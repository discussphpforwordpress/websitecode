<?php
class Membership_Base_Model_AttachmentAll extends Membership_Base_Model_Base {
	public $errorText = '';

	public function getTable($tableName = NULL) {
		return $this->getPrefix() . 'attachments_all';
	}

	/**
	 * @param $params[tmp_path | prev_file_name | user_id]
	 * @return array|bool
	 */
	public function addAttachment($params) {
		$filePath = false;
		$this->errorText = false;

		if(empty($params['tmp_path'])) {
			$this->errorText = $this->translate("Error! Incorrect Upload file params!");
			return false;
		} else {
			$filePath = $params['tmp_path'];
		}

		if(!file_exists($filePath)) {
			$this->errorText = $this->translate("Error! File not exists!");
			return false;
		}
		if(!empty($params['user_id'])) {
			$userId = (int)$params['user_id'];
		}
		if(!$userId) {
			$userId = get_current_user_id();
		}

		$fileType = null;
		if(function_exists('mime_content_type')) {
			$fileType = mime_content_type($filePath);
		}

		// prevent Inject by File Entry
		if(!$fileType || in_array($fileType, array('text/html', 'text/x-php', 'text/x-server-parsed-html', 'message/rfc822', 'text/webviewhtml', 'application/x-httpd-php', ))) {
			$this->errorText = $this->translate('Error! Illegal file entry!');
			return false;
		}
		$ext = '.unk';
		if(!empty($params['prev_file_name'])) {
			$ext = $this->getFileExtention($params['prev_file_name']);
		}
		// prevent inject by File Extention
		if(in_array($ext, array('php', 'html', 'shtml', 'htm'))) {
			$this->errorText = $this->translate('Error! Illegal file extention!');
			return false;
		}

		$attachmentTypeModel = $this->getModule('base')->getModel('AttachmentType');
		$attachmentTypeId = $attachmentTypeModel->getIdAndInsertIfNotExists($fileType);
		if(!$attachmentTypeId) {
			$this->errorText = $this->translate('Error! Insert Attachment Type. Db error #1');
			return false;
		}

		// clean not saved attachments
		$this->cleanUnused($userId);

		// if it image -> prepare image
		if(strpos($fileType,'image/') !== false) {
			$image = wp_get_image_editor($params['tmp_path'], array('tmp_path'));
			if (is_wp_error($image)) {
				if(count($image->errors)) {
					$errArrTmp = array_shift($image->errors);
					if(count($errArrTmp)) {
						$errArrTmp = array_shift($errArrTmp);
						$this->errorText = $this->translate($errArrTmp);
					}
				}
				return false;
			}

			$settings = $this->getModule('base')->getSettings();
			$imgMaxWidth = $settings['base']['uploads']['max-image-size']['width'];
			$imgMaxHeight = $settings['base']['uploads']['max-image-size']['height'];
			$imageQuality = $settings['base']['uploads']['image-quality'];

			$image->set_quality($imageQuality);
			$imageSize = $image->get_size();
			if ($imageSize['width'] > $imgMaxWidth || $imageSize['height'] > $imgMaxHeight) {
				$image->resize($imgMaxWidth, $imgMaxHeight, false);
				$imageSize = $image->get_size();
			}
			//
			$imagesModel = $this->getModule('base')->getModel('images', 'base');
			$savePath = $imagesModel->generateFilePath('/membership/attachments/', 'jpg');
			$source = $imagesModel->getUploadUrlFromPath($savePath);
			$image->save($savePath, 'image/jpeg');
		} else {
			$savePath = $this->generateFilePath('/membership/attachments/', $ext);
			$source = $this->getUploadUrlFromPath($savePath);

			// save into new folder
			$this->move($params['tmp_path'], $savePath);
		}

		$attachmentId = null;
		$queryInsertRes = $this->db->insert($this->getTable(), array(
			'user_id' => $userId,
			'source' => $params['prev_file_name'] . '|||' . $source,
			'type' => $attachmentTypeId,
		));
		//
		if($queryInsertRes) {
			$attachmentId = $this->db->insert_id;
		}
		if(!$attachmentId) {
			$this->errorText = $this->translate('Insert Attachment. Db error #2');
		}

		return array(
			'url' => $source,
			'attachment_id' => $attachmentId,
			'attachment_type_id' => $attachmentTypeId,
			'attachment_type_code' => $fileType,
			'file_name' => $params['prev_file_name'],
			'error' => !empty($this->errorText) ? $this->errorText : false,
		);
	}

	public function move($imagePath, $savePath) {
		$moveRes = move_uploaded_file($imagePath, $savePath);
	}

