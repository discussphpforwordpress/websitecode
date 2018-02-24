(function($, Membership) {

	// Navigation menu
	var $navMenu = $('.forums-tab-items'),
		navMenuBreaks = [];

	Membership.helpers.fitActionMenuToScreen($navMenu, navMenuBreaks);

	function fitMenu() {
		Membership.helpers.fitActionMenuToScreen($navMenu, navMenuBreaks);
	}

	$('.forums-tab-items').find('.dropdown').mpDropdown({
		action: 'hide'
	});

	$(window).on('resize', Membership.helpers.debounce(fitMenu, 100));

	var activeList,
		firstItemInit = true,
		ForumEntriesLists = {},
		EntriesList = function($tabContainer, listType) {

			this.$el = $tabContainer;
			this.listType = listType;
			this.$loader = $tabContainer.find('.entries-loader');
			this.$list = $tabContainer.find('.entries-list');
			this.limit = 10;
			this.$posts = this.$list.find('.mp-entry');
			this.offsetId = this.$posts.last().attr('data-id');
			this.hasMoreEntries = this.$posts.length == this.limit;
			this.fetchEntriesRequest = false;
			// var $date = $el.find('.date');

		};

	EntriesList.prototype.init = function() {
		var self = this;

		this.$el.find('.date').each(function() {
			var $date = $(this);
			$date.text(Membership.helpers.moment($date.text()));
		});


		this.$list.mpVisibility({
			once: false,
			observeChanges: true,
			onBottomVisible: function() {
				if (self.hasMoreEntries && !self.fetchEntriesRequest && self.listType == activeList) {
					self.fetchEntries();
				}
			}
		});
	};

	EntriesList.prototype.fetchEntries = function() {

		this.$loader.show();
		this.fetchEntriesRequest = true;

		var self = this,
			request;

		request = Membership.ajax({
			route: 'forum.getBbPressData',
			limit: this.limit,
			userId: Membership.get('requestedUser.id'),
			offsetId: this.offsetId,
			listType: this.listType
		});

		request.then(function(response) {
			if (response.success) {

				var $entries = $(response.html).filter('.mp-entry');
				self.offsetId = $entries.last().attr('data-id');

				$entries.find('.date').each(function() {
					var $date = $(this);
					$date.text(Membership.helpers.moment($date.text()));
				});

				self.$list.append($entries);

				if ($entries.length !== self.limit) {
					self.hasMoreEntries = false;
				}
			}

			self.fetchEntriesRequest = false;
			self.$loader.hide();
		});
	};


	$.each(['topics', 'replies', 'favorites', 'subscriptions'], function(index, value) {
		var $tabItem = $('.forums-tab-items .item[data-tab="' + value + '"]'),
			$tabContainer = $('.forums-tabs .tab[data-tab="' + value + '"]');

		if ($tabItem.length && $tabContainer.length) {
			var entriesList = new EntriesList($tabContainer, value);
			ForumEntriesLists[value] = entriesList;

			$tabItem.mpTab({
				ignoreFirstLoad: true,
				onFirstLoad: function() {
					entriesList.init();
				},
				onLoad: function(tabPath) {
					activeList = tabPath;
				}
			});

			if (firstItemInit) {
				$tabItem.trigger('click');
				firstItemInit = false;
			}
		}
	});

})(jQuery, Membership);