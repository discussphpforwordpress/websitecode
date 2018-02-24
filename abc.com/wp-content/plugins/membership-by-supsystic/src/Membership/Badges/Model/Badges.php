<?php

class Membership_Badges_Model_Badges extends Membership_Base_Model_Base {
	private $table;

	public function __construct($environment) {
		parent::__construct($environment);
		$this->table = $this->db->prefix . 'badge';
	}

	public function getSearchLikeFields() {
		return array('name');
	}
	public function getSimpleFieldsList() {
		return array('id', 'name', 'caption', 'img_id');
	}

	protected function _getListTable() {
		return $this->getTable('badge');
	}

	public function save( $data ) {
		$id = isset($data['id']) ? (int) $data['id'] : false;
		$action = $id ? 'update' : 'insert';
		$data['name'] = isset($data['name']) ? trim($data['name']) : null;
		$data['img_id'] = isset($data['img_id']) ? $data['img_id'] : null;
		if($data['name']) {
			$query = $this->getQueryBuilder();
			$action == 'insert'
				? $query->insertInto($this->getTable('badge'))
				: $query->update($this->getTable('badge'))->where('id', '=', $id);

			$query->fields(array('name', 'caption', 'img_id'))
			      ->values(array('%s', '%s', '%d'));

			$dbData = array( $data['name'], $data['caption'], $data['img_id']);
			if($this->query($query, $dbData) !== false) {
				if($action == 'insert'){
					$id = $this->db->insert_id;
				}
				return $id;
			} else
				$this->pushError( $this->getError() );
		} else
			$this->pushError( $this->environment->translate('Empty or invalid Badge Name'), 'name' );
		return false;
	}
	public function getById( $id ) {
		$item = parent::getById( $id );
		if($item['img_id']) {
			$src = wp_get_attachment_image_src($item['img_id'], 'thumbnail');
			$item['img_src'] = $src[0] != '' ? $src[0] : '-';
		}
		return $item;
	}
	public function getBadgeIDByUserId($userId){
		$badgesId = $this->getData($this->preparePrefix("
			SELECT badges_id FROM {prefix}users_badges_points WHERE user_id = ".$userId."
    	"), 'one');
		return $badgesId;
	}
	public function getAll(){
		$allBadges = $this->getData($this->preparePrefix("
			SELECT * FROM {prefix}badge WHERE 1
    	"), 'all');

		return $allBadges;
	}
	public function getAllUsers(){
		$allUsers = $this->getData($this->preparePrefix("
			SELECT * FROM {wp_prefix}users WHERE 1
    	"), 'all');

		return $allUsers;
	}
}