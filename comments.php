<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to narga_comment() which is
 * located in the inc/template-tags.php file.
 * 
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.0
*/

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die (__('Please do not load this page directly. Thanks!', 'narga'));
/*
* If the current post is protected by a password and
* the visitor has not yet entered the password we will
* return early without loading the comments.
*/

if ( post_password_required() ) { ?>
<section id="comments">
    <div class="notice">
        <p class="bottom"><?php _e('This post is password protected. Enter the password to view comments.', 'narga'); ?></p>
    </div>
</section>
<?php
return;
}
?>
<?php // You can start editing here. Customize the respond form below ?>
<?php if ( have_comments() ) : ?>
<section id="comments">
    <h3 class="comments-title">		    
        <?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'narga' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );?>
    </h3>

    <ol class="commentlist">
        <?php wp_list_comments( array( 'callback' => 'narga_comments', 'style' => 'ol' ) ); ?>
    </ol>

    <footer>
        <?php if ( function_exists('narga_comment_pagination') ) { narga_comment_pagination(); } else  { ?>
        <nav id="comments-nav">
            <?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;')); ?> 
        </nav>
        <?php } ?>
    </footer>
</section>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ( comments_open() ) : ?>
<?php else : // comments are closed ?>
<section id="comments">
    <div class="notice">
        <p class="bottom"><?php _e('Comments are closed.', 'narga') ?></p>
    </div>
</section>
<?php endif; ?>

<?php endif; // have_comments() ?>

<?php comment_form(); ?>
