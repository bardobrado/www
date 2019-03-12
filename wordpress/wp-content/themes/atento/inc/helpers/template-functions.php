<?php
/**
 * Functions which enhance the theme by hooking into WordPress and Core theme Functions.
 *
 * @package Atento
 */

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*----------------------------------------------------------------------
# Adds custom classes to the array of body classes.
-------------------------------------------------------------------------*/
if ( !function_exists( 'atento_body_classes' ) ) {
    /**
     * @param array $classes Classes for the body element.
     * @return array
     */
    function atento_body_classes( $classes ) {

        // Adds a class of hfeed to non-singular pages.
        if ( ! is_singular() ) {
            $classes[] = 'hfeed';
        }

        return apply_filters( 'atento_body_classes', $classes );
    }
}
add_filter( 'body_class', 'atento_body_classes' );

/*----------------------------------------------------------------------
# Add a pingback url auto-discovery header for single posts, pages, or attachments.
-------------------------------------------------------------------------*/
if ( !function_exists( 'atento_pingback_header' ) ) {

    function atento_pingback_header() {
        if ( is_singular() && pings_open() ) {
            echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
        }
    }
}
add_action( 'wp_head', 'atento_pingback_header' );

/*----------------------------------------------------------------------
# Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
-------------------------------------------------------------------------*/
if ( !function_exists( 'page_menu_args' ) ) {
    function page_menu_args( $args ) {
        $args['show_home'] = true;
        return $args;
    };
}
add_filter( 'wp_page_menu_args', 'page_menu_args', 10, 1 );

/*----------------------------------------------------------------------
# Get custom permalink
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_get_permalink' ) ) :

    function atento_get_permalink( $post_id = '' ) {

        // Apply filters and return
        return apply_filters( 'atento_get_permalink', get_permalink()  );

    }
endif;

/*----------------------------------------------------------------------
# Prints HTML with meta information for the categories.
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_cat_links' ) ) {

    function atento_cat_links( $before='', $after='') {
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $cat_sep = '<span class="cat-separator disc"></span>';
            $categories_list = get_the_category_list( $cat_sep );
            $output = '';
            if ( $categories_list ) {

                $output .= '<div class="cat-links post-meta-item d-flex flex-wrap align-items-center">';

                $output .= $categories_list;
                $output .= '</div>';
            }

            // Filter
            $output = apply_filters( 'atento_cat_links', $output );

            if ( ! empty( $output ) ) {
                echo $before . $output . $after;
            }
        }
    }
}

/*----------------------------------------------------------------------
# Prints HTML with meta information for the tags.
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_tags_links' ) ) {

    function atento_tags_links( $before='', $after='' ) {
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $tag_sep = '<span class="tag-separator separator-comma">, </span>';
            $tags_list  = get_the_tag_list( '', $tag_sep );
            $output     = '';
            if ( $tags_list ) {

                $output .= '<div class="tags-links post-meta-item d-flex flex-wrap align-items-center">';
                $output .= $tags_list;
                $output .= '</div>';
            }
            // Filter
            $output = apply_filters( 'atento_tags_links', $output );

            if ( ! empty( $output ) ) {
                echo $before . $output . $after;
            }
        }
    }
}

/*----------------------------------------------------------------------
# Prints HTML with meta information read more button
-------------------------------------------------------------------------*/
if ( !function_exists( 'atento_read_more' ) ) {
    function atento_read_more( $before='', $after='' ) {

        $output     = '';
        $output     .= '<div class="read-more custom w-100">';
        $output     .= '<a class="td-none transition-35s" href="'.esc_url( atento_get_permalink() ).'">' . esc_html__( 'Read More', 'atento' ) . '</a>';
        $output .= '</div>';

        // Filter
        $output = apply_filters( 'atento_read_more', $output );

        if ( ! empty( $output ) ) {
            echo $before . $output . $after;
        }
    }
}


