<?php

class Membership_Base_Model_AttachmentType extends Membership_Base_Model_Base {

	public function getTable($tableName = NULL) {
		return $this->getPrefix() . 'attachment_type';
	}

	public function getIdAndInsertIfNotExists($typeStr) {
		if(strlen($typeStr) > 128) {
			$typeStr = substr($typeStr, 0, 128);
		}
		$querySel = "SELECT id FROM " . $this->getTable() . " WHERE " . $this->db->prepare("code =%s", array($typeStr));
		$typeId = false;

		$resSelect = $this->db->get_results($querySel, ARRAY_A);
		if(!empty($resSelect[0]['id'])) {
			$typeId = $resSelect[0]['id'];
		} else {
			$insertRes = $this->db->insert($this->getTable(), array('code' => $typeStr));
			if($insertRes) {
				$typeId = $this->db->insert_id;
			}
		}
		return $typeId;
	}
}