<?php

class Membership_Groups_Model_Groups extends Membership_Base_Model_Base
{
	public $limit = 10;

	public function getGroupsByIds($groupIds, $currentUserId, $orderBy = null) {
		return $this->getGroup($groupIds, $currentUserId, $orderBy);
	}

	public function getGroupByName($groupName, $currentUserId) {
		return $this->getGroupBy('name', $groupName, $currentUserId);
	}

	public function getGroupByAlias($groupAlias, $currentUserId) {
		return $this->getGroupBy('alias', $groupAlias, $currentUserId);
	}

	public function getGroup($groupId, $currentUserId, $orderBy = null) {
		return $this->getGroupBy('id', $groupId, $currentUserId, $orderBy);
	}

	public function getGroupBy($field, $value, $currentUserId, $orderBy = null) {

		$queryParams = array($currentUserId, $currentUserId, $currentUserId);

		$query = $this->preparePrefix(
			"SELECT
				g.id,
				g.name,
				g.description,
				g.category_id,
				gc.name AS category_name,
				g.alias,
				g.is_blocked AS isBlocked,
				g.created_at,
				CASE WHEN gb.id IS NOT NULL THEN 1 ELSE 0 END AS currentUserIsBanned,
				(SELECT COUNT(*)
					FROM {prefix}groups_users AS gu
					WHERE gu.group_id = g.id
					AND gu.approved = '1'
				) AS totalUsers,
				gu.group_role AS currentUserRole,
				gu.approved AS currentUserApproved,
				gu.is_creator AS isCurrentUserCreator,
				(SELECT 1 FROM {prefix}groups_followers WHERE user_id = '%d' AND group_id = g.id LIMIT 1) 
					AS currentUserIsFollowing
			FROM {prefix}groups AS g
			LEFT JOIN {prefix}groups_users AS gu ON (gu.group_id = g.id AND gu.user_id = %d)
			LEFT JOIN {prefix}groups_settings AS gs ON (gs.group_id = g.id)
			LEFT JOIN {prefix}groups_blacklists AS gb ON (gb.group_id = g.id AND gb.user_id = %d)
			LEFT JOIN {prefix}groups_category AS gc ON (gc.id = g.category_id)
		");

		if (is_array($value)) {
			if ($field === 'id') {
				$placeholders = implode(', ', array_pad(array(), count($value), "'%d'"));

				$query .= " WHERE g.id in ({$placeholders})";

			} elseif ($field === 'alias') {
				$placeholders = implode(', ', array_pad(array(), count($value), "'%s'"));

				$query .= " WHERE g.alias in ({$placeholders})";
			}

			$queryParams = array_merge($queryParams, $value);
		} else {
			$queryParams[] = $value;

			if ($field === 'id') {
				$query .= " WHERE g.id = '%d'";
			} elseif ($field === 'alias') {
				$query .= " WHERE g.alias = '%s'";
			}
		}

		$query .= ' GROUP BY g.id';

		if ($orderBy) {
			$query .= $orderBy;
		} else {
			$query .= ' ORDER BY g.id DESC';
		}

		$groups = $this->db->get_results(
			$this->db->prepare($query, $queryParams),
			ARRAY_A
		);

		if (!$groups) {
			return array();
		}

		$groupIds = array();

		foreach ($groups as $group) {
			$groupIds[] = $group['id'];
		}

		$groupsSettings = $this->getGroupSettings($groupIds);
		$groupsTags = $this->getModel('Tags', 'Groups')->getGroupsTags($groupIds);
		$groupsModule = $this->getModule('groups');
		$defaultGroupSettings = $this->getDefaultGroupSettings();

		$_groups = array();

		foreach ($groups as $group) {
			$group['images'] = array();

			$group['settings'] = $defaultGroupSettings;
			if (isset($groupsSettings[$group['id']])) {
				$group['settings'] = array_merge($group['settings'], $groupsSettings[$group['id']]);
			}

            $group['url'] = $groupsModule->getGroupUrl($group);
            $group['tags'] = array();
            if (isset($groupsTags[$group['id']])) {
            	$group['tags'] = $groupsTags[$group['id']];
            }

            $_groups[$group['id']] = $group;
		}

		$imagesModel = $this->getModel('Images', 'Base');
		$images = $imagesModel->getGroupsImages(array_keys($_groups), true);

		foreach ($images as $image) {
			if (isset($_groups[$image['group_id']])) {
				$_groups[$image['group_id']]['images'][] = $image;
			}
		}

		if (is_array($value)) {
			return $_groups;
		} else {
			return array_shift($_groups);
		}
	}

	public function getGroupIdByAlias($alias)
	{
		$query = $this->preparePrefix(
			"
			SELECT 
				g.id
			FROM
				{prefix}groups AS g
			WHERE g.alias = '%s'
			LIMIT 1
			"
		);

		return $this->db->get_col(
			$this->db->prepare($query, array($alias))
		);
	}

	public function getGroupAliasIds($alias)
	{
		$query = $this->preparePrefix(
			"
			SELECT 
				SUBSTRING(g.alias, %d)
			FROM
				{prefix}groups AS g
			WHERE g.alias REGEXP '". $alias. "-[0-9]+$'
			"
		);

		return $this->db->get_col(
			$this->db->prepare($query, array(strlen($alias) + 2, $alias))
		);
	}

	public function getGroupSettings(array $groupIds) {

		$placeholders = implode(', ', array_pad(array(), count($groupIds), "'%d'"));

		$query = $this->preparePrefix(
			"SELECT *
			FROM {prefix}groups_settings AS gs
			WHERE group_id IN ($placeholders)
		");

		$settings = $this->db->get_results(
			$this->db->prepare($query, $groupIds),
			ARRAY_A
		);

		$_settings = array();

		foreach ($settings as $setting) {
			$_settings[$setting['group_id']][$setting['setting']] = $setting['value'];
		}

		return $_settings;
	}

	public function getDefaultGroupSettings() {
		return array(
			'type' => 'open',
			'invitations' => 'members-only',
			'read-activity' => 'all',
			'post-activity' => 'all',
			'post-comments' => 'all',
		);
	}

    public function setGroupSettings($groupId, $settings) {
        foreach ($settings as $settingName => $settingValue) {
            $query = $this->getQueryBuilder()
                    ->insertInto($this->getTable('groups_settings'))
                    ->fields(array('group_id', 'setting', 'value'))
                    ->values(array('%d', '%s', '%s')) . ' ON DUPLICATE KEY UPDATE value = %s';

            if (false === $this->db->query(
                    $this->db->prepare($query, array($groupId, $settingName, $settingValue, $settingValue))
            )) {
                return false;
            }
        }

        return true;
    }

    public function updateGroup($data, $groupId) {

		$query = $this->getQueryBuilder()
			->update($this->getTable('groups'))
			->set(array(
				'name' => '%s',
				'description' => '%s',
				'category_id' => '%s',
			))
			->where('id', '=', '%d');
			
		return $this->db->query(
			$this->db->prepare($query, array(
				$data['name'],
				$data['description'],
				$data['category_id'],
				$groupId,
			))
		);
	}

	public function getGroupMembers($groupId, $status, $limit = 0, $offsetId = null, $search = null)
	{
		$queryParams = array(
			$groupId
		);

		$selectPlaceholder = '';
        $fromPlaceholder = '';
		$prefixPlaceholder = $this->preparePrefix("{prefix}");

		$andQuerySql = '';

		if ($offsetId) {
			$andQuerySql .= $this->db->prepare("AND g.user_id < '%d' ", $offsetId);
		}

		switch ($status) {
			case 'invited':
				$fromPlaceholder = $this->preparePrefix("{prefix}groups_invites");
				break;
			case 'blocked':
				$fromPlaceholder = $this->preparePrefix("{prefix}groups_blacklists");
				break;
			case 'approved':
			case 'unapproved':
				$fromPlaceholder = $this->preparePrefix("{prefix}groups_users");
				break;
		}

		$searchColumnsPlaceholder = '';
		$searchJoinPlaceholder = '';

		if ($search) {
			$searchColumnsPlaceholder = "
				,
				m1.meta_value AS firstName,
				m2.meta_value AS lastName
			";
			$searchJoinPlaceholder = "
				LEFT JOIN {$this->db->base_prefix}usermeta AS m1 ON (m1.user_id = g.user_id AND m1.meta_key = 'first_name')
				LEFT JOIN {$this->db->base_prefix}usermeta AS m2 ON (m2.user_id = g.user_id AND m2.meta_key = 'last_name')
			";
		}

		if ($status === 'approved') {
			$andQuerySql .= ' AND g.approved = 1';
		}

		if ($status === 'unapproved') {
			$andQuerySql .= ' AND g.approved = 0';
		}

		$query = "
			SELECT g.user_id as id {$selectPlaceholder}
			{$searchColumnsPlaceholder}
			FROM {$fromPlaceholder} as g
			{$searchJoinPlaceholder}
			LEFT JOIN {$prefixPlaceholder}users_statuses as us ON us.user_id = g.user_id 
			WHERE g.group_id = '%d' AND us.user_status = 0
			{$andQuerySql}
		";

		if ($search) {
			$query .= " HAVING CONCAT(firstName, ' ', lastName) LIKE CONCAT('%%', '%s', '%%') OR CONCAT(lastName, ' ', firstName) LIKE CONCAT('%%', '%s', '%%')";
			$queryParams[] = $search;
			$queryParams[] = $search;
		}

		$query .= " ORDER BY g.user_id DESC";

		if ($limit) {
            $query .= " LIMIT %d";
            $queryParams[] = $limit;
		}

		$results = $this->db->get_results(
			$this->db->prepare($query, $queryParams),
			ARRAY_A
		);

		$users = array();

		foreach ($results as $user) {
			$users[] = $user['id'];
		}

		if ($results) {
			// get users info for current group
			$usersGroupInfo = $this->getGroupUsersInfo($users, $groupId);

			$users = $this->getModel('profile', 'users')->getUsersByIds(array('users' => $users));
			foreach ($users as &$user) {
				$user['groupRole'] = $status;
				if(!empty($usersGroupInfo[$user['id']])) {
					$user['groupInfo'] = $usersGroupInfo[$user['id']];
				}
			}
		}

		return $users;
	}

	public function getUsersToInvite($groupId = null, $userId, $limit, $offsetId = null, $search = null) {

		$usersModel = $this->getModel('profile', 'users');
		$andWhereSql = '';

		if ($offsetId) {
			$andWhereSql .= $this->db->prepare("AND friend_id < '%d' ", $offsetId);
		}

		if (!$search) {
			if ($groupId) {
				$andWhereSql .= $this->db->prepare(
					$this->preparePrefix("
						AND friend_id NOT IN (
							SELECT user_id FROM {prefix}groups_invites
							WHERE group_id = '%d'
							UNION DISTINCT 
							SELECT user_id FROM {prefix}groups_users
							WHERE group_id = '%d'
						)
					"), array($groupId, $groupId)
				);
			}

			$results = $this->db->get_col(
				$this->db->prepare(
					$this->preparePrefix("
						SELECT friend_id
						FROM {prefix}friends
						WHERE user_id = '%d' {$andWhereSql}
						ORDER BY friend_id DESC
						LIMIT %d
					"), array(
						$userId,
						$limit
					)
				)
			);
		} else {
			$andWhere = null;

			if ($groupId) {
				$andWhere = $this->db->prepare(
					$this->preparePrefix("
						AND search.user_id NOT IN (
							SELECT user_id FROM {prefix}groups_invites
							WHERE group_id = '%d'
							UNION DISTINCT
							SELECT user_id FROM {prefix}groups_users
							WHERE group_id = '%d'
						)
					"), array($groupId, $groupId)
				);
			}

			$results = $usersModel->searchByName(array(
				'search' => $search,
				'limit' => $limit,
				'offsetId' => $offsetId,
				'andWhere' => $andWhere
			));

		}

		$users = array();
		$settings = $this->getModule('groups')->getSettings();

		if (
			isset($settings['groups'])
			&& isset($settings['groups']['roles-to-invite'])
			&& $settings['groups']['roles-to-invite'] == 'friends-only'
		) {
			$friendsModel = $this->getModel('friends', 'users');
			$friendsIds = array();

			foreach ($friendsModel->getUserFriends(get_current_user_id(), 100) as $friend) {
				$friendsIds[] = $friend['id'];
			}

			$results = array_intersect($results, $friendsIds);
		}

		if ($results) {
			$users = $usersModel->getUsersByIds(array('users' => $results));
		}

		return $users;
	}

	public function countGroupUsers($groupId, $roles = array('approved'))
	{

		$query = array();

		if (in_array('approved', $roles)) {
			$query[] = $this->db->prepare("
				(SELECT COUNT(gu.user_id)
					FROM {prefix}groups_users AS gu
					LEFT JOIN {prefix}users_statuses us 
						ON us.user_id = gu.user_id 
					WHERE group_id = '%d' AND approved = 1
					AND us.user_status = 0 
					AND gu.user_id NOT IN
						(SELECT user_id
						FROM {prefix}groups_blacklists AS bl
						WHERE gu.group_id = bl.group_id)
				) as approved
			", $groupId);
		}

		if (in_array('unapproved', $roles)) {
			$query[] = $this->db->prepare("
				(SELECT COUNT(gu.user_id)
					FROM {prefix}groups_users AS gu
					LEFT JOIN {prefix}users_statuses us 
						ON us.user_id = gu.user_id 
					WHERE group_id = '%d' AND approved = 0 
					AND us.user_status = 0 
					AND gu.user_id NOT IN
						(SELECT user_id
						FROM {prefix}groups_blacklists AS bl
						WHERE gu.group_id = bl.group_id)
				) as unapproved
			", $groupId);
		}

		if (in_array('invited', $roles)) {
			$query[] = $this->db->prepare("
				(SELECT COUNT(gi.user_id) 
					FROM {prefix}groups_invites gi
					LEFT JOIN {prefix}users_statuses us 
						ON us.user_id = gi.user_id 
					WHERE group_id = '%d'
					AND us.user_status = 0
				) as invited
			", $groupId);
		}

		if (in_array('blocked', $roles)) {
			$query[] = $this->db->prepare("
				(SELECT COUNT(gb.user_id) 
					FROM {prefix}groups_blacklists gb
					LEFT JOIN {prefix}users_statuses us 
						ON us.user_id = gb.user_id 
					WHERE gb.group_id = '%d'
				) as blocked
			", $groupId);
		}

		$query = $this->preparePrefix("SELECT " . implode(',', $query));

		return $this->db->get_row($query, ARRAY_A);
	}

	public function countUsersByRole($groupId, $role)
	{
		$query = $this->preparePrefix("
			SELECT COUNT(user_id)
			FROM {prefix}groups_users AS gu
			WHERE gu.group_id = '%d' AND gu.group_role = '%s'
		");

		return $this->db->get_var(
			$this->db->prepare($query, array($groupId, $role))
		);
	}

	public function createGroup($data) {
		if ($this->getGroupIdByAlias($data['alias'])) {
			$aliasIds = $this->getGroupAliasIds($data['alias']);
			$maxAliasId = 0;

			foreach ($aliasIds as $aliasId) {
				if ($maxAliasId < $aliasId) {
					$maxAliasId = $aliasId;
				}
			}

			$data['alias'] .= '-'. ($maxAliasId + 1);
		}

        $currentDateTime = $this->getCurrentDateInUTC();
		$query = $this->getQueryBuilder()
			->insertInto($this->getTable('groups'))
			->fields(array('name', 'description', 'category_id', 'alias', 'created_at', 'updated_at'))
			->values(array('%s', '%s', '%s', '%s', '%s', '%s'));
		$data[] = $currentDateTime;
        $data[] = $currentDateTime;
		
		$this->db->query(
			$this->db->prepare($query, $data)
		);

        $groupId = $this->db->insert_id;

		return $groupId;
	}


	public function deleteGroup($id) {

		$query = $this->getQueryBuilder()
			->deleteFrom($this->getTable('groups'))
			->where('id', '=', $id)
			->build();
			
		$this->db->query($query);

        $query = $this->getQueryBuilder()
            ->deleteFrom($this->getTable('groups_users'))
            ->where('group_id', '=', $id)
            ->build();

        $this->db->query($query);

        $query = $this->getQueryBuilder()
            ->deleteFrom($this->getTable('groups_albums'))
            ->where('group_id', '=', $id)
            ->build();

        $this->db->query($query);

        $query = $this->getQueryBuilder()
            ->deleteFrom($this->getTable('groups_blacklists'))
            ->where('group_id', '=', $id)
            ->build();

        $this->db->query($query);

        $query = $this->getQueryBuilder()
            ->deleteFrom($this->getTable('groups_followers'))
            ->where('group_id', '=', $id)
            ->build();

        $this->db->query($query);

        $query = $this->getQueryBuilder()
            ->deleteFrom($this->getTable('groups_images'))
            ->where('group_id', '=', $id)
            ->build();

        $this->db->query($query);

        $query = $this->getQueryBuilder()
            ->deleteFrom($this->getTable('groups_invites'))
            ->where('group_id', '=', $id)
            ->build();

        $this->db->query($query);

        $query = $this->getQueryBuilder()
            ->deleteFrom($this->getTable('groups_settings'))
            ->where('group_id', '=', $id)
            ->build();

        $this->db->query($query);

        $query = $this->getQueryBuilder()
            ->deleteFrom($this->getTable('groups_tags'))
            ->where('group_id', '=', $id)
            ->build();

        return $this->db->query($query);
	}

	public function blockGroup($groupId) {

		$query = $this->getQueryBuilder()
			->update($this->getTable('groups'))
			->set(array(
				'is_blocked' => 1
			))
			->where('id', '=', '%d');

		$this->db->query($this->db->prepare($query, array($groupId)));
	}

	public function unblockGroup($groupId) {

		$query = $this->getQueryBuilder()
			->update($this->getTable('groups'))
			->set(array(
				'is_blocked' => 0
			))
			->where('id', '=', '%d');

		$this->db->query($this->db->prepare($query, array($groupId)));
	}

	public function addUserToGroup($groupId, $userId, $groupRole, $approved, $isCreator = 0) {

		$query = $this->preparePrefix("
			INSERT INTO {prefix}groups_users (`group_id`, `group_role`, `user_id`, `approved`, `is_creator`)
			VALUES ('%d', '%s', '%d', '%d', '%d');
		");

		return $this->db->query(
			$this->db->prepare($query, array($groupId, $groupRole, $userId, $approved, $isCreator))
		);
	}

	public function removeUserFromGroup($groupId, $userId) {

		$query = $this->preparePrefix("
			DELETE FROM {prefix}groups_users
			WHERE group_id = '%d' AND user_id = '%d'
		");

		return $this->db->query(
			$this->db->prepare($query, array($groupId, $userId))
		);
	}

	public function setGroupAdmin($groupId, $userId, $isGroupCreator = 0) {
		return $this->addUserToGroup($groupId, $userId, 'administrator', true, $isGroupCreator);
	}


	public function userHasPermission($userId, $groupId, $permissions) {
		$user = $this->getGroupUser($groupId, $userId);
		// TODO check permission based on role or check it in routes
		if ($user && $user->role === 'administrator') {
			return true;
		}
	}

	public function getGroupUser($groupId, $userId) {

		$query = $this->preparePrefix("
			SELECT * FROM {prefix}groups_users where group_id = '%d' AND user_id = '%d';
		");

		return $this->db->get_row(
			$this->db->prepare($query, array($groupId, $userId)),
			ARRAY_A
		);

	}

	public function updateUserGroupRole($groupId, $userId, $groupRole = 'user', $approved = true) {

		$query = $this->preparePrefix("
			UPDATE {prefix}groups_users
			SET group_role = '%s', approved = '%d'
			WHERE group_id = '%d' AND user_id = '%d' ;
		");

		return $this->db->query(
			$this->db->prepare($query, array($groupRole, intval($approved), $groupId, $userId))
		);

	}

	public function countUserGroups($userId)
	{
		$query = $this->preparePrefix("
			SELECT
				(
					SELECT COUNT(group_id)
					FROM {prefix}groups_users
					WHERE user_id = '%d' AND approved = '1'
				) as joined,
				(
					SELECT COUNT(group_id)
					FROM {prefix}groups_users
					WHERE user_id = '%d' AND approved = '1' AND group_role IN ('administrator')
				) as managed,
				(
					SELECT COUNT(group_id)
					FROM {prefix}groups_invites
					WHERE user_id = '%d'
				) as invited
		");

		return $this->db->get_row(
			$this->db->prepare(
				$query,
				array($userId, $userId, $userId)
			),
			ARRAY_A
		);
	}

	public function getUserGroups($userId, $type, $limit, $offsetId = null, $search = null, $categoryId = null)
	{
		$queryParams = array($userId);

		switch ($type) {
			case 'joined':
				$query = $this->preparePrefix("
					SELECT gu.group_id, g.name 
					FROM {prefix}groups_users AS gu
					LEFT JOIN {prefix}groups AS g ON (gu.group_id = g.id)
					WHERE user_id = '%d' AND gu.approved = '1'
				");
				break;
			case 'joined-ordered-by-activity':
				$query = $this->preparePrefix("
					SELECT gu.group_id, g.name
					FROM {prefix}groups_users AS gu
					LEFT JOIN {prefix}groups AS g ON (gu.group_id = g.id)
					LEFT JOIN (
						SELECT max(id) as max_id, object_id
						FROM {prefix}activity
						WHERE type = 'group_post' 
						AND status = 'active'
						GROUP BY object_id
					) as a ON (a.object_id = g.id)
					WHERE user_id = '%d' AND gu.approved = '1'
				");
				break;
			case 'managed':
				$query = $this->preparePrefix("
					SELECT gu.group_id, g.name 
					FROM {prefix}groups_users AS gu
					LEFT JOIN {prefix}groups AS g ON (gu.group_id = g.id)
					WHERE user_id = '%d' AND gu.approved = '1' AND gu.group_role IN ('administrator')
				");
				break;
			case 'invited':
				$query = $this->preparePrefix("
					SELECT gi.group_id, g.name 
					FROM {prefix}groups_invites AS gi
					LEFT JOIN {prefix}groups AS g ON (gi.group_id = g.id)
					WHERE user_id = '%d'
				");
				break;
            case 'followed':
                $query = $this->preparePrefix("
					SELECT gf.group_id, g.name 
					FROM {prefix}groups_followers AS gf
					LEFT JOIN {prefix}groups AS g ON (gf.group_id = g.id)
					WHERE user_id = '%d'
				");
                break;
		}


		if ($offsetId) {
			$query .= $this->db->prepare(" AND g.id < '%d'", $offsetId);
		}

		if ($search) {
			$query .= " AND g.name LIKE CONCAT('%%', '%s', '%%')";
			$queryParams[] = $search;
		}
		if($categoryId) {
			$query .= " AND g.category_id = '%s'";
			$queryParams[] = $categoryId;
		}

		$queryParams[] = $limit;

		if($type == 'joined-ordered-by-activity') {
			$query .= " ORDER BY max_id DESC, g.id DESC LIMIT %d";
		} else {
			$query .= " ORDER BY g.id DESC LIMIT %d";
		}

//		var_dump($query);
//		exit();

		$results = $this->db->get_col(
			$this->db->prepare($query, $queryParams)
		);

		$groups = array();

		if ($results) {
			$groups = $this->getGroupsByIds($results, get_current_user_id());
			// reordering groups array
			if($type == 'joined-ordered-by-activity') {
				$newGroupsWithOrder = array();
				if(count($groups)) {
					foreach($results as $oneIndex) {
						if(isset($groups[$oneIndex])) {
							$newGroupsWithOrder[$oneIndex] = $groups[$oneIndex];
						}
					}
					$groups = $newGroupsWithOrder;
				}
			}
		}

//		echo "<pre>";
//		print_r($results);
//		// print_r($newGroupsWithOrder);
//		print_r($groups);
//		echo "</pre>";
//		exit();

		return array_values($groups);
	}

	public function getGroups($currentUserId, $limit, $offsetId = null, $search = null, $categoryId = null) {

		$queryParams = array($currentUserId);

		$whereQuery = '';

		if ($offsetId) {
			$whereQuery .= $this->db->prepare(" AND g.id < '%d'", $offsetId);
		}

		if ($search) {
			$whereQuery .= " AND g.name LIKE CONCAT('%%', '%s', '%%')";
			$queryParams[] = $search;
		}
		if($categoryId) {
			$whereQuery .= " AND g.category_id = '%s'";
			$queryParams[] = $categoryId;
		}

		$query = $this->preparePrefix("
			SELECT
				g.id,
				g.name,
				gu.group_role AS currentUserRole,
				gs.value AS groupType
			FROM {prefix}groups AS g
			LEFT JOIN {prefix}groups_users AS gu ON (g.id = gu.group_id AND gu.user_id = '%d')
			LEFT JOIN {prefix}groups_settings AS gs ON (g.id = gs.group_id AND gs.setting = 'type')
			WHERE g.is_blocked = '0' {$whereQuery}
			GROUP BY g.id
		");

		$query .= "
			HAVING (groupType IN ('open', 'closed') OR (groupType = 'private' AND currentUserRole IN ('administrator')))
			ORDER BY g.id DESC
			LIMIT %d
		";

		$queryParams[] = $limit;

		$groups = $this->db->get_col(
			$this->db->prepare($query, $queryParams)
		);

		if ($groups) {
			$groups = $this->getGroupsByIds($groups, $currentUserId);
		}

		return array_values($groups);
	}



	public function getPopularGroups($params) {

		$limit = isset($params['limit']) ? $params['limit'] : 5;
		$since = isset($params['since']) ? $params['since'] : 0;
		$interval = '';

		switch ($since) {
			case 0:
				$interval = ' AND gf.followed_at >= DATE(NOW() - INTERVAL 1 DAY)';
				break;
			case 1:
				$interval = ' AND gf.followed_at >= DATE(NOW() - INTERVAL 7 DAY)';
				break;
			case 2:
				$interval = ' AND gf.followed_at >= DATE(NOW() - INTERVAL 30 DAY)';
				break;
			case 4:
				$interval = ' AND gf.followed_at >= DATE(NOW() - INTERVAL 365 DAY)';
				break;
		}

		$query = $this->preparePrefix("
			SELECT 
			    g.id, COUNT(gf.id) as followers
			FROM
			    {prefix}groups AS g
			        LEFT JOIN
			    {prefix}groups_followers AS gf ON (gf.group_id = g.id {$interval})
			    	JOIN {prefix}groups_settings AS gs ON (g.id = gs.group_id AND gs.setting = 'type' AND gs.value != 'private')
			WHERE g.is_blocked = '0'
			GROUP BY g.id
			ORDER BY followers DESC
			LIMIT %d
		");

		$groups = $this->db->get_col(
			$this->db->prepare($query, $limit)
		);

		if ($groups) {
			$_groups = implode(', ', $groups);
			$orderBy = " ORDER BY FIELD (g.id, $_groups)";
			$groups = $this->getGroupsByIds($groups, get_current_user_id(), $orderBy);
		}

		return $groups;
	}

	public function getGroupUsersInfo(array $userIds, $groupId) {

		$groupId = (int) $groupId;
		$userParamStr = array_fill(0, count($userIds), '%d');

		$query = $this->preparePrefix("SELECT DISTINCT `group_role`, `user_id`, `is_creator` FROM `{prefix}groups_users` WHERE group_id = " . $groupId. " AND user_id IN (" . implode(',', $userParamStr) . ')');

		$queryRes = $this->db->get_results(
			$this->db->prepare($query, $userIds),
			ARRAY_A
		);

		$funcRes = array();
		if(count($queryRes)) {
			foreach($queryRes as $oneUserInfo) {
				$funcRes[$oneUserInfo['user_id']] = $oneUserInfo;
			}
		}

		return $funcRes;
	}
}