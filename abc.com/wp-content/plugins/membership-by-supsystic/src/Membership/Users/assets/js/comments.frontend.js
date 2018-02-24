(function($, Membership) {

	var Comment = function($el) {
		this.$el = $el;
		var $date = $el.find('.date');
		$date.text(Membership.helpers.moment($date.text()));
	};
	var $commentsList = $('#mp-comments .items'),
		$commentsLoader = $('#mp-comments .comments-loader'),
		$comments = $commentsList.find('.item'),
		commentsLimit = 10,
		offsetId = $comments.last().attr('data-comment-id'),
		fetchRequest = false,
		hasMoreComments = $comments.length === commentsLimit;

	$commentsList.mpVisibility({
		once: false,
		observeChanges: true,
		onBottomVisible: function() {
			if (hasMoreComments && !fetchRequest) {
				fetchComments();
			}
		}
	});

	function fetchComments() {
		$commentsLoader.show();
		fetchRequest = true;
		return Membership.api.users.getComments({
			userId: Membership.get('requestedUser.id'),
			limit: commentsLimit,
			offsetId: offsetId
		}).then(function(response) {
			if (response.success) {

				var $comments = $(response.html).filter('.mp-comment');

				offsetId = $comments.last().attr('data-comment-id');
				$commentsList.append($comments);

				$comments.each(function() {
					new Comment($(this));
				});

				if ($comments.length < 1) {
					hasMoreComments = false;
				}
			}

			$commentsLoader.hide();
			fetchRequest = false;
		});
	}

	$comments.each(function() {
		new Comment($(this));
	});

})(jQuery, Membership);