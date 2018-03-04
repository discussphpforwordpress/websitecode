(function($, Membership) {

	var groupId = Membership.get('requestedGroup.id');

	$('.settings-tabs').find('.item').mpTab();

	var $confirmDeletionCheckbox = $('.confirm-deletion'),
		$confirmDeletionButton = $('.confirm-deletion-button');

	$confirmDeletionCheckbox.on('change', function() {
		if ($confirmDeletionCheckbox.is(':checked')) {
			$confirmDeletionButton.show();
		} else {
			$confirmDeletionButton.hide();
		}
	});

	$confirmDeletionButton.on('click', function() {
		$confirmDeletionButton.addClass('disabled loading');
		$confirmDeletionButton.attr('disabled', true);
		Membership.api.groups.delete({groupId:groupId}).then(function(response) {
			if (response.success) {
				window.location = response.redirect;
			}
			$confirmDeletionButton.removeClass('loading disabled');
			$confirmDeletionButton.removeAttr('disabled');
			Snackbar.show({text: response.message});
		})
	});

	var $groupSettingsForm = $('.group-settings-form');

	$groupSettingsForm.find('.update-button').on('click', function() {
		var $button = $(this),
			$groupName = $groupSettingsForm.find('[name="name"]').val(),
			$categoryId = $groupSettingsForm.find('[name="category"]').val(),
			$groupDescription = $groupSettingsForm.find('[name="description"]').val();

		$button.addClass('loading disabled');
		$button.attr('disabled', true);

		Membership.api.groups.updateData({
			groupId: groupId,
			data: {
				'name': $groupName,
				'description': $groupDescription,
				'category_id': $categoryId,
			}
		}).then(function(response) {
			Snackbar.show({text: response.message});
			$button.removeClass('loading disabled');
			$button.removeAttr('disabled');
		});
	});

	var $privacySettings = $('.privacy-settings');

	$privacySettings.find('.dropdown').mpDropdown({
		onChange: function() {
			var privacies = {};

			$privacySettings.find('select').each(function() {
				var $select = $(this);
				privacies[$select.attr('name')] = $select.val();
			});

			return Membership.api.groups.updatePrivacy({
				groupId: groupId,
				privacies: privacies
			}).then(function(response) {
				Snackbar.show({text: response.message});
			});
		}
	});

	var $tagsContainer = $('.tags-container'),
		$addTagContainer = $('.add-tag-input-container'),
		$addTagButton = $('.add-tag-button'),
		$addTagInput = $('.add-tag-input');

	$addTagInput.on('keyup', function(event){
		if (event.which == 13){
			$addTagButton.trigger('click');
		}
	});

	$addTagButton.on('click', function() {
		var tag = $addTagInput.val();
		if (!tag.length) {
			return;
		}

		$addTagContainer.addClass('loading');
		$addTagButton.addClass('disabled');

		Membership.api.groups.addTag({
			groupId: Membership.requestedGroup.id,
			tag: tag
		}).then(function(response) {
			if (response.success) {
				$tagsContainer.html(response.html);
				$addTagInput.val('');
			} else {
				if (response.error) {
					Snackbar.show({text: response.error});
				}
			}

			$addTagContainer.removeClass('loading');
			$addTagButton.removeClass('disabled');
		});
	});

	$tagsContainer.on('click', 'i.delete', function() {

		var $tag = $(this).parent(),
			tagId = $tag.attr('data-id');

		console.log(tagId);

		Membership.api.groups.removeTag({
			groupId: Membership.requestedGroup.id,
			tagId: tagId
		}).then(function(response) {
			if (! response.success) {
				if (response.error) {
					Snackbar.show({text: response.error});
				}
			}

		});

		$tag.remove();

	})


})(jQuery, Membership);