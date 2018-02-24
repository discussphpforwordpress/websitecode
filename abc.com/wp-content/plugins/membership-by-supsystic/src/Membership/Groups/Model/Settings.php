<?php

class Membership_Groups_Model_Settings extends Membership_Base_Model_Settings
{
	protected $settingField = 'groups';

	public function defaultSettings() 
	{
		return array(
			'logo-size' => array(
				'width' => '160',
				'height' => '160',
			),
			'logo-large-size' => array(
				'width' => '100',
				'height' => '100',
			),
			'logo-medium-size' => array(
				'width' => '50',
				'height' => '50',
			),
			'logo-small-size' => array(
				'width' => '32',
				'height' => '32',
			),
			'default-logo' => plugins_url('/assets/images/group.jpg', dirname(__FILE__)),
			// 'logo-thumbnails' => array(
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
			'cover-size' => array(
				'width' => '800',
				'height' => '300',
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
			'default-cover' => plugins_url('/assets/images/group-cover.jpg', dirname(__FILE__)),
			'permalink-base' => 'groupalias'
		);
	}

}