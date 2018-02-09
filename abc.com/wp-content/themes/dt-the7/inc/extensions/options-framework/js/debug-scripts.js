jQuery(document).ready(function($) {

	$('.show-debug-info.button').on('click', function() {
		$('#optionsframework-wrap').toggleClass('of-debug-show');
	}).detach().insertBefore('.nav-tab-wrapper').show();

});