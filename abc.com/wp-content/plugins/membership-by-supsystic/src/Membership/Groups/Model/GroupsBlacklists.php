<?php

class Membership_Groups_Model_GroupsBlacklists extends Membership_Base_Model_Base
{
	public function blockUser($groupId, $userId, $blockedBy, $reason = null, $commentary = null) {

		$query = $this->preparePrefix("
			INSERT INTO {prefix}groups_blacklists (group_id, user_id, blocked_by, reason, commentary)
			VALUES ('%d', '%d', '%d', '%s', '%s');
		");

		return $this->db->query(
			$this->db->prepare($query, array($groupId, $userId, $blockedBy, $reason, $commentary)),
			ARRAY_A
		);
	}

	public function getBlockedUsers($groupId, $offsetPage)
	{
		$limit = 20;
		$offset = $limit * $offsetPage;

		$query = $this->preparePrefix("
			SELECT user_id FROM {prefix}groups_blacklists WHERE group_id = '%d'
			LIMIT {$offset}, {$limit}
		");

		return $this->db->get_col(
			$this->db->prepare($query, array($groupId))
		);
	}
	public function unblockUser($groupId, $userId) {

		$query = $this->preparePrefix("
			DELETE FROM {prefix}groups_blacklists WHERE group_id = '%d' AND user_id = '%d'
		");

		return $this->db->query(
			$this->db->prepare($query, array($groupId, $userId)),
			ARRAY_A
		);
	}

}