<?php
class Membership_Slider_Model_SliderImageAttachment extends Membership_Base_Model_Base {

	public function addImageAttachment($image, $sliderId) {
		$userId = get_current_user_id();
		$image = wp_get_image_editor($image['tmp_name']);

		if (is_wp_error($image)) {
			return $image;
		}

		$settings = $this->getModule('base')->getSettings();
		$maxWidth = $settings['base']['uploads']['max-image-size']['width'];
		$maxHeight = $settings['base']['uploads']['max-image-size']['height'];
		$imageQuality = $settings['base']['uploads']['image-quality'];

		$image->set_quality($imageQuality);
		$size = $image->get_size();

		if ($size['width'] > $maxWidth || $size['height'] > $maxHeight) {
			$image->resize($maxWidth, $maxHeight, false);
			$size = $image->get_size();
		}

		$savePath = $this->generateFilePath('/membership/attachments/', 'jpg', $sliderId, $userId);
		$source = $this->getUploadUrlFromPath($savePath);

		$image->save($savePath, 'image/jpeg');

		$query = $this->preparePrefix("
			INSERT INTO `{prefix}slider_images`
				(`slider_id`, `height`, `width`, `url`)
			VALUES ('%d', '%d', '%d', '%s');
			");

		$this->db->query(
			$this->db->prepare($query, array($sliderId, $size['height'], $size['width'], $source))
		);

		return array(
			'id' => $this->db->insert_id,
			'width' => $size['width'],
			'height' => $size['height'],
			'src' => $source,
		);
	}

	public function deleteImagesFromSlider($sliderId) {

		if($sliderId) {
			$query = $this->preparePrefix("
				SELECT `id`, `url` FROM `{prefix}slider_images`
				WHERE `slider_id` = '%d'
			");
			$images = $this->db->get_results(
				$this->db->prepare($query, array($sliderId)),
				ARRAY_A
			);

			if(count($images)) {
				foreach ($images as $oneImage) {
					$this->removeImageById($oneImage['id'], $oneImage['url']);
				}
			}
		}
		return false;
	}

	public function deleteImageWithAttachment($id) {
		$query = $this->preparePrefix("
			SELECT `id`, `url` FROM `{prefix}slider_images`
			WHERE `id` = '%d'
		");

		$images = $this->db->get_results(
			$this->db->prepare($query, array($id)),
			ARRAY_A
		);

		if(count($images)) {
			$this->removeImageById($id, $images[0]['url']);
		}
	}

	public function removeImageById($id, $imageUrl = null) {
		if($imageUrl) {
			$imageDir = $this->getUploadPathFromUrl($imageUrl);
			if (file_exists($imageDir)) {
				unlink($imageDir);
			}
		}

		$queryRemove = $this->preparePrefix("DELETE FROM `{prefix}slider_images` WHERE `id` = '%d'");
		return $this->db->query($this->db->prepare(
			$queryRemove,
			array($id)
		));
	}

	public function generateFilePath($directory, $ext, $sliderId = '', $urserId = '') {
		$uniqid = preg_replace(
			array('`ad`', '`\.`'),	// Avoid add block false positives
			array('a0', ''),
			uniqid(null, true)
		);
		$fileName = $urserId . '_' . $uniqid . '_sl_' . $sliderId . '.' . $ext;
		$dirname  = $this->getUploadsPath($directory) . implode('/', str_split(substr($fileName, mt_rand(0, 10), 6), 2)) . '/';
		wp_mkdir_p($dirname);
		return $dirname . $fileName;
	}

	public function getUploadsPath($path = null) {
		return $this->getUploadDir('basedir') . $path;
	}
	
	public function getUploadsUrl($path = null) {
		return $this->getUploadDir('baseurl') . $path;
	}

	public function getUploadDir($key = null) {
		$uploadDirData = $this->environment->getConfig()->get('wp_upload_dir');
		if ($key && isset($uploadDirData[$key])) {
			return $uploadDirData[$key];
		}
		return $uploadDirData;
	}

	public function getUploadUrlFromPath($path) {
		return str_replace($this->getUploadsPath(), $this->getUploadsUrl(), $path);
	}

	public function getUploadPathFromUrl($path) {
		return str_replace(
			str_replace(array('https://', 'http://'), '', $this->getUploadsUrl()),
			$this->getUploadsPath(),
			str_replace(array('https://', 'http://'), '', $path)
		);
	}

	public function setImagesPositions(array $imagesArray) {
		if(count($imagesArray)) {

			$indexPos = 0;
			$queryString = '';
			$whereArr = array();
			foreach($imagesArray as $oneImgId) {
				$oneImgId = (int) $oneImgId;
				if($oneImgId) {
					$queryString .= " WHEN `id`='" . $oneImgId . "' THEN '" . $indexPos . "' ";
					$whereArr[] = $oneImgId;
					$queryArray[] = $oneImgId;
					$queryArray[] = $indexPos;
					$indexPos++;
				}
			}
			$queryString = "UPDATE `{prefix}slider_images` SET `position`= CASE " . $queryString;
			$queryString .= " END WHERE `id` IN(" . implode(',', $queryArray) . ")";

			$queryRemove = $this->preparePrefix($queryString);
			return $this->db->query($queryRemove);
		}
		return true;
	}
}