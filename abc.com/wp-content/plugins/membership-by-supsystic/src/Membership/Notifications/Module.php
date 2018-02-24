<?php

class Membership_Notifications_Module extends Membership_Base_Module {

	public function afterModulesLoaded() {
		$this->registerAjaxRoutes();
		$dispatcher = $this->getDispatcher();
		$dispatcher->on('users.addToFollowers', array($this, 'addToFollowers'), 10, 2);
		$dispatcher->on('users.addToFriends', array($this, 'addToFriends'), 10, 2);
		$dispatcher->on('groups.inviteUser', array($this, 'groupInvite'), 10, 3);
		$dispatcher->on('messages.createConversation', array($this, 'newConversation'), 10, 4);
		$dispatcher->on('messages.privateMessage', array($this, 'privateMessage'), 10, 3);
	}

	public function registerAjaxRoutes() {
		$routesModule = $this->getModule('routes');
		$routesModule->registerAjaxRoutes(array(
			'notifications.get' => array(
				'method' => 'get',
				'handler' => array($this->getController(), 'getNotifications')
			),
			'notifications.remove' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'removeNotification')
			),
			'notifications.setViewed' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'setViewed')
			),
			'notifications.setViewedAll' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'setViewedAll')
			),
			'notifications.saveUserSettings' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'saveUserSettings')
			),
            'notifications.setViewedAllByType' => array(
                'method' => 'post',
                'handler' => array($this->getController(), 'setViewedAllByType')
            ),
		));
	}

	public function addToFollowers($currentUserId, $requestedUserId) {
		$notificationsModel = $this->getModel('Notifications', 'Notifications');
		$usersModel = $this->getModel('Profile', 'Users');
		$requestedUser = $usersModel->getUserById($requestedUserId);

		if (@$requestedUser['notifications']['follows'] == 'on') {
			$notificationsModel->createNotification(
				$requestedUserId,
				'follow',
				$currentUserId
			);
		}
	}

	public function addToFriends($currentUserId, $requestedUserId) {
		$notificationsModel = $this->getModel('Notifications', 'Notifications');

		$usersModel = $this->getModel('Profile', 'Users');
		$requestedUser = $usersModel->getUserById($requestedUserId);

		if (@$requestedUser['notifications']['friend-requests'] == 'on') {

			if ($requestedUser['currentUserIsFriend']) {
				$notificationsModel->createNotification(
					$requestedUserId,
					'friendship_accept',
					$currentUserId
				);
			} else {
				$notificationsModel->createNotification(
					$requestedUserId,
					'friendship_request',
					$currentUserId
				);
			}
		}
	}

	public function groupInvite($groupId, $invitedUserId, $invitedByUserId) {
		$notificationsModel = $this->getModel('Notifications', 'Notifications');

		$notificationsModel->createNotification(
			$invitedUserId,
			'groups_invite',
			$invitedByUserId,
			$groupId
		);
	}

	public function newConversation($createdByUserId, $usersIds, $type, $conversationId) {
		$notificationsModel = $this->getModel('Notifications', 'Notifications');
		$usersModel = $this->getModel('Profile', 'Users');

		$users = $usersModel->getUsersByIds(array('users' => $usersIds));

		foreach ($users as $user) {
			if ($user['id'] !== $createdByUserId && $user['notifications']['messages'] == 'on') {
				$notificationsModel->createNotification(
					$user['id'],
					'message',
					$createdByUserId
				);
			}
		}
	}

	public function privateMessage($senderId, $recipientId, $conversationId) {
		$notificationsModel = $this->getModel('Notifications', 'Notifications');
		$usersModel = $this->getModel('Profile', 'Users');
		$recipient = $usersModel->getUserById($recipientId);

		if (@$recipient['notifications']['messages'] == 'on') {
			$notificationsModel->createNotification(
				$recipientId,
				'message',
				$senderId
			);
		}
	}

	public function enqueueNotificationsAssets() {
		$assetsPath = $this->getAssetsPath();
		$baseModule = $this->getModule('Base');
		$baseAssetsPath = $baseModule->getAssetsPath();
		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/notifications.frontend.css',

			),
			array(
				$baseAssetsPath . '/lib/moment/moment.min.js',
				$baseAssetsPath . '/lib/moment/locales.min.js',
				$assetsPath . '/js/notifications.frontend.js',
			),
			MBS_FRONTEND
		);
	}
}