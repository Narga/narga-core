<?php get_header(); ?>
    <!-- Row for main content area -->
    <div class="eight columns single-content-wrapper">
    <div class="post-box">
    <?php get_template_part('loop', 'single'); ?>
    </div>
    </div>
    <!-- End Content row -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
