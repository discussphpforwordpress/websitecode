(function($, Membership){

	var groupId = Membership.requestedGroup.id,
		$actionMenu = $('.mp-group-action-menu'),
		$actionMenuItems = $actionMenu.find('.menu > .fitted.item'),
		$dropDownMenu = $actionMenu.find('.menu > .dropdown.item .menu'),
		$loginModal = $('#membership-login-modal');

	$loginModal.find('form').on('form.submit', function(event, request) {
		request.then(function(response) {
			if (response.success) {
				response.redirect = window.location;
			}
		});
	});

	if ($actionMenuItems.length < 3) {
		$dropDownMenu.closest('.item').hide();
	}

	$dropDownMenu.append($actionMenuItems.slice(2));

	$dropDownMenu.find('.item').each(function() {
		var $menuItem = $(this),
			$button = $menuItem.find('button'),
			$dropDownMenuItem = $('<div class="item"></div>');

		if ($button.length) {
			$.each($button.get(0).attributes, function(i, attr) {
				if (attr.name !== 'class') {
					$dropDownMenuItem.attr(attr.name, attr.value);
				}
			});

			$dropDownMenuItem.text($button.text());
		}

		$menuItem.replaceWith($dropDownMenuItem);
	});

	$actionMenu.find('> .menu').show();
	$actionMenu.find('.dropdown').mpDropdown({action:'nothing'});

	var InviteUsersModal = function($modal) {
		this.$list = $modal.find('.users-list');
		this.$users = this.$list.find('.mp-user-card');
		this.$loader = $modal.find('.list-loader');
		this.$input = $modal.find('.users-search-input input');
		this.offsetId = this.$users.last().attr('data-id');
		this.limit = 10;
		this.hasMoreUsers = this.$users.length >= this.limit;
		this.fetchRequest = false;
		this.search = '';
		this.$modal = $modal.mpModal();
	};

	InviteUsersModal.prototype.open = function () {
		var self = this;

		if (!this.init) {

			this.init = true;

			this.$modal.mpVisibility({
				once: false,
				continuous: true,
				offset: 400,
				throttle: 80,
				context: self.$modal.parent(),
				observeChanges: true,
				onUpdate: function(calculations) {
					var screenCalculations = self.$modal.mpVisibility('get screen calculations');
					if (screenCalculations.bottom > calculations.height) {
						if (self.hasMoreUsers && !self.fetchRequest) {
							self.fetchUsers();
						}
					}
				}
			});

			this.$input.on('keyup', Membership.helpers.debounce(function() {
				self.search = this.value;
				self.offsetId = null;
				self.hasMoreUsers = true;
				self.$list.empty();
				self.fetchUsers();
			}, 1000));
		}

		this.$modal.mpModal('show');
	};

	InviteUsersModal.prototype.fetchUsers = function () {
		var self = this;
		this.$loader.show();
		this.fetchRequest = true;
		return Membership.api.groups.getUsersToInvite({
			groupId: groupId,
			limit: this.limit,
			offsetId: this.offsetId,
			search: this.search,
			template: 'invite-modal'
		}).then(function(response) {
			if (response.success) {
				var $users = $(response.html).filter('.mp-user-card');
				self.$list.append($users);
				self.offsetId = $users.last().attr('data-id');
				self.hasMoreUsers = $users.length === self.limit;
			}

			self.$loader.hide();
			self.fetchRequest = false;
		});
	};

	$('#invite-users-modal, #invite-administrators-modal').on('click', '[data-action]', function() {
		var $button = $(this),
			action = $button.attr('data-action'),
			$user = $button.closest('.mp-user-card'),
			userId = $user.attr('data-id'),
			request = $.Deferred().resolve();

		$button.addClass('loading disabled');
		$button.attr('disabled', true);

		switch (action) {
			case 'invite-user':
				request = Membership.api.groups.invite({
					groupId: groupId,
					userId: userId,
					role: 'user'
				}).then(function(response) {
					if (response.success) {
						$user.addClass('invited');
					}
				});
				break;
			case 'invite-administrator':
				request = Membership.api.groups.invite({
					groupId: groupId,
					userId: userId,
					role: 'administrator'
				}).then(function(response) {
					if (response.success) {
						$user.addClass('invited');
					}
				});
				break;
			case 'cancel-invitation':
				request = Membership.api.groups.cancelInvite({
					groupId: groupId,
					userId: userId
				}).then(function(response) {
					if (response.success) {
						$user.removeClass('invited');
					}
				});
				break;
		}

		request.then(function() {
			$button.removeClass('loading disabled');
			$button.removeAttr('disabled');
		});
	});

	var $inviteUsersModal = new InviteUsersModal($('#invite-users-modal')),
		$inviteAdminstratorsModal = new InviteUsersModal($('#invite-administrators-modal'));

	$actionMenu.on('click', '[data-action]', function() {
		var $actionButton = $(this),
			action = $actionButton.attr('data-action'),
			request = $.Deferred().reject();

		if (action !== 'invite-users' && action !== 'invite-administrators' && action !== 'login') {

			$actionButton.attr('disabled', true);
			$actionButton.addClass('loading disabled');
			if ($actionButton.is('div')) {
				$actionButton.prepend($('<i class="notched circle loading icon"></i>'));
			}
		}

		switch (action) {
			case 'invite-users':
				$inviteUsersModal.open();
				return;
			case 'invite-administrators':
				$inviteAdminstratorsModal.open();
				return;
			case 'send-request':
			case 'join-group':
			case 'accept-invitation':
				request = Membership.api.groups.join({groupId:groupId});
				break;
			case 'cancel-request':
			case 'leave-group':
			case 'decline-invitation':
				request = Membership.api.groups.leave({groupId:groupId});
				break;
			case 'unfollow':
				request = Membership.api.groups.unfollow({groupId:groupId});
				break;
			case 'follow':
				request = Membership.api.groups.follow({groupId:groupId});
				break;
			case 'block':
				request = Membership.api.groups.block({groupId:groupId});
				break;
			case 'unblock':
				request = Membership.api.groups.unblock({groupId:groupId});
				break;

			case 'login':
				$loginModal.mpModal('show');
				return;
		}

		request.then(function() {
			window.location.reload(true);
		})
	});


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
						Membership.api.groups.changeCover({
							groupId: groupId,
							attachmentId: attachmentId,
							cropData: $coverImage.cropper('getData', true),
						}).then(function(response) {
							if (response.success) {
								$coverImage.attr('src', Membership.helpers.getGroupCover(response.images));
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
		Membership.api.groups.removeCover({
			groupId: groupId
		}).then(function(response) {
			if (response.success) {
				$coverImage.attr('src', Membership.get('settings.groups.default-cover'));
				$updateCoverMenu.addClass('default');
			}
			$coverLoader.removeClass('active');
		});

	});

	// Logo upload
	var $logoImage = $('.logo-image'),
		$logoModal = $('#logo-modal'),
		$logoModalImage = $('.logo-modal-image'),
		$logoModalImageContainer = $('.logo-image-container'),
		$logoModalActions = $logoModal.find('.actions'),
		$logoModalLoader = $logoModalImageContainer.find('.dimmer, .loader'),
		$logoLoader = $('.logo-loader'),
		$logoLoader = $.merge($logoLoader, $logoLoader.children()),
		logoWidth = Membership.get('settings.groups.logo-size.width'),
		logoHeight = Membership.get('settings.groups.logo-size.height'),
		logoAspectRatio =  logoWidth / logoHeight,
		$updateLogoMenu = $('.update-logo-menu');

	$updateLogoMenu.find('[data-action="upload-logo"]').on('click', function() {
		$('<input type="file" name="image" accept=".jpg,.jpeg,.png">').on('change', function(event) {
			event.preventDefault();
			var files = event.target.files || event.dataTransfer.files,
				oldImageSrc = $logoImage.attr('src');

			$logoModalImage.attr('src', oldImageSrc);
			$logoModalLoader.addClass('active');
			$logoModal.mpModal('show');

			Membership.api.base.uploadImage({
				image: files[0]
			}).then(function(response) {

				$logoModalLoader.removeClass('active');
				$logoModalImage.attr('src', response.attachment.src);

				var attachmentId = response.attachment.id;

				$logoModalActions.one('click', 'button', function(event) {
					var $button = $(event.target),
						$buttons = $logoModalActions.find('button'),
						action = $button.attr('data-action');

					if (action == 'save-photo') {
						$buttons.attr('disabled', true);
						$button.addClass('loading');
						$logoModalLoader.addClass('active');

						Membership.api.groups.changeLogo({
							groupId: groupId,
							attachmentId: attachmentId,
							cropData: $logoModalImage.cropper('getData', true),
						}).then(function(response) {
							if (response.success) {
								$logoImage.attr('src', Membership.helpers.getGroupLogo(response.images));
								$logoModalImage.cropper('destroy').parent().removeAttr('style');
								$updateLogoMenu.removeClass('default');
							}
							$logoModalLoader.removeClass('active');
							$buttons.attr('disabled', false);
							$button.removeClass('loading');
							$logoModal.mpModal('hide');
						});
					} else {
						$logoModalImage.attr('src', oldImageSrc);
						$logoModalImage.cropper('destroy').parent().removeAttr('style');
						$logoModal.mpModal('hide');
					}
				});

				$logoModalImage.cropper($.extend(cropper.settings, {
					aspectRatio: logoAspectRatio,
					viewMode: 1,
					built: function() {
						$logoModalImage.cropper('zoomTo', 1);
					}
				}));

			}, function(response) {
				$logoModal.removeData();
				$logoModal.mpModal('hide');
				Snackbar.show({text: response.message});
				return $.Deferred().resolve();
			});
		}).trigger('click');
	});

	$updateLogoMenu.find('[data-action="remove-logo"]').on('click', function() {
		$logoLoader.addClass('active');
		Membership.api.groups.removeLogo({groupId: groupId}).then(function(response) {
			if (response.success) {
				$logoImage.attr('src', Membership.get('settings.groups.default-logo'));
				$updateLogoMenu.addClass('default');
			}
			$logoLoader.removeClass('active');
		});

	});

	// Dropdowns init
	$('.mp-update-cover, .mp-logo').find('.dropdown').mpDropdown({
		action: 'hide'
	});

}(jQuery, Membership));