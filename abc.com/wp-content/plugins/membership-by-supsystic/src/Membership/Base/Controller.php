<?php

class Membership_Base_Controller extends Rsc_Mvc_Controller {
	/**
	 * You can make controller just return it's data - without any headers, exit() or die() - just return it in code by settings this to "true"
	 * @var boolean 
	 */
	private $_simpleResponse = false;
	
	public function render($template, $data = array()) {
		return $this->getModule('base')->render($template, $data);
	}

	public function validate($input, $validationRules, $messages = array()) {
		return $this->getModule('base')->validate($input, $validationRules, $messages);
	}

	public function getModule($module = null, $modulePrefix = null) {
		if (! $module) {
			$moduleClassName = explode('_', get_class($this));
			$module = $moduleClassName[1];
		}

		if (isset($modulePrefix) && !empty($modulePrefix)) {
			$module = $modulePrefix. '_'.  $module;
		}

		return $this->getEnvironment()->getModule($module);
	}

	public function getModel($model = null, $module = null, $prefix = null) {
		if (!$prefix) {

			if (! $module) {
				$moduleClassName = explode('_', get_class($this));
				$module = $moduleClassName[1];
			}

			if (! $model) {
				$model = $module;
			}

			return $this->getModule($module)->getModel($model, $module, $prefix);
		}


		return $this->getModule('base')->getModel($model, $module, $prefix);
	}

	public function response($template, array $data = array()) {
		if($this->_simpleResponse) {
			return $data;
		}
		if ($template === 'ajax') {

			if (ob_get_length()) {
				ob_clean();
			}

			$baseModel = $this->getModel('base', 'base');


			$error = $baseModel->getError();

			if ($error) {
				$data['success'] = false;
				$data['databaseError'] = $error;
				if (WP_DEBUG) {

				    if (defined('DEBUG_BACKTRACE_IGNORE_ARGS')) {
                        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);
				    } else {
                        $backtrace = debug_backtrace();
				    }

					$stack = array();

					foreach ($backtrace as $call) {
						$class = isset($call['class']) ? $call['class'] . '::' : '';
						$stack[$class . $call['function']] = array(
							'file' => $call['file'],
							'line' => $call['line']
						);
					}

					$data['stack'] = $stack;
				}
			}


			if (isset($data['status'])) {
				status_header($data['status']);
			}
		}

