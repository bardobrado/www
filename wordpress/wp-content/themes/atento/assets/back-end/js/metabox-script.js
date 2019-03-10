/*!
 Project   : Atento WordPress Theme
 Purpose   : Meta Box Area Js
 Author    : precisethemes
 Theme URI : https://precisethemes.com/
 */
/**
 * File metabox-script.js.
 *
 * Theme Post/Page Meta Box enhancements for a better user experience.
 *
 * @package Atento
 */

( function( $ ) {

    "use strict";

    // Meta-box Tabs Settings
    $('ul.metabox-tab-nav li').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('ul.metabox-tab-nav li').removeClass('active');
        $('.setting-tab').removeClass('active');

        $(this).addClass('active');
        $("#" + tab_id).addClass('active');
    });

    // Add Active class with anchor actions click.
    $('.setting-tab .actions').click(function () {
        var status_id = $(this).attr('href').split('#');
        $('ul.metabox-tab-nav li').removeClass('active');
        $('.setting-tab').removeClass('active');
        $('ul.metabox-tab-nav li[data-tab="'+status_id[1]+'"]').addClass('active');
        $("#" + status_id[1]).addClass('active');
    });

    // Reset post meta settings
    $( 'div#post_meta_fields div.metabox-reset-settings a.metabox-reset-btn' ).click( function() {
        var $reset = $(this).data('reset');
        var $cancel = $(this).data('cancel');
        var $confirm = $( 'div.metabox-reset-settings div.metabox-reset-checkbox' ),
            $text   = $confirm.is(':visible') ? $reset : $cancel;
        $( this ).text( $text );
        $( 'div.metabox-reset-settings div.metabox-reset-checkbox input' ).attr('checked', false);
        $confirm.toggle();
    });
    
} ) ( jQuery );  