<?php
/**
 * Register Globals - Signs
 */


// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die;	


/**
 * Sign types
 */	

$test_plugin['sign_types'] = array ( 
	array( 
		'name' => __( 'None', 'test_plugin_textdomain' ),
		'id' => ''
	),
	array( 
		'name' => __( 'Text Sign', 'test_plugin_textdomain' ),
		'id' => 'text'
	),	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Image Signs', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array( 
				'name' => '++ ' . __( 'Custom (upload)', 'test_plugin_textdomain' ),
				'id' => 'custom-img'
			),				
			array( 
				'name' => __( 'Clean Ribbon', 'test_plugin_textdomain' ),
				'id' => 'clean-ribbon'
			),
			array( 
				'name' => __( 'Clean Wavy Ribbon', 'test_plugin_textdomain' ),
				'id' => 'clean-wribbon'
			),	
			array( 
				'name' => __( 'Classic Ribbon', 'test_plugin_textdomain' ),
				'id' => 'classic-ribbon'
			),	
			array( 
				'name' => __( 'Clean Badge', 'test_plugin_textdomain' ),
				'id' => 'clean-badge'
			),
			array( 
				'name' => __( 'Clean Wavy Badge', 'test_plugin_textdomain' ),
				'id' => 'clean-wbadge'
			),
			array( 
				'name' => __( 'Clean Tag', 'test_plugin_textdomain' ),
				'id' => 'clean-tag'
			),	
			array( 
				'name' => __( 'Paperclip', 'test_plugin_textdomain' ),
				'id' => 'paperclip'
			),
			array( 
				'name' => __( 'Tape', 'test_plugin_textdomain' ),
				'id' => 'tape'
			),											
		)												
	)			
);

// Sign types filter
$test_plugin['sign_types'] = apply_filters( 'test_plugin_sign_types', $test_plugin['sign_types'] );


/**
 * Signs
 */
 
// Text ribbons sign
$test_plugin['signs']['text'] = array (						
		array(
			'name' => 'Ribbon',
			'value' => 'ribbon', 
		)																		
);

// Clean ribbons sign
$test_plugin['signs']['clean-ribbon'] = array (						
	array(
		'group_name' => sprintf( '-- %s --', __( 'Blue', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_blue_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_blue_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_blue_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_blue_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_blue_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_blue_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_blue_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_blue_right_top.png'
			)								
		)												
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Green', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_green_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_green_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_green_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_green_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_green_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_green_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_green_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_green_right_top.png'
			)								
		)												
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Grey', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-grey-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_grey_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-grey-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_grey_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-grey-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_grey_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-grey-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_grey_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-grey-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_grey_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-grey-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_grey_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-grey-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_grey_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-grey-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_grey_right_top.png'
			)								
		)												
	),	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Purple', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-purple-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_purple_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-purple-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_purple_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-purple-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_purple_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-purple-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_purple_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-purple-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_purple_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-purple-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_purple_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-purple-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_purple_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-purple-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_purple_right_top.png'
			)								
		)												
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Red', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_red_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_red_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_red_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_red_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_red_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_red_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_red_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_red_right_top.png'
			)								
		)												
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Yellow', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_yellow_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_yellow_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_yellow_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_yellow_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_yellow_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_yellow_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_yellow_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean/ribbon_yellow_right_top.png'
			)								
		)												
	)	
);

// Clean ribbons sign filter
$test_plugin['signs']['clean-ribbon'] = apply_filters( 'test_plugin_sign_clean_ribbon', $test_plugin['signs']['clean-ribbon'] );


// Clean wavy ribbons sign
$test_plugin['signs']['clean-wribbon'] = array (						
	array(
		'group_name' => sprintf( '-- %s --', __( 'Blue', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_blue_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_blue_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_blue_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_blue_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_blue_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_blue_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_blue_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_blue_right_top.png'
			)								
		)												
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Green', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_green_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_green_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_green_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_green_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_green_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_green_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_green_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_green_right_top.png'
			)								
		)												
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Grey', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-grey-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_grey_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-grey-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_grey_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-grey-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_grey_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-grey-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_grey_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-grey-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_grey_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-grey-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_grey_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-grey-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_grey_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-grey-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_grey_right_top.png'
			)								
		)												
	),	
	array(
		'group_name' => sprintf( '-- %s --', __( 'Purple', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-purple-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_purple_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-purple-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_purple_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-purple-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_purple_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-purple-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_purple_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-purple-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_purple_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-purple-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_purple_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-purple-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_purple_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-purple-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_purple_right_top.png'
			)								
		)												
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Red', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_red_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_red_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_red_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_red_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_red_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_red_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_red_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_red_right_top.png'
			)								
		)												
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Yellow', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_yellow_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_yellow_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_yellow_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_yellow_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_yellow_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_yellow_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_yellow_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/clean_wavy/wribbon_yellow_right_top.png'
			)								
		)												
	)	
);

// Clean wavy ribbons sign filter
$test_plugin['signs']['clean-wribbon'] = apply_filters( 'test_plugin_sign_clean_wribbon', $test_plugin['signs']['clean-wribbon'] );


