<?php

class Membership_Design_Module extends Membership_Base_Module {

	public function afterModulesLoaded() {

		add_action('wp_head', array($this, 'generateStyles'));

		$this->getModule('routes')->registerAjaxRoutes(array(
			'design.saveSettings' => array(
				'method' => 'post',
				'admin' => true,
				'handler' => array($this->getController(), 'saveSettings')
			),
		));

		add_filter('wp_get_nav_menu_items', array($this, 'prepareMenuItems'), 1, 3);

		if (!$this->isModule('design')) {
			return;
		}

		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(
				$this->getModule('base')->getAssetsPath() . '/css/option.backend.css',
			),
			array(
				'https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/2.7.2/jquery.serializejson.min.js',
				'https://cdnjs.cloudflare.com/ajax/libs/tinyColorPicker/1.1.1/jqColorPicker.min.js',
				$assetsPath . '/js/design.backend.js',
			)
		);
	}

	public function generateStyles() {
		$settings = $this->getSettings();
		print $this->render('@design/styles.twig', array('settings' => $settings));
	}

	public function prepareMenuItems($items, $menu, $args) {

		$settings = $this->getSettings();

		if (is_user_logged_in() && !is_admin()) {

			if (@$settings['design']['menu']['remove-login-registration'] === 'true') {
				$excludeItems = array('login', 'registration');
				$routes = $this->getModule('routes')->getRoutesList();

				foreach ($items as $key => $item) {
					foreach ($routes as $route => $pageId) {
						if (in_array($route, $excludeItems) && $item->object_id == $pageId) {
							unset($items[$key]);
						}
					}
				}
			}


			if (@$settings['design']['menu']['add-logout-link'] === 'true') {
				if(!isset($settings['design']['menu']['use-logout-list'])
					|| (!empty($settings['design']['menu']['logout-menu-list']) && in_array($menu->term_id, $settings['design']['menu']['logout-menu-list']))
				) {
					$menuItem = new stdClass();
					$menuItem->title = $this->translate('Logout');
					$menuItem->url = wp_logout_url();
					$menuItem->ID = 0;
					$menuItem->object = null;
					$menuItem->position = null;
					$menuItem->object_id = null;
					$menuItem->type = null;
					$menuItem->db_id = null;
					$menuItem->menu_order = null;
					$menuItem->menu_item_parent = null;
					$menuItem->classes = array();
					$menuItem->xfn = '';
					$menuItem->target = null;
					$menuItem->attr_title = null;
					$menuItem->description = null;
					$menuItem->status = null;
					$items[] = $menuItem;
				}
			}
		}

		return $items;
	}
}