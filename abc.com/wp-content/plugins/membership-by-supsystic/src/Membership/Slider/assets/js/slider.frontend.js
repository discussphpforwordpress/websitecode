(function($, Membership) {
	function SliderForMembership() {
		if(Membership.GalleryTabs) {
			this.modalTabs =  Membership.GalleryTabs;
			this.imageAttachmentTemplate = $($('.mbs-rs-image-template').html());
			this.sliderAttachmentTemplate = $($(".mbs-slider-one-template").html());

			this.modalWndInit();
		}
	}
	
	SliderForMembership.prototype.modalWndSliderButtonInit = (function() {
		var self = this;

		$('.post-activity-buttons .button[data-action="select-slider"]').on('click', function() {
			self.$modalNextButton.addClass('disabled');

			var $sliderPresetOptionList = self.$modalSliderSelectorList.find('option');
			if($sliderPresetOptionList.length == 2) {
				$sliderPresetOptionList.eq(1).prop('selected', true);
			} else {
				self.$modalSliderSelectorList.val(null);
			}
			self.$modalSliderSelectorList.trigger('change');
			// window tabs init
			self.modalTabs.tabsVisibilityUpdate('slider', 'page1');
			self.modalPage2PrepareImgListHeight();
			self.$sliderModalWnd.mpModal('showModal');
		});
	});

	SliderForMembership.prototype.modalPage2PrepareImgListHeight = (function() {
		var windowH = $(window).height() * 0.9
		,	imageListHeigth = 140;
		if(windowH) {
			if(windowH > 450) {
				imageListHeigth += windowH - 450;
			}
			this.$modalSliderAttachedImages.css('max-height', imageListHeigth);
		}
	});

	SliderForMembership.prototype.modalWndPage1Init = (function() {
		var self = this;
	
		self.$modalSliderSelectorList.on('change', function() {
			if(self.$modalSliderSelectorList.val() != '') {
				self.$modalNextButton.removeClass('disabled');
			} else {
				self.$modalNextButton.addClass('disabled');
			}
		});
	
		// Next button behavior
		self.$modalNextButton.on('click', function() {
			self.$modalNextButton.addClass('disabled');
			// clear previos value
			self.$modalSliderAttachedImages.data('slider-id', '');
			self.$modalSliderAttachedImages.html('');
	
			// create slider in db
			Membership.api.slider.createSlider({
				'slider_id': self.$modalSliderSelectorList.val(),
			}).then(function(response){
				if(response.sliderId) {
					self.$modalSliderAttachedImages.data('slider-id', response.sliderId);
					// add slider image to panel
					$sliderAttach = self.sliderAttachmentTemplate.clone();
					$sliderAttach.attr('data-slider-id', response.sliderId);
					$sliderAttach.find('.icon').attr('data-slider-id', response.sliderId);
					$sliderAttach.find('.icon').attr('data-slider-id', response.sliderId);
					self.$modalSliderContainer.append($sliderAttach);
	
					self.modalWndSliderEvents();
					self.$modalNextButton.removeClass('disabled');
					// go to tabpage 2
					self.modalTabs.tabsVisibilityUpdate('slider', 'page2');
	
					// sort slider
					var sliderArraySort = self.$modalSliderContainer.sortable('toArray', {'attribute': 'data-slider-id'});
					self.$modalSliderContainer.data('slider-sort', JSON.stringify(sliderArraySort));
					self.modalWndSliderSortFunc(self);
				} else {
					Snackbar.show({text: $('#mbsSliderStrServerError').val()});
				}
			}, function(errResponse) {
				var strMessage = $('#mbsSliderStrServerError').val();
				if(errResponse && errResponse.responseJSON && errResponse.responseJSON.message) {
					strMessage = errResponse.responseJSON.message;
				}
				Snackbar.show({text: strMessage});
				self.$modalNextButton.removeClass('disabled');
			});
	
		});
	});

	SliderForMembership.prototype.modalWndImageEvents = (function() {
		var $images = $('.mbs-rs-img-list .mbs-one-gg-image');
	
		$images.off('click');
		// click image selected behavior
		$images.on('click', function() {
			var $oneImage = $(this);
			if($oneImage.hasClass('selected')) {
				$oneImage.removeClass('selected');
			} else {
				$oneImage.addClass('selected');
			}
		});
	});

	SliderForMembership.prototype.modalWndSliderEvents = (function() {

		if(this.$modalSliderContainer.children().length) {
			this.$modalSliderContainer.removeClass('mbs-hidden');
		} else {
			this.$modalSliderContainer.addClass('mbs-hidden');
		}

		// on close event
		var self = this
		,	$closeIcons = $('.mbs-slider-container .close')
		,	$sliderIcons = $('.mbs-slider-container .mbs-one-gg-image');

		$closeIcons.off('click');
		$closeIcons.on('click', function(event) {
			event.stopPropagation();
			var currItem = $(this)
			,	sliderId = currItem.data('slider-id');
			if(!isNaN(parseInt(sliderId))) {
				if(!currItem.hasClass('mbs-cross-rotating')) {
					currItem.addClass('mbs-cross-rotating');

					Membership.api.slider.removeSlider({
						'slider_id': sliderId,
					}).then(function(response) {
						if(response) {
							if(response.success) {
								var imageItem = currItem.closest('.mbs-one-gg-image');
								imageItem.hide(400, function() {
									imageItem.remove();
									if(!self.$modalSliderContainer.children().length) {
										self.$modalSliderContainer.addClass('mbs-hidden');
									}
									var sliderArraySort = self.$modalSliderContainer.sortable('toArray', {'attribute': 'data-slider-id'});
									self.$modalSliderContainer.data('slider-sort', JSON.stringify(sliderArraySort));
								});
							} else if(response.message) {
								Snackbar.show({text: response.message});
							} else {
								Snackbar.show({text: $('#mbsSliderStrServerError').val()});
							}
						} else {
							Snackbar.show({text: $('#mbsSliderStrServerError').val()});
						}

						currItem.removeClass('mbs-cross-rotating');
					}, function(response) {
						Snackbar.show({text: $('#mbsSliderStrServerError').val()});
						currItem.removeClass('mbs-cross-rotating');
					});
				}
			} else {
				Snackbar.show({text: $('.mbsStrIncorrectSliderParams').val()});
			}
		});

		$sliderIcons.off('click');
		$sliderIcons.on('click', function() {
			var $currItem = $(this)
			,	sliderId = $currItem.data('slider-id');

			if(sliderId && !isNaN(parseInt(sliderId))) {
				self.$modalSliderAttachedImages.data('slider-id', sliderId);
				self.modalTabs.tabsVisibilityUpdate('slider', 'page2');

				// FILL Slider IMAGES
				self.$modalSliderAttachedImages.html('');

				var imagesInfo = $currItem.data('images')
				,	currentImageSort = $currItem.data('img-sort');

				if(imagesInfo && currentImageSort) {
					var parsedImagesInfo = JSON.parse(imagesInfo)
					,	imagePositions = JSON.parse(currentImageSort);
					if(imagePositions.length) {
						for(var key in imagePositions) {
							var imageKey = imagePositions[key];
							if(!isNaN(parseInt(imageKey))) {

								var $attachment = self.imageAttachmentTemplate.clone()
								,	$progressBar = $attachment.find('.ui.progress')
								,	$image = $attachment.find('img');
								// remove progress bar
								$progressBar.remove();
								// prepare parametes
								$image.attr('src', parsedImagesInfo[imageKey]);
								$attachment.attr('data-image-id', imageKey)
								// add to container
								self.$modalSliderAttachedImages.append($attachment);
							}
						}
					}
				}

				self.modalWndImageEvents();
				self.$sliderModalWnd.mpModal('showModal');
			} else {
				Snackbar.show({text: $('.mbsStrIncorrectSliderParams').val()});
			}
		});
	});

	SliderForMembership.prototype.modalWndPage2Init = (function() {
		var self = this;
		$('.mbs-modal-slider-page2-btn-ok').on('click', function() {
			self.$sliderModalWnd.mpModal('hide');
		});
	
		this.modalWndImageEvents();
		this.modalWndRemoveImageInit();
		this.modalWndAddImageInit();
	});
	
	SliderForMembership.prototype.sliderItemInformationUpdate = (function(sliderId, attachment, updateType) {
		if(attachment && attachment.id && updateType) {
	
			var imageId = parseInt(attachment.id);
			if(!isNaN(imageId)) {
				var $sliderItem = $('.mbs-slider-container .mbs-one-gg-image[data-slider-id="' + sliderId + '"]')
				,	imageInfo = $sliderItem.data('images')
				,	parsedImageInfo = {};
	
				if(imageInfo) {
					parsedImageInfo = JSON.parse(imageInfo);
				}
	
				if(updateType == 1 && attachment.src) {
					// add
					parsedImageInfo[attachment.id] = attachment.src;
					$sliderItem.data('images', JSON.stringify(parsedImageInfo));
				} else if(updateType == 2) {
					//remove
					delete parsedImageInfo[attachment.id];
					$sliderItem.data('images', JSON.stringify(parsedImageInfo));
				}
	
				var arraySort = this.$modalSliderAttachedImages.sortable('toArray', {'attribute': 'data-image-id'})
				$sliderItem.data('img-sort', JSON.stringify(arraySort));
			}
		}
	});
	
	SliderForMembership.prototype.modalWndRemoveImageInit = (function() {
		var self = this
		,	$removeButton = $('#mbs-slider-remove-image');
		$removeButton.removeClass('disabled');
	
		$removeButton.on('click', function() {
			var vSliderId = self.$modalSliderAttachedImages.data('slider-id')
			,	$chainRemove
			,	$images = $('.mbs-rs-img-list .mbs-one-gg-image.selected');
	
			if($images.length) {
				$images.each(function(index, item) {
					var currImage = $(item)
					,	imageId = currImage.data('image-id');
					if(imageId && vSliderId) {
						$removeButton.addClass('disabled');
						$chainRemove = Membership.api.slider.removeImage({
							'slider_id': vSliderId,
							'image_id': imageId,
						}).then(function(response) {
							if(response) {
								if(response.success) {
									currImage.hide(400, function() {
										currImage.remove();
										self.sliderItemInformationUpdate(vSliderId, {'id': imageId}, 2);
									});
	
								} else {
									if(response.message) {
										Snackbar.show({text: response.message});
									} else {
										Snackbar.show({text: $('#mbsSliderStrServerError').val()});
									}
								}
							} else {
								Snackbar.show({text: $('#mbsSliderStrServerError').val()});
							}
						}, function(errResponse) {
							Snackbar.show({text: $('#mbsSliderStrServerError').val()});
						});
					} else {
						Snackbar.show({text: $("#mbsSliderStrImageParamIncorrect").val()});
					}
				});
				if($chainRemove) {
					$chainRemove.always(function() {
						$removeButton.removeClass('disabled');
					});
				}
			} else {
				Snackbar.show({text: $("#mbsSliderStrSelectImageToRemove").val()});
			}
	
		});
	});

	SliderForMembership.prototype.ModalPage2ButtonsSetDisable = (function(isDisable) {
		var $buttons = $('#mbs-rs-modal-page2-ok, #mbs-rs-modal-page2-cancel, #mbs-slider-add-image, #mbs-slider-remove-image');
		if(isDisable) {
			$buttons.addClass('disabled');
		} else {
			$buttons.removeClass('disabled');
		}
	});
	
	SliderForMembership.prototype.modalWndAddImageInit = (function() {
		var self = this
		,	$addButton = $('#mbs-slider-add-image');
		self.ModalPage2ButtonsSetDisable(false);

		// Image add behavior
		$addButton.on('click', function() {
			var sliderId = self.$modalSliderAttachedImages.data('slider-id');
			if(sliderId && !isNaN(parseInt(sliderId))) {
				$('<input type="file" name="image" multiple accept=".jpg,.jpeg,.png">').trigger('click').on('change', function(event) {
					event.preventDefault();
					var files = event.target.files || event.dataTransfer.files;
					self.ModalPage2ButtonsSetDisable(true);
					var $chainUpload = $.Deferred().resolve();

					for (var i = 0; i < files.length; i++) {

						(function(i) {

							var	reader = new FileReader(),
								$attachment = self.imageAttachmentTemplate.clone(),
								$image = $attachment.find('img'),
								$progressBar = $attachment.find('.ui.progress').mpProgress();

							self.$modalSliderAttachedImages.append($attachment);

							reader.onload = (function(event) {
								$image.attr('src', event.target.result);
							});

							reader.readAsDataURL(files[i]);

							$chainUpload = $chainUpload.then(function() {
								return self.uploadImage(files[i], $progressBar, sliderId).then(function(response) {
									if(response.attachment && response.attachment.id) {
										$image.attr('src', response.attachment.src);
										$attachment.attr('data-image-id', response.attachment.id);
										self.$modalSliderAttachedImages.stop(true).animate({
											scrollLeft: ($attachment.get(0).offsetLeft + $attachment.width())
										}, 500);
										self.sliderItemInformationUpdate(sliderId, response.attachment, 1);
										$progressBar.remove();
										self.modalWndImageEvents();
									} else {
										$attachment.remove();
										if(response.message) {
											Snackbar.show({text: response.message});
										} else {
											Snackbar.show({text: $('#mbsSliderStrServerError').val()});
										}
									}
								}, function(response) {
									$attachment.remove();
									if(response.message) {
										Snackbar.show({text: response.message});
									} else {
										Snackbar.show({text: $('#mbsSliderStrServerError').val()});
									}
									return $.Deferred().resolve();
								});
							});

						})(i);
					}
					self.$sliderModalWnd.mpModal('refresh');

					$chainUpload.always(function() {
						self.ModalPage2ButtonsSetDisable(false);
					});
				});
			} else {
				Snackbar.show({text: $("#mbsSliderStrParamIncorrect").val()});
			}
		});
	});

	SliderForMembership.prototype.uploadImage = (function(file, $progressBar, paramSliderId) {
		return Membership.api.slider.uploadImage({
			image: file,
			'sliderId': paramSliderId,
			uploadProgress: function(event) {
				if (event.lengthComputable) {
					$progressBar.mpProgress('set percent', parseInt((event.loaded / event.total) * 100));
				}
			}
		});
	});

	SliderForMembership.prototype.modalWndInit = (function() {
		var self1 = this;
		this.$sliderModalWnd = $('.mp-slider-modal');
		this.$modalSliderSelectorList = $('#sliderPresetSel');
		this.$modalNextButton = $('#mbs-slider-gg-next');
		this.$modalSliderAttachedImages = $('.mbs-rs-img-list');

		this.$modalSliderAttachedImages.sortable({
			update: function (event, ui) {
				var sliderId = self1.$modalSliderAttachedImages.data('slider-id');
				if(!isNaN(parseInt(sliderId))) {
					var $sliderItem = $('.mbs-slider-container .mbs-one-gg-image[data-slider-id="' + sliderId + '"]');
					var arraySort = self1.$modalSliderAttachedImages.sortable('toArray', {'attribute': 'data-image-id'});
					$sliderItem.data('img-sort', JSON.stringify(arraySort));
					Membership.api.slider.setImagesPosition({
						'image_array': arraySort,
					}).then(function(response){}, function(response) {});
				}
			},
		});
		this.$modalSliderContainer = $('.mbs-slider-container');
		this.$modalSliderContainer.sortable({
			update: function() {
				self1.modalWndSliderSortFunc(self1);
			},
		});
		
		this.modalWndSliderButtonInit();
		// init modal window
		this.$sliderModalWnd.mpModal({
			'closable' : 0,
		});
		this.modalWndSliderEvents();
		this.modalWndPage1Init();
		this.modalWndPage2Init();
	});

	SliderForMembership.prototype.modalWndSliderSortFunc = (function(selfParam) {
		var sliderArraySort = selfParam.$modalSliderContainer.sortable('toArray', {'attribute': 'data-slider-id'});
		selfParam.$modalSliderContainer.data('slider-sort', JSON.stringify(sliderArraySort));
		Membership.api.slider.setSliderPosition({
			'slider_array': sliderArraySort,
		}).then(function(response){}, function(response) {});
	});
	
	var $sliderPluginForMembership = new SliderForMembership();

	// init sliders that added by ajax
	$(document).ajaxComplete(function(event, jqXHR, settings) {

		if(window && jqXHR && window.SupsysticSlider && window.SupsysticSlider.init && jqXHR.statusText == "OK" && jqXHR.responseText) {
			var ieSecondParam = 'gui';
			if(window.navigator.userAgent.indexOf("MSIE ") > 0
				|| !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
				ieSecondParam = 'gi';
			}

			var regexRule = new RegExp('id=\\\\\"(supsystic-slider-(\\d+_\\d+)+)\\\\\" data-integrate-id=\\\\\"(\\d+)+\\\\\" class', ieSecondParam)
			,	sliderMatches = null;

			while((sliderMatches = regexRule.exec(jqXHR.responseText)) !== null) {
				if(sliderMatches && sliderMatches.length == 4) {
					window.SupsysticSlider.init('#' + sliderMatches[1] + '[data-integrate-id="' + sliderMatches[3] + '"]');
				}
			}
		}
	});
})(jQuery, Membership);