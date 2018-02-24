(function($, Membership) {

	var UsersList = function($tabContainer, listType) {
		this.$el = $tabContainer;
		this.listType = listType;
		this.limit = 10;
		this.offsetId = null;
		this.$loader = $tabContainer.find('.list-loader');
		this.$list = $tabContainer.find('.users-list');
		this.$notFoundMessage = $tabContainer.find('.no-users');
		this.$searchInput = $tabContainer.find('.user-search-input input');
		this.fetchUsersRequest = false;
		this.$users = this.$list.find('.mp-user-card');
		this.offsetId = this.$users.last().attr('data-id');
		this.hasMoreUsers = this.$users.length == this.limit;
	};

	UsersList.prototype.init = function() {
		var self = this;

		this.$searchInput.on('keyup', Membership.helpers.debounce(function() {
			if (this.value.length > 2 || this.value.length === 0) {
				self.$list.empty();
				self.offsetId = null;
				self.$loader.show();
				self.hasMoreUsers = true;
				self.fetchUsers();
			}
		}, 1000));

		this.$list.mpVisibility({
			once: false,
			observeChanges: true,
			onBottomVisible: function() {
				if (self.hasMoreUsers && !self.fetchUsersRequest) {
					self.fetchUsers();
				}
			}
		});
	};

	UsersList.prototype.fetchUsers = function() {

		this.$loader.show();
		this.fetchUsersRequest = true;
		this.$notFoundMessage.hide();

		var self = this,
			request;

		switch (this.listType) {
			case 'friends':
				request = Membership.api.users.getFriends({
					userId: Membership.requestedUser.id,
					limit: this.limit,
					offsetId: this.offsetId,
					search: this.$searchInput.val()
				});
				break;
			case 'friend-requests':
				request = Membership.api.users.getFriendshipRequests({
					limit: this.limit,
					offsetId: this.offsetId,
					search: this.$searchInput.val()
				});
				break
		}

		request.then(function(response) {
			if (response.success) {

				var $users = $(response.html).filter('.mp-user-card');
				self.offsetId = $users.last().attr('data-id');
				self.$list.append($users);

				if (!self.$list.find('.mp-user-card').length) {
					self.$notFoundMessage.show();
				}

				if ($users.length !== self.limit) {
					self.hasMoreUsers = false;
				}
			}

			self.fetchUsersRequest = false;
			self.$loader.hide();
		});
	};

	var firstItemInit = true;

	var UsersLists = {};

	$.each(['friends', 'friend-requests'], function(index, value) {
		var $tabItem = $('.users-tab-items .item[data-tab="' + value + '"]'),
			$tabContainer = $('.users-tabs .tab[data-tab="' + value + '"]');

		if ($tabItem.length && $tabContainer.length) {
			var usersList = new UsersList($tabContainer, value);
			UsersLists[value] = usersList;

			$tabItem.mpTab({
				ignoreFirstLoad: true,
				onFirstLoad: function() {
					usersList.init();
				},
				onLoad: function() {
					if ($tabItem.hasClass('need-refresh')) {
						usersList.$list.empty();
						usersList.offsetId = null;
						usersList.$loader.show();
						usersList.hasMoreUsers = true;
						usersList.fetchUsers();
						$tabItem.removeClass('need-refresh');
					}
				}
			});

			if (firstItemInit) {
				$tabItem.trigger('click');
				firstItemInit = false;
			}
		}
	});


	$(document).on('click', '.user-action-buttons button', function() {
		var $button = $(this),
			action = $button.attr('data-action'),
			$user = $button.closest('.mp-user-card'),
			userId = $user.attr('data-id'),
			$socialStats = $('.mp-profile-social-stats'),
			$friendsStatsCount = $socialStats.find('.mp-social-stats-friends'),
			$friendsTabItem = $('.users-tab-items [data-tab="friends"]'),
			$friendsLabel = $friendsTabItem.find('.label'),
			$friendRequestsLabel = $('.users-tab-items [data-tab="friend-requests"] .label');

		switch (action) {
			case 'accept-friend':
				$friendRequestsLabel.text(parseInt($friendRequestsLabel.text(), 10) - 1);
				$friendsLabel.text(parseInt($friendsLabel.text(), 10) + 1);
				$friendsStatsCount.text(parseInt($friendsStatsCount.text(), 10) + 1);

				Membership.api.users.addFriend({userId: userId})
					.then(function(response) {
						if (response.success) {
							$user.fadeOut(250, function() {
								$user.remove();
								$friendsTabItem.addClass('need-refresh');
							});
						}
					});
				break;
			case 'decline-friend':
				$friendRequestsLabel.text(parseInt($friendRequestsLabel.text(), 10) - 1);
				Membership.api.users.removeFriend({userId: userId}).then(function(response) {
						if (response.success) {
							$user.fadeOut(250, function() {
								$user.remove();
								UsersLists['friend-requests'].$list.mpVisibility('refresh');
							});
						}
					});
				break;
		}
	});
})(jQuery, Membership);