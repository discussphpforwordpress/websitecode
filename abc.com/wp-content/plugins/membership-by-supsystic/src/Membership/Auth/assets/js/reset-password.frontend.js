(function($, Membership) {

	$(function() {

			var $form = $('.reset-password-form'),
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
						route: 'auth.resetPassword',
						formData: formData
					}, {
						method: 'post'
				});

				$form.trigger('form.submit', [request]);

				request.then(function(response) {
					if (response.success) {
						Membership.showFormSuccessMessage(response.message, $form);
						$form.find('.field').hide();
					} else {
						Membership.showFormResponseErrors(response.errors, $form);
					}

					$submitButton.removeClass('loading disabled');
					$submitButton.attr('disabled', false);

				});

			});

			$submitButton.on('click', function () {
				$form.trigger('submit');
			});

		});

}(jQuery, Membership));