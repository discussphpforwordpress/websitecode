<?php
class Membership_Membership_Model_MenuEditItemCustomFields {

	protected static $fields = array();

	public function init() {
		self::$fields = array(
			//note that menu-item- gets prepended to field names
			//i.e.: icon-url becomes menu-item-mbs-menu-visibility
			'mbs-menu-visibility' => __('Membership Menu Settings', 'membership-by-supsystic'),
		);
		add_action('wp_nav_menu_item_custom_fields', array($this, 'fieldListHanlder'), 10, 4);
		add_filter('manage_nav-menus_columns', array($this, 'getColumnsHandler'), 99);
		add_action('wp_update_nav_menu_item', array($this, 'saveFieldsValuesHandler'), 10, 4);
	}

	public function saveFieldsValuesHandler($menuId, $menuItemDbId, $menuItemArgs) {
		if(defined('DOING_AJAX') && DOING_AJAX) {
			return;
		}
		check_admin_referer('update-nav_menu', 'update-nav-menu-nonce');

		foreach(self::$fields as $_key => $label) {
			$key = sprintf('menu-item-%s', $_key);
			// Sanitize
			if(!empty($_POST[$key][$menuItemDbId])) {
				$value = (int) $_POST[$key][$menuItemDbId];
			} else {
				$value = null;
			}
			// Update
			update_post_meta($menuItemDbId, $key, $value);
		}
	}

	public function fieldListHanlder($id, $item, $depth, $args) {
		// get environment
		global $scMembership;
		$environment = $scMembership->getEnvironment();
		$twig = $environment->getTwig();

		foreach(self::$fields as $_key => $label) {
			$key = sprintf('menu-item-%s', $_key);
			$id = sprintf('edit-%s-%s', $key, $item->ID);
			$name = sprintf('%s[%s]', $key, $item->ID);
			$value = get_post_meta($item->ID, $key, true);
			$class = sprintf('field-%s', $_key);

			if($_key == 'mbs-menu-visibility') {
				echo $twig->render('@membership/menus/visibility-nav-menu-item-field.twig', array(
					//'key' => $key,
					'id' => esc_attr($id),
					'name' => esc_attr($name),
					'value' => esc_attr($value),
					'class' => esc_attr($class),
					'label' => esc_html($label),
				));
			}
		}
	}

	/**
	 * Add our fields to the screen options toggle
	 */
	public function getColumnsHandler($columns) {
		$columns = array_merge($columns, self::$fields);
		return $columns;
	}
}
