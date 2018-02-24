<?php
class Membership_Messages_Model_MessageAttachments extends Membership_Base_Model_Base {

	public function getTable($tableName = NULL) {
		return $this->getPrefix() . 'messages_attachments';
	}

	/**
	 * @param $params
	 */
	public function saveAttachmentForMessage($params) {
		if(empty($params['attachment_all_id']) || !is_array($params['attachment_all_id']) || empty($params['message_id'])) {
			return false;
		}

		foreach($params['attachment_all_id'] as $oneAttAllId) {
			$attachmentId = (int) $oneAttAllId;
			if($attachmentId) {
				// insert_into messageAttachments
				$this->db->insert($this->getTable(), array(
					'message_id' => (int) $params['message_id'],
					'attachment_all_id' => $attachmentId,
				));

				// update attachemnt_all
				$this->db->update($this->getPrefix() . 'attachments_all', array(
					'is_saved' => '1',
				), array(
					'id' => $attachmentId,
				));
			}
		}
		return true;
	}

	public function getAttachmentInfo(array $ids) {
		$resList = array();
		if(count($ids)) {
			$querySel = "SELECT ma.attachment_all_id, ma.message_id, ata.source AS url, att.code AS attachment_code
			FROM " . $this->getPrefix() . "messages_attachments ma
			INNER JOIN " . $this->getPrefix() . "attachments_all ata
				ON ata.id = ma.attachment_all_id
			LEFT JOIN " . $this->getPrefix() . "attachment_type att
				ON att.id = ata.type	
			WHERE ma.message_id IN (". implode(',', $ids) . ")";

			$resList = $this->db->get_results($querySel, ARRAY_A);
		}
		return $resList;
	}

	public function addAttachmentToMessageArray(&$messages) {
		$attachmentArr = array();
		if(is_array($messages) && count($messages)) {
			$messageIds = array();
			// get messages Ids
			foreach($messages as $oneKey => $oneMessage) {
				$messageIds[$oneKey] = (int) $oneMessage['id'];
			}

			$attachmentList = $this->getAttachmentInfo($messageIds);
			// prepare associative attachmentList
			$resultAttachmentList = array();
			if(count($attachmentList)) {
				foreach($attachmentList as $oneAttElem) {
					$sourceArr = explode('|||', $oneAttElem['url']);
					$fileNameArr = array();
					if(is_array($sourceArr) && !empty($sourceArr)) {
						if(count($sourceArr) == 1) {
							$fileNameArr['url'] = $sourceArr[0];
						} else {
							$fileNameArr['name'] = $sourceArr[0];
							$fileNameArr['url'] = $sourceArr[1];
						}
					}
					$oneAttElem['file_info'] = $fileNameArr;
					$oneAttElem['is_image'] = (strpos($oneAttElem['attachment_code'], 'image/') !== false);
					// remove incorrect source value
					unset($oneAttElem['url']);
					$resultAttachmentList[$oneAttElem['message_id']][$oneAttElem['attachment_all_id']] = $oneAttElem;
				}
			}
			// save result to message array
			foreach($messages as &$resMessage) {
				$messageId = $resMessage['id'];
				if(isset($resultAttachmentList[$messageId])) {
					$resMessage['attachments'] = $resultAttachmentList[$messageId];
				}
			}
		}
		return true;
	}
}