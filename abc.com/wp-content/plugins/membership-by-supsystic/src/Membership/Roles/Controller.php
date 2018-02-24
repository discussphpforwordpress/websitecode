<?php
class Membership_Roles_Controller extends Membership_Base_Controller {

	public function indexAction(Rsc_Http_Request $request) {

		$rolesModel = $this->getModel('Roles');
		$roles = $rolesModel->getRoles(true);
		$wpRoles = $rolesModel->getWpRoles();
		$defaultWpRole = get_option('default_role');

		// Groups settings
		$baseSettings = $this->getModel('settings', 'base')->getSettings();
		$groupsSettings = $this->getModel('settings', 'groups')->getSettings();

		return $this->response(
			'@roles/backend/index.twig',
			array(
				'roles' => $roles,
				'wpRoles' => $wpRoles,
				'wpDefaultRole' => $defaultWpRole,
				'baseSettings' => $baseSettings,
				'groupsSettings' => $groupsSettings,
				'mainSettingsLink' => $this->generateUrl('membership'),
			)
		);
	}

	public function saveSettings($request) {
		$settings = $request->get('settings');
		if(isset($settings['groups'])) {
			$groupSettings = $settings['groups'];
			$groupSettingsModel = $this->getModel('settings', 'groups');

			$prevSettings = $groupSettingsModel->getSettings();
			$groupSettings = array_replace_recursive($prevSettings, $groupSettings);
			try {
				$groupSettingsModel->saveSettings($groupSettings);
			} catch (Exception $e) {
				status_header(500);
				return $this->response('ajax', array('message' => $e->getMessage()));
			}
		}
		return $this->response('ajax');
	}

	public function createRole(Rsc_Http_Parameters $parameters) {

		$name = $parameters->get('name');
		$rolesModel = $this->getModel();
		$roleId = $rolesModel->createRole($name, serialize(array()), 'custom', serialize(array()));
		$error = $rolesModel->getError();

		if ($error) {
			return $this->response('ajax', array(
				'success' => false,
				'error' => $error
			));
		}

		return $this->response('ajax', array(
			'success' => true
		));
	}

	public function updateRole(Rsc_Http_Parameters $parameters) {

		$roleId = $parameters->get('roleId');
		$name = $parameters->get('name');
		$value = $parameters->get('value');
		$rolesModel = $this->getModel();
		$role = $rolesModel->getRoleById($roleId);

		if ($name == 'name') {
			$role['name'] = $value;
		} else if(in_array($name, array('wp-role'))) {
			$role['settings'][$name] = $value; 
		} else {
			$role['permissions'][$name] = $value;
		}

		$rolesModel->updateRole($roleId, $role['name'], serialize($role['permissions']), null, serialize($role['settings']));

		$error = $rolesModel->getError();

		if ($error) {
			return $this->response('ajax', array(
				'success' => false,
				'error' => $error
			));
		}
		
		return $this->response('ajax', array(
			'success' => true
		));
	}

	public function deleteRole(Rsc_Http_Parameters $parameters) {
		$roleId = $parameters->get('roleId');
		$rolesModel = $this->getModel();
		$rolesModel->deleteRole($roleId);

		$error = $rolesModel->getError();

		if ($error) {
			return $this->response('ajax', array(
				'success' => false,
				'error' => $error
			));
		}
		
		return $this->response('ajax', array(
			'success' => true
		));
	}
}