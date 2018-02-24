<?php

class Membership_Badges_Module extends Membership_Base_Module {

	public function afterModulesLoaded() {

		$dispatcher = $this->getDispatcher();
		$dispatcher->on('adminAreaMenus', array($this, 'addAdminAreaMenuItem'));
		$dispatcher->on('badges.addBadges', array($this, 'addBadge'));
		$dispatcher->on('badges.addBadgesOne', array($this, 'addBadgeOne'));

		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/badges.backend.css',
				),
			array(
				$assetsPath . '/js/addBadges.backend.js',
			)
		);

		$this->registerAjaxRoutes();
	}

	//add badge src to users array
	public function addBadge($users) {
		if(empty($users)){
			return $users;
		}

		foreach ($users as $key => $user){
			$badgeId = $this->getModel('Badges', 'badges')->getBadgeIDByUserId($user['id']);
			$badge = $this->getModel('Badges', 'badges')->getById($badgeId);

			if( isset($badge['img_src']) && $badge['img_src'] !== ''){
				$users[$key]['badge_src'] = $badge['img_src'];
			}
		}
		return $users;
	}
	//add badge src to user
	public function addBadgeOne($user) {
		if(empty($user)){
			return $user;
		}

		$badgeId = $this->getModel('Badges', 'badges')->getBadgeIDByUserId($user['id']);
		$badge = $this->getModel('Badges', 'badges')->getById($badgeId);

		if( isset($badge['img_src']) && $badge['img_src'] !== ''){
			$user['badge_src'] = $badge['img_src'];
		}

		return $user;
	}
	public function addAdminAreaMenuItem($subMenus) {
		$extension = array('badges' => array(
			'title' => $this->translate('Badges'),
			'fa_icon' => 'fa fa-user-plus',
			'order' => 100,
			'module' => 'badges',
			'action' => 'index',
		));

		return array_merge($subMenus, $extension);
	}

	public function registerAjaxRoutes() {

		$routesModule = $this->getModule('routes');

		$routesModule->registerAjaxRoutes(array(
			'badges.badgeCreateNew' => array(
				'admin' => true,
				'method' => 'post',
				'handler' => array($this->getController(), 'badgeCreateNew')
			),
			'badges.getTblList' => array(
				'admin' => true,
				'method' => 'get',
				'handler' => array($this->getController(), 'getTblList')
			),
			'badges.removeById' => array(
				'method' => 'post',
				'admin' => true,
				'handler' => array($this->getController(), 'removeById')
			),
			'badges.save' => array(
				'method' => 'post',
				'admin' => true,
				'handler' => array($this->getController(), 'save')
			),
			'badges.getById' => array(
				'method' => 'post',
				'admin' => true,
				'handler' => array($this->getController(), 'getById')
			),
			'badges.getAll' => array(
				'method' => 'post',
				'admin' => true,
				'handler' => array($this->getController(), 'getAll')
			),
		));

	}

	public function getListContent() {
		$this->getModule('assets')
		     ->loadJqGrid()
		     ->enqueueScripts( $this->getAssetsPath(). '/js/badges.backend.js' );
	}

}