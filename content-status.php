<?php
/**
 * The template for displaying posts in the Status post format
 * 
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.2
 **/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <hgroup>
            <h2><?php the_author(); ?></h2>
            <h3><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'narga' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a></h3>
        </hgroup>
        <?php echo get_avatar(get_the_author_meta('ID'), '48', '', 'The author avatar');?>
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'View %s', 'narga' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="radius label right status-post-title" rel="bookmark"><?php _e( 'Status', 'narga' ); ?></a>
    </header>

    <section class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'narga'), 'after' => '</p></nav>' )); ?>
    </section>
    <footer>
        <?php if ( comments_open() ) : ?>
        <div class="comments-link">
            <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'narga' ) . '</span>', __( '1 Reply', 'narga' ), __( '% Replies', 'narga' ) ); ?>
        </div><!-- .comments-link -->
        <?php endif; // comments_open() ?>
    </footer><!-- .entry-meta -->
</article><!-- #post -->
