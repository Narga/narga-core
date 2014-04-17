<?php
/**
 * Custom functions that cleaning unuse element of HTML, CSS, WordPress
 * 
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA 1.8
 */

/* 
 * Start cleanup bloat after theme actived
 *
 * @since NARGA v1.8
 * */

if (!function_exists('narga_cleanup')) :
function narga_cleanup() {

   // clean up comment styles in the head & remove pesky injected css for recent comments widget
    add_action('wp_head', 'narga_remove_recent_comments_style', 1);
    // clean up gallery output in wp
    add_filter('gallery_style', 'narga_remove_gallery_style');
    // Removes the extra 10px of width from wp-caption and changes to HTML5 figure/figcaption
    add_filter('img_caption_shortcode', 'narga_img_caption_width_fix',10,3);
  // ie conditional wrapper plus option to change favicon
    add_action('wp_head', 'narga_header_extra');
}
add_action('after_setup_theme','narga_cleanup', 15);
endif;

/**
 * Remove somethings not used or include in others functions
 *
 * @since NARGA v1.1
 */
if (!function_exists('narga_remove_recent_comments_style')) :
    function narga_remove_recent_comments_style() {
        global $wp_widget_factory;
        # Remove recent comments css
        remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
        if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
            remove_filter('wp_head', 'wp_widget_recent_comments_style' );
    } }
endif;

/**
 * Removes the extra 10px of width from wp-caption and changes to HTML5 figure/figcaption
 * http://writings.orangegnome.com/writes/improved-html5-wordpress-captions/
 *
 * @since NARGA v1.1
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
        
        if ( $id )
            $id = esc_attr( $id );

	// Add itemprop="contentURL" to image - Ugly hack
        $content = str_replace('<img', '<img itemprop="contentURL"', $content); 

        return '<figure id="' . $id . '" aria-describedby="figcaption_' . $id . '" class="wp-caption ' . esc_attr($align) . '" itemscope itemtype="http://schema.org/ImageObject" style="width: ' . (0 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption id="figcaption_'. $id . '" class="wp-caption-text" itemprop="description">' . $caption . '</figcaption></figure>';
    }
endif;

/**
 * Remove injected CSS from gallery
 * 
 * @since NARGA v1.8
 **/
if (!function_exists('narga_remove_gallery_style')) :
function narga_remove_gallery_style($css) {
    return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}
endif;

/*
 * IE conditional HTML5  to header, favicon
 *
 * @since NARGA v1.6
 **/
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
}
endif;

?>
