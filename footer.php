<?php
/**
* The template for displaying the footer.
*
* Contains footer content and the closing of the
* #main and #page div elements.
*
* @package WordPress
* @subpackage NARGA Framework
* @since NARGA Framework 1.0
*/
?>

<!-- End row for main content area -->
            </section>		

        <!-- Footer area -->
        <footer role="contentinfo">
            <div id="footer-widgets" class="row">
                <?php dynamic_sidebar("Footer"); ?>
            </div>
                <div class="row full-width" id="footer-info">
                <hr />
                    <div class="small-12 large-4 columns">
                        <?php printf( __('<p>Proudly powered by <a href="http://wordpress.org/" title="%1$s" rel="generator">%2$s</a> &middot; <a href="http://www.narga.net/" title="%3$s" rel="designer">%4$s</a>.</p>', 'narga'), esc_attr( 'A Semantic Personal Publishing Platform'), 'WordPress', esc_attr( 'A responsive WordPress Framework'), 'NARGA'); ?>
                    </div>
                    <div class="small-12 large-8 columns">
                        <?php narga_footer_navigation(); ?>
                    </div>
            </div>
        </footer>
            <?php wp_footer(); ?>
        </body>
    </html>
