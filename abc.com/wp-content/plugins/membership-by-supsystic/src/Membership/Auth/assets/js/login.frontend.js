(function($, Membership) {

	$(function() {

			var $form = $('.membership-login-form'),
				$submitButton = $form.find('.submit'),
				validationRules = $form.data('validation-rules');

			$form.on('submit', function(event) {
				event.preventDefault();


				var formData = $form.find(':input').serializeJSON(),
					validationCheck = Membership.validateForm($form, formData, validationRules);

				if (!validationCheck) {
					return;
				}

				$submitButton.attr('disabled', true);
				$submitButton.addClass('loading disabled');

				var request = Membership.ajax({
						route: 'auth.login',
						formData: formData
					}, {
						method: 'post'
				});

				$form.trigger('form.submit', [request]);

				request.done(function(response) {
					if (response.success) {
						window.location = response.redirect;
					} else {
						Membership.showFormResponseErrors(response.errors, $form);
					}
				}).error(function(response) {
					Membership.showFormResponseErrors(response.responseJSON.errors, $form);
				}).always(function() {
					$submitButton.removeClass('loading disabled');
					$submitButton.attr('disabled', false);
				});


			});

			$submitButton.on('click', function () {
				$form.trigger('submit');
			});

		});


}(jQuery, Membership));