<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    DT_Dummy
 * @subpackage DT_Dummy/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    DT_Dummy
 * @subpackage DT_Dummy/admin
 * @author     Dream-Theme
 */
class The7_Demo_Content_Admin {

	/**
	 * Array of plugin pages ids.
	 *
	 * @var array
	 */
	private $plugin_page = array();

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * @var object
	 */
	private $plugins_checker = null;

	/**
	 * @var array
	 */
	private $dummies_list = array();

	/**
	 * DT_Dummy_Admin constructor.
	 *
	 * @since 1.0.0
	 * @param $plugin_name
	 * @param $version
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name . '-import', PRESSCORE_MODS_URI . '/demo-content/admin/css/dt-dummy-admin.css', array(), THE7_VERSION, 'all' );
	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		global $the7_tgmpa;

		wp_enqueue_script( $this->plugin_name . '-import', PRESSCORE_MODS_URI . '/demo-content/admin/js/dt-dummy-admin.js', array( 'jquery' ), THE7_VERSION, false );

		$plugins = array();
		$plugins_page_url = '';
		if ( class_exists( 'Presscore_Modules_TGMPAModule' ) ) {
			$plugins = Presscore_Modules_TGMPAModule::get_plugins_list_cache();
			$plugins = wp_list_pluck( $plugins, 'name', 'slug' );

			if ( ! $the7_tgmpa->is_tgmpa_complete() ) {
				$plugins_page_url = $the7_tgmpa->get_bulk_action_link();
			}
		}

		wp_localize_script( $this->plugin_name . '-import', 'dtDummy', array(
			'import_nonce' => wp_create_nonce( $this->plugin_name . '_import' ),
			'status_nonce' => wp_create_nonce( $this->plugin_name . '_php_ini_status' ),
			'import_msg' => array(
				'btn_import' => __( 'Importing...', 'the7mk2' ),
				'msg_import_success' => __( 'Demo content successfully imported.', 'the7mk2' ),
				'msg_import_fail' => __( 'Import Fail!', 'the7mk2' ),
				'download_package' => __( 'Downloading package.', 'the7mk2' ),
				'import_post_types' => __( 'Importing content.', 'the7mk2' ),
				'import_attachments' => __( 'Importing attachments.', 'the7mk2' ),
				'import_theme_options' => __( 'Importing theme options.', 'the7mk2' ),
				'import_rev_sliders' => __( 'Importing slider(s).', 'the7mk2' ),
				'cleanup' => __( 'Final cleanup.', 'the7mk2' ),
				'installing_plugin' => __( 'Installing', 'the7mk2' ),
				'activating_plugin' => __( 'Activating plugin(s)', 'the7mk2' ),
				'plugins_activated' => __( 'Plugin(s) activated successfully.', 'the7mk2' ),
				'plugins_installation_error' => __( 'Server error.', 'the7mk2' ),
				'rid_of_redirects' => __( 'Cleanup after plugins installation.', 'the7mk2' ),
			),
			'plugins' => $plugins,
		    'plugins_page_url' => $plugins_page_url,
		) );
	}

	/**
	 * Add action link to plugin admin page.
	 *
	 * @since 1.2.0
	 * @param array $links
	 *
	 * @return array
	 */
	public function add_plugin_action_links( $links ) {
		$links['import-content'] = '<a href="' . esc_url( 'tools.php?page=dt-dummy-import' ) . '">' . __( 'Import content', 'the7mk2' ) . '</a>';
		return $links;
	}

	/**
	 * Add admin notice about successful demo installation.
	 *
	 * @since 6.0.1
	 * @param string $demo
	 */
	public function add_successful_demo_installation_admin_notice( $demo ) {
		set_transient( 'the7_demo_installed', $demo, 20 );
	}

	/**
	 * Display admin notice about successful demo installation.
	 *
	 * @since 6.0.1
	 */
	public function display_successful_demo_installation_admin_notice() {
		global $current_screen;

		if ( $current_screen->base !== 'the7_page_the7-demo-content' ) {
			return;
		}

		if ( ! get_transient( 'the7_demo_installed' ) ) {
			return;
		}

		the7_admin_notices()->add( 'the7_demo_content_installed', array(
			$this,
			'successful_demo_installation_notice'
		), 'updated the7-dashboard-notice' );
	}

