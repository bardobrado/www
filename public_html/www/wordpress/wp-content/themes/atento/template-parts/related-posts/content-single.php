<?php
/**
 * Template part for displaying posts on archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Atento
 */

$url_link           = atento_get_permalink();
$post_id            = atento_get_the_ID();
$header_elements    = array( 'post-thumbnail','post-title','post-content' );
$btn_text           = esc_html__( 'Read More', 'atento' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'w-33' ); ?>>

    <?php

    if ( !empty( $header_elements ) ) :

        $default_gallery    = get_post_gallery( $post_id, false );
        $attachment_ids     = array();

        if ( ! empty( $default_gallery ) ) {
            foreach( $default_gallery['src'] as $src ) {
                $attachment_ids[] = atento_get_attachment_id_from_url( $src );
            }
        }

        if ( has_post_thumbnail() ) {

            $image_id = get_post_thumbnail_id();

            array_unshift($attachment_ids,$image_id );

        }

        ?>

        <header class="entry-header d-flex flex-wrap justify-content-between align-items-center">

            <?php


            $post_format_class  = array( 'd-flex position-absolute justify-content-center align-items-center post-format-icon opacity-0 invisible transition-35s' ); ?>
            <figure class="post-thumbnail d-block position-relative w-100 mb-0">
                <a class="post-thumbnail-link d-block" href="<?php echo esc_url( $url_link ); ?>">

                    <?php
                    $image_size     = 'atento-768-3x4';

                    if ( !empty( $attachment_ids ) ) {
                        $image_path     = wp_get_attachment_image_src( $attachment_ids[0], $image_size, true );
                        $image_alt      = get_post_meta( $attachment_ids[0], '_wp_attachment_image_alt', true );
                        ?>
                        <img width="<?php echo esc_attr($image_path[1]); ?>" height="<?php echo esc_attr($image_path[2]); ?>" src="<?php echo esc_url($image_path[0]); ?>" alt="<?php echo esc_attr($alt); ?>">
                    <?php } ?>

                </a><!-- .post-thumbnail-link -->

                <a class="d-flex position-absolute justify-content-center align-items-center post-format-icon opacity-0 invisible transition-35s" href="<?php echo esc_url( $url_link ); ?>">
                    <span class="pt-icon icon-dots-horizontal"></span>
                </a><!-- .post-format-icon -->
            </figure><!-- .post-thumbnail -->


            <?php


            the_title( '<h2 class="entry-title w-100 mb-0 td-none"><a class="transition-35s" href="' . esc_url( $url_link ) . '" rel="bookmark">', '</a></h2>' );

            ?>

        </header><!-- entry-header -->

    <?php endif; ?>


    <div class="entry-content">
        <p class="m-0"><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 18, '...' ) ); ?></p>
    </div><!-- .entry-content -->



    <footer class="entry-footer d-flex flex-wrap justify-content-between align-items-center">

        <?php atento_read_more( '', '', $btn_text ); ?>

    </footer><!-- .entry-footer -->


</article><!-- #post-<?php the_ID(); ?> -->
