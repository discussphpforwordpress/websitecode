<?php
/* Template Name: 作品 - 对齐网格 */

/**
 * Portfolio justified grid template
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;

$config = Presscore_Config::get_instance();

$config->set( 'template', 'portfolio' );

// allow to controll page content visibility
add_action('presscore_before_main_container', 'presscore_page_content_controller', 15);

get_header();

if ( presscore_is_content_visible() ): ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); // main loop

					do_action( 'presscore_before_loop' );

					if ( post_password_required() ) {
						the_content();

					} else {

						// backup config
						$config_backup = $config->get();

						///////////////////////
						// Posts Filer //
						///////////////////////

						presscore_display_posts_filter( array(
							'post_type' => 'dt_portfolio',
							'taxonomy' => 'dt_portfolio_category'
						) );

						// fullwidth wrap open
						if ( $config->get( 'full_width' ) ) { echo '<div class="full-width-wrap">'; }

						// masonry container open
						echo '<div ' . presscore_masonry_container_class( array( 'wf-container', 'jg-container' ) ) . presscore_masonry_container_data_atts() . '>';

							$page_query = presscore_get_filtered_posts( array( 'post_type' => 'dt_portfolio', 'taxonomy' => 'dt_portfolio_category' ) );
							if ( $page_query->have_posts() ) {

								while( $page_query->have_posts() ) {
									$page_query->the_post();

									// populate post config
									presscore_populate_portfolio_config();

									presscore_get_template_part( 'mod_portfolio', 'masonry/project' );
								}

								wp_reset_postdata();
							}

						// masonry container close
						echo '</div>';

						// fullwidth wrap close
						if ( $config->get( 'full_width' ) ) { echo '</div>'; }

						/////////////////////
						// Pagination //
						/////////////////////

						presscore_complex_pagination( $page_query );

						// restore config
						$config->reset( $config_backup );

					}

					do_action( 'presscore_after_loop' );

					presscore_display_share_buttons_for_post( 'page' );

				endwhile; endif; // main loop ?>

			</div><!-- #content -->

			<?php
			do_action('presscore_after_content');

endif; // if content visible

get_footer();
