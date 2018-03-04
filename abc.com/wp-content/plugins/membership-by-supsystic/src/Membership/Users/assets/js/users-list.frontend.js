(function($, Membership) {

	var $sendMessageToUserModal = $('#send-message-modal'),
		$sendMessageToUserModalButtons = $sendMessageToUserModal.find('.actions button'),
		mbsAmb = null,
		$loginModal = $('#membership-login-modal').mpModal();

	$sendMessageToUserModal.mpModal({
		onApprove: function($button) {
			var $textarea = $sendMessageToUserModal.find('textarea'),
				message = $.trim($textarea.val()),
				attachmentArr = [],
				userId = $sendMessageToUserModal.attr('data-user-id');

			if(mbsAmb) {
				attachmentArr = mbsAmb.getAttachedIds();
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
					$sendMessageToUserModal.mpModal('hide');
					Snackbar.show({text: 'Message was sent.'});
				}
			});

			return false;
		},
		'onShow': function() {
			$('.mbsAttMessSendBtn').prop('disabled', false);
			if(mbsAmb) {
				mbsAmb.clearAttachmentWrapper();
			}
		},
		onHidden: function($button) {
			$sendMessageToUserModal.find('textarea').val('');
			$sendMessageToUserModalButtons.removeClass('loading');
			$sendMessageToUserModalButtons.removeAttr('disabled');
		}
	});


	$(document).on('click', '.user-action-buttons button', function() {

		var $button = $(this),
			$actionButtons = $button.closest('.user-action-buttons').find('button'),
			action = $button.attr('data-action'),
			$user = $button.closest('.mp-user-card'),
			userId = $user.attr('data-id'),
			request = $.Deferred().reject();

		if (action !== 'message' && action !== 'login') {
			$actionButtons.attr('disabled', true);
			$button.addClass('loading');
		}

		switch (action) {
			case 'add-friend':
				request = Membership.api.users.addFriend({userId: userId});
				break;
			case 'remove-friend':
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
				if (Membership.helpers.currentUserHasPermission('send-messages', Membership.get('currentUser'))) {
                    $sendMessageToUserModal.find('.recipient-name').text($user.find('a.header').text());
                    $sendMessageToUserModal.mpModal('show');
                    $sendMessageToUserModal.attr('data-user-id', userId);
				} else {
                    Snackbar.show({text: "You're blocked by this user"});
				}
				break;
			case 'login':
				$loginModal.mpModal('show');
				break;
		}

		request.then(function(response) {
			if (response.success) {
				var $newUser = $(response.html).filter('.mp-user-card');
				$user.replaceWith($newUser);
			} else {
				Snackbar.show({text: response.message});
			}
		})

	});

	$(document).ready(function() {
		if(window.mbsAttachmentMessageBehavior) {
			mbsAmb = new window.mbsAttachmentMessageBehavior();
			mbsAmb.init($sendMessageToUserModal);
		}
	});
})(jQuery, Membership);