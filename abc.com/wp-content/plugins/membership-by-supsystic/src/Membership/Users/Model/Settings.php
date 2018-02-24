<?php

class Membership_Users_Model_Settings extends Membership_Base_Model_Settings {
	protected $settingField = 'profile';

	public function defaultSettings() {
		return array(
			'use-avatar' => 'yes',
			'use-gravatar' => 'yes',
			'avatar-size' => array(
				'width' => '160',
				'height' => '160',
			),
			'avatar-large-size' => array(
				'width' => '100',
				'height' => '100',
			),
			'avatar-medium-size' => array(
				'width' => '50',
				'height' => '50',
			),
			'avatar-small-size' => array(
				'width' => '32',
				'height' => '32',
			),
			// 'avatar-thumbnails' => array(
			// 	array(
			// 		'width' => '100',
			// 		'height' => '100'
			// 	),
			// 	array(
			// 		'width' => '50',
			// 		'height' => '50'
			// 	),
			// 	array(
			// 		'width' => '32',
			// 		'height' => '32'
			// 	),
			// 	array(
			// 		'width' => '20',
			// 		'height' => '20'
			// 	),
			// ),
			'default-avatar' => plugins_url('/assets/images/user.jpg', dirname(__FILE__)),
			'use-cover' => 'yes',
			'cover-size' => array(
				'width' => '1000',
				'height' => '375',
			),
            'cover-medium-size' => array(
                'width' => '399',
                'height' => '150',
            ),
			'cover-small-size' => array(
				'width' => '300',
				'height' => '113',
			),
			// 'cover-thumbnails' => array(
			// 	array(
			// 		'width' => '300',
			// 		'height' => '113'
			// 	),
			// ),
			'default-cover' => plugins_url('/Groups/assets/images/group-cover.jpg', dirname(dirname(__FILE__))),
			'permalink-base' => 'username',
			'display-name' => 'firstname-lastname',
			'default-role' => '2',
			'redirect-to-profile' => 'true',
			'registration-confirmation' => 'auto',
            'password-reset-email' => 'no',
			// 'enable-posts-tab' => 'true',
			// 'enable-comments-tab' => 'true',
			// 'enable-friends-tab' => 'true',
			// 'enable-reviews-tab' => 'true',
			// 'enable-followers-tab' => 'true',
            'default-user-status' => Membership_Users_Model_Fields::STATUS_ACTIVE,
			'allow-users-setup-privacy-settings' => 'yes'
		);
	}
}