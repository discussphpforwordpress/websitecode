<?php

class Membership_Auth_Module extends Membership_Base_Module {

	public function afterModulesLoaded() {

		$this->addShortcodes();
		add_action('user_register', array($this, 'userRegistered'));
		add_action('mssl_import_facebook_avatar', array($this, 'importAvatar'));

		$settings = $this->getSettings();

		if (isset($settings['design']['auth']['login-google-recaptcha-enable']) &&
		    $settings['design']['auth']['login-google-recaptcha-enable'] === 'true') {

			if (isset(
				$settings['design']['auth']['login-google-recaptcha-site-key'],
				$settings['design']['auth']['login-google-recaptcha-secret-key'])) {

				$this->getDispatcher()->on('auth.enqueueLoginAssets', array($this, 'enqueueGoogleRecaptchaAssets'));
				$this->getDispatcher()->on('auth.view.loginFormAfter', array($this, 'loginFormAfterInsertGoogleRecaptcha'));

			}

		}

		$routesModule = $this->getModule('routes');

		$routesModule->registerAjaxRoutes(array(
				'auth.registration' => array(
					'method' => 'post',
					'guest' => true,
					'handler' => array($this->getController(), 'registrationHandler')
				),
				'auth.login' => array(
					'method' => 'post',
					'guest' => true,
					'handler' => array($this->getController(), 'loginHandler')
				),
				'auth.resetPassword' => array(
					'method' => 'post',
					'guest' => true,
					'handler' => array($this->getController(), 'resetPassword')
				),
				'auth.resetPasswordConfirmation' => array(
					'method' => 'post',
					'guest' => true,
					'handler' => array($this->getController(), 'resetPasswordConfirmation')
				),
				'auth.getNonce' => array(
					'method' => 'post',
					'guest' => true,
					'handler' => array($this->getController(), 'getNonceHandler')
				),
			)
		);

		$routesModule->registerOnRequestAction(
			array(
				array($this, 'onRequest')
			)
		);
	}

	public function importAvatar($picture){
        if(is_null($picture)){ return; }
        $formData = $_POST['formData'];
        $userId = null;
        if(!is_user_logged_in()){
            $username = $formData['user_login'];

            $user = get_user_by('login', $username);
            $userId = $user->ID;
        }else{
            $userId = get_current_user_id();
        }
        /**
         * @var $imagesModel Membership_Base_Model_Images
         */
        $imagesModel = $this->getModel('images', 'base');

        $attachmentId = $imagesModel->uploadAttachmentFromUrl($picture, $userId);

        $images = $imagesModel->createImagesFromAttachments(array($attachmentId), $userId);

        $avatarImage = array_pop($images);

        $cropData = array(
            'x' => 0,
            'y' => 0,
            'height' => $avatarImage['height'],
            'width' => $avatarImage['width'],
            'rotate' => 0
        );

        $settings = $this->getModule('base')->getSettings();

        $sizes = array(
            $settings['profile']['avatar-size'],
            $settings['profile']['avatar-large-size'],
            $settings['profile']['avatar-medium-size'],
            $settings['profile']['avatar-small-size']
        );

        foreach ($sizes as $size) {
            $imagesModel->cropImage($avatarImage, $cropData, $size['width'], $size['height']);
        }

        $imagesModel->setUserAvatar($userId, $avatarImage['id'], serialize($cropData));
    }

	public function enqueueLoginAssets() {
		$baseModule = $this->getModule('Base');
		$baseAssetsPath = $baseModule->getAssetsPath();
		$this->getModule('Assets')->enqueueAssets(
			array(
				$baseAssetsPath . '/lib/tooltipster/tooltipster.css',
			),
			array(
				'jquery',
				$baseAssetsPath . '/lib/validate.min.js',
				$baseAssetsPath . '/lib/supsystic/validation.js',
				$baseAssetsPath . '/lib/jquery.serializejson.min.js',
				$baseAssetsPath . '/lib/tooltipster/jquery.tooltipster.min.js',
				$this->getAssetsPath() . '/js/login.frontend.js',
			),
			MBS_FRONTEND
		);

		$this->getDispatcher()->dispatch('auth.enqueueLoginAssets');
	}

	public function enqueueRegistrationAssets() {
		$baseModule = $this->getModule('Base');
		$baseAssetsPath = $baseModule->getAssetsPath();
		$this->getModule('Assets')->enqueueAssets(
			array(
				$baseAssetsPath . '/lib/tooltipster/tooltipster.css',
			),
			array(
				'jquery',
				$baseAssetsPath . '/lib/validate.min.js',
				$baseAssetsPath . '/lib/supsystic/validation.js',
				$baseAssetsPath . '/lib/jquery.serializejson.min.js',
				$baseAssetsPath . '/lib/tooltipster/jquery.tooltipster.min.js',
				$this->getAssetsPath() . '/js/registration.frontend.js',
			),
			MBS_FRONTEND
		);

		$this->getDispatcher()->dispatch('auth.enqueueRegistrationAssets');
	}

