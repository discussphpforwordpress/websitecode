<?php
/**
 * Albums shortcodes VC bridge
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// common
$loading_effect = array(
	array(
		"heading"		=> __( "Loading effect", 'dt-the7-core' ),
		"param_name"	=> "loading_effect",
		"type"			=> "dropdown",
		"value"			=> array(
			'无'				=> 'none',
			'淡入'			=> 'fade_in',
			'上移'			=> 'move_up',
			'Scale up'			=> 'scale_up',
			'Fall perspective'	=> 'fall_perspective',
			'Fly'				=> 'fly',
			'翻转'				=> 'flip',
			'Helix'				=> 'helix',
			'Scale'				=> 'scale',
		),
		"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		"group" => __( "Appearance", 'dt-the7-core' ),
	),
);

$show_meta = array(
		array(
			"value"			=> array( "显示专辑分类" => "true" ),
			"param_name"	=> "show_categories",
			"type"			=> "checkbox",
			"group" => __( "Project Meta", 'dt-the7-core' ),
		),
		array(
			"value"			=> array( "显示专辑日期" => "true" ),
			"param_name"	=> "show_date",
			"type"			=> "checkbox",
			"group" => __( "Project Meta", 'dt-the7-core' ),
		),
		array(
			"value"			=> array( "显示专辑作者" => "true" ),
			"param_name"	=> "show_author",
			"type"			=> "checkbox",
			"group" => __( "Project Meta", 'dt-the7-core' ),
		),
		array(
			"value"			=> array( "显示专辑评论" => "true" ),
			"param_name"	=> "show_comments",
			"type"			=> "checkbox",
			"group" => __( "Project Meta", 'dt-the7-core' ),
		),
);

$ordering = array(
		array(
			"heading"		=> __( "Order by", 'dt-the7-core' ),
			"description"	=> __( "Select how to sort retrieved posts.", 'dt-the7-core' ),
			"param_name"	=> "orderby",
			"type"			=> "dropdown",
			"value"			=> array(
				"日期"			=> "date",
				"作者"		=> "author",
				"标题"			=> "title",
				"别名"			=> "name",
				"修改日期"	=> "modified",
				"ID"			=> "id",
				"随机"		=> "rand",
			),
			"edit_field_class" => "vc_col-sm-6 vc_column dt_stle",
		),
		array(
			"heading"		=> __( "Order way", 'dt-the7-core' ),
			"description"	=> __( "Designates the ascending or descending order.", 'dt-the7-core' ),
			"param_name"	=> "order",
			"type"			=> "dropdown",
			"value"			=> array(
				"降序"	=> "desc",
				"升序"		=> "asc",
			),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
);

$category = array(
	array(
		"heading"		=> __( "Categories", 'dt-the7-core' ),
		"description"	=> __( "Note: By default, all your albums will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'dt-the7-core' ),
		"param_name"	=> "category",
		"type"			=> "dt_taxonomy",
		"taxonomy"		=> "dt_gallery_category",
		"admin_label"	=> true,
	)
);

$padding = array(
	array(
		"heading"		=> __( "Gap between images (px)", 'dt-the7-core' ),
		"param_name"	=> "padding",
		"type"			=> "textfield",
		"value"			=> "20",
		"edit_field_class" => "vc_col-sm-6 vc_column",
		"group" => __( "Appearance", 'dt-the7-core' ),
	),
);

$proportion = array(
	array(
		"heading"		=> __( "Thumbnails proportions", 'dt-the7-core' ),
		"description"	=> __( "Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", 'dt-the7-core' ),
		"param_name"	=> "proportion",
		"type"			=> "textfield",
		"value"			=> "",
		"edit_field_class" => "vc_col-sm-6 vc_column",
		"group" => __( "Appearance", 'dt-the7-core' ),
	),
);

// albums
$show_albums_content = array(
		array(
			"value"			=> array( "显示专辑标题" => "true" ),
			"param_name"	=> "show_title",
			"type"			=> "checkbox",
			"group" => __( "Appearance", 'dt-the7-core' ),
		),
		array(
			"value"			=> array( "显示专辑摘要" => "true" ),
			"param_name"	=> "show_excerpt",
			"type"			=> "checkbox",
			"group" => __( "Appearance", 'dt-the7-core' ),
		),
);

$show_filter = array(
		array(
			"value"			=> array( "显示分类筛选" => "true" ),
			"param_name"	=> "show_filter",
			"type"			=> "checkbox",
		),
);

$show_filter_ordering = array(
		array(
			"value"			=> array( "显示名字/日期顺序" => "true" ),
			"param_name"	=> "show_orderby",
			"type"			=> "checkbox",
		),
		array(
			"value"			=> array( "显示升序/降序顺序" => "true" ),
			"param_name"	=> "show_order",
			"type"			=> "checkbox",
		),
);

$show_miniatures = array(
	array(
		"value" => array( "显示图像微缩" => "true" ),
		"param_name" => "show_miniatures",
		"type" => "checkbox",
		"group" => __( "Appearance", 'dt-the7-core' ),
	),
);

$albums_to_show = array(
		array(
			"heading"		=> __( "Number of albums to show", 'dt-the7-core' ),
			"param_name"	=> "number",
			"type"			=> "textfield",
			"value"			=> "12",
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
);

$show_media_count = array(
	array(
		"value" => array( "显示图片和视频数量" => "true" ),
		"param_name" => "show_media_count",
		"type" => "checkbox",
		"group" => __( "Project Meta", 'dt-the7-core' ),
	),
);

$albums_per_page = array(
		array(
			"heading"		=> __( "Albums per page", 'dt-the7-core' ),
			"param_name"	=> "posts_per_page",
			"type"			=> "textfield",
			"value"			=> "-1",
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
);

// photos
$show_photos_content = $show_albums_content;
$show_photos_content[0]["value"] = array( "显示标题" => "true" );
$show_photos_content[1]["value"] = array( "显示项目描述" => "true" );

$photos_to_show = $albums_to_show;
$photos_to_show[0]["heading"] = __( "Number of items to show", 'dt-the7-core' );
$photos_to_show[0]["edit_field_class"] = "vc_col-xs-12 vc_column dt_row-6";

// masonry
$padding_masonry = $padding;
$padding_masonry[0]["description"] = __( "Image paddings (e.g. 5 pixel padding will give you 10 pixel gaps between images)", 'dt-the7-core' );

// scroller
$scroller_padding = $padding;
$scroller_padding[0]["edit_field_class"] = "vc_col-xs-12 vc_column dt_row-6";
$scroller_albums_to_show = $albums_to_show;
$scroller_albums_to_show[0]["edit_field_class"] = "vc_col-xs-12 vc_column dt_row-6";

$appearance = array(
	array(
		"heading" => __( "Appearance", 'dt-the7-core' ),
		"param_name" => "type",
		"type" => "dropdown",
		"value" => array(
			"切片" => "masonry",
			"网格" => "grid",
		),
		"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		"group" => __("Appearance", 'dt-the7-core'),
	),
);

// jgrid
$target_height = array(
	array(
		"heading" => __( "Row target height (px)", 'dt-the7-core' ),
		"param_name" => "target_height",
		"type" => "textfield",
		"value" => "240",
		"edit_field_class" => "vc_col-sm-6 vc_column",
		"group" => __("Appearance", 'dt-the7-core'),
	),
);

$hide_last_row = array(
	array(
		"value" => array( "如果不通过图片填充它，隐藏最后行" => "true" ),
		"heading" => '&nbsp;',
		"param_name" => "hide_last_row",
		"type" => "checkbox",
		"edit_field_class" => "vc_col-sm-6 vc_column",
		"group" => __("Appearance", 'dt-the7-core'),
	),
);

// scroller
$scroller_arrows = array(
	array(
		"heading" => __("Arrows", 'dt-the7-core'),
		"param_name" => "arrows",
		"type" => "dropdown",
		"value" => array(
			'浅色' => 'light',
			'深色' => 'dark',
			'长方形强调' => 'rectangular_accent',
			'禁用' => 'disabled',
		),
		"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		"group" => __("Slideshow", 'dt-the7-core'),
	),
	array(
		"group" => __("Slideshow", 'dt-the7-core'),
		"heading" => __("Show arrows on mobile device", 'dt-the7-core'),
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
);

$scroller_slidehow_controls = array(
	array(
		"heading" => __( "Autoslide interval (in milliseconds)", 'dt-the7-core' ),
		"param_name" => "autoslide",
		"type" => "textfield",
		"value" => "",
		"edit_field_class" => "vc_col-sm-6 vc_column",
		"group" => __("Slideshow", 'dt-the7-core'),
	),
	array(
		"value" => array( "Loop" => "true" ),
		"heading" => '&nbsp;',
		"param_name" => "loop",
		"type" => "checkbox",
		"edit_field_class" => "vc_col-sm-6 vc_column",
		"group" => __("Slideshow", 'dt-the7-core'),
	),
);

// hover
$descriptions = array(
	"heading"		=> __( "Show albums descriptions", 'dt-the7-core' ),
	"param_name"	=> "descriptions",
	"type"			=> "dropdown",
	"value"			=> array(
		'图片下'							=> 'under_image',
		'在彩色背景'					=> 'on_hover_centered',
		'在深色渐变'						=> 'on_dark_gradient',
		'在底部'							=> 'from_bottom',
		'背景和动画线'			=> 'bg_with_lines',
	),
	"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
	"group" => __( "Appearance", 'dt-the7-core' ),
);

$bg_under_posts = array(
	"heading"		=> __( "Background under albums", 'dt-the7-core' ),
	"param_name"	=> "bg_under_albums",
	"type"			=> "dropdown",
	"value"			=> array(
		'启用（图片带填充）'		=> 'with_paddings',
		'启用（图片无填充）'	=> 'fullwidth',
		'禁用'							=> 'disabled'
	),
	"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
	"group" => __( "Appearance", 'dt-the7-core' ),
);

$hover_animation = array(
	"heading"		=> __( "Animation", 'dt-the7-core' ),
	"param_name"	=> "hover_animation",
	"type"			=> "dropdown",
	"value"			=> array(
		'淡入'						=> 'fade',
		'方向感知'			=> 'direction_aware',
		'反方向感知'	=> 'redirection_aware',
		'缩放'					=> 'scale_in',
	),
	"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
	"group" => __( "Appearance", 'dt-the7-core' ),
);

$hover_bg_color = array(
	"heading"		=> __( "Image hover background color", 'dt-the7-core' ),
	"param_name"	=> "hover_bg_color",
	"type"			=> "dropdown",
	"value"			=> array(
		'彩色（来自主题选项）'	=> 'accent',
		'深色'							=> 'dark',
	),
	"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
	"group" => __( "Appearance", 'dt-the7-core' ),
);

$bgwl_animation_effect = array(
	"heading"		=> __( "Animation effect", 'dt-the7-core' ),
	"param_name"	=> "bgwl_animation_effect",
	"type"			=> "dropdown",
	"value"			=> array(
		'效果 1'	=> '1',
		'效果 2'	=> '2',
		'效果 3'	=> '3',
	),
	"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
	"group" => __( "Appearance", 'dt-the7-core' ),
);

$hover_content_visibility = array(
	"heading"		=> __( "Content", 'dt-the7-core' ),
	"param_name"	=> "hover_content_visibility",
	"type"			=> "dropdown",
	"value"			=> array(
		'在悬停'			=> 'on_hover',
		'始终可见'	=> 'always'
	),
	"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
	"group" => __( "Appearance", 'dt-the7-core' ),
);

$colored_bg_content_aligment = array(
	"heading"		=> __( "Content alignment", 'dt-the7-core' ),
	"param_name"	=> "colored_bg_content_aligment",
	"type"			=> "dropdown",
	"value"			=> array(
		"中"		=> "centre",
		"下"		=> "bottom",
		"左上"	=> "left_top",
		"左下"	=> "left_bottom",
	),
	"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
	"group" => __( "Appearance", 'dt-the7-core' ),
);

$content_aligment = array(
	"heading"		=> __( "Content alignment", 'dt-the7-core' ),
	"param_name"	=> "content_aligment",
	"type"			=> "dropdown",
	"value"			=> array(
		'左'			=> 'left',
		'中'		=> 'center',
	),
	"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
	"group" => __( "Appearance", 'dt-the7-core' ),
);

$descriptions_masonry = array(
	$descriptions,
	array_merge( $bg_under_posts, array(
		"dependency"	=> array(
			"element"	=> "descriptions",
			"value"		=> array( 'under_image' ),
		),
	) ),
	array_merge( $hover_animation, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array( 'on_hover_centered' ),
		),
	) ),
	array_merge( $hover_bg_color, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array(
				'on_hover_centered',
				'under_image',
				'bg_with_lines',
			),
		),
	) ),
	array_merge( $bgwl_animation_effect, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array( 'bg_with_lines' ),
		),
	) ),
	array_merge( $hover_content_visibility, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array(
				'on_dark_gradient',
				'bg_with_lines',
			),
		),
	) ),
	array_merge( $colored_bg_content_aligment, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array( 'on_hover_centered' ),
		),
	) ),
	array_merge( $content_aligment, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array(
				'under_image',
				'on_dark_gradient',
				'from_bottom',
			),
		),
	) ),
);

$descriptions_jgrid = array(
	array_merge( $descriptions, array( 'value' => array_diff( $descriptions['value'], array( 'under_image' ) ) ) ),
	array_merge( $hover_animation, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array( 'on_hover_centered' ),
		),
	) ),
	array_merge( $hover_bg_color, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array(
				'on_hover_centered',
				'bg_with_lines',
			),
		),
	) ),
	array_merge( $bgwl_animation_effect, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array( 'bg_with_lines' ),
		),
	) ),
	array_merge( $hover_content_visibility, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array(
				'on_dark_gradient',
				'bg_with_lines',
			),
		),
	) ),
	array_merge( $colored_bg_content_aligment, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array( 'on_hover_centered' ),
		),
	) ),
	array_merge( $content_aligment, array(
		"dependency"	=> array(
			"element"		=> "descriptions",
			"value"			=> array(
				'on_dark_gradient',
				'from_bottom',
			),
		),
	) ),
);

$album_number_order_title = array(
	array(
		"heading" => __( "Albums Number & Order", 'dt-the7-core' ),
		"param_name" => "dt_title",
		"type" => "dt_title",
	)
);

$album_filter_title = array( array(
	"heading" => __( "Albums Filter", 'dt-the7-core' ),
	"param_name" => "dt_title",
	"type" => "dt_title",
) );

$album_design_title = array( array(
	"heading" => __( "Album Design", 'dt-the7-core' ),
	"param_name" => "dt_title",
	"type" => "dt_title",
	"group" => __("Appearance", 'dt-the7-core'),
                             ) );

$album_elements_title = array( array(
	"heading" => __( "Album Elements", 'dt-the7-core' ),
	"param_name" => "dt_title",
	"type" => "dt_title",
	"group" => __("Appearance", 'dt-the7-core'),
) );

$photo_number_order_title = array(
	array(
		"heading" => __( "Albums Number & Order", 'dt-the7-core' ),
		"param_name" => "dt_title",
		"type" => "dt_title",
	)
);

$photo_filter_title = array(
	array(
	                             "heading" => __( "Albums Filter", 'dt-the7-core' ),
	                             "param_name" => "dt_title",
	                             "type" => "dt_title",
    )
);

$photo_design_title = array(
	array(
	                             "heading" => __( "Album Design", 'dt-the7-core' ),
	                             "param_name" => "dt_title",
	                             "type" => "dt_title",
	                             "group" => __("Appearance", 'dt-the7-core'),
                             )
);

$photo_elements_title = array(
	array(
	                               "heading" => __( "Album Elements", 'dt-the7-core' ),
	                               "param_name" => "dt_title",
	                               "type" => "dt_title",
	                               "group" => __("Appearance", 'dt-the7-core'),
                               )
);

$responsiveness = array(
	array(
		"heading" => __("Responsiveness", 'dt-the7-core'),
		"param_name" => "responsiveness",
		"type" => "dropdown",
		"value" => array(
			"基于文章宽度" => "post_width_based",
			"基于浏览器宽度" => "browser_width_based",
		),
		"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		"group" => __( "Responsiveness", 'dt-the7-core' ),
	),
	array(
		"heading" => __("Columns on Desktop", 'dt-the7-core'),
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
		"group" => __( "Responsiveness", 'dt-the7-core' ),
	),
	array(
		"heading" => __("Columns on Horizontal Tablet", 'dt-the7-core'),
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
		"group" => __( "Responsiveness", 'dt-the7-core' ),
	),
	array(
		"heading" => __("Columns on Vertical Tablet", 'dt-the7-core'),
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
		"group" => __( "Responsiveness", 'dt-the7-core' ),
	),
	array(
		"heading" => __("Columns on Mobile Phone", 'dt-the7-core'),
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
		"group" => __( "Responsiveness", 'dt-the7-core' ),
	),
	array(
		"heading" => __( "Column minimum width (px)", 'dt-the7-core' ),
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
		"group" => __( "Responsiveness", 'dt-the7-core' ),
	),
	array(
		"heading" => __( "Desired columns number", 'dt-the7-core' ),
		"param_name" => "columns",
		"type" => "textfield",
		"value" => "2",
		"edit_field_class" => "vc_col-sm-6 vc_column",
		"dependency" => array(
			"element" => "responsiveness",
			"value" => array(
				"post_width_based",
			),
		),
		"group" => __( "Responsiveness", 'dt-the7-core' ),
	),
);

$thumbnails_width = array(
	array(
		"heading" => __( "Thumbnails width", 'dt-the7-core' ),
		"description" => __( "In pixels. Leave this field empty if you want to preserve original thumbnails proportions.", 'dt-the7-core' ),
		"param_name" => "width",
		"type" => "textfield",
		"value" => "",
		"edit_field_class" => "vc_col-sm-6 vc_column",
		"group" => __( "Appearance", 'dt-the7-core' ),
	),
);

$thumbnails_height = array(
	array(
		"heading" => __( "Thumbnails height", 'dt-the7-core' ),
		"description" => __( "In pixels.", 'dt-the7-core' ),
		"param_name" => "height",
		"type" => "textfield",
		"value" => "210",
		"edit_field_class" => "vc_col-sm-6 vc_column",
		"group" => __( "Appearance", 'dt-the7-core' ),
	),
);

$thumbnails_max_width = array(
	array(
		"heading" => __( "Thumbnails max width", 'dt-the7-core' ),
		"description" => __("In percents.", 'dt-the7-core'),
		"param_name" => "max_width",
		"type" => "textfield",
		"value" => "",
		"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		"group" => __( "Appearance", 'dt-the7-core' ),
	),
);

// ! Albums masonry
vc_map( array(
	"weight" => -1,
	"base" => 'dt_albums',
	"name" => __( "Albums Masonry & Grid", 'dt-the7-core' ),
	"category" => __( 'by Dream-Theme', 'dt-the7-core' ),
	"icon" => "dt_vc_ico_albums",
	"class" => "dt_vc_sc_albums",
	"params" => array_merge(
		$category,
		$album_number_order_title,
		$albums_per_page,
		$albums_to_show,
		$ordering,
		$album_filter_title,
		$show_filter,
		$show_filter_ordering,

		$appearance,
		$loading_effect,
		array(
			array(
				"heading" => __( "Albums width", 'dt-the7-core' ),
				"param_name" => "same_width",
				"type" => "dropdown",
				"value" => array(
					"保留原始宽度" => "false",
					"使专辑相同宽度" => "true",
				),
				"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
				"group" => __( "Appearance", 'dt-the7-core' ),
			)
		),
		$padding_masonry,
		$proportion,
		$album_design_title,
		$descriptions_masonry,
		$album_elements_title,
		$show_albums_content,
		$show_miniatures,

		$show_meta,
		$show_media_count,

		$responsiveness
	)
) );

// ! Photos masonry
vc_map( array(
	"weight" => -1,
	"base" => 'dt_photos_masonry',
	"name" => __( "Photos Masonry & Grid", 'dt-the7-core' ),
	"category" => __( 'by Dream-Theme', 'dt-the7-core' ),
	"icon" => "dt_vc_ico_photos",
	"class" => "dt_vc_sc_photos",
	"params" => array_merge(
		$category,
		$photo_number_order_title,
		$photos_to_show,
		$ordering,

		$appearance,
		$loading_effect,
		$padding_masonry,
		$proportion,
		$show_photos_content,

		$responsiveness
	)
) );

// ! Albums justified grid
vc_map( array(
	"weight" => -1,
	"base" => "dt_albums_jgrid",
	"name" => __( "Albums Justified Grid", 'dt-the7-core' ),
	"category" => __( 'by Dream-Theme', 'dt-the7-core' ),
	"icon" => "dt_vc_ico_albums",
	"class" => "dt_vc_sc_albums",
	"params" => array_merge(
		$category,
		$album_number_order_title,
		$albums_to_show,
		$albums_per_page,
		$ordering,
		$album_filter_title,
		$show_filter,

		$loading_effect,
		$target_height,
		$hide_last_row,
		$padding,
		$proportion,
		$album_design_title,
		$descriptions_jgrid,
		$album_elements_title,
		$show_albums_content,
		$show_miniatures,

		$show_meta,
		$show_media_count
	)
) );

// ! Photos jgrid
vc_map( array(
	"weight" => -1,
	"base" => 'dt_photos_jgrid',
	"name" => __( "Photos Justified Grid", 'dt-the7-core' ),
	"category" => __( 'by Dream-Theme', 'dt-the7-core' ),
	"icon" => "dt_vc_ico_photos",
	"class" => "dt_vc_sc_photos",
	"params" => array_merge(
		$category,
		$photo_number_order_title,
		$photos_to_show,
		$ordering,

		$loading_effect,
		$target_height,
		$hide_last_row,
		$padding,
		$proportion,
		$photo_elements_title,
		$show_photos_content
	)
) );

// ! Albums scroller
vc_map( array(
	"weight" => -1,
	"base" => 'dt_albums_scroller',
	"name" => __( "Albums Scroller", 'dt-the7-core' ),
	"category" => __( 'by Dream-Theme', 'dt-the7-core' ),
	"icon" => "dt_vc_ico_albums",
	"class" => "dt_vc_sc_albums",
	"params" => array_merge(
		// General group.
		$category,
		$album_number_order_title,
		$scroller_albums_to_show,
		$ordering,

		// Appearance group.
		$scroller_padding,
		$thumbnails_width,
		$thumbnails_height,
		$thumbnails_max_width,
		$album_design_title,
		$descriptions_masonry,
		$album_elements_title,
		$show_albums_content,
		$show_miniatures,

		// Elements group.
		$show_meta,
		$show_media_count,

		// Slideshow group.
		$scroller_arrows,
		$scroller_slidehow_controls
	)
) );

// ! Photos scroller
vc_map( array(
	"weight" => -1,
	"base" => 'dt_small_photos',
	"name" => __( "Photos Scroller", 'dt-the7-core' ),
	"category" => __( 'by Dream-Theme', 'dt-the7-core' ),
	"icon" => "dt_vc_ico_photos",
	"class" => "dt_vc_sc_photos",
	"params" => array_merge(
		// General group.
		$category,
		$photo_number_order_title,
		$photos_to_show,
		array(
			array(
				"heading" => __( "Show", 'dt-the7-core' ),
				"param_name" => "orderby",
				"type" => "dropdown",
				"value" => array(
					"最新照片" => "recent",
					"随机照片" => "random",
				),
				"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
			),
		),

		// Appearance group.
		$scroller_padding,
		$thumbnails_width,
		$thumbnails_height,
		$thumbnails_max_width,
		$album_elements_title,
		$show_photos_content,

		// Slideshow group.
		$scroller_arrows,
		$scroller_slidehow_controls
	)
) );
