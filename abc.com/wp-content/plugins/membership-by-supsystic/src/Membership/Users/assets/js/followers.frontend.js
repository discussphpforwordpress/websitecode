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
			case 'followers':
				request = Membership.api.users.getFollowers({
					userId: Membership.requestedUser.id,
					limit: this.limit,
					offsetId: this.offsetId,
					search: this.$searchInput.val()
				});
				break;
			case 'following':
				request = Membership.api.users.getFollows({
					userId: Membership.requestedUser.id,
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

	$.each(['followers', 'following'], function(index, value) {
		var $tabItem = $('.users-tab-items .item[data-tab="' + value + '"]'),
			$tabContainer = $('.users-tabs .tab[data-tab="' + value + '"]');

		if ($tabItem.length && $tabContainer.length) {
			var usersList = new UsersList($tabContainer, value);
			UsersLists[value] = usersList;

			$tabItem.mpTab({
				ignoreFirstLoad: true,
				onFirstLoad: function() {
					usersList.init();
				}
			});

			if (firstItemInit) {
				$tabItem.trigger('click');
				firstItemInit = false;
			}
		}
	});

})(jQuery, Membership);