(function($, Membership) {
	function GoogleMapsEasyForMembership() {
	}

	GoogleMapsEasyForMembership.prototype.init = (function() {
		if(Membership.GalleryTabs) {
			this.modalTabs =  Membership.GalleryTabs;
			this.gMapsAttachmentTemplate = $($(".mbs-GoogleMaps-one-template").html());

			this.modalWndInit();
		}
	});

	GoogleMapsEasyForMembership.prototype.modalWndButtonInit = (function() {
		var self = this;

		$('.post-activity-buttons .button[data-action="select-googlemapseasy"]').on('click', function() {
			self.$modalNextButton.addClass('disabled');

			var $presetOptionList = self.$modalMapsSelectorList.find('option');
			if($presetOptionList.length == 2) {
				$presetOptionList.eq(1).prop('selected', true);
			} else {
				self.$modalMapsSelectorList.val(null);
			}
			self.$modalMapsSelectorList.trigger('change');
			// window tabs init
			self.modalTabs.tabsVisibilityUpdate('google-maps-easy', 'page1');
			self.$presetModalWnd.mpModal('showModal');
		});
	});

	GoogleMapsEasyForMembership.prototype.modalWndEvents = (function() {

		if(this.$modalGoogleMapsContainer.children().length) {
			this.$modalGoogleMapsContainer.removeClass('mbs-hidden');
		} else {
			this.$modalGoogleMapsContainer.addClass('mbs-hidden');
		}
		// on close event
		var self = this
		,	$closeIcons = $('.mbs-google-maps-container .close')
		,	$mapsIcons = $('.mbs-google-maps-container .mbs-one-gg-image');

		$closeIcons.off('click');
		$closeIcons.on('click', function(event) {
			event.stopPropagation();
			var currItem = $(this)
			,	mapsId = currItem.data('googleMapsId');
			if(!isNaN(parseInt(mapsId))) {
				if(!currItem.hasClass('mbs-cross-rotating')) {
					currItem.addClass('mbs-cross-rotating');

					Membership.api.googleMapsEasy.removeMap({
						'map_id': mapsId,
					}).then(function(response) {
						if(response) {
							if(response.success) {
								var imageItem = currItem.closest('.mbs-one-gg-image');
								imageItem.hide(400, function() {
									imageItem.remove();
									if(!self.$modalGoogleMapsContainer.children().length) {
										self.$modalGoogleMapsContainer.addClass('mbs-hidden');
									}
									var mapsArraySort = self.$modalGoogleMapsContainer.sortable('toArray', {'attribute': 'data-google-maps-id'});
									self.$modalGoogleMapsContainer.data('google-maps-sort', JSON.stringify(mapsArraySort));
								});
							} else if(response.message) {
								Snackbar.show({text: response.message});
							} else {
								Snackbar.show({text: $('#mbsGoogleMapsStrServerError').val()});
							}
						} else {
							Snackbar.show({text: $('#mbsGoogleMapsStrServerError').val()});
						}
						currItem.removeClass('mbs-cross-rotating');
					}, function(response) {
						Snackbar.show({text: $('#mbsGoogleMapsStrServerError').val()});
						currItem.removeClass('mbs-cross-rotating');
					});
				}
			} else {
				Snackbar.show({text: $('.mbsStrIncorrectGoogleMapsParams').val()});
			}
		});

		$mapsIcons.off('click');
		$mapsIcons.on('click', function() {
			var $currItem = $(this)
			,	mapId = $currItem.attr('data-google-maps-id')
			,	mapPresetId = $currItem.attr('gme-preset-id')
			,	parsedData = null;

			try {
				parsedData = JSON.parse($currItem.attr('data-google-maps-params'));
			} catch(exc1) {}

			self.prepareMapData(mapPresetId, parsedData);

			if(mapId && !isNaN(parseInt(mapId))) {
				var gmMarkers = self.loadMapWithMarkers(mapId, parsedData, self.editWndMarkerTypes);
				if(gmMarkers && gmMarkers.length) {
					// adding rows
					var ind2 = 0;
					while(ind2 < gmMarkers.length) {
						self.mapsMarkersSetRowParam(gmMarkers[ind2], 'load');
						ind2++;
					}
				}
				self.modalTabs.tabsVisibilityUpdate('google-maps-easy', 'page2');
				self.$presetModalWnd.mpModal('showModal');
				self.$currentMapObj.refreshWithCenter(
					self.$currentMapObj.getCenter().lat(),
					self.$currentMapObj.getCenter().lng(),
					self.$currentMapObj.getZoom()
				);
			} else {
				Snackbar.show({text: $('.mbsStrIncorrectGoogleMapsParams').val()});
			}
		});
	});

	GoogleMapsEasyForMembership.prototype.loadMapWithMarkers = (function(mapId, params, markerIconTypes) {
		if(params && !isNaN(parseInt(mapId)) && this.$currentMapObj && window.gmpGoogleMarker) {
			if(params.center && params.center.lat && params.center.lng && params.zoom) {
				// markers
				if(params.markers && params.markers.length) {
					var ind1 = 0;
					while(ind1 < params.markers.length) {
						var oneParam = params.markers[ind1];
						if(oneParam
							&& typeof oneParam.id != 'undefined'
							&& typeof oneParam.title != 'undefined'
							&& typeof oneParam.description != 'undefined'
							&& typeof oneParam.iconUrl != 'undefined'
							&& typeof oneParam.iconId != 'undefined'
							&& typeof oneParam.address != 'undefined'
						) {
							var googleMapsMarker = new window.gmpGoogleMarker(this.$currentMapObj, {
								'position': new google.maps.LatLng(
									this.$currentMapObj.getCenter().lat(),
									this.$currentMapObj.getCenter().lng()
								)
							});
							googleMapsMarker = this.fillMarkerFromParams(googleMapsMarker, oneParam,  markerIconTypes);
							googleMapsMarker.setMap(this.$currentMapObj._mapObj);
							this.markers[oneParam.id] = googleMapsMarker;
							// refresh result URL
							oneParam.iconUrl = googleMapsMarker.getIcon();
						} else {
							// remove this marker from list
							delete params.markers[ind1];
						}
						ind1++;
					}
				}
				this.$currentMapObj.refreshWithCenter(params.center.lat, params.center.lng, params.zoom);
			}
			return params.markers;
		}
		return null;
	});

	GoogleMapsEasyForMembership.prototype.modalWndPage1Init = (function() {
		var self = this;
		self.$modalMapsSelectorList.on('change', function() {
			if(self.$modalMapsSelectorList.val() != '') {
				self.$modalNextButton.removeClass('disabled');
			} else {
				self.$modalNextButton.addClass('disabled');
			}
		});
		// Next button behavior
		self.$modalNextButton.on('click', function() {
			self.$modalNextButton.addClass('disabled');
			self.$modalCurrentMapId.val('');

			// create map in db
			Membership.api.googleMapsEasy.createMap({
				'preset_id': self.$modalMapsSelectorList.val(),
			}).then(function(response){
				if(response.mapId) {
					// add GoogleMapsEasy image to panel
					var $googleMapAttach = self.gMapsAttachmentTemplate.clone()
					,	presetId = self.$modalMapsSelectorList.val();
					$googleMapAttach.attr('data-google-maps-id', response.mapId);
					$googleMapAttach.attr('gme-preset-id', presetId);
					$googleMapAttach.find('.icon').attr('data-google-maps-id', response.mapId);

					self.$modalCurrentMapId.val(response.mapId);
					self.$modalGoogleMapsContainer.append($googleMapAttach);
					self.modalWndEvents();
					self.$modalNextButton.removeClass('disabled');

					// go to tabpage 2
					self.modalTabs.tabsVisibilityUpdate('google-maps-easy', 'page2');
					self.prepareMapData(presetId, null);
					// sort Maps
					self.modalWndSortFunc(self);
					self.prepareMapPage();
					$('.mp-google-maps-modal').trigger('resize');
				} else {
					Snackbar.show({text: $('#mbsGoogleMapsStrServerError').val()});
				}
			}, function(errResponse) {
				var strMessage = $('#mbsGoogleMapsStrServerError').val();
				if(errResponse && errResponse.responseJSON && errResponse.responseJSON.message) {
					strMessage = errResponse.responseJSON.message;
				}
				Snackbar.show({text: strMessage});
				self.$modalNextButton.removeClass('disabled');
			});
		});
	});

	GoogleMapsEasyForMembership.prototype.prepareMapPage = (function() {
		// prepare window height
		var windowH = $(window).height() * 0.5
		,	imageListHeigth = 400;
		if(windowH) {
			imageListHeigth = windowH;
			$('.mp-google-maps-modal.mbs-gg-tab-pages .content.mbs-gg-tab-page[data-tab-info="page2"]').css('max-height', imageListHeigth);
		}
	});

	GoogleMapsEasyForMembership.prototype.prepareMapData = (function(presetId, data) {
		// remove all previous marker rows
		var mapRows = $('.mbsGme-marker-list-body .mbsGme-marker-list-row');
		$.each(mapRows, function(ind, element) {
			$(element).remove();
		});
		if(this.markers && Object.keys(this.markers).length) {
			// remove markers
			for(var ind1 in this.markers) {
				var marker = this.markers[ind1];
				if(marker.setMap) {
					marker.setMap(null);
					delete this.markers[ind1];
				}
			}
		}
		this.markers = {};

		if(presetId) {
			$('.gmp_map_opts[data-mbs-gme-map]').hide();
			var $mbsGmeMap = $('.gmp_map_opts[data-mbs-gme-map="' + presetId + '"]');
			$mbsGmeMap.show();
			this.$currentMapObj = this.findMapById(presetId);
			if(this.$currentMapObj) {
				// Fix map width for some markers list type
				if(this.$currentMapObj._mapObj
					&& this.$currentMapObj._mapObj.marker_list_params
					&& this.$currentMapObj._mapObj.marker_list_params.slide_width
					&&	(
						this.$currentMapObj._mapObj.markers_list_type == 'slider_simple_vertical_title_img'
						|| this.$currentMapObj._mapObj.markers_list_type == 'slider_simple_vertical_title_desc'
						|| this.$currentMapObj._mapObj.markers_list_type == 'slider_simple_vertical_img_2cols'
					)
				) {
					var $modalMapWrapper = $('.mbs-gg-tab-page .gmpMapDetailsContainer')
					,	$modalMapControls = $('.mbs-gg-tab-page .gmpMapProControlsCon');
					if($modalMapWrapper.length && $modalMapControls.length) {
						var parentWidth = parseInt($modalMapWrapper.parent().width())
						,	newMapWrapperWidth = parentWidth - parseInt(this.$currentMapObj._mapObj.marker_list_params.slide_width) - 5;
						if(!isNaN(newMapWrapperWidth) && newMapWrapperWidth > 0) {
							$modalMapWrapper.css('width', newMapWrapperWidth + 'px');
						}
					}
				}

				this.$currentMapObj.refresh();
				if(!data) {
					var mapDefParams = this.findMapDefaultParamsById(presetId)
					// set default Center and Zoom
					if(mapDefParams && mapDefParams.params) {
						if(mapDefParams.params.center) {
							this.$currentMapObj.setCenter(new google.maps.LatLng(
									mapDefParams.params.center.lat(),
									mapDefParams.params.center.lng()
								));
						}
						if(mapDefParams.params.zoom) {
							this.$currentMapObj.setZoom(mapDefParams.params.zoom);
						}
					}
				} else {
					if(data.center && data.center.lat && data.center.lng) {
						this.$currentMapObj.setCenter(new google.maps.LatLng(data.center.lat, data.center.lng));
					}
					if(data.zoom) {
						this.$currentMapObj.setZoom(data.zoom);
					}
				}
			}
		}
	});

	GoogleMapsEasyForMembership.prototype.modalWndPage2Init = (function() {
		var self = this;
		this.initEditMarkerWnd();
		this.$buttonSaveMap = $('#mbs-gmp-modal-page2-ok');

		this.$buttonSaveMap.on('click', function() {
			var mapId = self.$modalCurrentMapId.val()
			,	currentMapParams = self.getParams();
			if (currentMapParams && mapId) {
				self.$buttonSaveMap.prop('disabled', true);
				// data-gmp-map-params
				Membership.api.googleMapsEasy.saveMapParams({
					'map_info': currentMapParams,
					'mapId': mapId,
				}).then(function (response) {
					if (response) {
						if (response.message) {
							Snackbar.show({text: response.message});
						}
						if (response.success) {
							var iconItem = $('.mbs-google-maps-container .mbs-one-gg-image[data-google-maps-id="' + mapId + '"]');
							iconItem.attr('data-google-maps-params', JSON.stringify(currentMapParams));
							self.$presetModalWnd.mpModal('hide');
						} else if (!response.message) {
							Snackbar.show({text: $('#mbsGoogleMapsStrServerError').val()});
						}
					} else {
						Snackbar.show({text: $('#mbsGoogleMapsStrServerError').val()});
					}
					self.$buttonSaveMap.prop('disabled', false);
				}, function (response) {
					Snackbar.show({text: $('#mbsGoogleMapsStrServerError').val()});
					self.$buttonSaveMap.prop('disabled', false);
				});
			}
		});
	});

	GoogleMapsEasyForMembership.prototype.getMarkerIconTypeByUrl = (function(defMarkUrl) {
		var markerIconDefaultId = '';
		if(defMarkUrl && this.editWndMarkerTypes && typeof this.editWndMarkerTypes === 'object') {
			for(var ind in this.editWndMarkerTypes) {
				var currItem = this.editWndMarkerTypes[ind];
				if(currItem && currItem.path && currItem.path === defMarkUrl) {
					markerIconDefaultId = currItem.id;
				}
			}
		}
		this.$modalButtonChooseIcon.attr('data-default-id', markerIconDefaultId);
		this.$modalButtonChooseIcon.attr('data-default-url', defMarkUrl);
	});

	GoogleMapsEasyForMembership.prototype.initEditMarkerWnd = (function() {
		var self = this;
		this.messageAdded = $('#mbgGme-message-added').val();
		this.$buttonAddMarker = $('#mbsGoogleMapsEasyAddMarker');
		this.$markerRowTemplate = $('.mbsGme-list-row-template-item');
		this.$editWindow = $('.mbs-add-marker-inputs');
		this.$editWndMarkerName = $('#mbs-gmp-add-marker-name');
		this.$editWndMarkerDescr = $('#mbs-gmp-add-marker-descr')
		this.$editWndMarkerPosLat = $('#mbs-gmp-add-marker-latitude');
		this.$editWndMarkerPosLng = $('#mbs-gmp-add-marker-longitude');
		this.$editWndMarkerCancelBtn = $('#mbsGoogleMapsEasyCancelEditMarker');
		this.$editWndMarkerSaveBtn = $('#mbsGoogleMapsEasySaveMarker');
		this.$editWndMarkerAddress = $('#mbs-gmp-add-marker-address');
		this.editWndMarkerTypes = {};
		this.$currentMapObj = null;
		this.markers = {};

		if(!this.messageAdded) {
			this.messageAdded = 'Added';
		}
		
		$('#mbs-gmp-add-marker-name, #mbs-gmp-add-marker-descr').on('keyup change paste', function() {
			//self.updateEditWindowFromInputs();
		});
		$('#mbs-gmp-add-marker-latitude, #mbs-gmp-add-marker-longitude').on('keyup change paste', function(event, notResetAddr) {
			var currMap = self.$currentMapObj;
			if(currMap) {
				if(notResetAddr != 1) {
					self.$editWndMarkerAddress.val('');
				}
				self.updateEditWindowFromInputs();

				currMap.setCenter({
					'lat': parseFloat($('#mbs-gmp-add-marker-latitude').val()),
					'lng': parseFloat($('#mbs-gmp-add-marker-longitude').val()),
				});
				currMap.refresh();
			}
		});
		// modal
		this.$modalChooseIconDlg = $('.mp-google-maps-marker-icons-modal');
		this.$modalButtonChooseIcon = $('#mbsGoogleMapsEasyChooseIcon');
		this.$modalButtonOk = $('#mbs-gme-marker-icon-ok-btn');

		this.$buttonAddMarker.on('click', function() {
			self.addMarker(self);
		});
		this.$editWndMarkerCancelBtn.on('click', function() {
			var markerId = self.$editWindow.attr('data-id')
			,	resultCanc = self.cancelMarkerEvent(markerId);
			if(resultCanc == 'removed') {
				// if not saved marker - remove row
				var $currRow = $('.mbsGme-marker-list-row[data-id="' + markerId + '"]');
				$currRow.remove();
			} else if(resultCanc && resultCanc.action == 'canceled') {
				// restore previous information to row
				self.mapsMarkersSetRowParam({
					'id': markerId,
					'newId': null,
					'iconUrl': resultCanc.iconUrl,
					'title': resultCanc.title,
					'lat': resultCanc.lat,
					'lng': resultCanc.lng,
				}, 'update');
			}
			self.$editWindow.slideUp();
			$('#mbs-gmp-modal-page2-ok, #mbsGoogleMapsEasyAddMarker, .mbsGme-marker-edit, .mbsGme-marker-remove').prop('disabled', false);
		});
		this.$editWndMarkerSaveBtn.on('click', function() {
			if(self.$currentMapObj) {
				var markerId = self.$editWindow.attr('data-id');
				var params = self.fillMarkerParamsFromMarkerEditWnd();
				self.mapsMarkersSetMapParam(params, markerId == self.messageAdded ? 'create' : 'update');

				// save edit params to marker
				var resMarkerId = self.saveMarkerEvent(markerId);
				if(markerId === self.messageAdded && resMarkerId != null) {
					self.mapsMarkersSetRowParam({
							'id': markerId,
							'newId': resMarkerId,
							'title': self.$editWndMarkerName.val(),
							'lat': self.$editWndMarkerPosLat.val(),
							'lng': self.$editWndMarkerPosLng.val(),
						}, 'update');
				} else if(markerId == 'edit') {

				}
			}
			self.$editWindow.slideUp();
			$('#mbs-gmp-modal-page2-ok, #mbsGoogleMapsEasyAddMarker, .mbsGme-marker-edit, .mbsGme-marker-remove').prop('disabled', false);
		});
		// address input
		var gmpMembershipAdressInput = new mbsGoogleMapsEasyAddressInput()
		gmpMembershipAdressInput.initInput(self.$editWndMarkerAddress, {
			msgEl: ''
			,	onSelect: function(item, event, ui) {
				if(item) {
					self.$editWndMarkerPosLat.val(item.lat);
					self.$editWndMarkerPosLng.val(item.lng);
					self.$editWndMarkerPosLng.trigger('change', [1]);
				}
			}
		});
		////////////////////////
		// select Icon modal window
		////////////////////////
		this.$modalChooseIconDlg.mpModal({
			'closable' : 0,
			onApprove: function() {
				var selectedMarker = $('.mbsGmeWndIconWrapper .mbsGmeIconPreview.mbsSelected')
				,	retResult = false;
				if(selectedMarker.length) {
					self.$modalButtonChooseIcon.attr('data-id', selectedMarker.data('id'));
					self.$modalButtonChooseIcon.attr('data-img', selectedMarker.find('.mbsGmeMarkerIcon').attr('src'));
					self.updateEditWindowFromInputs();
					retResult = true;
				}
				$('#mbsGoogleMapsEasyChooseIcon, #mbsGoogleMapsEasySaveMarker, #mbsGoogleMapsEasyCancelEditMarker').prop('disabled', false);
				return retResult;
			},
			'onHide': function() {
				$('#mbsGoogleMapsEasyChooseIcon, #mbsGoogleMapsEasySaveMarker, #mbsGoogleMapsEasyCancelEditMarker').prop('disabled', false);
			},
			'allowMultiple' : true,
		});
		// marker icon
		$('.mbsGmeWndIconWrapper .mbsGmeIconPreview').on('click', function() {
			$('.mbsGmeWndIconWrapper .mbsGmeIconPreview').removeClass('mbsSelected');
			$(this).addClass('mbsSelected');
			if($('.mbsGmeWndIconWrapper .mbsGmeIconPreview.mbsSelected').length) {
				self.$modalButtonOk.removeClass('disabled')
			} else {
				self.$modalButtonOk.addClass('disabled')
			}
		});
		// choose button
		this.$modalButtonChooseIcon.on('click', function() {
			$('#mbsGoogleMapsEasyChooseIcon, #mbsGoogleMapsEasySaveMarker, #mbsGoogleMapsEasyCancelEditMarker').prop('disabled', true);
			$('.mbsGmeWndIconWrapper .mbsGmeIconPreview').removeClass('mbsSelected');
			if(self.$modalButtonChooseIcon.attr('data-id')) {
				$('.mbsGmeIconPreview[data-id="' + self.$modalButtonChooseIcon.attr('data-id') + '"]').addClass('mbsSelected');
			}
			self.$modalChooseIconDlg.mpModal('showModal');
		});
		var tempParsed = null;
		try{
			tempParsed = JSON.parse($('#mbsGme-marker-icon-types').val());
		} catch(exc1) {}
		
		if(tempParsed) {
			this.editWndMarkerTypes = tempParsed;
			// find default id by image-url
			this.getMarkerIconTypeByUrl($('#mbsGme-default-marker-icon-url').val());
		}
	});

	GoogleMapsEasyForMembership.prototype.cancelMarkerEvent = (function(markerId) {
		if(markerId == this.messageAdded) {
			this.markers[markerId].removeFromMap();
			delete this.markers[markerId];
			return 'removed';
		} else {
			if(this.markers['edit']) {
				this.markers['edit'].removeFromMap();
				this.markers[markerId].setMap(this.$currentMapObj._mapObj);
				delete this.markers['edit'];

				var params = this.getMarkerInfoByKey(markerId);
				if(params) {
					params['action'] = 'canceled';
					return params;
				}
			}
		}
		return null;
	});

	GoogleMapsEasyForMembership.prototype.fillMarkerParamsFromMarkerEditWnd = (function() {
		var selfContext = this
		,	markerId = selfContext.$editWindow.attr('data-id');

		var params = {};
		if(markerId) {
			params['id'] = markerId;
			params['newId'] = null;
			params['title'] = selfContext.$editWndMarkerName.val();
			params['description'] = selfContext.$editWndMarkerDescr.val();
			params['iconId'] = selfContext.$modalButtonChooseIcon.attr('data-id');
			params['iconUrl'] = selfContext.$modalButtonChooseIcon.attr('data-img');
			params['address'] = selfContext.$editWndMarkerAddress.val();
			params['lat'] = selfContext.$editWndMarkerPosLat.val();
			params['lng'] = selfContext.$editWndMarkerPosLng.val();
		}
		return params;
	});

	GoogleMapsEasyForMembership.prototype.fillWindowEditInputsFromMarkerParams = (function(params) {
		this.$editWindow.attr('data-id', params.id);
		this.$editWndMarkerName.val(params.title);
		this.$editWndMarkerDescr.val(params.description);
		this.$modalButtonChooseIcon.attr('data-id', params.iconId);
		this.$modalButtonChooseIcon.attr('data-img', params.iconUrl);
		this.$editWndMarkerPosLat.val(params.lat)
		this.$editWndMarkerPosLng.val(params.lng);
		this.$editWndMarkerAddress.val(params.address);
	});

	GoogleMapsEasyForMembership.prototype.mapsMarkersSetMapParam = (function(params, editType) {
		if(editType != 'create' && editType != 'update') {
			return;
		}
		var self = this;

		if(params
			&& typeof params.id != 'undefined'
			&& typeof params.title != 'undefined'
			&& typeof params.description != 'undefined'
			&& typeof params.lat != 'undefined'
			&& typeof params.lng != 'undefined'
			&& typeof params.iconUrl != 'undefined'
			&& typeof params.iconId != 'undefined'
			&& typeof params.address != 'undefined') {
			if(params.id in this.markers) {
				// if parameters Changed
				var currMarker = this.markers[params.id];
				if(params.id != this.messageAdded) {
					if(!this.markers['edit']) {
						this.markers['edit'] = this.createMarkerFromAnother(currMarker);
						currMarker.removeFromMap();
						currMarker = this.markers['edit'];
						currMarker.setMap(this.$currentMapObj._mapObj);
					} else {
						currMarker = this.markers['edit'];
					}
				}
				currMarker = self.fillMarkerFromParams(currMarker, params);
			}
		}
	});

	GoogleMapsEasyForMembership.prototype.fillMarkerFromParams = (function(marker, params, markerTypes) {
		var currPos = marker.getPosition();

		// need to change title?
		if(marker.getTitle() != params.title) {
			marker.setTitle(params.title);
		}
		// need to change address
		if(marker.getMarkerParam('gmpAddress') != params.address) {
			marker.setMarkerParam('gmpAddress', params.address);
		}
		// need to change description?
		if(marker.getDescription() != params.description) {
			marker.setDescription(params.description);
		}
		// need to change position?
		if(!currPos || currPos.lat() != params.lat || currPos.lng() != params.lng) {
			marker.setPosition(params.lat, params.lng);
		}
		if(params.iconId) {
			marker.setMarkerParam('iconId', params.iconId);
		}
		// need to change icon?
		var iconUrl = marker.getIcon();
		if(params.iconUrl && iconUrl != params.iconUrl) {
			marker.setIcon(params.iconUrl);
		} else {
			// restore url from markerTypes
			var iconId = marker.getMarkerParam('iconId');
			if(markerTypes) {
				if(markerTypes[iconId] && markerTypes[iconId].path) {
					marker.setIcon(markerTypes[iconId].path);
				}
			}
		}
		return marker;
	});

	GoogleMapsEasyForMembership.prototype.updateEditWindowFromInputs = (function() {
		var selfContext = this
		,	params = selfContext.fillMarkerParamsFromMarkerEditWnd();

		/// update ROW INFO
		selfContext.mapsMarkersSetRowParam(params, 'update');
		/// update MAP INFO
		selfContext.mapsMarkersSetMapParam(params, 'update');
	});

	GoogleMapsEasyForMembership.prototype.createMarkerFromAnother = (function(baseMarker) {
		var newMarker = null;
		if(baseMarker && baseMarker.getPosition && baseMarker.getPosition().lat && baseMarker.getPosition().lng) {
			if (this.$currentMapObj && window.gmpGoogleMarker) {
				newMarker = new window.gmpGoogleMarker(this.$currentMapObj, {
					'position': new google.maps.LatLng(
						baseMarker.getPosition().lat(),
						baseMarker.getPosition().lng()
					),
					'id': 'edit',
				});

				if (baseMarker.getTitle) {
					newMarker.setTitle(baseMarker.getTitle());
				}
				if (baseMarker.getDescription()) {
					newMarker.setDescription(baseMarker.getDescription());
				}
				if (baseMarker.getMarkerParam('iconId')) {
					newMarker.setMarkerParam('iconId', baseMarker.getMarkerParam('iconId'));
				}
				// need to change icon?
				if (baseMarker.getIcon) {
					newMarker.setIcon(baseMarker.getIcon());
				}
				if (baseMarker.getMarkerParam('gmpAddress')) {
					newMarker.setMarkerParam(baseMarker.getMarkerParam('gmpAddress'));
				}
			}
		}
		return newMarker;
	});

	GoogleMapsEasyForMembership.prototype.getMarkerInfoByKey = (function(markerId, markerTypes) {
		if(markerId in this.markers) {

			var params = {}
			,	currMarker = this.markers[markerId]
			,	description = currMarker.getDescription()
			,	currPos = currMarker.getPosition()
			,	title = currMarker.getTitle()
			,	iconId = currMarker.getMarkerParam('iconId')
			,	iconUrl = currMarker.getIcon();
			if(!title) {
				title = '';
			}
			if(!description) {
				description = '';
			}
			if(!iconUrl) {
				// restore url from markerTypes
				if(markerTypes && iconId) {
					if(markerTypes[iconId] && markerTypes[iconId].path) {
						iconUrl = markerTypes[iconId].path;
					}
				} else {
					iconUrl = '';
				}
			}
			params['id'] = markerId;
			params['newId'] = null;
			params['title'] = title;
			params['description'] = description;
			params['iconId'] = iconId;
			params['iconUrl'] = iconUrl;
			params['address'] = currMarker.getMarkerParam('gmpAddress');
			params['lat'] = currPos.lat();
			params['lng'] = currPos.lng();
			return params;
		}
		return null;
	});

	GoogleMapsEasyForMembership.prototype.findMapById = (function(id) {
		var mapFounded = null
		,	currInd = 0;
		if(typeof(g_gmlAllMaps) !== 'undefined' && g_gmlAllMaps && g_gmlAllMaps.length && id) {
			while(currInd < g_gmlAllMaps.length && !mapFounded) {
				if(g_gmlAllMaps[currInd]._mapParams && g_gmlAllMaps[currInd]._mapParams.id == id && g_gmlAllMaps[currInd]._mapParams.mbs_presets == 1) {
					mapFounded = g_gmlAllMaps[currInd];
				}
				currInd++;
			}
		}
		return mapFounded;
	});

	GoogleMapsEasyForMembership.prototype.findMapDefaultParamsById = (function(paramId) {
		var mapFounded = null
		,	currInd = 0;
		if(typeof(gmpAllMapsInfo) !== 'undefined' && gmpAllMapsInfo && gmpAllMapsInfo.length) {
			while(currInd < gmpAllMapsInfo.length && !mapFounded) {
				if(gmpAllMapsInfo[currInd].id == paramId && !gmpAllMapsInfo[currInd].mbs_created) {
					mapFounded = gmpAllMapsInfo[currInd];
				}
				currInd++;
			}
		}
		return mapFounded;
	});

	GoogleMapsEasyForMembership.prototype.addMarker = (function(selfParam) {
		$('#mbs-gmp-modal-page2-ok, #mbsGoogleMapsEasyAddMarker, .mbsGme-marker-edit, .mbsGme-marker-remove').prop('disabled', true);
		// get current map
		if (selfParam.$currentMapObj && window.gmpGoogleMarker) {
			var markerId = selfParam.messageAdded
				, markerObject = new window.gmpGoogleMarker(selfParam.$currentMapObj, {
				'position': new google.maps.LatLng(
					selfParam.$currentMapObj.getCenter().lat(),
					selfParam.$currentMapObj.getCenter().lng()
				),
				'id': markerId,
			});
			selfParam.markers[markerId] = markerObject;
			selfParam.mapsMarkersSetRowParam({
				'id': markerId,
				'newId': null,
			}, 'create');

			selfParam.mapsMarkerEditInputParam(markerObject, 'create');
			this.$editWindow.slideDown();
		}
	});

	GoogleMapsEasyForMembership.prototype.saveMarkerEvent = (function(markerId) {
		if(markerId == this.messageAdded) {
			var newMarkerId = 'm' + Object.keys(this.markers).length + '-' + Math.floor(Math.random()*10000000)
			this.markers[newMarkerId] = this.markers[markerId];
			delete this.markers[markerId];
			return newMarkerId;
		} else {
			if(this.markers['edit']) {
				delete this.markers[markerId];
				this.markers[markerId] = this.markers['edit']
				delete this.markers['edit'];
				return 'edit';
			}
		}
		return null;
	});

	GoogleMapsEasyForMembership.prototype.mapsMarkerEditInputParam = (function(markerObject, editType) {
		if(editType != 'create' && editType != 'update') {
			return;
		}
		var self = this;

		// Reseting Edit window Entry
		if(editType == 'create') {
			self.$editWndMarkerName.val('');
			self.$editWndMarkerDescr.val('');
			self.$editWndMarkerAddress.val('');

			self.$modalButtonChooseIcon.attr('data-id', self.$modalButtonChooseIcon.attr('data-default-id'));
			self.$modalButtonChooseIcon.attr('data-img', self.$modalButtonChooseIcon.attr('data-default-url'));
			if(markerObject && markerObject && markerObject.getPosition) {
				var markerPos = markerObject.getPosition();
				self.$editWndMarkerPosLat.val(markerPos.lat());
				self.$editWndMarkerPosLng.val(markerPos.lng());
			} else {
				self.$editWndMarkerPosLat.val('');
				self.$editWndMarkerPosLng.val('');
			}
			self.$editWndMarkerAddress.val('');
			self.$editWndMarkerPosLng.trigger('change');
		}
	});

	GoogleMapsEasyForMembership.prototype.mapsMarkersSetRowParam = (function(params, editType) {
		if(!params || (editType != 'create' && editType != 'update' && editType != 'load')) {
			return;
		}
		var self = this
		,	markerId = params['id']
		,	$oneRow = null;
		if(editType == 'create' || editType == 'load') {
			$oneRow = $(self.$markerRowTemplate.val());
		} else if(editType == 'update') {
			$oneRow = $('.mbsGme-marker-list-row[data-id="' + markerId + '"]');
			if(params.newId) {
				markerId = params['newId'];
			}
		}

		$oneRow.attr('data-id', markerId);
		// add events for buttons
		var $editButton = $oneRow.find('.mbsGme-marker-edit')
		,	$removeButton = $oneRow.find('.mbsGme-marker-remove')
		,	$idField = $oneRow.find('.mbsGme-marker-list-id')
		,	$titleField = $oneRow.find('.mbsGme-marker-list-title')
		,	$rowIconUrl = $oneRow.find('.mbsGme-marker-list-icon-img')
		,	$rowMarkerLat = $oneRow.find('.mbsGme-marker-list-lat')
		,	$rowMarkerLng = $oneRow.find('.mbsGme-marker-list-lng');

		// set Marker Id
		$editButton.attr('data-id', markerId);
		$removeButton.attr('data-id', markerId);
		$idField.text(markerId);
		self.$editWindow.attr('data-id', markerId);

		// only for Create
		if(editType == 'create') {
			$editButton.prop('disabled', true);
			$removeButton.prop('disabled', true);
		}
		// for Load and Create
		if(editType == 'load' || editType == 'create') {
			$('.mbsGme-marker-list-body').append($oneRow);

			$editButton.on('click', function(event) {
				self.editMarkerButtonEvent(event, $(this), self);
			});
			$removeButton.on('click', function(event) {
				self.removeMarkerButtonEvent(event, $(this));
			});
		}
		// for Load and Update
		if(editType == 'load' || editType == 'update') {
			if(params.title) {
				$titleField.text(params.title);
			}
			if(params.lat) {
				$rowMarkerLat.text(params.lat);
			}
			if(params.lng) {
				$rowMarkerLng.text(params.lng);
			}
			if(params.iconUrl) {
				$rowIconUrl.attr('src', params.iconUrl);
			}
		}
	});

	GoogleMapsEasyForMembership.prototype.editMarkerButtonEvent = (function(event, $button, selfParam) {
		var markerId = $button.attr('data-id');
		if(markerId) {
			var markerParams = this.getMarkerInfoByKey(markerId, selfParam.editWndMarkerTypes);
			if(markerParams) {
				$('#mbs-gmp-modal-page2-ok, #mbsGoogleMapsEasyAddMarker, .mbsGme-marker-edit, .mbsGme-marker-remove').prop('disabled', true);
				this.fillWindowEditInputsFromMarkerParams(markerParams);
				selfParam.$editWindow.slideDown();
			}
		}
	});

	GoogleMapsEasyForMembership.prototype.removeMarkerButtonEvent = (function(event, $button) {
		$button.prop('disabled', true);
		var markerId = $button.attr('data-id');
		if(markerId in this.markers) {
			this.markers[markerId].removeFromMap();
			delete this.markers[markerId];
			$('.mbsGme-marker-list-row[data-id="' + markerId + '"]').remove();
 		}
	});

	GoogleMapsEasyForMembership.prototype.modalWndSortFunc = (function(selfParam) {

		var mapsArraySort = selfParam.$modalGoogleMapsContainer.sortable('toArray', {'attribute': 'data-google-maps-id'});
		selfParam.$modalGoogleMapsContainer.data('google-maps-sort', JSON.stringify(mapsArraySort));
		Membership.api.googleMapsEasy.setPreviewPosition({
			'gmaps_array': mapsArraySort,
		}).then(function(response){
			if(response) {
				if(response.success) {
					
				} else if(response.message) {
					Snackbar.show({text: response.message});
				} else {
					Snackbar.show({text: $('#mbsGoogleMapsStrServerError').val()});
				}
			} else {
				Snackbar.show({text: $('#mbsGoogleMapsStrServerError').val()});
			}
		}, function(response) {
			Snackbar.show({text: $('#mbsGoogleMapsStrServerError').val()});
		});
	});

	GoogleMapsEasyForMembership.prototype.modalWndInit = (function() {
		var self1 = this;
		this.$presetModalWnd = $('.mp-google-maps-modal');
		this.$modalMapsSelectorList = $('#googleMapsPresetSel');
		this.$modalNextButton = $('#mbs-google-maps-gg-next');
		this.$modalCurrentMapId = $('#mbsGme-current-map-id');

		this.$modalGoogleMapsContainer = $('.mbs-google-maps-container');
		this.$modalGoogleMapsContainer.sortable({
			update: function() {
				self1.modalWndSortFunc(self1);
			},
		});

		this.modalWndButtonInit();
		// init modal window
		this.$presetModalWnd.mpModal({
			'closable' : 0,
			'allowMultiple' : true,
			'onHide': function() {
				// if user close window when click on marker add
				if(self1.$buttonAddMarker.prop('disabled') == true) {
					self1.$editWndMarkerCancelBtn.trigger('click');
				}
			},
		});
		this.modalWndEvents();
		this.modalWndPage1Init();
		this.modalWndPage2Init();
	});

	function mbsGoogleMapsEasyAddressInput() {
	}

	mbsGoogleMapsEasyAddressInput.prototype.initInput = (function(addressInput, params) {
		var selfMbs = this;
		params = params || {};

		addressInput.keyup(function(event){
			// Ignore tab, enter, caps, end, home, arrows
			if(selfMbs.foundInArray(event.keyCode, [9, 13, 20, 35, 36, 37, 38, 39, 40])) return;

			var searchData = $.trim(jQuery(this).val());
			if(searchData && searchData != '') {
				if(typeof(params.msgEl) === 'string') {
					params.msgEl = jQuery(params.msgEl);
				}
				// params.msgEl.showLoaderGmp();
				var self = this;

				$(this).autocomplete({
					source: function(request, response) {
						var autocomleateData = typeof(params.additionalData) != 'undefined' ? selfMbs.getPreparedData(params.additionalData, request.term) : []
						,	geocoder = selfMbs.getGeocoder()
						,	geocoderData = { 'address': searchData };

						if(typeof(params.geocoderParams) != 'undefined' && params.geocoderParams) {
							geocoderData = jQuery.extend({}, geocoderData, params.geocoderParams)
						}
						geocoder.geocode(geocoderData, function(results, status) {
							params.msgEl.html('');

							if(status == google.maps.GeocoderStatus.OK && results.length) {
								for(var i = 0; i < results.length; i++) {
									autocomleateData.push({
										label: results[i].formatted_address
										,	lat: results[i].geometry.location.lat()
										,	lng: results[i].geometry.location.lng()
										,	category: $('#mbsGmpMarkerMsg-places').val()
									});
								}
								response(autocomleateData);
							} else {
								if(autocomleateData) {
									response(autocomleateData);
								} else {
									var notFoundMsg = $('#mbsGmpMarkerMsg-nothing-was-found').val();

									if(jQuery(self).parent().find('.ui-helper-hidden-accessible').size()) {
										jQuery(self).parent().find('.ui-helper-hidden-accessible').html(notFoundMsg);
									} else {
										params.msgEl.html(notFoundMsg);
									}
								}
							}
						});
					}
					,	select: function(event, ui) {
						if(params.onSelect) {
							params.onSelect(ui.item, event, ui);
						}
					}
				});

				// Force imidiate search right after creation
				$(this).autocomplete('search');
			}
		});
	});

	mbsGoogleMapsEasyAddressInput.prototype.getGeocoder = (function() {
		if(!this.googleMapsGeocoder) {
			this.googleMapsGeocoder = new google.maps.Geocoder();
		}
		return this.googleMapsGeocoder;
	});

	mbsGoogleMapsEasyAddressInput.prototype.getPreparedData = (function(data, needle) {
		var autocomleateData = [];
		for(var i = 0; i < data.length; i++) {
			for(var j = 0; j < data[i].length; j++) {
				var label = data[i][j].label.toLowerCase()
					,	desc = data[i][j].marker_desc != 'undefined' ? data[i][j].marker_desc : ''
					,	term = needle.toLowerCase();

				if(label.indexOf(term) !== -1 || (desc && desc.indexOf(term) !== -1)) {
					autocomleateData.push(data[i][j]);
				}
			}
		}
		return autocomleateData;
	});

	mbsGoogleMapsEasyAddressInput.prototype.foundInArray = (function(needle, haystack) {
		if(haystack) {
			for(var i in haystack) {
				if(haystack[i] == needle)
					return true;
			}
		}
		return false;
	});

	GoogleMapsEasyForMembership.prototype.getParams = (function() {
		// prepare markers information
		var markersObj = []
		,	self = this;
		if(self.$currentMapObj) {
			for(var ind in this.markers) {
				if(ind != 'edit' && ind != this.messageAdded) {
					var newMarker = self.getMarkerInfoByKey(ind, self.editWndMarkerTypes)
					,	iconId = parseInt(newMarker.iconId);
					// save to db less data (saving only id, if exists)
					if(newMarker.iconId && !isNaN(iconId) && iconId > 0) {
						newMarker.iconUrl = '';
					}
					if(newMarker) {
						markersObj.push(newMarker);
					}
				}
			}

			return {
				center: {
					lat: self.$currentMapObj.getCenter().lat(),
					lng: self.$currentMapObj.getCenter().lng(),
				},
				'zoom': self.$currentMapObj.getZoom(),
				'markers': markersObj,
			};
		}
		return null;
	});

	GoogleMapsEasyForMembership.prototype.getGmpMarkerParams = (function(markerParams, map_id) {
		var gmpParams = {
			'address': "",
			'animation': null,
			'coord_x': null,
			'coord_y': null,
			'create_date': null,
			'description': '',
			'icon': 28,
			'icon_data':{
				'description': 'red,cycle',
				'id': 28,
				'path': null,
				'title': 'pin',
			},
			'id': null,
			'map_id': null,
			'marker_group_id': 0,
			'params': {
				'marker_link_src': '',
				'marker_list_def_img_url': '',
				'title_is_link': false,
			},
			'sort_order': 1,
			'title': '',
			'user_id': null,
		};
		if(markerParams.animation) {
			gmpParams['animation'] = markerParams.animation;
		}
		if(markerParams.create_date) {
			gmpParams['create_date'] = markerParams.create_date;
		}
		if(markerParams.id) {
			gmpParams['id'] = markerParams.id;
		}
		if(markerParams.marker_group_id) {
			gmpParams['marker_group_id'] = markerParams.marker_group_id;
		}
		if(markerParams.params) {
			if(markerParams.params.marker_link_src) {
				gmpParams['params']['marker_link_src'] = markerParams.params.marker_link_src;
			}
			if(markerParams.params.marker_list_def_img_url) {
				gmpParams['params']['marker_list_def_img_url'] = markerParams.params.marker_list_def_img_url;
			}
			if(markerParams.params.title_is_link) {
				gmpParams['params']['title_is_link'] = markerParams.params.title_is_link;
			}
		}
		if(markerParams.sort_order) {
			gmpParams['sort_order'] = markerParams.sort_order;
		}
		if(markerParams.user_id) {
			gmpParams['user_id'] = markerParams.user_id;
		}
		if(typeof markerParams.address != 'undefined') {
			gmpParams['address'] = markerParams.address;
		}
		if(typeof markerParams.lat != 'undefined' && typeof markerParams.lng != 'undefined') {
			gmpParams['coord_x'] = markerParams.lat;
			gmpParams['coord_y'] = markerParams.lng;
		}
		if(typeof markerParams.description != 'undefined') {
			gmpParams['description'] = markerParams.description;
		}
		if(typeof markerParams.iconUrl != 'undefined') {
			gmpParams['icon_data']['path'] = markerParams.iconUrl;
		}
		if(typeof markerParams.iconId != 'undefined') {
			gmpParams['icon'] = markerParams.iconId;
			gmpParams['icon_data']['id'] = markerParams.iconId;
		}
		if(typeof markerParams.iconTitle != 'undefined') {
			gmpParams['icon_data']['title'] = markerParams.iconTitle;
		}
		if(typeof markerParams.title != 'undefined') {
			gmpParams['title'] = markerParams.title;
		}
		gmpParams['map_id'] = map_id;
		//markerParams.id
		
		return gmpParams;
	});

	GoogleMapsEasyForMembership.prototype.initAjaxLoading = (function() {
		var self = this;
		$(document).ready(function() {
			$(document).ajaxComplete(function(event, jqXHR, settings) {
				if(window && jqXHR && jqXHR.statusText == "OK" && jqXHR.responseText) {
					var ieSecondParam = 'gui';
					if(window.navigator.userAgent.indexOf("MSIE ") > 0
						|| !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
						ieSecondParam = 'gi';
					}
					var regexRule = new RegExp('class=\\\\"gmp_map_opts[-_ !@#$%^&*\\(\\)\\w\\d\\\\=`\\\\"\\\\\']*'
						+ 'data-id=\\\\"([\\d]+)\\\\"[-_ !@#$%^&*\\(\\)\\w\\d\\\\=`\\\\"\\\\\']*'
						+ 'data-mbs-gme-map-id=[\\\\\']+([\\d]+)[\\\\\']+[\\W]*'
						+ 'data-mbs-gme-map-info=[\\\\\']+('
						+ '[-,\\.:_ \\/!@#$%^&*\\[\\]\\{\\}\\(\\)\\w\\d\\\\=`\\\\"\\\\\']*'
						//+ ')'
						+ ')[\\\\\']+'
						, ieSecondParam)
					,	sliderMatches = null
					,	mapsToInit = [];

					while((sliderMatches = regexRule.exec(jqXHR.responseText)) !== null) {

						if(sliderMatches.length > 3 && typeof gmpInitMapOnPage === 'function') {
							var gmeMapId = sliderMatches[1]
							,	mbsMapId = sliderMatches[2]
							,	config = null;
							try {
								sliderMatches[3] = sliderMatches[3].replace(/\\"/g, '"');
								config = JSON.parse(sliderMatches[3]);
							} catch(exc1) {}

							var currGmpConfig = self.findMapDefaultParamsById(gmeMapId);
							if(currGmpConfig && config) {
								var newMarkersParams = $.extend([], currGmpConfig.markers);
								if(config.markers && config.markers.length) {
									for(var ind1 = 0; ind1 < config.markers.length; ind1++){
										newMarkersParams.push(self.getGmpMarkerParams(config.markers[ind1], gmeMapId));
									}
								}
								var newConfig = $.extend({}, currGmpConfig, {
									'view_html_id': currGmpConfig.view_html_id + gmpAllMapsInfo.length,	// correcting view_id
									'view_id': currGmpConfig.view_id + gmpAllMapsInfo.length,
									'markers': newMarkersParams,
									'params': {
										'zoom': config.zoom,
										'map_center': {
											'coord_x': config.center.lat,
											'coord_y': config.center.lng,
										},
									},
									'view_html_mbs_id': '.gmp_map_opts[data-mbs-gme-map-id="' + mbsMapId + '"] .gmp_MapPreview',
								});

								// remove markers extended options
								if(newConfig.markers) {
									delete newConfig.markers['hasItemInObj'];
									delete newConfig.markers['hasObject'];
									delete newConfig.markers['indexOfObjWithItem'];
								}
								
								// need to copy original maps params
								var originalMap = self.findMapById(gmeMapId);
								if(originalMap) {
									newConfig.params = $.extend({}, originalMap._mapParams, newConfig.params);
									// for new slider init
									delete newConfig.params['original_slider_html'];
									// prepare heatmap
									if(newConfig.heatmap && newConfig.heatmap.coords && newConfig.heatmap.coords.length) {
										var newCoordList = [];
										for(var ind2 = 0; ind2 < newConfig.heatmap.coords.length; ind2++) {
											if(newConfig.heatmap.coords[ind2].length && newConfig.heatmap.coords[ind2].length == 2) {
												newCoordList.push(newConfig.heatmap.coords[ind2][0] + ', ' + newConfig.heatmap.coords[ind2][1]);
											}
										}
										if(newCoordList.length) {
											newConfig.heatmap.coords = newCoordList;
										}
									}
								}

								mapsToInit.push(newConfig);
							}
						}
					}
					if(mapsToInit.length) {
						setTimeout(function() {
							var ind2 = 0;
							while(ind2 < mapsToInit.length) {
								try {
									gmpInitMapOnPage(mapsToInit[ind2]);
								} catch(exc1) {}
								ind2++;
							}
						}, 400);
					}
				}
			});
		});
	});

	var $googleMapsEasyPluginForMembership = new GoogleMapsEasyForMembership();
	$googleMapsEasyPluginForMembership.init();
	$googleMapsEasyPluginForMembership.initAjaxLoading();

})(jQuery, Membership = window.Membership || {});