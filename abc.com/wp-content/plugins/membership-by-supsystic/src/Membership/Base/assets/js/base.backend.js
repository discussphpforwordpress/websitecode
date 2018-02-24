(function($, Membership) {

	$(function() {
		Membership.tooltip('.tooltip');
	});

	var unsavedChanges = false;

	$(document).on('ajaxSend', function(event, $xhr, settings) {
		if (settings.data && settings.data.indexOf('action=supsystic-membership') !== -1) {
			unsavedChanges = false;
		}
	});

	$('[data-save-settings]').on('click', function(event) {
		event.preventDefault();

		var $this = $(this),
			$icon = $this.find('i'),
			iconDefaultClass = $icon.attr('class'),
			iconLoadingClass = 'fa fa-circle-o-notch fa-spin';

		$(document).one('ajaxSend', function(event, $xhr, settings) {

				var requestContent = 'Saving ...',
					requestIcon = 'fa fa-circle-o-notch fa-spin fa-lg',
					responseContent = 'Saved',
					responseIcon = 'fa fa-check',
					responseErrorContent = 'Error',
					responseErrorIcon = 'fa fa-exclamation';

			if (settings.notify) {
				requestContent = settings.notify.requestContent || requestContent;
				requestIcon = settings.notify.requestIcon || requestIcon;
				responseContent = settings.notify.responseContent || responseContent;
				responseIcon = settings.notify.responseIcon || responseIcon;
				responseErrorContent = settings.notify.responseErrorContent || responseErrorContent;
				responseErrorIcon = settings.notify.responseErrorIcon || responseErrorIcon;
			}

			var saveNotify = $.sNotify({
				'icon': requestIcon,
				'content': '<span>' + requestContent + '</span>'
			});


			$this.prop('disabled', true);
			$icon.removeClass(iconDefaultClass).addClass(iconLoadingClass);
			$xhr.success(function(response) {
				saveNotify.update('<span>' + responseContent + '</span>', responseIcon).close(4000);
			}).error(function(response) {
				saveNotify.update('<span>' + responseErrorContent + '</span>', responseErrorIcon).close(4000);
			}).always(function() {
				$this.prop('disabled', false);
				$icon.removeClass(iconLoadingClass).addClass(iconDefaultClass);
			});
		});
	});

	$(window).on('beforeunload', function(event) {
		if (unsavedChanges) {
			return true;
		}
		return;
	});

	$('.sc .sc-container, .sc-modal-container').on('change', 'input, textarea', function(event) {
		if (event.originalEvent !== undefined) {
			var elementIdAttrVal = $(this).attr('id');
			// not set param if changed input is groupCategory
			if(elementIdAttrVal != 'mbsGroupCategoryName' && elementIdAttrVal != 'mbsReportFindField') {
				unsavedChanges = true;
			}
		}
 	});

	$(function() {
		$('.chosen-select').chosen({disable_search_threshold: 10, width: '100%!important'});
		$('.chosen-select-wide').chosen({disable_search_threshold: 10});
	});

	$(document).on('click', '.add-new-thumnail-size', function(event) {
		event.preventDefault();
		var $this = $(this),
			templateClass = $this.data('template'),
			appendTarget = $this.data('append'),
			$template = $(templateClass).clone();

		$template.find(':input').attr('disabled', false);
		$template.removeClass(templateClass.substring(1));
		$(appendTarget).append($template);
		$template.fadeIn();
	});

	$(document).on('click', '.remove-size', function(event) {
		event.preventDefault();
		$(this).closest('.mp-option-sizes-input').fadeOut(function() {
			$(this).remove();
		});
	});

	$(function() {

		var frame;

		var cropper = {
			settings: {
				dragMode: 'move',
				viewMode: 3,
				autoCropArea: 1,
				guides: false,
				center: true,
				minCropBoxWidth: 100,
				minCropBoxHeight: 100,
				toggleDragModeOnDblclick: false,
				cropBoxResizable: false,
				cropBoxMovable: false,
				scalable: false,
				highlight: false,
				minContainerWidth: 100,
				minContainerHeight: 100,
				background: false,
			},
			prepareCoverContainerSize: function ($imageContainer, imageWidth, imageHeight, imageAspectRatio) {
				var width = $imageContainer.parent().width(),
					height = width / imageAspectRatio,
					scaleRatio = Math.max(
						100 / imageWidth,
						100 / imageHeight
					);

				if (width < 100 || height < 100) {
					width = scaleRatio * imageWidth;
					height = scaleRatio * imageHeight;
				}

				$imageContainer.css({
					'width': width,
					'height': height,
					'max-height': 'none',
				});
			}
		};
		
		$('.mp-default-image').on('click', '.mp-change', function(event) {
			event.preventDefault();
			var $this = $(this),
				$parent = $this.parent(),
				$sourceInput = $parent.find('input[data-default-image]'),
				$previewImage = $parent.find('img'),
				$previewImageSource = $previewImage.attr('src'),
				sourceWidthInputName = $sourceInput.data('default-width-input-name'),
				sourceHeightInputName = $sourceInput.data('default-height-input-name'),
				cropDataInputName = $sourceInput.data('default-crop-input-name'),
				$sourceInputValue = $sourceInput.val(),
				$image = $('<img>', {style: 'height: auto; max-width: 100%;'}),
				$badgeInput = $parent.find('input[name="badge_img"]'),
				$ImgInput = $parent.find('input[name="img_id"]');
			
			var $modal = $('<div></div>').sModal({
					width: '80%',
					height: 600,
					buttons: [
						{
							content: '<i class="fa fa-times-circle"></i> Cancel',
							class: 'sc-button primary',
							event: function() {
								$sourceInput.val($sourceInputValue);
								$previewImage.attr('src', $previewImageSource);
								this.close();
							}
						},
						{
							content: '<i class="fa fa-plus-circle"></i> Save',
							class: 'sc-button primary add',
							event: function(modal) {
								var croppedData = JSON.stringify($image.cropper('getData', true));
								$('[name="' + cropDataInputName + '"]').val(croppedData)
								$image.cropper('getCroppedCanvas').toBlob(function (blob) {
									var urlCreator = window.URL || window.webkitURL,
										imageUrl = urlCreator.createObjectURL(blob);
									$previewImage.attr('src', imageUrl);
								});
								this.close();
							}
						}
					]
			});

			// $modal.open();
			if (frame) {
				frame.open();
				return;
			}

			frame = wp.media({
				multiple: false
			});

			frame.on('select', function() {
				var attachment = frame.state().get('selection').first().toJSON();

				$sourceInput.val(attachment.url);
				$previewImage.attr('src', attachment.url);
				$previewImage.css('display', 'inline');
				if($badgeInput.length > 0){
					$badgeInput.val(attachment.id);
				}
				if($ImgInput.length > 0){
					$ImgInput.val(attachment.id);
				}
				$parent.find('.mp-set-to-default').fadeIn();
				frame = null;
				$modal.find('.crop-image-wrapper').remove();

				var $imageWrapper = $('<div>', {class: 'crop-image-wrapper', style: 'min-height:300px;max-height:600px;overflow: hidden;'});
				$imageWrapper.append($image);

				$modal.append($imageWrapper);

				$image.on('load', function() {

					var sourceWidth = $('[name="' + sourceWidthInputName + '"]').val(),
						sourceHeight = $('[name="' + sourceHeightInputName + '"]').val(),
						imageAspectRatio =  sourceWidth / sourceHeight;

					if (!imageAspectRatio || !sourceHeight || !sourceWidth) {
						$('[name="' + cropDataInputName + '"]').val('');
						return;
					}

					$modal.open();

					$image.cropper($.extend(cropper.settings, {
						aspectRatio: imageAspectRatio,
						viewMode: 1,
						built: function() {
							$image.cropper('zoomTo', 1);
						}
					}));

				}).attr('src', attachment.url);

			});

			frame.open();
		});

		$('.mp-default-image').on('click', '.mp-set-to-default', function(event) {
			event.preventDefault();
			var $this = $(this),
				$parent = $this.parent(),
				$input = $parent.find('input[data-default-image]');

			$input.val($input.data('default-image'));
			$parent.find('img').attr('src', $input.data('default-image'));
			$parent.find('.mp-set-to-default').fadeOut();
		});
		
		$('.mp-default-image').on('click', '.mp-remove-info', function(event) {
			event.preventDefault();
			var $this = $(this)
			,	$parent = $this.parent()
			,   $inputImgId = $parent.find('input[name="img_id"]')
			,   $inputImgSrc = $parent.find('input[name="img_src"]')
			,   $inputPreview = $parent.find('img');
			
			$inputImgId.val('');
			$inputImgSrc.val('');
			$inputPreview.css('display', 'none').attr('src', '');
		});
	});

	$('.mbs-checkbox-for-enable').on('change', function() {
		var $this = $(this)
		,	$parent = $this.closest('.mbs-check-with-input-block');
		if($parent.length) {
			var $inputsElems = $parent.find('.mbs-cwib-input-block input, .mbs-cwib-input-block select');

			if($this.prop('checked')) {
				$inputsElems.prop('disabled', false);
			} else {
				$inputsElems.prop('disabled', true);
			}
		}
	}).trigger('change');
	
	$(document).one('click', '.supsystic-admin-notice a, .supsystic-admin-notice button', function(event) {
		$('.supsystic-admin-notice .notice-dismiss').trigger('click');

		Membership.ajax({
			route: 'membership.reviewNoticeResponse',
			response: $(this).data('response-code') || 'hide'
		}, {method: 'post'});
	});

})(jQuery, window.Membership);