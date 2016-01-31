(function($) {

    function set_header_size(size) {
        if (size === 'small') {
            $(header).addClass('small');
        } else if (size === 'big') {
            $(header).removeClass('small');
        }
    }

    function correct_header_data(){
        if (!header) {
            header = $('#masthead');
        }
        if($(document).scrollTop() > 0) {
            if( !header.data('size') || header.data('size') == 'big') {
                header.data('size', 'small');

                set_header_size('small');
            }
        } else {
            if( !header.data('size') || header.data('size') == 'small' ) {
                header.data('size', 'big');

                set_header_size('big');
            }
        }
    }

    $(document).ready(function(){
        header = $('#masthead');
    });

    $(window).scroll(function(){
        correct_header_data();
    });

    $('.menu-toggle').click(function(){
        $('#masthead').toggleClass('toggled');
    });

    $('.to-top').click(function(){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

    metaQuery.onBreakpointChange( function() {
        correct_header_data();
    });

})( jQuery );
