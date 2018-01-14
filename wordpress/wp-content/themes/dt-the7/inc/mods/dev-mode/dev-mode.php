<?php
/**
 * Development mode module.
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'The7_Dev_Mode_Module' ) ) {

	class The7_Dev_Mode_Module {

		/**
		 * Execute module.
		 */
		public static function execute() {
			// Load dependency.
			include dirname( __FILE__ ) . '/class-the7-dev-admin-page.php';
			include dirname( __FILE__ ) . '/class-the7-dev-re-install.php';
			include dirname( __FILE__ ) . '/class-the7-dev-beta-tester.php';

			The7_Dev_Admin_Page::init();
			The7_Dev_Re_Install::init();
			The7_Dev_Beta_Tester::init();
		}
	}

	The7_Dev_Mode_Module::execute();
}