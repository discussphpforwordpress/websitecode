<?php
/**
 * Editor popup - General Decoration View
 */

 
// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die;

$skin = isset( $_POST['skin'] ) ? sanitize_key( $_POST['skin'] ) : 'clean';
$action_type = isset( $_POST['_action_type'] ) ? sanitize_key( $_POST['_action_type'] ) : '';

ob_start();
?>

<div class="gwa-section"><span><?php _e( 'Shadow Settings', 'test_plugin_textdomain' ); ?></span></div>
<table class="gwa-table">		
	<tr>
		<th><label><?php _e( 'Shadow Style', 'test_plugin_textdomain' ); ?></label></th>
		<td>
			<select name="col-shadow" class="gwa-img-selector" data-preview="<?php esc_attr_e( 'Shadow Style', 'test_plugin_textdomain' ); ?>">
				<?php 
				$shadow_img_src = '';
				if ( !empty( $test_plugin['shadows'] ) ) : 
				foreach ( (array)$test_plugin['shadows'] as $col_shadow ) : 
				?>			
				<option data-src="<?php echo esc_attr( !empty( $col_shadow['data'] ) ? $col_shadow['data'] : '' ); ?>" value="<?php echo esc_attr( !empty( $col_shadow['value'] ) ? $col_shadow['value'] : '' ); ?>"<?php echo ( !empty( $col_shadow['value'] ) && !empty ($postdata['col-shadow'] ) && $col_shadow['value'] ==$postdata['col-shadow'] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $col_shadow['name'] ) ? $col_shadow['name'] : '' ); ?></option>
				<?php 						
				if ( !empty( $col_shadow['value'] ) && !empty( $col_shadow['data'] ) && !empty ($postdata['col-shadow'] ) && $col_shadow['value'] ==$postdata['col-shadow'] ) $shadow_img_src = $col_shadow['data'];
				endforeach;
				endif;
				?>
			</select>
			<div class="gwa-img-selector-media gwa-tc">
			<?php if ( !empty( $shadow_img_src ) ) : ?>
			<img src="<?php echo esc_attr( $shadow_img_src ); ?>">
			<?php endif; ?>
			</div>
		</td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Bottom shadow of the column.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
