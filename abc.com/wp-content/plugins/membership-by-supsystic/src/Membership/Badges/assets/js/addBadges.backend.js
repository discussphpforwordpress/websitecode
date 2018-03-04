(function($, Membership) {

    $(function() {
        $('.sc-tabs .tab').on('click', function() {
            if( $(this).attr('data-target') === 'user_list'){
	            Membership.ajax({
		            'route': 'badges.getAll',
	            }, {'method': 'post'})
		            .then(function(response) {
			            if (response.success) {
				            var html = '<option value=""></option>';
				
				            response.badges.forEach(function (item) {
					            html = html + '<option value="'+item.id+'">'+item.name+'</option>';
				            });
				
				            $('#mbsMembershipBadgesAndPointsFrm [name="all_badges"]').html(html);
			            }
		            });
            }
        });
    });
	
	$('.mp-save-budge').on('click', function (e) {
		e.preventDefault();
		
		var formData = $("#mpCreateBadget").serialize();
		
		Membership.ajax({
			'route': 'badges.badgeCreateNew',
			'fields': formData,
		}, {'method': 'post'});
	});
 
}(jQuery, Membership));