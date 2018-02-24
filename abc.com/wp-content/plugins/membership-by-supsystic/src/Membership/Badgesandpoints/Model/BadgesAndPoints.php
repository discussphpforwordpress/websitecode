<?php

class Membership_Badgesandpoints_Model_BadgesAndPoints extends Membership_Base_Model_Settings {
	private $table;

	public function __construct($environment) {
		parent::__construct($environment);
		$this->table = $this->db->prefix . 'users_badges_points';
	}

	public function getSimpleFieldsList() {
		return array('id', 'user_id', 'points_count', 'badges_id');
	}

	protected function _getListTable() {
		return $this->getTable('users_badges_points');
	}
	public function getSearchLikeFields() {
		return array('user_id');
	}
	public function checkIfUserHasBadge($userId){
		$allBadges = $this->getData($this->preparePrefix("
			SELECT badges_id FROM {prefix}users_badges_points WHERE user_id = ".$userId."
    	"), 'all');
		if(count($allBadges) >= 1){
			return true;
		}else{
			return false;
		}
	}
	public function save( $data ) {
		$id = isset($data['id']) ? (int) $data['id'] : false;
		$action = $id ? 'update' : 'insert';
		if($data['user_id']) {
			$query = $this->getQueryBuilder();
			$action == 'insert'
				? $query->insertInto($this->getTable('users_badges_points'))
				: $query->update($this->getTable('users_badges_points'))->where('id', '=', $id);

			$query->fields(array('user_id', 'points_count', 'badges_id'))
			      ->values(array('%d', '%d', '%d'));

			$dbData = array( $data['user_id'], $data['points_count'], $data['badges_id']);
			if($this->query($query, $dbData) !== false) {
				if($action == 'insert'){
					$id = $this->db->insert_id;
				}
				return $id;
			} else
				$this->pushError( $this->getError() );
		} else
			$this->pushError( $this->environment->translate('Empty or invalid User Id'), 'name' );
		return false;
	}

}