<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class() ?> id="post-<?php the_ID(); ?>" role="article">
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php narga_entry_meta(); ?>
		</header>
		<section class="entry-content">
			<?php the_content(); ?>
		</section>
		<footer>
			<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'narga'), 'after' => '</p></nav>' )); ?>
			<p class="tags"><?php the_tags('<span class="radius label">','</span> <span class="radius label">','</span>'); ?></p>
		</footer>
		<?php comments_template(); ?>
	</article>
<?php endwhile; // End the loop ?>
