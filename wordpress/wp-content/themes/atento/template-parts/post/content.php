<?php
/**
 * Template part for displaying post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Atento
 */

$after_footer_elements  = get_theme_mod( 'atento_post_after_footer_content_elements_order', array('post-navigation','comment-section') );
$header_class           = array( 'entry-header d-flex flex-wrap align-items-center text-center' );
$col_count              = '';
$content_class          = array( 'entry-content mt-40' );
$footer_class           = array( 'entry-footer d-flex flex-wrap align-items-center mt-40' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="<?php echo esc_attr( implode( ' ', $header_class ) ); ?>">

        <?php if ( has_post_thumbnail() ) :
            $image_size     = 'atento-1800-16x9';

            if ( atento_has_secondary_content_class() == 'full-width' ) {
                $image_size = 'atento-1800-16x9';
            } ?>

            <figure class="post-featured-image post-thumbnail">

                <?php the_post_thumbnail( $image_size, array(
                    'alt' => the_title_attribute( array(
                        'echo' => false,
                    ) ),
                ) ); ?>

            </figure>

        <?php endif;

        atento_cat_links();

        the_title( '<h1 class="entry-title w-100">', '</h1>' ); ?>

    </header><!-- .entry-header -->

    <div class="<?php echo esc_attr( implode( ' ', $content_class ) ); ?>">

        <?php the_content();

        wp_link_pages( array(
            'before'      => '<div class="page-links d-flex flex-wrap align-items-center py-24">' . esc_html__( 'Pages:', 'atento' ),
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
        ) ); ?>

    </div><!-- .entry-content -->

    <footer class="<?php echo esc_attr( implode( ' ', $footer_class ) ); ?>">

        <?php atento_tags_links(); ?>

    </footer><!-- .entry-footer -->

    <div class="after-footer-content">

        <?php if ( ! empty( $after_footer_elements ) ) {

            foreach ( $after_footer_elements as $footer_element_key => $footer_element_value ) {

                if ( $footer_element_value === 'post-navigation' ) {

                    echo '<div class="post-listing post-navigation-wrap default navigation-layout-2 mt-80">';

                    // Previous/next post navigation.
                    the_post_navigation( array(
                        'prev_text' => '<span aria-hidden="true" class="meta-nav d-inline-block">'. __( 'Previous Post', 'atento' ) . '</span>
                            <div class="post-nav-content transition-5s">
                                <h2 class="entry-title m-0">%title</h2></div><span class="screen-reader-text">' . __( 'Previous Post', 'atento' ) . '</span>' ,
                        'next_text' => '<span aria-hidden="true" class="meta-nav d-inline-block">'. __( 'Next Post', 'atento' ) . '</span>
                            <div class="post-nav-content transition-5s">
                            <h2 class="entry-title m-0">%title</h2></div><span class="screen-reader-text">' . __( 'Next Post', 'atento' ) . '</span>' ,
                    ) );

                    echo '</div>';

                }

                if ( $footer_element_value === 'comment-section' ) {

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                }

                if ( $footer_element_value === 'author-info-section' ) {

                    get_template_part( 'template-parts/post/author', 'box' ); // post author information
                }

                if ( $footer_element_value === 'related-posts' ) {

                    echo '<div class="single-post-related-posts mt-80">';

                    get_template_part( 'template-parts/related-posts/related', 'posts' ); // related post

                    echo '</div><!-- .single-post-related-posts -->';

                }
            }

        }

        if ( get_edit_post_link() ) :

            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Edit <span class="screen-reader-text">%s</span>', 'atento' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );

        endif; ?>

    </div><!-- .after-footer-content -->
</article><!-- #post-<?php the_ID(); ?> -->
