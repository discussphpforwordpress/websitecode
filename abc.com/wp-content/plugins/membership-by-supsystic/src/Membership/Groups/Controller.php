<?php
class Membership_Groups_Controller extends Membership_Base_Controller {

	public function createGroup(Rsc_Http_Parameters $parameters) {
		$name = $parameters->get('name');
		$description = $parameters->get('description');
		$category = $parameters->get('category');
		// other language symbols not supported in url
//		$aliasPrepare = iconv('UTF-8', 'ASCII//TRANSLIT', $parameters->get('name'));
		$aliasPrepare = mb_convert_encoding($parameters->get('name'), 'UTF-8' );

		$alias = strtolower($this->getModule('base')->translateCyrillicToLatin(
			preg_replace('/[^\w0-9]/u', '-', $aliasPrepare)
		));

		$type = $parameters->get('type');
		$invitedUsers = $parameters->get('invitedUsers', null);

		// TODO validate max length
		if ($this->validate(
			array('name' => $name),
			array('name' => 'required')
		)->isFail()) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('Group name is required')
			));
		};

		$groupsModule = $this->getModule('groups');
		$groupsModel = $groupsModule->getModel();

		$groupId = $groupsModel->createGroup(array(
			'name' => $name,
			'description' => $description,
			'category_id' => $category,
			'alias' => $alias,
		));

		$error = $groupsModel->getError();

		if ($error) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $error
			));
		}

		$currentUserId = get_current_user_id();
		$groupSettings = $groupsModel->getDefaultGroupSettings();
		$groupSettings['type'] = $type;
		$groupsModel->setGroupSettings($groupId, $groupSettings);
		$groupsModel->setGroupAdmin($groupId, $currentUserId, 1);

		if ($invitedUsers) {
			$groupsInvitesModel = $this->getModel('GroupsInvites');
			$groupsInvitesModel->inviteUsers($groupId, $invitedUsers, $currentUserId);
		}

        $activityModel = $this->getModel('activity', 'activity');
        $activityModel->createActivity($currentUserId, 'group_created', null, null, $groupId);

		$followersModel = $this->getModel('Followers', 'Groups');
		$followersModel->addToFollowers($currentUserId, $groupId);

		$group = $groupsModel->getGroup($groupId, $currentUserId);


		return $this->response('ajax', array(
			'success' => true,
			'message' => $this->translate('Group successfully created.'),
			'redirect' => $groupsModule->getGroupUrl($group)
		));
	}

	public function joinGroup(Rsc_Http_Parameters $requestData) {
		$userId = get_current_user_id();
		$groupId = $requestData->get('groupId');
		$groupsModel = $this->getModel();
        $followersModel = $this->getModel('followers');
		$group = $groupsModel->getGroup($groupId, $userId);

		// TODO group privacy join settings
		if ($group && $group['currentUserRole'] === null) {

			$groupsInvitesModel = $this->getModel('GroupsInvites');
			$invitation = $groupsInvitesModel->getInvitation($userId, $groupId);

			$isInvited = !empty($invitation);

			if (!in_array($group['settings']['type'], array('open', 'closed')) && !$isInvited) {
				return $this->response('ajax', array(
					'success' => false,
					'status' => 403
				));
			}

			$groupRole = $invitation['invitation_type'];

            if (!$groupRole) {
                $groupRole = 'user';
            }

			$approved = true;

			if ($group['settings']['type'] === 'closed' && !$isInvited) {
				$approved = false;
			}

			$groupsModel->addUserToGroup($group['id'], $userId, $groupRole, $approved);

            if ($group && $group['currentUserIsFollowing'] !== '1') {
                $followersModel->addToFollowers($userId, $group['id']);
            }

			if ($isInvited) {
				$groupsInvitesModel->cancelInvitation($group['id'], $userId);
			}

            $group = $groupsModel->getGroup($groupId, $userId);

			return $this->response('ajax', array(
				'success' => true,
                'html' => $this->render('@groups/partials/groups-list.twig', array('groups' => array($group)))
			));
		}

		$error = $groupsModel->getError();
        $errorFollowers = $followersModel->getError();

        if ($errorFollowers) {
            $error .= $errorFollowers;
        }

		if ($error) {
			return $this->response('ajax', array(
				'success' => false,
				'error' => $error,
				'message' => $this->translate('Database error')
			));
		}
	}

	public function leaveGroup(Rsc_Http_Parameters $requestData) {
		$groupId = $requestData->get('groupId');
		$userId = get_current_user_id();
		$groupsModel = $this->getModel();
        $followersModel = $this->getModel('followers');
		$group = $groupsModel->getGroup($groupId, $userId);
		
		if (! $group || $group['currentUserRole'] === null) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('Group does not exists, or user not a member of this group')
			));
		}

		if ($group['currentUserRole'] == 'administrator' && $groupsModel->countUsersByRole($groupId, 'administrator') < 2) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('There is no administrators left in group, you must delete group first.')
			));
		}

		$groupsModel->removeUserFromGroup($groupId, $userId);

        if ($group['currentUserIsFollowing'] == '1') {
            $followersModel->removeFromFollowers($userId, $groupId);
        }

		$error = $groupsModel->getError();
        $errorFollowers = $followersModel->getError();

        if ($errorFollowers) {
            $error .= $errorFollowers;
        }

		if ($error) {
			return $this->response('ajax', array(
				'success' => false,
				'error' => $error
			));
		}

		$group = $groupsModel->getGroup($groupId, $userId);

		return $this->response('ajax', array(
			'success' => true,
			'html' => $this->render('@groups/partials/groups-list.twig', array('groups' => array($group)))
		));
	}

    public function followGroup(Rsc_Http_Parameters $requestData) {
        $userId = get_current_user_id();
        $groupId = $requestData->get('groupId');
        $groupsModel = $this->getModel();
        $group = $groupsModel->getGroup($groupId, $userId);
        $followersModel = $this->getModel('followers');

        if ($group && $group['currentUserIsFollowing'] !== '1') {
            if (!in_array($group['settings']['type'], array('open'))) {
                return $this->response('ajax', array(
                    'success' => false,
                    'status' => 403
                ));
            }

            $followersModel->addToFollowers($userId, $group['id']);

	        $group = $groupsModel->getGroup($groupId, $userId);

	        return $this->response('ajax', array(
		        'success' => true,
		        'html' => $this->render('@groups/partials/groups-list.twig', array('groups' => array($group)))
	        ));
        }

        $error = $groupsModel->getError();

        if ($error) {
            return $this->response('ajax', array(
                'success' => false,
                'error' => $error,
	            'message' => $this->translate('Database error')
            ));
        }
    }

    public function unfollowGroup(Rsc_Http_Parameters $requestData) {
        $groupId = $requestData->get('groupId');
        $userId = get_current_user_id();
        $groupsModel = $this->getModel();
        $group = $groupsModel->getGroup($groupId, $userId);
        $followersModel = $this->getModel('followers');

        if (!$group) {
            return $this->response('ajax', array(
                'success' => false,
                'message' => $this->translate('Group does not exists')
            ));
        }

        if ($group['currentUserIsFollowing'] !== '1') {
            return $this->response('ajax', array(
                'success' => false,
                'message' => $this->translate('User is not follower of this group')
            ));
        }

        $followersModel->removeFromFollowers($userId, $groupId);
        $error = $followersModel->getError();

        if ($error) {
            return $this->response('ajax', array(
                'success' => false,
                'error' => $error
            ));
        }

	    $group = $groupsModel->getGroup($groupId, $userId);

	    return $this->response('ajax', array(
		    'success' => true,
		    'html' => $this->render('@groups/partials/groups-list.twig', array('groups' => array($group)))
	    ));
    }

    public function deleteGroup(Rsc_Http_Parameters $requestData) {
        $groupId = $requestData->get('groupId');
        $userId = get_current_user_id();
        $groupsModel = $this->getModel();
        $group = $groupsModel->getGroup($groupId, $userId);

        if (! $group) {
            return $this->response('ajax', array(
                'success' => false,
                'message' => $this->translate('Group does not exists.')
            ));
        }

        if ($group['currentUserRole'] !== 'administrator') {
            return $this->response('ajax', array(
                'success' => false,
                'message' => $this->translate('User does not have permission to delete this group.')
            ));
        }

        $groupsModel->deleteGroup($groupId, $userId);

        $error = $groupsModel->getError();

        if ($error) {
            return $this->response('ajax', array(
                'success' => false,
                'error' => $error,
                'message' => $this->translate('Database error')
            ));
        }

        return $this->response('ajax', array(
            'success' => true,
	        'redirect' => $this->getModule('routes')->getRouteUrl('groups'),
            'message' => $this->translate('Group was deleted.')
        ));
    }

	public function changeCover(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
		$userId = get_current_user_id();
		$groupId = $parameters->get('groupId');
		$groupModel = $this->getModel();
		$group = $groupModel->getGroup($groupId, $userId);

		if (!in_array($group['currentUserRole'], array('administrator'))) {
				return $this->response('ajax', array(
					'success' => false,
					'status' => 405
				));
		}

		$userId = get_current_user_id();
		
		$attachmentId = $parameters->get('attachmentId');
		$cropData = $parameters->get('cropData');

		$imagesModel = $this->getModel('images', 'base');
		$images = $imagesModel->createImagesFromAttachments(array($attachmentId), $userId);

		$coverImage = $images[0];
		$settings = $this->getModule('base')->getSettings();

		$sizes = array(
			$settings['groups']['cover-size'],
            $settings['groups']['cover-medium-size'],
			$settings['groups']['cover-small-size']
		);

		foreach ($sizes as $size) {
			$imagesModel->cropImage($coverImage, $cropData, $size['width'], $size['height']);
		}

		$imagesModel->setGroupCover($groupId, $coverImage['id'], serialize($cropData));
	
		return $this->response('ajax', 
			array(
				'success' => true,
				'images' => $imagesModel->getGroupsImages(array($groupId))
			)
		);
	}

	public function removeCover(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$groupId = $parameters->get('groupId');
		$groupModel = $this->getModel();
		$group = $groupModel->getGroup($groupId, $userId);

		if (!in_array($group['currentUserRole'], array('administrator'))) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 405
			));
		}

		$imagesModel = $this->getModel('images', 'base');
		$imagesModel->removeGroupCover($groupId);

		return $this->response('ajax', 
			array(
				'success' => true,
			)
		);
	}

	public function changeLogo(Rsc_Http_Parameters $parameters, Rsc_Http_Request $request) {
				$userId = get_current_user_id();
		$groupId = $parameters->get('groupId');

		$groupModel = $this->getModel();
		$group = $groupModel->getGroup($groupId, $userId);

		if (!in_array($group['currentUserRole'], array('administrator'))) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 405
			));
		}

		$attachmentId = $parameters->get('attachmentId');
		$cropData = $parameters->get('cropData');

		$imagesModel = $this->getModel('images', 'base');
		$images = $imagesModel->createImagesFromAttachments(array($attachmentId), $userId);

		$logoImage = $images[0];
		$settings = $this->getModule('base')->getSettings();

		$sizes = array(
			$settings['groups']['logo-size'],
			$settings['groups']['logo-large-size'],
			$settings['groups']['logo-medium-size'],
			$settings['groups']['logo-small-size']
		);

		foreach ($sizes as $size) {
			$imagesModel->cropImage($logoImage, $cropData, $size['width'], $size['height']);
		}

		$imagesModel->setGroupLogo($groupId, $logoImage['id'], serialize($cropData));
	
		return $this->response('ajax', 
			array(
				'success' => true,
				'images' => $imagesModel->getGroupsImages(array($groupId))
			)
		);
	}

	public function removeLogo(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$groupId = $parameters->get('groupId');
		$groupModel = $this->getModel();
		$group = $groupModel->getGroup($groupId, $userId);

		if (!in_array($group['currentUserRole'], array('administrator'))) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 405
			));
		}

		$imagesModel = $this->getModel('images', 'base');
		$imagesModel->removeGroupLogo($groupId);

		return $this->response('ajax', 
			array(
				'success' => true,
			)
		);
	}

	public function blockGroup(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$groupId = $parameters->get('groupId');
		$groupModel = $this->getModel();
		$group = $groupModel->getGroup($groupId, $userId);

		if (! $group) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('Group does not exists.')
			));
		}

		if (!$this->getModule('users')->currentUserCan('can-block-groups')) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 405
			));
		}

		$groupModel->blockGroup($groupId);

		return $this->response('ajax', array('success' => true));
	}

	public function unblockGroup(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$groupId = $parameters->get('groupId');
		$groupModel = $this->getModel();
		$group = $groupModel->getGroup($groupId, $userId);

		if (! $group) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('Group does not exists.')
			));
		}

		if (!$this->getModule('users')->currentUserCan('can-block-groups')) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 405
			));
		}

		$groupModel->unblockGroup($groupId);

		return $this->response('ajax', array('success' => true));
	}

	public function getUsers(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$groupId = $parameters->get('groupId');
		$status = $parameters->get('status', 'approved');
		$limit = min(max($parameters->get('limit', 0), 1), 50);
		$offsetId = $parameters->get('offsetId', 0);
		$search = $parameters->get('search', null);
		$groupModel = $this->getModel();

		$group = $groupModel->getGroup($groupId, $userId);

		if ($group && !in_array($group['currentUserRole'], array('administrator')) &&
			in_array($status, array('unapproved', 'invited', 'blocked'))
		) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 405
			));
		}

		$users = $groupModel->getGroupMembers($groupId, $status, $limit, $offsetId, $search);

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render('@groups/partials/group-users-list.twig', array(
					'users' => $users,
					'listType' => $status,
					'requestedGroup' => $group,
				))
			)
		);
	}

	public function getUsersToInvite(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$groupId = $parameters->get('groupId', null);
		$limit = min(max($parameters->get('limit', 0), 1), 50);
		$offsetId = $parameters->get('offsetId', null);
		$search = $parameters->get('search', null);
		$template = $parameters->get('template', 'invite-modal');

		$groupModel = $this->getModel();

		$users = $groupModel->getUsersToInvite($groupId, $userId, $limit, $offsetId, $search);



		if ($template == 'invite-modal') {
			$template = '@groups/partials/invite-modal-users.twig';
		} elseif ($template == 'search-dropdown') {
			$template = '@base/partials/search-dropdown-user.twig';
		} else {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('Unsupported template.')
			));
		}

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render($template, array('users' => $users))
			)
		);
	}

	public function removeUser(Rsc_Http_Parameters $parameters) {
		$groupId = $parameters->get('groupId');
		$userId = $parameters->get('userId');
		$block = $parameters->get('block') === 'true';

		$groupsModel = $this->getModel();
		$currentUserId = get_current_user_id();
		$group = $groupsModel->getGroup($groupId, $currentUserId);

		if ($group && in_array($group['currentUserRole'], array('administrator'))) {
			$groupsModel->removeUserFromGroup($groupId, $userId);

			if ($block) {
				$this->getModel('GroupsBlacklists')->blockUser($groupId, $userId, $currentUserId);
			}

			return $this->response(
				'ajax',
				array(
					'success' => true,
				)
			);
		}

		return $this->response('ajax', array(
			'success' => false,
			'status' => 405
		));
	}

	public function unblockUser(Rsc_Http_Parameters $parameters) {
		$groupId = $parameters->get('groupId');
		$userId = $parameters->get('userId');
		$groupsModel = $this->getModel();

		$currentUserId = get_current_user_id();
		$group = $groupsModel->getGroup($groupId, $currentUserId);

		if ($group && in_array($group['currentUserRole'], array('administrator'))) {
			$blacklistsModel = $this->getModel('GroupsBlacklists');
			$blacklistsModel->unblockUser($groupId, $userId);
			
			return $this->response(
				'ajax',
				array(
					'success' => true,
				)
			);
		}

		return $this->response('ajax', array(
			'success' => false,
			'status' => 405
		));
	}

	public function addTag(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$groupId = $parameters->get('groupId');
		$groupModel = $this->getModel();
		$group = $groupModel->getGroup($groupId, $userId);
		$tag = $parameters->get('tag', null);

		if (!$group || !$tag) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 405
			));
		}

		$tagsModel = $this->getModel('Tags', 'Groups');

		if ($tagsModel->groupHasTag($groupId, $tag)) {
			return $this->response('ajax', array(
				'success' => false,
				'error' => sprintf($this->translate('%s tag already added to this group.'), $tag)
			));
		}

		$tagsModel->addTag($groupId, $tag);
		$tags = $tagsModel->getGroupTags($groupId);
		$tags = array_shift($tags);

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render('@groups/partials/tags-list.twig', array('tags' => $tags))
			)
		);
	}

	public function removeTag(Rsc_Http_Parameters $parameters) {
        $userId = get_current_user_id();
        $groupId = $parameters->get('groupId');
        $tagId = $parameters->get('tagId');
        $groupsModel = $this->getModel();
        $tagsModel = $this->getModel('Tags', 'Groups');
        $group = $groupsModel->getGroup($groupId, $userId);

        if (!$group) {
            return $this->response('ajax', array(
                'success' => false,
                'status' => 405,
                'error' => $this->translate('Group with given id does not exists.')
            ));
        }

        if ($group['currentUserRole'] !== 'administrator') {
	        return $this->response('ajax', array(
		        'success' => false,
		        'status' => 403,
	        ));
        }

		if (!$tagsModel->groupHasTag($groupId, $tagId, $type = 'id')) {
			return $this->response('ajax', array(
				'success' => false,
				'error'   => $this->translate('Tag does not exists at this group')
			));
		}

		$tagsModel->removeTag($tagId, $groupId);

        return $this->response(
            'ajax',
            array(
                'success' => true
            )
        );
	}

	public function saveSettings($request) {
		$newSettings = $request->get('settings');
		$settingsModel = $this->getModel('settings', 'groups');
		$defaultImagesModel = $this->getModel('DefaultImages', 'base');
		$oldSettings = $settingsModel->getSettings();
		$defaultSettings = $settingsModel->defaultSettings();

		$newSettings = $defaultImagesModel->recreateDefaultImageByType('logo', array('large', 'medium', 'small'), $newSettings, $oldSettings, $defaultSettings);
		$newSettings = $defaultImagesModel->recreateDefaultImageByType('cover', array('medium', 'small'), $newSettings, $oldSettings, $defaultSettings);

		try {
			$settingsModel->saveSettings($newSettings);
		} catch (Exception $e) {
			status_header(500);
			return $this->response('ajax', array('message' => $e->getMessage()));
		}
		
		return $this->response('ajax');
	}

	public function getActivity(Rsc_Http_Parameters $parameters) {
        /**
         * @var $activityModel Membership_Activity_Model_Activity
         */
        $groupId = $parameters->get('groupId');
        $currentUserId = get_current_user_id();
        $limit = min(max($parameters->get('limit', 0), 1), 20);
        $offsetId = $parameters->get('offsetId', null);
        $activityModel = $this->getModel('activity', 'activity');

        $activities = $activityModel->getGroupActivity($groupId, $currentUserId, $limit, $offsetId);

        return $this->response(
            'ajax',
            array(
                'success' => true,
                'html' => $this->render('@activity/partials/activities.twig', array('activities' => $activities))
            )
        );

    }

	public function postActivity(Rsc_Http_Parameters $parameters) {
		$groupId = $parameters->get('groupId');
		$activityContent = $parameters->get('data');
		$isCommunityPost = $parameters->get('isCommunityPost') == 'true';

		if(empty($activityContent['images']) && empty($activityContent['message']) && empty($activityContent['files'])) {
			return $this->response(
				'ajax',
				array(
					'success' => false,
					'message' => $this->translate('Post can\'t be empty'),
				)
			);
		}

		$currentUserId = get_current_user_id();

        /**
         * @var $groupsModel Membership_Groups_Module
         */
		$groupsModel = $this->getModel();
		$groupsModule = $this->getModule('groups');
		$group = $groupsModel->getGroup($groupId, $currentUserId);

		if (!$groupsModule->currentUserHasGroupPermission('post-activity', $group)) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('Activity posting is restricted'),
				'status' => 403
			));
		}

		$activityModel = $this->getModel('activity', 'activity');

		$activityType = 'group_user_post';

		if ($isCommunityPost and $group['currentUserRole'] == 'administrator') {
			$activityType = 'group_post';
		}

		$activityId = $activityModel->createActivity(
			$currentUserId,
			$activityType,
			$activityContent['message'],
			null,
			$groupId
		);

        $groupMembers = $groupsModel->getGroupMembers($groupId, 'approved');
        $groupFollowers = $this->getModel('followers')->getGroupFollowers($groupId);
        $usersIds = array();

        foreach ($groupMembers as $user) {
            $usersIds[] = $user['id'];
        }

        foreach ($groupFollowers as $user) {
            if (!in_array($user['id'], $usersIds)) {
                $usersIds[] = $user['id'];
            }
        }

        if (isset($activityContent['images'])) {

        	$imagesModel = $this->getModel('images', 'base');
        	$albumsModel = $this->getModel('albums', 'base');

            $images = $imagesModel->createImagesFromAttachments(
                $activityContent['images'],
                $currentUserId
            );

            // Create thumbnails
            foreach ($images as $image) {
            	$imagesModel->resizeImage($image, 600, 600);
            	$imagesModel->resizeImage($image, 300, 300);
            }

            $imagesIds = array();

            foreach ($images as $image) {
                $imagesIds[] = $image['id'];
            }

            $this->getModel('activity', 'activity')->setActivityImages($activityId, $imagesIds);
            $activityAlbum = $albumsModel->getGroupActivityAlbum($groupId);
            $albumsModel->addImages($activityAlbum['id'], $imagesIds);
        }

		if(!empty($activityContent['files'])) {
			$this->setActivityAttachments($activityId, $activityContent['files']);
		}

		if (isset($activityContent['link']) && !isset($activityContent['images'])) {
			$linksModel = $this->getModel('Links', 'Activity');
			$linksModel->setActivityLinkByHash($activityId, $activityContent['link']);
		}

		if (isset($activityContent['galleries']) && count($activityContent['galleries'])) {
			$galleryAttachment = $this->getModel('GalleryAttachment', 'gallery');
			$galleryAttachment->updatePostsFieldInGalleries($activityContent['galleries'], $activityId);
		}
		if (isset($activityContent['sliders']) && count($activityContent['sliders'])) {
			$sliderAttachment = $this->getModel('SliderAttachment', 'slider');
			$sliderAttachment->updatePostsFieldInSliders($activityContent['sliders'], $activityId);
		}

		if(isset($activityContent['googleMapsEasy']) && count($activityContent['googleMapsEasy'])) {
			$googleMapsEasyAttachment = $this->getModel('GoogleMapsEasy', 'Googlemapseasy');
			$googleMapsEasyAttachment->updatePostFieldFor($activityContent['googleMapsEasy'], $activityId);
		}

		$activities = $activityModel->getActivityById($activityId, $currentUserId);

        /**
         * @var $notificationModel Membership_Notifications_Model_Notifications
         */
        $notificationModel = $this->getModel('Notifications', 'Notifications');

        foreach ($groupMembers as $key => $user_array){
            if($user_array['id'] == $currentUserId)
                continue;
            $notificationModel->createNotification($user_array['id'], 'group_new_note', $groupId, $activityId);
        }

		return $this->response(
			'ajax',
			array(
				'success' => 'true',
				'html' => $this->render('@activity/partials/activities.twig', array('activities' => $activities))
			)
		);

	}

	public function removeActivity(Rsc_Http_Parameters $parameters) {
		$activityId = $parameters->get('activityId');
		$currentUserId = get_current_user_id();
		$groupsModel = $this->getModel();
		$activityModel = $this->getModel('activity', 'activity');
		$activity = current($activityModel->getActivityById($activityId, $currentUserId, array('status' => 'active')));
		$userCanDeleteActivity = false;

		if ($activity) {
			if (intval($activity['user_id']) == $currentUserId) {
				$userCanDeleteActivity = true;
			} else {
				$group = $groupsModel->getGroup($activity['object_id'], $currentUserId);
				if ($group && $group['currentUserRole'] == 'administrator') {
					$userCanDeleteActivity = true;
				}
				$usersModule = $this->getModule('Users');
				if($usersModule->currentUserCan('edit-activity')) {
					$userCanDeleteActivity = true;
				}
			}
		}

		if ($userCanDeleteActivity) {
			$activityModel->removeActivity($activityId);
			$galleryAttachmentModel = $this->getModel('GalleryAttachment', 'gallery');
			$galleryAttachmentModel->removeGalleryByPostId($activityId);

			$sliderAttachmentModel = $this->getModel('SliderAttachment', 'slider');
			$sliderAttachmentModel->removeSliderByPostId($activityId);

			$googleMapsEasyAttachment = $this->getModel('GoogleMapsEasy', 'Googlemapseasy');
			$googleMapsEasyAttachment->removeMapByPostId($activityId);

			return $this->response('ajax',
				array(
					'success' => 'true',
				)
			);
		}

		return $this->response('ajax', array(
			'success' => false,
			'status' => 403
		));
	}

	public function updatePrivacy(Rsc_Http_Parameters $parameters) {
		$groupId = $parameters->get('groupId');
		$privacies = $parameters->get('privacies');
		$currentUserId = get_current_user_id();

		$groupsModel = $this->getModel();
		$group = $groupsModel->getGroup($groupId, $currentUserId);
	
		if ($group && $group['currentUserRole'] == 'administrator') {

            $groupsModel->setGroupSettings($groupId, $privacies);

			return $this->response(
				'ajax',
				array(
					'success' => true,
					'message' => $this->translate('Privacy settings was updated.')
				)
			);
		}

		return $this->response('ajax', array(
			'success' => false,
			'message' => $this->translate('Privacy settings was not updated.')
		));
	}


	public function updateData(Rsc_Http_Parameters $parameters) {
		$groupId  = $parameters->get('groupId');
		$data = $parameters->get('data');
		$userId = get_current_user_id();

		// TODO validate max length
		$validate = $this->validate($data,
			array(
				'name' => array(
					'presence' => array(
						'message' => $this->translate('Group name is required')
					)
				),
			)
		);

		if ($validate->isFail()) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => implode(', ', $validate->getErrorsList())
			));
		};

		$groupsModel = $this->getModel();
		$group = $groupsModel->getGroup($groupId, $userId);

		if ($group && $group['currentUserRole']  === 'administrator' ) {
			$groupsModel->updateGroup($data, $groupId);
			return $this->response('ajax',
				array(
					'success' => true,
					'message' => $this->translate('Group data successfully updated')
				));
		}

		$error = $groupsModel->getError();

		if ($error) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $error
			));
		}

		return $this->response('ajax', array(
			'success' => false,
			'message' => $this->translate('Something went wrong')
		));
	}

	public function approveUser(Rsc_Http_Parameters $parameters) {
		$groupId = $parameters->get('groupId');
		$userId = $parameters->get('userId');

		$groupsModel = $this->getModel();
		$currentUserId = get_current_user_id();

		$group = $groupsModel->getGroup($groupId, $currentUserId);

		if ($group && in_array($group['currentUserRole'], array('administrator'))) {

			$groupsModel->updateUserGroupRole($groupId, $userId, 'user', true);

			return $this->response(
				'ajax',
				array(
					'success' => true
				)
			);
		}

		return $this->response('ajax', array(
			'success' => false,
			'status' => 405
		));
	}

	public function invite(Rsc_Http_Parameters $parameters) {
		$groupId = $parameters->get('groupId');
		$userId = $parameters->get('userId');
		$role = $parameters->get('role', 'user');
		$groupsModule = $this->getModule();
		$groupsModel = $this->getModel();
		$currentUserId = get_current_user_id();
		$group = $groupsModel->getGroup($groupId, $currentUserId);

		if (!$group || !$groupsModule->currentUserHasGroupPermission('send-invitations', $group)) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 403
			));
		}

		if ($role !== 'user' && !$groupsModule->currentUserHasGroupPermission('send-administrator-invitations', $group)) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 403
			));
		}


		$invitesModel = $this->getModel('GroupsInvites');
		$invitesModel->inviteUser($groupId, $userId, $currentUserId, $role);

		return $this->response(
			'ajax',
			array(
				'success' => true,
			)
		);
	}

	public function cancelInvite(Rsc_Http_Parameters $parameters) {

		$groupId = $parameters->get('groupId');
		$userId = (int) $parameters->get('userId');
		$groupsModel = $this->getModel();
		$currentUserId = (int) get_current_user_id();
		$group = $groupsModel->getGroup($groupId, $currentUserId);
		$groupsModule = $this->getModule();
		$invitesModel = $this->getModel('GroupsInvites');


		if ($userId === $currentUserId && $invitesModel->isInvited($userId, $groupId)) {
			$invitesModel->cancelInvitation($groupId, $currentUserId);

			return $this->response(
				'ajax',
				array(
					'success' => true,
				)
			);
		}

		// || !$groupsModule->currentUserHasGroupPermission('send-invitations', $group)
		if (!$group) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 405
			));
		}

		/*
		if (in_array($group['currentUserRole'], array('administrator'))) {
			$currentUserId = null;
		}
        */
        $currentUserId = null;

		$invitesModel->cancelInvitation($groupId, $userId, $currentUserId);

		return $this->response(
			'ajax',
			array(
				'success' => true,
			)
		);
	}

	public function countUserGroups() {
		$groupsModel = $this->getModel();
		$currentUserId = get_current_user_id();
		$groups = $groupsModel->countUserGroups($currentUserId);

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'groups' => $groups,
			)
		);
	}

	public function getUserGroups(Rsc_Http_Parameters $parameters) {

		$userId = $parameters->get('userId');
		$usersModule = $this->getModule('Users');
		$usersModel = $this->getModel('Profile', 'Users');
		$requestedUser = $usersModel->getUserById($userId);

		if ($requestedUser && $usersModule->currentUserHasPermission('view-groups', $requestedUser)) {

			$groupsModel = $this->getModel();

			$type = $parameters->get('type');
			$limit = min(max($parameters->get('limit', 0), 1), 50);
			$offsetId = $parameters->get('offsetId', null);
			$search = $parameters->get('search', null);
			$category_id = $parameters->get('category_id', null);

			$groups = $groupsModel->getUserGroups($requestedUser['id'], $type, $limit, $offsetId, $search, $category_id);

			return $this->response(
				'ajax',
				array(
					'success' => true,
					'html' => $this->render('@groups/partials/groups-list.twig', array('groups' => $groups))
				)
			);
		} else {
			return $this->response(
				'ajax',
				array(
					'success' => false
				)
			);
		}

	}

	public function getGroups(Rsc_Http_Parameters $parameters) {
		$groupsModel = $this->getModel();
		$currentUserId = get_current_user_id();
		$limit = min(max($parameters->get('limit', 0), 1), 50);
		$offsetId = $parameters->get('offsetId', null);
		$search = $parameters->get('search', null);
		$category_id = $parameters->get('category_id', null);
		$groups = $groupsModel->getGroups($currentUserId, $limit, $offsetId, $search, $category_id);

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render('@groups/partials/groups-list.twig', array('groups' => $groups))
			)
		);
	}

	public function isNoteOnGroup(Rsc_Http_Parameters $parameters){
        /**
         * @var $groupsModel Membership_Groups_Model_Groups
         * @var $group array
         * @var $activityModel Membership_Activity_Model_Activity
         */
        //==============================Check data============================//
        //--------------------------------------------------------------------//
        //==============================Check data============================//
	    $group_alias = $parameters['group'];
	    $activityModel = $this->getModel('Activity', 'Activity');
	    $groupsModel = $this->getModel('Groups', 'Groups');
	    $group = $groupsModel->getGroupByAlias($group_alias, get_current_user_id());

        $group_id = null;
        $activity_id = null;
        $activities = array();

        if(!empty($group)){
            $group_id = $group['id'];
            $activity_id = $parameters['activity'];
            $activities = $activityModel->getActivitiesByGroupId($group_id);
        }else{
            //Mb $this->response... $erorr = 'Some text'?
            return false;
        }

	    //==================================Very bad code!=================================//

	    $result = false;
	    $offset = 0;
	    foreach ($activities as $key => $activity){
	        if($activity['id'] == $activity_id){
	            $result = true;
	            $offset = $key;
	            break;
            }
        }
        //==================================Very bad code!=================================//

	    return $this->response(Rsc_Http_Response::AJAX, array(
	        'result' => $result,
            'offset' => $offset,
            'offsetId' => $activities[$offset]['id'],
        ));

    }

    public function addGroupCategory(Rsc_Http_Parameters $parameters) {
		$categoryName = trim($parameters->get('categoryName'));
		$newId = 0;
		$errMessage = '';
		$length = strlen($categoryName);
		if($length) {
			if($length < 204) {
				$groupCategoryModel = $this->getModel('GroupsCategory', 'Groups');
				$newId = $groupCategoryModel->add($categoryName);
			} else {
				$errMessage = $this->translate('Error! The maximum length is 204 characters');
			}
		} else {
			$errMessage = $this->translate('Please enter Group Category Name!');
		}

		return $this->response(
			'ajax',
			array(
				'success' => ((int)$newId) > 0,
				'newId' => $newId,
				'message' => $errMessage,
			)
		);
	}

	public function updateGroupCategory(Rsc_Http_Parameters $parameters) {
		$catId = (int) $parameters->get('id');
		$categoryName = trim($parameters->get('categoryName'));
		$errorMsg = '';
		$length = strlen($categoryName);
		$updateRes = false;
		$updateDump = null;
		if($catId) {
			if($length) {
				if($length < 204) {
					$groupCategoryModel = $this->getModel('GroupsCategory', 'Groups');
					$updateDump = $groupCategoryModel->update($catId, $categoryName);
					$updateRes = true;
				} else {
					$errorMsg = $this->translate('Error! The maximum length is 204 characters');
				}
			} else {
				$errorMsg = $this->translate('Please enter Group Category Name!');
			}
		}

		return $this->response(
			'ajax',
			array(
				'success' => $updateRes,
				'updateInfo' => $updateDump,
				'message' => $errorMsg,
			)
		);
	}

	public function removeGroupCategory(Rsc_Http_Parameters $parameters) {
		$catId = (int) $parameters->get('id');
		$errorMsg = '';
		$removeRes = false;
		$removeDump = null;

		if($catId) {
			$groupCategoryModel = $this->getModel('GroupsCategory', 'Groups');
			$removeDump = $groupCategoryModel->remove($catId);
			$removeRes = true;
		}

		return $this->response(
			'ajax',
			array(
				'success' => $removeRes,
				'updateInfo' => $removeDump,
				'message' => $errorMsg,
			)
		);
	}

	public function setActivityAttachments($activityId, $attachmentsIds) {

		$attachmentAllModel = $this->getModule('base')->getModel('AttachmentAll');
		$attachmentAllModel->updateSavedParamFor($attachmentsIds);

		$activityModel = $this->getModule('activity')->getModel('activity');
		$activityModel->addAttachmentFiles($activityId, $attachmentsIds);
	}
}