<?php
/**
 * Footer Widget Section.
 *
 * @package Atento
 */

if ( ( is_active_sidebar( 'footer_sidebar_1' ) || is_active_sidebar( 'footer_sidebar_2' ) || is_active_sidebar( 'footer_sidebar_3' ) || is_active_sidebar( 'footer_sidebar_4' ) ) && ( get_theme_mod( 'atento_footer_widget_area_activate', true ) == true ) ) : ?>

    <div class="<?php echo esc_attr( 'footer-widgets' ); ?>">
        <div class="outer-container">
            <div class="container-fluid">
                <div class="row">
                    <?php get_template_part( 'template-parts/footer/widget-area/col', 4 ); ?>
                </div><!-- .row -->
            </div><!-- .outer-container -->
        </div><!-- .container-fluid -->
    </div><!-- .footer-widgets -->

<?php endif;
