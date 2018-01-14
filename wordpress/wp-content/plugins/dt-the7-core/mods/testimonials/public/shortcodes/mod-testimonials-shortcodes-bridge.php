<?php
/**
 * Testimonials shortcodes VC bridge
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// ! Testimonials
vc_map( array(
	"weight" => -1,
	"name" => __("Testimonials (old)", 'dt-the7-core'),
	"base" => 'dt_testimonials',
	"icon" => "dt_vc_ico_testimonials",
	"class" => "dt_vc_sc_testimonials",
	"deprecated" => '5.6',
	"category" => __('by Dream-Theme', 'dt-the7-core'),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_testimonials_category",
			"class" => "",
			"heading" => __("Categories", 'dt-the7-core'),
			"param_name" => "category",
			"admin_label" => true,
			"description" => __("Note: By default, all your testimonials will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'dt-the7-core')
		),

		// Appearance
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Appearance", 'dt-the7-core'),
			"admin_label" => true,
			"param_name" => "type",
			"value" => array(
				"切片" => "masonry",
				"幻灯片" => "slider"
			),
			"description" => ""
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between testimonials (px)", 'dt-the7-core'),
			"description" => __("Testimonial paddings (e.g. 5 pixel padding will give you 10 pixel gaps between testimonials)", 'dt-the7-core'),
			"param_name" => "padding",
			"value" => "20",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Column width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", 'dt-the7-core'),
			"param_name" => "column_width",
			"value" => "370",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Desired columns number
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", 'dt-the7-core'),
			"param_name" => "columns",
			"value" => "2",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Loading effect
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Loading effect", 'dt-the7-core'),
			"param_name" => "loading_effect",
			"value" => array(
				'无' => 'none',
				'淡入' => 'fade_in',
				'上移' => 'move_up',
				'放大' => 'scale_up',
				'下落透明' => 'fall_perspective',
				'飞入' => 'fly',
				'翻转' => 'flip',
				'螺旋' => 'helix',
				'缩放' => 'scale'
			),
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Autoslide
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Autoslide", 'dt-the7-core'),
			"param_name" => "autoslide",
			"value" => "",
			"description" => __('In milliseconds (e.g. 3 seconds = 3000 miliseconds). Leave this field empty to disable autoslide. This field works only when "Appearance: Slider" selected.', 'dt-the7-core'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"slider"
				)
			)
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of testimonials to show", 'dt-the7-core'),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Order by
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

		// Order
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
		)
	)
) );


/**
 * DT Testimonial Carousel.
 */

