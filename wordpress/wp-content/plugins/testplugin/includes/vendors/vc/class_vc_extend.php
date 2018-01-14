<?php
/**
 * Visual Composer Extend class
 */


/* Prevent direct call */
if ( ! defined( 'WPINC' ) ) { die; }

class DX_TestPlugin_VCExtend {

	protected static $instance = null;


	/**
	 * Initialize the class
	 */

	public function __construct() {
		
         add_action( 'init', array( $this, 'integrateWithVC' ) );
		 
    }
 
 
	/**
	 * Return an instance of this class
	 *
	 * @return object
	 */
	 
	public static function instance() {
		
		if ( self::$instance == null ) self::$instance = new self;
		return self::$instance;
		
	}	
 
 
	/**
	 * Add to Visual Composer
	 */ 
 
    public function integrateWithVC() {

		global $pagenow;
		
		if ( !function_exists( 'vc_map' ) ) return;
		
		if ( $pagenow != 'post.php' && 
			 $pagenow != 'post-new.php' && 
			 $pagenow != 'nav-menus.php' && 
			 ( $pagenow != 'admin-ajax.php' || $pagenow == 'admin-ajax.php' && isset( $_POST['action'] ) && $_POST['action'] != 'vc_edit_form' ) ) return; 
		
		$names = array();
		$pricing_tables = DX_TestPlugin_Data::get_tables( '', false, 'title', 'ASC' );

		if ( !empty( $pricing_tables ) ) {
			foreach ( $pricing_tables as $pricing_table ) {
				if ( !empty( $pricing_table['name'] ) && !empty( $pricing_table['id'] ) ) {
					$names[] = $pricing_table['name'];
					$name_count = array_count_values( $names );
					$dropdown_data[sprintf('%1$s (#%2$s)', $pricing_table['name'], $pricing_table['postid'])] = $pricing_table['id'];
				}
			}
		}
		
		if ( empty( $dropdown_data ) ) $dropdown_data[0] = __('No tables found!', 'test_plugin_textdomain' );
		
		vc_map( array (
			'name' => __( 'Test Plugin', 'test_plugin_textdomain' ),
			'description' => __( 'Amazing responsive pricing tables', 'test_plugin_textdomain' ),
			'base' => 'test_plugin',
			'category' => __( 'Content', 'test_plugin_textdomain' ),	
			'class' => '',
			'controls' => 'full',
			'icon' => plugin_dir_url( __FILE__ ) . 'assets/test_plugin_32x32.png',
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Table Name', 'test_plugin_textdomain' ),
					'param_name' => 'id',
					'value' => $dropdown_data,
					'description' => __( 'Select Pricing Table', 'test_plugin_textdomain' ),
					'admin_label' => true,
					'save_always' => true
				)
			)
		) );
				
    }

}
