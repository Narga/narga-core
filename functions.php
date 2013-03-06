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
 * @package WordPress
 * @subpackage NARGA Framework
 * @since NARGA Framework 1.0
 */

/*  ------------------------------------
:: Narga WordPress Framework Basic Setup
------------------------------------- */
if (!isset( $content_width))
    $content_width = 764;

function narga_setup() {

    # Add language supports. By default, this framework not include language files.
    load_theme_textdomain('narga', get_template_directory() . '/languages');

    # Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(764, 342, true);
    add_image_size( 'grid-post-thumbnails', 346, 135, true);

    # Support Custom Background
    add_theme_support( 'custom-background' );

    # Allows theme developers to add custom stylesheets to WordPress's TinyMCE visual editor. 
    add_editor_style( 'stylesheets/custom.css' );

    # Add post formarts supports. http://codex.wordpress.org/Post_Formats
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

    # Add menu supports. http://codex.wordpress.org/Function_Reference/register_nav_menus
    add_theme_support('menus');
    register_nav_menus(array(
        'top-bar-l' => __('Left Top Bar', 'narga'),
        'top-bar-r' => __('Right Top Bar', 'narga'),
        'secondary_navigation' => __('Secondary Navigation', 'narga')
    ));

    # Enables post and comment RSS feed links to head
    add_theme_support( 'automatic-feed-links' );
}
add_action('after_setup_theme', 'narga_setup');

/* ----------------------------------------
:: Enqueue Scripts and Styles for Front-End
---------------------------------------- */
function narga_assets() {
    if ( !is_admin() ) {
        wp_register_style( 'foundation',get_template_directory_uri() . '/stylesheets/foundation.min.css', false );
        wp_enqueue_style( 'foundation' );

        wp_register_style( 'app',get_template_directory_uri() . '/stylesheets/app.css', false );
        wp_enqueue_style( 'app' );

        # Load style.css to allow contents overwrite foundation & app css
        wp_register_style( 'style',get_template_directory_uri() . '/style.css', false );
        wp_enqueue_style( 'style' );

        # Load Google Fonts API
        wp_register_style( 'google-font',"http://fonts.googleapis.com/css?family=Oswald|Open+Sans:400,400italic,700,700italic", false );
        wp_enqueue_style( 'google-font' );

        # Enqueue to header
        wp_deregister_script( 'jquery' );
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', array(), '1.8.3', false);
        wp_enqueue_script( 'jquery' );

        # Load JavaScripts
        wp_enqueue_script( 'narga', get_template_directory_uri() . '/javascripts/narga.js', array(), '1.0', false );
        wp_enqueue_script( 'foundation', get_template_directory_uri() . '/javascripts/foundation.min.js', array(), '1.0', true );
        wp_enqueue_script( 'app', get_template_directory_uri().'/javascripts/app.js', array('foundation'), '1.0', true );

        # Enable threaded comments 
        if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
            wp_enqueue_script('comment-reply');
    }
}
add_action( 'init', 'narga_assets' );

/* ---------------------------------------------------------------
::  Includes the pro and custom functions if it exists
--------------------------------------------------------------- */
locate_template( array( 'assets/pro-functions.php', 'assets/custom-functions.php' ), true, false);
/* ---------------------------------------------------------------
:: Load custom-actions.php file if it exists in the uploads folder
:: Brought from PressWork - http://presswork.me
--------------------------------------------------------------- */
$upload_dir = wp_upload_dir();
if(!defined('ACTION_FILE'))
    define('ACTION_FILE', $upload_dir['basedir'].'/custom-functions.php');
if(file_exists(ACTION_FILE))
    include(ACTION_FILE);

/* ---------------------------------------------------------------
:: Load custom.css file if it exists in the uploads folder
:: Brought from PressWork - http://presswork.me
--------------------------------------------------------------- */
define('CSS_FILE', $upload_dir['basedir'].'/custom.css');
define('CSS_DISPLAY', $upload_dir['baseurl'].'/custom.css');
if(file_exists(CSS_FILE))
    add_action("wp_print_styles", "add_custom_css_file", 99);
function pw_add_custom_css_file() {
    wp_register_style('narga_custom_css', CSS_DISPLAY);
    wp_enqueue_style( 'narga_custom_css');
}

# add ie conditional html5  to header
function narga_ie_conditional_html5 () {
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
}
add_action('wp_head', 'narga_ie_conditional_html5');

/*  -----------------------------------
:: Narga WordPress Framework Assets
------------------------------------ */
require( get_template_directory() . '/assets/shortcodes.php' );
require( get_template_directory() . '/assets/theme-customizer.php' );

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

