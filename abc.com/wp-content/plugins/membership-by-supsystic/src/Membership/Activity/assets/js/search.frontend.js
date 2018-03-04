(function ($, Membership) {

	var activityContainer = new Membership.Activity.ActivityContainer($('.mp-activity-container:not([data-activity-context="widget"])')),
		queryParams = Membership.helpers.getQueryParams(),
		$searchContainer = $('.search-activities'),
		$searchInput = $searchContainer.find('input'),
		$noActivitesMessage = $('.no-activities'),
		searchRequest = false,
		searchType,
		searchQuery = '';

	if (queryParams.q) {
		$searchInput.val(queryParams.q);
		searchQuery = queryParams.q;
		searchType = queryParams.type || 'all';
	}


	function searchActivities() {
		$noActivitesMessage.hide();
		searchRequest = true;
		activityContainer.$activitiesLoader.show();

		return Membership.api.activity.search({
			query: searchQuery,
			type: searchType,
			limit: activityContainer.limit,
			offsetId: activityContainer.offsetId
		}).then(function(response) {

			if (response.success) {
				var $activities = activityContainer.initActivities($(response.html).filter('.mp-activity'));
				activityContainer.offsetId = $activities.last().attr('data-activity-id');
				activityContainer.$activitiesList.append($activities);

				if (!$activities.length && !activityContainer.$activitiesList.find('.mp-activity').length) {
					$noActivitesMessage.show();
				}


				if ($activities.length < activityContainer.limit) {
					activityContainer.hasMoreActivities = false;
				}
			}

			activityContainer.$activitiesLoader.hide();
			searchRequest = false;
		});
	}

	activityContainer.$activitiesList.mpVisibility({
		once: false,
		observeChanges: true,
		onBottomVisible: function() {
			if (activityContainer.hasMoreActivities && searchQuery.length > 0 && !searchRequest) {
				searchActivities();
			}
		}
	});

	function updateQueryString(searchInput) {
		var query = Membership.helpers.updateQueryParams(window.location.search, {
			q: encodeURIComponent(searchInput),
			type: 'text',
		});

		if (!query) {
			query = window.location.origin + window.location.pathname;
		}

		History.replaceState({
			component: 'mp-search',
			action: 'search'
		}, History.options.initialTitle, query);

	}

	function searchUpdate() {
		var inputValue = this.value;

		if (inputValue === searchQuery) {
			return;
		}

		searchQuery = inputValue;
		searchType = 'text';
		activityContainer.offsetId = null;
		activityContainer.hasMoreActivities = true;

		updateQueryString(inputValue);
		activityContainer.$activitiesList.empty();
		if (inputValue.length > 0) {
			searchActivities();
		}

	}

	$searchInput.on('keyup', Membership.helpers.debounce(searchUpdate, 500));

})(jQuery, Membership);