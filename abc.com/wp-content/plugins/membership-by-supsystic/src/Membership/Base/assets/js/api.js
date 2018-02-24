(function($, Membership) {

	Membership.action = 'supsystic-membership';

	Membership.ajax = function(data, extend) {
		var $sentFrom = extend && extend.sentFrom ? $( extend.sentFrom ) : false;
		if( $sentFrom ) {
			Membership.showFullLoader( $sentFrom );
		}
		return $.ajax($.extend({
			method: 'get',
			url: Membership.ajaxUrl,
			data: $.extend({
				action: Membership.action,
				route: '',
				wpnonce: Membership.wpnonce
			}, data)
		}, extend))
			.always(function(res){
				if( $sentFrom ) {
					Membership.hideFullLoader( $sentFrom );
				}
			});
	};

	Membership.api = {
		base: {
			uploadImage: function(upload) {

				var formData = new FormData(),
					fileExtension = upload.image.name.split('.').pop(),
					maxFileSize = parseInt(Membership.get('settings.base.uploads.max-file-size'), 10),
					imageSize = upload.image.size;

				if (['jpg', 'jpeg', 'png', 'gif', 'ico'].indexOf(fileExtension.toLowerCase()) === -1) {
					return $.Deferred().reject({message:'Unsupported file format. Allowed formats: .jpg .jpeg .png, .gif, .ico'});
				}

				if (upload.image.size > Membership.get('settings.base.uploads.max-file-size')) {
					return $.Deferred().reject({
						message: 'Picture exceeds the maximum image size (' +(maxFileSize/1024/1024).toFixed(2)+ 'MB). The image size: ' + (imageSize/1024/1024).toFixed(2) + 'MB'
					});
				}

				formData.append('route', 'base.uploadImage');
				formData.append('image', upload.image);
				formData.append('wpnonce', Membership.wpnonce);
				formData.append('action', Membership.action);

				return $.ajax({
					method: 'post',
					url: Membership.ajaxUrl,
					data: formData,
					processData: false,
					contentType: false,
					beforeSend:  upload.beforeSend,
					xhr: function() {
						var xhr = $.ajaxSettings.xhr();
						if(xhr.upload) {
							xhr.upload.addEventListener('progress', upload.uploadProgress, false);
						}
						return xhr;
					}
				});
			},
			uploadFile: function(upload, successCallback) {

				var formData = new FormData(),
					fileExtension = upload.image.name.split('.').pop();

				if (['jpg', 'jpeg', 'png'].indexOf(fileExtension) === -1) {
					return $.Deferred().reject(new Error('Images only.'));
				}

				formData.append('route', 'base.uploadFile');
				formData.append('media', upload.image);
				formData.append('wpnonce', Membership.wpnonce);
				formData.append('action', Membership.action);

				return $.ajax({
					method: 'post',
					url: Membership.ajaxUrl,
					data: formData,
					processData: false,
					contentType: false,
					beforeSend:  upload.beforeSend,
					xhr: function() {
						var xhr = $.ajaxSettings.xhr();
						if(xhr.upload) {
							xhr.upload.addEventListener('progress', upload.uploadProgress, false);
						}
						return xhr;
					},
					success: function (data) {
						successCallback(data.attachment);
					}
				});
			},
			uploadAnyFile: function(upload) {

				var formData = new FormData(),
					fileExtension = upload.uFile.name.split('.').pop(),
					maxFileSize = parseInt(Membership.get('settings.base.uploads.max-file-size'), 10),
					fileSize = upload.uFile.size;

				/*if (['jpg', 'jpeg', 'png'].indexOf(fileExtension.toLowerCase()) === -1) {
					return $.Deferred().reject({message:'Unsupported file format. Allowed formats: .jpg .jpeg .png'});
				}/**/

				if (upload.uFile.size > Membership.get('settings.base.uploads.max-file-size')) {
					return $.Deferred().reject({
						'statusText': 'File exceeds the maximum file size (' +(maxFileSize/1024/1024).toFixed(2)+ 'MB). The file size: ' + (fileSize/1024/1024).toFixed(2) + 'MB'
					});
				}

				formData.append('route', 'base.uploadAnyFile');
				formData.append('file', upload.uFile);
				formData.append('wpnonce', Membership.wpnonce);
				formData.append('action', Membership.action);

				return $.ajax({
					'method': 'post',
					'url': Membership.ajaxUrl,
					'data': formData,
					'processData': false,
					'contentType': false,
					'beforeSend':  upload.beforeSend,
					'xhr': function() {
						var xhr = $.ajaxSettings.xhr();
						if(xhr.upload) {
							xhr.upload.addEventListener('progress', upload.uploadProgress, false);
						}
						return xhr;
					}
				});
			},
			sendReport: function(params) {
				return Membership.ajax($.extend({
					route: 'reports.send'
				}, params), {method: 'post'});
			},
			getImages: function(params) {
				return Membership.ajax($.extend({
					route: 'photos.get'
				}, params));
			},
			'getAttachmentFiles': function(params) {
				return Membership.ajax($.extend({
					'route': 'base.getAttachmentFiles',
				}, params), {'method': 'post'});
			},
			getNonce: function(params) {
				return Membership.ajax($.extend({
					route: 'base.getNonce'
				}, params));
			}
		},
		activity: {
			get: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.get'
				}, params));
			},
			post: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.post'
				}, params), {method: 'post'});
			},
			update: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.update'
				}, params), {method: 'post'});
			},
			remove: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.remove'
				}, params), {method: 'post'});
			},
			share: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.share'
				}, params), {method: 'post'});
			},
			like: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.like'
				}, params), {method: 'post'});
			},
			unlike: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.unlike'
				}, params), {method: 'post'});
			},
			getLikes: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.likes.get'
				}, params));
			},
			getShares: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.shares.get'
				}, params));
			},
			parseUrlAttachment: function (params) {
				return Membership.ajax($.extend({
					route: 'activity.parseUrlAttachment'
				}, params));
			},
			search: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.search'
				}, params));
			},
			'favorite': function(params) {
				return Membership.ajax($.extend({
					'route': 'activity.favorite',
				}, params), {method: 'post'});
			},
			'unfavorite': function(params) {
				return Membership.ajax($.extend({
					'route': 'activity.unfavorite',
				}, params), {method: 'post'});
			},
			'getFavorites': function(params) {
				return Membership.ajax($.extend({
					'route': 'activity.favorites.get',
				}, params), {method: 'post'});
			},
		},
		comments: {
			get: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.comments.get'
				}, params));
			},
			post: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.comments.post'
				}, params), {method: 'post'});
			},
			update: function(params) {
				return Membership.ajax($.extend({
					route: 'comments.update'
				}, params), {method: 'post'});
			},
			remove: function(params) {
				return Membership.ajax($.extend({
					route: 'comments.remove'
				}, params), {method: 'post'});
			},
			reply: function(params) {
				return Membership.ajax($.extend({
					route: 'activity.comments.reply'
				}, params), {method: 'post'});
			},
			replies: function(params) {
				return Membership.ajax($.extend({
					route: 'comments.replies'
				}, params));
			}
		},
		notifications: {
			get: function(params) {
				return Membership.ajax($.extend({
					route: 'notifications.get'
				}, params));
			},
			setViewed: function(params) {
				return Membership.ajax($.extend({
					route: 'notifications.setViewed'
				}, params), {method: 'post'});
			},
			setViewedAll: function(params) {
				return Membership.ajax($.extend({
					route: 'notifications.setViewedAll'
				}, params), {method: 'post'});
			},
			remove: function(params) {
				return Membership.ajax($.extend({
					route: 'notifications.remove'
				}, params), {method: 'post'});
			},
            setViewedAllByType: function(params){
                return Membership.ajax($.extend({
                    route: 'notifications.setViewedAllByType'
                }, params), {method: 'post'});
            },
		},
		users: {
			getActivity: function(params) {
				return Membership.ajax($.extend({
					route: 'users.activity.get'
				}, params));
			},
			addFriend: function(params) {
				return Membership.ajax($.extend({
					route: 'users.friends.add'
				}, params), {method: 'post'});
			},
			removeFriend: function(params) {
				return Membership.ajax($.extend({
					route: 'users.friends.remove'
				}, params), {method: 'post'});
			},
			getFollows: function(params) {
				return Membership.ajax($.extend({
					route: 'users.follows.get'
				}, params));
			},
			getFollowers: function(params) {
				return Membership.ajax($.extend({
					route: 'users.followers.get'
				}, params));
			},
			follow: function(params) {
				return Membership.ajax($.extend({
					route: 'users.followers.follow'
				}, params), {method: 'post'});
			},
			unfollow: function(params) {
				return Membership.ajax($.extend({
					route: 'users.followers.unfollow'
				}, params), {method: 'post'});
			},
			search: function(params) {
				return Membership.ajax($.extend({
					route: 'users.search'
				}, params));
			},
			get: function(params) {
				return Membership.ajax($.extend({
					route: 'users.get'
				}, params));
			},
			changeCover: function(params) {
				return Membership.ajax($.extend({
					route: 'users.changeCover'
				}, params), {method: 'post'});
			},
			removeCover: function() {
				return Membership.ajax({
					route: 'users.removeCover'
				}, { method: 'post'});
			},
			changeAvatar: function(params) {
				return Membership.ajax($.extend({
					route: 'users.changeAvatar'
				}, params), {method: 'post'});
			},
			removeAvatar: function() {
				return Membership.ajax({
					route: 'users.removeAvatar'
				}, { method: 'post'});
			},
			saveField: function(params) {
				return Membership.ajax($.extend({
					route: 'users.fields.save'
				}, params), {method: 'post'});
			},
			getFriends: function(params) {
				return Membership.ajax($.extend({
					route: 'users.friends.get'
				}, params));
			},
			getFriendshipRequests: function(params) {
				return Membership.ajax($.extend({
					route: 'users.friends.getFriendshipRequests'
				}, params));
			},
			updatePrivacy: function(params) {
				return Membership.ajax($.extend({
					route: 'users.settings.updatePrivacy'
				}, params), {method: 'post'});
			},
			saveUserNotificationsSettings: function(params) {
				return Membership.ajax($.extend({
					route: 'users.settings.saveUserNotificationsSettings'
				}, params), {method: 'post'});
			},
			changeEmail: function(params) {
				return Membership.ajax($.extend({
					route: 'users.settings.changeEmail'
				}, params), {method: 'post'});
			},
			changePassword: function(params) {
				return Membership.ajax($.extend({
					route: 'users.settings.changePassword'
				}, params), {method: 'post'});
			},
			deleteAccount: function(params) {
				return Membership.ajax($.extend({
					route: 'users.settings.deleteAccount'
				}, params), {method: 'post'});
			},
			wpLogout: function(params) {
				return Membership.ajax($.extend({
					'route': 'users.wpLogout',
				}, params), {'method': 'post'});
			},
			getPosts: function(params) {
				return Membership.ajax($.extend({
					route: 'users.posts.get'
				}, params));
			},
			getComments: function(params) {
				return Membership.ajax($.extend({
					route: 'users.comments.get'
				}, params));
			}
		},
		groups: {
			getActivity: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.activity.get'
				}, params));
			},
			postActivity: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.activity.post'
				}, params), {method: 'post'});
			},
			removeActivity: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.activity.remove'
				}, params), {method: 'post'});
			},
			changeLogo: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.changeLogo'
				}, params), {method: 'post'});
			},
			removeLogo: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.removeLogo'
				}, params), {method: 'post'});
			},
			changeCover: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.changeCover'
				}, params), {method: 'post'});
			},
			removeCover: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.removeCover'
				}, params), {method: 'post'});
			},
			join: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.join'
				}, params), {method: 'post'});
			},
			leave: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.leave'
				}, params), {method: 'post'});
			},
			delete: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.delete'
				}, params), {method: 'post'});
			},
			follow: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.follow'
				}, params), {method: 'post'});
			},
			unfollow: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.unfollow'
				}, params), {method: 'post'});
			},
			getUsers: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.getUsers'
				}, params));
			},
			removeUser: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.removeUser'
				}, params), {method: 'post'});
			},
			unblockUser: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.unblockUser'
				}, params), {method: 'post'});
			},
			approveUser: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.approveUser'
				}, params), {method: 'post'});
			},
			getUsersToInvite: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.getUsersToInvite'
				}, params));
			},
			invite: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.invite'
				}, params), {method: 'post'});
			},
			cancelInvite: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.cancelInvite'
				}, params), {method: 'post'});
			},
			updatePrivacy: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.settings.updatePrivacy'
				}, params), {method: 'post'});
			},
			updateData: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.settings.updateData'
				}, params), {method: 'post'});
			},
			getUserGroups: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.getUserGroups'
				}, params));
			},
			get: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.getGroups'
				}, params));
			},
			createGroup: function(params) {
				return Membership.ajax($.extend({
					route: 'groups.createGroup'
				}, params), {method: 'post'});

			},
			// getTags: function(groupId, limit, offset, search) {
			// 	return Membership.ajax({
			// 		route: 'groups.getTags',
			// 		groupId: groupId,
			// 		limit: limit,
			// 		offset: offset,
			// 		search: search
			// 	});
			// },
			addTag:  function(params) {
				return Membership.ajax($.extend({
					route: 'groups.addTag'
				}, params), {method: 'post'});
			},
			removeTag:  function(params) {
				return Membership.ajax($.extend({
					route: 'groups.removeTag'
				}, params), {method: 'post'});
			},
			block:  function(params) {
				return Membership.ajax($.extend({
					route: 'groups.block'
				}, params), {method: 'post'});
			},
			unblock:  function(params) {
				return Membership.ajax($.extend({
					route: 'groups.unblock'
				}, params), {method: 'post'});
			}
		},
		'groupsCategory': {
			'add': function() {
				return Membership.ajax($.extend({
					route: 'groupsCategory.add'
				}, params), {method: 'post'});
			},
			'update': function() {
				return Membership.ajax($.extend({
					route: 'groupsCategory.update'
				}, params), {method: 'post'});
			},
			'remove': function() {
				return Membership.ajax($.extend({
					route: 'groupsCategory.remove'
				}, params), {method: 'post'});
			},
		},
		messages: {
			createConversation: function(params) {
				return Membership.ajax($.extend({
					route: 'messages.createConversation'
				}, params), {method: 'post'});
			},
			getMessages: function(params) {
				return Membership.ajax($.extend({
					route: 'messages.getMessages'
				}, params));
			},
			checkUnreadMessages: function(params) {
				return Membership.ajax($.extend({
					route: 'messages.checkUnreadMessages'
				}, params));
			},
			sendMessage: function(params) {
				return Membership.ajax($.extend({
					route: 'messages.sendMessage'
				}, params), {method: 'post'});
			},
			sendMessageToUser: function(params) {
				return Membership.ajax($.extend({
					route: 'messages.sendMessageToUser'
				}, params), {method: 'post'});
			},
			deleteMessages: function(params) {
				return Membership.ajax($.extend({
					route: 'messages.deleteMessages'
				}, params), {method: 'post'});
			},
			deleteConversation: function(params) {
				return Membership.ajax($.extend({
					route: 'messages.deleteConversation'
				}, params), {method: 'post'});
			},
			blockUser: function(params) {
				return Membership.ajax($.extend({
					route: 'messages.blockUser'
				}, params), {method: 'post'});
			},
			unblockUser: function(params) {
				return Membership.ajax($.extend({
					route: 'messages.unblockUser'
				}, params), {method: 'post'});
			}
		},
		photos: {

		},
		gallery: {
			removeImage: function(params) {
				return Membership.ajax($.extend({
					route: 'gallery.removeImage'
				}, params), {method: 'post'});
			},
			createGallery: function(params) {
				return Membership.ajax($.extend({
					route: 'gallery.addGallery',
				}, params), {method: 'post'})
			},
			removeGallery: function(params) {
				return Membership.ajax($.extend({
					route: 'gallery.remove',
				}, params), {method: 'post'});
			},
			setImagesPosition: function(params) {
				return Membership.ajax($.extend({
					route: 'gallery.setImagesPosition',
				}, params), {method: 'post'});
			},
			setGalleryPosition: function(params) {
				return Membership.ajax($.extend({
					route: 'gallery.setGalleryPosition',
				}, params), {method: 'post'});
			},
			uploadImage: function(upload) {

				var formData = new FormData(),
					fileExtension = upload.image.name.split('.').pop(),
					maxFileSize = parseInt(Membership.get('settings.base.uploads.max-file-size'), 10),
					imageSize = upload.image.size;

				if (['jpg', 'jpeg', 'png'].indexOf(fileExtension.toLowerCase()) === -1) {
					return $.Deferred().reject({message:'Unsupported file format. Allowed formats: .jpg .jpeg .png'});
				}

				if (upload.image.size > Membership.get('settings.base.uploads.max-file-size')) {
					return $.Deferred().reject({
						message: 'Picture exceeds the maximum image size (' +(maxFileSize/1024/1024).toFixed(2)+ 'MB). The image size: ' + (imageSize/1024/1024).toFixed(2) + 'MB'
					});
				}

				formData.append('route', 'gallery.uploadImage');
				formData.append('image', upload.image);
				formData.append('galleryId', upload.galleryId);
				formData.append('wpnonce', Membership.wpnonce);
				formData.append('action', Membership.action);

				return $.ajax({
					method: 'post',
					url: Membership.ajaxUrl,
					data: formData,
					processData: false,
					contentType: false,
					beforeSend:  upload.beforeSend,
					xhr: function() {
						var xhr = $.ajaxSettings.xhr();
						if(xhr.upload) {
							xhr.upload.addEventListener('progress', upload.uploadProgress, false);
						}
						return xhr;
					}
				});
			},
		},
		slider: {
			removeImage: function(params) {
				return Membership.ajax($.extend({
					route: 'slider.removeImage'
				}, params), {method: 'post'});
			},
			createSlider: function(params) {
				return Membership.ajax($.extend({
					route: 'slider.addSlider',
				}, params), {method: 'post'})
			},
			removeSlider: function(params) {
				return Membership.ajax($.extend({
					route: 'slider.remove',
				}, params), {method: 'post'});
			},
			setImagesPosition: function(params) {
				return Membership.ajax($.extend({
					route: 'slider.setImagesPosition',
				}, params), {method: 'post'});
			},
			setSliderPosition: function(params) {
				return Membership.ajax($.extend({
					route: 'slider.setSliderPosition',
				}, params), {method: 'post'});
			},
			uploadImage: function(upload) {

				var formData = new FormData(),
					fileExtension = upload.image.name.split('.').pop(),
					maxFileSize = parseInt(Membership.get('settings.base.uploads.max-file-size'), 10),
					imageSize = upload.image.size;

				if (['jpg', 'jpeg', 'png'].indexOf(fileExtension.toLowerCase()) === -1) {
					return $.Deferred().reject({message:'Unsupported file format. Allowed formats: .jpg .jpeg .png'});
				}

				if (upload.image.size > Membership.get('settings.base.uploads.max-file-size')) {
					return $.Deferred().reject({
						message: 'Picture exceeds the maximum image size (' +(maxFileSize/1024/1024).toFixed(2)+ 'MB). The image size: ' + (imageSize/1024/1024).toFixed(2) + 'MB'
					});
				}

				formData.append('route', 'slider.uploadImage');
				formData.append('image', upload.image);
				formData.append('sliderId', upload.sliderId);
				formData.append('wpnonce', Membership.wpnonce);
				formData.append('action', Membership.action);

				return $.ajax({
					method: 'post',
					url: Membership.ajaxUrl,
					data: formData,
					processData: false,
					contentType: false,
					beforeSend:  upload.beforeSend,
					xhr: function() {
						var xhr = $.ajaxSettings.xhr();
						if(xhr.upload) {
							xhr.upload.addEventListener('progress', upload.uploadProgress, false);
						}
						return xhr;
					}
				});
			},
		},
		'googleMapsEasy' : {
			setPreviewPosition: function (params) {
				return Membership.ajax($.extend({
					route: 'googleMapsEasy.setPreviewPosition'
				}, params), {method: 'post'});
			},
			removeMap: function(params) {
				return Membership.ajax($.extend({
					route: 'googleMapsEasy.removeMap'
				}, params), {method: 'post'});
			},
			createMap: function(params) {
				return Membership.ajax($.extend({
					route: 'googleMapsEasy.createMap'
				}, params), {method: 'post'});
			},
			saveMapParams: function(params) {
				return Membership.ajax($.extend({
					route: 'googleMapsEasy.saveMapParams'
				}, params), {method: 'post'});
			},
		}
	};

	var storageKey = 'SupsysticMembershipNonce';

	/**
	 * Cached page check
	 */
	var timestamp = new Date().getTime() / 1000,
		diffInSeconds = timestamp - Membership.timestamp;

	function storeNonce(response) {
		Membership.wpnonce = response.nonce;
		localStorage.setItem(storageKey, JSON.stringify({
			nonce: response.nonce,
			ttl: timestamp + (6 * 60 * 60) // 6h
		}));
	}

	if (diffInSeconds > 60) {
		var nonceData = localStorage.getItem(storageKey);

		Membership.pageIsCached = true;

		if (nonceData) {
			nonceData = JSON.parse(nonceData);
			if (nonceData.ttl < timestamp) {
				Membership.api.base.getNonce().then(storeNonce);
			} else {
				Membership.wpnonce = nonceData.nonce;
			}
		} else {
			Membership.api.base.getNonce().then(storeNonce);
		}
	} else {
		Membership.pageIsCached = false;
	}

	$(document).ajaxError(function(event, jqxhr) {
		var jsonResponse = jqxhr.responseJSON;
		if (jqxhr.status === 403 && jsonResponse) {
			if (jsonResponse.errors && jsonResponse.errors[0] === 'Invalid token. Please refresh page.') {
				Membership.api.base.getNonce().then(storeNonce);
			}
		}
	});

	window.Membership = Membership;
	
})(jQuery, window.Membership || {});