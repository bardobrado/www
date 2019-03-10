<?php
/**
 * Theme Customizer Hero Panel
 *
 * @package Atento
 */

if ( ! function_exists( 'atento_customizer_hero_controls_init' ) ) :

    function atento_customizer_hero_controls_init() {
        /*--------------------------------------------------------------
        # Panel Hero Slider
        --------------------------------------------------------------*/
        Kirki::add_panel( 'atento_hero_panel', array(
            'priority'  =>  122,
            'title'     =>  esc_html__( 'Hero Section', 'atento' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'atento_hero_visibility'                 => array( esc_attr__( 'Enable', 'atento' ), '' ),
            'atento_hero_content_section'            => array( esc_attr__( 'Content', 'atento' ), '' ),
        );
        
        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'atento_hero_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*------------------------------------------------------
        # Enable Hero Slider on Homepage Control
        -------------------------------------------------------*/
        atento_add_field(
            array(
                'type'              => 'toggle',
                'label'             => esc_html__( 'Homepage', 'atento' ),
                'description'       => esc_html__( 'Enable hero slider on homepage and static homepage.', 'atento' ),
                'settings'          => 'atento_hero_on_home_enable',
                'section'           => 'atento_hero_visibility',
                'default'           => 1,

            )
        );

        /*------------------------------------------------------
        # Hero Slides
        -------------------------------------------------------*/
        atento_add_field( array(
            'type'        => 'repeater',
            'section'     => 'atento_hero_content_section',
            'priority'    => 10,
            'row_label' => array(
                'type' => 'text',
                'value' => esc_attr__('Content', 'atento' ),
            ),
            'button_label' => esc_attr__('Add new content', 'atento' ),
            'settings'     => 'atento_repeatable_hero_slides',
            'choices'       => array(
                'limit'     => 1
            ),
            'default'      => array(
                array(
                    'hero_image'        => ATENTO_THEME_URI . '/assets/back-end/images/hero/hero-default.png',
                    'hero_title'        => esc_attr__( 'Hero Title', 'atento' ),
                    'hero_subtitle'     => '',
                    'hero_desc'         => esc_attr__( 'Hero Short Description Here.', 'atento' ),
                    'hero_button_text'  => esc_attr__( 'Read More', 'atento' ),
                    'hero_button_link'  => '#',
                    'hero_button_link_open' => '_self',
                ),
            ),
            'fields' => array(
                'hero_image' => array(
                    'type'        => 'image',
                    'label'       => esc_attr__( 'Image', 'atento' ),
                    'description' => esc_html__( 'Recommend image width is 1800px and height can be calculated upon "Hero Size - in ratio ( at Settings -> Hero Size Ratio ).', 'atento' ),
                    'default'     => '',
                ),
                'hero_title' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Title', 'atento' ),
                    'default'     => '',
                ),
                'hero_subtitle' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Subtitle', 'atento' ),
                    'default'     => '',
                ),
                'hero_desc' => array(
                    'type'        => 'textarea',
                    'label'       => esc_attr__( 'Short Description', 'atento' ),
                    'default'     => '',
                ),
                'hero_button_text' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Button Text', 'atento' ),
                    'default'     => 'Read More',
                ),
                'hero_button_link' => array(
                    'type'        => 'link',
                    'label'       => esc_attr__( 'Button URL', 'atento' ),
                    'default'     => '#',
                ),
                'hero_button_link_open' => array(
                    'type'        => 'radio',
                    'label'       => esc_attr__( 'Open Button URL', 'atento' ),
                    'default'     => '_self',
                    'choices'     => array(
                        '_self'     => esc_attr__( 'Same Window', 'atento' ),
                        '_blank'    => esc_attr__( 'New Window', 'atento' ),
                    ),
                ),
                'partial_refresh'   => array(
                    'atento_repeatable_hero_slides'  => array(
                        'selector'                  => '.hero-container',
                        'render_callback'           => '__return_false',
                    ),
                ),
            )
        ) );

        /*--------------------------------------------------------------
        # Hero Overlay Background Color
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'      =>  'color',
                'settings'  =>  'atento_hero_overlay_bg_color',
                'section'   =>  'atento_hero_content_section',
                'label'     =>  esc_html__( 'Overlay Background Color', 'atento' ),
                'default'   =>  'rgba(255,255,255,0)',
                'choices'   => array(
                    'alpha' => true,
                ),
                'transport'     =>  'postMessage',
                'js_vars'       =>  array(
                    array(
                        'element'   =>  array( '.hero-content .post-thumbnail::after' ),
                        'function'  =>  'css',
                        'property'  =>  'background'
                    )
                ),
                'output'        =>  array(
                    array(
                        'element'   =>  array( '.hero-content .post-thumbnail::after' ),
                        'function'  =>  'css',
                        'property'  =>  'background'
                    )
                )
            )
        );

    }
endif;
add_action( 'init', 'atento_customizer_hero_controls_init', 999 );
