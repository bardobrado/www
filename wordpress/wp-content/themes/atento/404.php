<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Atento
 */

get_header();

$row_class          = array( 'row' );
$primary_class      = array( 'content-area full-width' );

/**
 * Hook - atento_action_before_main_content
 *
 * @hooked: atento_action_page_header - 10
 */
do_action( 'atento_action_before_main_content' ); ?>

    <div class="outer-container">
        <div class="container-fluid">
            <div class="<?php echo esc_attr( implode( ' ', $row_class ) ); ?>">
                <div class="col-12 d-flex flex-wrap">
                    <div id="primary" class="<?php echo esc_attr( implode( ' ', $primary_class ) ); ?>">
                        <main id="main" class="site-main">
                            <section class="error-404 not-found">
                                <div class="page-content">
                                    <p class="error-description"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'atento' ); ?></p>

                                    <div class="mt-80">
                                        <?php get_search_form(); ?>
                                    </div>

                                    <div class="mt-80"></div>

                                    <?php the_widget( 'WP_Widget_Recent_Posts' );  ?>

                                    <div class="widget widget_categories">
                                        <h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'atento' ); ?></h2>
                                        <ul>
                                            <?php
                                            wp_list_categories( array(
                                                'orderby'    => 'count',
                                                'order'      => 'DESC',
                                                'show_count' => 1,
                                                'title_li'   => '',
                                                'number'     => 10,
                                            ) );
                                            ?>
                                        </ul>
                                    </div><!-- .widget -->

                                    <?php

                                    /* translators: %1$s: smiley */
                                    $atento_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'atento' ), convert_smilies( ':)' ) ) . '</p>';

                                    the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$atento_archive_content" );

                                    the_widget( 'WP_Widget_Tag_Cloud' ); ?>

                                </div><!-- .page-content -->
                            </section><!-- .error-404 -->
                        </main><!-- #main -->
                    </div><!-- #primary -->

                    <?php
                    /**
                     * Hook - atento_action_sidebar.
                     *
                     * @hooked: atento_add_sidebar - 10
                     */
                    do_action( 'atento_action_sidebar' ); ?>

                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </div><!-- .outer-container -->

<?php get_footer();
