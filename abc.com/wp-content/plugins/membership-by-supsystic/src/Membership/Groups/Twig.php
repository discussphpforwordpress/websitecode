<?php

class Membership_Groups_Twig extends Twig_Extension {

	private $environment;
	private $module;
	private $settings;
	private $usersModule;

	public function __construct($groupsModule) {
		$this->environment = $groupsModule->getEnvironment();
		$this->module = $groupsModule;
		$this->usersModule = $this->environment->getModule('users');
		$this->settings = $groupsModule->getSettings();
	}

	public function getName() {
		return 'Membership_Groups_Twig';
	}

	public function getGlobals()
	{
		return array(

		);
	}

	public function getFunctions()
	{
		return array(
			new Twig_SimpleFunction('groupUrl', array($this->module, 'getGroupUrl')),
			new Twig_SimpleFunction('groupUrlById', array($this->module, 'getGroupUrlById')),
			new Twig_SimpleFunction('groupNameById', array($this->module, 'getGroupNameById')),
			new Twig_SimpleFunction('currentUserHasGroupPermission', array($this->module, 'currentUserHasGroupPermission')),
			new Twig_SimpleFunction('groupCover', array($this, 'groupsCover')),
			new Twig_SimpleFunction('groupLogo', array($this, 'groupsLogo')),
			new Twig_SimpleFunction('canSendJoinRequest', array($this, 'canSendJoinRequest')),
			new Twig_SimpleFunction('canCancelJoinRequest', array($this, 'canCancelJoinRequest')),
			new Twig_SimpleFunction('canJoinGroup', array($this, 'canJoinGroup')),
			new Twig_SimpleFunction('canLeaveGroup', array($this, 'canLeaveGroup')),
			new Twig_SimpleFunction('canUnfollowGroup', array($this, 'canUnfollowGroup')),
			new Twig_SimpleFunction('canFollowGroup', array($this, 'canFollowGroup')),
			new Twig_SimpleFunction('isMemberOfGroup', array($this, 'isMemberOfGroup')),
			new Twig_SimpleFunction('canEditGroup', array($this, 'canEditGroup')),
			new Twig_SimpleFunction('isDefaultGroupLogo', array($this, 'isDefaultGroupLogo')),
			new Twig_SimpleFunction('isDefaultGroupCover', array($this, 'isDefaultGroupCover')),
			new Twig_SimpleFunction('canInviteToGroup', array($this, 'canInviteToGroup')),
            new Twig_SimpleFunction('notReadPost', array($this->module, 'notReadPost'))
		);
	}

	public function getEnvironment() {
		return $this->environment;
	}

	public function groupsCover($group, $size) {
		return $this->getImageByType('cover', $group, $size);
	}

	public function groupsLogo($group, $size) {
		return $this->getImageByType('logo', $group, $size);
	}

	private function getImageByType($type, $group, $size) {

		if ($size && $size !== 'default') {

			$sizes = @$this->settings['groups'][$type . '-' . $size . '-size'];
			$defaultImage = @$this->settings['groups']['default-' . $type . '-' . $size];

			if (!$defaultImage) {
				$defaultImage = @$this->settings['groups']['default-' . $type];
			}

		} else {
			$sizes = @$this->settings['groups'][$type . '-size'];
			$defaultImage = @$this->settings['groups']['default-' . $type];
		}

		if (!$sizes || !isset($group['images'])) {
			return $defaultImage;
		}

		foreach ($group['images'] as $image) {
			if ($image['width'] === $sizes['width'] && $image['height'] === $sizes['height'] && $image['type'] === $type) {
				return $image['source'];
			}
		}

		return $defaultImage;
	}

	public function canSendJoinRequest($group) {
		return $this->isClosedGroup($group) && !$this->isMember($group) && $this->usersModule->currentUserCan('join-groups');
	}

	public function canCancelJoinRequest($group) {
		return $this->isClosedGroup($group) && $this->isMember($group) && !$this->isApproved($group);
	}

	public function canJoinGroup($group) {
		return $this->isOpenGroup($group) && !$this->isMember($group) && $this->usersModule->currentUserCan('join-groups');
	}

	public function canLeaveGroup($group) {
		return $this->isMember($group) && $this->isApproved($group);
	}

	public function canUnfollowGroup($group) {
		return $this->isFollowersActive() && $this->currentUserIsFollowing($group) && $this->isOpenGroup($group);
	}

	public function canFollowGroup($group) {
		return $this->isFollowersActive() && !$this->currentUserIsFollowing($group) && $this->isOpenGroup($group);
	}

	public function isMemberOfGroup($group) {
		return $this->isMember($group);
	}

	private function isOpenGroup($group) {
		return $group['settings']['type'] === 'open';
	}

	private function isClosedGroup($group) {
		return $group['settings']['type'] === 'closed';
	}

	private function isMember($group) {
		return !!$group['currentUserRole'];
	}
	private function isAdmin($group) {
		return $group['currentUserRole'] === 'administrator';
	}

	private function isApproved($group) {
		return !!$group['currentUserApproved'];
	}

	private function isFollowersActive() {
		return @$this->settings['base']['main']['followers'] === 'true';
	}

	private function currentUserIsFollowing($group) {
		return !!$group['currentUserIsFollowing'];
	}

	public function canEditGroup($group) {
		return in_array($group['currentUserRole'], array('administrator'));
	}

	public function isDefaultGroupLogo($group) {
		return $this->getImageByType('logo', $group, 'default') === $this->settings['groups']['default-logo'];
	}

	public function isDefaultGroupCover($group) {
		return $this->getImageByType('cover', $group, 'default') === $this->settings['groups']['default-cover'];
	}

	public function canInviteToGroup($group) {

		if ($group['settings']['invitations'] == 'administrators') {
			return $this->isAdmin($group);
		}

		return $this->isApproved($group);
	}
}