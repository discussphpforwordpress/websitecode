(function($, Membership) {

	$(function() {

		var cp = $('.mp-option-color-input .sc-input').colorPicker({
			buildCallback: function($elm) {
				var colorInstance = this.color,
					colorPicker = this,
					random = function(n) {
						return Math.round(Math.random() * (n || 255));
					};

				$elm.append('<div class="cp-memory">' + Array(9).join("<div></div>") + '<div class="cp-store">Store Color</div></div>')
				.on('click', '.cp-memory div', function(e) {
					var $this = $(this);

					if (this.className) {
						$this.parent().prepend($this.prev()).children().eq(0).
							css('background-color', '#' + colorInstance.colors.HEX);
					} else {
						colorInstance.setColor($this.css('background-color'));
						colorPicker.render();
					}
				}).find('.cp-memory div').each(function() {
					!this.className && $(this).css({background:
						'rgb(' + random() + ', ' + random() + ', ' + random() + ')'
					});
				});
			},

			positionCallback: function($elm) {
				var $UI = this.$UI,
					$window = $(window),
					position = $elm.offset(),
					gap = this.color.options.gap,
					top = 0,
					left = 0;

					if (($window.height() - (position.top - window.pageYOffset)) < $UI._height) {
						top = position.top - $UI._height
					} else {
						top = position.top + $elm.outerHeight();
					}

				return { 
					left: position.left,
					top: top
				}
			},
			gap: 4,
			GPU: true,
			scrollResize: true,
		});

		$('.save-settings').on('click', function(event) {
			event.preventDefault();
			Membership.ajax({
				'route': 'design.saveSettings',
				'settings': $('.mp-options :input').serializeJSON({
					checkboxUncheckedValue: false,
				})
			}, {'method': 'post'})
			.error(function(response) {
				console.error(response.responseJSON.message);
			});
		});

		$('input[name="members[show-load-more-button]"]').on('click', function(event) {
			if ($(this).prop('checked')) {
				$('input[name="members[show-pages]"][value="false"]').prop('checked', true);
			}
		});

		$('input[name="members[show-pages]"]').on('click', function(event) {
			if ($(this).prop('checked')) {
				$('input[name="members[show-load-more-button]"][value="false"]').prop('checked', true);
			}
		});

		var $loginGoogleRecaptchaEnable = $('[name="auth[login-google-recaptcha-enable]"]');

		function toggleLoginGoogleRecaptchaSettings(value) {
			if (value === 'false') {
				$('.login-google-recaptcha-settings').fadeOut();
			} else {
				$('.login-google-recaptcha-settings').fadeIn();
			}
		}

		$loginGoogleRecaptchaEnable.on('change', function() {
			toggleLoginGoogleRecaptchaSettings(this.value);
		});

		toggleLoginGoogleRecaptchaSettings($loginGoogleRecaptchaEnable.filter(':checked').val());
	});

	function mbsDesignSettings() {

	}

	mbsDesignSettings.prototype.init = (function() {
		var $logoutCheckedCheckbox
		,	$logoutCheckbox = $('#add-logout-link .sc-radio input[name="menu[add-logout-link]"]')
		,	$logoutMenuListRow = $('.logoutMenuListRow');

		$logoutCheckbox.on('change', function() {
			$logoutCheckedCheckbox = $('#add-logout-link .sc-radio input[name="menu[add-logout-link]"][value="true"]:checked');
			if($logoutCheckedCheckbox.length) {
				$logoutMenuListRow.removeClass('mbs-hidden');
			} else {
				$logoutMenuListRow.addClass('mbs-hidden');
			}
		});
		$logoutCheckbox.trigger('change');

		this.initActivityTab();
	});

	mbsDesignSettings.prototype.initActivityTab = (function() {
		var $shareOption = $('input[type="radio"][name="activity[type][shares]"]')
		,	$friendPostOn = $('#activityTypesFriendPostOn')
		,	$friendPostOnInput = $('input[name="activity[type][friendPostOn]"]')
		,	$friendPostFrontendSettOn = $('#activityTypesFriendPostInFrontendOn');

		function visibilitySharesOption() {
			if($('input[type="radio"][name="activity[type][shares]"][value="true"]:checked').length) {
				$friendPostOn.removeClass('mbs-hidden');
				visibilityFriendPostOnOpt();
			} else {
				$friendPostOn.addClass('mbs-hidden');
				$friendPostFrontendSettOn.addClass('mbs-hidden');
			}
		}
		function visibilityFriendPostOnOpt() {
			if($friendPostOnInput.is(':checked')) {
				$friendPostFrontendSettOn.removeClass('mbs-hidden');
			} else {
				$friendPostFrontendSettOn.addClass('mbs-hidden');
			}
		}

		$friendPostOnInput.on('change', visibilityFriendPostOnOpt);
		$shareOption.on('change', visibilitySharesOption);

		visibilitySharesOption();
	});

	$(document).ready(function() {
		var designSettings = new mbsDesignSettings();
		designSettings.init();
	});

}(jQuery, Membership));