(function($, Membership) {

	if (typeof moment !== "undefined") {
		moment.locale(Membership.locale.split('_').shift());
	}

	var $imageAttachmentTemplate = $($('#mbsImageAttachmentTemplate').html()),
		gallery = new Gallery();

	var ActivityPostForm = function(container) {

		var activityPostForm = new ActivityForm(container.$activityPostForm),
			$postFormSubmitButton = activityPostForm.$el.find('[data-action="post-activity"]'),
			$activityPostForm = activityPostForm.$el;

		if (container.activityContext === 'group') {
			var isCommunityPost = false,
				$activityAuthor = $activityPostForm.find('.mp-activity-author'),
				$groupLogo = $activityPostForm.find('.activity-author-group'),
				$userAvatar = $activityPostForm.find('.activity-author-user');

			$activityAuthor.mpDropdown({
				action: 'select',
				onChange: function(value){
					if (value === 'group') {
						$groupLogo.show();
						$userAvatar.hide();
						isCommunityPost = true;
					} else {
						$groupLogo.hide();
						$userAvatar.show();
						isCommunityPost = false;
					}
				}

			});

			if ($groupLogo.length) {
				$activityAuthor.mpDropdown('set value', 'group');
			}
		}

		$postFormSubmitButton.on('click', function() {

			var message = $.trim(activityPostForm.$textarea.val()),
				$galleryContainer = $('.mbs-photo-gallery-container'),
				$sliderContainer = $('.mbs-slider-container'),
				$googleMapsEasyContainer = $('.mbs-google-maps-container'),
				data = {
					message: message,
					images: [],
					'files': [],
					galleries: [],
					sliders: [],
					googleMapsEasy: [],
					link: activityPostForm.attachmentLink
				};

			$.map(activityPostForm.$fileAttachmentList.children('.mbs-one-any-attachment[data-is-image="1"]'), function(attachment) {
				data.images.push($(attachment).attr('data-attachment-id'));
			});

			$.map(activityPostForm.$fileAttachmentList.children('.mbs-one-any-attachment[data-is-image="0"]'), function(attachment) {
				data.files.push($(attachment).attr('data-attachment-id'));
			});

			$.map($galleryContainer.children(), function(gallery) {
				data.galleries.push($(gallery).attr('data-gallery-id'));
			});

			$.map($sliderContainer.children(), function(slider) {
				data.sliders.push($(slider).attr('data-slider-id'));
			});

			$.map($googleMapsEasyContainer.children(), function(map) {
				data.googleMapsEasy.push($(map).attr('data-google-maps-id'));
			});

			if(data.galleries.length) {
				for(var ind = 0; ind < data.galleries.length; ind++) {
					data.message += '<img data-gallery-id="' + data.galleries[ind] + '" class="mbs-gg-unique-class"/> ';
				}
			}

			if(data.sliders.length) {
				for(var slInd = 0; slInd < data.sliders.length; slInd++) {
					data.message += '<img data-slider-id="' + data.sliders[slInd] + '" class="mbs-rs-unique-class"/> ';
				}
			}

			if(data.googleMapsEasy.length) {
				for(var gmeInd = 0; gmeInd < data.googleMapsEasy.length; gmeInd++) {
					data.message += '<img data-google-maps-easy-id="' + data.googleMapsEasy[gmeInd] + '" class="mbs-gme-unique-class"/> ';
				}
			}

			$postFormSubmitButton.attr('disabled', true).addClass('loading disabled');

			var request = $.Deferred().reject();

			switch (container.activityContext) {
				case 'activity':
					request = Membership.api.activity.post({
						userId: Membership.get('currentUser.id'),
						data: data
					});
					break;
				case 'profile':
					request = Membership.api.activity.post({
						userId: Membership.get('requestedUser.id'),
						data: data
					});
					break;
				case 'group':
					request = Membership.api.groups.postActivity({
						groupId: Membership.get('requestedGroup.id'),
						data: data,
						isCommunityPost: isCommunityPost
					});
					break;
				default:
					return;
			}

			request.then(function(response) {
				if (response.success) {
					var $activities = $(response.html).filter('.mp-activity');
					container.$activitiesList.prepend($activities);
					container.initActivities($activities);
                    Membership.ActivityAfterSuccessPostSubmit(response.id, message, container.activityContext);
					container.$noActivitiesMessage.hide();
				}else{
					Snackbar.show({text: response.message});
				}

				container.$activitiesList.children().slice(0, 1).fadeTo(0, 0).fadeTo(700, 1);

				activityPostForm.$textarea.val('').trigger('change');
				activityPostForm.$fileAttachmentList.empty().hide();
				activityPostForm.attachmentLink = null;
				$galleryContainer.html('').addClass('mbs-hidden');
				$sliderContainer.html('').addClass('mbs-hidden');
				$googleMapsEasyContainer.html('').addClass('mbs-hidden');

				activityPostForm.$attachmentLinkContainer.hide().find('.mp-activity-link').remove();
				$postFormSubmitButton.removeAttr('disabled').removeClass('loading disabled');
			});

		});

		activityPostForm.$el.show();
		container.$activityContainer.prepend(activityPostForm.$el);
	};

    Membership.ActivityAfterSuccessPostSubmit = function ActivityAfterSuccessPostSubmit(activityId, message, activityType) {};

	var ActivityEditForm = function($activity, activity) {

		var EditForm = new ActivityForm(activity.container.$activityPostForm.clone()),
			activityId = $activity.attr('data-activity-id'),
			$activityContent = $activity.find('.mp-activity-content:first'),
			$activityGalleryFirst = $activity.find('.segment > .mp-activity-content > .mp-activity-gallery  .mp-activity-gallery-image').first(),
			$activityGalleryFirstId = $activityGalleryFirst.attr('data-image-id'),
			$activityLinkOriginal = $activityContent.find('.mp-activity-link'),
			$activityLink = $activityLinkOriginal.clone();
		
			Membership.api.base.getImages({
				imageId: $activityGalleryFirstId + '.' + activityId,
			}).then(function(response) {
				if (response.success) {
					response.images.forEach(function (item) {
						var attachmentId = item.id
							,   imgSrc = item.source;
						
						var imgWrapperHtml = '<div class="mp-attachment-image mbs-one-any-attachment" data-attachment-id="">\n' +
							'\t\t<img class="ui image" src="">\n' +
							'\t\t<div class="mp-attachment-image-overlay"></div>\n' +
							'\t\t<div class="mp-progress-bar">\n' +
							'\n' +
							'\t\t</div>\n' +
							'\t\t<i class="close icon"></i>\n' +
							'\t</div>';
						
						var imgWrapper = $($.parseHTML( imgWrapperHtml ));
						imgWrapper.attr('data-attachment-id', attachmentId).attr('data-is-image', '1');
						imgWrapper.find('img').attr('src', imgSrc);
						
						EditForm.$fileAttachmentList.append(imgWrapper);
					});
				}
			}).then(function() {
				Membership.api.base.getAttachmentFiles({
					'activity_id': activityId,
				}).then(function(response) {
					if(response && !response.errors) {
						var attachKeyArr = Object.keys(response.attachments);
						if(attachKeyArr.length) {
							// get array list
							var attachmList = response.attachments[attachKeyArr[0]];
							if(attachmList && attachmList.length) {
								for(var ind1 = 0; ind1 < attachmList.length; ind1++) {
									var $oneAttachmentFile = $imageAttachmentTemplate.clone()
									,	$progressBar = $oneAttachmentFile.find('.mp-progress-bar')
									,	$attachmentCaption = $oneAttachmentFile.find('.mbs-image-caption')
									;
									$progressBar.remove();
									// init values
									$oneAttachmentFile.attr('data-attachment-id', attachmList[ind1]['attachment_all_id']);
									$oneAttachmentFile.attr('title', attachmList[ind1]['file_info']['name']);
									$oneAttachmentFile.attr('data-is-image', 0);
									$attachmentCaption.text(attachmList[ind1]['file_info']['name']);
									EditForm.$fileAttachmentList.append($oneAttachmentFile);
									// remove event
									$oneAttachmentFile.find('i.close.icon').on('click', function() {
										var $this = $(this)
										,	$attachmentWr = $this.closest('.mbs-one-any-attachment');
										$attachmentWr.remove();
										if (!EditForm.$fileAttachmentList.children().length) {
											EditForm.$fileAttachmentList.hide();
										}
									});
								}
							}
						}
					}
				});
			});
		
		EditForm.$el.find('.post-form-buttons .post-activity-buttons').hide();
		EditForm.$el.find('.post-form-buttons .edit-activity-buttons').show();
		EditForm.$el.show();
		EditForm.$fileAttachmentList.show();
		EditForm.$el.insertAfter($activityContent.hide());

		var activitiContentStr = $activityContent.attr('data-activity-data')
		,	sliderContent = ''
		,	googleMapsEasyContent = ''
		,	galleryContent = '';
		// prepare galleries code
		if(EditForm.galleryInfo && EditForm.galleryInfo.activityUpdate) {
			activitiContentStr = EditForm.galleryInfo.activityUpdate($activityContent);
			if(EditForm.galleryInfo.galleryContent) {
				galleryContent = EditForm.galleryInfo.galleryContent;
			}
		}
		// prepare sliders code
		if(EditForm.sliderInfo && EditForm.sliderInfo.activityUpdate) {
			activitiContentStr = EditForm.sliderInfo.activityUpdate($activityContent);
			if(EditForm.sliderInfo.sliderContent) {
				sliderContent = EditForm.sliderInfo.sliderContent;
			}
		}
		// prepare google maps easy
		if(EditForm.googleMapsEasyInfo && EditForm.googleMapsEasyInfo.activityUpdate) {
			activitiContentStr = EditForm.googleMapsEasyInfo.activityUpdate($activityContent);
			if(EditForm.googleMapsEasyInfo.googleMapsEasyContent) {
				googleMapsEasyContent = EditForm.googleMapsEasyInfo.googleMapsEasyContent;
			}
		}
		
		EditForm.$textarea.val(activitiContentStr);
		
		if ($activityLink.length) {
			EditForm.$attachmentLinkContainer.append($activityLink);
			EditForm.attachmentLink = $activityLink.attr('data-hash');
			EditForm.$attachmentLinkContainer.show();

			$activityLink.find('.mp-remove-attached-link').show().on('click', function() {
				$activityLink.remove();
				EditForm.$attachmentLinkContainer.hide();
				EditForm.attachmentLink = null;
			});
		}
		
		EditForm.$el.find('textarea').focusTextToEnd();
		$('body').on('click', 'i.close.icon', function(){
			var wrapperImg = $(this).closest('.mp-attachment-image')
			,   wrapperAllImages = $(this).closest('.mp-attachment-images');
			wrapperImg.remove();
			if (!wrapperAllImages.children().length) {
				wrapperAllImages.hide();
			}
		});
		
		EditForm.$el.on('click', '.post-form-buttons [data-action="cancel"]', function() {
			EditForm.$el.remove();
			$activityContent.show();
		});

		EditForm.$el.on('click', '.post-form-buttons [data-action="save"]', function(event) {
			var data = {
					message: $.trim(EditForm.$textarea.val() + galleryContent + sliderContent + googleMapsEasyContent),
					images: [],
					'files': [],
					link: EditForm.attachmentLink
				},
				$saveButton = $(event.target);
			
			$.map(EditForm.$fileAttachmentList.children('.mbs-one-any-attachment[data-is-image="1"]'), function(attachment) {
				data.images.push($(attachment).attr('data-attachment-id'));
			});
			$.map(EditForm.$fileAttachmentList.children('.mbs-one-any-attachment[data-is-image="0"]'), function(attachment) {
				data.files.push($(attachment).attr('data-attachment-id'));
			});
			EditForm.$el.find('.post-form-buttons button').attr('disabled', true).addClass('disabled');
			$saveButton.addClass('loading disabled');
			Membership.api.activity.update({
				activityId: activityId,
				data: data
			}).then(function(response) {
				var $activities = $(response.html);
				$activity.replaceWith($activities);
				activity.container.initActivities($activities);
				
			});
			
		});
	};

	var CommentForm = function(activity) {

		var $activity = activity.$el,
			activityId = $activity.attr('data-activity-id'),
			commentPostForm = new ActivityForm($activity.find('.mp-activity-comments > .mp-activity-comment-form')),
			$commentPostForm = commentPostForm.$el,
			$commentButtons = $commentPostForm.find('.post-form-buttons'),
			$loader = $commentButtons.find('.loading'),
			$sendCommentButton = $commentPostForm.find('[data-action="send-comment"]'),
			$commentButton = $activity.find('.mp-activity-actions .comment-action'),
			$commentsContainer = $activity.find('.mp-activity-comments'),
			$commentsList = $commentsContainer.find('.comments:first');

		$commentButton.on('click', function() {
			$commentsContainer.slideToggle("400");
		});

		if (activity.container.activityContext === 'group') {
			var $commentAuthor = $commentPostForm.find('.mp-comment-form-author'),
				$commentAuthorDropdown = $commentAuthor.find('> .dropdown'),
				groupId = $commentAuthor.attr('data-group-id'),
				$groupLogo = $commentPostForm.find('.activity-author-group'),
				$userAvatar = $commentPostForm.find('.activity-author-user');


			$commentAuthorDropdown.mpDropdown({
				action: 'select',
				onChange: function(value){
					if (value === 'group') {
						$groupLogo.show();
						$userAvatar.hide();
						groupId = $commentAuthor.attr('data-group-id');
					} else {
						$groupLogo.hide();
						$userAvatar.show();
						groupId = null;
					}
				}
			});

			if ($groupLogo.length) {
				$commentAuthorDropdown.mpDropdown('set value', 'group');
			} else {
				$commentAuthorDropdown.mpDropdown('set value', 'user');
			}

		}

		//Send comment
		$sendCommentButton.on('click', function() {
			var data = {
				message: $.trim(commentPostForm.$textarea.val()),
				images: [],
				'files': [],
				link: commentPostForm.attachmentLink
			};

			$.map(commentPostForm.$fileAttachmentList.children('.mbs-one-any-attachment[data-is-image="1"]'), function(attachment) {
				data.images.push($(attachment).attr('data-attachment-id'));
			});

			$.map(commentPostForm.$fileAttachmentList.children('.mbs-one-any-attachment[data-is-image="0"]'), function(attachment) {
				data.files.push($(attachment).attr('data-attachment-id'));
			});

			commentPostForm.$textarea.attr('disabled', true);

			var request = $.Deferred().reject();

			switch (activity.container.activityContext) {
				case 'activity':
				case 'search':
				case 'profile':
					request = Membership.api.comments.post({
						activityId: activityId,
						data: data
					});
					break;
				case 'group':
					request = Membership.api.comments.post({
						activityId: activityId,
						data: data,
						postAsGroup: groupId
					});
					break;
				default:
					request = Membership.api.comments.post({
						activityId: activityId,
						data: data
					});
			}

			$commentButtons.find('> *').hide();
			$loader.show();


			request.then(function(response) {
				if (response.success) {
					var $comments = $(response.html);
					$commentsList.append($comments);
					$commentsList.show();
					activity.comments.totalComments++;
					activity.comments.showedComments++;
					activity.comments.updateCommentsCounters();
					initComments($comments, activity);
					$commentsList.find('.comment:last').fadeTo(0, 0).fadeTo(700, 1);

					commentPostForm.$textarea.val('').trigger('change');
					commentPostForm.$fileAttachmentList.empty().hide();
					commentPostForm.attachmentLink = null;
					commentPostForm.$attachmentLinkContainer.hide().find('.mp-activity-link').remove();
				} else {
					var message = 'Error occurred!';
					if(response.message) {
						message = response.message;
					}
					Snackbar.show({'text': message});
				}

				commentPostForm.$textarea.removeAttr('disabled');
				$commentButtons.find('> *').show();
				$loader.hide();
			});
		});

		return commentPostForm;
	};

	var CommentEditForm = function(comment, isReply) {

		var commentEditForm = new ActivityForm(comment.activity.commentForm.$el.clone()),
			$commentEditForm = commentEditForm.$el,
			$comment = comment.$el,
			$commentContainer = $comment.find('.comment-container:first'),
			$commentContent = $comment.find('.mp-comment-content:first .text'),
			$commentLinkOriginal = $commentContainer.find('.mp-activity-link'),
			$commentLink = $commentLinkOriginal.clone(),
			$commentFormAction = $commentEditForm.find('.mp-comment-form-action').hide(),
			$commentEditFormAction = $commentEditForm.find('.mp-comment-form-edit-action').show(),
			$commentSaveActionButton = $commentEditFormAction.find('[data-action="save"]'),
			$commentCancelActionButton = $commentEditFormAction.find('[data-action="cancel"]');

		if (comment.activity.container.activityContext === 'group') {
			$commentEditForm
				.find('.mp-comment-form-author')
				.removeClass('comment-as')
				.html($comment.find('.avatar img').clone());
		}

		$commentEditForm.insertAfter($commentContainer.hide());
		commentEditForm.$textarea.val($commentContent.attr('data-comment-data'));

		if ($commentLink.length) {
			commentEditForm.$attachmentLinkContainer.append($commentLink);
			commentEditForm.attachmentLink = $commentLink.attr('data-hash');
			commentEditForm.$attachmentLinkContainer.show();

			$commentLink.find('.mp-remove-attached-link').show().on('click', function() {
				$commentLink.remove();
				commentEditForm.$attachmentLinkContainer.hide();
				commentEditForm.attachmentLink = null;
			});
		}

		$commentCancelActionButton.on('click', function() {
			commentEditForm.$el.remove();
			$commentContainer.show();
			$commentFormAction.show();
		});

		$commentSaveActionButton.on('click', function(event) {

			var data = {
					message: $.trim(commentEditForm.$textarea.val()),
					images: [],
					link: commentEditForm.attachmentLink
				},
				$saveButton = $(event.target);

			$saveButton.addClass('loading disabled');

			Membership.api.comments.update({
				commentId: comment.commentId,
				data: data
			}).then(function(response) {
				var $comments = $(response.html);
				$comment.replaceWith($comments);

				if (isReply) {
					initReplies($comments, comment);
				} else {
					initComments($comments, comment.activity);
				}

			});
		});

		return commentEditForm;
	};

	var CommentReplyForm = function(comment) {

		var $comment = comment.$el,
			commentId = $comment.attr('data-comment-id'),
			replyCommentForm = new ActivityForm($comment.find('.comments .mp-reply-form')),
			$replyCommentPostForm = replyCommentForm.$el,
			$repliesList = $comment.find('.comment-replies'),
			$commentButtons = $replyCommentPostForm.find('.post-form-buttons'),
			$loader = $commentButtons.find('.loading'),
			$sendReplyButton = $replyCommentPostForm.find('[data-action="send-comment"]');

		if (comment.activity.container.activityContext === 'group') {
			var $commentAuthor = $replyCommentPostForm.find('.mp-comment-form-author'),
				groupId = $commentAuthor.attr('data-group-id');

			$commentAuthor.find('> .dropdown').mpDropdown({
				action: 'select',
				onChange: function(value){
					if (value === 'group') {
						$replyCommentPostForm.find('.activity-author-group').show();
						$replyCommentPostForm.find('.activity-author-user').hide();
						groupId = $commentAuthor.attr('data-group-id');
					} else {
						$replyCommentPostForm.find('.activity-author-group').hide();
						$replyCommentPostForm.find('.activity-author-user').show();
						groupId = null;
					}
				}
			});
		}

		$sendReplyButton.on('click', function() {
			var data = {
				message: $.trim(replyCommentForm.$textarea.val()),
				images: [],
				'files': [],
				link: replyCommentForm.attachmentLink
			};

			$.map(replyCommentForm.$fileAttachmentList.children('.mbs-one-any-attachment[data-is-image="1"]'), function(attachment) {
				data.images.push($(attachment).attr('data-attachment-id'));
			});

			$.map(replyCommentForm.$fileAttachmentList.children('.mbs-one-any-attachment[data-is-image="0"]'), function(attachment) {
				data.files.push($(attachment).attr('data-attachment-id'));
			});

			replyCommentForm.$textarea.attr('disabled', true);

			var request = $.Deferred().reject();

			switch (comment.activity.container.activityContext) {
				case 'activity':
				case 'search':
				case 'profile':
					request = Membership.api.comments.reply({
						commentId: commentId,
						data: data
					});
					break;
				case 'group':
					request = Membership.api.comments.reply({
						commentId: commentId,
						data: data,
						postAsGroup: groupId
					});
					break;
				default:
					request = Membership.api.comments.reply({
						commentId: commentId,
						data: data
					});
			}


			$commentButtons.find('> *').hide();
			$loader.show();

			request.then(function(response) {
				if (response.success) {
					var $replies = $(response.html);
					$repliesList.append($replies);
					comment.replies.totalReplies++;
					comment.replies.showedReplies++;
					comment.replies.updateRepliesCounters();
					initReplies($replies, comment);
					$repliesList.show();
					$repliesList.find('.comment:last').fadeTo(0, 0).fadeTo(700, 1);
				}

				replyCommentForm.$textarea.val('').trigger('change');
				replyCommentForm.$fileAttachmentList.empty().hide();
				replyCommentForm.attachmentLink = null;
				replyCommentForm.$attachmentLinkContainer.hide().find('.mp-activity-link').remove();
				replyCommentForm.$textarea.removeAttr('disabled');
				$commentButtons.find('> *').show();
				$loader.hide();
			});
		});

		return replyCommentForm;
	};

	function GalleryInfo() {
		this.galleryContent = '';
	}

	GalleryInfo.prototype.activityUpdate = (function($activityContent) {
		this.galleryContent = '';
		$activityContent.attr('data-gallery-data', '');
		var activitiContentStr = $activityContent.attr('data-activity-data')
		,	galleryContentMatches = null
		,	galleryContentPatt = new RegExp('<img data-gallery-id="[\\d]+" class="mbs-gg-unique-class"/>', iePrepareRegex2Param('gi'));

		while(galleryContentMatches = galleryContentPatt.exec($activityContent.attr('data-activity-data'))) {
			this.galleryContent += galleryContentMatches[0];
			activitiContentStr = activitiContentStr.replace(galleryContentMatches[0], '');
			$activityContent.attr('data-gallery-data', this.galleryContent);
		}

		return activitiContentStr;
	});

	function SliderInfo() {
		this.sliderContent = '';
	}

	SliderInfo.prototype.activityUpdate = (function($activityContent) {
		this.sliderContent = '';
		var activityContentStr = $activityContent.attr('data-activity-data')
		,	sliderContentMatches = null
		,	sliderContentPattern = new RegExp('<img data-slider-id="[\\d]+" class="mbs-rs-unique-class"/>', iePrepareRegex2Param('gi'));

		while(sliderContentMatches = sliderContentPattern.exec($activityContent.attr('data-activity-data'))) {
			this.sliderContent += sliderContentMatches[0];
			activityContentStr = activityContentStr.replace(sliderContentMatches[0], '');
		}
		$activityContent.attr('data-slider-data', this.sliderContent);

		return activityContentStr;
	});

	function GoogleMapsEasyInfo() {
		this.googleMapsEasyContent = '';
	}

	GoogleMapsEasyInfo.prototype.activityUpdate = (function($activityContent) {
		this.googleMapsEasyContent = '';
		var activityContentStr = $activityContent.attr('data-activity-data')
		,	gmeContentMatches = null
		,	gmeContentPattern = new RegExp('<img data-google-maps-easy-id="[\\d]+" class="mbs-gme-unique-class"/>', iePrepareRegex2Param('gi'));

		while(gmeContentMatches = gmeContentPattern.exec($activityContent.attr('data-activity-data'))) {
			this.googleMapsEasyContent += gmeContentMatches[0];
			activityContentStr = activityContentStr.replace(gmeContentMatches[0], '');
		}
		$activityContent.attr('data-google-maps-easy-data', this.googleMapsEasyContent);
		return activityContentStr;
	});

	function ActivityForm($postForm) {

		this.attachmentLink = null;

		var self = this,
			$textarea = $postForm.find('textarea'),
			$addImageAttachmentButton = $postForm.find('[data-action="mbs-add-attachment"]'),
			$smilesButton = $postForm.find('.button[data-action="add-smile-to-text"]'),
			$fileAttachmentList = $postForm.find('.mp-attachment-images');

		$addImageAttachmentButton.on('click', function() {

			$('<input type="file" name="file" multiple accept="*.*">').on('change', function(event) {
				event.preventDefault();
				var files = event.target.files || event.dataTransfer.files;

				if (files.length) {
					$fileAttachmentList.show();
				}

				var $chainUpload = $.Deferred().resolve();

				for (var i = 0; i < files.length; i++) {

					(function(i) {

						var	reader = new FileReader(),
							$attachment = $imageAttachmentTemplate.clone(),
							$attachmentFile = $attachment.find('.mbs-att-image'),
							$progressBar = $attachment.find('.ui.progress').mpProgress(),
							$attachmentCaption = $attachment.find('.mbs-image-caption'),
							isAttachmImage = 0;


						if(files[i].type && files[i].type.indexOf('image') != '-1') {
							var fileName = files[i].name
							,	ext = ''
							,	extPos = fileName.lastIndexOf('.');
							if(extPos != -1) {
								ext = fileName.substr(extPos + 1);
								if(['jpg', 'jpeg', 'png', 'gif', 'ico'].indexOf(ext.toLowerCase()) !== -1) {
									isAttachmImage = 1;
								}
							}
						}

						$attachment.find('i.close.icon').on('click', function() {
							$attachment.remove();
							if (!$fileAttachmentList.children().length) {
								$fileAttachmentList.hide();
							}
						});

						$fileAttachmentList.append($attachment);

						if(isAttachmImage) {
							reader.onload = (function(event) {
								$attachmentFile.attr('src', event.target.result);
							});
						}

						reader.readAsDataURL(files[i]);
						$chainUpload = $chainUpload.then(function() {

							function attachFileUploadHandler(response) {
								if(!response || response.error || !response.success) {
									$attachment.remove();
									var errorText = 'Error occured';
									if(response.message) {
										errorText = response.message;
									}
									if(response.error) {
										errorText = response.error;
									}
									Snackbar.show({text: errorText});
								} else {
									if(response['isImage']) {
										$attachmentFile.attr('src', response['url']);
									}
									$attachment.attr('data-attachment-id', response['attachment_id']);
									$attachment.attr('title', response['file_name']);
									$attachmentCaption.text(response['file_name']);
									$attachment.attr('data-is-image', response['isImage']);
									$progressBar.remove();
									$fileAttachmentList.stop(true).animate({
										scrollLeft: ($attachment.get(0).offsetLeft + $attachment.width())
									}, 500);
								}
							}
							function attachFileUploadErrHandler(response) {
								var errorText = 'Error occured';
								if(response) {
									if(response.statusText) {
										errorText = response.statusText;
									}
									if(response.responseJSON && response.responseJSON.error) {
										errorText = response.responseJSON.error;
									}

									if(response.responseJSON && response.responseJSON.message && response.responseJSON.message.image && response.responseJSON.message.image.length) {
										errorText = response.responseJSON.message.image[0];
									}
								}
								$attachment.remove();
								Snackbar.show({text: errorText});
								return $.Deferred().resolve();
							}
							if(isAttachmImage) {
								return uploadImage(files[i], $progressBar).then(attachFileUploadHandler, attachFileUploadErrHandler);
							} else {
								return uploadAttachmentFile(files[i], $progressBar).then(attachFileUploadHandler, attachFileUploadErrHandler);
							}
						});

					})(i);
				}

				$chainUpload.then(function() {
					if (!$fileAttachmentList.has('*').length) {
						$fileAttachmentList.hide();
					}
				})
			}).trigger('click');
		});

		$textarea.on('change input paste', function() {
			var $textarea = $(this);

			$textarea.css('height', 'auto');

			if ($.trim($textarea.val())) {
				$textarea.css('height', $textarea.get(0).scrollHeight + 'px');
			}
		});

		var $attachmentLinkContainer = $postForm.find('.mp-attachment-link'),
			$attachmentLinkLoader = $attachmentLinkContainer.find('.loader');

		$textarea.on('paste', function(event) {

			var pastData = event.originalEvent.clipboardData.getData('Text'),
				match = pastData.match(/\bhttps?:\/\/(?:(?!&[^;]+;)[^\s"'<>)])+/);

			if (match && !self.attachmentLink) {
				$attachmentLinkContainer.show();
				$attachmentLinkLoader.show();
				Membership.api.activity.parseUrlAttachment({
					url: match[0]
				}).then(function(response) {

					if (response.success) {
						var $attachmentLink = $(response.html),
							$imageContainer = $attachmentLink.find('.image'),
							$videoPlayButton = $attachmentLink.find('.link-video-icon'),
							$videoContainer = $attachmentLink.find('.video-container'),
							$videoFrame = $videoContainer.children(),
							$image = $attachmentLink.find('img');

						self.attachmentLink = $attachmentLink.attr('data-hash');
						$attachmentLinkContainer.append($attachmentLink);
						$attachmentLink.show();

						$image.on('load', function() {
							if (Membership.helpers.attachmentLink.getImageAspectRatio($image) > 0.5625) {
								Membership.helpers.fitImageToContainer($image, $imageContainer);
							} else {
								$attachmentLink.removeClass('squared');
							}
						});

						$image.attr('src', $image.attr('data-src'));

						$videoPlayButton.on('click', function() {
							$attachmentLink.removeClass('squared');
							$videoContainer.show();
							$imageContainer.hide();
							$videoFrame.attr('src', $videoFrame.attr('data-src'));
							$videoFrame.css('height', $videoFrame.width() * Membership.helpers.attachmentLink.getVideoAspectRatio($videoFrame));
						});

						$attachmentLink.find('.mp-remove-attached-link').show().on('click', function() {
							$attachmentLink.remove();
							self.attachmentLink = null;
							$attachmentLinkContainer.hide();
						})

					}

					$attachmentLinkLoader.hide();
				});
			}
		});

		$smilesButton.on('click', function(e1) {
			var $this = $(this)
			,	$parent = $this.parent()
			,	$smilesWindow = $parent.find('.mp-smiles-window');

			if(!window.mbsSmilesWindowShow) {
				window.mbsSmilesWindowShow = 1;
				$smilesWindow.removeClass('mbs-displ-hidden');
			} else {
				window.mbsSmilesWindowShow = null;
				$smilesWindow.addClass('mbs-displ-hidden');
			}
			e1.preventDefault();
			e1.stopPropagation();
			return false;
		});
		
		$(document).off('mbsActivitySmileSelected').on('mbsActivitySmileSelected', function(event, $smileImg, $firefoxIE) {
			// insert Smile to textBox
			if($firefoxIE && $smileImg){
				var $parentForm = $smileImg.closest('.mp-activity-post-form');
				if($parentForm && $parentForm.length) {
					var $textArea = $parentForm.find('.mp-form-textarea')
						,	smileCode = $smileImg.attr('data-code');
					if($textArea && $textArea.length) {
						$textArea.val($textArea.val() + ' ' + smileCode + ' ');
					}
				}
			}else{
				if($smileImg.closest) {
					var $parentForm = $smileImg.closest('.mp-activity-post-form');
					if($parentForm && $parentForm.length) {
						var $textArea = $parentForm.find('.mp-form-textarea')
						,	smileCode = $smileImg.attr('data-code');
						if($textArea && $textArea.length) {
							$textArea.val($textArea.val() + ' ' + smileCode + ' ');
						}
					}
				}
			}
		});

		this.$el = $postForm;
		this.$attachmentLinkContainer = $attachmentLinkContainer;
		this.$textarea = $textarea;
		this.$fileAttachmentList = $fileAttachmentList;
		this.galleryInfo = new GalleryInfo();
		this.sliderInfo = new SliderInfo();
		this.googleMapsEasyInfo = new GoogleMapsEasyInfo();
	}

	function uploadImage(file, $progressBar) {

		return Membership.api.base.uploadImage({
			image: file,
			uploadProgress: function(event) {
				if (event.lengthComputable) {
					$progressBar.mpProgress('set percent', parseInt((event.loaded / event.total) * 100));
				}
			}
		});
	}
	function uploadAttachmentFile(myFile, $progressBar) {
		return Membership.api.base.uploadAnyFile({
			'uFile': myFile,
			'uploadProgress': function(event) {
				if (event.lengthComputable) {
					$progressBar.mpProgress('set percent', parseInt((event.loaded / event.total) * 100));
				}
			}
		});
	}

	function initComments($comments, activity) {
		$comments.each(function() {
			new Comment($(this), activity);
		});
		return $comments;
	}

	function initReplies($replies, comment) {
		$replies.each(function() {
			new CommentReply($(this), comment);
		});
		return $replies;
	}

	function Activity($activity, container) {
		this.$el = $activity;
		this.container = container;
		this.activityId = this.$el.attr('data-activity-id');
		this.activityMenu();
		this.activityDate();
		this.activityLink($activity.find('.mp-activity-content .mp-activity-link'));
		this.activityImages($activity.find('.mp-activity-content .mp-activity-gallery'));
		this.activityActions();
		this.activityComments();
	}

	function Comment($comment, activity) {
		this.$el = $comment;
		this.activity = activity;
		this.commentId = $comment.attr('data-comment-id');
		this.commentDate();
		this.activityLink($comment.find('.mp-comment-content .mp-activity-link'));
		this.activityImages($comment.find('.mp-comment-content .mp-activity-gallery'));
		this.commentReplies();
		this.commentMenu();
	}

	Comment.prototype = Object.create(Activity.prototype);

	Comment.prototype.constructor = Comment;

	Comment.prototype.commentMenu = function() {

		var self = this,
			$comment = this.$el,
			$repliesContainer = $comment.find('.comments:first');

		$comment.find('.mp-comment-content .actions .remove-action').on('click', function () {
			$comment.fadeOut(function() {
				var $commentsList = $comment.parent();
				$comment.remove();
				Membership.api.comments.remove({commentId: self.commentId});
				self.activity.comments.totalComments--;
				self.activity.comments.showedComments--;
				self.activity.comments.updateCommentsCounters();
				if (!$commentsList.children().length) {
					$commentsList.hide();
				}
			});
		});

		$comment.find('.mp-comment-content .actions .edit-action').on('click', function () {
			new CommentEditForm(self);
		});

		$comment.find('.mp-comment-content .actions .reply-action').on('click', function () {
			$repliesContainer.show();
		});
	};

	Comment.prototype.commentReplies = function() {

		var self = this,
			$repliesContainer = this.$el.find('.mp-comment-replies:first'),
			$repliesList = $repliesContainer.find('.comment-replies:first'),
			$repliesLoader = $repliesContainer.find('.replies-loader'),
			$previousRepliesContainer = $repliesContainer.find('.mp-previous-replies'),
			$repliesViewPreviousButton = $previousRepliesContainer.find('.mp-more-replies'),
			$repliesViewPreviousButtonLoader = $repliesViewPreviousButton.find('.loader'),
			$showedRepliesCounter = $repliesContainer.find('.mp-previous-replies .showed-replies'),
			$totalRepliesCounter = $repliesContainer.find('.mp-previous-replies .total-replies'),
			$loadRepliesActionButton = this.$el.find('.actions:first .load-replies'),
			limit = 15,
			request = false,
			offsetId = null;

		this.replies = {

			totalReplies: parseInt($totalRepliesCounter.text(), 10),
			showedReplies: parseInt($showedRepliesCounter.text(), 10),

			updateRepliesCounters: function() {
				$showedRepliesCounter.text(this.showedReplies);
				$totalRepliesCounter.text(this.totalReplies);
			}
		};

		var hasMoreReplies = this.replies.showedReplies < this.replies.totalReplies;

		function fetchReplies() {
			request = true;
			return Membership.api.comments.replies({
				commentId: self.commentId,
				limit: limit,
				offsetId: offsetId
			}).then(function(response) {
				if (response.success) {

					var $replies = $(response.html).filter('.comment');
					offsetId = $replies.first().attr('data-comment-id');

					$repliesList.prepend($replies);
					self.replies.showedReplies += $replies.length;

					if (self.replies.showedReplies >= self.replies.totalReplies || !$replies.length) {
						$previousRepliesContainer.hide();
					} else {
						$previousRepliesContainer.show();
					}

					initReplies($replies, self);
					self.replies.updateRepliesCounters();
				}

				request = false;
			});
		}

		$loadRepliesActionButton.one('click', function() {
			$loadRepliesActionButton.hide();
			$repliesContainer.show();
			$repliesLoader.show();
			fetchReplies().then(function() {
				$repliesLoader.hide();
				$repliesList.show();
			});
		});

		$repliesViewPreviousButton.on('click', function() {
			if (hasMoreReplies && !request) {
				$repliesViewPreviousButtonLoader.show();
				fetchReplies().then(function() {
					$repliesViewPreviousButtonLoader.hide();
				});
			}
		});

		this.replyForm = new CommentReplyForm(this);
	};

	function CommentReply($reply, comment) {
		this.$el = $reply;
		this.comment = comment;
		this.activity = comment.activity;
		this.commentId = $reply.attr('data-comment-id');
		this.commentDate();
		this.activityLink($reply.find('.mp-comment-content .mp-activity-link'));
		this.activityImages($reply.find('.mp-comment-content .mp-activity-gallery'));
		this.replyMenu();
	}

	CommentReply.prototype = Object.create(Comment.prototype);

	CommentReply.prototype.constructor = CommentReply;

	CommentReply.prototype.replyMenu = function() {

		var self = this,
			$reply = this.$el;

		$reply.find('.mp-comment-content .actions .remove-action').on('click', function () {
			$reply.fadeOut(function() {
				var $repliesList = $reply.parent();
				$reply.remove();
				Membership.api.comments.remove({commentId: self.commentId});
				self.comment.replies.totalReplies--;
				self.comment.replies.showedReplies--;
				self.comment.replies.updateRepliesCounters();
				if (!$repliesList.children().length) {
					$repliesList.hide();
				}
			});
		});

		$reply.find('.mp-comment-content .actions .edit-action').on('click', function () {
			new CommentEditForm(self, true);
		});

		$reply.find('.mp-comment-content .actions .reply-action').on('click', function () {
			self.comment.replyForm.$textarea.focus();
		});
	};

	Comment.prototype.commentDate = function() {
		this.$el.find('.mp-comment-content:first .metadata .date').each(function(){
			var $date = $(this);
			$date.text(Membership.helpers.moment($date.text()));
		})
	};

	Activity.prototype.activityDate = function() {
		this.$el.find('.mp-activity-header-title .date').each(function(){
			var $date = $(this);
			$date.text(Membership.helpers.moment($date.text()));
		})
	};

	Activity.prototype.activityMenu = function() {

		var self = this,
			$activity = this.$el,
			activityId = $activity.attr('data-activity-id'),
			$activityMenu = $activity.find('.mp-activity-menu');

		$activityMenu.mpDropdown({
			action: 'hide'
		});

		$activityMenu.find('.delete-action').on('click', function() {
			$activity.fadeOut(400);
			var imgAttachments = $activity.find('.mp-activity-gallery-image')
			,	attachmentsIds = [];
			$.each(imgAttachments, function(ind1, elem) {
				var $elem = $(elem)
				,	attachmentId = $elem.attr('data-image-id');
				if(attachmentId) {
					attachmentsIds.push(attachmentId);
				}
			});

			Membership.api.activity.remove({
				'activityId': activityId,
				'attachmentIds': attachmentsIds,
			}).then(function(response) {
				if (response.success) {
					$activity.remove();
				}
			});
		});

		$activityMenu.find('.group-delete-action').on('click', function() {
			$activity.fadeOut(400);

			Membership.api.groups.removeActivity({activityId: activityId})
				.then(function(response) {
					if (response.success) {
						$activity.remove();
					}
				});
		});

		var $reportActivityModal = $('#report-activity-modal'),
			$reportActivityModalButtons = $reportActivityModal.find('.actions button');

		$activityMenu.find('.report-action').on('click', function() {

			$reportActivityModal.mpModal({
				onApprove: function($button) {
					var $textarea = $reportActivityModal.find('textarea'),
						message = $.trim($textarea.val());

					if (!message.length) {
						return false;
					}

					$button.addClass('loading');
					$reportActivityModalButtons.attr('disabled', true);

					Membership.api.base.sendReport({
						message: message,
						objectId: activityId,
						type: 'activity'
					}).then(function(response) {
						if (response.success) {
							$reportActivityModal.mpModal('hide');
							Snackbar.show({text: 'This activity has been reported.'});
						}
					});

					return false;
				},
				onHidden: function() {
					$reportActivityModal.find('textarea').val('');
					$reportActivityModalButtons.removeClass('loading');
					$reportActivityModalButtons.removeAttr('disabled');
				}
			});


			$reportActivityModal.mpModal('show');
		});

		$activityMenu.find('.edit-action').on('click', function() {
			if($activity.find('.mp-activity-post-form').length === 0){
				new ActivityEditForm($activity, self);
			}
		});
	};

	Activity.prototype.activityLink = function($activityLink) {

		if (!$activityLink.length) {
			return;
		}

		var $imageContainer = $activityLink.find('.image'),
			$videoPlayButton = $activityLink.find('.link-video-icon'),
			$videoContainer = $activityLink.find('.video-container'),
			$videoFrame = $videoContainer.children(),
			$image = $activityLink.find('img');

		if ($image.length) {

			$image.on('load', function() {
				$activityLink.show();
				if (Membership.helpers.attachmentLink.getImageAspectRatio($image) > 0.7) {
					Membership.helpers.fitImageToContainer($image, $imageContainer);
				} else {
					$activityLink.removeClass('squared');
				}
			});

			$image.attr('src', $image.attr('data-src'));
		} else {
			$activityLink.show();
		}

		$videoPlayButton.on('click', function() {

			$activityLink.removeClass('squared');
			$videoContainer.show();
			$imageContainer.hide();
			$videoFrame.css('height', $videoFrame.width() * Membership.helpers.attachmentLink.getVideoAspectRatio($videoFrame));
			$videoFrame.attr('src', $videoFrame.attr('data-src'));

		});

	};

	Activity.prototype.activityImages = function($galleryContainer, activityId) {

		if (!$galleryContainer.length) {
			return;
		}

		function prepareContainers() {
			var maxHeight = Math.min($(window).width() * 0.5625, 700);
			$images.each(function(index) {

				var $imageContainer = $(this);

				if (total === 1) {
					$imageContainer.css('maxHeight', maxHeight + 'px');
				}

				if (total === 2 && type == 'horizontal') {
					$imageContainer.css('height', maxHeight / 2 + 'px');
				}

				if (total === 2 && type == 'vertical') {
					$imageContainer.css({
						width: '50%',
						height: maxHeight + 'px',
						float: 'left'
					});
				}

				if (total > 2 && type == 'vertical') {
					if (index > 0) {
						$imageContainer.css({
							width: '33%',
							height: maxHeight / 2 + 'px',
							minHeight: maxHeight / 2 + 'px',
							float: 'left'
						});
					} else {
						$imageContainer.css({
							width: '66.66%',
							height: maxHeight + 'px',
							minHeight: maxHeight + 'px',
							float: 'left'
						});
					}
				}

				if (total > 2 && type == 'horizontal') {

					if (index > 0) {
						$imageContainer.css({
							width: '50%',
							height: maxHeight / 3 + 'px',
							minHeight: maxHeight / 3 + 'px',
							float: 'left'
						});
					} else {
						$imageContainer.css({
							width: '100%',
							height: maxHeight * 2 / 3 + 'px',
							minHeight: maxHeight * 2 / 3 + 'px',
							float: 'left'
						});

					}
				}
			});

			if (total > 1) {
				fitImagesToContainer();
			}

		}

		function fitImagesToContainer() {
			$images.each(function() {
				var $imageContainer = $(this),
					$image = $imageContainer.find('img');
				Membership.helpers.fitImageToContainer($image, $imageContainer);
			})
		}

		var galleryId = $galleryContainer.attr('data-gallery-id'),
			$images = $galleryContainer.children(),
			total = $images.length,
			imageSize,
			type,
			self = this;

		$galleryContainer.mpImagesLoaded(function() {
			$galleryContainer.show();

			imageSize = Membership.helpers.getImageOriginalSizes($images.first().find('img').get(0));
			type = parseInt(imageSize.width, 10) > parseInt(imageSize.height, 10) ? 'horizontal' : 'vertical';
			prepareContainers();

			if (total > 1) {
				$(window).on('resize', Membership.helpers.debounce(prepareContainers, 200));
			}

		});

		$images.on('click', function() {
			var imageId = $(this).attr('data-image-id');
			gallery.open([imageId, '.', galleryId].join(''));
		});
 	};

	Activity.prototype.activityActions = function() {
		var PopupActionButton = function(type, $activity) {

			var self = this,
				activityId = $activity.attr('data-activity-id'),
				$actionButton = $activity.find('.mp-activity-actions .' + type + '-action'),
				$popup = $activity.find('.mp-activity-actions .mp-' + type + '-popup'),
				$popupLoader = $popup.find('.popup-loader'),
				$popupUsers = $popup.find('.popup-users'),
				$popupCount = $popup.find('.popup-count span'),
				$modal = $activity.find('.mp-activity-actions .mp-' + type + '-modal'),
				$modalUsers = $modal.find('.modal-users'),
				$modalCount = $modal.find('.header span'),
				$modalLoader = $modal.find('.modal-loader'),
				totalActionsCount = parseInt($popupCount.text(), 10) || 0,
				isActedByCurrentUser = $actionButton.hasClass('mp-' + type + 'd-activity'),
				isCurrUserActivity = $actionButton.hasClass('mbsCurrentUserActivity'),
				initPopup = false,
				initModal = false,
				fetchModalRequest = false,
				fetchModalRequestOffset = 0,
				hasMoreModal = true,
				limit = 15,
				offsetId = null;

			this.updateCounts = function() {
				$modalCount.text(totalActionsCount);
				$popupCount.text(totalActionsCount);
				$actionButton.find('span').text(totalActionsCount > 0 ? totalActionsCount : '');
			};

			this.showPopupLoader = function() {
				$popupLoader.show();
				$popupUsers.hide();
			};

			this.hidePopupLoader = function() {
				$popupLoader.hide();
				$popupUsers.show();
			};

			this.showModalLoader = function() {
				$modalLoader.show();
			};

			this.hideModalLoader = function() {
				$modalLoader.hide();
			};

			this.actionButtonClick = function() {
				self.showPopupLoader();
				switch (type) {
					case 'like':

						if (!isActedByCurrentUser) {
							$actionButton.addClass('mp-' + type + 'd-activity');
							isActedByCurrentUser = true;
							totalActionsCount++;
							$actionButton.mpPopup('show');

							Membership.api.activity.like({
								activityId: activityId
							}).then(function(response) {
								if (response.success) {
									$popupUsers.empty();
									$popupUsers.append(response.html);
								}
								self.hidePopupLoader();
							});


						} else {
							totalActionsCount--;

							if (!totalActionsCount) {
								$actionButton.mpPopup('hide');
							}

							$actionButton.removeClass('mp-' + type + 'd-activity');
							isActedByCurrentUser = false;

							Membership.api.activity.unlike({
								activityId: activityId
							}).then(function(response) {
								if (response.success) {
									$popupUsers.empty();
									$popupUsers.append(response.html);
								}
								self.hidePopupLoader();
							});

						}

						self.showPopupLoader();
						self.updateCounts();

						break;
					case 'share':

						Snackbar.show({text: 'This post has been shared to your activity'});

						Membership.api.activity.share({
							activityId: activityId
						}).then(function(response) {
							if (response.success) {
								$popupUsers.empty();
								$popupUsers.append(response.html);
								self.hidePopupLoader();
							}
						});

						var $sharedActivity = $activity.find('.mp-shared-activity .mp-activity');

						if (!isActedByCurrentUser && !$sharedActivity.length) {
							$actionButton.addClass('mp-' + type + 'd-activity');
							$actionButton.mpPopup('show');
							totalActionsCount++;
							self.updateCounts();
							isActedByCurrentUser = true;
						}

						break;
					case 'favorite':
						if(!isActedByCurrentUser) {
							$actionButton.addClass('mp-' + type + 'd-activity');
							isActedByCurrentUser = true;
							totalActionsCount++;
							$actionButton.mpPopup('show');

							Membership.api.activity.favorite({
								activityId: activityId
							}).then(function(response) {
								if (response.success) {
									$popupUsers.empty();
									$popupUsers.append(response.html);
								}
								self.hidePopupLoader();
							});
						} else {
							totalActionsCount--;
							if (!totalActionsCount) {
								$actionButton.mpPopup('hide');
							}
							$actionButton.removeClass('mp-' + type + 'd-activity');
							isActedByCurrentUser = false;

							Membership.api.activity.unfavorite({
								activityId: activityId
							}).then(function(response) {
								if (response.success) {
									$popupUsers.empty();
									$popupUsers.append(response.html);
								}
								self.hidePopupLoader();
							});
						}
						self.showPopupLoader();
						self.updateCounts();
						break;
				}
			};

			this.fetchData = function(limit, offsetId, template) {
				switch (type) {
					case 'like':
						return Membership.api.activity.getLikes({
							activityId: activityId,
							limit: limit,
							offsetId: offsetId,
							template: template
						});
						break;
					case 'share':
						return Membership.api.activity.getShares({
							activityId: activityId,
							limit: limit,
							offsetId: offsetId,
							template: template
						});
						break;
					case 'favorite':
						return Membership.api.activity.getFavorites({
							activityId: activityId,
							limit: limit,
							offsetId: offsetId,
							template: template,
						});
						break;
				}
			};

			this.loadModalData = function() {
				if (fetchModalRequest || !hasMoreModal) {
					return $.Deferred().reject();
				}

				fetchModalRequest = true;
				this.showModalLoader();

				return this.fetchData(15, offsetId, 'modal').then(function(response) {
					if (response.success) {
						var $users = $(response.html).filter('[data-activity-id]');
						offsetId = $users.last().attr('data-activity-id');
						$modalUsers.append($users);
						fetchModalRequest = false;
						hasMoreModal = parseInt($users.length, 10) === limit;
						self.hideModalLoader();
					}
				});
			};

			$actionButton.mpPopup({
				popup: $popup,
				on: 'hover',
				position: 'top left',
				hoverable: true,
				delay: {
					show: 300,
					hide: 500
				},
				onShow: function() {
					if (!totalActionsCount) {
						return false;
					}
					if (!initPopup) {
						self.fetchData(6, null, 'popup').then(function(response) {
							if (response.success) {
								$popupUsers.empty();
								$popupUsers.append(response.html);
								initPopup = true;
								self.hidePopupLoader();
							}
						});
					}
				}
			});

			$modal.mpModal({
				observeChanges: true,
				onShow: function() {
					if (!initModal) {
						self.loadModalData().then(function() {

							initModal = true;
							self.hideModalLoader();

							$modal.mpVisibility({
								once: false,
								continuous: true,
								offset: 400,
								throttle: 80,
								context: $modal.parent(),
								observeChanges: true,
								onUpdate: function(calculations) {
									var screenCalculations = $modal.mpVisibility('get screen calculations');
									if (screenCalculations.bottom > calculations.height) {
										self.loadModalData();
									}
								}
							});
						});
					}
				},
				onHidden: function() {
					initModal = false;
					fetchModalRequestOffset = 0;
					$modalUsers.empty();
					$modal.mpVisibility('destroy');
					hasMoreModal = totalActionsCount > 0;
					self.showModalLoader();
				}
			});

			$popupCount.parent().on('click', function () {
				$actionButton.mpPopup('hide');
				$modal.mpModal('show');
			});

			if (Membership.currentUser.id) {
				$actionButton.on('click', this.actionButtonClick);
			}
		};
		new PopupActionButton('like', this.$el);
		new PopupActionButton('share', this.$el);
		new PopupActionButton('favorite', this.$el);
	};

	Activity.prototype.activityComments = function() {

		var self = this,
			$commentsContainer = this.$el.find('.mp-activity-comments:first'),
			$commentsList = $commentsContainer.find('.comments:first'),
			$previousCommentsContainer = $commentsContainer.find('.mp-previous-comments'),
			$commentsViewPreviousButton = $previousCommentsContainer.find('.mp-more-comments'),
			$commentsViewPreviousButtonLoader = $commentsViewPreviousButton.find('.loader'),
			$showedCommentsCounter = $commentsContainer.find('.mp-previous-comments .showed-comments'),
			$totalCommentsCounter = $commentsContainer.find('.mp-previous-comments .total-comments'),
			$actionButtonCounter = this.$el.find('.mp-activity-actions .comment-action span'),
			limit = 15,
			request = false,
			offsetId = $commentsList.find('.comment').first().attr('data-comment-id');


		this.comments = {

			totalComments: parseInt($totalCommentsCounter.text(), 10) || 0,
			showedComments: parseInt($showedCommentsCounter.text(), 10) || 0,

			updateCommentsCounters: function() {
				$showedCommentsCounter.text(this.showedComments);
				$totalCommentsCounter.text(this.totalComments);
				$actionButtonCounter.text(this.totalComments > 0 ? this.totalComments : '');
			}
		};

		var hasMoreComments = this.comments.showedComments < this.comments.totalComments;

		function fetchComments() {
			request = true;
			return Membership.api.comments.get({
				activityId: self.activityId,
				limit: limit,
				offsetId: offsetId
			}).then(function(response) {
				if (response.success) {

					var $comments = $(response.html).filter('.comment');

					$commentsList.prepend($comments);
					self.comments.showedComments += $comments.length;

					if (self.comments.showedComments >= self.comments.totalComments || !$comments.length) {
						$previousCommentsContainer.hide();
					}

					initComments($comments, self);
					self.comments.updateCommentsCounters();
				}

				request = false;
			});
		}

		$commentsViewPreviousButton.on('click', function() {
			if (hasMoreComments && !request) {
				$commentsViewPreviousButtonLoader.show();
				fetchComments().then(function() {
					$commentsViewPreviousButtonLoader.hide();
				});
			}
		});

		this.commentForm = new CommentForm(this);
		initComments(this.$el.find('.comments .comment'), this);

	};

	function Gallery() {

		this.currentActivityId = null;
		this.total = 0;
		this.photoIndex = 0;
		this.indexOffset = 0;
		this.request = false;

		this.$modal = $('.mp-gallery-modal:first').mpModal({
			onHide: function() {
				self.closeModal();
			},
			onHidden: function() {
				self.showModalLoader();
			}
		});

		this.$modal.on('click', '.prev-button', function() {

			var photo = [self.photoIds[0], '.', self.currentActivityId].join('');

			if (self.photos.length < self.total && self.photoIds.indexOf(self.currentPhoto.id) <= 5) {

				if (self.request) {
					return;
				}

				self.showModalLoader();
				self.request = true;

				Membership.api.base.getImages({
					imageId: photo,
					direction: -1,
					offset: self.getPrevOffset()
				}).then(function(response) {
					if (response.success) {
						response.images.reverse().forEach(function(image) {
							if (self.total > self.photos.length) {
								self.photos.unshift(image);
								self.photoIds.unshift(image.id);
								self.indexOffset++;
							}
						});
					}
					self.request = false;
					self.updateCurrentPhotoIndex(-1);
					self.updateCurrentPhoto(self.photos[self.getPrevPhotoIndex()]);
				});
				return;
			}

			self.updateCurrentPhotoIndex(-1);
			self.updateCurrentPhoto(self.photos[self.getPrevPhotoIndex()]);
		});

		this.$modal.on('click', '.next-button', function() {


			var photo = [self.photoIds[self.photoIds.length - 1], '.', self.currentActivityId].join('');

			if (self.photos.length < self.total && ((self.photos.length - self.photoIds.indexOf(self.currentPhoto.id)) <= 5)) {

				if (self.request) {
					return;
				}

				self.showModalLoader();
				self.request = true;

				Membership.api.base.getImages({
					imageId: photo,
					direction: 1,
					offset: self.getNextOffset()
				}).then(function(response) {
					if (response.success) {
						response.images.forEach(function(image) {
							if (self.total > self.photos.length) {
								self.photos.push(image);
								self.photoIds.push(image.id);
							}
						});
					}
					self.request = false;
					self.updateCurrentPhotoIndex(1);
					self.updateCurrentPhoto(self.photos[self.getNextPhotoIndex()]);
				});
				return;

			}
			self.updateCurrentPhotoIndex(1);
			self.updateCurrentPhoto(self.photos[self.getNextPhotoIndex()]);
		});

		var self = this,
			$modalCounters = this.$modal.find('.image-index'),
			$modalControls = this.$modal.find('.controls'),
			$modalLoader = this.$modal.find('.modal-loader'),
			$modalImage = this.$modal.find('img');

		if (History.Adapter) {
			History.Adapter.bind(window, 'statechange', function() {
				var state = History.getState();

				if (state.data.component === 'mp-gallery') {

					if (state.data.action === 'open') {
						self.init(state.data.photo);
					}

					if (state.data.action === 'close' && self.isShowed) {
						self.close();
					}

					if (state.data.action === 'update') {
						self.init(state.data.photo);
					}
				}
			});
		}


		this.showModal = function() {
			this.$modal.mpModal('show');
			this.isShowed = true;
		};

		this.showModalLoader = function() {
			$modalLoader.addClass('active');
			$modalImage.removeAttr('src');
		};

		this.updateModal = function() {

			var loaderTimeout,
				photoSource = this.currentPhoto.source;

			$modalCounters.find('.current-index').text(parseInt(this.photoIndex, 10));
			$modalCounters.find('.total').text(this.total);
			$modalCounters.find('.id').text(this.currentPhoto.id);

			if (parseInt(this.total, 10) > 1) {
				$modalControls.show();
			} else {
				$modalControls.hide();
			}

			$modalImage.mpImagesLoaded().done(function() {
				clearTimeout(loaderTimeout);
				$modalImage.css('opacity', 1);
				$modalLoader.removeClass('active');
			});

			$modalImage.removeAttr('src');
			$modalImage.css('opacity', 0);
			$modalImage.attr('src', photoSource);
			$modalLoader.addClass('active');

			this.$modal.mpModal('refresh');
		};

		this.closeModal = function() {

			var query = Membership.helpers.updateQueryParams(window.location.search, {
				photo: null,
				t: null
			});

			if (!query) {
				query = window.location.origin + window.location.pathname;
			}

			History.pushState({
				component: 'mp-gallery',
				action: 'close'
			}, History.options.initialTitle, query);
		};
	}

	Gallery.prototype.open = function(photo) {

		History.pushState({
			component: 'mp-gallery',
			action: 'open',
			photo: photo
		}, History.options.initialTitle, Membership.helpers.updateQueryParams(window.location.search, {
			photo: photo,
			t: Date.now()
		}));
	};

	Gallery.prototype.close = function() {
		this.$modal.mpModal('hide');
	};

	Gallery.prototype.init = function(photo) {

		var photoData = photo.split('.');

		if (photoData.length < 2 || !photoData[0] || !photoData[1]) {
			return;
		}

		var	photoId = photoData[0],
			activityId = photoData[1],
			self = this;

		if (this.currentActivityId === activityId) {
			var photoIndex = this.photoIds.indexOf(photoId),
				offsetDirection = photoIndex - this.photoIds.indexOf(this.currentPhoto.id);

			if (photoIndex !== -1) {

				this.showModal();
				this.updateCurrentPhotoIndex(offsetDirection);

				this.currentPhoto = this.photos[photoIndex];
				this.updateModal();
				return;
			}
		}

		this.showModal();

		this.photos = [];
		this.photoIds = [];
		this.currentPhoto = {};
		this.indexOffset = 0;

		Membership.api.base.getImages({
			imageId: photo
		}).then(function(response) {

			if (response.images) {
				response.images.forEach(function(image) {
					self.photos.push(image);
					self.photoIds.push(image.id);

					if (!self.currentPhoto.id) {
						self.indexOffset++;
					}

					if (image.id === photoId) {
						self.currentPhoto = image;
					}

				});
			}

			self.total = parseInt(response.total, 10);
			self.photoIndex = parseInt(response.offset, 10);
			self.currentActivityId = activityId;
			self.updateModal();
		});
	};

	Gallery.prototype.updateCurrentPhoto = function(currentPhoto) {
		this.currentPhoto = currentPhoto;

		var photo = [currentPhoto.id, '.', this.currentActivityId].join(''),
			state = {
				component: 'mp-gallery',
				action: 'update',
				photo: photo
			};

		History.pushState(state, History.options.initialTitle, Membership.helpers.updateQueryParams(window.location.search, {
			photo: photo,
		}));
	};

	Gallery.prototype.getPrevOffset = function() {
		return parseInt(this.photoIndex, 10) -
			(this.photoIds.length - (this.photoIds.length - this.photoIds.indexOf(this.currentPhoto.id) + 1)) - 4;
	};

	Gallery.prototype.getNextOffset = function() {
		var offset = parseInt(this.photoIndex, 10) + this.photoIds.length - (this.photoIds.indexOf(this.currentPhoto.id) + 1);

		if (offset >= parseInt(this.total, 10)) {
			offset = (offset - parseInt(this.total, 10));
		}

		return offset;
	};

	Gallery.prototype.getPrevPhotoIndex = function() {
		var index = this.photoIds.indexOf(this.currentPhoto.id);

		if (index === 0) {
			index = this.photos.length;
		}

		return --index;
	};

	Gallery.prototype.getNextPhotoIndex = function() {
		var index = this.photoIds.indexOf(this.currentPhoto.id);

		if (index === this.photos.length - 1) {
			index = -1;
		}

		return ++index;
	};

	Gallery.prototype.updateCurrentPhotoIndex = function(directionOffset) {
		if (directionOffset < 0) {
			if (this.photoIndex === 1) {
				this.photoIndex = this.total - -(directionOffset + 1);
			} else {
				this.photoIndex = this.photoIndex - -(directionOffset);
			}
		} else if (directionOffset > 0) {
			if (this.photoIndex == this.total) {
				this.photoIndex = directionOffset;
			} else {
				this.photoIndex = this.photoIndex + directionOffset;
			}
		}
	};

	function ActivityContainer($activityContainer) {
		this.$activityContainer = $activityContainer;
		this.activityContext = $activityContainer.attr('data-activity-context');
		this.$activitiesList = $activityContainer.find('.mp-activity-list');
		this.$activityPostForm = $activityContainer.find('.mp-activity-post-form');
		this.$noActivitiesMessage = $activityContainer.find('.no-activities');
		this.$activities = this.$activitiesList.children();
		this.activitiesFetchRequest = false;
		this.limit = 5;

		var $activityFilter = $('[name="activity-filter"]');
		this.activityTypes = [];

		if	($activityFilter.length) {
			var filterSettings = $activityFilter.val().split(',');
			this.activityFilter = filterSettings.shift();
			this.activityTypes = filterSettings;
		}

		this.offsetId = this.$activities.last().attr('data-activity-id');
		this.hasMoreActivities = this.$activities.length == this.limit;
		this.offset = this.$activities.length;
		this.$activitiesLoader = $activityContainer.find('.activity-loader');
		this.queryParams = Membership.helpers.getQueryParams();
	}

	ActivityContainer.prototype.init = function() {
		var self = this;

		if (this.queryParams.photo) {
			gallery.open(this.queryParams.photo);
		}

		new ActivityPostForm(this);

		this.initActivities(this.$activitiesList.children());

		this.$activitiesList.mpVisibility({
			once: false,
			observeChanges: true,
			onBottomVisible: function() {
				if (self.hasMoreActivities && !self.activitiesFetchRequest) {
					self.fetchActivities();
				}
			}
		});

		var cacheFilter = this.filter,
			cacheActivityTypes = this.activityTypes.slice();

		if (this.activityContext === 'widget') {
			return;
		}

		$('.activity-filter').mpDropdown({
			action: function(text, value, element) {

				var $element = $(element),
					$this = $(this);

				if ($element.hasClass('activity-filter-item')) {
					$this.find('.activity-filter-item').removeClass('active');
					$this.mpDropdown('set text', text);
					$element.addClass('active');
					self.activityFilter = value;
					$this.mpDropdown('hide');
				}

				if ($element.hasClass('activity-type-item')) {
					var elementIndex = self.activityTypes.indexOf(value);
					if ($element.hasClass('active')) {
						$element.removeClass('active');
						$element.find('.label').removeClass('green').addClass('red');
						if (elementIndex !== -1) {
							self.activityTypes.splice(elementIndex, 1);
						}
					} else {
						$element.addClass('active');
						$element.find('.label').removeClass('red').addClass('green');
						if (elementIndex === -1) {
							self.activityTypes.push(value);
						}
					}
				}
			},
			onHide: function() {


				var activityNeedsUpdate = (function () {

					var diff = cacheActivityTypes.filter(function(i) {
						return !(self.activityTypes.indexOf(i) > -1);
					});

					var diff2 = self.activityTypes.filter(function(i) {
						return !(cacheActivityTypes.indexOf(i) > -1);
					});

					return diff.concat(diff2).length > 0 || self.activityFilter !== cacheFilter;
				})();

				cacheActivityTypes = self.activityTypes.slice();
				cacheFilter = self.activityFilter;

				if (activityNeedsUpdate) {
					self.$activitiesList.empty();
					self.hasMoreActivities = true;
					self.offsetId = null;
					self.offset = 0;
					self.fetchActivities().then(function() {
						if (self.$activitiesList.find('.mp-activity').length) {
							self.$noActivitiesMessage.hide();
						} else {
							self.$noActivitiesMessage.show();
						}
					});
				}

			}
		});
	};

	ActivityContainer.prototype.fetchActivities = function() {

		var activityRequest = $.Deferred().reject(),
			self = this;

		switch (this.activityContext) {
			case 'activity':
				activityRequest = Membership.api.activity.get({
					limit: this.limit,
					offsetId: this.offsetId,
					activityFilter: this.activityFilter,
					activityTypes: this.activityTypes,
					offset: this.offset
				});
				break;
			case 'group':
				activityRequest = Membership.api.groups.getActivity({
					groupId: Membership.get('requestedGroup.id'),
					limit: this.limit,
					offsetId: this.offsetId,
					offset: this.offset,
				});
				break;
			case 'profile':
				activityRequest = Membership.api.users.getActivity({
					userId: Membership.get('requestedUser.id'),
					limit: this.limit,
					offsetId: this.offsetId,
					offset: this.offset
				});
				break;
			case 'profile-favorite':
				activityRequest = Membership.api.users.getActivity({
					'userId': Membership.get('requestedUser.id'),
					'limit': this.limit,
					'offsetId': this.offsetId,
					'offset': this.offset,
					'contextParam': this.activityContext,
				});
				break;
			default:
				return;
		}

		this.activitiesFetchRequest = true;
		this.$activitiesLoader.show();

		return activityRequest.then(function(response) {

			if (response.success) {
				var $activities = $(response.html).filter('.mp-activity');

				self.offsetId = $activities.last().attr('data-activity-id');
				self.offset += $activities.length;
				self.$activitiesList.append($activities);

				self.initActivities($activities);
				if ($activities.length < self.limit) {
					self.hasMoreActivities = false;
				}
			}

			self.$activitiesLoader.hide();
			self.activitiesFetchRequest = false;

		}, function(response) {
			var jsonResponse = response.responseJSON;
			if (jsonResponse && jsonResponse.errors) {
				Snackbar.show({text: jsonResponse.errors[0]});
			}
		});
	};
	ActivityContainer.prototype.initActivities = function($activities) {

		var container = this;

		$activities.each(function() {
			new Activity($(this), container);
		});
		// social share init
		$(document).trigger('mbsMembershipDataLoadEvent');

		return $activities;
	};

	$('.mp-activity-container').each(function() {
		var container = new ActivityContainer($(this));
		container.init();
	});

	// check click to reset window visibility
	$(document).on('click', function(event, elem) {
		// window with activity smiles
		if(window.mbsSmilesWindowShow == 1) {
			if( !event ) event = window.event;
			
			var $target = $(event.target);
			if($target && $target.length) {
				var $foundedSmileImg = null
				,	notCloseWindow = null;
				if($target.hasClass('mp-smiles-window') || $target.hasClass('mbs-smiles-wrapper')) {
					notCloseWindow = 1;
				} else if($target.hasClass('emoji')) {
					var $smileParent = $target.parent();
					if($smileParent.hasClass('mbs-sw-one-smile')) {
						$foundedSmileImg = $smileParent;
					}
				} else if($target.hasClass('mbs-sw-one-smile')) {
					var firefoxIE = true;
					$foundedSmileImg = $target;
				}
				
				if($foundedSmileImg && $foundedSmileImg.length) {
					if(firefoxIE){
						$(document).trigger('mbsActivitySmileSelected', [$foundedSmileImg, firefoxIE]);
						$('.post-activity-buttons .mp-smiles-window:not(.mbs-displ-hidden)').addClass('mbs-displ-hidden');
						window.mbsSmilesWindowShow = null;
					}else{
						$(document).trigger('mbsActivitySmileSelected', [$foundedSmileImg]);
						$('.post-activity-buttons .mp-smiles-window:not(.mbs-displ-hidden)').addClass('mbs-displ-hidden');
						window.mbsSmilesWindowShow = null;
					}
				} else if(!notCloseWindow) {
					$('.post-activity-buttons .mp-smiles-window:not(.mbs-displ-hidden)').addClass('mbs-displ-hidden');
					window.mbsSmilesWindowShow = null;
				}
			}
		}
	});

	Membership.Activity = {
		ActivityContainer: ActivityContainer
	};

	function setViewedActivity(){
		var ui = $("div.ui.segment.vertical.basic.mp-activity-container");
		var single = parseInt(ui.attr("data-single"));
	    var groupId = Membership.get('requestedGroup.id');
        if(single === 0){
            Membership.api.notifications.setViewedAllByType({
                type: 'group_new_note',
                groupId: groupId
            });
        }
	}

    function iePrepareRegex2Param(paramStr) {
        if(window.navigator.userAgent.indexOf("MSIE ") > 0
            || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
            return paramStr
        }
        return paramStr + 'u';
    }


    setViewedActivity();


})(jQuery, Membership);

(function($){
	$.fn.focusTextToEnd = function(){
		this.focus();
		var $thisVal = this.val();
		this.val('').val($thisVal);
		return this;
	}
}(jQuery));