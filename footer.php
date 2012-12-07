                </section>		
<!-- End row for main content area -->
                </div>		
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

        </div><!-- Container End -->

        <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
             chromium.org/developers/how-tos/chrome-frame-getting-started -->
        <!--[if lt IE 7]>
<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->

<?php wp_footer(); ?>
</body>
</html>
