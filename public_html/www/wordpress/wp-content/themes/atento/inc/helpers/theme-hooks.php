<?php
/**
 * Functions hooked to custom hook
 *
 * @package Atento
 */

/*----------------------------------------------------------------------
# Header
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_add_header' ) ) :

    /**
     * Header Layout
     *
     * @since 0.1.0
     */
    function atento_add_header() {

        $nav_class          = array( 'nav-bar transition-35s bg-white nav-bar-setting' ); ?>

        <div class="<?php echo esc_attr( implode( ' ', $nav_class ) ); ?>">
            <div class="w-100">
                <?php get_template_part( 'template-parts/header/header-layout', 4 ); ?>
            </div><!-- .outer-container -->
        </div><!-- .nav-bar -->

    <?php }

endif;

add_action( 'atento_action_header', 'atento_add_header', 20 );

/*----------------------------------------------------------------------
# After Header Hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_add_after_header_hero' ) ) :

    /**
     * Add Hero Section
     *
     * @since 0.1.0
     */
    function atento_add_after_header_hero() {

        if ( atento_hero_enable() === true  && ( is_home() || is_front_page() ) ) {

            get_template_part('template-parts/hero/content', 'hero'); // Hero Content
        }

    }

endif;

/*----------------------------------------------------------------------
# After Header Custom Header Image Hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_add_after_header_custom_header' ) ) :

    /**
     * Add Custom Header Image
     *
     * @since 0.1.0
     */

    function atento_add_after_header_custom_header() {

        if ( ( is_home() || is_front_page() ) && atento_hero_enable() !== true && get_header_image() ) : ?>

            <div class="custom-header">
                <img src="<?php echo esc_url( get_header_image() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name ') ); ?>">
            </div><!-- .custom-header -->

        <?php elseif ( ( !is_front_page() || !is_home() ) && get_header_image() ) : ?>

            <div class="custom-header">
                <img src="<?php echo esc_url( get_header_image() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name ') ); ?>">
            </div><!-- .custom-header -->

        <?php endif;

    }

endif;
add_action( 'atento_action_after_header', 'atento_add_after_header_hero', 10 );
add_action( 'atento_action_after_header', 'atento_add_after_header_custom_header', 20 );

/*----------------------------------------------------------------------
# Before Widgets/ Page header hook / Breadcrumbs hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_action_page_header' ) ) :

    /**
     * Add Page Header
     *
     * @since 0.1.0
     */
    function atento_action_page_header() {

        if ( is_archive() ) {
            // Bail if Author Posts Page
            if ( is_author() ) {
                // Get global post
                global $post;
                // Define author bio data
                $data = array(
                    'post_author'       => $post->post_author,
                    'avatar_size'       => apply_filters( 'atento_author_avatar_size', 75 ),
                    'author_name'       => get_the_author(),
                    'posts_url'         => get_author_posts_url( $post->post_author ),
                    'description'       => get_the_author_meta( 'description', $post->post_author ),
                    'website'           => get_the_author_meta( 'url', $post->post_author ),
                );

                // Get author avatar
                $data['avatar'] = get_avatar( $post->post_author, $data['avatar_size'] );

                // Apply filters so we can tweak the author bio output
                $data = apply_filters( 'atento_post_author_bio_data', $data );

                // Extract variables
                extract( $data ); ?>

                <div class="page-header author-<?php echo esc_attr( $post_author );?>-header <?php echo esc_attr( atento_page_header_color_scheme() ); ?> mt-80">
                    <div class="outer-container">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="page-header-items col-12 d-flex flex-wrap align-items-center text-<?php echo esc_attr( atento_page_header_text_alignment() ); ?>">
                                    <h1 class="page-title w-100 d-flex flex-wrap align-items-center">
                                        <?php

                                        if ( $avatar ) : // Display author avatar
                                            echo wp_kses_post( $avatar );
                                        endif;

                                        echo esc_html( $author_name );

                                        ?>
                                    </h1><!-- .author-name -->

                                    <div class="archive-description w-100">
                                        <?php
                                        // Outputs the author description if exists
                                        if ( $description ) :
                                            echo wp_kses_post( wpautop( $description ) );
                                        endif;

                                        // Outputs the author website if exists
                                        if ( $website ) : ?>
                                            <p class="author-website"><a href="<?php echo esc_url( $website ); ?>" title="<?php esc_attr_e( 'Author Website', 'atento' ); ?>" target="_blank"><?php echo esc_url( $website ); ?></a></p>
                                        <?php
                                        endif;
                                        ?>

                                    </div><!-- author-bio-description -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .container-fluid -->
                    </div><!-- .outer-container -->
                </div><!-- .page-header -->

            <?php } else { ?>

                <div class="page-header archive-header <?php echo esc_attr( atento_page_header_color_scheme() ); ?> mt-80">
                    <div class="outer-container">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="page-header-items col-12 d-flex flex-wrap align-items-center text-<?php echo esc_attr( atento_page_header_text_alignment() ); ?>">

                                    <?php

                                    atento_archive_get_title( '<h1 class="page-title w-100">', '</h1>' );
                                    the_archive_description( '<div class="archive-description w-100">', '</div>' );

                                    ?>

                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .container-fluid -->
                    </div><!-- .outer-container -->
                </div><!-- .page-header -->

            <?php }
        }
        elseif ( is_search() ) { ?>

            <div class="page-header search-results-header <?php echo esc_attr( atento_page_header_color_scheme() ); ?> mt-80">
                <div class="outer-container">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="page-header-items col-12 d-flex flex-wrap align-items-center text-<?php echo esc_attr( atento_page_header_text_alignment() ); ?>">
                                <h1 class="page-title w-100">
                                    <?php
                                    /* translators: %s: search query. */
                                    printf( '%1$s <span>%2$s</span>',
                                        esc_html__( 'Search Results for:', 'atento' ),
                                        get_search_query()
                                        );
                                    ?>
                                </h1>
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container-fluid -->
                </div><!-- .outer-container -->
            </div><!-- .page-header -->

        <?php }

        elseif ( is_404() ) {  ?>

            <div class="page-header error-404-header <?php echo esc_attr( atento_page_header_color_scheme() ); ?> mt-80">
                <div class="outer-container">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="page-header-items col-12 d-flex flex-wrap align-items-center text-<?php echo esc_attr( atento_page_header_text_alignment() ); ?>">

                                <h1 class="page-title"><?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'atento' ) ; ?></h1>

                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container-fluid -->
                </div><!-- .outer-container -->
            </div><!-- .page-header -->

            <?php

        }
    }

