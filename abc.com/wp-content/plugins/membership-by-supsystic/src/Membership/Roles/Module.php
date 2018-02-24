<?php

class Membership_Roles_Module extends Membership_Base_Module {

    public function afterModulesLoaded() {
		$assetsPath = $this->getAssetsPath();
		$dispatcher = $this->getDispatcher();
		$dispatcher->on('routes.ajaxHandler.ajaxRoutes', array($this, 'routesRolePermissionCheck'));
		add_action('init', array($this, 'initAction'));

		$this->getModule('routes')->registerAjaxRoutes(
			array(
				'roles.saveSettings' => array(
					'method' => 'post',
					'admin' => true,
					'handler' => array($this->getController(), 'saveSettings')
				),
				'roles.createRole' => array(
					'method' => 'post',
					'admin' => true,
					'handler' => array($this->getController(), 'createRole')
				),
				'roles.updateRole' => array(
					'method' => 'post',
					'admin' => true,
					'handler' => array($this->getController(), 'updateRole')
				),
				'roles.deleteRole' => array(
					'method' => 'post',
					'admin' => true,
					'handler' => array($this->getController(), 'deleteRole')
				)
			)
		);


	    if (!$this->isModule('roles')) {
		    return;
	    }

	    $this->getModule('assets')->enqueueAssets(
		    array(
			    $assetsPath . '/css/roles.backend.css',
		    ),
		    array(
			    $assetsPath . '/js/roles.backend.js',
		    )
	    );
	}

	public function initAction() {
		if (!is_user_logged_in()) {
			$rolesModel = $this->getModel('roles', 'roles');
			$guestRole = $rolesModel->getDefaultGuestRole();

			$this->registerFrontendData(array(
				'guestPermissions' => $guestRole['permissions'],
			));
		}
	}

	public function pregGrepKeys($pattern, $input, $flags = 0) {
		return array_intersect_key($input, array_flip(preg_grep($pattern, array_keys($input), $flags)));
	}

	public function routesRolePermissionCheck($routes) {
		$permissions = array(
			'send-and-receive-messages' => array(
				'messages.*',
			),
			'can-create-groups' => array(
				'groups.createGroup',
			),
			'join-groups' => array(
				'groups.join',
			),
			'read-groups' => array(
				'groups.follow',
				'groups.activity.post',
				'groups.activity.get',
				'groups.getUserGroups',
				'groups.getGroups'
			),
			'access-to-members-page' => array(
				'users.getUsers',
			),
			'access-to-global-activity-page' => array(
				'activity.get'
			),
			'access-to-profile-activity-page' => array(
				'users.activity.get'
			),
			'add-friends' => array(
				'users.friends.add'
			),
			'follow' => array(
				'users.followers.follow'
			)
		);

		$usersModule = $this->getModule('users');

		foreach ($permissions as $permission => $patterns) {
			if (!$usersModule->currentUserCan($permission)) {
				$routes = $this->pregGrepKeys('/^' . implode('$|^', $patterns) . '$/i', $routes, PREG_GREP_INVERT);
			}
		}

		return $routes;
	}

}