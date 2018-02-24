<?php
class Membership_Mail_Module extends Membership_Base_Module {

    public function send($to, $subject, $message, $options) {

	    $settings = $this->getSettings();

	    $from = @$settings['mail']['emails']['mail-appears-from'];
	    $fromEmail = @$settings['mail']['emails']['mail-appears-from-address'];

        if (isset($options['variables'])) {
            $subject = $this->replaceVariables($subject, $options['variables']);
            $message = $this->replaceVariables($message, $options['variables']);
        }

	    $headers = array();
        $headers[]  = 'MIME-Version: 1.0';
        $headers[]  = 'Content-type: text/html; charset=UTF-8';

        if ($fromEmail) {

	        $headers[] = "From: {$from} <{$fromEmail}>";
        }

        $result = wp_mail($to, $subject, nl2br($message), $headers);
        $resultMessage = $this->translate('The message was sent');
        $errors = $this->getErrors();

        if (!empty($errors)) {
            $errorsMessage = implode(',', $errors);

            if ($errorsMessage !== '') {
                $resultMessage = $errorsMessage;
            }
        }

        if ($result) {
            $status = 200;
        } else {
            $status = 500;
        }

        return array(
            'success' => $result,
            'status' => $status,
            'message' => $resultMessage
        );
    }

    public function sendMail($type, $params) {

    	$settings = $this->getSettings();

    	switch ($type) {
		    case 'reset-password':
		    	$to = $params['email'];
		    	$subject = $settings['mail']['emails']['password-reset-email-subject'];
		    	$message = $settings['mail']['emails']['password-reset-email-body'];
				$options = array(
					'variables' => array(
						'password_reset_link' => $this->getModule('routes')->getRouteUrl('login', array(
							'action' => 'reset-password-confirmation',
							'key' => $params['key'],
							'user' => $params['login']
						)),
						'display_name' => $params['display_name']
					)
				);
		    	break;
		    case 'account-welcome-email':
			    $to = $params['email'];
			    $subject = $settings['mail']['emails']['account-welcome-email-subject'];
			    $message = $settings['mail']['emails']['account-welcome-email-body'];
			    $options = array(
				    'variables' => array(
					    'display_name' => $params['display_name'],
					    'login_url' => $params['login_url'],
					    'email' => $params['email'],
					    'username' => $params['username'],
					    'password' => $params['password'],
				    )
			    );
			    break;
		    case 'new-user-notification':
			    $to = $settings['mail']['notifications']['notifications-email-address'];
			    $subject = $settings['mail']['notifications']['new-user-notification-subject'];
			    $message = $settings['mail']['notifications']['new-user-notification-body'];
			    $options = array(
				    'variables' => array(
					    'display_name' => $params['display_name'],
					    'user_profile_link' => $params['user_profile_link'],
					    'submitted_registration' => $params['submitted_registration'],
				    )
			    );
		    	break;
		    case 'account-activation-email':
			    $to = $params['email'];
			    $subject = $settings['mail']['emails']['account-activation-email-subject'];
			    $message = $settings['mail']['emails']['account-activation-email-body'];
			    $options = array(
				    'variables' => array(
					    'account_activation_link' => $params['account_activation_link'],
				    )
			    );

		    	break;
		    case 'pending-review-email':
			    $to = $params['email'];
			    $subject = $settings['mail']['emails']['pending-review-email-subject'];
			    $message = $settings['mail']['emails']['pending-review-email-body'];
			    $options = array(
				    'variables' => array(
					    'display_name' => $params['display_name'],
				    )
			    );
		    	break;
		    case 'account-needs-review-notification':
			    $to = $settings['mail']['notifications']['notifications-email-address'];
			    $subject = $settings['mail']['notifications']['account-needs-review-notification-subject'];
			    $message = $settings['mail']['notifications']['account-needs-review-notification-body'];
			    $options = array(
				    'variables' => array(
					    'display_name' => $params['display_name'],
					    'user_profile_link' => $params['user_profile_link'],
					    'submitted_registration' => $params['submitted_registration'],
				    )
			    );
			    break;
		    case 'account-approved-email':
			    $to = $params['email'];
			    $subject = $settings['mail']['emails']['account-approved-email-subject'];
			    $message = $settings['mail']['emails']['account-approved-email-body'];
			    $options = array(
				    'variables' => array(
					    'display_name' => $params['display_name'],
					    'login_url' => $params['login_url'],
					    'email' => $params['email'],
					    'username' => $params['username'],
					    'password' => $params['password'],
				    )
			    );
			    break;
		    case 'account-rejected-email':
			    $to = $params['email'];
			    $subject = $settings['mail']['emails']['account-rejected-email-subject'];
			    $message = $settings['mail']['emails']['account-rejected-email-body'];
			    $options = array(
				    'variables' => array(
					    'display_name' => $params['display_name'],
				    )
			    );
			    break;
		    case 'account-deactivation-email':
			    $to = $params['email'];
			    $subject = $settings['mail']['emails']['account-deactivation-email-subject'];
			    $message = $settings['mail']['emails']['account-deactivation-email-body'];
			    $options = array(
				    'variables' => array(
					    'display_name' => $params['display_name'],
				    )
			    );
			    break;
		    case 'account-deleted-email':
			    $to = $params['email'];
			    $subject = $settings['mail']['emails']['account-deleted-email-subject'];
			    $message = $settings['mail']['emails']['account-deleted-email-body'];
			    $options = array(
				    'variables' => array(
					    'display_name' => $params['display_name'],
				    )
			    );
			    break;
		    case 'account-deletion-notification':
			    $to = $settings['mail']['notifications']['notifications-email-address'];
			    $subject = $settings['mail']['notifications']['account-deletion-notification-subject'];
			    $message = $settings['mail']['notifications']['account-deletion-notification-body'];
			    $options = array(
				    'variables' => array(
					    'display_name' => $params['display_name']
				    )
			    );
			    break;
		    case 'password-changed-email':
			    $to = $params['email'];
			    $subject = $settings['mail']['emails']['password-changed-email-subject'];
			    $message = $settings['mail']['emails']['password-changed-email-body'];
			    $options = array(
				    'variables' => array(
					    'display_name' => $params['display_name'],
					    'password_change_url' => $params['password_change_url'],
				    )
			    );
			    break;
			case 'notification-friends-followers':
				$to = $params['email'];
				$subject = $settings['mail']['emails']['notification-friends-followers-subject'];
				$message = $settings['mail']['emails']['notification-friends-followers-body'];
				$options = array(
					'variables' => array(
						'friend_follower' => $params['friend_follower'],
						'followers_url' => $params['followers_url'],
						'display_name' => $params['display_name'],
					)
				);
				break;
			case 'message-recieve-notification':
				$to = $params['email'];
				$subject = $settings['mail']['emails']['message-recieve-notification-subject'];
				$message = $settings['mail']['emails']['message-recieve-notification-body'];
				$options = array(
					'variables' => array(
						'display_name' => $params['display_name'],
						'from_username' => $params['from_username'],
						'message_url' => $params['message_url'],
					)
				);
				break;
	    }

    	return $this->send($to, $subject, $message, $options);
    }

