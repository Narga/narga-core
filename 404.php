<?php
/**
 * The template for displaying 404 pages (Not Found).
index/archive/search.
 *
 * @package WordPress
 * @subpackage NARGA Framework
 * @since NARGA Framework 1.0
 */


get_header(); ?>
<!-- Row for main content area -->
<div id="content" class="eight columns">
    <div class="post-box">
        <h2><?php _e('Sorry, the page you were looking for does not exist.', 'narga'); ?></h2>
        <div class="error">
            <p class="bottom"><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'narga'); ?></p>
        </div>
        <p><?php _e('We couldn\'t find that page. If you think this was an error on our part, please let us know. If not, maybe these links will help you:', 'narga'); ?></p>
        <ul> 
            <li><?php _e('Check your spelling', 'narga'); ?></li>
            <li><?php printf(__('Return to the <a href="%s">home page</a>', 'narga'), home_url()); ?></li>
            <li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'narga'); ?></li>
        </ul>
    </div>

</div><!-- End Content row -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
