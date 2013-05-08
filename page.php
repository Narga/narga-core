<?php
/**
* The template for displaying all pages.
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site will use a
* different template.
*
* @package NARGA Framework
* @since NARGA Framework 1.0
*/
?>
<?php get_header(); ?>
<!-- Row for main content area -->
<div id="page-content-wrapper" class="large-8 columns" role="content">
        <?php get_template_part('content', 'page'); ?>
        <?php comments_template( '', true ); ?>
</div><!-- End Content row -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
