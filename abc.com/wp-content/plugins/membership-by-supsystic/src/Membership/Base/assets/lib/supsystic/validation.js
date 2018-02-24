 (function($, Membership) {


	function hideFormErrors($form) {
		$form.find('.tooltipstered').each(function() {
			hideError($(this));
		});
	}

	function showError($el, errors) {
		$el.tooltipster('content', errors.join('<br>'));
		$el.tooltipster('show');
		$el.removeClass('success').addClass('error');
	}

	function hideError($el) {
		$el.tooltipster('hide');
		$el.removeClass('error').addClass('success');
	}

	Membership.validateForm = function($form, formData, validationRules) {

		var errors = validate(
				formData,
				validationRules,
				{fullMessages: false}
			),
			self = this;

		if (!errors) {
			hideFormErrors($form);
			return true;
		}

		console.log(errors);

		for (var name in errors) {

			var $el = $form.find('[data-name="' + name + '"]');

			if (!$el.hasClass('tooltipstered')) {

				$el.tooltipster({
					position: 'top-left',
					trigger: 'custom'
				}).on('change input', function() {
					var $this = $(this),
						name = $this.attr('name'),
						constraints = {};
						constraints[name] = validationRules[name];

					var validation = self.validate($form.serializeJSON(), constraints, {fullMessages: false});

					validation.success(function() {
						hideError($this);
					}).error(function(validation) {
						showError($el, validation[name]);
					});
				});
			}

			showError($el, errors[name]);

		}

		return false;
	};

	Membership.validate = function(attributes, constraints, options) {
		var validation;

		if (typeof attributes == 'string') {
			validation = validate.single(attributes, constraints, options);
		} else {
			validation = validate(attributes, constraints, options);
		}
		
		return {
			success: function(fn) {
				if (!validation) {
					fn.call(this);
				}
				return this;
			},
			error: function(fn) {
				if (validation) {
					fn.call(this, validation);
				}
				return this;
			}
		};
	};
	
	window.Membership = Membership;

})(jQuery, window.Membership || {});


