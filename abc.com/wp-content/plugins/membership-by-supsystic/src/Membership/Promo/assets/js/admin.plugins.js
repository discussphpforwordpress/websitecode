jQuery(document).ready(function(){
	if(typeof(ajaxurl) === 'undefined' || !ajaxurl) return;
	
	var g_mbsAnimationSpeed = 300;
	var $deactivateLnk = jQuery('#the-list tr[data-plugin="'+ mbsPluginsData.plugSlug+ '/index.php"] .row-actions .deactivate a');
	if($deactivateLnk && $deactivateLnk.size()) {
		var $deactivateForm = jQuery('#mbsDeactivateForm');
		var $deactivateWnd = jQuery('#mbsDeactivateWnd').dialog({
			modal:    true
		,	autoOpen: false
		,	width: 500
		,	height: 390
		,	buttons:  {
				'Submit & Deactivate': function() {
					$deactivateForm.submit();
				}
			}
		});
		var $wndButtonset = $deactivateWnd.parents('.ui-dialog:first')
			.find('.ui-dialog-buttonpane .ui-dialog-buttonset')
		,	$deactivateDlgBtn = $deactivateWnd.find('.mbsDeactivateSkipDataBtn')
		,	deactivateUrl = $deactivateLnk.attr('href');
		$deactivateDlgBtn.attr('href', deactivateUrl);
		$wndButtonset.append( $deactivateDlgBtn );
		$deactivateLnk.click(function(){
			$deactivateWnd.dialog('open');
			return false;
		});
		
		$deactivateForm.submit(function(){
			$deactivateForm.find('button').attr('disabled', 'disabled');
			jQuery.ajax({
				method: 'post'
			,	url: ajaxurl
			,	data: {
					action: 'supsystic-membership'
				,	route: 'promo.saveDeactivateData'
				,	'deactivate_reason': $deactivateForm.find('input[name="deactivate_reason"]:checked').val()
				,	'better_plugin': $deactivateForm.find('input[name="better_plugin"]').val()
				,	'other': $deactivateForm.find('input[name="other"]').val()
				,	'wpnonce': mbsPluginsData.nonce
				}
			}).always(function(res){
				window.location.href = deactivateUrl;
				$deactivateForm.find('button').removeAttr('disabled');
			});
			return false;
		});
		$deactivateForm.find('[name="deactivate_reason"]').change(function(){
			jQuery('.mbsDeactivateDescShell').slideUp( g_mbsAnimationSpeed );
			if(jQuery(this).prop('checked')) {
				var $descShell = jQuery(this).parents('.mbsDeactivateReasonShell:first').find('.mbsDeactivateDescShell');
				if($descShell && $descShell.size()) {
					$descShell.slideDown( g_mbsAnimationSpeed );
				}
			}
		});
	}
});