</table>
<div class="gwa-table-separator"></div>
<div class="gwa-section"><span><?php _e( 'Sign Settings', 'test_plugin_textdomain' ); ?></span></div>	
<table class="gwa-table">
	<tr>
		<th><label><?php _e( 'Sign Type', 'test_plugin_textdomain' ); ?></label></th>
		<td>
			<select name="col-sign-type" data-preview="<?php esc_attr_e( 'Sign Type', 'test_plugin_textdomain' ); ?>">
				<?php 
				if ( !empty( $test_plugin['sign_types'] ) ) :
				foreach ( (array)$test_plugin['sign_types'] as $sign_type ) :
				if ( !empty( $sign_type['group_name'] ) && !empty( $sign_type['group_data'] ) )	:
				?>
				<optgroup label="<?php echo esc_attr( $sign_type['group_name'] ); ?>"></optgroup>
				<?php
				foreach ( (array)$sign_type['group_data'] as $sign ) :
				if ( !empty( $sign['name'] ) )	:
				?>
				<option value="<?php echo esc_attr( !empty( $sign['id'] ) ? $sign['id'] : '' ); ?>"<?php echo ( isset( $sign['id'] ) && isset($postdata['col-sign-type'] ) && $sign['id'] ==$postdata['col-sign-type'] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $sign['name'] ) ? $sign['name'] : '' ); ?></option>
				<?php						
				endif;
				endforeach;
				else :						 
				if ( !empty( $sign_type['name'] ) )	:
				?>
				<option value="<?php echo esc_attr( !empty( $sign_type['id'] ) ? $sign_type['id'] : '' ); ?>"<?php echo ( isset( $sign_type['id'] ) && isset($postdata['col-sign-type'] )  && $sign_type['id'] ==$postdata['col-sign-type'] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $sign_type['name'] ) ? $sign_type['name'] : '' ); ?></option>
				<?php 
				endif;
				endif;
				endforeach;
				endif;
				?>
			</select>
		</td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Type of the sign.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>		
	<tr data-parent-id="col-sign-type" data-parent-value="custom-img"<?php echo ( empty($postdata['col-sign-type'] ) ||$postdata['col-sign-type'] != 'custom-img' ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Image', 'test_plugin_textdomain' ); ?></label></th>
		<td>
			<div class="gwa-img-upload">
				<div class="gwa-img-upload-media">
					<?php if ( !empty($postdata['col-sign']['custom-img']['data'] ) ) : ?>
					<span class="gwa-img-upload-media-container"><a href="#" title="<?php esc_attr_e( 'Remove', 'test_plugin_textdomain' ); ?>" class="gwa-img-upload-media-remove"></a><a href="#" title="<?php esc_attr_e( 'Preview', 'test_plugin_textdomain' ); ?>" class="gwa-img-upload-media-popup" data-action="popup" data-popup="image-preview" data-popup-type="image" data-popup-subtitle="<?php echo esc_attr($postdata['col-sign']['custom-img']['data'] ); ?>" data-id="<?php echo esc_attr($postdata['col-sign']['custom-img']['data'] ); ?>" data-popup-maxwidth="auto"><img src="<?php echo esc_attr($postdata['col-sign']['custom-img']['data'] ); ?>"></a></span>
					<?php else : ?>
					<a href="#" title="<?php esc_attr_e( 'Remove', 'test_plugin_textdomain' ); ?>" class="gwa-img-upload-media-remove"></a>
					<?php endif; ?>							
				</div>
				<div class="gwa-input-btn"<?php echo ( !empty( $postdata['col-sign']['custom-img']['data'] ) ? 'style="display:none;"': '' ); ?>><input type="text" name="col-sign[custom-img][data]" value="<?php echo ( !empty( $postdata['col-sign']['custom-img']['data'] ) ?  esc_attr( $postdata['col-sign']['custom-img']['data'] ) : '' ); ?>"><a href="#" title="<?php esc_attr_e( 'Add', 'test_plugin_textdomain' ); ?>" data-action="img-upload"><span class="gwa-icon-add"></span></a></div>
			</div>															
		</td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Enter an URL or select an image from the Media Library.', 'test_plugin_textdomain' ); ?></p></td>
	</tr> 						
	<?php 
	foreach ( (array)$test_plugin['signs'] as $sign => $sign_data ) :
	?>					
	<tr data-parent-id="col-sign-type" data-parent-value="<?php echo esc_attr( $sign ); ?>"<?php echo ( empty($postdata['col-sign-type'] ) ||$postdata['col-sign-type'] != $sign ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Sign', 'test_plugin_textdomain' ); ?></label></th>
		<td>
			<select name="col-sign[<?php echo esc_attr( $sign ); ?>]" class="gwa-img-selector">
				<?php 
				$sign_img_src = '';
				foreach ( $sign_data as $col_sign ) : 
				if ( !empty( $col_sign['group_name'] ) && !empty( $col_sign['group_data'] ) )	:
				?>
				<optgroup label="<?php echo esc_attr( $col_sign['group_name'] ); ?>"></optgroup>
				<?php 
				foreach ( (array)$col_sign['group_data'] as $col_sign ) :
				if ( !empty( $col_sign['value'] ) && !empty( $col_sign['data'] ) && !empty($postdata['col-sign'][$sign] ) && $col_sign['value'] ==$postdata['col-sign'][$sign] ) $sign_img_src = $col_sign['data'];
				if ( !empty( $col_sign['value'] ) && !empty( $col_sign['data'] ) && empty( $sign_img_src ) )  $sign_img_src = $col_sign['data'];
				?>
				<option data-src="<?php echo esc_attr( !empty( $col_sign['data'] ) ? $col_sign['data'] : '' ); ?>" value="<?php echo esc_attr( !empty( $col_sign['value'] ) ? $col_sign['value'] : '' ); ?>"<?php echo ( !empty( $col_sign['value'] )  && !empty ($postdata['col-sign'][$sign] ) && $col_sign['value'] ==$postdata['col-sign'][$sign] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $col_sign['name'] ) ? $col_sign['name'] : '' ); ?></option>
				<?php
				if ( !empty( $col_sign['value'] ) && !empty( $col_sign['data'] ) && !empty($postdata['col-sign'][$sign] ) &&$postdata['col-sign'][$sign] == $col_sign['value'] ) $sign_img_src = $col_sign['data'];
				endforeach;
				else :
				?>
				<option data-src="<?php echo esc_attr( !empty( $col_sign['data'] ) ? $col_sign['data'] : '' ); ?>" value="<?php echo esc_attr( !empty( $col_sign['value'] ) ? $col_sign['value'] : '' ); ?>"<?php echo ( !empty( $col_sign['value'] )  && !empty ($postdata['col-sign'][$sign] ) && $col_sign['value'] ==$postdata['col-sign'][$sign] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $col_sign['name'] ) ? $col_sign['name'] : '' ); ?></option>
				<?php 
				endif;
				if ( !empty( $col_sign['value'] ) && !empty( $col_sign['data'] ) && !empty($postdata['col-sign'][$sign] ) &&$postdata['col-sign'][$sign] == $col_sign['value'] ) $sign_img_src = $col_sign['data'];
				if ( !empty( $col_sign['value'] ) && !empty( $col_sign['data'] ) && empty( $sign_img_src ) )  $sign_img_src = $col_sign['data'];
				endforeach;
				?>
			</select>
			<div class="gwa-img-selector-media">
			<?php if ( !empty( $sign_img_src ) ) : ?>
			<img src="<?php echo esc_attr( $sign_img_src ); ?>">
			<?php endif; ?>
			</div>
		</td>				
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Sign.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>		
	<?php endforeach; ?>
	<tr data-parent-id="col-sign-type" data-parent-value="custom-img clean-ribbon clean-wribbon classic-ribbon clean-badge clean-wbadge clean-tag paperclip tape"<?php echo ( empty($postdata['col-sign-type'] ) || $postdata['col-sign-type'] == 'text' ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Alt Attribute', 'test_plugin_textdomain' ); ?></label></th>
		<td><input type="text" name="col-sign-alt" value="<?php echo isset( $postdata['col-sign-alt'] ) ? esc_attr( $postdata['col-sign-alt'] ) : ''; ?>"></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Alt attribute for image ribbons.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
    
	<!-- Text sign -->     
	<tr data-parent-id="col-sign-type" data-parent-value="text"<?php echo ( empty($postdata['col-sign-type'] ) || $postdata['col-sign-type'] != 'text' ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Text', 'test_plugin_textdomain' ); ?></label></th>
		<td><div class="gwa-input-btn"><input type="text" name="col-sign[text][content]" value="<?php echo isset( $postdata['col-sign']['text']['content'] ) ? esc_attr( $postdata['col-sign']['text']['content'] ) : ''; ?>" data-popup="sc-font-icon"><a href="#" data-action="popup" data-popup="sc-font-icon" title="<?php _e( 'Add Shortcode', 'test_plugin_textdomain' ); ?>"><i class="fa fa-code"></i></a></div></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Content of the sign.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
	<tr data-parent-id="col-sign-type" data-parent-value="text"<?php echo ( empty($postdata['col-sign-type'] ) || $postdata['col-sign-type'] != 'text' ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Font Family', 'test_plugin_textdomain' ); ?></label></th>
		<td>
			<select name="col-sign[text][font-family]">
				<?php 
				foreach ( (array)$test_plugin['fonts'] as $fonts ) : 
				if ( !empty( $fonts['group_name'] ) )	:
				?>
				<optgroup label="<?php echo esc_attr( $fonts['group_name'] ); ?>"></optgroup>
				<?php 
				foreach ( (array)$fonts['group_data'] as $font_data ) :
				?>
				<option value="<?php echo esc_attr( !empty( $font_data['value'] ) ? $font_data['value'] : '' ); ?>"<?php echo ( !empty( $font_data['value'] ) && isset( $postdata['col-sign']['text']['font-family'] ) && $font_data['value'] == $postdata['col-sign']['text']['font-family'] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $font_data['name'] ) ? $font_data['name'] : '' ); ?></option>
				<?php
				endforeach;
				else :
				?>
				<option value="<?php echo esc_attr( !empty( $fonts['value'] ) ? $fonts['value'] : '' ); ?>"<?php echo ( !empty( $fonts['value'] ) && isset( $postdata['col-sign']['text']['font-family'] ) && $fonts['value'] == $postdata['col-sign']['text']['font-family'] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $fonts['name'] ) ? $fonts['name'] : '' ); ?></option>
				<?php 
				endif;
				endforeach;
				?>
			</select>
		</td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Font family of the sign.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>			
	<tr data-parent-id="col-sign-type" data-parent-value="text"<?php echo ( empty($postdata['col-sign-type'] ) || $postdata['col-sign-type'] != 'text' ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Font Size', 'test_plugin_textdomain' ); ?> <span class="gwa-info">(px)</span></label></th>
		<td><input type="text" name="col-sign[text][font-size]" value="<?php echo isset( $postdata['col-sign']['text']['font-size'] ) ? esc_attr( (int)$postdata['col-sign']['text']['font-size'] ) : 12; ?>" class="gwa-input-mid"><div class="gwa-icon-btn"><a href="#" title="<?php esc_attr_e( 'Bold', 'test_plugin_textdomain' ); ?>" data-action="font-style-bold"<?php echo !empty( $postdata['col-sign']['text']['font-style']['bold'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-bold"></i><input type="hidden" name="col-sign[text][font-style][bold]" value="<?php echo !empty( $postdata['col-sign']['text']['font-style']['bold'] ) ? esc_attr( $postdata['col-sign']['text']['font-style']['bold'] ) : ''; ?>"></a><a href="#" title="<?php esc_attr_e( 'Italic', 'test_plugin_textdomain' ); ?>" data-action="font-style-italic"<?php echo !empty( $postdata['col-sign']['text']['font-style']['italic'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-italic"></i><input type="hidden" name="col-sign[text][font-style][italic]" value="<?php echo !empty( $postdata['col-sign']['text']['font-style']['italic'] ) ? esc_attr( $postdata['col-sign']['text']['font-style']['italic'] ) : ''; ?>"></a><a href="#" title="<?php esc_attr_e( 'Strikethrough', 'test_plugin_textdomain' ); ?>" data-action="font-style-strikethrough"<?php echo !empty( $postdata['col-sign']['text']['font-style']['strikethrough'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-strikethrough"></i><input type="hidden" name="col-sign[text][font-style][strikethrough]" value="<?php echo !empty( $postdata['col-sign']['text']['font-style']['strikethrough'] ) ? esc_attr( $postdata['col-sign']['text']['font-style']['strikethrough'] ) : ''; ?>"></a></div></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Font size of the sign text in pixels.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
	<tr data-parent-id="col-sign-type" data-parent-value="text"<?php echo ( empty($postdata['col-sign-type'] ) || $postdata['col-sign-type'] != 'text' ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Enable Shadow', 'test_plugin_textdomain' ); ?></label></th>
		<td><p><label><span class="gwa-checkbox<?php echo isset( $postdata['col-sign']['text']['shadow'] ) ? ' gwa-checked' : ''; ?>" tabindex="0"><span></span><input type="checkbox" name="col-sign[text][shadow]" tabindex="-1" value="1" <?php echo isset( $postdata['col-sign']['text']['shadow'] ) ? ' checked="checked"' : ''; ?>></span></label></p></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Whether to enable the shadow of the sign.', 'test_plugin_textdomain' ); ?></p></td>		
	</tr>    
	<tr data-parent-id="col-sign-type" data-parent-value="text"<?php echo ( empty($postdata['col-sign-type'] ) || $postdata['col-sign-type'] != 'text' ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Text Color', 'test_plugin_textdomain' ); ?></label></th>
		<td><label><div class="gwa-colorpicker gwa-colorpicker-inline" tabindex="0"><input type="hidden" name="col-sign[text][color]" value="<?php echo esc_attr( isset( $postdata['col-sign']['text']['color'] ) ? $postdata['col-sign']['text']['color'] : '' ); ?>"><span class="gwa-cp-picker"><span<?php echo ( !empty( $postdata['col-sign']['text']['color'] ) ? ' style="background:' . $postdata['col-sign']['text']['color'] . ';"' : '' ); ?>></span></span><span class="gwa-cp-label"><?php echo ( !empty( $postdata['col-sign']['text']['color'] ) ? $postdata['col-sign']['text']['color'] : '&nbsp;' ); ?></span><div class="gwa-cp-popup"><div class="gwa-cp-popup-inner"></div><div class="gwa-input-btn"><input type="text" tabindex="-1" value="<?php echo esc_attr( !empty( $postdata['col-sign']['text']['color'] ) ? $postdata['col-sign']['text']['color'] : '' ); ?>"><a href="#" data-action="cp-fav" tabindex="-1" title="<?php _e( 'Add To Favourites', 'test_plugin_textdomain' ); ?>"><i class="fa fa-heart"></i></a></div></div></div></label></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Text color of the sign.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
	<tr data-parent-id="col-sign-type" data-parent-value="text"<?php echo ( empty($postdata['col-sign-type'] ) || $postdata['col-sign-type'] != 'text' ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Background Color', 'test_plugin_textdomain' ); ?></label></th>
		<td><label><div class="gwa-colorpicker gwa-colorpicker-inline" tabindex="0"><input type="hidden" name="col-sign[text][bg-color]" value="<?php echo esc_attr( isset( $postdata['col-sign']['text']['bg-color'] ) ? $postdata['col-sign']['text']['bg-color'] : '' ); ?>"><span class="gwa-cp-picker"><span<?php echo ( !empty( $postdata['col-sign']['text']['bg-color'] ) ? ' style="background:' . $postdata['col-sign']['text']['bg-color'] . ';"' : '' ); ?>></span></span><span class="gwa-cp-label"><?php echo ( !empty( $postdata['col-sign']['text']['bg-color'] ) ? $postdata['col-sign']['text']['bg-color'] : '&nbsp;' ); ?></span><div class="gwa-cp-popup"><div class="gwa-cp-popup-inner"></div><div class="gwa-input-btn"><input type="text" tabindex="-1" value="<?php echo esc_attr( !empty( $postdata['col-sign']['text']['bg-color'] ) ? $postdata['col-sign']['text']['bg-color'] : '' ); ?>"><a href="#" data-action="cp-fav" tabindex="-1" title="<?php _e( 'Add To Favourites', 'test_plugin_textdomain' ); ?>"><i class="fa fa-heart"></i></a></div></div></div></label></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Background color of the sign.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
    <tr data-parent-id="col-sign-type" data-parent-value="text"<?php echo ( empty($postdata['col-sign-type'] ) || $postdata['col-sign-type'] != 'text' ? ' style="display:none;"' : '' ); ?>>
        <th><label><?php _e( 'Background Gradient?', 'test_plugin_textdomain' ); ?></label></th>
        <td><p><label><span class="gwa-checkbox<?php echo !empty( $postdata['col-sign']['text']['bg-grad'] ) ? ' gwa-checked' : ''; ?>" tabindex="0"><span></span><input type="checkbox" name="col-sign[text][bg-grad]" tabindex="-1" value="1" <?php echo !empty( $postdata['col-sign']['text']['bg-grad'] ) ? ' checked="checked"' : ''; ?>></span></label></p></td>
        <td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Whether to enable background gradients.', 'test_plugin_textdomain' ); ?></p></td>
    </tr>
	<tr data-parent-id="col-sign[text][bg-grad]" data-parent-value="on">
		<th><label><?php _e( 'Background Color', 'test_plugin_textdomain' ); ?> 2</label></th>
		<td><label><div class="gwa-colorpicker gwa-colorpicker-inline" tabindex="0"><input type="hidden" name="col-sign[text][bg-color2]" value="<?php echo esc_attr( isset( $postdata['col-sign']['text']['bg-color2'] ) ? $postdata['col-sign']['text']['bg-color2'] : '' ); ?>"><span class="gwa-cp-picker"><span<?php echo ( !empty( $postdata['col-sign']['text']['bg-color2'] ) ? ' style="background:' . $postdata['col-sign']['text']['bg-color2'] . ';"' : '' ); ?>></span></span><span class="gwa-cp-label"><?php echo ( !empty( $postdata['col-sign']['text']['bg-color2'] ) ? $postdata['col-sign']['text']['bg-color2'] : '&nbsp;' ); ?></span><div class="gwa-cp-popup"><div class="gwa-cp-popup-inner"></div><div class="gwa-input-btn"><input type="text" tabindex="-1" value="<?php echo esc_attr( !empty( $postdata['col-sign']['text']['bg-color2'] ) ? $postdata['col-sign']['text']['bg-color2'] : '' ); ?>"><a href="#" data-action="cp-fav" tabindex="-1" title="<?php _e( 'Add To Favourites', 'test_plugin_textdomain' ); ?>"><i class="fa fa-heart"></i></a></div></div></div></label></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Secondary background color of gradient.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>     
	<tr data-parent-id="col-sign[text][bg-grad]" data-parent-value="on">
		<th><label><?php _e( 'Bg Gradient Angle', 'test_plugin_textdomain' ); ?> <span class="gwa-info">(deg)</span></label></th>
		<td><input type="text" name="col-sign[text][bg-grad-angle]" value="<?php echo esc_attr( isset( $postdata['col-sign']['text']['bg-grad-angle'] ) ? (int)$postdata['col-sign']['text']['bg-grad-angle'] : 0 ); ?>"></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Angle of background gradient in degrees.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>         
</table>   
<div class="gwa-table-separator" data-parent-id="col-sign-type" data-parent-value="*"></div>
<table class="gwa-table">    
	<!-- /Text sign -->	    
    <tr data-parent-id="col-sign-type" data-parent-value="*"<?php echo ( empty($postdata['col-sign-type'] ) ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Alignment', 'test_plugin_textdomain' ); ?></label></th>
		<td>
			<select name="col-sign-align">
				<option value="left"<?php echo isset($postdata['col-sign-align'] ) && $postdata['col-sign-align'] == 'left' ? ' selected="selected"' : ''; ?>><?php _e( 'Left', 'test_plugin_textdomain' ); ?></option>
				<option value="right"<?php echo isset($postdata['col-sign-align'] ) && $postdata['col-sign-align'] == 'right' ? ' selected="selected"' : ''; ?>><?php _e( 'Right', 'test_plugin_textdomain' ); ?></option>
			</select>							
		</td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Horizontal alignment of the sign.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
    <tr data-parent-id="col-sign-type" data-parent-value="*"<?php echo ( empty($postdata['col-sign-type'] ) ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Left/Right & Top Pos.', 'test_plugin_textdomain' ); ?> <span class="gwa-info">(px)</span></label></th>
		<td><input type="text" name="col-sign-position[posx]" value="<?php echo isset( $postdata['col-sign-position']['posx'] ) ? esc_attr( (int)$postdata['col-sign-position']['posx'] ) : 0; ?>" class="gwa-input-mid"><input type="text" name="col-sign-position[posy]" value="<?php echo isset( $postdata['col-sign-position']['posy'] ) ? esc_attr( (int)$postdata['col-sign-position']['posy'] ) : 0; ?>" class="gwa-input-mid"></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Left or Right - depending on the alignment - and the Top position of the sign.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>    		
	<tr data-parent-id="col-sign-type" data-parent-value="*"<?php echo ( empty($postdata['col-sign-type'] ) ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Link', 'test_plugin_textdomain' ); ?></label></th>
		<td><input type="text" name="col-sign-link[url]" value="<?php echo esc_attr( isset($postdata['col-sign-link']['url'] ) ? $postdata['col-sign-link']['url'] : '' ); ?>"></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'URL of the sign link. Leave blank if you don\'t want the sign to be linkable.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
	<tr data-parent-id="col-sign-type" data-parent-value="*"<?php echo ( empty($postdata['col-sign-type'] ) ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Open In New Window?', 'test_plugin_textdomain' ); ?></label></th>
		<td><p><label><span class="gwa-checkbox<?php echo isset($postdata['col-sign-link']['target'] ) ? ' gwa-checked' : ''; ?>" tabindex="0"><span></span><input type="checkbox" name="col-sign-link[target]" tabindex="-1" value="1" <?php echo isset($postdata['col-sign-link']['target'] ) ? ' checked="checked"' : ''; ?>></span></label></p></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Whether to open the link in a new page.', 'test_plugin_textdomain' ); ?></p></td>									
	</tr>
	<tr data-parent-id="col-sign-type" data-parent-value="*"<?php echo ( empty($postdata['col-sign-type'] ) ? ' style="display:none;"' : '' ); ?>>
		<th><label><?php _e( 'Nofollow Link?', 'test_plugin_textdomain' ); ?></label></th>
		<td><p><label><span class="gwa-checkbox<?php echo isset($postdata['col-sign-link']['nofollow'] ) ? ' gwa-checked' : ''; ?>" tabindex="0"><span></span><input type="checkbox" name="col-sign-link[nofollow]" tabindex="-1" value="1" <?php echo isset($postdata['col-sign-link']['nofollow'] ) ? ' checked="checked"' : ''; ?>></span></label></p></td>                                                                                
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Whether to tell the search engines "Don\'t follow the link".', 'test_plugin_textdomain' ); ?></p></td>
	</tr>																																
</table>

<?php
$content = ob_get_clean();
$content = apply_filters( "test_plugin_admin_editor_popup_{$action_type}_{$skin}", $content, ( !empty( $postdata ) ? $postdata : '' ) );
echo $content;
?>