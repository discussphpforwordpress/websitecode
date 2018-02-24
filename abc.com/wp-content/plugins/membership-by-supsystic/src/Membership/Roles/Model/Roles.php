<?php

class Membership_Roles_Model_Roles extends Membership_Base_Model_Settings {

	private $roles = array();
	private $defaultRole = array();

	public function getDefaultGuestRole() {
		return $this->getRoleByType('__guest__', true);
	}

	public function getRoleByType($type, $withGuestRole = false) {
		if (!$this->roles) {
			$this->roles = $this->getRoles($withGuestRole);
		}

		foreach ($this->roles as $role) {
			if ($role['type'] === $type) {
				return $role;
			}
		}

		return false;
	}

	/**
	 * If default role not set in setting get default Membership User role permission
	 * @return array $role
	 */
	public function getDefaultRole() {
		if (!empty($this->defaultRole)) {
			return $this->defaultRole;
		}

		$settings = $this->getModule('base')->getSettings();
		$defaultRoleId = $settings['profile']['default-role'];
		$query = $this->preparePrefix(
			"SELECT 
				*
			FROM
				{prefix}roles
			WHERE id = '%d'
			LIMIT 1
			"
		);
		$role = $this->db->get_row(
			$this->db->prepare($query, array($defaultRoleId)),
			ARRAY_A
		);

		if ($role) {
			$role['permissions'] = unserialize($role['permissions']);
			$role['settings'] = unserialize($role['settings']);
			$roles = $this->mergeDefaultPermissions(array($role));
			$role = $roles[0];
		} else {
			$defaultRoles = $this->defaultRoles();
			$role = $defaultRoles[1]; // Membership User - 'subscriber'
		}

		$this->defaultRole = $role;

		return $role;
	}

	public function isRoleExist($id) {
		$query = $this->getQueryBuilder()
			->select(array('*'))
			->from($this->getTable('roles') . ' AS r')
			->where('r.id', '=', (int) $id)
			->build();

		$role = $this->db->get_row($query, ARRAY_A);
		return $role != null;
	}

	public function getRoleById($id) {
		$query = $this->getQueryBuilder()
		              ->select(array('*'))
		              ->from($this->getTable('roles') . ' AS r')
		              ->where('r.id', '=', $id)
		              ->build();

		$role = $this->db->get_row($query, ARRAY_A);

		if ($role) {
			$role['permissions'] = unserialize($role['permissions']);
			$role['settings'] = unserialize($role['settings']);

			$result = $this->mergeDefaultPermissions(array($role));
			$role = $result[0];
		} else {
			$role = $this->getDefaultRole();
		}

		return $role;
	}

	public function getRoles($withGuestRole = false) {
		$query = $this->getQueryBuilder()
			->select(array(
				'*',
				'(SELECT COUNT(*) FROM ' . $this->getTable('users_roles') . ' AS ur WHERE ur.role_id = r.id) AS users'
			))
			->from($this->getTable('roles') . ' AS r')
			->build();

		$roles = $this->db->get_results(
			$query,
			ARRAY_A
		);

		if ($roles) {
			foreach ($roles as $key => $role) {
				$roles[$key]['permissions'] = unserialize($role['permissions']);
				$roles[$key]['settings'] = unserialize($role['settings']);
			}

			$roles = $this->mergeDefaultPermissions($roles);
		} else {
			$roles = $this->defaultRoles();
		}

		$roles = $this->addSpecialRoles($roles);

		if (!$withGuestRole) {
			foreach ($roles as $key => $role) {
				if ($role['type'] == '__guest__') {
					unset($roles[$key]);
				}
			}
		}

		return $roles;
	}

	/**
	 * Gets all roles and return array of roles where key is role id and name of role its value
	 *
	 * @param bool $withGuestRole
	 *
	 * @return array
	 */
	public function getRolesList($withGuestRole = false) {
		$roles = $this->getRoles($withGuestRole);
		$rolesList = array();

		foreach ($roles as $role) {
			$rolesList[$role['id']] = $role['name'];
		}

		return $rolesList;
	}

