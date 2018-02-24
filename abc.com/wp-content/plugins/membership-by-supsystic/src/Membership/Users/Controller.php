<?php
class Membership_Users_Controller extends Membership_Base_Controller {

	public function indexAction(Rsc_Http_Request $request) {

		$settings = $this->getModel('settings', 'users')->getSettings();
		$fieldsModel = $this->getModel('Fields', 'Users');
		$dateFormats = Membership_Users_Model_Fields::getDateFormats();

		$rolesModel = $this->getModel('Roles', 'Roles');
		$roles = $rolesModel->getRoles(true);
		
		return $this->response(
			'@users/backend/index.twig',
			array(
				'settings' => $settings,
				'roles' => $roles,
				'dateFormats' => $dateFormats,
			)
		);
	}

	public function listAction(Rsc_Http_Request $request) {

		$usersModel = $this->getModel('Profile', 'Users');
		$search = $request->query->get('search', null);

		$params = array(
			'showOnlyActive' => false,
			'withUsersExtraQuery' => false
		);

		if (!is_null($search)) {
			$params['search'] = $search;
			$totalUsers = $usersModel->getUsersCount($params);
		} else {
			$totalUsers = $usersModel->getUsersCount($params);
		}

		$limit = 25;
		$totalPaginationPages = ceil($totalUsers / $limit);
		$currentPage = max(1, intval($request->query->get('p', 1)));
		$offset = ($currentPage -1) * $limit;

		$rolesModel = $this->getModel('Roles', 'Roles');
		$roles = $rolesModel->getRoles(true);

		$params['limit'] = $limit;
		$params['offset'] = $offset;
		$params['sort'] = $request->query->get('sort', 'id');
		$params['order'] = $request->query->get('order', 'desc');


		if (!is_null($search)) {
			$users = $usersModel->searchUsersByName($params);
		} else {
			$users = $usersModel->getUsers($params);
		}

		$users = $usersModel->setLastSeenData($users);
		$userStatusesList = $usersModel->userStatusesList();

		return $this->response(
			'@users/backend/users-list.twig',
			array(
				'roles' => $roles,
				'users' => $users,
				'userStatusesList' => $userStatusesList,
				'totalPaginationPages' => $totalPaginationPages,
				'totalUsers' => $totalUsers,
			)
		);
	}


	private function csvToArray($filename='', $delimiter=',')
	{
		if(!file_exists($filename) || !is_readable($filename)) {
			return false;
		}

		$header = null;
		$data = array();

		if (($handle = fopen($filename, 'r')) !== false) {
			while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
				if (!$header) {
					$header = $row;
				} else {
					$data[] = array_combine($header, $row);
				}
			}
			fclose($handle);
		}

