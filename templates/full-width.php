<?php
/*
Template Name: Full Width
*/
get_header(); ?>
    <!-- Row for main content area -->
    <div id="content" class="twelve columns full-width-content-wrapper">
    <div class="post-box">
    <?php get_template_part('loop', 'page'); ?>
    </div>
    </div><!-- End Content row -->
<?php get_footer(); ?>