	public function addSpecialRoles($roles) {
		$guestUserRoleExist = false;

		foreach ($roles as $role) {
			if ($role['type'] == '__guest__') {
				$guestUserRoleExist = true;
			}
		}

		if (!$guestUserRoleExist) {
			$defaultRoles = $this->defaultRoles();
			$permissions = $defaultRoles[1]['permissions']; // Membership User - 'subscriber'
			$roleSettings = isset($defaultRoles[1]['settings']) ? $defaultRoles[1]['settings'] : array();

			$name = 'Membership Guest';
			$type = '__guest__';

			$allowedPermissions = array(
				'read-groups',
				'access-to-members-page',
				'access-to-global-activity-page',
				'access-to-profile-activity-page',
			);

			foreach ($permissions as $permission => $value) {
				if (!in_array($permission, $allowedPermissions)) {
					$permissions[$permission] = 'false';
				}
			}

			$this->createRole($name, serialize($permissions), 'custom', serialize($roleSettings));

			if (!$this->getError()) {
				$roles[] = array(
					'id' => $this->db->insert_id,
					'name' => $name,
					'type' => $type,
					'permissions' => $permissions
				);
			}
		}

		return $roles;
	}

    public function getUserRole($userId) {
        $query = $this->getQueryBuilder()
            ->select(array('*'))
            ->from($this->getTable('roles') . ' AS r')
            ->join($this->getTable('users_roles') . ' AS ur')
            ->on('ur.role_id', '=', 'r.id')
            ->where('ur.user_id', '=', '%d')
            ->build();

        $role = $this->db->get_row(
            $this->db->prepare($query, array($userId)),
            ARRAY_A
        );

        if ($role) {
            $role['permissions'] = unserialize($role['permissions']);
			$role['settings'] = unserialize($role['settings']);
	        $roles = $this->mergeDefaultPermissions(array($role));
	        $role = array_shift($roles);
        } else {
            $role = $this->getDefaultRole();
        }

        return $role;
    }

    public function setUserRole($userId, $roleId) {
		$userRole = $this->getUserRole($userId);

		if ($userRole && isset($userRole['role_id'])) {
            $query = $this->getQueryBuilder()
                ->update($this->getTable('users_roles'))
                ->set(array('role_id' => '%d'))
                ->where('user_id', '=', '%d')
                ->build();
	    } else {
            $query = $this->getQueryBuilder()
                ->insertInto($this->getTable('users_roles'))
                ->fields(array('role_id', 'user_id'))
                ->values(array('%d', '%d'))
                ->build();
	    }

        return $this->db->query(
            $this->db->prepare($query, array($roleId, $userId))
        );
    }

	public function createRole($name, $permissions, $type = 'custom', $settings = null) {
		$query = $this->getQueryBuilder()
			->insertInto($this->getTable('roles'))
			->fields(array('name', 'permissions', 'settings', 'type'))
			->values(array('%s', '%s', '%s', '%s'))
			->build();

		if ($this->db->query($this->db->prepare($query, array($name, $permissions, $settings, $type)))) {
		    $result = $this->db->insert_id;
        } else {
		    $result = false;
		}

		return $result;
	}

	public function updateRole($roleId, $name, $permissions, $type = null, $settings = null) {
		$params = array('name' => '%s', 'permissions' => '%s', 'settings' => '%s');
		$paramsValues = array($name, $permissions, $settings, $roleId);

		if ($type) {
			$params['type'] = '%s';
			$paramsValues = array($name, $permissions, $settings, $type, $roleId);
		}

		$query = $this->getQueryBuilder()
			->update($this->getTable('roles'))
			->set($params)
			->where('id', '=', '%d')
			->build();

		return $this->db->query(
			$this->db->prepare($query, $paramsValues)
		);
	}

	public function deleteRole($roleId) {
		$query = $this->getQueryBuilder()
			->deleteFrom($this->getTable('roles'))
			->where('id', '=', '%d')
			->build();

		return $this->db->query(
			$this->db->prepare($query, array($roleId))
		);
	}

