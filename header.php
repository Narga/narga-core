<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Favicon and Feed -->
<link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

<!--  iOs Web App Home Screen Icon -->
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/devices/narga-icon-ipad.png" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/devices/narga-icon-retina.png" />
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/devices/narga-icon.png" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php wp_head(); ?>
<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/javascripts/jquery.min.js"><\/script>')</script>
</head>

<body <?php body_class(); ?>>
<!-- Start the main container -->
<div id="container" class="container" role="document">

<!-- start top bar -->
<div class="top-bar-container fixed contain-to-grid">
    <nav role="navigation" class="top-bar">
        <ul>
            <li class="toggle-topbar"><a href="#"></a></li>
        </ul>
        <section><?php narga_topbar_l(); ?><?php narga_topbar_r(); ?><?php if (get_theme_mod( 'topbar_search_form_toggle') == 'enable') { search_form_navigation(); } else {echo (''); }?></section>
    </nav>
</div>

<!-- Row for blog navigation -->
<div class="row top-header">
    <header class="twelve columns" role="banner">
        <?php narga_blog_head(); ?>
    </header>
</div>

<!-- Row for main content area -->
<div class="row">

<section id="main" role="main">
