<?php
/**
* The template for displaying posts in the Audio post format
*
* @package WordPress
* @subpackage NARGA Framework
* @since NARGA Framework 1.2
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <section class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'narga'), 'after' => '</p></nav>' )); ?>
    </section>
    <footer>
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'View %s', 'narga' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="audio-post-title" rel="bookmark"><?php the_title(); ?></a>
        <?php narga_entry_meta(); ?>
        <?php if ( comments_open() ) : ?>
        <div class="comments-link">
            <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'narga' ) . '</span>', __( '1 Reply', 'narga' ), __( '% Replies', 'narga' ) ); ?>
        </div><!-- .comments-link -->
        <?php endif; // comments_open() ?>
    </footer><!-- .entry-meta -->
</article><!-- #post -->
