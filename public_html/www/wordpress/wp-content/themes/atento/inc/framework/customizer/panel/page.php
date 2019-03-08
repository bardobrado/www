<?php
/**
 * Theme Customizer Page Panel
 *
 * @package Atento
 */
if ( ! function_exists( 'atento_customizer_page_controls_init' ) ) :

    function atento_customizer_page_controls_init() {
        /*--------------------------------------------------------------
        # Page Panel
        --------------------------------------------------------------*/
        Kirki::add_panel( 'atento_page_panel', array(
            'priority'      => 122,
            'title'         => esc_html__( 'Single Page Settings', 'atento' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array( 'atento_page_sidebar_section'          => array( esc_attr__( 'Sidebar', 'atento' ), '' ), );
        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'atento_page_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*--------------------------------------------------------------
        # Page Sidebar Layout
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'radio-image',
                'settings'    => 'atento_page_sidebar_layout',
                'label'       => esc_html__( 'Sidebar Layout', 'atento' ),
                'description' => esc_html__( 'Default layout is inherit from global settings. Assign new default layout for all single page.','atento' ),
                'section'     => 'atento_page_sidebar_section',
                'default'     => 'default',
                'choices'     => array(
                    'default'           => ATENTO_THEME_URI . '/assets/back-end/images/sidebar/default-sidebar.svg',
                    'left-sidebar'      => ATENTO_THEME_URI . '/assets/back-end/images/sidebar/left-sidebar.svg',
                    'full-width'        => ATENTO_THEME_URI . '/assets/back-end/images/sidebar/no-sidebar.svg',
                    'right-sidebar'     => ATENTO_THEME_URI . '/assets/back-end/images/sidebar/right-sidebar.svg',

                ),
            )
        );
    }
endif;
add_action( 'init', 'atento_customizer_page_controls_init', 999 );
