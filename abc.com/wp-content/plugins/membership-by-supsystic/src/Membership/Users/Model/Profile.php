<?php

class Membership_Users_Model_Profile extends Membership_Base_Model_Base
{

	static $users = array();

	public function getCurrentUser() {
		return $this->getUserById(get_current_user_id());
	}

	public function getUserByUsername($username) {
		return $this->getUserBy(array(
			'field' => 'login',
			'users' => $username,
		));
	}

	public function getUserById($userId) {
		return $this->getUserBy(array(
			'field' => 'id',
			'users' => $userId,
		));
	}

	public function getUsersByIds($params = array()) {

		return $this->getUserBy(
			array_merge(array(
				'field' => 'id',
				'users' => null,
				'orderBy' => null,
				'limit' => null,
				'offset' => null,
				'status' => null,
				'extraWhere' => null
			), $params)
		);

	}

	private function getCapabilitiesMetaKey() {

		$capabilitiesMetaKey = $this->db->base_prefix;

		$blogId = get_current_blog_id();

		if ($blogId > 1) {
			$capabilitiesMetaKey .= $blogId . '_';
		}

		return $capabilitiesMetaKey .= 'capabilities';
	}

	private function selectQuery()
	{
		$currentUserId = get_current_user_id();
		$queryParams = array_pad(array(), 5, $currentUserId);
		$extraJoin = '';

		if (is_multisite()) {
			$extraJoin .= $this->db->prepare(
				" JOIN {wp_base_prefix}usermeta AS msum ON (msum.user_id = u.ID AND msum.meta_key = %s)",
				$this->getCapabilitiesMetaKey()
			);
		}
		/**
		 * currentUserFriend - Means that requested user is friend of current user who made request.
		 * currentUserIsFriend - Means that current user who made request is friend of requested user
		 * currentUserIsFriendOfFriends - Means that current user who made request is friend of requested user friends
		 */
		return $this->db->prepare($this->preparePrefix("
			SELECT 
				u.ID as id,
				u.user_login,
				u.user_email,
				u.user_registered,
				u.display_name,
				ur.role_id as role_id,
				us.user_status as user_status,
				(SELECT 1 FROM {prefix}friends WHERE user_id = '%d' AND friend_id = u.ID LIMIT 1) 
					AS currentUserFriend,
				(SELECT 1 FROM {prefix}friends WHERE user_id = u.ID AND friend_id = '%d' LIMIT 1) 
					AS currentUserIsFriend,
				(SELECT 1 FROM {prefix}friends
					WHERE user_id IN (SELECT friend_id FROM {prefix}friends WHERE user_id = u.ID)
					AND friend_id = '%d'
					LIMIT 1
				) AS currentUserIsFriendOfFriends,
				(SELECT 1 FROM {prefix}followers WHERE user_id = '%d' AND following_id = u.ID LIMIT 1) 
					AS isFollowing,
				(SELECT 1 FROM {prefix}followers WHERE user_id = u.ID AND following_id = '%d' LIMIT 1) 
					AS isFollowed
			FROM
				{$this->db->base_prefix}users AS u
			LEFT JOIN {prefix}users_statuses AS us ON us.user_id = u.ID
			LEFT JOIN {prefix}users_roles AS ur ON ur.user_id = u.ID
			{$extraJoin}
		"), $queryParams);
	}

	public function getUserBy($params) { //  = array(), $field, $value, $orderBy = null, $limit = null, $offset = null, $status = null

		$field = $params['field'];
		$users = $params['users'];
		$orderBy = isset($params['orderBy']) ? $params['orderBy'] : null;
		$limit = isset($params['limit']) ? $params['limit'] : null;
		$offset = isset($params['offset']) ? $params['offset'] : null;
		$status = isset($params['status']) ? $params['status'] : null;
		$extraWhere = isset($params['extraWhere']) ? $params['extraWhere'] : null;

		$cacheOfInputValue = $users;

		if (!is_array($users)) {
			$users = array($users);
		}

		$queryParams = array();
		$query = $this->selectQuery();

		if (!is_null($status)) {
			$status = $this->db->prepare(' AND us.user_status = %d', $status);
		}

		$queryParams = array_merge($queryParams, $users);

		if ($field === 'id') {
			$placeholders = implode(', ', array_pad(array(), count($users), "'%d'"));
			$query .= " WHERE u.id in ({$placeholders}) {$status}";
		} elseif ($field === 'login') {
			$placeholders = implode(', ', array_pad(array(), count($users), "'%s'"));
			$query .= " WHERE u.user_login in ({$placeholders}) {$status}";
		}

		$query .= $extraWhere;

		if ($orderBy) {
			$query .= $orderBy;
		} else {
			$query .= ' ORDER BY u.id DESC';
		}

		if ($limit) {
            $query .= " LIMIT %d, %d";

            $queryParams = array_merge($queryParams, array($offset, $limit));
		}

		$users = $this->db->get_results(
			$this->db->prepare($query, $queryParams),
			ARRAY_A
		);

		$users = $this->prepareRelatedData($users);

		if (is_array($cacheOfInputValue)) {
			return array_values($users);
		} else {
			return array_shift($users);
		}
	}

	public function prepareRelatedData($users) {

		$_users = array();

		if ($users) {
			$userIds = array();
			$usersModule = $this->getModule('users');
			$privacy = $this->getDefaultPrivacy();
			$notificationsSettings = $this->getDefaultNotificationsSettings();
			$rolesModel = $this->getModel('roles', 'roles');

			foreach ($users as &$user) {

				$userIds[] = $user['id'];

				$userMeta = get_user_meta($user['id']);

				$user['firstName'] = isset($userMeta['first_name']) ? $userMeta['first_name'][0] : null;
				$user['lastName'] =  isset($userMeta['last_name']) ? $userMeta['last_name'][0] : null;
				$user['fields'] = isset($userMeta['membership_fields']) ? $userMeta['membership_fields'][0] : null;
				$user['privacy'] = isset($userMeta['membership_privacy']) ? $userMeta['membership_privacy'][0] : null;
				$user['notifications'] = isset($userMeta['membership_notifications']) ? $userMeta['membership_notifications'][0] : null;
				$user['nickname'] = !empty($userMeta['nickname'][0]) ? $userMeta['nickname'][0] : null;


				$statusesList = $this->userStatusesList();

				if (is_null($user['user_status'])) {
					$user['user_status'] = Membership_Users_Model_Fields::STATUS_PENDING_REVIEW;
				}

				$user['userStatus'] = $statusesList[$user['user_status']];

				if (isset($user['fields'])) {
					$user['fields'] = unserialize($user['fields']);
				}

				if (isset($user['images'])) {
					$user['images'] = unserialize($user['images']);
				}

				if (isset($user['role_id'])) {
					$role = $rolesModel->getRoleById($user['role_id']);
				} else {
					$role = $rolesModel->getDefaultRole();
				}

				$user['roleName'] = $role['name'];
				$user['permissions'] = $role['permissions'];

				if (isset($user['privacy']) && $user['permissions']['change-privacy-settings'] === 'true') {
					$_privacy = unserialize($user['privacy']);
					$user['privacy'] =  array_merge($privacy, $_privacy);
				} else {
					$user['privacy'] = $privacy;
				}

				if (isset($user['notifications'])) {
					$_notificationsSettings = unserialize($user['notifications']);
					$user['notifications'] =  array_merge($notificationsSettings, $_notificationsSettings);
				} else {
					$user['notifications'] = $notificationsSettings;
				}

				$user['displayName'] = $usersModule->getDisplayName($user);
				$user['images'] = array();

				$_users[$user['id']] = $user;
			}

			$imagesModel = $this->getModel('images', 'base');

			$images = $imagesModel->getUsersImages($userIds, true);



			foreach ($images as $image) {
				$_users[$image['user_id']]['images'][] = $image;
			}

			$socialStats = $this->getSocialStats($userIds);

			foreach ($socialStats as $stats) {
				$_users[$stats['user_id']]['follows'] = $stats['follows'];
				$_users[$stats['user_id']]['followers'] = $stats['followers'];
				$_users[$stats['user_id']]['friends'] = $stats['friends'];
			}

			$_users = $this->getDispatcher()->apply('users.prepareRelatedData', array($_users));
		}

		return $_users;
	}

	public function getSocialStats(array $userIds) {

		$placeholders = implode(', ', array_pad(array(), count($userIds), "'%d'"));

		$socialStats = array();

		foreach ($userIds as $userId) {
			$socialStats[$userId] = array(
				'user_id' => $userId,
				'follows' => 0,
				'followers' => 0,
				'friends' => 0
			);
		}

		$follows = $this->getData($this->db->prepare($this->preparePrefix("
			SELECT 
				f.user_id,
		        COUNT(f.following_id) as follows
		    FROM
		        {prefix}followers AS f
		    JOIN {$this->db->base_prefix}users AS u ON (f.following_id = u.ID)
		    JOIN {prefix}users_statuses AS us ON (us.user_id = f.following_id and us.user_status = '0')
		    WHERE f.user_id IN ($placeholders)
		    GROUP BY f.user_id
    	"), $userIds));


		foreach ($follows as $userFollows) {
			$socialStats[$userFollows['user_id']]['follows'] = $userFollows['follows'];
		}

		$followers = $this->getData($this->db->prepare($this->preparePrefix("
			SELECT 
				f.following_id as user_id,
		        COUNT(f.user_id) AS followers
		    FROM
		        {prefix}followers AS f
		    JOIN {$this->db->base_prefix}users AS u ON (f.user_id = u.ID)
		    JOIN {prefix}users_statuses AS us ON (us.user_id = f.user_id and us.user_status = '0')
		    WHERE f.following_id IN ($placeholders)
		    GROUP BY f.following_id
    	"), $userIds));

		foreach ($followers as $userFollowers) {
			$socialStats[$userFollowers['user_id']]['followers'] = $userFollowers['followers'];
		}

		$friends = $this->getData($this->db->prepare($this->preparePrefix("
			SELECT 
				f.user_id,
		        COUNT(f.friend_id) AS friends
		    FROM
		        {prefix}friends AS f
				JOIN {prefix}friends AS f2 ON (f2.user_id = f.friend_id AND f2.friend_id = f.user_id)
				JOIN {$this->db->base_prefix}users AS u ON (f.user_id = u.ID)
				JOIN {prefix}users_statuses AS us ON (us.user_id = f.friend_id and us.user_status = '0')
		    WHERE f.user_id IN ($placeholders)
		    GROUP BY f.user_id
    	"), $userIds));

		foreach ($friends as $userFriends) {
			$socialStats[$userFriends['user_id']]['friends'] = $userFriends['friends'];
		}

		return $socialStats;
	}

	public function getDefaultPrivacy()
	{
		return array(
			'view-profile' => 'all-users',
			'view-activity' => 'all-users',
			'send-messages' => 'all-users',
			'view-about' => 'all-users',
			'view-friends' => 'all-users',
            'view-follows' => 'all-users',
            'view-followers' => 'all-users',
			'view-groups' => 'all-users',
			'post-activity' => 'all-users',
			'view-comments' => 'all-users',
			'post-comments' => 'all-users',
			'view-posts' => 'all-users',
			'show-in-members-directory' => 'yes',
		);
	}

	public function getDefaultNotificationsSettings()
	{
		return array(
			'messages' => 'on',
			'friend-requests' => 'on',
			'follows' => 'on',
		);
	}

	private function usersExtraJoin($userIdColumn = 'u.ID') {
		$extraQuery = '';
		$settings = $this->getModule('base')->getSettings();

		$extraQuery .= " LEFT JOIN {prefix}users_roles AS ur ON (ur.user_id = $userIdColumn)";

		if (@$settings['design']['members']['show-only-with-avatar'] === 'true') {
			$extraQuery .= $this->preparePrefix("
				JOIN {prefix}users_images AS ui
				ON ($userIdColumn = ui.user_id AND ui.type = 'avatar')
			");
		}

		if (@$settings['design']['members']['show-only-with-cover'] === 'true') {
			$extraQuery .= $this->preparePrefix("
				JOIN {prefix}users_images AS ui2
				ON ($userIdColumn = ui2.user_id AND ui2.type = 'cover')
			");
		}

		return $extraQuery;
	}

	private function usersExtraWhere($userIdColumn = 'u.ID') {
		$extraWhere = '';
		$settings = $this->getModule('base')->getSettings();
		if (isset($settings['design']['members']['roles-to-display']) &&
		    !in_array('all', $settings['design']['members']['roles-to-display'])) {
			$rolesToDisplay = $settings['design']['members']['roles-to-display'];
			$roles = implode(',', $rolesToDisplay);

			/**
			 * If default role in roles list add is null check because users can be without role entry in data base.
			 */
			if (isset($settings['profile']['default-role']) &&
			    in_array($settings['profile']['default-role'], $rolesToDisplay)) {
				$extraWhere .= " AND (ur.role_id IN ($roles) OR ur.role_id IS NULL)";
			} else {
				$extraWhere .= " AND ur.role_id IN ($roles)";
			}
		}

		return $extraWhere;
	}
	public function prepareMetaField($meta){
		$aliasPrepare = mb_convert_encoding($meta, 'UTF-8' );
		$alias = strtolower($this->getModule('base')->translateCyrillicToLatin(
			preg_replace('/[^\w0-9]/u', '_', $aliasPrepare)
		));
		return $alias;
	}
	public function getUsers(array $params) {

		$limit = isset($params['limit']) ? $params['limit'] : 10;
		$offset = isset($params['offset']) ? $params['offset'] : 0;
		$andWhere = isset($params['andWhere']) ? $params['andWhere'] : '';
		$showOnlyActive = isset($params['showOnlyActive']) ? $params['showOnlyActive'] : true;
		$withUsersExtraQuery = isset($params['withUsersExtraQuery']) ? $params['withUsersExtraQuery'] : true;
		$count = isset($params['count']) ? true : false;
		$metaKey = isset($params['meta_key']) ? $params['meta_key'] : false;
		$metaValue = isset($params['meta_value']) ? $params['meta_value'] : false;

		$settings = $this->getModule('users')->getSettings();

		$orderBy =  'new-users-first';
		$order = '';
		$extraJoin = '';

		if ($withUsersExtraQuery) {
			$extraJoin .= $this->usersExtraJoin();
			$andWhere .= $this->usersExtraWhere();
		} else {
			$extraJoin .= " LEFT JOIN {prefix}users_roles AS ur ON ur.user_id = u.ID";
		}

		if (isset($params['sort'])) {
			$orderBy = null;
			$sortOrder = isset($params['order']) ? strtoupper($params['order']) : '';

			switch ($params['sort']) {
				case 'id':
					$order = " ORDER BY u.ID {$sortOrder}";
					break;
				case 'user_registered':
					$order = " ORDER BY u.user_registered {$sortOrder}";
					break;
				case 'role':
					$order = " ORDER BY ur.role_id {$sortOrder}";
					break;
				case 'status':
					$order = " ORDER BY us.user_status {$sortOrder}";
					break;
			}
		} else {
			if (isset($settings['design']['members']['sort-users-by'])) {
				$orderBy = $settings['design']['members']['sort-users-by'];
			}
		}

		switch ($orderBy) {
			case 'new-users-first':
				$order = ' ORDER BY u.ID DESC';
				break;
			case 'old-users-first':
				$order = ' ORDER BY u.ID ASC';
				break;
			case 'first-name':
				$extraJoin .= "
					LEFT JOIN {wp_base_prefix}usermeta AS umOrder
					ON (u.ID = umOrder.user_id AND umOrder.meta_key = 'first_name')
				";
				$order = " ORDER BY umOrder.meta_value ASC";
				break;
			case 'last-name':
				$extraJoin .= "
					LEFT JOIN {wp_base_prefix}usermeta AS umOrder
					ON (u.ID = umOrder.user_id AND umOrder.meta_key = 'last_name')
				";
				$order = " ORDER BY umOrder.meta_value ASC";
				break;
			case 'random':
				$seed = implode('', array(
					str_replace(".", "", $_SERVER['REMOTE_ADDR']),
					date("H"),
					date("j"),
					date("n"))
				);
				$order = " ORDER BY RAND($seed)";
				break;
		}

		$accessRoles = $this->getModule('users')->getCurrentUserRolesAccessPermissions();

		if (!empty($accessRoles) && !in_array('all', $accessRoles)) {
            $roles = implode(',', $accessRoles);
            $andWhere .= " AND ur.role_id IN ($roles)";
        }

        if ($showOnlyActive) {
	        $extraJoin .= ' LEFT JOIN {prefix}users_statuses AS us ON us.user_id = u.ID';
	        $andWhere .= ' AND us.user_status = 0';
        }

		if (is_multisite()) {
			$extraJoin .= $this->db->prepare(
				" JOIN {wp_base_prefix}usermeta AS msum ON (msum.user_id = u.ID AND msum.meta_key = %s)",
				$this->getCapabilitiesMetaKey()
			);
		}

		if($metaKey && $metaValue){
			$fields = $this->getModel('fields', 'users')->getFields();
			$typeNeedPrepare = array('drop', 'checkbox', 'radio', 'scroll');
			$metaParams = array();

			if(count($fields)){
				foreach ($fields as $field){
					if($field['label'] === $metaKey){
						$metaParams['name'] = $field['name'];
						$metaParams['type'] = $field['type'];
						if(in_array($metaParams['type'], $typeNeedPrepare)){
							$metaParams['value'] = $this->prepareMetaField($metaValue);
						}else{
							$metaParams['value'] = $metaValue;
						}
					}
				}
			}

			$userIdsResult = array();

			$subQuery = $this->preparePrefix("
				SELECT f.id, f.user_id
				FROM {prefix}fields AS f
	            WHERE f.name = '".$metaParams['name']."'
			");
			$fields = $this->db->get_results($subQuery, ARRAY_A);

			$subQuery = $this->preparePrefix("
					SELECT f.field_id
					FROM {prefix}fields_data AS f
		            WHERE f.data = '".$metaParams['value']."'
				");
			$fieldsData = $this->db->get_col($subQuery);

			foreach ( $fields as $field) {
				if(in_array($field['id'],$fieldsData)){
					$userIdsResult[] = $field['user_id'];
				}
			}

			$userIdsResultStr = implode(",", $userIdsResult);

			$andWhere = 'AND us.ID in ('.$userIdsResultStr.')';
		}

		$query = $this->preparePrefix("
			SELECT DISTINCT u.ID
			FROM {wp_base_prefix}users AS u
			{$extraJoin}
            WHERE 1 = 1 {$andWhere}
		");

		if ($count) {
			return $this->db->get_var("SELECT COUNT(*) FROM ($query) AS c");
		}

		$query .= " $order";
		$query .= $this->db->prepare(' LIMIT  %d, %d',  array($offset, $limit));
		$users = $this->db->get_col($query);

		if ($users) {
			$_users = implode(', ', $users);
			$orderBy = " ORDER BY FIELD (u.ID, $_users)";
			$users = $this->getUsersByIds(array('users' => $users, 'orderBy' => $orderBy));
		}


		$users = $this->getDispatcher()->apply('badges.addBadges', array($users));

		return $users;
	}

    public function getUsersCount(array $params) {
	    $search = isset($params['search']) ? $params['search'] : null;
	    $params['count'] = true;
	    if (!is_null($search)) {
		    //backend search count by first, last name, and by username
		    $countFirst = $this->searchByName($params);
		    $countSecond = $this->searchByName($params, true);
		    $count = $countFirst + $countSecond;
	    } else {
		    $count = $this->getUsers($params);
	    }
        return $count;
    }

    public function searchUsersByName(array $params) {
		//backend search by first, last name, and by username
	    $usersFirst = $this->searchByName($params);
	    $usersSecond = $this->searchByName($params, true);
	    $users = array_unique(array_merge($usersFirst, $usersSecond));

	    if ($users) {
		    $_users = implode(', ', $users);
		    $orderBy = " ORDER BY FIELD (u.ID, $_users)";
		    $users = $this->getUsersByIds(array('users' => $users, 'orderBy' => $orderBy));
	    }

	    return $users;
    }

	public function getQueryForSearchUsersByParams(array $params) {
		$search = !empty($params['search']) ? $params['search'] : null;
		$limit = isset($params['limit']) ? $params['limit'] : 10;
		$offset = isset($params['offset']) ? $params['offset'] : null;
		$offsetId = isset($params['offsetId']) ? $params['offsetId'] : null;
		$userRoleId = !empty($params['userRoleId']) ? (int)$params['userRoleId'] : null;
		$userMetaKey = isset($params['meta_key']) ? $params['meta_key'] : false;
		$userMetaValue = isset($params['meta_value']) ? $params['meta_value'] : false;
		$isReturnCount = !empty($params['count']) ? true : false;

		$searchByUserName = false;
		$searchByFirstName = false;
		$searchByLastName = false;
		// search by field name
		if(!empty($params['searchBy']['username'])) {
			$searchByUserName = true;
		}
		if(!empty($params['searchBy']['lastname'])) {
			$searchByLastName = true;
		}
		if(!empty($params['searchBy']['firstname'])) {
			$searchByFirstName = true;
		}
		if(!$searchByUserName && !$searchByFirstName && !$searchByLastName) {
			return null;
		}

		$andWhere = '';
		$orderBy = null;

		$extraJoin = " LEFT JOIN {prefix}users_roles AS ur ON ur.user_id = search.user_id ";
		if (is_multisite()) {
			$extraJoin .= $this->db->prepare(
				" JOIN {wp_base_prefix}usermeta AS msum ON (msum.user_id = search.user_id AND msum.meta_key = %s)",
				$this->getCapabilitiesMetaKey()
			);
		}
		if($userMetaKey && $userMetaValue){
			$extraJoin .= ' INNER JOIN {wp_base_prefix}usermeta AS umeta ON (u.ID = umeta.user_id AND umeta.meta_key = "'.$userMetaKey.'" AND umeta.meta_value = "'.$userMetaValue.'")';
		}
		// restrict by role
		$accessRoles = $this->getModule('users')->getCurrentUserRolesAccessPermissions();

		if(in_array('all', $accessRoles)) {
			// when all
			if($userRoleId) {
				$andWhere .= " AND ur.role_id = $userRoleId ";
			}
		} else if(!empty($accessRoles)) {
			if(is_array($accessRoles)) {
				if($userRoleId && in_array($userRoleId, $accessRoles)) {
					$andWhere .= " AND ur.role_id = $userRoleId ";
				} else {
					$roles = implode(',', $accessRoles);
					$andWhere .= " AND ur.role_id IN ($roles) ";
				}
			}
		}

		$queryUserIds = array();
		$searchLenght = strlen($search);
		// search by username
		if ($searchByUserName) {
			$whereQ1 = array();
			if($searchLenght) {
				$whereQ1[] = $this->db->prepare(" u.user_login LIKE %s", array($this->db->esc_like($search) . '%'));
			}
			if ($offsetId) {
				$whereQ1[] = $this->db->prepare(" u.ID < '%d' ", $offsetId);
			}

			if(count($whereQ1) == 0) {
				$whereQ1 = '';
			} else if(count($whereQ1) == 1) {
				$whereQ1 = " WHERE " . $whereQ1[0];
			} else if(count($whereQ1) > 1) {
				$whereQ1 = " WHERE " . implode(" AND ", $whereQ1);
			}

			$queryUserIds[] = $this->preparePrefix("(
				SELECT u.ID as user_id
				FROM {wp_base_prefix}users AS u " . $whereQ1 . ')');
		}
		// search by First Name and Last Name
		if($searchLenght && ($searchByFirstName || $searchByLastName)) {
			$whereQ2 = array();
			if ($offsetId) {
				$whereQ2[] = $this->db->prepare(" um.user_id < '%d' ", $offsetId);
			}
			if(strlen($search)) {
				$whereQ2[] = $this->db->prepare(' um.meta_value REGEXP %s', array('^' . implode('|^', explode(' ', $search))));
			}

			if(count($whereQ2) == 0) {
				$whereQ2 = '';
			} else if(count($whereQ2) == 1) {
				$whereQ2 = ' AND ' . $whereQ2[0];
			} else {
				$whereQ2 = ' AND ' . implode(' AND ', $whereQ2);
			}

			if($searchByFirstName) {
				$queryUserIds[] = $this->preparePrefix("(
					SELECT um.user_id
					FROM {wp_base_prefix}usermeta AS um
					WHERE um.meta_key = 'first_name' $whereQ2
				)");
			}
			if($searchByLastName) {
				$queryUserIds[] = $this->preparePrefix("(
					SELECT um.user_id
					FROM {wp_base_prefix}usermeta AS um
					WHERE um.meta_key = 'last_name' $whereQ2
				)");
			}
		}
		$fullFindQuery = implode(' UNION ', $queryUserIds);

		// search by Full name
		if($searchLenght && !$isReturnCount) {
			$havingRegexp = $search;
			if (strpos($search, ' ') !== false) {
				$havingRegexp .= '|' . implode(' ', array_reverse(explode(' ', $search)));
			}
			$andWhere .= $this->db->prepare(" HAVING 1=1 OR fullName REGEXP '%s' ", array($havingRegexp));
		}

		$query = $this->preparePrefix("
				SELECT DISTINCT search.user_id, CONCAT(umfn.meta_value, ' ', umln.meta_value) AS fullName
				FROM ({$fullFindQuery}) AS search
				JOIN {wp_base_prefix}users AS u ON (u.ID = search.user_id)
				LEFT JOIN {prefix}users_statuses AS us ON (us.user_id = search.user_id)
				JOIN {wp_base_prefix}usermeta AS umfn ON (umfn.user_id = search.user_id AND umfn.meta_key = 'first_name')
				JOIN {wp_base_prefix}usermeta AS umln ON (umln.user_id = search.user_id AND umln.meta_key = 'last_name')
				{$extraJoin}
				WHERE 1 = 1 {$andWhere}
			");

		if($isReturnCount) {
			$query = "SELECT COUNT(*) AS count FROM (" . $query . ") AS cres ";
		}
		$query .= $this->db->prepare(' LIMIT %d', $limit);

		if ($offset) {
			$query .= $this->db->prepare(' OFFSET %d', $offset);
			$queryParams[] = $offset;
		}

		return $query;
	}

	public function getUsersIdsByParams($params) {
		$res = null;
		$query = self::getQueryForSearchUsersByParams($params);
		if($query) {
			$res = $this->db->get_col($query);
		}
		return $res;
	}

	public function getUsersCountByParams($params) {
		$params['count'] = 1;
		$res = 0;
		$query = self::getQueryForSearchUsersByParams($params);
		if($query) {
			$dbRes = $this->db->get_col($query);
			if(count($dbRes)) {
				$res = (int)$dbRes[0];
			}
		}
		return $res;
	}

	public function searchByName(array $params, $searchByNameAndUsername = false) {
		$search = $params['search'];
		$limit = isset($params['limit']) ? $params['limit'] : 10;
		$offset = isset($params['offset']) ? $params['offset'] : null;
		$offsetId = isset($params['offsetId']) ? $params['offsetId'] : null;
		$count = isset($params['count']) ? true : false;

		$andWhere = isset($params['andWhere']) ? $params['andWhere'] : '';

		$showOnlyActive = isset($params['showOnlyActive']) ? $params['showOnlyActive'] : true;
		$withUsersExtraQuery = isset($params['withUsersExtraQuery']) ? $params['withUsersExtraQuery'] : true;

		$userMetaKey = isset($params['meta_key']) ? $params['meta_key'] : false;
		$userMetaValue = isset($params['meta_value']) ? $params['meta_value'] : false;

		$settings = $this->getModule('base')->getSettings();

		$searchByUsername = $settings['profile']['display-name'] === 'username';

		if($searchByNameAndUsername){
			if($searchByUsername){
				$searchByUsername = false;
			}else{
				$searchByUsername = true;
			}
		}

		$orderBy = null;

		if (isset($params['sort'])) {
			$sortOrder = isset($params['order']) ? strtoupper($params['order']) : '';
			switch ($params['sort']) {
				case 'id':
					$orderBy = " ORDER BY u.ID {$sortOrder}";
					break;
				case 'user_registered':
					$orderBy = " ORDER BY u.user_registered {$sortOrder}";
					break;
				case 'role':
					$orderBy = " ORDER BY ur.role_id {$sortOrder}";
					break;
				case 'status':
					$orderBy = " ORDER BY us.user_status {$sortOrder}";
					break;
			}
		}

		$extraJoin = '';

		if ($withUsersExtraQuery) {
			$extraJoin .= $this->usersExtraJoin('search.user_id');
			$andWhere .= $this->usersExtraWhere('search.user_id');
		} else {
			$extraJoin .= "LEFT JOIN {prefix}users_roles AS ur ON ur.user_id = search.user_id";
		}

		$accessRoles = $this->getModule('users')->getCurrentUserRolesAccessPermissions();

		if (!empty($accessRoles) && !in_array('all', $accessRoles)) {
			$roles = implode(',', $accessRoles);
			$andWhere .= " AND ur.role_id IN ($roles)";
		}

		if ($showOnlyActive) {
			$andWhere .= " AND us.user_status = 0";
		}

		if (is_multisite()) {
			$extraJoin .= $this->db->prepare(
				" JOIN {wp_base_prefix}usermeta AS msum ON (msum.user_id = search.user_id AND msum.meta_key = %s)",
				$this->getCapabilitiesMetaKey()
			);
		}

		if ($searchByUsername) {

			$andOffsetId = '';

			if ($offsetId) {
				$andOffsetId = $this->db->prepare(" AND u.ID < '%d' ", $offsetId);
			}

			if (!$orderBy) {
				$orderBy = "ORDER BY u.user_login ASC";
			}

			$searchQuery = $this->db->prepare($this->preparePrefix("
				SELECT
					u.ID as user_id
				FROM {wp_base_prefix}users AS u
				WHERE u.user_login LIKE CONCAT('%s', '%%')
				$andOffsetId
			"), array($search));


		} else {
			$searchRegexp = '^' . implode('|^', explode(' ', $search));

			if (!$orderBy) {
				$orderBy = "ORDER BY umfn.meta_key ASC";
			}

			$andOffsetId = '';

			if ($offsetId) {
				$andOffsetId = $this->db->prepare(" AND um.user_id < '%d' ", $offsetId);
			}

			$havingRegexp = $search;

			if (strpos($havingRegexp, ' ') !== false) {
				$havingRegexp .= '|' . implode(' ', array_reverse(explode(' ', $havingRegexp)));
			}

			$andWhere .= $this->db->prepare("
				HAVING fullName REGEXP '%s'
			", array($havingRegexp));

			$searchQuery = $this->db->prepare($this->preparePrefix("
				SELECT
					um.user_id
				FROM {wp_base_prefix}usermeta AS um
				WHERE um.meta_key = 'first_name' AND um.meta_value REGEXP '%s'
				{$andOffsetId}
				UNION 
				SELECT
					um.user_id
				FROM {wp_base_prefix}usermeta AS um
				WHERE um.meta_key = 'last_name' AND um.meta_value REGEXP '%s'
				{$andOffsetId}
			"), array($searchRegexp, $searchRegexp));

		}

		if($userMetaKey && $userMetaValue){
			$extraJoin .= ' INNER JOIN {wp_base_prefix}usermeta AS umeta ON (u.ID = umeta.user_id AND umeta.meta_key = "'.$userMetaKey.'" AND umeta.meta_value = "'.$userMetaValue.'")';
		}
		$query = $this->preparePrefix("
				SELECT
					search.user_id, CONCAT(umfn.meta_value, ' ', umln.meta_value) AS fullName
				FROM ({$searchQuery}) AS search
				JOIN {wp_base_prefix}users AS u ON (u.ID = search.user_id)
				LEFT JOIN {prefix}users_statuses AS us ON (us.user_id = search.user_id)
				JOIN {wp_base_prefix}usermeta AS umfn ON (umfn.user_id = search.user_id AND umfn.meta_key = 'first_name')
                JOIN {wp_base_prefix}usermeta AS umln ON (umln.user_id = search.user_id AND umln.meta_key = 'last_name')
				{$extraJoin}
				WHERE 1 = 1 {$andWhere}
			");

		if ($count) {
			return $this->db->get_var("SELECT COUNT(*) FROM ($query) AS c");
		}

		$query .= $orderBy;
		$query .= $this->db->prepare(' LIMIT %d', $limit);

		if ($offset) {
			$query .= $this->db->prepare(' OFFSET %d', $offset);
			$queryParams[] = $offset;
		}

		return $this->db->get_col($query);
	}

	public function setHashedPasswordToUser($userId, $hash) {

        $query = "
			UPDATE {$this->db->base_prefix}users SET user_pass = '%s' WHERE ID = '%d';
		";

        if ($hash) {
            return $this->db->query(
                $this->db->prepare($query, array($hash, $userId))
            );
        }

        return false;
    }

    public function setUserStatus($userId, $status) {

        $query = $this->preparePrefix("
			SELECT
			*
			FROM {prefix}users_statuses
			WHERE user_id = '%d'
		");

        $statusIsSet = $this->db->get_var($this->db->prepare($query, array($userId)));

        if ($statusIsSet) {
            $query = $this->preparePrefix("
                UPDATE {prefix}users_statuses SET user_status = '%d' WHERE user_id = '%d';
            ");
        } else {
            $query = $this->preparePrefix("
                INSERT INTO {prefix}users_statuses (user_status, user_id) VALUES ('%d', '%d');
            ");
        }

        return $this->db->query(
            $this->db->prepare($query, array($status, $userId))
        );
    }

    public function getUserStatus($userId) {
        $query = $this->preparePrefix("
			SELECT user_status FROM {prefix}users_statuses WHERE user_id = '%d';
		");

        return $this->db->get_var(
            $this->db->prepare($query, array($userId))
        );
    }

    public function updateUserStatus($userId, $status) {
        $query = $this->preparePrefix("
			UPDATE {prefix}users_statuses SET user_status = '%d' WHERE user_id = '%d';
		");

        return $this->db->query(
            $this->db->prepare($query, array($status, $userId))
        );
    }

	/**
	 * Set the isOnline lastSeen properties to passed users.
	 * isOnline will be true if last user activty timestamp not older than 15 minutes
	 * @param array $users
	 *
	 * @return array $users
	 *
	 */
    public function setLastSeenData(array $users) {

		$lastSeenData = $this->getUsersLastSeenData();
	    $lastSeenUsersList = array_keys($lastSeenData);

	    foreach ($users as $key => $user) {
			if (in_array(intval($user['id']), $lastSeenUsersList)) {
				$user['lastSeen'] = $lastSeenData[$user['id']];
				$user['isOnline'] = $user['lastSeen'] > (time() - (15 * MINUTE_IN_SECONDS));
			} else {
				$user['lastSeen'] = false;
				$user['isOnline'] = false;
			}

		    $users[$key] = $user;
		}

		return $users;
    }

	/**
	 * Fetches last seen users data
	 * @return array Associative array where key is user id and value last seen timestamp.
	 */
    private function getUsersLastSeenData() {

		$metaKey = $this->getModule('Base')->getConfig('hooks_prefix') . 'last_activity';
	    $query = $this->preparePrefix("
			SELECT user_id, meta_value FROM {wp_prefix}usermeta
			WHERE meta_key = '{$metaKey}'
		");

	    $users = array();

	    $results = $this->db->get_results($query, ARRAY_A);

	    foreach ($results as $result) {
	    	$users[$result['user_id']] = $result['meta_value'];
	    }

	    return $users;
    }

	public function userStatusesList() {
		return array(
			Membership_Users_Model_Fields::STATUS_ACTIVE => $this->translate('Active'),
			Membership_Users_Model_Fields::STATUS_PENDING_REVIEW => $this->translate('Pending review'),
			Membership_Users_Model_Fields::STATUS_DELETED => $this->translate('Deleted'),
			Membership_Users_Model_Fields::STATUS_REJECTED => $this->translate('Rejected'),
			Membership_Users_Model_Fields::STATUS_DISABLED => $this->translate('Disabled'),
			Membership_Users_Model_Fields::STATUS_EMAIL_NOT_CONFIRMED => $this->translate('Email not confirmed'),
		);
	}
}