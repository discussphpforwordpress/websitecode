<?php
/**
 * Custom Plugin Installer Skin class
 */


// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die;	

// Include original class
//include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader-skins.php' );

// Class
class DX_TestPlugin_Plugin_Installer_Skin extends Plugin_Installer_Skin {
	
	// Mute all standard WP update feedback
	public function header() {}
	public function footer() {}
	public function feedback( $string ) {}
	public function before() {}
	public function set_result( $result ) {}
	public function after() {}
	public function error( $errors ) {}
	
}

?>