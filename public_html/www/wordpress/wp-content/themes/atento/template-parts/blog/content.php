<?php
/**
 * Template part for displaying posts on archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Atento
 */

$url_link               = atento_get_permalink();
$thumbnail_ratio        = atento_get_thumbnail_ratio();
$enable_thumbnail_placeholder   = get_theme_mod( 'atento_archive_page_thumbnail_placeholder', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'grid-column w-100', 'text-center' ) ); ?>>
    <header class="entry-header d-flex flex-wrap justify-content-between align-items-center">

        <?php if ( has_post_thumbnail() || ( true == $enable_thumbnail_placeholder ) ) :

            $post_format_class  = array( 'd-flex position-absolute justify-content-center align-items-center post-format-icon opacity-0 invisible transition-35s' ); ?>

            <figure class="post-thumbnail d-block position-relative mb-0">
                <a class="post-thumbnail-link d-block" href="<?php echo esc_url( $url_link ); ?>">

                    <?php

                    if ( has_post_thumbnail() ) {
                        
                        $thumbnail_size = 'atento-1800-' . $thumbnail_ratio;

                        the_post_thumbnail( $thumbnail_size, array(
                            'alt' => the_title_attribute( array(
                                'echo' => false,
                            ) ),
                        ) );
                        
                    }
                    elseif ( $enable_thumbnail_placeholder == true ) {

                        $img_src = ATENTO_THEME_URI . '/assets/front-end/images/thumbnail-placeholder-16x9.svg';
                        echo '<img src="'.esc_url( $img_src ).'" alt="'.esc_attr__( 'Thumbnail Placeholder','atento' ).'">';
                    }
                    ?>

                </a><!-- .post-thumbnail-link -->
            </figure><!-- .post-thumbnail -->

        <?php endif;

        atento_cat_links();

        the_title( '<h2 class="entry-title w-100 mb-0 td-none"><a class="transition-35s" href="' . esc_url( $url_link ) . '" rel="bookmark">', '</a></h2>' ); ?>

    </header><!-- entry-header -->

    <div class="entry-content">
        <p class="m-0"><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 54, '...' ) ); ?></p>
    </div><!-- .entry-content -->

    <footer class="entry-footer d-flex flex-wrap justify-content-between align-items-center">
        <?php atento_read_more(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
