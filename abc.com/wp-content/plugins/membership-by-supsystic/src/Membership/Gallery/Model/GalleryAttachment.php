<?php
class Membership_Gallery_Model_GalleryAttachment extends Membership_Base_Model_Base {

	public function canUserWorkWithGallery($galleryId) {
		// check add/remove actions
		$userId = get_current_user_id();

		$query = $this->preparePrefix("
			SELECT `user_id` FROM `{prefix}photo_gallery`
			WHERE `id` = '%d'
		");

		$galleries = $this->db->get_col(
			$this->db->prepare($query, array($galleryId))
		);

		if(count($galleries[0] == $userId)) {
			if(isset($galleries[0]) && $galleries[0] == $userId) {
				return true;
			} else {
				return false;
			}
		}
		return null;
	}

	public function addGallery($photoGalleryId) {
		$userId = get_current_user_id();
		$this->cleanUnused($userId);

		$query = $this->preparePrefix("
			INSERT INTO `{prefix}photo_gallery`
				(`gallery_preset_id`, `user_id`)
			VALUES ('%d', '%d');
		");

		$this->db->query(
			$this->db->prepare($query, array($photoGalleryId, $userId))
		);

		return $this->db->insert_id;
	}

	public function cleanUnused($userId) {

		// get galleries by condition
		$query = $this->preparePrefix("
			SELECT `id` FROM `{prefix}photo_gallery`
			WHERE `date_create` <= (NOW() - INTERVAL 1 DAY)
			AND `user_id` = '%d'
			AND `post_id` IS NULL
		");

		$galleries = $this->db->get_col(
			$this->db->prepare($query, array($userId))
		);

		$this->removeGalleriesWithImages($galleries);
	}

	public function removeGalleryByPostId($postId) {
		$postId = (int) $postId;
		if($postId) {
			$query = $this->preparePrefix("SELECT `id` FROM `{prefix}photo_gallery`
				WHERE `post_id` ='%d'");

			$galleries = $this->db->get_col(
				$this->db->prepare($query, array($postId))
			);

			$this->removeGalleriesWithImages($galleries);
		}
	}

	public function removeGalleriesWithImages(array $galleriesIds) {

		if(count($galleriesIds)) {
			$galleryImageModel = $this->getModel('GalleryImageAttachment', 'gallery');
			foreach($galleriesIds as $galleryId) {
				// remove images from gallery
				$galleryImageModel->deleteImagesFromGallery($galleryId);
				// remove gallery
				$this->removeGalleryById($galleryId);
			}
		}
	}
	
	public function removeGalleryById($id) {
		$queryRemove = $this->preparePrefix("DELETE FROM `{prefix}photo_gallery` WHERE id = '%d'");
		$this->db->query($this->db->prepare(
			$queryRemove,
			array($id)
		));
	}

	public function updatePostsFieldInGalleries(array $galleryList, $postId) {

		if(count($galleryList)) {
			foreach($galleryList as $ggIndex) {
				$queryRemove = $this->preparePrefix("UPDATE `{prefix}photo_gallery` SET `post_id`='%d' WHERE id = '%d'");
				$this->db->query($this->db->prepare(
					$queryRemove,
					array($postId, $ggIndex)
				));
			}
		}
		return true;
	}

	public function getGalleryImagesBy($postId, $userId) {

		$galleryImages = array();

		$query = $this->preparePrefix("
				SELECT pg.`id`, pg.`position`, pg.`gallery_preset_id`, pgi.`height`, pgi.`width`, pgi.`url`
				FROM `{prefix}photo_gallery` pg
				
				LEFT JOIN `{prefix}photo_gallery_images` pgi
					ON pg.`id` = pgi.`photo_gallery_id`
					
				WHERE pg.`post_id` = '%d'
				AND pg.`user_id` = '%d'
				ORDER BY pg.`position`, pgi.`position`
			");
		$resultGalleries = $this->db->get_results(
			$this->db->prepare($query, array($postId, $userId)),
			ARRAY_A
		);

		if(count($resultGalleries)) {
			foreach($resultGalleries as $oneGallery) {
				$galleryImages[$oneGallery['position'] == null ? 0 : $oneGallery['position']][] = $oneGallery;
			}
		}

		return $galleryImages;
	}

	public function replaceImagesToPhotoGalleryHtml($activity, $galleryPluginEnvironment, &$isGalleryReplaced = 0) {
		$galleryStrPos = strpos($activity['data'], htmlspecialchars('class="mbs-gg-unique-class"'));
		if($galleryStrPos !== false) {
			$pattern = htmlspecialchars('`\<img data-gallery-id="([\d]+)" class="mbs-gg-unique-class"\/\>`');
			$findGalleryRes = preg_match_all($pattern, $activity['data'], $galleryMatches);

			if($findGalleryRes && count($galleryMatches) > 1 && count($galleryMatches[1]) > 0) {
				$galleriesArr = $this->getGalleryImagesBy($activity['id'], $activity['user_id']);
				if(count($galleriesArr)) {

					foreach($galleriesArr as $presetGalleryId => $oneGalleryInfo) {
						$galleryStr = '';
						if(count($oneGalleryInfo) == 1 && $oneGalleryInfo[0]['url'] == null) {
							// empty result - gallery without images
						} else if(count($oneGalleryInfo)) {

							//gallery_preset_id
							$galleryAttributes = array();
							$galleryAttributes['id'] = $oneGalleryInfo[0]['gallery_preset_id'];
							$galleryAttributes['plugin-info'] = 'Membership-by-Supsystic';
							$galleryAttributes['image-list'] = $oneGalleryInfo;
							$galleryAttributes['mm-gallery-id'] = $oneGalleryInfo[0]['id'];
							// get gallery string
							$galleryStr = $galleryPluginEnvironment->getModule('galleries')->getGallery($galleryAttributes);
							$isGalleryReplaced = true;
						}

						$pattern = htmlspecialchars('`\<img data-gallery-id="' . $oneGalleryInfo[0]['id'] . '" class="mbs-gg-unique-class"\/\>`');
						// replase image code on photo gallery entry
						$activity['data'] = preg_replace($pattern, $galleryStr, $activity['data']);
					}
				}
			}
		}
		return $activity['data'];
	}

	public function setGalleriesPosition(array $imagesArray) {
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
			$queryString = "UPDATE `{prefix}photo_gallery` SET `position`= CASE " . $queryString;
			$queryString .= " END WHERE `id` IN(" . implode(',', $queryArray) . ")";

			$queryRemove = $this->preparePrefix($queryString);
			return $this->db->query($queryRemove);
		}
		return true;
	}
}