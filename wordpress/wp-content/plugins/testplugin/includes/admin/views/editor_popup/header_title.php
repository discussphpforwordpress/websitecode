<?php
/**
 * Editor popup - Header title view
 */
 
// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'DX_TestPlugin' ) ) die;
  
// Get column type
$col_type = isset( $_POST['col_type'] ) ? $_POST['col_type'] : '';

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
<div class="gwa-popup-tab-contents">
	<div class="gwa-popup-tab-content gwa-current">
<table class="gwa-table">
	<tr>
		<th><label><?php _e( 'Title', 'test_plugin_textdomain' ); ?></label></th>
		<td><div class="gwa-input-btn"><input type="text" name="title[content]" value="<?php echo isset( $postdata['title']['content'] ) ? esc_attr( $postdata['title']['content'] ) : ''; ?>" data-popup="sc-font-icon" data-preview="<?php esc_attr_e( 'Content', 'test_plugin_textdomain' ); ?>"><a href="#" data-action="popup" data-popup="sc-font-icon" title="<?php _e( 'Add Shortcode', 'test_plugin_textdomain' ); ?>"><i class="fa fa-code"></i></a></div></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Title of the pricing table.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>
	<?php if ( $col_type == 'team' || $col_type == 'cteam' ) : ?> 
	<tr>
		<th><label><?php _e( 'Subtitle', 'test_plugin_textdomain' ); ?></label></th>
		<td><div class="gwa-input-btn"><input type="text" name="subtitle[content]" value="<?php echo isset( $postdata['subtitle']['content'] ) ? esc_attr( $postdata['subtitle']['content'] ) : ''; ?>" data-popup="sc-font-icon"><a href="#" data-action="popup" data-popup="sc-font-icon" subtitle="<?php _e( 'Add Shortcode', 'test_plugin_textdomain' ); ?>"><i class="fa fa-code"></i></a></div></td>
		<td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Subtitle of the pricing table.', 'test_plugin_textdomain' ); ?></p></td>
	</tr>    
    <?php endif; ?>   
