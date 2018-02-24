<?php
class Membership_ContactForm_Module extends Membership_Base_Module {
	public static $backendContactFormPresets;
	public function onInit() {
		if(parent::onInit()) {
			$this->getDispatcher()->filter('pagesList', array($this, 'addContactFormPage'));
		}
	}

	public function afterModulesLoaded() {
		$this->registerShortcodes();
		// backend
		$this->registerBackendAsset();
		$this->getDispatcher()->on('backendSettingsMainPagesTab', array($this, 'viewPagesTab'), 10, 1);
	}

	public function registerBackendAsset() {
		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(),
			array(
				$assetsPath . '/js/backend.contactform.js',
			),
			MBS_BACKEND
		);
	}

	public function viewPagesTab($pagesInfo) {
		$contactFormModel = $this->getModel();
		$contactFormPresets = $contactFormModel->getContactFormPresets();
		$isPluginActive = ($contactFormPresets !== false);

		echo $this->render(
			'@contactform/partials/backend.main.page.contact.form.twig',
			array(
				'pagesInfo' => $pagesInfo,
				'isPluginActive' => $isPluginActive,
				'pluginInstallUrl' => $contactFormModel->getPluginInstallUrl(),
				'wpPluginInstallUrl' => $contactFormModel->getWpPluginInstallUrl(),
				'contactFormPresets' => $contactFormPresets,
			)
		);
		return true;
	}

	public function addContactFormPage($pages) {
		$pages['contact_form'] = array(
			'title' => $this->translate('Contact Us'),
		);
		return $pages;
	}

	public function registerShortcodes() {
		add_shortcode($this->getConfig('shortcode_name') . '-contact_form',
			array($this, 'contactFormShortCodeHandler'));
	}

	public function contactFormShortCodeHandler($attributes) {

		$contactFormModel = $this->getModel();
		$contactFormPresets = $contactFormModel->getContactFormPresets();
		$settings = $this->getModel('settings', 'membership')->getSettings();

		if($contactFormPresets && isset($settings['pages']['contact_form_preset'])) {
			$settingsCfId = (int) $settings['pages']['contact_form_preset'];
			$appObj = frameCfs::getInstance();
			$formModule = $appObj->getModule('forms');
			
			if($settingsCfId && $contactFormModel->checkIdInPresets($settingsCfId, $contactFormPresets)) {
				echo $formModule->showForm(array(
					'id' => $settingsCfId,
				));
			}
		}
	}
}