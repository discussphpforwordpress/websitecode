(function($, Membership) {

    $(function() {
        $('.sc-tabs .tab').on('click', function() {
            $('.sc-header .sc-header-item').removeClass('active');
            $('.sc-header .sc-header-item[data-item="' + $(this).attr('data-target') + '"]').addClass('active');
        });
    });

}(jQuery, Membership));