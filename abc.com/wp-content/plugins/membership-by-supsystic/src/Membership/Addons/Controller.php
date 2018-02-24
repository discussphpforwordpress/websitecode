<?php

class Membership_Addons_Controller extends Membership_Base_Controller {

	public function indexAction(Rsc_Http_Request $request) {
		$notInstalledAddons = $this->getModule()->getNotInstalledAddons();
		foreach ($notInstalledAddons as &$item) {
			$item['promo_id'] = 'membership-' . $item['id'];
		}

		return $this->response(
			'@addons/backend/index.twig',
			array('notInstalledAddons' => $notInstalledAddons)
		);
	}
	
	public function ecommerceAction() {
		$ecommerceTabs = array(
			'membership_levels' => array(
				'title' => $this->translate('Membership Levels'),
				'fa_icon' => 'fa-list',
				'order' => 10,
				'promo_image' => '/images/membership-ecom-membership_levels.png'
			),
			'payments' => array(
				'title' => $this->translate('Payments'),
				'fa_icon' => 'fa-credit-card',
				'order' => 20,
				'promo_image' => '/images/membership-ecom-payments.jpg'
			),
			'currency' => array(
				'title' => $this->translate('Currency'),
				'fa_icon' => 'fa-usd',
				'order' => 30,
				'promo_image' => '/images/membership-ecom-currency.jpg'
			),
			'drip' => array(
				'title' => $this->translate('Dripping Content'),
				'fa_icon' => 'fa-tint',
				'order' => 40,
				'promo_image' => '/images/membership-ecom-drip.png'
			),
			'orders' => array(
				'title' => $this->translate('Orders'),
				'fa_icon' => 'fa-shopping-cart',
				'order' => 50,
				'promo_image' => '/images/membership-ecom-orders.png'
			),
			'settings' => array(
				'title' => $this->translate('Settings'),
				'fa_icon' => 'fa-cogs',
				'order' => 60,
				'promo_image' => '/images/membership-ecom-settings.jpg'
			),
			'statistics' => array(
				'title' => $this->translate('Statistics'),
				'fa_icon' => 'fa-line-chart',
				'order' => 70,
				'promo_image' => '/images/membership-ecom-statistics.png'
			),
		);
		return $this->response(
			'@addons/backend/ecommerce.twig', array(
				'ecommerceTabs' => $ecommerceTabs,
			)
		);
	}

	public function socialLoginAction(Rsc_Http_Request $request) {
		return $this->response('@addons/backend/addons/social-login.twig');
	}

	public function subscriptionsAction(Rsc_Http_Request $request) {
		return $this->response('@addons/backend/addons/subscriptions.twig');
	}

	public function socialNetworkIntegrationAction(Rsc_Http_Request $request) {
		return $this->response('@addons/backend/addons/social-network-integration.twig');
	}

	public function wooCommerceAction(Rsc_Http_Request $request) {
		return $this->response('@addons/backend/addons/woocommerce.twig');
	}

}