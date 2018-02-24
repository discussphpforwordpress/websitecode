<?php

class Membership_Auth_Controller extends Membership_Base_Controller {

	public function registrationShortcodeHandler($attr, $content) {
		$settings = $this->getModel('settings', 'users')->getSettings();
		$usersModule = $this->getModule('users');
		$fieldsModel = $usersModule->getModel('fields');
		$fields = $fieldsModel->getRegistrationFields();
		$fieldsModel->prepareDefaultRoleForRegistration($settings, $fields);

		$validationRules = $fieldsModel->getFieldsValidationRules($fields);
		$dependencies = $fieldsModel->loadFieldsAssets($fields);

		$nonce = wp_create_nonce( 'registration' );

		$this->getModule('assets')->enqueueAssets(
			$dependencies['styles'],
			$dependencies['scripts'],
			MBS_FRONTEND
		);

		return $this->render(
			'@auth/registration.twig',
			array(
				'fields' => $fields,
				'validationRules' => $validationRules,
				'usersCanRegister' => intval(get_option('users_can_register')),
				'nonce' => $nonce
			)
		);
	}

	public function getNonceHandler() {
		$nonce = wp_create_nonce( 'registration' );
		$response = array(
			'success' => true,
			'nonce' => $nonce,
		);
		return $this->ajax($response);
	}

