<?php

class Membership_Activity_Twig extends Twig_Extension {

	private $environment;
	private $module;
	private $settings;

	public function __construct($activityModule) {
		$this->environment = $activityModule->getEnvironment();
		$this->module = $activityModule;
		$this->settings = $activityModule->getSettings();
	}

	public function getName() {
		return 'Membership_Activity_Twig';
	}

	public function getGlobals()
	{
		return array();
	}

	public function getFunctions()
	{
		return array(
			new Twig_SimpleFunction('activityImage', array($this, 'activityImage')),
			new Twig_SimpleFunction('activityContent', array($this, 'activityContent')),
            new Twig_SimpleFunction('activityUrl', array($this->module, 'getActivityUrlById')),
            new Twig_SimpleFunction('isPostComment', array($this->module, 'isPostComment')),
			new Twig_SimpleFunction('getActivityUrl', array($this, 'getActivityUrl')),
			new Twig_SimpleFunction('getSocShareProject', array($this, 'getSocShareProject')),
		);
	}

	public function getEnvironment() {
		return $this->environment;
	}

	public function activityImage($images, $size = 'large') {

		$source = '';
		$totalSize = 0;

		switch ($size) {
			case 'large':
				foreach ($images as $image) {
					$imageSize = $image['width'] + $image['height'];
					if ($imageSize > $totalSize) {
						$totalSize = $imageSize;
						$source = $image['source'];
					}
				}
				return $source;
			case 'small':
				foreach ($images as $image) {
					$imageSize = $image['width'] + $image['height'];
					if ($imageSize < $totalSize || $totalSize === 0) {
						$totalSize = $imageSize;
						$source = $image['source'];
					}
				}
				return $source;
		}

	}

	public function activityContent($activity) {
		// linkify
		$activity['data'] = preg_replace('|(\bhttps?:\/\/(?:(?!&[^;]+;)[^\s"\'<>)])+)|','<a href=\'$1\'>$1</a>',$activity['data']);

		$activity['data'] = htmlspecialchars($activity['data']);

		//restore links
		$activity['data'] = preg_replace('|&lt;(a\s+href=.*?)&gt;(.*?)&lt;\/a&gt;|','<$1>$2</a>',$activity['data']);

		$activity['data'] = preg_replace_callback('/(?:^|\s)(#[a-z\d-]+)/m', array($this, 'activityTagsReplace'), $activity['data']);

		$galleryModule = $this->environment->getModule('gallery');
		$galleryModel = $galleryModule->getModel('gallery', 'gallery');
		$galleryPluginEnable = $galleryModel->isPluginActive();

		if($galleryPluginEnable) {
			$galleryAttachmentModel = $galleryModule->getModel('GalleryAttachment', 'gallery');
			global $supsysticGallery;
			if($supsysticGallery) {
				$galleryPluginEnvironment = $supsysticGallery->getEnvironment();
				$isGalleryReplaced = 0;
				$activity['data'] = $galleryAttachmentModel->replaceImagesToPhotoGalleryHtml($activity, $galleryPluginEnvironment, $isGalleryReplaced);
			}
		}
		
		$sliderModule = $this->environment->getModule('slider');
		$sliderModel = $sliderModule->getModel('slider', 'slider');
		$sliderPluginEnable = $sliderModel->isPluginActive();

		if($sliderPluginEnable) {
			$sliderAttachmentModel = $sliderModule->getModel('SliderAttachment', 'slider');
			global $supsysticSlider;
			if($supsysticSlider) {
				$sliderPluginEnvironment = $supsysticSlider->getEnvironment();
				$activity['data'] = $sliderAttachmentModel->replaceImagesToSliderHtml($activity, $sliderPluginEnvironment);
			}
		}

		$googleMapsEasyModule = $this->environment->getModule('GoogleMapsEasy');
		$googleMapsModel = $googleMapsEasyModule->getModel('GoogleMaps');
		$gmePluginEnabled = $googleMapsModel->isPluginActive();
		if($gmePluginEnabled) {
			$googleMapsEasyModel = $googleMapsEasyModule->getModel('GoogleMapsEasy');
			$activity['data'] = $googleMapsEasyModel->replateImageCodeToHtml($activity, $googleMapsModel->getGoogleMapsEasyIconList());
		}
		return convert_smilies($activity['data']);
	}

	private function activityTagsReplace($matches) {
		$url = $this->environment->getModule('routes')->getRouteUrl('search', array('q' => urlencode($matches[1]), 'type' => 'hash'));
		return ' <a href="' . $url . '">' . $matches[1] . '</a>';
	}

	public function getActivityUrl($id) {
		$activityUrl = '';
		$routesModule = $this->module->getModule('routes');
		$pageId = $routesModule->getPageIdByRoute('activity');

		if($pageId) {
			$activityUrl = $routesModule->getRouteUrl('activity');

			$permalinkStructure = get_option('permalink_structure');
			if($permalinkStructure) {
				if(substr($permalinkStructure, -1) !== '/') {
					$activityUrl .= '/';
				}
				$activityUrl .= $id;
			} else {
				$activityUrl .= '&activity_id=' . $id;
			}
		}
		return $activityUrl;
	}

	/**
	 * @param $params: projectId, url, activityType
	 * @return null|string
	 */
	public function getSocShareProject($params) {
		if(empty($params['projectId']) && empty('url')) {
			return null;
		}

		$params['projectId'] = (int) $params['projectId'];
		if(!$params['projectId']) {
			return null;
		}
		do_action('sss_membership_html', $params);
	}
}