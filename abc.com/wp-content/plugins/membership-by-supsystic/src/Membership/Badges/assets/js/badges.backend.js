(function($, Membership) {
	$(function() {
		var gridTbl = Membership.initJqTbl({
			tblId: 'mbsBadgesTbl'
		,	cols: [
				{name: 'id', label: Membership.trans('ID'), width: '50'}
			,	{name: 'name_link', label: Membership.trans('Name')}
			,	{name: 'caption', label: Membership.trans('Caption')}
			,	{name: 'img_thumbnail', label: Membership.trans('Img')}
			]
		,	label: Membership.trans('Badges')
		,	labelPlural: Membership.trans('Badges')
		,	url: 'badges.getTblList'
		,	removeUrl: 'badges.removeById'
		});
		var levelEditForm = Membership.initEditForm({
			saveUrl: 'badges.save'
		,	form: '#mbsMembershipBadgesFrm'
		,	formFields: ''
		,	wndId: 'badges-edit'
		,	getItemUrl: 'badges.getById'
		,	createBtn: '.mbsCreateBadgesBtn'
		,	backFromFormBtn: '.mbsBackBadgesBtn'
		,	saveFormBtn: '.mbsSaveBadgesBtn'
		});
		gridTbl.set('connectForm', levelEditForm);
		levelEditForm.set('connectTbl', gridTbl);
		
		$('#mbsMembershipBadgesFrm [name="recurring"]').change(function(){
			$(this).attr('checked')
			? $('.mbsBadgesRequringItem').slideDown( Membership.animationTime )
			: $('.mbsBadgesRequringItem').slideUp( Membership.animationTime );
		});
		$('#mbsMembershipBadgesFrm [name="img_src"]').change(function(){
			if($(this).val() != ''){
				$('.img_src').attr('src', $(this).val() );
				$('.img_src').css('display', 'inline');
			}
		});
	});
}(jQuery, Membership));
