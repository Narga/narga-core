<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
        <div class="notice">
                <p class="bottom"><?php _e('Sorry, no results were found.', 'narga'); ?></p>
        </div>
        <?php get_search_form(); ?>
<?php endif; ?>

<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
                <header>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php if (has_post_thumbnail()) {?><div class="post-thumb"><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('grid-post-thumbnails'); ?></a></div><?php } else { echo "<img src=\"http://placehold.it/360x140&amp;text=No%20Image\" alt=\"No Image\" title=\"No Image\" />"; } ?>
                        <?php narga_entry_meta(); ?>
                </header>
                <section class="entry-content">
        <?php if (is_archive() || is_search()) : // Only display excerpts for archives and search ?>
                <?php the_excerpt(); ?>
        <?php else : ?>
                <?php the_content('Continue reading...'); ?>
        <?php endif; ?>
                </section>
        </article>	
<?php endwhile; // End the loop ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( function_exists('narga_pagination') ) { narga_pagination(); } else if ( is_paged() ) { ?>
<nav id="post-nav">
        <div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'narga' ) ); ?></div>
        <div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'narga' ) ); ?></div>
</nav>
<?php } ?>
