<?php
/**
 * Related Posts Section.
 *
 * @package Atento
 */

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

$current_post   = $post;
$args           = array();
$section_title  = esc_html__( 'Related Posts', 'atento' );
$cats           = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );

if ( ! empty( $cats ) ) {
    $args['posts_per_page']         = 3;
    $args['post__not_in']           = array( $current_post->ID );
    $args['category__in']           = $cats;
    $args['no_found_rows']          = true;
    $args['ignore_sticky_posts']    = true;
    $args['orderby']                = 'modified';

}


$the_query = new WP_Query( $args );

if ( $the_query->have_posts() && ! empty( $args ) ) : ?>

    <div class="post-listing related-posts">

        <?php if ( $section_title !== '' ) : ?>
            <h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
        <?php endif; ?>

        <div class="blog-posts d-row mt-32">

            <?php while ( $the_query->have_posts() ) : $the_query->the_post();

                /*
                * Include the Post-Type-specific template for the content.
                * If you want to override this in a child theme, then include a file
                * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                */

                get_template_part( 'template-parts/related-posts/content', 'single' );

            endwhile; ?>

            <?php wp_reset_postdata(); ?>

        </div><!-- .blog-posts -->
    </div><!-- .related-posts -->

<?php endif;
