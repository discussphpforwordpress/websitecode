<?php
class Membership_Googlemapseasy_Model_GoogleMapsEasy extends Membership_Base_Model_Base {
	private $table;
	public $msg = array();

	public function __construct($environment) {
		parent::__construct($environment);
		$this->table = '{prefix}google_maps_easy';

		$this->msg['warn_access_denided'] = $this->translate('Access is denied');
		$this->msg['msg_you_can_not_delete_map'] = $this->translate('You can not delete this map');
		$this->msg['err_add_map_to_db'] = $this->translate('Error when adding a Google Map to the database');
		$this->msg['msg_maps_params_saved_successfully'] = $this->translate('Maps params was saved success');
	}

	public function getMessageByCode($code) {
		if(isset($this->msg[$code])) {
			return $this->msg[$code];
		}
		return null;
	}

	public function setPreviewPosition(array $imagesArray) {

		if(count($imagesArray)) {
			$indexPos = 0;
			$queryString = '';
			$whereArr = array();
			foreach($imagesArray as $oneImgId) {
				$oneImgId = (int) $oneImgId;
				if($oneImgId) {
					$queryString .= " WHEN `id`='" . $oneImgId . "' THEN '" . $indexPos . "' ";
					$whereArr[] = (int) $oneImgId;
					$queryArray[] = (int) $oneImgId;
					// $queryArray[] = $indexPos;
					$indexPos++;
				}
			}
			$queryString = "UPDATE `" . $this->table . "` SET `position`= CASE " . $queryString;
			$queryString .= " END WHERE `id` IN(" . implode(',', $queryArray) . ")";
			$querySort = $this->preparePrefix($queryString);
			return $this->db->query($querySort);
		}
		return false;
	}

	public function canUserWorkWithIds(array $googleMapsIds) {
		if(is_array($googleMapsIds)) {
			$userId = get_current_user_id();

			$query = $this->preparePrefix("
				SELECT `user_id` FROM `" . $this->table . "`
				WHERE `id` in(" . implode(',', $googleMapsIds) . ")
			");
			$gMaps = $this->db->get_col($query);
			if(count($gMaps)) {
				$userAccess = true;
				foreach($gMaps as $oneMap) {
					if($oneMap != $userId) {
						$userAccess = false;
					}
				}
				return $userAccess;
			}
		}
		return false;
	}

	public function cleanUnused($userId) {
		// get by condition
		$query = $this->preparePrefix("
			SELECT `id` FROM `" . $this->table . "`
			WHERE `date_create` <= (NOW() - INTERVAL 1 DAY)
			AND `user_id` = '%d'
			AND `post_id` IS NULL
		");
		$maps = $this->db->get_col(
			$this->db->prepare($query, array($userId))
		);
		$this->removeMap($maps);
	}

	public function prepareMapIds(array $mapIds) {
		$newMapIds = array();
		if(count($mapIds)) {

			foreach($mapIds as $oneMapId) {
				$newMapIds[] = (int)$oneMapId;
			}
		}
		return $newMapIds;
	}

	public function removeMap(array $mapIds) {
		if(count($mapIds)) {
			$queryRemove = $this->preparePrefix("DELETE FROM `" . $this->table . "` WHERE id in(" . implode(',', $mapIds) . ")");
			return $this->db->query($queryRemove);
		}
		return false;
	}

	public function createMap($presetId) {
		$presetId = (int) $presetId;
		$userId = get_current_user_id();
		$this->cleanUnused($userId);
		
		$query = $this->preparePrefix("
			INSERT INTO `" . $this->table . "`
				(`maps_preset_id`, `user_id`)
				VALUES ('%d', '%d');
			");
		$this->db->query(
			$this->db->prepare($query, array($presetId, $userId))
		);
		return $this->db->insert_id;
	}

	public function updateDataValue($mapId, array $data) {
		$mapId = (int) $mapId;
		if(count($data) && $mapId) {
			$query = $this->preparePrefix("UPDATE " . $this->table . "
				SET `data` = %s
				WHERE `id` = %d;
			");
			return $this->query(
				$this->db->prepare($query, array(json_encode($data), $mapId))
			);
		}
		return false;
	}

	public function updatePostFieldFor($postData, $activityId) {
		if(count($postData)) {
			foreach($postData as $gmeId) {
				$queryUpdate = $this->preparePrefix(
					$this->db->prepare(
						"UPDATE `" . $this->table . "` SET `post_id`='%d' WHERE id = '%d'",
						array($activityId, $gmeId)
					)
				);
				$this->db->query($queryUpdate);
			}
		}
		return true;
	}

	public function removeMapByPostId($postId) {
		$postId = (int) $postId;
		if($postId) {
			$query = $this->preparePrefix("SELECT `id` FROM `" . $this->table . "` WHERE `post_id` ='%d'");
			$maps = $this->db->get_col(
				$this->db->prepare($query, array($postId))
			);
			if(count($maps)) {
				foreach($maps as $idValue) {
					$this->removeMapById($idValue);
				}
			}
		}
	}

	public function removeMapById($id) {
		$queryRemove = $this->preparePrefix("DELETE FROM `" . $this->table . "` WHERE id = '%d'");
		$this->db->query($this->db->prepare(
			$queryRemove,
			array($id)
		));
	}

	public function getMapsBy($postId, $userId) {
		$query = $this->preparePrefix("
			SELECT `id`, `maps_preset_id`, `data`
			FROM `" . $this->table . "`
			WHERE `user_id` = '%d'
			AND `post_id` = '%d'
			ORDER BY `position`
		");
		$maps = $this->db->get_results(
			$this->db->prepare($query, array(
				(int) $userId,
				(int) $postId,
			)), ARRAY_A
		);
		return $maps;
	}

	public function replateImageCodeToHtml($activity, $gmeIconsList) {
		$gmePos = strpos($activity['data'], htmlspecialchars('class="mbs-gme-unique-class"'));

		if($gmePos !== false) {
			$pattern = htmlspecialchars('`\<img data-google-maps-easy-id="([\d]+)" class="mbs-gme-unique-class"\/\>`');
			$findGmeRes = preg_match_all($pattern, $activity['data'], $gmeMatches);

			if($findGmeRes && count($gmeMatches) > 1 && count($gmeMatches[1]) > 0) {
				$mapsArr = $this->getMapsBy($activity['id'], $activity['user_id']);
				if(count($mapsArr)) {
					$gmePlugin = frameGmp::getInstance();
					$gmapModule = $gmePlugin->getModule('gmap');

					foreach($mapsArr as $presetMapId => $oneMapInfo) {
						$mapsStr = '';
						if(isset($oneMapInfo['id']) && isset($oneMapInfo['maps_preset_id']) && isset($oneMapInfo['data'])) {

							$mapAttributes = array();
							$mapAttributes['id'] = $oneMapInfo['maps_preset_id'];
							$mapAttributes['plugin-info'] = 'Membership-by-Supsystic';
							$mapAttributes['membership-id'] = $oneMapInfo['id'];
							$mapAttributes['membership-params'] = json_decode($oneMapInfo['data'], true);
							$mapAttributes['iconsList'] = $gmeIconsList;
							$mapsStr = $gmapModule->drawMapFromShortcode($mapAttributes);
						}
						$pattern = htmlspecialchars('`\<img data-google-maps-easy-id="' . $oneMapInfo['id'] . '" class="mbs-gme-unique-class"\/\>`');
						// replace image code on map entry
						$activity['data'] = preg_replace($pattern, $mapsStr, $activity['data']);
					}
				}
			}
		}
		return $activity['data'];
	}
}
