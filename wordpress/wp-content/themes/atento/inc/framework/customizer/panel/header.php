<?php
/**
 * Theme Customizer Header Panel
 *
 * @package Atento
 */

if ( ! function_exists( 'atento_customizer_header_controls_init' ) ) :

    function atento_customizer_header_controls_init() {
        /*--------------------------------------------------------------
        # Panel Header
        --------------------------------------------------------------*/
        Kirki::add_panel( 'atento_header_panel', array(
            'priority'      => 2,
            'title'         => esc_html__( 'Header', 'atento' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'title_tagline'                              => array( esc_attr__( 'Site Title & Tagline', 'atento' ), '' ),
            'header_image'                               => array( esc_attr__( 'Header Image', 'atento' ), '' ),

        );

        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'atento_header_panel',
            );

            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }

            Kirki::add_section( $section_id, $section_args );
        }

        /*--------------------------------------------------------------
        # Logo Height
        --------------------------------------------------------------*/
        // Desktop
        atento_add_field(
            array(
                'priority'      => 8,
                'type'          => 'slider',
                'settings'      => 'atento_site_branding_logo_height',
                'label'         => esc_html__( 'Logo Height', 'atento' ),
                'section'       => 'title_tagline',
                'default'       => 72,
                'choices'       => array(
                    'min'       => '0',
                    'max'       => '200',
                    'suffix'    => 'px',
                ),
                'transport' => 'postMessage',
                'js_vars'   => array(
                    array(
                        'element'       => array( '.site-branding .custom-logo' ),
                        'property'      => 'height',
                        'units'         => 'px',
                    ),
                ),
                'output'   =>  array(
                    array(
                        'element'       => array( '.site-branding .custom-logo' ),
                        'property'      => 'height',
                        'units'         => 'px',
                    ),
                ),
            )
        );


        /*--------------------------------------------------------------
        # Site Title Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_header_site_title_visible',
                'section'       => 'title_tagline',
                'label'         => esc_html__( 'Display Site Title', 'atento' ),
                'default'       => 1,
            )
        );

        /*--------------------------------------------------------------
        # Tagline Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'              => 'toggle',
                'settings'          => 'atento_header_site_tagline_visible',
                'section'           => 'title_tagline',
                'label'             => esc_html__( 'Display Tagline', 'atento' ),
                'default'           => 1,
            )
        );

        /*--------------------------------------------------------------
        # Header Image: Custom Note
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'              => 'custom',
                'settings'          => 'atento_header_image_custom_note',
                'section'           => 'header_image',
                'label'             => esc_html__( 'Note:', 'atento' ),
                'default'           => '<p class="description">' . esc_html__( 'Header Image will not display on Homepage or Static Homepage if Hero Section is enable.', 'atento' ) . '</p>',
            )
        );


    }
endif;
add_action( 'init', 'atento_customizer_header_controls_init', 999 );
