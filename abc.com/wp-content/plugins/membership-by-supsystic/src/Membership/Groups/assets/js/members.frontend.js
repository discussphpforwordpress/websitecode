(function($, Membership) {

	var groupId = Membership.requestedGroup.id;

	var UsersList = function($tabContainer, listType) {
		this.$el = $tabContainer;
		this.listType = listType;
		this.limit = 10;
		this.offsetId = null;
		this.$loader = $tabContainer.find('.list-loader');
		this.$list = $tabContainer.find('.users-list');
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

		var self = this,
			request;

		request = Membership.api.groups.getUsers({
			groupId: groupId,
			status: this.listType,
			limit: this.limit,
			offsetId: this.offsetId,
			search: this.$searchInput.val()
		});

		request.then(function(response) {
			if (response.success) {

				var $users = $(response.html).filter('.mp-user-card');
				self.offsetId = $users.last().attr('data-id');
				self.$list.append($users);

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

	$.each(['approved', 'unapproved', 'blocked', 'invited'], function(index, value) {
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

	var $tabMenuItems = $('.users-tab-items');

	function updateTabLabelCounter(tab, increase) {
		var $tabItem = $tabMenuItems.find('[data-tab="' + tab + '"]'),
			$label = $tabItem.find('.label'),
			count = parseInt($label.text(), 10);

		count += increase;
		$label.text(count);

		if (count == 0) {
			$label.hide();
		} else {
			$tabItem.show();
		}
	}

	$(document).on('click', '.user-action-buttons [data-action]', function() {
		var $button = $(this),
			action = $button.attr('data-action'),
			$user = $button.closest('.mp-user-card'),
			userId = $user.attr('data-id'),
			request = $.Deferred().reject();

		if (['approve', 'unapprove', 'unblock', 'block', 'remove-from-group'].indexOf(action) !== -1) {
			$button.attr('disabled', true).addClass('loading');
		}

		switch (action) {
			case 'approve':
				request = Membership.api.groups.approveUser({
					groupId: groupId,
					userId: userId,
				}).then(function(response) {
					if (response.success) {
						updateTabLabelCounter('approved', +1);
						updateTabLabelCounter('unapproved', -1);
					}
				});
				break;
			case 'unapprove':
				request = Membership.api.groups.removeUser({
					groupId: groupId,
					userId: userId,
				}).then(function(response) {
					if (response.success) {
						updateTabLabelCounter('unapproved', -1);
					}
				});
				break;
			case 'unblock':
				request = Membership.api.groups.unblockUser({
					groupId: groupId,
					userId: userId
				}).then(function(response) {
					if (response.success) {
						updateTabLabelCounter('blocked', -1);
					}
				});
				break;
			case 'block':
				request = Membership.api.groups.removeUser({
					groupId: groupId,
					userId: userId,
					block: true
				}).then(function(response) {
					if (response.success) {
						updateTabLabelCounter('approved', -1);
						updateTabLabelCounter('blocked', +1);
						UsersLists['blocked'].hasMoreUsers = true;
					}
				});
				break;
			case 'remove-from-group':
				request = Membership.api.groups.removeUser({
					groupId: groupId,
					userId: userId,
				}).then(function(response) {
					if (response.success) {
						updateTabLabelCounter('approved', -1);
					}
				});
				break;
		}

		request.then(function() {
			$user.fadeOut(function() {
				$user.remove();
			});
		})

	});

})(jQuery, Membership);