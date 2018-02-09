	dtGlobals.desktopProcessed = false;
	dtGlobals.mobileProcessed = false;

	var headerBelowSliderExists = $(".floating-navigation-below-slider").exists(),
		bodyTransparent = $body.hasClass("transparent"),
		stickyMobileHeaderExists = $(".sticky-mobile-header").exists();


/* #Floating menu
================================================== */
	if(window.innerWidth <= dtLocal.themeSettings.mobileHeader.firstSwitchPoint && !$body.hasClass("responsive-off")){
		$('.masthead:not(.side-header):not(#phantom)').addClass("masthead-mobile-header");
		$('body:not(.overlay-navigation):not(.sticky-header) .side-header:not(#phantom)').addClass("masthead-mobile-header");
	}
	if(window.innerWidth <= dtLocal.themeSettings.mobileHeader.firstSwitchPoint && window.innerWidth > dtLocal.themeSettings.mobileHeader.secondSwitchPoint && !$body.hasClass("responsive-off")){
		//Check if top bar not empty on mobile
		if($('.left-widgets', $topBar).find(".in-top-bar-left").length > 0 || $('.right-widgets', $topBar).find(".in-top-bar-right").length > 0){
			$topBar.removeClass('top-bar-empty');
		}else{
			$topBar.addClass('top-bar-empty');
		}
	}else if(window.innerWidth <= dtLocal.themeSettings.mobileHeader.secondSwitchPoint && !$body.hasClass("responsive-off")) {
		if($('.left-widgets', $topBar).find(".in-top-bar").length > 0){
			$topBar.removeClass('top-bar-empty');
		}else{
			$topBar.addClass('top-bar-empty');
		}
	}

	/*
	// Mobile sticky header
	// variables $mastheadHeader, $mainSlider are defined in header.js atom
	*/
	var floatingNavigationBelowSliderExists = $(".floating-navigation-below-slider").exists();

	if($('.sticky-mobile-header').exists()){

		var $stickyMobileHeader =  $(".masthead:not(.side-header):not(#phantom), body:not(.overlay-navigation):not(.sticky-header) .side-header:not(#phantom)"),
			$mobileMenu = $stickyMobileHeader.find(".mobile-header-bar");
			$stickyMobileLogo = $stickyMobileHeader.find(".mobile-branding"),
			mobileLogoURL = $(".mobile-branding a").attr("href");

		// Logo for mobile sticky floating header: first switch point
		if(!$(".sticky-mobile-logo-first-switch").exists() && bodyTransparent) {
			if (dtLocal.themeSettings.stickyMobileHeaderFirstSwitch.logo.html) {
				if (mobileLogoURL == undefined) {
					$(dtLocal.themeSettings.stickyMobileHeaderFirstSwitch.logo.html).addClass("sticky-mobile-logo-first-switch").prependTo($stickyMobileLogo)
				}
				else {
					$('<a class="sticky-mobile-logo-first-switch" href="'+mobileLogoURL+'">' + dtLocal.themeSettings.stickyMobileHeaderFirstSwitch.logo.html +' </a>').prependTo($stickyMobileLogo);
				};
			};
		};

		// Logo for mobile sticky floating header: second switch point
		if(!$(".sticky-mobile-logo-second-switch").exists() && bodyTransparent) {
			if (dtLocal.themeSettings.stickyMobileHeaderSecondSwitch.logo.html) {
				if (mobileLogoURL == undefined) {
					$(dtLocal.themeSettings.stickyMobileHeaderSecondSwitch.logo.html).addClass("sticky-mobile-logo-second-switch").prependTo($stickyMobileLogo)
				}
				else {
					$('<a class="sticky-mobile-logo-second-switch" href="'+mobileLogoURL+'">' + dtLocal.themeSettings.stickyMobileHeaderSecondSwitch.logo.html +' </a>').prependTo($stickyMobileLogo);
				};
			};
		};


		var mobileTopBarH = 0,
			mobileAdminBarH = 0,
			sliderH = $mainSlider.height(),
			mobileHeaderH = 0,
			mobileMenuH = 0,
			mobileMenuT = 0,
			mobileHeaderDocked = false;

		if (!bodyTransparent) {
			$("<div class='mobile-header-space'></div>").insertBefore($stickyMobileHeader);
			var $MobileHeaderSpace = $(".mobile-header-space");
		}
		if($(".no-cssgridlegacy.no-cssgrid").length > 0  && floatingNavigationBelowSliderExists){
			if (bodyTransparent) {
				$stickyMobileHeader.css({
					"top":  sliderH
				});
				$MobileHeaderSpace.css({
					"top":  sliderH
				});
			}else{
				$MobileHeaderSpace.insertAfter($mainSlider);
				$stickyMobileHeader.insertAfter($mainSlider);
			}
		}


		var resetMobileSizes = function () {
			if (window.innerWidth > dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
				if($(".is-safari").length > 0){
					$stickyMobileHeader.css({
						"width": "",
						"max-width": ""
					});
				}

				$body.removeClass('sticky-mobile-off sticky-mobile-on');
				return false;
			};

			// Admin bar height
			if ($("#wpadminbar").exists() && !Modernizr.mq('only screen and (max-width:600px)')) {
				mobileAdminBarH = $("#wpadminbar").height();
			} else {
				mobileAdminBarH = 0;
			};
	
			// Top-bar height
			if ($topBar.exists() && !$topBar.is( ":hidden" ) && !$topBar.hasClass( "top-bar-empty" ) && !floatingNavigationBelowSliderExists) {
				mobileTopBarH = $topBar.innerHeight();
			}
			else {
				mobileTopBarH = 0;
			};
			// Full & sticky part header height
			if (window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint && window.innerWidth > dtLocal.themeSettings.mobileHeader.secondSwitchPoint) {
				mobileHeaderH = dtLocal.themeSettings.mobileHeader.firstSwitchPointHeight + mobileTopBarH;
				mobileMenuH = dtLocal.themeSettings.mobileHeader.firstSwitchPointHeight;
			}
			else {
				mobileHeaderH = dtLocal.themeSettings.mobileHeader.secondSwitchPointHeight + mobileTopBarH;
				mobileMenuH = dtLocal.themeSettings.mobileHeader.secondSwitchPointHeight;
			};
			
			// Sticky menu position
			if (!floatingNavigationBelowSliderExists) {
				mobileMenuT = mobileTopBarH;
			}
			else if (floatingNavigationBelowSliderExists && !bodyTransparent) {
				mobileMenuT = $mainSlider.height();
			}
			else if (floatingNavigationBelowSliderExists && bodyTransparent) {
				mobileMenuT = $mainSlider.height() - mobileHeaderH;
			}
			else {
				$mobileMenu.offset().top;
			}
			if ($body.hasClass('sticky-mobile-on')){
				$stickyMobileHeader.css({
					"top":  mobileAdminBarH - mobileTopBarH
				});
			}
	
			if (!bodyTransparent) {
				$MobileHeaderSpace.css({
					"height": mobileHeaderH
				});
				$MobileHeaderSpace.css({
					"top":  sliderH
				});
			};
			if($(".is-safari").length > 0){
				$stickyMobileHeader.css({
					"width":  document.documentElement.clientWidth,
					"max-width":  document.documentElement.clientWidth
				});
			}

		};
		resetMobileSizes();
		$window.on("resize debouncedresize", function() {
			resetMobileSizes();
		});

		// Main loop: listening for the scroll event
		$window.on("scroll", function() {
			// Stop execution when on mobile devices
			if (window.innerWidth > dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
				return false;
			}

			var posScrollTop = dtGlobals.winScrollTop;

			// Making header sticky (rewrite relative to $stickyHeader position)
			if ((posScrollTop > mobileMenuT) && (!mobileHeaderDocked)) {
				$body.removeClass('sticky-mobile-off').addClass('sticky-mobile-on');
				if(headerBelowSliderExists && stickyMobileHeaderExists){	
					$body.addClass("fixed-mobile-header");
				};
				$stickyMobileHeader.css({
					"top":  mobileAdminBarH - mobileTopBarH
				});
				mobileHeaderDocked = true;
			}
			else if ((posScrollTop <= mobileMenuT) && (mobileHeaderDocked)) {
				$body.removeClass('sticky-mobile-on').addClass('sticky-mobile-off');
				if(headerBelowSliderExists && stickyMobileHeaderExists){	
					$body.removeClass("fixed-mobile-header");
				};				
				$stickyMobileHeader.css({
					"top": 0
				});
				if($(".no-cssgridlegacy.no-cssgrid").length > 0  && floatingNavigationBelowSliderExists){
					if (bodyTransparent) {
						$stickyMobileHeader.css({
							"top":  sliderH
						});
					}else{
						$stickyMobileHeader.css({
							"top":  sliderH
						});
					}
				}
				mobileHeaderDocked = false;
			};
		});
	};


	/* Set variable for floating menu */

	if (dtGlobals.isMobile && !dtGlobals.isiPad) dtLocal.themeSettings.floatingHeader.showMenu = false;

	var bodyTransparent = $body.hasClass("transparent"),
		phantomStickyExists = $(".phantom-sticky").exists(),
		sideHeaderExists = $(".side-header").exists(),
		sideHeaderHStrokeExists = $(".side-header-h-stroke").exists();


	/* Floating navigation -> Style -> Sticky */

	if(dtLocal.themeSettings.floatingHeader.showMenu && phantomStickyExists) {
		var logoURL = $(".branding a", $mastheadHeader).attr("href"),
			$stickyHeader = $mastheadHeader,
			$stickyMenu = $stickyHeader.find(".header-bar"),
			$branding = $stickyHeader.find(".branding"),
			$logo = $branding.find("img");

		// Using same or different logo?
		if ($(dtLocal.themeSettings.floatingHeader.logo.html).attr("src") === $logo.attr("src")) {
			$branding.find("a").addClass("same-logo");
		}
		else {
			if(!$(".sticky-logo").exists()) {
				if (dtLocal.themeSettings.floatingHeader.logo.html && dtLocal.themeSettings.floatingHeader.logo.showLogo) {
					if (logoURL == undefined) {
						$(dtLocal.themeSettings.floatingHeader.logo.html).addClass("sticky-logo").prependTo($branding);
					}
					else {
						$('<a class="sticky-logo" href="'+logoURL+'">' + dtLocal.themeSettings.floatingHeader.logo.html +' </a>').prependTo($branding);
					};
				};
			};
		};

		var topBarH = 0,
			adminBarH = 0,
			stickyHeaderH = 0,
			stickyMenuH = 0,
			stickyMenuT = 0,
			headerDocked = false,
			headerTransition = "";

		// Appending empty div for sticky header placeholder

		if (!bodyTransparent) {
			$("<div class='header-space'></div>").insertAfter($stickyHeader);
			var $headerSpace = $(".header-space");
		};

		// Adding initial classes
		$stickyHeader.addClass('sticky-off fixed-masthead');

		var mobileReset = false,
			resetSizes = function () {
			// Stop execution when on mobile devices
			if (window.innerWidth <= dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
				if (!mobileReset) {
					mobileReset = true;
					$stickyHeader.removeClass('sticky-off sticky-on');
					if (!bodyTransparent) {
						$headerSpace.removeClass('sticky-space-off sticky-space-on');
					}
					$stickyHeader.css({
						"top":  "",
						"transform" : ""
					});
					headerDocked = false,
					headerTransition = "";
					if($(".is-safari").length > 0){
						$stickyHeader.css({
							"width":  "",
							"max-width":  ""
						});
					}
				}
				return false;
			}
			else if (mobileReset) {
				mobileReset = false;
			}
			
			if(!headerDocked && headerTransition === "") {
				$stickyHeader.addClass('sticky-off');
				if (!bodyTransparent) {
					$headerSpace.addClass('sticky-space-off');
				}	
			}

			// Admin bar height
			if ($("#wpadminbar").exists()) {
				adminBarH = $("#wpadminbar").height();
			}
			else {
				adminBarH = 0;
			};
	
			// Top-bar height
			if ($topBar.exists() && !$topBar.is( ":hidden" ) && !$topBar.hasClass( "top-bar-empty" ) && !floatingNavigationBelowSliderExists) {
				topBarH = $topBar.innerHeight();
			}
			else {
				topBarH = 0;
			};

			// Full header height
			stickyHeaderH = dtLocal.themeSettings.desktopHeader.height + topBarH;
			
			// Sticky part height 
			stickyMenuH = dtLocal.themeSettings.desktopHeader.height;
			
			// Sticky menu position
			if (!floatingNavigationBelowSliderExists) {
				stickyMenuT = topBarH;
			}
			else if (floatingNavigationBelowSliderExists && !bodyTransparent) {
				stickyMenuT = $mainSlider.height();
			}
			else if (floatingNavigationBelowSliderExists && bodyTransparent) {
				stickyMenuT = $mainSlider.height() - stickyMenuH;
			}
			else {
				$stickyMenu.offset().top;
			}
	
			if (!bodyTransparent) {
				$headerSpace.css({
					"height": stickyHeaderH
				});
			};

			if($(".is-safari").length > 0){
				$stickyHeader.css({
					"width":  document.documentElement.clientWidth,
					"max-width":  document.documentElement.clientWidth
				});
			}
		};

		resetSizes();
		$window.on("resize debouncedresize", function() {
			resetSizes();
		});

		// Scroll
		$window.on("scroll", function() {
			// Stop execution when on mobile devices
			if (window.innerWidth <= dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
				return false;
			}

			var posScrollTop = dtGlobals.winScrollTop;

			// Making header sticky (rewrite relative to $stickyHeader position)
			if ((posScrollTop > stickyMenuT) && (!headerDocked)) {
				$stickyHeader.removeClass("sticky-off").addClass("sticky-on");
				if (!bodyTransparent) {
					$headerSpace.removeClass("sticky-space-off").addClass("sticky-space-on");
				}
				$stickyHeader.css({
					"top":  adminBarH - topBarH
				});
				headerDocked = true;

				if (floatingNavigationBelowSliderExists && bodyTransparent) {
					$stickyHeader.css({
						"transform" : "translateY(0)"
					});
				};
			}
			else if ((posScrollTop <= stickyMenuT) && (headerDocked)) {
				$stickyHeader.removeClass("sticky-on").addClass("sticky-off");
				if (!bodyTransparent) {
					$headerSpace.removeClass("sticky-space-on").addClass("sticky-space-off");
				}
				$stickyHeader.css({
					"top": 0
				});
				headerDocked = false;
			
				if (floatingNavigationBelowSliderExists && bodyTransparent) {
					$stickyHeader.css({
						"transform" : "translateY(-100%)"
					});
				};
			};

			// Transition
			if ((posScrollTop > stickyMenuT) && (posScrollTop <= (stickyMenuT + stickyMenuH - dtLocal.themeSettings.floatingHeader.height))) {
				headerTransition = "changing";
				$stickyMenu
				.css({
					"transition" : "none",
					height : stickyMenuT + stickyMenuH - posScrollTop,
				});
			}
			else if (posScrollTop > (stickyMenuT + dtLocal.themeSettings.floatingHeader.height) && headerTransition !== "end") {
				headerTransition = "end";
				$stickyMenu
				.css({
					height : dtLocal.themeSettings.floatingHeader.height,
					"transition" : "all 0.3s ease" 
				});
			}
			else if (posScrollTop <= stickyMenuT && headerTransition !== "start") {
				headerTransition = "start";
				$stickyMenu
				.css({
					height : stickyMenuH,
					"transition" : "all 0.1s ease"
				});
			};
		});		
	};

	//Sticky top line
	if(stickyTopLine.exists()) {
		var stickyTopLineH = stickyTopLine.find('.header-bar').height();
		if (!$('.top-line-space').exists()) {
			$("<div class='top-line-space'></div>").insertBefore(stickyTopLine);
		}
		$('.top-line-space').css({
			height: stickyTopLineH
		});
		$window.on("scroll", function() {

			// When sticky navigation should be shown
			var posScrollTop = dtGlobals.winScrollTop, //window scroll top position
				stickyTopLineH = stickyTopLine.height(),
				showstickyTopLineAfter = posScrollTop > stickyTopLineH;
				if (showstickyTopLineAfter){  
					stickyTopLine.addClass("sticky-top-line-on");
				}
				else{
					stickyTopLine.removeClass("sticky-top-line-on");
				}
		});
	}

	/* Floating navigation -> Style -> fade, Slide */

	if(dtLocal.themeSettings.floatingHeader.showMenu) {

		if (dtLocal.themeSettings.floatingHeader.showMenu && !phantomStickyExists ) {

			var phantomFadeExists = $(".phantom-fade").exists(),
				phantomSlideExists = $(".phantom-slide").exists(),
				splitHeaderExists = $(".split-header").exists();

			if( phantomFadeExists || phantomSlideExists) {


				var $headerMenu = $(".masthead:not(#phantom) .main-nav").clone(true),
					logoURL = $(".branding a", $mastheadHeader).attr("href"),
					isMoved = false;

				if (splitHeaderExists) {
					var headerClass = $mastheadHeader.attr("class");
					var $headerTopLine = $(".side-header-h-stroke, .split-header"),
						$phantom = $('<div id="phantom" class="'+headerClass+'"><div class="ph-wrap"></div></div>').appendTo("body"),
						$menuBox = $phantom.find(".ph-wrap"),
						$widgetBox = $phantom.find(".widget-box"),
						$widget = $headerMenu.find(".mini-widgets"),
						$phantomLogo = $headerTopLine.find(".branding");
					

					/*Phantom logo*/

					if($(".phantom-custom-logo-on").length > 0){

						if (dtLocal.themeSettings.floatingHeader.logo.html && dtLocal.themeSettings.floatingHeader.logo.showLogo) {
							if (logoURL == undefined){
								$(dtLocal.themeSettings.floatingHeader.logo.html).prependTo($phantomLogo)
							}
							else {
								$('<a class="phantom-top-line-logo" href="'+logoURL+'">' + dtLocal.themeSettings.floatingHeader.logo.html +' </a>').prependTo($phantomLogo);
							};
						};

						
					};
					//Generate floating content on load
					var $headerMenu = $(".split-header .header-bar").clone(true);
					$headerMenu.appendTo($menuBox);
				}
				else {
					var headerClass = $mastheadHeader.attr("class"),
						$phantom = $('<div id="phantom" class="'+headerClass+'"><div class="ph-wrap"><div class="logo-box"></div><div class="menu-box"></div><div class="widget-box"></div></div></div>').appendTo("body"),
						$menuBox = $phantom.find(".menu-box"),
						$widgetBox = $phantom.find(".widget-box");

					if ($(".classic-header").length > 0) {
						var $widget = $(".header-bar .navigation .mini-widgets").clone(true);
					}
					else if (splitHeaderExists) {}
					else {
						var $widget = $(".header-bar .mini-widgets").clone(true);
					};
					//Generate floating content on load
					$headerMenu.appendTo($menuBox);
					$widget.appendTo($widgetBox);

					/*Phantom logo*/
					if (dtLocal.themeSettings.floatingHeader.logo.html && dtLocal.themeSettings.floatingHeader.logo.showLogo) {
						$phantom.find(".ph-wrap").addClass("with-logo");

						if(logoURL == undefined){
							$phantom.find(".logo-box").html('<a href="'+dtLocal.themeSettings.floatingHeader.logo.url+'">' + dtLocal.themeSettings.floatingHeader.logo.html +' </a>');
						}
						else {
							$phantom.find(".logo-box").html('<a href="'+logoURL+'">' + dtLocal.themeSettings.floatingHeader.logo.html +' </a>');
						};
					};

					
				};
				
				if ($page.hasClass("boxed")) {
					$phantom.addClass("boxed").velocity({ translateX : "-50%" }, 0).find(".ph-wrap").addClass("boxed");
				}

				/* Hide floating on load */
				$phantom.removeClass('show-phantom').addClass('hide-phantom');


				var phantomAnimate = false;

				var phantomTimeoutShow,
					phantomTimeoutHide;	
				var tempScrTop = dtGlobals.winScrollTop,
					sliderH = $mainSlider.height(),
					headerH = $mastheadHeader.height();

				if (floatingNavigationBelowSliderExists && bodyTransparent) {
					var showFloatingAfter = tempScrTop <= sliderH;

				}
				else if (floatingNavigationBelowSliderExists) {
					var showFloatingAfter = tempScrTop <= (sliderH + headerH);
				}
				else {
					var showFloatingAfter = tempScrTop<= dtLocal.themeSettings.floatingHeader.showAfter;
				};
				$window.on("scroll", function() {

					// Stop execution when on mobile devices
					if (window.innerWidth <= dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
						return false;
					}
					
					var tempScrTop = dtGlobals.winScrollTop,
						sliderH = $mainSlider.height(),
						headerH = $mastheadHeader.height();

					if (floatingNavigationBelowSliderExists && bodyTransparent) {
						var showFloatingAfter = tempScrTop > sliderH && isMoved === false,
							hideFloatingAfter = tempScrTop <= sliderH && isMoved === true;

					}
					else if (floatingNavigationBelowSliderExists) {
						var showFloatingAfter = tempScrTop > (sliderH + headerH) && isMoved === false,
							hideFloatingAfter = tempScrTop <= (sliderH + headerH) && isMoved === true;
					}
					else {
						var showFloatingAfter = tempScrTop > dtLocal.themeSettings.floatingHeader.showAfter && isMoved === false,
							hideFloatingAfter = tempScrTop <= dtLocal.themeSettings.floatingHeader.showAfter && isMoved === true;
					};

					if (showFloatingAfter) {
						if(!$html.hasClass("menu-open")){	

							if( !dtGlobals.isHovering && !phantomAnimate ) {
								phantomAnimate = true;
								$phantom.removeClass("hide-phantom").addClass("show-phantom");

								isMoved = true;
							};
						}
					}
					else if (hideFloatingAfter) {

						if(phantomAnimate) {
							if(!$html.hasClass("menu-open")){	
								phantomAnimate = false;
								$phantom.removeClass("show-phantom").addClass("hide-phantom");
				
								isMoved = false;
							}
						}

					};
					
				});
			};
		};
	};

// });