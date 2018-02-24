<?php
class Membership_Slider_Module extends Membership_Base_Module {
	public static $isSliderActivityModalInit = false;
	public static $frontendSliderPresets = null;

	public function afterModulesLoaded() {
		// frontend
		$this->getDispatcher()->on('activity.form.actions', array($this, 'viewSliderButton'), 10, 1);
		$this->getDispatcher()->on('activity.view.sliderModal', array($this, 'viewModalSliderWindow'), 10, 1);
		$this->getDispatcher()->on('activity.form.sliderContainer', array($this, 'viewFormSliderContainer'), 10, 1);
		$this->getDispatcher()->on('activity.enqueueActivitiesAssets', array($this, 'registerFrontendAsset'), 10, 1);
		$this->registerAjaxRoutes();

		// backend
		$this->getDispatcher()->on('backendMainContentSettingsSliderOpt', array($this, 'viewContentSliderSetting'), 10, 1);
	}

	public function registerAjaxRoutes() {
		$routesModule = $this->getModule('routes');
		$routesModule->registerAjaxRoutes(array(
			'slider.removeImage' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'removeImage'),
			),
			'slider.uploadImage' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'uploadImage')
			),
			'slider.addSlider' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'addSlider')
			),
			'slider.remove' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'removeSlider'),
			),
			'slider.setImagesPosition' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'setImagesPosition'),
			),
			'slider.setSliderPosition' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'setSliderPosition'),
			),
		));
	}

	public function viewSliderButton() {

		if($this->getSliderPresets()) {
			echo $this->render(
				'@slider/partials/activity-post-form-button.twig',
				array(
					'sliderPresets' => self::$frontendSliderPresets,
				)
			);
		}
		return true;
	}

	public function viewModalSliderWindow() {
		$sliderModel = $this->getModel('slider', 'slider');

		if($this->getSliderPresets()) {
			if(!self::$isSliderActivityModalInit) {

				$defaultSliderImage = $sliderModel->getDefaultSliderImageUrl();
				echo $this->render(
					'@slider/partials/activity-slider-modal.twig',
					array(
						'sliderPresets' => self::$frontendSliderPresets,
						'defaultSliderImage' => $defaultSliderImage,
					)
				);
				self::$isSliderActivityModalInit = true;
			}
		}
		return true;
	}

	public function getSliderPresets() {
		$sliderModel = $this->getModel('slider', 'slider');
		if(self::$frontendSliderPresets == null) {
			$settings = $this->getModel('settings', 'membership')->getSettings();
			self::$frontendSliderPresets = $sliderModel->getActivePresets(isset($settings['plugins']['slider']) ? $settings['plugins']['slider'] : null);
		}
		return self::$frontendSliderPresets;
	}

	public function viewFormSliderContainer() {
		if($this->getSliderPresets()) {
			echo $this->render('@slider/partials/activity-post-form-slider-container.twig', array());
		}
		return true;
	}

	public function viewContentSliderSetting() {

		$sliderInfo = $this->getModel('slider', 'slider')->getSliderInfo();
		echo $this->render('@slider/partials/backend.main.content.setting.twig', array(
			'sliderInfo' => $sliderInfo,
		));
		return true;
	}

	public function prepareUrlFromPath($path) {
		$tmpVar = str_replace(rtrim(ABSPATH, '/'), get_bloginfo('wpurl'), $path);
		$url = str_replace('\\', '/', $tmpVar);
		return $url;
	}

	public function registerFrontendAsset() {
		$assetsPath = $this->getAssetsPath();

		$cssArr = array(
			array(
				'source' => $assetsPath . '/css/slider.frontend.css',
				'dependencies' => array(
					'gallery.frontend.css',
				),
			),
		);
		
		$jsArr = array(
			array(
				'source' => $assetsPath . '/js/slider.frontend.js',
				'dependencies' => array(
					'gallery.frontend.js',
					'jquery-ui.min.js',
				)
			)
		);
		global $supsysticSlider;

		// if SliderPresets Exists - ALWAYS include css and scripts for slider 
		if($this->getSliderPresets() && $supsysticSlider) {
			$sliderPluginEnvironment = $supsysticSlider->getEnvironment();
			$sliderConfig = $sliderPluginEnvironment->getConfig();
			$sliderUrl = $this->prepareUrlFromPath($sliderConfig->plugin_path);

			// wp-content/plugins/slider-by-supsystic/src/SupsysticSlider/Bx/
			$bxAssetLocation = $sliderUrl . '/src/SupsysticSlider/Bx';

			wp_enqueue_script(
				'supsysticSlider-bxSliderPlugin',
				$bxAssetLocation . '/assets/js/jquery.bxslider.js',
				array(),
				'1.0.0',
				true
			);
			wp_enqueue_script(
				'supsysticSlider-bxSliderPluginFitVids',
				$bxAssetLocation . '/assets/js/jquery.fitvids.js',
				array(),
				'1.0.0',
				true
			);
			wp_enqueue_script(
				'supsysticSlider-bxSlider',
				$bxAssetLocation . '/assets/js/frontend.js',
				array(),
				'1.0.0',
				true
			);
			wp_enqueue_script(
				'google-font-loader',
				'//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js',
				array(),
				'1.0.0',
				true
			);

			wp_enqueue_style(
				'supsysticSlider-bxSliderStyles',
				$bxAssetLocation . '/assets/css/jquery.bxslider.css',
				array(),
				'1.0.0',
				'all'
			);
			wp_enqueue_style(
				'supsysticSlider-bxSliderStyles-animate',
				$bxAssetLocation . '/assets/css/animate.css',
				array(),
				'1.0.0',
				'all'
			);

			// wp-content/plugins/slider-by-supsystic/src/SupsysticSlider/Coin/
			$coinAssetLocation = $sliderUrl . '/src/SupsysticSlider/Coin';
			wp_enqueue_style(
				'supsysticSlider-coinSliderPluginStyles',
				$coinAssetLocation . '/assets/css/coin-slider-styles.css',
				array(),
				'1.0.0',
				'all'
			);

			wp_enqueue_script(
				'supsysticSlider-coinSliderPlugin',
				$coinAssetLocation . '/assets/js/coin-slider.min.js',
				array(),
				'1.0.0',
				true
			);
			wp_enqueue_script(
				'supsysticSlider-coinSlider-frontend',
				$coinAssetLocation . '/assets/js/frontend.js',
				array(),
				'1.0.0',
				true
			);

			// wp-content/plugins/slider-by-supsystic/src/SupsysticSlider/Core/
			$coreAssetLocation = $sliderUrl . '/src/SupsysticSlider/Core';
//			if ($this->isPluginPage()) {
//				wp_enqueue_script('notice',
//					$coreAssetLocation . '/assets/js/notice.js',
//					array('jquery'),
//					'1.0',
//					true
//				);
//			}


			if($sliderConfig->is_pro) {
				// supsystic_slider_pro/src/SupsysticSliderPro/Jssor/
				$jssorAssetLocation = $this->prepareUrlFromPath($sliderConfig->pro_modules_path) . '/SupsysticSliderPro/Jssor';

				wp_enqueue_style(
					'supsysticSlider-jssorSliderStyles',
					$jssorAssetLocation . '/assets/css/jssor-slider-styles.css',
					array(),
					'1.0.0',
					'all'
				);

				wp_enqueue_style(
					'supsysticSlider-slide-buttons',
					$jssorAssetLocation . '/assets/css/caption-buttons.css',
					array(),
					'1.0.0',
					'all'
				);

				wp_enqueue_script('jquery');

				wp_enqueue_script(
					'supsysticSlider-jssor',
					$jssorAssetLocation . '/assets/js/jssor.js',
					array(),
					'1.0.0',
					true
				);

				wp_enqueue_script(
					'supsysticSlider-jssorSlider',
					$jssorAssetLocation . '/assets/js/jssor.slider.js',
					array(),
					'1.0.0',
					true
				);

				wp_enqueue_script(
					'supsysticSlider-frontend-jssorSlider',
					$jssorAssetLocation . '/assets/js/frontend.js',
					array(),
					'1.0.0',
					true
				);

				wp_enqueue_script(
					'supsysticSlider-jssor-ytiframe',
					$jssorAssetLocation . '/assets/js/jssor.player.ytiframe.js',
					array(),
					'1.0.0',
					true
				);
			}

			// wp-content/plugins/slider-by-supsystic/src/SupsysticSlider/Slider/
			$sliderAssetLocation = $sliderUrl . '/src/SupsysticSlider/Slider';
			wp_enqueue_style(
				'rs-shadows-css',
				$sliderUrl . '/app/assets/css/shadows.css',
				array(),
				'1.0.0'
			);
			wp_enqueue_style(
				'supsysticSlider-slider-stylesAnimateLetters',
				$sliderAssetLocation . '/assets/css/animate.css',
				array(),
				'1.0.0'
			);

			wp_enqueue_script(
				'supsysticSlider-slider-frontend',
				$sliderAssetLocation . '/assets/js/frontend.js',
				array(),
				'1.0.0',
				true
			);
			wp_enqueue_script(
				'supsysticSlider-slider-lettering',
				$sliderAssetLocation . '/assets/js/jquery.lettering.js',
				array(),
				'1.0.0',
				true
			);
			wp_enqueue_script(
				'supsysticSlider-slider-texttillate',
				$sliderAssetLocation . '/assets/js/jquery.textillate.js',
				array(),
				'1.0.0',
				true
			);
			wp_enqueue_script(
				'supsysticSlider-slider-easing',
				'//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
				array(),
				'1.0.0',
				true
			);
		}
		
		$this->getModule('assets')->enqueueAssets($cssArr, $jsArr, MBS_FRONTEND);
	}
}