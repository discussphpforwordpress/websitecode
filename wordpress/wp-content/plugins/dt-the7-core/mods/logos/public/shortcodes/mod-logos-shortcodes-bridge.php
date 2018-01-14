<?php
/**
 * Logos shortcodes VC bridge
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// ! Logos
vc_map( array(
	"weight" => -1,
	"name" => __("Clients", 'dt-the7-core'),
	"base" => "dt_logos",
	"icon" => "dt_vc_ico_logos",
	"class" => "dt_vc_sc_logos",
	"category" => __('by Dream-Theme', 'dt-the7-core'),
	"params" => array(
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_logos_category",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Categories", 'dt-the7-core'),
			"param_name" => "category",
			"description" => __("Note: By default, all your logotypes will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'dt-the7-core')
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
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of logotypes to show", 'dt-the7-core'),
			"param_name" => "number",
			"value" => "12",
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
				"升序" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", 'dt-the7-core')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'dt-the7-core'),
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
