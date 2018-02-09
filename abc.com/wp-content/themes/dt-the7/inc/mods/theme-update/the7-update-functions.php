<?php

function the7_update_550_fancy_titles_parallax() {
	global $wpdb;

	$parallax_speed_meta = $wpdb->get_results( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '_dt_fancy_header_parallax_speed'" );
	$fixed_bg_meta = $wpdb->get_results( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '_dt_fancy_header_bg_fixed'", OBJECT_K );
	foreach ( $parallax_speed_meta as $_meta ) {
		if ( ! empty( $_meta->meta_value ) ) {
			// Setup parallax.
			add_post_meta( $_meta->post_id, '_dt_fancy_header_scroll_effect', 'parallax', true );
			add_post_meta( $_meta->post_id, '_dt_fancy_header_bg_parallax', $_meta->meta_value, true );
		} elseif ( array_key_exists( $_meta->post_id, $fixed_bg_meta ) && ! empty( $fixed_bg_meta[ $_meta->post_id ]->meta_value ) ) {
			// Setup fixed bg.
			add_post_meta( $_meta->post_id, '_dt_fancy_header_scroll_effect', 'fixed', true );
		}
		delete_post_meta( $_meta->post_id, '_dt_fancy_header_parallax_speed' );
		delete_post_meta( $_meta->post_id, '_dt_fancy_header_bg_fixed' );
	}
}

function the7_update_550_fancy_titles_font_size() {
	global $wpdb;

	$title_font_size_meta = $wpdb->get_results( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '_dt_fancy_header_title_size'" );

	foreach ( $title_font_size_meta as $font_size_meta ) {
		$old_font_size = $font_size_meta->meta_value;
		if ( in_array( $old_font_size, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ) ) ) {
			$font_size_option = "fonts-{$old_font_size}_font_size";
			$line_height_option = "fonts-{$old_font_size}_line_height";
		} elseif ( in_array( $old_font_size, array( 'big', 'normal', 'small' ) ) ) {
			$font_size_option = "fonts-{$old_font_size}_size";
			$line_height_option = "fonts-{$old_font_size}_size_line_height";
		} else {
			continue;
		}

		$post_id = $font_size_meta->post_id;
		$font_size = of_get_option( $font_size_option );
		if ( $font_size ) {
			add_post_meta( $post_id, '_dt_fancy_header_title_font_size', $font_size, true );
		}

		$line_height = of_get_option( $line_height_option );
		if ( $line_height ) {
			add_post_meta( $post_id, '_dt_fancy_header_title_line_height', $line_height, true );
		}

		delete_post_meta( $post_id, '_dt_fancy_header_title_size' );
	}
}

function the7_update_550_fancy_subtitles_font_size() {
	global $wpdb;

	$subtitle_font_size_meta = $wpdb->get_results( "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = '_dt_fancy_header_subtitle_size'" );

	foreach ( $subtitle_font_size_meta as $font_size_meta ) {
		$old_font_size = $font_size_meta->meta_value;
		if ( in_array( $old_font_size, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ) ) ) {
			$font_size_option = "fonts-{$old_font_size}_font_size";
			$line_height_option = "fonts-{$old_font_size}_line_height";
		} elseif ( in_array( $old_font_size, array( 'big', 'normal', 'small' ) ) ) {
			$font_size_option = "fonts-{$old_font_size}_size";
			$line_height_option = "fonts-{$old_font_size}_size_line_height";
		} else {
			continue;
		}

		$post_id = $font_size_meta->post_id;
		$font_size = of_get_option( $font_size_option );
		if ( $font_size ) {
			add_post_meta( $post_id, '_dt_fancy_header_subtitle_font_size', $font_size, true );
		}

		$line_height = of_get_option( $line_height_option );
		if ( $line_height ) {
			add_post_meta( $post_id, '_dt_fancy_header_subtitle_line_height', $line_height, true );
		}

		delete_post_meta( $post_id, '_dt_fancy_header_subtitle_size' );
	}
}

function the7_update_550_db_version() {
	The7_Install::update_db_version( '5.5.0' );
}

/**
 * Regenerate short codes inline css for all posts.
 *
 * @return bool
 */
function the7_mass_regenerate_short_codes_inline_css() {
	global $wpdb;

	$processed_posts = get_option( 'the7_update_short_codes_inline_css_processed_posts' );
	if ( ! $processed_posts || ! is_array( $processed_posts )) {
		$processed_posts = array( '0' );
	}
	$processed_posts_str = join( ',', $processed_posts );
	$posts_with_inline_css = $wpdb->get_results( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'the7_shortcodes_inline_css' AND post_id NOT IN ($processed_posts_str)" );

	if ( ! $posts_with_inline_css ) {
		delete_option( 'the7_update_short_codes_inline_css_processed_posts' );
		return false;
	}

	$post_ids = wp_list_pluck( $posts_with_inline_css, 'post_id' );
	$post_ids_str = join( ',', $post_ids );
	$posts_content = $wpdb->get_results( "SELECT ID, post_content FROM $wpdb->posts WHERE ID IN ({$post_ids_str})" );
	$posts_content_array = wp_list_pluck( $posts_content, 'post_content', 'ID' );

	if ( ! class_exists( 'The7_Shortcode_Id_Crutch', false ) ) {
		include( PRESSCORE_SHORTCODES_INCLUDES_DIR . '/class-the7-shortcode-id-crutch.php' );
	}

	if ( ! class_exists( 'lessc', false ) ) {
		include( PRESSCORE_DIR . '/vendor/lessphp/lessc.inc.php' );
	}

	/**
	 * Little crutch to overcome short codes inner id issue.
	 *
	 * On each output short code increments inner id, which lead to fatal issues when trying to process many posts at once.
	 * First post processed normally but short codes id's in the next one will start not from 1, and inline css wil be generated with invalid selectors.
	 * This class can fix the issue. It can reset short code inner id on each iteration which emulates normal post save process.
	 */
	$id_crutch_obj = new The7_Shortcode_Id_Crutch();

	/**
	 * Hook to reset short code inner id.
	 */
	add_action( 'the7_shortcodes_reset', array( $id_crutch_obj, 'reset_id' ) );

	foreach ( $post_ids as $post_id ) {
		if ( empty( $posts_content_array[ $post_id ] ) || wp_is_post_revision( $post_id ) ) {
			continue;
		}

		/**
		 * Reset processed tags on each iteration.
		 */
		$id_crutch_obj->reset_processed_tags();
		$css = presscore_generate_shortcode_css( $posts_content_array[ $post_id ] );

		if ( $css ) {
			update_post_meta( $post_id, 'the7_shortcodes_inline_css', $css );
		}

		$processed_posts[] = $post_id;
		update_option( 'the7_update_short_codes_inline_css_processed_posts', $processed_posts, false );
	}

	delete_option( 'the7_update_short_codes_inline_css_processed_posts' );
}

function the7_update_600_db_version() {
	The7_Install::update_db_version( '6.0.0' );
}

function the7_update_610_db_version() {
	The7_Install::update_db_version( '6.1.0' );
}
