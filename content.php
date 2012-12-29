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
    <h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'View %s', 'narga' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <?php narga_entry_meta(); ?>
    </header>
    <?php if(!is_singular()) {narga_post_thumbnail();} ?>
    <section class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'narga'), 'after' => '</p></nav>' )); ?>
    </section>
</article>
