<?php
/**
 * Benefits shortcodes VC bridge
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// ! Benefits
vc_map( array(
	"weight" => -1,
	"name" => __("Benefits", 'dt-the7-core'),
	"base" => "dt_benefits_vc",
	"icon" => "dt_vc_ico_benefits",
	"class" => "dt_vc_sc_benefits",
	"category" => __('by Dream-Theme', 'dt-the7-core'),
	"params" => array(

		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_benefits_category",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Categories", 'dt-the7-core'),
			"param_name" => "category",
			"description" => __("Note: By default, all your benefits will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'dt-the7-core')
		),

		// Column min width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", 'dt-the7-core'),
			"param_name" => "column_width",
			"value" => "180"
		),

		// Column max width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", 'dt-the7-core'),
			"param_name" => "columns_number",
			"value" => "3"
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Benefits layout", 'dt-the7-core'),
			"param_name" => "style",
			"value" => array(
				"图片，标题和内容居中" => "1",
				"图片和标题内嵌" => "2",
				"图片在左" => "3"
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icons backgrounds", 'dt-the7-core'),
			"param_name" => "image_background",
			"value" => array(
				"显示" => "true",
				"隐藏" => "false"
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Border radius for image backgrounds", 'dt-the7-core'),
			"param_name" => "image_background_border",
			"value" => array(
				"默认" => "",
				"自定义" => "custom"
			),
			"description" => ""
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Border radius (in px)", 'dt-the7-core'),
			"param_name" => "image_background_border_radius",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "image_background_border",
				"value" => array(
					"custom"
				)
			)
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Background size (in px)", 'dt-the7-core'),
			"param_name" => "image_background_size",
			"value" => "70",
			"description" => "",
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Backgrounds color", 'dt-the7-core'),
			"param_name" => "image_background_paint",
			"value" => array(
				"默认" => "light",
				"强调" => "accent",
				"自定义颜色" => "custom"
			),
			"description" => ""
		),

		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => "",
			"param_name" => "image_background_color",
			"value" => "#222222",
			"description" => "",
			"dependency" => array(
				"element" => "image_background_paint",
				"value" => array(
					"custom"
				)
			)
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Backgrounds hover color", 'dt-the7-core'),
			"param_name" => "image_hover_background_paint",
			"value" => array(
				"默认" => "light",
				"强调" => "accent",
				"自定义颜色" => "custom"
			),
			"description" => ""
		),

		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => "",
			"param_name" => "image_hover_background_color",
			"value" => "#444444",
			"description" => "",
			"dependency" => array(
				"element" => "image_hover_background_paint",
				"value" => array(
					"custom"
				)
			)
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Icon size (in px)", 'dt-the7-core'),
			"param_name" => "icons_size",
			"value" => "38",
			"description" => "",
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icons color", 'dt-the7-core'),
			"param_name" => "icons_paint",
			"value" => array(
				"半透明" => "light",
				"强调" => "accent",
				"自定义颜色" => "custom"
			),
			"description" => ""
		),

		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => "",
			"param_name" => "icons_color",
			"value" => "#ffffff",
			"description" => "",
			"dependency" => array(
				"element" => "icons_paint",
				"value" => array(
					"custom"
				)
			)
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icons hover color", 'dt-the7-core'),
			"param_name" => "icons_hover_paint",
			"value" => array(
				"半透明" => "light",
				"强调" => "accent",
				"自定义颜色" => "custom"
			),
			"description" => ""
		),

		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => "",
			"param_name" => "icons_hover_color",
			"value" => "#dddddd",
			"description" => "",
			"dependency" => array(
				"element" => "icons_hover_paint",
				"value" => array(
					"custom"
				)
			)
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Decorative lines", 'dt-the7-core'),
			"param_name" => "decorative_lines",
			"value" => array(
				"强调" => "hover",
				"半透明" => "static",
				"禁用" => "disabled"
			),
			'std' => 'disabled',
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Title font size", 'dt-the7-core'),
			"param_name" => "header_size",
			"value" => array(
				"H1" => "h1",
				"H2" => "h2",
				"H3" => "h3",
				"H4" => "h4",
				"H5" => "h5",
				"H6" => "h6"
			),
			'std' => 'h5',
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content font size", 'dt-the7-core'),
			"param_name" => "content_size",
			"value" => array(
				"大" => "big",
				"中" => "normal",
				"小" => "small"
			),
			"description" => ""
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of benefits to show", 'dt-the7-core'),
			"param_name" => "number",
			"value" => "8",
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Open link in", 'dt-the7-core'),
			"param_name" => "target_blank",
			"value" => array(
				"同一窗口" => "false",
				"新窗口" => "true"
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", 'dt-the7-core'),
			"param_name" => "orderby",
			"value" => array(
				"日期" => "date",
				"作者" => "author",
				"标题" => "title",
				"别名" => "name",
				"修改日期" => "modified",
				"ID" => "id",
				"随机" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", 'dt-the7-core')
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", 'dt-the7-core'),
			"param_name" => "order",
			"value" => array(
				"降序" => "desc",
				"升级" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", 'dt-the7-core')
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'dt-the7-core'),
			"admin_label" => true,
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animate", 'dt-the7-core'),
			"param_name" => "animate",
			"value" => array(
				"一个接一个" => 'one_by_one',
				"同时出现" => 'at_the_same_time'
			),
			"description" => ""
		),
	)
) );
