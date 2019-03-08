<?php
/**
 * Theme Customizer Sections Panel
 *
 * @package Atento
 */

if ( ! function_exists( 'atento_customizer_sections_controls_init' ) ) :

    function atento_customizer_sections_controls_init() {
        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'atento_extra_settings'      => array( esc_attr__( 'Enable Extra Settings', 'atento' ), '' ),
        );

        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'priority'    => 1,
                'title'       => $section[0],
                'description' => $section[1],
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*--------------------------------------------------------------
         # Note
         --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'custom',
                'settings'      => 'atento_sections_note',
                'section'       => 'atento_extra_settings',
                'description'   => esc_html__( 'Enable more setting options section in the customizer to have more customization features. Enabling more sections may cause customizer loading speed.', 'atento' ),
            )
        );

        atento_add_field(
            array(
                'type'          => 'custom',
                'settings'      => 'atento_sections_note_2',
                'section'       => 'atento_extra_settings',
                'description'   => esc_html__( 'After making changes to "Enable Extra Settings" it needs to "Publish" and "Reload Customizer" to load files and take effects on Customizer.', 'atento' ),
            )
        );

        atento_add_field(
            array(
                'type'        => 'custom',
                'settings'    => 'atento_reload_customizer_section',
                'section'     => 'atento_extra_settings',
                'default'     => '<a id="customize-reload-actions" class="reload-customizer-btn">' . esc_html__( 'Reload Customizer', 'atento' ) . '</a>',
            )
        );

        /*--------------------------------------------------------------
        # Coming Soon
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_coming_soon_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( 'Coming Soon', 'atento' ),
            )
        );

        /*--------------------------------------------------------------
        # Header Menu Settings
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_header_menu_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( 'Header Menu Settings', 'atento' ),
                'description'   => esc_html__( 'Customizer -> Menus', 'atento' ),
            )
        );

        /*--------------------------------------------------------------
        # Hero Content
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_hero_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( 'Hero Content', 'atento' ),
                'default'       => '1',
            )
        );

        /*--------------------------------------------------------------
        # Featured Posts Slider
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_featured_posts_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( 'Featured Posts Slider', 'atento' ),
                'default'       => '1',
            )
        );

        /*--------------------------------------------------------------
        # 404 Error Page
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_404_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( '404 Error Page', 'atento' ),
            )
        );

        /*--------------------------------------------------------------
        # Button Setting
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_button_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( 'Button Setting', 'atento' ),
                'description'   => esc_html__( 'Customizer -> General Settings', 'atento' ),
                'default'       => '1',
            )
        );

        /*--------------------------------------------------------------
        # Posts Listing
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_posts_listing_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( 'Posts Listing', 'atento' ),
                'description'   => esc_html__( 'Customizer -> Global Settings', 'atento' ),
                'default'       => '1',
            )
        );

        /*--------------------------------------------------------------
        # Author Box
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_author_box_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( 'Author Box', 'atento' ),
                'description'   => esc_html__( 'Customizer -> Single Post Settings', 'atento' ),
            )
        );

        /*--------------------------------------------------------------
        # Post Navigation
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_post_navigation_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( 'Post Navigation', 'atento' ),
                'description'   => esc_html__( 'Customizer -> Single Post Settings', 'atento' ),
                'default'       => '1',
            )
        );

        /*--------------------------------------------------------------
        # Related Posts
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_related_posts_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( 'Related Posts', 'atento' ),
                'description'   => esc_html__( 'Customizer -> Single Post Settings', 'atento' ),
                'default'       => '1',
            )
        );

        /*--------------------------------------------------------------
        # Single Post: Typography
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_post_typography_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( 'Single Post: Typography', 'atento' ),
                'description'   => esc_html__( 'Customizer -> Single Post Settings', 'atento' ),
            )
        );

        /*--------------------------------------------------------------
        # Single Page: Typography
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'          => 'toggle',
                'settings'      => 'atento_page_typography_section_enable',
                'section'       => 'atento_extra_settings',
                'label'         => esc_html__( 'Single Page: Typography', 'atento' ),
                'description'   => esc_html__( 'Customizer -> Single Page Settings', 'atento' ),
            )
        );

    }
endif;
add_action( 'init', 'atento_customizer_sections_controls_init', 999 );
