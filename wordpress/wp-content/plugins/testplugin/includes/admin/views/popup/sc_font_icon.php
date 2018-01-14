<?php
$maxwidth = !empty( $_POST['maxwidth'] ) && $_POST['maxwidth'] != 'auto' ? (int)$_POST['maxwidth'] : 700;
$user_id = get_current_user_id();
?>
<div class="gwa-popup" data-help="<?php echo esc_attr( isset( $_COOKIE['test_plugin']['settings']['help'][$user_id] ) ? $_COOKIE['test_plugin']['settings']['help'][$user_id] : '' ); ?>">
	<div class="gwa-popup-inner"<?php echo !empty( $_POST['maxwidth'] ) && $_POST['maxwidth'] != 'auto' ? sprintf( ' style="width:%dpx;"', (int)$_POST['maxwidth'] ) : ''; ?>>
		<div class="gwa-popup-header">
			<div class="gwa-popup-header-icon-code"></div>
			<div class="gwa-popup-title"><?php _e( 'Shortcode Editor', 'test_plugin_textdomain' ); ?><small><?php _e( 'Insert Custom Shortcode', 'test_plugin_textdomain'); ?></small></div>
			<a href="#" title="<?php _e( 'Close', 'test_plugin_textdomain' ); ?>" class="gwa-popup-close"></a>
		</div>
		<div class="gwa-popup-content-wrap">
			<div class="gwa-popup-content">	
				<div class="gwa-abox">
					<div class="gwa-abox-content-wrap">
						<div class="gwa-abox-content">
							<table class="gwa-table">							
								<tr>
									<th><label><?php _e( 'Iconset', 'test_plugin_textdomain' ); ?></label></th>
									<td>
										<select name="shortcode">                                
											<option value="fa"><?php _e( 'Font Awesome 4.7 (786)', 'test_plugin_textdomain' ); ?></option>
											<option value="linecon"><?php _e( 'Linecon (48)', 'test_plugin_textdomain' ); ?></option>
											<option value="icomoon"><?php _e( 'Icomoon (491)', 'test_plugin_textdomain' ); ?></option>
											<option value="material"><?php _e( 'Material Icons (795)', 'test_plugin_textdomain' ); ?></option>
			                            </select>
									</td>
									<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Set of the icons.', 'test_plugin_textdomain' ); ?></p></td>									
								</tr>
								<tr class="gwa-row-separator"></tr>	
								<?php include('parts/part_fa.php'); ?>
								<?php include('parts/part_linecon.php'); ?>
								<?php include('parts/part_icomoon.php'); ?>
								<?php include('parts/part_material.php'); ?>								
							</table>
						</div>
					 </div>
				</div>
			</div>
		</div>
		<div class="gwa-popup-footer">
			<div class="gwa-popup-assets gwa-fl">
				<a href="#" data-action="insert-sc" title="<?php esc_attr_e( 'Insert Shortcode', 'test_plugin_textdomain' ); ?>" class="gwa-btn-style1"><?php esc_attr_e( 'Insert Shortcode', 'test_plugin_textdomain' ); ?></a>
			</div>
		</div>		
	</div>	
</div>