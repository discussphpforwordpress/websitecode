<?php

class Membership_Forum_Module extends Membership_Base_Module {

	public function __construct(Rsc_Environment $environment, $location, $namespace) {
		parent::__construct($environment, $location, $namespace);
		$this->getDispatcher()->on('settingsModelAliases', array($this, 'registerSettingsModel'));
	}

	public function afterModulesLoaded() {
		if (!class_exists('bbPress')) {
			return;
		}

		/**
		 * Add "Publish to my activity" checkbox to new topic/reply form on dashboard
		 */
		add_action('add_meta_boxes_topic', array($this, 'bbPressPublishToActivityBackend'));
		add_action('add_meta_boxes_reply', array($this, 'bbPressPublishToActivityBackend'));

		/**
		 * Add "Publish to my activity" checkbox to new topic/reply form on frontend
		 */
		add_action('bbp_theme_before_topic_form_submit_wrapper', array($this, 'bbPressPublishToActivityFrontend'));
		add_action('bbp_theme_before_reply_form_submit_wrapper', array($this, 'bbPressPublishToActivityFrontend'));

		/**
		 * bbPress frontend create topic/reply handlers
		 */
		add_action('bbp_new_topic', array($this, 'newTopic'), 10, 4);
		add_action('bbp_new_reply', array($this, 'newReply'), 10, 5);

		/**
		 * bbPress backend create topic/reply handlers
		 */
		add_action('save_post_topic', array($this, 'savePost'));
		add_action('save_post_reply', array($this, 'savePost'));

		$settings = $this->getSettings();

		if (@$settings['forum']['replace-profile-url'] == 'yes') {
			add_filter('bbp_get_user_profile_url',  array($this, 'bbpProfileUrl'), 10, 3);
		}

		$dispatcher = $this->getDispatcher();

		$dispatcher->on('activity.relatedDataPrepare', array($this, 'activityDataPrepare'), 10, 2);
		$dispatcher->on('activity.relatedData', array($this, 'activityData'), 10, 2);
		$dispatcher->on('activity.buildActivitySelectQuery', array($this, 'activityQueryBuild'), 10, 1);
		$dispatcher->on('activity.view.activityTitle', array($this, 'activityTitle'), 10, 1);
		$dispatcher->on('activity.view.activityContent', array($this, 'activityContent'));
		$dispatcher->on('adminAreaMenus', array($this, 'addAdminAreaMenuItem'));
		$dispatcher->on('beforeShortCodeRender', array($this, 'beforeShortCodeRender'), 10, 2);
		$dispatcher->filter('users.profilePagesBeforeRender', array($this, 'profilePagesBeforeRender'), 10, 2);


		$this->getModule('routes')->registerAjaxRoutes(array(

			'forum.saveSettings' => array(
				'method' => 'post',
				'admin' => true,
				'handler' => array($this->getController(), 'saveSettings')
			),

			'forum.getBbPressData' => array(
				'method' => 'get',
				'handler' => array($this->getController(), 'getBbPressForumData')
			),
		));

		$this->getModule('routes')->registerOnRequestAction(array(
				array($this, 'onRequest')
		), $priority = 100);

		if (!$this->isModule('forum')) {
			return;
		}

		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueScripts(
			array(
				$assetsPath . '/js/forum.backend.js',
			)
		);

	}

	public function onRequest($query, $requestedPageId, $routesList) {
		if (!is_admin()) {
			if (@($routesList['profile'] == $requestedPageId)) {
				if (isset($query->query_vars['action']) && $query->query_vars['action'] === 'forum') {
					$this->enqueueAssets();
				}
			}
		}
		return $query;
	}