	/**
	 * Print admin notice about successful demo installation.
	 *
	 * @since 6.0.1
	 */
	public function successful_demo_installation_notice() {
		$demo = get_transient( 'the7_demo_installed' );
		echo "<p>{$demo} 已成功导入。</p>";
		delete_transient( 'the7_demo_installed' );
	}

	/**
	 * Import dummy content. Ajax response.
	 *
	 * @since 1.0.0
	 */
	public function import_dummy_content() {
		if ( ! check_ajax_referer( $this->plugin_name . '_import', false, false ) || ! current_user_can( 'edit_theme_options' ) ) {
			$error = ( the7_is_debug_on() ? '<p>' . __( 'Insufficient user rights.', 'the7mk2' ) . '</p>' : '' );
			wp_send_json_error( array( 'error_msg' => $error ) );
		}

		if ( empty( $_POST['dummy'] ) ) {
			$error = ( the7_is_debug_on() ? '<p>' . __( 'Unable to find dummy content.', 'the7mk2' ) . '</p>' : '' );
			wp_send_json_error( array( 'error_msg' => $error ) );
		}

		$dummy_slug = ( isset( $_POST['content_part_id'] ) ? sanitize_key( $_POST['content_part_id'] ) : '' );
		$wp_uploads = wp_get_upload_dir();
		$import_content_dir = trailingslashit( $wp_uploads['basedir'] ) . "the7-demo-content-tmp/{$dummy_slug}";
		$dummy_list = $this->get_dummy_list();

		$import_manager = new The7_Demo_Content_Import_Manager( $import_content_dir );

		do_action( 'the7_demo_content_before_content_import', $import_manager );

		switch ( $this->get_action() ) {
			case 'download_package':
				$import_manager->download_dummy();
				break;
			case 'import_post_types':
				$import_manager->import_post_types();
				$import_manager->import_wp_settings();
				$import_manager->import_vc_settings();
				break;
			case 'import_attachments':
				$include_attachments = ( isset( $dummy_list[ $dummy_slug ]['include_attachments'] ) ? (bool) $dummy_list[ $dummy_slug ]['include_attachments'] : false );
				$import_manager->import_attachments( $include_attachments );
				break;
			case 'import_theme_options':
				$import_manager->import_theme_option();
				$import_manager->import_ultimate_addons_settings();
				$import_manager->import_ultimate_addons_icon_fonts();
				break;
			case 'import_rev_sliders':
				$import_manager->import_rev_sliders();
				break;
			case 'cleanup':
				$this->add_successful_demo_installation_admin_notice( $dummy_list[ $dummy_slug ]['title'] );
				$import_manager->cleanup_temp_dir();
				break;
		}

		do_action( 'the7_demo_content_after_content_import', $import_manager );

		if ( $import_manager->has_errors() ) {
			wp_send_json_error( array( 'error_msg' => $import_manager->get_errors_string() ) );
		}

		wp_send_json_success();
	}

	protected function get_action() {
		return $_POST['dummy'];
	}

	/**
	 * Check if php.ini have proper params values. Ajax response.
	 */
	public function get_php_ini_status() {
		if ( ! check_ajax_referer( $this->plugin_name . '_php_ini_status', false, false ) || ! current_user_can( 'edit_theme_options' ) ) {
			wp_send_json_error();
		}

		ob_start();
		include 'partials/notices/status.php';
		$status = ob_get_clean();

		wp_send_json_success( $status );
	}

	/**
	 * Register plugin admin page.
	 *
	 * @since 1.0.0
	 * @use add_management_page
	 */
	public function add_plugin_page() {
		$this->plugin_page['import_dummy'] = '';
	}

	/**
	 * Render plugin admin page.
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_page() {
		include 'partials/demos.php';
	}

	/**
	 * Return dummies list.
	 *
	 * @since 1.2.0
	 * @return array
	 */
	private function get_dummy_list() {
		return apply_filters( 'the7_demo_content_list', $this->dummies_list );
	}

	/**
	 * Factory method. Populates $plugins_checker property.
	 *
	 * @since 1.3.0
	 * @return The7_Demo_Content_TGMPA
	 */
	private function plugins_checker() {
		if ( null === $this->plugins_checker ) {
			$this->plugins_checker = new The7_Demo_Content_TGMPA();
		}

		return $this->plugins_checker;
	}
}