vc_map( array(

	"weight" => -1,
	"name" => __("Testimonials Carousel", 'the7mk2'),
	"base" => "dt_testimonials_carousel",
	"icon" => "dt_vc_ico_testimonials_carousel",
	"class" => "dt_testimonials_carousel",
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
				'分类文章' => 'category',
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
			'heading' => __('Layout', 'the7mk2'),
			'param_name' => 'content_layout',
			'type' => 'dt_radio_image',
			'value' => 'layout_4',
			'options' => array(
				'layout_1'       => array(
					'title' => _x( 'Layout 1', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l01.gif',
				),
				'layout_2'        => array(
					'title' => _x( 'Layout 2', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l02.gif',
				),
				'layout_3'         => array(
					'title' => _x( 'Layout 3', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l03.gif',
				),
				'layout_4'          => array(
					'title' => _x( 'Layout 4', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l04.gif',
				),
				'layout_5'     => array(
					'title' => _x( 'Layout 5', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l05.gif',
				),
				'layout_6'       => array(
					'title' => _x( 'Layout 6', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l06.gif',
				),
			),
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

			'value' => '30px 30px 20px 30px',
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
			'heading' => __('Show image', 'the7mk2'),
			'param_name' => 'show_avatar',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		array(
			'heading' => __('Image sizing', 'the7mk2'),
			'param_name' => 'image_sizing',
			'type' => 'dropdown',
			'std' => 'resize',
			'value' => array(
				'保持图像比例' => 'proportional',
				'重新调整图片' => 'resize',
			),
			'dependency'	=> array(
				'element'	=> 'show_avatar',
				'value'		=> 'y',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'headings' => array( __('Width', 'the7mk2'), __('Height', 'the7mk2') ),
			'param_name' => 'resized_image_dimensions',
			'type' => 'dt_dimensions',
			'value' => '1x1',
			'dependency' => array(
				'element' => 'image_sizing',
				'value' => 'resize',
			),

			'description' => __('Set image proportions, for example: 4x3, 3x2.', 'the7mk2'),
		),
		array(
			'heading' => __('Maximum width', 'the7mk2'),
			'param_name' => 'img_max_width',
			'type' => 'dt_number',
			'value' => '80',
			'units' => 'px',

			'dependency'	=> array(
				'element'	=> 'show_avatar',
				'value'		=> 'y',
			),
			'description' => __('Leave empty to use default width.', 'the7mk2'),
		),
		array(
			'heading' => __('Image paddings', 'the7mk2'),
			'param_name' => 'image_paddings',
			'type' => 'dt_spacing',
			'value' => '0px 20px 20px 0px',
			'units' => 'px, %',

			'dependency'	=> array(
				'element'	=> 'show_avatar',
				'value'		=> 'y',
			),
		),
		array(
			'heading' => __('Image border radius', 'the7mk2'),
			'param_name' => 'img_border_radius',
			'type' => 'dt_number',
			'value' => '500',
			'units' => 'px',

			'dependency'	=> array(
				'element'	=> 'show_avatar',
				'value'		=> 'y',
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
			"value" => "2",
			"edit_field_class" => "vc_media-xs vc_col-xs-2 vc_column",
	  	),
	  	array(
			"heading" => __("Vert. tablet", 'the7mk2'),
			"param_name" => "slides_on_v_tabs",
			"type" => "textfield",
			"value" => "1",
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
			'value' => 'n',
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
				"一次一个幻灯片" => "single",
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

	  	
		// - Testimonial Author Name.
		
		array(
			'heading' => __( 'Testimonial Author Name', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Show author name', 'the7mk2'),
			'param_name' => 'testimonial_name',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'post_title_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_name',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'post_title_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H4 font size.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_name',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'post_title_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H4 line height.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_name',
				'value' => 'y',
			),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_title_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use headers color.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_name',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Gap below name', 'the7mk2'),
			'param_name' => 'post_title_bottom_margin',
			'type' => 'dt_number',
			'value' => '0',
			'units' => 'px',
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_name',
				'value' => 'y',
			),
		),
		// - Meta Information.
		array(
			'heading' => __( 'Testimonial Author Position', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Show position', 'the7mk2'),
			'param_name' => 'testimonial_position',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'testimonial_position_font_style',
			'type' => 'dt_font_style',
			'value' => 'normal:bold:none',
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_position',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'testimonial_position_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use medium font size.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_position',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'testimonial_position_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use medium line height.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_position',
				'value' => 'y',
			),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'testimonial_position_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use accent text color.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_position',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Gap below position', 'the7mk2'),
			'param_name' => 'testimonial_position_bottom_margin',
			'type' => 'dt_number',
			'value' => '20px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_position',
				'value' => 'y',
			),
		),
		// - Text.
		array(
			'heading' => __( 'Testimonial', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Testimonial content or excerpt', 'the7mk2'),
			'param_name' => 'post_content',
			'type' => 'dropdown',
			'std' => 'show_excerpt',
			'value' => array(
				'摘要' => 'show_excerpt',
				'内容' => 'show_content',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Maximum number of words', 'the7mk2'),
			'param_name' => 'excerpt_words_limit',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'description' => __( 'Leave empty to show full text.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'post_content',
				'value' => 'show_excerpt',
			),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'content_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'content_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use medium font size.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'content_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use medium line height.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_content_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use primary text color.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below testimonial', 'the7mk2'),
			'param_name' => 'content_bottom_margin',
			'type' => 'dt_number',
			'value' => '0',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Testimonial', 'the7mk2' ),
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
				"离开为止" => "no-changes",
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
			'value' => '-18px',
			'units' => 'px',
			"dependency" => Array("element" => "arrow_responsiveness", "value" => array("reposition-arrows")),
		),
		array(
			"group" => __("Arrows Responsiveness", 'the7mk2'),
			'heading' => __('Right arrow horizontal offset', 'the7mk2'),
			'param_name' => 'r_arrows_mobile_h_position',
			'type' => 'dt_number',
			'value' => '-18px',
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
				"小火车" => "small-dot-stroke",
				"放大" => "scale-up",
				"行程" => "stroke",
				"填满" => "fill-in",
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
			'param_name' => 'css_dt_testimonials_carousel',
			'group' => __( 'Design Options', 'the7mk2' )
		),
	),


) );

/**
 * DT Testimonial Masonry.
 */

vc_map( array(

	"weight" => -1,
	"name" => __("Testimonials Masonry & Grid", 'the7mk2'),
	"base" => "dt_testimonials_masonry",
	"icon" => "dt_vc_ico_testimonials_masonry",
	"class" => "dt_testimonials_masonry",
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
				'分类文章' => 'category',
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
			"heading" => __("Mode", 'dt-the7-core'),
			"param_name" => "type",
			"type" => "dropdown",
			"value" => array(
				"网格" => "grid",
				"切片" => "masonry",
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"heading" => __("Loading effect", 'the7mk2'),
			"param_name" => "loading_effect",
			"type" => "dropdown",
			"value" => array(
				'无' => 'none',
				'淡入' => 'fade_in',
				'上移' => 'move_up',
				'放大' => 'scale_up',
				'下落透视' => 'fall_perspective',
				'飞' => 'fly',
				'翻转' => 'flip',
				'螺旋' => 'helix',
				'比例' => 'scale'
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			'heading' => __('Layout', 'the7mk2'),
			'param_name' => 'content_layout',
			'type' => 'dt_radio_image',
			'value' => 'layout_4',
			'options' => array(
				'layout_1'       => array(
					'title' => _x( 'Layout 1', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l01.gif',
				),
				'layout_2'        => array(
					'title' => _x( 'Layout 2', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l02.gif',
				),
				'layout_3'         => array(
					'title' => _x( 'Layout 3', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l03.gif',
				),
				'layout_4'          => array(
					'title' => _x( 'Layout 4', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l04.gif',
				),
				'layout_5'     => array(
					'title' => _x( 'Layout 5', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l05.gif',
				),
				'layout_6'       => array(
					'title' => _x( 'Layout 6', 'the7mk2' ),
					'src' => '/inc/shortcodes/images/l06.gif',
				),
			),
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

			'value' => '30px 30px 20px 30px',
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
			'heading' => __('Show image', 'the7mk2'),
			'param_name' => 'show_avatar',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
		),
		array(
			'heading' => __('Image sizing', 'the7mk2'),
			'param_name' => 'image_sizing',
			'type' => 'dropdown',
			'std' => 'resize',
			'value' => array(
				'保持图片比例' => 'proportional',
				'重新调整图片' => 'resize',
			),
			'dependency'	=> array(
				'element'	=> 'show_avatar',
				'value'		=> 'y',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'headings' => array( __('Width', 'the7mk2'), __('Height', 'the7mk2') ),
			'param_name' => 'resized_image_dimensions',
			'type' => 'dt_dimensions',
			'value' => '1x1',
			'dependency' => array(
				'element' => 'image_sizing',
				'value' => 'resize',
			),

			'description' => __('Set image proportions, for example: 4x3, 3x2.', 'the7mk2'),
		),
		array(
			'heading' => __('Maximum width', 'the7mk2'),
			'param_name' => 'img_max_width',
			'type' => 'dt_number',
			'value' => '80',
			'units' => 'px',

			'dependency'	=> array(
				'element'	=> 'show_avatar',
				'value'		=> 'y',
			),
			'description' => __('Leave empty to use default width.', 'the7mk2'),
		),
		array(
			'heading' => __('Image paddings', 'the7mk2'),
			'param_name' => 'image_paddings',
			'type' => 'dt_spacing',
			'value' => '0px 20px 20px 0px',
			'units' => 'px, %',

			'dependency'	=> array(
				'element'	=> 'show_avatar',
				'value'		=> 'y',
			),
		),
		array(
			'heading' => __('Image border radius', 'the7mk2'),
			'param_name' => 'img_border_radius',
			'type' => 'dt_number',
			'value' => '60',
			'units' => 'px',

			'dependency'	=> array(
				'element'	=> 'show_avatar',
				'value'		=> 'y',
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
			'value' => 'desktop:3|h_tablet:3|v_tablet:2|phone:1',
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
			"heading" => __("Gap between columns ", 'the7mk2'),
			"param_name" => "gap_between_posts",
			"type" => "dt_number",
			"value" => "15",
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
			"description" => __("Please note that this setting affects post paddings. So, for example: a value 10px will give you 20px gaps between posts)", "the7mk2"),
		),
		array(
			'heading' => __( 'Pagination colors', 'the7mk2' ),
			'param_name' => 'dt_title',
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

		// - Testimonial Author Name.
		
		array(
			'heading' => __( 'Testimonial Author Name', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Show author name', 'the7mk2'),
			'param_name' => 'testimonial_name',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'post_title_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_name',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'post_title_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H4 font size.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_name',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'post_title_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use H4 line height.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_name',
				'value' => 'y',
			),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_title_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use headers color.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_name',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Gap below name', 'the7mk2'),
			'param_name' => 'post_title_bottom_margin',
			'type' => 'dt_number',
			'value' => '0',
			'units' => 'px',
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_name',
				'value' => 'y',
			),
		),
		// - Meta Information.
		array(
			'heading' => __( 'Testimonial Author Position', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Show position', 'the7mk2'),
			'param_name' => 'testimonial_position',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'是' => 'y',
				'否' => 'n',
			),
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'testimonial_position_font_style',
			'type' => 'dt_font_style',
			'value' => 'normal:bold:none',
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_position',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'testimonial_position_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use medium font size.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_position',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'testimonial_position_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use medium line height.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_position',
				'value' => 'y',
			),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'testimonial_position_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use accent text color.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_position',
				'value' => 'y',
			),
		),
		array(
			'heading' => __('Gap below position', 'the7mk2'),
			'param_name' => 'testimonial_position_bottom_margin',
			'type' => 'dt_number',
			'value' => '20px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'testimonial_position',
				'value' => 'y',
			),
		),

		
		// - Text.
		array(
			'heading' => __( 'Testimonial', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Testimonial content or excerpt', 'the7mk2'),
			'param_name' => 'post_content',
			'type' => 'dropdown',
			'std' => 'show_excerpt',
			'value' => array(
				'摘要' => 'show_excerpt',
				'内容' => 'show_content',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Maximum number of words', 'the7mk2'),
			'param_name' => 'excerpt_words_limit',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'description' => __( 'Leave empty to show full text.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
			'dependency' => array(
				'element' => 'post_content',
				'value' => 'show_excerpt',
			),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'content_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'content_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use medium font size.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'content_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Leave empty to use medium line height.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_content_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Leave empty to use primary text color.', 'the7mk2' ),
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below testimonial', 'the7mk2'),
			'param_name' => 'content_bottom_margin',
			'type' => 'dt_number',
			'value' => '0',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Testimonial', 'the7mk2' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'the7mk2' ),
			'param_name' => 'css_dt_testimonials_masonry',
			'group' => __( 'Design Options', 'the7mk2' )
		),
	),


) );