<?php
/**
 * The Footer Column - 4
 *
 * @package Atento
 */

$col_class = 'col-12 col-md-6 col-lg-3'; ?>

<?php if ( is_active_sidebar( 'footer_sidebar_1' ) ) : ?>

    <div class="<?php echo esc_attr( $col_class ); ?>">
        <?php dynamic_sidebar( 'footer_sidebar_1' ); ?>
    </div><!-- .col-3 -->

<?php endif; ?>

<?php if ( is_active_sidebar( 'footer_sidebar_2' ) ) : ?>

    <div class="<?php echo esc_attr( $col_class ); ?>">
        <?php dynamic_sidebar( 'footer_sidebar_2' ); ?>
    </div><!-- .col-3 -->

<?php endif; ?>

<?php if ( is_active_sidebar( 'footer_sidebar_3' ) ) : ?>

    <div class="<?php echo esc_attr( $col_class ); ?>">
        <?php dynamic_sidebar( 'footer_sidebar_3' ); ?>
    </div><!-- .col-3 -->

<?php endif; ?>

<?php if ( is_active_sidebar( 'footer_sidebar_4' ) ) : ?>

    <div class="<?php echo esc_attr( $col_class ); ?>">
        <?php dynamic_sidebar( 'footer_sidebar_4' ); ?>
    </div><!-- .col-3 -->

<?php endif;
