<?php
/**
 * This file contains shortcodes interface for Visual Composer.
 *
 * @package the7\Shortcodes
 * @since 1.0.0
 */

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Changing rows and columns classes.
 *
 * @param  string $class_string
 * @param  string $tag
 * @return string
 */
function custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
	if ( $tag=='vc_column' || $tag=='vc_column_inner' ) {
		$class_string = preg_replace( '/vc_span(\d{1,2})/', 'wf-cell wf-span-$1', $class_string );
	}

	return $class_string;
}
add_filter( 'vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2 );


/**
 * Adding our classes to paint standard VC shortcodes.
 *
 * @param  string $class_string
 * @param  string $tag
 * @param  array  $atts
 * @return string
 */
function custom_css_accordion( $class_string, $tag, $atts = array() ) {
	if ( in_array( $tag, array( 'vc_accordion', 'vc_progress_bar', 'vc_posts_slider' ) ) ) {
		$class_string .= ' dt-style';
	}

	if ( 'vc_accordion' === $tag ) {
		if ( array_key_exists( 'style' , $atts ) ) {
			switch ( $atts['style'] ) {
				case '2':
					$class_string .= ' dt-accordion-bg-on';
					break;

				case '3':
					$class_string .= ' dt-accordion-line-on';
					break;
			}
		}

		if ( array_key_exists( 'title_size', $atts ) ) {
			$class_string .= ' dt-accordion-' . presscore_get_font_size_class( $atts['title_size'] );
		}
	}

	return $class_string;
}
add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'custom_css_accordion', 10, 3 );

/**
 * VC Row.
 */

if ( The7_Admin_Dashboard_Settings::get( 'rows' ) ) {
	include_once dirname( __FILE__ ) . '/vc_row_js_composer_bridge.php';
}

/**
 * Woocommerce shortcodes.
 */
$woocommerce_shortcodes = array(
	'recent_products',
	'featured_products',
    'products',
	'product_category',
    'product_categories',
	'sale_products',
	'best_selling_products',
    'top_rated_products',
    'product_attribute',
    'related_products',
);
foreach ( $woocommerce_shortcodes as $wc_shortcode ) {
	vc_remove_param( $wc_shortcode, 'columns' );
}



/**
 * VC Pie.
 */

vc_map( array(
	'base'			=> 'vc_pie',
	'name'			=> __( 'Pie Chart', 'the7mk2' ),
	'description'	=> __( 'Animated pie chart', 'the7mk2' ),
	'category'		=> __( 'Content', 'the7mk2' ),
	'icon'			=> 'icon-wpb-vc_pie',
	'params'		=> array(
		array(
			'heading'		=> __( 'Widget title', 'the7mk2' ),
			'description'	=> __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'the7mk2' ),
			'param_name'	=> 'title',
			'type'			=> 'textfield',
			'admin_label'	=> true,
		),
		array(
			'heading'		=> __( 'Pie value', 'the7mk2' ),
			'description'	=> __( 'Input graph value here. Choose range between 0 and 100.', 'the7mk2' ),
			'param_name'	=> 'value',
			'type'			=> 'textfield',
			'value'			=> '50',
			'admin_label'	=> true,
		),
		array(
			'heading'		=> __( 'Pie label value', 'the7mk2' ),
			'description'	=> __( 'Input integer value for label. If empty "Pie value" will be used.', 'the7mk2' ),
			'param_name'	=> 'label_value',
			'type'			=> 'textfield',
			'value'			=> '',
		),
		array(
			'heading'		=> __( 'Units', 'the7mk2' ),
			'description'	=> __( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'the7mk2' ),
			'param_name'	=> 'units',
			'type'			=> 'textfield',
		),
		array(
			"heading"		=> __( "Bar color", 'the7mk2' ),
			"description"	=> __( 'Select pie chart color.', 'the7mk2' ),
			"param_name"	=> "color_mode",
			"type"			=> "dropdown",
			"value"			=> array(
				"标题"					=> "title_like",
				"浅色 (50%内容)"	=> "content_like",
				"强调"				=> "accent",
				"自定义"				=> "custom"
			),
		),
		array(
			"heading"		=> __( "Custom bar color", 'the7mk2' ),
			"param_name"	=> "color",
			"type"			=> "colorpicker",
			"value"			=> '#f7f7f7',
			"dependency"	=> array(
				"element"		=> "color_mode",
				"value"			=> array( "custom" )
			)
		),
		array(
			'heading'		=> __( 'Extra class name', 'the7mk2' ),
			'description'	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'the7mk2' ),
			'param_name'	=> 'el_class',
			'type'			=> 'textfield',
		),
		array(
			"heading"		=> __( "Appearance", 'the7mk2' ),
			"param_name"	=> "appearance",
			"type"			=> "dropdown",
			"value"			=> array(
				"饼图（默认）"	=> "default",
				"计数器"				=> "counter"
			),
			"admin_label"	=> true,
		),
		array(
			'type' => 'el_id',
			'heading' => __( 'Element ID', 'the7mk2' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'the7mk2' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'the7mk2' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'the7mk2' )
		),
	)
) );

/**
 * VC Widgetized sidebar.
 */

vc_add_param( "vc_widget_sidebar", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __( "Show background", 'the7mk2' ),
	"admin_label" => true,
	"param_name" => "show_bg",
	"value" => array(
		"是" => "true",
		"否" => "false"
	)
) );

/**
 * VC Tabs.
 */

// undeprecate
vc_map_update( "vc_tabs", array(
	'name' => __( 'Tabs', 'the7mk2' ),
	'deprecated' => null,
	'category' => __('by Dream-Theme', 'the7mk2'),
	'icon' => 'dt_vc_ico_tabs',
	'weight' => -1,
) );

vc_map_update( 'vc_tab', array(
	'deprecated' => null,
) );

// title font size
vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"heading" => __("Title size", 'the7mk2'),
	"param_name" => "title_size",
	"value" => array(
		'小' => "small",
		'中' => "normal",
		'大' => "big",
		'h1' => "h1",
		'h2' => "h2",
		'h3' => "h3",
		'h4' => "h4",
		'h5' => "h5",
		'h6' => "h6",
	),
	"std" => "big"
));

// style
vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"heading" => __("Style", 'the7mk2'),
	"param_name" => "style",
	"value" => array(
		"风格1" => "tab-style-one",
		"风格2" => "tab-style-two",
		"风格3" => "tab-style-three",
		"风格4" => "tab-style-four"
	)
));

/**
 * VC Tour.
 */

// undeprecate
vc_map_update("vc_tour", array(
	'name' => __( 'Tour', 'the7mk2' ),
	'deprecated' => null,
	'category' => __('by Dream-Theme', 'the7mk2'),
	'icon' => 'dt_vc_ico_tour',
	'weight' => -1,
));

// title font size
vc_add_param("vc_tour", array(
	"type" => "dropdown",
	"heading" => __("Title size", 'the7mk2'),
	"param_name" => "title_size",
	"value" => array(
		'小' => "small",
		'中' => "normal",
		'大' => "big",
		'h1' => "h1",
		'h2' => "h2",
		'h3' => "h3",
		'h4' => "h4",
		'h5' => "h5",
		'h6' => "h6",
	),
	"std" => "big"
));

vc_add_param("vc_tour", array(
	"type" => "dropdown",
	"heading" => __("Style", 'the7mk2'),
	"param_name" => "style",
	"value" => array(
		"风格1" => "tab-style-one",
		"风格2" => "tab-style-two",
		"风格3" => "tab-style-three",
		"风格4" => "tab-style-four"
	)
));

/**
 * VC Progress bars.
 */

vc_add_param("vc_progress_bar", array(
	"type" => "dropdown",
	"heading" => __( 'Style', 'the7mk2' ),
	"param_name" => "caption_pos",
	"value" => array(
		'风格1 (文字在条上)' => 'on',
		'风格2 (文字在粗条上面)' => 'top',
		'风格3 (文字在细条上面)' => 'thin_top',
	)
));

vc_add_param("vc_progress_bar", array(
	"type" => "dropdown",
	"heading" => __( 'Background', 'the7mk2' ),
	"param_name" => "bgstyle",
	"value" => array(
		'默认' => 'default',
		'轮廓' => 'outline',
		'半透明' => 'transparent',
	)
));

// add accent predefined color
$param = WPBMap::getParam('vc_progress_bar', 'bgcolor');
$param['value'] = array( 'Accent' => 'accent-bg', 'Custom' => 'custom' );
WPBMap::mutateParam('vc_progress_bar', $param);

/**
 * VC Column text.
 */

