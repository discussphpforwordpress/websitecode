<?php

class Membership_Messages_Controller extends Membership_Base_Controller
{

	public function sendMessageToUser(Rsc_Http_Parameters $parameters)
	{
		$recipientId = $parameters->get('userId', null);

		if (!$recipientId) {
			return $this->response(
				'ajax',
				array(
					'success' => false,
				)
			);
		}

		$currentUserId = get_current_user_id();
		$parameters->add('users', array($currentUserId, $recipientId));
		$parameters->add('private', true);

		$mailModule = $this->getModule('Mail');
		$mailRes = $mailModule->sendMessageNotification(array(
			'user-from' => $currentUserId,
			'user-to' => $recipientId,
		));

		return $this->createConversation($parameters);
	}

	public function sendMessage(Rsc_Http_Parameters $parameters) {
		$message = $parameters->get('message');
		$currentUserId = get_current_user_id();
		$conversationId = $parameters->get('conversationId');
		$usersModule = $this->getModule('users');

		$conversationModel = $this->getModel('Conversation');
		$users = $conversationModel->getConversationUsers($conversationId, true);

		$_users = $usersModule->getModel('profile')->getUsersByIds(array('users' => $users));

		foreach ($_users as $user) {
			if (!$usersModule->userCan($user, 'send-and-receive-messages')) {

				return $this->response(
					'ajax',
					array(
						'success' => false,
						'message' => $this->translate('Some of requested users cannot receive or send messages')
					)
				);
			}
		}

		if (in_array($currentUserId, $users)) {

			$addMessage = $conversationModel->addMessage($message, $currentUserId, $conversationId);

			if (!$addMessage['isSent']) {
				return $this->response(
					'ajax',
					array(
						'success' => false,
						'message' => $addMessage['error']
					)
				);
			}

			// save attachments
			$attachmentArr = $parameters->get('attachments', array());
			$attachmentAllModel = $this->getModule('Messages')->getModel('MessageAttachments');
			$saveAttachmentRes = $attachmentAllModel->saveAttachmentForMessage(array(
				'attachment_all_id' => $attachmentArr,
				'message_id' => (int) $addMessage['messageId'],
			));

			$messages = $conversationModel->getMessageById($addMessage['messageId'], $currentUserId);
			// add attachments to messages
			$attachmentAllModel->addAttachmentToMessageArray($messages);

			return $this->response(
				'ajax',
				array(
					'success' => true,
					'attachmentErr' => (!$saveAttachmentRes) ? $this->translate('Message attachment save error!') : null,
					'html' => $this->render('@messages/partials/messages.twig', array(
						'messages' => $messages,
						'attachmentIcon' => $usersModule->getUsersModuleUrl() . '/assets/images/attachment_icon.png',
					))
				)
			);

		}

	}

