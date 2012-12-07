<?php function narga_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?>>
                <article id="comment-<?php comment_ID(); ?>">
                        <header class="comment-author vcard">
                                <?php echo get_avatar($comment,$size='64'); ?>
                                <?php printf(__('<cite class="fn">%s</cite>', 'narga'), get_comment_author_link()) ?>
                                <time datetime="<?php echo comment_date('c') ?>"  itemprop="commentTime"><a itemprop="url" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s', 'narga'), get_comment_date(),  get_comment_time()) ?></a></time>
                        </header>

                        <section itemprop="commentText" class="comment">
<?php comment_text() ?>
<?php if ($comment->comment_approved == '0') : ?><div class=" alert label"><?php _e('Your comment is awaiting moderation.', 'narga') ?></div><?php endif; ?>
</section>
                        <?php edit_comment_link(__('Edit', 'narga'), '', '') ?> 			
                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </article>
<?php } ?>

<?php
    // Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die (__('Please do not load this page directly. Thanks!', 'narga'));

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
                <h3><?php comments_number(__('No Responses to', 'narga'), __('One Response to', 'narga'), __('% Responses to', 'narga') ); ?> &#8220;<?php the_title(); ?>&#8221;</h3>
                <ol class="commentlist">
                <?php wp_list_comments('type=comment&callback=narga_comments'); ?>

                </ol>
                <footer>
                        <nav id="comments-nav">
                                <div class="comments-previous"><?php previous_comments_link( __( '&larr; Older comments', 'narga' ) ); ?></div>
                                <div class="comments-next"><?php next_comments_link( __( 'Newer comments &rarr;', 'narga' ) ); ?></div>
                        </nav>
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
<?php endif; ?>
<?php if ( comments_open() ) : ?>
<section id="respond">
        <h3><?php comment_form_title( __('Leave a Reply', 'narga'), __('Leave a Reply to %s', 'narga') ); ?></h3>
        <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
        <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
        <p><?php printf( __('You must be <a href="%s">logged in</a> to post a comment.', 'narga'), wp_login_url( get_permalink() ) ); ?></p>
        <?php else : ?>
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                <?php if ( is_user_logged_in() ) : ?>
                <p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'narga'), get_option('siteurl'), $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'narga'); ?>"><?php _e('Log out &raquo;', 'narga'); ?></a></p>
                <?php else : ?>
                <p>
                        <label for="author"><?php _e('Name', 'narga'); if ($req) _e(' (required)', 'narga'); ?></label>
                        <input type="text" class="five" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>>
                </p>
                <p>
                        <label for="email"><?php _e('Email (will not be published)', 'narga'); if ($req) _e(' (required)', 'narga'); ?></label>
                        <input type="text" class="five" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>>
                </p>
                <p>
                        <label for="url"><?php _e('Website', 'narga'); ?></label>
                        <input type="text" class="five" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3">
                </p>
                <?php endif; ?>
                <p>
                        <label for="comment"><?php _e('Comment', 'narga'); ?></label>
                        <textarea name="comment" id="comment" tabindex="4"></textarea>
                </p>
                <p id="allowed_tags" class="small"><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></p>
                <p><input name="submit" class="radius medium button" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'narga'); ?>"></p>
                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', $post->ID); ?>
        </form>
        <?php endif; // If registration required and not logged in ?>
</section>
<?php endif; // if you delete this the sky will fall on your head ?>
