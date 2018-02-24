<?php

class Membership_Users_Model_Friends extends Membership_Base_Model_Base
{

	public function addToFriends($currentUserId, $friendId) {

		$query = $this->preparePrefix("
			INSERT
			INTO {prefix}friends (user_id, friend_id)
			VALUES ('%d', '%d')
		");

		$query = $this->db->query(
			$this->db->prepare($query, array($currentUserId, $friendId))
		);

		if ($query !== false) {
			$this->getDispatcher()->dispatch('users.addToFriends', array($currentUserId, $friendId));
		}

		return $query;
	}



	public function removeFromFriends($currentUserId, $friendId) {

		$query = $this->preparePrefix("
			DELETE
			FROM {prefix}friends
			WHERE (user_id = '%d' AND friend_id = '%d')
			OR (user_id = '%d' AND friend_id = '%d')
		");

		return $this->db->query(
			$this->db->prepare($query, array($currentUserId, $friendId, $friendId, $currentUserId))
		);
	}

	public function getUserFriends($requestedUserId, $limit, $offsetId = null, $search = null)
	{
		$queryParams = array($requestedUserId, $requestedUserId);

		$andQuerySql = '';

		if ($offsetId) {
			$andQuerySql .= $this->db->prepare("AND f.friend_id < '%d' ", $offsetId);
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
				LEFT JOIN {$this->db->base_prefix}usermeta AS m1 ON (m1.user_id = f.friend_id AND m1.meta_key = 'first_name')
				LEFT JOIN {$this->db->base_prefix}usermeta AS m2 ON (m2.user_id = f.friend_id AND m2.meta_key = 'last_name')
			";
		}

		$having = '';

		if ($search) {
			$having .= " HAVING CONCAT(firstName, ' ', lastName) LIKE CONCAT('%%', '%s', '%%') OR CONCAT(lastName, ' ', firstName) LIKE CONCAT('%%', '%s', '%%')";
			$queryParams[] = $search;
			$queryParams[] = $search;
		}

		$query = $this->preparePrefix("
			SELECT f.friend_id
			{$searchColumnsPlaceholder}
			FROM {prefix}friends as f
			{$searchJoinPlaceholder}
			WHERE f.user_id = '%d' AND f.friend_id
			IN (SELECT user_id FROM {prefix}friends WHERE friend_id = '%d')
			{$andQuerySql}
			{$having}
			ORDER BY f.friend_id DESC
			LIMIT  %d
		");

		$queryParams[] = $limit;

		$friends = $this->db->get_col(
			$this->db->prepare($query, $queryParams)
		);

		if (! empty($friends)) {
			$usersModel = $this->getModel('profile', 'users');
			$friends = $usersModel->getUsersByIds(array('users' => $friends));
		}
		$friends = $this->getDispatcher()->apply('badges.addBadges', array($friends));
		return $friends;
	}

	public function countFriendRequests($userId) {

		$queryParams = array($userId, $userId);

		$query = $this->preparePrefix("
			SELECT COUNT(user_id)
			FROM {prefix}friends
			WHERE friend_id = '%d' AND user_id
			NOT IN (SELECT friend_id FROM {prefix}friends WHERE user_id = '%d')
		");

		return $this->db->get_var(
			$this->db->prepare($query, $queryParams)
		);
	}

	public function getUserFriendRequests($limit, $offsetId = null, $search = null)
	{
		$currentUserId = get_current_user_id();

		$queryParams = array($currentUserId, $currentUserId);

		$andQuerySql = '';

		if ($offsetId) {
			$andQuerySql .= $this->db->prepare("AND f.user_id < '%d' ", $offsetId);
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
				LEFT JOIN {$this->db->base_prefix}usermeta AS m1 ON (m1.user_id = f.user_id AND m1.meta_key = 'first_name')
				LEFT JOIN {$this->db->base_prefix}usermeta AS m2 ON (m2.user_id = f.user_id AND m2.meta_key = 'last_name')
			";
		}

		$having = '';

		if ($search) {
			$having .= " HAVING CONCAT(firstName, ' ', lastName) LIKE CONCAT('%%', '%s', '%%') OR CONCAT(lastName, ' ', firstName) LIKE CONCAT('%%', '%s', '%%')";
			$queryParams[] = $search;
			$queryParams[] = $search;
		}

		$query = $this->preparePrefix("
			SELECT f.user_id
			{$searchColumnsPlaceholder}
			FROM {prefix}friends AS f
			$searchJoinPlaceholder
			WHERE f.friend_id = '%d' AND f.user_id
			NOT IN (SELECT friend_id FROM {prefix}friends WHERE user_id = '%d')
			{$andQuerySql}
			{$having}
			ORDER BY f.friend_id DESC
			LIMIT %d
		");

		$queryParams[] = $limit;

		$friendRequests = $this->db->get_col(
			$this->db->prepare($query, $queryParams)
		);

		if (! empty($friendRequests)) {
			$usersModel = $this->getModel('profile', 'users');
			$friendRequests = $usersModel->getUsersByIds(array('users' => $friendRequests));
		}

		return $friendRequests;
	}

	/**
	 * get only accepted friend list
	 * @param $userId
	 * @return array|null|object
	 */
	public function getAcceptedUserFriendIds($userId, $resultAsSimpleArray = false) {
		$querySelParams = array((int)$userId);
		$querySelect = $this->preparePrefix(
		"SELECT f.user_id
			FROM {prefix}friends as f
			WHERE f.friend_id = '%d'"
		);

		$userFriendsArr = $this->getDb()->get_results($this->db->prepare($querySelect, $querySelParams), ARRAY_A);

		if($resultAsSimpleArray && count($userFriendsArr)) {
			$newArray = array();
			foreach($userFriendsArr as $oneFriend) {
				$newArray[] = $oneFriend['user_id'];
			}
			$userFriendsArr = $newArray;
		}
		return $userFriendsArr;
	}
}