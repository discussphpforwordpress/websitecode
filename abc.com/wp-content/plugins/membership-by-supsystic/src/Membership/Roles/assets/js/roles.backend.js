(function ($, Membership) {

	$(function() {
		var $rolesTable = $('table.roles');
		$rolesTable.on('change', 'input, select', function(event) {

			var $input = $(this),
				$td = $input.closest('td, th'),
				index = $td.index(),
				roleId = $rolesTable.find('tr:first').find('th').eq(index).attr('data-id'),
				name = $input.attr('name'),
				value = $input.val();

			if ($input.attr('type') === 'checkbox') {
				value = $input.is(':checked')
			}

			event.stopPropagation();

			var updateNotify = $.sNotify({
				'icon': 'fa fa-circle-o-notch fa-spin fa-lg',
				'content': '<span>Updating role</span>'
			});

			Membership.ajax({
				route: 'roles.updateRole',
				roleId: roleId,
				name: name,
				value: value
			}, {method: 'post'}).success(function(response) {
				updateNotify.update('<span>Updated</span>', 'fa fa-check').close(2000);
			});

		});

		var $fixedColumn = $rolesTable.clone()
			.insertBefore($rolesTable)
			.addClass('fixed-column'),
			width = $rolesTable.find('td:first-child').width();

		$fixedColumn.width();

		$fixedColumn
			.find('th:not(:first-child),td:not(:first-child)')
			.remove();

		$fixedColumn.find('tr').each(function (i, elem) {
			var $row = $(this);
			$row.height($rolesTable.find('tr:eq(' + i + ')').height());
			$row.find('th, td').width(width);
		});

		$rolesTable.parent().on('scroll', function() {
			$fixedColumn.css('transform', 'translateX(' + this.scrollLeft + 'px)');
		});


		var $newRoleModal = $('.new-role-template').sModal({
			width: '400px',
			height: '300px',
			buttons: [
				{
					content: '<i class="fa fa-times-circle"></i> Cancel',
					class: 'sc-button primary',
					event: function() {
						this.close();
					}
				},
				{
					content: '<i class="fa fa-plus-circle"></i> Create role',
					class: 'sc-button primary create',
					event: function(event) {
						var name = $(this).find('[name="name"]').val();

						if (!name.length) {
							return;
						}

						$(event.target).attr('disabled', true);

						Membership.ajax({
							route: 'roles.createRole',
							name: name
						}, {method: 'post'}).success(function(response) {
							window.location.reload();
						});
					}
				}
			]
		});

		$('.add-new-role').on('click', function() {
			$newRoleModal.open();
		});

		var roleIdToRemove,
			$removeRoleModal = $('.remove-role-template').sModal({
				width: '400px',
				height: '300px',
				buttons: [
					{
						content: 'Cancel',
						class: 'sc-button primary',
						event: function() {
							this.close();
						}
					},
					{
						content: 'Delete',
						class: 'sc-button primary create',
						event: function(event) {
							$(event.target).attr('disabled', true);

							Membership.ajax({
								route: 'roles.deleteRole',
								roleId: roleIdToRemove
							}, {method: 'post'}).success(function(response) {
								window.location.reload();
							});
						}
					}
				]
			});

		$('.remove-role').on('click', function() {
			roleIdToRemove = $(this).closest('th').attr('data-id');
			$removeRoleModal.open();
		});

	});

	$(function() {
		$('.save-settings').on('click', function(event) {
			event.preventDefault();
			Membership.ajax({
				'route': 'roles.saveSettings',
				'settings': $('.mp-options :input').serializeJSON({
					checkboxUncheckedValue: false,
				})
			}, {'method': 'post'})
			.error(function(response) {
				if(response && response.responseJSON && response.responseJSON.message) {
					console.error(response.responseJSON.message);
				} else {
					console.error('Error ocured');
				}

			});
		});
	});

})(jQuery, Membership);