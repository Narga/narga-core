<?php
/**
 * The main template file.
 * 
 * This is the most generic template file in a WordPress theme and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 * 
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.0
 **/
get_header(); ?>
<!-- Row for main content area -->
    <div id="main-content" class="large-8 columns <?php if (narga_options('sidebar_position') == 'right') : echo 'right'; endif; ?>" role="content">
<?php 
if (is_front_page() && !is_paged() && narga_options('featured_category') != '-1') :
    echo '<div id="orbit-slider">';
    narga_orbit_slider();
    echo '</div>';
endif;
?>
    <?php if (!have_posts()) : ?>
    <div class="notice">
        <p class="bottom"><?php _e('Sorry, no results were found.', 'narga'); ?></p>
    </div>
    <?php get_search_form(); ?>
    <?php endif; ?>

    <?php /* Start loop */ ?>
    <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('content', get_post_format()); ?>
    <?php endwhile; // End the loop ?>
    <?php /* Display navigation to next/previous pages when applicable */ ?>
    <?php if ( function_exists('narga_pagination') ) { narga_pagination(); } else if ( is_paged() ) { ?>
    <nav id="post-nav">
        <div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'narga' ) ); ?></div>
        <div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'narga' ) ); ?></div>
    </nav>
    <?php } ?>
</div><!-- End Content row -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
