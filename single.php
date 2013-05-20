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
<div id="single-content-wrapper" class="large-8 small-12 columns" role="content">
        <?php narga_breadcrumb(); ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part('content', get_post_format()); ?>
        <?php endwhile; // end of the loop. ?>
	<nav class="nav-single">
	    <h3 class="assistive-text"><?php _e( 'Post navigation', 'narga' ); ?></h3>
	    <span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'narga' ) . '</span> %title' ); ?></span>
	    <span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'narga' ) . '</span>' ); ?></span>
	</nav>      
        <?php comments_template( '', true ); ?>
</div>
<!-- End Content row -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
