<?php

class Membership_Messages_Model_Conversation extends Membership_Base_Model_Base
{
	public function getConversationDialog($user1, $user2)
	{
		$query = $this->preparePrefix("
			SELECT c.*, u1.user_id as u1, u2.user_id as u2 FROM {prefix}conversations as c
			LEFT JOIN {prefix}conversations_users AS u1 ON (c.id = u1.conversation_id AND u1.user_id = '%d')
			JOIN {prefix}conversations_users AS u2 ON (c.id = u2.conversation_id AND u2.user_id = '%d' AND u2.id != u1.id)
			WHERE type = 'conversation'
		");

		return $this->db->get_row(
			$this->db->prepare($query, array($user1, $user2)),
			ARRAY_A
		);
	}

	public function createConversation($createdBy, $users, $type = 'conversation') {

		$query = $this->preparePrefix("
			INSERT INTO {prefix}conversations (`created_by`, `type`)
			VALUES ('%d', '%s');
		");

		$this->db->query(
			$this->db->prepare($query, array($createdBy, $type))
		);

		$conversationId = $this->db->insert_id;

		if ($conversationId && !$this->getError()) {

			$values = array();

			$query = $this->preparePrefix("
				INSERT INTO {prefix}conversations_users (`conversation_id`, `user_id`, `conversation_state`)
				VALUES 
			");

			foreach ($users as $userId) {
				$values[] = $this->db->prepare("('%d', '%d', 'joined')", array($conversationId, $userId)); 
 			}

 			$query .= implode(',', $values);

			if ($this->db->query($query) !== false)  {
				$this->getDispatcher()->dispatch('messages.createConversation', array($createdBy, $users, $type, $conversationId));
			}
		}

		return $conversationId;
	}

	public function getConversationUsers($conversationsIds, $withCurrentUser = false)
	{
		$queryParams = $conversationsIds;

		if (!is_array($conversationsIds)) {
			$queryParams = array($conversationsIds);
		}

		$conversationsIdsPlaceholders = implode(', ', array_pad(array(), count($conversationsIds), "'%d'"));

		$query = $this->preparePrefix("
			SELECT user_id, conversation_state, conversation_id
			FROM {prefix}conversations_users
			WHERE conversation_id IN ({$conversationsIdsPlaceholders})
		");

		if (!$withCurrentUser) {
			$queryParams[] = get_current_user_id();
			$query .= " AND user_id != '%d'";
		}

		$conversations = array();

		$results = $this->db->get_results(
			$this->db->prepare($query, $queryParams),
			ARRAY_A
		);


		foreach ($results as $conversation) {
			$conversations[$conversation['conversation_id']][] = $conversation['user_id'];
		}

		if (!is_array($conversationsIds)) {
			return array_shift($conversations);
		}

		return $conversations;
	}

	public function addMessage($message, $authorId, $conversationId) {
		
		$query = $this->preparePrefix("
			INSERT INTO {prefix}messages (`message`, `author_id`, `conversation_id`, `created_at`)
			VALUES ('%s', '%d', '%d', '%s')
		");

		$this->db->query(
			$this->db->prepare(
			    $query,
                array($message, $authorId, $conversationId, $this->getCurrentDateInUTC())
            )
		);

		$messageId = $this->db->insert_id;

		if (!$messageId) {
			return false;
		}

		$users = array_unique($this->getConversationUsers($conversationId, true));

		$usersWhoBlockMessageAuthor = $this->getUsersWhoBlock($authorId);

		foreach ($users as $i => $user) {
			if (in_array($user, $usersWhoBlockMessageAuthor)) {
				unset($users[$i]);

				if (count($users) === 1) {
					return array(
						'isSent' => false,
						'error' => $this->translate('This user is blocking your messages.')
					);
				}
			}
		}

		if (!$users) {
			return array(
				'isSent' => false,
				'error' => $this->translate('No users is found.')
			);
		}

		$values = array();

		$query = $this->preparePrefix("
			INSERT INTO {prefix}messages_users (`message_id`, `user_id`, `message_state`)
			VALUES
		");

		foreach ($users as $userId) {

			$state = intval($userId) === intval($authorId) ? 'read' :'unread';

			$values[] = $this->db->prepare(
				"('%d', '%d', '%s')",
				array($messageId, $userId, $state)
			);
		}

		$query .= implode(',', $values);

		$query = $this->db->query($query);

		if ($query !== false) {
			$this->getDispatcher()->apply('messages.addMessage', array($authorId, $users, $messageId));
		}

		return array(
			'isSent' => true,
			'messageId' => $messageId
		);
	}

	public function getUserConversations($currentUserId, $conversationsIds = false) {

		$queryParams = array($currentUserId, $currentUserId);

		$query = $this->preparePrefix("
			SELECT m1.conversation_id AS id,
			COUNT(CASE WHEN mu.message_state = 'unread' THEN 1 ELSE NULL END) AS unreadMessages,
			m2.id AS lastMessageId,
			m2.message as lastMessage,
			m2.created_at AS lastMessageCreatedAt,
			c.type
			FROM {prefix}messages_users AS mu
			LEFT JOIN {prefix}messages AS m1 ON (m1.id = mu.message_id)
			LEFT JOIN (
				SELECT MAX(mu.message_id) AS last_message_id, m.conversation_id
				FROM {prefix}messages_users AS mu
				LEFT JOIN {prefix}messages AS m ON (m.id = mu.message_id)
				WHERE mu.user_id = '%d'
				GROUP BY m.conversation_id
			) AS lm ON (lm.conversation_id = m1.conversation_id)
			LEFT JOIN {prefix}messages AS m2 ON (m2.id = lm.last_message_id)
			LEFT JOIN {prefix}conversations AS c ON (c.id = m1.conversation_id)
			WHERE mu.user_id = '%d'
		");

		if ($conversationsIds) {
			$conversationsIdsPlaceholders = implode(', ', array_pad(array(), count($conversationsIds), "'%d'"));
			$query .= " AND m1.conversation_id IN ($conversationsIdsPlaceholders)";
			$queryParams = array_merge($queryParams, $conversationsIds);
		}

		$query .= ' GROUP BY m1.conversation_id, lm.last_message_id ORDER BY lm.last_message_id DESC';

		$conversations = $this->db->get_results(
			$this->db->prepare($query, $queryParams),
			ARRAY_A
		);

		if ($conversations) {

			$conversationsIds = array();

			foreach ($conversations as &$conversation) {
				$conversationId = $conversation['id'];
				$conversationsIds[$conversationId] = array();
				$conversation['users'] = &$conversationsIds[$conversationId];
			}

			$users = $this->getConversationUsers(array_keys($conversationsIds), true);

			foreach ($users as $conversationId => $usersIds) {
				$conversationsIds[$conversationId] = $usersIds;
			}

			$conversations = $this->getUsersProfileData($conversations);
			$blockedUsers = $this->getBlockedUsers($currentUserId);

			foreach ($conversations as &$conversation) {
				if ($conversation['type'] === 'conversation') {
					foreach ($conversation['users'] as &$user) {
						if (in_array($user['id'], $blockedUsers)) {
							$conversation['blocked'] = true;
						}
					}
				}

			}
		}

		return $conversations;
	}

	public function checkUnreadMessages($currentUserId) {

		$query = $this->preparePrefix("
			SELECT 
			    m.conversation_id
			FROM {prefix}messages_users AS mu
			LEFT JOIN {prefix}messages AS m ON (mu.message_id = m.id)
			WHERE mu.user_id = '%d' AND mu.message_state = 'unread'
			GROUP BY m.conversation_id
		");

		$conversations = $this->db->get_col(
			$this->db->prepare($query, $currentUserId)
		);

		if ($conversations) {
			$conversations = $this->getUserConversations($currentUserId, $conversations);
		}

		return $conversations;
	}

	public function getConversationMessages($conversationId, $userId, $limit, $lastMessageId = null, $direction = null) {

		$queryParams = array($conversationId, $userId);

		$query = $this->preparePrefix("
			SELECT 
				m.id,
				m.author_id,
				m.message,
				m.created_at,
				m.conversation_id,
				mu.message_state
			FROM {prefix}messages_users AS mu
			LEFT JOIN {prefix}messages AS m ON (m.id = mu.message_id)
			WHERE m.conversation_id = '%d' AND mu.user_id = '%d'
		");

		if ($lastMessageId) {
			$operator = '>';
			if ((int)$direction === -1) {
				$operator = '<';
			}
			$query .= " AND mu.message_id {$operator} '%d'";
			$queryParams[] = $lastMessageId;
		}

		$query .= " ORDER BY mu.message_id DESC LIMIT %d";
		$queryParams[] = $limit;


		$messages = array_reverse($this->db->get_results(
			$this->db->prepare($query, $queryParams),
			ARRAY_A
		));

		if ($messages) {

			$users = array();

			foreach ($messages as &$message) {
				$users[$message['author_id']] = array();
				$message['author'] = &$users[$message['author_id']];
			}

			$usersModel = $this->getModel('profile', 'users');
			$profiles = $usersModel->getUsersByIds(array('users' => array_keys($users)));

			foreach ($profiles as &$user) {
				$users[$user['id']] = $user;
			}
		}


		return $messages;
	}

	public function getMessageById($messageId, $userId) {

		$queryParams = array($messageId, $userId);

		$query = $this->preparePrefix("
			SELECT 
				m.id,
				m.author_id,
				m.message,
				m.created_at,
				m.conversation_id,
				mu.message_state
			FROM {prefix}messages_users AS mu
			LEFT JOIN {prefix}messages AS m ON (m.id = mu.message_id)
			WHERE m.id = '%d' AND mu.user_id = '%d'
		");

		$messages = $this->db->get_results(
			$this->db->prepare($query, $queryParams),
			ARRAY_A
		);

		if ($messages) {
			$users = array();
			foreach ($messages as &$message) {
				$users[$message['author_id']] = array();
				$message['author'] = &$users[$message['author_id']];
			}

			$usersModel = $this->getModel('profile', 'users');
			$profiles = $usersModel->getUsersByIds(array('users' => array_keys($users)));

			foreach ($profiles as &$user) {
				$users[$user['id']] = $user;
			}
		}

		return $messages;
	}

	private function getUsersProfileData($conversations) {
		$users = array();

		foreach ($conversations as $conversation) {
			$users = array_merge($users, $conversation['users']);
		}

		$users = array_unique($users);
		$usersModel = $this->getModel('profile', 'users');

		if ($users) {
			$users = $usersModel->getUsersByIds(array('users' => $users));
		}

		$_users = array();

		foreach ($users as &$user) {
			$_users[$user['id']] = $user;
		}

		foreach ($conversations as $key => &$conversation) {
			$usersIds = $conversation['users'];
			$conversation['users'] = array();
			foreach($usersIds as $id) {

				/**
				 * In case when user is deleted remove conversation from list
				 **/
				if (!isset($_users[$id])) {
					unset($conversations[$key]);
					continue 2;
				}

			    $user = $_users[$id];
				$conversation['users'][] = $user;
			}
		}

		return $conversations;
	}

	public function deleteConversationMessages($conversationId, $userId, $messages = null)
	{
		$queryParams = array($conversationId, $userId);

		$query = $this->preparePrefix("
			DELETE mu FROM {prefix}messages_users AS mu
			LEFT JOIN {prefix}messages AS m ON (m.id = mu.message_id)
			WHERE m.conversation_id = '%d'
			AND mu.user_id = '%d'
		");

		if ($messages) {

			if (!is_array($messages)) {
				return;
			}

			$queryParams = array_merge($queryParams, $messages);
			$messagesIdsPlaceholder = implode(', ', array_pad(array(), count($messages), "'%d'"));
			$query .= " AND mu.message_id IN ({$messagesIdsPlaceholder})";
		}

		$this->db->query(
			$this->db->prepare($query, $queryParams)
		);
	}

	public function markMessagesAsRead($currentUserId, $conversationId) {

		$query = $this->preparePrefix("
			UPDATE {prefix}messages_users AS mu
			LEFT JOIN {prefix}messages AS m ON (mu.message_id = m.id)
			SET mu.message_state = 'read' 
			WHERE mu.user_id = '%d'
			AND m.conversation_id = '%d'
			AND mu.message_state = 'unread'
		");

		$this->db->query(
			$this->db->prepare($query, array($currentUserId, $conversationId))
		);
	}

	public function getBlockedUsers($currentUserId) {
		return  $this->getData(array(
			"SELECT blocked_user_id FROM {prefix}conversations_users_blocks WHERE user_id = '%d'",
			$currentUserId
		), 'col');
	}

	/**
	 * Get array of user ids who is block requested user
	 * @param $userId
	 *
	 * @return array
	 */
	public function getUsersWhoBlock($userId) {
		return $this->getData(array(
			"SELECT user_id FROM {prefix}conversations_users_blocks WHERE blocked_user_id = '%d'",
			$userId
		), 'col');
	}

    public function blockUser($currentUserId, $blockedUserId) {
        $queryParams = array($currentUserId, $blockedUserId);

        $query = $this->preparePrefix("
			INSERT INTO {prefix}conversations_users_blocks (`user_id`, `blocked_user_id`)
			VALUES ('%d', '%d')
		");

        return $this->db->query($this->db->prepare($query, $queryParams));
    }

    public function unblockUser($currentUserId, $blockedUserId) {
        $queryParams = array($currentUserId, $blockedUserId);

        $query = $this->preparePrefix("
			DELETE 
			FROM {prefix}conversations_users_blocks
			WHERE user_id = '%d' AND blocked_user_id = '%d'
		");

        return $this->db->query($this->db->prepare($query, $queryParams));
    }
}