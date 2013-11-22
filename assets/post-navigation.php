<?php
/**
 * Post Navigation Control: Breadcrumb, Pagination
 * 
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.8
 */

/**
 * Rewrite default wordpress pagination function
 * 
 * @since NARGA v1.1
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
 *
 * @since NARGA v1.1
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
 *
 * @since NARGA v1.3.5
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

?>
