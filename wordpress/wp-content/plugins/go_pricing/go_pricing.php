<?php
/**
 * Plugin Name: Go Pricing - WordPress Responsive Pricing Tables
 * Plugin URI:  http://www.go-pricing.com
 * Description: 一个漂亮且多功能的价格表插件。更多WordPress汉化主题、主题升级、问题咨询请访问：<strong><a href="http://www.4mudi.com">http://www.4mudi.com</a></strong>或者光临<a href="http://wordpresszhuti.taobao.com">四亩地淘宝店</a>
 * Version:     3.3.8
 * Author:      Granth
 * Author URI:  http://granthweb.com
 * Text Domain: go_pricing_textdomain
 * Domain Path: /lang
 */

// Prevent direct call
if ( !defined( 'WPINC' ) ) die;

// Prevent redeclaring class
if ( class_exists( 'GW_GoPricing' ) ) wp_die ( __( 'GW_GoPricing class has already been declared!', 'go_pricing_textdomain' ) );	

// Include & init main class
include_once( plugin_dir_path( __FILE__ ) . 'includes/class_go_pricing.php' );
GW_GoPricing::instance( __FILE__ );

// Register activation / deactivation / uninstall hooks
register_activation_hook( __FILE__, array( 'GW_GoPricing', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'GW_GoPricing', 'deactivate' ) );
register_uninstall_hook( __FILE__, array( 'GW_GoPricing', 'uninstall' ) );

?>