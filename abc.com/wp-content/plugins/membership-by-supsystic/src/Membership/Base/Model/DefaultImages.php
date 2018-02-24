<?php

class Membership_Base_Model_DefaultImages extends Membership_Base_Model_Images {

	/**
	 * Recreates thumbnail sizes of source image
	 * @param string $type Type of default image (avatar, logo, cover) that are set in template.
	 * @param array $thumbnailSizes
	 * @param array $newSettings
	 * @param array $oldSettings
	 * @param array $defaultSettings
	 *
	 * @return array $newSettings
	 */
	public function recreateDefaultImageByType($type, array $thumbnailSizes, array $newSettings, array $oldSettings, array $defaultSettings) {

		$sourceImage = !empty($newSettings["default-{$type}-source"]) ?
			$newSettings["default-{$type}-source"] : false;

		if (!$sourceImage) {
			return $newSettings;
		}

		$sourceImageUploadPath = $this->getUploadPathFromUrl($sourceImage);

		// If source image is set to default image
		if ($sourceImage == $defaultSettings["default-{$type}"]) {
			$config = $this->environment->getConfig();
			$pluginPath = $config->get('plugin_path');
			$pluginFolderUrl = plugin_dir_url($config->get('plugin_basename'), realpath($pluginPath));
			$sourceImageUploadPath = str_replace($pluginFolderUrl, realpath($pluginPath) . '/', $sourceImage);
			$newSettings["default-{$type}-crop-data"] = '';
		}

		if ($oldSettings["{$type}-size"]["width"] !== $newSettings["{$type}-size"]["width"]
		    || $oldSettings["{$type}-size"]["height"] !== $newSettings["{$type}-size"]["height"]
		    || empty($oldSettings["default-{$type}-source"])
		    || $oldSettings["default-{$type}-source"] !== $newSettings["default-{$type}-source"]
			|| $oldSettings["default-{$type}-crop-data"] !== $newSettings["default-{$type}-crop-data"]
			|| $oldSettings["default-{$type}"] !== $newSettings["default-{$type}"]
		) {
			// Remove images only if path contains membership images folder
			if (strpos($newSettings["default-{$type}"], '/membership/images/') !== false) {
				$this->cleanImageFromPath($this->getUploadPathFromUrl($newSettings["default-{$type}"]));
			}

			if (empty($newSettings["default-{$type}-crop-data"])) {

				$resizedImage = $this->resizeImageFromPath(
					$sourceImageUploadPath,
					$newSettings["{$type}-size"]["width"],
					$newSettings["{$type}-size"]["height"],
					true
				);

				if (is_wp_error($resizedImage)) {
					$newSettings["default-{$type}"] = $defaultSettings["default-{$type}"];
				} else {
					$newSettings["default-{$type}"] = $resizedImage['source'];
				}

			} else {
				$cropData = json_decode($newSettings["default-{$type}-crop-data"], true);

				$croppedImage = $this->cropImageFromPath(
					$sourceImageUploadPath,
					$cropData,
					$newSettings["{$type}-size"]["width"],
					$newSettings["{$type}-size"]["height"]
				);
				if (is_wp_error($croppedImage)) {
					$newSettings["default-{$type}"] = $defaultSettings["default-{$type}"];
				} else {
					$newSettings["default-{$type}"] = $this->getUploadUrlFromPath($croppedImage);
				}
			}

		};

		foreach ($thumbnailSizes as $size) {
			if (isset($newSettings["{$type}-{$size}-size"])) {
				if ($oldSettings["{$type}-{$size}-size"]["width"] !== $newSettings["{$type}-{$size}-size"]["width"]
				    || $oldSettings["{$type}-{$size}-size"]["height"] !== $newSettings["{$type}-{$size}-size"]["height"]
				    || empty($oldSettings["default-{$type}-source"])
				    || $oldSettings["default-{$type}-source"] !== $newSettings["default-{$type}-source"]
				    || $oldSettings["default-{$type}-crop-data"] !== $newSettings["default-{$type}-crop-data"]
				    || $oldSettings["default-{$type}-{$size}"] !== $newSettings["default-{$type}-{$size}"]
				) {

					if (strpos($newSettings["default-{$type}-{$size}"], '/membership/images/') !== false) {
						$this->cleanImageFromPath($this->getUploadPathFromUrl($newSettings["default-{$type}-{$size}"]));
					}

					if (empty($newSettings["default-{$type}-crop-data"])) {

						$resizedImage = $this->resizeImageFromPath(
							$sourceImageUploadPath,
							$newSettings["{$type}-{$size}-size"]["width"],
							$newSettings["{$type}-{$size}-size"]["height"],
							true
						);

						if (is_wp_error($resizedImage)) {
							$newSettings["default-{$type}-{$size}"] = $defaultSettings["default-{$type}"];
						} else {
							$newSettings["default-{$type}-{$size}"] = $resizedImage['source'];
						}

					} else {

						$cropData = json_decode($newSettings["default-{$type}-crop-data"], true);

						$scaledCropData = $this->getScaledCropData($cropData, array(
							'width' => $newSettings["{$type}-{$size}-size"]["width"],
							'height' => $newSettings["{$type}-{$size}-size"]["height"]
						));

						$croppedImage = $this->cropImageFromPath(
							$sourceImageUploadPath,
							$scaledCropData,
							$newSettings["{$type}-{$size}-size"]["width"],
							$newSettings["{$type}-{$size}-size"]["height"]
						);

						if (is_wp_error($croppedImage)) {
							$newSettings["default-{$type}-{$size}"] = $defaultSettings["default-{$type}"];
						} else {
							$newSettings["default-{$type}-{$size}"] = $this->getUploadUrlFromPath($croppedImage);
						}
					}
				}
			}
		}

		return $newSettings;
	}
}