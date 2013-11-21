<?php
/**
 * The template for displaying Search Results pages.
 * 
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.0
 **/
?>

<?php get_header(); ?>
<!-- Row for main content area -->
<div id="search-wrapper" class="large-8 columns" role="content">
    <div class="post-box">
        <h2><?php _e('Search Results for', 'narga'); ?> "<?php echo get_search_query(); ?>"</h2>
        <?php get_template_part('content', 'search'); ?>
    </div>
</div><!-- End Content row -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
