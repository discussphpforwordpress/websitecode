(function($, Membership) {

	var $pluginRow = $('[data-slug="membership-by-supsystic"]'),
		$lastAction = $pluginRow.find('.row-actions span:last'),
		$uninstallLink = $('<a>', {
			href: Membership.uninstallUrl
		})
			.text(Membership.translate['Uninstall'])
			.css({color: '#a00'});

	$lastAction.append(' | ').after($uninstallLink);
	$uninstallLink.wrap('<span></span>');

})(jQuery, window.MembershipUninstall);