(function ($, Membership) {

	$(function() {

		$(window).off('beforeunload');

		var $usersTab = $('[data-tab="users"]'),
			$usersTable = $('table.users-table'),
			$applyButton = $usersTab.find('.bulk-actions-apply-button'),
			$bulkActions = $usersTab.find('.bulk-actions'),
			$bulkActionsLists = $usersTab.find('.bulk-actions-list'),
			$searchButton = $usersTab.find('.search-button'),
			$searchUsersInput = $usersTab.find('.search-users-input');

		$usersTable.find('.last-seen, .registered').each(function() {
			var $this = $(this);
			if ($this.hasClass('registered')) {
				$this.text(moment($this.text()).fromNow());
			} else {
				$this.text(moment($this.text() * 1000).fromNow());
			}
			$this.show();
		});

		$usersTable.find('.select-all').on('change', function() {
			var isChecked = this.checked;

			$usersTable.find('input[name="users[]"]').each(function() {
				$(this).prop('checked', isChecked);
			})
		});

		$usersTable.find('tr').on('click', function() {
			var checkbox = $(this).find('input[name="users[]"]');
			checkbox.prop('checked', !checkbox.prop('checked'));
		});

		$bulkActions.on('change', function() {

			$bulkActionsLists.hide();
			$applyButton.show();

			switch (this.value) {
				case 'change-status':
					$bulkActionsLists.filter('.status-list').show();
					break;
				case 'change-role':
					$bulkActionsLists.filter('.roles-list').show();
					break;
				default:
					$applyButton.hide();
			}
		});


		$applyButton.on('click', function () {

			var checkedUserCheckboxes = $usersTable.find('input[name="users[]"]').serializeJSON(),
				action = $bulkActions.val(),
				value;

			switch (action) {
				case 'change-status':
					value = $bulkActionsLists.filter('.status-list').val();
					break;
				case 'change-role':
					value = $bulkActionsLists.filter('.roles-list').val();
					break;
				default:
					return;
			}

			if (! checkedUserCheckboxes.users) {
				$.sNotify({
					icon: 'fa fa-exclamation',
					content: '<span>You must select at least one user.</span>',
					delay: 3000
				});

				return;
			}

			$bulkActions.attr('disabled', true);
			$bulkActionsLists.attr('disabled', true);

			$applyButton.attr('disabled', true);

			var updateNotify = $.sNotify({
				icon: 'fa fa-circle-o-notch fa-spin fa-lg',
				content: '<span>Updating users...</span>'
			});

			Membership.ajax({
				route: 'users.bulkUpdate',
				users: checkedUserCheckboxes.users,
				bulkAction: action,
				bulkValue: value
			}, {method: 'post'}).success(function(response) {
				updateNotify.update('<span>Updated</span>', 'fa fa-check').close(2000);
				var newLabel = '';

				switch (action) {
					case 'change-status':
						newLabel = $bulkActionsLists.filter('.status-list').find('option:selected').text();
						$usersTable.find('input[name="users[]"]:checked').each(function() {
							var $row = $(this).closest('tr');
							$row.find('.status').text(newLabel);
						});
						break;
					case 'change-role':
						newLabel = $bulkActionsLists.filter('.roles-list').find('option:selected').text();
						$usersTable.find('input[name="users[]"]:checked').each(function() {
							var $row = $(this).closest('tr');
							$row.find('.role').text(newLabel);
						});
						break;
					default:
						return;
				}



			}).error(function(response) {
				updateNotify.update('<span>Error</span>', 'fa fa-exclamation').close(2000);
			}).always(function() {
				$bulkActions.removeAttr('disabled');
				$bulkActionsLists.removeAttr('disabled');
				$applyButton.removeAttr('disabled');
			});

		});

		$searchButton.on('click', function() {
			$searchButton.attr('disabled', true);
			window.location = Membership.helpers.updateQueryParams(window.location.search, {
				search: $searchUsersInput.val(),
				p: null
			}) + '#users'
		});
		
		$searchUsersInput.on('keyup', function(){
			$searchButton.attr('disabled', false);
		});

	});

})(jQuery, Membership);