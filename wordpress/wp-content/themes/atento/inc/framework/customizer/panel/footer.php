<?php
/**
 * Theme Customizer Post Panel
 *
 * @package Atento
 */

if ( ! function_exists( 'atento_customizer_footer_controls_init' ) ) :

    function atento_customizer_footer_controls_init() {
        /*--------------------------------------------------------------
        # Panel
        --------------------------------------------------------------*/
        Kirki::add_panel( 'atento_footer_panel', array(
            'priority'      => 126,
            'title'         => esc_html__( 'Footer', 'atento' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'atento_footer_widgets_section'      => array( esc_attr__( 'Widgets', 'atento' ), '' ),
            'atento_footer_bar_section'          => array( esc_attr__( 'Footer Bar', 'atento' ), '' ),
        );
        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'atento_footer_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*--------------------------------------------------------------
        # Footer Widgets: Enable
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_footer_widget_area_activate',
                'label'         => esc_html__( 'Enable', 'atento' ),
                'description'   => esc_html__( 'Enable it to display Footer Widget Area on all Pages.', 'atento' ),
                'section'       => 'atento_footer_widgets_section',
                'default'       => 1,
                'partial_refresh'   => array(
                    'atento_footer_widget_area_activate'   => array(
                        'selector'                          => '.site-footer .footer-widgets',
                        'render_callback'                   => '__return_false',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Footer Widgets: Content Order
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'sortable',
                'settings'    => 'atento_footer_bar_content_order_list',
                'label'       => esc_html__( 'Content Order', 'atento' ),
                'description' => esc_html__( 'Drag & Drop items to re-arrange order of appearance.', 'atento' ),
                'section'     => 'atento_footer_bar_section',
                'default'     => array(
                    'footer-bar-text',
                ),
                'choices'     => array(
                    'footer-bar-text'       => esc_attr__( 'Copyright Text', 'atento' ),
                    'footer-bar-menu'       => esc_attr__( 'Footer Menu', 'atento' ),
                ),
                'partial_refresh'   => array(
                    'atento_footer_bar_content_order_list'   => array(
                        'selector'                          => '#colophon',
                        'render_callback'                   => '__return_false',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Footer Widgets: Footer Menu
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'select',
                'settings'    => 'atento_footer_bar_menu_id',
                'label'       => esc_html__( 'Display a menu', 'atento' ),
                'section'     => 'atento_footer_bar_section',
                'choices'     => atento_get_menus(),
                'active_callback'  => array(
                    array(
                        'setting'  => 'atento_footer_bar_content_order_list',
                        'operator' => 'in',
                        'value'    => array( 'footer-bar-menu' ),
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Footer Bar: Background
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'color',
                'label'       => esc_html__( 'Background', 'atento' ),
                'settings'    => 'atento_footer_bar_bg_color',
                'section'     => 'atento_footer_bar_section',
                'default'     => 'rgba(51,51,51,1)',
                'choices'     => array(
                    'alpha' => true,
                ),
                'transport' => 'postMessage',
                'js_vars'   => array(
                    array(
                        'element'  => '.footer-bar',
                        'property' => 'background',
                    )
                ),
                'output'   => array(
                    array(
                        'element'  => '.footer-bar',
                        'property' => 'background',
                    )
                ),
            )
        );
    }
endif;
add_action( 'init', 'atento_customizer_footer_controls_init', 999 );
