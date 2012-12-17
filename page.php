<?php get_header(); ?>
    <!-- Row for main content area -->
    <div id="content" class="eight columns page-content-wrapper">
    <div class="post-box">
    <?php get_template_part('loop', 'page'); ?>
    </div>
    </div><!-- End Content row -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
