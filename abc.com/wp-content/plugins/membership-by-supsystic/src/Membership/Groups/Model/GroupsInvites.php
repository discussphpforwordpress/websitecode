<?php

class Membership_Groups_Model_GroupsInvites extends Membership_Base_Model_Base
{

	
	public function inviteUsers($groupId, $usersIds, $invitedBy) {

		$valuesPlaceholder = array();
		$queryParams = array();

        $group = $this->getModel('groups', 'groups')->getGroup($groupId, get_current_user_id());

		foreach ($usersIds as $userId) {
			$queryParams[] = $groupId;
			$queryParams[] = $userId;
			$queryParams[] = $invitedBy;
			$valuesPlaceholder[] = "('%d', '%d', '%d')";
		}

		$valuesPlaceholder = implode(',', $valuesPlaceholder);

		$query = $this->preparePrefix("
			INSERT INTO {prefix}groups_invites (`group_id`, `user_id`, `invited_by`)
			VALUES {$valuesPlaceholder}
		");

		$query = $this->db->query(
			$this->db->prepare($query, $queryParams)
		);

		if ($query !== false)  {
			foreach ($usersIds as $userId) {
				$this->getDispatcher()->dispatch('groups.inviteUser', array($groupId, $userId, $invitedBy));
			}
		}

		return $query;
	}

	public function inviteUser($groupId, $userId, $invitedBy, $invitationType) {

		$query = $this->preparePrefix("
			INSERT INTO {prefix}groups_invites (`group_id`, `user_id`, `invited_by`, `invitation_type`)
			VALUES ('%d', '%d', '%d', '%s');
		");

		$query = $this->db->query(
			$this->db->prepare($query, array($groupId, $userId, $invitedBy, $invitationType))
		);

		if ($query !== false)  {
			$this->getDispatcher()->dispatch('groups.inviteUser', array($groupId, $userId, $invitedBy));
		}

		return $query;
	}

	public function cancelInvitation($groupId, $userId, $currentUserId = null) {

		$queryParams = array($groupId, $userId);

		$query = $this->preparePrefix("
			DELETE FROM {prefix}groups_invites WHERE group_id = '%d' AND user_id = '%d'
		");

		if ($currentUserId) {
			$query .= " AND invited_by = '%d'";
			$queryParams[] = $currentUserId;
		}

		return $this->db->query(
			$this->db->prepare($query, $queryParams)
		);
	}

	public function getUserInvitations($userId) {

		$groupsModel = $this->getModel('groups', 'groups');
		$currentUserId = get_current_user_id();

		$usersModel = $this->getModel('profile', 'users');

		$query = $this->preparePrefix("
			SELECT * FROM {prefix}groups_invites WHERE user_id = '%d'
		");

		$invitations = $this->db->get_results(
			$this->db->prepare($query, array($userId)),
			ARRAY_A
		);

		$_invitedBy = array();
		$_invitedTo = array();

		if ($invitations) {
			foreach ($invitations as &$invitation) {
				$_invitedBy[$invitation['invited_by']] = array();
				$_invitedTo[$invitation['group_id']] = array();
				$invitation['invitedTo'] = &$_invitedTo[$invitation['group_id']];
				$invitation['invitedBy'] = &$_invitedBy[$invitation['invited_by']];
			}
			
			$users = $usersModel->getUsersByIds(array('users' => array_keys($_invitedBy)));

			foreach ($users as &$user) {
				$_invitedBy[$user['id']] = $user;
			}

			$groups = $groupsModel->getGroupsByIds(array_keys($_invitedTo), $currentUserId);

			foreach ($groups as &$group) {
				$_invitedTo[$group['id']] = $group;
			}
			
		}

		return $invitations;
	}

	public function isInvited($userId, $groupId) {
		$query = $this->preparePrefix("
			SELECT 1 FROM {prefix}groups_invites WHERE group_id = '%d' AND user_id = '%d' LIMIT 1
		");

		return (bool) $this->db->get_var(
			$this->db->prepare($query, array($groupId, $userId))
		);
	}

	public function getInvitation($userId, $groupId) {
		$query = $this->preparePrefix("
			SELECT * FROM {prefix}groups_invites WHERE group_id = '%d' AND user_id = '%d' LIMIT 1
		");

		return $this->db->get_row(
			$this->db->prepare($query, array($groupId, $userId)),
			ARRAY_A
		);
	}
}