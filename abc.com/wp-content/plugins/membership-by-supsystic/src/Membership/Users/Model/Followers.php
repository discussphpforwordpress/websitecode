<?php

class Membership_Users_Model_Followers extends Membership_Base_Model_Base
{

	public function addToFollowers($currentUserId, $followingId) {

		$currentDateTime = $this->getCurrentDateInUTC();

		$query = $this->preparePrefix("
			INSERT
			INTO {prefix}followers (user_id, following_id, followed_at)
			VALUES ('%d', '%d', '%s')
		");


		$query = $this->db->query(
			$this->db->prepare($query, array($currentUserId, $followingId, $currentDateTime))
		);

		if ($query !== false) {
			$this->getDispatcher()->dispatch('users.addToFollowers', array($currentUserId, $followingId));
		}

		return $query;
	}

	public function removeFromFollowers($currentUserId, $followingId) {

		$query = $this->preparePrefix("
			DELETE
			FROM {prefix}followers
			WHERE (user_id = '%d' AND following_id = '%d')
		");
		
		return $this->db->query(
			$this->db->prepare($query, array($currentUserId, $followingId))
		);
	}

    public function getUserFollows($requestedUserId, $limit, $offsetId = null, $search = null)
    {
        $queryParams = array($requestedUserId);

	    $andQuerySql = '';

	    if ($offsetId) {
		    $andQuerySql .= $this->db->prepare("AND f.following_id < '%d' ", $offsetId);
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
				LEFT JOIN {$this->db->base_prefix}usermeta AS m1 ON (m1.user_id = f.following_id AND m1.meta_key = 'first_name')
				LEFT JOIN {$this->db->base_prefix}usermeta AS m2 ON (m2.user_id = f.following_id AND m2.meta_key = 'last_name')
			";
	    }

	    $having = '';

	    if ($search) {
		    $having .= " HAVING CONCAT(firstName, ' ', lastName) LIKE CONCAT('%%', '%s', '%%') OR CONCAT(lastName, ' ', firstName) LIKE CONCAT('%%', '%s', '%%')";
		    $queryParams[] = $search;
		    $queryParams[] = $search;
	    }

	    $query = $this->preparePrefix("
			SELECT f.following_id
			{$searchColumnsPlaceholder}
			FROM {prefix}followers as f
			{$searchJoinPlaceholder}
			WHERE f.user_id = '%d'
			{$andQuerySql}
			{$having}
			ORDER BY f.following_id DESC
			LIMIT  %d
		");

	    $queryParams[] = $limit;

        $follows = $this->db->get_col(
            $this->db->prepare($query, $queryParams)
        );

        if (! empty($follows)) {
            $usersModel = $this->getModel('profile', 'users');
            $follows = $usersModel->getUsersByIds(array('users' => $follows));

        }
	    $follows = $this->getDispatcher()->apply('badges.addBadges', array($follows));
        return $follows;
    }

	public function getUserFollowers($requestedUserId, $limit, $offsetId = null, $search = null)
	{
		$queryParams = array($requestedUserId);

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
			FROM {prefix}followers as f
			{$searchJoinPlaceholder}
			WHERE f.following_id = '%d'
			{$andQuerySql}
			{$having}
			ORDER BY f.user_id DESC
			LIMIT  %d
		");

		$queryParams[] = $limit;

		$followers = $this->db->get_col(
			$this->db->prepare($query, $queryParams)
		);

		if (! empty($followers)) {
			$usersModel = $this->getModel('profile', 'users');
			$followers = $usersModel->getUsersByIds(array('users' => $followers));

		}
		$followers = $this->getDispatcher()->apply('badges.addBadges', array($followers));
		return $followers;
	}
}