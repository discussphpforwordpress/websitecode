<?php

class Membership_License_Module extends Membership_Base_Module {

	public $apiUri;
	public $pluginName;
	public $pluginSlug;
	public $pluginСode;
	public $pluginHash;
	public $userAgentHash;

	public function __construct(Rsc_Environment $environment, $location, $namespace) {
		parent::__construct($environment, $location, $namespace);
		$this->getDispatcher()->on('settingsModelAliases', array($this, 'registerSettingsModel'));
	}
	
	public function afterModulesLoaded() {

		$addons = $this->getConfig()->get('addons');

		if (!$addons) {
			return;
		}

		//$dispatcher = $this->getDispatcher();
		//$dispatcher->on('settingsModelAliases', array($this, 'registerSettingsModel'));
		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/license.backend.css',
			),
			array(
				$assetsPath . '/js/license.backend.js',
			)
		);

		$this->getModule('routes')->registerAjaxRoutes(
			array(
				'license.activate' => array(
					'method' => 'post',
					'admin' => true,
					'handler' => array($this->getController(), 'activate')
				),
			)
		);
	}

	public function registerSettingsModel($aliases) {
		$aliases = array_merge($aliases, array(
			'addons' => $this->getModel('addons'),
			'license' => $this->getModel('license'),
		));
		return $aliases;
	}

	public function getPluginName()
	{
		return $this->pluginName . '/index.php';
	}

	public function updateCheck($data) {
		if (!$this->apiUri || empty($data->checked) || !isset($data->checked[$this->getPluginName()])) {
			return $data;
		}

		$args = array(
			'license' => $this->getLicenseCredentials(),
			'slug' => $this->pluginCode,
			'version' => $data->checked[$this->getPluginName()],
			'hash' => $this->pluginHash
		);

		$request = $this->prepareRequestData('basic_check', $args);
		$response = wp_remote_post($this->apiUri, $request);

		
		if (!is_wp_error($response) && ($response['response']['code'] == 200)) {
			$responseBody = unserialize($response['body']);
			if ($responseBody) {
				$data->response[$this->getPluginName()] = $responseBody;
			}
		}

		return $data;
	}

	public function apiCall($def, $action, $args) {

		$pluginsUpdateInfo = get_site_transient('update_plugins');

		if (!isset($pluginsUpdateInfo->checked[$this->getPluginName()])) {
			return $def;
		}

		$currentVersion = $pluginsUpdateInfo->checked[$this->getPluginName()];
		$args->version = $currentVersion;
		
		$request = $this->prepareRequestData($action, $args);

		$response = wp_remote_post($this->apiUri, $request);

		if (!is_wp_error($response) && ($response['response']['code'] == 200)) {
			$responseBody = unserialize($response['body']);
			if ($responseBody) {
				return $responseBody;
			}
		}

		return $def;
	}

	public function getLicenseCredentials() {
		$credentials = $this->getModel('license')->getSettings();
		if ($credentials) {
			$credentials['key'] = md5($credentials['key']);
			return urlencode(base64_encode(implode('|', $credentials)));
		}
	}

	public function prepareRequestData($action, $args) {
		global $wp_version;

		return array(
			'body' => array(
				'action' => $action, 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => $this->userAgentHash. '/' . $wp_version . '; ' . get_bloginfo('wpurl') . '/;'. $this->getIP()
		);
	}

	public function getIP() {
		return (empty($_SERVER['HTTP_CLIENT_IP']) ?
			(empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['REMOTE_ADDR'] : $_SERVER['HTTP_X_FORWARDED_FOR']) :
			$_SERVER['HTTP_CLIENT_IP']);
	}

	public function onInstall() {
		if ($this->pluginSlug && $this->pluginCode) {
			$addonsModel = $this->getModel('Addons');
			$addons = $addonsModel->getAddons();

			if (isset($addons[$this->pluginSlug]) && $addons[$this->pluginSlug]['state'] === 'not-activated') {
				$credentials = $this->getModel('license')->getSettings();
				if ($credentials) {

					$activateResponse = $addonsModel->activate(array(
						'email' => $credentials['email'],
						'key' => $credentials['key'],
						'plugin_code' => $this->pluginCode
					));

					if ($activateResponse['success'] === false) {

						if ($activateResponse['error'] == $this->translate('Your license has expired')) {
							$addons[$this->pluginSlug]['state'] = 'expired';
						} else {
							$addons[$this->pluginSlug]['state'] = 'error';
							$addons[$this->pluginSlug]['error'] = $activateResponse['error'];
						}

					} else {
						$date = new DateTime('now');
						$addons[$this->pluginSlug]['state'] = 'activated';
						$addons[$this->pluginSlug]['checkDate'] = $date->format('Y-m-d H:i:s');
						$addons[$this->pluginSlug]['licenseSaveName'] = $activateResponse['response']['data']['save_data']['license_save_name'];
						$addons[$this->pluginSlug]['licenseSaveVal'] = $activateResponse['response']['data']['save_data']['license_save_val'];
						$addons[$this->pluginSlug]['daysLeft'] = $activateResponse['response']['data']['save_data']['days_left'];
					}
				}

				$addonsModel->saveSettings($addons);
			}
		}
	}
}