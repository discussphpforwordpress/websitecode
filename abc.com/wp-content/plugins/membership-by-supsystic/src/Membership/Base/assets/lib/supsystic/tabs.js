(function($) {
	$(function() {

		function setActiveTab() {
			$('.sc-tabs').each(function(index, el) {
				var $links = $(this).find('[data-target]')
					,	$activeLink = $($links.filter('[data-target="' + location.hash.replace('#', '') + '"]')[0] || $links[0]);

				$links.on('click', function(event, isInit){
					event.preventDefault();
					var $this = $(this)
						,	target = $this.data('target')
						,	connectedJqTbl = $this.data('connect-tbl')
						,	isActive = $this.hasClass('active');

					$links.removeClass('active');
					$this.addClass('active');

					$('[data-tab]').removeClass('active');
					$('[data-tab='+ target+ ']').addClass('active');

					window.location.hash = '#'+ target;

					if(connectedJqTbl && !isInit) {
						var tbl = Membership.getJqTbl( connectedJqTbl );
						if(tbl) {
							tbl.updateWidth();
							if(isActive && tbl.get('connectForm') && tbl.get('connectForm').isVisible()) {
								tbl.get('connectForm').hideForm();
							}
						}
					}
				});

				$activeLink.trigger('click', true);
			});
		}

		$('.mp-tabs').each(function() {
			var $activeLink,
				$tabContent,
				$links = $(this).find('a');

			$activeLink = $($links.filter('[href="' + location.hash.replace('/', '') + '"]')[0] || $links[0]);

			if (! $activeLink.length) {
				return;
			}

			$tabContent = $($activeLink[0].hash);

			$links.not($activeLink).each(function () {
				$(this.hash).hide();
			});

			$(this).on('click', 'a', function(event) {

				event.preventDefault();

				if (!this.hash || this.hash === '#') {
					return false;
				}


				window.location.hash = '#/' + this.hash.replace('#', '');

				$activeLink.removeClass('active');
				$tabContent.hide();

				$activeLink = $(this);
				$activeLink.trigger('before.show.tab');
				$tabContent = $(this.hash);

				$activeLink.addClass('active');
				$tabContent.fadeIn();
				$activeLink.trigger('after.show.tab');

			});


			$activeLink.trigger('click');
		});

		setActiveTab();

		$(window).on('hashchange', function() {
			setActiveTab();
		});

	});

})(jQuery);