# function to generate blog name and subheader for custom as users want without copy the header.php file in child theme
if (!function_exists('narga_blog_head')) :  
    function narga_blog_head() {
        echo '<header role="banner">';
        echo '<h1><a href="' . esc_url( home_url( '/' ) ) . '" title="' . get_bloginfo('name') . '">' . get_bloginfo('name') . '</a></h1>';
        echo '<h2 class="subheader">' . get_bloginfo('description') . '</h2>';
        echo '</header>';
    }  
endif;

# Remove somethings not used or include in others functions
if (!function_exists('narga_remove_unused_items')) :  
    function narga_remove_unused_items() {  
        global $wp_widget_factory;
        # Remove recent comments css
        remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
    }  
add_action( 'widgets_init', 'narga_remove_unused_items' ); 
endif;

# return entry meta information for posts, used by multiple loops.
if (!function_exists('narga_entry_meta')) :  
    function narga_entry_meta() {
        echo '<p class="post-meta-data">';
        echo '<time class="updated" datetime="'. get_the_time('c') .'">'. sprintf(__('%s', 'narga'), get_the_time('M jS, Y'), get_the_time()) .'</time>';
        if (false === get_post_format()) {
            echo ' in <span class="entry-categories">' . get_the_category_list( ', ' ) . '</span> <span class="byline author vcard">'. __('by', 'narga') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .'</a></span>';            
        } else {
            echo '';
        }
        if (comments_open()) :
            echo ' <span class="entry-comments">';
        comments_popup_link( __( 'Be the first to comment', 'narga' ), __( '1 comment', 'narga'),  __( '% comments', 'narga' ),  __( 'comments-link', 'narga' ),  __( 'Comments are off for this post', 'narga' ));
        echo '</span>';
endif;
edit_post_link('Edit', ' | ', '');
echo '</p>';
    }
endif;


# Function to trim the excerpt
if (!function_exists('narga_excerpts')) :  
    function narga_excerpts($content = false) {
        # If is the home page, an archive, or search results
        if(is_front_page() || is_archive() || is_search()) :
            global $post;
        $content = $post->post_excerpt;
        $content = strip_shortcodes($content);
        $content = str_replace(']]>', ']]&gt;', $content);
        $content = strip_tags($content);
        # If an excerpt is set in the Optional Excerpt box
        if($content) :
            $content = apply_filters('the_excerpt', $content);
        # If no excerpt is set
        else :
            $content = $post->post_content;
        $excerpt_length = 50;
        $words = explode(' ', $content, $excerpt_length + 1);
        if(count($words) > $excerpt_length) :
            array_pop($words);
        array_push($words, '...<p><a class="more-link" href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '">  ' . __( 'Read more &#187;', 'narga' ) . ' </a></p>');
        $content = implode(' ', $words);
endif;
$content = '<p>' . $content . '</p>';
endif;
endif;
# Make sure to return the content
return $content;
    }
# Replace content with excerpt
if (get_theme_mod('posts_excerpt') == 'enable') {
    add_filter('the_content', 'narga_excerpts');
}
endif;

# Replace more link text
if (!function_exists('narga_more_link')) :  
    function narga_more_link( $more_link, $more_link_text ) {
        return str_replace( $more_link_text, 'Read More &#187;', $more_link );
    }
add_filter( 'the_content_more_link', 'narga_more_link', 10, 2 );
endif;

/*  --------------------------------
:: Adds "odd" class to all odd posts
--------------------------------- */
if (!function_exists('narga_addition_classes')) :  
    function narga_addition_classes ( $classes ) { 
        $current_class = 'odd';
        if(!is_singular() && !is_sticky()) {
            global $current_class;
            $current_class = ($current_class == 'odd') ? 'even' : 'odd';
            $classes[] = $current_class.' six column';
        }
        /* Temporaty remove sticky class */
        elseif(!is_singular() && is_sticky()) {
            $classes = str_replace('sticky', 'sticky-entry', $classes);
        }
        return $classes;
    }
if (get_theme_mod( 'posts_grid_layout') == 'enable') {
    add_filter ( 'post_class' , 'narga_addition_classes' );
}
endif;

/*  --------------------------------
:: Post Thumbnail Control
--------------------------------- */
if (!function_exists('narga_post_thumbnail')) :  
    function narga_post_thumbnail() {
        if (get_theme_mod( 'posts_thumbnail') == 'enable') {
            echo '<div class="post-thumb';
            if (get_theme_mod( 'posts_grid_layout') == 'disable') { echo ' no-grid'; } else echo ''; echo '">';
            if (has_post_thumbnail()) {
                echo '<a href="' . get_permalink() . '" title="Permanent Link to ' . get_the_title() . '">' . the_post_thumbnail('grid-post-thumbnails') . '</a>';
            } else {
                echo '';
            }
            echo '</div>';
        } else { echo (''); }
    }
endif;

if (!function_exists('narga_comments')) :  
    function narga_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        echo '<li ';
        comment_class();
        echo '>
            <article id="comment-' . get_comment_ID() . '">
            <header class="comment-author vcard">';
        echo get_avatar($comment,$size='64');
        printf(__('<cite class="fn">%s</cite>', 'narga'), get_comment_author_link());
        echo '<time datetime="' . get_comment_date('c') . '"  itemprop="commentTime"><a itemprop="url" href="' . htmlspecialchars( get_comment_link( $comment->comment_ID ) ) . '">';
        printf(__('%1$s', 'narga'), get_comment_date(),  get_comment_time());
        echo '</a></time>
            </header>
            <section itemprop="commentText" class="comment">';
        comment_text();
        if ($comment->comment_approved == '0') : 
            echo '<div class=" alert label">';
        _e('Your comment is awaiting moderation.', 'narga');
        echo '</div>';
endif;
echo '</section>';
$id = $comment->comment_ID;
edit_comment_link(__('Edit', 'narga'), '<a class="comment-del-link" href="'.admin_url("comment.php?action=cdc&c=$id").'">Del</a> ', '<a class="comment-spam-link" href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">Spam</a>');
comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
echo '</article>';
    }
