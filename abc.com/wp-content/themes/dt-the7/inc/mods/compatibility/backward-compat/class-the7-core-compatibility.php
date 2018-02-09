<?php

class The7_Core_Compatibility {

	/**
	 * Initiate compatibility actions.
	 */
	public static function setup() {
		$plugin_version = The7PT()->version();

		if ( version_compare( $plugin_version, '1.4.1', '>=' ) ) {
			self::hide_modules_options();
			add_action( 'the7_before_meta_box_registration', array( __CLASS__, 'exclude_meta_fields_from_presets' ), 9999 );
		}
	}

	/**
	 * Remove theme options for backwars compatibility.
	 */
	public static function hide_modules_options() {
		remove_filter( 'presscore_options_files_to_load', array( 'The7PT_Admin', 'add_module_options' ) );
	}

	/**
	 * Exclude some fields from presets and defaults.
	 */
	public static function exclude_meta_fields_from_presets() {
		global $DT_META_BOXES;

		foreach ( $DT_META_BOXES as &$meta_box ) {
			// Exclude albums media.
			if ( $meta_box['id'] === 'dt_page_box-album_post_media' && isset( $meta_box['fields'][0]['id'] ) ) {
				$meta_box['fields'][0]['exclude_from_presets'] = true;
			// Exclude project media.
			} elseif ( $meta_box['id'] === 'dt_page_box-portfolio_post_media' && isset( $meta_box['fields'][0]['id'] ) ) {
				$meta_box['fields'][0]['exclude_from_presets'] = true;
			// Exclude teammate options.
			} elseif ( $meta_box['id'] === 'dt_page_box-testimonial_options' && ! empty( $meta_box['fields'] ) ) {
				foreach ( $meta_box['fields'] as &$field ) {
					if ( $field['id'] === '_dt_teammate_options_go_to_single' ) {
						continue;
					}

					$field['exclude_from_presets'] = true;
				}
			}
		}
	}
}