<?php
/**
 * The template used for displaying page content in page.php
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.2
 **/
?>

<?php while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <h1><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'View %s', 'narga' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
    </header>
    <section class="entry-content">
        <?php the_content(); ?>
        <div class="clearfix"></div>
        <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'narga'), 'after' => '</p></nav>' )); ?>
    </section>
</article>	
<?php endwhile; // End the loop ?>
