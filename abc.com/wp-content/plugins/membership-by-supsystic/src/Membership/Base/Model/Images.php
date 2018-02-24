<?php


class Membership_Base_Model_Images extends Membership_Base_Model_Base
{
	public function getImageSizeAndSrc($imagePath)
	{
		list($width, $height) = getimagesize($imagePath);
		return array(
			'width' => $width,
			'height' => $height,
			'src' => $this->getUploadUrlFromPath($imagePath)
		);
	}

	public function generateFilename($file, $path, $extension = null, $suffix = null) {

		$info = pathinfo($file);
		$ext = $info['extension'];
		$filename = $info['filename'];

		if ($suffix) {
			$filename = "$filename-$suffix";
		}

		if ($extension) {
			$ext = $extension;
		}

		return trailingslashit($path) . "$filename.$ext";
	}

	public function getUploadDir($key = null)
	{
		$uploadDirData = $this->environment->getConfig()->get('wp_upload_dir');
		if ($key && isset($uploadDirData[$key])) {
			return $uploadDirData[$key];
		}
		return $uploadDirData;
	}

	public function getUploadsPath($path = null) 
	{
		return $this->getUploadDir('basedir') . $path;
	}

	public function getUploadsUrl($path = null) 
	{
		return $this->getUploadDir('baseurl') . $path;
	}

	public function getUploadPathFromUrl($path) 
	{
		return str_replace(
			str_replace(array('https://', 'http://'), '', $this->getUploadsUrl()),
			$this->getUploadsPath(),
			str_replace(array('https://', 'http://'), '', $path)
		);
	}

	public function getUploadUrlFromPath($path) 
	{
		return str_replace($this->getUploadsPath(), $this->getUploadsUrl(), $path);
	}

	public function uploadAttachmentFromUrl($url, $userId = 0) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		$raw = curl_exec($ch);
		curl_close($ch);

		$path = $this->generateFilePath('/membership/attachments/', 'jpg');

		if(file_exists($path)) {
			unlink($path);
		}

		$fp = fopen($path, 'x');
		fwrite($fp, $raw);
		fclose($fp);

		$attachmentModel = $this->getModel('attachment', 'base');

		if($userId === 0 && $userId >= 1){
            $attachment = $attachmentModel->addImageAttachment(array('tmp_name' => $path));
        }else{
            $attachment = $attachmentModel->addImageAttachment(array('tmp_name' => $path, 'userId' => $userId));
        }

		$result = null;

		if (isset($attachment['id'])) {
			$result = $attachment['id'];
		}