		return $data;
	}

	public function importFromCsvAction(Rsc_Http_Request $request) {

		$nonceAction = 'csvImport';
		$fieldsModel = $this->getModel('Fields', 'Users');
		$fields = $fieldsModel->getFieldsList($exclude = array('user_pass_confirm', 'g-recaptcha-response'));

		if ($request->server->get('REQUEST_METHOD') === 'POST') {

			$errors = array();

			$uploadedFile = $request->files->get('csv');
			$delimiter = $request->post->get('delimiter', ',');

			if (! check_admin_referer($nonceAction) ||
			    ! ($uploadedFile['error'] == UPLOAD_ERR_OK && is_uploaded_file($uploadedFile['tmp_name']))
			    || !current_user_can('create_users')
			) {
				return;
			}

			$data = $this->csvToArray($uploadedFile['tmp_name'], $delimiter);

			foreach ($data as $userData) {

				$wpUserFields = array();
				$membershipFieldsData = array();

				if (!isset($userData['user_login'])) {
					$errors[] = sprintf($this->translate('Field user_login is required. Passed data: %s. Skipped.'), implode($delimiter, $userData));
					continue;
				} else {
					if (username_exists($userData['user_login'])) {
						$errors[] = sprintf($this->translate('User with login %s already exists. Skipped.'), '<b>' . $userData['user_login'] . '</b>');
						continue;
					}
				}

				if (isset($userData['user_email']) && email_exists($userData['user_email'])) {
					$errors[] = sprintf($this->translate('User with email %s already exists. Skipped.'), '<b>' . $userData['user_email'] . '</b>');
					continue;
				}

				foreach ($fields as $field) {
					if (isset($userData[$field['name']])) {
						if (isset($field['sys']) && $field['sys']) {
							$wpUserFields[$field['name']] = $userData[$field['name']];
						} else {
							if (in_array($field['type'], array('scroll', 'drop', 'checkbox', 'radio'))) {
								foreach ($field['options'] as $fieldOption) {
									if ($fieldOption['id'] === $userData[$field['name']]) {
										$membershipFieldsData[$field['name']] = array(
											$userData[$field['name']]
										);
									}
								}
							} else {
								$membershipFieldsData[$field['name']] = $userData[$field['name']];
							}
						}
					}
				}

				if (!isset($wpUserFields['user_pass'])) {
					$wpUserFields['user_pass'] = $userData['user_login'];
				}

				$userId = wp_insert_user($wpUserFields);

				if (is_wp_error($userId)) {
					$errors[] = sprintf(
						$this->translate('Error creating user with login: %s. Error message: %s'),
						$userData['user_login'],
						$userId->get_error_message());
					continue;
				}

				$this->getModel('Profile', 'Users')
				     ->setUserStatus($userId, Membership_Users_Model_Fields::STATUS_ACTIVE);

				if ($membershipFieldsData) {
					$fieldsModel->updateForUser($userId, $membershipFieldsData);
				}
			}

			return $this->response(
				'@users/backend/import-from-csv.twig',
				array(
					'importResponse' => true,
					'importErrors' => $errors
				)
			);

		} else {
			return $this->response(
				'@users/backend/import-from-csv.twig',
				array(
					'fields' => $fields,
					'nonce' => wp_create_nonce($nonceAction)
				)
			);
		}
	}

	public function getFields(Rsc_Http_Parameters $data) {
        /**
         * @var $fieldsModel Membership_Users_Model_Fields
         */
		$fieldsModel = $this->getModel('fields', 'users');
		$fields = $fieldsModel->getFields(array('include_user_role' => array('enabled' => false)));

		return $this->response('ajax', array(
			'fields' => json_encode($fields)
		));
	}

	public function saveFields(Rsc_Http_Parameters $data) {
		$fieldsModel = $this->getModel('fields', 'users');
		try {
			$fieldsModel->saveFields($data['fields']);
		} catch (Exception $e) {
			status_header(500);
			return $this->response('ajax', array('message' => $e->getMessage()));
		}
		return $this->response('ajax');
	}

	public function saveSettings($request) {
		$newSettings = $request->get('settings');
		$settingsModel = $this->getModel('settings', 'users');
		$defaultImagesModel = $this->getModel('DefaultImages', 'base');
		$oldSettings = $settingsModel->getSettings();
		$defaultSettings = $settingsModel->defaultSettings();

		$newSettings = $defaultImagesModel->recreateDefaultImageByType('avatar', array('large', 'medium', 'small'), $newSettings, $oldSettings, $defaultSettings);
		$newSettings = $defaultImagesModel->recreateDefaultImageByType('cover', array('medium', 'small'), $newSettings, $oldSettings, $defaultSettings);

		try {
			$settingsModel->saveSettings($newSettings);
		} catch (Exception $e) {
			status_header(500);
			return $this->response('ajax', array('message' => $e->getMessage()));
		}

		return $this->response('ajax');
	}

	public function changeCover(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		
		$attachmentId = $parameters->get('attachmentId');
		$cropData = $parameters->get('cropData');

		$imagesModel = $this->getModel('images', 'base');
		$images = $imagesModel->createImagesFromAttachments(array($attachmentId), $userId);

		$coverImage = $images[0];

		$settings = $this->getModule('base')->getSettings();

		$sizes = array(
			$settings['profile']['cover-size'],
            $settings['profile']['cover-medium-size'],
			$settings['profile']['cover-small-size']
		);

		foreach ($sizes as $size) {
			$imagesModel->cropImage($coverImage, $cropData, $size['width'], $size['height']);
		}

		$imagesModel->setUserCover($userId, $coverImage['id'], serialize($cropData));

		return $this->response('ajax', 
			array(
				'success' => true,
				'images' => $imagesModel->getUsersImages(array($userId))
			)
		);
	}

	public function removeCover(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$imagesModel = $this->getModel('images', 'base');
		$imagesModel->removeUserCover($userId);

		return $this->response('ajax', 
			array(
				'success' => true,
			)
		);
	}

	public function changeAvatar(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$attachmentId = $parameters->get('attachmentId');
		$cropData = $parameters->get('cropData');

		$imagesModel = $this->getModel('images', 'base');
		$images = $imagesModel->createImagesFromAttachments(array($attachmentId), $userId);

		$avatarImage = $images[0];

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
	
		return $this->response('ajax', 
			array(
				'success' => true,
				'images' => $imagesModel->getUsersImages(array($userId))
			)
		);
	}

	public function removeAvatar(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$imagesModel = $this->getModel('images', 'base');
		$imagesModel->removeUserAvatar($userId);

		return $this->response('ajax', 
			array(
				'success' => true,
			)
		);
	}

	public function saveAboutFields(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$fieldName = $parameters->get('fieldName');
		$fieldData = $parameters->get('fieldData');

		if (in_array($fieldName, array('first_name', 'last_name'))) {
			wp_update_user(
				array(
					'ID' => $userId,
					$fieldName => $fieldData
				)
			);
		}

		if($fieldName == 'user_role') {
			$rolesModel = $this->getModel('roles', 'roles');
			$fieldData = (int) $fieldData;
			$isSelectedUserRoleExist = $rolesModel->isRoleExist($fieldData);
			// check if role exists
			if($isSelectedUserRoleExist) {
				$rolesModel->setUserRole($userId, $fieldData);
			}
		} else {
			$this->getModel('fields')->updateUserFieldData($userId, $fieldName, $fieldData);
		}

		return $this->response('ajax', array('success' => true));
	}

	public function updateAccountData(Rsc_Http_Parameters $parameters) {
		$currentUser = $this->getModule('users')->getCurrentUser();
		$formData = $parameters->get('formData');
		$userId = $parameters->get('userId');
		
		if ($currentUser['id'] !== $userId) {
			return $this->response('ajax', array(
				'success' => false,
				'status' => 405
			));
		}

		$userFields = $this->getModel('fields', 'users')->getFields( array('exclude_password' => true) );
		$userFieldsValidationRules = $this->getModel('fields', 'users')->getFieldsValidationRules( $userFields );
		
		$validation = $this->validate(
			$formData,
			$userFieldsValidationRules
			/*array(
				'email' => 'required',
				'first_name' => 'required',
				'last_name' => 'required',
			),
			array(
				'email' => array(
					'required' => 'E-mail is required'
				),
				'first_name' => array(
					'required' => 'First Name is required'
				),
				'last_name' => array(
					'required' => 'Last Name is required'
				)
			)*/
		);

		if ($validation->isFail()) {
			return $this->response('ajax', array(
				'success' => false, 
				'errors' => $validation->getErrorsList()
			));
		}

		$updateWpUserData = array('ID' => $userId);
		$updateForUser = array();

		foreach($userFields as $f) {
			if(isset($formData[ $f['name'] ]) && isset($f['sys']) && $f['sys']) {
				$updateWpUserData[ $f['name'] ] = $formData[ $f['name'] ];
			}
			$updateForUser[ $f['name'] ] = $formData[ $f['name'] ];
		}

		// Update WP user data - it's required to correct display in native WP profile
		wp_update_user( $updateWpUserData );
		// Update our user fields data - it will required for our plugin: we will take all info from here
		$this->getModel('fields', 'users')->updateForUser( $userId, $updateForUser );

		return $this->response('ajax', array(
			'success' => true
		));
	}

	public function changeEmail(Rsc_Http_Parameters $parameters) {

		$currentPassword = $parameters->get('password');
		$newEmail = $parameters->get('email');
		$currentUser = get_user_by('id', get_current_user_id());
		
		if (wp_check_password($currentPassword, $currentUser->user_pass, $currentUser->ID)) {
			if ($newEmail !== $currentUser->user_email) {
				$update = wp_update_user(
					array(
						'ID' => $currentUser->ID,
						'user_email' => $newEmail
					)
				);

				if (is_wp_error($update)) {
					return $this->response('ajax', array(
						'success' => false,
						'message' => $update->get_error_message(),
					));
				}
			}

			return $this->response('ajax', array(
				'success' => true,
				'message' => $this->translate('Email is updated successfully'),
			));
		} else {

			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('Current password was incorrect')
			));
		}
	}

	public function changePassword(Rsc_Http_Parameters $parameters) {
		$currentPassword = $parameters->get('password');
		$newPassword = $parameters->get('newPassword');
		$newPasswordConfirmation = $parameters->get('newPasswordConfirmation');

		$validation = $this->validate(
			array(
				'current_password' => $currentPassword,
				'new_password' => $newPassword,
				'new_password_confirmation' => $newPasswordConfirmation,
			),
			array(
				'current_password' => array(
					'presence' => array(
						'message' => $this->translate('Current password is required')
					)
				),
				'new_password' => array(
					'presence' => array(
						'message' => $this->translate('New password is required'),

					)
				),
				'new_password_confirmation'=> array(
					'presence' => array(
						'message' => $this->translate('Password confirmation is required')
					),
					'equality' => array(
						'attribute' => 'new_password',
						'message' => $this->translate('New Password and New Password Confirmation fields is not match.')
					)
				),
			)
		);

		if ($validation->isFail()) {
			return $this->response('ajax', array(
				'success' => false, 
				'message' => implode(', ', $validation->getErrorsList())
			));
		}

		$currentUser = get_user_by('id', get_current_user_id());

        $settings = $this->getModule()->getSettings();

		if ($currentUser && wp_check_password($currentPassword, $currentUser->user_pass, $currentUser->ID)) {

			$message = $this->translate('Password is updated successfully');

			$user = $this->getModel('Profile', 'Users')->getUserById($currentUser->ID);
			$config = $this->getConfig();

            if ('true' === $settings['mail']['emails']['password-changed-email'] && $user) {

                $hash = wp_hash_password($newPassword);
	            update_user_meta($user['id'], $config->get('db_prefix') . 'password_change_hash', $hash);
	            update_user_meta($user['id'], $config->get('db_prefix') . 'password_change_code', wp_generate_password(16, false));

                $mailModule = $this->getModule('Mail');
	            $mailModule->sendPasswordChangedEmail($user);

	            $message = $this->translate('Confirmation link for password change is sent to your email.');
            } else {
                wp_set_password($newPassword, $currentUser->ID);

                wp_signon(array(
                    'user_login' => $currentUser->user_login,
                    'user_password' => $newPassword
                ));
            }

			return $this->response('ajax', array(
				'success' => true,
				'message' => $message,
			));

		} else {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('Current password was incorrect')
			));
		}
	}

	public function adminProfileFieldsUpdate($userId) {
		$membershipFields = $this->getRequest()->post->get('membership');
		$fieldsModel = $this->getModel('Fields');
		$profileModel = $this->getModel('Profile');

		if ($membershipFields) {
		    if (isset($membershipFields['user_status'])) {
				if (current_user_can('edit_users')) {
					$user = $profileModel->getUserById(intval($userId));
					$userStatus = is_null($user['user_status']) ? Membership_Users_Model_Fields::STATUS_PENDING_REVIEW : intval($user['user_status']);
					$mailModule = $this->getModule('Mail');

					if (Membership_Users_Model_Fields::STATUS_PENDING_REVIEW === $userStatus) {
						switch ((int) $membershipFields['user_status']) {
							case Membership_Users_Model_Fields::STATUS_ACTIVE:
								$mailModule->sendAccountApprovedEmail($user);
								break;
							case Membership_Users_Model_Fields::STATUS_REJECTED:
								$mailModule->sendAccountRejectedEmail($user);
								break;
						}
					}

					if (Membership_Users_Model_Fields::STATUS_DELETED === (int)$membershipFields['user_status']) {
						$this->setAccountDeleted($userId);
					}

					if (Membership_Users_Model_Fields::STATUS_DISABLED === (int)$membershipFields['user_status']) {
						$mailModule->sendAccountDisabledEmail($user);
					}

					$profileModel->setUserStatus($userId, $membershipFields['user_status']);
				}

                unset($membershipFields['user_status']);
            }


            if (isset($membershipFields['user_role'])) {
	            if (current_user_can('edit_users')) {
		            $this->getModel('Roles', 'Roles')->setUserRole($userId, $membershipFields['user_role']);
	            }
	            unset($membershipFields['user_role']);
            }

			foreach ($membershipFields as $fieldName => $fieldData) {
				$fieldsModel->updateUserFieldData($userId, $fieldName, $fieldData);
			}
		}
	}

	public function deleteAccount(Rsc_Http_Parameters $parameters) {
		$userId = get_current_user_id();
		$password = $parameters->get('password');
		$currentUser = wp_get_current_user();

		$usersModule = $this->getModule('users');
		$currUserInfo = $usersModule->getCurrentUser();
		$isUserCanRemoveHisAcc = $usersModule->userCan($currUserInfo, 'can-delete-their-account');
		if(!$isUserCanRemoveHisAcc) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('Access denied'),
			));
		}

		if (wp_check_password($password, $currentUser->user_pass, $currentUser->ID)) {

			$settings = $this->getModule()->getSettings();
			$afterDeleteAccountAction = $settings['base']['main']['after-delete-account-action'];

			$redirectTo = home_url();

			if ($afterDeleteAccountAction === 'redirect-to-url') {
				$redirectTo = $settings['base']['main']['after-delete-account-action-redirect-url'];
			}

			$this->setAccountDeleted($userId);

			return $this->response('ajax', array(
				'success' => true,
				'redirect' => $redirectTo
			));
		}

		return $this->response('ajax', array(
			'success' => false,
			'message' => $this->translate('Current password was incorrect')
		));
	}

	public function wpLogout() {
		wp_logout();
		return $this->response('ajax', array(
			'success' => true,
		));
	}

	public function setAccountDeleted($userId) {

		$profileModel = $this->getModel('profile');
		$user = $profileModel->getUserById(intval($userId));
		$mailModule = $this->getModule('mail');

		$mailModule->sendAccountDeletedEmail($user);
		$mailModule->sendAccountDeletedNotificationEmail($user);

		$profileModel->updateUserStatus($userId, Membership_Users_Model_Fields::STATUS_DELETED);
	}

    public function setStatus(Rsc_Http_Parameters $parameters) {

        $userId = $parameters->get('userId');
        $status = $parameters->get('status');
	    $user = $this->getModel('profile')->getUserById(intval($userId));

        if ($user) {
            $message = '';
            $result = false;

            if (in_array($status, array('disabled', 'active'))) {

                $settings = $this->getModule()->getSettings();

                switch ($status) {
                    case 'disabled':
                        if (false !== $result = $this->getModel('profile')->updateUserStatus(
                                $userId,
                                Membership_Users_Model_Fields::STATUS_DISABLED
                            )) {
                            $message = $this->translate('User blocked');
                            $this->getDispatcher()->dispatch('sendEmail', array(
                                'to' => $user['user_email'],
                                'subject' => $settings['mail']['emails']['account-deactivation-email-subject'],
                                'message' => $settings['mail']['emails']['account-deactivation-email-body'],
                                'options' => array(
                                    'variables' => array(
                                        'site_name' => get_bloginfo('sitename'),
                                        'display_name' => $user['display_name'],
                                        'admin_email' => get_bloginfo('admin_email'),
                                    )
                                )
                            ));
                        }

                        break;
                    case 'active':
                        if (false !== $result = $this->getModel('profile')->updateUserStatus(
                                $userId,
                                Membership_Users_Model_Fields::STATUS_ACTIVE
                            )) {
                            $message = $this->translate('User activated');
                        }

                        break;
                }
            } else {
                $message = $this->translate('User update error');
            }
        } else {
            $message = $this->translate('There is no user with provided id');
            $result = false;
        }

        return $this->response('ajax', array(
            'success' => $result,
            'message' => $message
        ));
    }

	public function updatePrivacy(Rsc_Http_Parameters $parameters) {

		$userId = get_current_user_id();
		$privacies = $parameters->get('privacies');
		$update = update_user_meta($userId, 'membership_privacy', $privacies);

		if ($update === false) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('Your changes could not be saved')
			));
		}

		return $this->response('ajax', array(
			'success' => true,
			'message' => $this->translate('Your changes has been saved.')
		));
	}

	public function saveUserNotificationsSettings(Rsc_Http_Parameters $parameters) {
		$settings = $parameters->get('settings');
		$userId = get_current_user_id();
		$settingsMetaName = 'membership_notifications';

		$newSettings = array(
			'messages' => $settings['messages'],
			'friend-requests' => $settings['friend-requests'],
			'follows' => $settings['follows'],
		);

		update_user_meta($userId, $settingsMetaName, $newSettings);

		if ($newSettings !== get_user_meta($userId, $settingsMetaName, true)) {
			return $this->response('ajax', array(
				'success' => false,
				'message' => $this->translate('Notifications settings changes could not be saved.')
			));
		}

		return $this->response('ajax', array(
			'success' => true,
			'message' => $this->translate('Notifications settings changes has been saved.')
		));
	}

	public function getActivity(Rsc_Http_Parameters $parameters) {
		$userId = $parameters->get('userId');
		$currentUserId = get_current_user_id();
		$limit = min(max($parameters->get('limit', 0), 1), 20);
		$offsetId = $parameters->get('offsetId', null);
		$activityModel = $this->getModel('activity', 'activity');
		$contextParam = $parameters->get('contextParam', null);

		if($contextParam) {
			// for 'profile-favorite'
			$activities = $activityModel->getActivity(array(
				'userId' => $userId,
				'limit' => $limit,
				'status' => 'active',
				'activityTypes' => array(
					'favorite',
				),
				'offsetId' => $offsetId,
			));
		} else {
			$activities = $activityModel->getUserProfileActivity($userId, $currentUserId,  $limit, $offsetId);
		}

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render(
					'@activity/partials/activities.twig',
					array(
						'activities' => $activities,
					)
				),
			)
		);
	}

	public function addFriend(Rsc_Http_Parameters $parameters) {
		$friendsModel = $this->getModel('friends');
		$profileModel = $this->getModel('profile');
		 $followersModel = $this->getModel('followers');
		$friendId = $parameters->get('userId');
		$currentUserId = get_current_user_id();

		$requestedUser = $profileModel->getUserById($friendId);
        $currentUser = $profileModel->getUserById(intval($currentUserId));

		if ($requestedUser['currentUserFriend']) {
			return $this->response(
				'ajax',
				array(
					'success' => true,
					'status' => 503,
					'message' => $this->translate('User already in friends')
				)
			);
		}

		if (!$requestedUser) {
			return $this->response(
				'ajax',
				array(
					'success' => true,
					'status' => 503,
					'message' => $this->translate('User not found')
				)
			);
		}


		$friendsModel->addToFriends($currentUserId, $friendId);

		if (!(bool) $requestedUser['isFollowing']) {
			$followersModel->addToFollowers($currentUserId, $friendId);
		}

		$requestedUser = $profileModel->getUserById($friendId);
		$mailModule = $this->getModule('Mail');
		$mailRes = $mailModule->sendNewFriendFollowerNotification(array(
			'notification-type' => 'friend',
			'user-from' => $currentUserId,
			'user-to' => $friendId,
		));

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render('@users/partials/users-list.twig', array('users' => array($requestedUser)))
			)
		);
	}

	public function removeFriend(Rsc_Http_Parameters $parameters) {
		$friendsModel = $this->getModel('friends');
		$friendId = $parameters->get('userId');
		$currentUserId = get_current_user_id();
		$friendsModel->removeFromFriends($currentUserId, $friendId);

		if ($error = $friendsModel->getError()) {
			return $this->response(
				'ajax',
				array(
					'success' => false,
					'message' => $error
				)
			);
		}

		$profileModel = $this->getModel('profile');
		$requestedUser = $profileModel->getUserById($friendId);

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render('@users/partials/users-list.twig', array('users' => array($requestedUser)))
			)
		);
	}

	public function getFriends(Rsc_Http_Parameters $parameters) {

		$usersModule = $this->getModule('users');
		$usersModel = $this->getModel('profile');
		$friendsModel = $this->getModel('friends');
		
		$userId = $parameters->get('userId');
		$limit = min(max($parameters->get('limit', 1), 1), 20);
		$offsetId = $parameters->get('offsetId', null);
		$search = $parameters->get('search', null);
		
		$requestedUser = $usersModel->getUserById(intval($userId));

		if ($usersModule->currentUserHasPermission('view-friends', $requestedUser)) {

			$users = $friendsModel->getUserFriends($requestedUser['id'], $limit, $offsetId, $search);

			return $this->response(
				'ajax',
				array(
					'success' => true,
					'html' => $this->render('@users/partials/users-list.twig', array('users' => $users))
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

	public function getFriendshipRequests(Rsc_Http_Parameters $parameters) {


		$friendsModel = $this->getModel('friends');

		$limit = min(max($parameters->get('limit', 1), 1), 20);
		$offsetId = $parameters->get('offsetId', null);
		$search = $parameters->get('search', null);

		$users = $friendsModel->getUserFriendRequests($limit, $offsetId, $search);

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render('@users/partials/users-list-friend-requests.twig', array('users' => $users))
			)
		);
	}

    public function follow(Rsc_Http_Parameters $parameters) {
        $followersModel = $this->getModel('followers');
        $profileModel = $this->getModel('profile');
        $followingId = $parameters->get('userId');
        $currentUserId = get_current_user_id();

        $requestedUser = $profileModel->getUserById($followingId);

        if ($requestedUser['isFollowing']) {
            return $this->response(
                'ajax',
                array(
                    'success' => false,
                    'status' => 503,
                    'message' => $this->translate('User already followed')
                )
            );
        }

        if (!$requestedUser) {
            return $this->response(
                'ajax',
                array(
                    'success' => false,
                    'status' => 503,
                    'message' => $this->translate('User not found')
                )
            );
        }

        $followersModel->addToFollowers($currentUserId, $followingId);

	    $requestedUser = $profileModel->getUserById($followingId);
		$mailModule = $this->getModule('Mail');
		$mailRes = $mailModule->sendNewFriendFollowerNotification(array(
			'notification-type' => 'follower',
			'user-from' => $currentUserId,
			'user-to' => $followingId,
		));

        return $this->response(
            'ajax',
            array(
                'success' => true,
                'html' => $this->render('@users/partials/users-list.twig', array('users' => array($requestedUser)))
            )
        );
    }

    public function unfollow(Rsc_Http_Parameters $parameters) {
        $followersModel = $this->getModel('followers');
        $followingId = $parameters->get('userId');
        $currentUserId = get_current_user_id();
        $followersModel->removeFromFollowers($currentUserId, $followingId);
	    $profileModel = $this->getModel('profile');
	    $requestedUser = $profileModel->getUserById($followingId);

	    return $this->response(
		    'ajax',
		    array(
			    'success' => true,
			    'html' => $this->render('@users/partials/users-list.twig', array('users' => array($requestedUser)))
		    )
	    );
    }

    public function getFollows(Rsc_Http_Parameters $parameters) {
        $usersModule = $this->getModule('users');
        $usersModel = $this->getModel('profile');

        $userId = $parameters->get('userId');
        $limit = min(max($parameters->get('limit', 1), 1), 50);
        $offsetId = $parameters->get('offsetId', null);
        $search = $parameters->get('search', null);
        $requestedUser = $usersModel->getUserById(intval($userId));

        if ($usersModule->currentUserHasPermission('view-follows', $requestedUser)) {

            $users = $this->getModel('followers')->getUserFollows($requestedUser['id'], $limit, $offsetId, $search);

            return $this->response(
                'ajax',
                array(
                    'success' => true,
                    'html' => $this->render('@users/partials/users-list.twig', array('users' => $users))
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

    public function getFollowers(Rsc_Http_Parameters $parameters) {
        $usersModule = $this->getModule('users');
        $usersModel = $this->getModel('profile');

        $userId = $parameters->get('userId');
        $limit = min(max($parameters->get('limit', 0), 1), 50);
        $offsetId = $parameters->get('offsetId', null);
	    $search = $parameters->get('search', null);

        $requestedUser = $usersModel->getUserById(intval($userId));

        if ($usersModule->currentUserHasPermission('view-followers', $requestedUser)) {

            $users = $this->getModel('followers')->getUserFollowers($requestedUser['id'], $limit, $offsetId, $search);

            return $this->response(
                'ajax',
                array(
                    'success' => true,
                    'html' => $this->render('@users/partials/users-list.twig', array('users' => $users))
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

	public function search(Rsc_Http_Parameters $parameters) {

		$query = $parameters->get('query', null);
		$limit = min(max($parameters->get('limit', 0), 1), 20);
		$offset = $parameters->get('offset', null);
		$offsetId = $parameters->get('offsetId', null);
		$userRoleId = (int) $parameters->get('userRoleId', null);
        $usersModel = $this->getModel('profile', 'users');
        $template = $parameters->get('template', 'users-list');

		if($userRoleId == 0 && (is_null($query) || $query == '')) {
			return $this->response('ajax', array('success' => false));
		}

		$params = array(
			'search' => $query,
            'limit' => $limit,
            'offset' => $offset,
			'offsetId' =>$offsetId,
			'userRoleId' => $userRoleId,
			'searchBy' => array('username' => 1, 'lastname' => 1, 'firstname' => 1),
		);

		$users = $usersModel->getUsersIdsByParams($params);
		if ($users) {
			$_users = implode(', ', $users);
			$orderBy = " ORDER BY FIELD (u.ID, $_users)";
			$users = $usersModel->getUsersByIds(array('users' => $users, 'orderBy' => $orderBy));
		}

		if ($template == 'users-list') {
			$template = '@users/partials/users-list.twig';
		} elseif ($template == 'search-dropdown') {
			$template = '@base/partials/search-dropdown-user.twig';
		} else {
			return $this->response(
				'ajax',
				array(
					'success' => false,
					'message' => $this->translate('Unsupported template.')
				)
			);
		}

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render($template, array('users' => $users))
			)
		);
	}

	public function getUsers(Rsc_Http_Parameters $parameters) {
		$limit = min(max($parameters->get('limit', 0), 1), 20);
		$offset = $parameters->get('offset', 0);
		$usersModel = $this->getModel('profile', 'users');

//		/**
//		 * Check if user privacy rule (show in members directory) set to yes
//		 * (or privacy is not set then it means yes by default) otherwise exclude from result
//		 */
//		$extraQuery = "LEFT JOIN {wp_base_prefix}usermeta AS um ON (um.user_id = u.ID and meta_key = 'membership_privacy')";
//		$extraWhere = "AND (um.meta_value REGEXP '.*\"show-in-members-directory\";s:[0-9]+:\"yes\".*' OR um.meta_value IS NULL)";

		$users = $usersModel->getUsers(array(
			'limit' => $limit,
			'offset' => $offset,
		));

		return $this->response(
			'ajax',
			array(
				'success' => true,
				'html' => $this->render('@users/partials/users-list.twig', array('users' => $users))
			)
		);
	}

    public function getPosts(Rsc_Http_Parameters $parameters) {

        $usersModule = $this->getModule('users');
        $usersModel = $this->getModel('profile');
        $postsModel = $this->getModel('posts');
        $userId = $parameters->get('userId');

        $requestedUser = $usersModel->getUserById(intval($userId));
        $limit = min(max($parameters->get('limit', 1), 1), 50);
        $offsetId = $parameters->get('offsetId', null);
        if ($usersModule->currentUserHasPermission('view-posts', $requestedUser)) {
            $posts = $postsModel->getPosts($requestedUser['id'], $limit, $offsetId);

            return $this->response(
                'ajax',
                array(
                    'success' => true,
	                'html' => $this->render('@users/partials/posts.twig', array('posts' => $posts))
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

    public function getComments(Rsc_Http_Parameters $parameters) {
        $usersModule = $this->getModule('users');
        $usersModel = $this->getModel('profile');
        $commentsModel = $this->getModel('comments');

        $userId = $parameters->get('userId');
        $requestedUser = $usersModel->getUserById(intval($userId));
        $limit = min(max($parameters->get('limit', 0), 10), 100);
        $offsetId = $parameters->get('offsetId', null);

        if ($usersModule->currentUserHasPermission('view-comments', $requestedUser)) {
            $comments = $commentsModel->getComments($requestedUser['id'], $limit, $offsetId);

            return $this->response(
                'ajax',
                array(
                    'success' => true,
                    'html' => $this->render('@users/partials/comments.twig', array('comments' => $comments))
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

    public function bulkUpdate(Rsc_Http_Parameters $parameters) {
	    $profileModel = $this->getModel('Profile', 'Users');
		$users = $parameters->get('users');
		$action = $parameters->get('bulkAction');
		$value = $parameters->get('bulkValue');

		switch ($action) {
			case 'change-status':
				$statuses = $profileModel->userStatusesList();

				if (in_array($value, array_keys($statuses))) {
					foreach ($users as $userId) {
						$profileModel->setUserStatus($userId, $value);
					}
				}

				break;

			case 'change-role':

				$rolesModel = $this->getModel('Roles', 'Roles');
				$roles = $rolesModel->getRolesList();

				if (in_array($value, array_keys($roles))) {
					foreach ($users as $userId) {
						$rolesModel->setUserRole($userId, $value);
					}
				}
				break;
		}

	    return $this->response(
		    'ajax',
		    array(
			    'success' => true
		    )
	    );
    }
}