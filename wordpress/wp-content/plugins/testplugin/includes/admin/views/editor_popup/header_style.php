<?php
/**
 * Editor popup - Header style view
 */


// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die;

$skin = isset( $_POST['skin'] ) ? sanitize_key( $_POST['skin'] ) : 'clean';
$action_type = isset( $_POST['_action_type'] ) ? sanitize_key( $_POST['_action_type'] ) : '';

ob_start();
?>

<table class="gwa-table">						
	<tr>
		<th><label><?php _e( 'Header Style', 'test_plugin_textdomain' ); ?></label></th>
		<td>
			<select name="type" data-preview="<?php esc_attr_e( 'Style', 'test_plugin_textdomain' ); ?>">
				<option value=""<?php echo ( empty( $postdata['type'] ) ? ' selected="selected"' : '' ); ?>><?php _e( 'Circle', 'test_plugin_textdomain' ); ?></option>
				<option value="standard"<?php echo ( !empty( $postdata['type'] ) && $postdata['type'] == 'standard' ? ' selected="selected"' : '' ); ?>><?php _e( 'Standard (new)', 'test_plugin_textdomain' ); ?></option>
			</select>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Style of the header.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
	<tr class="gwa-row-fullwidth test-plugin-style-type" data-type="pricing cpricing">
		<td><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Set background image only if want to replace the style default colors with an image.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>			
	<tr>
		<th><label><?php _e( 'Header background', 'test_plugin_textdomain' ); ?></label></th>
		<td>
			<div class="gwa-img-upload">
				<div class="gwa-img-upload-media">
					<?php if ( !empty( $postdata['bg-img']['data'] ) ) : ?>
					<span class="gwa-img-upload-media-container"><a href="#" title="<?php esc_attr_e( 'Remove', 'test_plugin_textdomain' ); ?>" class="gwa-img-upload-media-remove"></a><a href="#" title="<?php esc_attr_e( 'Preview', 'test_plugin_textdomain' ); ?>" class="gwa-img-upload-media-popup" data-action="popup" data-popup="image-preview" data-popup-type="image" data-popup-subtitle="<?php echo esc_attr( $postdata['bg-img']['data'] ); ?>" data-id="<?php echo esc_attr( $postdata['bg-img']['data'] ); ?>" data-popup-maxwidth="auto"><img src="<?php echo esc_attr( $postdata['bg-img']['data'] ); ?>"></a></span>
					<?php else : ?>
					<a href="#" title="<?php esc_attr_e( 'Remove', 'test_plugin_textdomain' ); ?>" class="gwa-img-upload-media-remove"></a>
					<?php endif; ?>							
				</div>
				<div class="gwa-input-btn"<?php echo ( !empty( $postdata['bg-img']['data'] ) ? 'style="display:none;"': '' ); ?>><input type="text" name="bg-img[data]" value="<?php echo ( !empty( $postdata['bg-img']['data'] ) ?  esc_attr( $postdata['bg-img']['data'] ) : '' ); ?>"><a href="#" title="<?php esc_attr_e( 'Add', 'test_plugin_textdomain' ); ?>" data-action="img-upload"><span class="gwa-icon-add"></span></a></div>
			</div>
		</td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Background image of the header.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
	<tr>
		<th><label><?php _e( 'Bg position', 'test_plugin_textdomain' ); ?> <span class="gwa-info">(%)</span></label></th>
		<td><input type="text" name="bg-img[posx]" value="<?php echo isset( $postdata['bg-img']['posx'] ) ? esc_attr( (int)$postdata['bg-img']['posx'] ) : 50; ?>" class="gwa-input-mid"><input type="text" name="bg-img[posy]" value="<?php echo isset( $postdata['bg-img']['posy'] ) ? esc_attr( (int)$postdata['bg-img']['posy'] ) : 50; ?>" class="gwa-input-mid"></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Background position of the header image.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>			
</table>
<!-- /Button -->

<?php
$content = ob_get_clean();
$content = apply_filters( "test_plugin_admin_editor_popup_{$action_type}_{$skin}", $content, ( !empty( $postdata ) ? $postdata : '' ) );
echo $content;
?>
