<?php

class Membership_Base_Model_Attachment extends Membership_Base_Model_Base
{

	public function addImageAttachment($image)
	{
		$userId = get_current_user_id();

		if($userId === 0){
		    $userId = $image['userId'];
        }
		
		$this->cleanUnusedAttachments($userId);
		
		$image = wp_get_image_editor($image['tmp_name']);
		
		if (is_wp_error($image)) {
			return $image;
		}

		$settings = $this->getModule('base')->getSettings();
		$maxWidth = $settings['base']['uploads']['max-image-size']['width'];
		$maxHeight = $settings['base']['uploads']['max-image-size']['height'];
		$imageQuality = $settings['base']['uploads']['image-quality'];

		$image->set_quality($imageQuality);
		$size = $image->get_size();

		if ($size['width'] > $maxWidth || $size['height'] > $maxHeight) {
			$image->resize($maxWidth, $maxHeight, false);
			$size = $image->get_size();
		}

		$imagesModel = $this->getModel('images', 'base');

		$savePath = $imagesModel->generateFilePath('/membership/attachments/', 'jpg');
		$source = $imagesModel->getUploadUrlFromPath($savePath);

		$image->save($savePath, 'image/jpeg');

		$query = $this->preparePrefix(
			"
			INSERT INTO `{prefix}attachments`
				(`user_id`, `source`, `type`, `created_at`)
			VALUES ('%d', '%s', 'image', '%s');
			"
		);

		$this->db->query(
			$this->db->prepare($query, array($userId, $source, $this->getCurrentDateInUTC()))
		);

		return array(
			'id' => $this->db->insert_id,
			'width' => $size['width'],
			'height' => $size['height'],
			'src' => $source,
		);
	}

	public function addImageAttachmentFromUrl($source) {
		$userId = get_current_user_id();

		$query = $this->preparePrefix(
			"
			INSERT INTO `{prefix}attachments`
				(`user_id`, `source`, `type`, `created_at`)
			VALUES ('%d', '%s', 'image', '%s');
			"
		);

		$this->db->query(
			$this->db->prepare($query, array($userId, $source, $this->getCurrentDateInUTC()))
		);

		return array(
			'id' => $this->db->insert_id,
			'width' => $size['width'],
			'height' => $size['height'],
			'src' => $source,
		);
	}

    public function addMediaAttachment($media)
    {
        $userId = get_current_user_id();

        $this->cleanUnusedAttachments($userId);

        $media = wp_get_image_editor($media['tmp_name']);

        if (is_wp_error($media)) {
            return $media;
        }

        $settings = $this->getModule('base')->getSettings();
        $maxWidth = $settings['base']['uploads']['max-image-size']['width'];
        $maxHeight = $settings['base']['uploads']['max-image-size']['height'];
        $imageQuality = $settings['base']['uploads']['image-quality'];

        $media->set_quality($imageQuality);
        $size = $media->get_size();

        if ($size['width'] > $maxWidth || $size['height'] > $maxHeight) {
            $media->resize($maxWidth, $maxHeight, false);
            $size = $media->get_size();
        }

        $imagesModel = $this->getModel('images', 'base');

        $savePath = $imagesModel->generateFilePath('/membership/attachments/', 'jpg');
        $source = $imagesModel->getUploadUrlFromPath($savePath);

        $media->save($savePath, 'image/jpeg');

        $query = $this->preparePrefix(
            "
			INSERT INTO `{prefix}attachments`
				(`user_id`, `source`, `type`, `created_at`)
			VALUES ('%d', '%s', 'media', '%s');
			"
        );

        $this->db->query(
            $this->db->prepare($query, array($userId, $source, $this->getCurrentDateInUTC()))
        );

        return array(
            'id' => $this->db->insert_id,
            'width' => $size['width'],
            'height' => $size['height'],
            'src' => $source,
        );
    }

	public function getAttachments(array $attachments, $userId, $type) {

		$placeholders = implode(', ', array_pad(array(), count($attachments), "'%d'"));

		$query = $this->preparePrefix(
			"
			SELECT * FROM `{prefix}attachments`
			WHERE id IN ($placeholders)
			AND user_id = '%d'
			AND type = '%s'
			"
		);

		$queryParams = array_merge($attachments, array($userId, $type));

		return $this->db->get_results(
			$this->db->prepare($query, $queryParams),
			ARRAY_A
		);
	}

	public function cleanUnusedAttachments($userId) {

		$query = $this->preparePrefix(
			"
			SELECT id FROM `{prefix}attachments`
			WHERE created_at <= (NOW() - INTERVAL 1 DAY)
			AND user_id = '%d'
			"
		);

		$attachments = $this->db->get_col(
			$this->db->prepare($query, array($userId))
		);

		if ($attachments) {
			$this->deleteAttachments($attachments);
		}
	}

	public function deleteAttachments(array $attachments)
	{

		$placeholders = implode(', ', array_pad(array(), count($attachments), "'%d'"));

		$query = $this->preparePrefix(
			"
			SELECT * FROM `{prefix}attachments`
			WHERE id IN ($placeholders)
			"
		);

		$attachments = $this->db->get_results(
			$this->db->prepare($query, $attachments),
			ARRAY_A
		);

		$imagesModel = $this->getModel('images', 'base');

		foreach ($attachments as $attachment) {
			$image = $imagesModel->getUploadPathFromUrl($attachment['source']);

			if (file_exists($image)) {
				unlink($image);
			}

			$query = $this->preparePrefix("DELETE FROM `{prefix}attachments` WHERE id = '%d'");

			$this->db->query($this->db->prepare(
				$query,
				array($attachment['id'])
			));
		}
	}
}