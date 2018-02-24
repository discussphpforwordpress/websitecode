<?php

class Membership_Activity_Model_Activity extends Membership_Base_Model_Base {

	const ACTIVITY_TYPE_POST = 'posts';
	const ACTIVITY_TYPE_PHOTOS = 'photos';
	const ACTIVITY_TYPE_SHARES = 'shares';
	const ACTIVITY_TYPE_LIKES = 'likes';
	const ACTIVITY_TYPE_FAVORITES = 'favorite';
	const ACTIVITY_TYPE_COMMENTS = 'comments';
	const ACTIVITY_TYPE_GROUPS = 'groups';
	const ACTIVITY_TYPE_SOCIAL = 'social';
	const ACTIVITY_TYPE_FORUM = 'forum';

	public function createActivity($userId, $type, $data, $targetId = null, $objectId = null, $foreignId = null) {
		$fields = array('user_id', 'type', 'data', 'created_at', 'updated_at');
		$values = array('%d', '%s', '%s', '%s', '%s');
        $currentDateTime = $this->getCurrentDateInUTC();
		$queryParams = array($userId, $type, $data, $currentDateTime, $currentDateTime);

		if ($targetId) {
			$queryParams[] = $targetId;
			$fields[] = 'target_id';
			$values[] = '%d';
		}

		if ($objectId) {
			$queryParams[] = $objectId;
			$fields[] = 'object_id';
			$values[] = '%d';
		}

		if ($foreignId) {
			$queryParams[] = $foreignId;
			$fields[] = 'foreign_id';
			$values[] = '%d';
		}

		$query = $this->getQueryBuilder()
			->insertInto($this->getTable('activity'))
			->fields($fields)
			->values($values)
			->build();

		$this->db->query(
			$this->db->prepare($query, $queryParams)
		);


		if ($this->db->insert_id) {
			$this->environment->getDispatcher()->dispatch('createActivity', array(array(
				'id' => $this->db->insert_id,
				'userId' => $userId,
				'type' => $type,
				'data' => $data,
				'targetId' => $targetId,
				'objectId' => $objectId,
				'foreignId' => $foreignId
			)));
		}


		return $this->db->insert_id;
	}

	public function getUserProfileActivity($requestedUserId, $currentUserId, $limit, $offsetId = null) {

		$query = $this->buildActivitySelectQuery(
			array(
				'where' => $this->getUserProfileActivityQueries($requestedUserId, $currentUserId),
				'type' => 'profile-activity',
				'limit' => $limit,
				'requestedUserId' => $requestedUserId,
				'offsetId' => $offsetId
			)
		);

		$activities = $this->db->get_results($query, ARRAY_A);
		return $this->prepareActivityRelatedData($activities, $currentUserId);
	}

	public function getGroupActivity($groupId, $currentUserId, $limit, $lastActivityId = null) {
		$query = $this->buildActivitySelectQuery(
			array(
				'where' => $this->getGroupActivityQueries($groupId),
				'type' => 'group-activity',
				'limit' => $limit,
				'offsetId' => $lastActivityId
			)
		);

		$activities = $this->db->get_results($query, ARRAY_A);

		return $this->prepareActivityRelatedData($activities, $currentUserId);
	}

