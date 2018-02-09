/*! modernizr 3.5.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-cssanimations-cssfilters-cssgrid_cssgridlegacy-csstransforms-csstransforms3d-csstransitions-forcetouch-touchevents-mq-prefixed-prefixedcss-prefixes-setclasses-testallprops-testprop !*/
!function(e,t,n){function r(e,t){return typeof e===t}function o(){var e,t,n,o,i,s,a;for(var u in S)if(S.hasOwnProperty(u)){if(e=[],t=S[u],t.name&&(e.push(t.name.toLowerCase()),t.options&&t.options.aliases&&t.options.aliases.length))for(n=0;n<t.options.aliases.length;n++)e.push(t.options.aliases[n].toLowerCase());for(o=r(t.fn,"function")?t.fn():t.fn,i=0;i<e.length;i++)s=e[i],a=s.split("."),1===a.length?Modernizr[a[0]]=o:(!Modernizr[a[0]]||Modernizr[a[0]]instanceof Boolean||(Modernizr[a[0]]=new Boolean(Modernizr[a[0]])),Modernizr[a[0]][a[1]]=o),C.push((o?"":"no-")+a.join("-"))}}function i(e){var t=b.className,n=Modernizr._config.classPrefix||"";if(w&&(t=t.baseVal),Modernizr._config.enableJSClass){var r=new RegExp("(^|\\s)"+n+"no-js(\\s|$)");t=t.replace(r,"$1"+n+"js$2")}Modernizr._config.enableClasses&&(t+=" "+n+e.join(" "+n),w?b.className.baseVal=t:b.className=t)}function s(e){return e.replace(/([a-z])-([a-z])/g,function(e,t,n){return t+n.toUpperCase()}).replace(/^-/,"")}function a(e){return e.replace(/([A-Z])/g,function(e,t){return"-"+t.toLowerCase()}).replace(/^ms-/,"-ms-")}function u(){return"function"!=typeof t.createElement?t.createElement(arguments[0]):w?t.createElementNS.call(t,"http://www.w3.org/2000/svg",arguments[0]):t.createElement.apply(t,arguments)}function f(){var e=t.body;return e||(e=u(w?"svg":"body"),e.fake=!0),e}function l(e,n,r,o){var i,s,a,l,d="modernizr",c=u("div"),p=f();if(parseInt(r,10))for(;r--;)a=u("div"),a.id=o?o[r]:d+(r+1),c.appendChild(a);return i=u("style"),i.type="text/css",i.id="s"+d,(p.fake?p:c).appendChild(i),p.appendChild(c),i.styleSheet?i.styleSheet.cssText=e:i.appendChild(t.createTextNode(e)),c.id=d,p.fake&&(p.style.background="",p.style.overflow="hidden",l=b.style.overflow,b.style.overflow="hidden",b.appendChild(p)),s=n(c,e),p.fake?(p.parentNode.removeChild(p),b.style.overflow=l,b.offsetHeight):c.parentNode.removeChild(c),!!s}function d(e,t){return!!~(""+e).indexOf(t)}function c(e,t){return function(){return e.apply(t,arguments)}}function p(e,t,n){var o;for(var i in e)if(e[i]in t)return n===!1?e[i]:(o=t[e[i]],r(o,"function")?c(o,n||t):o);return!1}function m(t,n,r){var o;if("getComputedStyle"in e){o=getComputedStyle.call(e,t,n);var i=e.console;if(null!==o)r&&(o=o.getPropertyValue(r));else if(i){var s=i.error?"error":"log";i[s].call(i,"getComputedStyle returning null, its possible modernizr test results are inaccurate")}}else o=!n&&t.currentStyle&&t.currentStyle[r];return o}function v(t,r){var o=t.length;if("CSS"in e&&"supports"in e.CSS){for(;o--;)if(e.CSS.supports(a(t[o]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var i=[];o--;)i.push("("+a(t[o])+":"+r+")");return i=i.join(" or "),l("@supports ("+i+") { #modernizr { position: absolute; } }",function(e){return"absolute"==m(e,null,"position")})}return n}function g(e,t,o,i){function a(){l&&(delete R.style,delete R.modElem)}if(i=r(i,"undefined")?!1:i,!r(o,"undefined")){var f=v(e,o);if(!r(f,"undefined"))return f}for(var l,c,p,m,g,h=["modernizr","tspan","samp"];!R.style&&h.length;)l=!0,R.modElem=u(h.shift()),R.style=R.modElem.style;for(p=e.length,c=0;p>c;c++)if(m=e[c],g=R.style[m],d(m,"-")&&(m=s(m)),R.style[m]!==n){if(i||r(o,"undefined"))return a(),"pfx"==t?m:!0;try{R.style[m]=o}catch(y){}if(R.style[m]!=g)return a(),"pfx"==t?m:!0}return a(),!1}function h(e,t,n,o,i){var s=e.charAt(0).toUpperCase()+e.slice(1),a=(e+" "+N.join(s+" ")+s).split(" ");return r(t,"string")||r(t,"undefined")?g(a,t,o,i):(a=(e+" "+j.join(s+" ")+s).split(" "),p(a,t,n))}function y(e,t,r){return h(e,n,n,t,r)}var C=[],S=[],_={_version:"3.5.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,t){var n=this;setTimeout(function(){t(n[e])},0)},addTest:function(e,t,n){S.push({name:e,fn:t,options:n})},addAsyncTest:function(e){S.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=_,Modernizr=new Modernizr;var x=_._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):["",""];_._prefixes=x;var b=t.documentElement,w="svg"===b.nodeName.toLowerCase(),T=function(){function e(e,t){var o;return e?(t&&"string"!=typeof t||(t=u(t||"div")),e="on"+e,o=e in t,!o&&r&&(t.setAttribute||(t=u("div")),t.setAttribute(e,""),o="function"==typeof t[e],t[e]!==n&&(t[e]=n),t.removeAttribute(e)),o):!1}var r=!("onblur"in t.documentElement);return e}();_.hasEvent=T;var E="CSS"in e&&"supports"in e.CSS,z="supportsCSS"in e;Modernizr.addTest("supports",E||z);var P=function(){var t=e.matchMedia||e.msMatchMedia;return t?function(e){var n=t(e);return n&&n.matches||!1}:function(t){var n=!1;return l("@media "+t+" { #modernizr { position: absolute; } }",function(t){n="absolute"==(e.getComputedStyle?e.getComputedStyle(t,null):t.currentStyle).position}),n}}();_.mq=P;var O=_.testStyles=l;Modernizr.addTest("touchevents",function(){var n;if("ontouchstart"in e||e.DocumentTouch&&t instanceof DocumentTouch)n=!0;else{var r=["@media (",x.join("touch-enabled),("),"heartz",")","{#modernizr{top:9px;position:absolute}}"].join("");O(r,function(e){n=9===e.offsetTop})}return n});var A="Moz O ms Webkit",N=_._config.usePrefixes?A.split(" "):[];_._cssomPrefixes=N;var M=function(t){var r,o=x.length,i=e.CSSRule;if("undefined"==typeof i)return n;if(!t)return!1;if(t=t.replace(/^@/,""),r=t.replace(/-/g,"_").toUpperCase()+"_RULE",r in i)return"@"+t;for(var s=0;o>s;s++){var a=x[s],u=a.toUpperCase()+"_"+r;if(u in i)return"@-"+a.toLowerCase()+"-"+t}return!1};_.atRule=M;var j=_._config.usePrefixes?A.toLowerCase().split(" "):[];_._domPrefixes=j;var k={elem:u("modernizr")};Modernizr._q.push(function(){delete k.elem});var R={style:k.elem.style};Modernizr._q.unshift(function(){delete R.style});_.testProp=function(e,t,r){return g([e],n,t,r)};_.testAllProps=h;var L=_.prefixed=function(e,t,n){return 0===e.indexOf("@")?M(e):(-1!=e.indexOf("-")&&(e=s(e)),t?h(e,t,n):h(e,"pfx"))};_.prefixedCSS=function(e){var t=L(e);return t&&a(t)};Modernizr.addTest("forcetouch",function(){return T(L("mouseforcewillbegin",e,!1),e)?MouseEvent.WEBKIT_FORCE_AT_MOUSE_DOWN&&MouseEvent.WEBKIT_FORCE_AT_FORCE_MOUSE_DOWN:!1}),_.testAllProps=y,Modernizr.addTest("cssanimations",y("animationName","a",!0)),Modernizr.addTest("cssgridlegacy",y("grid-columns","10px",!0)),Modernizr.addTest("cssgrid",y("grid-template-rows","none",!0)),Modernizr.addTest("cssfilters",function(){if(Modernizr.supports)return y("filter","blur(2px)");var e=u("a");return e.style.cssText=x.join("filter:blur(2px); "),!!e.style.length&&(t.documentMode===n||t.documentMode>9)}),Modernizr.addTest("csstransforms",function(){return-1===navigator.userAgent.indexOf("Android 2.")&&y("transform","scale(1)",!0)}),Modernizr.addTest("csstransforms3d",function(){var e=!!y("perspective","1px",!0),t=Modernizr._config.usePrefixes;if(e&&(!t||"webkitPerspective"in b.style)){var n,r="#modernizr{width:0;height:0}";Modernizr.supports?n="@supports (perspective: 1px)":(n="@media (transform-3d)",t&&(n+=",(-webkit-transform-3d)")),n+="{#modernizr{width:7px;height:18px;margin:0;padding:0;border:0}}",O(r+n,function(t){e=7===t.offsetWidth&&18===t.offsetHeight})}return e}),Modernizr.addTest("csstransitions",y("transition","all",!0)),o(),i(C),delete _.addTest,delete _.addAsyncTest;for(var U=0;U<Modernizr._q.length;U++)Modernizr._q[U]();e.Modernizr=Modernizr}(window,document);


var dtGlobals = {};

dtGlobals.isMobile	= (/(Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|windows phone)/.test(navigator.userAgent));
dtGlobals.isAndroid	= (/(Android)/.test(navigator.userAgent));
dtGlobals.isiOS		= (/(iPhone|iPod|iPad)/.test(navigator.userAgent));
dtGlobals.isiPhone	= (/(iPhone|iPod)/.test(navigator.userAgent));
dtGlobals.isiPad	= (/(iPad)/.test(navigator.userAgent));
dtGlobals.isBuggy	= (navigator.userAgent.match(/AppleWebKit/) && typeof window.ontouchstart === 'undefined' && ! navigator.userAgent.match(/Chrome/));
dtGlobals.winScrollTop = 0;
window.onscroll = function() {
	dtGlobals.winScrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
};

dtGlobals.isWindowsPhone = navigator.userAgent.match(/IEMobile/i);

dtGlobals.customColor = 'red';
if (dtGlobals.isMobile) { 
	document.documentElement.className += " mobile-true";
} else {
	document.documentElement.className += " mobile-false";
};

dtGlobals.logoURL = false;
dtGlobals.logoH = false;
dtGlobals.logoW = false;

jQuery(document).ready(function($) {

	var $document = $(document),
		$window = $(window),
		$html = $("html"),
		$body = $("body");

	// iOS sniffing.
	if (dtGlobals.isiOS) {
		$html.addClass("is-iOS");
	}
	else {
		$html.addClass("not-iOS");
	};

	// Detect webkit browser
	if ( !$.browser.webkit || dtGlobals.isMobile ){
		$body.addClass("not-webkit").removeClass("is-webkit");
	}else{
		$body.removeClass("not-webkit").addClass("is-webkit");
	};
	//Detect ms = 10 browser
	if (jQuery.browser.msie && jQuery.browser.version == 10) {
	    $body.addClass("ie-10");
	}
	  
	/*--Detect safari browser*/
	$.browser.safari = ($.browser.webkit && !(/chrome/.test(navigator.userAgent.toLowerCase())));
	if ($.browser.safari) {
		$body.addClass("is-safari");
	};

	// windows-phone sniffing
	if (dtGlobals.isWindowsPhone){
		$body.addClass("ie-mobile").addClass("windows-phone");
	};
	// if not mobile device
	if(!dtGlobals.isMobile){
		$body.addClass("no-mobile");
	};
	// iphone
	if(dtGlobals.isiPhone){
		$body.addClass("is-iphone");
	};

	dtGlobals.isPhone = false;
	dtGlobals.isTablet = false;
	dtGlobals.isDesktop = false;

	var size = window.getComputedStyle(document.body,":after").getPropertyValue("content");

	if (size.indexOf("phone") !=-1 && dtGlobals.isMobile) {
		dtGlobals.isPhone = true;
	} 
	else if (size.indexOf("tablet") !=-1 && dtGlobals.isMobile) {
		dtGlobals.isTablet = true;
	}
	else {
		dtGlobals.isDesktop = true;
	};

	/*--old ie remove csstransforms3d*/
	if ($.browser.msie) $("html").removeClass("csstransforms3d");

	var dtResizeTimeout;
	if(dtGlobals.isMobile && !dtGlobals.isWindowsPhone && !dtGlobals.isAndroid){
		$(window).bind("orientationchange", function(event) {
			/*$(window).on("resize", function() {*/
				clearTimeout(dtResizeTimeout);
				dtResizeTimeout = setTimeout(function() {
					$(window).trigger( "debouncedresize" );
				}, 200);
			/*});*/
		});
	}else{
		$(window).on("resize", function() {
			clearTimeout(dtResizeTimeout);
			dtResizeTimeout = setTimeout(function() {
				$(window).trigger( "debouncedresize" );
			}, 200);
		});
	}
});