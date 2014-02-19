<?php
/**
 * The Header for our theme.
 * Displays all of the head section and everything up till.
 *
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.0
 **/
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if gt IE 8]>
<!--> <html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head <?php language_attributes(); ?>>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <!-- Mobile viewport optimized: j.mp/bplateviewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <!-- ZURB Foundation Top Bar -->
    <?php narga_topbar() ?>

    <!-- Header: include logo, top ads ... -->
    <?php narga_header(); ?>    

    <!-- Main content area -->
    <section id="main" class="row" role="grid">