		return parent::response($template, $data);
	}
	public function ajax( array $data = array() ) {
		return $this->response( Rsc_Http_Response::AJAX, $data );
	}

	public function uploadImage(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$settings = $this->getModule('base')->getSettings();
		$maxFileSize = $settings['base']['uploads']['max-file-size'];
		$image = $request->files->get('image');


		if (!isset($image['error']) || is_array($image['error'])) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 400,
			));
		}

		$validation = $this->validate(array('image' => $image), array(
			'image' => array(
				'mimes' => array(
					'formats' => array('jpg', 'jpeg', 'png', 'gif', 'ico'),
					'message' => $this->translate('Unsupported image format')
				),
				'size' => array(
					'limit' => $maxFileSize,
					'message' => $this->translate('Image size limit is exceeded')
				)
			)
		));

		if ($validation->isFail()) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 400,
				'message' => $validation->getErrors()
			));
		}

		switch ($image['error']) {
			case UPLOAD_ERR_OK:
				break;
			case UPLOAD_ERR_NO_FILE:
				return $this->response('ajax', array(
					'success' => false,
					'status' => 400,
					'message' => $this->translate('No file is sent')
				));
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				return $this->response('ajax', array(
					'success' => false,
					'status' => 400,
					'message' => $this->translate('Exceeded filesize limit.')
				));
			default:
				return $this->response('ajax', array(
					'success' => false,
					'status' => 400,
					'message' => $this->translate('Unknown upload error.')
				));
		}


		$attachmentModel = $this->getModel('attachment', 'base');
		$attachment = $attachmentModel->addImageAttachment($image);

		return $this->response('ajax', 
			array(
				'success' => true,
				'attachment' => $attachment,
				'isImage' => 1,
				'attachment_id' => $attachment['id'],
				'file_name' => $image['name'],
			)
		);
	}

    // @todo merge with uploadImage method
    public function uploadFile(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
        $settings = $this->getModule('base')->getSettings();
        $maxFileSize = $settings['base']['uploads']['max-file-size'];
        $userId = get_current_user_id();
        $media = $request->files->get('media');

		if (!isset($media['error']) || is_array($media['error'])) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 400,
			));
		}

	    $validation = $this->validate(array('media' => $media), array(
			'media' => array(
				'mimes' => array(
					'formats' => array('jpg', 'jpeg', 'png'),
					'message' => $this->translate('Unsupported image format')
				),
				'size' => array(
					'limit' => $maxFileSize,
					'message' => $this->translate('Image size limit is exceeded')
				)
			)
		));

        switch ($media['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                return $this->response('ajax', array(
                    'success' => false,
                    'status' => 400,
                    'error' => $this->translate('No file is sent')
                ));
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return $this->response('ajax', array(
                    'success' => false,
                    'status' => 400,
                    'error' => $this->translate('Exceeded filesize limit.')
                ));
            default:
                return $this->response('ajax', array(
                    'success' => false,
                    'status' => 400,
                    'error' => $this->translate('Unknown upload error.')
                ));
        }


        $attachmentModel = $this->getModel('attachment', 'base');
        $attachment = $attachmentModel->addMediaAttachment($media);

        return $this->response('ajax',
            array(
                'success' => true,
                'attachment' => $attachment
            )
        );
    }

	// )) its 3td method for upload
	public function uploadAnyFile(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$settings = $this->getModule('base')->getSettings();
		$maxFileSize = $settings['base']['uploads']['max-file-size'];
		$fileItem = $request->files->get('file');

		if (!isset($fileItem['error']) || is_array($fileItem['error'])) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 400,
				'error' => $this->translate('File entry error!'),
			));
		}

		$validation = $this->validate(array('file' => $fileItem), array(
			'file' => array(
				/*
				'mimes' => array(
					'formats' => array('jpg', 'jpeg', 'png'),
					'message' => $this->translate('Unsupported file format')
				),
				/**/
				'size' => array(
					'success' => false,
					'limit' => $maxFileSize,
					'error' => $this->translate('Image size limit is exceeded')
				)
			)
		));

		if ($validation->isFail()) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 400,
				'error' => implode(',', $validation->getErrors()),
			));
		}

		switch ($fileItem['error']) {
			case UPLOAD_ERR_OK:
				break;
			case UPLOAD_ERR_NO_FILE:
				return $this->response('ajax', array(
					'success' => false,
					'status' => 400,
					'error' => $this->translate('No file is sent')
				));
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				return $this->response('ajax', array(
					'success' => false,
					'status' => 400,
					'error' => $this->translate('Exceeded filesize limit.')
				));
			default:
				return $this->response('ajax', array(
					'success' => false,
					'status' => 400,
					'error' => $this->translate('Unknown upload error.')
				));
		}

		$resultArr = array();
		$attachmentAllModel = $this->getModule('base')->getModel('AttachmentAll');
		$addRes = $attachmentAllModel->addAttachment(array(
			'user_id' => get_current_user_id(),
			'tmp_path' => $fileItem['tmp_name'],
			'prev_file_name' => $fileItem['name'],
		));

		if($addRes) {
			$resultArr = $addRes;
			$resultArr['success'] = true;
			$resultArr['isImage'] = 0;
		} else {
			$resultArr['error'] = $attachmentAllModel->errorText;
		}
		return $this->response('ajax', $resultArr);
	}

	public function getPhotos(Rsc_Http_Parameters $parameters) {
		
		$photo = $parameters->get('imageId', null);

		if (!$photo) {
			return $this->response('ajax',
				array(
					'success' => false,
					'message' => ''
				)
			);
		}

		$photoData = explode('.', $photo);

		$photoId = $photoData[0];
		$activityId = $photoData[1];

		$direction = $parameters->get('direction', null);
		$offset = $parameters->get('offset', null);

		$imagesModel = $this->getModel('images');

		$images = array();
		$total = null;

		if ($activityId) {
			$images = $imagesModel->getActivityImages($photoId, $activityId, $direction, $offset);
			if (!$direction && !$offset) {
				$offset = $imagesModel->getActivityImagesOffset($photoId, $activityId);
				$total = $imagesModel->countActivityImages($activityId);
				return $this->response('ajax',
					array(
						'success' => true,
						'images' => $images,
						'offset' => $offset,
						'total' => $total
					)
				);		
			}

			return $this->response('ajax',
				array(
					'success' => true,
					'images' => $images
				)
			);
		}
	}

	public function getNonce(Rsc_Http_Parameters $parameters) {

		return $this->response('ajax',
			array(
				'success' => true,
				'nonce' => $this->getModule('Base')->getNonce()
			)
		);
	}

	public function getTblList(Rsc_Http_Parameters $parameters) {
		$tblListModel = $this->_getTblListModel();
		$page = (int) $parameters->get('page');
		$rowsLimit = (int) $parameters->get('rows');
		$orderBy = $parameters->get('sidx');
		$sortOrder = $parameters->get('sord');
		$search = trim( $parameters->get('search') );

		$selectParams = array(
			'fields' => $tblListModel->getSimpleFieldsList(), 
			'order_by' => $this->_prepareTblCols( $orderBy ), 
			'order' => $this->_prepareTblCols( $sortOrder ),
			'from_controller' => true,
		);
		
		if(!empty($search)) {

			$searchLikeFields = $tblListModel->getSearchLikeFields();
			if(!empty($searchLikeFields)) {

				$selectParams['where'] = array();
				foreach($searchLikeFields as $sf) {
					$cond = array();
					$searchNow = $search;
					if(is_array( $sf )) {
						$cond = array( $sf[ 0 ], $sf[ 1 ] );
					} else {
						$cond = array( $sf, 'LIKE' );
						$searchNow = "%$searchNow%";
					}
					$cond[] = $searchNow;
					$cond[] = 'orWhere';
					$selectParams['where'][] = $cond;
				}
			}
		}

		// Get total pages count for current request
		$totalCount = $tblListModel->getListTotalCount( $selectParams );

		$totalPages = 0;
		if($totalCount > 0) {
			$totalPages = ceil($totalCount / $rowsLimit);
		}
		if($page > $totalPages) {
			$page = $totalPages;
		}
		// Calc limits - to get data only for current set
		$limitStart = $rowsLimit * $page - $rowsLimit; // do not put $limit*($page - 1)
		if($limitStart < 0)
			$limitStart = 0;
		
		$selectParams['limit_offset'] = $limitStart;
		$selectParams['limit'] = $rowsLimit;
		
		$dataList = $tblListModel->getList( $selectParams );
//		var_dump($dataList);

//		exit();
		if(!empty($dataList)) {
			foreach($dataList as $i => $d) {
				$dataList[ $i ] = $this->_tblListPrepareRow( $d );
			}
		}
        return $this->response(
            'ajax',
            array(
                'success' => true,
				'page' => $page,
				'total' => $totalPages,
				'rows' => $dataList,
				'records' => count( $dataList ),
            )
        );
	}
	/**
	 * Some col names can be different in frontend and database, so make it correct conversion from frontend to database here
	 */
	protected function _prepareTblCols( $col ) {
		return $col;
	}
	/**
	 * For re-defining
	 */
	protected function _getTblListModel() {
		throw new RuntimeException(__FUNCTION__. ' method should be re-defined in child classes');
	}
	/**
	 * Public alias for _getTblListModel() - it's required to use this method outside of controllers
	 */
	public function getTblListModel() {
		return $this->_getTblListModel();
	}
	/**
	 * You can re-define this method too
	 * @param type $row
	 */
	protected function _tblListPrepareRow( $row ) {
		return $row;
	}
	public function getById(Rsc_Http_Parameters $parameters) {
		$tblListModel = $this->_getTblListModel();
		$id = (int) $parameters->get('id');
		$item = $tblListModel->getById( $id );
		if($item) {
			return $this->ajax(array('success' => true, 'item' => $item));
		} else
			return $this->ajax(array('status' => 500, 'errors' => $this->translate('Can not find required Item')));
	}
	public function removeById(Rsc_Http_Parameters $parameters) {
		$tblListModel = $this->_getTblListModel();
		if($tblListModel->removeById( $parameters->get('id') )) {
			return $this->ajax(array('success' => true));
		}
		return $this->ajax(array('status' => 500, 'errors' => $tblListModel->getError()));
	}
	public function save(Rsc_Http_Parameters $parameters) {
		$data = $parameters->get('data');
		$tblListModel = $this->_getTblListModel();
		try {
			$id = $tblListModel->save( $data );
			if($id) {
				return $this->ajax( array('success' => true, 'id' => $id) );
			} else
				return $this->ajax( array('errors' => $tblListModel->getError(), 'status' => 500) );
		} catch (Exception $e) {
			return $this->ajax( array('message' => $e->getMessage(), 'status' => 500) );
		}
		return $this->ajax(array('status' => 500, 'errors' => $this->translate('Something went wrong')));
	}
	/**
	 * Set it to return simple data or make it work as usual (default)
	 * @param type $simpleRes
	 */
	public function setSimpleResponse( $simpleRes ) {
		$this->_simpleResponse = $simpleRes;
	}
	protected function _isSimpleResponse() {
		return $this->_simpleResponse;
	}
	public function getSettingsModel() {
		throw new RuntimeException(__FUNCTION__. ' method should be re-defined in child classes');
	}

	public function getAttachmentFiles(Rsc_Http_Parameters $parameters) {
		$attachmentArr = array();
		$activityId = (int) $parameters->get('activity_id');

		if($activityId) {
			$activityModel = $this->getModel('activity', 'activity');
			$attachmentArr = $activityModel->getAttachmentFiles(array($activityId));
		}

		return $this->ajax(array(
			'attachments' => $attachmentArr,
			'errors' => false,
		));
	}
}