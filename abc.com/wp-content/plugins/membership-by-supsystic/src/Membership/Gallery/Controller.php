<?php
class Membership_Gallery_Controller extends Membership_Base_Controller {

	public function removeImage(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$arr = array();

		$galleryId = $parameters->get('gallery_id');
		$imageId = $parameters->get('image_id');
		
		// can this user delete image by id?
		$ggMod = $this->getModel('GalleryAttachment', 'gallery');
		$canUserWork = $ggMod->canUserWorkWithGallery($galleryId);

		if(!$canUserWork) {
			return $this->response(
				'ajax',
				array(
					'success' => false,
					'message' => translate('Access denied. You can\'t remove this image.'),
				)
			);
		}

		$galleryImageAttachmentModel = $this->getModel('GalleryImageAttachment', 'gallery');
		$galleryImageAttachmentModel->deleteImageWithAttachment($imageId);
		
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
		$galleryId = (int) $parameters->get('galleryId');

		// can this user add image by id?
		$ggMod = $this->getModel('GalleryAttachment', 'gallery');
		$canUserWork = $ggMod->canUserWorkWithGallery($galleryId);

		if(!$canUserWork) {
			return $this->response(
				'ajax',
				array(
					'success' => false,
					'message' => translate('Access denied. You can\'t add image to this gallery.'),
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

		$galleryImageAttachmentModel = $this->getModel('GalleryImageAttachment', 'gallery');
		$attachment = $galleryImageAttachmentModel->addImageAttachment($image, $galleryId);

		return $this->response('ajax',
			array(
				'success' => true,
				'attachment' => $attachment
			)
		);
	}

	public function addGallery(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {

		$photoGalleryId = (int) $parameters->get('gallery_id');
		
		$galleryModel = $this->getModel('GalleryAttachment', 'gallery');
		$galleryId = $galleryModel->addGallery($photoGalleryId);

		if(!$galleryId) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 400,
				'message' => $this->translate('Error when adding a gallery to the database.')
			));
		}

		return $this->response('ajax',
			array(
			'success' => true,
			'galleryId' => $galleryId,
			)
		);
	}

	public function removeGallery(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$galleryId = (int) $parameters->get('gallery_id');

		$galleryAttachmentModel = $this->getModel('GalleryAttachment', 'gallery');
		if($galleryAttachmentModel->canUserWorkWithGallery($galleryId)) {
			$galleryAttachmentModel->removeGalleriesWithImages(array($galleryId));

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
				'message' => translate('Access denied. You can\'t remove this gallery.'),
			)
		);
	}

	public function setImagesPosition(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$imagesArray = $parameters->get('image_array');
		
		$galleryImageAttachmentModel = $this->getModel('GalleryImageAttachment', 'gallery');
		$galleryImageAttachmentModel->setImagesPositions($imagesArray);
		
		return $this->response(
			'ajax',
			array(
				'success' => true,
			)
		);
	}
	
	public function setGalleryPosition(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$galleryArray = $parameters->get('gallery_array');

		$galleryAttachmentModel = $this->getModel('GalleryAttachment', 'gallery');
		$galleryAttachmentModel->setGalleriesPosition($galleryArray);
		
		return $this->response(
			'ajax',
			array(
				'success' => true,
			)
		);
	}
}

