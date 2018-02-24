(function($) {
	function mbsAttachmentMessageBehavior() {

	}

	mbsAttachmentMessageBehavior.prototype.init = (function($parent) {

		this.$attachmentList = $parent.find('.mbs-all-attachment-list');
		this.$attachmentButton = $parent.find('.mbs-add-attachment');
		this.$attachTemplate = $($('.mbs-all-attachment-template').html());
		this.$addAttachmentBtn = $('.mbsAttMessSendBtn');

		this.initHandlers();
	});

	mbsAttachmentMessageBehavior.prototype.initHandlers = (function() {
		var self2 = this;
		this.$attachmentButton.off('click').on('click', function() {
			var $uploadFileInput = $('<input type="file" name="files" multiple >');
			$uploadFileInput.on('change', function(event) {
				self2.selectFilesHandler(event);
			});
			$uploadFileInput.trigger('click');
		});
	});

	mbsAttachmentMessageBehavior.prototype.initMessageConversationContainer = (function() {

		this.clearAttachmentWrapper(true);
		this.$attachmentList = $('.send-message-reply-form .mbsAllAttachmentList2:visible');
		this.$attachmentButton = $('.send-message-reply-form .mbsAddAttachment2:visible');
		this.$attachTemplate = $($('.mbs-all-attachment-template').html());
		this.$addAttachmentBtn = $('.send-message-reply-form .mbsAttMessSendBtn2:visible');

		this.initHandlers();
	});

	mbsAttachmentMessageBehavior.prototype.clearAttachmentWrapper = (function(notHideAttachmentList) {
		if(this.$attachmentList && this.$attachmentList.length) {
			this.$attachmentList.find('.mbs-one-any-attachment').remove();
			if(!notHideAttachmentList) {
				this.$attachmentList.hide();
			}
		}
	});

	mbsAttachmentMessageBehavior.prototype.selectFilesHandler = (function(event) {
		event.preventDefault();
		var files = event.target.files || event.dataTransfer.files
		,	$chainUpload = $.Deferred().resolve()
		,	self2 = this
		,	attachmentCount = files.length
		;
		if (files.length) {
			self2.$attachmentList.show();
		}
		for (var i = 0; i < files.length; i++) {
			(function(i) {
				self2.$addAttachmentBtn.prop('disabled', true);
				var	reader = new FileReader(),
					$attachmentDiv = self2.$attachTemplate.clone(),
					$attachmentCaption = $attachmentDiv.find('.mbs-image-caption'),
					$attachmentImage = $attachmentDiv.find('.mbs-att-image'),
					$progressBar = $attachmentDiv.find('.ui.progress').mpProgress();

				$attachmentDiv.find('i.close.icon').on('click', function() {
					$attachmentDiv.remove();
					if (!self2.$attachmentList.children().length) {
						self2.$attachmentList.hide();
					}
				});

				self2.$attachmentList.append($attachmentDiv);
				$(window).trigger('resize');
				//reader.onload = (function(event) {
				//	// $attachmentDiv.attr('src', event.target.result);
				//});


				reader.readAsDataURL(files[i]);
				$chainUpload = $chainUpload.then(function() {
					return self2.uploadFile(files[i], $progressBar).then(function(response) {
						if(!response || response.error) {
							$attachmentDiv.remove();
							Snackbar.show({text: response.error});
						} else {
							if(response['attachment_type_code'].indexOf('image') != -1) {
								$attachmentImage.attr('src', response['url']);
							}
							$attachmentDiv.attr('data-attachment-id', response['attachment_id']);
							$attachmentDiv.attr('title', response['file_name']);
							$attachmentCaption.text(response['file_name']);
							$progressBar.remove();
						}
					}, function(response) {
						var errorText = 'Error occured';
						if(response) {
							if(response.statusText) {
								errorText = response.statusText;
							}
							if(response.responseJSON && response.responseJSON.error) {
								errorText = response.responseJSON.error;
							}
						}
						Snackbar.show({text: errorText});
						$attachmentDiv.remove();
						return $.Deferred().resolve();
					});
				})
				.always(function() {
					attachmentCount = attachmentCount - 1;
					if(attachmentCount == 0) {
						self2.$addAttachmentBtn.prop('disabled', false);
					}
				});
			})(i);
		}

		$chainUpload.then(function() {
			if (!self2.$attachmentList.has('*').length) {
				self2.$attachmentList.hide();
			}
		})

	});

	mbsAttachmentMessageBehavior.prototype.uploadFile = (function(myFiles, $progressBar) {
		return Membership.api.base.uploadAnyFile({
			'uFile': myFiles,
			'uploadProgress': function(event) {
				if (event.lengthComputable) {
					$progressBar.mpProgress('set percent', parseInt((event.loaded / event.total) * 100));
				}
			}
		});
	});

	mbsAttachmentMessageBehavior.prototype.getAttachedIds = (function() {
		var attachedIds = [];
		this.$attachmentList
			.find('.mbs-one-any-attachment')
			.each(function(ind, attItem) {
				var $attItem = $(attItem);
				attachedIds.push(parseInt($attItem.attr('data-attachment-id')));
			});

		return attachedIds;
	});

	window.mbsAttachmentMessageBehavior = mbsAttachmentMessageBehavior;
}) (jQuery);