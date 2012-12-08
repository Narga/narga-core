<?php
/*  ------------------------------------
:: Narga WordPress Framework Basic Setup
------------------------------------- */
function narga_setup() {
    # Add language supports. By default, this framework not include language files.
    load_theme_textdomain('narga', get_template_directory() . '/languages');

    # Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(785, 360, true);
    add_image_size( 'grid-post-thumbnails', 360, 140, true);

    # Add post formarts supports. http://codex.wordpress.org/Post_Formats
    add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

    # Add menu supports. http://codex.wordpress.org/Function_Reference/register_nav_menus
    add_theme_support('menus');
    register_nav_menus(array(
        'top-bar-l' => __('Left Top Bar', 'narga'),
        'top-bar-r' => __('Right Top Bar', 'narga'),
        'primary_navigation' => __('Primary Navigation', 'narga'),
        'secondary_navigation' => __('Secondary Navigation', 'narga')
    ));
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
        wp_register_style( 'google-font',"http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic|Kreon:700", false );
        wp_enqueue_style( 'google-font' );

        # Enqueue to header
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', get_template_directory_uri() . '/javascripts/jquery.min.js' );
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

# add ie conditional html5  to header
function ie_conditional_html5 () {
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
add_action('wp_head', 'ie_conditional_html5');

/*  -----------------------------------
:: Narga WordPress Framework Assets
------------------------------------ */
require( get_template_directory() . '/assets/shortcodes.php' );
require( get_template_directory() . '/assets/theme-customizer.php' );


# return entry meta information for posts, used by multiple loops.
if (!function_exists('narga_entry_meta')) :  
    function narga_entry_meta() {
        echo '<p class="post-meta-data">';
        echo '<time class="updated" datetime="'. get_the_time('c') .'">'. sprintf(__('%s', 'narga'), get_the_time('M jS, Y'), get_the_time()) .'</time> in <span class="entry-categories">' . get_the_category_list( ', ' ) . '</span> <span class="byline author vcard">'. __('by', 'narga') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn" />'. get_the_author() .'</a></span>';
        if (comments_open()) :
            echo ' <span class="entry-comments">';
        comments_popup_link( 'Be the first to comment', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
        echo '</span>';
endif;
edit_post_link(' | Edit', '', '');
echo '</p>';
    }
endif;

# Remove somethings not used or include in others functions
if (!function_exists('remove_unused_items')) :  
    function remove_unused_items() {  
        global $wp_widget_factory;
        # Remove recent comments css
        remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
    }  
add_action( 'widgets_init', 'remove_unused_items' ); 
endif;

# Function to trim the excerpt
if (!function_exists('narga_excerpts')) :  
    function narga_excerpts($content = false) {
        # If is the home page, an archive, or search results
        if(is_front_page() || is_archive() || is_search()) :
            global $post;
        $content = $post->post_excerpt;
        # If an excerpt is set in the Optional Excerpt box
        if($content) :
            $content = apply_filters('the_excerpt', $content);
        # If no excerpt is set
        else :
            $content = $post->post_content;
        $excerpt_length = 65;
        $words = explode(' ', $content, $excerpt_length + 1);
        if(count($words) > $excerpt_length) :
            array_pop($words);
        array_push($words, '...');
        $content = implode(' ', $words);
endif;
$content = '<p>' . strip_tags($content) . '</p><p><a class="small button secondary" href="'. get_permalink($post->ID) . '">Read More &#187; </a></p>';
endif;
endif;
# Make sure to return the content
return $content;
    }
# Replace content with excerpt
if (get_theme_mod( 'posts_excerpt') == 'enable') {
    add_filter('the_content', 'narga_excerpts');
}
endif;

/*  --------------------------------
:: Adds "odd" class to all odd posts
--------------------------------- */
if (!function_exists('narga_addition_classes')) :  
    function narga_addition_classes ( $classes ) { 
        $current_class = 'odd';
        if(!is_singular()) {
            global $current_class;
            $current_class = ($current_class == 'odd') ? 'even' : 'odd';
            $classes[] = $current_class.' six column';
        }
        return $classes;
    }
if (get_theme_mod( 'posts_grid_layout') == 'enable') {
    add_filter ( 'post_class' , 'narga_addition_classes' );
}
endif;

/*  --------------------------------
:: Addition actions to comments
--------------------------------- */
if (!function_exists('addition_actions_comment_link')) :  
    function addition_actions_comment_link($id) {
        global $comment, $post;

        if ( $post->post_type == 'page' ) {
            if ( !current_user_can( 'edit_page', $post->ID ) )
                return;
        } else {
            if ( !current_user_can( 'edit_post', $post->ID ) )
                return;
        }

        $id = $comment->comment_ID;

        if ( null === $link )
            $link = __('Edit');


        $link = '<a class="comment-edit-link" href="' . get_edit_comment_link( $comment->comment_ID ) . '" title="' . __( 'Edit comment' ) . '">' . $link . '</a>';
        $link = $link . ' <a class="comment-del-link" href="'.admin_url("comment.php?action=cdc&c=$id").'">Del</a> ';
        $link = $link . ' <a class="comment-spam-link" href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">Spam</a>';
        $link = $before . $link . $after;

        return $link;
    }

add_filter('edit_comment_link', 'addition_actions_comment_link');
endif;

# function to render orbit slide based on featured category and number of slide in Customize.
if (!function_exists('narga_orbit_slider')) :  
    function narga_orbit_slider() {
        echo "<div id=\"narga_orbit_slider\">\n";
        $query_posts = new WP_Query('category_in= '.get_theme_mod( 'featured_category').'&showposts='.get_theme_mod('number_slide' ).'');
        while ($query_posts->have_posts()) : $query_posts->the_post(); $do_not_duplicate = $post->ID;
        if(has_post_thumbnail()) {
            the_post_thumbnail('post-thumbnail', array( 'alt' => get_the_title(), 'title' => get_the_title(), 'data-caption' => '#htmlCaption-'.$query_posts->current_post,));
        } 
endwhile;
echo "\n\t\t\t</div>";
# Print the captions   
while ( $query_posts->have_posts() ) : $query_posts->the_post();
echo "<span class=\"orbit-caption\" id=\"htmlCaption-".$query_posts->current_post."\">";
echo '<h3><a href=' . get_permalink(). ' ' . 'title=' . get_the_title() . '>' . get_the_title(). '</a></h3>';
echo get_post(get_post_thumbnail_id())->post_content; # Get image descriptions
echo "</span>";
endwhile;
    }
endif;

/**
 * Removes the extra 10px of width from wp-caption and changes to HTML5 figure/figcaption
 * http://writings.orangegnome.com/writes/improved-html5-wordpress-captions/
 **/
add_filter('img_caption_shortcode', 'img_caption_shortcode_filter',10,3);
function img_caption_shortcode_filter($val, $attr, $content = null) {
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
            'prev_next' => True,
            'prev_text' => __('&laquo;'),
            'next_text' => __('&raquo;'),
            'type' => 'list'
        ) );
        # Display the pagination if more than one page is found
        if ( $paginate_links ) {
            echo '<nav id="post-nav">' . str_replace('page-numbers', 'pagination', $paginate_links) . '</nav>';
        }
    }
endif;
?>