	public function enqueueAssets() {
		$baseModule = $this->getModule('Base');
		$assetsPath = $this->getAssetsPath();
		$baseAssetsPath = $baseModule->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(),
			array(
				$baseAssetsPath . '/lib/moment/moment.min.js',
				$assetsPath . '/js/forum.frontend.js',
			),
			MBS_FRONTEND
		);
	}

	public function registerSettingsModel($aliases) {
		return array_merge($aliases, array('forum' => $this->getModel('Settings', 'Forum')));
	}

	public function activityTitle($activity) {
		print $this->render('@forum/activity-title.twig', array('activity' => $activity));
	}

	public function activityContent($activity) {
		print $this->render('@forum/activity-content.twig', array('activity' => $activity));
	}

	public function activityQueryBuild($queryParams) {

		$activityModel = $this->getModel('Activity', 'Activity');

		if (isset($queryParams['activityTypes']) && ! in_array(Membership_Activity_Model_Activity::ACTIVITY_TYPE_FORUM, $queryParams['activityTypes'])) {
			return $queryParams;
		}

		global $wpdb;

		$andExistsTopic = "
			AND EXISTS (
				SELECT
	              p.ID
	            FROM {wp_prefix}posts AS p
	            JOIN {wp_prefix}posts AS forum ON (forum.ID = p.post_parent AND forum.post_type = 'forum' AND forum.post_status = 'publish')
	            WHERE p.ID = a.object_id AND p.post_status IN ('publish', 'closed')
			)
		";

		$andExistsReply = "
			AND EXISTS (
				SELECT
	              p.ID
	            FROM {wp_prefix}posts AS p
	            JOIN {wp_prefix}posts AS topic ON (p.post_parent = topic.ID)
                JOIN {wp_prefix}posts AS forum ON (forum.ID = topic.post_parent AND forum.post_type = 'forum' AND forum.post_status = 'publish')
	            WHERE p.ID = a.object_id AND p.post_status = 'publish' AND topic.post_status IN ('publish', 'closed')
			)
		";

		switch ($queryParams['type']) {
			case 'activity':
				array_unshift($queryParams['where'],
					$wpdb->prepare("a.type = 'bbpress_topic' AND a.user_id = '%d' {$andExistsTopic}", $queryParams['requestedUserId']),
					$wpdb->prepare("a.type = 'bbpress_reply' AND a.user_id = '%d' {$andExistsReply}", $queryParams['requestedUserId']),
					"a.type = 'bbpress_topic' AND fs.id IS NOT NULL {$andExistsTopic}",
					"a.type = 'bbpress_reply' AND fs.id IS NOT NULL {$andExistsReply}"
				);
				break;
			case 'profile-activity':
				array_unshift($queryParams['where'],
					$wpdb->prepare("a.type = 'bbpress_topic' AND a.user_id = '%d' {$andExistsTopic}", $queryParams['requestedUserId']),
					$wpdb->prepare("a.type = 'bbpress_reply' AND a.user_id = '%d' {$andExistsReply}", $queryParams['requestedUserId'])
				);
				break;
			case 'activity-guest':
				array_unshift(
					$queryParams['where'],
					"a.type = 'bbpress_topic' {$andExistsTopic}",
					"a.type = 'bbpress_reply' {$andExistsReply}"
				);
				break;
		}

		return $queryParams;
	}

	public function activityDataPrepare($activities, &$data) {

		foreach ($activities as &$activity) {
			switch($activity['type']) {
				case 'bbpress_topic':
					$data['users'][] = $activity['user_id'];
					$data['posts'][] = $activity['object_id'];
					break;
				case 'bbpress_reply':
					$data['users'][] = $activity['user_id'];
					$data['posts'][] = $activity['object_id'];
					$data['posts'][] = $activity['target_id'];
					break;
			}
		}

		return $activities;
	}

	public function activityData($activities, $data) {

		foreach ($activities as &$activity) {
			switch($activity['type']) {
				case 'bbpress_topic':
					$activity['author'] = $data['users'][$activity['user_id']];
					$activity['post'] = $data['posts'][$activity['object_id']];
					break;
				case 'bbpress_reply':
					$activity['author'] = $data['users'][$activity['user_id']];
					$activity['post'] = $data['posts'][$activity['target_id']];
					$activity['post_reply'] = $data['posts'][$activity['object_id']];
					break;
			}
		}

		return $activities;
	}

	public function savePost($postId) {

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $postId;
		}

		$parameters = $this->getRequest()->post;
		$postType = $parameters->get('post_type');

		if ($parameters->has('publish-to-membership-activity')) {

			if ($postType == 'topic') {
				$this->getModel('Activity', 'Activity')
					->createActivity(
						$parameters->get('user_ID'),
						'bbpress_topic',
						'',
						null,
						$parameters->get('post_ID')
					);
			}

			if ($postType == 'reply') {
				$this->getModel('Activity', 'Activity')
					->createActivity(
						$parameters->get('user_ID'),
						'bbpress_reply',
						'',
						$parameters->get('bbp_reply_to'),
						$parameters->get('post_ID'));
			}
		}

		return $postId;
	}

	public function newTopic($topicId, $forumId, $anonymousData, $topicAuthor) {
		$parameters = $this->getRequest()->post;

		if (!empty($anonymousData)) {
			return;
		}

		if ($parameters->has('publish-to-membership-activity')) {
			$this->getModel('Activity', 'Activity')->createActivity($topicAuthor, 'bbpress_topic', '', null, $topicId);
		}
	}

	public function newReply($replyId, $topicId, $forumId, $anonymousData, $replyAuthor) {
		$parameters = $this->getRequest()->post;

		if (!empty($anonymousData)) {
			return;
		}

		if ($parameters->has('publish-to-membership-activity')) {
			$this->getModel('Activity', 'Activity')->createActivity($replyAuthor, 'bbpress_reply', '', $topicId, $replyId);
		}
	}

	public function bbpProfileUrl($link, $userId, $niceName) {
		return $this->getModule('users')->getUserProfileUrl(array(
			'id' => $userId,
			'user_login' => $niceName
		));
	}

	public function addUserProfileMenuItem($menuItems) {
		return array_merge($menuItems, array(
			'forum' => $this->translate('Forum')
		));
	}

	public function profilePagesBeforeRender($renderData, $requestedUser) {

		$settings = $this->getSettings();
		$dispatcher = $this->getDispatcher();


		if (@$settings['forum']['enable-forum-tab'] == 'yes') {

			$rolesWhoCanHaveProfileTab = @$settings['forum']['roles-who-can-have-forum-tab'];

			if ($requestedUser && $rolesWhoCanHaveProfileTab && (in_array('all', $rolesWhoCanHaveProfileTab) || in_array($requestedUser['role_id'], $rolesWhoCanHaveProfileTab))) {
				$dispatcher->on('profileMenuItemsArray', array($this, 'addUserProfileMenuItem'));
			}

			if ($renderData['action'] == 'forum') {
				$requestedUser = $this->getModule('users')->getRequestedUser();
				$requestedUserId = $requestedUser['id'];
				$bbPressModel = $this->getModel('BbPress', 'Forum');
				$started = $bbPressModel->getStartedTopics($requestedUserId, 10);
				$replies = $bbPressModel->getReplies($requestedUserId, 10);
				$favorites = $bbPressModel->getFavorites($requestedUserId, 10);
				$subscriptions = $bbPressModel->getSubscriptions($requestedUserId, 10);
				$counts = $bbPressModel->countForumData($requestedUserId);

				$renderData = array_merge($renderData, array(
					'template' => '@forum/forum.twig',
					'started' => $started,
					'replies' => $replies,
					'favorites' => $favorites,
					'subscriptions' => $subscriptions,
					'counts' => $counts
				));

			}

		} else {
			if ($renderData['action'] == 'forum') {
				$renderData['error'] = $this->translate('This page is disabled by site administrator.');
			}
		}

		return $renderData;
	}

	public function userProfilePage($content, $action) {


	}

	public function bbPressPublishToActivityBackend() {

		$currentScreen = get_current_screen();
		if ($currentScreen->action === 'add') {
			add_meta_box(
				'publish-to-membership-activity',
				$this->translate('Publish to Membership Activity'),
				array($this, 'publishToActivityCheckbox'),
				array('topic', 'reply'),
				'normal',
				'default'
			);
		}

	}

	public function bbPressPublishToActivityFrontend() {

		if (bbp_is_topic_edit() || bbp_is_reply_edit()) {
			return;
		}

		$this->publishToActivityCheckbox();
	}

	public function publishToActivityCheckbox() {
		print '<label><input name="publish-to-membership-activity" type="checkbox" value="true"> ' . $this->translate('Publish to my activity') . '</label>';
	}

	public function addAdminAreaMenuItem($subMenus) {

		$menuItem = array('forum' => array(
			'title' => $this->translate('Forum'),
			'fa_icon' => 'fa fa-comments-o',
			'order' => 90,
			'module' => 'forum',
			'action' => '',
		));

		return array_merge($subMenus, $menuItem);
	}
}