<?php
class Membership_Membership_Model_MenuEditItemCustomFieldsWalker extends Walker_Nav_Menu_Edit {

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$item_output = '';
		parent::start_el($item_output, $item, $depth, $args, $id);

		$replaceRes = preg_replace(
			// NOTE: Check this regex from time to time!
			'/(?=<(fieldset|p)[^>]+class="[^"]*field-move)/',
			$this->get_fields( $item, $depth, $args ),
			$item_output
		);

		$output .= $replaceRes;
	}

	protected function get_fields($item, $depth, $args = array(), $id = 0) {
		ob_start();
		do_action('wp_nav_menu_item_custom_fields', $item->ID, $item, $depth, $args, $id);
		return ob_get_clean();
	}
}
