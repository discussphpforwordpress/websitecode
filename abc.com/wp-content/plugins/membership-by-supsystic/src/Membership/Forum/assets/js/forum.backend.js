(function($, Membership) {

	$('.save-settings[data-item="forum"]').on('click', function(event) {
		event.preventDefault();

		var section = $('div.sc-tab-content[data-tab="forum"]'),
			settings = section.find('.mp-options :input').serializeJSON({checkboxUncheckedValue: false});

		Membership.ajax({
			'route': 'forum.saveSettings',
			'settings': settings
		}, {'method': 'post'}).error(function(response) {
			console.error(response.responseJSON.message);
		});
	});

}(jQuery, Membership));


