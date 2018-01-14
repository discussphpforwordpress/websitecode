<?php
/**
 * Databas Update page controller class
 */
 
 
// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die;	


// Class
class DX_TestPlugin_AdminPage_DbUpdate extends DX_TestPlugin_AdminPage {
	
	/**
	 * Register ajax actions
	 *
	 * @return void
	 */	

	public function register_ajax_actions( $ajax_action_callback ) {  }
		

	/**
	 * Action
	 *
	 * @return void
	 */	
	 	
	public function action() {
		
		// Create custom nonce
		$this->create_nonce( 'db_update' );
		
		// Load views if action is empty		
		if ( empty( $this->action ) ) {
			
			$this->content( $this->view() );
			
		}
		
		// Load views if action is not empty (handle postdata)
		if ( !empty( $this->action ) && check_admin_referer( $this->nonce, '_nonce' ) ) {
			
			// Do the update
			if ( $this->action == 'db_update' ) {
				
				$version_info = get_option( self::$plugin_prefix . '_version' );
				$result = DX_TestPlugin_Data::db_update();
				
				if ( $result === false ) { 
				
					DX_TestPlugin_AdminNotices::add( 'db_update', 'error', __( 'Oops, something went wrong!', 'test_plugin_textdomain' ) );
				
				} else {
				
					DX_TestPlugin_AdminNotices::add( 'db_update', 'success', sprintf( __( '%1$s pricing table(s) has been successfully updated.', 'test_plugin_textdomain' ), $result ) );
					
					$version_info['db'] = self::$db_version;
					update_option( self::$plugin_prefix . '_version', $version_info );
					delete_option( self::$plugin_prefix . '_tables' );
					
					wp_redirect( admin_url( 'admin.php?page=test-plugin' ) );	
					exit;					
					
				}

			} else {
				
				$this->content( $this->view() );
				
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
		include_once( 'views/page/db_update.php' );
		return ob_get_clean();
		
	}


}
 

?>