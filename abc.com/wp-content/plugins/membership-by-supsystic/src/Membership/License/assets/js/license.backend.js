(function($, Membership) {

	var _MS_PER_DAY = 1000 * 60 * 60 * 24;

	function dateDiffInDays(a, b) {

		var utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate()),
			utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());

		return Math.floor((utc2 - utc1) / _MS_PER_DAY);
	}

	function updateExpireDays() {
		$('.mp-addon-days-left').each(function() {
			var $this = $(this),
				daysLeft = $this.data('addonDaysLeft') - dateDiffInDays(new Date($this.data('addonCheckDate')), new Date());

			if (daysLeft < 0) {
				$this.closest('.mp-addon-state').removeClass().addClass('mp-addon-state expired');
			}

			$this.text(daysLeft);
		});

	}

	$(function() {

		$('.mp-addons-activation-form .activate-addons').on('click', function( event ) {
			event.preventDefault();

			var $button = $(this),
				$form = $button.closest('form'),
				licenseCredentials = $form.find(':input').serializeJSON({
					checkboxUncheckedValue: false,
				}),
				notify = $.sNotify({
					'icon': 'fa fa-circle-o-notch fa-spin fa-lg',
					'content': '<span>Activating ...</span>',
				});

				$button.attr('disabled', true);

				if (!licenseCredentials.email.length || !licenseCredentials.key.length) {
					notify.update('<span>License Email and Key is required</span>', 'fa fa-exclamation').close(4000);
					$button.attr('disabled', false);
					return;
				}

				Membership.ajax({
					'route': 'license.activate',
					'license': licenseCredentials,
				}, {'method': 'post'})
				.done(function(response) {
					if (response.success) {
						for (var id in response.addons) {

							var $addonRow = $('.mp-addons-table tr[data-addon-id="' + id + '"]');

								$addonRow.removeClass();
								$addonRow.addClass('mp-addon-state');
								$addonRow.addClass(response.addons[id].state);

							switch (response.addons[id].state) {
								case 'error':
									$addonRow.find('.addon-error').text(response.addons[id].error);
									break;
								case 'activated':
									$addonRow.find('.mp-addon-days-left').data('addonDaysLeft', response.addons[id].daysLeft);
									$addonRow.find('.mp-addon-days-left').data('addonCheckDate', response.addons[id].checkDate);
									break
							}
							
						}

						var responseMessage = [
							'Activated:',
							response.count.activated,
							'from Total:',
							response.count.total,
						];

						if (response.count.expired) {
							responseMessage.push('Expired:');
							responseMessage.push(response.count.expired);
						}

						if (response.count.errors) {
							responseMessage.push('Activation error:');
							responseMessage.push(response.count.errors);
						}

						updateExpireDays();
						notify.update('<span>' + responseMessage.join(' ') + '</span>', 'fa fa-check').close(2000);

						setTimeout(function() {
							notify.update('<span>Refreshing page..</span>', 'fa fa-circle-o-notch fa-spin fa-lg').close(5000);
							setTimeout(function() {
								document.location.reload();
							}, 3000);
						}, 1000);

					}
				})
				.fail(function(response) {
					console.error(response.responseJSON.message);
					notify.update('<span>' + response.responseJSON.message + '</span>', 'fa fa-circle-o-notch fa-spin fa-lg').close(4000);
				})
				.always(function() {
					$button.attr('disabled', false);
				});


		});

		updateExpireDays();

	});

}(jQuery, Membership));