		return $result;
	}

	public function move($imagePath, $savePath, $prefix)
	{
		$newImagePath = $this->generateFilename($imagePath, $savePath, null, $prefix);
		move_uploaded_file($imagePath, $newImagePath);
	}

	public function generateFilePath($directory, $ext)
	{
		$uniqid = str_replace('ad', 'a0', uniqid()); // Avoid add block false positives
		$fileName = $uniqid . '.' . $ext;
		$dirname  = $this->getUploadsPath($directory) . implode('/', str_split(substr($fileName, mt_rand(0, 7), 6), 2)) . '/';
		wp_mkdir_p($dirname);
		return $dirname . $fileName;
	}

	public function createImagesFromAttachments(array $attachments, $userId, $attachmentUserId = null, $type = 'image') {

		$attachmentModel = $this->getModel('attachment', 'base');
		$attachments = $attachmentModel->getAttachments(
			$attachments,
			$attachmentUserId !== null ? $attachmentUserId : $userId,
			$type
		);

		$images = array();

		foreach ($attachments as $attachment) {
			$sourcePath = $this->getUploadPathFromUrl($attachment['source']);
			$image = wp_get_image_editor($sourcePath);
			$size = $image->get_size();
			unset($image);
			$fileName = $this->generateFilePath('/membership/images/', 'jpg');
			rename($sourcePath, $fileName);
			$images[] = array(
				'source' => $this->getUploadUrlFromPath($fileName),
				'width' => $size['width'],
				'height' => $size['height'],
			);
		}

		foreach ($images as &$image) {
			$image['id'] = $this->addImage($userId, $image['source'], $image['width'], $image['height']);
		}

		return $images;
	}

	public function addImage($userId, $source, $width, $height) {

		$query = $this->preparePrefix(
			"
			INSERT INTO `{prefix}images`
				(`user_id`, `source`, `width`, `height`, `created_at`)
			VALUES ('%d', '%s', '%d', '%d', '%s');
			"
		);

		$this->db->query(
			$this->db->prepare(
			    $query,
                array($userId, $source, $width, $height, $this->getCurrentDateInUTC())
            )
		);

		return $this->db->insert_id;
	}

	public function addImageThumbnail($imageId, $source, $width, $height) {

		$query = $this->preparePrefix(
			"
			INSERT INTO `{prefix}images_thumbnails`
				(`image_id`, `source`, `width`, `height`, `created_at`)
			VALUES ('%d', '%s', '%d', '%d', '%s');
			"
		);

		$this->db->query(
			$this->db->prepare(
			    $query,
                array($imageId, $source, $width, $height, $this->getCurrentDateInUTC())
            )
		);

		return $this->db->insert_id;
	}

	public function resizeImage($image, $width, $height) {

		$imagePath = $this->getUploadPathFromUrl($image['source']);
		$resizeData = $this->resizeImageFromPath($imagePath, $width, $height);

		if (is_wp_error($resizeData)) {
			return $resizeData;
		}

		return array(
			'id' => $this->addImageThumbnail($image['id'], $resizeData['source'], $resizeData['width'], $resizeData['height']),
			'image_id' => $image['id'],
			'source' => $resizeData['source'],
			'width' => $resizeData['width'],
			'height' => $resizeData['height'],
		);
	}

	public function resizeImageFromPath($imagePath, $width, $height, $crop = false) {
		$editor = wp_get_image_editor($imagePath);

		if (is_wp_error($editor)) {
			return $editor;
		}

		$size = $editor->get_size();

		if ($size['width'] > $width || $size['height'] > $height || $crop) {
			$editor->resize($width, $height, $crop);
			$size = $editor->get_size();
		}

		$filePath = $this->generateFilePath('/membership/images/', 'jpg');
		$editor->save($filePath, 'image/jpeg');

		return array(
			'source' => $this->getUploadUrlFromPath($filePath),
			'width' => $size['width'],
			'height' => $size['height']
		);
	}

	public function cropImage($image, $cropData, $imageWidth, $imageHeight) 
	{
		$imagePath = $this->getUploadPathFromUrl($image['source']);
		$source = $this->cropImageFromPath($imagePath, $cropData, $imageWidth, $imageHeight);

		if (is_wp_error($source)) {
			return $source;
		}

		$source = $this->getUploadUrlFromPath($source);

		return array(
			'id' => $this->addImageThumbnail($image['id'], $source, $imageWidth, $imageHeight),
			'image_id' => $image['id'],
			'source' => $source,
			'width' => $imageWidth,
			'height' => $imageHeight,
		);
	}

	public function cropImageFromPath($imagePath, $cropData, $imageWidth, $imageHeight) {
		$editor = wp_get_image_editor($imagePath);

		if (is_wp_error($editor)) {
			return $editor;
		}

		$filePath = $this->generateFilePath('/membership/images/', 'jpg');

		$editor->crop(
			$cropData['x'],
			$cropData['y'],
			$cropData['width'],
			$cropData['height'],
			$imageWidth,
			$imageHeight,
			false
		);

		$editor->save($filePath, 'image/jpeg');
		unset($editor);

		return $filePath;
	}

	public function getScaledCropData($cropData, $size) {

		$cropAreaScaleFactor = min($cropData['width'] / $size['width'], $cropData['height'] / $size['height']);

		$width = $size['width'] * $cropAreaScaleFactor;
		$height = $size['height'] * $cropAreaScaleFactor;

		$offsetX = ($cropData['width'] - $width) / 2;
		$offsetY = ($cropData['height'] - $height) / 2;
		return array(
			'x' => $cropData['x'] + $offsetX,
			'y' =>  $cropData['y'] + $offsetY,
			'width' => $width,
			'height' => $height
		);
	}

	public function createThumbnails($imageId, $sourcePath, $sizes)
	{
		$thumbnails = array();

		foreach ($sizes as $size) {
			$editor = wp_get_image_editor($sourcePath);
			$editor->resize($size['width'], $size['height'], true);
			$filePath = $this->generateFilePath('/membership/images/', 'jpg');
			$editor->save($filePath, 'image/jpeg');
			$source = $this->getUploadUrlFromPath($filePath);
			$thumbnails[] = array(
				'id' => $this->addImageThumbnail($imageId, $source, $size['width'], $size['height']),
				'image_id' => $imageId,
				'source' => $source,
				'width' => $size['width'],
				'height' => $size['height'],
			);
			unset($editor);
		}

		return $thumbnails;
	}

	public function setUserImage($userId, $imageId, $type, $cropData)
	{
		$query = $this->preparePrefix(
			"
			INSERT INTO `{prefix}users_images`
				(`user_id`, `image_id`, `type`, crop)
			VALUES ('%d', '%d', '%s', '%s')
			ON DUPLICATE KEY UPDATE image_id = '%d', crop = '%s'
			"
		);

		return $this->db->query(
			$this->db->prepare($query, array($userId, $imageId, $type, $cropData, $imageId, $cropData))
		);
	}

	public function removeUserImage($userId, $type) {
		$query = $this->preparePrefix("
			DELETE FROM `{prefix}users_images`
			WHERE user_id = '%d' AND type = '%s'
		");

		$this->db->query(
			$this->db->prepare($query, array($userId, $type))
		);
	}

	public function setUserCover($userId, $imageId, $cropData)
	{
		$this->setUserImage($userId, $imageId, 'cover', $cropData);
		$albumsModel = $this->getModel('albums', 'base');
		$album = $albumsModel->getUserCoverAlbum($userId);
		$albumsModel->addImage($album['id'], $imageId);
	}

	public function removeUserCover($userId)
	{
		$this->removeUserImage($userId, 'cover');
	}

	public function setUserAvatar($userId, $imageId, $cropData)
	{
		$this->setUserImage($userId, $imageId, 'avatar', $cropData);
		$albumsModel = $this->getModel('albums', 'base');
		$album = $albumsModel->getUserAvatarAlbum($userId);
		$albumsModel->addImage($album['id'], $imageId);
	}

	public function removeUserAvatar($userId)
	{
		$this->removeUserImage($userId, 'avatar');
	}

	public function getUsersImages($userIds, $checkSizes = false) {

		$placeholders = implode(', ', array_pad(array(), count($userIds), "'%d'"));

		$query = $this->preparePrefix("
			SELECT 
				it.id, ui.user_id, ui.image_id, ui.type, it.width, it.height, it.source
			FROM
				{prefix}users_images AS ui
			LEFT JOIN {prefix}images_thumbnails AS it ON (ui.image_id = it.image_id)
			WHERE user_id IN ($placeholders)
		");

		$images = $this->db->get_results(
			$this->db->prepare($query, $userIds),
			ARRAY_A
		);


		if ($images && $checkSizes) {
			$settings = $this->getModule('base')->getSettings();

			$thumbnailsToRecreate = $this->checkThumbnailSizes(array(
				'avatar' => array(
					'default' => $settings['profile']['avatar-size'],
					'large' => $settings['profile']['avatar-large-size'],
					'medium' => $settings['profile']['avatar-medium-size'],
					'small' => $settings['profile']['avatar-small-size']
				),
				'cover' => array(
					'default' => $settings['profile']['cover-size'],
                    'medium' => $settings['profile']['cover-medium-size'],
					'small' => $settings['profile']['cover-small-size']
				)
			), $images, 'user_id');

			if ($thumbnailsToRecreate) {
				$queries = array();

				foreach ($thumbnailsToRecreate as $userId => $thumbnailImages) {
					foreach ($thumbnailImages as $imageId => $types) {
						foreach ($types as $type => $sizes) {
							$queries[] = $this->db->prepare($this->preparePrefix("
								SELECT 
									ui.image_id as id, ui.user_id, ui.type, ui.crop, i.source
								FROM {prefix}users_images AS ui
								LEFT JOIN {prefix}images AS i ON (i.id = ui.image_id)
								WHERE ui.user_id = '%d' AND ui.image_id = '%d' AND ui.type = '%s'
	 						"), $userId, $imageId, $type);
						}

					}
				}

				$_images = $this->db->get_results(implode(' UNION ', $queries), ARRAY_A);

				foreach ($_images as $_image) {

					$cropData = unserialize($_image['crop']);
					$sizes = $thumbnailsToRecreate[$_image['user_id']][$_image['id']][$_image['type']];
					foreach ($sizes as $size) {

						$cropArearScaleFactor = min($cropData['width'] / $size['width'], $cropData['height'] / $size['height']);

						$width = $size['width'] * $cropArearScaleFactor;
						$height = $size['height'] * $cropArearScaleFactor;

						$offsetX = ($cropData['width'] - $width) / 2;
						$offsetY = ($cropData['height'] - $height) / 2;

						$image = $this->cropImage(
							$_image,
							array(
								'x' => $cropData['x'] + $offsetX,
								'y' =>  $cropData['y'] + $offsetY,
								'width' => $width,
								'height' => $height,
							),
							$size['width'],
							$size['height']
						);

						if (is_wp_error($image)) {
							continue;
						}

						$image['user_id'] = $_image['user_id'];
						$image['type'] = $_image['type'];
						$images[] = $image;
					}
				}
			}

		}

		return $images;
	}

	public function checkThumbnailSizes($thumbnailSizes, &$images, $ownerIndex) {

		$thumbnailsToRemove = array();
		$thumbnails = array();

		// Generate lists with images per user
		foreach ($images as $image) {
			if (!isset($thumbnails[$image[$ownerIndex]])) {
				$thumbnails[$image[$ownerIndex]] = array();
			}

			if (!isset($thumbnails[$image[$ownerIndex]][$image['image_id']])) {
				$thumbnails[$image[$ownerIndex]][$image['image_id']] = array();
			}
			
			$thumbnails[$image[$ownerIndex]][$image['image_id']][$image['type']] = array();
		}

		// Filter not in use sizes
		foreach ($images as $key => &$image) {
			$imageType = $image['type'];
			if (isset($thumbnailSizes[$imageType])) {

				foreach ($thumbnailSizes[$imageType] as $name => $size) {

					if ($image['width'] === $size['width'] && $image['height'] === $size['height']) {
						$thumbnails[$image[$ownerIndex]][$image['image_id']][$imageType][] = $name;
						continue 2;
					}
				}
			}

			// Unset old unused thumbnail sizes
			$thumbnailsToRemove[] = $image['id'];
			unset($images[$key]);
			unset($thumbnails[$image[$ownerIndex]][$imageType]);
		}

		$this->removeThumbnails($thumbnailsToRemove);

		foreach ($thumbnails as $ownerId => $thumbnailImages) {

			foreach ($thumbnailImages as $imageId => $types) {
				foreach ($types as $imageType => $sizeNames) {

					if (isset($thumbnailSizes[$imageType])) {


						$thumbnailSizeNames = array_keys($thumbnailSizes[$imageType]);

						foreach ($thumbnailSizeNames as $name) {
							if (in_array($name, $sizeNames)) {
								foreach (array_keys($sizeNames, $name) as $key) {
									unset($thumbnails[$ownerId][$imageId][$imageType][$key]);
								}
							} else {

								$thumbnails[$ownerId][$imageId][$imageType][] = $thumbnailSizes[$imageType][$name];

							}
						}

						if (!$thumbnails[$ownerId][$imageId][$imageType]) {
							unset($thumbnails[$ownerId][$imageId][$imageType]);
						};
					}

					if (!$thumbnails[$ownerId][$imageId]) {
						unset($thumbnails[$ownerId][$imageId]);
					};
				}

				if (!$thumbnails[$ownerId]) {
					unset($thumbnails[$ownerId]);
				};

			}
		}

		return $thumbnails;
	}

	public function getGroupsImages($groupIds, $checkSizes = false) {

		$placeholders = implode(', ', array_pad(array(), count($groupIds), "'%d'"));

		$query = $this->preparePrefix("
			SELECT 
				gi.group_id, gi.image_id, gi.type, it.width, it.height, it.source
			FROM
				{prefix}groups_images AS gi
			LEFT JOIN {prefix}images_thumbnails AS it ON (gi.image_id = it.image_id)
			WHERE gi.group_id IN ($placeholders)
		");

		$images = $this->db->get_results(
			$this->db->prepare($query, $groupIds),
			ARRAY_A
		);

		if ($images && $checkSizes) {
			$settings = $this->getModule('base')->getSettings();

			$thumbnailsToRecreate = $this->checkThumbnailSizes(array(
				'logo' => array(
					'default' => $settings['groups']['logo-size'],
					'large' => $settings['groups']['logo-large-size'],
					'medium' => $settings['groups']['logo-medium-size'],
					'small' => $settings['groups']['logo-small-size']
				),
				'cover' => array(
					'default' => $settings['groups']['cover-size'],
                    'medium' => $settings['groups']['cover-medium-size'],
					'small' => $settings['groups']['cover-small-size']
				)
			), $images, 'group_id');

			if ($thumbnailsToRecreate) {
				$queries = array();

				foreach ($thumbnailsToRecreate as $groupId => $thumbnailImages) {
					foreach ($thumbnailImages as $imageId => $types) {
						foreach ($types as $type => $sizes) {
							$queries[] = $this->db->prepare($this->preparePrefix("
								SELECT 
									ui.image_id as id, ui.group_id, ui.type, ui.crop, i.source
								FROM {prefix}groups_images AS ui
								LEFT JOIN {prefix}images AS i ON (i.id = ui.image_id)
								WHERE ui.group_id = '%d' AND ui.image_id = '%d' AND ui.type = '%s'
	 						"), $groupId, $imageId, $type);
						}

					}
				}

				$_images = $this->db->get_results(implode(' UNION ', $queries), ARRAY_A);

				foreach ($_images as $_image) {

					$cropData = unserialize($_image['crop']);
					$sizes = $thumbnailsToRecreate[$_image['group_id']][$_image['id']][$_image['type']];

					foreach ($sizes as $size) {

						$cropArearScaleFactor = min($cropData['width'] / $size['width'], $cropData['height'] / $size['height']);

						$width = $size['width'] * $cropArearScaleFactor;
						$height = $size['height'] * $cropArearScaleFactor;

						$offsetX = ($cropData['width'] - $width) / 2;
						$offsetY = ($cropData['height'] - $height) / 2;

						$image = $this->cropImage(
							$_image,
							array(
								'x' => $cropData['x'] + $offsetX,
								'y' =>  $cropData['y'] + $offsetY,
								'width' => $width,
								'height' => $height,
							),
							$size['width'],
							$size['height']
						);
						
						$image['group_id'] = $_image['group_id'];
						$image['type'] = $_image['type'];
						$images[] = $image;
					}
				}
			}

		}

		return $images;
	}


	public function setGroupImage($groupId, $imageId, $type, $cropData)
	{
		$query = $this->preparePrefix("
			INSERT INTO {prefix}groups_images
				(group_id, image_id, type, crop)
			VALUES ('%d', '%d', '%s', '%s')
			ON DUPLICATE KEY UPDATE image_id = '%d', crop = '%s'
		");

		return $this->db->query(
			$this->db->prepare($query, array($groupId, $imageId, $type, $cropData, $imageId, $cropData))
		);
	}

	public function removeGroupImage($groupId, $type) {
		$query = $this->preparePrefix("
			DELETE FROM `{prefix}groups_images`
			WHERE group_id = '%d' AND type = '%s'
		");

		$this->db->query(
			$this->db->prepare($query, array($groupId, $type))
		);
	}

	public function setGroupLogo($groupId, $imageId, $cropData)
	{
		$this->setGroupImage($groupId, $imageId, 'logo', $cropData);
		$albumsModel = $this->getModel('albums', 'base');
		$album = $albumsModel->getGroupLogoAlbum($groupId);
		$albumsModel->addImage($album['id'], $imageId);
	}

	public function removeGroupLogo($groupId)
	{
		$this->removeGroupImage($groupId, 'logo');
	}

	public function setGroupCover($groupId, $imageId, $cropData)
	{
		$this->setGroupImage($groupId, $imageId, 'cover', $cropData);
		$albumsModel = $this->getModel('albums', 'base');
		$album = $albumsModel->getGroupCoverAlbum($groupId);
		$albumsModel->addImage($album['id'], $imageId);
	}

	public function removeGroupCover($groupId)
	{
		$this->removeGroupImage($groupId, 'cover');
	}


	public function removeThumbnails(array $thumbnails)
	{

		if (!$thumbnails) {
			return;
		}

		$placeholders = implode(', ', array_pad(array(), count($thumbnails), "'%d'"));

		$query = $this->preparePrefix("
			SELECT * FROM {prefix}images_thumbnails
			WHERE id IN ($placeholders)
		");

		$_thumbnails = $this->db->get_results(
			$this->db->prepare($query, $thumbnails),
			ARRAY_A
		);

		foreach ($_thumbnails as $_thumbnail) {
			$image = $this->getUploadPathFromUrl($_thumbnail['source']);
			$this->cleanImageFromPath($image);
		}

		$query = $this->preparePrefix("DELETE FROM {prefix}images_thumbnails WHERE id IN ($placeholders)");
		$this->db->query($this->db->prepare($query, $thumbnails));
	}

	public function removeImagesByImagesIds(array $imagesIds, $withThumnails = false) {

		if(count($imagesIds)) {
			if($withThumnails) {
				$this->removeThumbNailsByImagesIds($imagesIds);
			}

			$placeholders = implode(', ', array_pad(array(), count($imagesIds), "'%d'"));
			$query = $this->db->prepare($this->preparePrefix('
				SELECT id, source FROM {prefix}images
				WHERE id IN (' . $placeholders . ')
			'), $imagesIds);

			$imageList = $this->db->get_results($query, ARRAY_A);

			if(count($imageList)) {
				foreach($imageList as $oneImage) {
					$image = $this->getUploadPathFromUrl($oneImage['source']);
					$this->cleanImageFromPath($image);
					var_dump('removed=', $image);
				}
			}

			$removeQuery = $this->preparePrefix("DELETE FROM {prefix}images WHERE id IN ($placeholders)");
			$this->db->query($this->db->prepare($removeQuery, $imagesIds));
		}
	}

	public function removeThumbNailsByImagesIds(array $imagesIds) {
		if(count($imagesIds)) {
			$placeholders = implode(', ', array_pad(array(), count($imagesIds), "'%d'"));
			$query = $this->preparePrefix("
				SELECT id, source FROM {prefix}images_thumbnails
				WHERE image_id IN ($placeholders)
			");
			$thumbnailsRes = $this->db->get_results(
				$this->db->prepare($query, $imagesIds),
				ARRAY_A
			);

			if(count($thumbnailsRes)) {
				foreach ($thumbnailsRes as $thumbnail) {
					$image = $this->getUploadPathFromUrl($thumbnail['source']);
					$this->cleanImageFromPath($image);
				}

				$query = $this->preparePrefix("DELETE FROM {prefix}images_thumbnails WHERE id IN ($placeholders)");
				$this->db->query($this->db->prepare($query, $imagesIds));
			}
		}
	}

	public function cleanImageFromPath($imagePath) {
		if (file_exists($imagePath)) {
			unlink($imagePath);
			$this->cleanUpEmptyDir(dirname($imagePath));
		}
	}

	public function cleanUpEmptyDir($dir) {
		if (file_exists($dir) && is_dir($dir) && basename($dir) !== 'membership') {
			$files = array_diff(scandir($dir), array('.', '..'));
			if (!$files) {
				rmdir($dir);
				$this->cleanUpEmptyDir(dirname($dir));
			};
		}
	}


	public function getActivityImages($photoId, $activityId, $direction, $offset) {

		$query = $this->db->prepare($this->preparePrefix("
			SELECT * FROM {prefix}activity_images
			WHERE activity_id = '%d' AND image_id = '%d'
		"), array($activityId, $photoId));

		$limit = 10;
		$order = ' ORDER BY ai.image_id';

		if (!$direction) {
			
			$query .= $this->db->prepare($this->preparePrefix("
				UNION
				(SELECT * FROM {prefix}activity_images
				WHERE activity_id = '%d' AND image_id < '%d'
				ORDER BY image_id DESC
				LIMIT {$limit})
			"), array($activityId, $photoId));

			$query .= $this->db->prepare($this->preparePrefix("
				UNION
				(SELECT * FROM {prefix}activity_images
				WHERE activity_id = '%d' AND image_id > '%d'
				LIMIT {$limit})
			"), array($activityId, $photoId));
		}


		if ($direction === '-1') {

			if ($offset < 0) {

				$total = $this->countActivityImages($activityId);
				$leftLimit = $limit + $offset;
				$leftOffset = 0;

				$rightLimit = $limit - $leftLimit;
				$rightOffset = $total - $rightLimit;

				$query = $this->db->prepare($this->preparePrefix("
					(SELECT * FROM (
						(SELECT * FROM {prefix}activity_images
						WHERE activity_id = '%d'
						LIMIT %d, {$rightLimit})
					) as ai ORDER BY ai.image_id ASC) 
				"), array($activityId, $rightOffset));

				$query .= $this->db->prepare($this->preparePrefix("
					UNION
					(SELECT * FROM {prefix}activity_images
					WHERE image_id < '%d'
					AND activity_id = '%d'
					LIMIT %d, {$leftLimit})
				"), array($photoId, $activityId, $leftOffset));

				$order = '';

			} else {

				$query = $this->db->prepare($this->preparePrefix("
					SELECT * FROM {prefix}activity_images
					WHERE image_id < '%d' AND activity_id = '%d'
					LIMIT %d, {$limit} 
				"), array($photoId, $activityId, $offset));
			}

		}

		if ($direction === '1') {

			$query = $this->db->prepare($this->preparePrefix("
				SELECT * FROM {prefix}activity_images
				WHERE activity_id = '%d'
				ORDER BY image_id
				LIMIT %d, {$limit} 
			"), array($activityId, $offset));
		}

		$query = $this->preparePrefix("
			SELECT ai.image_id as id, i.width, i.height, i.source, i.user_id FROM ({$query}) AS ai
			LEFT JOIN {prefix}images AS i ON (i.id = ai.image_id)
			{$order}
		");

		return $this->db->get_results(
			$query,
			ARRAY_A
		);
	}

	public function getActivityImagesOffset($photoId, $activityId) {
		
		$query = $this->preparePrefix("
			SELECT COUNT(*)
			FROM {prefix}activity_images
			WHERE activity_id = '%d' AND image_id <= '%d'
			ORDER BY image_id
		");

		return $this->db->get_var(
			 $this->db->prepare($query, array($activityId, $photoId))
		);
	}

	public function countActivityImages($activityId) {

		$query = $this->preparePrefix("
			SELECT COUNT(*)
			FROM {prefix}activity_images
			WHERE activity_id = '%d'
			ORDER BY image_id
		");

		return $this->db->get_var(
			 $this->db->prepare($query, array($activityId))
		);
	}
}