<?php

class Membership_Groups_Model_Followers extends Membership_Base_Model_Base
{

	public function addToFollowers($currentUserId, $groupId) {

		$currentDateTime = $this->getCurrentDateInUTC();

		$query = $this->preparePrefix("
			INSERT
			INTO {prefix}groups_followers (user_id, group_id, followed_at)
			VALUES ('%d', '%d', '%s')
		");
		
		return $this->db->query(
			$this->db->prepare($query, array($currentUserId, $groupId, $currentDateTime))
		);
	}

	public function removeFromFollowers($currentUserId, $groupId) {

		$query = $this->preparePrefix("
			DELETE
			FROM {prefix}groups_followers
			WHERE (user_id = '%d' AND group_id = '%d')
		");
		
		return $this->db->query(
			$this->db->prepare($query, array($currentUserId, $groupId))
		);
	}

	public function getGroupFollowers($groupId, $limit = null, $offset = 0)
	{
		$queryParams = array($groupId);

		$query = $this->preparePrefix("
			SELECT f.user_id AS id
			FROM {prefix}groups_followers as f
			WHERE f.group_id = '%d'
		");

        if ($limit) {
            $query .= " LIMIT %d, %d";
            $queryParams[] = $offset;
            $queryParams[] = $limit;
        }

		$followers = $this->db->get_col(
			$this->db->prepare($query, $queryParams)
		);

		if (! empty($followers)) {
			$usersModel = $this->getModel('profile', 'users');
			$followers = $usersModel->getUsersByIds(array('users' => $followers));

		}

		return $followers;
	}
}