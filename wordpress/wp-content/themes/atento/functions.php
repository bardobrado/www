<?php
/**
 * Atento functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Atento
 */

/**
 * Atento only works on PHP v5.4.0 or later.
 */
if ( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
    require get_template_directory() . '/inc/libraries/back-compat.php';
    return;
}
/**
 * Define constants
 */
$atento_theme_options  = wp_get_theme();
$atento_theme_name     = $atento_theme_options->get( 'Name' );
$atento_theme_author   = $atento_theme_options->get( 'Author' );
$atento_theme_desc     = $atento_theme_options->get( 'Description' );
$atento_theme_version  = $atento_theme_options->get( 'Version' );

define( 'ATENTO_THEME_NAME', $atento_theme_name );
define( 'ATENTO_THEME_AUTHOR', $atento_theme_author );
define( 'ATENTO_THEME_DESC', $atento_theme_desc );
define( 'ATENTO_THEME_VERSION', $atento_theme_version );
define( 'ATENTO_THEME_URI', get_template_directory_uri() );
define( 'ATENTO_THEME_DIR', get_template_directory() );

if ( ! function_exists( 'atento_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function atento_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Atento, use a find and replace
         * to change 'atento' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'atento', ATENTO_THEME_DIR . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        /* Image Ratio - 4:3 */
        add_image_size( 'atento-768-4x3', 768, 576, true );
        add_image_size( 'atento-1200-4x3', 1200, 900, true );
        add_image_size( 'atento-1800-4x3', 1800, 1350, true );

        /* Image Ratio - 16:9 */
        add_image_size( 'atento-768-16x9', 768, 432, true );
        add_image_size( 'atento-1200-16x9', 1200, 675, true );
        add_image_size( 'atento-1800-16x9', 1800, 1012, true );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary-menu' => esc_html__( 'Primary', 'atento' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'atento_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Set up the WordPress core custom header image feature.
        add_theme_support( 'custom-header', apply_filters( 'atento_custom_header_args', array(
            'default-image'          => '',
            'width'                  => 1920,
            'height'                 => 260,
            'flex-height'            => true,
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

    }
endif;
add_action( 'after_setup_theme', 'atento_setup' );

// Register Sidebars
function atento_widgets_init() {

    // Register Default Sidebar
    register_sidebar( array(
        'name'          => esc_html__('Sidebar', 'atento'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'atento'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));


    /* ---------------------------------------------
    # Header Search Widget Areas
    ---------------------------------------------*/
    if ( get_theme_mod( 'atento_footer_widget_area_activate', true ) == true ) {

        for ($i = 1; $i <=4; $i++) {

            register_sidebar( array(
                'name'          => esc_html__('Footer Widgets Column ', 'atento').$i,
                'id'            => 'footer_sidebar_' . $i,
                'description'   => esc_html__('Add widgets here.', 'atento'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ));

        }
    }

}
add_action( 'widgets_init', 'atento_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function atento_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'atento_content_width', 640 );
}
add_action( 'after_setup_theme', 'atento_content_width', 0 );

/**
 * function for google fonts
 */
if ( ! function_exists('atento_google_fonts_url') ) :

    /**
     * Return fonts URL.
     *
     * @return string Fonts URL.
     */
    function atento_google_fonts_url(){

        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Barlow Semi Condensed, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'atento' ) ) {
            $fonts[] = 'Roboto:400italic,700italic,300,400,500,600,700';
        }

        /* translators: If there are characters in your language that are not supported by Barlow, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Cormorant Garamond font: on or off', 'atento' ) ) {
            $fonts[] = 'Cormorant Garamond:400italic,700italic,300,400,500,600,700';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => rawurlencode( implode( '|', $fonts ) ),
                'subset' => rawurlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/**
 * Enqueue scripts and styles.
 */
function atento_scripts() {

    $min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    // CSS Lib
    wp_enqueue_style( 'lib-css', ATENTO_THEME_URI .'/assets/front-end/css/lib.css', false, ATENTO_THEME_VERSION, 'all' );


    wp_enqueue_style( 'atento-style', get_stylesheet_uri() );

    $fonts_url = atento_google_fonts_url();
    if ( ! empty( $fonts_url ) ) {
        wp_enqueue_style('atento-google-fonts', $fonts_url, array(), null);
    }

    // Custom JS
    wp_enqueue_script( 'custom-js', ATENTO_THEME_URI . '/assets/front-end/js/custom' . $min . '.js', array( 'jquery' ), ATENTO_THEME_VERSION, true );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'atento_scripts' );

/*--------------------------------------------------------------
# Back-End Enqueue scripts and styles.
--------------------------------------------------------------*/
//if ( !function_exists( 'atento_admin_scripts' ) ) {
//    function atento_admin_scripts() {
//
//        $min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
//
//        // Get Current Screen Name
//        $current_screen = get_current_screen();
//        $screen_id      = $current_screen->id;
//
//        // Enqueue Google Fonts
//        wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Libre+Baskerville:400,700|Roboto:300,400,500,700', array(), ATENTO_THEME_VERSION, '' );
//
//        // Widgets Specific enqueue.
//        if ( in_array( $screen_id, array( 'widgets', 'customize' ) ) ) {
//            wp_enqueue_style( 'atento-customizer-style', ATENTO_THEME_URI .'/assets/back-end/css/customizer-style' . $min . '.css', false, ATENTO_THEME_VERSION, 'all' );
//        }
//
//        // Enqueue Style
//        wp_enqueue_style( 'atento-admin-style', ATENTO_THEME_URI .'/assets/back-end/css/admin-style' . $min . '.css', false, ATENTO_THEME_VERSION, 'all' );
//
//        // Enqueue Script
//        wp_enqueue_script( 'atento-admin-script', ATENTO_THEME_URI . '/assets/back-end/js/admin-script' . $min . '.js', array( 'jquery' ), ATENTO_THEME_VERSION, true );
//
//    }
//}
//add_action( 'admin_enqueue_scripts', 'atento_admin_scripts' );

/*--------------------------------------------------------------
# Back-End Enqueue scripts and styles.
--------------------------------------------------------------*/
if ( !function_exists( 'atento_admin_scripts' ) ) {
    function atento_admin_scripts() {

        // Get Current Screen Name
        $screen         = get_current_screen();
        $screen_id      = $screen ? $screen->id : '';

        //$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

        $min = '';

        // Enqueue Style
        wp_enqueue_style( 'atento-admin-style', ATENTO_THEME_URI .'/assets/back-end/css/admin-style' . $min . '.css', false, ATENTO_THEME_VERSION, 'all' );


        // Run some code, only on the customizer and widgets page
        if ( in_array( $screen_id, array( 'widgets', 'customize' ) ) ) {

            wp_enqueue_style( 'atento-customizer-style', ATENTO_THEME_URI .'/assets/back-end/css/customizer-style' . $min . '.css', false, ATENTO_THEME_VERSION, 'all' );

        } else {

            // Enqueue Script
            wp_enqueue_script( 'atento-admin-script', ATENTO_THEME_URI . '/assets/back-end/js/admin-script' . $min . '.js', array( 'jquery' ), ATENTO_THEME_VERSION, true );

        }

    }
}
add_action( 'admin_enqueue_scripts', 'atento_admin_scripts' );

/**
 * Load template functions.
 */
require ATENTO_THEME_DIR . '/inc/helpers/template-functions.php';

/**
 * Load themes custom hooks.
 */
require ATENTO_THEME_DIR . '/inc/helpers/theme-hooks.php';

/**
 * Load kirki library in theme
 */
require ATENTO_THEME_DIR . '/inc/libraries/kirki/kirki.php';

/**
 * Load plugin recommendations.
 */
require ATENTO_THEME_DIR . '/inc/libraries/tgm/tgm.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require ATENTO_THEME_DIR . '/inc/libraries/jetpack.php';
}

/**
 * Customizer options.
 */
require ATENTO_THEME_DIR . '/inc/framework/customizer/customizer.php';

/**
 * Load theme meta box
 */
require ATENTO_THEME_DIR . '/inc/framework/meta-boxes/class-meta-box.php';

/**
 * Include Welcome page and demo importer.
 */
if ( is_admin() ) {
    // Welcome Page.
    require ATENTO_THEME_DIR . '/inc/framework/welcome-screen/class-welcome-screen.php';
    require ATENTO_THEME_DIR . '/inc/framework/welcome-screen/persist-admin-notices-dismissal.php';

    // Demo.
    require ATENTO_THEME_DIR . '/inc/framework/demo-importer/class-demo.php';
}
