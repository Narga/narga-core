<?php
/**
 * The Template for displaying all single posts.
 * 
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.0
 **/
?>

<?php get_header(); ?>
<!-- Row for main content area -->
<div id="single-content-wrapper" class="large-8 small-12 columns" role="content">
<?php #Breadcrumb Control
if (narga_options('breadcrumb') == 1) :
    narga_breadcrumb();
endif;
?>

<?php
while ( have_posts() ) : the_post();
    get_template_part('content', get_post_format());
endwhile;
?>

    <?php comments_template( '', true ); ?>
</div>
<!-- End Content row -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