	public function registrationHandler(Rsc_Http_Parameters $parameters) {

		if (!intval(get_option('users_can_register'))) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 403,
				'errors' => array(
				    'registration_disabled' => $this->translate('User registration is disabled. To enable go to WP Settings > General and check box for Membership option.')
                )
			));
		}

		$fieldsModel = $this->getModel('Fields', 'Users');

		$formData = $parameters->get('formData');
		$nonce = $formData["_wpnonce"];
		
		if( ! wp_verify_nonce( $nonce, 'registration') ){
			return $this->response('ajax', array(
				'success' => false,
				'errors' => array(
					'user_email' => sprintf($this->translate('Anti Bot Protection'))
				)
			));
		}

		$userFields = $fieldsModel->getRegistrationFields();
		$validation = $this->validate($formData, $fieldsModel->getFieldsValidationRules($userFields, $secretSafe = true));

		if ($validation->isFail()) {
			return $this->response('ajax', array(
				'success' => false,
				'errors' => $validation->getErrorsList()
			));
		}

		$wpUserFields = array();
		$membershipFieldsData = array();
		$notAllowedType = array('password', 'date');

		foreach($userFields as $field) {
			if (isset($formData[$field['name']])) {
				if($field['name'] != 'user_role') {
					if(isset($field['sys']) && $field['sys'] && $field['name'] != 'country') {
						$wpUserFields[$field['name']] = $formData[$field['name']];
						if(!in_array($field['type'], $notAllowedType)){
							$membershipFieldsData[$field['name']] = $formData[$field['name']];
						}
					} else {
						if(!in_array($field['type'], $notAllowedType)){
							$membershipFieldsData[$field['name']] = $formData[$field['name']];
						}
					}
				}
			}
		}

        if (isset($wpUserFields['user_login'])) {
            $wpUserFields['user_login'] = preg_replace('/[^\w0-9]/u', '-', $wpUserFields['user_login']);
        }

		// Email unique check
		if ($wpUserFields && email_exists($wpUserFields['user_email'])) {
			return $this->response('ajax', array(
				'success' => false,
				'errors' => array(
					'user_email' => sprintf($this->translate('User with this %s e-mail address already exists.'), $wpUserFields['user_email'])
				)
			));
		}

		if (!isset($wpUserFields['user_login'])) {
			$wpUserFields['user_login'] = $this->getModule('Users')->generateLoginFromEmail($wpUserFields['user_email']);
		}

		// Username unique check
		if ($wpUserFields['user_login'] && username_exists($wpUserFields['user_login'])) {
			return $this->response('ajax', array(
				'success' => false,
				'errors' => array(
					'user_login' => sprintf($this->translate('User with username %s already exists'), $wpUserFields['user_login'])
				)
			));
		}

		if (!$wpUserFields['user_pass']) {
            $wpUserFields['user_pass'] = wp_generate_password();
        }

		// Update WP user data - it's required to correct display in native WP profile
		$userId = wp_insert_user($wpUserFields);

		if (is_wp_error($userId)) {
			return $this->response('ajax', array(
				'success' => false,
				'errors' => array(
					'wp_error' => $userId->get_error_message()
				)
			));
		}

		// Update our user fields data - it will required for our plugin: we will take all info from here
		if ($membershipFieldsData) {
			$fieldsModel->updateForUser($userId, $membershipFieldsData);
		}

		$rolesModel = $this->getModel('roles', 'roles');
		$role = $rolesModel->getUserRole($userId);
		// update wordpress user role
		if(!empty($role['settings']['wp-role'])){
			$userObj = new WP_User($userId);
			if($userObj && method_exists($userObj, 'set_role')) {
				$userObj->set_role($role['settings']['wp-role']);
			}
		}
		// update membership role
		if(!empty($formData['user_role'])) {
			$newMmUserRoleId = (int)$formData['user_role'];
			$isSelectedUserRoleExist = $rolesModel->isRoleExist($newMmUserRoleId);
			// check if role exists
			if($isSelectedUserRoleExist) {
				$rolesModel->setUserRole($userId, $newMmUserRoleId);
			}
		}

		$settings = $this->getModule()->getSettings();

		if(!isset($settings['design']['auth']['login-after-register-enable'])
			|| $settings['design']['auth']['login-after-register-enable'] == 1) {
			$redirectToLoginPage = 1;
			$user = wp_signon(array(
				'user_login' => $wpUserFields['user_login'],
				'user_password' => $wpUserFields['user_pass']
			));

			if (is_wp_error($user)) {
				return $this->response('ajax', array(
					'success' => false,
					'errors' => array(
						'login_error' => $this->translate('Login error')
					)
				));
			}
		}

        $picture = (isset($formData['_oauth-picture'])) ? $formData['_oauth-picture'] : null;

		$responseMessage = $this->translate('Thank you for registration!');

		$redirectTo = $this->getModule('Users')->getUserProfileUrl(array(
			'id' => $user->ID,
			'user_login' => $user->user_login
		));

        switch ($settings['profile']['registration-confirmation']) {
            case 'email-confirmation':
				$responseMessage .= '<br>' . $this->translate('To complete your registration please follow the activation link in confirmation email message that you will receive.');
                break;
            case 'admin-confirmation':
	            $responseMessage .= '<br>' . $this->translate('To complete your registration administrator needs to review your account.<br>You will receive email about your account activation after review.');
	            break;
        }

		$responseMessage .= '<br>' . $this->translate('You will be redirected to next page in few seconds.');

		$afterRegistrationAction = $settings['base']['main']['after-registration-action'];

		if ($afterRegistrationAction === 'redirect-to-url') {
			$redirectTo = $settings['base']['main']['after-registration-redirect-url'];
		}
		if(!isset($redirectToLoginPage)) {
			$redirectTo = $this->getModule('Routes')->getRouteUrl('login');
		}

		$response = array(
			'success' => true,
			'redirect' => $redirectTo,
			'message' => $responseMessage
		);

		if($this->_isSimpleResponse()) {
			$response['id'] = $user->ID;
		}

        do_action('mssl_import_facebook_avatar', $picture);

		return $this->ajax($response);
	}

	public function loginShortcodeHandler()
	{
		$action = get_query_var('action');
		$template = '@auth/login.twig';
		$templateData = array();

		if ($action) {
			switch ($action) {
				case 'reset-password':
					$template = '@auth/reset-password.twig';
					break;
				case 'reset-password-confirmation':
					$template = '@auth/reset-password-confirmation.twig';
					break;
			}
		}

		return $this->render($template, $templateData);
	}

	public function loginHandler(Rsc_Http_Parameters $parameters)
	{
		$formData = $parameters->get('formData');
		$settings = $this->getModule()->getSettings();

		$validationRules = array(
			'username' => array(
				'required' => array(
					'message' => $this->translate('Username or E-mail is required.')
				)
			),
			'password' => array(
				'required' => array(
					'message' => $this->translate('Password is required and can\'t be empty.')
				)
			)
		);

		if (isset($settings['design']['auth']['login-google-recaptcha-enable']) &&
		    $settings['design']['auth']['login-google-recaptcha-enable'] === 'true') {

			if (isset(
				$settings['design']['auth']['login-google-recaptcha-site-key'],
				$settings['design']['auth']['login-google-recaptcha-secret-key'])) {

				$validationRules['g-recaptcha-response'] = array(
					'recaptcha' => array(
						'message' => $this->translate('Captcha response error.'),
						'secret' => $settings['design']['auth']['login-google-recaptcha-secret-key'],
						'remoteip' => $this->getModule()->getClientIP()
					)
				);
			}

		}

		$validation = $this->validate($formData, $validationRules);

		if ($validation->isFail()) {
			return $this->response('ajax', array(
				'success' => false,
				'errors' => $validation->getErrorsList()
			));
		};

		$username = $formData['username'];
		$password = $formData['password'];
		$remember = isset($formData['remember']);

		$field = 'login';

		if (is_email($username)) {
			$field = 'email';
		}

		$user = get_user_by($field, $username);

		if ($user && wp_check_password($password, $user->data->user_pass, $user->ID)) {

			$settings = $this->getModule()->getSettings();
            $usersModule = $this->getModule('users');
			$userProfile = $this->getModel('profile', 'users')->getUserById($user->ID);

			switch ($userProfile['user_status']) {
                case Membership_Users_Model_Fields::STATUS_DELETED:
                    return $this->response('ajax', array(
                        'success' => false,
                        'errors' => array($this->translate('Account is deleted from system.'))
                    ));
                    break;
                case Membership_Users_Model_Fields::STATUS_REJECTED:
                    return $this->response('ajax', array(
                        'success' => false,
                        'errors' => array($this->translate('Account is not approved.'))
                    ));
                    break;
                case Membership_Users_Model_Fields::STATUS_DISABLED:
                    return $this->response('ajax', array(
                        'success' => false,
                        'errors' => array($this->translate('Account is disabled.'))
                    ));
                    break;
                case Membership_Users_Model_Fields::STATUS_PENDING_REVIEW:
                    return $this->response('ajax', array(
                        'success' => false,
                        'errors' => array($this->translate('Account is in verification process.'))
                    ));
                    break;
                case Membership_Users_Model_Fields::STATUS_EMAIL_NOT_CONFIRMED:
                    return $this->response('ajax', array(
                        'success' => false,
                        'errors' => array($this->translate('Check your email address for confirmation link.'))
                    ));
                    break;
            }

			$redirectTo = $usersModule->getUserProfileUrl($user->to_array());
			$afterLoginAction = $settings['base']['main']['after-login-action'];

			if ($afterLoginAction === 'redirect-to-url') {
				$redirectTo = $settings['base']['main']['after-login-action-redirect-url'];
			}

			wp_signon(array(
				'user_login' => $user->data->user_login,
				'user_password' => $password,
				'remember' => $remember
			));

			return $this->response('ajax', array(
				'success' => true,
				'redirect' => $redirectTo
			));
		}

		return $this->response('ajax', array(
			'success' => false,
			'errors' => array($this->translate('Invalid login or password.'))
		));
	}

	public function resetPassword(Rsc_Http_Parameters $parameters) {

		$formData = $parameters->get('formData');

		if ($this->validate($formData, array(
			'username' => 'required',
		))->isFail()) {
			return $this->response('ajax', array(
				'success' => false,
				'errors' => array($this->translate('Invalid username or email.'))
			));
		};

		$field = 'login';
		$username = $formData['username'];

		if (is_email($username)) {
			$field = 'email';
		}

		$user = get_user_by($field, $username);


		$mailModule = $this->getModule('Mail');

		if ($user) {

			$key = get_password_reset_key($user);

			if (is_wp_error($key)) {
				return $this->response('ajax', array(
					'success' => false,
					'errors' => $key->get_error_messages()
				));
			}

			$sendMail = $mailModule->sendMail('reset-password', array(
				'email' => $user->user_email,
				'login' => $user->user_login,
				'display_name' => $user->display_name,
				'key' => $key
			));

			if ($sendMail['success']) {
				return $this->response('ajax', array(
					'success' => true,
					'message' => $this->translate('Check your email for the confirmation link.')
				));
			} else {
				return $this->response('ajax', array(
					'success' => false,
					'errors' => array($sendMail['message'])
				));
			}

		} else {
			return $this->response('ajax', array(
				'success' => false,
				'errors' => array($this->translate('Invalid username or email.'))
			));
		}
	}

	public function resetPasswordConfirmation(Rsc_Http_Parameters $parameters) {

		$formData = $parameters->get('formData');

		$validation = $this->validate($formData, array(
			'password' => array(
				'presence' => array('message' => $this->translate('Password is required'))
			),
			'password_confirmation' => array(
				'presence' => array('message' => $this->translate('Password confirmation is required')),
				'equality' => array(
					'attribute' => 'password',
					'message' => $this->translate('Password and password confirmation must match')
				)
			),
			'key' => array('presence' => array('message' => $this->translate('Reset key is not provided.'))),
			'user' => array('presence' => array('message' => $this->translate('User is not provided.'))),
		));

		if ($validation->isFail()) {
			return $this->response('ajax', array(
				'success' => false,
				'errors' => $validation->getErrorsList()
			));
		}

		$user = check_password_reset_key($formData['key'], $formData['user']);

		if (! $user) {
			return $this->response('ajax', array(
				'success' => false,
				'errors' => array(
					$this->translate('Your password reset link appears to be invalid. Please request a new link.')
				)
			));
		}

		if (is_wp_error($user)) {
			return $this->response('ajax', array(
				'success' => false,
				'errors' => $user->get_error_messages()
			));
		}

		reset_password($user, $formData['password']);

		$loginUrl = $this->getModule('Routes')->getRouteUrl('login');
		$loginUrl = ' <a href="' . $loginUrl . '>' . $this->translate('Log in') . '</a>';

		return $this->response('ajax', array(
			'success' => true,
			'message' => $this->translate('Your password has been reset.') . ' ' . $loginUrl
		));
	}
}
