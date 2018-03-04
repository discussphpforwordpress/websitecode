(function($, Membership) {

	var $loginModal = $('#membership-login-modal').mpModal();

	$(document).on('click', '.group-action-buttons button', function() {
		var $button = $(this),
			$actionButtons = $button.closest('.group-action-buttons').find('button'),
			$group = $button.closest('.mp-group-card'),
			groupId = $group.attr('data-id'),
			action = $button.attr('data-action'),
			request = $.Deferred().reject();

		if (action !== 'login') {
			$actionButtons.attr('disabled', true);
			$button.addClass('loading');
		}

		switch (action) {
			case 'send-request':
			case 'join-group':
				request = Membership.api.groups.join({groupId:groupId});
				break;
			case 'accept-invitation':
				Membership.api.groups.join({groupId:groupId}).then(function() {
					$group.fadeOut(function() {
						$group.remove();
					})
				});
				break;
			case 'decline-invitation':
				Membership.api.groups.cancelInvite({
					groupId: groupId,
					userId: Membership.currentUser.id
				}).then(function() {
						$group.fadeOut(function() {
							$group.remove();
						})
					});
				break;
			case 'cancel-request':
			case 'leave-group':
				request = Membership.api.groups.leave({groupId:groupId});
				break;
			case 'unfollow':
				request = Membership.api.groups.unfollow({groupId:groupId});
				break;
			case 'follow':
				request = Membership.api.groups.follow({groupId:groupId});
				break;
			case 'login':
				$loginModal.mpModal('show');
				break;
		}

		request.then(function(response) {
			if (response.success) {
				var $newGroup = $(response.html).filter('.mp-group-card');
				$group.replaceWith($newGroup);
			} else {
				Snackbar.show({text: response.message});
			}

			$actionButtons.removeAttr('disabled').removeClass('loading');
		})
	});

})(jQuery, Membership);