</table>
	</div>
    <div class="gwa-popup-tab-content">
		<?php if ( $col_type == 'team' || $col_type == 'cteam' ) : ?> 
        <div class="gwa-section"><span><?php _e( 'Title Style', 'test_plugin_textdomain' ); ?></span></div>      
        <?php endif; ?>     
		<table class="gwa-table">    
            <tr>
                <th><label><?php _e( 'Font Family', 'test_plugin_textdomain' ); ?></label></th>
                <td>
                    <select name="title[font-family]">
                        <?php 
                        foreach ( (array)$test_plugin['fonts'] as $fonts ) : 
                        if ( !empty( $fonts['group_name'] ) )	:
                        ?>
                        <optgroup label="<?php echo esc_attr( $fonts['group_name'] ); ?>"></optgroup>
                        <?php 
                        foreach ( (array)$fonts['group_data'] as $font_data ) :
                        ?>
                        <option value="<?php echo esc_attr( !empty( $font_data['value'] ) ? $font_data['value'] : '' ); ?>"<?php echo ( !empty( $font_data['value'] ) && isset( $postdata['title']['font-family'] ) && $font_data['value'] == $postdata['title']['font-family'] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $font_data['name'] ) ? $font_data['name'] : '' ); ?></option>
                        <?php
                        endforeach;
                        else :
                        ?>
                        <option value="<?php echo esc_attr( !empty( $fonts['value'] ) ? $fonts['value'] : '' ); ?>"<?php echo ( !empty( $fonts['value'] ) && isset( $postdata['title']['font-family'] ) && $fonts['value'] == $postdata['title']['font-family'] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $fonts['name'] ) ? $fonts['name'] : '' ); ?></option>
                        <?php 
                        endif;
                        endforeach;
                        ?>
                    </select>
                </td>
                <td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Font family of the title.', 'test_plugin_textdomain' ); ?></p></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Font Size / Line H.', 'test_plugin_textdomain' ); ?> <span class="gwa-info">(px)</span></label></th>
                <td><input type="text" name="title[font-size]" value="<?php echo isset( $postdata['title']['font-size'] ) ? esc_attr( (int)$postdata['title']['font-size'] ) : 18; ?>" class="gwa-input-mid"><input type="text" name="title[line-height]" value="<?php echo isset( $postdata['title']['line-height'] ) ? esc_attr( (int)$postdata['title']['line-height'] ) : 16; ?>" class="gwa-input-mid"><div class="gwa-icon-btn"><a href="#" title="<?php esc_attr_e( 'Bold', 'test_plugin_textdomain' ); ?>" data-action="font-style-bold"<?php echo !empty( $postdata['title']['font-style']['bold'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-bold"></i><input type="hidden" name="title[font-style][bold]" value="<?php echo !empty( $postdata['title']['font-style']['bold'] ) ? esc_attr( $postdata['title']['font-style']['bold'] ) : ''; ?>"></a><a href="#" title="<?php esc_attr_e( 'Italic', 'test_plugin_textdomain' ); ?>" data-action="font-style-italic"<?php echo !empty( $postdata['title']['font-style']['italic'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-italic"></i><input type="hidden" name="title[font-style][italic]" value="<?php echo !empty( $postdata['title']['font-style']['italic'] ) ? esc_attr( $postdata['title']['font-style']['italic'] ) : ''; ?>"></a><a href="#" title="<?php esc_attr_e( 'Strikethrough', 'test_plugin_textdomain' ); ?>" data-action="font-style-strikethrough"<?php echo !empty( $postdata['title']['font-style']['strikethrough'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-strikethrough"></i><input type="hidden" name="title[font-style][strikethrough]" value="<?php echo !empty( $postdata['title']['font-style']['strikethrough'] ) ? esc_attr( $postdata['title']['font-style']['strikethrough'] ) : ''; ?>"></a></div></td>
                <td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Font size and line height of the title in pixels.', 'test_plugin_textdomain' ); ?></p></td>
            </tr>            
		</table>
		<?php if ( $col_type == 'team' || $col_type == 'cteam' ) : ?> 
        <div class="gwa-section"><span><?php _e( 'Subtitle Style', 'test_plugin_textdomain' ); ?></span></div>
        <table class="gwa-table">
            <tr>
                <th><label><?php _e( 'Font Family', 'test_plugin_textdomain' ); ?></label></th>
                <td>
                    <select name="subtitle[font-family]">
                        <?php 
                        foreach ( (array)$test_plugin['fonts'] as $fonts ) : 
                        if ( !empty( $fonts['group_name'] ) )	:
                        ?>
                        <optgroup label="<?php echo esc_attr( $fonts['group_name'] ); ?>"></optgroup>
                        <?php 
                        foreach ( (array)$fonts['group_data'] as $font_data ) :
                        ?>
                        <option value="<?php echo esc_attr( !empty( $font_data['value'] ) ? $font_data['value'] : '' ); ?>"<?php echo ( !empty( $font_data['value'] ) && isset( $postdata['title']['font-family'] ) && $font_data['value'] == $postdata['title']['font-family'] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $font_data['name'] ) ? $font_data['name'] : '' ); ?></option>
                        <?php
                        endforeach;
                        else :
                        ?>
                        <option value="<?php echo esc_attr( !empty( $fonts['value'] ) ? $fonts['value'] : '' ); ?>"<?php echo ( !empty( $fonts['value'] ) && isset( $postdata['title']['font-family'] ) && $fonts['value'] == $postdata['title']['font-family'] ? ' selected="selected"' : '' ); ?>><?php echo ( !empty( $fonts['name'] ) ? $fonts['name'] : '' ); ?></option>
                        <?php 
                        endif;
                        endforeach;
                        ?>
                    </select>
                <td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Font family of the subtitle.', 'test_plugin_textdomain' ); ?></p></td>
            </tr>			
            <tr>
                <th><label><?php _e( 'Font Size / Line H.', 'test_plugin_textdomain' ); ?> <span class="gwa-info">(px)</span></label></th>
                <td><input type="text" name="subtitle[font-size]" value="<?php echo isset( $postdata['title']['font-size'] ) ? esc_attr( (int)$postdata['title']['font-size'] ) : 12; ?>" class="gwa-input-mid"><input type="text" name="subtitle[line-height]" value="<?php echo isset( $postdata['title']['line-height'] ) ? esc_attr( (int)$postdata['title']['line-height'] ) : 16; ?>" class="gwa-input-mid"><div class="gwa-icon-btn"><a href="#" subtitle="<?php esc_attr_e( 'Bold', 'test_plugin_textdomain' ); ?>" data-action="font-style-bold"<?php echo !empty( $postdata['title']['font-style']['bold'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-bold"></i><input type="hidden" name="subtitle[font-style][bold]" value="<?php echo !empty( $postdata['title']['font-style']['bold'] ) ? esc_attr( $postdata['title']['font-style']['bold'] ) : ''; ?>"></a><a href="#" subtitle="<?php esc_attr_e( 'Italic', 'test_plugin_textdomain' ); ?>" data-action="font-style-italic"<?php echo !empty( $postdata['title']['font-style']['italic'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-italic"></i><input type="hidden" name="subtitle[font-style][italic]" value="<?php echo !empty( $postdata['title']['font-style']['italic'] ) ? esc_attr( $postdata['title']['font-style']['italic'] ) : ''; ?>"></a><a href="#" subtitle="<?php esc_attr_e( 'Strikethrough', 'test_plugin_textdomain' ); ?>" data-action="font-style-strikethrough"<?php echo !empty( $postdata['title']['font-style']['strikethrough'] ) ? ' class="gwa-current"' : ''; ?>><i class="fa fa-strikethrough"></i><input type="hidden" name="subtitle[font-style][strikethrough]" value="<?php echo !empty( $postdata['title']['font-style']['strikethrough'] ) ? esc_attr( $postdata['title']['font-style']['strikethrough'] ) : ''; ?>"></a></div></td>
                <td class="gwa-abox-info"><p class="gwa-info"><i class="fa fa-info-circle"></i><?php _e( 'Font size and line height of the subtitle in pixels.', 'test_plugin_textdomain' ); ?></p></td>
            </tr>
        </table>             
        <?php endif; ?>                      
    </div>
</div>

<?php
$content = ob_get_clean();
$content = apply_filters( "test_plugin_admin_editor_popup_{$action_type}_{$skin}", $content, ( !empty( $postdata ) ? $postdata : '' ) );
echo $content;
?>
