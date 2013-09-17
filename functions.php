<?php
/**
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package NARGA
 * @since NARGA 1.0
 */

/* NARGA Assets */
require_once locate_template('/assets/customizer.php' );
require_once locate_template('/assets/topbar.php' );
require_once locate_template('/assets/jetpack.php' );
# Support Custom Header
require_once locate_template('/assets/custom-header.php');

/* NARGA Basic Setup */
if (!isset( $content_width))
    $content_width = 640;

function narga_setup() {
    # Add language supports. By default, this framework not include language files.
    load_theme_textdomain('narga', get_template_directory() . '/languages');

    # to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

    # Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(640, 290, true);
    
    # Support Custom Background
    add_theme_support( 'custom-background', array(
        'default-image' => '',  // background image default
	'default-color' => '', // background color default (dont add the #)
        'wp-head-callback' => '_custom_background_cb',
        'admin-head-callback' => '',
        'admin-preview-callback' => ''
    ));

    # Allows theme developers to add custom stylesheets to WordPress's TinyMCE visual editor. 
    add_editor_style( 'stylesheets/custom.css' );

    # Add post formarts supports. http://codex.wordpress.org/Post_Formats
    add_theme_support('post-formats', array (
        'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'chat'
    ));

    # Add menu supports. http://codex.wordpress.org/Function_Reference/register_nav_menus
    add_theme_support('menus');

    # Register Navigation
    register_nav_menus(array(
        'top-bar-l' => __('Top Bar', 'narga'),
        'footer_navigation' => __('Footer Navigation', 'narga')
    ));

    # Enables post and comment RSS feed links to head
    add_theme_support( 'automatic-feed-links' );
}
add_action('after_setup_theme', 'narga_setup');

/* ----------------------------------------
   :: Enqueue Scripts and Styles for Front-End
---------------------------------------- */
function narga_assets() {
    global $wp_styles;

    if ( !is_admin() ) {

        # Loads Foundation Main stylesheet
        wp_enqueue_style( 'foundation', get_template_directory_uri() . '/stylesheets/foundation.min.css', array(), '2013-08-12', false );

        # Load Google Fonts API
        wp_enqueue_style( 'google-font',"http://fonts.googleapis.com/css?family=Oswald|Open+Sans:400,400italic,700,700italic", array(), '2013-08-12', false );

        # Loads our main stylesheet.
        wp_enqueue_style( 'narga-style', get_stylesheet_uri(), array(), '2013-08-12'  );

        # Load JavaScripts
        wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/javascripts/vendor/custom.modernizr.js', array( 'jquery' ), '2.6.2', true );

        wp_enqueue_script( 'foundation', get_template_directory_uri() . '/javascripts/foundation.min.js', array( 'jquery' ), '4.3.1', true );

        wp_enqueue_script( 'narga', get_template_directory_uri() . '/javascripts/narga.js', array( 'jquery' ), '1.3.3', true );

        # Enable threaded comments 
        if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
            wp_enqueue_script('comment-reply');
    }
}
add_action( 'wp_enqueue_scripts', 'narga_assets' );

/**
 * Enqueue Zepto to footer
 * Idea by ZGani 
 * Since NARGA v1.4.0
 **/
