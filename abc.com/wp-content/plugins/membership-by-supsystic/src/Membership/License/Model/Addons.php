<?php

class Membership_License_Model_Addons extends Membership_Base_Model_Settings
{
	protected $apiUri = 'http://supsystic.com/';
	protected $settingField = 'addons';

	public function getAddons() {

		$activeAddons = $this->get($this->settingField);

		if ($activeAddons) {
			$activeAddons = $activeAddons['addons'];
		}

		$installedAddons = $this->getInstalledAddons();

		foreach ($installedAddons as $id => $addon) {
			if (isset($activeAddons[$id])) {
				$installedAddons[$id] = $activeAddons[$id];

			} else {
				$installedAddons[$id]['state'] = 'not-activated';
			}
		}
		
		return $installedAddons;
	}


	public function activate(array $licenseData)
	{
		
		$siteUrl = get_bloginfo('wpurl') . '/';

		$requestData = array_merge($licenseData, array(
			'mod' => 'manager',
			'pl' => 'lms',
			'action' => 'activate',
			'url' => $siteUrl,
		));


		$response = wp_remote_post($this->apiUri, array(
			'body' => $requestData
		));


		if (is_wp_error($response)) {

			return array(
				'success' => false,
				'error' => $response->get_error_message()
			);

		} else {
			$response = json_decode($response['body'], true);

			if ($response === false) {
				return array(
					'success' => 'false',
					'error' => $this->translate('License server error')
				);
			}

			if ($response['error']) {
				return array(
					'success' => false,
					'error' => $response['errors'][0]
				);
			}

			return array(
				'success' => true,
				'response' => $response
			);
		}
	}
	
	public function getInstalledAddons() {
		return $this->environment->getConfig()->get('addons');
	}

}