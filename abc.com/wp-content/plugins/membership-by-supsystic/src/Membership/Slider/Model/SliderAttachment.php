<?php
class Membership_Slider_Model_SliderAttachment extends Membership_Base_Model_Base {

	public function canUserWorkWithSlider($sliderId) {
		// check add/remove actions
		$userId = get_current_user_id();

		$query = $this->preparePrefix("
			SELECT `user_id` FROM `{prefix}slider`
			WHERE `id` = '%d'
		");

		$sliders = $this->db->get_col(
			$this->db->prepare($query, array($sliderId))
		);

		if(count($sliders[0] == $userId)) {
			if(isset($sliders[0]) && $sliders[0] == $userId) {
				return true;
			} else {
				return false;
			}
		}
		return null;
	}

	public function addSlider($pluginSliderId) {
		$userId = get_current_user_id();
		$this->cleanUnused($userId);

		$query = $this->preparePrefix("
			INSERT INTO `{prefix}slider`
				(`slider_preset_id`, `user_id`)
			VALUES ('%d', '%d');
		");

		$this->db->query(
			$this->db->prepare($query, array($pluginSliderId, $userId))
		);

		return $this->db->insert_id;
	}

	public function cleanUnused($userId) {

		// get sliders by condition
		$query = $this->preparePrefix("
			SELECT `id` FROM `{prefix}slider`
			WHERE `date_create` <= (NOW() - INTERVAL 1 DAY)
			AND `user_id` = '%d'
			AND `post_id` IS NULL
		");

		$sliders = $this->db->get_col(
			$this->db->prepare($query, array($userId))
		);

		$this->removeSlidersWithImages($sliders);
	}

	public function removeSliderByPostId($postId) {
		$postId = (int) $postId;
		if($postId) {
			$query = $this->preparePrefix("SELECT `id` FROM `{prefix}slider`
				WHERE `post_id` ='%d'");

			$sliders = $this->db->get_col(
				$this->db->prepare($query, array($postId))
			);

			$this->removeSlidersWithImages($sliders);
		}
	}

	public function removeSlidersWithImages(array $sliderIds) {

		if(count($sliderIds)) {
			$sliderImageModel = $this->getModel('SliderImageAttachment', 'slider');
			foreach($sliderIds as $sliderId) {
				// remove images from slider
				$sliderImageModel->deleteImagesFromSlider($sliderId);
				// remove slider
				$this->removeSliderById($sliderId);
			}
		}
	}

	public function removeSliderById($id) {
		$queryRemove = $this->preparePrefix("DELETE FROM `{prefix}slider` WHERE id = '%d'");
		$this->db->query($this->db->prepare(
			$queryRemove,
			array($id)
		));
	}

	public function updatePostsFieldInSliders(array $sliderList, $postId) {

		if(count($sliderList)) {
			foreach($sliderList as $rsIndex) {
				$queryRemove = $this->preparePrefix("UPDATE `{prefix}slider` SET `post_id`='%d' WHERE id = '%d'");
				$this->db->query($this->db->prepare(
					$queryRemove,
					array($postId, $rsIndex)
				));
			}
		}
		return true;
	}

	public function getSliderImagesBy($postId, $userId) {
		$sliderImages = array();

		$query = $this->preparePrefix("
				SELECT s.`id`, s.`position`, s.`slider_preset_id`, si.`height`, si.`width`, si.`url`
				FROM `{prefix}slider` s
				
				LEFT JOIN `{prefix}slider_images` si
					ON s.`id` = si.`slider_id`
					
				WHERE s.`post_id` = '%d'
				AND s.`user_id` = '%d'
				ORDER BY s.`position`, si.`position`
			");

		$resultSliders = $this->db->get_results(
			$this->db->prepare($query, array($postId, $userId)),
			ARRAY_A
		);

		if(count($resultSliders)) {
			foreach($resultSliders as $oneSlider) {
				$sliderImages[$oneSlider['position'] == null ? 0 : $oneSlider['position']][] = $oneSlider;
			}
		}

		return $sliderImages;
	}

	public function replaceImagesToSliderHtml($activity, $sliderPluginEnvironment) {
		$sliderStrPos = strpos($activity['data'], htmlspecialchars('class="mbs-rs-unique-class"'));
		if($sliderStrPos !== false) {
			$pattern = htmlspecialchars('`\<img data-slider-id="([\d]+)" class="mbs-rs-unique-class"\/\>`');
			$findSliderRes = preg_match_all($pattern, $activity['data'], $sliderMatches);

			if($findSliderRes && count($sliderMatches) > 1 && count($sliderMatches[1]) > 0) {
				$sliderArr = $this->getSliderImagesBy($activity['id'], $activity['user_id']);
				if(count($sliderArr)) {

					foreach($sliderArr as $presetSliderId => $oneSliderInfo) {
						$sliderStr = '';
						if(count($oneSliderInfo) == 1 && $oneSliderInfo[0]['url'] == null) {
							// empty result - slider without images
						} else if(count($oneSliderInfo)) {

							// slider_preset_id
							$sliderAttributes = array();
							$sliderAttributes['id'] = $oneSliderInfo[0]['slider_preset_id'];
							$sliderAttributes['integration-id'] = $oneSliderInfo[0]['id'];
							$sliderAttributes['plugin-info'] = 'Membership-by-Supsystic';
							$sliderAttributes['image-list'] = $oneSliderInfo;

							// get slider string
							$sliderStr = $sliderPluginEnvironment->getModule('slider')->render($sliderAttributes);
						}

						$pattern = htmlspecialchars('`\<img data-slider-id="' . $oneSliderInfo[0]['id'] . '" class="mbs-rs-unique-class"\/\>`');
						// replase image code on photo slider entry
						$activity['data'] = preg_replace($pattern, $sliderStr, $activity['data']);
					}
				}
			}
		}
		return $activity['data'];
	}

	public function setSliderPosition(array $imagesArray) {
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
			$queryString = "UPDATE `{prefix}slider` SET `position`= CASE " . $queryString;
			$queryString .= " END WHERE `id` IN(" . implode(',', $queryArray) . ")";

			$queryRemove = $this->preparePrefix($queryString);
			return $this->db->query($queryRemove);
		}
		return true;
	}
}