endif;

add_action( 'atento_action_before_main_content', 'atento_action_page_header', 10 );

/*----------------------------------------------------------------------
# Post navigation hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_add_navigation' ) ) :

    /**
     * Add Post Navigation
     *
     * @since 0.1.0
     */
    function atento_add_navigation() {

        get_template_part( 'template-parts/post/post', 'navigation' ); // post navigation

    }

endif;

add_action( 'atento_action_navigation', 'atento_add_navigation', 10 );


/*----------------------------------------------------------------------
# Related posts hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_add_related_posts' ) ) :

    /**
     * Add related posts.
     *
     * @since 0.1.0
     */
    function atento_add_related_posts() {

        get_template_part( 'template-parts/post/related', 'posts' ); // related post

    }

endif;

add_action( 'atento_action_related', 'atento_add_related_posts', 10 );

/*----------------------------------------------------------------------
# Sidebar hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_add_sidebar' ) ) :

    /**
     * Add Sidebar
     *
     * @since 0.1.0
     */
    function atento_add_sidebar() {

        get_sidebar(); // sidebar area

    }

endif;

add_action( 'atento_action_sidebar', 'atento_add_sidebar', 10 );

/*----------------------------------------------------------------------
# Footer widget hook / Footer bar hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_add_footer_widgets' ) ) :

    /**
     * Add footer widgets
     *
     * @since 0.1.0
     */
    function atento_add_footer_widgets() {

        get_template_part( 'template-parts/footer/footer', 'widget' ); // Footer Widget Area

    }

endif;

if ( ! function_exists( 'atento_add_footer_bottom_widgets' ) ) :

    /**
     * Add footer bottom widgets
     *
     * @since 0.1.0
     */
    function atento_add_footer_bottom_widgets() {

        if ( is_active_sidebar( 'bottom_full_width_widgets' ) ) {

            ?>
            <div class="mt-40 mt-lg-80">
                <?php dynamic_sidebar( 'bottom_full_width_widgets' ); ?>
            </div><!-- mt-80 -->
            <?php
        }


    }

endif;

if ( ! function_exists( 'atento_add_footer_bar' ) ) :

    /**
     * Add footer bar
     *
     * @since 0.1.0
     */
    function atento_add_footer_bar() {

        get_template_part( 'template-parts/footer/footer', 'bar' ); // Footer Bar

    }

endif;

add_action( 'atento_action_footer', 'atento_add_footer_widgets', 10 );
add_action( 'atento_action_footer', 'atento_add_footer_bottom_widgets', 15 );
add_action( 'atento_action_footer', 'atento_add_footer_bar', 20 );

/*----------------------------------------------------------------------
# Post navigation hook
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_add_posts_pagination' ) ) :

    /**
     * Add custom posts pagination
     *
     * @since 0.1.0
     */
    function atento_add_posts_pagination() {

        the_posts_pagination();

    }

endif;

add_action( 'atento_action_posts_pagination', 'atento_add_posts_pagination', 10 );
