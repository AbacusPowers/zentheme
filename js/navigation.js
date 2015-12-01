(function($) {

    function animate_header(){

        function do_it(size) {

            header.stop().animate({
                height: size + 'px'
            }, 600);

            var bonus = 20;
            if($('html').hasClass('breakpoint-small')) {
                bonus = 40;
            }

            $('#content').stop().animate({
                marginTop: (size + bonus) + 'px'
            }, 600);
        }

        function correct_header_data(){
            if($(document).scrollTop() > 0) {
                if( !header.data('size') || header.data('size') == 'big') {
                    header.data('size', 'small');

                    do_it(small);
                }
            } else {
                if( !header.data('size') || header.data('size') == 'small' ) {
                    header.data('size', 'big');

                    do_it(big);
                }
            }
        }

        var big, small, otherHeader;
        if($('html').hasClass('breakpoint-small')){
            header = $('.site-branding');
            big = 140;
            small = 40;
            otherHeader = $('#masthead');

            if(otherHeader.data('size')) {
                otherHeader.css('height','').data('size',null);
            }

            //correct_header_data();
        } else {
            header = $('#masthead');
            big = 160;
            small = 60;
            otherHeader = $('.site-branding');

            if(otherHeader.data('size')) {
                otherHeader.css('height','').data('size',null);
            }

            //correct_header_data();
        }
        correct_header_data();

    }

    $(document).ready(function(){

        animate_header();

    });


    $(window).scroll(function(){

        animate_header();

    });

    $('.menu-toggle').click(function(){
        $('.breakpoint-small .main-navigation').slideToggle();
        $(this).toggleClass('toggle-on');
        //$('.main-navigation div.menu').toggle("slide", { direction: "left" }, 1000);
    });

    $('.to-top').click(function(){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

    metaQuery.onBreakpointChange( function() {

        animate_header(function(){
            var toggle = $('.menu-toggle');
            if(toggle.hasClass('toggle-on')) {
                toggle.click();
            }
        });
    });

})( jQuery );

///**
// * navigation.js
// *
// * Handles toggling the navigation menu for small screens and enables tab
// * support for dropdown menus.
// */
//( function() {
//	var container, button, menu, links, subMenus;
//
//	container = document.getElementById( 'site-navigation' );
//	if ( ! container ) {
//		return;
//	}
//
//	button = container.getElementsByTagName( 'button' )[0];
//	if ( 'undefined' === typeof button ) {
//		return;
//	}
//
//	menu = container.getElementsByTagName( 'ul' )[0];
//
//	// Hide menu toggle button if menu is empty and return early.
//	if ( 'undefined' === typeof menu ) {
//		button.style.display = 'none';
//		return;
//	}
//
//	menu.setAttribute( 'aria-expanded', 'false' );
//	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
//		menu.className += ' nav-menu';
//	}
//
//	button.onclick = function() {
//		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
//			container.className = container.className.replace( ' toggled', '' );
//			button.setAttribute( 'aria-expanded', 'false' );
//			menu.setAttribute( 'aria-expanded', 'false' );
//		} else {
//			container.className += ' toggled';
//			button.setAttribute( 'aria-expanded', 'true' );
//			menu.setAttribute( 'aria-expanded', 'true' );
//		}
//	};
//
//	// Get all the link elements within the menu.
//	links    = menu.getElementsByTagName( 'a' );
//	subMenus = menu.getElementsByTagName( 'ul' );
//
//	// Set menu items with submenus to aria-haspopup="true".
//	for ( var i = 0, len = subMenus.length; i < len; i++ ) {
//		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
//	}
//
//	// Each time a menu link is focused or blurred, toggle focus.
//	for ( i = 0, len = links.length; i < len; i++ ) {
//		links[i].addEventListener( 'focus', toggleFocus, true );
//		links[i].addEventListener( 'blur', toggleFocus, true );
//	}
//
//	/**
//	 * Sets or removes .focus class on an element.
//	 */
//	function toggleFocus() {
//		var self = this;
//
//		// Move up through the ancestors of the current link until we hit .nav-menu.
//		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
//
//			// On li elements toggle the class .focus.
//			if ( 'li' === self.tagName.toLowerCase() ) {
//				if ( -1 !== self.className.indexOf( 'focus' ) ) {
//					self.className = self.className.replace( ' focus', '' );
//				} else {
//					self.className += ' focus';
//				}
//			}
//
//			self = self.parentElement;
//		}
//	}
//} )();
