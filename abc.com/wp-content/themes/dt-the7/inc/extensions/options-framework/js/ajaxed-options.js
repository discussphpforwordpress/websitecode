(function ($) {
	"use strict";

	// Class that handles errors messages.
	var settingsError = (function() {
		function settingsError(noticeID, insertAfter) {
			this.insertAfterObj = $(insertAfter);
			this.noticeID = noticeID;
			this.noticeTplObj = $('<div id="'+noticeID+'" class="settings-error notice"></div>');
		}

		settingsError.prototype.addError = function(content, type) {
			if (!content) {
				return $();
			}

            $("html, body").animate({ scrollTop: 0}, 400);
            return this.noticeTplObj.clone().html(content).addClass(type).insertAfter(this.insertAfterObj);
		};

		settingsError.prototype.removeErrors = function() {
			$("#"+this.noticeID).remove();
		};

		settingsError.prototype.prepareMsg = function(msg) {
			return "<p><strong>" + msg + "</strong></p>";
		};

		return settingsError;
	}());

	var pageErrors = new settingsError("optionsframework-options-saved", "#optionsframework-wrap > h1");

	var Buttons = (function () {
		function Buttons(buttonsObj) {
			this.buttonsObj = buttonsObj;
			this.activeButton = null;
		}

		Buttons.prototype.setActiveButton = function(button) {
			this.activeButton = this.buttonsObj.filter(button);

			// Show busy text.
			var busyValue = this.activeButton.attr("data-busy-value");
			if (busyValue) {
				this.activeButton.data("originValue", this.activeButton.val());
				this.activeButton.val(busyValue);
			}

			// Keep button pressed.
			this.activeButton.addClass("active");

			// Prevent clicks.
			this.buttonsObj.addClass("busy");
		};

		Buttons.prototype.resetActiveButton = function() {
			if (!this.activeButton) {
				return false;
			}

			if (this.activeButton.data("originValue")) {
				// Reset button text.
				this.activeButton.val(this.activeButton.data("originValue"));
			}

			// Deactivate.
			this.activeButton.removeClass("active");

			this.activeButton = null;

			// Allow click.
			this.buttonsObj.removeClass("busy");

			return true;
		};

		return Buttons;
	}());

	var submitButtons = new Buttons( $("#optionsframework-submit input[type=submit]") );

	submitButtons.buttonsObj.on("click", function (e) {
		var $this = $(this);

		if ($this.is(".reset-button") && !confirm(optionsframework.resetMsg)) {
			e.preventDefault();
			return false;
		}

		if ($this.hasClass("busy")) {
			return false;
		}

		var spinnerClass = ".submit-spinner";
		if ($this.hasClass("button-secondary")) {
			spinnerClass = ".reset-spinner";
		}

		submitButtons.setActiveButton($this);
		pageErrors.removeErrors();
	});

	$("#optionsframework-form").ajaxForm({
        url: ajaxurl,
        type: "post",
        success: function (response) {
        	try {
                if (response.data.msg) {
                    response.data.msg = pageErrors.prepareMsg(response.data.msg);
                }

                if (response.success) {
                    var $error = pageErrors.addError(response.data.msg, "updated");
                    setTimeout(function () {
                        $error.fadeOut();
                    }, 5000);

                    if (submitButtons.activeButton.hasClass("of-reload-page-on-click")) {
                        window.location.reload(true);
                    }

                    if (response.data.redirectTo) {
                        window.location.assign(response.data.redirectTo);
                    }
                } else {
                    // Error handling here.
                    pageErrors.addError(response.data.msg, "error");
                }

                var previewIframe = document.getElementById('the7-customizer-preview');
                if (previewIframe) {
                    previewIframe.contentWindow.location.reload(true);
                }
            } catch (error) {
                pageErrors.addError(pageErrors.prepareMsg(optionsframework.serverErrorMsg), "error");
        		console.log(response, error);
			}

            submitButtons.resetActiveButton();
        },
        error: function(jqXHR) {
			pageErrors.addError(pageErrors.prepareMsg(optionsframework.serverErrorMsg), "error");
			submitButtons.resetActiveButton();
			console.log(jqXHR.statusText, jqXHR.responseText);
		},
	});
})(jQuery);
