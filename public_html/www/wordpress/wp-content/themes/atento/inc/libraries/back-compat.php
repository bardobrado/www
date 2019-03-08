<?php
/**
 * Back compat functionality
 *
 * Prevents this theme from running on PHP versions prior to 5.4.0
 */

/**
 * Prevent switching to this theme on older versions of PHP.
 *
 * Switches to the default theme.
 * @package atento
 * @since 1.0.0
 */
function atento_bc_switch_theme() {
    switch_theme( WP_DEFAULT_THEME );
    unset( $_GET['activated'] );
    add_action( 'admin_notices', 'atento_bc_upgrade_notice' );
}
add_action( 'after_switch_theme', 'atento_bc_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * @since 1.0.0
 */
function atento_bc_upgrade_notice() {
    printf( '<div class="error"><p>%s</p></div>',
        sprintf( __( 'Atento requires at least PHP version 5.4.0. You are running version %s. Please upgrade and try again.', 'atento' ), PHP_VERSION )
    );
}

/**
 * Prevents the Customizer from being loaded
 *
 * @since 1.0.0
 */
function atento_bc_customize() {
    wp_die( sprintf( __( 'Atento requires at least PHP version 5.4.0. You are running version %s. Please upgrade and try again.', 'atento' ), PHP_VERSION ), '', array(
        'back_link' => true,
    ) );
}
add_action( 'load-customize.php', 'atento_bc_customize' );

/**
 * Prevents the Theme Preview from being loaded
 *
 * @since 1.0.0
 */
function atento_bc_preview() {
    if ( isset( $_GET['preview'] ) ) {
        wp_die( sprintf( __( 'Atento requires at least PHP version 5.4.0. You are running version %s. Please upgrade and try again.', 'atento' ), PHP_VERSION ) );
    }
}
add_action( 'template_redirect', 'atento_bc_preview' );
