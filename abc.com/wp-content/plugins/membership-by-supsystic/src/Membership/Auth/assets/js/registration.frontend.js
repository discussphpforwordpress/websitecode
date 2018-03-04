(function($, Membership) {

	window.MembershipRecaptchaResponseCallback = function(response) {
		$('[name="g-recaptcha-response"]').trigger('change');
	};

	$(function() {

		var $form = $('.membership-registration-form'),
			$submitButton = $form.find('.registration-submit'),
			validationRules = $form.data('validation-rules'),
			$dateFields = $form.find('.date-field');


		if ($dateFields.length) {
			$dateFields.each(function () {
				var $dateField = $(this),
					$realField = $form.find('[name="' + $dateField.attr('data-field-name') + '"]');

				new Pikaday({
					yearRange: 100,
					field: this,
					format: $dateField.attr('data-format'),
					onSelect: function() {
						$realField.val(this.getMoment().format('YYYY-MM-DD'));
					}
				});
			})

		}

		$form.find('select.dropdown').mpDropdown();

		$form.on('submit', function(event) {
			event.preventDefault();
			
			var formData = $form.find(':input').serializeJSON(),
				validationCheck = Membership.validateForm($form, formData, validationRules),
				$firstErrorField = $('.field.tooltipstered').first();

			if (!validationCheck) {
				if ($firstErrorField.length) {
					$('html, body').stop().animate({
						scrollTop: $firstErrorField.offset().top
					}, 1000);
				}
				return;
			}

			$submitButton.attr('disabled', true).addClass('loading');
			
			Membership.ajax({
				route: 'auth.getNonce'
			}, {
				method: 'post'
			}).done(function(response) {
				if (response.success) {
					$('#_wpnonce').val(response.nonce);
					var formData = $form.find(':input').serializeJSON();
					Membership.ajax({
						route: 'auth.registration',
						formData: formData
					}, {
						method: 'post'
					}).done(function(response) {
						if (response.success) {
							if (response.message !== '') {
								$('form').hide();
								$('.message.success').html(response.message).show();
								setTimeout(function() {
									window.location = response.redirect;
								}, 5000);
							} else {
								window.location = response.redirect;
							}
						} else {
							if(typeof grecaptcha != 'undefined') {
								grecaptcha && grecaptcha.reset();
							}
							Membership.showFormResponseErrors(response.errors, $form);
							$submitButton.removeAttr('disabled').removeClass('loading');
						}
					}).error(function (response) {
						if(typeof grecaptcha != 'undefined') {
							grecaptcha && grecaptcha.reset();
						}
						showResponseErrors(response.responseJSON.errors);
						$submitButton.removeAttr('disabled').removeClass('loading');
					});
				} else {
					if(typeof grecaptcha != 'undefined') {
						grecaptcha && grecaptcha.reset();
					}
					Membership.showFormResponseErrors(response.errors, $form);
					$submitButton.removeAttr('disabled').removeClass('loading');
				}
			}).error(function (response) {
				if(typeof grecaptcha != 'undefined') {
					grecaptcha && grecaptcha.reset();
				}
				showResponseErrors(response.responseJSON.errors);
				$submitButton.removeAttr('disabled').removeClass('loading');
			});
		});
	});

	function showResponseErrors(errors) {
		if (! errors) {
			return;
		}
		var $errorContainer = $('.error.message'),
			$errorsList = $errorContainer.find('.list');
		$errorsList.empty();

		$.each(errors, function (i, message) {
			$errorsList.append($('<li>' + message + '</li>'));
		});
		$errorContainer.show();
	}

})(jQuery, Membership);
