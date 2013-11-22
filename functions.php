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
 * @subpackage NARGA
 * @since NARGA 1.0
 */

/* NARGA Assets */
// Customizer additions.
require_once locate_template('/assets/customizer.php' );
// WordPress Zurb Topbar function.
require_once locate_template('/assets/topbar.php' );
// Load Jetpack compatibility file.
require_once locate_template('/assets/jetpack.php' );
// Implement the Custom Header feature.
require_once locate_template('/assets/custom-header.php');
// Custom functions that cleaning unuse element of HTML, CSS, WordPress.
require_once locate_template('/assets/cleanup.php');
// Content related functions to manipulation your post.
require_once locate_template('/assets/content.php');
// Post Navigation Control: Breadcrumb, Pagination.
require_once locate_template('/assets/post-navigation.php');

if (!isset( $content_width))
    $content_width = 640;
/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
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

/* NARGA Basic Setup */
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

/**
 * Enqueue Scripts and Styles for Front-End
 *
 * @since NARGA v0.1
 **/
function narga_assets() {
    global $wp_styles;

    if ( !is_admin() ) {
      
        # Loads Foundation Main stylesheet
        wp_enqueue_style( 'foundation', get_template_directory_uri() . '/stylesheets/foundation.min.css', array(), '2013-11-20', 'all' );

         # Loads our main stylesheet.
        wp_enqueue_style( 'narga-style', get_stylesheet_uri(), array(), '2013-08-12', 'all' );

        # Load JavaScripts
        wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/javascripts/modernizr.js', array( 'jquery' ), '2.6.2', true );

        wp_enqueue_script( 'foundation', get_template_directory_uri() . '/javascripts/foundation.min.js', array( 'jquery' ), '5.0.0', true );

        wp_enqueue_script( 'narga', get_template_directory_uri() . '/javascripts/narga.js', array( 'jquery' ), '1.8', true );

        # Enable threaded comments 
        if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
            wp_enqueue_script('comment-reply');
    }
}
add_action( 'wp_enqueue_scripts', 'narga_assets' );

/**
 * Includes the pro and custom functions if it exists
 *
 * @since NARGA v1.1
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
 * Orbit Slider as Featured Post
 * Function to render orbit slide based on featured category and number of slide in Customize.
 *
 * @since NARGA v1.1
 */
if (!function_exists('narga_orbit_slider')) :  
    function narga_orbit_slider() {
        echo '<div class="orbit-container">
            <ul data-orbit data-options="bullets:false;resume_on_mouseout: true.;">';
        $args = array(
            'showposts' => narga_options('number_slide'),
            'post_type' => 'any',
            'cat' => narga_options('featured_category'),
        );
        $narga_slider_query = new WP_Query($args);
        while ($narga_slider_query->have_posts()) : $narga_slider_query->the_post();
        if(has_post_thumbnail()) {
            $number = 1; $number = $number++;
            echo '
                <li>';
            the_post_thumbnail('post-thumbnail', array( 'alt' => get_the_title(), 'title' => get_the_title(), 'data-caption' => '#htmlCaption-'.$narga_slider_query->current_post,));
            echo '
                <div class="orbit-caption"><h3><a href="' . get_permalink(). '" ' . 'title="' . get_the_title() . '">' . get_the_title(). '</a></h3></div></li>' . "\n";
        } elseif (! has_post_thumbnail() && (narga_options('default_slides_image') == '1') ) {
            echo '
                <li><img width="640" height="290" src="' . get_template_directory_uri() . '/images/default-slide-image.png" class="attachment-post-thumbnail wp-post-image" alt="' . get_the_title() . '" title="' . get_the_title() . '" data-caption="#htmlCaption-' .$narga_slider_query->current_post . '" />';
            echo '
            <div class="orbit-caption"><h3><a href="' . get_permalink(). '" ' . 'title="' . get_the_title() . '">' . get_the_title(). '</a></h3></div></li>' . "\n";
         } else echo '';
endwhile;
echo '</ul>';
if (narga_options('slide_indicator') == 1) :
    $i = 1;
    echo '<ol class="orbit-bullets">';
    if ( narga_options('default_slides_image') == '1' ) :
        for($i; $i <= narga_options('number_slide'); $i++) {
            echo '<li data-orbit-slide-number="' . $i . '"></li>';
        }
    elseif ( narga_options('default_slides_image') == '0' ) :
        for($i; $i <= $number+2; $i++) {
            echo '<li data-orbit-slide-number="' . $i . '"></li>';
        }
    endif;
    echo '</ol>';
endif;
echo '</div>';
    }
endif;

/**
 * Theme link to NARGA Help page
 * Since NARGA v1.1
 * (temporaty remove, adding in next version
 **/

?>
