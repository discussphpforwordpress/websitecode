<?php

class Membership_Users_Twig extends Twig_Extension {

	private $environment;
	private $module;
	private $settings;

	public function __construct($usersModule) {
		$this->environment = $usersModule->getEnvironment();
		$this->module = $usersModule;
		$this->settings = $usersModule->getSettings();
	}

	public function getName() {
		return 'Membership_Users_Twig';
	}

	public function getGlobals()
	{
		return array(
			'friendsActive' => @$this->settings['base']['main']['friends'] === 'true',
			'followersActive' => @$this->settings['base']['main']['followers'] === 'true',
			'messagesActive' => @$this->settings['base']['main']['messages'] === 'true',
		);
	}

	public function getFunctions()
	{
		return array(
			new Twig_SimpleFunction('currentUserCan', array($this->module, 'currentUserCan')),
			new Twig_SimpleFunction('currentUserHasPermission', array($this->module, 'currentUserHasPermission')),
			new Twig_SimpleFunction('generateUserField', array($this->module, 'generateUserField')),
			new Twig_SimpleFunction('userCover', array($this, 'userCover')),
			new Twig_SimpleFunction('userAvatar', array($this, 'userAvatar')),
			new Twig_SimpleFunction('profileUrl', array($this, 'profileUrl')),
			new Twig_SimpleFunction('isCurrentUser', array($this, 'isCurrentUser')),
			new Twig_SimpleFunction('isFriendOfCurrentUser', array($this, 'isFriendOfCurrentUser')),
			new Twig_SimpleFunction('currentUserIsFriendOf', array($this, 'currentUserIsFriendOf')),
			new Twig_SimpleFunction('isCurrentUserFollow', array($this, 'isCurrentUserFollow')),
			new Twig_SimpleFunction('isDefaultAvatar', array($this, 'isDefaultAvatar')),
			new Twig_SimpleFunction('isDefaultCover', array($this, 'isDefaultCover')),
			new Twig_SimpleFunction('profileMenuItems', array($this, 'profileMenuItems')),
            new Twig_SimpleFunction('setViewed', array($this->module, 'setViewed'))
		);
	}

	public function getEnvironment() {
		return $this->environment;
	}

	public function isCurrentUser($user) {
		$currentUser = $this->module->getCurrentUser();
		return $user['id'] === $currentUser['id'];
	}

	public function profileUrl($user, $arguments = array()) {
		return $this->module->getUserProfileUrl($user, $arguments);
	}

	public function userCover($user, $size) {
		return $this->getImageByType('cover', $user, $size);
	}

	public function userAvatar($user, $size) {
		return $this->getImageByType('avatar', $user, $size);
	}

	private function getImageByType($type, $user, $size) {

		if ($size && $size !== 'default') {

			$sizes = @$this->settings['profile'][$type . '-' . $size . '-size'];
			$defaultImage = @$this->settings['profile']['default-' . $type . '-' . $size];

			if (!$defaultImage) {
				$defaultImage = @$this->settings['profile']['default-' . $type];
			}

		} else {
			$sizes = @$this->settings['profile'][$type . '-size'];
			$defaultImage = @$this->settings['profile']['default-' . $type];
		}

		if (!$sizes || !isset($user['images'])) {
			return $defaultImage;
		}

		foreach ($user['images'] as $image) {
			if ($image['width'] === $sizes['width'] && $image['height'] === $sizes['height'] && $image['type'] === $type) {
				return $image['source'];
			}
		}

		return $defaultImage;
	}

	public function isDefaultAvatar($user) {
		return $this->getImageByType('avatar', $user, 'default') === $this->settings['profile']['default-avatar'];
	}

	public function isDefaultCover($user) {
		return $this->getImageByType('cover', $user, 'default') === $this->settings['profile']['default-cover'];
	}

	/**
	 * Check if requested user is friend of current logged in user
	 * @param array $user Requested user data
	 *
	 * @return bool
	 */
	public function isFriendOfCurrentUser($user) {
		return (bool) $user['currentUserFriend'];
	}

	/**
	 * Check if current logged in user is follow requested user
	 * @param array $user Requested user data
	 *
	 * @return bool
	 */
	public function isCurrentUserFollow($user) {
		return (bool) $user['isFollowing'];
	}

	/**
	 * Check if current logged in user is friend of requested user
	 * @param array $user Requested user data
	 *
	 * @return bool
	 */
	public function currentUserIsFriendOf($user) {
		return (bool) $user['currentUserIsFriend'];
	}

	public function profileMenuItems() {

		$menuArray = array();

		if (@$this->settings['base']['main']['activity'] === 'true') {
			$menuArray['activity'] = $this->environment->translate('Activity');
		}

		$menuArray['about'] = $this->environment->translate('About');

		if (@$this->settings['base']['main']['groups'] === 'true') {
			$menuArray['groups'] = $this->environment->translate('Groups');
		}

		if (@$this->settings['base']['main']['friends'] === 'true') {
			$menuArray['friends'] = $this->environment->translate('Friends');
		}

		if (@$this->settings['base']['main']['followers'] === 'true') {
			$menuArray['followers'] = $this->environment->translate('Followers');
		}

		if(!empty($this->settings['base']['main']['favorites']) && $this->settings['base']['main']['favorites'] === 'true') {
			$menuArray['favorites'] = $this->environment->translate('Favorites');
		}

		if ($this->isCurrentUser($this->module->getRequestedUser()) && @$this->settings['base']['main']['messages'] === 'true') {
			$menuArray['messages'] = $this->environment->translate('Messages');
		}

		if (@$this->settings['base']['main']['posts'] === 'true') {
			$menuArray['posts'] = $this->environment->translate('Posts');
		}

		if (@$this->settings['base']['main']['comments'] === 'true') {
			$menuArray['comments'] = $this->environment->translate('Comments');
		}

		if (@$this->settings['base']['main']['forum'] === 'true') {
			$menuArray['forum'] = $this->environment->translate('Forum');
		}

		return $this->getEnvironment()->getDispatcher()->applyFilters('profileMenuItemsArray', $menuArray);
	}

}