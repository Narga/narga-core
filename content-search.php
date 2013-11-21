<?php
/**
 * The template for displaying Search Results pages.
 * 
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.0
 **/
?>

<?php if (!have_posts()) : ?>
<div class="notice">
    <p class="bottom"><?php _e('Sorry, no results were found.', 'narga'); ?></p>
</div>
<?php get_search_form(); ?>	
<?php endif; ?>

<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'View %s', 'narga' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <?php narga_entry_meta(); ?>	
    </header>
    <section class="entry-content">
        <?php if (is_archive() || is_search()) : // Only display excerpts for archives and search ?>
        <?php the_excerpt(); ?>
        <?php else : ?>
        <?php the_content( __( 'Continue reading &rarr;', 'narga' ) ); ?>
        <?php endif; ?>
    </section>
    <footer>
        <?php $tag = get_the_tags(); if (!$tag) { } else { ?><p><?php the_tags(); ?></p><?php } ?>
    </footer>
</article>

<?php endwhile; // End the loop ?>

