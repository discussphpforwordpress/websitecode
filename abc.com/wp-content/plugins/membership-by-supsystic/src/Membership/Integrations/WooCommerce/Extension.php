<?php


class Membership_Integrations_WooCommerce_Extension extends Membership_Base_Module {

	public function afterModulesLoaded() {
		if (class_exists('WooCommerce')) {
			$this->init();
		}
	}

	public function init() {
		add_action('publish_product', array($this, 'newProduct'), 10, 2);
		$this->getDispatcher()->on('activity.relatedDataPrepare', array($this, 'activityDataPrepare'), 10, 2);
		$this->getDispatcher()->on('activity.relatedData', array($this, 'activityData'), 10, 2);
		$this->getDispatcher()->on('activity.buildActivitySelectQuery', array($this, 'activityQueryBuild'), 10, 1);
		$this->getDispatcher()->on('activity.view.activityTitle', array($this, 'activityTitle'));
		$this->getDispatcher()->on('activity.view.activityContent', array($this, 'activityContent'));
	}

	public function activityTitle() {
		print $this->render('@woocommerce/activity-title.twig');
	}

	public function activityContent() {
		print $this->render('@woocommerce/activity-content.twig');
	}


	public function activityQueryBuild($queryParams) {
		global $wpdb;

		switch ($queryParams['type']) {
			case 'activity':
				array_unshift($queryParams['where'],
					$wpdb->prepare("a.type = 'woocommerce_product' AND a.user_id = '%d'", $queryParams['requestedUserId']),
					"a.type = 'woocommerce_product' AND fs.id IS NOT NULL"
				);
				break;
			case 'activity-guest':
				array_unshift($queryParams['where'],
					"a.type = 'woocommerce_product'"
				);
				break;
			case 'profile-activity':
				array_unshift($queryParams['where'],
					$wpdb->prepare("a.type = 'woocommerce_product' AND a.user_id = '%d'", $queryParams['requestedUserId'])
				);
				break;
		}

		return $queryParams;
	}

	public function activityDataPrepare($activities, &$data) {

		foreach ($activities as &$activity) {
			if ($activity['type'] === 'woocommerce_product') {
				$data['posts'][] = $activity['object_id'];
			}
		}

		return $activities;
	}

	public function activityData($activities, $data) {

		$cartUrl = get_permalink(wc_get_page_id('shop'));
		foreach ($activities as &$activity) {
			if ($activity['type'] === 'woocommerce_product') {
				$product = wc_get_product($data['posts'][$activity['object_id']]);
				$product->permalink = $product->get_permalink();
				$product->price = $product->get_display_price();
				$product->description = do_shortcode($product->get_post_data()->post_content);
				$product->regular_price = $product->get_regular_price();
				$product->image = $product->get_image();
				$product->currency = get_woocommerce_currency_symbol();
				$product->title = $product->get_title();
				$product->buyUrl =  add_query_arg(array('add-to-cart' => $product->id), wc_get_cart_url());
				$activity['product'] = $product;
			}
		}

		return $activities;
	}

	public function newProduct($id, $post) {
		$this->getModel('Activity', 'Activity')->createActivity($post->post_author, 'woocommerce_product', '', null, $post->ID);
	}

}