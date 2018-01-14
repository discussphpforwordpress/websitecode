<?php
/**
 * Column main view
 */


// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die; 

?>

<!-- Column -->
<div class="test-plugin-col">				
		<div class="test-plugin-col-content">
		
		<!-- Column Controls -->		
		<div class="gwa-col-assets gwa-clearfix">
			<div class="gwa-col-assets-nav-main">
				<a href="#" title="<?php esc_attr_e( 'Delete', 'test_plugin_textdomain' ); ?>" class="gwa-asset-icon-delete gwa-bg-color3" data-action="delete-col" data-confirm="<?php esc_attr_e( 'Are you sure you want to delete the column?', 'test_plugin_textdomain' ); ?>"><span></span></a>
				<a href="#" title="<?php esc_attr_e( 'Clone', 'test_plugin_textdomain' ); ?>" class="gwa-asset-icon-clone gwa-bg-color2" data-action="clone-col"  data-confirm="<?php esc_attr_e( 'Are you sure you wanto clone the column?', 'test_plugin_textdomain' ); ?>"><span></span></a>
				<a href="#" title="<?php esc_attr_e( 'Expand / Collapse', 'test_plugin_textdomain' ); ?>" class="gwa-asset-icon-settings gwa-bg-color4" data-action="expand-col"><span></span></a>
			</div>
			<?php do_action( 'test_plugin_colum_assets_html', isset( $table_data ) ? $table_data : '' ); ?>			
		</div>
		<!-- / Column Controls -->		
		
		<!-- General Options -->
		<div class="gwa-abox gwa-closed" data-type="general" data-color="#90c820">
			<div class="gwa-abox-header">
				<div class="gwa-abox-header-icon-general"></div>
				<div class="gwa-abox-title"><?php _e( 'General', 'test_plugin_textdomain' ); ?><small><?php _e( 'Global Column Settings', 'test_plugin_textdomain' ); ?></small></div>
				<div class="test-plugin-col-index"><?php printf( '#%d', $x+1 ); ?></div>
				<div class="gwa-abox-ctrl"></div>
			</div>
			<div class="gwa-abox-content-wrap">
				<div class="gwa-abox-content"> 
					<?php $this->get_column_general( $table_data, $x ); ?>	
				</div>
			</div>
		</div>
		<!-- / General Options -->

		<!-- Header Options -->
		<div class="gwa-abox gwa-closed" data-type="header" data-color="#ffbe00">
			<div class="gwa-abox-header">
				<div class="gwa-abox-header-icon-header"></div>
				<div class="gwa-abox-title"><?php _e( 'Header', 'test_plugin_textdomain' ); ?><small><?php _e( 'Header Content & Style', 'test_plugin_textdomain' ); ?></small></div>
				<div class="test-plugin-col-index"><?php printf( '#%d', $x+1 ); ?></div>
				<div class="gwa-abox-ctrl"></div>	
			</div>
			<div class="gwa-abox-content-wrap">
				<div class="gwa-abox-content"> 
					<?php $this->get_column_header( $table_data, $x ); ?>
				</div>
			</div>
		</div>
		<!-- / Header Options -->					

		<!-- Body Options -->									
		<div class="gwa-abox gwa-closed" data-type="body" data-color="#d271e6">
			<div class="gwa-abox-header">
				<div class="gwa-abox-header-icon-body"></div>
				<div class="gwa-abox-title"><?php _e( 'Body', 'test_plugin_textdomain' ); ?><small><?php _e( 'Body Content & Style', 'test_plugin_textdomain' ); ?></small></div>
				<div class="test-plugin-col-index"><?php printf( '#%d', $x+1 ); ?></div>				
				<div class="gwa-abox-ctrl"></div>
			</div>
			<div class="gwa-abox-content-wrap">
				<div class="gwa-abox-content">
					<?php $this->get_column_body( $table_data, $x, $row_count ); ?>
				</div>
			</div>						
		</div>
		<!-- / Body Options -->	
	
		<!-- Footer Options -->
		<div class="gwa-abox gwa-closed" data-type="footer" data-color="#fa5541">
			<div class="gwa-abox-header">
				<div class="gwa-abox-header-icon-footer"></div>
				<div class="gwa-abox-title"><?php _e( 'Footer', 'test_plugin_textdomain' ); ?><small><?php _e( 'Footer Content & Style', 'test_plugin_textdomain' ); ?></small></div>
				<div class="test-plugin-col-index"><?php printf( '#%d', $x+1 ); ?></div>
				<div class="gwa-abox-ctrl"></div>
			</div>
			<div class="gwa-abox-content-wrap">
				<div class="gwa-abox-content">
					<?php $this->get_column_footer( $table_data, $x, $button_count ); ?>
				</div>				
			</div>
		</div>
		<!-- / Footer Options -->
		
	</div>
	
</div>
<!-- / Column -->	