// Classic ribbons sign
$test_plugin['signs']['classic-ribbon'] = array (						
	array(
		'group_name' => sprintf( '-- %s --', __( 'Blue', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_blue_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_blue_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_blue_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_blue_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_blue_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_blue_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-blue-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_blue_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-blue-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_blue_right_top.png'
			)								
		)												
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Green', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_green_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_green_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_green_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_green_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_green_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_green_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-green-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_green_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-green-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_green_right_top.png'
			)								
		)												
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Red', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_red_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_red_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_red_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_red_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_red_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_red_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-red-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_red_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-red-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_red_right_top.png'
			)								
		)												
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Yellow', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_yellow_left_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-50', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_yellow_right_50.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_yellow_left_new.png'
			),
			array(
				'name' => 'New (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-new', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_yellow_right_new.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_yellow_left_save.png'
			),
			array(
				'name' => 'Save (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-save', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_yellow_right_save.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'left-yellow-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_yellow_left_top.png'
			),
			array(
				'name' => 'Top (' . sprintf( __( '%s side', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'right-yellow-top', 
				'data' => $this->plugin_url . 'assets/images/signs/ribbons/classic/ribbon_yellow_right_top.png'
			)								
		)												
	)											
);

// Classic ribbons sign filter
$test_plugin['signs']['classic-ribbon'] = apply_filters( 'test_plugin_sign_classic_ribbon', $test_plugin['signs']['classic-ribbon'] );


// Clean badges sign
$test_plugin['signs']['clean-badge'] = array (						
	array(
		'group_name' => sprintf( '-- %s --', __( 'Blue', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => 'Join Now',
				'value' => 'blue-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_blue_join_now.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'blue-left-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_blue_left_join_now_15.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'blue-right-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_blue_right_join_now_15.png'
			)							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Green', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => 'Join Now',
				'value' => 'green-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_green_join_now.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'green-left-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_green_left_join_now_15.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'green-right-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_green_right_join_now_15.png'
			)							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Grey', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => 'Join Now',
				'value' => 'grey-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_grey_join_now.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'grey-left-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_grey_left_join_now_15.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'grey-right-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_grey_right_join_now_15.png'
			)							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Purple', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => 'Join Now',
				'value' => 'purple-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_purple_join_now.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'purple-left-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_purple_left_join_now_15.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'purple-right-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_purple_right_join_now_15.png'
			)							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Red', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => 'Join Now',
				'value' => 'red-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_red_join_now.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'red-left-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_red_left_join_now_15.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'red-right-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_red_right_join_now_15.png'
			)
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Yellow', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => 'Join Now',
				'value' => 'yellow-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_yellow_join_now.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'yellow-left-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_yellow_left_join_now_15.png'
			),
			array(
				'name' => 'Join Now (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'yellow-right-join-now', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean/badge_yellow_right_join_now_15.png'
			)							
		)																					
	)
);

// Clean badges sign filter
$test_plugin['signs']['clean-badge'] = apply_filters( 'test_plugin_sign_clean_badge', $test_plugin['signs']['clean-badge'] );


// Clean wawy badges sign
$test_plugin['signs']['clean-wbadge'] = array (						
	array(
		'group_name' => sprintf( '-- %s --', __( 'Blue', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50%',
				'value' => 'blue-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_blue_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'blue-left-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_blue_left_50_15.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'blue-right-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_blue_right_50_15.png'
			)							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Green', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50%',
				'value' => 'green-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_green_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'green-left-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_green_left_50_15.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'green-right-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_green_right_50_15.png'
			)							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Grey', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50%',
				'value' => 'grey-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_grey_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'grey-left-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_grey_left_50_15.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'grey-right-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_grey_right_50_15.png'
			)							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Purple', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50%',
				'value' => 'purple-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_purple_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'purple-left-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_purple_left_50_15.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'purple-right-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_purple_right_50_15.png'
			)							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Red', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50%',
				'value' => 'red-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_red_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'red-left-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_red_left_50_15.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'red-right-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_red_right_50_15.png'
			)
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Yellow', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => '50%',
				'value' => 'yellow-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_yellow_50.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'left' ) . ')',
				'value' => 'yellow-left-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_yellow_left_50_15.png'
			),
			array(
				'name' => '50% (' . sprintf( __( '15%% %s', 'test_plugin_textdomain' ), 'right' ) . ')',
				'value' => 'yellow-right-50', 
				'data' => $this->plugin_url . 'assets/images/signs/badges/clean_wavy/wbadge_yellow_right_50_15.png'
			)							
		)																					
	)
);

// Clean wavy badges sign filter
$test_plugin['signs']['clean-wbadge'] = apply_filters( 'test_plugin_sign_clean_wbadge', $test_plugin['signs']['clean-wbadge'] );


