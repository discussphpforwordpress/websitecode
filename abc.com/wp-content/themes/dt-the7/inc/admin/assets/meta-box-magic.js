// JavaScript Document

jQuery(document).ready(function($){

//Show content
function dt_show($_box, init){
	if (init == true){
		$_box.show();
	} else {
		$_box.animate({ opacity: '1' }, { queue: false, duration: 500 }).slideDown(500);
	}
}

//Hide content
function dt_hide($_box){
	$_box.animate({ opacity: '0' }, { queue: false, duration: 500 }).slideUp(500);
}

//Switch content
function dt_switcher($_this, init){
	var $_box = $("."+$_this.attr("data-name"));
	if ( $_this.attr("value")=="show" && $_this.is(":checked") || $_this.attr("value")=="show" && $_this.is(":hidden") ){
		dt_show($_box, init);
	} else if ($_this.attr("value")=="hide" && $_this.is(":checked") || $_this.attr("value")=="hide" && $_this.is(":hidden") ) {
		dt_hide($_box);
	}
	// add checkbox support
	if( $_this.is('input[type="checkbox"]') ) {
		if( $_this.is(":checked") ) dt_show($_box, init);
		else dt_hide($_box);
	}
}

/* Radio-image: begin */
//Highlite the active radio-image
$(".dt_radio-img label input:checked").parent("label").addClass("act").siblings('label').removeClass("act");

//Handle the click on the radio-image
$(".dt_radio-img label").on("click", function(){
	$(this).addClass("act").siblings('label').removeClass("act");
});
/* Radio-image: end */

/* Radio-switcher: begin */
//Show the certain content when the page loads
$(".dt_switcher input:checked").each(function(){
	dt_switcher($(this), true);
})

//Handle the click on the switcher
$(".dt_switcher").on("change", function(e){
	dt_switcher($(" > input", e.currentTarget));
});
/* Radio-switcher: end */

/* Advanced settings toggle: begin */
//Show the certain content when the page loads
$(".dt_advanced input[value=show]").each(function(){
	$(this).parent().addClass("act");
	dt_switcher($(this), true);
});

//Handle the click on the toggle
$(".dt_advanced").on("click", function(e){
	e.preventDefault();

	var	$_this = $(e.currentTarget),
		$_check = $("> input:hidden", $_this);

	if ($_check.attr("value")=="show") {
		$_this.removeClass("act");
		$_check.attr("value", "hide");
	} else if ($_check.attr("value")=="hide") {
		$_this.addClass("act");
		$_check.attr("value", "show");
	}

	dt_switcher($_check);
});
/* Advanced settings toggle: end */

/* Tabs: begin */
//Handle the tab navigation
function dt_tabs(label){
	var	$_this = $(label),
		$_check = $("> input", $_this);
		
	$_this.siblings("label").removeClass("act").find("input").removeAttr("checked");
	$_check.attr("checked","checked");
	$_this.addClass("act");
	
	var $_tabs = $_this.parents(".dt_tabs"),
		$_tabs_content = $_tabs.next(".dt_tabs-content");

	if ($_check.attr("value")=="all") {
		$("> div", $_tabs_content).hide();
		$("> .dt_tab-all", $_tabs_content).show();
		$("> .dt_arrange-by", $_tabs).not('.hide-if-js').hide();
		$_tabs_content.removeClass("except only");
	} else if ($_check.attr("value")=="only") {
		$("> div", $_tabs_content).hide();
		$("> .dt_tab-select", $_tabs_content).show();
		$("> .dt_arrange-by", $_tabs).not('.hide-if-js').show();
		$_tabs_content.removeClass("except").addClass("only");
	} else if ($_check.attr("value")=="except") {
		$("> div", $_tabs_content).hide();
		$("> .dt_tab-select", $_tabs_content).show();
		$("> .dt_arrange-by", $_tabs).not('.hide-if-js').show();
		$_tabs_content.removeClass("only").addClass("except");
	}
	
	if ($_check.attr("value")=="albums") {
		$("> .dt_tab-select > div", $_tabs_content).hide();
		$("> .dt_tab-select > .dt_tab-items", $_tabs_content).show();
	} else if ($_check.attr("value")=="category") {
		$("> .dt_tab-select > div", $_tabs_content).hide();
		$("> .dt_tab-select > .dt_tab-categories", $_tabs_content).show();
	}
}

//Highlite the active tab on the page load
$("label.dt_tab input:checked, label.dt_arrange input:checked").parent("label").addClass("act").siblings('label').removeClass("act");

//Show the active tab content on the page load
$(".dt_tabs input:checked").each(function() {
	dt_tabs($(this).parent("label"));
});

//Handle the click on the tab
$(".dt_tabs label").on("click", function(e){
	e.preventDefault();
	dt_tabs($(e.currentTarget));
});
/* Tabs: end */

/* Checkboxes: begin */
//Handle the check/uncheck action
function dt_toggle_checkbox(checkbox){
	var	$_this = $(checkbox),
		$_check = $("> input", $_this);
		
	if ($_check.attr("checked")=="checked") {
		$_check.removeAttr("checked");
		$_this.removeClass("act");
	} else {
		$_check.attr("checked", "checked");
		$_this.addClass("act");
	}
}

//Show checked checkboxes on the page load
$(".dt_checkbox").each(function(){
	var	$_this = $(this),
		$_check = $("> input", $_this);
		
	if ($_check.attr("checked")=="checked") {
		$_this.addClass("act");
	} else {
		$_this.removeClass("act");
	}
})

//Handle the click on the checkbox 
$(".dt_checkbox").on("click", function(e){
	e.preventDefault();
	dt_toggle_checkbox($(e.currentTarget));
});

//Emulate the click on the checkbox
$(".dt_item-cover, .dt_tab-categories > .dt_list-item > span").on("click", function(e){
	dt_toggle_checkbox($(e.currentTarget).parent().find(".dt_checkbox"));
});

//Emulate hover over the checkbox
$(".dt_item-cover, .dt_tab-categories > .dt_list-item > span").on("mouseenter", function(){
	$(this).parent().find(".dt_checkbox").addClass("dt_hover");
}).on("mouseleave",function(){
	$(this).parent().find(".dt_checkbox").removeClass("dt_hover");
});
/* Checkboxes: end */

$(window).resize(function(){
//	console.log("resizing")
	$(".dt_tabs-content").css({"max-height" : $(window).height() - 150})
});
$(window).trigger("resize");

// custom logic for slideshow header with normal or fancy background
var pageSlideshowHeader = {
	_isSlideshow: false,
	_isTransOrNormal: false,
	_headerTitle: $('.rwmb-input-_dt_header_title input'),
	_headerBg: $('.rwmb-input-_dt_header_background input'),
	_target: $( '.rwmb-input-_dt_header_header-below-slideshow' ),
	init: function() {
		var self = this;

		self._headerTitle.on('change', function() {
			self._checkTitle($(this).val());
			self._changeTargetVisibility();
		});

		self._headerBg.on('change', function() {
			self._checkBg($(this).val());
			self._changeTargetVisibility();
		});

		self._checkTitle(self._headerTitle.filter(':checked').val());
		self._checkBg(self._headerBg.filter(':checked').val());
		self._changeTargetVisibility();
	},
	_checkTitle: function(val) {
		this._isSlideshow = ( 'slideshow' === val );
	},
	_checkBg: function(val) {
		this._isTransOrNormal = ( 'normal' === val || 'transparent' === val );
	},
	_changeTargetVisibility: function() {
		if ( this._isSlideshow && this._isTransOrNormal ) {
			this._target.show();
		} else {
			this._target.hide();
		}
	}
};
pageSlideshowHeader.init();
});
;
jQuery(function($) {

	// from http://stackoverflow.com/questions/1584370/how-to-merge-two-arrays-in-javascript
	function arrayUnique(array) {
	    var a = array.concat();
	    for(var i=0; i<a.length; ++i) {
	        for(var j=i+1; j<a.length; ++j) {
	            if(a[i] === a[j])
	                a.splice(j--, 1);
	        }
	    }

	    return a;
	};

	// show/hide slideshow and fancy header meta boxes
	$('.rwmb-input-_dt_header_title input[type="radio"]').on('change', function(e){
		var $this = $(this),
			val = $this.val(),
			$wpMetaBoxesSwitcher = $('#adv-settings'),
			targetMetaBoxes = ['dt_page_box-slideshow_options', 'dt_page_box-display_slideshow', 'dt_page_box-fancy_header_options'],
			optsList = {
				fancy : ['dt_page_box-fancy_header_options'],
				slideshow : ['dt_page_box-slideshow_options', 'dt_page_box-display_slideshow']
			};

		for (var i=0; i<targetMetaBoxes.length; i++) {
			$('#'+targetMetaBoxes[i]).hide();
			$wpMetaBoxesSwitcher.find('#'+targetMetaBoxes[i]+'-hide').prop('checked', '');
		}

		// show meta boxes
		if ( typeof optsList[ val ] != 'undefined' ) {
			for (var i=0; i<optsList[ val ].length; i++) {
				$('#'+optsList[ val ][i]).show();
				$wpMetaBoxesSwitcher.find('#'+optsList[ val ][i]+'-hide').prop('checked', true);
			}
		}
			
	});

	// trigger change event after meta box switcher
	$("#page_template").on('dtBoxesToggled', function(){
		var template = $(this).val();

		$('.rwmb-input-_dt_header_title input[type="radio"]:checked').trigger('change');
	
		// show/hide meta box fields for templates
		$('.rwmb-hidden-field.hide-if-js').each(function(e){
			var $this = $(this),
				attr = $this.attr('data-show-on');
			
			if ( typeof attr !== 'undefined' && attr !== false ) {
				attr = attr.split(',');
				if ( attr.indexOf(template) > -1 ) { $this.show(); }
				else { $this.hide(); }
			}
		});

	});

	// change event for radio buttons
	$('.rwmb-radio-hide-fields').each(function() {
		var $miniContainer = $(this),
			$container = $miniContainer.parents('.rwmb-field').first();

		$miniContainer.find('input[type="radio"]').on('click', function(e){
			var $input = $(this),
				ids = $input.attr('data-hide-fields'),
				hiddenIds = jQuery.data($miniContainer, 'hiddenFields') || [],
				showIds = hiddenIds;

			if ( ids ) {
				ids = ids.split(',');
			} else {
				ids = new Array();
			}

			/*// hide fields
			for( var i = 0; i < ids.length; i++ ) {
				$('.rwmb-input-'+ids[i]).parent().hide();
				
				var showIndex = showIds.indexOf(ids[i]);
				if ( showIndex > -1 ) {
					showIds.splice(showIndex, 1);
				}
			}

			// show hidden fields
			for( i = 0; i < showIds.length; i++ ) {
				$('.rwmb-input-'+showIds[i]).parent().show();
			}*/

			// hide fields
			for( var i = 0; i < ids.length; i++ ) {
				$('.rwmb-input-'+ids[i]).closest('.rwmb-field, .rwmb-flickering-field').hide();
				
				var showIndex = showIds.indexOf(ids[i]);
				if ( showIndex > -1 ) {
					showIds.splice(showIndex, 1);
				}
			}

			// show hidden fields
			for( i = 0; i < showIds.length; i++ ) {
				$('.rwmb-input-'+showIds[i]).closest('.rwmb-field, .rwmb-flickering-field').show();
			}

			// store hidden ids
			jQuery.data($miniContainer, 'hiddenFields', ids);
		});
		$miniContainer.find('input[type="radio"]:checked').trigger('click').trigger('change');
	});

	// change event for checkboxes
	$('.rwmb-checkbox-hide-fields').each(function() {
		var $miniContainer = $(this),
			$container = $miniContainer.parents('.rwmb-field').first();

		$miniContainer.find('input[type="checkbox"]').on('change', function(e){
			var $input = $(this),
				ids = $input.attr('data-hide-fields');
//				hiddenIds = jQuery.data($miniContainer, 'hiddenFields') || [],
//				showIds = hiddenIds;

			if ( ids ) {
				ids = ids.split(',');
			} else {
				ids = new Array();
			}

			if ( $input.prop('checked') ) { 

				// show hidden fields
				for( i = 0; i < ids.length; i++ ) {
					$('.rwmb-input-'+ids[i]).parent().show();
				}

			} else {

				// hide fields
				for( var i = 0; i < ids.length; i++ ) {
					$('.rwmb-input-'+ids[i]).parent().hide();
/*					
					var showIndex = showIds.indexOf(ids[i]);
					if ( showIndex > -1 ) {
						showIds.splice(showIndex, 1);
					}
*/
				}

			}			

//			console.log( hiddenIds, showIds );

			// store hidden ids
//			jQuery.data($miniContainer, 'hiddenFields', ids);
		});
		$miniContainer.find('input[type="checkbox"]').trigger('change').trigger('change');
	});
	
	/*****************************************************************************************/
	// Proportions slider
	/*****************************************************************************************/

	$( '.rwmb-proportion_slider-wrapper .rwmb-slider' ).each( function() {
		var $this = $(this),
			$prview = $this.parents('.rwmb-proportion_slider-wrapper').find('.rwmb-proportion_slider-prop-box'),
			propIndex = parseInt( $this.parents('.rwmb-input').find('input').val() ), // proportion index
			w = 80, // preview width in pixels
			h = 80, // preview height in pixels
			sliderWidth = 407;

		// add legend
		//store our select options in an array so we can call join(delimiter) on them
		var options = [];
		for(var index in rwmbImageRatios) {
			if ( 'length' == index ) continue;
		  	options.push(rwmbImageRatios[index].desc);
		}

		//how far apart each option label should appear
		var width = parseInt(Math.round( sliderWidth / (options.length - 1) ));

		//after the slider create a containing div with p tags of a set width.
		$this.after('<div class="ui-slider-legend"><p style="width:' + width + 'px;">' + options.join('</p><p style="width:' + width + 'px;">') +'</p></div><div class="rwmb-slider-prop-label"><span></span></div>');

		// get new dimensions
		var res = dtResizeSquare( propIndex, w, h ),
			$label = $this.siblings('.rwmb-slider-prop-label').find('span');

		// set new dimesions for preview
		$prview.css('width', res.w);
		$prview.css('height', res.h);

		// set label
		$label.text(res.desc);

		// slider on slide event
		$this.on( 'slide', function ( event, ui ) {
			var	propIndex = ui.value,
				res = dtResizeSquare( propIndex, w, h );

			// set new dimensions for preview
			$prview.css('width', res.w);
			$prview.css('height', res.h);

			// set label
			$label.text( res.desc );
		});
	});

});

