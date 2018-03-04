(function($, Membership) {

	function GalleryTabs() {
		var mtiSelf = this;
		$('.mbs-gg-tab-links .mbs-gg-tab-link').on('click', function() {
			var $self = $(this)
			,	$parent = $self.parent();

			if($parent.data('tabs') && $self.data('tab-info')) {
				mtiSelf.tabsVisibilityUpdate($parent.data('tabs'), $self.data('tab-info'));
			}
		});
	};
	Membership.GalleryTabs = new GalleryTabs()

	GalleryTabs.prototype.tabsVisibilityUpdate = (function(parentDataInfo, thisDataInfo) {
		$('.mbs-gg-tab-pages[data-tabs="' + parentDataInfo + '"] .mbs-gg-tab-page').addClass('mbs-hidden')
		$('.mbs-gg-tab-pages[data-tabs="' + parentDataInfo + '"] .mbs-gg-tab-page[data-tab-info="' + thisDataInfo + '"]').removeClass('mbs-hidden');
	});

	function GalleryForMembership() {
		this.modalTabs =  Membership.GalleryTabs;
		this.imageAttachmentTemplate = $($('.mbs-gg-image-template').html());
		this.galleryAttachmentTemplate = $($(".mbs-gallery-one-template").html());

		this.modalWndInit();
	}

	GalleryForMembership.prototype.modalWndGalleryButtonInit = (function() {
		var self = this;

		$('.post-activity-buttons .button[data-action="select-gallery"]').on('click', function() {
			self.$modalNextButton.addClass('disabled');

			var $galleryPresetOptionList = self.$modalGalleriesSelectorList.find('option');
			if($galleryPresetOptionList.length == 2) {
				$galleryPresetOptionList.eq(1).prop('selected', true);
			} else {
				self.$modalGalleriesSelectorList.val(null);
			}
			self.$modalGalleriesSelectorList.trigger('change');
			// window tabs init
			self.modalTabs.tabsVisibilityUpdate('gallery', 'page1');
			self.modalPage2PrepareImgListHeight();
			self.$galleryModalWnd.mpModal('showModal');
		});
	});

	GalleryForMembership.prototype.modalPage2PrepareImgListHeight = (function() {
		var windowH = $(window).height() * 0.9
		,	imageListHeigth = 140;
		if(windowH) {
			if(windowH > 450) {
				imageListHeigth += windowH - 450;
			}
			this.$modalGalleryAttachedImages.css('max-height', imageListHeigth);
		}
	});
	
	GalleryForMembership.prototype.modalWndPage1Init = (function() {
		var self = this;

		self.$modalGalleriesSelectorList.on('change', function() {
			if(self.$modalGalleriesSelectorList.val() != '') {
				self.$modalNextButton.removeClass('disabled');
			} else {
				self.$modalNextButton.addClass('disabled');
			}
		});

		// Next button behavior
		self.$modalNextButton.on('click', function() {
			self.$modalNextButton.addClass('disabled');
			// clear previos value
			self.$modalGalleryAttachedImages.data('gallery-id', '');
			self.$modalGalleryAttachedImages.html('');

			// create gallery in db
			Membership.api.gallery.createGallery({
				'gallery_id': self.$modalGalleriesSelectorList.val(),
			}).then(function(response){
				if(response.galleryId) {
					self.$modalGalleryAttachedImages.data('gallery-id', response.galleryId);
					// add gallery image to panel
					$galleryAttach = self.galleryAttachmentTemplate.clone();
					$galleryAttach.attr('data-gallery-id', response.galleryId);
					$galleryAttach.find('.icon').attr('data-gallery-id', response.galleryId);
					$galleryAttach.find('.icon').attr('data-gallery-id', response.galleryId);
					self.$modalGalleryContainer.append($galleryAttach);

					self.modalWndGalleriesEvents();
					self.$modalNextButton.removeClass('disabled');
					// go to tabpage 2
					self.modalTabs.tabsVisibilityUpdate('gallery', 'page2');

					// sort galleries parameters
					var gallArraySort = self.$modalGalleryContainer.sortable('toArray', {'attribute': 'data-gallery-id'});
					self.$modalGalleryContainer.data('gallery-sort', JSON.stringify(gallArraySort));
					self.modalWndGallerySortFunc(self);
				} else {
					Snackbar.show({text: $('#mbsStrServerError').val()});
				}
			}, function(errResponse) {
				var strMessage = $('#mbsStrServerError').val();
				if(errResponse && errResponse.responseJSON && errResponse.responseJSON.message) {
					strMessage = errResponse.responseJSON.message;
				}
				Snackbar.show({text: strMessage});
				self.$modalNextButton.removeClass('disabled');
			});

		});
	});

	GalleryForMembership.prototype.modalWndImageEvents = (function() {
		var $images = $('.mbs-gg-img-list .mbs-one-gg-image');

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

	GalleryForMembership.prototype.modalWndGalleriesEvents = (function() {

		if(this.$modalGalleryContainer.children().length) {
			this.$modalGalleryContainer.removeClass('mbs-hidden');
		} else {
			this.$modalGalleryContainer.addClass('mbs-hidden');
		}

		// on close event
		var self = this
		,	$closeIcons = $('.mbs-photo-gallery-container .close')
		,	$galleryIcons = $('.mbs-photo-gallery-container .mbs-one-gg-image');
		
		$closeIcons.off('click');
		$closeIcons.on('click', function(event) {
			event.stopPropagation();
			var currItem = $(this)
			,	galleryId = currItem.data('gallery-id');
			if(!isNaN(parseInt(galleryId))) {
				if(!currItem.hasClass('mbs-cross-rotating')) {
					currItem.addClass('mbs-cross-rotating');

					Membership.api.gallery.removeGallery({
						'gallery_id': galleryId,
					}).then(function(response) {
						if(response) {
							if(response.success) {
								var imageItem = currItem.closest('.mbs-one-gg-image');
								imageItem.hide(400, function() {
									imageItem.remove();
									if(!self.$modalGalleryContainer.children().length) {
										self.$modalGalleryContainer.addClass('mbs-hidden');
									}
									var gallArraySort = self.$modalGalleryContainer.sortable('toArray', {'attribute': 'data-gallery-id'});
									self.$modalGalleryContainer.data('gallery-sort', JSON.stringify(gallArraySort));
								});
							} else if(response.message) {
								Snackbar.show({text: response.message});
							} else {
								Snackbar.show({text: $('#mbsStrServerError').val()});
							}
						} else {
							Snackbar.show({text: $('#mbsStrServerError').val()});
						}

						currItem.removeClass('mbs-cross-rotating');
					}, function(response) {
						Snackbar.show({text: $('#mbsStrServerError').val()});
						currItem.removeClass('mbs-cross-rotating');
					});
				}
			} else {
				Snackbar.show({text: $('.mbsStrIncorrectGalleryParams').val()});
			}
		});

		$galleryIcons.off('click');
		$galleryIcons.on('click', function() {
			var $currItem = $(this)
			,	galleryId = $currItem.data('gallery-id');
			if(galleryId && !isNaN(parseInt(galleryId))) {
				self.$modalGalleryAttachedImages.data('gallery-id', galleryId);
				self.modalTabs.tabsVisibilityUpdate('gallery', 'page2');

				// FILL GALLERY IMAGES
				self.$modalGalleryAttachedImages.html('');

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
								// prepare paremetes
								$image.attr('src', parsedImagesInfo[imageKey]);
								$attachment.attr('data-image-id', imageKey)
								// add to container
								self.$modalGalleryAttachedImages.append($attachment);
							}
						}
					}
				}

				self.modalWndImageEvents();
				self.$galleryModalWnd.mpModal('showModal');
			} else {
				Snackbar.show({text: $('.mbsStrIncorrectGalleryParams').val()});
			}
		});
	});

	GalleryForMembership.prototype.modalWndPage2Init = (function() {
		var self = this;
		$('.mbs-modal-page2-btn-ok').on('click', function() {
			self.$galleryModalWnd.mpModal('hide');
		});

		this.modalWndImageEvents();
		this.modalWndRemoveImageInit();
		this.modalWndAddImageInit();
	});

	GalleryForMembership.prototype.galleryItemInformationUpdate = (function(galleryId, attachment, updateType) {
		if(attachment && attachment.id && updateType) {

			var imageId = parseInt(attachment.id);
			if(!isNaN(imageId)) {
				var $galleryItem = $('.mbs-photo-gallery-container .mbs-one-gg-image[data-gallery-id="' + galleryId + '"]')
				,	imageInfo = $galleryItem.data('images')
				,	parsedImageInfo = {};

				if(imageInfo) {
					parsedImageInfo = JSON.parse(imageInfo);
				}

				if(updateType == 1 && attachment.src) {
					// add
					parsedImageInfo[attachment.id] = attachment.src;
					$galleryItem.data('images', JSON.stringify(parsedImageInfo));
				} else if(updateType == 2) {
					//remove
					delete parsedImageInfo[attachment.id];
					$galleryItem.data('images', JSON.stringify(parsedImageInfo));
				}

				var arraySort = this.$modalGalleryAttachedImages.sortable('toArray', {'attribute': 'data-image-id'})
				$galleryItem.data('img-sort', JSON.stringify(arraySort));
			}
		}
	});

	GalleryForMembership.prototype.modalWndRemoveImageInit = (function() {
		var selfGallery = this
		,	$removeButton = $('#mbs-photo-gg-remove-image');
		$removeButton.removeClass('disabled');

		$removeButton.on('click', function() {
			var vGalleryId = selfGallery.$modalGalleryAttachedImages.data('gallery-id')
			,	$chainRemove
			,	$images = $('.mbs-gg-img-list .mbs-one-gg-image.selected');

			if($images.length) {
				$images.each(function(index, item) {
					var currImage = $(item)
					,	imageId = currImage.data('image-id');
					if(imageId && vGalleryId) {
						$removeButton.addClass('disabled');
						$chainRemove = Membership.api.gallery.removeImage({
							'gallery_id': vGalleryId,
							'image_id': imageId,
						}).then(function(response) {
							if(response) {
								if(response.success) {
									currImage.hide(400, function() {
										currImage.remove();
										selfGallery.galleryItemInformationUpdate(vGalleryId, {'id': imageId}, 2);
									});

								} else {
									if(response.message) {
										Snackbar.show({text: response.message});
									} else {
										Snackbar.show({text: $('#mbsStrServerError').val()});
									}
								}
							} else {
								Snackbar.show({text: $('#mbsStrServerError').val()});
							}
						}, function(errResponse) {
							Snackbar.show({text: $('#mbsStrServerError').val()});
						});
					} else {
						Snackbar.show({text: $("#mbsStrImageParamIncorrect").val()});
					}
				});
				if($chainRemove) {
					$chainRemove.always(function() {
						$removeButton.removeClass('disabled');
					});
				}
			} else {
				Snackbar.show({text: $("#mbsStrSelectImageToRemove").val()});
			}

		});
	});

	GalleryForMembership.prototype.ModalPage2ButtonsSetDisable = (function (isDisable) {
		var $buttons = $('#mbs-photo-gg-add-image, #mbs-photo-gg-remove-image, #mbs-gg-modal-page2-ok, #mbs-gg-modal-page2-cancel');
		if(isDisable) {
			$buttons.addClass('disabled');
		} else {
			$buttons.removeClass('disabled');
		}
	});

	GalleryForMembership.prototype.modalWndAddImageInit = (function() {
		var self = this
		,	$addButton = $('#mbs-photo-gg-add-image');
		self.ModalPage2ButtonsSetDisable(false);

		// Image add behavior
		$addButton.on('click', function() {
			var galleryId = self.$modalGalleryAttachedImages.data('gallery-id');
			if(galleryId && !isNaN(parseInt(galleryId))) {
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

							self.$modalGalleryAttachedImages.append($attachment);

							reader.onload = (function(event) {
								$image.attr('src', event.target.result);
							});

							reader.readAsDataURL(files[i]);

							$chainUpload = $chainUpload.then(function() {
								return self.uploadImage(files[i], $progressBar, galleryId).then(function(response) {
									if(response.attachment && response.attachment.id) {
										$image.attr('src', response.attachment.src);
										$attachment.attr('data-image-id', response.attachment.id);
										self.$modalGalleryAttachedImages.stop(true).animate({
											scrollLeft: ($attachment.get(0).offsetLeft + $attachment.width())
										}, 500);
										self.galleryItemInformationUpdate(galleryId, response.attachment, 1);
										$progressBar.remove();
										self.modalWndImageEvents();
									} else {
										$attachment.remove();
										if(response.message) {
											Snackbar.show({text: response.message});
										} else {
											Snackbar.show({text: $('#mbsStrServerError').val()});
										}
									}
								}, function(response) {
									$attachment.remove();
									if(response.message) {
										Snackbar.show({text: response.message});
									} else {
										Snackbar.show({text: $('#mbsStrServerError').val()});
									}
									return $.Deferred().resolve();
								});
							});

						})(i);
					}
					self.$galleryModalWnd.mpModal('refresh');

					$chainUpload.always(function() {
						self.ModalPage2ButtonsSetDisable(false);
					});
				});
			} else {
				Snackbar.show({text: $("#mbsStrGalleryParamIncorrect").val()});
			}
		});
	});

	GalleryForMembership.prototype.uploadImage = (function(file, $progressBar, paramGalleryId) {
		return Membership.api.gallery.uploadImage({
			image: file,
			'galleryId': paramGalleryId,
			uploadProgress: function(event) {
				if (event.lengthComputable) {
					$progressBar.mpProgress('set percent', parseInt((event.loaded / event.total) * 100));
				}
			}
		});
	});

	GalleryForMembership.prototype.modalWndInit = (function() {
		var self1 = this;
		this.$galleryModalWnd = $('.mp-photo-gallery-modal');
		this.$modalGalleriesSelectorList = $('#photoGalleryPresetSel');
		this.$modalNextButton = $('#mbs-photo-gg-next');
		this.$modalGalleryAttachedImages = $('.mbs-gg-img-list');
		this.$modalGalleryAttachedImages.sortable({
			update: function (event, ui) {
				var galleryId = self1.$modalGalleryAttachedImages.data('gallery-id');
				if(!isNaN(parseInt(galleryId))) {
					var $galleryItem = $('.mbs-photo-gallery-container .mbs-one-gg-image[data-gallery-id="' + galleryId + '"]');
					var arraySort = self1.$modalGalleryAttachedImages.sortable('toArray', {'attribute': 'data-image-id'});
					$galleryItem.data('img-sort', JSON.stringify(arraySort));
					Membership.api.gallery.setImagesPosition({
						'image_array': arraySort,
					}).then(function(response){}, function(response) {});
				}
			},
		});
		this.$modalGalleryContainer = $('.mbs-photo-gallery-container');
		this.$modalGalleryContainer.sortable({
			update: function() {
				self1.modalWndGallerySortFunc(self1);
			},
		});

		this.modalWndGalleryButtonInit();
		// init modal window
		this.$galleryModalWnd.mpModal({
			'closable' : 0,
		});
		this.modalWndGalleriesEvents();
		this.modalWndPage1Init();
		this.modalWndPage2Init();
	});

	GalleryForMembership.prototype.modalWndGallerySortFunc = (function(selfParam) {
		var gallArraySort = selfParam.$modalGalleryContainer.sortable('toArray', {'attribute': 'data-gallery-id'});
		selfParam.$modalGalleryContainer.data('gallery-sort', JSON.stringify(gallArraySort));
		Membership.api.gallery.setGalleryPosition({
			'gallery_array': gallArraySort,
		}).then(function(response){}, function(response) {});
	});

	$galleryPluginForMembership = new GalleryForMembership();

})(jQuery, Membership);