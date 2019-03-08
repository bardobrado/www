<?php
/**
 * Envy Blog Customizer General Panel
 *
 * @package Atento
 */

if ( ! function_exists( 'atento_customizer_typography_controls_init' ) ) :

    function atento_customizer_typography_controls_init() {
        /*--------------------------------------------------------------
        # Typography Panel
        --------------------------------------------------------------*/
        Kirki::add_panel( 'atento_typography_panel', array(
            'priority'      => 101,
            'title'         => esc_html__( 'Typography', 'atento' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'atento_typography_body_section'             => array( esc_attr__( 'Body', 'atento' ), '' ),
            'atento_typography_logo_section'             => array( esc_attr__( 'Logo', 'atento' ), '' ),
            'atento_typography_main_menu_section'        => array( esc_attr__( 'Main Menu', 'atento' ), '' ),
            'atento_typography_heading_h1_section'       => array( esc_attr__( 'H1', 'atento' ), '' ),
            'atento_typography_heading_h2_section'       => array( esc_attr__( 'H2', 'atento' ), '' ),
            'atento_typography_heading_h3_section'       => array( esc_attr__( 'H3', 'atento' ), '' ),
            'atento_typography_heading_h4_section'       => array( esc_attr__( 'H4', 'atento' ), '' ),
            'atento_typography_heading_h5_section'       => array( esc_attr__( 'H5', 'atento' ), '' ),
            'atento_typography_heading_h6_section'       => array( esc_attr__( 'H6', 'atento' ), '' ),
            'atento_typography_post_meta_section'        => array( esc_attr__( 'Post Meta', 'atento' ), '' ),
            'atento_typography_widgets_title_section'    => array( esc_attr__( 'Widget Title', 'atento' ), '' ),
        );
        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'atento_typography_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*--------------------------------------------------------------
        # Body Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_body',
                'label'       => esc_attr__( 'Body', 'atento' ),
                'section'     => 'atento_typography_body_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => 'regular',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => 'body',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Site Title Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_site_title',
                'label'       => esc_attr__( 'Site Title', 'atento' ),
                'section'     => 'atento_typography_logo_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => 'regular',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => '.site-branding .site-title',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Tagline Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_site_tagline',
                'label'       => esc_attr__( 'Site Tagline', 'atento' ),
                'section'     => 'atento_typography_logo_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => 'regular',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => '.site-branding p',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Main Menu Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_main_menu',
                'label'       => esc_attr__( 'Main Menu', 'atento' ),
                'section'     => 'atento_typography_main_menu_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => 'regular',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => '.main-navigation ul li',
                    ),
                ),
            )
        );


        /*--------------------------------------------------------------
        # H1 Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_heading_h1',
                'label'       => esc_attr__( 'H1', 'atento' ),
                'section'     => 'atento_typography_heading_h1_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => 'regular',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => 'h1',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # H2 Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_heading_h2',
                'label'       => esc_attr__( 'H2', 'atento' ),
                'section'     => 'atento_typography_heading_h2_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => '500',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => 'h2',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # H3 Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_heading_h3',
                'label'       => esc_attr__( 'H3', 'atento' ),
                'section'     => 'atento_typography_heading_h3_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => 'regular',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => 'h3',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # H4 Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_heading_h4',
                'label'       => esc_attr__( 'H4', 'atento' ),
                'section'     => 'atento_typography_heading_h4_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => 'regular',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => 'h4',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # H5 Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_heading_h5',
                'label'       => esc_attr__( 'H5', 'atento' ),
                'section'     => 'atento_typography_heading_h5_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => 'regular',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => 'h5',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # H6 Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_heading_h6',
                'label'       => esc_attr__( 'H6', 'atento' ),
                'section'     => 'atento_typography_heading_h6_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => 'regular',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => 'h6',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Post Meta Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_post_meta',
                'label'       => esc_attr__( 'Post Meta', 'atento' ),
                'section'     => 'atento_typography_post_meta_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => 'regular',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => '.entry-meta label',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Widget Title Typography & Control
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'typography',
                'settings'    => 'atento_typography_widgets_title',
                'label'       => esc_attr__( 'Widget Title', 'atento' ),
                'section'     => 'atento_typography_widgets_title_section',
                'default'     => array(
                    'font-family'    => 'Roboto',
                    'variant'        => 'regular',
                    'subsets'        => array( 'latin-ext' ),
                ),
                'output'      => array(
                    array(
                        'element' => '.widget-title',
                    ),
                ),
            )
        );
    }
endif;
add_action( 'init', 'atento_customizer_typography_controls_init', 999 );
