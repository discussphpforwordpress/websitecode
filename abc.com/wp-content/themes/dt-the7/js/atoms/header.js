
/* #Header
================================================== */

	var $topBar = $(".top-bar"),
		$mastheadHeader = $(".masthead"),
		$overlayHeader = $(".overlay-navigation"),
		$stickyHeader = $(".sticky-header"),
		stickyTopLine = $(".sticky-top-line"),
		$mainSlider = $("#main-slideshow, .photo-scroller"),
		$leftHeader = $(".header-side-left").length > 0,
		$rightHeader = $(".header-side-right").length > 0,
		$main = $("#main, #main-slideshow, .photo-scroller, .page-title, .fancy-header, .footer"),
		$topHeader = $(".floating-logo.side-header-menu-icon .branding, .side-header-h-stroke, #phantom"),
		$sideHeader = $(".side-header"),
		$onePage = $(".page-template-template-microsite").length > 0,
		dtScrollTimeout;
		if($(".side-header-v-stroke").length > 0){			
			var $sideHeaderW = $sideHeader.width() - $(".side-header-v-stroke").width(),
				$delay = 200;
		}else{
			var $sideHeaderW = $sideHeader.width(),
				$delay = 0;
		}

	$.closeSideHeader = function(){
		$page.removeClass("show-header");
		$page.addClass("closed-header");
		$body.removeClass("show-sticky-header");
		//$(".mobile-sticky-header-overlay, .dt-mobile-menu-icon, .menu-toggle").removeClass("active");
		$(".sticky-header-overlay").removeClass("active");
		
	}
	$.closeMobileHeader = function(){
		$page.removeClass("show-mobile-header");
		$page.addClass("closed-mobile-header");
		$body.removeClass("show-sticky-mobile-header show-overlay-mobile-header").addClass("closed-overlay-mobile-header");
		$(".mobile-sticky-header-overlay, .dt-mobile-menu-icon, .menu-toggle").removeClass("active");
		
	}


	/*!-Show Hide side header*/
	if($stickyHeader.length > 0 || $overlayHeader.length > 0 ) {
		$('<div class="lines-button x"><span class="lines"></span></div>').appendTo(".menu-toggle");
		if($stickyHeader.length > 0) {
			$body.append('<div class="sticky-header-overlay"></div>');
			if(!$(".header-under-side-line").length > 0 && $(".mixed-header").length > 0){
				var mixedMenuToggle = $(".mixed-header").find(".menu-toggle").position().top;
				$(".mixed-header").find(".menu-toggle").clone(true).prependTo(".side-header")
				// .css({
				// 	top: mixedMenuToggle
				// });
			}
		};
		/*hiding side header*/
		

		if( $overlayHeader.length > 0 ) {
			$($sideHeader).append('<div class="hide-overlay"></div>');
			$('<div class="lines-button x"><span class="lines"></span></div>').appendTo(".hide-overlay");
			
		}

		var $hamburger = $(".menu-toggle .lines-button"),
			$menuToggle = $(".menu-toggle:not(.active)"),
			$overlay = $(".sticky-header-overlay");

		$hamburger.on("click", function (){
			if(!$(".header-under-side-line").length > 0){
				var $this = $(".side-header .menu-toggle");
			}else{
				var $this = $(".menu-toggle");
			}
			if ($this.hasClass("active")){
				$this.removeClass("active");
				$page.removeClass("show-header").addClass("closed-header");
				$this.parents("body").removeClass("show-sticky-header");
				$overlay.removeClass("active");
				$(".hide-overlay").removeClass("active");
				
	
			}else{
				$menuToggle.removeClass("active");
				$this.addClass('active').css({left:"",right:""});
				$page.addClass("show-header").removeClass("closed-header");
				$this.parents("body").addClass("show-sticky-header");
				
				$overlay.addClass("active");
				$(".hide-overlay").addClass("active");
				
			};
		});
		$overlay.on("click", function (){
			if($(this).hasClass("active")){
				$menuToggle.removeClass("active");
				$page.removeClass("show-header").addClass("closed-header");
				$body.removeClass("show-sticky-header");
				$overlay.removeClass("active");
			}
		});
		$(".hide-overlay").on("click", function (){
			if($(this).hasClass("active")){
				$menuToggle.removeClass("active");
				$page.removeClass("show-header");
				$page.addClass("closed-header");
				$body.removeClass("show-sticky-header");
				$overlay.removeClass("active");
				
			}
		});
	};

	/* !- Right-side header + boxed layout */
	function ofX() {

		var $windowW = $window.width(),
			$boxedHeaderPos = ($windowW - $page.innerWidth())/2,
			$sideHeaderToggleExist = $(".side-header-menu-icon").length > 0;

		if(($windowW - $page.innerWidth())/2 > 0){
			var $boxedHeaderPos = ($windowW - $page.innerWidth())/2;
		}else {
			var $boxedHeaderPos = "";
		}

		if ($body.hasClass("header-side-right") && $page.hasClass("boxed")) {
			if(!$stickyHeader.length > 0){
				$sideHeader.css({
					right: $boxedHeaderPos
				});
			};
		}
		if($(".floating-menu-icon-right").length > 0 && $page.hasClass("boxed")){
			$menuToggle.css({
				right: $boxedHeaderPos
			});
			$(".branding").css({
				left: $boxedHeaderPos
			});
		}
	
		if ($page.hasClass("boxed")) {
			
			if($sideHeaderToggleExist && !$(".floating-menu-icon-right").length > 0){
				
				$(".floating-logo .branding").css({
					right: $boxedHeaderPos
				});
				$menuToggle.css({
					left: $boxedHeaderPos
				});
			}
		};
		if($overlayHeader.length > 0 && $sideHeaderToggleExist  && $page.hasClass("boxed")){
			$menuToggle.css({
				right: $boxedHeaderPos
			});
			$(".floating-logo .branding").css({
				left: $boxedHeaderPos
			});

		};
		if ($body.hasClass("right-side-line") && $page.hasClass("boxed")) {
			$('.side-header-v-stroke').css({
				right: $boxedHeaderPos
			});
		};
	};

	ofX();
	$window.on("resize", function() {
		ofX();
	});


	/*Default scroll for mobile*/
	if($(".mixed-header").length > 0){
		var $activeHeader = $(".mixed-header");
	}else{
		var $activeHeader = $mastheadHeader;
	}
	var position = 0,
		dtIsAnchor = false;
	window.clickMenuToggle = function( $el, e ) {
		if($(".show-mobile-header").length > 0){
			var $menu = $(".dt-mobile-header");	
		}else{
			var $menu = $sideHeader;		
		}

		$( '.menu-item > a' ).each(function(){
			if($(this).attr('href').match("#!")){
				dtIsAnchor = true;
			}
		})
		if(!$onePage && !dtIsAnchor) {
			if(!$html.hasClass("menu-open")) {
				position = dtGlobals.winScrollTop;
				$html.addClass("menu-open");

				if (!dtGlobals.isiOS) {
					$body.css("margin-top", -position);
					
				}
				else {
					$window.on("touchstart.dt", function(e) {
						$window.off("touchmove.dt");

						if ($menu[0].offsetHeight >= $menu[0].scrollHeight) {
							$window.on("touchmove.dt", function(e) {
								e.preventDefault();
							});
						}
						else if ($menu[0].scrollTop <= 0) {
							$menu[0].scrollTop += 1;
						}
						else if ($menu[0].scrollTop + $menu[0].offsetHeight >= $menu[0].scrollHeight) {
							$menu[0].scrollTop -= 1;
						};
					});
				};
			}
			else {
				$html.removeClass("menu-open");
				if (!dtGlobals.isiOS) {
					$body.css("margin-top", 0);
					$window.scrollTop(position);
				} 
				else {
					$window.off("touchstart.dt");
					$window.off("touchmove.dt");	
				}
			};
		}else{
			if(!$html.hasClass("onepage-menu-open")) {
				$html.addClass("onepage-menu-open");
				
			}
			else {
				$html.removeClass("onepage-menu-open");
			};
		}
	};
	$body.on( 'click', '.menu-toggle .lines-button, .sticky-header-overlay, .hide-overlay', function( e ) {
		clickMenuToggle( $( this ), e );
	});

	/*Side header scrollbar for desctop*/
	$(".side-header .header-bar").wrap("<div class='header-scrollbar-wrap'></div>");
	if($sideHeader.length > 0 && !dtGlobals.isMobile){
		$(".header-scrollbar-wrap").mCustomScrollbar({
			scrollInertia:150
		});

	};
	if($sideHeader.length > 0){
		if(!$(".mCSB_container").length > 0){
			$(".side-header .header-scrollbar-wrap .header-bar").wrap("<div class='mCSB_container'></div>");
		}
	}