// add custom animation
$param = WPBMap::getParam('vc_column_text', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_column_text', $param);

/**
 * VC Message Box.
 */

// add custom animation
$param = WPBMap::getParam('vc_message', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_message', $param);

/**
 * VC Single Image.
 */

// add custom animation
$param = WPBMap::getParam('vc_single_image', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_single_image', $param);

// replace pretty photo with theme popup
$param = WPBMap::getParam('vc_single_image', 'onclick');

if ( $param && $key = array_search( 'link_image', $param['value'] ) ) {
	unset( $param['value'][ $key ] );

	$key = 'Open Magnific Popup';

	$param['value'][ $key ] = 'link_image';

	WPBMap::mutateParam('vc_single_image', $param);
}
unset( $param, $key );

vc_add_param("vc_single_image", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Image hovers", 'the7mk2'),
	"param_name" => "image_hovers",
	"std" => "true",
	"value" => array(
		"禁用" => "false",
		"启用" => "true"
	)
));

/**
 * @since 3.1.4
 */
vc_add_param("vc_single_image", array(
	"type" => "checkbox",
	"heading" => __("Lazy loading", 'the7mk2'),
	"param_name" => "lazy_loading",
));

/**
 * VC Accordion.
 */

// undeprecate
vc_map_update( "vc_accordion", array(
	"deprecated" => null,
	"name"       => __( 'Accordion', 'the7mk2' ),
	"category"   => __( 'by Dream-Theme', 'the7mk2' ),
	"icon"       => "dt_vc_ico_accordion",
	"weight"     => - 1,
) );

vc_map_update( 'vc_accordion_tab', array(
	'deprecated' => null,
));

// title font size
vc_add_param("vc_accordion", array(
	"type" => "dropdown",
	"heading" => __("Title size", 'the7mk2'),
	"param_name" => "title_size",
	"value" => array(
		'小' => "small",
		'中' => "normal",
		'大' => "big",
		'h1' => "h1",
		'h2' => "h2",
		'h3' => "h3",
		'h4' => "h4",
		'h5' => "h5",
		'h6' => "h6",
	),
	"std" => "big"
));

vc_add_param("vc_accordion", array(
	"type" => "dropdown",
	"heading" => __("Style", 'the7mk2'),
	"param_name" => "style",
	"value" => array(
		'风格1 (无背景)' => '1',
		'风格2 (带背景)' => '2',
		'风格3 (带分隔)' => '3'
	),
	"description" => ""
));

/**
 * VC Button.
 */

vc_add_param( 'vc_btn', array(
	'type' => 'checkbox',
	'heading' => __( 'Smooth scroll?', 'the7mk2' ),
	'param_name' => 'smooth_scroll',
	'description' => __( 'for #anchor navigation', 'the7mk2' )
) );

/**
 * DT Fancy Titles.
 */

vc_map( array(
	"weight" => -1,
	"name" => "花式标题",
	"base" => "dt_fancy_title",
	"icon" => "dt_vc_ico_fancy_titles",
	"class" => "dt_vc_sc_fancy_titles",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"description" => '',
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => "标题",
			"param_name" => "title",
			"holder" => "div",
			"value" => "标题",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "标题位置",
			"param_name" => "title_align",
			"value" => array(
				'中' => "center",
				'左' => "left",
				'右' => "right"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "标题大小",
			"param_name" => "title_size",
			"value" => array(
				'小' => "small",
				'中' => "normal",
				'大' => "big",
				'h1' => "h1",
				'h2' => "h2",
				'h3' => "h3",
				'h4' => "h4",
				'h5' => "h5",
				'h6' => "h6",
			),
			"std" => "normal",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "标题颜色",
			"param_name" => "title_color",
			"value" => array(
				"半透明" => "default",
				"强调" => "accent",
				"标题" => "title",
				"自定义" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "自定义标题颜色",
			"param_name" => "custom_title_color",
			"dependency" => array(
				"element" => "title_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "分隔样式",
			"param_name" => "separator_style",
			"value" => array(
				"线" => "",
				"虚线" => "dashed",
				"点线" => "dotted",
				"双线" => "double",
				"粗线" => "thick",
				"禁用" => "disabled"
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => "元素宽度 (%)",
			"param_name" => "el_width",
			"value" => "100",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "标题背景",
			"param_name" => "title_bg",
			"value" => array(
				"启用" => "enabled",
				"禁用" => "disabled"
			),
			"std" => "disabled",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "分隔和背景颜色",
			"param_name" => "separator_color",
			"value" => array(
				"默认" => "default",
				"强调" => "accent",
				"自定义" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "自定义分隔颜色",
			"param_name" => "custom_separator_color",
			"dependency" => array(
				"element" => "separator_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
	)
) );

/**
 * DT Fancy Separators.
 */

vc_map( array(
	"weight" => -1,
	"name" => "花式分隔线",
	"base" => "dt_fancy_separator",
	"icon" => "dt_vc_ico_separators",
	"class" => "dt_vc_sc_separators",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"description" => '',
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => "分隔样式",
			"param_name" => "separator_style",
			"value" => array(
				"线" => "line",
				"虚线" => "dashed",
				"点线" => "dotted",
				"双线" => "double",
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "分隔颜色",
			"param_name" => "separator_color",
			"value" => array(
				"默认" => "default",
				"强调" => "accent",
				"自定义" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "自定义分隔颜色",
			"param_name" => "custom_separator_color",
			"dependency" => array(
				"element" => "separator_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "对齐",
			"param_name" => "alignment",
			"value" => array(
				'中' => 'center',
				'左' => 'left',
				'右' => 'right',
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => "粗细 (px)",
			"param_name" => "line_thickness",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => "元素宽度 (%或px)",
			"param_name" => "el_width",
			"value" => "100%",
			"description" => ""
		),
	)
) );

/**
 * DT Fancy Quote.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Fancy Quote", 'the7mk2'),
	"base" => "dt_quote",
	"icon" => "dt_vc_ico_quote",
	"class" => "dt_vc_sc_quote",
	"deprecated" => '5.2.1',
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<p>I am test text for QUOTE. Click edit button to change this text.</p>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Quote type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"区块引用" => "blockquote",
				"拉取引用" => "pullquote"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "font_size",
			"value" => array(
				"小" => "small",
				"中" => "normal",
				"大" => "big",
				"h1" => "h1",
				"h2" => "h2",
				"h3" => "h3",
				"h4" => "h4",
				"h5" => "h5",
				"h6" => "h6",
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Blockquote style", 'the7mk2'),
			"param_name" => "background",
			"value" => array(
				"边框" => "plain",
				"背景" => "fancy"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Call to Action.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Call to Action", 'the7mk2'),
	"base" => "dt_call_to_action",
	"icon" => "dt_vc_ico_call_to_action",
	"class" => "dt_vc_sc_call_to_action",
	"deprecated" => '5.2.1',
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<p>I am test text for CALL TO ACTION. Click edit button to change this text.</p>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "content_size",
			"value" => array(
				"小" => "small",
				"中" => "normal",
				"大" => "big",
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", 'the7mk2'),
			"param_name" => "background",
			"value" => array(
				"无" => "no",
				"轮廓" => "plain",
				"背景" => "fancy"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Decorative line on the left", 'the7mk2'),
			"param_name" => "line",
			"value" => array(
				"禁用" => "false",
				"启用" => "true"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button alignment", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"默认" => "0",
				"在右" => "1"
			),
			"description" => __( "Use [dt_button] to insert a button. Default: button keeps alignment from content editor. On the right: button is aligned to the right.", 'the7mk2' )
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Teaser.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Teaser", 'the7mk2'),
	"base" => "dt_teaser",
	"icon" => "dt_vc_ico_teaser",
	"class" => "dt_vc_sc_teaser",
	"deprecated" => '5.2.1',
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"上传图片" => "uploaded_image",
				"图片来自网址" => "image",
				"视频来自网址" => "video"
			),
			"description" => ""
		),

		//////////////////////
		// uploaded image //
		//////////////////////

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose image", 'the7mk2'),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),

		//////////////////////
		// image from url //
		//////////////////////

		// image url
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image URL", 'the7mk2'),
			"param_name" => "image",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image width
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image WIDTH", 'the7mk2'),
			"param_name" => "image_width",
			"value" => "",
			"description" => __("image width in px", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image height
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image HEIGHT", 'the7mk2'),
			"param_name" => "image_height",
			"value" => "",
			"description" => __("image height in px", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image alt
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image ALT", 'the7mk2'),
			"param_name" => "image_alt",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// misc link
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Misc link", 'the7mk2'),
			"param_name" => "misc_link",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// target
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Target link", 'the7mk2'),
			"param_name" => "target",
			"value" => array(
				"新窗口" => "blank",
				"原窗口" => "self"
			),
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// open in lightbox
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Open in lighbox", 'the7mk2'),
			"param_name" => "lightbox",
			"value" => array(
				"" => "true"
			),
			"description" => __("If selected, larger image will be opened on click.", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		//////////////////////
		// video from url //
		//////////////////////

		// video url
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Video URL", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "media",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"video"
				)
			)
		),

		// content
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("I am test text for TEASER. Click edit button to change this text.", 'the7mk2'),
			"description" => ""
		),

		// media style
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Media style", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"全宽" => "1",
				"带填充" => "2"
			),
			"description" => ""
		),

		// image hoovers
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hovers", 'the7mk2'),
			"param_name" => "image_hovers",
			"std" => "true",
			"value" => array(
				"禁用" => "false",
				"启用" => "true"
			)
		),

		// font size
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "content_size",
			"value" => array(
				"小" => "small",
				"中" => "normal",
				"大" => "big"
			),
			"std" => "big",
			"description" => ""
		),

		// background
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", 'the7mk2'),
			"param_name" => "background",
			"value" => array(
				"无" => "no",
				"轮廓" => "plain",
				"背景" => "fancy"
			),
			"description" => ""
		),

		// animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Banner.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Banner", 'the7mk2'),
	"base" => "dt_banner",
	"icon" => "dt_vc_ico_banner",
	"class" => "dt_vc_sc_banner",
	"deprecated" => '5.2.1',
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"上传图片" => "uploaded_image",
				"图片来自网址" => "image"
			),
			"description" => ""
		),
		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Background image", 'the7mk2'),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Background image", 'the7mk2'),
			"param_name" => "bg_image",
			"description" => __("Image URL.", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<p>I am test text for BANNER. Click edit button to change this text.</p>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Banner link", 'the7mk2'),
			"param_name" => "link",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Open link in", 'the7mk2'),
			"param_name" => "target_blank",
			"value" => array(
				"原窗口" => "false",
				"新窗口" => "true"
			),
			"description" => "",
			"dependency" => array(
				"element" => "link",
				"not_empty" => true
			)
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Background color", 'the7mk2'),
			"param_name" => "bg_color",
			"value" => "rgba(0,0,0,0.4)",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Border color", 'the7mk2'),
			"param_name" => "text_color",
			"value" => "#ffffff",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "text_size",
			"value" => array(
				"小" => "small",
				"中" => "normal",
				"大" => "big"
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Border width", 'the7mk2'),
			"param_name" => "border_width",
			"value" => "3",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Outer padding", 'the7mk2'),
			"param_name" => "outer_padding",
			"value" => "10",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Inner padding", 'the7mk2'),
			"param_name" => "inner_padding",
			"value" => "10",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Banner minimal height", 'the7mk2'),
			"param_name" => "min_height",
			"value" => "150",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Contact form.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Contact Form", 'the7mk2'),
	"base" => "dt_contact_form",
	"icon" => "dt_vc_ico_contact_form",
	"class" => "dt_vc_sc_contact_form",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Form fields", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "fields",
			"value" => array(
				"名字" => "name",
				"邮箱" => "email",
				"手机" => "telephone",
				"国家" => "country",
				"城市" => "city",
				"公司" => "company",
				"网站" => "website",
				"信息" => "message"
			),
			"description" => __("Attention! At least one must be selected.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Message textarea height", 'the7mk2'),
			"param_name" => "message_height",
			"value" => "6",
			"description" => __("Number of lines.", 'the7mk2'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Required fields", 'the7mk2'),
			//"admin_label" => true,
			"param_name" => "required",
			"value" => array(
				"名字" => "name",
				"邮箱" => "email",
				"手机" => "telephone",
				"国家" => "country",
				"城市" => "city",
				"公司" => "company",
				"网站" => "website",
				"信息" => "message"
			),
			"description" => __("Attention! At least one must be selected.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __('Submit button caption', 'the7mk2'),
			"param_name" => "button_title",
			"value" => "发送信息",
			"description" => ""
		)
		// array(
		// 	"type" => "dropdown",
		// 	"class" => "",
		// 	"heading" => __("Submit button size", 'the7mk2'),
		// 	"param_name" => "button_size",
		// 	"value" => array(
		// 		"Small" => "small",
		// 		"Medium" => "medium",
		// 		"Big" => "big"
		// 	),
		// 	"description" => ""
		// )
	)
) );

/**
 * DT Mini Blog.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Blog Mini", 'the7mk2'),
	"base" => "dt_blog_posts_small",
	"icon" => "dt_vc_ico_blog_posts_small",
	"class" => "dt_vc_sc_blog_posts_small",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		// General group.
		array(
			"heading" => __("Categories", 'the7mk2'),
			"param_name" => "category",
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"admin_label" => true,
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2'),
		),
		array(
			"heading" => __( "Posts Number & Order", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"heading" => __("Number of posts to show", 'the7mk2'),
			"param_name" => "number",
			"type" => "textfield",
			"value" => "6",
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"heading" => __("Order by", 'the7mk2'),
			"param_name" => "orderby",
			"type" => "dropdown",
			"value" => array(
				"日期" => "date",
				"作者" => "author",
				"标题" => "title",
				"别名" => "name",
				"修改日期" => "modified",
				"ID" => "id",
				"随机" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __("Order way", 'the7mk2'),
			"param_name" => "order",
			"type" => "dropdown",
			"value" => array(
				"降序" => "desc",
				"升序" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		// Appearance group.
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Layout", 'the7mk2'),
			"param_name" => "columns",
			"type" => "dropdown",
			"value" => array(
				"列表" => "1",
				"2列" => "2",
				"3列" => "3"
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __( "Post Design & Elements", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Featured images", 'the7mk2'),
			"param_name" => "featured_images",
			"type" => "dropdown",
			"value" => array(
				"显示" => "true",
				"隐藏" => "false"
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Images width", 'the7mk2'),
			"param_name" => "images_width",
			"type" => "textfield",
			"value" => "60",
			"description" => 'in px',
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Images height", 'the7mk2'),
			"param_name" => "images_height",
			"type" => "textfield",
			"value" => "60",
			"description" => 'in px',
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"param_name" => "round_images",
			"type" => "checkbox",
			"value" => array(
				"启用圆角" => "true",
			),
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			),
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"param_name" => "show_excerpts",
			"type" => "checkbox",
			"value" => array(
				"显示摘要" => "true",
			),
		),
	)
) );

/**
 * Blog list.
 */
vc_map( array(
	'weight' => -1,
	'name' => __( 'Blog list', 'the7mk2' ),
	'base' => 'dt_blog_list',
	'class' => 'dt_vc_sc_blog_list',
	'icon' => 'dt_vc_ico_blog_posts',
	'category' => __( 'by Dream-Theme', 'the7mk2' ),
	'params' => array(
		// General group.
		array(
			'heading' => __('Show', 'the7mk2'),
			'param_name' => 'post_type',
			'type' => 'dropdown',
			'std' => 'category',
			'value' => array(
				'所有文章' => 'posts',
				'文章来自分类' => 'category',
				'文章来自标签' => 'tags',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose posts', 'the7mk2' ),
			'param_name' => 'posts',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
			),
			'save_always' => true,
			'description' => __( 'Field accept post ID, title. Leave empty to show all posts.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_type',
				'value' => 'posts',
			),
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose post categories', 'the7mk2' ),
			'param_name' => 'category',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
			),
			'save_always' => true,
			'description' => __( 'Field accept category ID, title, slug. Leave empty to show all posts.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_type',
				'value' => 'category',
			),
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose tags', 'the7mk2' ),
			'param_name' => 'tags',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
			),
			'save_always' => true,
			'description' => __( 'Field accept tag ID, title, slug. Leave empty to show all posts.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_type',
				'value' => 'tags',
			),
		),
		// - Layout Settings.
		array(
			'heading' => __( 'Layout Settings', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Style', 'the7mk2'),
			'param_name' => 'layout',
			'type' => 'dropdown',
			'value' => array(
				'经典' => 'classic',
				'中心' => 'centered',
				'底部叠加' => 'bottom_overlap',
				'侧面叠加' => 'side_overlap',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// -- Classic style.
		array(
			'heading' => __('Image width', 'the7mk2'),
			'param_name' => 'cl_image_width',
			'type' => 'dt_number',
			'value' => '50%',
			'units' => '%',
			'max' => 100,
			'min' => 0,
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'classic',
			),
		),
		array(
			'heading' => __('Show dividers', 'the7mk2'),
			'param_name' => 'cl_dividers',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否 ' => 'n',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'classic',
			),
		),
		array(
			'heading'		=> __('Dividers color', 'the7mk2'),
			'param_name'	=> 'cl_dividers_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency'	=> array(
				'element'	=> 'layout',
				'value'		=> 'classic',
			),
			'description'   => __( 'Leave empty to use default divider color.', 'the7mk2' ),
		),
		// -- Centered style.
		array(
			'heading' => __('Content area width', 'the7mk2'),
			'param_name' => 'ce_content_width',
			'type' => 'dt_number',
			'value' => '75%',
			'units' => 'px, %',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'centered',
			),
		),
		array(
			'heading' => __('Show dividers', 'the7mk2'),
			'param_name' => 'ce_dividers',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'centered',
			),
		),
		array(
			'heading'		=> __('Dividers color', 'the7mk2'),
			'param_name'	=> 'ce_dividers_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency'	=> array(
				'element'	=> 'layout',
				'value'		=> 'centered',
			),
			'description'   => __( 'Leave empty to use default divider color.', 'the7mk2' ),
		),
		// -- Bottom overlap.
		array(
			'heading' => __('Content area width', 'the7mk2'),
			'param_name' => 'bo_content_width',
			'type' => 'dt_number',
			'value' => '75%',
			'units' => 'px, %',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'bottom_overlap',
			),
		),
		array(
			'heading' => __('Content area top overlap', 'the7mk2'),
			'param_name' => 'bo_content_top_overlap',
			'type' => 'dt_number',
			'value' => '100px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'bottom_overlap',
			),
		),
		// -- Side overlap style.
		array(
			'heading' => __('Content alignment', 'the7mk2'),
			'param_name' => 'si_content_align',
			'type' => 'dropdown',
			'value' => array(
				'格子' => 'checkerboard',
				'文字在右' => 'list',
				'文字在左' => 'right_list',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'side_overlap',
			),
		),
		array(
			'heading' => __('Image width', 'the7mk2'),
			'param_name' => 'si_image_width',
			'type' => 'dt_number',
			'value' => '75%',
			'units' => 'px, %',
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'side_overlap',
			),
		),
		array(
			'heading' => __('Content area side overlap', 'the7mk2'),
			'param_name' => 'si_content_side_overlap',
			'type' => 'dt_number',
			'value' => '150px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'side_overlap',
			),
		),
		array(
			'heading' => __('Content area top margin', 'the7mk2'),
			'param_name' => 'si_content_top_margin',
			'type' => 'dt_number',
			'value' => '50px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'side_overlap',
			),
		),
		// - Content Area.
		array(
			'heading' => __( 'Content Area', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Show background', 'the7mk2'),
			'param_name' => 'content_bg',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		array(
			'heading'		=> __('Color', 'the7mk2'),
			'param_name'	=> 'custom_content_bg_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency'	=> array(
				'element'	=> 'content_bg',
				'value'		=> 'y',
			),
			'description'   => __( 'Leave empty to use default content boxes color & decoration.', 'the7mk2' ),
		),
		array(
			'heading' => __('Content area paddings', 'the7mk2'),
			'param_name' => 'post_content_paddings',
			'type' => 'dt_spacing',
			'value' => '15px 20px 20px 20px',
			'units' => 'px',
		),
		array(
			'heading' => __('Gap below post', 'the7mk2'),
			'param_name' => 'gap_between_posts',
			'type' => 'dt_number',
			'value' => '50px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// - Image Settings.
		array(
			'heading' => __( 'Image Settings', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Image sizing', 'the7mk2'),
			'param_name' => 'image_sizing',
			'type' => 'dropdown',
			'std' => 'resize',
			'value' => array(
				'保留图像比例' => 'proportional',
				'调整图片大小' => 'resize',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'headings' => array( __('Width', 'the7mk2'), __('Height', 'the7mk2') ),
			'param_name' => 'resized_image_dimensions',
			'type' => 'dt_dimensions',
			'value' => '3x2',
			'dependency' => array(
				'element' => 'image_sizing',
				'value' => 'resize',
			),
			'description' => __('Set image proportions, for example: 4x3, 3x2.', 'the7mk2'),
		),
		array(
			'heading' => __('Image paddings', 'the7mk2'),
			'param_name' => 'image_paddings',
			'type' => 'dt_spacing',
			'value' => '0px 0px 0px 0px',
			'units' => 'px, %',
		),
		array(
			'heading' => __('Enable scale animation on hover', 'the7mk2'),
			'param_name' => 'image_scale_animation_on_hover',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		// - Responsiveness.
		array(
			'heading' => __( 'Responsiveness', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Switch to mobile layout if browser width is less then', 'the7mk2'),
			'param_name' => 'mobile_switch_width',
			'type' => 'dt_number',
			'value' => '768px',
			'units' => 'px',
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
			'heading' => __('Total number of posts', 'the7mk2'),
			'param_name' => 'dis_posts_total',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'disabled',
			),
			'description' => __('Leave empty to display all posts.', 'the7mk2'),
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
		// Post group.
		// - Post Title.
		array(
			'heading' => __( 'Post Title', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'post_title_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'post_title_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H3 font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'post_title_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H3 line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_title_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use headers color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below title', 'the7mk2'),
			'param_name' => 'post_title_bottom_margin',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - Meta Information.
		array(
			'heading' => __( 'Meta Information', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post date', 'the7mk2'),
			'param_name' => 'post_date',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post categories', 'the7mk2'),
			'param_name' => 'post_category',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post author', 'the7mk2'),
			'param_name' => 'post_author',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post comments', 'the7mk2'),
			'param_name' => 'post_comments',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'meta_info_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'meta_info_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use small font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'meta_info_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use small line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_meta_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use secondary text color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below meta info', 'the7mk2'),
			'param_name' => 'meta_info_bottom_margin',
			'type' => 'dt_number',
			'value' => '15px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - Text.
		array(
			'heading' => __( 'Text', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Content or excerpt', 'the7mk2'),
			'param_name' => 'post_content',
			'type' => 'dropdown',
			'std' => 'show_excerpt',
			'value' => array(
				'关' => 'off',
				'摘要' => 'show_excerpt',
				'文章内容' => 'show_content',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Maximum number of words', 'the7mk2'),
			'param_name' => 'excerpt_words_limit',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_content',
				'value' => 'show_excerpt',
			),
			'description' => __( 'Leave empty to show full text.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'content_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'content_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Leave empty to use large font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'content_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Leave empty to use large line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_content_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Leave empty to use primary text color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below text', 'the7mk2'),
			'param_name' => 'content_bottom_margin',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - "Read More" Button.
		array(
			'heading' => __( '"Read More" Button', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('"Read more" button', 'the7mk2'),
			'param_name' => 'read_more_button',
			'type' => 'dropdown',
			'std' => 'default_link',
			'value' => array(
				'关' => 'off',
				'默认链接' => 'default_link',
				'默认按钮' => 'default_button',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Button text', 'the7mk2'),
			'param_name' => 'read_more_button_text',
			'type' => 'textfield',
			'value' => '阅读更多',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'read_more_button',
				'value'	=> array(
					'default_link',
					'default_button',
				),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		// Fancy Elements group.
		// - Fancy Date.
		array(
			'heading' => __( 'Fancy Date', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Show Fancy date', 'the7mk2'),
			'param_name' => 'fancy_date',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'fancy_date_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Background color', 'the7mk2'),
			'param_name' => 'fancy_date_bg_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Line color', 'the7mk2'),
			'param_name' => 'fancy_date_line_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use accent color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		// - Fancy Categories.
		array(
			'heading' => __( 'Fancy Categories', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Show fancy categories', 'the7mk2'),
			'param_name' => 'fancy_categories',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'fancy_categories_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_categories',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color or category color indication.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Background color', 'the7mk2'),
			'param_name' => 'fancy_categories_bg_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_categories',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color or category color indication.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		// List group.
		array(
			'heading' => __( 'Categorization & Ordering settings', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Order', 'the7mk2'),
			'param_name' => 'order',
			'type' => 'dropdown',
			'std' => 'desc',
			'value' => array(
				'升序' => 'asc',
				'降序' => 'desc',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Order by', 'the7mk2'),
			'param_name' => 'orderby',
			'type' => 'dropdown',
			'value' => array(
				'日期' => 'date',
				'名字' => 'title',
				'随机' => 'rand',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'List', 'the7mk2' ),
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
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Show name / date ordering', 'the7mk2'),
			'param_name' => 'show_orderby_filter',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Show asc. / desc. ordering', 'the7mk2'),
			'param_name' => 'show_order_filter',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Gap below categorization & ordering', 'the7mk2' ),
			'param_name' => 'gap_below_category_filter',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'description' => __('Leave empty to use default gap', 'the7mk2'),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Categorization, ordering & pagination colors', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'navigation_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'description' => __( 'Leave empty to use headers color.', 'the7mk2' ),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Accent color', 'the7mk2'),
			'param_name' => 'navigation_accent_color',
			'type' => 'colorpicker',
			'value' => '',
			'description' => __( 'Leave empty to use accent color.', 'the7mk2' ),
			'group' => __( 'List', 'the7mk2' ),
		),
	),
) );

/**
 * Blog masonry.
 */
vc_map( array(
	'weight' => -1,
	'name' => __( 'Blog Masonry & Grid', 'the7mk2' ),
	'base' => 'dt_blog_masonry',
	'class' => 'dt_vc_sc_blog_masonry',
	'icon' => 'dt_vc_ico_blog_posts',
	'category' => __( 'by Dream-Theme', 'the7mk2' ),
	'params' => array(
		// General group.
		array(
			'heading' => __('Show', 'the7mk2'),
			'param_name' => 'post_type',
			'type' => 'dropdown',
			'std' => 'category',
			'value' => array(
				'所有文章' => 'posts',
				'文章来自分类' => 'category',
				'文章来自标签' => 'tags',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose posts', 'the7mk2' ),
			'param_name' => 'posts',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
			),
			'save_always' => true,
			'description' => __( 'Field accept post ID, title. Leave empty to show all posts.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_type',
				'value' => 'posts',
			),
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose post categories', 'the7mk2' ),
			'param_name' => 'category',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
			),
			'save_always' => true,
			'description' => __( 'Field accept category ID, title, slug. Leave empty to show all posts.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_type',
				'value' => 'category',
			),
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose tags', 'the7mk2' ),
			'param_name' => 'tags',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
			),
			'save_always' => true,
			'description' => __( 'Field accept tag ID, title, slug. Leave empty to show all posts.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_type',
				'value' => 'tags',
			),
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
			'heading' => __('Style', 'the7mk2'),
			'param_name' => 'layout',
			'type' => 'dropdown',
			'value' => array(
				'经典' => 'classic',
				'底部叠加（背景）' => 'bottom_overlap',
				'底部叠加（渐变）' => 'gradient_overlap',
				'覆盖（背景）' => 'gradient_overlay',
				'覆盖（渐变）' => 'gradient_rollover',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// -- Bottom overlap style.
		array(
			'heading' => __('Content area width', 'the7mk2'),
			'param_name' => 'bo_content_width',
			'type' => 'dt_number',
			'value' => '75%',
			'units' => '%, px',
			'min' => 0,
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'bottom_overlap',
			),
		),
		array(
			'heading' => __('Content area overlap', 'the7mk2'),
			'param_name' => 'bo_content_overlap',
			'type' => 'dt_number',
			'value' => '100px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'bottom_overlap',
			),
		),
		array(
			'heading' => __('Overlay background margins', 'the7mk2'),
			'param_name' => 'grovly_content_overlap',
			'type' => 'dt_number',
			'value' => '0px',
			'units' => 'px, %',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'gradient_overlay',
			),
		),
		// - Content Area.
		array(
			'heading' => __( 'Content Area', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Show background', 'the7mk2'),
			'param_name' => 'content_bg',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		array(
			'heading'		=> __('Color', 'the7mk2'),
			'param_name'	=> 'custom_content_bg_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency'	=> array(
				'element'	=> 'content_bg',
				'value'		=> 'y',
			),
			'description'   => __( 'Leave empty to use default content boxes color & decoration. Note that decoration doesn\'t apply to gradient backgrounds.', 'the7mk2' ),
		),
		array(
			'heading' => __('Content area paddings', 'the7mk2'),
			'param_name' => 'post_content_paddings',
			'type' => 'dt_spacing',
			'value' => '25px 30px 30px 30px',
			'units' => 'px',
		),
		// - Image Settings.
		array(
			'heading' => __( 'Image Settings', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Image sizing', 'the7mk2'),
			'param_name' => 'image_sizing',
			'type' => 'dropdown',
			'std' => 'resize',
			'value' => array(
				'保留图像比例' => 'proportional',
				'调整图片大小' => 'resize',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'headings' => array( __('Width', 'the7mk2'), __('Height', 'the7mk2') ),
			'param_name' => 'resized_image_dimensions',
			'type' => 'dt_dimensions',
			'value' => '3x2',
			'dependency' => array(
				'element' => 'image_sizing',
				'value' => 'resize',
			),
			'description' => __('Set image proportions, for example: 4x3, 3x2.', 'the7mk2'),
		),
		array(
			'heading' => __('Image paddings', 'the7mk2'),
			'param_name' => 'image_paddings',
			'type' => 'dt_spacing',
			'value' => '0px 0px 0px 0px',
			'units' => 'px, %',
		),
		array(
			'heading' => __('Enable scale animation on hover', 'the7mk2'),
			'param_name' => 'image_scale_animation_on_hover',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		array(
			'heading' => __('Enable hover background color', 'the7mk2'),
			'param_name' => 'image_hover_bg_color',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
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
		array(
			'heading' => __('Make all posts the same width', 'the7mk2'),
			'param_name' => 'all_posts_the_same_width',
			'type' => 'dropdown',
			'value' => array(
				'否（宽文章填充2列）' => 'n',
				'是（宽文章填充1列）' => 'y',
			),
			'description'   => __( 'Post wide/normal width can be chosen in single post options.', 'the7mk2' ),
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
			'heading' => __('Total number of posts', 'the7mk2'),
			'param_name' => 'dis_posts_total',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'disabled',
			),
			'description' => __('Leave empty to display all posts.', 'the7mk2'),
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
		// Post group.
		array(
			'heading' => __('Content alignment', 'the7mk2'),
			'param_name' => 'content_alignment',
			'type' => 'dropdown',
			'std' => 'left',
			'value' => array(
				'左' => 'left',
				'中' => 'center',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - Post Title.
		array(
			'heading' => __( 'Post Title', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'post_title_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'post_title_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H4 font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'post_title_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H4 line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_title_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use headers color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below title', 'the7mk2'),
			'param_name' => 'post_title_bottom_margin',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - Meta Information.
		array(
			'heading' => __( 'Meta Information', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post date', 'the7mk2'),
			'param_name' => 'post_date',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post categories', 'the7mk2'),
			'param_name' => 'post_category',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post author', 'the7mk2'),
			'param_name' => 'post_author',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post comments', 'the7mk2'),
			'param_name' => 'post_comments',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'meta_info_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'meta_info_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use small font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'meta_info_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use small line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_meta_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use secondary text color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below meta info', 'the7mk2'),
			'param_name' => 'meta_info_bottom_margin',
			'type' => 'dt_number',
			'value' => '15px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - Text.
		array(
			'heading' => __( 'Text', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Content or excerpt', 'the7mk2'),
			'param_name' => 'post_content',
			'type' => 'dropdown',
			'std' => 'show_excerpt',
			'value' => array(
				'关' => 'off',
				'摘要' => 'show_excerpt',
				'文章内容' => 'show_content',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Maximum number of words', 'the7mk2'),
			'param_name' => 'excerpt_words_limit',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_content',
				'value' => 'show_excerpt',
			),

			'description' => __( 'Leave empty to show full text.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'content_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'content_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Leave empty to use medium font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'content_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Leave empty to use medium line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_content_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Leave empty to use primary text color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below text', 'the7mk2'),
			'param_name' => 'content_bottom_margin',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - "Read More" Button.
		array(
			'heading' => __( '"Read More" Button', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('"Read more" button', 'the7mk2'),
			'param_name' => 'read_more_button',
			'type' => 'dropdown',
			'std' => 'default_link',
			'value' => array(
				'关' => 'off',
				'默认链接' => 'default_link',
				'默认按钮' => 'default_button',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Button text', 'the7mk2'),
			'param_name' => 'read_more_button_text',
			'type' => 'textfield',
			'value' => '阅读更多',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'read_more_button',
				'value'	=> array(
					'default_link',
					'default_button',
				),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		// Fancy Elements group.
		// - Fancy Date.
		array(
			'heading' => __( 'Fancy Date', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Show Fancy date', 'the7mk2'),
			'param_name' => 'fancy_date',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'fancy_date_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Background color', 'the7mk2'),
			'param_name' => 'fancy_date_bg_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Line color', 'the7mk2'),
			'param_name' => 'fancy_date_line_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use accent color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		// - Fancy Categories.
		array(
			'heading' => __( 'Fancy Categories', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Show fancy categories', 'the7mk2'),
			'param_name' => 'fancy_categories',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'fancy_categories_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_categories',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color or category color indication.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Background color', 'the7mk2'),
			'param_name' => 'fancy_categories_bg_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_categories',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color or category color indication.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		// List group.
		array(
			'heading' => __( 'Categorization & Ordering settings', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Order', 'the7mk2'),
			'param_name' => 'order',
			'type' => 'dropdown',
			'std' => 'desc',
			'value' => array(
				'升序' => 'asc',
				'降序' => 'desc',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Order by', 'the7mk2'),
			'param_name' => 'orderby',
			'type' => 'dropdown',
			'value' => array(
				'日期' => 'date',
				'名字' => 'title',
				'随机' => 'rand',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'List', 'the7mk2' ),
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
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Show name / date ordering', 'the7mk2'),
			'param_name' => 'show_orderby_filter',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Show asc. / desc. ordering', 'the7mk2'),
			'param_name' => 'show_order_filter',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Gap below categorization & ordering', 'the7mk2' ),
			'param_name' => 'gap_below_category_filter',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'description' => __('Leave empty to use default gap', 'the7mk2'),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Categorization, ordering & pagination colors', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'navigation_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'description' => __( 'Leave empty to use headers color.', 'the7mk2' ),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Accent color', 'the7mk2'),
			'param_name' => 'navigation_accent_color',
			'type' => 'colorpicker',
			'value' => '',
			'description' => __( 'Leave empty to use accent color.', 'the7mk2' ),
			'group' => __( 'List', 'the7mk2' ),
		),
	),
) );

/**
 * DT Blog Carousel.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Blog Carousel", 'the7mk2'),
	"base" => "dt_blog_carousel",
	"icon" => "dt_vc_ico_blog_carousel",
	"class" => "dt_blog_carousel",
	"category" => __('by Dream-Theme', 'the7mk2'),
    "admin_enqueue_css" => array(get_template_directory_uri().'/fonts/icomoon-arrows-the7/style.css'),
	"params" => array(
		// General group.
		array(
			'heading' => __('Show', 'the7mk2'),
			'param_name' => 'post_type',
			'type' => 'dropdown',
			'std' => 'category',
			'value' => array(
				'所有文章' => 'posts',
				'文章来自分类' => 'category',
				'文章来自标签' => 'tags',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose posts', 'the7mk2' ),
			'param_name' => 'posts',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
			),
			'save_always' => true,
			'description' => __( 'Field accept post ID, title. Leave empty to show all posts.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_type',
				'value' => 'posts',
			),
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose post categories', 'the7mk2' ),
			'param_name' => 'category',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
			),
			'save_always' => true,
			'description' => __( 'Field accept category ID, title, slug. Leave empty to show all posts.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_type',
				'value' => 'category',
			),
		),
		array(
			'type' => 'autocomplete',
			'heading' => __( 'Choose tags', 'the7mk2' ),
			'param_name' => 'tags',
			'settings' => array(
				'multiple' => true,
				'min_length' => 0,
			),
			'save_always' => true,
			'description' => __( 'Field accept tag ID, title, slug. Leave empty to show all posts.', 'the7mk2' ),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_type',
				'value' => 'tags',
			),
		),
		array(
			'heading' => __('Order', 'the7mk2'),
			'param_name' => 'order',
			'type' => 'dropdown',
			'std' => 'desc',
			'value' => array(
				'升序' => 'asc',
				'降序' => 'desc',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'heading' => __('Order by', 'the7mk2'),
			'param_name' => 'orderby',
			'type' => 'dropdown',
			'value' => array(
				'日期' => 'date',
				'名字' => 'title',
				'随机' => 'rand',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'heading' => __('Total number of posts', 'the7mk2'),
			'param_name' => 'dis_posts_total',
			'type' => 'dt_number',
			'value' => '6',
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
			'heading' => __('Style', 'the7mk2'),
			'param_name' => 'layout',
			'type' => 'dropdown',
			'value' => array(
				'经典' => 'classic',
				'底部叠加（背景）' => 'bottom_overlap',
				'底部叠加（渐变）' => 'gradient_overlap',
				'叠加（背景）' => 'gradient_overlay',
				'叠加（渐变）' => 'gradient_rollover',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// -- Bottom overlap.
		array(
			'heading' => __('Content area width', 'the7mk2'),
			'param_name' => 'bo_content_width',
			'type' => 'dt_number',
			'value' => '75%',
			'units' => 'px, %',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'bottom_overlap',
			),
		),
		array(
			'heading' => __('Content area top overlap', 'the7mk2'),
			'param_name' => 'bo_content_top_overlap',
			'type' => 'dt_number',
			'value' => '100px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'bottom_overlap',
			),
		),
		array(
			'heading' => __('Overlay background margins', 'the7mk2'),
			'param_name' => 'grovly_content_overlap',
			'type' => 'dt_number',
			'value' => '0px',
			'units' => 'px, %',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'gradient_overlay',
			),
		),
		// - Content Area.
		array(
			'heading' => __( 'Content Area', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Show background', 'the7mk2'),
			'param_name' => 'content_bg',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		array(
			'heading'		=> __('Color', 'the7mk2'),
			'param_name'	=> 'custom_content_bg_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency'	=> array(
				'element'	=> 'content_bg',
				'value'		=> 'y',
			),
			'description'   => __( 'Leave empty to use default content boxes color & decoration.', 'the7mk2' ),
		),
		array(
			'heading' => __('Content area paddings', 'the7mk2'),
			'param_name' => 'post_content_paddings',
			'type' => 'dt_spacing',
			'value' => '15px 20px 20px 20px',
			'units' => 'px',
		),
		// - Image Settings.
		array(
			'heading' => __( 'Image Settings', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Image sizing', 'the7mk2'),
			'param_name' => 'image_sizing',
			'type' => 'dropdown',
			'std' => 'resize',
			'value' => array(
				'保留图像比例' => 'proportional',
				'调整图片大小' => 'resize',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'headings' => array( __('Width', 'the7mk2'), __('Height', 'the7mk2') ),
			'param_name' => 'resized_image_dimensions',
			'type' => 'dt_dimensions',
			'value' => '3x2',
			'dependency' => array(
				'element' => 'image_sizing',
				'value' => 'resize',
			),
			'description' => __('Set image proportions, for example: 4x3, 3x2.', 'the7mk2'),
		),
		array(
			'heading' => __('Image paddings', 'the7mk2'),
			'param_name' => 'image_paddings',
			'type' => 'dt_spacing',
			'value' => '0px 0px 0px 0px',
			'units' => 'px, %',
		),
		array(
			'heading' => __('Enable scale animation on hover', 'the7mk2'),
			'param_name' => 'image_scale_animation_on_hover',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		array(
			'heading' => __('Enable hover background color', 'the7mk2'),
			'param_name' => 'image_hover_bg_color',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
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
			"heading" => __("Autoplay slides‏", "the7mk2"),
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

	  	// Post group.
		array(
			'heading' => __('Content alignment', 'the7mk2'),
			'param_name' => 'content_alignment',
			'type' => 'dropdown',
			'std' => 'left',
			'value' => array(
				'左' => 'left',
				'中' => 'center',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - Post Title.
		array(
			'heading' => __( 'Post Title', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'post_title_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'post_title_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H4 font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'post_title_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H4 line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_title_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use headers color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below title', 'the7mk2'),
			'param_name' => 'post_title_bottom_margin',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - Meta Information.
		array(
			'heading' => __( 'Meta Information', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post date', 'the7mk2'),
			'param_name' => 'post_date',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post categories', 'the7mk2'),
			'param_name' => 'post_category',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post author', 'the7mk2'),
			'param_name' => 'post_author',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post comments', 'the7mk2'),
			'param_name' => 'post_comments',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'meta_info_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'meta_info_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use small font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'meta_info_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use small line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_meta_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use secondary text color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below meta info', 'the7mk2'),
			'param_name' => 'meta_info_bottom_margin',
			'type' => 'dt_number',
			'value' => '15px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - Text.
		array(
			'heading' => __( 'Text', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Content or excerpt', 'the7mk2'),
			'param_name' => 'post_content',
			'type' => 'dropdown',
			'std' => 'show_excerpt',
			'value' => array(
				'关' => 'off',
				'摘要' => 'show_excerpt',
				'文章内容' => 'show_content',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Maximum number of words', 'the7mk2'),
			'param_name' => 'excerpt_words_limit',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_content',
				'value' => 'show_excerpt',
			),
			
			'description' => __( 'Leave empty to show full text.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'content_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'content_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Leave empty to use medium font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'content_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Leave empty to use medium line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_content_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Leave empty to use primary text color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below text', 'the7mk2'),
			'param_name' => 'content_bottom_margin',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - "Read More" Button.
		array(
			'heading' => __( '"Read More" Button', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('"Read more" button', 'the7mk2'),
			'param_name' => 'read_more_button',
			'type' => 'dropdown',
			'std' => 'default_link',
			'value' => array(
				'关' => 'off',
				'默认链接' => 'default_link',
				'默认按钮' => 'default_button',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Button text', 'the7mk2'),
			'param_name' => 'read_more_button_text',
			'type' => 'textfield',
			'value' => 'Read more',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'read_more_button',
				'value'	=> array(
					'default_link',
					'default_button',
				),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		// Fancy Elements group.
		// - Fancy Date.
		array(
			'heading' => __( 'Fancy Date', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Show Fancy date', 'the7mk2'),
			'param_name' => 'fancy_date',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'fancy_date_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Background color', 'the7mk2'),
			'param_name' => 'fancy_date_bg_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Line color', 'the7mk2'),
			'param_name' => 'fancy_date_line_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use accent color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		// - Fancy Categories.
		array(
			'heading' => __( 'Fancy Categories', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Show fancy categories', 'the7mk2'),
			'param_name' => 'fancy_categories',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'fancy_categories_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_categories',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color or category color indication.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Background color', 'the7mk2'),
			'param_name' => 'fancy_categories_bg_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_categories',
				'value'	=> 'y',
			),
			'description' => __( 'Leave empty to use predefined color or category color indication.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		 // Naviagtion group.
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
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
			'heading' => __('Arrow background color', 'the7mk2'),
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
				"离开" => "no-changes",
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
				"填充" => "fill-in",
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
			'description' => __( 'Live empty to use accent color.', 'the7mk2' ),
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
			'description' => __( 'Live empty to use accent color.', 'the7mk2' ),
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

/**
 * DT Blog.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Blog Masonry & Grid (old)", 'the7mk2'),
	"base" => "dt_blog_posts",
	"icon" => "dt_vc_ico_blog_posts",
	"class" => "dt_vc_sc_blog_posts",
	"deprecated" => '4.6',
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		// General group.
		array(
			"heading" => __("Categories", 'the7mk2'),
			"param_name" => "category",
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"admin_label" => true,
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2')
		),
		array(
			"heading" => __( "Posts Number & Order", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"heading" => __("Number of posts to show", 'the7mk2'),
			"param_name" => "number",
			"type" => "textfield",
			"value" => "12",
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __("Posts per page", 'the7mk2'),
			"param_name" => "posts_per_page",
			"type" => "textfield",
			"value" => "-1",
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __("Order by", 'the7mk2'),
			"param_name" => "orderby",
			"type" => "dropdown",
			"value" => array(
				"日期" => "date",
				"作者" => "author",
				"标题" => "title",
				"别名" => "name",
				"修改日期" => "modified",
				"ID" => "id",
				"随机" => "rand",
			),
			"description" => __("Select how to sort retrieved posts.", 'the7mk2'),
		    "edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __("Order way", 'the7mk2'),
			"param_name" => "order",
			"type" => "dropdown",
			"value" => array(
				"降序" => "desc",
				"升序" => "asc",
			),
			"description" => __("Designates the ascending or descending order.", 'the7mk2'),
		    "edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __( "Posts Filter", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"param_name" => "show_filter",
			"type" => "checkbox",
			"value" => array(
				"显示分类筛选" => "true",
			),
		),
		array(
			"param_name" => "show_orderby",
			"type" => "checkbox",
			"value" => array(
				"显示名字/日期顺序" => "true",
			),
		),
		array(
			"param_name" => "show_order",
			"type" => "checkbox",
			"value" => array(
				"显示升序/降序顺序" => "true",
			),
		),
		// Appearance group.
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Appearance", 'the7mk2'),
			"param_name" => "type",
			"type" => "dropdown",
			"value" => array(
				"切片" => "masonry",
				"网格" => "grid",
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Loading effect", 'the7mk2'),
			"param_name" => "loading_effect",
			"type" => "dropdown",
			"value" => array(
				'无' => 'none',
				'淡入' => 'fade_in',
				'上移' => 'move_up',
				'放大' => 'scale_up',
				'坠落角度' => 'fall_perspective',
				'飞' => 'fly',
				'翻转' => 'flip',
				'螺旋' => 'helix',
				'缩放' => 'scale'
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Posts width", 'the7mk2'),
			"param_name" => "same_width",
			"type" => "dropdown",
			"value" => array(
				"保留原始宽度" => "false",
				"使文章相同宽度" => "true",
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Gap between posts (px)", 'the7mk2'),
			"param_name" => "padding",
			"type" => "textfield",
			"value" => "20",
			"description" => __("Post paddings (e.g. 5 pixel padding will give you 10 pixel gaps between posts)", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Image proportions", 'the7mk2'),
			"param_name" => "proportion",
			"type" => "textfield",
			"value" => "",
			"description" => __("Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __( "Post Design & Elements", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Image & background style", 'the7mk2'),
			"param_name" => "background",
			"type" => "dropdown",
			"value" => array(
				"无背景" => "disabled",
				"全宽图片" => "fullwidth",
				"图片带填充" => "with_paddings"
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"param_name" => "show_excerpts",
			"type" => "checkbox",
			"value" => array(
				"显示摘要" => "true",
			),
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"param_name" => "show_read_more_button",
			"type" => "checkbox",
			"value" => array(
				'显示"阅读更多"按钮' => "true",
			),
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"param_name" => "fancy_date",
			"type" => "checkbox",
			"value" => array(
				"花式日期" => "true",
			),
		),
		// Elements group.
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_post_categories",
			"type" => "checkbox",
			"value" => array(
				"显示文章分类" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_post_date",
			"type" => "checkbox",
			"value" => array(
				"显示文章日期" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_post_author",
			"type" => "checkbox",
			"value" => array(
				"显示文章作者" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_post_comments",
			"type" => "checkbox",
			"value" => array(
				"显示文章评论" => "true",
			),
		),
		// Responsiveness group.
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Responsiveness", 'the7mk2'),
			"param_name" => "responsiveness",
			"type" => "dropdown",
			"value" => array(
				"基于文章宽度" => "post_width_based",
				"基于浏览器宽度" => "browser_width_based",
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Column minimum width (px)", 'the7mk2'),
			"param_name" => "column_width",
			"type" => "textfield",
			"value" => "370",
			"edit_field_class" => "vc_col-sm-6 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"post_width_based",
				),
			),
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Desired columns number", 'the7mk2'),
			"param_name" => "columns_number",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_col-sm-6 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"post_width_based",
				),
			),
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Columns on Desktop", 'the7mk2'),
			"param_name" => "columns_on_desk",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_col-sm-3 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"browser_width_based",
				),
			),
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Columns on Horizontal Tablet", 'the7mk2'),
			"param_name" => "columns_on_htabs",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_col-sm-3 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"browser_width_based",
				),
			),
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Columns on Vertical Tablet", 'the7mk2'),
			"param_name" => "columns_on_vtabs",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_col-sm-3 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"browser_width_based",
				),
			),
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Columns on Mobile Phone", 'the7mk2'),
			"param_name" => "columns_on_mobile",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_col-sm-3 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"browser_width_based",
				),
			),
		),
	)
) );

/**
 * DT Blog Scroller.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Blog Scroller (old)", 'the7mk2'),
	"base" => "dt_blog_scroller",
	"icon" => "dt_vc_ico_blog_posts",
	"class" => "dt_vc_sc_blog_posts",
	"deprecated" => '4.6',
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		// General group.
		array(
			"heading" => __("Categories", 'the7mk2'),
			"param_name" => "category",
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"admin_label" => true,
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2'),
		),
		array(
			"heading" => __( "Posts Number & Order", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"heading" => __("Number of posts to show", 'the7mk2'),
			"param_name" => "number",
			"type" => "textfield",
			"value" => "12",
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"heading" => __("Order by", 'the7mk2'),
			"param_name" => "orderby",
			"type" => "dropdown",
			"value" => array(
				"日期" => "date",
				"作者" => "author",
				"标题" => "title",
				"别名" => "name",
				"修改日期" => "modified",
				"ID" => "id",
				"随机" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __("Order way", 'the7mk2'),
			"param_name" => "order",
			"type" => "dropdown",
			"value" => array(
				"降序" => "desc",
				"升序" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		// Appearance group.
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Gap between images (px)", 'the7mk2'),
			"param_name" => "padding",
			"type" => "textfield",
			"value" => "20",
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Thumbnails width", 'the7mk2'),
			"param_name" => "width",
			"type" => "textfield",
			"value" => "",
			"description" => __("In pixels. Leave this field empty if you want to preserve original thumbnails proportions.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Thumbnails height", 'the7mk2'),
			"param_name" => "height",
			"type" => "textfield",
			"value" => "210",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Thumbnails max width", 'the7mk2'),
			"param_name" => "max_width",
			"type" => "textfield",
			"value" => "",
			"description" => __("In percents.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __( "Post Design & Elements", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Content alignment", 'the7mk2'),
			"param_name" => "content_aligment",
			"type" => "dropdown",
			"value" => array(
				'左' => 'left',
				'中' => 'center'
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Image hover background color", 'the7mk2'),
			"param_name" => "hover_bg_color",
			"type" => "dropdown",
			"value" => array(
				'彩色（来自主题选项）' => 'accent',
				'深色' => 'dark'
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Background under projects", 'the7mk2'),
			"type" => "dropdown",
			"param_name" => "bg_under_posts",
			"value" => array(
				'启用（图片带填充）' => 'with_paddings',
				'启用（图片不带填充）' => 'fullwidth',
				'禁用' => 'disabled'
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"type" => "checkbox",
			"param_name" => "show_excerpt",
			"value" => array(
				"显示摘要" => "true",
			),
		),
		// Elements group.
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_categories",
			"type" => "checkbox",
			"value" => array(
				"显示文章分类" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_date",
			"type" => "checkbox",
			"value" => array(
				"显示文章日期" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_author",
			"type" => "checkbox",
			"value" => array(
				"显示文章作者" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_comments",
			"type" => "checkbox",
			"value" => array(
				"显示文章评论" => "true",
			),
		),
	    // Slideshow group.
		array(
			"group" => __("Slideshow", 'the7mk2'),
			"heading" => __("Arrows", 'the7mk2'),
			"param_name" => "arrows",
			"type" => "dropdown",
			"value" => array(
				'浅色' => 'light',
				'深色' => 'dark',
				'长方形强调' => 'rectangular_accent',
				'禁用' => 'disabled'
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Slideshow", 'the7mk2'),
			"heading" => __("Show arrows on mobile device", 'the7mk2'),
			"param_name" => "arrows_on_mobile",
			"type" => "dropdown",
			"value" => array(
				"是" => "on",
				"否" => "off",
			),
			"dependency" => array(
				"element" => "arrows",
				"value" => array(
					'light',
					'dark',
					'rectangular_accent',
				),
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Slideshow", 'the7mk2'),
			"heading" => __("Autoslide interval (in milliseconds)", 'the7mk2'),
			"param_name" => "autoslide",
			"type" => "textfield",
			"value" => "",
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Slideshow", 'the7mk2'),
			"heading" => '&nbsp;',
			"param_name" => "loop",
			"type" => "checkbox",
			"value" => array(
				"循环" => "true",
			),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
	)
) );

/**
 * DT Gap.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Gap (old) ", 'the7mk2'),
	"base" => "dt_gap",
	"deprecated" => '4.6',
	"icon" => "dt_vc_ico_gap",
	"class" => "dt_vc_sc_gap",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap height", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "height",
			"value" => "10",
			"description" => __("In pixels.", 'the7mk2')
		)
	)
) );

/**
 * DT Fancy Media.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Fancy Media", 'the7mk2'),
	"base" => "dt_fancy_image",
	"icon" => "dt_vc_ico_fancy_image",
	"class" => "dt_vc_sc_fancy_image",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"上传媒体" => "uploaded_image",
				"媒体来自网址" => "from_url"
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose image", 'the7mk2'),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image URL", 'the7mk2'),
			"param_name" => "image",
			"value" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image size", 'the7mk2'),
			"description" => __("Enter image size in pixels. Example: 200x100 (Width x Height).", 'the7mk2'),
			"param_name" => "image_dimensions",
			"value" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image ALT", 'the7mk2'),
			"param_name" => "image_alt",
			"value" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"type" => "textfield",
			"heading" => __("Video URL", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "media",
			"value" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"type" => "dropdown",
			"heading" => __("On click action", 'the7mk2'),
			"param_name" => "onclick",
			"value" => array(
				"无" => "none",
				"在灯箱打开" => "lightbox",
				"打开自定义链接" => "custom_link",
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"type" => "textfield",
			"heading" => __("Image link", 'the7mk2'),
			"param_name" => "image_link",
			"value" => "",
			"dependency" => array(
				"element" => "onclick",
				"value" => array( "custom_link" ),
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"type" => "dropdown",
			"heading" => __("Link Target", 'the7mk2'),
			"param_name" => "custom_link_target",
			"value" => array(
				"同一窗口" => "_self",
				"新窗口" => "_blank",
			),
			"dependency" => array(
				"element" => "onclick",
				"value" => array( "custom_link" ),
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"type" => "dt_switch",
			"heading" => __("Enable image hovers", 'the7mk2'),
			"param_name" => "image_hovers",
			"value" => "true",
			"options" => array(
				"是" => "true",
				"否" => "false",
			),
			"dependency" => array(
				"element" => "onclick",
				"value" => array( "lightbox", "custom_link" ),
			)
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			"type" => "dropdown",
			"heading" => __("Style", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"全宽媒体" => "1",
				"媒体带填充和轮廓" => "2",
				"媒体带填充和适合背景" => "3"
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "textfield",
			"heading" => __("Width", 'the7mk2'),
			"param_name" => "width",
			"value" => "500",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"type" => "textfield",
			"heading" => __("Height", 'the7mk2'),
			"param_name" => "height",
			"value" => "",
			"description" => __("In pixels. Will be calculated automatically if empty.", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				),
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			'heading' => __('Border radius', 'the7mk2'),
			'param_name' => 'border_radius',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			"type" => "textfield",
			"heading" => __("Padding", 'the7mk2'),
			"param_name" => "padding",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"dependency" => array(
				"element" => "style",
				"value" => array(
					"2",
					"3"
				),
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			"type" => "textfield",
			"heading" => __("Margin-top", 'the7mk2'),
			"param_name" => "margin_top",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			"type" => "textfield",
			"heading" => __("Margin-bottom", 'the7mk2'),
			"param_name" => "margin_bottom",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			"type" => "textfield",
			"heading" => __("Margin-left", 'the7mk2'),
			"param_name" => "margin_left",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		// @TODO: Compatibility? Maybe delete.
		array(
			"type" => "textfield",
			"heading" => __("Margin-right", 'the7mk2'),
			"param_name" => "margin_right",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "dropdown",
			"heading" => __("Align", 'the7mk2'),
			"param_name" => "align",
			"std" => "center",
			"value" => array(
				"左" => "left",
				"中" => "center",
				"右" => "right"
			),
			"description" => __( 'Please note: narrow image with left or right alignment will be wrapped by the text below.', 'the7mk2' ),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"type" => "dropdown",
			"heading" => __("Image decoration", 'the7mk2'),
			"param_name" => "image_decoration",
			"value" => array(
				"无" => "none",
				"阴影" => "shadow",
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			'heading' => __('Horizontal length', 'the7mk2'),
			'param_name' => 'shadow_h_length',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'dependency' => array(
				'element' => 'image_decoration',
				'value' => 'shadow',
			),
		),
		array(
			'heading' => __('Vertical length', 'the7mk2'),
			'param_name' => 'shadow_v_length',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'dependency' => array(
				'element' => 'image_decoration',
				'value' => 'shadow',
			),
		),
		array(
			'heading' => __('Blur radius', 'the7mk2'),
			'param_name' => 'shadow_blur_radius',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'dependency' => array(
				'element' => 'image_decoration',
				'value' => 'shadow',
			),
		),
		array(
			'heading' => __('Spread', 'the7mk2'),
			'param_name' => 'shadow_spread',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'dependency' => array(
				'element' => 'image_decoration',
				'value' => 'shadow',
			),
		),
		array(
			"heading"		=> __("Shadow color", 'the7mk2'),
			"type"			=> "colorpicker",
			"param_name"	=> "shadow_color",
			"value"			=> 'rgba(0,0,0,.6)',
			'dependency' => array(
				'element' => 'image_decoration',
				'value' => 'shadow',
			),
		),
		array(
			"type" => "dropdown",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'the7mk2'),
			"param_name" => "extra_class",
			"value" => "",
			"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'the7mk2' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'the7mk2' )
		),
	)
) );

/**
 * DT Button.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Button (old)", 'the7mk2'),
	"base" => "dt_button",
	"icon" => "dt_vc_ico_button",
	"class" => "dt_vc_sc_button",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"deprecated" => '5.2.0',
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'the7mk2'),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Caption", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "content",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Link URL", 'the7mk2'),
			"param_name" => "link",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Open link in", 'the7mk2'),
			"param_name" => "target_blank",
			"value" => array(
				"原窗口" => "false",
				"新窗口" => "true"
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Smooth scroll?', 'the7mk2' ),
			'param_name' => 'smooth_scroll',
			'description' => __( 'for #anchor navigation', 'the7mk2' )
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button alignment", 'the7mk2'),
			"param_name" => "button_alignment",
			"value" => array(
				"默认" => "default",
				"中" => "center",
			),
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options()
		),
		array(
			"group" => __("Style", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Size", 'the7mk2'),
			"param_name" => "size",
			"value" => array(
				"小" => "small",
				"中" => "medium",
				"大" => "big"
			),
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Style", 'the7mk2'),
			"param_name"	=> "style",
			"value"			=> array(
				"默认（来自主题选项/按钮）"	=> "default",
				"链接"										=> "link",
				"浅色"										=> "light",
				"浅色带悬停背景"			=> "light_with_bg",
				"轮廓"									=> "outline",
				"轮廓带悬停背景"			=> "outline_with_bg",
			)
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Background (border) color", 'the7mk2'),
			"param_name"	=> "bg_color_style",
			"value"			=> array(
				"默认（来自主题选项/按钮）"	=> "default",
				"强调"									=> "accent",
				"自定义"									=> "custom"
			),
			"dependency"	=> array(
				"element"	=> "style",
				"value"		=> array(
					'default',
					'outline',
					'outline_with_bg'
				)
			),
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom background color", 'the7mk2'),
			"param_name"	=> "bg_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "bg_color_style",
				"value"		=> array( "custom" )
			),
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Background (border) hover color", 'the7mk2'),
			"param_name"	=> "bg_hover_color_style",
			"value"			=> array(
				"默认（来自主题选项/按钮）"	=> "default",
				"强调"									=> "accent",
				"自定义"									=> "custom"
			),
			"dependency"	=> array(
				"element"	=> "style",
				"value"		=> array(
					'default',
					'light_with_bg',
					'outline',
					'outline_with_bg'
				)
			),
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom background hover color", 'the7mk2'),
			"param_name"	=> "bg_hover_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "bg_hover_color_style",
				"value"		=> array( "custom" )
			),
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Text color", 'the7mk2'),
			"param_name"	=> "text_color_style",
			"value"			=> array(
				"默认（来自主题选项/按钮）"	=> "default",
				"标题"										=> "context",
				"强调"									=> "accent",
				"自定义"									=> "custom"
			)
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom text color", 'the7mk2'),
			"param_name"	=> "text_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "text_color_style",
				"value"		=> array( "custom" )
			),
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Text hover color", 'the7mk2'),
			"param_name"	=> "text_hover_color_style",
			"value"			=> array(
				"默认（来自主题选项/按钮）"	=> "default",
				"标题"										=> "context",
				"强调"									=> "accent",
				"自定义"									=> "custom"
			)
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom text hover color", 'the7mk2'),
			"param_name"	=> "text_hover_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "text_hover_color_style",
				"value"		=> array( "custom" )
			),
		),
		array(
			"group" => __("Icon", 'the7mk2'),
			"type" => "textarea_raw_html",
			"class" => "",
			"heading" => __("Icon", 'the7mk2'),
			"param_name" => "icon",
			"value" => '',
			"description" => __('f.e. <code>&lt;i class="fa fa-coffee"&gt;&lt;/i&gt;</code>', 'the7mk2'),
		),
		array(
			"group"			=> __("Icon", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon alignment", 'the7mk2'),
			"param_name" => "icon_align",
			"value" => array(
				"左" => "left",
				"右" => "right"
			)
		),
	)
) );




/**
 * DT Fancy List.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Fancy List", 'the7mk2'),
	"base" => "dt_vc_list",
	"icon" => "dt_vc_ico_list",
	"class" => "dt_vc_sc_list",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Caption", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<ul><li>Your list</li><li>goes</li><li>here!</li></ul>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("List style", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"无序" => "1",
				"有序（数字）" => "2",
				"无项目符号" => "3"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Bullet position", 'the7mk2'),
			"param_name" => "bullet_position",
			"value" => array(
				"上" => "top",
				"中" => "middle"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Dividers", 'the7mk2'),
			"param_name" => "dividers",
			"value" => array(
				"显示" => "true",
				"隐藏" => "false"
			),
			"description" => ""
		)
	)
) );

/**
 * DT Before / After.
 */

vc_map( array(
	"weight" => -1,
	'name' => __( 'Before / After', 'the7mk2' ),
	'base' => 'dt_before_after',
	'class' => 'dt_vc_sc_before_after',
	'icon' => 'dt_vc_ico_before_after',
	'category' => __( 'by Dream-Theme', 'the7mk2' ),
	'description' => "",
	'params' => array(

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose first image", 'the7mk2'),
			"param_name" => "image_1",
			"value" => "",
			"description" => ""
		),

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose second image", 'the7mk2'),
			"param_name" => "image_2",
			"value" => "",
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"holder" => "div",
			"heading" => __("Orientation", 'the7mk2'),
			"param_name" => "orientation",
			"value" => array(
				"垂直" => "horizontal",
				"水平" => "vertical"
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"holder" => "div",
			"heading" => __("Navigation", 'the7mk2'),
			"param_name" => "navigation",
			"value" => array(
				"点击并拖动" => "drag",
				"跟随" => "move"
			),
			"description" => ""
		),

		array(
			'type' => 'textfield',
			"holder" => "div",
			'heading' => __( 'Visible part of the "Before" image (in %)', 'the7mk2' ),
			'param_name' => 'offset',
			'std' => '50',
			'description' => "",
		),

	)
) );

vc_map( array(
	"weight" => -1,
	'name' => __( 'Breadcrumbs', 'the7mk2' ),
	'base' => 'dt_breadcrumbs',
	'class' => 'dt_vc_sc_breadcrumbs',
	'icon' => 'dt_vc_ico_breadcrumbs',
	'category' => __( 'by Dream-Theme', 'the7mk2' ),
	'description' => "",
	'params' => array(
		array(
			'heading' => __( 'Font', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'font_style',
			'type' => 'dt_font_style',
			'value' => '',
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H3 font size.', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H3 line height.', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'font_color',
			'type'			=> 'colorpicker',
			'value'			=> '#a2a5a6',
			'description' => __( 'Leave empty to use headers color.', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Background', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Paddings', 'the7mk2'),
			'param_name' => 'paddings',
			'type' => 'dt_spacing',
			'value' => '2px 10px 2px 10px',
			'units' => 'px',
		),
		array(
			'heading'		=> __('Background color', 'the7mk2'),
			'param_name'	=> 'bg_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
		),
		array(
			'heading' => __( 'Border', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading'		=> __('Border color', 'the7mk2'),
			'param_name'	=> 'border_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
		),
		array(
			'heading' => __('Border width', 'the7mk2'),
			'param_name' => 'border_width',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'heading' => __('Border radius', 'the7mk2'),
			'param_name' => 'border_radius',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'heading' => __( 'Position', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Alignment', 'the7mk2'),
			'type' => 'dropdown',
			'holder' => 'div',
			'param_name' => 'alignment',
			'value' => array(
				'中' => 'center',
				'左' => 'left',
				'右' => 'right',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
	)
) );

/**
 * DT Carousel.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Carousel", 'the7mk2'),
	"base" => "dt_carousel",
	"icon" => "dt_vc_ico_carousel",
	"class" => "dt_carousel",
	"as_parent" => array('except' => 'dt_carousel'),
	"content_element" => true,
	"controls" => "full",
	"show_settings_on_create" => true,
	"category" => __('by Dream-Theme', 'the7mk2'),
    "admin_enqueue_css" => array(get_template_directory_uri().'/fonts/icomoon-arrows-the7/style.css'),
	"params" => array(
		// General group.
		
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
			"heading" => __("Autoplay slides‏", "the7mk2"),
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
		
		 // Naviagtion group.
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
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
			'heading' => __('Arrow background color', 'the7mk2'),
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
			'description' => __( "Live empty to use accent color.", 'the7mk2' ),
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
				"自适应箭头" => "reposition-arrows",
				"保持原样" => "no-changes",
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
				"小圆点" => "small-dot-stroke",
				"放大" => "scale-up",
				"圆点" => "stroke",
				"填充" => "fill-in",
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
			'description' => __( 'Live empty to use accent color.', 'the7mk2' ),
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
			'description' => __( 'Live empty to use accent color.', 'the7mk2' ),
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
			'param_name' => 'css_dt_carousel',
			'group' => __( 'Design Options', 'the7mk2' )
		),

	),
	"js_view" => 'VcColumnView'

) );

/**
 * DT Default button.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Default Button", 'the7mk2'),
	"base" => "dt_default_button",
	"icon" => "dt_vc_ico_button",
	"class" => "dt_vc_default_button",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Caption", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "content",
			"value" => ""
		),
		array(
			"type" => "vc_link",
			"class" => "",
			"heading" => __("Link URL", 'the7mk2'),
			"param_name" => "link",
			"value" => ""
		),
		// array(
		// 	"type" => "dropdown",
		// 	"class" => "",
		// 	"heading" => __("Open link in", 'the7mk2'),
		// 	"param_name" => "target_blank",
		// 	"value" => array(
		// 		"Same window" => "false",
		// 		"New window" => "true"
		// 	)
		// ),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Enable smooth scroll for anchor navigation', 'the7mk2' ),
			'param_name' => 'smooth_scroll',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'description' => __( 'for #anchor navigation', 'the7mk2' )
		),
		
	
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'the7mk2'),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'the7mk2')
		),
		array(
			"group" => __("Style", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Size", 'the7mk2'),
			"param_name" => "size",
			"value" => array(
				"小" => "small",
				"中" => "medium",
				"大" => "big"
			),
			"description" => __("Buttons style, color, font, border radius & paddings can be set up in Theme Options / Buttons. ", 'the7mk2')
		),

		
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button width", 'the7mk2'),
			"param_name" => "btn_width",
			"value" => array(
				"默认" => "btn_auto_width",
				"自定义" => "btn_fixed_width",
				"全宽" => "btn_full_width"
			),
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"heading" => __("Width", 'the7mk2'),
			"param_name" => "custom_btn_width",
			"type" => "dt_number",
			"value" => "200px",
			'dependency'	=> array(
				'element'	=> 'btn_width',
				'value'		=> 'btn_fixed_width',
			),
			"edit_field_class" => "vc_col-sm-3 vc_column dt_col_custom",
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button alignment", 'the7mk2'),
			"param_name" => "button_alignment",
			"value" => array(
				"内联左" => "btn_inline_left",
				"内联右" => "btn_inline_right",
				"左" => "btn_left",
				"中" => "btn_center",
				"右" => "btn_right"
			),
		),
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options()
		),
		array(
			"group"			=> __("Color", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom background color", 'the7mk2'),
			"param_name"	=> "default_btn_bg_color",
			"value"			=> '',
			"description" => __("Leave empty to use default color from Theme Options/Buttons ", 'the7mk2')
		),
		array(
			"group"			=> __("Color", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom background hover color", 'the7mk2'),
			"param_name"	=> "bg_hover_color",
			"value"			=> '',
			"description" => __("Leave empty to use default color from Theme Options/Buttons ", 'the7mk2')
		),
		array(
			"group"			=> __("Color", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom text color", 'the7mk2'),
			"param_name"	=> "text_color",
			"value"			=> '',
			"description" => __("Leave empty to use default color from Theme Options/Buttons ", 'the7mk2')
		),
		array(
			"group"			=> __("Color", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom text hover color", 'the7mk2'),
			"param_name"	=> "text_hover_color",
			"value"			=> '',
			"description" => __("Leave empty to use default color from Theme Options/Buttons ", 'the7mk2')
		),
		array(
			"group"			=> __("Icon", 'the7mk2'),
			"type" => "textarea_raw_html",
			"class" => "",
			"heading" => __("Icon", 'the7mk2'),
			"param_name" => "icon",
			"value" => '',
			//"description" => __('f.e. <code>&lt;i class="fa fa-coffee"&gt;&lt;/i&gt;</code>', 'the7mk2'),
			'description' => sprintf( __( 'f.e. <code>&lt;i class="fa fa-arrow-circle-right"&gt;&lt;/i&gt;</code> <a href="%s" target="_blank">http://fontawesome.io/icons/</a>.', 'the7mk2' ), 'http://fontawesome.io/icons/' ),
			'edit_field_class' => 'custom-textarea-height vc_col-xs-12  vc_column',
		),
		
		array(
			"group"			=> __("Icon", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon alignment", 'the7mk2'),
			"param_name" => "icon_align",
			"value" => array(
				"左" => "left",
				"右" => "right"
			)
		),

		array(
			'type' => 'css_editor',
            'heading' => __( 'CSS box', 'the7mk2' ),
            'param_name' => 'css',
            'group' => __( 'Design Options ', 'the7mk2' ),
            'edit_field_class' => 'vc_col-sm-12 vc_column no-vc-background no-vc-padding no-vc-border',
		),
	)
) );

vc_map( array(
	"weight" => -1,
	"name" => __("Social Icons", 'the7mk2'),
	"base" => "dt_soc_icons",
	"icon" => "dt_vc_soc_icons",
	"class" => "dt_vc_soc_icons",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"as_parent" => array('only' => 'dt_single_soc_icon'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	"content_element" => true,
	"show_settings_on_create" => true,
	//"is_container"    => true,
	"js_view" => 'VcColumnView',
	"params" => array(
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Alignment","the7mk2"),
			"param_name" => "icon_align",
			"value" => array(
				"中" => "center",
				"左" => "left",
				"右" => "right"
			),
			//"description" => __("", "smile"),
		),
		array(
			'heading'		=> __( 'Extra class name', 'the7mk2' ),
			'description'	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'the7mk2' ),
			'param_name'	=> 'el_class',
			'type'			=> 'textfield',
		),

		array(
			'type' => 'css_editor',
            'heading' => __( 'CSS box', 'the7mk2' ),
            'param_name' => 'css',
            'group' => __( 'Design ', 'the7mk2' ),
            'edit_field_class' => 'vc_col-sm-12 vc_column no-vc-background no-vc-border',
		),
	)
) );

vc_map(
	array(
	   "name" => __("Social Icon Item"),
	   "base" => "dt_single_soc_icon",
	   "class" => "dt_vc_single_soc_icon",
	   "icon" => "dt_vc_soc_icon",
	   "category" => __('by Dream-Theme', 'the7mk2'),
	   "description" => __("Add a set of multiple icons and give some custom style.","the7mk2"),
	   "as_child" => array('only' => 'dt_soc_icons'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	   "show_settings_on_create" => true,
	   "is_container"    => false,
    	"admin_enqueue_css" => array(get_template_directory_uri().'/fonts/icomoon-the7-social/style.css'),
    	"front_enqueue_css" => array(get_template_directory_uri().'/fonts/icomoon-the7-social/style.css'),
	   "params" => array(

	   		array(
				"type" => "vc_link",
				"class" => "",
				"heading" => __("Icon link", 'the7mk2'),
				"param_name" => "link",
				"value" => ""
			),

			array(
				"heading" => __( "Social Icon", 'the7mk2' ),
				"param_name" => "dt_title",
				"type" => "dt_title",
			),
			array(
				"heading" => __("Choose icon", "the7mk2"),
				"param_name" => "dt_soc_icon",
				"type" => "dt_soc_icon_manager",
				"value" => "icon-ar-017-r",
			),
			array(
				"heading" => __("Icon size", 'the7mk2'),
				"param_name" => "soc_icon_size",
				"type" => "dt_number",
				"value" => "16px",
				"units" => "px",
			),
			array(
				"heading" => __( "Icon Background", 'the7mk2' ),
				"param_name" => "dt_title",
				"type" => "dt_title",
			),
			array(
				"heading" => __("Background size", 'the7mk2'),
				"param_name" => "soc_icon_bg_size",
				"type" => "dt_number",
				"value" => "26px",
				"units" => "px",
			),
			array(
				"heading" => __("Border width", 'the7mk2'),
				"param_name" => "soc_icon_border_width",
				"type" => "dt_number",
				"value" => "0",
				"units" => "px",
			),
			array(
				"heading" => __("Border radius", 'the7mk2'),
				"param_name" => "soc_icon_border_radius",
				"type" => "dt_number",
				"value" => "100px",
				"units" => "px",
			),
			array(
				"heading" => __( "Normal", 'the7mk2' ),
				"param_name" => "dt_title",
				"type" => "dt_title",
			),
			array(
				'heading' => __('Icon color', 'the7mk2'),
				'description' => __( "Live empty to use accent color.", 'the7mk2' ),
				'param_name' => 'soc_icon_color',
				'type' => 'colorpicker',
				'value' => 'rgba(255,255,255,1)',
			),
			array(
				'heading' => __('Icon border color  ', 'the7mk2'),
				'description' => __( "Live empty to use accent color.", 'the7mk2' ),
				'param_name' => 'soc_icon_border_color',
				'type' => 'colorpicker',
				'value' => '',
			),
			array(
				'heading' => __('Show icon background', 'the7mk2'),
				'param_name' => 'soc_icon_bg',
				'type' => 'dt_switch',
				'value' => 'y',
				'options' => array(
					'是' => 'y',
					'否' => 'n',
				),
			),
			array(
				'heading'		=> __('Icon background color', 'the7mk2'),
				'param_name'	=> 'soc_icon_bg_color',
				'type'			=> 'colorpicker',
				'value'			=> '',
				'dependency'	=> array(
					'element'	=> 'soc_icon_bg',
					'value'		=> 'y',
				),
				'description'   => __( 'Live empty to use accent color.', 'the7mk2' ),
			),
			array(
				"heading" => __( "Hover", 'the7mk2' ),
				"param_name" => "dt_title",
				"type" => "dt_title",
			),
			array(
				'heading' => __('Icon color', 'the7mk2'),
				'description' => __( "Live empty to use accent color.", 'the7mk2' ),
				'param_name' => 'soc_icon_color_hover',
				'type' => 'colorpicker',
				'value' => 'rgba(255,255,255,0.75)',
			),
			array(
				'heading' => __('Icon border color  ', 'the7mk2'),
				'description' => __( "Live empty to use accent color.", 'the7mk2' ),
				'param_name' => 'soc_icon_border_color_hover',
				'type' => 'colorpicker',
				'value' => '',
			),
			array(
				'heading' => __('Show icon background', 'the7mk2'),
				'param_name' => 'soc_icon_bg_hover',
				'type' => 'dt_switch',
				'value' => 'y',
				'options' => array(
					'是' => 'y',
					'否' => 'n',
				),
			),
			array(
				'heading'		=> __('Icon background color', 'the7mk2'),
				'param_name'	=> 'soc_icon_bg_color_hover',
				'type'			=> 'colorpicker',
				'value'			=> '',
				'dependency'	=> array(
					'element'	=> 'soc_icon_bg_hover',
					'value'		=> 'y',
				),
				'description'   => __( 'Live empty to use accent color.', 'the7mk2' ),
			),
			array(
			'type' => 'css_editor',
            'heading' => __( 'CSS box', 'the7mk2' ),
            'param_name' => 'css',
            'group' => __( 'Design ', 'the7mk2' ),
            'edit_field_class' => 'vc_col-sm-12 vc_column no-vc-background no-vc-border',
		),
		),
	)
);


include dirname( __FILE__ ) . '/wc_js_composer_bridge.php';

