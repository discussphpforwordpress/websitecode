<?php
class Membership_Socialshare_Module extends Membership_Base_Module {

	public function afterModulesLoaded() {

		parent::onInit();
		add_action('mbs_disable_social_sharing', array($this, 'manuallyDisableSocialProject'), 10, 1);

		// backend
		$this->getDispatcher()->on('backendMainContentSettingsSocialShareOpt', array($this, 'getViewBackendSettings'), 10, 1);
	}

	public function getViewBackendSettings() {

		$ssModel = $this->getModel('SocialShare');
		$ssList = $ssModel->getProjectList();

		echo $this->render('@socialshare/backend/mainContentSettings.twig', array(
			'socialShareInfo' => array(
				'isPuliginActive' => $ssModel->isPluginActive(),
				'installUrl' => $ssModel->getPluginInstallUrl(),
				'installWpUrl' => $ssModel->getWpInstallUrl(),
				'projectList' => $ssModel->getProjectList(),
			),
		));
		return true;
	}

	/**
	 * disable social sharing in Memberhip, when SocialShare project setting "where_to_show" changed from
	 * "membership" to something else
	 * @param int $ssProjectId id of social sharing project
	 */
	public function manuallyDisableSocialProject($ssProjectId) {
		$ssProjectId = (int) $ssProjectId;
		$membershipModel = $this->getModel('settings', 'membership');
		$settings = $membershipModel->getSettings();
		if(!empty($settings['plugins']['socialShare']['ids']) && is_array($settings['plugins']['socialShare']['ids'])) {

			// find index for search value
			$fInd = array_search($ssProjectId, $settings['plugins']['socialShare']['ids']);
			if($fInd !== null && $fInd !== false) {
				// remove item from array
				unset($settings['plugins']['socialShare']['ids'][$fInd]);
				// save settings
				$membershipModel->saveSettings($settings);
			}
		}
	}
}