(function($, Membership) {
	$(function() {
		var gridTbl2 = Membership.initJqTbl({
			tblId: 'mbsBadgesAndPointsTbl'
			,	cols: [
				{name: 'id', label: Membership.trans('ID'), width: '50'}
				,	{name: 'user_id', label: Membership.trans('User Login')}
				,	{name: 'points_count', label: Membership.trans('Points Count')}
				,	{name: 'badges_id', label: Membership.trans('Badges Name')}
			]
			,	label: Membership.trans('Badges and Points')
			,	labelPlural: Membership.trans('Badges and Points')
			,	url: 'badgesAndPoints.getTblList'
			,	removeUrl: 'badgesAndPoints.removeById'
		});
		var levelEditForm2 = Membership.initEditForm({
			saveUrl: 'badgesAndPoints.save'
			,	form: '#mbsMembershipBadgesAndPointsFrm'
			,	formFields: ''
			,	wndId: 'badges-and-points-edit'
			,	getItemUrl: 'badgesAndPoints.getById'
			,	createBtn: '.mbsCreateBadgesAndPointsBtn'
			,	backFromFormBtn: '.mbsBackBadgesAndPointsBtn'
			,	saveFormBtn: '.mbsSaveBadgesAndPointsBtn'
		});
		gridTbl2.set('connectForm', levelEditForm2);
		levelEditForm2.set('connectTbl', gridTbl2);
		
		$('#mbsMembershipBadgesAndPointsFrm [name="recurring"]').change(function(){
			$(this).attr('checked')
				? $('.mbsBadgesAndPointsRequringItem').slideDown( Membership.animationTime )
				: $('.mbsBadgesAndPointsRequringItem').slideUp( Membership.animationTime );
		});
		//check active user in select
		$('#mbsMembershipBadgesAndPointsFrm [name="user_id"]').change(function(){
			// console.log('1');
			var userId = $(this).val();
			$('#mbsMembershipBadgesAndPointsFrm [name="all_users"]').val(userId);
		});
		//after select set active user id to hidden input
		$('#mbsMembershipBadgesAndPointsFrm [name="all_users"]').change(function(){
			// console.log('2');
			var userId = $(this).val();
			$('#mbsMembershipBadgesAndPointsFrm [name="user_id"]').val(userId);
		});
		//check active badge in select
		$('#mbsMembershipBadgesAndPointsFrm [name="badges_id"]').change(function(){
			var userId = $(this).val();
			$('#mbsMembershipBadgesAndPointsFrm [name="all_badges"]').val(userId);
		});
		//after select set active badge id to hidden input
		$('#mbsMembershipBadgesAndPointsFrm [name="all_badges"]').change(function(){
			var userId = $(this).val();
			$('#mbsMembershipBadgesAndPointsFrm [name="badges_id"]').val(userId);
		});
	});
}(jQuery, Membership));
