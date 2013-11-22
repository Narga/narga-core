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
 * Custom Post Excerpt
 * This function will auto create post excerpt from content if it's not exist. 
 * Allow user can change the number of words in Customization Panel
 *
 * @since NARGA v1.6
 */
# Function to trim the excerpt
if (!function_exists('narga_excerpts')) :
    function narga_excerpts($text = false) {
        # If is the home page, an archive, or search results
        if(!is_singular()) :
            global $post;
            $excerpt_length = narga_options('excerpt_length');
            $text = $post->post_excerpt;
            # If an excerpt is set in the Optional Excerpt box
            if ( empty($post->post_excerpt) ) {
                $content = $post->post_content;
                if (false == get_post_format() || count($content) > $excerpt_length) {
                    $content = str_replace('\]\]\>', ']]&gt;', $content);
                    $content = preg_replace('@<script[^>]*?>.*?</script>@si', '', $content);
                    $content = strip_shortcodes($content);
                    $content = strip_tags($content, '<p>');
                    $words = explode(' ', $content, $excerpt_length + 1);
                    if (count($words)> $excerpt_length) {
                        array_pop($words);
                        array_push($words, '...<br><a href="'.get_permalink($post->ID) .'" class="more-link">' . __('Continue Reading »', 'narga') . '</a>');
                        $text = wpautop(implode(' ', $words));
                    }
                }
            } else {
                $text = apply_filters('the_excerpt', $text);
            }
            endif;
            # Make sure to return the content
            return $text;
    }

# Replace content with excerpt
if (narga_options('excerpt_length') != '0') :
    remove_filter('get_the_excerpt', 'wp_trim_excerpt');
    add_filter('the_content', 'narga_excerpts');
endif;
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
