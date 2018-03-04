(function($, Membership){

	var cropper = {
		settings: {
			dragMode: 'move',
			viewMode: 3,
			autoCropArea: 1,
			guides: false,
			center: true,
			minCropBoxWidth: 100,
			minCropBoxHeight: 100,
			toggleDragModeOnDblclick: false,
			cropBoxResizable: false,
			cropBoxMovable: false,
			scalable: false,
			highlight: false,
			minContainerWidth: 100,
			minContainerHeight: 100,
			background: false,
		},
		prepareCoverContainerSize: function ($imageContainer, imageWidth, imageHeight, imageAspectRatio) {
			var width = $imageContainer.parent().width(),
				height = width / imageAspectRatio,
				scaleRatio = Math.max(
					100 / imageWidth,
					100 / imageHeight
				);

			if (width < 100 || height < 100) {
				width = scaleRatio * imageWidth;
				height = scaleRatio * imageHeight;
			}

			$imageContainer.css({
				'width': width,
				'height': height,
				'max-height': 'none',
			});
		}
	};

	// User action buttons
	var $actionMenu = $('.mp-user-action-menu'),
		$actionMenuItems = $actionMenu.find('.menu > .fitted.item').slice(2),
		mbsAmb2 = null,
		$dropDownMenu = $actionMenu.find('.menu > .dropdown.item .menu');

	$dropDownMenu.append($actionMenuItems);
	$dropDownMenu.find('.item').each(function() {
		var $menuItem = $(this),
			$button = $menuItem.find('button');
		$menuItem.replaceWith('<div class="item" data-action="' + $button.attr('data-action') + '">' + $button.text() + '</div>');
	});


	// Send message modal
	var $sendMessageToUserModal = $('#send-message-modal'),
		$sendMessageToUserModalButtons = $sendMessageToUserModal.find('.actions button');

	$sendMessageToUserModal.mpModal({
		onApprove: function($button) {
			var $textarea = $sendMessageToUserModal.find('textarea'),
				message = $.trim($textarea.val()),
				attachmentArr = [],
				userId = Membership.requestedUser.id;
			if(mbsAmb2) {
				attachmentArr = mbsAmb2.getAttachedIds()
			}
			if (!message.length && !attachmentArr.length) {
				return false;
			}

			$button.addClass('loading');
			$sendMessageToUserModalButtons.attr('disabled', true);

			Membership.api.messages.sendMessageToUser({
				userId: userId,
				message: message,
				'attachments': attachmentArr,
			}).then(function(response) {
				if (response.success) {
					Snackbar.show({text: 'Message was sent.'});
				} else {
					Snackbar.show({text: response.message});
				}

				$sendMessageToUserModal.mpModal('hide');

			});

			return false;
		},
		'onShow': function() {
			if(mbsAmb2) {
				$('.mbsAttMessSendBtn').prop('disabled', false);
				mbsAmb2.clearAttachmentWrapper();
			}
		},
		onHidden: function() {
			$sendMessageToUserModal.find('textarea').val('');
			$sendMessageToUserModalButtons.removeClass('loading');
			$sendMessageToUserModalButtons.removeAttr('disabled');
		}
	});

    // Login modal
    var $loginModal = $('#membership-login-modal');

    $loginModal.mpModal();

	// Report user modal
	var $reportUserModal = $('#report-user-modal'),
		$reportUserModalButtons = $reportUserModal.find('.actions button');

		$reportUserModal.mpModal({
			onApprove: function($button) {
				var $textarea = $reportUserModal.find('textarea'),
					message = $.trim($textarea.val()),
					userId = Membership.requestedUser.id;

				if (!message.length) {
					return false;
				}

				$button.addClass('loading');
				$reportUserModalButtons.attr('disabled', true);

				Membership.api.base.sendReport({
					message: message,
					objectId: userId,
					type: 'user'
				}).then(function(response) {
						if (response.success) {
							$reportUserModal.mpModal('hide');
							Snackbar.show({text: 'User was reported.'});
						}
					});

				return false;
			},
			onHidden: function() {
				$reportUserModal.find('textarea').val('');
				$reportUserModalButtons.removeClass('loading');
				$reportUserModalButtons.removeAttr('disabled');
			}
		});

	$('.mp-user-action-menu .dropdown').mpDropdown({action:'nothing'});

	$(document).on('click', '.mp-user-action-menu [data-action]', function() {
		var $actionMenuItem = $(this),
			action = $actionMenuItem.attr('data-action'),
			userId = Membership.requestedUser.id,
			request = $.Deferred().resolve();

		if (action !== 'message' && action !== 'report' && action !== 'login') {
			$actionMenuItem.attr('disabled', true);
			$actionMenuItem.addClass('loading disabled');

			if ($actionMenuItem.is('div')) {
				$actionMenuItem.prepend($('<i class="notched circle loading icon"></i>'));
			}
		}

		switch (action) {
			case 'invite-friends':

				return;
			case 'add-friend':
				request = Membership.api.users.addFriend({userId: userId});
				break;
			case 'remove-friend':
				request = Membership.api.users.removeFriend({userId: userId});
				break;
			case 'cancel-friend-request':
				request = Membership.api.users.removeFriend({userId: userId});
				break;
			case 'follow':
				request = Membership.api.users.follow({userId: userId});
				break;
			case 'unfollow':
				request = Membership.api.users.unfollow({userId: userId});
				break;
			case 'message':
				$sendMessageToUserModal.find('.recipient-name').text(Membership.requestedUser.displayName);
				$sendMessageToUserModal.mpModal('show');
				$sendMessageToUserModal.attr('data-user-id', userId);
				return;
			case 'report':
				$reportUserModal.find('.recipient-name').text(Membership.requestedUser.displayName);
				$reportUserModal.mpModal('show');
				$reportUserModal.attr('data-user-id', userId);
				return;
            case 'login':
                $loginModal.mpModal('show');
                return;
		}

		request.then(function() {
			window.location.reload(true);
		})
	});

	// Navigation menu
	var $navMenu = $('.profile-nav-menu'),
        navMenuBreaks = [];

	$actionMenu.find('> .menu').show();
	$navMenu.show();
    Membership.helpers.fitActionMenuToScreen($navMenu, navMenuBreaks);

    function fitMenu() {
        Membership.helpers.fitActionMenuToScreen($navMenu, navMenuBreaks);
    }

	$(window).on('resize', Membership.helpers.debounce(fitMenu, 100));

	// Cover upload
	var $coverContainer = $('.mp-cover-container'),
		$coverImage = $('.cover-image'),
		$coverLoader = $('.cover-loader'),
		$coverLoader = $.merge($coverLoader, $coverLoader.children()),
		coverWidth = Membership.get('settings.profile.cover-size.width'),
		coverHeight = Membership.get('settings.profile.cover-size.height'),
		coverAspectRatio =  coverWidth / coverHeight,
		$updateCoverMenu = $('.mp-update-cover');

	$updateCoverMenu.find('[data-action="upload-photo"]').on('click', function() {
		$('<input type="file" name="image" accept=".jpg,.jpeg,.png">').on('change', function(event) {
			event.preventDefault();
			var files = event.target.files || event.dataTransfer.files,
				oldImageSrc = $coverImage.attr('src');

			$coverLoader.addClass('active');

			Membership.api.base.uploadImage({
				image: files[0]
			}).then(function(response) {

				$coverLoader.removeClass('active');
				$coverImage.attr('src', response.attachment.src);
				$coverContainer.addClass('crop-action');

				var attachmentId = response.attachment.id;

				$('.mp-crop-cover-action').one('click', 'button', function(event) {
					var $button = $(event.target),
						action = $button.attr('data-action');

					if (action == 'save-photo') {
						$coverLoader.addClass('active');
						Membership.api.users.changeCover({
							attachmentId: attachmentId,
							cropData: $coverImage.cropper('getData', true)
						}).then(function(response) {
							if (response.success) {
								$coverImage.attr('src', Membership.helpers.getUserCover(response.images));
								$coverImage.cropper('destroy').parent().removeAttr('style');
								$coverContainer.removeClass('crop-action');
								$updateCoverMenu.removeClass('default');
							}
							$coverLoader.removeClass('active');
						});
					} else {
						$coverImage.attr('src', oldImageSrc);
						$coverImage.cropper('destroy').parent().removeAttr('style');
						$coverContainer.removeClass('crop-action');
					}
				});

				cropper.prepareCoverContainerSize($coverImage.parent(), coverWidth, coverHeight, coverAspectRatio);

				$coverImage.cropper($.extend(cropper.settings, {
					aspectRatio: coverAspectRatio,
					viewMode: 3,
					built: function() {
						$coverImage.cropper('zoomTo', 1);
					}
				}));

			}, function(response) {
				$coverLoader.removeClass('active');
				Snackbar.show({text: response.message});
				return $.Deferred().resolve();
			});
		}).trigger('click');
	});

	$updateCoverMenu.find('[data-action="remove-photo"]').on('click', function() {
		$coverLoader.addClass('active');
		Membership.api.users.removeCover().then(function(response) {
			if (response.success) {
				$coverImage.attr('src', Membership.get('settings.profile.default-cover'));
				$updateCoverMenu.addClass('default');
			}
			$coverLoader.removeClass('active');
		});

	});

	// Avatar upload
	var $avatarImage = $('.avatar-image'),
		$avatarModal = $('#avatar-modal'),
		$avatarModalImage = $('.avatar-modal-image'),
		$avatarModalImageContainer = $('.avatar-image-container'),
		$avatarModalActions = $avatarModal.find('.actions'),
		$avatarModalLoader = $avatarModalImageContainer.find('.dimmer, .loader'),
		$avatarLoader = $('.avatar-loader'),
		$avatarLoader = $.merge($avatarLoader, $avatarLoader.children()),
		avatarWidth = Membership.get('settings.profile.avatar-size.width'),
		avatarHeight = Membership.get('settings.profile.avatar-size.height'),
		avatarAspectRatio =  avatarWidth / avatarHeight,
		$updateAvatarMenu = $('.update-avatar-menu');

	$updateAvatarMenu.find('[data-action="upload-photo"]').on('click', function() {

		$('<input type="file" name="image" accept=".jpg,.jpeg,.png">').on('change', function(event) {
			event.preventDefault();
			var files = event.target.files || event.dataTransfer.files,
				oldImageSrc = $avatarImage.attr('src');

			$avatarModalImage.attr('src', oldImageSrc);
			$avatarModalLoader.addClass('active');
			$avatarModal.mpModal('show');


			Membership.api.base.uploadImage({
				image: files[0]
			}).then(function(response) {
				$avatarModalLoader.removeClass('active');
				$avatarModalImage.attr('src', response.attachment.src);

				var attachmentId = response.attachment.id;

				$avatarModalActions.one('click', 'button', function(event) {
					var $button = $(event.target),
						$buttons = $avatarModalActions.find('button'),
						action = $button.attr('data-action');

					if (action == 'save-photo') {
						$buttons.attr('disabled', true);
						$button.addClass('loading');
						$avatarModalLoader.addClass('active');

						Membership.api.users.changeAvatar({
							attachmentId: attachmentId,
							cropData: $avatarModalImage.cropper('getData', true)
						}).then(function(response) {
							if (response.success) {
								$avatarImage.attr('src', Membership.helpers.getUserAvatar(response.images));
								$avatarModalImage.cropper('destroy').parent().removeAttr('style');
								$updateAvatarMenu.removeClass('default');
							}
							$avatarModalLoader.removeClass('active');
							$buttons.attr('disabled', false);
							$button.removeClass('loading');
							$avatarModal.mpModal('hide');
						});
					} else {
						$avatarModalImage.attr('src', oldImageSrc);
						$avatarModalImage.cropper('destroy').parent().removeAttr('style');
						$avatarModal.mpModal('hide');
					}
				});

				$avatarModalImage.cropper($.extend(cropper.settings, {
					aspectRatio: avatarAspectRatio,
					viewMode: 1,
					built: function() {
						$avatarModalImage.cropper('zoomTo', 1);
					}
				}));

			}, function(response) {
				$avatarModal.removeData();
				$avatarModal.mpModal('hide');
				Snackbar.show({text: response.message});
				return $.Deferred().resolve();
			});
		}).trigger('click');
	});

	$updateAvatarMenu.find('[data-action="remove-photo"]').on('click', function() {
		$avatarLoader.addClass('active');
		Membership.api.users.removeAvatar().then(function(response) {
			if (response.success) {
				$avatarImage.attr('src', Membership.get('settings.profile.default-avatar'));
				$updateAvatarMenu.addClass('default');
			}
			$avatarLoader.removeClass('active');
		});

	});

	// Dropdowns init
	$('.mp-profile-nav-menu, .mp-update-cover, .mp-avatar').find('.dropdown').mpDropdown({
		action: 'hide'
	});

	$(document).ready(function() {
		if(window.mbsAttachmentMessageBehavior && $sendMessageToUserModal.length) {
			mbsAmb2 = new window.mbsAttachmentMessageBehavior();
			mbsAmb2.init($sendMessageToUserModal);
		}
	});

}(jQuery, Membership));