	public function getActivityById($activityId, $currentUserId, $extra = array()) {
		if (!is_array($activityId)) {
			$activityId = array($activityId);
		}

		$queryParams = $activityId;
		$activityIds = implode(', ', array_pad(array(), count($activityId), "'%d'"));
		$queryWhere = '';

		if (isset($extra['status'])) {
			$queryWhere    = " AND a.status = '%s'";
			$queryParams[] = $extra['status'];
		}

		$query = $this->preparePrefix("
			SELECT 
				a.*
			FROM
				{prefix}activity as a
			WHERE id IN ({$activityIds}) $queryWhere
		");

		$activities = $this->db->get_results(
			$this->db->prepare($query, $queryParams),
			ARRAY_A
		);

		if ($activities) {
			$activities = $this->prepareActivityRelatedData($activities, $currentUserId);
		}

		return $activities;
	}

	public function unlikeActivity($activityId, $currentUserId)
	{
		$queryParams = array($currentUserId, $activityId);
		$query = $this->preparePrefix("
			DELETE
			FROM
				{prefix}activity
			WHERE user_id = '%d' AND foreign_id = '%d' AND type = 'like'
		");

		return $this->db->query($this->db->prepare($query, $queryParams));
	}

    public function getLikeActivityByActivityId($activityId, $currentUserId) {
        $queryParams = array($currentUserId, $activityId);
        $query = $this->preparePrefix("
				SELECT 
					*
				FROM
					{prefix}activity
				WHERE user_id = '%d'
				 AND foreign_id = '%d'
				 AND type = 'like'
				 AND status = 'active'
				LIMIT 1
			");

        $activity = $this->db->get_results(
            $this->db->prepare($query, $queryParams),
            'ARRAY_A'
        );

        if ($activity) {
            $activity = $this->prepareActivityRelatedData($activity, $currentUserId);
        }

        return $activity;
    }

	public function buildActivitySelectQuery(array $queryParams) { // $whereArray, $requestedUserId, $type, $limit, $offsetId = null) {

		$currentUserId = get_current_user_id();
		$queryParams['currentUserId'] = $currentUserId;
		$queryParams = $this->getDispatcher()->apply('activity.buildActivitySelectQuery', array($queryParams));

		$andWhere = isset($queryParams['andWhere']) ? $queryParams['andWhere'] : '';
		$join = isset($queryParams['join']) ? $queryParams['join'] : '';
		$select = isset($queryParams['select']) ? $queryParams['select'] : '';

		if (isset($queryParams['offsetId']) && !empty($queryParams['offsetId'])) {
			$andWhere .= $this->db->prepare(" AND a.id < '%d'", array($queryParams['offsetId']));
		}

		$queries = array();

		if (empty($queryParams['where'])) {
			return array();
		}

		$activeUserStatus = Membership_Users_Model_Fields::STATUS_ACTIVE;

		foreach ($queryParams['where'] as $where) {

			if (empty($where)) {
				continue;
			}

			$whereJoin = '';

			if (is_array($where)) {
				$whereJoin .= isset($where['join']) ? $where['join'] : '';
				$where = $where['where'];
			}

			$queries[] = "
				SELECT 
					a.*
					{$select}
				FROM
					{prefix}activity AS a
				JOIN {wp_base_prefix}users AS u ON (a.user_id = u.ID)
				JOIN {prefix}users_statuses AS us ON (a.user_id = us.user_id AND us.user_status = '{$activeUserStatus}')
				LEFT JOIN {prefix}activity AS fa ON (a.foreign_id = fa.id)
				LEFT JOIN {prefix}followers AS fs ON (a.user_id = fs.following_id AND fs.user_id = '{$currentUserId}')
				{$join}
				{$whereJoin}
				WHERE {$where} {$andWhere}
				AND a.status = 'active' 
				AND COALESCE(fa.status, 'active') != 'blocked'
			";
		}


		$query = $this->preparePrefix(implode(' UNION ', $queries));

		$query .= isset($queryParams['groupBy']) ? $queryParams['groupBy'] : '';
		$query .= isset($queryParams['orderBy']) ? $queryParams['orderBy'] : ' ORDER BY id DESC';
		$query .= isset($queryParams['limit']) ? $this->db->prepare(' LIMIT %d', $queryParams['limit']) : ' LIMIT 5';
		$query .= isset($queryParams['offset']) ? $this->db->prepare(' OFFSET %d', $queryParams['offset']) : '';
		return $query;
	}

	public function getActivity(array $params) {

		$currentUserId = isset($params['userId']) ? $params['userId'] : null;
		$limit = isset($params['limit']) ? $params['limit'] : 5;
		$offsetId = isset($params['offsetId']) ? $params['offsetId'] : null;

		if (isset($params['activityTypes'])) {
			$activityTypes = $params['activityTypes'];
		} else {
			$activityTypes = $this->getAllActivityTypes();
			$activityTypes = array_keys($activityTypes);
		}

		if ($currentUserId) {
			$query = $this->buildActivitySelectQuery(
				array(
					'where' => $this->getUserActivityQueries($currentUserId, $activityTypes),
					'requestedUserId' => $currentUserId,
					'type' => 'activity',
					'limit' => $limit,
					'offsetId' => $offsetId,
					'activityTypes' => $activityTypes
				)
			);

		} else {
			$query = $this->buildActivitySelectQuery(
				array(
					'where' => $this->getGuestActivityQueries($activityTypes),
					'type' => 'activity-guest',
					'limit' => $limit,
					'offsetId' => $offsetId,
					'activityTypes' => $activityTypes
				)
			);
		}

		if (!$query) {
			return array();
		}

		$activities = $this->db->get_results($query, ARRAY_A);

		if ($activities) {
			$activities = $this->prepareActivityRelatedData($activities, $currentUserId);
		}

		return array_values($activities);
	}

	private function getUserActivityQueries($userId, $activityTypes) {

		$queries = array();
		$activeUserStatus = Membership_Users_Model_Fields::STATUS_ACTIVE;

		$foreignActivityUserExistsJoin = "
			JOIN {wp_base_prefix}users AS fa_u ON (fa.user_id = fa_u.ID)
			JOIN {prefix}users_statuses AS fa_us ON (fa.user_id = fa_us.user_id AND fa_us.user_status = '{$activeUserStatus}')
		";

		/**
		 * Posts
		 */
		if (in_array(self::ACTIVITY_TYPE_POST, $activityTypes)) {
			// Current user activity
			$queries[] = $this->db->prepare("a.type IN ('post', 'related_post') AND a.user_id = '%d'", $userId);
			$queries[] = $this->db->prepare("a.type = 'related_post' AND a.target_id = '%d'", $userId);

			// Followed users activities
			$queries[] = "a.type = 'post' AND fs.id IS NOT NULL";

		} else {
			/**
			 * Photos
			 */
			if (in_array(self::ACTIVITY_TYPE_PHOTOS, $activityTypes)) {

				$join = "LEFT JOIN (
					SELECT activity_id, COUNT(id) AS count
					FROM {prefix}activity_images
					GROUP BY activity_id
				) AS ai ON (a.id = ai.activity_id)";

				// Current user images
				$queries[] = array(
					'join' => $join,
					'where' => $this->db->prepare("a.type IN ('post', 'related_post') AND a.user_id = '%d' AND ai.count IS NOT NULL", $userId)
				);

				// Followed user images
				$queries[] = array(
					'join' => $join,
					'where' => "a.type = 'post' AND fs.id IS NOT NULL AND ai.count IS NOT NULL"
				);
			}
		}

		/**
		 * Shares
		 */
		if (in_array(self::ACTIVITY_TYPE_SHARES, $activityTypes)) {
			/** User shares */
			// Followed users shared activities
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => "a.type IN ('shared_post', 'shared_related_post') AND fs.id IS NOT NULL"
			);

			// Current user shared activities
			$queries[] = $this->db->prepare("a.type IN ('shared_post', 'shared_related_post') AND a.user_id = '%d'", $userId);

			// Current user shared group activities
			$queries[] = $this->db->prepare("a.type IN ('shared_group_post', 'shared_group_user_post') AND a.user_id = '%d' ", $userId);

			// Followed users shared group activities
			$where = $this->db->prepare("a.type IN ('shared_group_post', 'shared_group_user_post')
				AND fs.id IS NOT NULL
				AND fa.object_id
				IN (
					SELECT id FROM (
						SELECT g.*, gu.approved as isApproved, gs.value AS groupReadActivity FROM {prefix}groups AS g
						LEFT JOIN {prefix}groups_settings AS gs ON (g.id = gs.group_id AND gs.setting = 'read-activity')
						LEFT JOIN {prefix}groups_users AS gu ON (g.id = gu.group_id AND gu.user_id = '%d')
					) AS g WHERE g.groupReadActivity = 'all' OR g.isApproved = 1
				)", array($userId));

			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);
		}

		/**
		 * Likes
		 */
		if (in_array(self::ACTIVITY_TYPE_LIKES, $activityTypes)) {

			// Likes of following users exclude group activities
			$where = "a.type = 'like' AND fs.id IS NOT NULL
				AND fa.type NOT IN ('group_post', 'group_user_post', 'shared_group_post', 'shared_group_user_post')
			";
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);

			// Likes of following users on group activities where user can read activity
			$where = $this->db->prepare("a.type = 'like'
				AND fs.id IS NOT NULL
				AND fa.type IN ('group_post', 'group_user_post') AND fa.object_id IN (
					SELECT id FROM (
						SELECT g.*, gu.approved as isApproved, gs.value AS groupReadActivity FROM {prefix}groups AS g
						LEFT JOIN {prefix}groups_settings AS gs ON (g.id = gs.group_id AND gs.setting = 'read-activity')
						LEFT JOIN {prefix}groups_users AS gu ON (g.id = gu.group_id AND gu.user_id = '%d')
					) AS g WHERE g.groupReadActivity = 'all' OR g.isApproved = 1
				)
			", $userId);
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);

			// Likes of following users on group shared activities where user can read activity
			$where = $this->db->prepare("a.type = 'like'
				AND fs.id IS NOT NULL
				AND (
					SELECT a2.object_id
					FROM {prefix}activity AS a1
					JOIN {prefix}activity AS a2 ON (a1.foreign_id = a2.id)
					WHERE a1.id = a.foreign_id
					AND a1.type IN ('shared_group_post', 'shared_group_user_post')
				) IN (
					SELECT id FROM (
						SELECT g.*, gu.approved as isApproved, gs.value AS groupReadActivity FROM {prefix}groups AS g
						LEFT JOIN {prefix}groups_settings AS gs ON (g.id = gs.group_id AND gs.setting = 'read-activity')
						LEFT JOIN {prefix}groups_users AS gu ON (g.id = gu.group_id AND gu.user_id = '%d')
					) AS g WHERE g.groupReadActivity = 'all' OR g.isApproved = 1
				)
			", $userId);
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);
		}

		/**
		 * Favorites
		 */
		if (in_array(self::ACTIVITY_TYPE_FAVORITES, $activityTypes)) {
			$currUser = (int) $userId;
			// Favorites of following users exclude group activities
			$where = "a.type = 'favorite' AND a.user_id = " . $currUser . "
				
			";
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);
		}

