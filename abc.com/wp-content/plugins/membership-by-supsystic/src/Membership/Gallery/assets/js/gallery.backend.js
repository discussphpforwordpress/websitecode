(function($, Membership) {

	function GalleryForMembership() {
		this.init();
	}

	GalleryForMembership.prototype.init = (function() {

		$(".mpp-button").on('click', function() {
			var $self = $(this)
				,	toogleObjectId = $self.data('toogle');

			if(toogleObjectId) {
				var $toogleObject = $('#' + toogleObjectId);
				if($toogleObject.length) {
					$toogleObject.toggle();
				}
			}
		});

		$('.mbs-setting-select-all').on('change', function() {
			var $self = $(this)
				//
			,	additionalData = $self.data('type');
			if($self.prop('checked')) {
				$('.mbs-can-setting-checked' + '.mbs-type-' + additionalData).prop('checked', true);
			} else {
				$('.mbs-can-setting-checked' + '.mbs-type-' + additionalData).prop('checked', false);
			}
		});
	});

	$PhotoGalleryForMembership = new GalleryForMembership();

})(jQuery, window.Membership);