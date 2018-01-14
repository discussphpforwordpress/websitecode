(function($){

	$(function() {

		$('.the7-notice .notice-dismiss').on( 'click.the7-dismiss-notice', function( event ) {
			event.preventDefault();
			$.post(ajaxurl, {
				action: 'the7-dismiss-admin-notice',
				code: $(this).parent().attr('data-code'),
				_ajax_nonce: the7Notices._ajax_nonce
			});
		});

		// It somehow related to wizard. Why is that?
		if ( typeof(localStorage) !== 'undefined' ) {
			localStorage.setItem('dt_cut_page', window.location.href);
		}
	});

}(jQuery));
