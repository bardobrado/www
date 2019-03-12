<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Atento
 */
?>

</div><!-- #content -->

<?php if ( get_theme_mod( 'atento_footer_widget_area_activate', true ) == true ) : ?>
    <div class="footer-separator"></div>
<?php endif; ?>

<footer class="site-footer">

    <?php
    /**
     * Hook - atento_action_footer.
     *
     * @hooked atento_add_footer_widgets - 10
     * @hooked atento_add_footer_bottom_widgets - 15
     * @hooked atento_add_footer_bar - 20
     */
    do_action( 'atento_action_footer' );
    ?>

</footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>