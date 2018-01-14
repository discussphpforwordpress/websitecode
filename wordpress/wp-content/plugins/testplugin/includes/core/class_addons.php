<?php
/**
 * Class for plugin addons
 */


// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die;	

// Class
class DX_TestPlugin_Addon  {

	protected $globals;
		
	protected static $plugin_version;
	protected static $db_version;
	protected static $plugin_prefix;
	protected static $plugin_slug;
	protected static $plugin_path;
	
	protected static $addon;
	

	/**
	 * Initialize the class
	 *
	 * @return void
	 */	
	
	public function __construct() {
		
		$this->globals = DX_TestPlugin::instance();
		self::$plugin_version = $this->globals['plugin_version'];
		self::$db_version = $this->globals['db_version'];		
		self::$plugin_prefix = $this->globals['plugin_prefix'];
		self::$plugin_slug = $this->globals['plugin_slug'];
		self::$plugin_path = $this->globals['plugin_path'];
		
	}
	
	
	/**
	 * Register addon
	 *
	 * @return void
	 */		
	
	public static function register( $addon ) {
	
		if ( empty( $addon ) || empty( $addon['id'] ) || empty( $addon['slug'] ) || empty( $addon['base'] ) || empty( $addon['version'] ) ) return false;
		
		$apicall = new DX_TestPlugin_Api( array( 'product' => 'test_plugin', 'type' => 'info' ) );
		$api_data = $apicall->get_data();
		
		if ( !empty( $api_data['addons'][$addon['id']] ) ) $addon['api_data'] = $api_data['addons'][$addon['id']];	
		
		global $test_plugin;
		self::$addon = $test_plugin['addons'][$addon['id']] = $addon;
	
	}

}

?>