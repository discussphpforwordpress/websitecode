<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*** WPBakery Page Builder Content elements refresh ***/
class VcSharedLibrary {
	// Here we will store plugin wise (shared) settings. Colors, Locations, Sizes, etc...
	/**
	 * @var array
	 */
	private static $colors = array(
		'蓝色' => 'blue',
		'绿宝石' => 'turquoise',
		'粉红色' => 'pink',
		'紫罗兰' => 'violet',
		'Peacoc' => 'peacoc',
		'奇诺' => 'chino',
		'热葡萄酒' => 'mulled_wine',
		'Vista蓝' => 'vista_blue',
		'黑色' => 'black',
		'灰色' => 'grey',
		'橙色' => 'orange',
		'天蓝' => 'sky',
		'绿色' => 'green',
		'多汁粉色' => 'juicy_pink',
		'沙褐色' => 'sandy_brown',
		'紫色' => 'purple',
		'白色' => 'white',
	);

	/**
	 * @var array
	 */
	public static $icons = array(
		'玻璃' => 'glass',
		'音乐' => 'music',
		'搜索' => 'search',
	);

	/**
	 * @var array
	 */
	public static $sizes = array(
		'迷你' => 'xs',
		'小' => 'sm',
		'正常' => 'md',
		'大' => 'lg',
	);

	/**
	 * @var array
	 */
	public static $button_styles = array(
		'圆角' => 'rounded',
		'方形' => 'square',
		'圆形' => 'round',
		'轮廓' => 'outlined',
		'3D' => '3d',
		'方轮廓' => 'square_outlined',
	);

	/**
	 * @var array
	 */
	public static $message_box_styles = array(
		'标准' => 'standard',
		'实心' => 'solid',
		'实心图标' => 'solid-icon',
		'轮廓' => 'outline',
		'3D' => '3d',
	);

	/**
	 * Toggle styles
	 * @var array
	 */
	public static $toggle_styles = array(
		'默认' => 'default',
		'简单' => 'simple',
		'圆' => 'round',
		'圆轮廓' => 'round_outline',
		'圆角' => 'rounded',
		'圆角轮廓' => 'rounded_outline',
		'方' => 'square',
		'方形轮廓' => 'square_outline',
		'箭头' => 'arrow',
		'仅文字' => 'text_only',
	);

	/**
	 * Animation styles
	 * @var array
	 */
	public static $animation_styles = array(
		'乱跳' => 'easeOutBounce',
		'伸缩' => 'easeOutElastic',
		'返回' => 'easeOutBack',
		'立方' => 'easeinOutCubic',
		'昆特' => 'easeinOutQuint',
		'夸脱' => 'easeOutQuart',
		'四元' => 'easeinQuad',
		'正弦' => 'easeOutSine',
	);

	/**
	 * @var array
	 */
	public static $cta_styles = array(
		'圆角' => 'rounded',
		'正方形' => 'square',
		'圆' => 'round',
		'轮廓' => 'outlined',
		'方轮廓' => 'square_outlined',
	);

	/**
	 * @var array
	 */
	public static $txt_align = array(
		'左' => 'left',
		'右' => 'right',
		'中' => 'center',
		'两端对齐' => 'justify',
	);

	/**
	 * @var array
	 */
	public static $el_widths = array(
		'100%' => '',
		'90%' => '90',
		'80%' => '80',
		'70%' => '70',
		'60%' => '60',
		'50%' => '50',
		'40%' => '40',
		'30%' => '30',
		'20%' => '20',
		'10%' => '10',
	);

	/**
	 * @var array
	 */
	public static $sep_widths = array(
		'1px' => '',
		'2px' => '2',
		'3px' => '3',
		'4px' => '4',
		'5px' => '5',
		'6px' => '6',
		'7px' => '7',
		'8px' => '8',
		'9px' => '9',
		'10px' => '10',
	);

	/**
	 * @var array
	 */
	public static $sep_styles = array(
		'边框' => '',
		'虚线' => 'dashed',
		'点线' => 'dotted',
		'双线' => 'double',
		'阴影' => 'shadow',
	);

	/**
	 * @var array
	 */
	public static $box_styles = array(
		'默认' => '',
		'圆角' => 'vc_box_rounded',
		'边框' => 'vc_box_border',
		'轮廓' => 'vc_box_outline',
		'阴影' => 'vc_box_shadow',
		'边框阴影' => 'vc_box_shadow_border',
		'3D阴影' => 'vc_box_shadow_3d',
	);

	/**
	 * Round box styles
	 *
	 * @var array
	 */
	public static $round_box_styles = array(
		'圆' => 'vc_box_circle',
		'圆边框' => 'vc_box_border_circle',
		'圆轮廓' => 'vc_box_outline_circle',
		'圆阴影' => 'vc_box_shadow_circle',
		'圆边框阴影' => 'vc_box_shadow_border_circle',
	);

