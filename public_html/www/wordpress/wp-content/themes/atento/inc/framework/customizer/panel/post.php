<?php
/**
 * Theme Customizer Post Panel
 *
 * @package Atento
 */

if ( ! function_exists( 'atento_customizer_post_controls_init' ) ) :

    function atento_customizer_post_controls_init() {
        /*--------------------------------------------------------------
        # Post Panel
        --------------------------------------------------------------*/
        Kirki::add_panel( 'atento_post_panel', array(
            'priority'      => 122,
            'title'         => esc_html__( 'Single Post Settings', 'atento' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array('atento_post_header_section'           => array( esc_attr__( 'Page Header', 'atento' ), '' ) );
        $sections['atento_post_content_settings_section']        = array( esc_attr__( 'Content Settings', 'atento' ), '' );

        $sections['atento_post_author_section']              = array( esc_attr__( 'Author Box', 'atento' ), '' );

        $sections['atento_post_related_posts_section']       = array( esc_attr__( 'Related Posts', 'atento' ), '' );


        $sections['atento_post_widgets_section']                 = array( esc_attr__( 'Before/After Widgets', 'atento' ), '' );
        $sections['atento_post_sidebar_section']                 = array( esc_attr__( 'Sidebar', 'atento' ), '' );


        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'atento_post_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }


        /*--------------------------------------------------------------
        # Content Settings: After Footer Content
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'sortable',
                'settings'    => 'atento_post_after_footer_content_elements_order',
                'label'       => esc_html__( 'After Footer Content', 'atento' ),
                'description' => esc_html__( 'Drag & Drop items to re-arrange order of appearance.', 'atento' ),
                'section'     => 'atento_post_content_settings_section',
                'default'     => array('post-navigation','comment-section'),
                'choices'     => array(
                    'author-info-section'   => esc_attr__( 'Author Box', 'atento' ),
                    'related-posts'         => esc_attr__( 'Related Posts', 'atento' ),
                    'post-navigation'       => esc_attr__( 'Post Navigation', 'atento' ),
                    'comment-section'       => esc_attr__( 'Comment Section', 'atento' ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Post Sidebar Layout
        --------------------------------------------------------------*/
        atento_add_field(
            array(
                'type'        => 'radio-image',
                'settings'    => 'atento_post_sidebar_layout',
                'label'       => esc_html__( 'Sidebar Layout', 'atento' ),
                'description' => esc_html__( 'Default layout is inherit from global settings. Assign new default layout for all single post.','atento' ),
                'section'     => 'atento_post_sidebar_section',
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
add_action( 'init', 'atento_customizer_post_controls_init', 999 );

