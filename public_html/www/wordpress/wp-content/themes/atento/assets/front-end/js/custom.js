/* File skip-link-focus-fix */
( function() {
    var isIe = /(trident|msie)/i.test( navigator.userAgent );

    if ( isIe && document.getElementById && window.addEventListener ) {
        window.addEventListener( 'hashchange', function() {
            var id = location.hash.substring( 1 ),
                element;

            if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
                return;
            }

            element = document.getElementById( id );

            if ( element ) {
                if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
                    element.tabIndex = -1;
                }

                element.focus();
            }
        }, false );
    }
} )();

(function($) {
    'use strict';

    // Stop Scrolling
    $.fn.stopScrolling = function() {
        $('html').on('wheel.modal mousewheel.modal', function () {return false;});
        return this;
    };

    // Restore Scrolling
    $.fn.restoreScrolling = function() {
        $('html').off('wheel.modal mousewheel.modal');
        return this;
    };

    // Toggle Menu
    var bodyOverlay = $('.body-overlay');
    $( '.hamburger-menu' ).on( 'click', function() {
        bodyOverlay.addClass('is-active');
        $('.main-navigation').toggleClass('is-active');
        $(this).toggleClass('cross');
        $.fn.stopScrolling();
    });

    $( '.hamburger-menu.cross, .close-navigation' ).on( 'click', function() {
        $('.hamburger-menu').removeClass('cross');
        bodyOverlay.removeClass('is-active');
        $('.main-navigation').removeClass('is-active');
        $.fn.restoreScrolling();
    });

    // Keyboard Esc
    $(document).keyup(function(e) {
        if (e.keyCode === 27) {
            $('.hamburger-menu').removeClass('cross');
            bodyOverlay.removeClass('is-active');
            $('.main-navigation').removeClass('is-active');
            $.fn.restoreScrolling();
        }
    });

    // Restore onClick closeset
    $(document).on( 'click', function (e) {
        if ( $( e.target).closest( '.hamburger-menu,.main-navigation' ).length === 0 ) {
            bodyOverlay.removeClass('is-active');
            $('.main-navigation').removeClass('is-active');
            $('.hamburger-menu').removeClass('cross');
            $.fn.restoreScrolling();
        }
    });

})(jQuery);