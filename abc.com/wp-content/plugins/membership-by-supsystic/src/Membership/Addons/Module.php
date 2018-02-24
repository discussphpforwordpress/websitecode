<?php

class Membership_Addons_Module extends Membership_Base_Module {

	private $addons = array(
		/*'social-login',
		'subscriptions'*/
	);

	public function afterModulesLoaded() {
		$dispatcher = $this->getDispatcher();
		$dispatcher->on('adminAreaMenus', array($this, 'addAdminAreaMenuItem'));

		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/addons.backend.css',
				),
			array(
				$assetsPath . '/js/addons.backend.js',
			)
		);
	}
	
	public function getAddonsList() {
		if(empty($this->addons)) {
			$this->addons = array(
				'social-login' => array(
					'title' => $this->translate('Social Login'),
					'fa_icon' => 'fa-share-alt',
					'order' => 90,
					'module' => 'addons',
					'action' => 'socialLogin',
					'id' => 'social-login',
					'promo_image' => '/images/membership_social_login_pro_addon.png'
				),
				'social-network-integration' => array(
					'title' => $this->translate('Social Network Integration'),
					'fa_icon' => 'fa-share-alt',
					'order' => 100,
					'module' => 'addons',
					'action' => 'socialNetworkIntegration',
					'id' => 'social-network-integration',
					'promo_image' => '/images/membership_social_network_integration_pro_addon.png'
				),
				'subscriptions' => array(
					'title' => $this->translate('Subscriptions'),
					'fa_icon' => 'fa-newspaper-o',
					'order' => 110,
					'module' => 'addons',
					'action' => 'subscriptions',
					'id' => 'subscriptions',
					'promo_image' => '/images/membership_subscriptions_pro_addon.png'
				),
				'woocommerce' => array(
					'title' => $this->translate('WooCommerce'),
					'fa_icon' => 'fa-shopping-cart',
					'order' => 120,
					'module' => 'addons',
					'action' => 'wooCommerce',
					'id' => 'woocommerce',
					'promo_image' => '/images/membership_woocommerce_pro_addon.png'
				),
			);
		}

		return $this->addons;
	}

	public function addAdminAreaMenuItem($subMenus) {
		$extension = array('extensions' => array(
			'title' => $this->translate('Extensions'),
			'fa_icon' => 'fa fa-ellipsis-h',
			'order' => 100,
			'module' => 'addons',
			'action' => '',
		));
		
		$installedAddons = array_keys($this->getModel('Addons', 'License')->getInstalledAddons());
		if(empty($installedAddons) || !in_array('ecommerce', $installedAddons)) {
			$extension['ecommerce'] = array(
				'title' => $this->translate('E-Commerce'),
				'fa_icon' => 'fa-shopping-cart',
				'order' => 110,
				'module' => 'addons',
				'action' => 'ecommerce',
			);
		}
		return array_merge($subMenus, $extension);
	}

	public function getNotInstalledAddons() {
		$notInstalledAddons = array();
		$installedAddons = array_keys($this->getModel('Addons', 'License')->getInstalledAddons());

		$this->getAddonsList();

		foreach ($this->addons as $addonCode => $addon) {
			if (!in_array($addonCode, $installedAddons)) {
				$notInstalledAddons[] = $addon;
			}
		}

		// Add promo menu items
		if(!empty($notInstalledAddons)) {
			foreach($notInstalledAddons as $i => $item) {
				$notInstalledAddons[$i]['is_promo'] = true;
			}
		}

		return $notInstalledAddons;
	}
}