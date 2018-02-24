<?php
class Membership_Googlemapseasy_Module extends Membership_Base_Module {
	public static $gmapFrontendPresets = null;
	public static $isGoogleMapsActivityModalInit = null;
	public static $moduleLoadedOnce = false;
	public static $moduleAssetLoadedOnce = false;
	protected $mapGoogleComApiUrl = null;
	
	public function afterModulesLoaded() {
		if(!self::$moduleLoadedOnce) {
			// frontend
			$this->getDispatcher()->on('activity.form.actions', array($this, 'viewGoogleMapsButton'), 10, 1);
			$this->getDispatcher()->on('activity.view.googleMapsModal', array($this, 'viewModalGoogleMapsEasyWindow'), 10, 1);
			$this->getDispatcher()->on('activity.form.googleMapsContainer', array($this, 'viewFormGoogleMapsContainer'), 10, 1);
			$this->getDispatcher()->on('activity.enqueueActivitiesAssets', array($this, 'registerFrontendAsset'), 10, 1);
			$this->registerAjaxRoutes();
			// backend
			$this->registerBackendAsset();
			$this->getDispatcher()->on('backendMainContentSettingsGoogleMapsEasyOpt', array($this, 'viewBackendContentGoogleMapsSetting'), 10, 1);
			self::$moduleLoadedOnce = true;
		}
	}

	public function registerAjaxRoutes() {
		$routesModule = $this->getModule('routes');
		$routesModule->registerAjaxRoutes(array(
			'googleMapsEasy.setPreviewPosition' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'setPreviewPosition'),
			),
			'googleMapsEasy.removeMap' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'removeMap'),
			),
			'googleMapsEasy.createMap' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'createMap'),
			),
			'googleMapsEasy.saveMapParams' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'saveMapParams'),
			),
		));
	}

	public function getGmapsPresets() {
		if(self::$gmapFrontendPresets === null) {
			$googleMapsModel = $this->getModel('GoogleMaps');
			if($googleMapsModel) {
				if($googleMapsModel->checkPluginRequiments()) {
					$settings = $this->getModel('settings', 'membership')->getSettings();
					self::$gmapFrontendPresets = $googleMapsModel->getActivePresets(isset($settings['plugins']['googleMapsEasy']) ? $settings['plugins']['googleMapsEasy'] : null);
				} else {
					self::$gmapFrontendPresets = false;
				}
			}
		}
	}

	public function viewBackendContentGoogleMapsSetting() {
		$googleMapsInfo = $this->getModel('GoogleMaps')->getGoogleMapsInfo();
		echo $this->render('@googlemapseasy/partials/backend.main.content.setting.twig', array(
			'googleMapsInfo' => $googleMapsInfo,
		));
		return true;
	}

	public function getMapGoogleComApiUrl() {
		if(empty($this->mapGoogleComApiUrl)) {
			$gmModel = $this->getModel('GoogleMaps');
			$apiKey = $gmModel->getGoogleMapApiKey();
			$urlParams = array('key' => $apiKey);
			$this->mapGoogleComApiUrl = 'https://maps.googleapis.com/maps/api/js?'. http_build_query($urlParams);
		}
		return $this->mapGoogleComApiUrl;
	}

	public function registerFrontendAsset() {
		if(!self::$moduleAssetLoadedOnce) {
			$assetsPath = $this->getAssetsPath();
			$baseAssetUrl = $this->getModule('base')->getAssetsPath() . '/lib/jquery-ui/';
			$this->getModule('assets')->enqueueAssets(
				array(
					array(
						'source' => $assetsPath . '/css/google-maps.frontend.css',
						'dependencies' => array(
							'gallery.frontend.css',
						),
					),
					$baseAssetUrl . 'jquery-ui.autocomplete.min.css',
				),
				array(
					array(
						'source' => $assetsPath . '/js/google-maps-frontend.js',
						'dependencies' => array(
							'gallery.frontend.js',
							'jquery-ui.min.js',
						)
					),
					array(
						'handle' => 'jquery-ui.autocomplete.min',
						'source' => $baseAssetUrl . 'jquery-ui.autocomplete.min.js',
					),
				),
				MBS_FRONTEND
			);
			self::$moduleAssetLoadedOnce = true;
		}
	}

	public function viewFormGoogleMapsContainer() {
		$this->getGmapsPresets();
		if(self::$gmapFrontendPresets) {
			echo $this->render('@googlemapseasy/partials/activity-post-form-container.twig', array());
		}
		return true;
	}

	public function viewGoogleMapsButton() {
		$this->getGmapsPresets();
		if(self::$gmapFrontendPresets) {
			echo $this->render(
				'@googlemapseasy/partials/activity-post-form-button.twig',
				array(
					'googleMaps' => self::$gmapFrontendPresets,
				)
			);
		}
		return true;
	}

	public function viewModalGoogleMapsEasyWindow() {
		$this->getGmapsPresets();
		if(self::$gmapFrontendPresets) {
			if(!self::$isGoogleMapsActivityModalInit) {
				$googleMapsModel = $this->getModel('GoogleMaps');
				$defaultGoogleMapsImage = $googleMapsModel->getDefaulImageUrl();

				$markerIconsList = $googleMapsModel->getGoogleMapsEasyIconList();

				// run GME module function
				$googleMapsEasyHtmlArr = $googleMapsModel->initGoogleMapsHtml(self::$gmapFrontendPresets);
				echo $this->render(
					'@googlemapseasy/partials/activity-google-maps-modal.twig',
					array(
						'googleMapsPresets' => self::$gmapFrontendPresets,
						'googleMapsEasyHtmlArr' => $googleMapsEasyHtmlArr,
						'defaultGoogleMapsImage' => $defaultGoogleMapsImage,
						'markerIconsList' => $markerIconsList,
						'defaultIcon' => $googleMapsModel->getDefaultIconUrl(),
					)
				);
				self::$isGoogleMapsActivityModalInit = true;
			}
		}
		return true;
	}
	
	public function registerBackendAsset() {
		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/google-maps-backend.css',
			), array(), MBS_BACKEND
		);
	}
}