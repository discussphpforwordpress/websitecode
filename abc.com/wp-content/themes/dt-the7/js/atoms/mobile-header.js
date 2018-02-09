
/* #Mobile header
================================================== */
if(!$body.hasClass("responsive-off")){
	
		var $mixedHeader = $(".mixed-header"),

			//Mobile header widgets
			 $firstSwitchWidgetsNearLogo = $(".masthead .near-logo-first-switch").clone(true).addClass("show-on-first-switch"),
			 $secondSwitchWidgetsNearLogo = $(".masthead .near-logo-second-switch").clone(true).addClass("show-on-second-switch"),

			 //Mobile navigation widgets
			$mobileWidgetsInMenu = $mastheadHeader.find(".in-menu-first-switch").clone(true).addClass("hide-on-desktop hide-on-second-switch show-on-first-switch"),
			$mobileWidgetsInMenuSeocndSwitch = $mastheadHeader.find(".in-menu-second-switch").clone(true).addClass("hide-on-desktop hide-on-first-switch show-on-second-switch"),

			//Mobile top bar widgets
			$mobileWidgetsInTopBar = $mastheadHeader.find(".in-top-bar").clone(true).addClass("hide-on-desktop hide-on-first-switch show-on-second-switch"),
			$mobileWidgetsInTopBarLeft = $mastheadHeader.find(".in-top-bar-left").clone(true).addClass("hide-on-desktop show-on-first-switch"),
			$mobileWidgetsInTopBarRight = $mastheadHeader.find(".in-top-bar-right").clone(true).addClass("hide-on-desktop  show-on-first-switch");

		if($mixedHeader.length > 0){
			var $mobileLogo = $mixedHeader.find(".branding > a, .branding > img").clone(true),
				$activeHeader = $mixedHeader
		}else{
			var $mobileLogo = $(".masthead:not(.mixed-header)").find(".branding > a, .branding > img").clone(true),
				$activeHeader = $mastheadHeader;
		}
		if($topBar.length > 0 && $topBar.css('display') != 'none'){
			var topBarH = $topBar.innerHeight();
		}else{
			var topBarH = 0;
		}

		/*Append mobile header-bar to masthead*/
		$("<div class='mobile-header-bar'><div class='mobile-navigation'></div><div class='mobile-mini-widgets'></div><div class='mobile-branding'></div></div>").appendTo(".masthead");
		/*Mobile menu toggle icon*/
		$(".mobile-header-bar .mobile-navigation").append("<a href='#' class='dt-mobile-menu-icon'><span class='lines'></span></a>");

		/*Append mini widgets to mobile header-bar*/

		$($firstSwitchWidgetsNearLogo).appendTo(".mobile-header-bar .mobile-mini-widgets");
		$($secondSwitchWidgetsNearLogo).appendTo(".mobile-header-bar .mobile-mini-widgets");

		/*Append mini widgets to mobile top-bar*/
		$(".left-widgets", $topBar).append($mobileWidgetsInTopBar);
		$(".left-widgets", $topBar).append($mobileWidgetsInTopBarLeft);
		$(".right-widgets", $topBar).append($mobileWidgetsInTopBarRight).removeClass("select-type-menu list-type-menu select-type-menu-second-switch list-type-menu-second-switch");
		$(".right-widgets", $topBar).append($mobileWidgetsInTopBarRight).removeClass("select-type-menu list-type-menu select-type-menu-second-switch list-type-menu-second-switch")

		/*Mobile navigation widgets*/
		$($mobileWidgetsInMenu).appendTo(".mobile-mini-widgets-in-menu");
		$($mobileWidgetsInMenuSeocndSwitch).appendTo(".mobile-mini-widgets-in-menu");
		 $mobileWidgetsInMenu.removeClass("select-type-menu list-type-menu select-type-menu-second-switch list-type-menu-second-switch");
		 $mobileWidgetsInMenuSeocndSwitch.removeClass("select-type-menu list-type-menu select-type-menu-first-switch list-type-menu-first-switch");

		/*Append logo to mobile header-bar*/
		$(".mobile-header-bar .mobile-branding").append($mobileLogo);

		var $mobileMenu = $(".dt-mobile-header");
		if($mobileMenu.siblings().hasClass("dt-parent-menu-clickable")){
			$mobileMenu.addClass("dt-parent-menu-clickable");
		}

		$firstSwitchWidgetsNearLogo.removeClass("select-type-menu list-type-menu select-type-menu-second-switch list-type-menu-second-switch");
		 $secondSwitchWidgetsNearLogo.removeClass("select-type-menu list-type-menu select-type-menu-first-switch list-type-menu-first-switch");

		 $mobileWidgetsInTopBar.removeClass('show-on-desktop select-type-menu list-type-menu select-type-menu-first-switch list-type-menu-first-switch in-top-bar-left').addClass('hide-on-desktop hide-on-first-switch');
		 $mobileWidgetsInTopBarLeft.removeClass('show-on-desktop select-type-menu list-type-menu select-type-menu-second-switch list-type-menu-second-switch in-top-bar').addClass('hide-on-desktop hide-on-second-switch');
		 $mobileWidgetsInTopBarRight.removeClass('show-on-desktop select-type-menu list-type-menu  select-type-menu-second-switch list-type-menu-second-switch').addClass('hide-on-desktop');
		$(".header-bar .mini-widgets > .mini-nav ").removeClass('select-type-menu-second-switch list-type-menu-second-switch select-type-menu-first-switch list-type-menu-first-switch');

		$(".mini-nav.show-on-desktop:not(.show-on-first-switch):not(.show-on-second-switch)", $topBar).removeClass('select-type-menu-second-switch list-type-menu-second-switch select-type-menu-first-switch list-type-menu-first-switch');
		$(".masthead .hide-on-desktop").addClass("display-none");
		
		/*Remove mega menu settings from mobile*/
		$(".mobile-main-nav ").find("li").each(function(){
			var $this = $(this),
				$this_sub = $this.find(" > .dt-mega-menu-wrap > .sub-nav");
			if($this.hasClass("new-column")){
				var $thisPrev = $this.prev().find(" > .sub-nav");
				$(" > .sub-nav > *", $this).appendTo($thisPrev)
			}
			$this_sub.unwrap();		
		}).removeClass('dt-mega-menu dt-mega-parent hide-mega-title').find(" > .sub-nav").removeClass("hover-style-click-bg hover-style-bg");


		/*!-Show Hide mobile header*/
		if($mobileMenu.length > 0 ) {
			dtGlobals.mobileMenuPoint = 50;
			var $menu = $(".dt-mobile-header"),
				$Mobilehamburger = $(".dt-mobile-menu-icon"),
				isbtnMoved = false,
				$activeHeaderTop = $activeHeader.offset().top;
			//$menu.wrap("<div class='mobile-header-scrollbar-wrap'></div>"); - working with new header

			/*Mobile floating menu toggle*/
			if(!$(".floating-btn").length > 0 && $(".floating-mobile-menu-icon").length > 0){
				var $hamburgerFloat = $Mobilehamburger.first().clone(true);
				//$hamburgerFloat.insertBefore($Mobilehamburger).addClass("floating-btn");
				$hamburgerFloat.appendTo(".masthead:not(#phantom)").addClass("floating-btn");
			}
			var $floatMobBtn = $(".floating-btn");
			
			var mobilePhantomAnimate = false;


			$window.scroll(function () {
				dtGlobals.mobileMenuPoint = $activeHeaderTop + $activeHeader.height() + 50;

				if(dtGlobals.winScrollTop > dtGlobals.mobileMenuPoint && isbtnMoved === false){
					//console.log("show float")
					$floatMobBtn.parents(".masthead").addClass("show-floating-icon");
					isbtnMoved = true;
				}
				else if(dtGlobals.winScrollTop <= dtGlobals.mobileMenuPoint && isbtnMoved === true) {
					$floatMobBtn.parents(".masthead").removeClass("show-floating-icon");
					isbtnMoved = false;
				}
				if(dtGlobals.winScrollTop > $(".masthead:not(.side-header)").height()){
					$menu.addClass("stick-to-top");
				}else{
					$menu.removeClass("stick-to-top");
				}
			});
			var $Mobilehamburger = $(".dt-mobile-menu-icon");

			/*Append overlay for mobile menu*/
			if(!$(".mobile-sticky-header-overlay").length > 0){
				$body.append('<div class="mobile-sticky-header-overlay"></div>');
			}
					
			 var $mobileOverlay = $(".mobile-sticky-header-overlay");

			/*Click on mobile menu toggle*/
			$Mobilehamburger.on("click", function (e){
				e.preventDefault();
				
				var $this = $(this);

				if ($this.hasClass("active")){
					$this.removeClass("active");
					$page.removeClass("show-mobile-header").addClass("closed-mobile-header");
					$body.removeClass("show-mobile-overlay-header").addClass("closed-overlay-mobile-header");
					$this.parents("body").removeClass("show-sticky-mobile-header");
					$mobileOverlay.removeClass("active");
				}else{
					$Mobilehamburger.removeClass("active");
					$this.addClass('active');
					$page.addClass("show-mobile-header").removeClass("closed-mobile-header");
					$body.removeClass("closed-overlay-mobile-header").addClass("show-overlay-mobile-header");
					$mobileOverlay.removeClass("active");
					$this.parents("body").addClass("show-sticky-mobile-header");
					
					$mobileOverlay.addClass("active");
				};

			
			});
			$mobileOverlay.on("click", function (){
				if($(this).hasClass("active")){
					$Mobilehamburger.removeClass("active");
					$page.removeClass("show-mobile-header").addClass("closed-mobile-header");
					$body.removeClass("show-sticky-mobile-header").addClass("closed-overlay-mobile-header").addClass("closed-overlay-mobile-header");
					$mobileOverlay.removeClass("active");
					
				}
			});
			$(".dt-close-mobile-menu-icon span").on("click", function (){
				
				$page.removeClass("show-mobile-header");
				$page.addClass("closed-mobile-header");
				$body.removeClass("show-sticky-mobile-header");
				$body.removeClass("show-overlay-mobile-header").addClass("closed-overlay-mobile-header");
				$mobileOverlay.removeClass("active");
				$Mobilehamburger.removeClass("active");
								
			});
			
			////!--Return with old header
			$(".dt-mobile-header").wrapInner("<div class='mobile-header-scrollbar-wrap'></div>");
			if(!dtGlobals.isMobile){
				$(".mobile-header-scrollbar-wrap").mCustomScrollbar({
					scrollInertia:150
				});
			}

		};
		
/*
		$.mobileHeader = function() {
			if($topBar.length > 0 && $topBar.css('display') != 'none'){
				var topBarH = $topBar.innerHeight()
			}else{
				var topBarH = 0;
			}

			if($(".sticky-mobile-header ").length > 0){
				if($(".mixed-header").length > 0){
					var headerH = $(".mixed-header").height();
				}else{
					var headerH = $mastheadHeader.height();
				}
				var stickyMobileHeader = $('.masthead').first();
				if(!$(".mobile-header-space").length > 0 && !$(".floating-navigation-below-slider").length > 0){
					$("<div class='mobile-header-space'></div>").insertBefore(stickyMobileHeader);
				}
				$(".mobile-header-space").css({
					height: headerH
				});
			}
		}
		$.mobileHeader();
*/
		
	}
