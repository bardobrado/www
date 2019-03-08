<?php
/**
 * Theme Customizer Blog Panel
 *
 * @package Atento
 */

if ( ! function_exists( 'atento_customizer_blog_controls_init' ) ) :

    function atento_customizer_blog_controls_init() {
        /*--------------------------------------------------------------
        # Panel
        --------------------------------------------------------------*/
        Kirki::add_panel( 'atento_archive_panel', array(
            'priority'      => 122,
            'title'         => esc_html__( 'Archive/Blog Settings', 'atento' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array('atento_pagination_section'           => array( esc_attr__( 'Pagination Settings', 'atento' ), '' ) );
        $sections['atento_archive_page_thumbnail_section']      = array( esc_attr__( 'Thumbnail Placeholder', 'atento' ), '' );
        $sections['atento_archive_sidebar_section']             = array( esc_attr__( 'Sidebar', 'atento' ), '' );

        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'atento_archive_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*--------------------------------------------------------------
        # Archive: Related Posts - Content
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'sortable',
                'settings'    => 'atento_archive_related_posts_elements_order',
                'section'     => 'atento_archive_related_posts_section',
                'label'       => esc_html__( 'Content', 'atento' ),
                'description' => esc_html__( 'Click on eye icon to enable/disable item, drag & drop items to re-arrange order of appearance.', 'atento' ),
                'default'     => array(
                    'post-title',
                    'posted-date',
                ),
                'choices'     => array(
                    'post-title'            => esc_attr__( 'Title', 'atento' ),
                    'post-cats'             => esc_attr__( 'Categories', 'atento' ),
                    'post-author'           => esc_attr__( 'Author', 'atento' ),
                    'posted-date'           => esc_attr__( 'Date', 'atento' ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Pagination: Alignment
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'select',
                'settings'    => 'atento_pagination_alignment',
                'label'       => esc_html__( 'Pagination Alignment', 'atento' ),
                'section'     => 'atento_pagination_section',
                'default'     => 'justify-content-center',
                'choices'     => atento_flex_justify(),
                'transport'   => 'postMessage',
                'js_vars'     => array(
                    array(
                        'element'       => '.navigation.pagination .nav-links',
                        'function'      => 'html',
                        'attr'          => 'class',
                        'value_pattern' => 'nav-links d-flex flex-wrap $ w-100',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Thumbnail Placeholder
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'toggle',
                'label'       => esc_html__( 'Show Placeholder', 'atento' ),
                'description' => esc_html__( 'Show grey background colored box in absence of post thumbnail.', 'atento' ),
                'settings'    => 'atento_archive_page_thumbnail_placeholder',
                'section'     => 'atento_archive_page_thumbnail_section',
                'default'     => 1,
            )
        );
        
        /*--------------------------------------------------------------
        # Archive/Blog Sidebar Layout
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'radio-image',
                'settings'    => 'atento_archive_sidebar_layout',
                'label'       => esc_html__( 'Sidebar Layout', 'atento' ),
                'description' => esc_html__( 'Default layout is inherit from global settings. Assign new default layout for all archive pages.','atento' ),
                'section'     => 'atento_archive_sidebar_section',
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
add_action( 'init', 'atento_customizer_blog_controls_init', 999 );
