<?php
/**
 * WordPress Shortcodes Configuration, since version 1.0
 * Some of shortcodes based from WP-Foundation frameworks
 **/

/**
 * Allow shortcodes in widgets
 * since NARGA v1.1.0
 **/
add_filter('widget_text', 'do_shortcode');

/**
 * Removes the extra 10px of width from wp-caption and changes to HTML5 figure/figcaption
 * http://writings.orangegnome.com/writes/improved-html5-wordpress-captions/
 * Since NARGA v1.1.0
 **/
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
add_filter('img_caption_shortcode', 'narga_img_caption_shortcode_filter',10,3);

/**
 * ZURB Foundation Alerts shortcode
 * @param array $atts
 * @return string
 * [alert][/alert]
 * since NARGA v1.1.0
 **/
function narga_shortcode_alert( $atts, $content = null ) {
    extract( shortcode_atts( array('type' => ''), $atts ) );
    return '<div class="alert-box ' . esc_attr($type) . '">' . do_shortcode($content) . ' <a href="" class="close">&times;</a> </div>';
}
add_shortcode( 'alert', 'narga_shortcode_alert' );

/**
 * ZURB Foundation Columns shortcode
 * @param array $atts
 * @return string
 * [column][/column]
 * since NARGA v1.1.0
 **/
function narga_shortcode_columns( $atts, $content = null ) {
    extract( shortcode_atts( array('center' => '', 'span' => '',), $atts ) );
    # Set the 'center' variable
    if ($center == 'true') {
        $center = 'centered';
    }
    return '<div class="' . esc_attr($span) . ' columns ' . esc_attr($center) .'">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'column', 'narga_shortcode_columns' );

/**
 * ZURB Foundation Buttons shortcode
 * @param array $atts
 * @return string
 * [button link="" size="medium/small" type="" style="" reveal=""][/button]
 * since NARGA v1.1.0
 **/
function narga_shortcode_button( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'link' => '#',
        'size' => 'medium',
        'type' => '',
        'style' => '',
        'reveal' => ''
    ), $atts ) );

    if (!$reveal == null) {
        $reveal_data = 'data-reveal-id=' . $reveal . ' ';
    }

    return '<a ' . $reveal_data . ' href="' . esc_attr($link) . '" class="' . esc_attr($size) . ' ' . esc_attr($style) . ' ' . esc_attr($type) . ' button">' . $content . '</a>';
}

add_shortcode( 'button', 'narga_shortcode_button' );

# Converts audio5 shortcode to HTML5 audio tag
# [audio5 src="http://yoursite.com/upload-folder/filename.mp3" loop="true" autoplay="autoplay" preload="auto" loop="loop" controls=""]
# If you’re running the JetPack plugin for WordPress, you can easily add audio you’ve uploaded with the shortcode: [audio http://yoursite.com/upload-folder/filename.mp3]
function narga_html5_audio($atts, $content = null) {
    extract(shortcode_atts(array(
        "src" => '',
        "autoplay" => '',
        "preload"=> 'true',
        "loop" => '',
        "controls"=> ''
    ), $atts));
    return '<audio src="'.$src.'" autoplay="'.$autoplay.'" preload="'.$preload.'" loop="'.$loop.'" controls="'.$controls.'" autobuffer />';
}
add_shortcode('audio5', 'narga_html5_audio');

# Converts video5 shortcode to HTML5 video tag
function narga_html5_video($atts, $content = null) {
    extract(shortcode_atts(array(
        "src" => '',
        "width" => '',
        "height" => ''
    ), $atts));
    return '<video src="'.$src.'" width="'.$width.'" height="'.$height.'" controls autobuffer>';
}
add_shortcode('video5', 'narga_html5_video');

/* Social Media */

/**
 * Twitter button shortcode
 * @param array $atts
 * @return string
 * [t related='NARGA Framework - A rock solid starting WordPress HTML5 theme for developers' countbox='horizontal/vertical' via='narga' ]
 * since NARGA v1.2.4
 **/
