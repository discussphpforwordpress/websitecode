<?php
/**
 * Plugin Name: test plugin example
 * Plugin URI:
 * Description: 测试插件
 * Version:     0.0.1
 * Author:      Damon
 * Author URI:  https://damonxiong.github.io/
 * Text Domain: test_plugin_textdomain
 * Domain Path: /lang
 */

// Prevent direct call
if ( !defined( 'WPINC' ) ) {echo "die";die;}

// Prevent redeclaring class
if ( class_exists( 'DX_TestPlugin' ) ) wp_die ( __( 'DX_TestPlugin class has already been declared!', 'test_plugin_textdomain' ) );

// Include & init main class
include_once( plugin_dir_path( __FILE__ ) . 'includes/class_test_plugin.php' );
DX_TestPlugin::instance( __FILE__ );

// Register activation / deactivation / uninstall hooks
register_activation_hook( __FILE__, array( 'DX_TestPlugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'DX_TestPlugin', 'deactivate' ) );
register_uninstall_hook( __FILE__, array( 'DX_TestPlugin', 'uninstall' ) );

?>
