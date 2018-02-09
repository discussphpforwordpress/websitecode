<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! dt_is_woocommerce_enabled() ) {
	return;
}

/**
 * DT Products Carousel.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Products Carousel", 'the7mk2'),
	"base" => "dt_products_carousel",
	"icon" => "dt_vc_ico_products",
	"class" => "dt_products_carousel",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"admin_enqueue_css" => array(get_template_directory_uri().'/fonts/icomoon-arrows-the7/style.css'),
	"params" => array(
		// General group.
		array(
			'heading' => __('Show:', 'the7mk2'),
			'param_name' => 'show_products',
			'type' => 'dropdown',
			'std' => 'all_products',
			'value' => array(
				'All products' => 'all_products',
				'Sale products' => 'sale_products',
				'Featured products' => 'featured_products',
				'Top rated products' => 'top_products',
				'Best selling products' => 'best_selling_products',
				'Products from categories' => 'categories_products',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose product categories', 'the7mk2' ),
			'param_name' => 'category_ids',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
				// In UI show results except selected. NB! You should manually check values in backend
			),
			'save_always' => true,
			'description' => __( 'Leave empty to show products from all categories. Input product category name to see suggestions.', 'the7mk2' ),
			"dependency" => Array("element" => "show_products", "value" => array("categories_products"))
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose products', 'the7mk2' ),
			'param_name' => 'ids',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
				'unique_values' => true,
				// In UI show results except selected. NB! You should manually check values in backend
			),
			'save_always' => true,
			'description' => __( 'Leave empty to show all products. Input product ID or product SKU or product title to see suggestions.', 'the7mk2' ),
			"dependency" => Array("element" => "show_products", "value" => array("all_products"))
		),
		array(
			'heading' => __('Order by', 'the7mk2'),
			'param_name' => 'orderby',
			'type' => 'dropdown',
			'value' => array(
				'日期' => 'date',
				'ID' => 'id',
				'作者'=> 'author',
				'菜单顺序'=> 'menu_order',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'heading' => __('Total number of products ', 'the7mk2'),
			'param_name' => 'dis_posts_total',
			'type' => 'dt_number',
			'value' => '12',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'description' => __('Leave empty to display all posts.', 'the7mk2'),
		),
		// - Layout Settings.
		array(
			'heading' => __( 'Layout Settings', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),

		array(
			'heading' => __('Text & button position:', 'the7mk2'),
			'param_name' => 'layout',
			'type' => 'dropdown',
			'value' => array(
				'访客和按钮在图片下面' => 'content_below_img',
				'文字在图片下面，按钮在图片上' => 'btn_on_img',
				'文字在图片下面，按钮在图片悬停出现' => 'btn_on_img_hover',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),

		array(
			"heading" => __( "Columns & Responsiveness", 'the7mk2' ),
			"param_name" => "dt_title_general",
			"type" => "dt_title",
		),
		array(
			"heading" => __("Desktop", 'the7mk2'),
			"param_name" => "slides_on_desk",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_media-xs vc_col-xs-2 vc_column",
		),
		array(
			"heading" => __("Laptop", 'the7mk2'),
			"param_name" => "slides_on_lapt",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_media-xs vc_col-xs-2 vc_column",
		),
		array(
			"heading" => __("Hor. tablet ", 'the7mk2'),
			"param_name" => "slides_on_h_tabs",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_media-xs vc_col-xs-2 vc_column",
		),
		array(
			"heading" => __("Vert. tablet", 'the7mk2'),
			"param_name" => "slides_on_v_tabs",
			"type" => "textfield",
			"value" => "2",
			"edit_field_class" => "vc_media-xs vc_col-xs-2 vc_column",
		),
		array(
			"heading" => __("Phone", 'the7mk2'),
			"param_name" => "slides_on_mob",
			"type" => "textfield",
			"value" => "1",
			"edit_field_class" => "vc_media-xs vc_col-xs-2 vc_column",
		),
		array(
			"heading" => __("Gap between columns ", 'the7mk2'),
			"param_name" => "item_space",
			"type" => "dt_number",
			"value" => "30",
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"heading" => __("Enable adaptive height", "the7mk2"),
			"param_name" => "adaptive_height",
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		array(
			"heading" => __( "Scrolling", 'the7mk2' ),
			"param_name" => "dt_title_general",
			"type" => "dt_title",
			"value" => "",
		),
		array(
			"heading" => __("Scroll mode", 'the7mk2'),
			"param_name" => "slide_to_scroll",
			"type" => "dropdown",
			"value" => array(
				"一次一张幻灯片" => "single",
				"所有幻灯片" => "all",
			),

			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			"heading" => __("Transition speed","the7mk2"),
			"param_name" => "speed",
			"type" => "dt_number",
			"value" => "600",
			"min" => "100",
			"max" => "10000",
			"step" => "100",
			"suffix" => "ms",
		),
		array(
			"heading" => __("Autoplay slidesâ€", "the7mk2"),
			"param_name" => "autoplay",
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		array(
			"heading" => __("Autoplay speed","the7mk2"),
			"param_name" => "autoplay_speed",
			"type" => "dt_number",
			"value" => "6000",
			"min" => "100",
			"max" => "10000",
			"step" => "10",
			"suffix" => "ms",
			"dependency" => Array("element" => "autoplay", "value" => array("y"))
		),
		array(
			'heading' => __( 'Extra Class', 'the7mk2' ),
			'param_name' => 'dt_title_general',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name (optional)","the7mk2"),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("Style particular elements differently - add a class name and refer to it in custom CSS.", "the7mk2"),
		),
		array(
			'type' => 'hidden',
			'param_name' => 'skus',
			"dependency" => Array("element" => "show_products", "value" => array("all_products"))
		),
		// PRODUCT group.
		// - Post Title.
		array(
			'heading'		=> __('Product titles & price', 'the7mk2'),
			'param_name'	=> 'custom_title_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use headings color.', 'the7mk2' ),
			'group' => __( 'Product', 'the7mk2' ),
		),
		// - Text.
		array(
			'heading'		=> __('Old price for sale products', 'the7mk2'),
			'param_name'	=> 'custom_price_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use secondary text color.', 'the7mk2' ),
			'group' => __( 'Product', 'the7mk2' ),
		),
		array(
			'heading' => __('Product rating', 'the7mk2'),
			'param_name' => 'product_rating',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Product', 'the7mk2' ),

		),
		array(
			'heading' => __('Product short description', 'the7mk2'),
			'param_name' => 'product_descr',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Product', 'the7mk2' ),

		),
		array(
			'heading'		=> __('Product description color', 'the7mk2'),
			'param_name'	=> 'custom_content_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use primary text color.', 'the7mk2' ),
			'group' => __( 'Product', 'the7mk2' ),
			'dependency'	=> array(
				'element'	=> 'product_descr',
				'value'		=> 'y',
			),
		),
		// Navigation group.
		array(
			"group" => __("Arrows", 'the7mk2'),
			"heading" => __("Show arrows", 'the7mk2'),
			"param_name" => "arrows",
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		array(
			"group" => __("Arrows", 'the7mk2'),
			"heading" => __( "Arrow Icon", 'the7mk2' ),
			"param_name" => "dt_title_arrows",
			"type" => "dt_title",
			"value" => "",
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			"group" => __("Arrows", 'the7mk2'),
			"heading" => __("Choose icon for 'Next Arrow'", "the7mk2"),
			"param_name" => "next_icon",
			"type" => "dt_navigation",
			"value" => "icon-ar-017-r",
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			"group" => __("Arrows", 'the7mk2'),
			"heading" => __("Choose icon  for 'Prev Arrow'", "the7mk2"),
			"param_name" => "prev_icon",
			"type" => "dt_navigation",
			"value" => "icon-ar-017-l",
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			"group" => __( "Arrows", 'the7mk2' ),
			"heading" => __("Arrow icon size", 'the7mk2'),
			"param_name" => "arrow_icon_size",
			"type" => "dt_number",
			"value" => "18px",
			"units" => "px",
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),

		array(
			"group" => __("Arrows", 'the7mk2'),
			"heading" => __( "Arrow Background", 'the7mk2' ),
			"param_name" => "dt_title_arrows",
			"type" => "dt_title",
			"value" => "",
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			"group" => __( "Arrows", 'the7mk2' ),
			"heading" => __("Width", 'the7mk2'),
			"param_name" => "arrow_bg_width",
			"type" => "dt_number",
			"value" => "36px",
			"units" => "x",
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
			"edit_field_class" => "vc_col-sm-3 vc_column dt_col_custom",
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Height', 'the7mk2'),
			'param_name' => 'arrow_bg_height',
			'type' => 'dt_number',
			'value' => '36px',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
			"edit_field_class" => "vc_col-sm-3 vc_column ",
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Arrow border radius', 'the7mk2'),
			'param_name' => 'arrow_border_radius',
			'type' => 'dt_number',
			'value' => '500px',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Arrow border width', 'the7mk2'),
			'param_name' => 'arrow_border_width',
			'type' => 'dt_number',
			'value' => '0',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			"group" => __("Arrows", 'the7mk2'),
			'heading' => __( 'Color Setting', 'the7mk2' ),
			'param_name' => 'dt_title_arrows',
			'type' => 'dt_title',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Arrow icon color', 'the7mk2'),
			'description' => __( "Leave empty to use accent color.", 'the7mk2' ),
			'param_name' => 'arrow_icon_color',
			'type' => 'colorpicker',
			'value' => '#ffffff',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Arrow border color', 'the7mk2'),
			'description' => __( "Leave empty to use accent color.", 'the7mk2' ),
			'param_name' => 'arrow_border_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			"group" => __("Arrows", 'the7mk2'),
			"heading" => __("Show arrow background", 'the7mk2'),
			"param_name" => "arrows_bg_show",
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Arrow background color', 'the7mk2'),
			'description' => __( "Leave empty to use accent color.", 'the7mk2' ),
			'param_name' => 'arrow_bg_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'arrows_bg_show',
				'value'		=> 'y',
			),
		),
		array(
			"group" => __("Arrows", 'the7mk2'),
			'heading' => __( 'Hover Color Setting', 'the7mk2' ),
			'param_name' => 'dt_title_arrows',
			'type' => 'dt_title',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Arrow icon color hover', 'the7mk2'),
			'description' => __( "Leave empty to use accent color.", 'the7mk2' ),
			'param_name' => 'arrow_icon_color_hover',
			'type' => 'colorpicker',
			'value' => 'rgba(255,255,255,0.75)',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Arrow border color hover ', 'the7mk2'),
			'description' => __( "Leave empty to use accent color.", 'the7mk2' ),
			'param_name' => 'arrow_border_color_hover',
			'type' => 'colorpicker',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			"group" => __("Arrows", 'the7mk2'),
			"heading" => __("Show arrow background hover", 'the7mk2'),
			"param_name" => "arrows_bg_hover_show",
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Arrow background hover color', 'the7mk2'),
			'description' => __( "Leave empty to use accent color.", 'the7mk2' ),
			'param_name' => 'arrow_bg_color_hover',
			'type' => 'colorpicker',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'arrows_bg_hover_show',
				'value'		=> 'y',
			),
		),
		// - Right arrow:
		array(
			"group" => __("Arrows", 'the7mk2'),
			'heading' => __( 'Right Arrow Position', 'the7mk2' ),
			'param_name' => 'dt_title_arrows',
			'type' => 'dt_title',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			"group" => __("Arrows", 'the7mk2'),
			"heading" => __("Icon paddings", 'the7mk2'),
			"param_name" => "r_arrow_icon_paddings",
			"type" => "dt_spacing",
			"value" => "0 0 0 0",
			"units" => "px",
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			"heading" => __("Vertical position", 'the7mk2'),
			"param_name" => "r_arrow_v_position",
			"type" => "dropdown",
			"value" => array(
				"中" => "center",
				"下" => "bottom",
				"上" => "top",
			),
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			"heading" => __("Horizontal position", 'the7mk2'),
			"param_name" => "r_arrow_h_position",
			"type" => "dropdown",
			"value" => array(
				"右" => "right",
				"中" => "center",
				"左" => "left",
			),
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Vertical offset', 'the7mk2'),
			'param_name' => 'r_arrow_v_offset',
			'type' => 'dt_number',
			'value' => '0',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Horizontal offset', 'the7mk2'),
			'param_name' => 'r_arrow_h_offset',
			'type' => 'dt_number',
			'value' => '-43px',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		// - Left arrow:
		array(
			"group" => __("Arrows", 'the7mk2'),
			'heading' => __( 'Left Arrow Position', 'the7mk2' ),
			'param_name' => 'dt_title_arrows',
			'type' => 'dt_title',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			"group" => __("Arrows", 'the7mk2'),
			"heading" => __("Icon paddings", 'the7mk2'),
			"param_name" => "l_arrow_icon_paddings",
			"type" => "dt_spacing",
			"value" => "0 0 0 0",
			"units" => "px",
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			"heading" => __("Vertical position", 'the7mk2'),
			"param_name" => "l_arrow_v_position",
			"type" => "dropdown",
			"value" => array(
				"中" => "center",
				"下" => "bottom",
				"上" => "top",
			),
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			"heading" => __("Horizontal position", 'the7mk2'),
			"param_name" => "l_arrow_h_position",
			"type" => "dropdown",
			"value" => array(
				"左" => "left",
				"右" => "right",
				"中" => "center",
			),
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Vertical offset', 'the7mk2'),
			'param_name' => 'l_arrow_v_offset',
			'type' => 'dt_number',
			'value' => '0',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Arrows', 'the7mk2' ),
			'heading' => __('Horizontal offset', 'the7mk2'),
			'param_name' => 'l_arrow_h_offset',
			'type' => 'dt_number',
			'value' => '-43px',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
		),
		//Arrows Responsiveness
		array(
			"group" => __("Arrows Responsiveness", 'the7mk2'),
			"heading" => __("Arrows responsiveness","the7mk2"),
			"param_name" => "arrow_responsiveness",
			"type" => "dropdown",
			"value" => array(
				"重新定位箭头" => "reposition-arrows",
				"按原样" => "no-changes",
				"隐藏箭头" => "hide-arrows",
			),
			'dependency'	=> array(
				'element'	=> 'arrows',
				'value'		=> 'y',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			"group" => __("Arrows Responsiveness", 'the7mk2'),
			'heading' => __('Enable if browser width is less then ', 'the7mk2'),
			'param_name' => 'hide_arrows_mobile_switch_width',
			'type' => 'dt_number',
			'value' => '778px',
			'units' => 'px',
			"dependency" => Array("element" => "arrow_responsiveness", "value" => array("hide-arrows")),
		),
		array(
			"group" => __("Arrows Responsiveness", 'the7mk2'),
			'heading' => __('Enable if browser width is less then ', 'the7mk2'),
			'param_name' => 'reposition_arrows_mobile_switch_width',
			'type' => 'dt_number',
			'value' => '778px',
			'units' => 'px',
			"dependency" => Array("element" => "arrow_responsiveness", "value" => array("reposition-arrows")),
		),
		array(
			"group" => __("Arrows Responsiveness", 'the7mk2'),
			'heading' => __('Left arrow horizontal offset', 'the7mk2'),
			'param_name' => 'l_arrows_mobile_h_position',
			'type' => 'dt_number',
			'value' => '10px',
			'units' => 'px',
			"dependency" => Array("element" => "arrow_responsiveness", "value" => array("reposition-arrows")),
		),
		array(
			"group" => __("Arrows Responsiveness", 'the7mk2'),
			'heading' => __('Right arrow horizontal offset', 'the7mk2'),
			'param_name' => 'r_arrows_mobile_h_position',
			'type' => 'dt_number',
			'value' => '10px',
			'units' => 'px',
			"dependency" => Array("element" => "arrow_responsiveness", "value" => array("reposition-arrows")),
		),
		//BULLETS
		array(
			"group" => __("Bullets", 'the7mk2'),
			"heading" => __("Show bullets", 'the7mk2'),
			"param_name" => "show_bullets",
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		array(
			"group" => __("Bullets", 'the7mk2'),
			'heading' => __( 'Bullets Style, Size & Color', 'the7mk2' ),
			'param_name' => 'dt_title_bullets',
			'type' => 'dt_title',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'show_bullets',
				'value'		=> 'y',
			),

		),
		array(
			"group" => __("Bullets", 'the7mk2'),
			"heading" => __("Choose bullets style","the7mk2"),
			"param_name" => "bullets_style",
			"type" => "dropdown",
			"value" => array(
				"小圆点行程" => "small-dot-stroke",
				"放大" => "scale-up",
				"行程" => "stroke",
				"填写" => "fill-in",
				"方形" => "ubax",
				"长方形" => "etefu",
			),
			'dependency'	=> array(
				'element'	=> 'show_bullets',
				'value'		=> 'y',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'group' => __( 'Bullets', 'the7mk2' ),
			'heading' => __('Bullets size', 'the7mk2'),
			'param_name' => 'bullet_size',
			'type' => 'dt_number',
			'value' => '10px',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'show_bullets',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Bullets', 'the7mk2' ),
			'heading' => __('Gap between bullets', 'the7mk2'),
			'param_name' => 'bullet_gap',
			'type' => 'dt_number',
			'value' => '16px',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'show_bullets',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Bullets', 'the7mk2' ),
			'heading' => __('Bullets color', 'the7mk2'),
			'description' => __( 'Leave empty to use accent color.', 'the7mk2' ),
			'param_name' => 'bullet_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'show_bullets',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Bullets', 'the7mk2' ),
			'heading' => __('Bullets hover color', 'the7mk2'),
			'description' => __( 'Leave empty to use accent color.', 'the7mk2' ),
			'param_name' => 'bullet_color_hover',
			'type' => 'colorpicker',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'show_bullets',
				'value'		=> 'y',
			),
		),
		array(
			"group" => __("Bullets", 'the7mk2'),
			'heading' => __( 'Bullets Position', 'the7mk2' ),
			'param_name' => 'dt_title_bullets',
			'type' => 'dt_title',
			'value' => '',
			'dependency'	=> array(
				'element'	=> 'show_bullets',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Bullets', 'the7mk2' ),
			"heading" => __("Vertical position", 'the7mk2'),
			"param_name" => "bullets_v_position",
			"type" => "dropdown",
			"value" => array(
				"下" => "bottom",
				"上" => "top",
				"中" => "center",
			),
			'dependency'	=> array(
				'element'	=> 'show_bullets',
				'value'		=> 'y',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'group' => __( 'Bullets', 'the7mk2' ),
			"heading" => __("Horizontal position", 'the7mk2'),
			"param_name" => "bullets_h_position",
			"type" => "dropdown",
			"value" => array(
				"中" => "center",
				"右" => "right",
				"左" => "left",
			),
			'dependency'	=> array(
				'element'	=> 'show_bullets',
				'value'		=> 'y',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'group' => __( 'Bullets', 'the7mk2' ),
			'heading' => __('Vertical offset', 'the7mk2'),
			'param_name' => 'bullets_v_offset',
			'type' => 'dt_number',
			'value' => '20px',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'show_bullets',
				'value'		=> 'y',
			),
		),
		array(
			'group' => __( 'Bullets', 'the7mk2' ),
			'heading' => __('Horizontal offset', 'the7mk2'),
			'param_name' => 'bullets_h_offset',
			'type' => 'dt_number',
			'value' => '0',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'show_bullets',
				'value'		=> 'y',
			),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'the7mk2' ),
			'param_name' => 'css_dt_blog_carousel',
			'group' => __( 'Design Options', 'the7mk2' )
		),
	),

) );

vc_map( array(
	'weight' => -1,
	'name' => __( 'Products Masonry & Grid', 'the7mk2' ),
	'base' => 'dt_products_masonry',
	'class' => 'dt_vc_sc_products_masonry',
	'icon' => 'dt_vc_ico_products',
	'category' => __( 'by Dream-Theme', 'the7mk2' ),
	'params' => array(
		// General group.
		array(
			'heading' => __('Show:', 'the7mk2'),
			'param_name' => 'show_products',
			'type' => 'dropdown',
			'std' => 'all_products',
			'value' => array(
				'所有产品' => 'all_products',
				'促销产品' => 'sale_products',
				'推荐产品' => 'featured_products',
				'好评产品' => 'top_products',
				'畅销产品' => 'best_selling_products',
				'分类产品' => 'categories_products',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose product categories', 'the7mk2' ),
			'param_name' => 'category_ids',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
				// In UI show results except selected. NB! You should manually check values in backend
			),
			'save_always' => true,
			'description' => __( 'Leave empty to show products from all categories. Input product category name to see suggestions.', 'the7mk2' ),
			"dependency" => Array("element" => "show_products", "value" => array("categories_products"))
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose products', 'the7mk2' ),
			'param_name' => 'ids',
			'settings' => array(
				'multiple' => true,
				'unique_values' => true,
				'min_length' => 0,
				// In UI show results except selected. NB! You should manually check values in backend
			),
			'save_always' => true,
			'description' => __( 'Leave empty to show all products. Input product ID or product SKU or product title to see suggestions.', 'the7mk2' ),
			"dependency" => Array("element" => "show_products", "value" => array("all_products"))
		),
		array(
			'heading' => __('Order by', 'the7mk2'),
			'param_name' => 'orderby',
			'type' => 'dropdown',
			'value' => array(
				'日期' => 'date',
				'ID' => 'id',
				'作者'=> 'author',
				'菜单顺序'=> 'menu_order',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// - Layout Settings.
		array(
			'heading' => __( 'Layout Settings', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Mode', 'the7mk2'),
			'param_name' => 'mode',
			'type' => 'dropdown',
			'value' => array(
				'切片' => 'masonry',
				'网格' => 'grid',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'heading' => __('Text & button position:', 'the7mk2'),
			'param_name' => 'layout',
			'type' => 'dropdown',
			'value' => array(
				'文字和按钮在图片下面' => 'content_below_img',
				'文字在图片下面，按钮在图片上' => 'btn_on_img',
				'文字在图片下面，按钮在图片悬停时出现' => 'btn_on_img_hover',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// - Columns & Responsiveness.
		array(
			'heading' => __( 'Columns & Responsiveness', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Responsiveness mode', 'the7mk2'),
			'param_name' => 'responsiveness',
			'type' => 'dropdown',
			'value' => array(
				'基于浏览器宽度' => 'browser_width_based',
				'基于文章宽度' => 'post_width_based',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// -- Browser width based.
		array(
			'heading' => __('Number of columns', 'the7mk2'),
			'param_name' => 'bwb_columns',
			'type' => 'dt_responsive_columns',
			'value' => 'desktop:4|h_tablet:3|v_tablet:2|phone:1',
			'dependency'	=> array(
				'element'	=> 'responsiveness',
				'value'		=> 'browser_width_based',
			),
		),
		// -- Post width based.
		array(
			'heading' => __('Column minimum width', 'the7mk2'),
			'param_name' => 'pwb_column_min_width',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'dependency'	=> array(
				'element'	=> 'responsiveness',
				'value'		=> 'post_width_based',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'heading' => __('Desired columns number', 'the7mk2'),
			'param_name' => 'pwb_columns',
			'type' => 'dt_number',
			'value' => '',
			'units' => '',
			'max' => 12,
			'dependency'	=> array(
				'element'	=> 'responsiveness',
				'value'		=> 'post_width_based',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'heading' => __('Gap between columns', 'the7mk2'),
			'param_name' => 'gap_between_posts',
			'type' => 'dt_number',
			'value' => '15px',
			'units' => 'px',
			'description' => __('Please note that this setting affects post paddings. So, for example: a value 10px will give you 20px gaps between posts)', 'the7mk2'),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// - Pagination.
		array(
			'heading' => __( 'Pagination', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Pagination mode', 'the7mk2'),
			'param_name' => 'loading_mode',
			'type' => 'dropdown',
			'std' => 'disabled',
			'value' => array(
				'禁用' => 'disabled',
				'标准' => 'standard',
				'JavaScript页面' => 'js_pagination',
				'"加载更多"按钮' => 'js_more',
				'无限滚动' => 'js_lazy_loading',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// -- Disabled.
		array(
			'heading' => __('Total number of products ', 'the7mk2'),
			'param_name' => 'dis_posts_total',
			'type' => 'dt_number',
			'value' => '12',
			'save_always' => true, // Allow to use different defaults in interface and shortcode.
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'description' => __('Leave empty to display all posts.', 'the7mk2'),
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'disabled',
			),
		),
		// -- Standard.
		array(
			'heading' => __('Number of posts to display on one page', 'the7mk2'),
			'param_name' => 'st_posts_per_page',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'standard',
			),
			'description' => __('Leave empty to use number from wp settings.', 'the7mk2'),
		),
		array(
			'heading' => __('Show all pages in paginator', 'the7mk2'),
			'param_name' => 'st_show_all_pages',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'standard',
			),
		),
		array(
			'heading' => __('Gap before pagination', 'the7mk2'),
			'param_name' => 'st_gap_before_pagination',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'standard',
			),
			'description' => __('Leave empty to use default gap', 'the7mk2'),
		),
		// -- JavaScript pages.
		array(
			'heading' => __('Total number of posts', 'the7mk2'),
			'param_name' => 'jsp_posts_total',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_pagination',
			),
			'description' => __('Leave empty to display all posts.', 'the7mk2'),
		),
		array(
			'heading' => __('Number of posts to display on one page', 'the7mk2'),
			'param_name' => 'jsp_posts_per_page',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_pagination',
			),
			'description' => __('Leave empty to use number from wp settings.', 'the7mk2'),
		),
		array(
			'heading' => __('Show all pages in paginator', 'the7mk2'),
			'param_name' => 'jsp_show_all_pages',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_pagination',
			),
		),
		array(
			'heading' => __('Gap before pagination', 'the7mk2'),
			'param_name' => 'jsp_gap_before_pagination',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_pagination',
			),
			'description' => __('Leave empty to use default gap', 'the7mk2'),
		),
		// -- js Load more.
		array(
			'heading' => __('Total number of posts', 'the7mk2'),
			'param_name' => 'jsm_posts_total',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_more',
			),
			'description' => __('Leave empty to display all posts.', 'the7mk2'),
		),
		array(
			'heading' => __('Number of posts to display on one page', 'the7mk2'),
			'param_name' => 'jsm_posts_per_page',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_more',
			),
			'description' => __('Leave empty to use number from wp settings.', 'the7mk2'),
		),
		array(
			'heading' => __('Gap before pagination', 'the7mk2'),
			'param_name' => 'jsm_gap_before_pagination',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_more',
			),
			'description' => __('Leave empty to use default gap', 'the7mk2'),
		),
		// -- js Infinite scroll.
		array(
			'heading' => __('Total number of posts', 'the7mk2'),
			'param_name' => 'jsl_posts_total',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_lazy_loading',
			),
			'description' => __('Leave empty to display all posts.', 'the7mk2'),
		),
		array(
			'heading' => __('Number of posts to display on one page', 'the7mk2'),
			'param_name' => 'jsl_posts_per_page',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_lazy_loading',
			),
			'description' => __('Leave empty to use number from wp settings.', 'the7mk2'),
		),
		array(
			'heading' => __( 'Categorization', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Show categories filter', 'the7mk2'),
			'param_name' => 'show_categories_filter',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'description' => __( 'You can set up categorization colors, font & style in Theme Options >> Post Types >> General.', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Gap below categorization', 'the7mk2' ),
			'param_name' => 'gap_below_category_filter',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'description' => __('Leave empty to use default gap', 'the7mk2'),
		),
		array(
			'heading' => __( 'Categorization & pagination colors', 'the7mk2' ),
			'param_name' => 'dt_title_pagination_colors',
			'type' => 'dt_title',
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'navigation_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'description' => __( 'Leave empty to use headers color.', 'the7mk2' ),
		),
		array(
			'heading' => __('Accent color', 'the7mk2'),
			'param_name' => 'navigation_accent_color',
			'type' => 'colorpicker',
			'value' => '',
			'description' => __( 'Leave empty to use accent color.', 'the7mk2' ),
		),
		// PRODUCT group.
		// - Post Title.
		array(
			'heading' => __( 'Text Colors', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Product', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Product titles & price', 'the7mk2'),
			'param_name'	=> 'custom_title_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use headings color.', 'the7mk2' ),
			'group' => __( 'Product', 'the7mk2' ),
		),
		// - Text.
		array(
			'heading'		=> __('Old price for sale products', 'the7mk2'),
			'param_name'	=> 'custom_price_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use secondary text color.', 'the7mk2' ),
			'group' => __( 'Product', 'the7mk2' ),
		),
		array(
			'heading' => __('Product rating', 'the7mk2'),
			'param_name' => 'product_rating',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Product', 'the7mk2' ),
		),
		array(
			'heading' => __('Product short description', 'the7mk2'),
			'param_name' => 'product_descr',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Product', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Product description', 'the7mk2'),
			'param_name'	=> 'custom_content_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use primary text color.', 'the7mk2' ),
			'group' => __( 'Product', 'the7mk2' ),
			'dependency'	=> array(
				'element'	=> 'product_descr',
				'value'		=> 'y',
			),
		),
	),
) );