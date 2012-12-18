<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <h2 class="entry-title"><?php the_title(); ?></h2>
    </header>
    <section class="entry-content">
    <?php the_content(); ?>
    <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'narga'), 'after' => '</p></nav>' )); ?>
    </section>
</article>	
<?php endwhile; // End the loop ?>