function dtResizeSquare( propIndex, w, h ) {
	var newW, newH, prop, def;

	if ( !arguments.callee.dtDefIndex ) {
		arguments.callee.dtDefIndex = dtGetDefaultIndex();
	}

	def = arguments.callee.dtDefIndex;

	if ( !propIndex ) propIndex = def;

	// get proportion from global object
	prop = rwmbImageRatios[ propIndex ].ratio;

	if ( propIndex < def ) {
		newH = parseInt(Math.round( w / prop ));
		newW = parseInt(Math.round( prop * newH ));
	} else if ( propIndex == def ) {
		newW = w;
		newH = h;
	} else if ( propIndex > def ) {
		newW = parseInt(Math.round( prop * h ));
		newH = parseInt(Math.round( newW / prop ));
	}

	return { w: newW, h: newH, desc: rwmbImageRatios[ propIndex ].desc };
}

function dtGetDefaultIndex() {
	var length = rwmbImageRatios.length,
		def = 1;

	for ( var i=1; i<=length; i++ ) {
		if ( 1 == rwmbImageRatios[i].ratio ) {
			def = i;
			break;
		}
	}
	
	return def;
}

;
jQuery(document).ready( function() {
	
	var dt_boxes = new Object();
	// new!
	var dt_nonces = new Object();
	
	function dt_find_boxes() {
		jQuery('.postbox').each(function(){
			var this_id = jQuery(this).attr('id');
			if(this_id && this_id.match(/dt_page_box-/i)){
				dt_boxes[this_id] = '#'+this_id;
				//new!
				if( typeof (nonce_field = jQuery(this).find('input[type="hidden"][name*="nonce_"]').attr('id')) != 'undefined' ) {
					dt_nonces[this_id] = '#'+nonce_field;
				}
			}
		});
	}
	// new!
	dt_find_boxes();

	function dt_toggle_boxes() {
		var metaBoxes = arguments,
			$wpMetaBoxesSwitcher = jQuery('#adv-settings');

		if( typeof arguments[0] == 'object' ) {
			metaBoxes = arguments[0];
		}

		for(var key in dt_boxes) {
			$wpMetaBoxesSwitcher.find(dt_boxes[key] + '-hide').prop('checked', '');
			jQuery(dt_boxes[key]).hide();

			//new!
			if( 'dt_blocked_nonce' != jQuery(dt_nonces[key]).attr('class') ) {
				jQuery(dt_nonces[key]).attr('name', 'blocked_'+jQuery(dt_nonces[key]).attr('name'));
				jQuery(dt_nonces[key]).attr('class', 'dt_blocked_nonce');
			}
		}

		for(var i=0;i<metaBoxes.length;i++) {
			$wpMetaBoxesSwitcher.find(metaBoxes[i] + '-hide').prop('checked', true);
			jQuery(metaBoxes[i]).show();

			// new!
			var nonce_key = metaBoxes[i].slice(1);
			if( 'dt_blocked_nonce' == jQuery(dt_nonces[nonce_key]).attr('class') ) {
				var new_name = jQuery(dt_nonces[nonce_key]).attr('name').replace("blocked_", "");
				jQuery(dt_nonces[nonce_key]).attr('name', new_name);
				jQuery(dt_nonces[nonce_key]).attr('class', '');
			}
		}
	}

	function the7ShowBoxesForPageTemplate( templateName ) {
        var activeMetaBoxes = [];

        for( var metabox in dtMetaboxes ) {
            // choose to show or not to show
            if ( !dtMetaboxes[metabox].length || dtMetaboxes[metabox].indexOf(templateName) > -1 ) { activeMetaBoxes.push('#'+metabox); }
        }

        if ( activeMetaBoxes.length ) {
            dt_toggle_boxes(activeMetaBoxes);
        } else {
            dt_toggle_boxes();
        }
	}

	jQuery("#page_template").change(function() {
		var $this = jQuery(this);

        the7ShowBoxesForPageTemplate($this.val());
		$this.trigger('dtBoxesToggled');
	}).trigger('dtBoxesToggled');
});