/*----------------------------------------------------------------------
# Add Action for the copyright information.
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_footer_copyright_information' ) ) {
    /**
     * Function to show the copyright information
     */
    function atento_footer_copyright_information() {
        printf( '<div class="site-info">%1$s <a href="%2$s">%3$s.</a> %4$s.<span class="sep"> | </span>%5$s <a href="%6$s" rel="designer" target="_blank">Precise Themes</a></div><!-- .site-info -->',
            sprintf('%1$s %2$s',
                esc_html__( 'Copyright &copy;', 'atento' ),
                esc_html( date('Y') )
            ),
            esc_url( home_url( '/' ) ),
            esc_html( get_bloginfo( 'name', 'display' ) ),
            esc_html__( 'All rights reserved','atento' ),
            esc_html__( 'Designed by','atento' ),
            esc_url( 'http://precisethemes.com/' )
        );
    }
}
add_action( 'atento_footer_copyright', 'atento_footer_copyright_information', 5 );

/*----------------------------------------------------------------------
#  Returns correct ID
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_get_the_ID' ) ) {
    function atento_get_the_ID() {

        // Default value is empty
        $id = get_the_ID();

        // Posts page
        if ( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
            $id = $page_for_posts;
        }

        // Apply filters and return
        return apply_filters( 'atento_post_id', $id );

    }
}

/*----------------------------------------------------------------------
# Display the archive title based on the queried object.
-------------------------------------------------------------------------*/
if ( !function_exists( 'atento_archive_get_title' ) ) {
    function atento_archive_get_title( $before = '', $after = '' ) {
        if ( is_category() ) {
            $title = sprintf( '<label>%1$s</label> %2$s',
                esc_html__( 'Category','atento' ),
                single_cat_title( '', false ) );
        } elseif ( is_tag() ) {
            $title = sprintf( '<label>%1$s</label> %2$s',
                esc_html__( 'Tag','atento' ),
                single_tag_title( '', false ) );
        } elseif ( is_author() ) {
            $title = sprintf( '<label>%1$s</label> %2$s',
                esc_html__( 'Author','atento' ),
                get_the_author() );
        } elseif ( is_year() ) {
            $title = sprintf( '<label>%1$s</label> %2$s',
                esc_html__( 'Year','atento' ),
                get_the_date( _x( 'Y', 'yearly archives date format', 'atento' ) ) );
        } elseif ( is_month() ) {
            $title = sprintf( '<label>%1$s</label> %2$s',
                esc_html__( 'Month','atento' ),
                get_the_date( _x( 'F Y', 'monthly archives date format', 'atento' ) ) );
        } elseif ( is_day() ) {
            $title = sprintf( '<label>%1$s</label> %2$s',
                esc_html__( 'Day','atento' ),
                get_the_date( _x( 'F j, Y', 'daily archives date format', 'atento' ) ) );
        } elseif ( is_tax( 'post_format' ) ) {
            if ( is_tax( 'post_format', 'post-format-aside' ) ) {
                $title = _x( 'Asides', 'post format archive title', 'atento' );
            } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
                $title = _x( 'Galleries', 'post format archive title', 'atento' );
            } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
                $title = _x( 'Images', 'post format archive title', 'atento' );
            } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
                $title = _x( 'Videos', 'post format archive title', 'atento' );
            } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
                $title = _x( 'Quotes', 'post format archive title', 'atento' );
            } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
                $title = _x( 'Links', 'post format archive title', 'atento' );
            } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
                $title = _x( 'Statuses', 'post format archive title', 'atento' );
            } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
                $title = _x( 'Audio', 'post format archive title', 'atento' );
            } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
                $title = _x( 'Chats', 'post format archive title', 'atento' );
            }
        } elseif ( is_post_type_archive() ) {
            $title = sprintf( '<label>%1$s</label> %2$s',
                esc_html__( 'Archives','atento' ),
                post_type_archive_title( '', false ) );
        } elseif ( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = sprintf( '<label>%1$s</label> %2$s',
                $tax->labels->singular_name,
                single_term_title( '', false ) );
        } else {
            $title = esc_html__( 'Archives', 'atento' );
        }

        /**
         * Filter the archive title.
         *
         * @param string $title Archive title to be displayed.
         */
        $title = apply_filters( 'get_the_archive_title', $title );

        if ( ! empty( $title ) ) {
            echo $before . $title . $after;
        }
    }
}

