/**
 * Created by justin on 11/13/15.
 */
(function($) {
    $(document).on('click','.destroy-card',function(){
        $(this).closest('.card').slideToggle({ duration: 1000, easing: 'easeOutQuint' });
    })
})( jQuery );

//(function($) {
//    var cardprops = {};
//
//    // $ Works! You can test it with next line if you like
//    // console.log($);
//    var cards = $('.card');
//    //cards.click(function(){
//    //    var that = $(this);
//    //    cards.not(that).each(function(){
//    //        $(this).addClass('unfocused');
//    //    });
//    //    $(this).toggleClass('takeover');
//    //});
//
//    cards.click(function(){
//        if ( $(this).hasClass('expanded') ) {
//            $('.card-container',this).animate(cardprops,function(){
//                $(this).css({position: '', top: '', bottom: '', left: '', right: '', width: '', zIndex: '', margin: ''});
//                $(this).parent().css('height','');
//                $('body').css('overflow','');
//            });
//
//        } else {
//            var offset = $(this).offset();
//            var top = offset.top;
//            var left = offset.left;
//            var right = offset.right;
//            var width = $(this).width();
//            var height = $(this).height();
//            if( $('body').hasClass('admin-bar')) {
//                if ($(window).width() <= 600 ) {
//                    bump = 0;
//                } else if ($(window).width() <= 782 && $(window).width() >=600) {
//                    bump = 46;
//                } else {
//                    bump = 32;
//                }
//                if(header.data('size') == 'big') {
//                    var headheight = big + bump;
//                } else if(header.data('size') == 'small') {
//                    var headheight = small + bump;
//                }
//            } else {
//                if(header.data('size') == 'big') {
//                    var headheight = big;
//                } else if(header.data('size') == 'small') {
//                    var headheight = small;
//                }
//            }
//
//
//
//            cardprops = {position: "fixed", top: top, left: left, right: right, width: width, zIndex: 100, margin: 0};
//            $('.card-container',this).css(cardprops);
//            $(this).css('height',height);
//            $('.card-container',this).animate({top: headheight, left: 0, right: 0, bottom: 0, width: "100%", margin: 0, float: "none"});
//            $('body').css('overflow','hidden');
//        }
//        $(this).toggleClass('expanded');
//    });
//
//})( jQuery );