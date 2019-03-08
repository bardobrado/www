<?php
/**
 * Atento Welcome Screen
 *
 * @since  1.0.3
 * @package atento
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Atento_Welcome_Screen' ) ) :

    /**
     * Atento_Welcome_Screen Class.
     */
    class Atento_Welcome_Screen {

        /**
         * Constructor.
         */
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'admin_menu' ) );
            add_action( 'admin_init', array( 'PAnD', 'init' ) );
            add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
        }

        /**
         * Add admin menu.
         */
        public function admin_menu() {

            add_theme_page(
                esc_html__( 'Getting Started', 'atento' ),
                esc_html__( 'Getting Started', 'atento' ),
                'edit_theme_options',
                'atento-welcome' ,
                array( $this, 'welcome_screen' )
            );
        }

        /**
         * Show welcome notice.
         */
        public function welcome_notice() {
            if ( ! PAnD::is_admin_notice_active( 'atento-welcome-forever' ) ) {
                return;
            } ?>

            <div data-dismissible="atento-welcome-forever" class="updated notice notice-success is-dismissible welcome-notice">

                <?php

                printf(
                    '<h1>%1$s</h1>',
                    esc_html__( 'Welcome to Atento', 'atento' )
                );

                printf(
                    '<p>%1$s<br/><a href="%2$s">%3$s</a></p>',
                    esc_html__( 'Welcome! Thank you for choosing Atento ! To fully take advantage of the best our theme can offer please make sure you visit our', 'atento' ),
                    esc_url( admin_url( 'themes.php?page=atento-welcome' ) ),
                    esc_html__( 'welcome page', 'atento' )
                );

                printf(
                    '<p><a class="button-secondary" href="%1$s">%2$s</a></p>',
                    esc_url( admin_url( 'themes.php?page=atento-welcome' ) ),
                    esc_html__( 'Get started with Atento', 'atento' )
                );

                ?>
                <button type="button" class="notice-dismiss">
                    <a class="atento-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'atento-hide-notice', 'welcome' ) ), 'atento_hide_notices_nonce', '_atento_notice_nonce' ) ); ?>">
                        <span class="screen-reader-text"><?php esc_html_e( 'Dismiss', 'atento' ); ?></span>
                    </a>
                </button>

            </div>
            <?php
        }

        /**
         * Welcome screen page.
         */
        public function welcome_screen() {
            $user = wp_get_current_user();
            ?>

            <div class="about-container">
                <div class="flex theme-info">
                    <div class="theme-details">
                        <?php
                        printf(
                            '<h4>%1$s &commat;<span>%2$s,</span></h4>',
                            esc_html__( 'Hello', 'atento' ),
                            esc_html( ucfirst( $user->display_name ) )
                        );

                        printf(
                            '<h1 class="entry-title">%1$s %2$s</h1>',
                            esc_html__( 'Welcome to Atento version', 'atento' ),
                            esc_html( ATENTO_THEME_VERSION )
                        );

                        printf(
                            '<p class="entry-content">%1$s</p>',
                            wp_kses_post( ATENTO_THEME_DESC )
                        );
                        ?>
                    </div>

                    <figure class="theme-screenshot">
                        <img src="<?php echo esc_url( ATENTO_THEME_URI ) . '/screenshot.png'; ?>" />
                    </figure>
                </div>

                <div class="about-theme-tabs">
                    <ul class="about-theme-tab-nav">
                        <li class="tab-link active" data-tab="getting_started"><?php esc_html_e( 'Getting Started', 'atento' ); ?></li>
                        <li class="tab-link" data-tab="support"><?php esc_html_e( 'Support Forum', 'atento' ); ?></li>
                        <li class="tab-link" data-tab="changelog"><?php esc_html_e( 'Changelog', 'atento' ); ?></li>
                        <li class="tab-link" data-tab="free_vs_pro"><?php esc_html_e( 'Free vs Pro', 'atento' ); ?></li>
                        <li class="tab-link" data-tab="upgrade_pro"><?php esc_html_e( ' Upgrade to Pro', 'atento' ); ?></li>
                    </ul>

                    <?php $this->getting_started();?>

                    <?php $this->supports();?>

                    <?php $this->changelog();?>

                    <?php $this->free_vs_pro();?>

                    <?php $this->upgrade_pro();?>

                    <div class="about-page-theme-rating">
                        <?php
                        printf(
                            '<p>%1$s <a href="%2$s" target="_blank"> %3$s</a> %4$s </p>',
                            esc_html__( 'Have you ❤ using Atento? Please rate ⭐⭐⭐⭐⭐ our theme', 'atento' ),
                            esc_url( 'https://wordpress.org/support/theme/atento/reviews/#new-post' ),
                            esc_html__( 'Atento', 'atento' ),
                            esc_html__( 'on WordPress.org ☺ Thank you', 'atento' )
                        );
                        ?>
                    </div>

                </div>
            </div>
            <?php
        }

        /**
         * Show Getting Started Content.
         */
        public function getting_started() { ?>

            <div id="getting_started" class="about-theme-tab active">
                <section>
                    <h3><?php esc_html_e( 'Documentation & Installation Guide', 'atento' ); ?></h3>

                    <p><?php esc_html_e( 'Theme documentation page will guide you to install and configure theme quick and easy. We have included details, screenshots and stepwise description about theme installation guides and tutorials.', 'atento' ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/docs/atento/' ); ?>" target="_blank"><?php esc_html_e( 'View Documentation', 'atento' ); ?></a></p>
                </section>

                <section>
                    <h3><?php esc_html_e( 'Support Forum', 'atento' ); ?></h3>

                    <p><?php esc_html_e( 'Need help to setup your website with Atento theme? Visit our support forum and browse support topics or create new, one of our support member will follow and help you to solver your issue.', 'atento' ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/support-forum/forum/atento/' ); ?>" target="_blank"><?php esc_html_e( 'Support Forum', 'atento' ); ?></a></p>
                </section>

                <section>
                    <h3><?php esc_html_e( 'Demo content', 'atento' ); ?></h3>

                    <h4><?php esc_html_e( 'Install:  One Click Demo Import', 'atento' ); ?></h4>
                    <p><?php esc_html_e( 'Install the following plugin and then come back here to access the importer. With it you can import all demo content and change your homepage and blog page to the ones from our demo site, automatically. It will also assign a menu.', 'atento' ); ?></p>

                    <?php if ( !class_exists('OCDI_Plugin') ) : ?>
                        <?php $odi_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=one-click-demo-import'), 'install-plugin_one-click-demo-import'); ?>
                        <p>
                            <a target="_blank" class="install-now button importer-install" href="<?php echo esc_url( $odi_url ); ?>"><?php esc_html_e( 'Install and Activate', 'atento' ); ?></a>
                            <a style="display:none;" class="button button-primary button-large importer-button" href="<?php echo esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import.php' ) ); ?>"><?php esc_html_e( 'Go to the importer', 'atento' ); ?></a>
                        </p>
                    <?php else : ?>
                        <p style="color:#23d423;font-style:italic;font-size:14px;"><?php esc_html_e( 'Plugin installed and active!', 'atento' ); ?></p>
                        <a class="button button-primary button-large" href="<?php echo esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import.php' ) ); ?>"><?php esc_html_e( 'Import Demo', 'atento' ); ?></a>
                    <?php endif; ?>

                    <br> <br>
                </section>

                <section>
                    <h3><?php esc_html_e( 'Theme Option & Customization', 'atento' ); ?></h3>

                    <p><?php esc_html_e( 'Most of theme settings customization options are available through theme customizer. To setup and customise your website elements and sections.', 'atento' ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><?php esc_html_e( 'Go to Customizer', 'atento' ); ?></a></p>
                </section>

            </div>
            <?php
        }

        /**
         * Show Getting Supports Content.
         */
        public function supports() { ?>

            <div id="support" class="about-theme-tab flex">
                <section>
                    <h3><?php esc_html_e( 'Support Forum', 'atento' ); ?></h3>

                    <p><?php esc_html_e( 'Need help to setup your website with Atento theme? Visit our support forum and browse support topics or create new, one of our support member will follow and help you to solver your issue.', 'atento' ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/support-forum/forum/atento/' ); ?>" target="_blank"><?php esc_html_e( 'Visit Support Forum', 'atento' ); ?></a></p>
                </section>
            </div>
            <?php
        }

        /**
         * Show Getting Supports Content.
         */
        public function free_vs_pro() { ?>

            <div id="free_vs_pro" class="about-theme-tab">
                <table>
                    <tr>
                        <td><?php esc_html_e( 'Theme Features', 'atento' ); ?></td>
                        <td><?php esc_html_e( 'Free Version', 'atento' ); ?></td>
                        <td><?php esc_html_e( 'Pro Version', 'atento' ); ?></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Coming Soon Page', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Top Header Bar', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Slide in Box', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Number of Header Layouts', 'atento' ); ?></td>
                        <td>1</td>
                        <td>7</td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced Header Settings', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Sticky Header', 'atento' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Smooth Page Scroll', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Hero Slider Support', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Featured Posts Slider for Homepage', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Built-in Custom Widgets', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Sticky Sidebar', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Unlimited Widget Area (Sidebar) Generator', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Unique Sidebar Selection', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Typography Option (850+ Google Fonts)', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Custom Responsive Values', 'atento' ); ?>
                            <br/><p class="description"><?php esc_html_e( 'Custom Responsive values for different screen size(Desktop, Tablet, Mobile).', 'atento' ); ?></p></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced Archive/Blog Settings', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Unique Page Header', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Post Navigation Layout', 'atento' ); ?></td>
                        <td class="redFeature">1</span></td>
                        <td class="greenFeature">3</span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Related Posts for blog/archive page', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced Post/Page Settings', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Social Share', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Advanced Post/Page Options', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>


                    <tr>
                        <td><?php esc_html_e( 'Advanced 404 Error Page Editor', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Footer Instagram Feed', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Pop up Box', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Number of Footer Widgets Position Layouts', 'atento' ); ?></td>
                        <td>1</td>
                        <td>10</td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Sortable Footer Bar Elements', 'atento' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Footer Copyright Editor', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Inbuilt Theme Widgets', 'atento' ); ?></td>
                        <td class="redFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Contact Form 7 Compatible', 'atento' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'MailChimp Compatible', 'atento' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'WPML Compatible', 'atento' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-no dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Polylang Support in Customizer', 'atento' ); ?></td>
                        <td class="greenFeature"><span class="dashicons dashicons-no-alt dash-red"></span></td>
                        <td class="greenFeature"><span class="dashicons dashicons-yes dash-green"></span></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Theme Support', 'atento' ); ?></td>
                        <td><?php esc_html_e( 'Support via Forum', 'atento' ); ?></td>
                        <td><?php esc_html_e( 'Quick Ticket Support', 'atento' ); ?></td>
                    </tr>
                </table>

                <br>
            </div>
            <?php
        }

        /**
         * Show Changelog Content.
         */
        public function changelog() {
            global $wp_filesystem; ?>

            <div id="changelog" class="about-theme-tab">
                <div class="wrap about-wrap">

                    <?php

                    $changelog_file = apply_filters( 'atento_changelog_file', get_template_directory() . '/readme.txt' );

                    // Check if the changelog file exists and is readable.
                    if ( $changelog_file && is_readable( $changelog_file ) ) {
                        WP_Filesystem();
                        $changelog = $wp_filesystem->get_contents( $changelog_file );
                        $changelog_list = $this->parse_changelog( $changelog );

                        echo wp_kses_post( $changelog_list );
                    }

                    ?>

                </div>
            </div>
            <?php
        }

        /**
         * Show Upgrade Pro Content.
         */
        public function upgrade_pro() { ?>

            <div id="upgrade_pro" class="about-theme-tab flex">
                <section>
                    <h3><?php esc_html_e( 'Upgrade to Pro', 'atento' ); ?></h3>

                    <p><?php esc_html_e( 'Need help to upgrade your website with Atento Pro theme for more exciting features and additional theme options.', 'atento' ); ?></p>

                    <p><a class="button button-primary button-large" href="<?php echo esc_url( 'https://precisethemes.com/wordpress-theme/atento-pro/' ); ?>" target="_blank"><?php esc_html_e( 'Upgrade to Pro', 'atento' ); ?></a></p>

                </section>
            </div>
            <?php
        }

        /**
         * Parse changelog from readme file.
         */
        private function parse_changelog( $content ) {
            $matches   = null;
            $regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
            $changelog = '';

            if ( preg_match( $regexp, $content, $matches ) ) {
                $changes = explode( '\r\n', trim( $matches[1] ) );

                $changelog .= '<pre class="changelog">';

                foreach ( $changes as $index => $line ) {
                    $changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
                }

                $changelog .= '</pre>';
            }

            return wp_kses_post( $changelog );
        }
    }

endif;

return new Atento_Welcome_Screen();
