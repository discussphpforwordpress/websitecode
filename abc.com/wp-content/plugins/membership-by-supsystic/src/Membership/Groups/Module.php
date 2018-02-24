<?php
class Membership_Groups_Module extends Membership_Base_Module {

	private $requestedGroup;
	private $_groupsById = array();

	public function afterModulesLoaded() {
		add_shortcode(
			$this->getConfig('shortcode_name') . '-groups',
			array($this, 'shortcodeHandler')
		);
		add_shortcode(
			$this->getConfig('shortcode_name') . '-joined-groups',
			array($this, 'joinedGroupsShortcodeHandler')
		);
		add_action('setup_theme', array($this, 'registerRewriteRules'));
		$this->getDispatcher()->on('activity.relatedData', array($this, 'activityData'), 10, 2);

		$this->registerTwigExtensions();
		$this->registerAjaxRoutes();

		$routesModule = $this->getModule('routes');

		$routesModule->registerOnRequestAction(
			array(
				array($this, 'onRequest')
			)
		);

		add_action('widgets_init', array($this, 'widgetsInit'));

		if (!$this->isModule('groups')) {
			return;
		}

		$assetsPath = $this->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(),
			array(
				$assetsPath . '/js/groups.backend.js',
			)
		);
	}

	public function widgetsInit() {
		global $wp_widget_factory;
		$wp_widget_factory->widgets['Membership_Groups_Widgets_PopularGroups'] = new Membership_Groups_Widgets_PopularGroups($this);
		$wp_widget_factory->widgets['Membership_Groups_Widgets_SuggestedGroups'] = new Membership_Groups_Widgets_SuggestedGroups($this);
	}

	public function registerAjaxRoutes() {
		$settings = $this->getSettings();

		if ($settings['base']['main']['groups'] === 'true') {

			$routesModule = $this->getModule('routes');

			$routesModule->registerAjaxRoutes(array(

				'groups.saveSettings' => array(
					'method' => 'post',
					'admin' => true,
					'handler' => array($this->getController(), 'saveSettings')
				),

				'groups.join' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'joinGroup')
				),
				'groups.leave' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'leaveGroup')
				),

                'groups.follow' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'followGroup')
                ),
                'groups.unfollow' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'unfollowGroup')
                ),

                'groups.delete' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'deleteGroup')
                ),

				'groups.activity.post' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'postActivity')
				),

				'groups.activity.remove' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'removeActivity')
				),

                'groups.activity.get' => array(
                    'method' => 'get',
                    'handler' => array($this->getController(), 'getActivity'),
                    'guest' => true
                ),

				'groups.changeCover' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'changeCover')
				),
				'groups.removeCover' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'removeCover')
				),
				'groups.changeLogo' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'changeLogo')
				),
				'groups.removeLogo' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'removeLogo')
				),
				'groups.getUsers' => array(
					'method' => 'get',
					'guest' => true,
					'handler' => array($this->getController(), 'getUsers')
				),
				'groups.removeUser' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'removeUser')
				),
				'groups.unblockUser' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'unblockUser')
				),
				'groups.approveUser' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'approveUser')
				),
				'groups.getUsersToInvite' => array(
					'method' => 'get',
					'handler' => array($this->getController(), 'getUsersToInvite')
				),

				'groups.invite' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'invite')
				),

				'groups.cancelInvite' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'cancelInvite')
				),

				'groups.settings.updatePrivacy' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'updatePrivacy')
				),

				'groups.settings.updateData' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'updateData')
				),

				'groups.getUserGroups' => array(
					'method' => 'get',
					'handler' => array($this->getController(), 'getUserGroups')
				),

				'groups.getGroups' => array(
					'method' => 'get',
					'handler' => array($this->getController(), 'getGroups'),
                    'guest' => true
				),

				'groups.block' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'blockGroup')
				),
				'groups.unblock' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'unblockGroup')
				),

				'groups.addTag' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'addTag')
				),
				'groups.removeTag' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'removeTag')
				),

				'groups.createGroup' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'createGroup')
				),

                'groups.isNoteOnGroup' => array(
                    'method' => 'post',
                    'handler' => array($this->getController(), 'isNoteOnGroup')
                ),
				'groupsCategory.add' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'addGroupCategory')
				),
				'groupsCategory.update' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'updateGroupCategory')
				),
				'groupsCategory.remove' => array(
					'method' => 'post',
					'handler' => array($this->getController(), 'removeGroupCategory')
				),
			));

		}

	}

	public function onRequest($query, $requestedPageId, $routesList) {
		if (!is_admin() && isset($routesList['groups']) && $requestedPageId == $routesList['groups']) {

			if (isset($query->query_vars['activity'])) {
				$this->registerFrontendData(array('requestedActivity' => $query->query_vars['activity']));
			}

			if (isset($query->query_vars['group'])) {

				$groupsModel = $this->getModel();

				if ($this->getGroupPermalinkBase() === 'groupalias') {
					$this->requestedGroup = $groupsModel->getGroupByAlias(
						$query->query_vars['group'],
						get_current_user_id()
					);
				} else {
					$this->requestedGroup = $groupsModel->getGroup(
						$query->query_vars['group'],
						get_current_user_id()
					);
				}

				$this->registerFrontendData(
					array('requestedGroup' => $this->requestedGroup)
				);

				$this->getTwig()->addGlobal('requestedGroup',  $this->requestedGroup);

				add_filter('pre_get_document_title', array($this, 'setTitle'), 20, 2);
				add_action('wp_head', array($this, 'addDescription'), 2);

				$this->enqueueGroupAssets();

				if (isset($query->query_vars['activity']) ||
				    !isset($query->query_vars['action']) ||
				    $query->query_vars['action'] == 'activity'
				) {
					$this->getModule('Activity')->enqueueActivitiesAssets();
				}

				if (isset($query->query_vars['action'])) {
					switch ($query->query_vars['action']) {
						case 'members':
							$this->enqueueGroupMembersAssets();
							break;
						case 'settings':
							$this->enqueueGroupSettingsAssets();
							break;
					}
				}


			} else {
				$this->enqueueGroupsListAssets();
			}
		}

		return $query;
	}


	public function enqueueGroupsListAssets() {
		$assetsPath = $this->getAssetsPath();
		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/groups-list.frontend.css'
			),
			array(
				$assetsPath . '/js/groups.frontend.js',
				$assetsPath . '/js/groups-list.frontend.js'
			),
			MBS_FRONTEND
		);

		if (! is_user_logged_in()) {
			$authModule = $this->getModule('Auth');
			$authModule->enqueueLoginModalAssets();
		}
	}

	public function enqueueGroupAssets() {

		$assetsPath = $this->getAssetsPath();
		$baseModule = $this->getModule('Base');
		$usersModule = $this->getModule('Users');
		$baseAssetsPath = $baseModule->getAssetsPath();
		$usersAssetsPath = $usersModule->getAssetsPath();

		$this->getModule('assets')->enqueueAssets(
			array(
				$usersAssetsPath . '/css/users-list.frontend.css',
				$assetsPath . '/css/groups.frontend.css',
				$baseAssetsPath . '/lib/cropper/cropper.min.css',

			),
			array(
				$assetsPath . '/js/group.frontend.js',
				$baseAssetsPath . '/lib/cropper/cropper.min.js',
			),
			MBS_FRONTEND
		);

		if (! is_user_logged_in()) {
			$authModule = $this->getModule('Auth');
			$authModule->enqueueLoginModalAssets();
		}
	}

	public function enqueueGroupAddAsset() {
		$assetsPath = $this->getAssetsPath();
		// <script type="text/javascript" src="{{ assets('groups', 'js/create-group.frontend.js') }}"></script>
		$this->getModule('assets')->enqueueAssets(
			array(),
			array(
				$assetsPath . '/js/create-group.frontend.js',
			),
			MBS_FRONTEND
		);
	}

	public function enqueueJoinGroupAsset() {
		$assetsPath = $this->getAssetsPath();
		$usersModule = $this->getModule('Users');
		$usersAssetsPath = $usersModule->getAssetsPath();

		$baseModule = $this->getModule('Base');
		$baseAssetsPath = $baseModule->getAssetsPath();
		$baseModule->enqueueAssets();

		$this->getModule('assets')->enqueueAssets(
			array(
				$assetsPath . '/css/groups-list.frontend.css',
			),
			array(
				array(
					'source' => $assetsPath . '/js/create-group.frontend.js',
					'dependencies' => array('jquery')
				),
				$assetsPath . '/js/groups-list.frontend.js',
				$assetsPath . '/js/groups.frontend.js',
			),
			MBS_FRONTEND
		);
	}

	public function enqueueGroupMembersAssets() {
		$this->getModule('users')->enqueueUsersListsAssets();
		$this->getModule('assets')->enqueueAssets(
			array(),
			array(
				$this->getAssetsPath() . '/js/members.frontend.js',
			),
			MBS_FRONTEND
		);
	}


	public function enqueueGroupSettingsAssets() {
		$this->getModule('assets')->enqueueAssets(
			array(),
			array(
				$this->getAssetsPath() . '/js/settings.frontend.js'
			),
			MBS_FRONTEND
		);
	}


	public function setTitle($title) {
		$settings = $this->getSettings();

		return str_replace(
			'{group_name}',
			$this->requestedGroup['name'],
			$settings['base']['seo']['group-title']
		);
	}

	public function addDescription() {
		$settings = $this->getSettings();
		// https://codex.wordpress.org/Meta_Tags_in_WordPress
		$description =  str_replace(
			array(
				'{group_name}',
				'{group_description}'
				),
			array(
				$this->requestedGroup['name'],
				$this->requestedGroup['description'],
				),
			$settings['base']['seo']['group-description']
		);

		print '<meta name="description" content="' . $description . '" />';
	}

	public function shortcodeHandler($attributes){
		$group = get_query_var('group');
		$usersModule = $this->getModule('users');
		$currentUser = $usersModule->getCurrentuser();
		$groupsModel = $this->getModel('Groups', 'Groups');
		$groupCategoryModel = $this->getModel('GroupsCategory', 'Groups');

		$settings = $this->getSettings();

		if ($settings['base']['main']['groups'] === 'false') {
			return $this->render('@base/error.twig', array('error' => $this->translate('Groups are disabled by site administrator.')));
		}

		if (!$usersModule->currentUserCan('read-groups')) {
			return $this->render('@base/error.twig', array('error' => $this->translate('Your account don\'t have permission to read groups')));
		}


		if ($group) {

			$action = get_query_var('action');
			$group = $this->requestedGroup;

			if (!$group) {
				return $this->render('@base/error.twig', array('error' => $this->translate('Group that are you looking is not found.')));
			}

			$error = false;
			$template = '';

			$templateData['requestedGroup'] = $group;
			$templateData['usersToInvite'] = $groupsModel->getUsersToInvite($group['id'], $currentUser['id'], 10, 0);

			if (empty($action)) {
				$action = 'activity';
			}

			$templateData['action'] = $action;

			if ($action === 'activity') {
                /**
                 * @var $activityModel Membership_Activity_Model_Activity
                 * @var $followersModel Membership_Groups_Model_Followers
                 */

				$activityId = get_query_var('activity');
				$activityModel = $this->getModel('Activity', 'Activity');
				$followersModel = $this->getModel('Followers', 'Groups');
				$groupId = $group['id'];

				//Check followers//
                if(is_null($group['currentUserIsFollowing']) && (($group['settings']['type'] === 'private') || ($group['settings']['type'] === 'closed'))){
                    $error = $this->translate('Access to this page is restricted.');
                }
                //Check followers//

				if (!$activityId) {

					$templateData['activities'] = $activityModel->getGroupActivity($group['id'], $currentUser['id'], 5);
					$template = '@groups/activities.twig';
				} else {
					$template = '@groups/activity.twig';
					$requestedActivity = $activityModel->getActivityById($activityId, $currentUser['id'], array('status' => 'active'));
					if ($requestedActivity) {
						$templateData['activities'] = $requestedActivity;
						$templateData['singleView'] =  true;
                    }else {
						$error = $this->translate('Requested activity is not found.');
                    }
				}

			} elseif ($action === 'members') {

				$template = '@groups/members.twig';

				if (in_array($group['currentUserRole'], array('administrator'))) {
					$usersRoles = array(
						'approved',
						'unapproved',
						'invited',
						'blocked'
					);
				} else {
					$usersRoles = array('approved');
				}

				$templateData['counts'] = $groupsModel->countGroupUsers($group['id'], $usersRoles);
				$templateData['users'] = array();

				foreach ($usersRoles as $role) {
					$templateData['users'][$role] = $groupsModel->getGroupMembers($group['id'], $role, $groupsModel->limit);
				}


			} elseif ($action === 'settings') {
				if ($group['currentUserRole'] === 'administrator') {
					$groupCategoryList = $groupCategoryModel->getGroupCategoryList();
					$template = '@groups/settings.twig';
					$templateData['groupCategoryList'] = $groupCategoryList;
				} else {
					$error = $this->translate('Your account don\'t have permission to access this page');
				}
			}

			if ($error) {
				$template = '@base/error.twig';
				$templateData['error'] = $error;
			}

			return $this->render($template, $templateData);

		} else {
			$this->enqueueGroupAddAsset();
			$groupsCounts = $groupsModel->countUserGroups($currentUser['id']);
			$groupCategoryList = $groupCategoryModel->getGroupCategoryList();

			$joinedType = 'joined';
			if(isset($settings['base']['groups']['joined-sort-order']) && $settings['base']['groups']['joined-sort-order'] == '1') {
				$joinedType = 'joined-ordered-by-activity';
			}

			return $this->render('@groups/groups.twig', array(
				'counts' => $groupsCounts,
				'groupCategoryList' => $groupCategoryList,
				'groups' => array(
					'all' => $groupsModel->getGroups($currentUser['id'], $groupsModel->limit),
					'joined' => $groupsModel->getUserGroups($currentUser['id'], $joinedType, $groupsModel->limit),
					'managed' => $groupsModel->getUserGroups($currentUser['id'], 'managed', $groupsModel->limit),
					'invited' => $groupsModel->getUserGroups($currentUser['id'], 'invited', $groupsModel->limit)
				)
			));
		}

	}

	public function joinedGroupsShortcodeHandler($attributes) {

		$usersModule = $this->getModule('users');
		$currentUser = $usersModule->getCurrentuser();
		$groupsModel = $this->getModel('Groups', 'Groups');
		$groupCategoryModel = $this->getModel('GroupsCategory', 'Groups');

		//
		$this->enqueueJoinGroupAsset();
		$groupCategoryList = $groupCategoryModel->getGroupCategoryList();

		$joinedType = 'joined';
		$settings = $this->getSettings();
		if(isset($settings['base']['groups']['joined-sort-order']) && $settings['base']['groups']['joined-sort-order'] == '1') {
			$joinedType = 'joined-ordered-by-activity';
		}

		return $this->render('@groups/joined-groups.twig', array(
			'groupCategoryList' => $groupCategoryList,
			'joinedGroups' => $groupsModel->getUserGroups($currentUser['id'], $joinedType, $groupsModel->limit),
		));
	}

	public function registerRewriteRules() {
		$routesModule = $this->getModule('routes');

		$pageId = $routesModule->getPageIdByRoute('groups');

		if ($pageId) {

			$routesModule->addQueryVars(array('group', 'action', 'activity'));
			$permalink = str_replace(site_url('/'), '', $routesModule->getRouteUrl('groups'));

			if ($permalinkStructure = get_option('permalink_structure')) {
				if (substr($permalinkStructure, -1) !== '/') {
					$permalink .= '/';
				}
			}

			$routesModule->addRewriteRule(
				'^' . $permalink . '([A-Za-z-0-9_]+)/?$',
				'index.php?page_id=' . $pageId . '&group=$matches[1]'
			);

			$routesModule->addRewriteRule(
				'^' . $permalink . '([A-Za-z-0-9_]+)/([A-Za-z-0-9]+)/?$',
				'index.php?page_id=' . $pageId . '&group=$matches[1]&action=$matches[2]'
			);

			$routesModule->addRewriteRule(
				'^' . $permalink . '([A-Za-z-0-9._-]+)/(activity)/([0-9]+)/?$',
				'index.php?page_id=' . $pageId . '&group=$matches[1]&action=$matches[2]&activity=$matches[3]'
			);
		}
	}

	public function registerTwigExtensions() {
		$this->getTwig()->addExtension(new Membership_Groups_Twig($this));
	}

	public function currentUserHasGroupPermission($setting, $requestedGroup = null) {
		if (!$requestedGroup) {
			$requestedGroup = $this->requestedGroup;
		}

		if ($requestedGroup['currentUserRole'] === 'administrator') {
			return true;
		}

		$hasPermission = false;

		switch($setting) {
            case 'read-activity':
                if ($requestedGroup['settings']['read-activity'] === 'all') {
                    $hasPermission = true;
                }

                if ($requestedGroup['settings']['read-activity'] === 'members-only') {
                    if ($requestedGroup['settings']['type'] === 'open' && !!$requestedGroup['currentUserRole']) {
                        $hasPermission = true;
                    }

                    if (
                        in_array($requestedGroup['settings']['type'], array('closed', 'private')) &&
                        !!$requestedGroup['currentUserRole'] &&
                        !!$requestedGroup['currentUserApproved']
                    ) {
                        $hasPermission = true;
                    }
                }

                break;
			case 'post-activity':
				if ($requestedGroup['settings']['post-activity'] == 'all' && is_user_logged_in()) {
					$hasPermission = true;
				}

                if ($requestedGroup['settings']['post-activity'] === 'members-only') {
                    if ($requestedGroup['settings']['type'] === 'open' && !!$requestedGroup['currentUserRole']) {
                        $hasPermission = true;
                    }

                    if (
                        in_array($requestedGroup['settings']['type'], array('closed', 'private')) &&
                        !!$requestedGroup['currentUserRole'] &&
                        !!$requestedGroup['currentUserApproved']
                    ) {
                        $hasPermission = true;
                    }
                }

                if ($requestedGroup['settings']['post-activity'] == 'administrators' &&
                    in_array($requestedGroup['currentUserRole'], array('administrator'))
                ) {
                    $hasPermission = true;
                }

				break;
			case 'post-comments':
				if ($requestedGroup['settings']['post-comments'] == 'all' && is_user_logged_in()) {
					$hasPermission = true;
				}

                if ($requestedGroup['settings']['post-comments'] === 'members-only') {
                    if ($requestedGroup['settings']['type'] === 'open' && !!$requestedGroup['currentUserRole']) {
                        $hasPermission = true;
                    }

                    if (
                        in_array($requestedGroup['settings']['type'], array('closed', 'private')) &&
                        !!$requestedGroup['currentUserRole'] &&
                        !!$requestedGroup['currentUserApproved']
                    ) {
                        $hasPermission = true;
                    }
                }

                if ($requestedGroup['settings']['post-comments'] == 'administrators' &&
                    in_array($requestedGroup['currentUserRole'], array('administrator'))
                ) {
                    $hasPermission = true;
                }

				break;
            case 'send-invitations':
                if ($requestedGroup['settings']['invitations'] == 'members-only') {
                    if ($requestedGroup['settings']['type'] === 'open' && !!$requestedGroup['currentUserRole']) {
                        $hasPermission = true;
                    }

                    if (
                        in_array($requestedGroup['settings']['type'], array('closed', 'private')) &&
                        !!$requestedGroup['currentUserRole'] &&
                        !!$requestedGroup['currentUserApproved']
                    ) {
                        $hasPermission = true;
                    }
                }

                if ($requestedGroup['settings']['invitations'] == 'administrators' &&
                    in_array($requestedGroup['currentUserRole'], array('administrator'))
                ) {
                    $hasPermission = true;
                }

                break;
			case 'send-administrator-invitations':
				if (in_array($requestedGroup['currentUserRole'], array('administrator'))) {
					$hasPermission = true;
				}

				break;
		}

		return $hasPermission;
	}

	public function getGroupLogo($group, $width, $height) {
		$settings = $this->getSettings();

		if ($settings['profile']['use-gravatar'] === 'no') {

			if (isset($group['images']['logo-thumbnails'][$width . 'x' . $height]['src'])) {
				return $group['images']['logo-thumbnails'][$width . 'x' . $height]['src'];
			}

			if (isset($group['images']['logo'])) {
				if ($group['images']['logo']['width'] == $width && $group['images']['logo']['height'] == $height) {
					return $group['images']['logo']['src'];
				}
			}

			return $settings['groups']['default-logo'];

		} else {
			return $this->getGravatarUrl($group['name'], $width);
		}
	}

	public function getGroupUrl($group, $args = array()) {
		$permalinkBase = $this->getGroupPermalinkBase();
		$permalink = $this->getModule('routes')->getRouteUrl('groups');
		$permalinkStructure = get_option('permalink_structure');
		$permalinkGroupValue = $group['id'];

		if ($permalinkBase === 'groupalias') {
			$permalinkGroupValue = $group['alias'];
		}

		if ($permalinkStructure) {

			if (substr($permalinkStructure, -1) !== '/') {
				$permalink .= '/';
			}

			$url = $permalink . $permalinkGroupValue;

			if (!empty($args)) {
				$url .= '/' . implode('/', $args);
			}

			if (substr($permalinkStructure, -1) === '/') {
				$url .= '/';
			}

		} else {
			$url = add_query_arg(
				array_merge(
					array('group' => $permalinkGroupValue),
					$args
				),
				$permalink
			);
		}

		return $url;
	}

	public function getGroupUrlById($id){
        /**
         * @var $groupsModel Membership_Groups_Model_Groups
         */
	    $groupsModel = $this->getModel("Groups", "Groups");
	    $currentUserId = get_current_user_id();

	    $group = isset($this->_groupsById[$id]) ? $this->_groupsById[$id] : $groupsModel->getGroup($id, $currentUserId);

	    return $this->getGroupUrl($group);
    }

    public function getGroupNameById($id){
        /**
         * @var $groupsModel Membership_Groups_Model_Groups
         */
        $groupsModel = $this->getModel("Groups", "Groups");
        $currentUserId = get_current_user_id();


        $group = isset($this->_groupsById[$id]) ? $this->_groupsById[$id] : $groupsModel->getGroup($id, $currentUserId);

        return $group['name'];
    }

	public function activityData($activities, $data) {
		foreach ($activities as &$activity) {
			if (in_array($activity['type'], array('group_post', 'group_user_post'))) {
				$activity['url'] = $this->getGroupUrl($activity['group'], array(
					'action' => 'activity',
					'activity' => $activity['id']
				));
			}
		}

		return $activities;
	}

	public function getGroupPermalinkBase() {
		$settings = $this->getSettings();

		return $settings['groups']['permalink-base'];
	}

    public function notReadPost($group_id){
        /**
         * @var $notificationsModel Membership_Notifications_Model_Notifications
         */
        $notificationsModel = $this->getModel('Notifications', 'Notifications');
        $count = $notificationsModel->getNotificationCount(get_current_user_id(), array(
            'viewed' => 0,
            'type' => 'group_new_note',
            'target_id' => $group_id,
        ));

        return $count;
    }
}