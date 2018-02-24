(function($, Membership) {

	var $notificationsList = $('.mp-notifications'),
		$markAllAsReadButton = $('.mark-all-as-read'),
		$notifications = $notificationsList.find('.mp-notification'),
		$notificationsLoader = $('#notifications-loader'),
		offsetId = $notifications.last().attr('data-id'),
		request = false,
		limit = 10,
		hasMoreNotifications = $notifications.length >= limit;


	var Notification = function($notification) {
		this.$el = $notification;
		this.id = this.$el.attr('data-id');

		var $setViewedButton = this.$el.find('.set-viewed-action'),
			$removeButton = this.$el.find('.remove-action'),
			notificationId = this.id;

		$setViewedButton.on('click', function() {
			Membership.api.notifications.setViewed({notificationId:notificationId});
			$setViewedButton.hide();
			$notification.removeClass('not-viewed');
		});

		$removeButton.on('click', function() {
			$notification.fadeOut(function() {
				$notification.hide();
			});
			Membership.api.notifications.remove({notificationId:notificationId});
		});

		var $date = this.$el.find('.mp-notification-content-date');

		$date.text(Membership.helpers.moment($date.text()));
	};


	$notifications.each(function() {
		new Notification($(this));
	});

	function loadNotifications() {

		$notificationsLoader.show();
		request = true;

		return Membership.api.notifications.get({
			limit: limit,
			offsetId: offsetId
		}).then(function(response) {
			if (response.success) {
				var $notifications = $(response.html).filter('.mp-notification');

				$notifications.each(function() {
					new Notification($(this));
				});

				$notificationsList.append($notifications);
				offsetId = $notifications.last().attr('data-id');
				hasMoreNotifications = $notifications.length === limit;
			}

			request = false;
			$notificationsLoader.hide();
		});
	}

	$notificationsList.mpVisibility({
		once: false,
		observeChanges: true,
		onBottomVisible: function() {
			if (hasMoreNotifications && !request) {
				loadNotifications();
			}
		}
	});

	$markAllAsReadButton.on('click', function() {
		$notificationsList.find('.not-viewed').each(function() {
			var $notification = $(this);
			$notification.removeClass('not-viewed').find('.set-viewed-action').hide();
		});
		Membership.api.notifications.setViewedAll();
	});

    var links = $('a.mm-autohide-notofication');
    links.each(function($index, $element){
        $($element).on('click', function($event){
            $event.preventDefault();
            var link = $(this);
            var notificationId = parseInt(link.attr('data-id'));
            Membership.api.notifications.remove({
                notificationId: notificationId
            }).success(function($response){
                document.location.replace(link.attr('href'));
            });

        });
    });

})(jQuery, Membership);