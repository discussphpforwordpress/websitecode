<?php
/**
 * Archive pages.
 *
 * @package The7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = presscore_config();
$config->set( 'template', 'archive' );
$config->set( 'layout', 'masonry' );
$config->set( 'template.layout.type', 'masonry' );

get_header();
?>
			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php
				the_archive_description( '<div class="taxonomy-description">', '</div>' );

				if ( ! have_posts() ) {
					get_template_part( 'no-results', 'search' );
                } else {
					do_action( 'presscore_before_loop' );

					// backup config
					$config_backup = $config->get();

					// masonry container open
					echo '<div ' . presscore_masonry_container_class( array( 'wf-container' ) ) . presscore_masonry_container_data_atts() . '>';
                    while ( have_posts() ) {
                        the_post();
                        presscore_archive_post_content();
                        $config->reset( $config_backup );
                    }
					// masonry container close
					echo '</div>';

					dt_paginator();

					do_action( 'presscore_after_loop' );
                }
				?>

			</div><!-- #content -->

			<?php do_action( 'presscore_after_content' ) ?>

<?php get_footer() ?>