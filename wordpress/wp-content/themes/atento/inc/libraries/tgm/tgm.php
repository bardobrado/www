<?php
/**
 * Plugin recommendation
 *
 * @package Atento
 */

// Load TGM library.
require ATENTO_THEME_DIR . '/inc/libraries/tgm/class-tgm-plugin-activation.php';

if ( ! function_exists( 'atento_register_recommended_plugins' ) ) :

	/**
	 * Register recommended plugins.
	 *
	 * @since 1.0.3
	 */
	function atento_register_recommended_plugins() {
        $plugins = array(
            array(
                'name'     => esc_html__( 'One Click Demo Importer', 'atento' ),
                'slug'     => 'one-click-demo-import',
                'required' => true,
            ),
            array(
                'name'     => esc_html__( 'MailChimp Sign-Up Form', 'atento' ),
                'slug'     => 'mailchimp-for-wp',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Contact Form 7', 'atento' ),
                'slug'     => 'contact-form-7',
                'required' => false,
            ),
        );

        $config = array();

        tgmpa( $plugins, $config );
	}

endif;

add_action( 'tgmpa_register', 'atento_register_recommended_plugins' );
