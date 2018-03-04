(function($, Membership) {

	var $recaptcha = $('.g-recaptcha'),
		$form = $recaptcha.closest('form'),
		$validationRules = $form.attr('data-validation-rules');

	if ($validationRules) {
		var validationRules = JSON.parse($validationRules);
		validationRules['g-recaptcha-response'] = {
			"presence" : {
				"message": "Please fill up the captcha."
			}
		};
		$form.attr('data-validation-rules', JSON.stringify(validationRules));
	}

	function resetReCaptcha() {
		grecaptcha && grecaptcha.reset();
	}

	window.MembershipRecaptchaResponseCallback = function(response) {
		$('[name="g-recaptcha-response"]').trigger('change');
		$form.on('form.submit', function(event, request) {
			request.done(function(response) {
				if (!response.success) {
					resetReCaptcha();
				}
			}).error(function(response) {
				resetReCaptcha();
			});
		});
	};

}(jQuery, Membership));