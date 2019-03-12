<?php
/**
 * Theme Customizer Global Panel
 *
 * @package Atento
 */

if ( ! function_exists( 'atento_customizer_global_controls_init' ) ) :

    function atento_customizer_global_controls_init() {
        /*--------------------------------------------------------------
        # Panel
        --------------------------------------------------------------*/
        Kirki::add_section( 'atento_global_sidebar_section', array(
            'priority'  =>  50,
            'title'     =>  esc_html__( 'Sidebar', 'atento' ),
        ));
        /*--------------------------------------------------------------
        # Global Sidebar Layout
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'radio-image',
                'settings'    => 'atento_global_sidebar_layout',
                'label'       => esc_html__( 'Layout', 'atento' ),
                'description' => esc_html__( 'This sidebar will be reflected in whole site blog, archives, categories, tags, authors and search result page.', 'atento' ),
                'section'     => 'atento_global_sidebar_section',
                'default'     => 'right-sidebar',
                'choices'     => array(
                    'full-width'        => ATENTO_THEME_URI . '/assets/back-end/images/sidebar/no-sidebar.svg',
                    'left-sidebar'      => ATENTO_THEME_URI . '/assets/back-end/images/sidebar/left-sidebar.svg',
                    'right-sidebar'     => ATENTO_THEME_URI . '/assets/back-end/images/sidebar/right-sidebar.svg',

                ),
            )
        );

    }
endif;
add_action( 'init', 'atento_customizer_global_controls_init', 999 );
