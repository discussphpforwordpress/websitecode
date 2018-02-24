<?php

class Membership_License_Controller extends Membership_Base_Controller
{

	public function indexAction(Rsc_Http_Request $request)
	{
		$addonModel = $this->getModel('addons');
		$addons = $addonModel->getAddons();

		return $this->response('@license/backend/index.twig', array('addons' => $addons));
	}

	public function activate(Rsc_Http_Parameters $parameters)
	{
		$addons = $this->getConfig()->get('addons');

		$licenseData = $parameters->get('license');
		$addonModel = $this->getModel('addons');
		$licenseModel = $this->getModel('license');

		$licenseModel->saveSettings(array(
			'email' => $licenseData['email'],
			'key' => $licenseData['key']
		));

		$pluginsCount = array(

		);

		$activated = 0;
		$errors = 0;
		$expired = 0;
		$total = 0;

		foreach ($addons as $key => $addon) {
			
			$activateResponse = $addonModel->activate(array(
				'email' => $licenseData['email'],
				'key' => $licenseData['key'],
				'plugin_code' => $addon['code']
			));

			if ($activateResponse['success'] === false) {

				if ($activateResponse['error'] == $this->translate('Your license has expired')) {
					$addons[$key]['state'] = 'expired';
					$expired++;
				} else {
					$addons[$key]['state'] = 'error';
					$addons[$key]['error'] = $activateResponse['error'];
					$errors++;
				}

			} else {
				$date = new DateTime('now');
				$addons[$key]['state'] = 'activated';
				$addons[$key]['checkDate'] = $date->format('Y-m-d H:i:s');
				$addons[$key]['licenseSaveName'] = $activateResponse['response']['data']['save_data']['license_save_name'];
				$addons[$key]['licenseSaveVal'] = $activateResponse['response']['data']['save_data']['license_save_val'];
				$addons[$key]['daysLeft'] = $activateResponse['response']['data']['save_data']['days_left'];
				$activated++;
			}

			$total++;
		}

		$addonModel->saveSettings($addons);

		return $this->response('ajax', 
			array(
				'success' => true,
				'addons' => $addons,
				'count' => array(
					'activated' => $activated,
					'errors' => $errors,
					'expired' => $expired,
					'total' => $total,
				)
			)
		);
	}

	public function update($value='')
	{
		# code...
	}
}