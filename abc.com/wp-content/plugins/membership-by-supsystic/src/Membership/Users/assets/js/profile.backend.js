(function ($, Membership) {
	'use strict';

	var unsavedChanges = false,
		fieldNames = [],
		sections = [],
		fModal,
		generateFieldName = function(name) {
			/**
			 * replace here "." symbol because validate.js has false positive when "." presence in attribute name
			 * also replace '"+<>;() symbols because many hosting has enabled suhosin security extension.
			 * And if input $_POST data key contains one of those symbols then element will be removed from $_POST data
			 * also if field has "required" then server side validation return errors
			 */
			name = name.toLowerCase().replace(/[\s.'"+<>;()]/g, '_');
			var index = 1;
			var nameCache = name;
			while (fieldNames.indexOf(name) !== -1) {
				name = nameCache + '-' + index;
				index++;
			}
			fieldNames.push(name);
			return name;
		},
		createField = function(data) {

			var $field = $('.mp-fields-template .mp-field').clone(),
				$instance;

			$field.on('click', '.mp-field-remove-button', function() {
				$field.remove();
				unsavedChanges = true;
			});

			if (data.name == 'user_email') {
				$field.find('input[type="checkbox"]').attr('disabled', 'disabled');
				$field.find('select').attr('disabled', 'disabled');
			}

			if ($.inArray(data.section, sections) === -1) {
				createSection(data.section);
			}

			$('.mp-section[data-section="' + data.section + '"] .fields-list').append($field);

			updateField($field, data);

			$field.fadeIn();
			fieldNames.push(data.name);

			$field.on('change', ':input', function(event) {
				event.preventDefault();
				var $this = $(this),
					fieldData = JSON.parse($field.attr('data-field')),
					fieldName = $this.attr('name'),
					newValue = $this.serializeJSON({
						checkboxUncheckedValue: false,
						parseBooleans: true,
						parseNumbers: true,
					});

				updateFieldData($field, $.extend(fieldData, newValue));
			});
			// Limit system fields manipulations
			if(parseInt(data.sys)) {
				$field.find('.mp-field-remove-button').remove();
				if(data.name == 'email') {
					$field.find('input[name="enabled"], input[name="required"], input[name="registration"]').attr('disabled', 'disabled');
				}
			}
		},
		updateField = function($field, data) {
			var fieldData = $field.attr('data-field') && JSON.parse($field.attr('data-field'));

			if (fieldData && fieldData.section !== data.section) {
				$field.appendTo($('.mp-section[data-section="' + data.section + '"] .fields-list'));
			}

			$field.find('[name="label"]').val(data.label);
			$field.find('[name="type"]').val(data.type);
			$field.find('[name="required"]').attr('checked', data.required);
			$field.find('[name="registration"]').attr('checked', data.registration);
			$field.find('[name="enabled"]').attr('checked', data.enabled);


			//Merge data and fieldData
            var mergedData = null;
            if(fieldData === undefined){
                mergedData = data;
            }else{
                mergedData = Object.assign(fieldData, data);
            }
			$field.attr('data-field', JSON.stringify(mergedData));
		},
		updateFieldData = function($field, data) {
			$field.attr('data-field',
				JSON.stringify(
					$.extend(JSON.parse($field.attr('data-field')), data)
				)
			);
			unsavedChanges = true;
		},
		validateSection = function(sectionName) {
			return Membership.validate(sectionName, {
				presence: {
					message: 'Section can\'t be blank'
				},
				exclusion: {
					within: sections,
					message: "Section %{value} already exists."
				}
			});
		},
		createSection = function(sectionName) {

			validateSection(sectionName).success(function() {

				$('.add-section-modal .section-name + .error-msg').fadeOut();

				var $section = $('.mp-section-template').children().fadeIn().clone();
				$section.attr('data-section', sectionName);
				$section.find('.mp-section-title-input').val(sectionName);
				$section.appendTo('.mp-fields-container');

				$section.find('.fields-list').sortable({
					helper: 'clone',
					handle: '.mp-field-drag-handler',
					connectWith: '.mp-section-container .fields-list',
					delay: 150,
					opacity: 0.9,
					cursor: 'move',
					revert: 100,
					items: 'tr:not(.fields-list-placeholder)',
					appendTo: document.body,
					receive: function(event, ui) {
						updateFieldData(ui.item, {section: $section.attr('data-section')});
					}
				});

				sections.push(sectionName);

			}).error(function(messages) {
				$('.add-section-modal .section-name + .error-msg')
					.text(messages[0])
					.fadeIn();
				throw new Error('Validation error');
			});
		},
		updateSection = function(event) {

			if (event.type === 'keyup' && event.which !== 13) {
				return;
			}

			var $this = $(this),
				$section = $this.closest('.mp-section'),
				newSectionName = $this.val(),
				oldSectionName = $section.attr('data-section');

			if (newSectionName !== oldSectionName ) {
				validateSection(newSectionName).success(function() {

					sections.splice(sections.indexOf(oldSectionName), 1, newSectionName);
					$section.attr('data-section', newSectionName);

					$section.find('.mp-field').each(function() {
						updateFieldData($(this), { section: newSectionName });
					});

					unsavedChanges = true;

				}).error(function(messages) {
					$.sNotify({
						'icon': 'fa fa-exclamation-triangle',
						'content': messages[0],
						'delay': 3000
					});
					$this.focus();
				});
			}
		},
		removeSection = function(event) {
			event.preventDefault();
			var $sections = $('.mp-fields-container .mp-section');

			if ($sections.length > 1) {
				var $section = $(event.target).closest('.mp-section'),
					index = $section.index(),
					$insertToSection;

				if (index > 0) {
					$insertToSection = $sections.eq(index - 1);
				} else {
					$insertToSection = $sections.eq(index + 1);
				}

				$section.find('.mp-field')
					.hide()
					.appendTo($insertToSection.find('.fields-list'))
					.fadeIn()
					.each(function() {
						updateFieldData($(this), { section: $insertToSection.attr('data-section') });
					});

				sections.splice(sections.indexOf($section.attr('data-section')), 1);

				$section.fadeOut().remove();
				unsavedChanges = true;
			} else {
				$.sNotify({
					'icon': 'fa fa-exclamation-triangle',
					'content': 'You must have at least one section',
					'delay': 3000
				});
			}
		};


	$(document).on('blur keyup', '.mp-section-title-input', updateSection);
	$(document).on('click', '.mp-section .mp-section-remove', removeSection);

	// Document ready
	$(function() {

		fModal = (function() {

			var $addFieldOptionButton,
				$editField,
				$fieldModal = $('.edit-field-modal').sModal({
					width: 550,
					height: 550,
					buttons: [
						{
							content: '<i class="fa fa-times-circle"></i> Cancel',
							class: 'sc-button primary',
							event: function() {
								this.close();
							}
						},
						{
							content: '<i class="fa fa-refresh"></i> Update Field',
							class: 'sc-button primary update',
							event: function() {
								updateField($editField, collectFieldData());
								unsavedChanges = true;
								this.close();
							}
						},
						{
							content: '<i class="fa fa-plus-circle"></i> Add Field',
							class: 'sc-button primary add',
							event: function(modal) {
								createField(collectFieldData());
								unsavedChanges = true;
								this.close();
							}
						}
					]
				}),
				$fieldTypesSelect = $fieldModal.find('.field-type'),
				$fieldSectionSelect = $fieldModal.find('.field-section'),
				$fieldOption = $fieldModal.find('.option-template .option');

			function collectFieldData() {
				var field = $fieldModal.find(':input:visible')
					.serializeJSON({
						checkboxUncheckedValue: false,
						parseBooleans: true,
					})
				,	dataFieldName = $fieldModal.attr('data-field-name')
				,	dataFieldType = $fieldModal.attr('data-field-type')
				,	isUserRoleField = (dataFieldName == 'user_role') && (dataFieldType == 'drop');
				;

				if (field.options) {
					if(!isUserRoleField) {
						for (var i = 0; i < field.options.length; i++) {
							var name = field.options[i],
								checked = false;

							if(validate.isArray(field['selected-options']) &&
								field['selected-options'][0] === name) {
								// Radio
								checked = true;
							} else if(validate.isObject(field['selected-options']) &&
								field['selected-options'][name]) {
								// Checkbox
								checked = true;
							}

							field.options[i] = {
								name: name,
								checked: checked,
								id: name.toLowerCase().replace(/\s/g, '_')
							};
						}
					} else {
						var $inputsOpt = $fieldModal.find(':input[name="options[]"]:visible')
						,	ind = 0;
						if($inputsOpt.length) {

							$inputsOpt.each(function(ind, oneOptItem) {
								var $oneOptItem = $(oneOptItem);
								field.options[ind] = {
									'name': $oneOptItem.val(),
									'checked': false,
									id: $oneOptItem.attr('data-id'),
								};
								ind++;
							});
						}
					}
				}

				delete field['selected-options'];

				Membership.validate(field.label, {
					presence: {
						message: 'Label can\'t be blank'
					}
				}).success(function() {
					$fieldModal
						.find('.field-label')
						.next('.error-msg')
						.fadeOut();
				}).error(function(messages) {
					$fieldModal
						.find('.field-label')
						.next('.error-msg')
						.text(messages[0])
						.fadeIn();
				});

				if ($editField) {
					var fieldData = JSON.parse($editField.attr('data-field'));

					if (field.label !== fieldData.label) {
						fieldNames.splice(fieldNames.indexOf(fieldData.name), 1);
						field.name = generateFieldName(field.label);
					} else {
						field.name = fieldData.name;
					}

				} else {
					field.name = generateFieldName(field.label);
				}
				return field;
			}

			function createOption(optionName, checked) {
				checked = checked || false;
				var $option = $fieldOption.clone(true, true);

				$option.on('click', '.remove-option', function(event) {
					event.preventDefault();
					$(this).closest('.option').remove();
				});

				$option.find('input[type="checkbox"]')
					.attr({
						name: 'selected-options[' + optionName + ']',
						checked: checked
					});

				$option.find('input[type="radio"]')
					.attr({
						value: optionName,
						checked: checked
					});

				$option
					.find('[name="options[]"]')
					.val(optionName);

				return $option;
			}
			function createUserRoleOption(oneOptionData) {
				var $option = $fieldOption.clone(true, true)
				,	$textInput = $option.find('[name="options[]"]')
				;
				// remove default Trash icon
				$option.find('.remove-option').remove();
				// turn off Default value
				$option.find('input[type="radio"]').prop('disabled', true);

				$textInput.val(oneOptionData['name']);
				$textInput.attr('data-id', oneOptionData['id']);
				$textInput.prop('readonly', true);

				return $option;
			}

			// Field types select
			$fieldTypesSelect.on('change', function(event) {
				event.preventDefault();

				if (['scroll', 'checkbox'].indexOf(this.value) !== -1) {
					$('.field-options-container').fadeIn();
					$fieldModal
						.find('.seleceted-options-state')
						.removeClass('sc-radio')
						.addClass('sc-checkbox')
						.find('.seleceted-options-input-state')
						.removeClass('sc-radio-state')
						.addClass('sc-checkbox-state');

					$fieldModal.find('.seleceted-options-state input[type="checkbox"]')
					.each(function() {
						var $input = $(this);
						$input.prependTo($input.parent());
					});

				} else if (['drop', 'radio',].indexOf(this.value) !== -1) {
					$('.field-options-container').fadeIn();
					$fieldModal
						.find('.seleceted-options-state')
						.removeClass('sc-checkbox')
						.addClass('sc-radio')
						.find('.seleceted-options-input-state')
						.removeClass('sc-checkbox-state')
						.addClass('sc-radio-state');

					$fieldModal.find('.seleceted-options-state input[type="radio"]')
					.each(function() {
						var $input = $(this);
						$input.prependTo($input.parent());
					});

				} else {
					$('.field-options-container').fadeOut();
				}

				$fieldModal
					.find('.field-options')
					.fadeOut()
					.filter('.field-' + this.value)
					.fadeIn();
			});

			// Add new field option
			$addFieldOptionButton = $fieldModal.find('.add-field-option')
				.on('click',  function(event) {
					event.preventDefault();

					var optionName = $fieldModal.find('.option-name-input').val();

					Membership.validate(optionName, {
						presence: {
							message: 'Option name can\'t be blank'
						}
					}).success(function() {
						$fieldModal
							.find('.option-name-input')
							.val('')
							.next('.error-msg')
							.fadeOut();
					}).error(function(messages) {
						$fieldModal
							.find('.option-name-input')
							.next('.error-msg')
							.text(messages[0])
							.fadeIn();
						throw new Error(messages[0]);
					});

					$fieldModal.find('.field-options-list').append(
						createOption(optionName).fadeIn()
					);
				});

			$fieldModal.find('.option-name-input')
				.on('keyup', function(event) {
					if (event.which == 13) {
						$addFieldOptionButton.trigger('click');
					}
				});

			// Update modal form with field data before open
			function updateModalData(data) {
				var isUserRoleOpt = (data.type == 'drop') && (data.name == 'user_role')
				,	$addNewOptionRow = $('.mbsModalEditAddToDdOpt');

				$fieldModal.find('.field-label').val(data.label || '');
				$fieldModal.find('.field-description').val(data.description || '');


				if (data.type != 'g-recaptcha-response') {
					$('.mp-field').each(function() {
						if ($(this).attr('data-field') !== undefined) {
							var fieldData = JSON.parse($(this).attr('data-field'));

							if (fieldData.type == 'g-recaptcha-response') {
								$fieldModal.find('.field-type option[value="g-recaptcha-response"]').hide();
							}
						}
					});
				} else {
					$fieldModal.find('.field-type option[value="g-recaptcha-response"]').show();
				}

				if (data.type) {
					$fieldTypesSelect.val(data.type);
				} else {
					$fieldTypesSelect.prop("selectedIndex", 0);
				}
				if(isUserRoleOpt) {
					$addNewOptionRow.hide();
					$fieldModal.attr('data-field-name', 'user_role');
					$fieldModal.attr('data-field-type', $fieldTypesSelect.val());
				} else {
					$addNewOptionRow.show();
					$fieldModal.attr('data-field-name', '');
					$fieldModal.attr('data-field-type', '');
				}

				if (data.type == 'date') {
					$fieldModal.find('select[name="date-format"]').val(data['date-format'] || '');
				}

				if (data.type == 'g-recaptcha-response') {
					$fieldModal.find('input[name="google-re-captcha-site-key"]').val(data['google-re-captcha-site-key'] || '');
					$fieldModal.find('input[name="google-re-captcha-secret-key"]').val(data['google-re-captcha-secret-key'] || '');
					$fieldModal.find('select[name="google-re-captcha-theme"]').val(data['google-re-captcha-theme'] || '');
					$fieldModal.find('select[name="google-re-captcha-type"]').val(data['google-re-captcha-type'] || '');
					$fieldModal.find('select[name="google-re-captcha-size"]').val(data['google-re-captcha-size'] || '');
				}

				$fieldSectionSelect.empty();

				for (var i = 0; i < sections.length; i++) {
					$('<option>')
						.text(sections[i])
						.val(sections[i])
						.appendTo($fieldSectionSelect);
				}

				if (data.section) {
					$fieldSectionSelect.val(data.section);
				}

				$fieldTypesSelect.trigger('change');
				$fieldModal.find('.field-options-list').empty();

				if (data.options) {
					for (var i = 0; i < data.options.length; i++) {
						var $oneOption = null;
						if(isUserRoleOpt) {
							$oneOption = createUserRoleOption(data.options[i]);
						} else {
							$oneOption = createOption(data.options[i].name, data.options[i].checked);
						}
						$fieldModal.find('.field-options-list').append($oneOption);
					}
				}

				$fieldModal.find('[name="registration"]').prop('checked', data.registration).trigger('change');
				$fieldModal.find('[name="required"]').prop('checked', data.required);
				$fieldModal.find('[name="enabled"]').prop('checked', data.enabled);
                $fieldModal.find('[name="asterisk"]').prop('checked', data.asterisk);
			}

			return $.extend($fieldModal, {
				newField: function() {
					$fieldModal
						.closest('.sc-modal-container')
						.find('.sc-modal-action-buttons .update')
						.hide();
					$fieldModal
						.closest('.sc-modal-container')
						.find('.sc-modal-action-buttons .add')
						.show();
					updateModalData({});
					$editField = null;
				},
				editField: function($field, data) {
					$fieldModal
						.closest('.sc-modal-container')
						.find('.sc-modal-action-buttons .update')
						.show();
					$fieldModal
						.closest('.sc-modal-container')
						.find('.sc-modal-action-buttons .add')
						.hide();
					$editField = $field;
					updateModalData(data);
				}
			});
		})();

		// Add new field
		$('.add-new-field').on('click', function(event) {
			fModal.newField();
			fModal.open();
		});
		
        function hide($object, visible) {
            if(visible === true){ $object.parent().parent().show(0);}
            else{ $object.parent().parent().hide(0); }
        }


        var require = $("input[name='required']#popup-required");
        var asterisk = $("input[name='asterisk']#popup-asterisk");
        require.change(function() { hide(asterisk, require.prop('checked')); });

		$(document).on('click', '.mp-field-edit-button', function(event) {
			event.preventDefault();
			var $field = $(this).closest('.mp-field');

			fModal.editField($field, JSON.parse($field.attr('data-field')));

            hide(asterisk, require.prop('checked'));

			fModal.open();
		});

		// Section modal
		var $sectionModal = $('.add-section-modal').sModal({
			width: 500,
			height: 210,
			buttons: [
				{
					content: '<i class="fa fa-times-circle"></i> Cancel',
					class: 'sc-button primary',
					event: function() {
						this.close();
					}
				},
				{
					content: '<i class="fa fa-plus-circle"></i> Add Section',
					class: 'sc-button primary add',
					event: function() {
						var $sectionName = $sectionModal.find('.section-name');
						createSection($sectionName.val());
						this.close();
						unsavedChanges = true;
						$sectionName.val('');
					}
				}
			]
		});

		$(document).on('click', '.add-new-section', function(event) {
			event.preventDefault();
			$sectionModal.open();
		});

		$(document).on('click', 'input[name="required"]', function() {
			if ($(this).prop('checked')) {
				var fieldContainer = $(this).closest('.mp-field');
				if(fieldContainer.length > 0) {
                    var data = JSON.parse(fieldContainer.attr('data-field'));
                }
                $(this).closest(':has(input[name="registration"])')
                    .find('input[name="registration"]').prop('checked', true);
                $(this).closest(':has(input[name="enabled"])')
                    .find('input[name="enabled"]').prop('checked', true);
				if(fieldContainer.length > 0){
                    data.enabled = true;
                    data.registration = true;
                    updateFieldData(fieldContainer, data);
                }
			}
		});

        $(document).on('click', 'input[name="registration"]', function() {
            if (!$(this).prop('checked')) {
                $(this).closest(':has(input[name="required"])')
                    .find('input[name="required"]').prop('checked', false);
				var fieldContainer = $(this).closest('.mp-field'),
					data = JSON.parse(fieldContainer.attr('data-field'));
				data.required = false;
				updateFieldData(fieldContainer, data);
            }
        });

        $(document).on('click', 'input[name="enabled"]', function() {
			var fieldContainer = $(this).closest('.mp-field'),
				data = JSON.parse(fieldContainer.attr('data-field'));

			if (!$(this).prop('checked')) {
                $(this).closest(':has(input[name="registration"])')
                    .find('input[name="registration"]').prop('checked', false);
                $(this).closest(':has(input[name="required"])')
                    .find('input[name="required"]').prop('checked', false);
				data.required = false;
				data.registration = false;
				updateFieldData(fieldContainer, data);
            }
        });

		// Save field
		$(document).on('click', '.save-fields', function(event) {
			event.preventDefault();

			var fieldsData = [];

			$('.mp-section .mp-field').each(function() {
				fieldsData.push(JSON.parse($(this).attr('data-field')));
			});

			Membership.ajax({
				'route': 'users.saveFields',
				'fields': fieldsData,
			}, {'method': 'post'}).then(function() {
				unsavedChanges = false;
			})
			.fail(function(response) {
				console.error(response.responseJSON.message);
			});
		});

		$('.save-settings').on('click', function(event) {
			event.preventDefault();
			Membership.ajax({
				'route': 'users.saveSettings',
				'settings': $('.mp-options :input').serializeJSON({
					checkboxUncheckedValue: false
				})
			}, {'method': 'post'})
			.fail(function(response) {
				console.error(response.responseJSON.message);
			});

		});

	});

	$('.mp-fields-container').sortable({
		handle: '.mp-section-drag-handler',
		delay: 150,
		opacity: 0.8,
		revert: 100
	});

	// Options sortable
	$('.field-options-container .field-options-list').sortable({
		handle: '.option-drag-handler',
		delay: 150,
		opacity: 0.9,
		cursor: 'move',
		revert: 100,
		helper: 'clone'
	});

	var notify = $.sNotify({
		'icon': 'fa fa-circle-o-notch fa-spin fa-lg',
		'content': '<span>Loading ...</span>',
	});

	Membership.ajax({'route': 'users.getFields'})
		.done(function(response) {
			var fields = JSON.parse(response.fields);
			if (fields.length) {
				$.each(fields, function() {
					createField(this);
				});
			} else {
				createSection('Main');
			}
		}).fail(function(response) {
			console.log('error', response);
		}).always(function() {
			notify.close();
		});


	$(window).on('beforeunload', function(event) {
		if (unsavedChanges) {
			return true;
		}
		return;
	});

})(jQuery, Membership || {});