endif;

# function to render orbit slide based on featured category and number of slide in Customize.
if (!function_exists('narga_orbit_slider')) :  
    function narga_orbit_slider() {
        echo '<div id="narga-orbit-slider">';
        $args = array(
            'category_name' => get_theme_mod('featured_category'),
            'showposts' => get_theme_mod('number_slide')
        );
        $query_posts = new WP_Query($args);
        while ($query_posts->have_posts()) : $query_posts->the_post();
        if(has_post_thumbnail()) {
            the_post_thumbnail('post-thumbnail', array( 'alt' => get_the_title(), 'title' => get_the_title(), 'data-caption' => '#htmlCaption-'.$query_posts->current_post,));
        } 
endwhile;
echo '</div>';
# Print the captions   
while ( $query_posts->have_posts() ) : $query_posts->the_post();
echo '<span class="orbit-caption" id="htmlCaption-' . $query_posts->current_post . '">';
echo '<span class="slider-title"><a href="' . get_permalink(). '" ' . 'title="' . get_the_title() . '">' . get_the_title(). '</a></span><br />';
echo '<span class="slider-description">' . get_post(get_post_thumbnail_id())->post_content . '</span>'; # Get image descriptions
echo '</span>';
endwhile;
    }
endif;

/**
 * Removes the extra 10px of width from wp-caption and changes to HTML5 figure/figcaption
 * http://writings.orangegnome.com/writes/improved-html5-wordpress-captions/
 **/
add_filter('img_caption_shortcode', 'narga_img_caption_shortcode_filter',10,3);
function narga_img_caption_shortcode_filter($val, $attr, $content = null) {
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
/* ------------------------------------------------------------
:: Rewrite default wordpress pagination function
:: http://codex.wordpress.org/Function_Reference/paginate_links
------------------------------------------------------------ */
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
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'type' => 'list'
        ) );
        # Display the pagination if more than one page is found
        echo '<nav id="post-nav">' . str_replace('page-numbers', 'pagination', $paginate_links) . '</nav>';        
    }
endif;
/* ------------------------------------------------------------
:: Rewrite default wordpress comments pagination function
------------------------------------------------------------ */
if (!function_exists('narga_comment_pagination')) :  
    function narga_comment_pagination() {
        //read the page links but do not echo
        $comment_page = paginate_comments_links( array(
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'echo' => false, 
            'type' => 'list'
        )
    );
        echo '<nav id="comments-nav">' . str_replace('page-numbers', 'pagination', $comment_page) . '</nav>';
    }
endif;

/*  ---------------------------------------
:: Add Framework Customizer Direct Link ::
--------------------------------------- */
add_action('admin_menu', 'narga_add_theme_menu');
function narga_add_theme_menu() {
    add_theme_page('NARGA Customizer', 'NARGA', 'edit_theme_options', '../wp-admin/customize.php', '');
}
?>
