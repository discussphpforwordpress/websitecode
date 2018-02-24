(function($, Membership) {
	
	var groupId = $('[name="group-id"]').val();

	$(function() {

		$(document).on('click', '.blockGroup', function(event) {
			event.preventDefault();
			console.log('block');
			Membership.ajax({
				route: 'groups.blockGroup',
				data: {
					'groupId': groupId,
				},
			}, {
				method: 'post'
			}).done(function(response) {
				if (response.success) {
					location.reload();
				}
			});

		});

		$(document).on('click', '.unblockGroup', function(event) {
			event.preventDefault();

			Membership.ajax({
				route: 'groups.unblockGroup',
				data: {
					'groupId': groupId,
				},
			}, {
				method: 'post'
			}).done(function(response) {
				if (response.success) {
					location.reload();
				}
			});

		});
		
	});




})(jQuery, Membership);