(function($, Membership) {

	var Post = function($el) {
		this.$el = $el;
		var $date = $el.find('.date');
		$date.text(Membership.helpers.moment($date.text()));
	};

	var $postsList = $('#mp-posts .items'),
		$postsLoader = $('#mp-posts .posts-loader'),
		$posts = $postsList.find('.item'),
		postsLimit = 10,
		offsetId = $posts.last().attr('data-post-id'),
		fetchRequest = false,
		hasMorePosts = $posts.length === postsLimit;

	$postsList.mpVisibility({
		once: false,
		observeChanges: true,
		onBottomVisible: function() {
			if (hasMorePosts && !fetchRequest) {
				fetchPosts();
			}
		}
	});

	function fetchPosts() {
		$postsLoader.show();
		fetchRequest = true;
		return Membership.api.users.getPosts({
			userId: Membership.get('requestedUser.id'),
			limit: postsLimit,
			offsetId: offsetId
		}).then(function(response) {
				if (response.success) {

					var $posts = $(response.html).filter('.mp-post');

					offsetId = $posts.last().attr('data-post-id');
					$postsList.append($posts);

					$posts.each(function() {
						new Post($(this));
					});

					if ($posts.length < 1) {
						hasMorePosts = false;
					}
					// social share init
					$(document).trigger('mbsMembershipDataLoadEvent');
				}

				$postsLoader.hide();
				fetchRequest = false;
			});
	}

	$posts.each(function() {
		new Post($(this));
	});

})(jQuery, Membership);