<?php
/**
 * Header Layout 4
 *
 * @package Atento
 */
?>

<div class="body-overlay w-100 h-100 opacity-0 invisible transition-5s"></div>

<div class="d-flex flex-column align-items-center">
    <div class="site-branding d-flex flex-wrap flex-column justify-content-center align-items-center">

        <?php the_custom_logo(); ?>

        <div class="site-title-wrap text-center">

            <?php

            if ( true == get_theme_mod( 'atento_header_site_title_visible', true ) ) :

                if ( is_front_page() && is_home() ) : ?>

                    <h1 class="site-title"><a class="d-inline-block td-none outline-none" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name ') ); ?></a></h1>

                <?php else : ?>

                    <p class="site-title"><a class="d-inline-block td-none outline-none" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name ') ); ?></a></p>

                <?php endif;

            endif;

            if ( true == get_theme_mod( 'atento_header_site_tagline_visible', true ) ) :

                $atento_description = get_bloginfo( 'description', 'display' );
                if ( $atento_description || is_customize_preview() ) : ?>

                    <p class="site-description"><?php echo $atento_description; /* WPCS: xss ok. */ ?></p>

                <?php endif;

            endif; ?>

        </div><!-- .site-title-wrap -->
    </div><!-- .site-branding -->

    <nav id="site-navigation" class="main-navigation slide-in transition-5s">
        <div class="close-navigation position-absolute transition-5s cursor-pointer d-lg-none"><span class="pt-icon icon-cross"></span></div>

        <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_id' => 'primary-menu', 'container' => 'ul', 'menu_class' => 'primary-menu d-flex flex-wrap flex-column flex-lg-row justify-content-center p-0 m-0 ls-none' ) ); ?>
    </nav><!-- #site-navigation -->

    <div class="hamburger-menu cursor-pointer d-lg-none">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div><!-- .hamburger-menu -->
</div><!-- .col -->