	public function getFileExtention($filePath) {
		$ext = 'tmp';
		$explodeArr = explode('.', $filePath);
		if(count($explodeArr) > 1) {
			$ext = array_pop($explodeArr);
		}
		return $ext;
	}

	public function getUploadUrlFromPath($path)	{
		return str_replace($this->getUploadsPath(), $this->getUploadsUrl(), $path);
	}

	public function getUploadsUrl($path = null) {
		return $this->getUploadDir('baseurl') . $path;
	}

	public function generateFilePath($directory, $ext = 'unk') {
		$fileName = str_replace('ad', 'a0', uniqid()); // Avoid add block false positives
		if($ext) {
			$fileName .= '.' . $ext;
		}
		$dirname  = $this->getUploadsPath($directory) . implode('/', str_split(substr($fileName, mt_rand(0, 7), 6), 2)) . '/';
		wp_mkdir_p($dirname);
		return $dirname . $fileName;
	}

	public function getUploadDir($key = null) {
		$uploadDirData = $this->environment->getConfig()->get('wp_upload_dir');
		if ($key && isset($uploadDirData[$key])) {
			return $uploadDirData[$key];
		}
		return $uploadDirData;
	}

	public function getUploadsPath($path = null) {
		return $this->getUploadDir('basedir') . $path;
	}

	public function getUploadPathFromUrl($path) {
		return str_replace(
			str_replace(array('https://', 'http://'), '', $this->getUploadsUrl()),
			$this->getUploadsPath(),
			str_replace(array('https://', 'http://'), '', $path)
		);
	}

	public function cleanUnused($userId) {

		$selectQuery = $this->db->prepare("SELECT id, source FROM " . $this->getPrefix() . "attachments_all
			WHERE created_at <= (NOW() - INTERVAL 1 DAY)
			AND user_id = %s
			AND is_saved = 0", array($userId));
		$resList = $this->db->get_results($selectQuery, ARRAY_A);

		if(count($resList)) {
			$idsArr = array();
			foreach($resList as $oneAttachment) {
				$idsArr[] = $oneAttachment['id'];

				$fileInfoArr = $this->getArrFromSourceField($oneAttachment['source']);
				if(!empty($fileInfoArr['url'])) {
					$filePath = $this->getUploadPathFromUrl($fileInfoArr['url']);
					if(file_exists($filePath)) {
						unlink($filePath);
					}
				}

			}

			$idsStr = implode(',', $idsArr);
			$removeByQuery = "DELETE FROM " . $this->getPrefix() . "attachments_all WHERE id in (" . $idsStr . ")";
			$this->db->query($removeByQuery);
		}
		return true;
	}

	public function updateSavedParamFor(array $attachmentIds) {
		$countArr = count($attachmentIds);
		if($countArr) {
			$arrParamsStr = '(' . implode(',', array_fill(0, $countArr, '%s')) . ')';
			$query = $this->db->prepare('UPDATE ' . $this->gettable() . ' SET `is_saved`=1 WHERE `id` IN' . $arrParamsStr, $attachmentIds);

			$this->db->query($query);
			return true;
		}
		return false;
	}

	public function getArrFromSourceField($source) {
		$explodedArr = explode('|||', $source);
		$fileNameArr = array();
		if(is_array($explodedArr) && !empty($explodedArr)) {
			if(count($explodedArr) == 0) {
				$fileNameArr['url'] = $source;
			} else if(count($explodedArr) == 1) {
				$fileNameArr['url'] = $explodedArr[0];
			} else {
				$fileNameArr['name'] = $explodedArr[0];
				$fileNameArr['url'] = $explodedArr[1];
			}
		}
		return $fileNameArr;
	}

	public function removeAttachmentById(array $attachmentIds) {
		if(count($attachmentIds)) {
			$whereParam = implode(',', array_fill(0, count($attachmentIds), '%s'));
			$selectQuery = $this->db->prepare("SELECT id, source FROM " . $this->getPrefix() . "attachments_all
				WHERE id IN(" . $whereParam . ")", $attachmentIds);
			$resList = $this->db->get_results($selectQuery, ARRAY_A);

			if(count($resList)) {
				$idsArr = array();
				foreach($resList as $oneAttachment) {
					$idsArr[] = $oneAttachment['id'];

					$fileInfoArr = $this->getArrFromSourceField($oneAttachment['source']);
					if(!empty($fileInfoArr['url'])) {
						$filePath = $this->getUploadPathFromUrl($fileInfoArr['url']);
						if(file_exists($filePath)) {
							unlink($filePath);
						}
					}
				}

				$idsStr = implode(',', $idsArr);
				$removeByQuery = "DELETE FROM " . $this->getPrefix() . "attachments_all WHERE id in (" . $idsStr . ")";
				$this->db->query($removeByQuery);
			}
		}
		return true;
	}
}