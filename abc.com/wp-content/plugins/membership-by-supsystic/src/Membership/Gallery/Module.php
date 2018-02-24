<?php
class Membership_Gallery_Module extends Membership_Base_Module {
	public static $isGalleryActivityModalInit = false;
	public static $frontendGalleryPresets = null;
	
	public function afterModulesLoaded() {
		// frontend
		$this->getDispatcher()->on('activity.form.actions', array($this, 'viewAddGalleryButton'), 10, 1);
		$this->getDispatcher()->on('activity.view.galleryModal', array($this, 'viewModalGalleryWindow'), 10, 1);
		$this->getDispatcher()->on('activity.form.photoGalleryContainer', array($this, 'viewFormPhotoGalleryContainer'), 10, 1);
		$this->getDispatcher()->on('activity.enqueueActivitiesAssets', array($this, 'registerFrontendAsset'), 10, 1);
		$this->registerAjaxRoutes();

		// backend
		$this->registerBackendAsset();
		$this->getDispatcher()->on('backendSettingsMainContentTab', array($this, 'viewContentGalleryTab'), 10, 1);
		$this->getDispatcher()->on('backendSettingsMainContentSettings', array($this, 'viewContentGallerySettings'), 10, 1);
	}

	public function registerAjaxRoutes() {
		$routesModule = $this->getModule('routes');
		$routesModule->registerAjaxRoutes(array(
			'gallery.removeImage' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'removeImage'),
			),
			'gallery.uploadImage' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'uploadImage')
			),
			'gallery.addGallery' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'addGallery')
			),
			'gallery.remove' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'removeGallery'),
			),
			'gallery.setImagesPosition' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'setImagesPosition'),
			),
			'gallery.setGalleryPosition' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'setGalleryPosition'),
			),
		));
	}

	public function getGalleryPresets() {
		if(self::$frontendGalleryPresets == null) {
			$settings = $this->getModel('settings', 'membership')->getSettings();
			$galleryModel = $this->getModel('Gallery', 'Gallery');
			self::$frontendGalleryPresets = $galleryModel->getGalleryListJoinSettings(isset($settings['plugins']['photoGallery']) ? $settings['plugins']['photoGallery'] : null);
		}
		return self::$frontendGalleryPresets;
	}

	public function viewAddGalleryButton() {

		$this->getGalleryPresets();
		if(self::$frontendGalleryPresets) {
			echo $this->render(
				'@gallery/partials/activity-post-form-button.twig',
				array(
					'galleriesPresets' => self::$frontendGalleryPresets,
				)
			);
		}
		return true;
	}

	public function viewModalGalleryWindow() {
		$this->getGalleryPresets();
		if(self::$frontendGalleryPresets) {
			if(!self::$isGalleryActivityModalInit) {
				echo $this->render(
					'@gallery/partials/activity-gallery-modal.twig',
					array(
						'galleriesPresets' => self::$frontendGalleryPresets,
					)
				);
				self::$isGalleryActivityModalInit = true;
			}
		}
		return true;
	}

	public function viewContentGalleryTab() {
		echo $this->render('@gallery/partials/backend.main.content.tab.twig', array());
		return true;
	}

	public function viewContentGallerySettings() {

		$settings = $this->getModel('settings', 'membership')->getSettings();
		$pluginsInfo = array(
			'gallery' => $this->getModel('gallery', 'gallery')->getGalleryInfo(),
		);

		echo $this->render('@gallery/partials/backend.main.content.setting.twig', array(
			'settings' => $settings,
			'pluginsInfo' => $pluginsInfo,
		));
		return true;
	}

	public function viewFormPhotoGalleryContainer() {

		$galleryModel = $this->getModel('gallery', 'gallery');
		$galleryInfo = $galleryModel->getGalleryInfo();
		$defaultGalleryImage = $galleryModel->getDefaultGalleryImageUrl();

		if($galleryInfo['isPuliginActive'] == 1) {
			echo $this->render('@gallery/partials/activity-post-form-gallery-container.twig', array(
				'defaultGalleryImage' => $defaultGalleryImage,
			));
		}
		return true;
	}

	public function registerFrontendAsset() {

		$cssArray = array();
		$jsArray = array();

		global $supsysticGallery;
		if($supsysticGallery) {
			$galleryPluginEnvironment = $supsysticGallery->getEnvironment()->getConfig();

			$galleryPlugUrl = $galleryPluginEnvironment->plugin_url;

			//wp-content/plugins/gallery-supsystic/src/GridGallery/Galleries/Module.php
			$freeGalleryPath = $galleryPlugUrl . '/src/GridGallery/Galleries';
			$freeGalleryModuleCss = array(
				$freeGalleryPath . '/assets/css/grid-gallery.galleries.frontend.css',
				$freeGalleryPath . '/assets/css/grid-gallery.galleries.effects.css',
				$freeGalleryPath . '/assets/css/jquery.flex-images.css',
				$freeGalleryPath . '/assets/css/lightSlider.css',
				$freeGalleryPath . '/assets/css/prettyPhoto.css',
				$freeGalleryPath . '/assets/css/photobox.css',
				$freeGalleryPath . '/assets/css/gridgallerypro-embedded.css',
				$freeGalleryPath . '/assets/css/icons-effects.css',
				$freeGalleryPath . '/assets/css/loaders.css',
			);
			$cssArray = array_merge($cssArray, $freeGalleryModuleCss);

			$freeGalleryModuleJs = array(
				'//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js',
				$freeGalleryPath . '/assets/js/lib/imagesLoaded.min.js',
				$freeGalleryPath . '/assets/js/lib/jquery.easing.js',
				$freeGalleryPath . '/assets/js/lib/jquery.prettyphoto.js',
				$freeGalleryPath . '/assets/js/lib/jquery.quicksand.js',
				$freeGalleryPath . '/assets/js/lib/jquery.wookmark.js',
				$freeGalleryPath . '/assets/js/lib/hammer.min.js',
				$freeGalleryPath . '/assets/js/lib/jquery.history.js',
				array(
					'handle' => 'frontend.jquery.slimscroll.js',
					'source' => $freeGalleryPath . '/assets/js/lib/jquery.slimscroll.js',
				),
				$freeGalleryPath . '/assets/js/jquery.photobox.js',
				$freeGalleryPath . '/assets/js/jquery.sliphover.js',
				array(
					'source' => $freeGalleryPath . '/assets/js/frontend.js',
					'dependencies' => array(
						'jquery',
						'hammer.min.js',
						'frontend.jquery.slimscroll.js',
						'imagesLoaded.min.js',
						'jquery.prettyphoto.js',
						'jquery.easing.js',
						'jquery.quicksand.js',
						'jquery.wookmark.js',
						'jquery.photobox.js',
						'jquery.sliphover.js',
						'jquery.colorbox.js',
						'jquery.history.js'
					),
				),
			);
			$jsArray = array_merge($jsArray, $freeGalleryModuleJs);

			//wp-content/plugins/gallery-supsystic/src/GridGallery/Colorbox/Module.php
			$freeColorBoxPath = $galleryPlugUrl . '/src/GridGallery/Colorbox';
			$freeColorBoxModuleJs = array(
				array(
					'handle' => 'jquery.colorbox.js',
					'source' => $freeColorBoxPath,
					'dependencies' => array('jquery'),
					'version' => $galleryPluginEnvironment->get('plugin_version'),
				)
			);
			$jsArray = array_merge($jsArray, $freeColorBoxModuleJs);

			$freeColorBoxModuleCss = array(
				array(
					'handle' => 'colorbox-theme1.css',
					'source' => $freeColorBoxPath .'/jquery-colorbox/themes/theme_1/colorbox.css',
				),
				array(
					'handle' => 'colorbox-theme2.css',
					'source' => $freeColorBoxPath .'/jquery-colorbox/themes/theme_2/colorbox.css',
				),
				array(
					'handle' => 'colorbox-theme3.css',
					'source' => $freeColorBoxPath .'/jquery-colorbox/themes/theme_3/colorbox.css',
				),
				array(
					'handle' => 'colorbox-theme4.css',
					'source' => $freeColorBoxPath .'/jquery-colorbox/themes/theme_4/colorbox.css',
				),
				array(
					'handle' => 'colorbox-theme5.css',
					'source' => $freeColorBoxPath .'/jquery-colorbox/themes/theme_5/colorbox.css',
				),
				array(
					'handle' => 'colorbox-theme7.css',
					'source' => $freeColorBoxPath .'/jquery-colorbox/themes/theme_7/colorbox.css',
				)
			);
			$cssArray = array_merge($cssArray, $freeColorBoxModuleCss);

			if($galleryPluginEnvironment->is_pro) {
				$proGalleryModulePath = $this->prepareUrlFromPath($galleryPluginEnvironment->pro_modules_path) .  '/GridGalleryPro/Galleries';
				// wp-content/plugins/gallery-supsystic/doc/supsystic-gallery-pro/src/GridGalleryPro/Galleries/Module.php
				$proGalleryModuleCss = array(
					'//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css',
				);
				$cssArray = array_merge($cssArray, $proGalleryModuleCss);

				$proGalleryModuleJs = array(array(
					'handle' => 'frontend-pro.js',
					'source' => $proGalleryModulePath . '/js/frontend.js',
				));
				$jsArray = array_merge($jsArray, $proGalleryModuleJs);
			}
		}

		$assetsPath = $this->getAssetsPath();
		$cssArray = array_merge($cssArray, array(
			$assetsPath . '/css/gallery.frontend.css',
		));

		$jsArray = array_merge($jsArray, array(
			$assetsPath . '/js/jquery-ui.min.js',
			$assetsPath . '/js/gallery.frontend.js',
		));

		$this->getModule('assets')->enqueueAssets($cssArray, $jsArray, MBS_FRONTEND);
	}

	public function prepareUrlFromPath($path) {
		$tmpVar = str_replace(rtrim(ABSPATH, '/'), get_bloginfo('wpurl'), $path);
		$url = str_replace('\\', '/', $tmpVar);
		return $url;
	}

	public function registerBackendAsset() {
		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/gallery.backend.css',
			),
			array(
				$assetsPath . '/js/gallery.backend.js',
			),
			MBS_BACKEND
		);
	}
}