	/**
	 * Circle box styles
	 *
	 * @var array
	 */
	public static $circle_box_styles = array(
		'圈' => 'vc_box_circle_2',
		'圈边框' => 'vc_box_border_circle_2',
		'圈轮廓' => 'vc_box_outline_circle_2',
		'圈阴影' => 'vc_box_shadow_circle_2',
		'圈边框阴影' => 'vc_box_shadow_border_circle_2',
	);

	/**
	 * @return array
	 */
	public static function getColors() {
		return self::$colors;
	}

	/**
	 * @return array
	 */
	public static function getIcons() {
		return self::$icons;
	}

	/**
	 * @return array
	 */
	public static function getSizes() {
		return self::$sizes;
	}

	/**
	 * @return array
	 */
	public static function getButtonStyles() {
		return self::$button_styles;
	}

	/**
	 * @return array
	 */
	public static function getMessageBoxStyles() {
		return self::$message_box_styles;
	}

	/**
	 * @return array
	 */
	public static function getToggleStyles() {
		return self::$toggle_styles;
	}

	/**
	 * @return array
	 */
	public static function getAnimationStyles() {
		return self::$animation_styles;
	}

	/**
	 * @return array
	 */
	public static function getCtaStyles() {
		return self::$cta_styles;
	}

	/**
	 * @return array
	 */
	public static function getTextAlign() {
		return self::$txt_align;
	}

	/**
	 * @return array
	 */
	public static function getBorderWidths() {
		return self::$sep_widths;
	}

	/**
	 * @return array
	 */
	public static function getElementWidths() {
		return self::$el_widths;
	}

	/**
	 * @return array
	 */
	public static function getSeparatorStyles() {
		return self::$sep_styles;
	}

	/**
	 * Get list of box styles
	 *
	 * Possible $groups values:
	 * - default
	 * - round
	 * - circle
	 *
	 * @param array $groups Array of groups to include. If not specified, return all
	 *
	 * @return array
	 */
	public static function getBoxStyles( $groups = array() ) {
		$list = array();
		$groups = (array) $groups;

		if ( ! $groups || in_array( 'default', $groups ) ) {
			$list += self::$box_styles;
		}

		if ( ! $groups || in_array( 'round', $groups ) ) {
			$list += self::$round_box_styles;
		}

		if ( ! $groups || in_array( 'cirlce', $groups ) ) {
			$list += self::$circle_box_styles;
		}

		return $list;
	}

	public static function getColorsDashed() {
		$colors = array(
			__( 'Blue', 'js_composer' ) => 'blue',
			__( 'Turquoise', 'js_composer' ) => 'turquoise',
			__( 'Pink', 'js_composer' ) => 'pink',
			__( 'Violet', 'js_composer' ) => 'violet',
			__( 'Peacoc', 'js_composer' ) => 'peacoc',
			__( 'Chino', 'js_composer' ) => 'chino',
			__( 'Mulled Wine', 'js_composer' ) => 'mulled-wine',
			__( 'Vista Blue', 'js_composer' ) => 'vista-blue',
			__( 'Black', 'js_composer' ) => 'black',
			__( 'Grey', 'js_composer' ) => 'grey',
			__( 'Orange', 'js_composer' ) => 'orange',
			__( 'Sky', 'js_composer' ) => 'sky',
			__( 'Green', 'js_composer' ) => 'green',
			__( 'Juicy pink', 'js_composer' ) => 'juicy-pink',
			__( 'Sandy brown', 'js_composer' ) => 'sandy-brown',
			__( 'Purple', 'js_composer' ) => 'purple',
			__( 'White', 'js_composer' ) => 'white',
		);

		return $colors;
	}
}

/**
 * @param string $asset
 *
 * @return array|string
 */
function getVcShared( $asset = '' ) {
	switch ( $asset ) {
		case 'colors':
			return VcSharedLibrary::getColors();
			break;

		case 'colors-dashed':
			return VcSharedLibrary::getColorsDashed();
			break;

		case 'icons':
			return VcSharedLibrary::getIcons();
			break;

		case 'sizes':
			return VcSharedLibrary::getSizes();
			break;

		case 'button styles':
		case 'alert styles':
			return VcSharedLibrary::getButtonStyles();
			break;
		case 'message_box_styles':
			return VcSharedLibrary::getMessageBoxStyles();
			break;
		case 'cta styles':
			return VcSharedLibrary::getCtaStyles();
			break;

		case 'text align':
			return VcSharedLibrary::getTextAlign();
			break;

		case 'cta widths':
		case 'separator widths':
			return VcSharedLibrary::getElementWidths();
			break;

		case 'separator styles':
			return VcSharedLibrary::getSeparatorStyles();
			break;

		case 'separator border widths':
			return VcSharedLibrary::getBorderWidths();
			break;

		case 'single image styles':
			return VcSharedLibrary::getBoxStyles();
			break;

		case 'single image external styles':
			return VcSharedLibrary::getBoxStyles( array( 'default', 'round' ) );
			break;

		case 'toggle styles':
			return VcSharedLibrary::getToggleStyles();
			break;

		case 'animation styles':
			return VcSharedLibrary::getAnimationStyles();
			break;

		default:
			# code...
			break;
	}

	return '';
}
