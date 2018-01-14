<?php
/**
 * General Settings page controller class
 */
 
 
// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die;	


// Class
class DX_TestPlugin_AdminPage_GeneralSettings extends DX_TestPlugin_AdminPage {
	
	/**
	 * Register ajax actions
	 *
	 * @return void
	 */	

	public function register_ajax_actions( $ajax_action_callback ) { 
	
		DX_TestPlugin_Admin::register_ajax_action( 'general_settings', $ajax_action_callback );
		
	}
	

	/**
	 * Action
	 *
	 * @return void
	 */	
	 	
	public function action() {
		
		// Create custom nonce
		$this->create_nonce( 'general_settings' );
		
		// Load views if action is empty		
		if ( empty( $this->action ) ) {
			
			$this->content( $this->view() );
			
		}
		
		// Load views if action is not empty (handle postdata)
		if ( !empty( $this->action ) && check_admin_referer( $this->nonce, '_nonce' ) ) {
			
			$this->process_postdata( $_POST );
			
			if ( $this->is_ajax === false ) {
				wp_redirect( $this->referrer );	
				exit;
			} else {
				DX_TestPlugin_AdminNotices::show();
			}
			
		}
			
	}
	
	
	/**
	 * Load views
	 *
	 * @return string
	 */	
	
	public function view( $view = '', $data = null ) {

		ob_start();
		include_once( 'views/page/general_settings.php' );
		return ob_get_clean();
		
	}

	
	/**
	 * Process postdata
	 *
	 * @return void
	 */		

	public function process_postdata( $postdata ) { 
		
		// Clean custom CSS
		if ( isset( $postdata['custom-css'] ) ) {
			$custom_css = DX_TestPlugin_Helper::clean_input( array( $postdata['custom-css'] ), 'no_html' );
			$postdata['custom-css'] = $custom_css[0];
		}		
		
		// Clean postdata (the rest)
		$postdata = DX_TestPlugin_Helper::clean_input( $postdata, 'filtered', '', array( 'thousand-sep', 'custom-css' ) );
		$postdata = DX_TestPlugin_Helper::remove_input( $postdata, 'action' );
		
		$settings = get_option( self::$plugin_prefix . '_table_settings', $postdata );		
				
		
		// Verify and save data
		if ( !empty( $postdata ) ) {
			
			if ( empty( $settings ) || ( !empty( $settings ) && $settings != $postdata ) ) {
				
				$result = update_option( self::$plugin_prefix . '_table_settings', $postdata );
				
				if ( $result === false ) {
					DX_TestPlugin_AdminNotices::add( 'general_settings', 'error', __( 'Oops, something went wrong!', 'test_plugin_textdomain' ) );			
				} else {
					DX_TestPlugin_AdminNotices::add( 'general_settings', 'success', __( 'General Settings has been successfully updated!', 'test_plugin_textdomain' ) );	
				}
				
			} else {
				DX_TestPlugin_AdminNotices::add( 'general_settings', 'success', __( 'General Settings has been successfully updated!', 'test_plugin_textdomain' ) );	
			}
					
		} else {
			DX_TestPlugin_AdminNotices::add( 'general_settings', 'error', __( 'Oops, something went wrong!', 'test_plugin_textdomain' ) );	
		}

	}
	
}
 

?>