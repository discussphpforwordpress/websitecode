(function ($, Membership) {

	var userStatus = {
		STATUS_DELETED: -4,
		STATUS_REJECTED: -3,
		STATUS_DISABLED: -2,
		STATUS_PENDING_REVIEW: -1,
		STATUS_ACTIVE: 0
	};

    $(function() {

        var $reportsTable = $('.sc-table.reports'),
			translate = JSON.parse($reportsTable.attr('data-translate')),
			$activityReportDetailsModal = $('.activity-report-details-template').sModal({
				width: '800px',
				height: '90%',
				buttons: [
					{
						content: '<i class="fa fa-eye"></i> ' + translate['Mark as read and close'],
						class: 'sc-button primary mark-as-read',
						event: function() {
							setReportStatus(this.report, 'viewed', translate['Read']);
							this.close();
						}
					},
					{
						content: '<i class="fa fa-eye-slash"></i> ' + translate['Mark as unread and close'],
						class: 'sc-button primary mark-as-unread',
						event: function() {
							setReportStatus(this.report, 'new', translate['Unread']);
							this.close();
						}
					},
					{
						content: '<i class="fa fa-times-circle"></i> '  + translate['Close'],
						class: 'sc-button primary',
						event: function() {
							this.close();
						}
					}
				]
			}),
			$userReportDetailsModal = $('.user-report-details-template').sModal({
					width: '800px',
					height: '90%',
					buttons: [
						{
							content: '<i class="fa fa-eye"></i> ' + translate['Mark as read and close'],
							class: 'sc-button primary mark-as-read',
							event: function() {
								setReportStatus(this.report, 'viewed', translate['Read']);
								this.close();
							}
						},
						{
							content: '<i class="fa fa-eye-slash"></i> ' + translate['Mark as unread and close'],
							class: 'sc-button primary mark-as-unread',
							event: function() {
								setReportStatus(this.report, 'new', translate['Unread']);
								this.close();
							}
						},
						{
							content: '<i class="fa fa-times-circle"></i> '  + translate['Close'],
							class: 'sc-button primary',
							event: function() {
								this.close();
							}
						}
					]
				}),
			$sendMessageModal = $('.send-message-modal').sModal({
					width: '25%',
					height: '90%',
					buttons: [
						{
							content: '<i class="fa fa-send"></i> Send',
							class: 'sc-button primary send',
							event: function() {
								this.$buttons.find('button').attr('disabled', true);

								var modal = this,
									notify = $.sNotify({
									'icon': 'fa fa-circle-o-notch fa-spin fa-lg',
									'content': '<span>Sending ...</span>'
								});

								Membership.api.messages.sendMessageToUser({
									userId: this.recipientId,
									message: this.find('.message-input').val()
								}).then(function(response) {

									modal.$buttons.find('button').removeAttr('disabled');

									if (response.success) {
										notify.update('<span>Message was sent successfully.</span>', 'fa fa-check').close(3000);
										modal.find('.message-input').val('');
										modal.close();
									} else {
										notify.update('<span>Error. </span>' + response.message, 'fa fa-exclamation').close(3000);
									}

								});
							}
						},
						{
							content: '<i class="fa fa-times-circle"></i> Close',
							class: 'sc-button primary',
							event: function() {
								this.find('.message-input').val('');
								this.close();
							}
						}
					]
				});


		function setReportStatus(report, status, title) {
			var reportRow = $reportsTable.find('tr[data-report-id="' + report.id + '"]');

			reportRow.find('.status').text(title);

			Membership.ajax({
				route: 'reports.setStatus',
				data: {
					id: report.id,
					status: status
				}
			}, {method: 'post'});

			report.status = status;

			updateReportDataAttribute(report)
		}

        $('.report-details').on('click', function(event) {
            event.preventDefault();

            var reportRow = $(this).closest('tr'),
                data = JSON.parse(reportRow.attr('data-report')),
				$modal,
                modalContainer;

			switch (data.content_type) {
				case 'activity':
					$modal = $activityReportDetailsModal;
					break;
				case 'user':
					$modal = $userReportDetailsModal;
					break;
			}

			$modal.report = data;

			modalContainer = $modal.closest('.sc-modal-container');

			/**
			 * Report date
			 */
			$modal.find('.report-date').html(data.date);

			/**
			 * Reporter data and buttons
			 */
			if (data.reporter) {
				var reporter = $('<a>')
						.attr('href', data.reporter.url)
						.attr('target', '_blank')
						.text(data.reporter.displayName),
					sendReporterMessageButton = $modal.find('.report-reporter button.send-message'),
					blockReporterButton = $modal.find('.report-reporter button.block-user'),
					unblockReporterButton = $modal.find('.report-reporter button.unblock-user');

				$modal.find('.report-reporter-link').html(reporter);
				$modal.find('.report-reporter button').hide();

				if (data.reporter.user_status == userStatus.STATUS_ACTIVE) {
					sendReporterMessageButton.show();
					blockReporterButton.show();
				}

				if (data.reporter.user_status == userStatus.STATUS_DISABLED) {
					unblockReporterButton.show();
				}

				sendReporterMessageButton.off('click').on('click', function() {
					openSendMessageModal(data.reporter.id, reporter.clone());
				});

				/**
				 * Block reporter
				 */
				blockReporterButton.off('click').on('click', function() {
					blockUser(data.reporter, data, {
						sendMessageButton: sendReporterMessageButton,
						blockButton: blockReporterButton,
						unblockButton: unblockReporterButton,
					});
				});

				/**
				 * Unblock reporter
				 */
				unblockReporterButton.off('click').on('click', function() {
					unblockUser(data.reporter, data, {
						sendMessageButton: sendReporterMessageButton,
						blockButton: blockReporterButton,
						unblockButton: unblockReporterButton
					});
				});
			} else {
				$modal.find('.report-reporter-link').html(translate['User is not found']);
				$modal.find('.report-reporter button').hide();
			}


			/**
			 * Reported user or activity data and buttons
			 */

			var reportedUser;

			if (data.reported) {
				if (data.content_type === 'user') {
					reportedUser = data.reported;
				}

				if (data.content_type === 'activity') {
					reportedUser = data.reported.author;
				}
			}

			if (reportedUser) {


				/**
				 * Reported activity data and buttons
				 */
				if (data.content_type === 'activity') {

					$modal.find('.report-content .content-data').html(data.reported.data);
					$modal.find('.reported-activity-link').html($('<a>')
						.attr('href', data.reported.url)
						.attr('target', '_blank')
						.text('Link'));

					var $blockActivityButton = $modal.find('.block-activity').hide(),
						$unblockActivityButton = $modal.find('.unblock-activity').hide();

					if (data.reported.status == 'active') {
						$blockActivityButton.show();
					}

					if (data.reported.status == 'blocked') {
						$unblockActivityButton.show();
					}

					$blockActivityButton.off('click').on('click', function() {

						var notify = $.sNotify({
							'icon': 'fa fa-circle-o-notch fa-spin fa-lg',
							'content': '<span>Blocking activity ...</span>'
						});

						$blockActivityButton.attr('disabled', true);

						Membership.ajax({
							route: 'activity.setStatus',
							activityId: data.reported.id,
							status: 'blocked'
						}, {method: 'post'}).then(function(response) {

							if (response.success) {
								notify.update('<span>Activity blocked.</span>', 'fa fa-check').close(3000);
								$unblockActivityButton.show();
								$blockActivityButton.hide();
								data.reported.status = 'blocked';
								updateReportDataAttribute(data);
							} else {
								notify.update('<span>Error. </span>' + response.message, 'fa fa-exclamation').close(3000);
							}

							$blockActivityButton.removeAttr('disabled');
						});
					});

					$unblockActivityButton.off('click').on('click', function() {

						var notify = $.sNotify({
							'icon': 'fa fa-circle-o-notch fa-spin fa-lg',
							'content': '<span>Unblocking activity ...</span>'
						});


						$blockActivityButton.attr('disabled', true);

						Membership.ajax({
							route: 'activity.setStatus',
							activityId: data.reported.id,
							status: 'active'
						}, {method: 'post'}).then(function(response) {

							if (response.success) {
								notify.update('<span>Activity unblocked.</span>', 'fa fa-check').close(3000);
								$unblockActivityButton.hide();
								$blockActivityButton.show();
								data.reported.status = 'active';
								updateReportDataAttribute(data);
							} else {
								notify.update('<span>Error. </span>' + response.message, 'fa fa-exclamation').close(3000);
							}

							$blockActivityButton.removeAttr('disabled');
						});
					});
				}

				var reported = $('<a>')
						.attr('href', reportedUser.url)
						.attr('target', '_blank')
						.text(reportedUser.displayName),
					sendReportedMessageButton = $modal.find('.report-reported button.send-message'),
					blockReportedButton = $modal.find('.report-reported button.block-user'),
					unblockReportedButton = $modal.find('.report-reported button.unblock-user');

				$modal.find('.report-reported-link').html(reported);
				$modal.find('.report-reported button').hide();

				if (reportedUser.user_status == userStatus.STATUS_ACTIVE) {
					sendReportedMessageButton.show();
					blockReportedButton.show();
				}

				if (reportedUser.user_status == userStatus.STATUS_DISABLED) {
					unblockReportedButton.show();
				}

				sendReportedMessageButton.off('click').on('click', function() {
					openSendMessageModal(reportedUser.id, reported.clone());
				});

				/**
				 * Block reported
				 */
				blockReportedButton.off('click').on('click', function() {
					blockUser(reportedUser, data, {
						sendMessageButton: sendReportedMessageButton,
						blockButton: blockReportedButton,
						unblockButton: unblockReportedButton
					});
				});

				/**
				 * Unblock reported
				 */
				unblockReportedButton.off('click').on('click', function() {
					unblockUser(reportedUser, data, {
						sendMessageButton: sendReportedMessageButton,
						blockButton: blockReportedButton,
						unblockButton: unblockReportedButton
					});
				});

			} else {

				$modal.find('.report-reported button').hide();
				$modal.find('.report-reported-link').html(translate['User is not found']);

				if (data.content_type === 'activity') {
					$modal.find('.report-reported-activity button').hide();
					$modal.find('.reported-activity-link').html(translate['Activity is not found']);
				}
			}


			$modal.find('.report-comment').html(data.comment);

			/**
			 * Modal marks as read/unread buttons
			 */
			modalContainer.find('.mark-as-read, .mark-as-unread').hide();

			if (data.status !== 'new') {
				$modal.find('.report-status').html(translate['Read']);
				modalContainer.find('.mark-as-unread').show();
			} else {
				modalContainer.find('.mark-as-read').show();
				$modal.find('.report-status').html(translate['Unread']);
			}
			
			$modal.open();
        });

        function openSendMessageModal(recipientId, recipientName) {
			$sendMessageModal.find('.message-recipient').html(recipientName);
			$sendMessageModal.recipientId = recipientId;
			$sendMessageModal.open();
		}

		function blockUser(user, data, buttons) {

			var notify = $.sNotify({
				'icon': 'fa fa-circle-o-notch fa-spin fa-lg',
				'content': '<span>Blocking user ...</span>'
			});

			buttons.blockButton.attr('disabled', true);

			return Membership.ajax({
				route: 'users.setStatus',
				userId: user.id,
				status: 'disabled'
			}, {method: 'post'}).then(function(response) {

				if (response.success) {
					notify.update('<span>' + response.message + '</span>', 'fa fa-check').close(3000);
					buttons.sendMessageButton.hide();
					buttons.unblockButton.show();
					buttons.blockButton.hide();
					user.user_status = userStatus.STATUS_DISABLED;
					updateReportDataAttribute(data);
				} else {
					notify.update('<span>Error. </span>' + response.message, 'fa fa-exclamation').close(3000);
				}

				buttons.blockButton.removeAttr('disabled');

				return response;
			});

		}

		function unblockUser(user, data, buttons) {

			var notify = $.sNotify({
				'icon': 'fa fa-circle-o-notch fa-spin fa-lg',
				'content': '<span>Unblocking user ...</span>'
			});

			buttons.unblockButton.attr('disabled', true);

			return Membership.ajax({
				route: 'users.setStatus',
				userId: user.id,
				status: 'active'
			}, {method: 'post'}).then(function(response) {

				if (response.success) {
					notify.update('<span>' + response.message + '</span>', 'fa fa-check').close(3000);
					buttons.unblockButton.hide();
					buttons.sendMessageButton.show();
					buttons.blockButton.show();
					user.user_status = userStatus.STATUS_ACTIVE;
					updateReportDataAttribute(data);
				} else {
					notify.update('<span>Error. </span>' + response.message, 'fa fa-exclamation').close(3000);
				}

				buttons.unblockButton.removeAttr('disabled');

				return response;
			});
		}
		
		function updateReportDataAttribute(data) {
			$reportsTable.find('tr[data-report-id="' + data.id + '"]').attr('data-report', JSON.stringify(data));
		}
		
    });


})(jQuery, Membership);