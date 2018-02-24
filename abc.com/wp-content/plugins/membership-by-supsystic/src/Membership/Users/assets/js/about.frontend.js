(function($, Membership) {

	$('.about-tabs .item').mpTab();
	var $fields = $('.mp-field'),
		$dateFields = $fields.find('.date-field');

	if ($dateFields.length) {
		$dateFields.each(function () {
			var $dateField = $(this),
				$realField = $dateField.next();

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

	$fields.find('select.dropdown').mpDropdown();


	function Field($field) {

		this.$el = $field;
		this.type = $field.attr('data-field-type');
		this.name = $field.attr('data-field-name');

		var self = this;

		$field.find('.field-edit-action').on('click', function () {
			self.editAction()
		});
	}

	Field.prototype.editAction = function() {

		var self = this,
			$fieldData = this.$el.find('.mp-field-data'),
			$fieldEdit = this.$el.find('.mp-field-edit'),
			$actionButtons = $fieldEdit.find('.edit-action-buttons button'),
			$saveActionButton = $actionButtons.filter('.save-action'),
			$cancelActionButton = $actionButtons.filter('.cancel-action'),
			storedCurrentFieldData = this.getFieldData();

		$fieldEdit.show();
		$fieldData.hide();

		$saveActionButton.off('click').on('click', function () {
			$saveActionButton.addClass('loading');
			$actionButtons.attr('disabled', true).addClass('disabled');
			var fieldData = self.getFieldData();

			self.updateField(fieldData);

			Membership.api.users.saveField({
				fieldName: self.name,
				fieldData: fieldData
			}).then(function() {
				$actionButtons.removeAttr('disabled').removeClass('disabled loading');
				$fieldEdit.hide();
				$fieldData.show();
			});

		});

		$cancelActionButton.off('click').on('click', function () {
			self.setFieldData(storedCurrentFieldData);
			$actionButtons.removeAttr('disabled').removeClass('disabled loading');
			$fieldEdit.hide();
			$fieldData.show();
		});
	};

	Field.prototype.getFieldData = function() {

		var data,
			$editContainer = this.$el.find('.mp-field-edit');

		switch (this.type) {
			case 'text':
			case 'email':
			case 'password':
			case 'numeric':
				data = $editContainer.find('input').val();
				break;
			case 'date':
				data = $editContainer.find('input[type="hidden"]').val();
				break;
			case 'drop':
				data = $editContainer.find('select').val();
				break;
			case 'checkbox':
				data = [];
				$editContainer.find('input:checked').each(function() {
					data.push(this.value);
				});
				break;
			case 'scroll':
				data = [];
				$editContainer.find('select option:selected').each(function() {
					data.push(this.value);
				});
				break;
			case 'radio':
				data = $editContainer.find('input:checked').attr('value');
				break;
		}

		return data;
	};

	Field.prototype.setFieldData = function(data) {

		var $editContainer = this.$el.find('.mp-field-edit');

		switch (this.type) {
			case 'text':
			case 'email':
			case 'password':
			case 'numeric':
				this.$el.find('.mp-field-edit input').val(data);
				break;
			case 'date':
				this.$el.find('.mp-field-edit input[type="hidden"]').val(data);
				break;
			case 'drop':
				this.$el.find('.mp-field-edit select').val(data);
				break;
			case 'checkbox':
				$editContainer.find('input').prop('checked', false);
				data.forEach(function (el) {
					$editContainer.find('input[value="' + el + '"]').prop('checked', true);
				});
				break;
			case 'scroll':
				$editContainer.find('select option').prop('selected', false);
				data.forEach(function (el) {
					$editContainer.find('select option[value="' + el + '"]').prop('selected', true);
				});
				break;
			case 'radio':
				$editContainer.find('input').prop('selected', false);
				$editContainer.find('input[value="' + data + '"]').prop('selected', true);
				break;
		}
	};

	Field.prototype.updateField = function(data) {

		var $fieldDataContainer = this.$el.find('.mp-field-data p'),
			$editContainer = this.$el.find('.mp-field-edit'),
			title = [];

		switch (this.type) {
			case 'text':
			case 'email':
			case 'password':
			case 'numeric':
				$fieldDataContainer.text(data);
				break;
			case 'date':
				var dateFieldInput = $editContainer.find('.date-field'),
					format = dateFieldInput.attr('data-format');

				$fieldDataContainer.text(moment(data).format(format));
				break;
			case 'drop':
				$fieldDataContainer.text($editContainer.find('select option[value="' + data + '"]').text());
				break;
			case 'checkbox':
				data.forEach(function (el) {
					title.push($editContainer.find('input[value="' + el + '"]').next().text());
				});
				$fieldDataContainer.text(title.join(' • '));
				break;
			case 'scroll':
				$editContainer.find('select option:selected').each(function() {
					title.push($(this).text());
				});

				$fieldDataContainer.text(title.join(' • '));
				break;
			case 'radio':
				$fieldDataContainer.text(
					$editContainer.find('input:checked').next().text()
				);
				break;
		}
	};

	$fields.each(function() {
		new Field($(this));
	});

})(jQuery, Membership);