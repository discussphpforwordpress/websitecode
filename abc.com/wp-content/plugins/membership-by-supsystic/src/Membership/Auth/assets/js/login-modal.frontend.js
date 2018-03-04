(function($, Membership){

	var $loginModal = $('#membership-login-modal');

	$loginModal.find('form').on('form.submit', function(event, request) {
		request.then(function(response) {
			if (response.success) {
				response.redirect = window.location;
			}
		});
	});

}(jQuery, Membership));