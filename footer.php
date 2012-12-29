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
       </div>
<!-- End of the main container -->
<!-- Footer content area -->
                <footer id="content-info" role="contentinfo">
                        <div class="row">
                                <?php dynamic_sidebar("Footer"); ?>
                        </div>
                        <div class="row">
                                <div class="twelve columns">
                                        <p class="text-center">Powered by <a href="http://www.wordpress.org/" title="WordPress">WordPress</a> and <a href="http://www.narga.net/" title="Narga WordPress Framework">Narga</a>. &copy; <?php echo date('Y'); ?>. All rights reserved.</p>
                                </div>
                        </div>
                </footer>

 <?php wp_footer(); ?>
</body>
</html>
