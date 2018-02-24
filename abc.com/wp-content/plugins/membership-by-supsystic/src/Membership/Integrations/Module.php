<?php

class Membership_Integrations_Module extends Membership_Base_Module {

	public $enabledExtensions = array(
		'bbPress'
	);

	public function onInit() {
		return;

		$location = $this->getLocation();
		$environment = $this->getEnvironment();
		$loader = $environment->getTwig()->getLoader();
		$resolver = $environment->getResolver();
		$modules = $resolver->getModulesList();

//		foreach ($this->enabledExtensions as $extension) {
//			$alias = strtolower($extension);
//			$class = 'Membership_Integrations_' . $extension . '_Module';
//			$loader->addPath($location. '/' . $extension . '/views/', $alias);
//			$modules[$alias] =  new $class($this->getEnvironment(), $location . '/' . $extension, $extension);
//		}
//
//		$resolver->setModulesList($modules);

		$dispatcher = $this->getDispatcher();
//		$dispatcher->on('adminAreaMenus', array($this, 'addAdminAreaMenuItem'));

		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(),
			array()
		);
	}

	public function addAdminAreaMenuItem($subMenus) {
		$item = array('integrations' => array(
			'title' => $this->translate('Integrations'),
			'fa_icon' => 'fa fa-exchange',
			'order' => 100,
			'module' => 'integrations',
			'action' => '',
		));

		return array_merge($subMenus, $item);
	}
}