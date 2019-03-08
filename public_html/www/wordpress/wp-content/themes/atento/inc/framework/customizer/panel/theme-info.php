<?php
/**
 * Atento Customizer Themes Info Section
 *
 * @package Atento
 */

if ( ! function_exists( 'atento_customizer_theme_info_controls_init' ) ) :

    function atento_customizer_theme_info_controls_init() {
        /*--------------------------------------------------------------
        # Themes Info Section
        --------------------------------------------------------------*/
        Kirki::add_section( 'atento_theme_info_section', array(
            'title'          => esc_html__( 'Themes Info', 'atento' ),
            'priority'       => 200,
            'capability'     => 'edit_theme_options',
        ) );

        /*--------------------------------------------------------------
        # Themes Info Section
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'custom',
                'settings'    => 'atento_theme_info_theme_link',
                'section'     => 'atento_theme_info_section',
                'default'     => sprintf('<a target="_blank" href="%1$s">%2$s</a>',
                    esc_url( 'https://precisethemes.com/atento/'),
                    esc_html__( 'Theme Info', 'atento' ) )
            )
        );

        atento_add_field(
            array(
                'type'        => 'custom',
                'settings'    => 'atento_theme_info_support_link',
                'section'     => 'atento_theme_info_section',
                'default'     => sprintf('<a target="_blank" href="%1$s">%2$s</a>',
                    esc_url( 'https://precisethemes.com/support-forum/forum/atento/'),
                    esc_html__( 'Support', 'atento' ) )
            )
        );

        atento_add_field(
            array(
                'type'        => 'custom',
                'settings'    => 'atento_theme_info_docs_link',
                'section'     => 'atento_theme_info_section',
                'default'     => sprintf('<a target="_blank" href="%1$s">%2$s</a>',
                    esc_url( 'https://precisethemes.com/docs/atento/'),
                    esc_html__( 'Documentation', 'atento' ) )
            )
        );

        atento_add_field(
            array(
                'type'        => 'custom',
                'settings'    => 'atento_theme_info_demo_link',
                'section'     => 'atento_theme_info_section',
                'default'     => sprintf('<a target="_blank" href="%1$s">%2$s</a>',
                    esc_url( 'https://precisethemes.com/demo/atento/'),
                    esc_html__( 'View Demos', 'atento' ) )
            )
        );
    }
endif;
add_action( 'init', 'atento_customizer_theme_info_controls_init', 999 );