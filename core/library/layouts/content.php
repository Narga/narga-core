<?php
/**
 * Content related functions
 *
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.8
 */

/**
 * Return entry meta information for posts, used by multiple loops
 *
 * @since NARGA v1.1
 */
if (!function_exists('narga_entry_meta')) :  
    function narga_entry_meta() {
        echo '<p class="post-meta-data">';
        if (comments_open()) :
            echo ' <span class="entry-comments right">';
        comments_popup_link( __( 'No comment', 'narga' ), __( '1 comment', 'narga'),  __( '% comments', 'narga' ),  __( 'comments-link', 'narga' ),  __( 'Comments are off for this post', 'narga' ));
        echo '</span>';
        endif;
        echo '<a href="' . get_permalink() . '" title="' . get_the_time() . '" rel="bookmark"><time class="updated" datetime="'. get_the_time('c') .'">'. sprintf(__('%s', 'narga'), get_the_time('M jS, Y'), get_the_time()) .'</time></a>';
        if (false === get_post_format()) {
            echo __(' in ', 'narga') .'<span class="entry-categories">' . get_the_category_list( ', ' ) . '</span> <span class="byline author">' . __(' by ', 'narga') . '<a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .'</a></span>';            
        } else {
            echo '';
        }
        edit_post_link(__('Edit', 'narga'), ' | ', '');
        echo '</p>';
    }
endif;

/**
 * Replace Read more link text
 *
 * @since NARGA v1.6
 */
if (!function_exists('narga_more_link')) :  
    function narga_more_link( $more_link, $more_link_text ) {
        $readmore = narga_options(post_readmore);
        return str_replace( $more_link_text, $readmore, $more_link );
    }
    add_filter( 'the_content_more_link', 'narga_more_link', 10, 2 );
endif;

/**
 * WordPress Comments Adjustment
 *
 * @since NARGA v1.1
 **/

if (!function_exists('narga_comments')) :  
    function narga_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
                case 'pingback' :
                case 'trackback' :
                // Display trackbacks differently than normal comments.
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php _e( 'Pingback:', 'narga' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'narga' ), '<span class="edit-link">', '</span>' ); ?></p>
<?php
                    break;
                default :
                    // Proceed with normal comments.
                    global $post;
                    echo '<li ';
                    comment_class();
                    echo '>
                        <article id="comment-' . get_comment_ID() . '" class="comment">
                        <header>
                        <div class="comment-author vcard">';
                    echo get_avatar($comment,64);
                    printf(__('<cite class="fn">%s</cite>', 'narga'), get_comment_author_link(),
                        // If current post author is also comment author, make it known visually.
                        ( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'narga' ) . '</span>' : '');
                    echo '<div class="comment-meta">
                        <time datetime="' . get_comment_date('c') . '"  itemprop="commentTime"><a itemprop="url" href="' . htmlspecialchars( get_comment_link( $comment->comment_ID ) ) . '">';
                    printf(__('%1$s', 'narga'), get_comment_date(),  get_comment_time());
                    echo '</a></time>
                        </div>
                        </div>
                        </header>
                        <section itemprop="commentText" class="comment">';
                    if ($comment->comment_approved == '0') : 
                        echo '<div class="comment-awaiting-moderation">';
                    _e('Your comment is awaiting moderation.', 'narga');
                    echo '</div>';
endif;
comment_text();
$id = $comment->comment_ID;
edit_comment_link(__('Edit', 'narga'), '<a class="comment-del-link" href="'.admin_url("comment.php?action=cdc&c=$id").'">' . __( 'Del', 'narga' ) . '</a> ', '<a class="comment-spam-link" href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">' . __( 'Spam', 'narga' ) . '</a>');
echo '<span class="reply">';
comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'narga' ), 'after' => '<span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
echo '</span>
    </section>
    </article>';
break;
endswitch; // end comment_type check
    }
endif;

?>
