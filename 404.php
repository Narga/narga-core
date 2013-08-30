<?php
/**
* The template for displaying 404 pages (Not Found).
index/archive/search.
*
* @package WordPress
* @subpackage NARGA
* @since 1.0
*/
get_header(); ?>
<!-- Row for main content area -->
<div id="404-wrapper" class="large-8 columns">
    <div class="post-box">
        <article id="post-0" class="post error404 no-results not-found">
            <header class="entry-header">
                <h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'narga' ); ?></h1>
            </header>

            <div class="entry-content">
                <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'narga' ); ?></p>
                <?php get_search_form(); ?>
            </div><!-- .entry-content -->
        </article><!-- #post-0 -->

    </div>

</div><!-- End Content row -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
