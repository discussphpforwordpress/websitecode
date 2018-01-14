<?php
/**
 * Editor popup - Footer row view
 */


// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die; 

$skin = isset( $_POST['skin'] ) ? sanitize_key( $_POST['skin'] ) : 'clean';
$action_type = isset( $_POST['_action_type'] ) ? sanitize_key( $_POST['_action_type'] ) : '';

ob_start();

// Define tabs
add_action( 'test_plugin_editor_popup_content_before_html', 'popup_tabs' );

function popup_tabs() {
	
	?>
	<div class="gwa-popup-tabs gwa-clearfix">
    	<div class="gwa-popup-tab gwa-current"><?php _e( 'General', 'test_plugin_textdomain' ); ?></div>
        <div class="gwa-popup-tab"><?php _e( 'Style', 'test_plugin_textdomain' ); ?></div>   
    </div>
    <?php
}
?>

<!-- Type Selector -->
<table class="gwa-table">							
	<tr>
		<th><label><?php _e( 'Row Type', 'test_plugin_textdomain' ); ?></label></th>
		<td>
			<select name="type" data-title="type">
				<option value="button"<?php echo !empty ( $postdata['type'] ) && $postdata['type'] == 'button' ? ' selected="selected"' : ''; ?>><?php _e( 'Button', 'test_plugin_textdomain' ); ?></option>
				<option value="html"<?php echo !empty ( $postdata['type'] ) && $postdata['type'] == 'html' ? ' selected="selected"' : ''; ?>><?php _e( 'HTML Content', 'test_plugin_textdomain' ); ?></option>							
			</select>							
		</td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Type of the footer row.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
</table>
<div class="gwa-table-separator"></div>
<!-- / Type Selector -->			