/*----------------------------------------------------------------------
# Returns sidebar layout
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_get_sidebar_layout' ) ) {
    function atento_get_sidebar_layout( $post_id = '' ) {

        // Global Sidebar Layout
        $global_layout = get_theme_mod( 'atento_global_sidebar_layout', 'right-sidebar' );

        // Get post ID
        $post_id = $post_id ? $post_id : atento_get_the_ID();


        // Check meta first to override and return (prevents filters from overriding meta)
        if ( $post_id && $meta = get_post_meta( $post_id, 'atento_sidebar_layout', true ) ) {

            return apply_filters( 'atento_get_sidebar_layout', esc_attr( $meta ) );

        }


        // Bail if single page
        if ( is_404() ) {

            $global_layout = 'full-width';
        }

        // Bail if single page
        elseif ( is_page() ) {

            $page_layout = get_theme_mod( 'atento_page_sidebar_layout', 'default' );

            if ( $page_layout !== 'default' ) {

                $global_layout = $page_layout;

            }

        }

        // Bail if single post
        elseif ( is_single() ) {

            $post_layout = get_theme_mod( 'atento_post_sidebar_layout', 'default' );

            if ( $post_layout !== 'default' ) {

                $global_layout = $post_layout;

            }
        }

        // Bail if archive page
        elseif ( is_archive() ) {

            // For all Archive Page
            $archive_layout = get_theme_mod( 'atento_archive_sidebar_layout', 'default' );

            if ( $archive_layout !== 'default' ) {

                $global_layout = $archive_layout;

            }

        }

        // Apply filters and return
        return apply_filters( 'atento_get_sidebar_layout', esc_attr( $global_layout ) );

    }
}

/*----------------------------------------------------------------------
# Return Sidebar ID
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_get_sidebar_id' ) ) {
    function atento_get_sidebar_id( $post_id = '' ) {

        // Global Sidebar
        $global_sidebar = 'sidebar-1';

        // Apply filters and return
        return apply_filters( 'atento_get_sidebar_id', $global_sidebar );

    }
}

/*----------------------------------------------------------------------
# Primary Class
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_has_primary_content_class' ) ) {
    function atento_has_primary_content_class() {

        $sidebar_layout = atento_get_sidebar_layout();

        if ( $sidebar_layout == 'right-sidebar' ) {
            $primary_class = 'order-1';
        }
        elseif ( $sidebar_layout == 'left-sidebar' ) {
            $primary_class = 'order-2';
        }
        else {
            $primary_class = 'full-width';
        }
        // Apply filters and return
        return apply_filters( 'atento_has_primary_content_class', $primary_class );

    }
}

/*----------------------------------------------------------------------
# Secondary Class
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_has_secondary_content_class' ) ) {
    function atento_has_secondary_content_class() {

        $sidebar_layout = atento_get_sidebar_layout();

        if ( $sidebar_layout == 'right-sidebar' ) {
            $secondary_class = 'order-2';
        } elseif ( $sidebar_layout == 'left-sidebar' ) {
            $secondary_class = 'order-1';
        } else {
            $secondary_class = $sidebar_layout;
        }
        // Apply filters and return
        return apply_filters( 'atento_has_secondary_content_class', $secondary_class );

    }
}


/*----------------------------------------------------------------------
# Page Header Color Scheme
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_page_header_color_scheme' ) ) {
    function atento_page_header_color_scheme( $post_id = '' ) {

        // Global Sidebar
        $global_color_scheme = 'cs-dark';

        // Apply filters and return
        return apply_filters( 'atento_page_header_color_scheme', $global_color_scheme );

    }
}

/*----------------------------------------------------------------------
# Page Header Text Alignment Scheme
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_page_header_text_alignment' ) ) {
    function atento_page_header_text_alignment( $post_id = '' ) {

        // Global Sidebar
        $global_text_align = 'left';

        // Apply filters and return
        return apply_filters( 'atento_page_header_text_alignment', $global_text_align );

    }
}


/*----------------------------------------------------------------------
# Return Thumbnail Ratio
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_get_thumbnail_ratio' ) ) {
    function atento_get_thumbnail_ratio( $post_id = '' ) {

        // Global ratio
        $global_ratio = '16x9';

        // Apply filters and return
        return apply_filters( 'atento_get_thumbnail_ratio', $global_ratio );

    }
}

/*--------------------------------------------------------------
# Return attachment id from Image URL. attachment
--------------------------------------------------------------*/
if ( ! function_exists( 'atento_get_attachment_id_from_url' ) ) {
    function atento_get_attachment_id_from_url( $url ) {
        $attachment_id = 0;
        $dir = wp_upload_dir();
        if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
            $file = basename( $url );
            $query_args = array(
                'post_type'   => 'attachment',
                'post_status' => 'inherit',
                'fields'      => 'ids',
                'meta_query'  => array(
                    array(
                        'value'   => $file,
                        'compare' => 'LIKE',
                        'key'     => '_wp_attachment_metadata',
                    ),
                )
            );
            $query = new WP_Query( $query_args );
            if ( $query->have_posts() ) {
                foreach ( $query->posts as $post_id ) {
                    $meta = wp_get_attachment_metadata( $post_id );
                    $original_file       = basename( $meta['file'] );
                    $cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
                    if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
                        $attachment_id = $post_id;
                        break;
                    }
                }
            }
        }
        return $attachment_id;
    }
}

