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
<div id="single-content" class="large-8 columns" role="content">
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
