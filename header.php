<?php
/**
 * The Header for our theme.
 *
 * Displays all of the head section and everything up till:
 *
 * @package WordPress
 * @subpackage NARGA Framework
 * @since NARGA Framework 1.0
 */
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
    <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
    <!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
    <!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
        <head <?php language_attributes(); ?>>
            <meta charset="<?php bloginfo('charset'); ?>">
            <title><?php wp_title( '|', true, 'right' ); ?></title>
            <link rel="profile" href="http://gmpg.org/xfn/11" />
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
            <!-- Mobile viewport optimized: j.mp/bplateviewport -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <!--  iOs Web App Home Screen and Favicon Icons -->
            <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/devices/narga-icon-ipad.png" />
            <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/devices/narga-icon-retina.png" />
            <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/devices/narga-icon.png" />
            <?php wp_head(); ?>
        </head>
        <body <?php body_class(); ?>>
            <!-- ZURB Foundation Topbar -->
            <div class="fixed">
                <div class="contain-to-grid">
                <nav role="navigation" class="top-bar">
                    <ul class="title-area">
                        <li class="name"><h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1></li>
                        <li class="toggle-topbar menu-icon"><a href="#"><span><?php _e( 'Menu', 'narga' ); ?></span></a></li>
                    </ul>
                    <section class="top-bar-section">
                        <!-- Left Nav Section -->
                        <?php narga_topbar_l(); ?>
                        <!-- Right Nav Section -->
                        <?php narga_topbar_r(); ?>
                        <?php if (get_theme_mod( 'topbar_search_form_toggle') == 'enable') { narga_search_form_navigation(); } else {echo (''); }?>
                    </section>
                </nav>
                </div>
            </div>

                <!-- Row for blog navigation -->
                <div id="site-header" class="row">
                    <?php narga_blog_head(); ?>
                </div>

                <!-- Row for main content area -->
                <section id="main" class="row" role="grid">
