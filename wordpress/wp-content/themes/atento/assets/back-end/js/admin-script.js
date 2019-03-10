/*!
 Project   : Atento WordPress Theme
 Purpose   : Admin Area Js
 Author    : precisethemes
 Theme URI : https://precisethemes.com/
 */
/**
 * File admin-script.js.
 *
 * Theme Admin( Dashboard ) enhancements for a better user experience.
 *
 * @package Atento
 */

( function( $ ) {

    "use strict";

    // Welcome Page Menu Tab
    $('ul.about-theme-tab-nav li').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('ul.about-theme-tab-nav li').removeClass('active');
        $('.about-theme-tab').removeClass('active');

        $(this).addClass('active');
        $("#" + tab_id).addClass('active');
    });

    // Add Active class with anchor actions click.
    $('.about-theme-tab .actions').click(function () {
        var status_id = $(this).attr('href').split('#');
        $('ul.about-theme-tab-nav li').removeClass('active');
        $('.about-theme-tab').removeClass('active');
        $('ul.about-theme-tab-nav li[data-tab="'+status_id[1]+'"]').addClass('active');
        $("#" + status_id[1]).addClass('active');
    });

} ) ( jQuery );