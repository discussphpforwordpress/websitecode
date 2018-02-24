<?php
class Membership_Googlemapseasy_Controller extends Membership_Base_Controller {
	
	public function setPreviewPosition(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$successRes = false;
		$resMessage = null;
		$gmpArray = $parameters->get('gmaps_array');

		$googleMapsEasytModel = $this->getModel('GoogleMapsEasy');
		$newMapIds = $googleMapsEasytModel->prepareMapIds($gmpArray);
		$hasAccess = $googleMapsEasytModel->canUserWorkWithIds($newMapIds);
		if($hasAccess) {
			$res = $googleMapsEasytModel->setPreviewPosition($newMapIds);
			if($res !== false) {
				$successRes = true;
			}
		} else {
			$resMessage = $googleMapsEasytModel->getMessageByCode('warn_access_denided') . '. ' . $googleMapsEasytModel->getMessageByCode('msg_you_can_not_delete_map');
		}

		return $this->response(
			'ajax',
			array(
				'success' => $successRes,
				'message' => $resMessage,
			)
		);
	}

	public function removeMap(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$successRes = false;
		$resMessage = null;
		
		$mapIdParam = $parameters->get('map_id');
		$googleMapsEasytModel = $this->getModel('GoogleMapsEasy');
		$newMapIds = $googleMapsEasytModel->prepareMapIds(array($mapIdParam));
		$hasAccess = $googleMapsEasytModel->canUserWorkWithIds($newMapIds);
		if($hasAccess) {
			$res = $googleMapsEasytModel->removeMap($newMapIds);
			if($res !== false) {
				$successRes = true;
			}
		} else {
			$resMessage = $googleMapsEasytModel->getMessageByCode('warn_access_denided') . '. ' . $googleMapsEasytModel->getMessageByCode('msg_you_can_not_delete_map');
		}

		return $this->response(
			'ajax',
			array(
				'success' => $successRes,
				'message' => $resMessage,
			)
		);
	}

	public function createMap(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$successRes = false;
		$resMessage = null;
		$mapId = null;

		$presetId = $parameters->get('preset_id');
		$googleMapsEasytModel = $this->getModel('GoogleMapsEasy');
		$newMapId = $googleMapsEasytModel->createMap($presetId);

		if(!$newMapId) {
			$resMessage = $googleMapsEasytModel->getMessageByCode('err_add_map_to_db');
		} else {
			$successRes = true;
		}
		return $this->response(
			'ajax',
			array(
				'success' => $successRes,
				'message' => $resMessage,
				'mapId' => $newMapId,
			)
		);
	}

	public function saveMapParams(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$successRes = false;
		$resMessage = null;
		$mapParams = $parameters->get('map_info');
		$mapId = $parameters->get('mapId');

		$googleMapsEasytModel = $this->getModel('GoogleMapsEasy');
		$hasAccess = $googleMapsEasytModel->canUserWorkWithIds(array($mapId));
		if($hasAccess) {
			$googleMapsEasytModel->updateDataValue($mapId, $mapParams);
			$successRes = true;
			$resMessage = $googleMapsEasytModel->getMessageByCode('msg_maps_params_saved_successfully');
		} else {
			$resMessage = $googleMapsEasytModel->getMessageByCode('warn_access_denided') . '.';
		}
		return $this->response(
			'ajax',
			array(
				'success' => $successRes,
				'message' => $resMessage,
			)
		);
	}
}


