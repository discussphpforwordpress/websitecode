<?php

class Membership_Design_Controller extends Membership_Base_Controller
{

	public function indexAction(Rsc_Http_Request $request) {

		$settingsModel = $this->getModel('settings', 'design');
		$settings = $settingsModel->getSettings();
		$fontsList = $settingsModel->getFontsListForSelector();
		$rolesModel = $this->getModel('roles', 'roles');
		$roles = $rolesModel->getRoles();
		$wpMenuList = $settingsModel->getWpMenuListForSelector();

		// Groups settings
		$baseSettings = $this->getModel('settings', 'base')->getSettings();
		$groupsSettings = $this->getModel('settings', 'groups')->getSettings();

		return $this->response(
			'@design/backend/index.twig',
			array(
				'settings' => $settings,
				'baseSettings' => $baseSettings,
				'groupsSettings' => $groupsSettings,
				'mainSettingsLink' => $this->generateUrl('membership'),
				'roles' => $roles,
				'fontsList' => $fontsList,
				'wpMenuList' => $wpMenuList,
			)
		);
	}

	public function saveSettings($request) 
	{
		// save design settings
		$settings = $request->get('settings');
		$groupSettings = $settings['groups'];
		unset($settings['groups']);
		$this->getModel('settings', 'design')->saveSettings($settings);

		// save group settings
		$settingsModel = $this->getModel('settings', 'groups');

		$defaultImagesModel = $this->getModel('DefaultImages', 'base');
		$oldSettings = $settingsModel->getSettings();
		$defaultSettings = $settingsModel->defaultSettings();

		$groupSettings = $defaultImagesModel->recreateDefaultImageByType('logo', array('large', 'medium', 'small'), $groupSettings, $oldSettings, $defaultSettings);
		$groupSettings = $defaultImagesModel->recreateDefaultImageByType('cover', array('medium', 'small'), $groupSettings, $oldSettings, $defaultSettings);

		// merge with "previous" settings
		$prevSettings = $settingsModel->getSettings();
		$groupSettings = array_replace_recursive($prevSettings, $groupSettings);
		try {
			$settingsModel->saveSettings($groupSettings);
		} catch (Exception $e) {
			status_header(500);
			return $this->response('ajax', array('message' => $e->getMessage()));
		}
	}
}