    public function afterModulesLoaded() {


	    add_action('user_register', array($this, 'userRegistered'));

        $this->getDispatcher()->on('sendEmail', array($this, 'send'), 10, 4);

	    $this->getModule('routes')->registerAjaxRoutes(array(
		    'mail.saveSettings' => array(
			    'method' => 'post',
			    'admin' => true,
			    'handler' => array($this->getController(), 'saveSettings')
		    ),
		    'mail.sendTestMail' => array(
			    'method' => 'post',
			    'admin' => true,
			    'handler' => array($this->getController(), 'sendTestMail')
		    ),
		    'mail.getDefaultMailOptions' => array(
			    'method' => 'post',
			    'admin' => true,
			    'handler' => array($this->getController(), 'getDefaultMailOptions')
		    ),
	    ));

	    $this->getModel('Settings', 'Base')->addModelAlias('mail', $this->getModel('Settings', 'Mail'));

	    if (!$this->isModule('mail')) {
		    return;
	    }

	    $assetsPath = $this->getAssetsPath();

	    $this->getModule('assets')->enqueueAssets(
		    array(),
		    array(
			    $assetsPath . '/js/mail.backend.js',
		    )
	    );
    }

	/**
	 * Replace string variables according to array of variables
	 *
	 * Variables array should looks like array('site_name' => get_bloginfo('sitename'))
	 *
	 * @param $string string
	 * @param $variables array
	 *
	 * @return mixed|string $result
	 */
	public function replaceVariables($string, $variables) {

		$result = $string;

		$default = array(
			'site_name' => get_bloginfo('sitename'),
			'admin_email' => get_bloginfo('admin_email')
		);

		$variables = array_merge($default, $variables);

		foreach ($variables as $key => $value) {
			$result = str_replace('{'. $key. '}', $value, $result);
		}

		return $result;
	}