		/**
		 * Comments
		 */
		if (in_array(self::ACTIVITY_TYPE_COMMENTS, $activityTypes)) {

			// Comments of following users exclude group activities
			$queries[] = "a.type = 'activity_comment' AND fs.id IS NOT NULL
					AND (SELECT type FROM {prefix}activity WHERE id = a.object_id)
					NOT IN ('group_post', 'group_user_post', 'shared_group_post', 'shared_group_user_post')
				";


			// Comments of following users on group activities where user can read activity
			$where = $this->db->prepare("a.type = 'activity_comment'
					AND fs.id IS NOT NULL
					AND fa.type IN ('group_post', 'group_user_post') AND fa.object_id IN (
						SELECT id FROM (
							SELECT g.*, gu.approved as isApproved, gs.value AS groupReadActivity FROM {prefix}groups AS g
							LEFT JOIN {prefix}groups_settings AS gs ON (g.id = gs.group_id AND gs.setting = 'read-activity')
							LEFT JOIN {prefix}groups_users AS gu ON (g.id = gu.group_id AND gu.user_id = '%d')
						) AS g WHERE g.groupReadActivity = 'all' OR g.isApproved = 1
					)
				", $userId);
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);

			// Comments of following users on group shared activities where user can read activity
			$queries[] = $this->db->prepare("a.type = 'activity_comment'
					AND fs.id IS NOT NULL
					AND (
						SELECT a2.object_id
						FROM {prefix}activity AS a1
						JOIN {prefix}activity AS a2 ON (a1.foreign_id = a2.id)
						WHERE a1.id = a.object_id
						AND a1.type IN ('shared_group_post', 'shared_group_user_post')
					) IN (
						SELECT id FROM (
							SELECT g.*, gu.approved as isApproved, gs.value AS groupReadActivity FROM {prefix}groups AS g
							LEFT JOIN {prefix}groups_settings AS gs ON (g.id = gs.group_id AND gs.setting = 'read-activity')
							LEFT JOIN {prefix}groups_users AS gu ON (g.id = gu.group_id AND gu.user_id = '%d')
						) AS g WHERE g.groupReadActivity = 'all' OR g.isApproved = 1
					)
				", $userId);
		}

		/**
		 * Groups
		 */
		if (in_array(self::ACTIVITY_TYPE_GROUPS, $activityTypes)) {
			$queries[] = array(
				'join' => ' JOIN {prefix}groups AS g ON (a.object_id = g.id)',
				'where' =>	"a.type = 'group_created' AND fs.id IS NOT NULL"
			);

			// Followed groups activities, show only when user followed group and approved in group or group privacy read activity set to all
			$queries[] = $this->db->prepare("a.type IN ('group_post', 'group_user_post') AND a.object_id
					IN (
						SELECT f.group_id FROM {prefix}groups_followers as f
						WHERE f.user_id = '%d'
					) AND EXISTS (
						SELECT 1 FROM {prefix}groups AS g
						LEFT JOIN {prefix}groups_settings AS gs ON (g.id = gs.group_id AND gs.setting = 'read-activity')
						LEFT JOIN {prefix}groups_users AS gu ON (g.id = gu.group_id AND gu.user_id = '%d')
						WHERE g.id = a.object_id AND (gs.value = 'all' OR gu.approved = 1)
					)", array($userId, $userId));

		}

		/**
		 * Social
		 */
		if (in_array(self::ACTIVITY_TYPE_SOCIAL, $activityTypes)) {
			$queries[] = "a.type IN ('friendship', 'user_registered') AND fs.id IS NOT NULL";
		}

		return $queries;
	}

	private function getUserProfileActivityQueries($userId, $currentUserId) {

		$queries = array();
		$activeUserStatus = Membership_Users_Model_Fields::STATUS_ACTIVE;

		$foreignActivityUserExistsJoin = "
			JOIN {wp_base_prefix}users AS fa_u ON (fa.user_id = fa_u.ID)
			JOIN {prefix}users_statuses AS fa_us ON (fa.user_id = fa_us.user_id AND fa_us.user_status = '{$activeUserStatus}')
		";

		$queries[] = $this->db->prepare("a.type = 'post' AND a.user_id = '%d'", $userId);
		$queries[] = $this->db->prepare("a.type IN ('shared_post', 'shared_related_post', 'friend_post') AND a.user_id = '%d'", $userId);
		$queries[] = $this->db->prepare("a.type = 'related_post' AND a.target_id = '%d'", $userId);

		$where = $this->db->prepare("a.type IN ('shared_group_post', 'shared_group_user_post') AND a.user_id = '%d' 
				AND fa.object_id IN (
					SELECT id FROM (
						SELECT g.*, gu.approved as isApproved, gs.value AS groupReadActivity FROM {prefix}groups AS g
						LEFT JOIN {prefix}groups_settings AS gs ON (g.id = gs.group_id AND gs.setting = 'read-activity')
						LEFT JOIN {prefix}groups_users AS gu ON (g.id = gu.group_id AND gu.user_id = '%d')
					) AS g WHERE g.groupReadActivity = 'all' OR g.isApproved = 1
				)
			", array($userId, $currentUserId));

		$queries[] = array(
			'join' => $foreignActivityUserExistsJoin,
			'where' => $where
		);

		return $queries;
	}

	private function getGuestActivityQueries($activityTypes) {

		$queries = array();

		$activeUserStatus = Membership_Users_Model_Fields::STATUS_ACTIVE;

		$foreignActivityUserExistsJoin = "
			JOIN {wp_base_prefix}users AS fa_u ON (fa.user_id = fa_u.ID)
			JOIN {prefix}users_statuses AS fa_us ON (fa.user_id = fa_us.user_id AND fa_us.user_status = '{$activeUserStatus}')
		";

		// Post activities
		if (in_array(self::ACTIVITY_TYPE_POST, $activityTypes)) {
			// Current user activity
			$queries[] = "a.type IN ('post', 'related_post')";


		} else {

			$join = "LEFT JOIN (
					SELECT activity_id, COUNT(id) AS count
					FROM {prefix}activity_images
					GROUP BY activity_id
				) AS ai ON (a.id = ai.activity_id)";

			if (in_array(self::ACTIVITY_TYPE_PHOTOS, $activityTypes)) {
				$queries[] = array(
					'join' => $join,
					'where' => "a.type IN ('post', 'related_post')AND ai.count IS NOT NULL"
				);
			}
		}

		if (in_array(self::ACTIVITY_TYPE_SHARES, $activityTypes)) {
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => "a.type IN ('shared_post', 'shared_related_post')"
			);

			// Show only groups activities with allowed reading in privacy settings
			$queries[] = "a.type IN ('shared_group_post', 'shared_group_user_post') AND (
				SELECT value FROM {prefix}groups_settings WHERE group_id = (
					SELECT a2.object_id FROM {prefix}activity AS a2 WHERE a2.id = a.foreign_id LIMIT 1
			) AND setting = 'read-activity') = 'all' ";
		}

		if (in_array(self::ACTIVITY_TYPE_LIKES, $activityTypes)) {
			// Likes of users exclude group activities
			$where =  "a.type = 'like' AND fa.type NOT IN 
				('group_post', 'group_user_post', 'shared_group_post', 'shared_group_user_post')";
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);

