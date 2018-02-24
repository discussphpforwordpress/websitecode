(function($, Membership) {

	var $usersList = $('.users-list'),
		$showMoreButtonContainer = $('#users-list-load-more'),
		$showMoreButton = $showMoreButtonContainer.find('button'),
		showMoreButtonIsEnabled = Membership.get('settings.design.members.show-load-more-button') === 'true',
		paginationIsEnabled = Membership.get('settings.design.members.show-pages') === 'true',
		$loader = $('.users-list-loader'),
		$usersSearchInput = $('#users-search-input'),
		limit = 10,
		searchQuery = $usersSearchInput.val(),
		hasMoreUsers = $usersList.find('.mp-user-card').length === limit,
		loadRequest = false,
		requestPromise;

	$('#mbsMsfUserRoleId').on('change', function() {
		if(!paginationIsEnabled) {
			$usersList.empty();
			loadUsers();
		}
	});

	function loadUsers() {
		if (loadRequest || paginationIsEnabled) {
			return;
		}
		var userRoleVal = $('#mbsMsfUserRoleId').val();

		$showMoreButton.hide();
		$loader.fadeToggle();
		loadRequest = true;

		if (searchQuery || userRoleVal) {
			requestPromise = Membership.api.users.search({
				'query': searchQuery,
				'limit': limit,
				'offset': $usersList.children().length,
				'template': 'users-list',
				'userRoleId': userRoleVal,
			});
		} else {
			requestPromise = Membership.api.users.get({
				limit: limit,
				offset: $usersList.children().length
			});
		}

		requestPromise.then(function(response) {
			if (response.success) {
				$showMoreButton.show();
				var $users = $(response.html).filter('.mp-user-card');

				if ($users.length !== limit) {
					hasMoreUsers = false;
					$showMoreButton.hide();
				}

				$usersList.append($users);
				$usersList.children().slice(-$users.length).fadeTo(0, 0).fadeTo(250, 1);
			}
			$loader.hide();
			loadRequest = false;
		});
	};

	function paginationSearch() {
		searchQuery = $.trim($usersSearchInput.val());
		var userRoleId = $('#mbsMsfUserRoleId').val();

		if (searchQuery || userRoleId) {
			window.location.href = Membership.helpers.getRouteUrl('members', {
				'search': searchQuery,
				'role_id': userRoleId,
			});
			$usersSearchInput.next().addClass('loading').attr('disabled', true);
		}
	}

	if (!paginationIsEnabled) {
		var debounceSearchHandler = Membership.helpers.debounce(function() {
			searchQuery = $.trim($usersSearchInput.val());
			hasMoreUsers = true;
			$usersList.empty();
			loadUsers();
		}, 500);

		$usersSearchInput.on('keyup', function (event) {
			if (event.keyCode == 13) {
				debounceSearchHandler();
			}
		});
		$usersSearchInput.on('input', debounceSearchHandler);
	}

	if (showMoreButtonIsEnabled) {

		if (hasMoreUsers) {
			$showMoreButton.show();
		}
		
		$showMoreButton.on('click', function () {
			var dataAction = $showMoreButtonContainer.attr('data-action');
			var $userId = $('.member-tabs button').last().attr('data-user-id');
			if (typeof dataAction !== typeof undefined && dataAction !== false) {
				var offsetId = $showMoreButtonContainer.attr('data-offcet-id');
				switch (dataAction) {
					case 'friends':
						request = Membership.api.users.getFriends({userId: $userId, limit:limit, offsetId: offsetId});
						break;
					case 'follows':
						request = Membership.api.users.getFollows({userId: $userId, limit:limit, offsetId: offsetId});
						break;
					case 'followers':
						request = Membership.api.users.getFollowers({userId: $userId, limit:limit, offsetId: offsetId});
						break;
				}
				request.then(function(response) {
					if (response.success) {
						$('.users-list-tabs').append(response.html);
						var offsetId = $('.users-list-tabs .mp-user-card').last().attr('data-id');
						$('#users-list-load-more').attr('data-offcet-id', offsetId);
						if (hasMoreUsers) {
							$showMoreButton.show();
						}else{
							$showMoreButton.hide();
						}
					}
				});
			}else{
				loadUsers();
			}
			
		});
	} else if (paginationIsEnabled) {
		$usersSearchInput.on('keyup', function (event) {
			if (event.keyCode == 13) {
				paginationSearch();
			}
		});
		$usersSearchInput.next().on('click', paginationSearch)
	} else {
		$usersList.mpVisibility({
			once: false,
			observeChanges: true,
			offset: $usersList.children(":first").height(),
			onBottomVisible: function() {
				if (hasMoreUsers) {
					loadUsers();
				}
			},
		});
	}

	$('.ui.pagination.menu').on('click', 'a.disabled', function(event) {
		event.preventDefault();
	});
	
	$(document).on('click', '.member-tabs button', function() {
		
		var $button = $(this)
			,   wrapper = $button.parent()
			,   action = $button.attr('data-action')
			,	$userId = $button.attr('data-user-id')
			,	$showAllMembers = false
			,	$countAllMembers = $button.attr('data-count');
		
		wrapper.find('button').removeClass('active');
		$button.addClass('active');
		
		if(!paginationIsEnabled){
			switch (action) {
				case 'all':
					$showAllMembers = true;
					$('#users-list-load-more').removeAttr('data-action');
					$('#users-list-load-more').removeAttr('offcet-id');
					break;
				case 'friends':
					request = Membership.api.users.getFriends({userId: $userId, limit:limit});
					$('#users-list-load-more').attr('data-action', 'friends');
					break;
				case 'follows':
					request = Membership.api.users.getFollows({userId: $userId, limit:limit});
					$('#users-list-load-more').attr('data-action', 'follows');
					break;
				case 'followers':
					request = Membership.api.users.getFollowers({userId: $userId, limit:limit});
					$('#users-list-load-more').attr('data-action', 'followers');
					break;
			}
			if($showAllMembers){
				$('.users-list').show();
				$('.users-list-tabs').hide();
			}else{
				request.then(function(response) {
					if (response.success) {
						$('.users-list').hide();
						$('.users-list-tabs').html(response.html);
						$('.users-list-tabs').show();
						var $offsetId = $('.users-list-tabs .mp-user-card').last().attr('data-id');
						var $cartsCount = $('.users-list-tabs .mp-user-card').length;
						$('#users-list-load-more').attr('data-offcet-id', $offsetId);
						$showMoreButton.show();
						if($cartsCount >= $countAllMembers){
							$showMoreButton.hide();
						}
					}
				});
			}
		}else{
			var url = $button.attr('data-current-url');
			url = url + '/?offset=1&type='+action+'';
			window.location.href = url;
		}
	});

})(jQuery, Membership);