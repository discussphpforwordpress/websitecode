<?php
class Membership_Notifications_Controller extends Membership_Base_Controller {

	public function getNotifications(Rsc_Http_Parameters $parameters) {
		$notificationsModel = $this->getModel();
		$currentUserId = get_current_user_id();
		$limit = min(max($parameters->get('limit', 0), 1), 20);
		$offsetId = $parameters->get('offsetId', null);

		$notifications =  $notificationsModel->getNotifications($currentUserId, $limit, $offsetId);

		return $this->response('ajax', array(
			'success' => true,
			'html' => $this->render('@notifications/partials/notifications.twig', array('notifications' => $notifications))
		));
	}

	public function removeNotification(Rsc_Http_Parameters $parameters) {
		$notificationId = $parameters->get('notificationId');
		$notificationsModel = $this->getModel();
		$currentUserId = get_current_user_id();
		$notification = current($notificationsModel->getNotificationById($notificationId));

		if (!$notification || intval($notification['user_id']) !== $currentUserId) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 405
			));
		}

		$notificationsModel->removeNotification($notificationId);

		return $this->response('ajax',
			array(
				'success' => true,
			)
		);
	}

	public function setViewed(Rsc_Http_Parameters $parameters) {
		$notificationId = $parameters->get('notificationId');
		$notificationsModel = $this->getModel();
		$notificationsModel->setViewed(array($notificationId));

		return $this->response('ajax',
			array(
				'success' => true
			)
		);
	}


	public function setViewedAll() {
		$notificationsModel = $this->getModel();
		$notificationsModel->setViewedAll(get_current_user_id());

		return $this->response('ajax',
			array(
				'success' => true
			)
		);
	}

	public function setViewedAllByType(Rsc_Http_Parameters $parameters){
	    /**
         * @var $notificationModel Membership_Notifications_Model_Notifications
         */
	    $notificationModel = $this->getModel('Notifications', 'Notifications');
	    $type = $parameters->get('type');
	    $groupId = $parameters->get('groupId');

        $setResult = $notificationModel->setViewedTypeGroup(get_current_user_id(), $type, $groupId);
        return $this->response('ajax', array('success' => $setResult));
    }
}