;
jQuery(document).ready( function($) {

    function updatePresetsList(newPresetsList) {
        var newOptionsHTML = newPresetsList.reduce(function (str, presetName) {
            return str + '<option value="' + presetName.id + '">' + presetName.name + '</option>';
        }, '');
        $('#the7-post-meta-presets').html(newOptionsHTML);
    }

    function isError(response) {
        return !response.success;
    }

    function alertError(response) {
        try {
            alert(response.data.msg);
        } catch (e) {
            console.log(e);
        }
    }

    function getPostMeta() {
        return $('.rwmb-field').find(':input').serializeArray();
    }

    function presetActionsVisibilityCheck() {
        var id = $('#the7-post-meta-presets').val();
        var $buttons = $('#the7-post-meta-save-preset, #the7-post-meta-delete-preset, #the7-post-meta-apply-preset');

        if (id) {
            $buttons.removeAttr('disabled');
        } else {
            $buttons.attr('disabled', 'disabled');
        }
    }

    $('#the7-post-meta-apply-preset').on('click', function (event) {
        event.preventDefault();

        var postID = $('#post_ID').val();
        var id = $('#the7-post-meta-presets').val();

        if (id === '') {
            return;
        }

        var $this = $(this);
        var originText = $this.text();
        $this.addClass('active ready').text(the7MetaPresetsStrings.applyingPreset);

        $.post(ajaxurl, {
            action: 'the7_meta_preset',
            preset_action: 'apply_preset',
            _ajax_nonce: the7MetaPresetsNonces._ajax_nonce,
            postID: postID,
            id: id
        })
            .done(function (response) {
                if ( isError(response) ) {
                    $this.removeClass('active ready').text(originText);
                    alertError(response);
                    return;
                }

                window.location.reload();
            })
            .fail(function () {
                $this.removeClass('active ready').text(originText);
            });
    });

    $('#the7-post-meta-delete-preset').on('click', function (event) {
        event.preventDefault();

        var postID = $('#post_ID').val();
        var id = $('#the7-post-meta-presets').val();

        if (id === '') {
            return;
        }

        $.post(ajaxurl, {
            action: 'the7_meta_preset',
            preset_action: 'delete_preset',
            _ajax_nonce: the7MetaPresetsNonces._ajax_nonce,
            postID: postID,
            id: id
        })
            .done(function (response) {
                if ( isError(response) ) {
                    alertError(response);
                    return;
                }

                try {
                    updatePresetsList(response.data.presetsNames);
                    presetActionsVisibilityCheck();
                } catch (e) {
                    // Some error handling.
                    console.log(e);
                }
            });
    });

    $('#the7-post-meta-add-preset').on('click', function (event) {
        event.preventDefault();

        var title = prompt(the7MetaPresetsStrings.enterName, '');
        title = title.trim();
        if (!title) {
            return;
        }

        var postID = $('#post_ID').val();

        $.post(ajaxurl, {
            action: 'the7_meta_preset',
            preset_action: 'add_preset',
            _ajax_nonce: the7MetaPresetsNonces._ajax_nonce,
            postID: postID,
            title: title,
            meta: getPostMeta()
        })
            .done(function (response) {
                if ( isError(response) ) {
                    alertError(response);
                    return;
                }

                try {
                    updatePresetsList(response.data.presetsNames);
                    presetActionsVisibilityCheck();
                } catch (e) {
                    // Some error handling.
                    console.log(e);
                }
            });
    });

    $('#the7-post-meta-save-preset').on('click', function (event) {
        event.preventDefault();

        var postID = $('#post_ID').val();
        var id = $('#the7-post-meta-presets').val();

        if (id === '') {
            return;
        }

        $.post(ajaxurl, {
            action: 'the7_meta_preset',
            preset_action: 'save_preset',
            _ajax_nonce: the7MetaPresetsNonces._ajax_nonce,
            postID: postID,
            id: id,
            meta: getPostMeta()
        })
            .done(function (response) {
                if ( isError(response) ) {
                    alertError(response);
                    return;
                }

                alert(the7MetaPresetsStrings.presetSaved);
            });
    });

    $('#the7-post-meta-save-defaults').on('click', function (event) {
        event.preventDefault();

        var postID = $('#post_ID').val();

        $.post(ajaxurl, {
            action: 'the7_meta_preset',
            preset_action: 'save_defaults',
            _ajax_nonce: the7MetaPresetsNonces._ajax_nonce,
            postID: postID,
            meta: getPostMeta()
        })
            .done(function (response) {
                if ( isError(response) ) {
                    alertError(response);
                    return;
                }

                alert(the7MetaPresetsStrings.defaultsSaved);
            });
    });
});