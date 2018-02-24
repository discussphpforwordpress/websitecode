<?php
class Membership_Users_Module extends Membership_Base_Module {

	private static $isInitSendMessageModalWnd = false;
	private static $isInitSendMessageAttTempl = false;

	private $currentUser;
	private $requestedUser;

	public function getCurrentUser() {
		if (!$this->currentUser) {
			$this->currentUser = $this->getModel('profile')->getCurrentUser();
			if ($this->currentUser) {

				$this->currentUser = $this->getDispatcher()->apply(
					'badges.addBadgesOne',
					array($this->currentUser)
				);

				$this->getTwig()->addGlobal('currentUser', $this->currentUser);
			}
		}
		return $this->currentUser;
	}

	public function getCurrentUserPermissions() {
		$currentUser = $this->getCurrentUser();
		return $currentUser['permissions'];
	}

	public function getCurrentId() {
		$this->getCurrentUser();
		return $this->currentUser ? $this->currentUser['id'] : false;
	}

	public function getRequestedUser() {
		return $this->requestedUser;
	}

	public function afterModulesLoaded() {

		$this->setUserLastSeenDate();
		$this->checkCurrentUserPermission();

		$this->registerTwigExtension();
		$this->registerAjaxRoutes();
		$this->registerShortcodes();

		add_action('setup_theme', array($this, 'registerRewriteRules'));

		$this->getModule('routes')->registerOnRequestAction(
			array(
				10 => array($this, 'onRequest')
			),
			$priority = 10
		);

		// Backend profile
		add_action('show_user_profile', array($this, 'showAdminProfileFields'));
		add_action('edit_user_profile', array($this, 'showAdminProfileFields'));
		add_action('user_new_form', array($this, 'showAdminProfileFields'));
		add_action('personal_options_update', array($this->getController(), 'adminProfileFieldsUpdate'));
		add_action('edit_user_profile_update', array($this->getController(), 'adminProfileFieldsUpdate'));
		add_action('init', array($this, 'initAction'));

		$this->getDispatcher()->on('users.addToFriends', array($this, 'addToFriends'), 10, 2);
		$this->getDispatcher()->on('users.addToFollowers', array($this, 'addToFollowers'), 10, 2);
		$this->getDispatcher()->on('activity.relatedDataPrepare', array($this, 'activityDataPrepare'), 10, 2);
		$this->getDispatcher()->on('activity.relatedData', array($this, 'activityData'), 10, 2);
		$this->getDispatcher()->on('activity.buildActivitySelectQuery', array($this, 'activityQueryBuild'), 10, 1);
		$this->getDispatcher()->on('activity.view.activityTitle', array($this, 'activityTitle'), 10, 1);
		$this->getDispatcher()->on('activity.view.activityContent', array($this, 'activityContent'), 10, 1);
		$this->getDispatcher()->on('userBadges', array($this, 'membersShortcodeHandler'));
		$this->getDispatcher()->on('users.send.message.modal.wnd', array($this, 'renderSendMessageModalWnd'), 10, 1);
		$this->getDispatcher()->on('users.send.message.attachment.template', array($this, 'renderSendMessageAttachmTemplate'), 10, 1);

		if (!$this->isModule('users')) {
			return;
		}

		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/users.backend.css',
				$assetsPath . '/css/profile.backend.css',
			),
			array(
				$assetsPath . '/js/profile.backend.js',
				$assetsPath . '/js/users.backend.js',
			)
		);
	}

	public function setUserLastSeenDate() {
		if (is_user_logged_in()) {
			update_user_meta(get_current_user_id(), $this->getConfig('hooks_prefix') . 'last_activity', time());
		}

	}

	public function initAction() {
		$currentUser = $this->getCurrentUser();
		$this->registerFrontendData(array(
			'currentUser' => array(
				'id' => $currentUser['id'],
				'displayName' => $currentUser['displayName']
			),
			'profile' => array(
				'baseUrl' => $this->getProfileBaseUrl(),
				'permalinkBase' => $this->getProfilePermalinkBase()
			)
		));
	}

	public function checkCurrentUserPermission() {
		$permissions = $this->getCurrentUserPermissions();

		if ($permissions['can-access-wp-admin'] === 'false') {

			if (is_admin() && ! defined('DOING_AJAX') && !current_user_can('manage_options')) {
				add_action('admin_init', array($this->getModule('routes'), 'redirect404'), 0);
				add_filter('body_class', '__return_false');
			}
		}

		if ($permissions['can-see-admin-bar'] === 'false') {
			show_admin_bar(false);
			add_filter('show_admin_bar', '__return_false');
		}
	}

	public function registerAjaxRoutes() {

		$routesModule = $this->getModule('routes');

		$routesModule->registerAjaxRoutes(array(
			'users.saveSettings' => array(
				'admin' => true,
				'method' => 'post',
				'handler' => array($this->getController(), 'saveSettings')
			),

			'users.showAllMembers' => array(
				'admin' => true,
				'method' => '',
				'handler' => array($this, 'membersShortcodeHandler')
			),

			'users.getFields' => array(
				'admin' => true,
				'method' => 'get',
				'handler' => array($this->getController(), 'getFields')
			),

			'users.saveFields' => array(
				'admin' => true,
				'method' => 'post',
				'handler' => array($this->getController(), 'saveFields')
			),

            'users.setStatus' => array(
                'admin' => true,
                'method' => 'post',
                'handler' => array($this->getController(), 'setStatus')
            ),

            'users.changeAvatar' => array(
                'method' => 'post',
                'handler' => array($this->getController(), 'changeAvatar')
            ),

			'users.activity.get' => array(
				'method' => 'get',
				'handler' => array($this->getController(), 'getActivity'),
				'guest' => true
			),

			'users.settings.updateAccountData' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'updateAccountData')
			),
			'users.settings.changePassword' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'changePassword')
			),
			'users.settings.changeEmail' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'changeEmail')
			),
			'users.settings.updatePrivacy' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'updatePrivacy')
			),
			'users.settings.saveUserNotificationsSettings' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'saveUserNotificationsSettings')
			),
			'users.search' => array(
				'method' => 'get',
				'handler' => array($this->getController(), 'search'),
				'guest' => true
			),
			'users.get' => array(
				'method' => 'get',
				'handler' => array($this->getController(), 'getUsers'),
                'guest' => true
			),
			'users.fields.save' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'saveAboutFields')
			),
			'users.bulkUpdate' => array(
				'method' => 'post',
				'admin' => true,
				'handler' => array($this->getController(), 'bulkUpdate')
			),
			'users.wpLogout' => array(
				'method' => 'post',
				'handler' => array($this->getController(), 'wpLogout'),
			),
		));

        $settings = $this->getSettings();

        if ($settings['base']['main']['friends'] === 'true') {
            $routesModule->registerAjaxRoutes(array(
                'users.friends.add' => array(
		            'method' => 'post',
		            'handler' => array($this->getController(), 'addFriend')
	            ),
                'users.friends.remove' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'removeFriend')
                ),
                'users.friends.get' => array(
                    'method' => 'get',
                    'handler' => array($this->getController(), 'getFriends'),
                    'guest' => true
                ),
                'users.friends.getFriendshipRequests' => array(
                    'method' => 'get',
                    'handler' => array($this->getController(), 'getFriendshipRequests')
                ),
            ));
        }

        if ($settings['base']['main']['followers'] === 'true') {
            $routesModule->registerAjaxRoutes(array(
                'users.follows.get' => array(
                    'method' => 'get',
                    'handler' => array($this->getController(), 'getFollows'),
                    'guest' => true
                ),
                'users.followers.get' => array(
                    'method' => 'get',
                    'handler' => array($this->getController(), 'getFollowers'),
                    'guest' => true
                ),
//                'users.followers.post' => array(
//	                'method' => 'post',
//	                'handler' => array($this->getController(), 'getFollowers'),
//                ),
                'users.followers.follow' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'follow')
                ),
                'users.followers.unfollow' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'unfollow')
                ),
            ));
        }


		if ($this->currentUser['permissions']['can-delete-their-account'] === 'true') {
			$routesModule->registerAjaxRoutes(array(
				'users.settings.deleteAccount' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'deleteAccount')
				)
			));
		}

        $settings = $this->getSettings();

		if (//$settings['profile']['use-avatar'] == self::MBS_YES && $settings['profile']['use-gravatar'] == self::MBS_NO
			// todo: $settings['profile']['use-avatar'] and $settings['profile']['use-gravatar'] options are moved to design section, restore option check after design section is completed
            true) {
			$routesModule->registerAjaxRoutes(array(
				'users.changeAvatar' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'changeAvatar')
				),
				'users.removeAvatar' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'removeAvatar')
				),
			));
		}

		if ($settings['profile']['use-cover'] == self::MBS_YES) {
			$routesModule->registerAjaxRoutes(array(
				'users.changeCover' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'changeCover')
				),
				'users.removeCover' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'removeCover')
				)
			));
		}

        if (isset($settings['base']['main']['posts']) && $settings['base']['main']['posts'] === 'true') {
            $routesModule->registerAjaxRoutes(array(
                'users.posts.get' => array(
                    'method' => 'get',
                    'handler' => array($this->getController(), 'getPosts'),
                    'guest' => true
                )
            ));
        }

        if (isset($settings['base']['main']['comments']) && $settings['base']['main']['comments'] === 'true') {
            $routesModule->registerAjaxRoutes(array(
                'users.comments.get' => array(
                    'method' => 'get',
                    'handler' => array($this->getController(), 'getComments'),
                    'guest' => true
                )
            ));
        }
	}

	public function getCurrentUserRole() {
		$rolesModel = $this->getModel('Roles', 'Roles');

		if (is_user_logged_in()) {
			$currentUser = $this->getCurrentUser();
			return $rolesModel->getUserRole($currentUser['id']);
		} else {
			return $rolesModel->getDefaultGuestRole();
		}
	}

    public function getCurrentUserRolesAccessPermissions() {
		$role = $this->getCurrentUserRole();
		return $role['permissions']['access-to-specific-roles-page'];
    }

	public function setTitle($title) {
        $settings = $this->getSettings();

		return str_replace(
			'{display_name}',
			$this->requestedUser['displayName'],
            $settings['base']['seo']['profile-title']
		);
	}

	public function addDescription() {
        $settings = $this->getSettings();
        // https://codex.wordpress.org/Meta_Tags_in_WordPress
		$description =  str_replace(
			array(
				'{display_name}',
				'{site_name}'
			),
			array(
				$this->requestedUser['displayName'],
				get_bloginfo('name')
			),
            $settings['base']['seo']['profile-description']
		);

		print '<meta name="description" content="' . $description . '" />';
	}

	public function dequeueConflictStyles() {
		wp_dequeue_style('um_minified');
	}

	public function dequeueConflictScripts() {
		wp_dequeue_script('um_minified');
	}

	// Redirect current user to their profile
	public function onRequest($query, $requestedPageId, $routesList) {

		$settings = $this->getSettings();
		$request = $this->getRequest();
		$usersModel = $this->getModel('Profile');

		if  (in_array($requestedPageId, $routesList)) {
			add_action('wp_print_styles', array($this, 'dequeueConflictStyles'), 100);
			add_action('wp_print_scripts', array($this, 'dequeueConflictScripts'), 100);
		}

		/**
		 * Get requested user
		 */
		if (isset($query->query_vars['user'])) {
			$requestUserName = urldecode($query->query_vars['user']);
			if ($this->getProfilePermalinkBase() === 'username') {
				$this->requestedUser = $usersModel->getUserByUsername($requestUserName);
			} else {
				$this->requestedUser = $usersModel->getUserById($requestUserName);
			}
			$this->requestedUser = $this->getDispatcher()->apply(
				'badges.addBadgesOne',
				array($this->requestedUser)
			);
		}

		/**
		 * Check activation code and set user state if user activation code is confirmed
		 */
		if ($request->query->has('activation_code') && $this->requestedUser) {

			$activationCodeMetaName = $this->getConfig()->get('db_prefix') . 'activation_code';
			$storedActivationCode = get_user_meta(
				$this->requestedUser['id'],
				$activationCodeMetaName,
				$single = true);

			$activationCode = $request->query->get('activation_code');

			if  ($storedActivationCode === $activationCode) {
				$profileModel = $this->getModel('Profile', 'Users');
				$profileModel->updateUserStatus($this->requestedUser['id'], Membership_Users_Model_Fields::STATUS_ACTIVE);
				$query->membership['noRedirect'] = true;
				delete_user_meta($this->requestedUser['id'], $activationCodeMetaName);
				$mailModule = $this->getModule('Mail');
				$mailModule->sendAccountWelcomeEmail($this->requestedUser);
				$mailModule->sendNewUserNotificationEmail($this->requestedUser);
				$this->getModule('Routes')->replaceContentWith('@users/account-confirmed.twig');
				return;
			}
		}


		/**
		 * Change password by link from email
		 */
		if ($request->query->has('password_change_code') && $this->requestedUser) {

			$changePasswordCodeMetaName = $this->getConfig()->get('db_prefix') . 'password_change_code';
			$passwordHashCodeMetaName = $this->getConfig()->get('db_prefix') . 'password_change_hash';

			$storedPasswordChangeCode = get_user_meta(
				$this->requestedUser['id'],
				$changePasswordCodeMetaName,
				$single = true);

			$storedPasswordHash = get_user_meta(
				$this->requestedUser['id'],
				$passwordHashCodeMetaName,
				$single = true);

			$passwordChangeCode = $request->query->get('password_change_code');

			if  ($storedPasswordChangeCode === $passwordChangeCode) {
				$this->getModel('Profile')->setHashedPasswordToUser($this->requestedUser['id'], $storedPasswordHash);
				delete_user_meta($this->requestedUser['id'], $changePasswordCodeMetaName);
				delete_user_meta($this->requestedUser['id'], $passwordHashCodeMetaName);
				$query->membership['noRedirect'] = true;
				$this->getModule('Routes')->replaceContentWith('@users/password-changed.twig');
			}
		}


		/**
		 * Check current user status and show error message if needs.
		 */
		if (is_user_logged_in()) {
			$user = $this->getCurrentUser();
			$userStatus = is_null($user['user_status']) ? Membership_Users_Model_Fields::STATUS_PENDING_REVIEW : intval($user['user_status']);

			$protectAllPages = $settings['base']['security']['protect-all-pages'] === 'yes';

			if (in_array($requestedPageId, $routesList) || $protectAllPages) {
				switch ($userStatus) {
					case Membership_Users_Model_Fields::STATUS_DISABLED:
						$this->getModule('Routes')->replaceContentWith(
							'@base/error.twig',
							array('error' => $this->translate('Your account has been disabled.'))
						);
						break;
					case Membership_Users_Model_Fields::STATUS_REJECTED:
						$this->getModule('Routes')->replaceContentWith(
							'@base/error.twig',
							array('error' => $this->translate('Your account has been rejected.'))
						);
						break;
					case Membership_Users_Model_Fields::STATUS_DELETED:
						$this->getModule('Routes')->replaceContentWith(
							'@base/error.twig',
							array('error' => $this->translate('Your account has been deleted.'))
						);
						break;
					case Membership_Users_Model_Fields::STATUS_PENDING_REVIEW:
						$this->getModule('Routes')->replaceContentWith(
							'@base/error.twig',
							array('error' => $this->translate('Your account is awaiting admin approval.'))
						);
						break;
					case Membership_Users_Model_Fields::STATUS_EMAIL_NOT_CONFIRMED:
						$request = $this->getRequest();
						if ($request->query->has('activation_code')) {

						} else {
							$this->getModule('Routes')->replaceContentWith(
								'@base/error.twig',
								array('error' => $this->translate('You must confirm your account email address. Check your email for confirmation link.'))
							);
						}
						break;
				}
			}
		}


		if (!is_admin()) {

			/**
			 * Enqueue assets
			 */
			if (@($routesList['profile'] == $requestedPageId)) {

				$this->enqueueProfileAssets();

				if (isset($query->query_vars['activity']) ||
				    !isset($query->query_vars['action']) ||
				    $query->query_vars['action'] == 'activity'
				) {
					$this->getModule('Activity')->enqueueActivitiesAssets();
				}

				if (isset($query->query_vars['action'])) {
					switch ($query->query_vars['action']) {
						case 'about':
							$this->enqueueAboutAssets();
							break;
						case 'groups':
							$this->getModule('Groups')->enqueueGroupsListAssets();
							break;
						case 'friends':
							$this->enqueueFriendsAssets();
							break;
						case 'followers':
							$this->enqueueFollowersAssets();
							break;
						case 'messages':
							$this->getModule('Messages')->enqueueMessagesAssets();
							$this->enqueueAttachmentAssets();
							break;
						case 'posts':
							$this->enqueuePostsAssets();
							break;
						case 'comments':
							$this->enqueueCommentsAssets();
							break;
						case 'settings':
							$this->enqueueSettingsAssets();
							break;
						case 'notifications':
							$this->getModule('Notifications')->enqueueNotificationsAssets();
							break;
						case 'activity':
						case 'favorites':
						default:
							$this->getModule('Activity')->enqueueActivitiesAssets();
							break;
					}
				}
			}

			if (@($routesList['members'] == $requestedPageId)) {
				$this->enqueueMembersAssets();
			}

			if (isset($routesList['profile']) && $requestedPageId == $routesList['profile']) {

                if (!is_user_logged_in()) {
                	$username = isset($query->query_vars['user']) ? $query->query_vars['user'] : null;

	                /**
	                 * Redirect guest user to members page if not username is specified
	                 */
                	if (!$username) {
                        wp_redirect($this->getModule('Routes')->getRouteUrl('members'));
                        exit;
                	}
                }

                $usersModel = $this->getModel('profile');

				if (isset($query->query_vars['user'])) {

					/**
					 * Show error message if user status is not active or user not found
					 */
					if (! $this->requestedUser) {
						$this->getModule('Routes')->replaceContentWith(
							'@base/error.twig',
							array('error' => $this->translate('Profile is not exists.'))
						);
					} else {
						$currentUser = $this->getCurrentUser();
						if (($currentUser['id'] !== $this->requestedUser['id'])) {
							if (is_null($this->requestedUser['user_status']) ||
							    intval($this->requestedUser['user_status']) !== Membership_Users_Model_Fields::STATUS_ACTIVE) {
								$this->getModule('Routes')->replaceContentWith(
									'@base/error.twig',
									array('error' => $this->translate('Profile is not exists.'))
								);
							}
							$this->enqueueUsersListsAssets();
						}
					}

					if (isset($query->query_vars['activity'])) {
						$this->registerFrontendData(array('requestedActivity' => $query->query_vars['activity']));
					}

					$this->getTwig()->addGlobal('requestedUser', $this->requestedUser);

					$this->registerFrontendData(array('requestedUser' => array(
						'id' => $this->requestedUser['id'],
						'displayName' => $this->requestedUser['displayName'],
					)));

					add_filter('pre_get_document_title', array($this, 'setTitle'), 20, 2);
					add_action('wp_head', array($this, 'addDescription'), 2);

				} else {
					wp_redirect($this->getUserProfileUrl($usersModel->getCurrentUser()));
                    exit;
                }
			}
		}


		return $query;
	}

	public function enqueueProfileAssets() {
		$assetsPath = $this->getAssetsPath();
		$baseModule = $this->getModule('Base');
		$baseAssetsPath = $baseModule->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/profile.frontend.css',
				$baseAssetsPath . '/lib/cropper/cropper.min.css',

			),
			array(
				$assetsPath . '/js/profile.frontend.js',
				$baseAssetsPath . '/lib/cropper/cropper.min.js',
			),
			MBS_FRONTEND
		);

		if (! is_user_logged_in()) {
			$authModule = $this->getModule('Auth');
			$authModule->enqueueLoginModalAssets();
		}
	}

	public function enqueueMembersAssets() {
		$this->enqueueUsersListsAssets();
		$this->getModule('assets')->enqueueAssets(
			array(),
			array(
				$this->getAssetsPath() . '/js/members.frontend.js',
			),
			MBS_FRONTEND
		);

		if (! is_user_logged_in()) {
			$authModule = $this->getModule('Auth');
			$authModule->enqueueLoginModalAssets();
		}
	}

	public function enqueueSettingsAssets() {

		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(),
			array(
				$assetsPath . '/js/settings.frontend.js'
			),
			MBS_FRONTEND
		);

		$this->getDispatcher()->dispatch('users.enqueueSettingsAssets');
	}

	public function enqueueAboutAssets() {

		$assetsPath = $this->getAssetsPath();
		$baseModule = $this->getModule('Base');
		$baseAssetsPath = $baseModule->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(
				$baseAssetsPath . '/lib/pikaday/css/pikaday.css',

			),
			array(
				$baseAssetsPath . '/lib/moment/moment.min.js',
				$baseAssetsPath . '/lib/pikaday/pikaday.js',
				$assetsPath . '/js/about.frontend.js'
			),
			MBS_FRONTEND
		);

	}

	public function enqueueFriendsAssets() {
		$this->enqueueUsersListsAssets();
		$assetsPath = $this->getAssetsPath();
		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/friends.frontend.css'
			),
			array(
				$assetsPath . '/js/friends.frontend.js'
			),
			MBS_FRONTEND
		);
	}

	public function enqueueFollowersAssets() {
		$this->enqueueUsersListsAssets();
		$assetsPath = $this->getAssetsPath();
		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/followers.frontend.css'
			),
			array(
				$assetsPath . '/js/followers.frontend.js'
			),
			MBS_FRONTEND
		);
	}

	public function enqueuePostsAssets() {

		$baseModule = $this->getModule('Base');
		$assetsPath = $this->getAssetsPath();
		$baseAssetsPath = $baseModule->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(),
			array(
				$baseAssetsPath . '/lib/moment/moment.min.js',
				$assetsPath . '/js/posts.frontend.js'
			),
			MBS_FRONTEND
		);
	}

	public function enqueueCommentsAssets() {

		$baseModule = $this->getModule('Base');
		$assetsPath = $this->getAssetsPath();
		$baseAssetsPath = $baseModule->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(),
			array(
				$baseAssetsPath . '/lib/moment/moment.min.js',
				$assetsPath . '/js/comments.frontend.js'
			),
			MBS_FRONTEND
		);
	}

	public function enqueueUsersListsAssets() {
		$assetsPath = $this->getAssetsPath();
		$this->getModule('assets')->enqueueAssets(
			array(
				array(
					'source' => $assetsPath . '/css/users-list.frontend.css',
					'dependencies' => array('semantic-ui')
				)
			),
			array(
				$assetsPath . '/js/attachment.frontent.js',
				$assetsPath . '/js/users-list.frontend.js',
			),
			MBS_FRONTEND
		);
	}

	public function enqueueAttachmentAssets() {
		$assetsPath = $this->getAssetsPath();
		$this->getModule('assets')->enqueueAssets(array(

			), array(
				$assetsPath . '/js/attachment.frontent.js',
			), MBS_FRONTEND
		);
	}

	public function registerShortcodes() {
		add_shortcode($this->getConfig('shortcode_name') . '-profile',
			array($this, 'shortcodeHandler'));
        add_shortcode($this->getConfig('shortcode_name') . '-members',
            array($this, 'membersShortcodeHandler'));
		add_shortcode($this->getConfig('shortcode_name') . '-user-avatar', array($this, 'userAvatarShortCodeHandler'));
	}

	public function registerRewriteRules() {
		$routesModule = $this->getModule('routes');
		$routesModule->addQueryVars(array('user', 'action', 'type', 'activity'));

		$pageId = $routesModule->getPageIdByRoute('profile');

		if ($pageId) {

			// permalink starts from page slug
			$slug = basename( get_permalink($pageId) );
			$pos = strpos($routesModule->getRouteUrl('profile'), $slug);
			$permalink = substr($routesModule->getRouteUrl('profile') , $pos);

			if ($permalinkStructure = get_option('permalink_structure')) {
				if (substr($permalinkStructure, -1) !== '/') {
					$permalink .= '/';
				}
			}

			$routesModule->addRewriteRule(
				'^' . $permalink . '([\%@A-Za-z-0-9._-]+)/?$',
				'index.php?page_id=' . $pageId . '&user=$matches[1]'
			);

			$routesModule->addRewriteRule(
				'^' . $permalink . '([\%@A-Za-z-0-9._-]+)/([A-Za-z-0-9]+)/?$',
				'index.php?page_id=' . $pageId . '&user=$matches[1]&action=$matches[2]'
			);

			$routesModule->addRewriteRule(
				'^' . $permalink . '([\%@A-Za-z-0-9._-]+)/(activity)/([0-9]+)/?$',
				'index.php?page_id=' . $pageId . '&user=$matches[1]&action=$matches[2]&activity=$matches[3]'
			);

			$routesModule->addRewriteRule(
				'^' . $permalink . '([\%@A-Za-z-0-9._-]+)/([A-Za-z-0-9]+)/([A-Za-z-0-9]+)/?$',
				'index.php?page_id=' . $pageId . '&user=$matches[1]&action=$matches[2]&type=$matches[3]'
			);
		}
	}

	public function membersShortcodeHandler($params = array()) {

		$userMetaKey = isset($params['meta_key']) ? $params['meta_key'] : false;
		$userMetaValue = isset($params['meta_value']) ? $params['meta_value'] : false;
		$currentUser = $this->getCurrentUser();
		$currentId = $currentUser['id'];

		if (!$this->currentUserCan('access-to-members-page')) {
			return $this->render('@base/error.twig', array('error' => $this->translate('Your account don\'t have permission to see members page')));
		}

		$settings = $this->getSettings();

		$profileModel = $this->getModel('Profile');
		$rolesModel = $this->getModel('roles', 'roles');
		$data = array();
		$usersPerRequest = 10;
		$search = $this->getRequest()->query->get('search', null);
		$userRoleId = $this->getRequest()->query->get('role_id', 0);

//		/**
//		 * Check if user privacy rule (show in members directory) set to yes
//		 * (or privacy is not set then it means yes by default) otherwise exclude from result
//		 */
//		$extraQuery = "LEFT JOIN {wp_base_prefix}usermeta AS um ON (um.user_id = u.ID and meta_key = 'membership_privacy')";
//		$extraWhere = "AND (um.meta_value REGEXP '.*\"show-in-members-directory\";s:[0-9]+:\"yes\".*' OR um.meta_value IS NULL)";

		if (@$settings['design']['members']['show-pages'] === 'true') {
			$page = $this->getRequest()->query->get('offset', 1);
			$userType = $this->getRequest()->query->get('type', 'all');
			$offset = ($page - 1) * $usersPerRequest;

			$data['currentPage'] = $page;
			$data['userRoleId'] = $userRoleId;
			global $wp;
			$data['membersPageUrl'] = home_url( $wp->request );

			if ($search || $userRoleId) {
				$dataArray = array(
					'search' => $search,
					'userRoleId' => $userRoleId,
					'searchBy' => array(
						'username' => 1,
						'lastname' => 1,
						'firstname' => 1,
					),
				);

				$totalCount = $profileModel->getUsersCountByParams($dataArray);
				$data['totalPages'] = max(ceil($totalCount / $usersPerRequest), 1);

				$dataArray['limit'] = $usersPerRequest;
				$dataArray['offset'] = $offset;

				if($userMetaKey && $userMetaValue){
					$dataArray['meta_key'] = $userMetaKey;
					$dataArray['meta_value'] = $userMetaValue;
				}

				$users = $profileModel->getUsersIdsByParams($dataArray);
				if ($users) {
					$_users = implode(', ', $users);
					$orderBy = " ORDER BY FIELD (u.ID, $_users)";
					$users = $profileModel->getUsersByIds(array('users' => $users, 'orderBy' => $orderBy));
				}

				$data['users'] = $users;
			} else {
				$dataArray = array(
					'userRoleId' => $userRoleId,
					'searchBy' => array(
						'username' => 1,
						'lastname' => 1,
						'firstname' => 1,
					),
					'userType' => $userType,
				);

				$totalCount = $profileModel->getUsersCountByParams($dataArray);
				$data['totalPages'] = max(ceil($totalCount / $usersPerRequest), 1);

				$dataArray['limit'] = $usersPerRequest;
				$dataArray['offset'] = $offset;

				if($userMetaKey && $userMetaValue){
					$dataArray['meta_key'] = $userMetaKey;
					$dataArray['meta_value'] = $userMetaValue;
				}

				//$userType = 'followers';
				switch ($userType) {
					case 'all':
						$users = $profileModel->getUsersIdsByParams($dataArray);
						if ($users) {
							$_users = implode(', ', $users);
							$orderBy = " ORDER BY FIELD (u.ID, $_users)";
							$users = $profileModel->getUsersByIds(array('users' => $users, 'orderBy' => $orderBy));
						}
						$data['users'] = $users;
						$data['userType'] = $userType;
						break;
					case 'friends':
						$totalCount = $currentUser['friends'];
						$data['totalPages'] = max(ceil($totalCount / $usersPerRequest), 1);
						$data['users'] = $this->getModel('Friends')->getUserFriends($currentId, $usersPerRequest, $offset);
						$data['userType'] = $userType;
						break;
					case 'follows':
						$totalCount = $currentUser['follows'];
						$data['totalPages'] = max(ceil($totalCount / $usersPerRequest), 1);
						$data['users'] = $this->getModel('Followers')->getUserFollows($currentId, $usersPerRequest, $offset);
						$data['userType'] = $userType;
						break;
					case 'followers':
						$totalCount = $currentUser['followers'];
						$data['totalPages'] = max(ceil($totalCount / $usersPerRequest), 1);
						$data['users'] = $this->getModel('Followers')->getUserFollowers($currentId, $usersPerRequest, $offset);
						$data['userType'] = $userType;
						break;
				}

			}

		} else {
			if ($search) {
				$dataArray = array(
					'search' => $search,
					'limit' => $usersPerRequest,
					'offset' => 0
				);
				if($userMetaKey && $userMetaValue){
					$dataArray['meta_key'] = $userMetaKey;
					$dataArray['meta_value'] = $userMetaValue;
				}
				$usersFirst = $profileModel->searchByName($dataArray);
				$usersSecond = $profileModel->searchByName($dataArray, true);
				$users = array_unique(array_merge($usersFirst, $usersSecond));

				if ($users) {
					$_users = implode(', ', $users);
					$orderBy = " ORDER BY FIELD (u.ID, $_users)";
					$users = $profileModel->getUsersByIds(array('users' => $users, 'orderBy' => $orderBy));
				}

				$data['users'] = $users;
			} else {
				$dataArray = array(
					'limit' => $usersPerRequest,
					'offset' => 0
				);
				if($userMetaKey && $userMetaValue){
					$dataArray['meta_key'] = $userMetaKey;
					$dataArray['meta_value'] = $userMetaValue;
				}
				$data['users'] = $profileModel->getUsers($dataArray);
			}
		}
		if($currentUser){
			$dataArray['limit'] = 100000;
			$totalCount = count($profileModel->getUsers($dataArray));
			$data['current_user_id'] = $currentId;
			$data['user'] = $currentUser;
			$data['total_count'] = $totalCount;
		}

		$data['userRoleList'] = $rolesModel->getUserRolesForSelect($userRoleId);

		return $this->render('@users/members.twig', $data);
	}

	public function shortcodeHandler($attributes) {
		$requestedUser = $this->requestedUser;
		$currentUser = $this->currentUser;

		$settings = $this->getSettings();
		
		if ($requestedUser) {
			$isCurrentUser = $requestedUser['id'] === $currentUser['id'];

			/**
			 * Check if current user has permission to view requested user profile.
			 */
			if (!$isCurrentUser) {
				$rolesAccess = $this->getCurrentUserRolesAccessPermissions();
				// fix empty data
				if(!$rolesAccess) {
					$rolesAccess = array();
				}

				if (isset($requestedUser['role_id']) &&
				    !in_array($requestedUser['role_id'], $rolesAccess) &&
				    !in_array('all', $rolesAccess)) {

					return $this->render('@base/error.twig', array(
						'error' => $this->translate('You don\'t have permissions to access this user profile.')
					));
				}

				if (!$this->currentUserHasPermission('view-profile', $requestedUser)) {
					return $this->render('@base/error.twig', array(
						'error' => $this->translate('This user is restrict access to his profile.')
					));
				}
			}

			$renderData = array();
			$renderData['action'] = get_query_var('action');
			$renderData['template'] = null;
			$renderData['error'] = false;

			if (empty($renderData['action']) && !$this->currentUserCan('access-to-profile-activity-page')) {
				$renderData['action'] = 'about';
			}

			/**
			 * Set about page as default if activity disabled in settings.
			 */
			if (empty($renderData['action'])) {
			    if ($settings['base']['main']['activity'] === 'true') {
                    $renderData['action'] = 'activity';
			    } else {
                    $renderData['action'] = 'about';
			    }
			}

			/**
			 * Check if current user has access to profile activity
			 */
			if ($renderData['action'] === 'activity' && !$this->currentUserCan('access-to-profile-activity-page')) {
				return $this->render(
					'@users/error.twig',
					array('error' => $this->translate('Your account don\'t have permissions to see activity page')));
			}

			if ($isCurrentUser) {
				$notificationsModel = $this->getModel('Notifications', 'Notifications');
				$notifications = $notificationsModel->getNotificationsCounts($currentUser['id']);
				$_notifications = array();

				$notificationsSections = array(
					'friendship_accept' => 'friends',
					'friendship_request' => 'friends',
					'follow' => 'followers',
					'message' => 'messages',
					'groups_invite' => 'groups'
				);

				foreach ($notifications as $notification) {

					$section = @$notificationsSections[$notification['type']];
					$_notifications[$section] = isset($_notifications[$section]) ? $_notifications[$section] + $notification['count'] : $notification['count'];
				}

				foreach ($notificationsSections as $notificationType => $notificationSection) {
					if ($renderData['action'] === $notificationSection) {
						$notificationsModel->setViewedType($currentUser['id'], $notificationType);
					}
				}

				$renderData['unreadNotifications'] = $_notifications;
			}



			switch ($renderData['action']) {
				case 'settings':
					if ($isCurrentUser) {
						$usersModel = $this->getModel('Profile');
						$blockedUsers = $this->getModel('Conversation', 'Messages')->getBlockedUsers($currentUser['id']);

						if ($blockedUsers) {
							$renderData['blockedUsers'] = $usersModel->getUsersByIds(array('users' => $blockedUsers));
						}
						if(!empty($settings['design']['activity']['type']['shares'])
							&& !empty($settings['design']['activity']['type']['friendPostOn'])
							&& !empty($settings['design']['activity']['type']['friendPostOnShowInFrontend'])
							&& $settings['design']['activity']['type']['shares'] == 'true'
							&& $settings['design']['activity']['type']['friendPostOn'] == 1
							&& $settings['design']['activity']['type']['friendPostOnShowInFrontend'] == 1
						) {
							$renderData['bConfig']['showFriendPostOpt'] = 1;
						}

						$renderData['template'] = '@users/settings.twig';
					} else {
						$renderData['error'] = $this->translate('Access to this page is restricted.');
					}

					break;
				case 'about':
					if ($this->currentUserHasPermission('view-about', $requestedUser)) {
						$fieldsModel = $this->getModel('Fields', 'Users');

						$fieldsData = $fieldsModel->getUserFieldsData(
							$requestedUser['id'],
							array('user_email', 'user_pass', 'user_pass_confirm', 'g-recaptcha-response')
						);
						$renderData['fields'] = $fieldsData['fields'];
						$renderData['sections'] = $fieldsData['sections'];
						$renderData['template'] = '@users/about.twig';
					} else {
						$renderData['error'] = $this->translate('This user is restrict access to his about page.');
					}

					break;
				case 'groups':
					if ($settings['base']['main']['groups'] === 'true') {
						if ($this->currentUserHasPermission('view-groups', $requestedUser)) {
							if (!$this->currentUserCan('read-groups')) {
								$renderData['template'] = '@base/error.twig';
								$renderData['error'] = $this->translate('Your account don\'t have permission to read groups');
							} else {
								$joinedType = 'joined';
								if(isset($settings['base']['groups']['joined-sort-order']) && $settings['base']['groups']['joined-sort-order'] == '1') {
									$joinedType = 'joined-ordered-by-activity';
								}

								$groupCategoryModel = $this->getModel('GroupsCategory', 'Groups');
								$groupCategoryList = $groupCategoryModel->getGroupCategoryList();
								$renderData['groupCategoryList'] = $groupCategoryList;
								$renderData['template'] = '@users/groups.twig';
								$groupsModel = $this->getModel('Groups', 'Groups');
								$renderData['groups'] = $groupsModel->getUserGroups($requestedUser['id'], $joinedType, 10);

								if ($isCurrentUser) {
									$renderData['groupCounts'] = $groupsModel->countUserGroups($requestedUser['id']);
									$renderData['groupInvites'] = $groupsModel->getUserGroups($requestedUser['id'], 'invited', 10);
								}
							}
						} else {
							$renderData['error'] = $this->translate('This user is restrict access to his groups page.');
						}
					} else {
						$renderData['error'] = $this->translate('This page is disabled by site administrator.');
					}

					break;
				case 'activity':
					if ($settings['base']['main']['activity'] === 'true') {

						$activityId = get_query_var('activity');
						$renderData['template'] = '@users/activities.twig';
						$activityModel = $this->getModel('Activity', 'Activity');
						$smilesList = $activityModel->getSmilesList();
						$renderData['smilesList'] = $smilesList;
						$renderData['contextParam'] = 'profile';

						if ($this->currentUserHasPermission('view-activity', $requestedUser)) {

							if (!$activityId) {
								$renderData['activities'] = $activityModel->getUserProfileActivity($requestedUser['id'],  $currentUser['id'], 5);
								$canUserPostActivity = $this->currentUserHasPermission('post-activity', $requestedUser);
								$renderData['disablePostForm'] = !$canUserPostActivity;
							} else {
								$renderData['template'] = '@users/activity.twig';
								$requestedActivity = $activityModel->getActivityById($activityId, $requestedUser['id'], array(
									'status' => 'active'
								));

								if ($requestedActivity && $requestedActivity[0]['author']['id'] === $requestedUser['id']) {
									$renderData['activities'] = $requestedActivity;
								} else {
									$renderData['error'] = $this->translate('Requested activity is not found.');
								}
							}
						} else {
							$renderData['error'] = $this->translate('This user is restrict access to his activity page.');
						}
					} else {
						$renderData['error'] = $this->translate('This page is disabled by site administrator.');
					}

					break;
				case 'favorites':
					if($settings['base']['main']['activity'] === 'true') {
						$renderData['template'] = '@users/activities.twig';
						$activityModel = $this->getModel('Activity', 'Activity');
						$smilesList = $activityModel->getSmilesList();
						$renderData['smilesList'] = $smilesList;
						$renderData['contextParam'] = 'profile-favorite';

						if($this->currentUserHasPermission('view-activity', $requestedUser)) {
							$activities = $activityModel->getActivity(array(
								'userId' => $requestedUser['id'],
								'limit' => 5,
								'status' => 'active',
								'activityTypes' => array(
									'favorite',
								),
							));
							$renderData['activities'] = $activities;
							$canUserPostActivity = $this->currentUserHasPermission('post-activity', $requestedUser);
							$renderData['disablePostForm'] = !$canUserPostActivity;
						} else {
							$renderData['error'] = $this->translate('This user is restrict access to his activity page.');
						}
					} else {
						$renderData['error'] = $this->translate('This page is disabled by site administrator.');
					}

					break;
				case 'friends':
					if ($settings['base']['main']['friends'] === 'true') {
						if ($this->currentUserHasPermission('view-friends', $requestedUser)) {

							$friendsModel = $this->getModel('friends');
							$friends = $friendsModel->getUserFriends($requestedUser['id'], 10);
							$renderData['friends'] = $friends;

							if ($isCurrentUser) {
								$friendRequests = $friendsModel->getUserFriendRequests(10);
								$renderData['friendRequests'] = $friendRequests;
								$renderData['friendRequestsCount'] = $friendsModel->countFriendRequests($currentUser['id']);
							}

							$renderData['template'] = '@users/friends.twig';

						} else {
							$renderData['error'] = $this->translate('This user is restrict access to his friends page.');
						}
					} else {
						$renderData['error'] = $this->translate('This page is disabled by site administrator.');
					}

					break;
				case 'followers':
					if ($settings['base']['main']['followers'] === 'true') {
						if ($this->currentUserHasPermission('view-follows', $requestedUser) || $this->currentUserHasPermission('view-followers', $requestedUser)) {
							$followersModel = $this->getModel('Followers');

							if ($this->currentUserHasPermission('view-follows', $requestedUser)) {
								$renderData['follows'] = $followersModel->getUserFollows($requestedUser['id'], 10);
							}
							if ($this->currentUserHasPermission('view-followers', $requestedUser)) {
								$renderData['followers'] = $followersModel->getUserFollowers($requestedUser['id'], 10);
							}
							$renderData['template'] = '@users/followers.twig';
						} else {
							$renderData['error'] = $this->translate('This user is restrict access to his followers page.');
						}
					} else {
						$renderData['error'] = $this->translate('This page is disabled by site administrator.');
					}

					break;
				case 'notifications':
					if ($isCurrentUser) {
						$renderData['template'] = '@users/notifications.twig';
						$renderData['type'] = get_query_var('type', 'main');
						$renderData['notifications'] = $notificationsModel->getNotifications($currentUser['id'], 10);
					} else {
						$renderData['error'] = $this->translate('Access to this page is restricted.');
					}

					break;
				case 'messages':
					if ($settings['base']['main']['messages'] === 'true') {
						$renderData['template'] = '@users/messages.twig';

						$conversationModel = $this->getModel('Conversation', 'Messages');
						$renderData['conversations'] = $conversationModel->getUserConversations($currentUser['id']);
						$friendsModel = $this->getModel('Friends', 'Users');
						$renderData['currentUserFriends'] = $friendsModel->getUserFriends($currentUser['id'],  20, 0);

						if (! $this->currentUserCan('send-and-receive-messages')) {
							$renderData['error'] = $this->translate('Your account don\'t have permission to see messages section');
						}
					} else {
						$renderData['error'] = $this->translate('This page is disabled by site administrator.');
					}

					break;
				case 'posts':
					if ($settings['base']['main']['posts'] === 'true') {
						$renderData['template'] = '@users/posts.twig';
						$renderData['createNewPostUrl'] = admin_url('post-new.php');
						$renderData['canUserCreatePost'] = current_user_can('publish_posts');

						if ($this->currentUserHasPermission('view-posts', $requestedUser)) {
							$postsModel = $this->getModel('Posts');
							$renderData['posts'] = $postsModel->getPosts($requestedUser['id'], 10);
						} else {
							$renderData['error'] = $this->translate('This user is restrict access to his posts page.');
						}
					} else {
						$renderData['error'] = $this->translate('This page is disabled by site administrator.');
					}

					break;
				case 'comments':
					if ($settings['base']['main']['comments'] === 'true') {
						$renderData['template'] = '@users/comments.twig';

						if ($this->currentUserHasPermission('view-comments', $requestedUser)) {
							$commentsModel = $this->getModel('Comments');
							$renderData['comments'] = $commentsModel->getComments($requestedUser['id'], 10);
						} else {
							$renderData['error'] = $this->translate('This user is restrict access to his comments page.');
						}
					} else {
						$renderData['error'] = $this->translate('This page is disabled by site administrator.');
					}

					break;
			}

			$renderData = $this->getDispatcher()->apply(
				'users.profilePagesBeforeRender',
				array(
					$renderData,
					$requestedUser
				)
			);

            if ($renderData['error']) {
	            return $this->render('@users/error.twig', $renderData);
            }

			return $this->render($renderData['template'], $renderData);

		} else {
			return $this->render('@base/error.twig', array('error' => $this->translate('Profile is not exists.')));
		}
	}

	public function registerTwigExtension() {
		$this->getTwig()->addExtension(new Membership_Users_Twig($this));
	}

	public function getProfileBaseUrl() {
		$permalinkBase = $this->getProfilePermalinkBase();
		$permalink = $this->getModule('routes')->getRouteUrl('profile');

		$url = $permalink;

		if (!get_option('permalink_structure')) {
			$url = add_query_arg(array(), $permalink);
		}

		return $url;
	}

	public function getUserProfileUrl($user, $args = array()) {
		$permalinkBase = $this->getProfilePermalinkBase();
		$permalink = $this->getModule('routes')->getRouteUrl('profile');

		$permalinkStructure = get_option('permalink_structure');

		$permalinkUserValue = $user['id'];

		if ($permalinkBase === 'username') {
			$username = strtolower($user['user_login']);
			$permalinkUserValue = $username;
		}

		if ($permalinkStructure) {

			if (substr($permalinkStructure, -1) !== '/') {
				$permalink .= '/';
			}

			$url = $permalink . $permalinkUserValue;

			if (!empty($args)) {
				$url .= '/' . implode('/', $args);
			}

			if (substr($permalinkStructure, -1) === '/') {
				$url .= '/';
			}

		} else {
			$url = add_query_arg(
				array_merge(
					array('user' => $permalinkUserValue),
					$args
				), $permalink
			);
		}


		return $url;
	}

	public function getProfilePermalinkBase() {
        $settings = $this->getSettings();

        return $settings['profile']['permalink-base'];
	}

	public function getUsersModuleUrl() {
		return plugins_url(null, __FILE__);
	}

	public function showAdminProfileFields($user) {
		$userId = null;
		$userStatus = Membership_Users_Model_Fields::STATUS_ACTIVE;
		$rolesModel = $this->getModel('roles', 'roles');

		if ($user instanceof WP_User) {
			$userId = $user->ID;
			$userStatus = $this->getModel('profile')->getUserStatus($userId);
			$userRole = $rolesModel->getUserRole($userId);
			if (!$userRole || !isset($userRole['role_id'])) {
				$defaultRole = $this->getModel('roles', 'roles')->getDefaultRole();
				$userRoleId = $defaultRole['id'];
			} else {
				$userRoleId = $userRole['role_id'];
			}
		} else {
			$userDefaultRole = $rolesModel->getDefaultRole();
			$userRoleId = $userDefaultRole['id'];
		}

		$fields = $this->getModel('fields')->getUserFieldsData($userId, array(
			'user_login',
		    'first_name',
		    'last_name',
		    'user_email',
		    'user_pass',
		    'user_pass_confirm',
	    ), array(
		    'include_user_status' => current_user_can('edit_users'),
            'user_status_value' => $userStatus,
            'include_user_role' => current_user_can('edit_users'),
            'user_role_value' => $userRoleId
        ));
		
		print $this->render(
			'@users/backend/admin-fields-edit.twig',
			array('fields' => $fields['fields'])
		);
	}

	public function getDisplayName($user) {
		$firstName = $user['firstName'];
		$lastName = $user['lastName'];
		$displayName = $user['user_login'];

		$settings = $this->getSettings();
		$displayNameOption = $settings['profile']['display-name'];

		if ($displayNameOption == 'firstname-lastname') {
			$displayName = $firstName . ' ' . $lastName;
		} elseif ($displayNameOption == 'lastname-firstname') {
			$displayName = $lastName . ' ' . $firstName;
		} elseif($displayNameOption == 'nickname') {
			if(!empty($user['nickname'])) {
				$displayName = $user['nickname'];
			}
		}

		if ($displayName == ' ') {
            $displayName = $user['user_login'];
		}
		if(!$displayName) {
			$displayName = $user['user_login'];
		}

		return $displayName;
	}

	public function userCan($user, $permission) {

		if ($user && isset($user['permissions'][$permission])) {
			return $user['permissions'][$permission] === 'true';
		}

		return false;
	}

	public function currentUserCan($permission) {
		$currentUser = $this->getCurrentUser();
		if ($currentUser) {
			return $this->userCan($currentUser, $permission);
		} else {
			$guestRole = $this->getModel('roles', 'roles')->getDefaultGuestRole();
			return $this->userCan($guestRole, $permission);
		}
	}

	public function currentUserHasPermission($privacyName, $requestedUser = null) {

		if (!$requestedUser) {
			$requestedUser = $this->requestedUser;
		}

		if ($requestedUser['id'] === $this->currentUser['id']) {
			return true;
		}

		switch ($requestedUser['privacy'][$privacyName]) {
			case 'all-users':
				return true;
			case 'friends':
				return (bool) $requestedUser['currentUserIsFriend'];
			case 'friends-of-friends':
				return (bool) $requestedUser['currentUserIsFriend'] || (bool) $requestedUser['currentUserIsFriendOfFriends'];
		}

		return false;
	}

    /**
     * Generate username from email address: explode it by "@" and retrive first part - this will be username
     * @param string $email
     * @param bool|string $username If we explode email and turn up that such username exists - we will try to randomize it and make recursion returning
     * @return string Generated username
     */
	public function generateLoginFromEmail($email, $username = false) {
		if (!$username) {
			$nameMail = explode('@', trim($email));
			$username = $nameMail[ 0 ];
		}

		if (username_exists($username)) {
			return $this->generateLoginFromEmail($email, $username. mt_rand(1, 9999));
		}

		return $username;
	}

	/**
	 * @param array $requestedUser
	 */
	public function setRequestedUser(array $requestedUser) {
		$this->requestedUser = $requestedUser;


	}

	public function addToFollowers($currentUserId, $followingUserId) {
		$this->getModel('Activity', 'Activity')->createActivity($currentUserId, 'follow', null, $followingUserId);
	}

	public function addToFriends($currentUserId, $requestedUserId) {
		$profileModel = $this->getModel('profile');
		$requestedUser = $profileModel->getUserById($requestedUserId);

		if ($requestedUser['currentUserIsFriend']) {
			$activityModel = $this->getModel('activity', 'activity');
			$activityModel->createActivity($currentUserId, 'friendship', null, $requestedUserId);
		}
	}

	public function activityDataPrepare($activities, &$data) {
		foreach ($activities as &$activity) {
			if ($activity['type'] === 'follow') {
				$data['users'][] = $activity['target_id'];
			}

			if ($activity['type'] === 'friendship') {
				$data['users'][] = $activity['target_id'];
			}
		}

		return $activities;
	}

	public function activityData($activities, $data) {
		foreach ($activities as &$activity) {
			if (!in_array($activity['type'], array('group_post', 'group_user_post'))) {
				$activity['url'] = $this->getUserProfileUrl($activity['author'], array(
					'action' => 'activity',
					'activity' => $activity['id']
				));
			}

			if ($activity['type'] === 'follow' && isset($data['users'][$activity['target_id']])) {
				$activity['target'] = $data['users'][$activity['target_id']];
			}

			if ($activity['type'] === 'friendship' && !empty($data['users'][$activity['target_id']])) {
				$activity['target'] = $data['users'][$activity['target_id']];
			}
		}

		return $activities;
	}

	public function activityQueryBuild($queryParams) {

		$activityModel = $this->getModel('Activity', 'Activity');

		if (isset($queryParams['activityTypes']) && ! in_array(Membership_Activity_Model_Activity::ACTIVITY_TYPE_SOCIAL, $queryParams['activityTypes'])) {
			return $queryParams;
		}

		global $wpdb;

		switch ($queryParams['type']) {
			case 'activity':
				array_unshift(
					$queryParams['where'],
					$wpdb->prepare("a.type = 'follow' AND a.target_id = '%d'", $queryParams['requestedUserId']),
					$wpdb->prepare("a.type = 'friendship' AND a.user_id = '%d'", $queryParams['requestedUserId']),
					$wpdb->prepare("a.type = 'friendship' AND a.target_id = '%d'", $queryParams['requestedUserId'])
				);
				break;
			case 'activity-guest':
				array_unshift(
					$queryParams['where'],
					"a.type = 'friendship'",
					"a.type = 'follow'"
				);
				break;
		}

		return $queryParams;
	}

	public function activityTitle($activity) {
		print $this->render('@users/partials/activity-title.twig', array('activity' => $activity));
	}

	public function activityContent($activity) {
		print $this->render('@users/partials/activity-content.twig', array('activity' => $activity));
	}

	public function isAdmin() {
		return current_user_can('manage_options');
	}

	public function setViewed($id){
        /**
         * @var $notificationModel Membership_Notifications_Model_Notifications
         */
	    $notificationModel = $this->getModel('Notifications', 'Notifications');
	    $notificationModel->setViewed($id);
    }

	public function renderSendMessageModalWnd() {
		if(!self::$isInitSendMessageModalWnd) {
			echo $this->render('@users/partials/users-send-message-modal.twig', array(
					'useAttachment' => 1,
			));
			self::$isInitSendMessageModalWnd = true;
		}
		return null;
	}

	public function renderSendMessageAttachmTemplate() {
		if(!self::$isInitSendMessageAttTempl) {
			$attachmentIconUrl = $this->getUsersModuleUrl() . '/assets/images/attachment_icon.png';
			echo $this->render('@users/partials/users-send-message-attachment-template.twig', array(
				'attachmentIcon' => $attachmentIconUrl,
			));
			self::$isInitSendMessageAttTempl = true;
		}
		return null;
	}

	public function userAvatarShortCodeHandler($scParams) {
		if(!empty($scParams['user-id'])) {
			$userId = (int) $scParams['user-id'];
		}
		if(empty($userId) || $userId <= 0) {
			$userId = get_current_user_id();
		}

		$profileModel = $this->getModel('profile');
		$userInfo = $profileModel->getUserById($userId);

		if(empty($userInfo['id'])) {
			return null;
		}

		$userSettings = $this->getModel('settings')->getSettings();

		return $this->render('@users/avatar-shortcode.twig', array(
			'userInfo' => $userInfo,
			'userSettings' => $userSettings,
		));
	}
}