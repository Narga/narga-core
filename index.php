<?php get_header(); ?>

                <!-- Row for main content area -->
                <div id="content" class="eight">
                    <?php if (get_theme_mod( 'slide_toggle') == 'enable') {narga_orbit_slider();} else {echo (''); }?>
                        <div class="post-box">
                                <?php get_template_part('loop', 'index'); ?>
                        </div>

                </div><!-- End Content row -->

                <?php get_sidebar(); ?>

<?php get_footer(); ?>
