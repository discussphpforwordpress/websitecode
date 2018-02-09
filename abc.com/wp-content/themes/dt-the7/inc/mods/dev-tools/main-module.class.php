<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'The7_DevToolMainModule', false ) ) :

	class The7_DevToolMainModule {

		protected $plugin_name;

		protected $version;

		protected $plugin_dir;

		const DEV_TOOL_OPTION = 'the7_dev_tool_option';

		private $options = array();

		public function __construct() {
			$this->plugin_name = 'the7-dev-tools';
			$this->version = '1.0.0';
			$this->plugin_dir = trailingslashit( dirname( __FILE__ ) );
			$this->options = get_option( self::DEV_TOOL_OPTION, array() );
		}

		public function execute() {
			if ( ! is_admin() ) {
				return;
			}
			if ( empty( $this->options ) ) {
				$this->resetTheme();
			}
			register_setting( self::DEV_TOOL_OPTION, self::DEV_TOOL_OPTION, array( $this, 'validate_options' ) );
		}

		public static function init() {
			add_action( 'after_setup_theme', array( __CLASS__, 'dev_tools_after_setup_theme' ), 9999 );
			add_action( 'admin_menu', array( __CLASS__, 'dev_tools_menu_filter' ), 9999 );
			add_action( 'admin_bar_menu', array( __CLASS__, 'dev_tools_admin_bar_filter' ), 1 );
			add_filter( 'upgrader_post_install', array( __CLASS__, 'restore_dev_tool_files' ), 11, 3 );
			add_action( 'optionsframework_get_options_id', array(
				__CLASS__,
				'dev_tools_optionsframework_get_options_id',
			) );
			add_action( 'the7_subpages_filter', array( __CLASS__, 'dev_tools_the7_subpages_filter' ) );
		}

		static function dev_tools_after_setup_theme() {
			$theme_version = wp_get_theme( get_template())->Version;
			if ( $theme_version === "6.0.0" ) {
				$devTools = new The7_DevToolMainModule();
				$devTools->updateThemeFiles( PRESSCORE_STYLESHEETS_VERSION );
			}
		}

		static function dev_tools_optionsframework_get_options_id( $name ) {
			if ( self::getToolOption( 'use_the7_options' ) ) {
				return "the7";
			}

			return $name;
		}

		static function dev_tools_the7_subpages_filter( $page ) {
			if ( self::getToolOption( 'hide_the7_menu' ) && ( $page['dashboard_slug'] === 'the7-dashboard' ) && ( $page['slug'] === 'the7-plugins' ) ) {
				$page['dashboard_slug'] = 'plugins.php';
				$theme_name = self::getToolOption( 'theme_name' );
				$page['title'] = $theme_name . ' ' . $page['title'];
			}

			return $page;
		}

		public static function dev_tools_admin_bar_filter() {
			if ( self::getToolOption( 'hide_theme_options' ) ) {
				remove_action( 'admin_bar_menu', 'optionsframework_admin_bar_theme_options', 40 );
			}
		}

		public static function dev_tools_menu_filter() {
			global $menu, $submenu;

			if ( self::getToolOption( 'hide_the7_menu' ) ) {
				remove_menu_page( 'the7-dashboard' );
			}
			if ( self::getToolOption( 'hide_theme_options' ) ) {
				remove_menu_page( 'of-options-wizard' );
			}

			$is_replace = The7_DevToolMainModule::getToolOption( 'replace_theme_branding' );
			if ( $is_replace ) {
				$replace_text = "";
				foreach ( $menu AS $k => &$v ) {
					$result = array_search( 'the7-dashboard', $v );
					if ( ! $result ) {
						$v[0] = str_replace( "The7", $replace_text, $v[0] );
					}
				}
			}
		}

		public function initDefaultThemeStyle() {
			$default = include $this->plugin_dir . "templates/style-default.css.php";
			$this->options = array_merge( $this->options, $default );
		}

		public function validate_options( $input ) {
			$validateCheckboxed = array(
				"replace_theme_descr",
				"hide_the7_menu",
				"hide_theme_options",
				"replace_theme_branding",
				"use_the7_options",
			);

			$this->options = array_merge( $this->options, $input );
			foreach ( $this->options as $field => $value ) {
				switch ( $field ) {
					case 'theme_name':
						$this->options[ $field ] = sanitize_text_field( $value );
						//$this->options[ $field ] = preg_replace( '/\s+/', '', $this->options[ $field ] );
						break;
					case 'theme_url':
						$this->options[ $field ] = esc_url( $value );
						break;
					case 'theme_author_uri':
						$this->options[ $field ] = esc_url( $value );
						break;
					default:
						$this->options[ $field ] = sanitize_text_field( $value );
				}
			}
			foreach ( $validateCheckboxed as $value ) {
				$this->options[ $value ] = self::arr_get( $input, $value, false );
				$this->options[ $value ] = $this->sanitize_checkbox( $this->options[ $value ] );
			}

			$this->updateThemeFiles();

			if ( is_multisite() ) {
				update_site_option( self::DEV_TOOL_OPTION . '-network', $this->options );
			}

			return $this->options;
		}

		private function sanitize_checkbox( $input ) {
			if ( $input ) {
				$output = '1';
			} else {
				$output = false;
			}

			return $output;
		}

		public function setDevToolsOptions() {
			return update_option( self::DEV_TOOL_OPTION, $this->options );
		}

		public function isReplaceThemeDescription() {
			return self::arr_get( $this->options, 'replace_theme_descr', false );
		}

		public function resetTheme() {
			$this->initDefaultThemeStyle();
			$this->options['theme_name'] = $this->options['theme_title'];
			$this->options['screenshot'] = '';
			$this->setDevToolsOptions();
		}

		private function get_optionsframework_theme_name( $name ) {
			return preg_replace( "/\W/", "", strtolower( $name ) );
		}

		public function updateThemeFiles( $theme_version = '' ) {
			if ( empty( $this->options ) ) {
				return;
			}
			$current_theme = wp_get_theme();

			$this->options['modified_folder_name'] = $current_theme->Template;
			//fill variables
			$theme_title = self::arr_get( $this->options, 'theme_name', '' );
			$theme_uri = self::arr_get( $this->options, 'theme_url', '' );
			$theme_author = self::arr_get( $this->options, 'theme_author', '' );
			$theme_author_uri = self::arr_get( $this->options, 'theme_author_uri', '' );
			$theme_description = self::arr_get( $this->options, 'theme_description', '' );
			$theme_tags = self::arr_get( $this->options, 'theme_tags', '' );
			if ( empty( $theme_version ) ) {
				$theme_version = wp_get_theme( $current_theme->Template )->Version;
			}

			//write style css
			ob_start();
			$styleTemplateFile = $this->plugin_dir . 'templates/style-css.php';
			if ( ! file_exists( $styleTemplateFile ) ) {
				return;
			}
			require $this->plugin_dir . 'templates/style-css.php';
			$css = ob_get_clean();
			file_put_contents( PRESSCORE_THEME_DIR . '/style.css', $css );

			//copy screenshot image
			$screenshot = self::arr_get( $this->options, 'screenshot', '' );
			if ( empty( $screenshot ) ) {
				$screenshot_path = $this->plugin_dir . "templates/screenshot.jpg";
			} else {
				$screenshot_path = $this->options['screenshot'];
			}
			if ( $screenshot_local_filename = $this->searchScreenshot( PRESSCORE_THEME_DIR ) ) {
				$screenshot_local_path = PRESSCORE_THEME_DIR . '/' . $screenshot_local_filename;
				if ( ! unlink( $screenshot_local_path ) ) {
					// most likely a directory problem Fail with an error
					return;
				}
			}
			$returnCode = copy( $screenshot_path, PRESSCORE_THEME_DIR . "/screenshot." . pathinfo( $screenshot_path, PATHINFO_EXTENSION ) );
			if ( ! $returnCode ) {
				// Failure
			}
		}

		/**
		 * Searches directory for a theme screenshot
		 *
		 * @param  string $directory directory to search (a theme directory)
		 *
		 * @return string|false 'screenshot.png' (or whatever) or false if there is no screenshot
		 */
		private function searchScreenshot( $directory ) {
			$screenshots = glob( $directory . '/screenshot.{png,jpg,jpeg,gif}', GLOB_BRACE );

			return ( empty( $screenshots ) ) ? false : basename( $screenshots[0] );
		}

		public static function restore_dev_tool_files( $res = true, $hook_extra = array(), $result = array() ) {
			if ( is_wp_error( $res ) || ! isset( $hook_extra['theme'] ) || 'dt-the7' !== $hook_extra['theme'] ) {
				return $res;
			}
			$devTools = new The7_DevToolMainModule();
			$theme_name = self::arr_get( $devTools->options, 'theme_name', '' );
			$screenshot = self::arr_get( $devTools->options, 'screenshot', '' );
			if ( ! $devTools->isReplaceThemeDescription() && ( empty( $theme_name ) || $theme_name === "The7" ) && empty( $screenshot ) ) {
				return $res;
			}
			wp_clean_themes_cache( true );
			$devTools->updateThemeFiles();

			return $res;
		}

		public static function get_setting_name( $name ) {
			return self::DEV_TOOL_OPTION . "[$name]";
		}

		public static function getDevToolsOptions() {
			return self::get_option( self::DEV_TOOL_OPTION, array() );
		}

		public static function getOptionName() {
			return self::DEV_TOOL_OPTION;
		}

		public static function getToolOption( $name ) {
			if ( is_multisite() ) {
				$options = get_site_option( self::DEV_TOOL_OPTION . '-network' );
			} else {
				$options = get_option( self::DEV_TOOL_OPTION );
			}

			if ( isset( $options[ $name ] ) ) {
				return $options[ $name ];
			}

			return null;
		}


		private static function arr_get( $array, $key, $default = null ) {
			return isset( $array[ $key ] ) ? $array[ $key ] : $default;
		}
	}
endif;