	public function enqueueLoginModalAssets() {
		$this->enqueueLoginAssets();

		$this->getModule('Assets')->enqueueAssets(
			array(),
			array(
				$this->getAssetsPath() . '/js/login-modal.frontend.js',
			),
			MBS_FRONTEND
		);
	}

	// Redirect logged users from register and login pages and unregistered to login page
	public function onRequest($query, $requestedPageId, $routesList) {
		$routesModule = $this->getModule('routes');
		$settings = $this->getSettings();
		if (
			!is_admin()
			&& !is_user_logged_in()
		    && !in_array($requestedPageId, $routesList)
			&& $settings['base']['security']['global-site-access'] !== 'everyone'
		    && $settings['base']['security']['protect-all-pages'] === 'yes'
			&& !isset($query->membership['noRedirect'])
		) {
			wp_redirect($routesModule->getRouteUrl('login'));
			die();
		}

		// Redirect only from plugin-registered pages
		if (!in_array($requestedPageId, $routesList) || !isset($routesList['registration']) || !isset($routesList['login'])) {
			return $query;
		}

		if (!is_admin()) {
			if (is_user_logged_in()) {

				if (in_array($requestedPageId, array($routesList['registration'], $routesList['login']))) {
					$usersModule = $this->getModule('users');
					$currentUser = $usersModule->getCurrentUser();

					if ($currentUser['user_status'] < Membership_Users_Model_Fields::STATUS_ACTIVE) {
						wp_logout();
						wp_redirect($routesModule->getRouteUrl('login'));
						die();
					}

					wp_redirect($usersModule->getUserProfileUrl($currentUser));
					die();
				}

			} else {

				/**
				 * Redirect all requests to login page if user tries to access any page with global-site-access option
				 * set to different from "everyone" value. Except requested page is login or registration page.
				 * Or the user has just activated his account or changes password. @see Membership_Users_Module::onRequest()
				 */
				if (!in_array($requestedPageId, array($routesList['registration'], $routesList['login']))) {
					if ($settings['base']['security']['global-site-access'] !== 'everyone' && !isset($query->membership['noRedirect'])) {
                        wp_redirect($routesModule->getRouteUrl('login'));
                        die();
					}
				}
			}
		}

		/**
		 * Load assets for login and registration pages
		 */
		if (!is_admin()) {
			if ($requestedPageId === $routesList['login']) {
				$this->enqueueLoginAssets();
			}

			if ($requestedPageId === $routesList['registration']) {
				$this->enqueueRegistrationAssets();
			}
		}

		return $query;
	}

	public function userRegistered($userId) {
		$settings = $this->getSettings();
		$profileModel = $this->getModel('Profile', 'Users');
		$config = $this->getConfig();

		switch ($settings['profile']['registration-confirmation']) {
			case 'auto':
				$profileModel->setUserStatus($userId, Membership_Users_Model_Fields::STATUS_ACTIVE);
				break;
			case 'email-confirmation':
				update_user_meta($userId, $config->get('db_prefix') . 'activation_code', wp_generate_password(16, false));
				$profileModel->setUserStatus($userId, Membership_Users_Model_Fields::STATUS_EMAIL_NOT_CONFIRMED);
				break;
			case 'admin-confirmation':
				$profileModel->setUserStatus($userId, Membership_Users_Model_Fields::STATUS_PENDING_REVIEW);
				break;
		}

		$activityModel = $this->getModel('activity', 'activity');
		$activityModel->createActivity($userId, 'user_registered', null);
	}

	public function addShortcodes() {
		add_shortcode($this->getConfig('shortcode_name') . '-registration', 
			array($this->getController(), 'registrationShortcodeHandler')
		);

		add_shortcode($this->getConfig('shortcode_name') . '-login', 
			array($this->getController(), 'loginShortcodeHandler')
		);
	}

	public function loginFormAfterInsertGoogleRecaptcha() {
		$settings = $this->getSettings();
		print $this->render('@auth/partials/google-recaptcha-field.twig', array(
			'key' => $settings['design']['auth']['login-google-recaptcha-site-key'],
			'theme' => $settings['design']['auth']['login-google-recaptcha-theme'],
			'type' => $settings['design']['auth']['login-google-recaptcha-type'],
			'size' => $settings['design']['auth']['login-google-recaptcha-size'],
		));
	}

	public function enqueueGoogleRecaptchaAssets() {
		$this->getModule('Assets')->enqueueScripts(array(
			$this->getAssetsPath() . '/js/' . 'google-recaptcha.frontend.js',
			'https://www.google.com/recaptcha/api.js',
		), MBS_FRONTEND);
	}
}