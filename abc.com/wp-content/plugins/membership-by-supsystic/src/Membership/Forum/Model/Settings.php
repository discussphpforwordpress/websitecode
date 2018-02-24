<?php

class Membership_Forum_Model_Settings extends Membership_Base_Model_Settings {

	protected $settingField = 'forum';

	public function defaultSettings() {
		return array(
			'replace-profile-url' => 'no',
			'enable-forum-tab' => 'yes',
			'roles-who-can-have-forum-tab' => array('all')
		);
	}
}