    public function getErrors() {
        global $ts_mail_errors;
        global $phpmailer;
        // Clear prev. send errors at first
        $ts_mail_errors = array();

        // Let's try to get errors about mail sending from WP
        if (!isset($ts_mail_errors)) $ts_mail_errors = array();

        if (isset($phpmailer)) {
            $ts_mail_errors[] = $phpmailer->ErrorInfo;
        }

        if(empty($ts_mail_errors)) {
            $ts_mail_errors[] = $this->translate('Cannot send email - problem with send server');
        }

        return $ts_mail_errors;
    }

	public function sendNewFriendFollowerNotification($params) {

		$profileModel = $this->getModel('Profile', 'Users');

		if(empty($params['user-from']) || empty($params['user-to']) || empty($params['notification-type'])) {
			return;
		}
		$userFrom = $profileModel->getUserById($params['user-from']);
		$userTo = $profileModel->getUserById($params['user-to']);
		if(!$userFrom || !$userTo) {
			return;
		}
		$settings = $this->getSettings();
		if(!isset($settings['mail']['emails']['notification-friends-followers'])
			|| $settings['mail']['emails']['notification-friends-followers'] == "false"
			|| $settings['mail']['emails']['notification-friends-followers'] == false) {
			return;
		}

		$notificationType = 'friend';
		$notificationUrl = $this->getRouteUrlForMail('profile') . $userTo['user_login'] . '/';
		if($params['notification-type'] != $notificationType) {
			$notificationType = 'follower';
			$notificationUrl .= 'followers/';
		} else {
			$notificationUrl .= 'friends/';
		}

		$sendRes = $this->sendMail('notification-friends-followers', array(
			'email' => $userTo['user_email'],
			'friend_follower' => $this->translate($notificationType),
			'followers_url' => $notificationUrl,
			'display_name' => $userTo['displayName'],
		));
		return $sendRes;
	}

	public function sendMessageNotification($params) {
		$profileModel = $this->getModel('Profile', 'Users');

		if(empty($params['user-from']) || empty($params['user-to'])) {
			return;
		}
		$userFrom = $profileModel->getUserById($params['user-from']);
		$userTo = $profileModel->getUserById($params['user-to']);
		if(!$userFrom || !$userTo) {
			return;
		}
		$settings = $this->getSettings();
		if(!isset($settings['mail']['emails']['message-recieve-notification'])
			|| $settings['mail']['emails']['message-recieve-notification'] == "false"
			|| $settings['mail']['emails']['message-recieve-notification'] == false) {
			return;
		}
		$messageUrl = $this->getRouteUrlForMail('profile') . $userTo['user_login'] . '/messages/';

		$sendRes = $this->sendMail('message-recieve-notification', array(
			'email' => $userTo['user_email'],
			'display_name' => $userTo['displayName'],
			'from_username' => $userFrom['displayName'],
			'message_url' => $messageUrl,
		));
		return $sendRes;
	}

    public function userRegistered($userId) {

		$settings = $this->getSettings();
		$profileModel = $this->getModel('Profile', 'Users');

	    if (!$user = $profileModel->getUserById($userId)) {
		    return;
	    }

	    switch ($settings['profile']['registration-confirmation']) {
		    case 'auto':
			    $this->sendAccountWelcomeEmail($user);
			    $this->sendNewUserNotificationEmail($user);
			    break;
		    case 'email-confirmation':
			    $this->sendAccountActivationEmail($user);
			    break;
		    case 'admin-confirmation':
				$this->sendPendingReviewEmail($user);
				$this->sendAccountNeedReviewNotificationEmail($user);
			    break;
	    }

    }

    public function sendAccountWelcomeEmail($user) {

	    $settings = $this->getSettings();

	    if ($settings['mail']['emails']['account-welcome-email'] === 'true') {
		    $request = $this->getRequest();
		    $password = '*******';

		    if ($request->post->has('formData')) {
			    $formData = $request->post->get('formData');
			    $password = $formData['user_pass'];
		    }

		    if ($request->post->has('user_pass')) {
			    $password = $request->post->get('user_pass');
		    }

		    $this->sendMail('account-welcome-email', array(
			    'email' => $user['user_email'],
			    'display_name' => $user['displayName'],
			    'login_url' => $this->getModule('Routes')->getRouteUrl('login'),
			    'username' => $user['user_login'],
			    'password' => $password,
		    ));
	    }
    }