if (!function_exists('narga_enqueue_zepto')) :
    function narga_enqueue_zepto(){
        echo '<!-- Check for Zepto support, load jQuery if necessary -->
            <script type="text/javascript">
document.write(\'<script src=' . get_template_directory_uri() . '/javascripts/vendor/\'
+ (\'__proto__\' in {} ? \'zepto\' : \'jquery\')
+ \'.min.js><\/script>\');
        </script>';
    } 
  add_action('wp_footer', 'narga_enqueue_zepto');
endif;

/**
 * Includes the pro and custom functions if it exists
 * Since NARGA v1.1
  **/
locate_template( array( 'assets/pro-functions.php', 'assets/custom-functions.php' ), true, false);
/* Load custom-actions.php file if it exists in the uploads folder */
$upload_dir = wp_upload_dir();
if(!defined('ACTION_FILE'))
define('ACTION_FILE', $upload_dir['basedir'].'/custom-functions.php');
if(file_exists(ACTION_FILE))
    include(ACTION_FILE);

/* Load custom.css file if it exists in the uploads folder */
    define('CSS_FILE', $upload_dir['basedir'].'/custom.css');
    define('CSS_DISPLAY', $upload_dir['baseurl'].'/custom.css');
if(file_exists(CSS_FILE))
    add_action("wp_print_styles", "add_custom_css_file", 99);
    function narga_add_custom_css_file() {
        wp_register_style('narga_custom_css', CSS_DISPLAY);
        wp_enqueue_style( 'narga_custom_css');
    }

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 * @since NARGA v1.3.3
 * @from Twenty Twelve
 */
function narga_content_width() {
        if ( is_page_template( 'templates/full-width.php' ) || is_attachment() ) {
                global $content_width;
                $content_width = 975;
        }
}
add_action( 'template_redirect', 'narga_content_width' );


/*
 * Header addition component: Add IE conditional HTML5  to header, favicon
 *
 * @since NARGA v1.6
 *
 */
if (!function_exists('narga_header_extra')) :  
function narga_header_extra () {
    # IE Conditional
    global $is_IE;
    if ($is_IE) {
        echo '<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
            chromium.org/developers/how-tos/chrome-frame-getting-started -->';
        echo '<!--[if lt IE 7]>';
        echo '<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>';
        echo '<script defer>window.attachEvent(\'onload\',function(){CFInstall.check({mode:\'overlay\'})})</script>';
        echo '<![endif]-->';
        echo '<!--[if lt IE 9]>';
        echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
        echo '<![endif]-->';
    }
    # Custom favicon
    if (narga_options('favicon') != '') :
        echo "\t" . '<link rel="shortcut icon" type="image/png" href="' . narga_options('favicon') . '">' . "\n";
    endif;
}
add_action('wp_head', 'narga_header_extra');
endif;

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * based on Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
if (!function_exists('narga_wp_title')) :  
    function narga_wp_title( $title, $sep ) {
        global $paged, $page;

        if ( is_feed() )
            return $title;

        // Add the site name.
        $title .= get_bloginfo( 'name' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";

        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', 'narga' ), max( $paged, $page ) );

        return $title;
    }
add_filter( 'wp_title', 'narga_wp_title', 10, 2 );
endif;


/**
 * Remove somethings not used or include in others functions
 * Since NARGA v1.1
 */
if (!function_exists('narga_remove_unused_items')) :  
    function narga_remove_unused_items() {  
        global $wp_widget_factory;
        # Remove recent comments css
        remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
    }
add_action( 'widgets_init', 'narga_remove_unused_items' ); 
endif;

/**
 * Return entry meta information for posts, used by multiple loops
 * Since NARGA v1.1
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

# Fix post sticky class conflict with topbar 
if (!function_exists('narga_fix_sticky_class')) :  
    function narga_fix_sticky_class($classes) {
        $classes = array_diff($classes, array("sticky"));
        return $classes;
    }
add_filter('post_class','narga_fix_sticky_class');
endif;

/**
 * Replace Read more link text
 *
 * Since NARGA v1.6
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
 * Since NARGA v1.1
 */
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

/**
 * Orbit Slider as Featured Post
 * function to render orbit slide based on featured category and number of slide in Customize.
 * Since NARGA v1.1
 */
if (!function_exists('narga_orbit_slider')) :  
    function narga_orbit_slider() {
        echo '<div class="orbit-container">
            <ul data-orbit data-options="bullets:false;resume_on_mouseout: true.;">';
        $args = array(
            'cat' => narga_options('featured_category'),
            'showposts' => narga_options('number_slide')
        );
        $narga_slider_query = new WP_Query($args);
        while ($narga_slider_query->have_posts()) : $narga_slider_query->the_post();
        if(has_post_thumbnail()) {
            echo '
                <li>';
            the_post_thumbnail('post-thumbnail', array( 'alt' => get_the_title(), 'title' => get_the_title(), 'data-caption' => '#htmlCaption-'.$narga_slider_query->current_post,));
        } elseif (! has_post_thumbnail()) {
            echo '
                <li><img width="640" height="290" src="' . get_template_directory_uri() . '/images/default-slide-image.png" class="attachment-post-thumbnail wp-post-image" alt="' . get_the_title() . '" title="' . get_the_title() . '" data-caption="#htmlCaption-' .$narga_slider_query->current_post . '" />';
        }
        echo '
            <div class="orbit-caption"><h3><a href="' . get_permalink(). '" ' . 'title="' . get_the_title() . '">' . get_the_title(). '</a></h3></div></li>' . "\n";
endwhile;
echo '</ul>';
if (narga_options('slide_indicator') == 1) :
    $i = 1;
echo '<ol class="orbit-bullets">';
for($i; $i <= narga_options('number_slide'); $i++) {
    echo '<li data-orbit-slide-number="' . $i . '"></li>';
}
echo '</ol>';
endif;
echo '</div>';
    }
endif;

/**
 * Rewrite default wordpress pagination function
 * Since NARGA v1.1
 **/
if (!function_exists('narga_pagination')) :  
    function narga_pagination() {
        global $wp_query;
        $big = 999999999; # This needs to be an unlikely integer
        $paginate_links = paginate_links( array(
            'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'mid_size' => 5,
            'prev_next' => true,
            'prev_text' => __('&laquo; Previous', 'narga'),
            'next_text' => __('Next &raquo;', 'narga'),
            'type' => 'list'
        ) );
        $search  = array('ul class=\'page-numbers', '<li><a class="next page-numbers"');
        $replace = array('ul class=\'pagination', '<li class="arrow"><a');
        echo '<nav id="post-nav" class="columns">' .str_replace($search, $replace, $paginate_links) . '</nav>';
    }
endif;

/**
 * Rewrite default wordpress comments pagination function
 * Since NARGA v1.1
 **/
if (!function_exists('narga_comment_pagination')) :  
    function narga_comment_pagination() {
        //read the page links but do not echo
        $comment_page = paginate_comments_links( array(
            'prev_text' => __('&laquo; Previous', 'narga'),
            'next_text' => __('Next &raquo;', 'narga'),
            'echo' => false, 
            'type' => 'list'
        ) );
        $search  = array('ul class=\'page-numbers', '<li><a class="next page-numbers"');
        $replace = array('ul class=\'pagination', '<li class="arrow"><a');
        echo '<nav id="comments-nav">' . str_replace($search, $replace,  $comment_page) . '</nav>';
    }
endif;

/**
 * Generator breadcrumbs with Foundation
 * Since NARGA v1.3.5
 **/
if (!function_exists('narga_breadcrumb')) :  
    function narga_breadcrumb() {
        if (!is_home()) {
            echo '<ul class="breadcrumbs"><li><a href="';
            echo home_url();
            echo '">';
            bloginfo('name');
            echo "</a></li>";
            if (is_category()) {
                the_category('<li>', '</li>');
            } elseif (is_page() || is_single()) {
                echo the_title('<li class="current">', '</li>');
            } 
            echo "</ul>";
        }
    }
endif;

/**
 * Removes the extra 10px of width from wp-caption and changes to HTML5 figure/figcaption
 * http://writings.orangegnome.com/writes/improved-html5-wordpress-captions/
 * Since NARGA v1.1.0
 **/
if (!function_exists('narga_img_caption_width_fix')) :
    function narga_img_caption_width_fix ($val, $attr, $content = null) {
        extract(shortcode_atts(array(
            'id'	=> '',
            'align'	=> '',
            'width'	=> '',
            'caption' => ''
        ), $attr));

        if ( 1 > (int) $width || empty($caption) )
            return $val;

        return '<figure id="' . $id . '" class="wp-caption ' . esc_attr($align) . '" style="width: ' . $width . 'px;">'
            . do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $caption . '</figcaption></figure>';
    }
add_filter('img_caption_shortcode', 'narga_img_caption_width_fix',10,3);
endif;

/**
 * Theme link to NARGA Help page
 * Since NARGA v1.1
 * (temporaty remove, adding in next version
 **/

?>
