(function($, Membership) {

	$(document).on('click', '.remove-size', function(event) {
		event.preventDefault();
		$(this).closest('.mp-option-sizes-input').fadeOut(function() {
			$(this).remove();
		});
	});

	var toggleOptions = [
		'#account-welcome-email',
		'#account-activation-email',
		'#pending-review-email',
		'#account-approved-email',
		'#account-rejected-email',
		'#account-deactivation-email',
		'#account-deleted-email',
		'#password-reset-email',
		'#password-changed-email',
		'#notification-friends-followers',
		'#message-recieve-notification',
		'#new-user-notification',
		'#account-needs-review-notification',
		'#account-deletion-notification',
	],
		$emailOptionsModal;

	$(function() {

		$(toggleOptions.join(',')).on('change', '[type="checkbox"]', function(event) {
			event.preventDefault();
			var id = $(event.delegateTarget).attr('id'),
				relatedElements = $('#' + id + '-subject, #' + id + '-body');

			if (this.value === 'true') {
                this.value = 'false';
			} else {
                this.value = 'true';
			}
		});

		$('.save-settings').on('click', function(event) {
			event.preventDefault();

			Membership.ajax({
				'route': 'mail.saveSettings',
				'settings': $('.mp-options :input').serializeJSON({
					checkboxUncheckedValue: false,
				})
			}, {'method': 'post'})
			.error(function(response) {
				console.error(response.responseJSON.message);
			});

		});

		// Email options modal
		$emailOptionsModal = (function() {
			var $emailOptionId,
				$emailOptionsModal = $('.edit-email-options-modal').sModal({
					width: 800,
					height: 400,
					buttons: [
						{
							content: '<i class="fa fa-times-circle"></i> Cancel',
							class: 'sc-button primary',
							event: function() {
								this.close();
							}
						},
						{
							content: '<i class="fa fa-refresh"></i> Update',
							class: 'sc-button primary update',
							event: function() {
								updateEmailOptions();
								$('.save-settings').trigger('click');
								this.close();
							}
						}
					]
				});

			function updateEmailOptions() {
				$('#' + $emailOptionId + '-subject').find('.mp-option-input input').val($emailOptionsModal.find('#email-subject-input').val());
				$('#' + $emailOptionId + '-body').find('.mp-option-input textarea').val($emailOptionsModal.find('#email-body-input').val());
			}

			function updateModalData(data) {
				$emailOptionId = data.id;
				$emailOptionsModal.find('#email-subject-label').html(data.title + ' Subject');
				$emailOptionsModal.find('#email-subject-label').attr('title', data.title + ' Subject');
				$emailOptionsModal.find('#email-subject-input').val(data.subject);

				$emailOptionsModal.find('#email-body-label').html(data.title + ' Body');
				$emailOptionsModal.find('#email-body-label').attr('title', data.title + ' Body');
				$emailOptionsModal.find('#email-body-input').val(data.body);
			}

			return $.extend($emailOptionsModal, {
				editEmailOptions: function(data) {
					updateModalData(data);
				}
			});
		})();
	});

	$(document).on('click', '.mp-option-setting-edit-button', function(event) {
		event.preventDefault();

		var emailOption = $(this).closest('.mp-option'),
			emailOptionId = emailOption.attr('id'),
			data = {
				id: emailOptionId,
				title: emailOption.find('.mp-option-label span').html(),
				subject: $('#' + emailOptionId + '-subject').find('.mp-option-input input').val(),
				body: $('#' + emailOptionId + '-body').find('.mp-option-input textarea').val()
			};

		$emailOptionsModal.editEmailOptions(data);
		$emailOptionsModal.open();
	});

	$(document).on('click', '.mp-option-setting-send-button', function(event) {
		event.preventDefault();

		var $this = $(this),
			id = $(this).closest('.mp-option').attr('id'),
			notify = $.sNotify({
				'icon': 'fa fa-circle-o-notch fa-spin fa-lg',
				'content': '<span>Sending ...</span>',
			});

		$this.attr('disabled', 'true');

		Membership.ajax({
			'route': 'mail.sendTestMail',
			'id': id
		}, {'method': 'post'})
			.done(function() {
				notify.update('<span>Sended</span>', 'fa fa-check').close(3000);
			})
			.fail(function(response) {
				console.log(response);
				notify.update('<span>Error ' + response.responseJSON.message + '</span>', 'fa fa-exclamation').close(3000);
			})
			.always(function(response) {
				//console.log('sets');
				//console.log(response);
				$this.removeAttr('disabled');
			});

	});

	$(document).on('click', '.mp-option-setting-reset-button', function(event) {
		event.preventDefault();

		var $this = $(this),
			id = $(this).closest('.mp-option').attr('id'),
			notify = $.sNotify({
				'icon': 'fa fa-circle-o-notch fa-spin fa-lg',
				'content': '<span>Resetting to default ...</span>',
			});

		$this.attr('disabled', 'true');

		Membership.ajax({
			'route': 'mail.getDefaultMailOptions',
			'template': id
		}, {'method': 'post'})
			.done(function(response) {
				$('#' + id + '-subject').find('.mp-option-input input').val(response.subject);
				$('#' + id + '-body').find('.mp-option-input textarea').val(response.message);
				notify.update('<span>Done</span>', 'fa fa-check').close(3000);
			})
			.fail(function() {
				notify.update('<span>Error</span>', 'fa fa-exclamation').close(3000);

			})
			.always(function(response) {
				//console.log('sets');
				//console.log(response);
				$this.removeAttr('disabled');
			});

	});

}(jQuery, Membership));