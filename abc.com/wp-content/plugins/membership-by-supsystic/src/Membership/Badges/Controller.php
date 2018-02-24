<?php

class Membership_Badges_Controller extends Membership_Base_Controller {

	public function indexAction(Rsc_Http_Request $request) {

		return $this->response('@badges/backend/index.twig'
			,
			array(
				'content' => $this->getModule('badges')->getListContent(),
				'userList' => $this->getModule('badgesandpoints')->getListContent(),
			)
		);
	}

	protected function _getTblListModel() {
		return $this->getModel('badges', 'badges');
	}
	protected function _tblListPrepareRow( $row ) {
		if(isset($row['name'])) {
			$row['name_link'] = '<a href="'. $row['id']. '" class="mbsListEditBtn">'. $row['name']. ' <i class="fa fa-fw fa-pencil"></i></a>';
		}
		if(isset($row['img_id'])) {
			$src = wp_get_attachment_image_src($row['img_id'], 'thumbnail');
			$row['img_thumbnail'] = $src[0] != '' ? '<img style="width:45px;" src="'.$src[0].'" />' : '-';
		}
		return $row;
	}
	protected function _prepareTblCols( $col ) {
		$colsConvert = array(
			'name_link' => 'name',
		);
		return isset( $colsConvert[ $col ] ) ? $colsConvert[ $col ] : $col;
	}
	public function getAll(Rsc_Http_Parameters $parameters){
		$badges = $this->getModel('Badges', 'badges')->getAll();
		return $this->response('ajax',
			array(
				'success' => true,
				'badges' => $badges)
		);
	}
}