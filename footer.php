<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the #main and #page div elements.
 * 
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.0
 **/
?>

<!-- End row for main content area -->
    </section>

    <!-- Footer area -->
    <footer role="contentinfo" class="row">
    <div id="footer-widgets" class="footer-info hide-for-small">
    <?php dynamic_sidebar("Footer"); ?>
    <div class="colophon">
    <hr />
        <div class="large-6 columns">
        <?php printf( __('<p>Proudly powered by <a href="http://wordpress.org/" title="%1$s" rel="generator">%2$s</a> &middot; <a href="http://www.narga.net/" title="%3$s" rel="designer">%4$s</a>.</p>', 'narga'), esc_attr( 'A Semantic Personal Publishing Platform'), 'WordPress', esc_attr( 'NARGA'), 'NARGA'); ?>
        </div>
        <div class="large-6 columns hide-for-medium">
        <?php narga_footer_navigation(); ?>
        </div>
    </div>
    </div>
    </footer>
<?php wp_footer(); ?>
</body>
</html>