function narga_twitter( $atts, $content=null ){
    extract(shortcode_atts(array(
        'url' => null,
        'counturl' => null,
        'via' => '',
        'hashtags' => '',
        'text' => '',
        'related' => '',
        'countbox' => 'none', # none, horizontal, vertical

    ), $atts));

    # Check for count url and set to $url if not provided
    if($counturl == null) $counturl = $url;

    $twitter_code = <<<HTML
    <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script><a href='http://twitter.com/share' class="twitter-share-button" data-url="$url" data-counturl="$counturl" data-via="$via" data-hashtags="$hashtags" data-text="$text" data-related="$related" data-count="$countbox"></a>
HTML;
    return $twitter_code;
}
add_shortcode('t', 'narga_twitter');

/**
 * Facebook Like button shortcode
 * @param array $atts
 * @return string
 * [fb send='true' action='recommend' layout='button_count/box_count']
 * since NARGA v1.2.4
 **/
function narga_fb_like( $atts, $content=null ){
    extract(shortcode_atts(array(
        'send' => 'false',
        'layout' => 'standard', # standard, button_count, box_count
        'show_faces' => 'true',
        'width' => '400px',
        'action' => 'like',
        'font' => '',
        'colorscheme' => 'light',
        'ref' => '',
        'locale' => 'en_US',
        'appId' => '429051310480411'
    ), $atts));

    $fb_like_code = <<<HTML
        <div id="fb-root"></div><script src="http://connect.facebook.net/$locale/all.js#appId=$appId&amp;xfbml=1"></script>
<div class="fb-like" data-send="$send" data-layout="$layout" data-width="$width" data-show-faces="$show_faces" data-colorscheme="$colorscheme" data-action="$action" data-font="$font"></div>
HTML;

    return $fb_like_code;
}
add_shortcode('fb', 'narga_fb_like');

/**
 * Google Plus button shortcode
 * @param array $atts
 * @return string
 * [gp size='small/medium/tall']
 * since NARGA v1.2.4
 **/

# Global namespace in functions.php
$plus1flag = false;

function narga_gplus( $atts, $content=null ){
    extract(shortcode_atts(array(
        'url' => '',
        'lang' => 'en-US',
        'parsetags' => 'onload',
        'count' => 'false',
        'size' => 'medium',
        'callback' => '',

    ), $atts));

    # Set global flag
    global $plus1flag;
    $plus1flag = true;

    # Check for $content and set to URL if not provided
    if($content != null) $url = $content;

    $plus1_code = <<<HTML
    <div class="g-plusone" data-href='$url' data-count="$count" data-size="$size" data-callback="$callback"></div>
HTML;

    return $plus1_code;
}

# Add meta for front page ONLY and add scripts to any page with a shortcode
function narga_addgplus(){
    global $plus1flag;
    if($plus1flag){
        if(is_home()){ # check for front page
            echo "<link rel='canonical' href='" . site_url() ."' />";
        }

        echo <<<HTML

        <script type="text/javascript">
          (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script>
HTML;
    }
}

add_shortcode('gp', 'narga_gplus');
add_action('wp_footer', 'narga_addgplus');

/**
 * GitHub Gist shortcode
 * @param array $atts
 * @return string
 * [gist id="ID" file="FILE"]
 * since NARGA v1.3.0
 **/
if (!function_exists('narga_github_gist')) :  
function narga_github_gist($atts) {
    return sprintf(
        '<script src="https://gist.github.com/%s.js%s"></script>', 
        $atts['id'], 
        $atts['file'] ? '?file=' . $atts['file'] : ''
    );
}
add_shortcode('gist','narga_github_gist');
endif;

/**
 * Adsense shortcode callback
 * @param array $atts
 * @return string
 * [adsense ad_client="" ad_slot="" width="" height=""]
 * since NARGA v1.3.7
 **/
if (!function_exists('narga_adsense')) :  
function narga_adsense( $atts ) {
    # Extract and apply the defaults
    extract(shortcode_atts(array(
        'ad_client' => '',
        'ad_slot' => '',
        'width' => '',
        'height' => '',
    ), $atts));
    
    return '<script type="text/javascript"><!--'. "\n" . 
        'google_ad_client = "' . $ad_client . '";'. "\n" . 
        'google_ad_slot = "' . $ad_slot . '";'. "\n" . 
        'google_ad_width = ' . $width . ';'. "\n" . 
        'google_ad_height = ' . $height . ';'. "\n" . 
        '//-->'. "\n" . 
        '</script>'. "\n" .
        '<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>';
}
add_shortcode('adsense','narga_adsense');
endif;

?>
