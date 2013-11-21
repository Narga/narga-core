<?php
/**
 * The template for displaying Archive pages.
 * Used to display archive-type pages if nothing more specific matches a query. For example, puts together date-based pages if no date.php file exists.
 * If you'd like to further customize these archive views, you may create a new template file for each specific one.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 * 
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.0
 **/
?>

<?php get_header(); ?>
<!-- Row for main content area -->
<div id="archive-wrapper" class="large-8 columns" role="content">
    <?php #Breadcrumb Control
    if (narga_options('breadcrumb') == 1) :
    narga_breadcrumb();
    endif;
    ?>

    <h2><?php if ( is_day() ) : printf( __( 'Daily Archives: %s', 'narga' ), '<span>' . get_the_date() . '</span>' );
        elseif ( is_month() ) :
        printf( __( 'Monthly Archives: %s', 'narga' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'narga' ) ) . '</span>' );
        elseif ( is_year() ) :
        printf( __( 'Yearly Archives: %s', 'narga' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'narga' ) ) . '</span>' );
        else :
        single_cat_title();
        endif;?></h2>
    <hr>
    <?php while (have_posts()) : the_post();
    get_template_part('content', get_post_format());
    endwhile; // End the loop ?>
    <?php /* Display navigation to next/previous pages when applicable */
    if ( function_exists('narga_pagination') ) { narga_pagination(); } else if ( is_paged() ) { ?>
    <nav id="post-nav">
        <div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'narga' ) ); ?></div>
        <div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'narga' ) ); ?></div>
    </nav>
    <?php } ?>
</div><!-- End Content row -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
