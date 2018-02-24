<?php

class Membership_Base_Model_Albums extends Membership_Base_Model_Base
{

	public function getUserCoverAlbum($userId, $createIfNotExist = true) {
		$album = $this->getUserAlbumByType($userId, 'cover');

		if (!$album && $createIfNotExist) {
			$this->createUserAlbum($userId, 'Cover photos', 'cover');
			return $this->getUserCoverAlbum($userId);
		}

		return $album;
	}

	public function getUserAvatarAlbum($userId, $createIfNotExist = true) {
		$album = $this->getUserAlbumByType($userId, 'avatar');

		if (!$album && $createIfNotExist) {
			$this->createUserAlbum($userId, 'Profile photos', 'avatar');
			return $this->getUserAvatarAlbum($userId);
		}

		return $album;
	}

	public function getUserActivityAlbum($userId, $createIfNotExist = true) {
		$album = $this->getUserAlbumByType($userId, 'activity');

		if (!$album && $createIfNotExist) {
			$this->createUserAlbum($userId, 'Activity photos', 'activity');
			return $this->getUserActivityAlbum($userId);
		}

		return $album;
	}

	public function getUserAlbumByType($userId, $type)
	{
		$query = $this->preparePrefix("
			SELECT a.* FROM {prefix}albums AS a
			JOIN {prefix}users_albums AS ua ON (a.id = ua.album_id AND ua.type = '%s')
			WHERE a.user_id = '%d'
		");

		return $this->db->get_row(
			$this->db->prepare($query, array($type, $userId)),
			ARRAY_A
		);
	}

	public function createUserAlbum($userId, $title, $type = null) {

		$albumId = $this->createAlbum($userId, $title);

		$query = $this->preparePrefix("
			INSERT INTO {prefix}users_albums
			(user_id, album_id, type)
			VALUES ('%d', '%d', '%s')
		");

		$this->db->query(
			$this->db->prepare($query, array($userId, $albumId, $type))
		);
	}

	public function getGroupAlbumByType($groupId, $type)
	{
		$query = $this->preparePrefix("
			SELECT a.*, ga.type FROM {prefix}groups_albums AS ga 
			JOIN {prefix}albums AS a ON (a.id = ga.album_id)
			WHERE group_id = '%d' AND type = '%s'
		");

		return $this->db->get_row(
			$this->db->prepare($query, array($groupId, $type)),
			ARRAY_A
		);
	}

	public function createGroupAlbum($groupId, $title, $type = null) {

		$albumId = $this->createAlbum(get_current_user_id(), $title);

		$query = $this->preparePrefix("
			INSERT INTO {prefix}groups_albums
			(group_id, album_id, type)
			VALUES ('%d', '%d', '%s')
		");

		$this->db->query(
			$this->db->prepare($query, array($groupId, $albumId, $type))
		);
	}

	public function getGroupCoverAlbum($groupId, $createIfNotExist = true) {
		$album = $this->getGroupAlbumByType($groupId, 'cover');

		if (!$album && $createIfNotExist) {
			$this->createGroupAlbum($groupId, 'Cover photos', 'cover');
			return $this->getGroupCoverAlbum($groupId);
		}

		return $album;
	}

	public function getGroupLogoAlbum($groupId, $createIfNotExist = true) {
		$album = $this->getGroupAlbumByType($groupId, 'logo');

		if (!$album && $createIfNotExist) {
			$this->createGroupAlbum($groupId, 'Profile photos', 'logo');
			return $this->getGroupLogoAlbum($groupId);
		}

		return $album;
	}

	public function getGroupActivityAlbum($groupId, $createIfNotExist = true) {
		$album = $this->getGroupAlbumByType($groupId, 'activity');

		if (!$album && $createIfNotExist) {
			$this->createGroupAlbum($groupId, 'Activity photos', 'activity');
			return $this->getGroupActivityAlbum($groupId);
		}

		return $album;
	}

	public function createAlbum($userId, $title = null, $description = null)
	{
		$query = $this->preparePrefix(
			"
			INSERT INTO {prefix}albums
			(user_id, title, description, created_at)
			VALUES ('%d', '%s', '%s', '%s')
			"
		);

		$this->db->query(
			$this->db->prepare(
			    $query,
                array($userId, $title, $description, $this->getCurrentDateInUTC())
            )
		);

		return $this->db->insert_id;
	}

	public function addImage($albumId, $imageId)
	{
		return $this->addImages($albumId, array($imageId));
	}

	public function addImages($albumId, $imagesIds)
	{
		$valuesPlaceholder = array();
		$queryParams = array();

		foreach ($imagesIds as $imageId) {
			$queryParams[] = $albumId;
			$queryParams[] = $imageId;
			$valuesPlaceholder[] = "('%d', '%d')";
		}

		$valuesPlaceholder = implode(',', $valuesPlaceholder);

		$query = $this->preparePrefix("
			INSERT INTO {prefix}albums_images (album_id, image_id)
			VALUES {$valuesPlaceholder}
		");

		return $this->db->query(
			$this->db->prepare($query, $queryParams)
		);
	}
}