	private function defaultRoles() {
		$wpDefaultRole = get_option('default_role');

		return array(
			array(
				'name' => $this->environment->translate('Membership Administrator'),
				'type' => 'administrator',
				'permissions' => array(
					// Admin permissions
					'can-access-wp-admin' => 'true',
					'can-see-admin-bar' => 'true',
					// Activities
					'edit-activity' => 'true',
					// Profile
					'access-to-specific-roles-page' => array('all'),
					'can-delete-their-account' => 'true',
					'change-privacy-settings' => 'true',
					// Messages
					'send-and-receive-messages' => 'true',
					// Groups
					'can-block-groups' => 'true',
					'can-create-groups' => 'true',
					'join-groups' => 'true',
					'read-groups' => 'true',
					// Members page
					'access-to-members-page' => 'true',
					// Activity
					'access-to-global-activity-page' => 'true',
					'access-to-profile-activity-page' => 'true',
					// Friend
					'add-friends' => 'true',
					// Follows
					'follow' => 'true',
				),
				'settings' => array(
					'wp-role' => $wpDefaultRole,
				),
			),
			array(
				'name' => $this->environment->translate('Membership User'),
				'type' => 'subscriber',
				'permissions' => array(
					// Admin permissions
					'can-access-wp-admin' => 'true',
					'can-see-admin-bar' => 'true',
					// Activities
					'edit-activity' => 'false',
					// Profile
					'access-to-specific-roles-page' => array('all'),
					'can-delete-their-account' => 'true',
					'change-privacy-settings' => 'true',
					// Messages
					'send-and-receive-messages' => 'true',
					// Groups
					'can-block-groups' => 'false',
					'can-create-groups' => 'true',
					'join-groups' => 'true',
					'read-groups' => 'true',
					// Members page
					'access-to-members-page' => 'true',
					// Activity
					'access-to-global-activity-page' => 'true',
					'access-to-profile-activity-page' => 'true',
					// Friend
					'add-friends' => 'true',
					// Follows
					'follow' => 'true',
				),
				'settings' => array(
					'wp-role' => $wpDefaultRole,
				),
			),
			array(
				'name' => $this->environment->translate('Membership Guest'),
				'type' => '__guest__',
				'permissions' => array(
					'read-groups' => 'true',
					'access-to-members-page'  => 'true',
					'access-to-global-activity-page' => 'true',
					'access-to-profile-activity-page' => 'true',
					'access-to-specific-roles-page' => array('all')
				),
				'settings' => array(
					'wp-role' => $wpDefaultRole,
				),
			),
		);
	}

	/**
	 * Extends saved role permission in db with default permissions
	 * Need to allow easily adding new permissions to roles
	 * Role that not found in default roles list will use default role permissions
	 *
	 * @param array $roles
	 *
	 * @return array
	 */
	private function mergeDefaultPermissions(array $roles) {
		$defaultRoles = $this->defaultRoles();
		$defaultRole = $defaultRoles[1];

		foreach ($roles as &$role) {
			$defaultPermissions = array();

			foreach ($defaultRoles as $_role) {
				if ($role['type'] === $_role['type']) {
					$defaultPermissions = $_role['permissions'];
					continue;
				}
			}

			if (!$defaultPermissions) {
				$defaultPermissions = $defaultRole['permissions'];
			}

			$role['permissions'] = array_merge($defaultPermissions, $role['permissions']);
		}

		return $roles;
	}

	public function getWpRoles() {
		global $wp_roles;

		$allWpRoles = $wp_roles->roles;
		$resRoles = array();
		if(count($allWpRoles)) {
			foreach($allWpRoles as $roleKey => $roleVal) {
				if(isset($roleVal['name'])) {
					$resRoles[esc_attr($roleKey)] = array(
						'value' => esc_attr($roleKey),
						'title' => $roleVal['name'],
					); 
				}
			}
		}

		// adding No selected option, if default role not exists
		$defaultWpRole = get_option('default_role');
		if(!isset($resRoles[$defaultWpRole])) {
			array_unshift($resRoles, array(
				'value' => 0,
				'title' => 'Not selected',
			));
		}
		// sorting by value
		asort($resRoles);
		return $resRoles;
	}

	public function getUserRolesForSelect($selectedRoleId = 0, $addAllRolest = true) {
		$newUserRoles = array();
		$userRoles = $this->getRoles();

		$newUserRoles[0] = array(
			'id' => 0,
			'name' => $this->translate('All roles'),
			'selected' => 0 == $selectedRoleId,
		);

		if(count($userRoles)) {
			foreach($userRoles as $oneRole) {
				$newUserRoles[$oneRole['id']] = array(
					'id' => $oneRole['id'],
					'name' => $oneRole['name'],
					'selected' => $oneRole['id'] == $selectedRoleId,
				);
			}
		}
		return $newUserRoles;
	}
}