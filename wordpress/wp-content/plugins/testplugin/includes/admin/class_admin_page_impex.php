<?php
/**
 * Import & Export page controller class
 */
 
 
// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die;	


// Class
class DX_TestPlugin_AdminPage_Impex extends DX_TestPlugin_AdminPage {
	
	/**
	 * Register ajax actions
	 *
	 * @return void
	 */	
	
	public function register_ajax_actions( $ajax_action_callback ) { 
	
		DX_TestPlugin_Admin::register_ajax_action( 'impex', $ajax_action_callback );
		DX_TestPlugin_Admin::register_ajax_action( 'import', $ajax_action_callback );
		
	}
	
	
	/**
	 * Action
	 *
	 * @return void
	 */
	 	
	public function action() {
		
		// Create custom nonce
		$this->create_nonce( 'impex' );

		// Load views if action is empty		
		if ( empty( $this->action ) ) {
			
			$action = isset( $_GET['action'] ) ? $_GET['action'] : '';
			
			switch ( $action ) {
				
				case 'import':				
				
					$tmp_postdata = $this->get_temp_postdata();
					
					if ( empty( $tmp_postdata ) ) {
						// Load default view
						$this->content( $this->view() );
					} else {
						// Load import view
						$this->content( $this->view( 'import' ) );
					}
					break;					
				
				case 'export':
				
					$tmp_postdata = $this->get_temp_postdata();							
					
					if ( empty( $tmp_postdata ) || !isset( $tmp_postdata[0] ) ) {
						// Load default view
						$this->content( $this->view() );
					} else {
						// Force download data
						$this->export( $tmp_postdata );		
					}
					break;

				default:
								
					// Load default view
					$this->content( $this->view() );	

			}
			
		}

		
		// Load views if action is not empty (handle postdata)
		if ( !empty( $this->action ) && check_admin_referer( $this->nonce, '_nonce' ) ) {
			
			switch( $this->action ) {
				
				// Default
				case 'impex': 
					
					if ( !empty( $this->action_type ) ) {
						
						switch( $this->action_type ) {

							// Import
							case 'import':
							
								add_filter( 'upload_mimes', array( $this, 'restrict_upload_mimes') );
								add_filter( 'upload_dir', array( $this, 'set_upload_dir' ) );
								
								$result = $this->validate_import_data( $_FILES );	
														
								if ( $result === false ) {
									
									if ( $this->is_ajax === false ) {
										wp_redirect( $this->referrer );	
										exit;
									} else {
										echo $this->view();
										DX_TestPlugin_AdminNotices::show();
									}
									
								} else {
									
									$this->set_temp_postdata( $result );
									
									if ( $this->is_ajax === false ) {
										wp_redirect( add_query_arg( 'action', 'import', $this->referrer ) );	
										exit;
									} else {
										echo $this->view( 'import' );
									}
									
								}
												
								break;
							
							// Export	
							case 'export':
								
								$result = $this->validate_export_data( $_POST['export'] );
								
								if ( $result === false ) {

									if ( $this->is_ajax === false ) {
										wp_redirect( $this->referrer );	
										exit;
									} else {
										DX_TestPlugin_AdminNotices::show();
									}
									
								} else {
									
									$this->set_temp_postdata( $_POST['export'] );
									
									if ( $this->is_ajax === false ) {
										wp_redirect( add_query_arg( 'action', 'export', $this->referrer ) );	
										exit;
									} else {
										
										echo '<div id="download_url">' . add_query_arg( array( 'action' => 'export' ), admin_url( 'admin.php?page=test-plugin-import-export' ) ) . '</div>';
										
									}

								}
															
								break;								
							
						}
						
					}

					break;

				// Import page
				case 'import' :
				
					if ( !empty( $_POST['import'] ) ) {
						
						$this->import( $_POST['import-data'], ( isset( $_POST['replace'] ) ? $_POST['replace'] : false ), $_POST['import'] );
						
						if ( $this->is_ajax === false ) {
							wp_redirect( $this->referrer );	
							exit;
						} else {
							echo $this->view();
							DX_TestPlugin_AdminNotices::show();
						}
			
					} else {
						
						DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'Please select tables to import!', 'test_plugin_textdomain' ) );
					
						if ( $this->is_ajax === false ) {
							$this->set_temp_postdata( $_POST['import-data'] );
							wp_redirect( add_query_arg( 'action', 'import', $this->referrer ) );	
							exit;
						} else {
							DX_TestPlugin_AdminNotices::show();
						}						
						
					}

			}
			
		}
			
		
	}
	
	
	/**
	 * Load views
	 *
	 * @return void
	 */	
	
	public function view( $view = '', $data = null ) {

		ob_start();
		
		switch( $view ) {
			case 'export' :
				include_once( 'views/page/export.php' );	
				break;
				
			case 'import' : 
				include_once( 'views/page/import.php' );	
				break;
			
			default:
				include_once( 'views/page/impex.php' );				
		};
		
		$view_content = ob_get_clean();	
		return $view_content;
		
	}

	
	/**
	 * Validate & export data
	 *
	 * @return string | bool
	 */		

	public function validate_export_data( $export_data ) { 
		
		if ( empty( $export_data ) ) {

			DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'There is nothing to export!', 'test_plugin_textdomain' ) );
			return false;
			
		} else {
			
			$export_data = $export_data[0] == 'all' ? array() : $export_data;
			$result = DX_TestPlugin_Data::export( $export_data );
			
			if ( $result === false ) { 
			
				DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'Oops, something went wrong!', 'test_plugin_textdomain' ) );	
				return false;

			}
			
		}
		
		if ( empty( $export_data ) ) $export_data  = 'all';
		
		return $export_data;

	}
	
	
	/**
	 * Export
	 *
	 * @return void | bool
	 */		

	public function export( $export_data ) { 
		
		if ( empty( $export_data ) ) {

			DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'There is nothing to export!', 'test_plugin_textdomain' ) );
			return false;
			
		} else {
			
			$export_data = $export_data[0] == 'all' ? array() : $export_data;
			$result = DX_TestPlugin_Data::export( $export_data );
			
			if ( $result === false ) { 
			
				DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'Oops, something went wrong!', 'test_plugin_textdomain' ) );	
				return false;

			}
			
			$this->delete_temp_postdata();
			
			if ($result === false) return;
			
			ob_end_clean();
			header( 'Pragma: public' );
			header( 'Expires: 0' );
			header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
			header( 'Content-Description: File Transfer' );
			header( 'Content-Transfer-Encoding: Binary' );						
			header( 'Content-type: text/plain' );
			header( 'Content-Disposition: attachment; filename="export_' . date( 'd_m_Y_H_i_s' ) . '.txt"' );
			header( 'Connection: close' );
			echo $result;
			ob_end_flush();
			exit;			
			
		}		
		
	}
	
	
	/**
	 * Validate & return import data
	 *
	 * @return string | bool
	 */		
	
	public function validate_import_data( $import_data ) {
						
		if ( empty( $import_data ) || empty( $import_data['import-data'] ) || empty( $import_data['import-data']['name'] ) || empty( $import_data['import-data']['tmp_name'] ) || empty( $import_data['import-data']['size'] ) ) {
		
			DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'There is nothing to import!', 'test_plugin_textdomain' ) );	
			return false;
			
		}
		
		if ( !empty( $import_data['import-data']['error'] ) || ( $file_content = @file_get_contents( $_FILES['import-data']['tmp_name'] ) ) === false ) {
		
			DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'Oops, something went wrong', 'test_plugin_textdomain' ) );	
			return false;
			
		}
		
		$file = wp_upload_bits( $_FILES['import-data']['name'], '', $file_content );
		
		if ( empty( $file ) || empty( $file['file'] ) || !empty( $file['error'] ) ) {
		
			DX_TestPlugin_AdminNotices::add( 'impex', 'error', !empty( $file['error'] ) ? $file['error'] : __( 'Oops, something went wrong!', 'test_plugin_textdomain' ) );	
			return false;
			
		}
		
		$data = @unserialize( base64_decode( $file_content ) );
		
		if ( $data === false ) { 

			DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'Invalid import data!', 'test_plugin_textdomain' ) );
			unlink( $file['file'] );
			return false;
			
		}

		if ( empty( $data['_info']['db_version'] ) || version_compare( $data['_info']['db_version'], self::$db_version, "!=" ) ) {

			DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'Import data is not compatible with the current version!', 'test_plugin_textdomain' ) );
			unlink( $file['file'] );			
			return false;

		}
		
		unset( $data['_info'] );

		foreach( $data as $data_key => $data_val ) {
			$result['data'][$data_key ] = $data_val['name'];
		}
		
		$result['file'] = $file['file'];
		
		// save uploaded file data into db
		$uploads = get_option( self::$plugin_prefix . '_uploads', array() );
		$uploads[] = array(
			'file' => $result['file'],
			'expiration' => gmdate( 'Y-m-d H:i:s', time() + 30 * 60 )
		);
		
		update_option( self::$plugin_prefix . '_uploads', $uploads );
		
		return $result;
		
	}
	
	
	/**
	 * Import
	 *
	 * @return bool
	 */		

	public function import( $file, $override, $ids ) { 
	
		$file_content = @file_get_contents( $file );

		if ( $file_content === false ) { 

			DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'Invalid import data!', 'test_plugin_textdomain' ) );
			return false;
			
		}
		
		$data = @unserialize( base64_decode( $file_content ) );
		
		if ( $data === false ) { 

			DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'Invalid import data!', 'test_plugin_textdomain' ) );
			unlink( $file['file'] );
			return false;
			
		}

		if ( empty( $data['_info']['db_version'] ) || version_compare( $data['_info']['db_version'], self::$db_version, "<" ) ) {

			DX_TestPlugin_AdminNotices::add( 'impex', 'error', __( 'Import data is not compatible with the current version!', 'test_plugin_textdomain' ) );
			unlink( $file['file'] );
			return false;

		}

		$data = $file_content;
				
		$ids = isset( $ids[0] ) && $ids[0] == 'all' ? array() : $ids;
		
		$result = DX_TestPlugin_Data::import( $data, (bool)$override, $ids );
		
		if ( $result === false ) { 

			DX_TestPlugin_AdminNotices::add( 'main', 'error', __( 'Oops, something went wrong!', 'test_plugin_textdomain' ) );
			unlink( $file['file'] );
			return false;

		} else {
			DX_TestPlugin_AdminNotices::add( 'main', 'success', sprintf( __( '%1$s pricing table(s) has been successfully imported.', 'test_plugin_textdomain' ), $result ) );
		}
		
		delete_transient( self::$plugin_prefix . '_uploads' );
		return true;

	}
	
	
	/**
	 * Restrict allowed mimes
	 *
	 * @return array
	 */		
	
	public function restrict_upload_mimes( $mimes ) {
		
		$allowed_mimes = array( 'txt' => 'text/plain' );
		
		return $allowed_mimes;
		
	}
	
	
	/**
	 * Set custom upload path
	 *
	 * @return array
	 */		
	
	public function set_upload_dir( $param ) {
		
		$param['subdir'] = '/test_plugin_data';
		$param['path'] = $param['basedir'] . $param['subdir'];
				
		return $param;
		
	}		
	
}
 

?>