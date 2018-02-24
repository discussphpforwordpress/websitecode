<?php

class Membership_Badgesandpoints_Module extends Membership_Base_Module {

	public function afterModulesLoaded() {
		$this->registerAjaxRoutes();
	}

	public function registerAjaxRoutes() {

		$routesModule = $this->getModule('routes');

		$routesModule->registerAjaxRoutes(array(
			'badgesAndPoints.getTblList' => array(
				'admin' => true,
				'method' => 'get',
				'handler' => array($this->getController(), 'getTblList')
			),
			'badgesAndPoints.removeById' => array(
				'method' => 'post',
				'admin' => true,
				'handler' => array($this->getController(), 'removeById')
			),
			'badgesAndPoints.save' => array(
				'method' => 'post',
				'admin' => true,
				'handler' => array($this->getController(), 'save')
			),
			'badgesAndPoints.getById' => array(
				'method' => 'post',
				'admin' => true,
				'handler' => array($this->getController(), 'getById')
			),
		));

	}

	public function getListContent() {
		$allUsers = $this->getModel('Badges', 'badges')->getAllUsers();
		$allBadges = $this->getModel('Badges', 'badges')->getAll();
		$allUsersSimple = array('value' => '');
		$allBadgesSimple = array('value' => '');
		foreach ( $allUsers as $user ) {
			$array = array('value' => $user['ID'] , 'title'=> $user['user_login']);
			array_push($allUsersSimple, $array);
		}
		foreach ( $allBadges as $badge ) {
			$array = array('value' => $badge['id'] , 'title'=> $badge['name']);
			array_push($allBadgesSimple, $array);
		}

		$this->getModule('assets')
		     ->loadJqGrid()
		     ->enqueueScripts( $this->getAssetsPath(). '/js/badgesAndPoints.backend.js' );
		return $this->render('@badgesandpoints/backend/list_users.twig',
			array(
				'allUsers' => $allUsersSimple,
				'allBadges' => $allBadgesSimple
			)
		);
	}

}