			// Likes of users on group activities where user can read activity
			$where = "a.type = 'like'
				AND EXISTS (
					SELECT a1.id
					FROM {prefix}activity as a1
					JOIN {prefix}groups_settings AS gs ON (a1.object_id = gs.group_id AND gs.setting = 'read-activity') 
					WHERE a1.id = a.foreign_id AND gs.value = 'all'
					AND type IN ('group_post', 'group_user_post')
				)
			";
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);

			// Likes of  users on group shared activities where user can read activity
			$where = "a.type = 'like'
				AND EXISTS (
					SELECT a1.*
					FROM {prefix}activity as a1
					WHERE a1.id = a.foreign_id
					AND type IN ('shared_group_post', 'shared_group_user_post')
				    AND EXISTS (
						SELECT a2.id
						FROM {prefix}activity as a2
				        JOIN {prefix}groups_settings AS gs ON (a2.object_id = gs.group_id AND gs.setting = 'read-activity') 
						WHERE a2.id = a1.foreign_id AND gs.value = 'all'
				    )
				)
			";
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);
		}

		if (in_array(self::ACTIVITY_TYPE_FAVORITES, $activityTypes)) {
			// Favorites of users exclude group activities
			$where =  "a.type = 'favorite' AND fa.type NOT IN 
				('group_post', 'group_user_post', 'shared_group_post', 'shared_group_user_post')";
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);

			// Favorites of users on group activities where user can read activity
			$where = "a.type = 'favorite'
				AND EXISTS (
					SELECT a1.id
					FROM {prefix}activity as a1
					JOIN {prefix}groups_settings AS gs ON (a1.object_id = gs.group_id AND gs.setting = 'read-activity') 
					WHERE a1.id = a.foreign_id AND gs.value = 'all'
					AND type IN ('group_post', 'group_user_post')
				)
			";
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);

			// Favorites of  users on group shared activities where user can read activity
			$where = "a.type = 'favorite'
				AND EXISTS (
					SELECT a1.*
					FROM {prefix}activity as a1
					WHERE a1.id = a.foreign_id
					AND type IN ('shared_group_post', 'shared_group_user_post')
					AND EXISTS (
						SELECT a2.id
						FROM {prefix}activity as a2
						JOIN {prefix}groups_settings AS gs ON (a2.object_id = gs.group_id AND gs.setting = 'read-activity') 
						WHERE a2.id = a1.foreign_id AND gs.value = 'all'
					)
				)
			";
			$queries[] = array(
				'join' => $foreignActivityUserExistsJoin,
				'where' => $where
			);
		}

		if (in_array(self::ACTIVITY_TYPE_COMMENTS, $activityTypes)) {
			// Comments of users exclude group activities
			$queries[] = "a.type = 'activity_comment'
				AND (SELECT type FROM {prefix}activity WHERE id = a.object_id)
				NOT IN ('group_post', 'group_user_post', 'shared_group_post', 'shared_group_user_post')
			";

			// Comments users on group activities where user can read activity
			$queries[] = "a.type = 'activity_comment'
				AND EXISTS (
					SELECT a1.id
					FROM {prefix}activity as a1
					JOIN {prefix}groups_settings AS gs ON (a1.object_id = gs.group_id AND gs.setting = 'read-activity') 
					WHERE a1.id = a.object_id AND gs.value = 'all'
					AND a1.type IN ('group_post', 'group_user_post')
				)
			";

			// Comments of following users on group shared activities where user can read activity
			$queries[] = "a.type = 'activity_comment'
				AND EXISTS (
					SELECT a1.*
					FROM {prefix}activity as a1
					WHERE a1.id = a.object_id
					AND a1.type IN ('shared_group_post', 'shared_group_user_post')
				    AND EXISTS (
						SELECT a2.id
						FROM {prefix}activity as a2
				        JOIN {prefix}groups_settings AS gs ON (a2.object_id = gs.group_id AND gs.setting = 'read-activity') 
						WHERE a2.id = a1.foreign_id AND gs.value = 'all'
				    )
				)
			";
		}

		if (in_array(self::ACTIVITY_TYPE_GROUPS, $activityTypes)) {
			$queries[] = array(
				'join' => ' JOIN {prefix}groups AS g ON (a.object_id = g.id)',
				'where' =>	"a.type = 'group_created'"
			);

			// Show only groups activities with allowed reading in privacy settings
			$queries[] = array(
				'join' => ' JOIN {prefix}groups AS g ON (a.object_id = g.id)',
				'where' =>	"a.type IN ('group_post', 'group_user_post') AND (
						SELECT value FROM {prefix}groups_settings WHERE group_id = a.object_id AND setting = 'read-activity'
					) = 'all'"
			);
		}

		if (in_array(self::ACTIVITY_TYPE_SOCIAL, $activityTypes)) {
			$queries[] = "a.type IN ('friendship', 'user_registered')";
		}

		return $queries;
	}

	private function getGroupActivityQueries($groupId) {
		return array(
			$this->db->prepare("a.object_id = '%d' AND a.type = 'group_post' AND a.status = 'active'", $groupId),
			$this->db->prepare("a.object_id = '%d' AND a.type = 'group_user_post' AND a.status = 'active'", $groupId),
		);
	}

	private function prepareActivityRelatedData($activities, $currentUserId) {
		if (!$activities) {
			return array();
		}

		$_activities = array();
		$friendPostActivities = array();
		$relatedData = array(
			'users' => array(),
			'groups' => array(),
			'related_activities' => array(),
			'posts' => array(),
		);

		$fetchedData = array(
			'users' => array(),
			'groups' => array(),
			'related_activities' => array(),
			'posts' => array(),
		);

		$usersModule = $this->environment->getModule('users');
		$usersModel = $usersModule->getModel('profile');

		foreach ($activities as $key => $activity) {
			$_activities[] = $activity['id'];

			switch ($activity['type']) {
				case 'post':
                case 'user_registered':
				$relatedData['users'][] = $activity['user_id'];
					break;
				case 'related_post':
					$relatedData['users'][] = $activity['user_id'];
					$relatedData['users'][] = $activity['target_id'];
					break;
                case 'following':
                    $relatedData['users'][] = $activity['user_id'];
                    $relatedData['users'][] = $activity['target_id'];
                    break;
				case 'group_post':
				case 'group_user_post':
                case 'group_created':
					$relatedData['users'][] = $activity['user_id'];
					$relatedData['groups'][] = $activity['object_id'];
					break;
				case 'activity_comment':
					$relatedData['users'][] = $activity['user_id'];
					$relatedData['related_activities'][] = $activity['object_id'];
					break;
				case 'like':
					$relatedData['users'][] = $activity['user_id'];
					$relatedData['related_activities'][] = $activity['foreign_id'];
					break;
				case 'favorite':
					$relatedData['users'][] = $activity['user_id'];
					$relatedData['related_activities'][] = $activity['foreign_id'];
				default:
					$relatedData['users'][] = $activity['user_id'];
					break;
			}

			if (strpos($activity['type'], 'shared_') !== false) {
				$relatedData['users'][] = $activity['user_id'];
				$relatedData['related_activities'][] = $activity['foreign_id'];
			}

			if (strpos($activity['type'], 'friend_') !== false) {
				$friendPostActivities[$activity['id']] = $activity['foreign_id'];
				$relatedData['users'][] = $activity['user_id'];
				$relatedData['related_activities'][] = $activity['foreign_id'];
			}
		}

		$activities = $this->getDispatcher()->apply('activity.relatedDataPrepare', array($activities, &$relatedData));

		$users = $usersModel->getUsersByIds(array('users' => array_unique($relatedData['users'])));

		foreach ($users as &$user) {
			$fetchedData['users'][$user['id']] = $user;
		}

		if ($relatedData['groups']) {
			$groupsModel = $this->getModel('groups', 'groups');
			$groups = $groupsModel->getGroup(array_unique($relatedData['groups']), $currentUserId);

			foreach ($groups as &$group) {
				$fetchedData['groups'][$group['id']] = $group;
			}
		}

		if ($relatedData['posts']) {

			$posts = get_posts(array(
				'include' => $relatedData['posts'],
				'post_type' => get_post_types('', 'names')
			));

			foreach ($posts as $post) {
				$fetchedData['posts'][$post->ID] = $post;
			}
		}

		if ($relatedData['related_activities']) {
			$relatedActivities = $this->getActivityById($relatedData['related_activities'], $currentUserId);

			foreach ($relatedActivities as $relatedActivity) {
				$fetchedData['related_activities'][$relatedActivity['id']] = $relatedActivity;
			}
		}

		$activitiesLikes = $this->getActivitiesLikes($_activities, $currentUserId);
		$activitiesShares = $this->getActivitiesShares($_activities, $currentUserId);
		$activitiesFavorites = $this->getActivitiesFavorites($_activities, $currentUserId);
		$activitiesComments = $this->getActivitiesComments($_activities, $currentUserId);

		$activitiesImages = $this->getActivitiesImages($_activities);
		$activityAttachmentFile = $this->getAttachmentFiles($_activities);

		$activitiesLinks = $this->getActivitiesLinks($_activities);

		foreach ($activities as $key => &$activity) {

			// Mute php notice in case when we have post from not existing (deleted) user
			switch ($activity['type']) {
				case 'post':
				case 'user_registered':

					$activity['author'] = @$fetchedData['users'][$activity['user_id']];
					break;
				case 'related_post':
					$activity['author'] = @$fetchedData['users'][$activity['user_id']];
					$activity['target'] = @$fetchedData['users'][$activity['target_id']];
					break;
				case 'group_post':
				case 'group_user_post':
                case 'group_created':
					$activity['author'] = @$fetchedData['users'][$activity['user_id']];
					$activity['group'] = @$fetchedData['groups'][$activity['object_id']];
					break;
				case 'activity_comment':
					$activity['author'] = @$fetchedData['users'][$activity['user_id']];
					$activity['relatedActivity'] = $fetchedData['related_activities'][$activity['object_id']];
					break;
				case 'like':
					$activity['author'] = @$fetchedData['users'][$activity['user_id']];
					$activity['relatedActivity'] = $fetchedData['related_activities'][$activity['foreign_id']];
					break;
				case 'favorite':
					if(!empty($fetchedData['users'][$activity['user_id']])) {
						$activity['author'] = $fetchedData['users'][$activity['user_id']];
					}
					$activity['relatedActivity'] = $fetchedData['related_activities'][$activity['foreign_id']];
					break;
				default:
					$activity['author'] = @$fetchedData['users'][$activity['user_id']];
					break;
			}

			if (strpos($activity['type'], 'shared_') !== false) {
				$activity['author'] = $fetchedData['users'][$activity['user_id']];
				$activity['sharedActivity'] = $fetchedData['related_activities'][$activity['foreign_id']];
			}

			if(!empty($friendPostActivities[$activity['id']]) && !empty($fetchedData['related_activities'][$friendPostActivities[$activity['id']]])) {
				$activity['friendPost'] = $fetchedData['related_activities'][$friendPostActivities[$activity['id']]];
			}

			if (isset($activitiesLikes[$activity['id']])) {
                $activity['likes'] = $activitiesLikes[$activity['id']];
			}
			if(isset($activitiesFavorites[$activity['id']])) {
				$activity['favorite'] = $activitiesFavorites[$activity['id']];
			}

			if (isset($activitiesShares[$activity['id']])) {
                $activity['shares'] = $activitiesShares[$activity['id']];
			}

			if (isset($activitiesComments[$activity['id']])) {
                $activity['comments'] = $activitiesComments[$activity['id']];
			}

			if (isset($activitiesImages[$activity['id']])) {
                $activity['images'] = $activitiesImages[$activity['id']];
			}

			if(isset($activityAttachmentFile[$activity['id']])) {
				$activity['attachmentFiles'] = $activityAttachmentFile[$activity['id']];
			}

			if (isset($activitiesLinks[$activity['id']])) {
                $activity['link'] = $activitiesLinks[$activity['id']];
			}
		}

		return $this->getDispatcher()->apply('activity.relatedData', array($activities, $fetchedData));
	}

	public function removeActivity($activityId) {
		$aImages = $this->getActivityImages($activityId);

		$imagesIds = array();
		$activityImagesIds = array();
		if(count($aImages)) {
			foreach($aImages as $oneElem) {
				$imagesIds[] = $oneElem['image_id'];
				$activityImagesIds[] = $oneElem['id'];
			}
		}

		// remove images and thumbnails
		$imagesModel = $this->getModel('Images', 'base');
		$imagesModel->removeImagesByImagesIds($imagesIds, true);

		// remove activity images
		$this->removeActivityImages($activityImagesIds);
		return $this->updateActivityStatus($activityId, 'deleted');
	}

	public function getActivityImages($activityId) {
		$query = $this->db->prepare($this->preparePrefix("
				SELECT ai.id, ai.image_id
				FROM {prefix}activity_images AS ai
				WHERE activity_id = '%d'
			"), array($activityId));

		$aiArray = $this->db->get_results($query, ARRAY_A);
		return $aiArray;
	}

	public function removeActivityImages($aiIds) {
		if(count($aiIds)) {
			$placeHolders = implode(', ', array_pad(array(), count($aiIds), "'%d'"));
			$removeQuery = $this->db->prepare($this->preparePrefix(
				'DELETE FROM {prefix}activity_images 
				WHERE id in (' . $placeHolders . ')'
				), $aiIds);

			$this->db->query($removeQuery);

		}
	}

    public function setActivityImages($activityId, $imagesIds) {
        foreach ($imagesIds as $imageId) {
            $query = $this->preparePrefix(
                "
                INSERT INTO `{prefix}activity_images`
                    (`activity_id`, `image_id`)
                VALUES ('%d', '%d')
                ON DUPLICATE KEY UPDATE image_id = '%d'
                "
            );

            $this->db->query(
                $this->db->prepare($query, array($activityId, $imageId, $imageId))
            );
        }
    }

	public function getActivitiesLinks($activitiesIds) {

		$placeholders = implode(', ', array_pad(array(), count($activitiesIds), "'%d'"));

		$query = $this->preparePrefix("
			/** @lang sql */	
			SELECT l.*, al.activity_id
			FROM
				{prefix}activity_links AS al
			    LEFT JOIN {prefix}links AS l ON (al.link_id = l.id)
			WHERE al.activity_id IN  ($placeholders)
		");

		$links = array();

		$results = $this->db->get_results(
			$this->db->prepare($query, $activitiesIds),
			ARRAY_A
		);

		if ($results) {
			$linksModel = $this->getModel('Links', 'Activity');
			foreach ($results as $link) {
				$unserializedMeta = @unserialize($link['meta']);

				// emoji can cause error with unserialize if mysql database collation not support it
				if ($unserializedMeta === false) {
					$unserializedMeta = $linksModel->repairSerializedArray($link['meta']);
				}

				$link['meta'] = $unserializedMeta;
 				$links[$link['activity_id']] = $linksModel->prepareData($link);
			}
		}

		return $links;
	}

    public function getActivitiesImages($activitiesIds) {

        $placeholders = implode(', ', array_pad(array(), count($activitiesIds), "'%d'"));

        $query = $this->preparePrefix("
			SELECT 
				COUNT(ai.image_id) as total, ai.activity_id
			FROM
				{prefix}activity_images AS ai
			WHERE ai.activity_id IN ($placeholders)
			GROUP BY ai.activity_id
		");

        $count = $this->db->get_results(
            $this->db->prepare($query, $activitiesIds),
            ARRAY_A
        );

        $activitiesImages = array();

        foreach ($count as $activity) {
        	$activitiesImages[$activity['activity_id']] = array(
		        'total' => $activity['total'],
		        'thumbnails' => array(),
        	);
        }

        if (! $activitiesImages) {
        	return array();
        }

		$query = array();

		foreach ($activitiesImages as $activity => $activityData) {
			$query[] =  $this->db->prepare($this->preparePrefix("
				(SELECT 
					ai.activity_id, ai.image_id
				FROM
					{prefix}activity_images AS ai
				WHERE activity_id = '%d'
				ORDER BY image_id
				LIMIT 5)
			"), array($activity));
		}

		$query = implode(' UNION ALL ', $query);

        $images = $this->db->get_results(
            $query,
            ARRAY_A
        );

        $imagesIds = array();

        foreach ($images as $image) {
        	$imagesIds[] = $image['image_id'];
        }

        $imagesIds = implode(',', $imagesIds);
		
		$images = $this->db->get_results(
			$this->preparePrefix("
				SELECT 
					it.image_id, it.width, it.height, it.source, ai.activity_id
				FROM
					{prefix}images_thumbnails AS it
				LEFT JOIN {prefix}activity_images AS ai ON (it.image_id = ai.image_id)
				WHERE it.image_id IN ({$imagesIds})
			"),
			 ARRAY_A
		);

		foreach ($images as $image) {
			$activitiesImages[$image['activity_id']]['thumbnails'][$image['image_id']][] = $image;
		}

		return $activitiesImages;

    }

    public function getActivitiesLikes(array $activitiesIds, $currentUserId) {

	    $placeholders = implode(', ', array_pad(array(), count($activitiesIds), "'%d'"));

		$queryParams = array_merge(array($currentUserId), $activitiesIds);

	    $query = $this->preparePrefix("
			SELECT
				a.foreign_id as activityId,
				COUNT(au.id) as likedByCurrentUser,
				COUNT(a.id) as count
			FROM {prefix}activity AS a
			LEFT JOIN {prefix}activity AS au ON (a.id = au.id AND a.user_id = '%d')
			WHERE a.foreign_id IN ({$placeholders}) AND a.type = 'like' AND a.status = 'active'
			GROUP BY a.foreign_id
		");

	    $likes = $this->db->get_results(
		    $this->db->prepare($query, $queryParams),
		    ARRAY_A
	    );

	    $_likes = array();

	    if ($likes) {
			foreach ($likes as $like) {
				$_likes[$like['activityId']] = array(
					'likedByCurrentUser' => $like['likedByCurrentUser'],
					'count' => $like['count'],
				);
			}
	    }

	    return $_likes;
    }

    public function getActivitiesShares(array $activitiesIds, $currentUserId) {

	    $placeholders = implode(', ', array_pad(array(), count($activitiesIds), "'%d'"));

		$queryParams = array_merge(array($currentUserId), $activitiesIds);

	    $query = $this->preparePrefix("
			SELECT
				a.foreign_id as activityId,
				COUNT(DISTINCT au.user_id) as sharedByCurrentUser,
				COUNT(DISTINCT a.user_id) as count
			FROM {prefix}activity AS a
			LEFT JOIN {prefix}activity AS au ON (a.id = au.id AND a.user_id = '%d')
			LEFT JOIN {prefix}activity AS sa ON (sa.id = a.foreign_id)
			WHERE a.foreign_id IN ({$placeholders})  AND a.type = CONCAT('shared_', sa.type) AND a.status = 'active'
			GROUP BY a.foreign_id
		");

	    $shares = $this->db->get_results(
		    $this->db->prepare($query, $queryParams),
		    ARRAY_A
	    );

	    $_shares = array();

	    if ($shares) {
			foreach ($shares as $share) {
				$_shares[$share['activityId']] = array(
					'sharedByCurrentUser' => $share['sharedByCurrentUser'],
					'count' => $share['count'],
				);
			}
	    }

	    return $_shares;
    }

    public function getActivitiesComments(array $activitiesIds, $currentUserId) {

	    $placeholders = implode(', ', array_pad(array(), count($activitiesIds), "'%d'"));

		$queryParams = $activitiesIds;

	    $query = $this->preparePrefix("
			SELECT
				a.object_id as activityId,
				COUNT(a.id) as count
			FROM {prefix}activity AS a
			WHERE a.object_id IN ({$placeholders}) 
				AND (a.type = 'activity_comment' OR a.type = 'activity_group_comment')
				AND a.status = 'active'
			GROUP BY a.object_id
		");

	    $commentsModel = $this->getModel('Comments', 'Activity');

	    $counts = $this->db->get_results(
		    $this->db->prepare($query, $queryParams),
		    ARRAY_A
	    );


	    $_comments = array();

	    if ($counts) {
			foreach ($counts as $count) {
				$_comments[$count['activityId']] = array(
					'count' => $count['count'],
					'comments' => $commentsModel->getActivityComments($count['activityId'], $currentUserId, 1)
				);
			}
	    }

	    return $_comments;
    }

	public function getActivityLikes($activityId, $currentUserId, $limit, $offsetId = null) {

		$whereQuery = '';

		if ($offsetId) {
			$whereQuery = $this->db->prepare("AND a.id < '%d'", $offsetId);
		}

		$queryLimit = $this->db->prepare("LIMIT %d", $limit);

		$query = $this->preparePrefix("
			SELECT
				a.*
			FROM
			    {prefix}activity AS a
			    JOIN (SELECT
						MAX(a.id) AS id
					FROM
						{prefix}activity AS a
					WHERE
						a.foreign_id = '%d' AND a.type = 'like' AND a.status = 'active' {$whereQuery}
					GROUP BY a.user_id
				) as u_max_a_group  ON (a.id = u_max_a_group.id)
			WHERE
			    a.foreign_id = '%d' AND a.type = 'like' AND a.status = 'active' {$whereQuery}
			ORDER BY a.id DESC
			{$queryLimit}
		");

		$likes = $this->db->get_results(
			$this->db->prepare($query, array($activityId, $activityId)),
			ARRAY_A
		);

		if ($likes) {
			$likes = $this->prepareActivityRelatedData($likes, $currentUserId);
		}

		return $likes;
	}

    public function getActivityShares($activityId, $currentUserId, $limit, $offsetId = null) {

	    $whereQuery = '';

	    if ($offsetId) {
		    $whereQuery = $this->db->prepare("AND a.id < '%d'", $offsetId);
	    }

	    $queryLimit = $this->db->prepare("LIMIT %d", $limit);

        $query = $this->preparePrefix("
			SELECT
				a.*
			FROM
			    {prefix}activity AS a
			    JOIN (SELECT
						MAX(a.id) AS id
					FROM
						{prefix}activity AS a
			            LEFT JOIN {prefix}activity AS sa ON (sa.id = a.foreign_id)
					WHERE
						a.foreign_id = '%d' AND a.type = CONCAT('shared_', sa.type) AND a.status = 'active' {$whereQuery}
					GROUP BY a.user_id
				) as u_max_a_group ON (a.id = u_max_a_group.id)
			    LEFT JOIN {prefix}activity AS sa ON (sa.id = a.foreign_id)
			WHERE
			    a.foreign_id = '%d' AND a.type = CONCAT('shared_', sa.type) AND a.status = 'active' {$whereQuery}
			ORDER BY a.id DESC
			{$queryLimit}
        ");

	    $shares = $this->db->get_results(
		    $this->db->prepare($query, array($activityId, $activityId)),
		    ARRAY_A
	    );

	    if ($shares) {
		    $shares = $this->prepareActivityRelatedData($shares, $currentUserId);
	    }

	    return $shares;
    }

    public function searchInActivities($search, $type, $currentUserId = null, $limit, $lastActivityId = null) {

		if ($type == 'hash') {
			$tags = array();
			if(preg_match_all('/(?:^|\s)(#[a-z\d-]+)/', $search, $matches)) {
				foreach ($matches as $tag) {
					$tags[] = $this->db->prepare('%s', str_replace('#', '', $tag));
				}
			} else {
				return array();
			}

			$tags = implode(',', $tags);
			$searchQuery = "AND a.id IN (SELECT activity_id FROM {prefix}activity_tags WHERE tag IN ({$tags}))";
		} else {
			$regexp = $this->db->prepare('%s', $search);
			$searchQuery = "AND a.data REGEXP $regexp ";
		}

	    $query = $this->buildActivitySelectQuery(

		    array(
			    'where' => array(
				    "a.type IN ('post', 'related_post') $searchQuery",
				    // Search in closed approved groups
				    $this->db->prepare("a.type IN ('group_post', 'group_user_post') $searchQuery AND a.object_id
					IN (
						SELECT f.group_id FROM {prefix}groups_followers as f
						WHERE f.user_id = '%d'
					) AND a.object_id = (
						SELECT gu.group_id FROM {prefix}groups_users AS gu
						WHERE gu.user_id = '%d' AND gu.approved = '1'
						LIMIT 1
					) AND (
						SELECT value FROM {prefix}groups_settings WHERE group_id = a.object_id AND setting = 'read-activity'
					) != 'all'
					", array($currentUserId, $currentUserId)),

				    // Search in all public groups
				    "a.type IN ('group_post', 'group_user_post') $searchQuery AND (
						SELECT value FROM {prefix}groups_settings WHERE group_id = a.object_id AND setting = 'read-activity'
					) = 'all'"
			    ),
			    'type' => 'search-activity',
			    'limit' => $limit,
			    'requestedUserId' => $currentUserId,
			    'offsetId' => $lastActivityId
		    )
	    );

	    $activities = $this->db->get_results($query, ARRAY_A);

	    if ($activities) {
		    $activities = $this->prepareActivityRelatedData($activities, $currentUserId);
	    }

	    return array_values($activities);

    }

    public function updateActivityData($activityId, $data) {

	    $currentDateTime = $this->getCurrentDateInUTC();

	    $query = $this->preparePrefix("
			UPDATE {prefix}activity SET `data` = '%s', `updated_at` = '%s' WHERE `id` = '%d';
		");

	    $this->db->query(
		    $this->db->prepare($query, array($data, $currentDateTime, $activityId))
	    );
    }

    public function updateActivityStatus($activityId, $status) {
        $currentDateTime = $this->getCurrentDateInUTC();

        $query = $this->preparePrefix("
			UPDATE {prefix}activity SET `status` = '%s', `updated_at` = '%s' WHERE `id` = '%d';
		");

        $this->db->query(
            $this->db->prepare($query, array($status, $currentDateTime, $activityId))
        );
    }

    public function canReadActivity($activity) {

	    if (in_array($activity['type'], array('group_post', 'group_user_post'))) {

		    if (isset($activity['group']) &&
		        isset($activity['group']['settings']) &&
		        isset($activity['group']['settings']['read-activity'])) {

			    $group = $activity['group'];
			    $groupSettings = $group['settings'];

			    if ($groupSettings['read-activity'] === 'all') {
				    return true;
			    }

			    if ($groupSettings['read-activity'] === 'members-only' && !!$group['currentUserApproved']) {
				    return true;
			    }
		    }

		    return false;
	    }

	    if (isset($activity['relatedActivity'])) {
			return $this->canReadActivity($activity['relatedActivity']);
	    }

	    if (isset($activity['sharedActivity'])) {
			return $this->canReadActivity($activity['sharedActivity']);
	    }

	    return true;
    }

    public function getPopularActivities($params) {

	    $limit = isset($params['limit']) ? $params['limit'] : 5;
	    $since = isset($params['since']) ? $params['since'] : 0;
	    $offset = isset($params['offset']) ? $params['offset'] : null;
		$show_shortened_post = isset($params['show_shortened_post']) ? $params['show_shortened_post'] : null;
		$show_shortened_post_len = isset($params['show_shortened_post_len']) ? (int) $params['show_shortened_post_len'] : 300;

	    if (isset($params['activityTypes'])) {
		    $activityTypes = $params['activityTypes'];
	    } else {
		    $activityTypes = $this->getAllActivityTypes();
		    $activityTypes = array_keys($activityTypes);
	    }

	    $createdAt = '';

	    switch ($since) {
		    case 0:
			    $createdAt = ' AND a.created_at >= DATE(NOW() - INTERVAL 1 DAY)';
			    break;
		    case 1:
			    $createdAt = ' AND a.created_at >= DATE(NOW() - INTERVAL 7 DAY)';
			    break;
		    case 2:
			    $createdAt = ' AND a.created_at >= DATE(NOW() - INTERVAL 30 DAY)';
			    break;
		    case 4:
			    $createdAt = ' AND a.created_at >= DATE(NOW() - INTERVAL 365 DAY)';
			    break;
	    }

	    $andWhere = " AND a.type != 'like'";
	    $andWhere .= $createdAt;

	    $currentUserId = get_current_user_id();

		$query = $this->buildActivitySelectQuery(array(
				'where' => $this->getGuestActivityQueries($activityTypes),
				'type' => 'activity-guest',
				'select' => ', (SELECT COUNT(al.id) FROM {prefix}activity AS al WHERE al.type = \'like\' AND a.id = al.foreign_id) as likes',
				'orderBy' => ' ORDER BY likes DESC, id DESC',
				'andWhere' => $andWhere,
				'limit' => $this->db->prepare('%d', $limit),
				'offset' => $offset
			)
		);

	    $activities = $this->db->get_results($query, ARRAY_A);

		if($show_shortened_post == 1 && $show_shortened_post_len > 0 && count($activities)) {
			foreach($activities as &$oneActivity) {
				$shortData = $this->getTruncatedStrWithHtmlTags($oneActivity['data'], $show_shortened_post_len);
				$dataLen = strlen($oneActivity['data']);
				$shortDataLen = strlen($shortData);
				$oneActivity['data'] = $shortData;
				if($shortDataLen < $dataLen) {
					$oneActivity['data'] .= '...';
				}
			}
		}

	    if ($activities) {
		    $activities = $this->prepareActivityRelatedData($activities, $currentUserId);
	    }

	    return $activities;
    }

	function getTruncatedStrWithHtmlTags($inputStr, $maxLength = 300, $isUtf8 = true) {
		if($maxLength <= 0) {
			return null;
		}
		$resultStr = '';
		$printedLength = 0;
		$position = 0;
		$tags = array();

		// For UTF-8, we need to count multibyte sequences as one character.
		$re = $isUtf8
			? '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;|[\x80-\xFF][\x80-\xBF]*}'
			: '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}';

		while ($printedLength < $maxLength
			&& preg_match($re, $inputStr, $match, PREG_OFFSET_CAPTURE, $position))
		{
			list($tag, $tagPosition) = $match[0];
			// Print text leading up to the tag.
			$str = substr($inputStr, $position, $tagPosition - $position);

			if ($printedLength + strlen($str) > $maxLength) {
				$res1 = $this->checkAndPrepareWordToAdd($str, $maxLength, 0, $printedLength, strlen($str));
				$resultStr .= $res1;
				$printedLength = $maxLength;
				break;
			}
			$resultStr .= $str;

			$printedLength += strlen($str);
			if ($printedLength >= $maxLength) {
				break;
			}

			if ($tag[0] == '&' || ord($tag) >= 0x80) {
				// Pass the entity or UTF-8 multibyte sequence through unchanged.
				$resultStr .= $tag;
				$printedLength++;
			} else {
				// Handle the tag.
				$tagName = $match[1][0];

				if ($tag[1] == '/') {
					// This is a closing tag.
					if(count($tags)) {
						$resultStr .= '</' . array_pop($tags) . '>';
					} else {
						$resultStr .= $tag;
					}
				} else if ($tag[strlen($tag) - 2] == '/') {
					// Self-closing tag.
					$resultStr .= $tag;
				} else {
					// Opening tag.
					$resultStr .= $tag;
					$tags[] = $tagName;
				}
			}
			// Continue after the tag.
			$position = $tagPosition + strlen($tag);
		}

		// Print any remaining text.
		$currStrLen = strlen($inputStr);
		if ($printedLength < $maxLength && $position < $currStrLen) {
			$resultStr .= $this->checkAndPrepareWordToAdd($inputStr, $maxLength, $position, $printedLength, $currStrLen);
		}

		// Close any open tags.
		while (!empty($tags)) {
			$resultStr .= '</' . array_pop($tags) . '>';
		}
		return $resultStr;
	}

	/**
	 * check word is not wrapped? if not - return it
	 * @param $inputStr
	 * @param $maxLength
	 * @param $position
	 * @param $printedLength
	 * @param $currStrLen
	 * @return string
	 */
	public function checkAndPrepareWordToAdd($inputStr, $maxLength, $position, $printedLength, $currStrLen) {
		$wordToAdd = '';
		$cutStrLen = $maxLength - $printedLength;
		$cutSubStr = substr($inputStr, $position, $cutStrLen);
		$nextCharPosition = $position + $cutStrLen;

		// check length
		if($nextCharPosition < $currStrLen) {
			// if next symbol is letter - delete this word
			if(ctype_alpha(substr($inputStr, $nextCharPosition, 1))) {
				$prevDelimiterFound = false;
				$nextCharPosition--;

				while($prevDelimiterFound === false && $nextCharPosition >= $position) {
					if(!ctype_alpha(substr($inputStr, $nextCharPosition, 1))) {
						$prevDelimiterFound = $nextCharPosition;
						$wordToAdd = substr($inputStr, $position, $nextCharPosition - $position + 1);
					} else {
						$nextCharPosition--;
					}
				}
			} else {
				// if next char is not letter - then add curr string
				$wordToAdd = $cutSubStr;
			}
		} else {
			// copy all remaining text
			$wordToAdd = $cutSubStr;
		}
		return $wordToAdd;
	}

    public function getAllActivityTypes() {
		return array(
			self::ACTIVITY_TYPE_POST => $this->translate('Posts'),
			self::ACTIVITY_TYPE_PHOTOS => $this->translate('Photos'),
			self::ACTIVITY_TYPE_SHARES => $this->translate('Shares'),
			self::ACTIVITY_TYPE_LIKES => $this->translate('Likes'),
			self::ACTIVITY_TYPE_FAVORITES => $this->translate('Favorite'),
			self::ACTIVITY_TYPE_COMMENTS => $this->translate('Comments'),
			self::ACTIVITY_TYPE_GROUPS => $this->translate('Groups'),
			self::ACTIVITY_TYPE_SOCIAL => $this->translate('Social'),
			self::ACTIVITY_TYPE_FORUM => $this->translate('Forum')
		);
    }

	public function getActivityTypesFromSettings($types) {
		$enabledActivityTypes = array();

		foreach ($types as $name => $isEnabled) {
			if ($isEnabled === 'true') {
				$enabledActivityTypes[] = $name;
			}
		}

		return $enabledActivityTypes;
	}

	public function getSmilesList() {
		return array(
			'1' => ':smile:',
			'2' =>':grin:',
			'3' =>':sad:',
			'4' =>':eek:',
			'5' =>':shock:',
			'6' =>':???:',
			'7' =>':cool:',
			'8' =>':mad:',
			'9' =>':razz:',
			'10' =>':neutral:',
			'11' =>':wink:',
			'12' =>':lol:',
			'13' =>':oops:',
			'14' =>':cry:',
			'15' =>':evil:',
			'16' =>':twisted:',
			'17' =>':roll:',
			'18' =>':!:',
			'19' =>':?:',
			'20' =>':idea:',
			'21' =>':arrow:',
			'22' =>':mrgreen:',
		);
	}

	public function getActivitiesByGroupId($id){
	    return $this->getActivity(array('target_id' => $id));
    }

	public function addAttachmentFiles($activityId, array $attachmentIds) {
		$attachmentTable = $this->getPrefix() . 'activity_attachments';
		$activityId = (int) $activityId;

		$arrCount = count($attachmentIds);
		if($arrCount) {
			$queryValStr = array_fill(0, $arrCount, "('" . $activityId . "', %s)");
			$queryStr = "INSERT INTO " . $attachmentTable . " (`activity_id`, `attachment_all_id`) VALUES" . implode(',', $queryValStr);

			$query = $this->db->prepare($queryStr, $attachmentIds);
			$this->db->query($query);
			return true;
		}
		return false;
	}

	public function getAttachmentFiles(array $acitivityIds) {
		$resAttArr = array();
		$attachmentTable = $this->getPrefix() . 'activity_attachments';

		$arrCount = count($acitivityIds);
		if($arrCount) {
			$query = "SELECT aatt.activity_id, aall.`source`, aatt.attachment_all_id
				FROM " . $this->getPrefix() . "activity_attachments aatt
				INNER JOIN " . $this->getPrefix() . "attachments_all aall
					ON aatt.attachment_all_id = aall.id
				WHERE aall.is_saved = 1
				AND aatt.activity_id in (" . implode(',', array_fill(0, $arrCount, '%s')) . ")";

			$query = $this->db->prepare($query, $acitivityIds);
			$dbResult = $this->db->get_results($query, ARRAY_A);

			if(count($dbResult)) {
				foreach($dbResult as $oneAtt) {
					$explodedArr = explode('|||', $oneAtt['source']);
					$fileNameArr = array();
					if(is_array($explodedArr) && !empty($explodedArr)) {
						if(count($explodedArr) == 1) {
							$fileNameArr['url'] = $explodedArr[0];
						} else {
							$fileNameArr['name'] = $explodedArr[0];
							$fileNameArr['url'] = $explodedArr[1];
						}
					}
					$resAttArr[$oneAtt['activity_id']][] = array(
						'file_info' => $fileNameArr,
						'attachment_all_id' => $oneAtt['attachment_all_id'],
					);
				}
			}
		}

		return $resAttArr;
	}

	public function getActivityAttachmentIds($activityId) {
		$query = $this->db->prepare(
			"SELECT attachment_all_id FROM " . $this->getPrefix() . "activity_attachments WHERE activity_id = %s",
			array($activityId)
		);

		$resArr = array();
		$dbRes = $this->db->get_results($query, ARRAY_A);
		if(count($dbRes)) {
			foreach($dbRes as $oneRes) {
				$resArr[] = $oneRes['attachment_all_id'];
			}
		}
		return $resArr;
	}

	public function removeActivityAttachmentsBy($activityId, array $attachmentIds) {
		$activityId = (int) $activityId;
		if(count($attachmentIds)) {
			$attachCodes = implode(',', array_fill(0, count($attachmentIds), '%s'));
			$remQuery = "DELETE FROM " . $this->getPrefix() . "activity_attachments
				WHERE activity_id = '" . $activityId . "' AND attachment_all_id in (" . $attachCodes . ")";
			$remQuery = $this->db->prepare($remQuery, $attachmentIds);

			$this->db->query($remQuery);
		}
		return true;
	}

	public function unFavoriteActivity($activityId, $currentUserId) {
		$queryParams = array($currentUserId, $activityId);
		$query = $this->preparePrefix("
			DELETE FROM {prefix}activity
			WHERE user_id = '%d' AND foreign_id = '%d' AND type = 'favorite'
		");

		return $this->db->query($this->db->prepare($query, $queryParams));
	}

	public function getActivitiesFavorites(array $activitiesIds, $currentUserId) {

		$placeholders = implode(', ', array_pad(array(), count($activitiesIds), "'%d'"));
		$queryParams = array_merge(array($currentUserId), $activitiesIds);

		$query = $this->preparePrefix("
			SELECT
				a.foreign_id as activityId,
				COUNT(au.id) as favoritedByCurrentUser,
				COUNT(a.id) as count
			FROM {prefix}activity AS a
			LEFT JOIN {prefix}activity AS au ON (a.id = au.id AND a.user_id = '%d')
			WHERE a.foreign_id IN ({$placeholders}) AND a.type = 'favorite' AND a.status = 'active'
			GROUP BY a.foreign_id
		");

		$favorites = $this->db->get_results(
			$this->db->prepare($query, $queryParams),
			ARRAY_A
		);

		$_favorites = array();
		if($favorites) {
			foreach($favorites as $favorite) {
				$_favorites[$favorite['activityId']] = array(
					'currentUserInFavorite' => $favorite['favoritedByCurrentUser'],
					'count' => $favorite['count'],
				);
			}
		}
		return $_favorites;
	}

	public function getActivityInfoFavorites($activityId, $currentUserId, $limit, $offsetId = null) {

		$whereQuery = '';
		if ($offsetId) {
			$whereQuery = $this->db->prepare("AND a.id < '%d'", $offsetId);
		}

		$queryLimit = $this->db->prepare("LIMIT %d", $limit);
		$query = $this->preparePrefix("
			SELECT a.*
			FROM {prefix}activity AS a
			JOIN (
				SELECT MAX(a.id) AS id
				FROM {prefix}activity AS a
				WHERE a.foreign_id = '%d' AND a.type = 'favorite' AND a.status = 'active' {$whereQuery}
				GROUP BY a.user_id
			) as u_max_a_group  ON (a.id = u_max_a_group.id)
			WHERE a.foreign_id = '%d' AND a.type = 'favorite' AND a.status = 'active' {$whereQuery}
			ORDER BY a.id DESC
			{$queryLimit}
		");

		$favorites = $this->db->get_results($this->db->prepare($query, array($activityId, $activityId)),ARRAY_A);

		if ($favorites) {
			$favorites = $this->prepareActivityRelatedData($favorites, $currentUserId);
		}

		return $favorites;
	}
}