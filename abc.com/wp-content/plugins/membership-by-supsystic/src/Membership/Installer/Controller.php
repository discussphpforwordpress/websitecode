<?php

class Membership_Installer_Controller extends Membership_Base_Controller {

	public function uninstallAction(Rsc_Http_Request $request) {
		return $this->response('@installer/uninstall.twig', array(
			'uninstallConfirmUrl' => $this->generateUrl(
				'installer',
				'uninstallConfirm',
				array(
					'_wpnonce' => wp_create_nonce('membership-uninstall-confirm'),
					'networkActivated' => $request->query->get('networkActivated', null)
				)
			)
		));
	}

	public function uninstallConfirmAction(Rsc_Http_Request $request) {

		if (is_admin()) {
			$verify = wp_verify_nonce($_REQUEST['_wpnonce'], 'membership-uninstall-confirm');
			$isNetworkActivated = $request->query->has('networkActivated');

			if ($verify) {
				if (($isNetworkActivated && current_user_can('manage_network_plugins')) ||
				    (!$isNetworkActivated && current_user_can('delete_plugins'))) {
					$installerModule = $this->getModule('Installer');
					$installerModule->uninstall($isNetworkActivated);
				}
			}

			$redirectUrl = 'plugins.php';

			if ($isNetworkActivated) {
				$redirectUrl = 'network/' . $redirectUrl;
			}

			return $this->redirect(get_admin_url(null, $redirectUrl));
		}

	}

}