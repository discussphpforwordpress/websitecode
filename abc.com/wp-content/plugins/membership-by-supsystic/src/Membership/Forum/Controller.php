<?php
class Membership_Forum_Controller extends Membership_Base_Controller {

	public function indexAction(Rsc_Http_Request $request) {

		$settings = $this->getModel('Settings', 'Forum')->getSettings();
		$rolesModel = $this->getModel('Roles', 'Roles');
		$roles = $rolesModel->getRoles();

		return $this->response(
			'@forum/backend/index.twig',
			array(
				'settings' => $settings,
				'roles' => $roles
			)
		);
	}

	public function saveSettings($request) {
		$settings = $request->get('settings');
		$this->getModel('Settings', 'Forum')->saveSettings($settings);
	}

	public function getBbPressForumData($request) {
		$userId = $request->get('userId');
		$dataType = $request->get('listType');
		$offsetId = $request->get('offsetId');
		$bbPressModel = $this->getModel('BbPress', 'Forum');

		$template = '';
		$entries = array();

		switch ($dataType) {
			case 'topics':
				$template = '@forum/partials/topics.twig';
				$entries = $bbPressModel->getStartedTopics($userId, 10, $offsetId);
				break;
			case 'replies':
				$template = '@forum/partials/replies.twig';
				$entries = $bbPressModel->getReplies($userId, 10, $offsetId);
				break;
			case 'favorites':
				$template = '@forum/partials/topics.twig';
				$entries = $bbPressModel->getFavorites($userId, 10, $offsetId);
				break;
			case 'subscriptions':
				$template = '@forum/partials/topics.twig';
				$entries = $bbPressModel->getSubscriptions($userId, 10, $offsetId);
				break;
		}

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render(
					$template,
					array(
						'entries' => $entries,
					)
				),
			)
		);

	}
}