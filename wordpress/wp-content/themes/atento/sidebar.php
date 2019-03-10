<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Atento
 */

$sidebar_class = atento_has_secondary_content_class();

if ( $sidebar_class == 'full-width' ) {
    return;
}

$sidebar = atento_get_sidebar_id();

$secondary_classes = array('widget-area');
$secondary_classes[] = $sidebar_class;
$secondary_classes[] = atento_get_sidebar_layout(); ?>

<aside id="secondary" class="<?php echo esc_attr( implode( ' ', $secondary_classes ) );?>">
    <?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->
