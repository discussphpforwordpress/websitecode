<?php
/**
 * The7 theme.
 *
 * @package The7
 * @since   1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

update_site_option( 'the7_registered', 'yes' );
update_site_option( 'the7_purchase_code', 'the7_purchase_code' );

/**
 * Set the content width based on the theme's design and stylesheet.
 * @since 1.0.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200; /* pixels */
}

/**
 * Initialize theme.
 * @since 1.0.0
 */
require( trailingslashit( get_template_directory() ) . 'inc/init.php' );

// function custom_login() {
//     echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/custom-login/custom-login.css" />';
// }
// // 增加自定义样式表
// add_action('login_head', 'custom_login');

// function custom_headerurl( $url ) {
//     return get_bloginfo( 'url' );
// }
// //更改logo的url，默认指向wordpress.org
// add_filter( 'login_headerurl', 'custom_headerurl' );

// function custom_headertitle ( $title ) {
//     return __( '欢迎来到宽影视觉' );
// }
//更改logo的title，默认是“Powered by WordPress”(基于WordPress)
// add_filter('login_headertitle','custom_headertitle');
// function custom_login_message() {
//     echo '<p style="text-align:center">' . __('宽影视觉，带给您非常体验');
// }
// // 在登陆表单中添加信息
// add_action('login_form', 'custom_login_message');

// function custom_html() {
//     echo '<p class="copyright">&copy; 宽影视觉';
// }
// //添加自定义HTML，例如增加版权信息
// add_action('login_footer', 'custom_html');