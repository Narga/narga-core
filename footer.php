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

            <!-- End of the main container -->
        </div>
        <!-- Footer area -->
        <footer class="row" role="contentinfo">
            <div class="large-12 columns">
                <hr />
                <div class="row">
                    <div class="large-6 columns">
                        <?php printf( __('Proudly powered by <a href="http://wordpress.org/" title="%1$s" rel="generator">%2$s</a> &middot; <a href="http://www.narga.net/" title="%3$s" rel="designer">%4$s</a>.', 'narga'), esc_attr( 'A Semantic Personal Publishing Platform'), 'WordPress', esc_attr( 'A responsive WordPress Framework'), 'NARGA'); ?>
                    </div>
                    <div class="large-6 columns">
                        <?php narga_footer_navigation(); ?>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Check for Zepto support, load jQuery if necessary -->
        <script>
            document.write('<script src=<?php echo get_template_directory_uri(); ?>/javascripts/vendor/'
                + ('__proto__' in {} ? 'zepto' : 'jquery')
                + '.js><\/script>');
            </script>
            <?php wp_footer(); ?>
        </body>
    </html>
