<?php
/**
 * Less related functions.
 * @package the7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * This function returns less vars array to use with phpless.
 * @return array
 */
function presscore_compile_less_vars() {
	// Include custom lessphp functions.
	require_once 'class-lessphp-functions.php';

	DT_LessPHP_Functions::register_functions();

	$less_vars = the7_get_new_less_vars_manager();

	do_action( 'presscore_setup_less_vars', $less_vars );

	return apply_filters( 'presscore_compiled_less_vars', $less_vars->get_vars() );
}

if ( ! function_exists( 'the7_get_new_less_vars_manager' ) ) {

	/**
	 * Factory function for Presscore_Lib_LessVars_Manager.
	 *
	 * @since 5.7.0
	 *
	 * @return Presscore_Lib_LessVars_Manager
	 */
	function the7_get_new_less_vars_manager() {
		return new Presscore_Lib_LessVars_Manager( new Presscore_Lib_SimpleBag(), new Presscore_Lib_LessVars_Factory() );
	}
}

if ( ! function_exists( 'presscore_less_get_accent_colors' ) ) :

	/**
	 * Helper that returns array of accent less vars.
	 *
	 * @since 3.0.0
	 * 
	 * @param  Presscore_Lib_LessVars_Manager $less_vars
	 * @return array Returns array like array( 'first-color', 'seconf-color' )
	 */
	function presscore_less_get_accent_colors( Presscore_Lib_LessVars_Manager $less_vars ) {
		// less vars
		$_color_vars = array( 'accent-bg-color', 'accent-bg-color-2' );
		// options ids
		$_test_id = 'general-accent_color_mode';
		$_color_id = 'general-accent_bg_color';
		$_gradient_id = 'general-accent_bg_color_gradient';
		// options defaults
		$_color_def = '#D73B37';
		$_gradient_def = array( '#ffffff', '#000000' );

		$accent_colors = $less_vars->get_var( $_color_vars );
		if ( ! array_product( $accent_colors ) ) {
			switch ( of_get_option( $_test_id ) ) {
				case 'gradient':
					$colors = of_get_option( $_gradient_id, $_gradient_def );
					break;
				case 'color':
				default:
					$colors = array( of_get_option( $_color_id, $_color_def ), null );
			}
			$less_vars->add_hex_color( $_color_vars, $colors );
			$accent_colors = $less_vars->get_var( $_color_vars );
		}

		return $accent_colors;
	}

endif;

if ( ! function_exists( 'presscore_less_get_conditional_colors' ) ) :

	/**
	 * Function returns $color|$gradient|$accent based on $test value.
	 * @since 3.0.0
	 * @param  string $test
	 * @param  string $color
	 * @param  array $gradient
	 * @param  array|string $accent
	 * @return array|string
	 */
	function presscore_less_get_conditional_colors( $test, $color, $gradient, $accent ) {
		switch ( call_user_func_array( 'of_get_option', $test ) ) {
			case 'outline':
			case 'color':
				$_color = array(
					call_user_func_array( 'of_get_option', $color ),
					null
				);
				break;
			case 'gradient':
				$_color = call_user_func_array( 'of_get_option', $gradient );
				break;
			case 'accent':
			default:
				$_color = $accent;
		}

		return $_color;
	}

endif;
