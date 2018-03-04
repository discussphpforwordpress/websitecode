(function($, Membership) {

	var loadedAssets = [];

	Membership.jqTbls = {};
	
	Membership.loader = function(assetsList) {
		var defferedScripts = [];

		for (var i = 0; i < assetsList.length; i++) {
			var assetPath = assetsList[i].split('/'),
				module = assetPath.shift().replace('@', ''),
				moduleName = module.charAt(0).toUpperCase() + module.substr(1),
				assetUrl = [Membership.modulesPath, moduleName, 'assets'].concat(assetPath).join('/');

			if ($.inArray(assetUrl, loadedAssets) !== -1) {
				continue;
			}

			loadedAssets.push(assetUrl);

			if (assetUrl.split('.').pop() === 'css') {
				$('<link>')
					.appendTo('head')
					.attr({type : 'text/css', rel : 'stylesheet'})
					.attr('href', assetUrl);
				continue;
			}

			defferedScripts.push($.getScript(assetUrl));
		}

		return $.when.apply($, defferedScripts);
	};

	Membership.get = function(path, defaultValue) {

		var _path = path.split('.'),
			setting = this;

		defaultValue = defaultValue || false;

		for (var i = 0; i < _path.length; i++) {

			if (!setting[_path[i]]) {
				return defaultValue;
			}

			setting = setting[_path[i]];
		}

		return setting;
	};

	Membership.helpers = {
		moment: function(time) {
			time = moment(time).add(moment().utcOffset(), 'm').format('YYYY-MM-DD HH:mm:ss');
			var fromNow = moment(time).fromNow();
			return moment(time).calendar(null, {
				sameDay: '[' + fromNow + ']',
				nextDay: moment.localeData()._calendar.nextDay.replace('LT', 'HH:mm'),
				nextWeek: 'dddd',
				lastDay: moment.localeData()._calendar.lastDay.replace('LT', 'HH:mm'),
				lastWeek: 'D MMMM HH:mm',
				sameElse: 'D MMMM YYYY'
			});
		},
		debounce: function(func, wait, immediate) {
			var timeout;
			return function() {
				var context = this,
					args = arguments,
					later = function() {
						timeout = null;
						if (!immediate) {
							func.apply(context, args);
						}
					},
					callNow = immediate && !timeout;

				clearTimeout(timeout);
				timeout = setTimeout(later, wait);

				if (callNow) {
					func.apply(context, args);
				}
			};
		},
		isCurrentUser: function() {
			return Membership.get('currentUser.id') === Membership.get('requestedUser.id');
		},
		getRouteUrl: function(route, params) {
			var paramsArray = [],
				permalinksIsOn = Membership.permalink !== '';

				if (!Membership.routes[route]) {
					return false;
				}

				for (param in params) {
					paramsArray.push(param + '=' + params[param]);
				}

			return Membership.routes[route] + (permalinksIsOn ? '?' : '&') + paramsArray.join('&');
		},
		getProfileUrl: function(user, params) {
			var url = [],
				permalinksIsOn = Membership.permalink !== '',
				userId,
				param;

			url.push(Membership.profile.baseUrl);

			if (Membership.profile.permalinkBase === 'username') {
				userId = user.user_login;
			} else {
				userId = user.id;
			}

			if (permalinksIsOn) {
				url.push(userId + '/');
				for (param in params) {
					url.push(params[param] + '/');
				}
			} else {
				url.push('&user=' + userId);
				for (param in params) {
					url.push('&' + param + '=' + params[param]);
				}
			}

			return url.join('');
		},
		getMembersUrl: function () {
			return Membership.profile.membersUrl;
		},
		userCan: function(user, permission) {
			if (user && user.permissions) {
				return user.permissions[permission] === 'true';
			}

			return false;
		},
		currentUserCan: function(permission) {
			if (Membership.currentUser) {
				return this.userCan(Membership.currentUser, permission);
			} else {
				return this.userCan({
					permissions: Membership.guestPermissions
				}, permission);
			}
		},
		currentUserHasPermission: function(permission, requestedUser) {

			requestedUser = requestedUser || Membership.get('requestedUser');

			if (requestedUser.id === Membership.get('currentUser.id')) {
				return true;
			}

			switch(requestedUser.privacy[permission]) {
				case 'all-users':
					return true;
				case 'friends':
					return !!requestedUser.currentUserIsFriend;
				case 'friends-of-friends':
					return !!requestedUser.currentUserIsFriend || !!requestedUser.currentUserIsFriendOfFriends;
                case 'nobody':
                    return false;
				default:
					return false;
			}
		},
		currentUserHasGroupPermission: function(setting, requestedGroup) {

			requestedGroup = requestedGroup || Membership.get('requestedGroup');
			if (requestedGroup.currentUserRole === 'administrator') {
				return true;
			}

			var hasPermission = false;

			switch(setting) {
				case 'send-invitations':
					if (requestedGroup.settings.invitations === 'members-only') {
						if (requestedGroup.settings.type === 'open' && !!requestedGroup.currentUserRole) {
							hasPermission = true;
						}
						if (
							['closed', 'private'].indexOf(requestedGroup.settings.type) !== -1 &&
							!!requestedGroup.currentUserRole &&
							!!requestedGroup.currentUserApproved
						) {
							hasPermission = true;
						}
					}

					if (requestedGroup.settings.invitations == 'administrators' &&
						['administrator'].indexOf(requestedGroup.currentUserRole) !== -1
					) {
						hasPermission = true;
					}
					break;
				case 'post-activity':
					if (requestedGroup.settings['post-activity'] === 'all' && !!Membership.isLoggedIn) {
						hasPermission = true;
					}

					if (requestedGroup.settings['post-activity'] === 'members-only') {
						if (requestedGroup.settings.type === 'open' && !!requestedGroup.currentUserRole) {
							hasPermission = true;
						}
						if (
							['closed', 'private'].indexOf(requestedGroup.settings.type) !== -1 &&
							!!requestedGroup.currentUserRole &&
							!!requestedGroup.currentUserApproved
						) {
							hasPermission = true;
						}
					}

					if (requestedGroup.settings['post-activity'] == 'administrators' &&
						['administrator'].indexOf(requestedGroup.currentUserRole) !== -1
					) {
						hasPermission = true;
					}
					break;
				case 'post-comments':
					if (requestedGroup.settings['post-comments'] === 'all' && !!Membership.isLoggedIn) {
						hasPermission = true;
					}

					if (requestedGroup.settings['post-comments'] === 'members-only') {
						if (requestedGroup.settings.type === 'open' && !!requestedGroup.currentUserRole) {
							hasPermission = true;
						}
						if (
							['closed', 'private'].indexOf(requestedGroup.settings.type) !== -1 &&
							!!requestedGroup.currentUserRole &&
							!!requestedGroup.currentUserApproved
						) {
							hasPermission = true;
						}
					}

					if (requestedGroup.settings['post-comments'] == 'administrators' &&
						['administrator'].indexOf(requestedGroup.currentUserRole) !== -1
					) {
						hasPermission = true;
					}
					break;
				case 'read-comments':
				case 'read-activity':
					if (requestedGroup.settings['read-activity'] === 'all') {
						hasPermission = true;
					}

					if (requestedGroup.settings['read-activity'] === 'members-only') {
						if (requestedGroup.settings.type === 'open' && !!requestedGroup.currentUserRole) {
							hasPermission = true;
						}
						if (
							['closed', 'private'].indexOf(requestedGroup.settings.type) !== -1 &&
							!!requestedGroup.currentUserRole &&
							!!requestedGroup.currentUserApproved
						) {
							hasPermission = true;
						}
					}
					break;
			}

			return hasPermission;
		},
		getGroupUrl: function(group, params) {
			var url = [],
				permalinksIsOn = Membership.permalinks !== '',
				param;

			url.push(group.url + '/');

			if (permalinksIsOn) {
				for (param in params) {
					url.push(params[param] + '/');
				}
			} else {
				for (param in params) {
					url.push('&' + param + '=' + params[param]);
				}
			}

			return url.join('');
		},
		getUserAvatar: function(images, size) {

			var sizes,
				defaultImage;

			if (size && size !== 'default') {
				sizes = Membership.get('settings.profile.avatar-' + size  + '-' + 'size');
				defaultImage = Membership.get('settings.profile.default-avatar' + '-' + size)
				if (!defaultImage) {
					defaultImage = Membership.get('settings.profile.default-avatar');
				}
			} else {
				sizes = Membership.get('settings.profile.avatar-size');
				defaultImage = Membership.get('settings.profile.default-avatar')
			}

			if (!sizes) {
				return defaultImage;
			}

			return this.getImageBySize(images, sizes.width, sizes.height, 'avatar', defaultImage);

		},
		getUserCover: function(images, size) {

			var sizes,
				defaultImage;

			if (size && size !== 'default') {
				sizes = Membership.get('settings.profile.cover-' + size  + '-' + 'size');
				defaultImage = Membership.get('settings.profile.default-cover' + '-' + size)
				if (!defaultImage) {
					defaultImage = Membership.get('settings.profile.default-cover');
				}
			} else {
				sizes = Membership.get('settings.profile.cover-size');
				defaultImage = Membership.get('settings.profile.default-cover')
			}

			if (!sizes) {
				return defaultImage;
			}

			return this.getImageBySize(images, sizes.width, sizes.height, 'cover', defaultImage);

		},
		getGroupLogo: function(images, size) {

			var sizes,
				defaultImage;

			if (size && size !== 'default') {
				sizes = Membership.get('settings.groups.logo-' + size  + '-' + 'size');
				defaultImage = Membership.get('settings.groups.default-logo' + '-' + size)
				if (!defaultImage) {
					defaultImage = Membership.get('settings.groups.default-logo');
				}
			} else {
				sizes = Membership.get('settings.groups.logo-size');
				defaultImage = Membership.get('settings.groups.default-logo')
			}

			if (!sizes) {
				return defaultImage;
			}

			return this.getImageBySize(images, sizes.width, sizes.height, 'logo', defaultImage);
		},
		getGroupCover: function(images, size) {

			if (size && size !== 'default') {
				sizes = Membership.get('settings.groups.cover-' + size  + '-' + 'size');
				defaultImage = Membership.get('settings.groups.default-cover' + '-' + size)
				if (!defaultImage) {
					defaultImage = Membership.get('settings.groups.default-cover');
				}
			} else {
				sizes = Membership.get('settings.groups.cover-size');
				defaultImage = Membership.get('settings.groups.default-cover')
			}


			if (!sizes) {
				return defaultImage;
			}

			return this.getImageBySize(images, sizes.width, sizes.height, 'cover', defaultImage);
		},
		getImageBySize: function(images, width, height, type, defaultValue) {

			var thumbnail = images.filter(function(image) {
				return image.width == width && image.height == height && image.type == type;
			});

			if (thumbnail.length) {
				return thumbnail[0].source;
			} else {
				return defaultValue;
			}
		},
		getImageOriginalSizes: function(img) {

			var tempImage = new Image(),
				width,
				height;
			if ('naturalWidth' in tempImage && 'naturalHeight' in tempImage) {
				width = img.naturalWidth;
				height = img.naturalHeight;
			} else {
				tempImage.src = img.src;
				width = tempImage.width;
				height = tempImage.height;
			}
			return {
				width: width,
				height: height
			};
		},
		getQueryParams: function() {
			var queryParams = window.location.search.substr(1).split('&'),
				params = {};

			for (var i = 0; i < queryParams.length; ++i) {
				var param = queryParams[i].split('=', 2);
				if (param.length == 1) {
					params[param[0]] = "";
				} else {
					params[param[0]] = decodeURIComponent(param[1].replace(/\+/g, " "));
				}
			}

			return params;
		},
		updateQueryParams: function (url, params) {
			for (var param in params) {

				var re = new RegExp("[\\?&]" + param + "=([^&#]*)"),
					match = re.exec(url),
					delimiter,
					value = params[param];


				if (match === null) {

					var hasQuestionMark = /\?/.test(url);
					delimiter = hasQuestionMark ? "&" : "?";

					if (value) {
						url = url + delimiter + param + "=" + value;
					}

				} else {
					delimiter = match[0].charAt(0);

					if (value) {
						url = url.replace(re, delimiter + param + "=" + value);
					} else {
						url = url.replace(re, '');
						if (delimiter === '?' && url.length) {
							url = '?' + url.substr(1);
						}
					}
				}
			}

			return url;
		},
		fitImageToContainer: function($image, $container) {

			$image.css('top', 0);
			$image.css('left', 0);

			var containerSize = {
					width: $container.outerWidth(),
					height: $container.outerHeight()
				},
				imageSizes = Membership.helpers.getImageOriginalSizes($image.get(0)),
				widthRatio = containerSize.width / imageSizes.width,
				heightRatio = containerSize.height / imageSizes.height,
				ratio = Math.max(widthRatio, heightRatio);

			var styles = {
				width: Math.floor(imageSizes.width * ratio),
				height: Math.floor(imageSizes.height * ratio),
				position: 'absolute',
				maxWidth: 'none',
				maxHeight: 'none'
			};

			if (containerSize.width >= styles.width) {
				styles.top = -((styles.height - containerSize.height) / 2);
				styles.top += 'px';
			} else {
				styles.left = -((styles.width - containerSize.width) / 2);
				styles.left += 'px';
			}

			styles.width += 'px';
			styles.height += 'px';

			for (var styleName in styles) {
				$image.css(styleName, styles[styleName]);
			}
		},
		attachmentLink: {
			getImageAspectRatio: function($image) {
				var width = $image.attr('data-width'),
					height = $image.attr('data-height');

				if (width && height) {
					return height / width;
				} else {
					var size = Membership.helpers.getImageOriginalSizes($image.get(0));
					return size.height / size.width;
				}
			},
			getVideoAspectRatio: function($videoFrame) {
				var width = $videoFrame.attr('data-width'),
					height = $videoFrame.attr('data-height');

				if (width && height) {
					return height / width;
				}

				return 0.5625; // 16:9 Default
			},
			fitImageToContainer: function($image) {
				var $imageContainer = $image.closest('.image');

				$image.css('top', 0);
				$image.css('left', 0);

				var containerSize = {
						width: $imageContainer.width(),
						height: $imageContainer.height()
					},
					imageSizes = Membership.helpers.getImageOriginalSizes($image.get(0)),
					widthRatio = containerSize.width / imageSizes.width,
					heightRatio = containerSize.height / imageSizes.height,
					ratio = Math.max(widthRatio, heightRatio);

				var styles = {
					width: Math.floor(imageSizes.width * ratio),
					height: Math.floor(imageSizes.height * ratio),
					position: 'absolute',
					maxWidth: 'none',
					maxHeight: 'none'
				};

				if (containerSize.width >= styles.width) {
					styles.top = -((styles.height - containerSize.height) / 2);
					styles.top += 'px';
				} else {
					styles.left = -((styles.width - containerSize.width) / 2);
					styles.left += 'px';
				}

				styles.width += 'px';
				styles.height += 'px';

				for (var styleName in styles) {
					$image.css(styleName, styles[styleName]);
				}
			}
		},
        fitActionMenuToScreen: function(navMenu, navMenuBreaks) {
			if (navMenu.length > 0) {
				var $navMenuDropdown = navMenu.find('.dropdown'),
					$navMenuDropdownMenu = $navMenuDropdown.find('.menu'),
					$navMenuElements = navMenu.find('> *').not($navMenuDropdown),
					navMenuElementsWidth = 0,
					navMenuDropDownWidth = $navMenuDropdown.outerWidth(),
					dropdownItemsCount = $navMenuDropdownMenu.children().length;

				$.each($navMenuElements, function() {
					navMenuElementsWidth += $(this).outerWidth();
				});

				var availableSpace = navMenu.width();

				if (dropdownItemsCount > 0) {
					navMenuElementsWidth = navMenuElementsWidth + navMenuDropDownWidth;
				}

				if (availableSpace < navMenuElementsWidth) {
					navMenuBreaks.push(navMenuElementsWidth);
					$navMenuElements.not($navMenuDropdown).last().prependTo($navMenuDropdownMenu);
					dropdownItemsCount++;
					if (!$navMenuDropdown.is(':visible')) {
						$navMenuDropdown.show();
					}
				} else {
					for (var i = navMenuBreaks.length; i > 0; i--) {
						if (availableSpace >= navMenuBreaks[i - 1]) {
							$navMenuDropdownMenu.children().first().insertAfter(navMenu.find('> *').not($navMenuDropdown).last());
							navMenuBreaks.pop();
							dropdownItemsCount--;
						}
					}
					if (navMenuBreaks.length < 1) {
						$navMenuDropdown.hide();
					}
				}

				availableSpace = navMenu.width();
				navMenuElementsWidth = 0;

				if (dropdownItemsCount > 0) {
					navMenuElementsWidth = navMenuElementsWidth + navMenuDropDownWidth;
				}

				$.each($navMenuElements, function() {
					navMenuElementsWidth += $(this).outerWidth();
				});

				if (availableSpace < navMenuElementsWidth) {
					Membership.helpers.fitActionMenuToScreen(navMenu, navMenuBreaks);
				}
			}
    	}
	};


	Membership.makeAjaxUrl = function( route, data ) {
		return Membership.ajaxUrl+ '?route='+ route+ '&wpnonce='+ Membership.wpnonce+ '&action='+ Membership.action;
	};
	Membership.showFullLoader = function( $sentFrom ) {
		var loaderClasses = Membership.isAdmin ? 'fa fa-circle-o-notch fa-6 fa-spin' : 'circle notched icon loading big'
			,	$loader = $('<div class="mbsFullLoader"><div class="mbsFullLoadIconShell"><i class="'+ loaderClasses+ '"></i></div></div>').appendTo( $sentFrom )
			,	offset = $sentFrom.position()
			,	width = $sentFrom.outerWidth()
			,	height = $sentFrom.outerHeight();
		$loader.css({
			'top': offset.top
			,	'left': offset.left
			,	'width': width
			,	'height': height
		}).show();
		var $buttons = $sentFrom.find('input[type="submit"],button');
		if($buttons && $buttons.size()) {
			$buttons.attr('disabled', 'disabled');
		}
	};
	Membership.hideFullLoader = function( $sentFrom ) {
		var $loader = $sentFrom.find('.mbsFullLoader');
		if($loader && $loader.size()) {
			$loader.remove();
		}
		var $buttons = $sentFrom.find('input[type="submit"],button');
		if($buttons && $buttons.size()) {
			$buttons.removeAttr('disabled');
		}
	};

	Membership.strReplace = function(search, replace, subject) {
		var temp = subject.split(search);
		return temp.join(replace);
	};
	Membership.trans = function( msgId ) {	// JS function to translate messages, nothing to do here for now
		var args = Array.from(arguments);
		if(args.length > 1) {
			for(var i = 1; i < args.length; i++) { // As simple as I can:)
				msgId = this.strReplace('%s', args[ i ], msgId);
			}
		}
		return msgId;
	};
	Membership.custCheckInit = function( selector, params ) {
		params = params || {};
		var $selector = jQuery( selector )
			,	$set = jQuery(selector).find('input[type="checkbox"],input[type="radio"]')
			,	selectorType = $selector.attr('type');
		if(selectorType == 'checkbox' || selectorType == 'radio') {
			$set.add( $selector );
		}
		$set.each(function(){
			var $this = jQuery( this );
			if($this.data('check-inited')) return;
			var $parent = $this.parent()
				,	type = $this.attr('type');
			if($parent.prop('tagName') !== 'LABEL') {
				$this.wrap('<label class="sc-'+ type+ '" />');
			} else {
				$parent.addClass('sc-'+ type+ '');
			}
			jQuery('<div class="sc-'+ type+ '-state"></div>').insertAfter( $this );
			$this.data('check-inited', 1);
		});
		if(params.click) {
			$set.bind('click', params.click);
		}
	};
	Membership.switchWnd = function( switchWnd, params ) {
		params = params || {};
		var $wnd = jQuery('.sc-switch-wnd[data-switch="'+ switchWnd+ '"]')
			,	$content = jQuery('[data-switch-content="'+ switchWnd+ '"]')
			,	action = '';
		if(typeof(params.show) === 'undefined') {
			action = $wnd.hasClass('active') ? 'hide' : 'show';
		} else {
			action = params.show ? 'show' : 'hide';
		}
		switch( action ) {
			case 'show':
				$wnd.slideDown( this.animationTime );
				$content.slideUp( this.animationTime );
				break;
			case 'hide':
				$wnd.slideUp( this.animationTime );
				$content.slideDown( this.animationTime );
				break;
		}
	};
	Membership.getTxtEditorVal = function(id) {
		if(typeof(tinyMCE) !== 'undefined'
			&& tinyMCE.get( id )
			&& !jQuery('#'+ id).is(':visible')
			&& tinyMCE.get( id ).getDoc
			&& typeof(tinyMCE.get( id ).getDoc) == 'function'
			&& tinyMCE.get( id ).getDoc()
		)
			return tinyMCE.get( id ).getContent();
		else
			return jQuery('#'+ id).val();
	};
	Membership.setTxtEditorVal = function(id, content) {
		if(typeof(tinyMCE) !== 'undefined'
			&& tinyMCE
			&& tinyMCE.get( id )
			&& !jQuery('#'+ id).is(':visible')
			&& tinyMCE.get( id ).getDoc
			&& typeof(tinyMCE.get( id ).getDoc) == 'function'
			&& tinyMCE.get( id ).getDoc()
		)
			tinyMCE.get( id ).setContent(content);
		else
			jQuery('#'+ id).val( content );
	};
	Membership.getGridColDataById = function(id, column, gridSelectorId) {
		var rowId = this.getGridRowId(id, gridSelectorId);
		if(rowId) {
			return jQuery('#'+ gridSelectorId).jqGrid ('getCell', rowId, column);
		}
		return false;
	};
	Membership.getGridRowId = function(id, gridSelectorId) {
		var rowId = parseInt(jQuery('#'+ gridSelectorId).find('[aria-describedby='+ gridSelectorId+ '_id][title='+ id+ ']').parent('tr:first').index());
		if(!rowId) {
			console.log('CAN NOT FIND ITEM WITH ID  '+ id);
			return false;
		}
		return rowId;
	};

	/**
	 * Extend one class with other - OOP
	 * @param {type} Child
	 * @param {type} Parent
	 * @returns {undefined}
	 */
	Membership.extendOop = function(Child, Parent) {
		var F = function() { };
		F.prototype = Parent.prototype;
		Child.prototype = new F();
		Child.prototype.constructor = Child;
		Child.superclass = Parent.prototype;
	};
	function baseCollection( params ) {
		this._data = params;
	}
	baseCollection.prototype.get = function( key ) {
		return this._data[ key ];
	};
	baseCollection.prototype.set = function( key, val ) {
		this._data[ key ] = val;
	};
	function jqTbl( params ) {
		jqTbl.superclass.constructor.apply(this, arguments);
		this._tblId = params.tblId;
		this._tbl = null;
		this._init();
	}
	Membership.extendOop(jqTbl, baseCollection);
	jqTbl.prototype.getTblId = function() {
		return this._tblId;
	};
	jqTbl.prototype.getTbl = function() {
		return this._tbl;
	};
	jqTbl.prototype.reload = function() {
		this.getTbl().trigger( 'reloadGrid' );
	};
	jqTbl.prototype.updateWidth = function() {
		this.getTbl().setGridWidth( jQuery('#gbox_'+ this._tblId).parent().width() );
	};
	jqTbl.prototype._init = function() {
		var colModel = []
			,	colNames = []
			,	cols = this.get('cols')
			,	self = this;
		for(var i = 0; i < cols.length; i++) {
			colModel.push(jQuery.extend({
				index: cols[ i ].name
				,	searchoptions: {sopt: ['eq']}
				,	align: 'center'
			}, cols[ i ]));
			colNames.push( cols[ i ].label );
		}
		this._tbl = jQuery('#'+ this._tblId).jqGrid({
			url: Membership.makeAjaxUrl( this.get('url') )
			,	datatype: 'json'
			,	autowidth: true
			,	shrinkToFit: true
			,	colNames:colNames
			,	colModel:colModel
			,	postData: {
				search: {
					text_like: jQuery('#'+ this._tblId+ 'SearchTxt').val()
				}
			}
			,	rowNum:10
			,	rowList:[10, 20, 30, 1000]
			,	pager: '#'+ this._tblId+ 'Nav'
			,	sortname: 'id'
			,	viewrecords: true
			,	sortorder: 'desc'
			,	jsonReader: { repeatitems : false, id: '0' }
			,	caption: Membership.trans('Current %s', this.get('label'))
			,	height: '100%'
			,	emptyrecords: Membership.trans('You have no %s for now.', this.get('labelPlural'))
			,	multiselect: true
			,	onSelectRow: function(rowid, e) {
				var tblId = jQuery(this).attr('id')
					,	selectedRowIds = jQuery('#'+ tblId).jqGrid ('getGridParam', 'selarrrow')
					,	totalRows = jQuery('#'+ tblId).getGridParam('reccount')
					,	totalRowsSelected = selectedRowIds.length;

				if(totalRowsSelected) {
					jQuery('#'+ tblId+ 'RemoveGroupBtn').removeAttr('disabled');
					if(totalRowsSelected == totalRows) {
						jQuery('#cb_'+ tblId).prop('indeterminate', false);
						jQuery('#cb_'+ tblId).attr('checked', 'checked');
					} else {
						jQuery('#cb_'+ tblId).prop('indeterminate', true);
					}
				} else {
					jQuery('#'+ tblId+ 'RemoveGroupBtn').attr('disabled', 'disabled');
					jQuery('#cb_'+ tblId).prop('indeterminate', false);
					jQuery('#cb_'+ tblId).removeAttr('checked');
				}
			}
			,	gridComplete: function(a, b, c) {
				var tblId = jQuery(this).attr('id');
				jQuery('#'+ tblId+ 'RemoveGroupBtn').attr('disabled', 'disabled');
				jQuery('#cb_'+ tblId).prop('indeterminate', false);
				jQuery('#cb_'+ tblId).removeAttr('checked');
				// Custom checkbox manipulation
				Membership.custCheckInit('#'+ jQuery(this).attr('id'), {
					click: function(event) {
						event.stopPropagation();
						return false;
					}
				});
				// Edit form
				if(self.get('connectForm')) {
					jQuery(this).find('.mbsListEditBtn').click(function(){
						self.get('connectForm').edit( jQuery(this).attr('href'), jQuery(this) );
						return false;
					});
				}
				// Additional callback after grid draw complete
				if(self.get('onGridComplete')) {
					self.get('onGridComplete')( self );
				}
			}
			,	loadComplete: function() {
				var tblId = jQuery(this).attr('id');
				if (this.p.reccount === 0) {
					jQuery(this).hide();
					jQuery('#'+ tblId+ 'EmptyMsg').show();
				} else {
					jQuery(this).show();
					jQuery('#'+ tblId+ 'EmptyMsg').hide();
					if(this.p.lastpage > 1) {
						jQuery('#'+ tblId+ 'Nav_center .ui-pg-table').show();
					} else {	// We don't need page switcher if there are only one page
						jQuery('#'+ tblId+ 'Nav_center .ui-pg-table').hide();
					}
				}
			}
		});
		jQuery('#'+ this._tblId+ 'NavShell').append( jQuery('#'+ this._tblId+ 'Nav') );
		jQuery('#'+ this._tblId+ 'Nav').find('.ui-pg-selbox').insertAfter( jQuery('#'+ this._tblId+ 'Nav').find('.ui-paging-info') );
		jQuery('#'+ this._tblId+ 'Nav').find('.ui-pg-table td:first').remove();
		// Make navigation tabs to be with our additional buttons - in one row
		jQuery('#'+ this._tblId+ 'Nav_center').prepend( jQuery('#'+ this._tblId+ 'NavBtnsShell') ).css({
			'width': '80%'
			,	'white-space': 'normal'
			,	'padding-top': '8px'
		});
		jQuery('#'+ this._tblId+ 'SearchTxt').keyup(function(){
			var searchVal = jQuery.trim( jQuery(this).val() );
			if(searchVal && searchVal != '') {
				self._tbl.setGridParam({
					postData: {
						search: searchVal
					}
				}).trigger( 'reloadGrid' );
			}
		});

		jQuery('#'+ this._tblId+ 'EmptyMsg').insertAfter(jQuery('#'+ this._tblId+ '').parent());
		jQuery('#'+ this._tblId+ '').jqGrid('navGrid', '#'+ this._tblId+ 'Nav', {edit: false, add: false, del: false});
		jQuery('#cb_'+ this._tblId+ '').change(function(){
			jQuery(this).attr('checked')
				? jQuery('#'+ self.getTblId()+ 'RemoveGroupBtn').removeAttr('disabled')
				: jQuery('#'+ self.getTblId()+ 'RemoveGroupBtn').attr('disabled', 'disabled');
		});
		jQuery('#'+ this._tblId+ 'RemoveGroupBtn').click(function(){
			var selectedRowIds = jQuery('#'+ self.getTblId()).jqGrid ('getGridParam', 'selarrrow')
				,	listIds = [];
			for(var i in selectedRowIds) {
				var rowData = jQuery('#'+ self.getTblId()).jqGrid('getRowData', selectedRowIds[ i ]);
				listIds.push( rowData.id );
			}
			var formsLabel = '';
			if(listIds.length == 1) {	// In table label cell there can be some additional links
				var labelCellData = Membership.getGridColDataById(listIds[0], 'label', self.getTblId());
				formsLabel = jQuery(labelCellData).text();
			}
			var confirmMsg = listIds.length > 1
				? Membership.trans('Are you sur want to remove '+ listIds.length+ ' %s?', self.get('labelPlural'))
				: Membership.trans('Are you sure want to remove "'+ formsLabel+ '" %s?', self.get('label'));
			if(confirm(confirmMsg)) {
				Membership.ajax({
					'route': self.get('removeUrl')
					,	'id': listIds
				}, {'method': 'post'})
					.error(function(response) {
						console.error(response.responseJSON.message);
					})
					.success(function(response){
						if(response.success) {
							jQuery('#'+ self.getTblId()).trigger( 'reloadGrid' );
						}
					});
			}
			return false;
		});
		Membership.custCheckInit( '#'+ this._tblId+ '_cb' );
	};
	function editForm( params ) {
		editForm.superclass.constructor.apply(this, arguments);
		this._$form = jQuery( params.form );
		this._editInProgress = false;
		this._formFields = params.formFields;
		this._init();
	}
	Membership.extendOop(editForm, baseCollection);
	editForm.prototype._init = function() {
		var self = this;
		if(this.get('createBtn')) {
			jQuery(this.get('createBtn')).click(function(){
				self.clearForm();
				self.showForm();
				return false;
			});
		}
		if(this.get('backFromFormBtn')) {
			jQuery(this.get('backFromFormBtn')).click(function(){
				self.hideForm();
				return false;
			});
		}
		if(this.get('saveFormBtn')) {
			jQuery(this.get('saveFormBtn')).click(function(){
				self.saveForm();
				return false;
			});
		}
		var $chosenSelects = this._$form.find('select[class*="chosen"]');
		if($chosenSelects && $chosenSelects.size()) {
			$chosenSelects.each(function(){
				var $this = $(this)
					,	name = $this.attr('name');
				name = name.replace('\[\]', '');	// It can be multiple select
				if(self._formFields[ name ]) {
					self._formFields[ name ].isChosen = $this;
				}
			});
		}
	};
	editForm.prototype.saveForm = function() {
		var data = this._$form.find(':input').serializeJSON({
			checkboxUncheckedValue: false
		})
			,	self = this;
		for(var key in this._formFields) {
			switch( this._formFields[ key ].type ) {
				case 'editor':
					data[ key ] = Membership.getTxtEditorVal( key );
					break;
			}
		}
		Membership.ajax({
			'route': this.get('saveUrl')
			,	'data': data
		}, {'method': 'post'})
			.error(function(response) {
				console.error(response.responseJSON.message);
			})
			.success(function(response){
				if(response.success) {
					self._$form.find('[name="id"]').val( response.id );
				}
			});
	};
	editForm.prototype.clearForm = function() {
		this._$form.get(0).reset();
		for(var key in this._formFields) {
			if( this._formFields[ key ].isChosen ) {
				this._formFields[ key ].isChosen.trigger('chosen:updated');
			}
		}
		this._$form.find(':input[type="checkbox"]').trigger('change');
		this._$form.find('[name="id"]').val('');
		this._$form.find('img').css('display', 'none');
		
		
		
	};
	editForm.prototype.showForm = function() {
		Membership.switchWnd(this.get('wndId'), {show: true});
		this._isVisible = true;
	};
	editForm.prototype.hideForm = function() {
		/*Hide form - show connected list - mean that we need to reload table with it, right?*/
		if(this.get('connectTbl')) {
			this.get('connectTbl').reload();
		}
		Membership.switchWnd(this.get('wndId'), {show: false});
		this._isVisible = false;
	};
	editForm.prototype.isVisible = function() {
		return this._isVisible;
	};
	editForm.prototype.fillInForm = function( data ) {
		for(var key in data) {
			var value = data[ key ];
			if(typeof(value) === 'object' && key == 'params') {
				for(var key2 in value) {
					this._fillInFormValue( key2, value, true );
				}
			} else {
				this._fillInFormValue( key, data );
			}
		}
		
	};
	editForm.prototype._fillInFormValue = function( key, data, isParams ) {
		var type = this._formFields[ key ] ? this._formFields[ key ].type : false
			,	searchName = jQuery.inArray(type, ['multiselect']) !== -1 ? key+ '[]' : key;
		if(isParams) {
			searchName = 'params['+ searchName+ ']';
		}
		var $inp = this._$form.find('[name="'+ searchName+ '"]');
		switch(type) {
			case 'editor':
				Membership.setTxtEditorVal( key, data[ key ] );
				break;
			case 'checkbox':
				parseInt( data[ key ] ) ? $inp.prop('checked', 'checked') : $inp.removeProp('checked');
				break;
			default:
				if($inp && $inp.size()) {
					$inp.val( data[ key ] );
					if(this._formFields[ key ] && this._formFields[ key ].isChosen) {
						$inp.trigger('chosen:updated');
					}
				}
				break;
		}
		$inp.trigger('change');
	};
	editForm.prototype.edit = function( id, $btn ) {
		if(this._editInProgress) return;	// For case - user clicked on other element during loading first one
		var $editBtnIcon = null
			,	self = this;
		if($btn) {
			$editBtnIcon = $btn.find('i.fa');
			if(!$editBtnIcon.size()) {
				$editBtnIcon = null;
			}
		}
		if($editBtnIcon) {
			$editBtnIcon.data('prev-class', $editBtnIcon.attr('class')).attr('class', 'fa fa-fw fa-spinner');
		}
		this._editInProgress = true;
		Membership.ajax({
			'route': this.get('getItemUrl')
			,	'id': id
		}, {'method': 'post'})
			.error(function(response) {
				console.error(response.responseJSON.message);
				self._editInProgress = false;
			})
			.success(function(response){
				if(response.success) {
					self.clearForm();
					self.fillInForm( response.item );
					self.showForm();
				}
				self._editInProgress = false;
				if($editBtnIcon) {
					$editBtnIcon.attr('class', $editBtnIcon.data('prev-class'));
				}
			});
	};
	Membership.initJqTbl = function( params ) {
		return (this.jqTbls[ params.tblId ] = new jqTbl( params ));
	};
	Membership.getJqTbl = function( tblId ) {
		return this.jqTbls[ tblId ];
	};
	Membership.initEditForm = function( params ) {
		return new editForm( params );
	};
	Membership.showResponseErrors = function( errors, formSelector ) {
		if (! errors) {
			return;
		}

		$('.form-errors').remove();

		var formSelector = formSelector
			,	errorElement = formSelector
			,	errorMessage = '';

		$.each(errors, function (type, message) {
			errorElement = type;
			errorMessage = message;
		});

		var errorsContainer = $('.form-errors');

		if (!errorsContainer.length) {
			errorsContainer = $('<div>', { class: 'form-errors'}).hide();

			var formContainer = $('input[name="' + errorElement + '"]');

			if (!formContainer.length) {
				errorsContainer.appendTo($( formSelector ));
			} else {
				errorsContainer.appendTo(formContainer.closest('.field'));
				$('html, body').stop().animate({
					scrollTop: errorsContainer
				}, 1000);
			}
		}

		errorsContainer.fadeOut().empty();
		errorsContainer.append(errorMessage).fadeIn();
	};

	Membership.showFormResponseErrors = function(errors, form) {

		var $form = typeof form === "string" ? $(form) : form,
			$errorsContainer = $form.find('.ui.error.message').empty();

		$form.find('.ui.message').hide();

		if (! errors) {
			return;
		}

		if	(!$errorsContainer.length) {
			$errorsContainer = $('<div>', { class: 'ui error message'});
			$form.prepend($errorsContainer);
		}

		$.each(errors, function (type, message) {
			$errorsContainer.append($('<p>').html(message));
		});

		$errorsContainer.fadeIn();
	};

	Membership.showFormSuccessMessage = function(message, form) {

		var $form = typeof form === "string" ? $(form) : form,
			$messageContainer = $form.find('.ui.success.message').empty();

		$form.find('.ui.message').hide();

		if (! message) {
			return;
		}

		if	(!$messageContainer.length) {
			$messageContainer = $('<div>', { class: 'ui success message'});
			$form.prepend($messageContainer);
		}

		$messageContainer.append($('<p>').html(message)).fadeIn();
	};

	Membership.tooltip = function( selector ) {
		$( selector ).tooltipster({
			contentCloning: false,
			interactive: true,
			contentAsHTML: true,
			functionInit: function(instance, helper) {
				instance.content($(helper.origin).find('.tooltip_content').detach().text());
			}
		});
	};

	Membership.setCookie = function(c_name, value, exdays) {
		var exdate = new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var value_prepared = '';
		if(typeof(value) == 'array' || typeof(value) == 'object') {
			value_prepared = '_JSON:'+ JSON.stringify( value );
		} else {
			value_prepared = value;
		}
		var c_value = escape(value_prepared)+ ((exdays==null) ? "" : "; expires="+exdate.toUTCString())+ '; path=/';
		document.cookie = c_name+ "="+ c_value;
	};

	Membership.getCookie = function(name) {
		var parts = document.cookie.split(name + "=");
		if (parts.length == 2) {
			var value = unescape(parts.pop().split(";").shift());
			if(value.indexOf('_JSON:') === 0) {
				value = JSON.parse(value.split("_JSON:").pop());
			}
			return value;
		}
		return null;
	};

	Membership.delCookie = function( name ) {
		document.cookie = name+ '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	};

	/**
	 * Convert Date string (in common - mm/dd/yyyy) - to miliseconds
	 * @param {string} strDate date string
	 * @return {int} miliseconds
	 */
	Membership.strToMs = function( strDate ) {
		var dateHours = strDate.split(' ');
		if(dateHours.length == 2) {
			strDate = dateHours[0]+ ' ';
			var hms = dateHours[1].split(':');

			for(var i = 0; i < 3; i++) {
				strDate += hms[ i ] ? hms[ i ] : '00';
				if(i < 2)
					strDate += ':';
			}
		}
		var date = new Date( Membership.strReplace('-', '/', strDate) )
			,	res = 0;
		if(date) {
			res = date.getTime();
		}
		return res;
	}

	window.Membership = Membership;
	
})(jQuery, window.Membership || {});