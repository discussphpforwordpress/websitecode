(function($, Membership) {

	$('.settings-tabs .item').mpTab();
    // Navigation menu
    var $settingsMenu = $('.settings-nav-menu'),
        navMenuBreaks = [];

    $settingsMenu.find('.dropdown').mpDropdown();

	$(document).ready(function() {
		$settingsMenu.find('.dropdown a').on('click', function() {
			$settingsMenu.children('a').removeClass('active');
			$(this).addClass('active');
		});
	});

    $settingsMenu.show();
    Membership.helpers.fitActionMenuToScreen($settingsMenu, navMenuBreaks);

    function fitMenu() {
        Membership.helpers.fitActionMenuToScreen($settingsMenu, navMenuBreaks);
    }

    $(window).on('resize', Membership.helpers.debounce(fitMenu, 100));

	var $confirmPasswordModalTemplate = $('.mp-confirm-password.modal');

	function onApproveConfirmPasswordModal($approveButton) {

		var $modal = $(this),
			$form = $modal.find('.form'),
			$modalActionButtons = $modal.find('.actions button'),
			type = $modal.attr('data-type'),
			password = $modal.find('input[type="password"]').val(),
			$request = $.Deferred().reject();

		$modalActionButtons.attr('disabled', true);
		$approveButton.addClass('loading');
		$form.removeClass('error');

		switch (type) {
			case 'email-change':

				var newEmail = $('.account-settings input[name="email"]').val();

				$request = Membership.api.users.changeEmail({
					password: password,
					email: newEmail
				});

				break;

			case 'password-change':

				var $passwordInput = $('.account-settings input[name="password"]'),
					$passwordConfirmationInput = $('.account-settings input[name="password-confirmation"]');

				$request = Membership.api.users.changePassword({
					password: password,
					newPassword: $passwordInput.val(),
					newPasswordConfirmation: $passwordConfirmationInput.val(),
				});

				$request.then(function(response) {
					if (response.success) {
						$passwordInput.val('');
						$passwordConfirmationInput.val('');
					}

					return response;
				});

				break;

			case 'delete-account':

				$request = Membership.api.users.deleteAccount({password:password})
					.then(function(response) {
						if (response.success) {
							var redirectUrl = response.redirect;
							Membership.api.users.wpLogout().then(function(response) {
								if(redirectUrl) {
									window.location = redirectUrl;
								}
							});
						}
						return response;
					}, function(response) {
						Snackbar.show({text: 'Access denied!'});
						$approveButton.removeClass('loading');
						$modalActionButtons.attr('disabled', false);
					});

				break;
		}

		$request.then(function(response) {

			$modalActionButtons.removeClass('loading').removeAttr('disabled');

			if (response.success) {
				if(response.message) {
					Snackbar.show({text: response.message});
				}
				$modal.mpModal('hide');
			} else {
				$form.addClass('error');
				$form.find('.message.error').text(response.message);
			}

		});

		return false;
	}

	function onHiddenConfirmPasswordModal() {
		var $modal = $(this);
		$modal.find('input[type="password"]').val('');
		$modal.find('.form').removeClass('error');
	}

	var $changeEmailModal = $confirmPasswordModalTemplate.clone().attr('data-type', 'email-change').mpModal({
		onApprove: onApproveConfirmPasswordModal,
		onHidden: onHiddenConfirmPasswordModal
	});

	$('.change-email').on('click', function() {
		$changeEmailModal.mpModal('show');
	});

	var $changePasswordModal = $confirmPasswordModalTemplate.clone().attr('data-type', 'password-change').mpModal({
		onApprove: onApproveConfirmPasswordModal,
		onHidden: onHiddenConfirmPasswordModal
	});


	$('.change-password').on('click', function() {
		$changePasswordModal.mpModal('show');
	});

	var $confirmDeletionCheckbox = $('.confirm-deletion'),
		$confirmDeletionButton = $('.confirm-deletion-button');

	$confirmDeletionCheckbox.on('change', function() {
		if ($confirmDeletionCheckbox.is(':checked')) {
			$confirmDeletionButton.show();
		} else {
			$confirmDeletionButton.hide();
		}
	});

	var $deleteAccountModal = $confirmPasswordModalTemplate.clone().attr('data-type', 'delete-account').mpModal({
		onApprove: onApproveConfirmPasswordModal,
		onHidden: onHiddenConfirmPasswordModal
	});

	$confirmDeletionButton.on('click', function() {
		$deleteAccountModal.mpModal('show', 'delete-account');
	});

	var $blockedUsers = $('.blocked-users .blocked-user');

	$blockedUsers.each(function() {
		var $user = $(this),
			$unblockButton = $user.find('button'),
			userId = $user.attr('data-id');

		$unblockButton.on('click', function () {
			$unblockButton.addClass('loading disabled');
			$unblockButton.attr('disabled', true);
			Membership.api.messages.unblockUser({userId: userId}).then(function (response) {
				if (response.success) {
					$user.fadeOut(function() {
						$user.remove();
					});

				} else {
					$unblockButton.removeClass('loading disabled');
					$unblockButton.removeAttr('disabled', true);
				}

				Snackbar.show({text: response.message});
			})
		})
	});

	$('#notifications-messages, #notifications-friend-requests, #notifications-follows')
		.on('change', Membership.helpers.debounce(updateNotificationsSettings, 500));

	function updateNotificationsSettings() {
		var settings = {
			messages: $('#notifications-messages').is(':checked') ? 'on' : 'off',
			'friend-requests': $('#notifications-friend-requests').is(':checked')  ? 'on' : 'off',
			follows: $('#notifications-follows').is(':checked')  ? 'on' : 'off'
		};

		Membership.api.users.saveUserNotificationsSettings({settings: settings}).then(function (response) {
			Snackbar.show({text: response.message});
		});
	}

	function mbsProfileSettings() {

	}

	mbsProfileSettings.prototype.init = (function() {
		this.initPrivacyTab();
	});

	mbsProfileSettings.prototype.initPrivacyTab = (function() {
		var $privacySettings = $('.privacy-settings')
		,	$hideFriendPostCheckbox = $('#mbsUserPrivacyHideFriendPost')
		;
		function savePrivacyTabValuesToDb() {
			var privacies = {};
			$privacySettings.find('select').each(function() {
				var $select = $(this);
				privacies[$select.attr('name')] = $select.val();
			});
			privacies['hideFriendPost'] = $hideFriendPostCheckbox.is(':checked') == 1 ? 1 : 0;
			return Membership.api.users.updatePrivacy({'privacies':privacies}).then(function(response) {
				Snackbar.show({text: response.message});
			});
		}

		$privacySettings.find('.dropdown').mpDropdown({
			onChange: savePrivacyTabValuesToDb,
		});

		$hideFriendPostCheckbox.on('change', savePrivacyTabValuesToDb);
	});

	var profileSettings = new mbsProfileSettings();
	profileSettings.init();
})(jQuery, Membership);