/*----------------------------------------------------------------------
# Enable Hero
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_hero_enable' ) ) :

    /**
     * Enable Hero Section.
     *
     * @since 0.1.0
     */
    function atento_hero_enable() {

        $output = false;

        if ( get_theme_mod( 'atento_hero_on_home_enable', true ) ) {

            $output = true;

        }

        return $output;

    }

endif;

/*----------------------------------------------------------------------
# Get menu list
# @return array of menu list with menu id as index and menu name as value
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_get_menus' ) ) {
    /**
     * Get menu list
     * @return array of menu list with menu id as index and menu name as value
     */
    function atento_get_menus() {
        $menu_list = array();
        $nav_menus = wp_get_nav_menus();
        if ( count( $nav_menus ) ) {
            $menu_list[''] = sprintf( '&mdash; %s &mdash;', esc_html__( 'Choose a Menu', 'atento' ) );
            foreach ( $nav_menus as $nav ) {
                $menu_list[ $nav->slug ] = esc_html( $nav->name );
            }
        } else {
            $menu_list = array( '' => esc_html__( 'No Menu set yet', 'atento' ) );
        }
        return $menu_list;
    }
}

/*----------------------------------------------------------------------
# Get Page Content Layouts
# @return array of content layouts
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_content_layouts' ) ) :
    /**
     * Returns array of content layouts for page or page.
     */
    function atento_content_layouts( $output = array() ) {

        $output['left-sidebar']     = esc_html__( 'Left Sidebar', 'atento' );
        $output['full-width']       = esc_html__( 'Full Width', 'atento' );
        $output['right-sidebar']    = esc_html__( 'Right Sidebar', 'atento' );
        return $output;
    }
endif;

/*----------------------------------------------------------------------
# Get Justify Alignment Options
# @return array of justify layouts
-------------------------------------------------------------------------*/
if ( ! function_exists( 'atento_flex_justify' ) ) :
    /**
     * Returns array of text alignment options
     */
    function atento_flex_justify( $output = array() ) {

        $output['justify-content-start']    = esc_html__( 'Left', 'atento' );
        $output['justify-content-center']   = esc_html__( 'Center', 'atento' );
        $output['justify-content-end']      = esc_html__( 'Right', 'atento' );
        return $output;
    }
endif;