// Clean tags sign
$test_plugin['signs']['clean-tag'] = array (						
	array(
		'name' => 'Blue New',
		'value' => 'blue-new', 
		'data' => $this->plugin_url . 'assets/images/signs/tags/tag_blue_new.png'
	),
	array(
		'name' => 'Green New',
		'value' => 'green-new', 
		'data' => $this->plugin_url . 'assets/images/signs/tags/tag_green_new.png'
	),
	array(
		'name' => 'Grey New',
		'value' => 'grey-new', 
		'data' => $this->plugin_url . 'assets/images/signs/tags/tag_grey_new.png'
	),
	array(
		'name' => 'Purple New',
		'value' => 'purple-new', 
		'data' => $this->plugin_url . 'assets/images/signs/tags/tag_purple_new.png'
	),
	array(
		'name' => 'Red New',
		'value' => 'red-new', 
		'data' => $this->plugin_url . 'assets/images/signs/tags/tag_red_new.png'
	),
	array(
		'name' => 'Yellow New',
		'value' => 'yellow-new', 
		'data' => $this->plugin_url . 'assets/images/signs/tags/tag_yellow_new.png'
	)				
);

// Clean tags sign filter
$test_plugin['signs']['clean-tag'] = apply_filters( 'test_plugin_sign_clean_tag', $test_plugin['signs']['clean-tag'] );


// Paperclips sign
$test_plugin['signs']['paperclip'] = array (									
	array(
		'group_name' => sprintf( '-- %s --', __( 'Blue', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => __( 'Straight', 'test_plugin_textdomain' ),
				'value' => 'blue-straight', 
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_blue.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Left' ),
				'value' => 'blue-left',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_blue_left.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Right' ),
				'value' => 'blue-right',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_blue_right.png'
			),							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Green', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => __( 'Straight', 'test_plugin_textdomain' ),
				'value' => 'green-straight', 
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_green.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Left' ),
				'value' => 'green-left',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_green_left.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Right' ),
				'value' => 'green-right',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_green_right.png'
			),							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Grey', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => __( 'Straight', 'test_plugin_textdomain' ),
				'value' => 'grey-straight', 
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_grey.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Left' ),
				'value' => 'grey-left',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_grey_left.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Right' ),
				'value' => 'grey-right',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_grey_right.png'
			),							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Purple', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => __( 'Straight', 'test_plugin_textdomain' ),
				'value' => 'purple-straight', 
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_purple.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Left' ),
				'value' => 'purple-left',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_purple_left.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Right' ),
				'value' => 'purple-right',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_purple_right.png'
			),							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Red', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => __( 'Straight', 'test_plugin_textdomain' ),
				'value' => 'red-straight', 
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_red.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Left' ),
				'value' => 'red-left',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_red_left.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Right' ),
				'value' => 'red-right',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_red_right.png'
			),							
		)
	),
	array(
		'group_name' => sprintf( '-- %s --', __( 'Yellow', 'test_plugin_textdomain' ) ),
		'group_data' => array(
			array(
				'name' => __( 'Straight', 'test_plugin_textdomain' ),
				'value' => 'yellow-straight', 
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_yellow.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Left' ),
				'value' => 'yellow-left',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_yellow_left.png'
			),
			array(
				'name' => sprintf( __( '%s rotated', 'test_plugin_textdomain' ), 'Right' ),
				'value' => 'yellow-right',
				'data' => $this->plugin_url . 'assets/images/signs/objects/paperclip/paperclip_yellow_right.png'
			),							
		)
	)					
);

// Paperclips sign filter
$test_plugin['signs']['paperclip'] = apply_filters( 'test_plugin_sign_paperclip', $test_plugin['signs']['paperclip'] );


// Tapes sign
$test_plugin['signs']['tape'] = array (						
	array(
		'name' => 'Tape 1',
		'value' => 'tape1', 
		'data' => $this->plugin_url . 'assets/images/signs/objects/tape/tape_1.png'
	),
	array(
		'name' => 'Tape 2',
		'value' => 'tape2', 
		'data' => $this->plugin_url . 'assets/images/signs/objects/tape/tape_2.png'
	),
	array(
		'name' => 'Tape 3',
		'value' => 'tape3', 
		'data' => $this->plugin_url . 'assets/images/signs/objects/tape/tape_3.png'
	),
	array(
		'name' => 'Tape 4',
		'value' => 'tape4', 
		'data' => $this->plugin_url . 'assets/images/signs/objects/tape/tape_4.png'
	),
	array(
		'name' => 'Tape 5',
		'value' => 'tape5', 
		'data' => $this->plugin_url . 'assets/images/signs/objects/tape/tape_5.png'
	),
	array(
		'name' => 'Tape 6',
		'value' => 'tape6', 
		'data' => $this->plugin_url . 'assets/images/signs/objects/tape/tape_6.png'
	)				
);

// Tapes sign filter
$test_plugin['signs']['tape'] = apply_filters( 'test_plugin_sign_tape', $test_plugin['signs']['tape'] );


// Global sign filter
$test_plugin['signs'] = apply_filters( 'test_plugin_signs', $test_plugin['signs'] );

?>