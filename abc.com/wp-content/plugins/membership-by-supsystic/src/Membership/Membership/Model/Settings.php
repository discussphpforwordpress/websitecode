<?php

class Membership_Membership_Model_Settings extends Membership_Base_Model_Settings
{
	protected $field = 'main';

	public function defaultSettings() 
	{
		return  array(
			'main' => array(
				'admin-email' => get_bloginfo('admin_email'),
                'activity' => 'true',
				'friends' => 'true',
				'followers' => 'true',
				'messages' => 'true',
				'messages-send' => 'everyone',
				'posts' => 'true',
				'comments' => 'true',
				'comments-available' => 'everyone',
				'user-rating' => 'true',
				'rating-can-write' => 'everyone',
				'groups' => 'true',
				'groups-content-view' => 'everyone',
				'group-creation' => 'everyone',
				'write-to-group' => 'everyone',
				'after-registration-action' => 'redirect-to-profile',
				'after-registration-redirect-url' => '',
				'after-login-action' => 'redirect-to-profile',
				'after-login-action-redirect-url' => '',
				'after-logout-action' => 'redirect-to-main',
				'after-logout-action-redirect-url' => '',
				'after-delete-account-action' => 'redirect-to-main',
				'after-delete-account-redirect-url' => '',
			),
			'security' => array(
				'global-site-access' => 'everyone',
				'protect-all-pages' => 'no',
				'backend-login-screen-redirect' => 'no',
				'whitelisted-ip' => '',
				'blocked-ip' => '',
				'blocked-emails' => '',
				'blacklist-words' => '',
			),
			'uploads' => array(
				'max-image-size' => array(
					'width' => '1000',
					'height' => '1000',
				),
				'max-file-size' => $this->maxFileUploadSize(),
				'image-quality' => '100',
			),
			'seo' => array(
				'profile-title' => '{display_name} | Membership',
				'profile-description' => '{display_name} is on {site_name}. Join {site_name} to view {display_name}\'s profile',
				'group-title' => '{group_name} | Membership',
				'group-description' => '{group_name} | {group_description}.',
			)
		);
	}


	private function maxFileUploadSize() 
	{

		$maxUpload = $this->convertToBytes(ini_get('upload_max_filesize'));
		$maxPost = $this->convertToBytes(ini_get('post_max_size'));
		$memoryLimit = $this->convertToBytes(ini_get('memory_limit'));

		$size = min($maxUpload, $maxPost, $memoryLimit);
		return $size;
	}


	private function convertToBytes($value)
	{
		$value = trim($value);
		$last = strtolower($value[strlen($value) - 1]);
		$value = intval($value);

		switch($last) {
			case 'p':
				$value *= 1024;
			case 't':
				$value *= 1024;
			case 'g':
				$value *= 1024;
			case 'm':
				$value *= 1024;
			case 'k':
				$value *= 1024;
		}

		return $value;
	}
}