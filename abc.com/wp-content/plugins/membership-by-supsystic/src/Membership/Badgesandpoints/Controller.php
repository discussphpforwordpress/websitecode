<?php

class Membership_Badgesandpoints_Controller extends Membership_Base_Controller {

	protected function _getTblListModel() {
		return $this->getModel('BadgesAndPoints', 'badgesandpoints');
	}
	protected function _tblListPrepareRow( $row ) {

		if(isset($row['user_id'])) {
			$user = get_user_by( 'id', $row['user_id'] );
			$row['user_id'] = '<a href="'. $row['id']. '" class="mbsListEditBtn">'. $user->user_login. ' <i class="fa fa-fw fa-pencil"></i></a>';
		}

		if(isset($row['badges_id'])) {
			$badgeName = $this->getModel('badges','badges')->getById($row['badges_id']);
			$row['badges_id'] = $badgeName['name'];
		}
		return $row;
	}

	public function save(Rsc_Http_Parameters $parameters) {

		$data = $parameters->get('data');

		if( empty($data['id']) && isset($data['user_id']) && $this->getModel('BadgesAndPoints','badgesandpoints')
		        ->checkIfUserHasBadge($data['user_id'])) {

			return $this->response(
				'ajax',
				array(
					'success' => false,
					'message' => $this->translate('User already has badges')
				)
			);
		}

		$tblListModel = $this->_getTblListModel();
		try {
			$id = $tblListModel->save( $data );
			if($id) {
				return $this->ajax( array('success' => true, 'id' => $id) );
			} else {
				return $this->ajax( array('success' => false, 'errors' => $this->translate('User not selected')) );
			}
		} catch (Exception $e) {
			return $this->ajax( array('message' => $e->getMessage(), 'status' => 500) );
		}
		return $this->ajax(array('status' => 500, 'errors' => $this->translate('Something went wrong')));
	}

}