(function ($) {
    "use strict";

    function addParameter(url, parameterName, parameterValue, atStart) {
        var replaceDuplicates = true;
        if (url.indexOf('#') == 0) {
            return url;
        } else if (url.indexOf('#') > 0) {
            var cl = url.indexOf('#');
            var urlhash = url.substring(url.indexOf('#'), url.length);
        } else {
            var urlhash = '';
            var cl = url.length;
        }
        var sourceUrl = url.substring(0, cl);

        var urlParts = sourceUrl.split("?");
        var newQueryString = "";

        if (urlParts.length > 1) {
            var parameters = urlParts[1].split("&");
            for (var i = 0; (i < parameters.length); i++) {
                var parameterParts = parameters[i].split("=");
                if (!(replaceDuplicates && parameterParts[0] == parameterName)) {
                    if (newQueryString == "")
                        newQueryString = "?";
                    else
                        newQueryString += "&";
                    newQueryString += parameterParts[0] + "=" + (parameterParts[1] ? parameterParts[1] : '');
                }
            }
        }
        if (newQueryString == "")
            newQueryString = "?";

        if (atStart) {
            newQueryString = '?' + parameterName + "=" + parameterValue + (newQueryString.length > 1 ? '&' + newQueryString.substring(1) : '');
        } else {
            if (newQueryString !== "" && newQueryString != '?')
                newQueryString += "&";
            newQueryString += parameterName + "=" + (parameterValue ? parameterValue : '');
        }
        return urlParts[0] + newQueryString + urlhash;
    };

    var updatePageLinks = function() {
        var $this = $(this);

        if ( this.host === location.host ) {
            $this.attr( 'href', addParameter( $this.attr( 'href' ), 'the7_settings_preview', 'true' ) );
        }
    }

    $(document).ready(function() {
        $('#page a').each(updatePageLinks);

        // Update urls for ajaxed posts
        $(window).on('dt.ajax.content.appended', function () {
            dtGlobals.ajaxContainerItems.find('a').each(updatePageLinks);
        });
    });
})(jQuery);
