<?php

class The7_Post_Meta_Presets_Box {

	public static $instance = null;

	protected function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
	}

	public static function setup() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self;
		}
	}

	/**
	 * Adds the meta box.
	 */
	public function add_meta_box() {
		$post_types = array( 'post', 'page' );

		add_meta_box(
			'the7-post-meta-presets-box',
			__( 'Settings Presets', 'the7mk2' ),
			array( $this, 'render' ),
			$post_types,
			'side',
			'default'
		);
	}

	/**
	 * Renders the meta box.
	 */
	public function render( $post ) {
		?>

		<p>
            <select id="the7-post-meta-presets" name="_the7_post_meta_presets">
                <?php
                $presets_provider = Presscore_Modules_Posts_Defaults::new_post_meta_wp_provider( $post->post_type );
                $presets_names = Presscore_Modules_Posts_Defaults::prepare_presets_names_for_output( $presets_provider->get_presets_names() );

                foreach ( $presets_names as $preset_name ) {
	                printf( '<option value="%1$s">%2$s</option>', $preset_name['id'], $preset_name['name'] );
                }
                ?>
            </select>
        </p>
        <?php
        $preset_action_status = '';
        if ( $presets_names[0]['id'] === '' ) {
            $preset_action_status = 'disabled="disabled"';
        }
        ?>
        <p id="the7-post-meta-presets-actions">
            <button type="button" id="the7-post-meta-add-preset" class="button button-secondary"><?php esc_html_e( 'Create new', 'the7mk2' ) ?></button>
            <button type="button" id="the7-post-meta-save-preset" class="button button-primary" <?php echo $preset_action_status ?>><?php esc_html_e( 'Save', 'the7mk2' ) ?></button>
            <button type="button" id="the7-post-meta-delete-preset" class="button button-secondary" <?php echo $preset_action_status ?>><?php esc_html_e( 'Delete', 'the7mk2' ) ?></button>
        </p>
        <div class="rwmb-field rwmb-heading-wrapper"><div class="dt_hr dt_hr-top"></div><h4><?php esc_html_e( 'Preset Actions', 'the7mk2' ) ?></h4></div>
        <p>
            <button type="button" id="the7-post-meta-save-defaults" class="button button-secondary"><?php esc_html_e( 'Save as default', 'the7mk2' ) ?></button>
            <button type="button" id="the7-post-meta-apply-preset" class="button button-primary" <?php echo $preset_action_status ?>><?php esc_html_e( 'Apply to this page', 'the7mk2' ) ?></button>
        </p>

		<?php
	}
}