<div class="gwa-popup-tab-contents">
	<div class="gwa-popup-tab-content gwa-current">

    <!-- Button -->
    <table class="gwa-table" data-parent-id="type" data-parent-value="button"<?php echo !empty( $postdata['type'] ) && $postdata['type'] != 'button' ? ' style="display:none;"' : ''; ?>>
        <?php include( 'part/button_general.php' ); ?>
    </table>
    <!-- / Button -->

    <!-- HTML Content -->
    <table class="gwa-table" data-parent-id="type" data-parent-value="html"<?php echo empty( $postdata['type'] ) || ( !empty( $postdata['type'] ) && $postdata['type'] != 'html' ) ? ' style="display:none;"' : ''; ?>>
        <tr class="gwa-row-fullwidth">
            <th><label><?php _e( 'Content', 'test_plugin_textdomain' ); ?></label></th>
            <td><div class="gwa-textarea-code"><div class="gwa-textarea-btn-top"><span class="gwa-textarea-align"><input type="hidden" name="html[text-align]" value="<?php echo !empty( $postdata['html']['text-align'] ) ? esc_attr( $postdata['html']['text-align'] ) : ''; ?>"><a href="#" data-align="left" title="<?php _e( 'Align Left', 'test_plugin_textdomain' ); ?>" class="<?php echo !empty( $postdata['html']['text-align'] ) && $postdata['html']['text-align'] == 'left' ? 'gwa-current' : ''; ?>"><i class="fa fa-align-left"></i></a><a href="#" data-align="" title="<?php _e( 'Align Center', 'test_plugin_textdomain' ); ?>" class="<?php echo empty( $postdata['html']['text-align'] ) ? 'gwa-current' : ''; ?>"><i class="fa fa-align-center"></i></a><a href="#" data-align="right" title="<?php _e( 'Align Right', 'test_plugin_textdomain' ); ?>" class="<?php echo !empty( $postdata['html']['text-align'] ) && $postdata['html']['text-align'] == 'right' ? 'gwa-current' : ''; ?>"><i class="fa fa-align-right"></i></a></span><a href="#" data-action="popup"  data-popup="sc-row-icon" title="<?php _e( 'Add Shortcode', 'test_plugin_textdomain' ); ?>" class="gwa-fr"><i class="fa fa-code"></i></a></div><textarea name="html[content]" rows="5" data-popup="sc-row-icon" data-editor-height="180" data-editor-type="htmlmixed" data-preview="<?php esc_attr_e( 'Content', 'test_plugin_textdomain' ); ?>"><?php echo isset( $postdata['html']['content'] ) ? esc_textarea( $postdata['html']['content'] ) : '' ; ?></textarea></div></td>
            <td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Content of the row.', 'test_plugin_textdomain' ); ?></p></td>
        </tr>
    </table>
    <!-- / HTML Content -->
    </div>
    
	<div class="gwa-popup-tab-content">    
    
    <!-- Button -->
    <table class="gwa-table" data-parent-id="type" data-parent-value="button"<?php echo !empty( $postdata['type'] ) && $postdata['type'] != 'button' ? ' style="display:none;"' : ''; ?>>
        <?php include( 'part/button_style.php' ); ?>
		<?php include( 'part/button_style_hover.php' ); ?>	
    </table>
    <!-- / Button -->    
    
     <!-- HTML Content -->
     <table class="gwa-table" data-parent-id="type" data-parent-value="html"<?php echo empty( $postdata['type'] ) || ( !empty( $postdata['type'] ) && $postdata['type'] != 'html' ) ? ' style="display:none;"' : ''; ?>>
        <tr>
            <th><label><?php _e( 'Font Family', 'test_plugin_textdomain' ); ?></label></th>
            <td>
                <select name="html[font-family]">
                    <?php 
                    foreach ( (array)$test_plugin['fonts'] as $fonts ) : 
                    if ( !empty( $fonts['group_name'] ) )	:
                    ?>
                    <optgroup label="<?php echo esc_attr( $fonts['group_name'] ); ?>"></optgroup>
                    <?php 
                    foreach ( (array)$fonts['group_data'] as $font_data ) :
                    ?>
                    <option value="<?php echo esc_attr( !empty( $font_data['value'] ) ? $font_data['value'] : '' ); ?>"<?php echo ( !empty( $font_data['value'] ) && isset( $postdata['html']['font-family'] ) && $font_data['value'] == $postdata['html']['font-family'] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $font_data['name'] ) ? $font_data['name'] : '' ); ?></option>
                    <?php
                    endforeach;
                    else :
                    ?>
                    <option value="<?php echo esc_attr( !empty( $fonts['value'] ) ? $fonts['value'] : '' ); ?>"<?php echo ( !empty( $fonts['value'] ) && isset( $postdata['html']['font-family'] ) && $fonts['value'] == $postdata['html']['font-family'] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $fonts['name'] ) ? $fonts['name'] : '' ); ?></option>
                    <?php 
                    endif;
                    endforeach;
                    ?>
                </select>
            <td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Font family of the row content.', 'test_plugin_textdomain' ); ?></p></td>
        </tr>							
        <tr>
            <th><label><?php _e( 'Font Size / Line H.', 'test_plugin_textdomain' ); ?> <span class="gwa-info">(px)</span></label></th>
            <td><input type="text" name="html[font-size]" value="<?php echo !empty( $postdata['html']['font-size'] ) ? esc_attr( $postdata['html']['font-size'] ) : 12; ?>" class="gwa-input-mid"><input type="text" name="html[line-height]" value="<?php echo !empty( $postdata['html']['line-height'] ) ? esc_attr( $postdata['html']['line-height'] ) : 16; ?>" class="gwa-input-mid"><div class="gwa-icon-btn"><a href="#" title="<?php esc_attr_e( 'Bold', 'test_plugin_textdomain' ); ?>" data-action="font-style-bold"<?php echo !empty( $postdata['html']['font-style']['bold'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-bold"></i><input type="hidden" name="html[font-style][bold]" value="<?php echo !empty( $postdata['html']['font-style']['bold'] ) ? esc_attr( $postdata['html']['font-style']['bold'] ) : ''; ?>"></a><a href="#" title="<?php esc_attr_e( 'Italic', 'test_plugin_textdomain' ); ?>" data-action="font-style-italic"<?php echo !empty( $postdata['html']['font-style']['italic'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-italic"></i><input type="hidden" name="html[font-style][italic]" value="<?php echo !empty( $postdata['html']['font-style']['italic'] ) ? esc_attr( $postdata['html']['font-style']['italic'] ) : ''; ?>"></a><a href="#" title="<?php esc_attr_e( 'Strikethrough', 'test_plugin_textdomain' ); ?>" data-action="font-style-strikethrough"<?php echo !empty( $postdata['html']['font-style']['strikethrough'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-strikethrough"></i><input type="hidden" name="html[font-style][strikethrough]" value="<?php echo !empty( $postdata['html']['font-style']['strikethrough'] ) ? esc_attr( $postdata['html']['font-style']['strikethrough'] ) : ''; ?>"></a></div></td>
            <td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Font size and line height of the row content in pixels.', 'test_plugin_textdomain' ); ?></p></td>
        </tr>
    </table>			
    <!-- / HTML Content -->
	</div>
</div>

<?php
$content = ob_get_clean();
$content = apply_filters( "test_plugin_admin_editor_popup_{$action_type}_{$skin}", $content, ( !empty( $postdata ) ? $postdata : '' ) );
echo $content;
?>