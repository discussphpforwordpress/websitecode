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