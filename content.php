<?php
/**
* The default template for displaying content. Used for both single and index/archive/search.
*
* @package WordPress
* @subpackage NARGA Framework
* @since NARGA Framework 1.2
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
    <header>
    <?php if ( is_single() ) : ?>
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <?php else : ?>
    <h2 class="entry-title">
    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'View %s', 'narga' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
    <?php endif; // is_single() ?>
    <?php narga_entry_meta(); ?>
    </header>
    <section class="entry-content<?php if ( has_post_format( 'video' )) {echo ' flex-video';}?>">
        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'narga' ) ); ?>
    </section>
    <footer>
        <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'narga'), 'after' => '</p></nav>' )); ?>
        <?php if(is_singular()) { ?>                   
        <p class="tags"><?php the_tags('<span class="radius label">','</span> <span class="radius label">','</span>'); ?></p>
        <div class="post-author">
            <h3><?php _e('About the Author &#151; ', 'narga'); ?><?php the_author_posts_link(); ?></h3>
            <p><?php echo get_avatar(get_the_author_meta('ID'), '80', '', 'The author avatar'); echo get_the_author_meta("description");?></p>
        </div>
        <?php } ?>
    </footer>
</article>
