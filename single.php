<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage NARGA Framework
 * @since NARGA Framework 1.0
 */
?>

<?php get_header(); ?>
    <!-- Row for main content area -->
    <div class="eight columns single-content-wrapper">
    <div class="post-box">
    <?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part('content', get_post_format()); ?>
    <?php endwhile; // end of the loop. ?>
   <?php comments_template( '', true ); ?>
    </div>
    </div>
    <!-- End Content row -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
