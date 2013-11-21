<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: NARGA loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.0
 */
get_header(); ?>
    <!-- Row for main content area -->
    <div id="full-width-wrapper" class="large-12 columns" role="content">
    <?php get_template_part('content', 'page'); ?>
    </div><!-- End Content row -->
<?php get_footer(); ?>
