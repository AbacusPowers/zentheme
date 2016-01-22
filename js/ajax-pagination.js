/**
 * Created by justin on 11/14/15.
 */
(function($){
    function find_page_number(element) {
        var href = element.attr('href');
        var hrefParts = href.split("/").reverse();
        return parseInt(hrefParts[1]);
    }

    $(document).on('click', '.pagination a.page-numbers', function(e) {
        e.preventDefault();
        var page = find_page_number($(this));
        $('#posts-loading').show();
        $.ajax({
            url: ajaxification.ajaxurl,
            type: 'post',
            data: {
                action: 'ajax_pagination',
                query_vars: ajaxification.query_vars,
                page: page,
                security: ajaxification.ajax_nonce
            },
            success: function( html ) {
                //$('#main').find( 'article' ).remove();
                $('#main nav').remove();
                $('#main').append( html );
                $('#posts-loading').hide();
                //$('html, body').animate({scrollTop : 0},800);
                //console.log(page, ajaxification.query_vars);
            }
        });

    });
})(jQuery);