    public function sendNewUserNotificationEmail($user) {

	    $settings = $this->getSettings();

	    if ($settings['mail']['notifications']['new-user-notification'] === 'true') {

		    $editUserUrl = admin_url('user-edit.php?user_id=' . $user['id']);

		    $fields = $this->getModel('Fields', 'Users')->getUserFieldsData($user['id'], array('user_pass', 'user_pass_confirm', 'g-recaptcha-response'));
		    $fields = $fields['fields'];

		    $this->sendMail('new-user-notification', array(
			    'display_name' => $user['displayName'],
			    'user_profile_link' => $editUserUrl,
			    'submitted_registration' => $this->render(
				    '@users/backend/admin-fields-view.twig',
				    array('fields' => $fields)
			    ),
		    ));
	    }
    }

    public function sendAccountActivationEmail($user) {

	    $usersModule = $this->getModule('users');
	    $userProfileUrl = $usersModule->getUserProfileUrl($user);

	    $activationCode = get_user_meta($user['id'], $this->getConfig()->get('db_prefix') . 'activation_code', $single = true);
	    $activationUrl = add_query_arg(array('activation_code' => $activationCode), $userProfileUrl);
	    $this->sendMail('account-activation-email', array(
		    'email' => $user['user_email'],
		    'account_activation_link' => $activationUrl,
	    ));

    }

	public function sendPendingReviewEmail($user) {
	    $settings = $this->getSettings();

	    if ($settings['mail']['emails']['pending-review-email'] === 'true') {
		    $this->sendMail('pending-review-email', array(
			    'email' => $user['user_email'],
			    'display_name' => $user['displayName'],
		    ));
	    }
    }

	public function sendAccountNeedReviewNotificationEmail($user) {

		$settings = $this->getSettings();

		if ($settings['mail']['notifications']['account-needs-review-notification'] === 'true') {

			$editUserUrl = admin_url('user-edit.php?user_id=' . $user['id']);

			$fields = $this->getModel('Fields', 'Users')->getUserFieldsData($user['id'], array('user_pass', 'user_pass_confirm', 'g-recaptcha-response'));
			$fields = $fields['fields'];

			$this->sendMail('account-needs-review-notification', array(
				'display_name' => $user['displayName'],
				'user_profile_link' => $editUserUrl,
				'submitted_registration' => $this->render(
					'@users/backend/admin-fields-view.twig',
					array('fields' => $fields)
				),
			));
		}
	}

	public function sendAccountApprovedEmail($user) {

		$settings = $this->getSettings();

		if ($settings['mail']['emails']['account-approved-email'] === 'true') {
			$password = '*******';

			$this->sendMail('account-approved-email', array(
				'email' => $user['user_email'],
				'display_name' => $user['displayName'],
				'login_url' => $this->getModule('Routes')->getRouteUrl('login'),
				'username' => $user['user_login'],
				'password' => $password,
			));
		}
	}

	public function sendAccountRejectedEmail($user) {
		$settings = $this->getSettings();

		if ($settings['mail']['emails']['account-rejected-email'] === 'true') {
			$this->sendMail('account-rejected-email', array(
				'email' => $user['user_email'],
				'display_name' => $user['displayName'],
			));
		}
	}

	public function sendAccountDisabledEmail($user) {
		$settings = $this->getSettings();

		if ($settings['mail']['emails']['account-deactivation-email'] === 'true') {
			$this->sendMail('account-deactivation-email', array(
				'email' => $user['user_email'],
				'display_name' => $user['displayName'],
			));
		}
	}

	public function sendAccountDeletedEmail($user) {
		$settings = $this->getSettings();

		if ($settings['mail']['emails']['account-deleted-email'] === 'true') {
			$this->sendMail('account-deleted-email', array(
				'email' => $user['user_email'],
				'display_name' => $user['displayName'],
			));
		}
	}

	public function sendAccountDeletedNotificationEmail($user) {

		$settings = $this->getSettings();
		if ($settings['mail']['notifications']['account-deletion-notification'] === 'true') {
			$this->sendMail('account-deletion-notification', array(
				'display_name' => $user['displayName'],
			));
		}
	}

	public function sendPasswordChangedEmail($user) {

		$usersModule = $this->getModule('users');
		$userProfileUrl = $usersModule->getUserProfileUrl($user);

		$passwordChangeCode = get_user_meta($user['id'], $this->getConfig()->get('db_prefix') . 'password_change_code', $single = true);
		$passwordChangeUrl = add_query_arg(array('password_change_code' => $passwordChangeCode), $userProfileUrl);
		$this->sendMail('password-changed-email', array(
			'display_name' => $user['displayName'],
			'email' => $user['user_email'],
			'password_change_url' => $passwordChangeUrl
		));
	}

	public function getRouteUrlForMail($code) {
		$url = $this->getModule('Routes')->getRouteUrl($code);
		// fix for permalinks without last slash
		$url = rtrim($url, '/');
		$url .= '/';
		return $url;
	}
}