<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Atento
 */

$gallery_position       = get_post_meta( atento_get_the_ID(), 'atento_gl_position', true );
$header_class           = array( 'entry-header d-flex flex-wrap align-items-center text-center' );
$content_class          = array( 'entry-content mt-40' ); ?>

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

    <div class="after-footer-content">

        <?php

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

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