	public function getMessages(Rsc_Http_Parameters $parameters) 
	{
		$conversationModel = $this->getModel('Conversation');
		$conversationId = $parameters->get('conversationId');
		$limit = min(max($parameters->get('limit', 0), 1), 50);
		$lastMessageId = $parameters->get('lastMessageId');
		$direction = $parameters->get('direction', 1);
		$currentUserId = get_current_user_id();
		$messages = $conversationModel->getConversationMessages($conversationId, $currentUserId, $limit, $lastMessageId, $direction);
		$usersModule = $this->getModule('users');
		$attachmentAllModel = $this->getModule('Messages')->getModel('MessageAttachments');
		$attachmentAllModel->addAttachmentToMessageArray($messages);

		if ($messages) {
			$conversationModel->markMessagesAsRead($currentUserId, $conversationId);
		}

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render('@messages/partials/messages.twig', array(
					'messages' => $messages,
					'attachmentIcon' => $usersModule->getUsersModuleUrl() . '/assets/images/attachment_icon.png',
				)),
			)
		);
	}

	public function checkUnreadMessages(Rsc_Http_Parameters $parameters)
	{
		$currentUserId = get_current_user_id();
		$conversationModel = $this->getModel('Conversation');
		$conversations = $conversationModel->checkUnreadMessages($currentUserId);

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'conversations' => $conversations,
				'html' => array(
					'conversationListItems' => $this->getTwig()->render('@messages/partials/conversations-list.twig', array('conversations' => $conversations)),
					'conversations' => $this->getTwig()->render('@messages/partials/conversations.twig', array('conversations' => $conversations))
				),
			)
		);
	}

	public function deleteMessages(Rsc_Http_Parameters $parameters) 
	{
		$conversationModel = $this->getModel('Conversation');
		$conversationId = $parameters->get('conversationId');
		$messages = $parameters->get('messages');
		$currentUserId = get_current_user_id();
		$conversationModel->deleteConversationMessages($conversationId, $currentUserId, $messages);

		return $this->response(
			'ajax',
			array(
				'success' => true,
			)
		);
	}

	public function createConversation(Rsc_Http_Parameters $parameters)
	{
		$conversationModel = $this->getModel('Conversation');
		$currentUserId = get_current_user_id();
		$message = $parameters->get('message');
		$_users = $parameters->get('users');
		$usersModule = $this->getModule('users');

		if (!array_filter($_users) || !is_array($_users)) {
			return $this->response(
				'ajax',
				array(
					'success' => false,
				)
			);
		}

		$users = array();

		foreach ($_users as $user) {
			$users[] = (int) $user;
		}

		if (!in_array($currentUserId, $users) || (in_array($currentUserId, $users) && count($users) === 1)) {
			array_splice($users, 0, 0, $currentUserId);
		}

		$_users = $usersModule->getModel('profile')->getUsersByIds(array('users' => $users));
		$usersCount = count($users);

		foreach ($_users as $user) {
			if (!$usersModule->userCan($user, 'send-and-receive-messages')) {

				return $this->response(
					'ajax',
					array(
						'success' => false,
						'message' => $this->translate('Some of requested users cannot receive or send messages')
					)
				);
			}

			if ($usersCount === 2 && $user['id'] !== $currentUserId) {
				if (!$usersModule->currentUserHasPermission('send-messages', $user)) {
					return $this->response(
						'ajax',
						array(
							'success' => false,
							'message' => $this->translate('Sending message to this user is restricted by his privacy settings')
						)
					);
				};
			}

		}

		if ($usersCount === 2) {
			$conversation = $conversationModel->getConversationDialog($currentUserId, end($users));
			if ($conversation) {
				$conversationId = $conversation['id'];
				if ($parameters->get('private')) {
					$this->getDispatcher()->dispatch('messages.privateMessage', array($users[0], $users[1], $conversationId));
				}
			} else {
				$conversationId = $conversationModel->createConversation($currentUserId, $users);
			}
		} else {
			$conversationId = $conversationModel->createConversation($currentUserId, $users, 'composed-conversation');
		}


		$addMessage = $conversationModel->addMessage($message, $currentUserId, $conversationId);

		if (!$addMessage['isSent']) {
			return $this->response(
				'ajax',
				array(
					'success' => false,
					'message' => $addMessage['error'],
				)
			);
		}

		$conversations = $conversationModel->getUserConversations($currentUserId, array($conversationId));
		$error = $conversationModel->getError();

		if ($error) {
			return $this->response(
				'ajax',
				array(
					'success' => false,
					'message' => $error,
				)
			);
		}

		$attachmentArr = $parameters->get('attachments', array());
		$attachmentAllModel = $this->getModule('Messages')->getModel('MessageAttachments');
		$saveAttachmentRes = $attachmentAllModel->saveAttachmentForMessage(array(
			'attachment_all_id' => $attachmentArr,
			'message_id' => (int) $addMessage['messageId'],
		));

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'attachmentErr' => (!$saveAttachmentRes) ? $this->translate('Message attachment save error!') : null,
				'html' => array(
					'conversationListItem' => $this->getTwig()->render('@messages/partials/conversations-list.twig', array('conversations' => $conversations)),
					'conversationMessages' => $this->getTwig()->render('@messages/partials/conversations.twig', array('conversations' => $conversations))
				),
			)
		);
	}

	public function deleteConversation(Rsc_Http_Parameters $parameters) {

		$conversationModel = $this->getModel('Conversation');
		$currentUserId = get_current_user_id();
		$conversationId = $parameters->get('conversationId');
		$conversationModel->deleteConversationMessages($conversationId, $currentUserId);
		return $this->response(
			'ajax',
			array(
				'success' => true
			)
		);
	}

    public function blockUser(Rsc_Http_Parameters $parameters)
    {
        $userId = $parameters->get('userId');
        $currentUserId = get_current_user_id();
        $conversationModel = $this->getModel('Conversation');

        if (!in_array($userId, $conversationModel->getBlockedUsers($currentUserId))) {
            $result = $conversationModel->blockUser($currentUserId, $userId);
            $message = $this->translate('User blocked');
        } else {
            $result = false;
            $message = $this->translate('User already blocked');
        }

        return $this->response(
            'ajax',
            array(
                'success' => $result,
                'message' => $message
            )
        );
    }

    public function unblockUser(Rsc_Http_Parameters $parameters)
    {
        $userId = $parameters->get('userId');
        $currentUserId = get_current_user_id();
	    $conversationModel = $this->getModel('Conversation');

	    if (in_array($userId, $conversationModel->getBlockedUsers($currentUserId))) {
		    $result = $conversationModel->unblockUser($currentUserId, $userId);
		    $message = $this->translate('User unblocked');
	    } else {
		    $result = false;
		    $message = $this->translate('User is not blocked');
	    }

        return $this->response(
            'ajax',
            array(
                'success' => $result,
                'message' => $message
            )
        );
    }

}