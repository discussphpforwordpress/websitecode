<?php
class Membership_Slider_Controller extends Membership_Base_Controller {

	public function removeImage(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$sliderId = $parameters->get('slider_id');
		$imageId = $parameters->get('image_id');

		// can this user delete image by id?
		$sliderAttachmentModel = $this->getModel('SliderAttachment', 'slider');
		$canUserWork = $sliderAttachmentModel->canUserWorkWithSlider($sliderId);

		if(!$canUserWork) {
			return $this->response(
				'ajax',
				array(
					'success' => false,
					'message' => translate('Access denied. You can\'t remove this image.'),
				)
			);
		}

		$sliderImageAttachmentModel = $this->getModel('SliderImageAttachment', 'slider');
		$sliderImageAttachmentModel->deleteImageWithAttachment($imageId);

		return $this->response(
			'ajax',
			array(
				'success' => true,
			)
		);
	}

	public function uploadImage(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$settings = $this->getModule('base')->getSettings();
		$maxFileSize = $settings['base']['uploads']['max-file-size'];
		$image = $request->files->get('image');
		$sliderId = (int) $parameters->get('sliderId');

		// can this user add image by id?
		$sliderAttachmentModel = $this->getModel('SliderAttachment', 'slider');
		$canUserWork = $sliderAttachmentModel->canUserWorkWithSlider($sliderId);

		if(!$canUserWork) {
			return $this->response(
				'ajax',
				array(
					'success' => false,
					'message' => translate('Access denied. You can\'t add image to this slider.'),
				)
			);
		}

		if (!isset($image['error']) || is_array($image['error'])) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => translate($image['error']),
				'status' => 400,
			));
		}

		$validation = $this->validate(array('image' => $image), array(
			'image' => array(
				'mimes' => array(
					'formats' => array('jpg', 'jpeg', 'png'),
					'message' => $this->translate('Unsupported image format. You can use jpeg or png image format.')
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

		$sliderImageAttachmentModel = $this->getModel('SliderImageAttachment', 'slider');
		$attachment = $sliderImageAttachmentModel->addImageAttachment($image, $sliderId);

		return $this->response('ajax',
			array(
				'success' => true,
				'attachment' => $attachment
			)
		);
	}

	public function addSlider(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {

		$pluginSliderId = (int) $parameters->get('slider_id');

		$sliderAttachmentModel = $this->getModel('SliderAttachment', 'slider');
		$sliderId = $sliderAttachmentModel->addSlider($pluginSliderId);

		if(!$sliderId) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 400,
				'message' => $this->translate('Error when adding a slider to the database.')
			));
		}

		return $this->response('ajax',
			array(
				'success' => true,
				'sliderId' => $sliderId,
			)
		);
	}

	public function removeSlider(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$sliderId = (int) $parameters->get('slider_id');

		$sliderAttachmentModel = $this->getModel('SliderAttachment', 'slider');
		if($sliderAttachmentModel->canUserWorkWithSlider($sliderId)) {
			$sliderAttachmentModel->removeSlidersWithImages(array($sliderId));

			return $this->response(
				'ajax',
				array(
					'success' => true,
				)
			);
		}
		return $this->response(
			'ajax',
			array(
				'success' => false,
				'message' => translate('Access denied. You can\'t remove this slider.'),
			)
		);
	}

	public function setImagesPosition(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$imagesArray = $parameters->get('image_array');

		$sliderImageAttachmentModel = $this->getModel('SliderImageAttachment', 'slider');
		$sliderImageAttachmentModel->setImagesPositions($imagesArray);

		return $this->response(
			'ajax',
			array(
				'success' => true,
			)
		);
	}

	public function setSliderPosition(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$sliderArray = $parameters->get('slider_array');

		$sliderAttachmentModel = $this->getModel('SliderAttachment', 'slider');
		$sliderAttachmentModel->setSliderPosition($sliderArray);

		return $this->response(
			'ajax',
			array(
				'success' => true,
			)
		);
	}
}

