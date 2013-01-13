<?php
/*  ------------------------------------------------------
:: WordPress Shortcodes Configuration, since version 1.0
:: Some of shortcodes based from WP-Foundation frameworks
------------------------------------------------------- */

# Allow shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

# Alerts [alert][/alert]

function foundation_shortcode_alert( $atts, $content = null ) {
    extract( shortcode_atts( array('type' => ''), $atts ) );
    return '<div class="alert-box ' . esc_attr($type) . '">' . do_shortcode($content) . ' <a href="" class="close">&times;</a> </div>';
}
add_shortcode( 'alert', 'narga_shortcode_alert' );

# Columns [column][/column]
function narga_shortcode_column( $atts, $content = null ) {
    extract( shortcode_atts( array('center' => '', 'span' => '',), $atts ) );
    # Set the 'center' variable
    if ($center == 'true') {
        $center = 'centered';
    }
    return '<div class="' . esc_attr($span) . ' columns ' . esc_attr($center) .'">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'column', 'foundation_shortcode_alert' );

# Buttons [button][/button]

function foundation_shortcode_button( $atts, $content = null ) {
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

add_shortcode( 'button', 'foundation_shortcode_button' );


// Panels [panel][/panel]

function foundation_shortcode_panel( $atts, $content = null ) {

    extract( shortcode_atts( array(
        'type' => '',
        'style' => ''
    ), $atts ) );

    return '<div class="panel ' . esc_attr($type) . ' ' . esc_attr($style) . '">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'panel', 'foundation_shortcode_panel' );

// Tabs [tabs] [tab][/tab] [/tabs]

function foundation_shortcode_tabs( $atts, $content ){
    extract(shortcode_atts(array(
        'type' => ''
    ), $atts));

    $GLOBALS['tab_count'] = 0;

    do_shortcode( $content );

    $i = 0;

    if( is_array( $GLOBALS['tabs'] ) ){
        foreach( $GLOBALS['tabs'] as $tab ){

            $i++;

            // Remove whitespace for #id
            $title = $tab[title];
            $title = str_replace(' ', '', $title);

            // Set the active tab
            if ($i == 1) {

                $tabs[] = '<dd class="active"><a href="#'.$title.'">'.$tab['title'].'</a></dd>';
                $panes[] = '<li class="active" id="'.$title.'Tab"><h3>'.$tab['title'].'</h3>'.$tab['content'].'</li>';
            }
            else {

                $tabs[] = '<dd><a class="" href="#'.$title.'">'.$tab['title'].'</a></dd>';
                $panes[] = '<li id="'.$title.'Tab"><h3>'.$tab['title'].'</h3>'.$tab['content'].'</li>';

            }
        }

        $return = "\n".'<dl class="tabs '.esc_attr($type).'">'.implode( "\n", $tabs ).'</dl>'."\n".'<ul class="tabs-content">'.implode( "\n", $panes ).'</ul>'."\n";

    }
    return $return;
}
add_shortcode( 'tabs', 'foundation_shortcode_tabs' );

function foundation_shortcode_tab( $atts, $content ){
    extract(shortcode_atts(array(
        'title' => 'Tab %d'
    ), $atts));

    $x = $GLOBALS['tab_count'];
    $GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

    $GLOBALS['tab_count']++;

}

add_shortcode( 'tab', 'foundation_shortcode_tab' );

/**
 * Elements
 */

// Detection (Show) [show][/show]

function foundation_shortcode_show( $atts, $content = null ) {

    extract( shortcode_atts( array(
        'for' => ''
    ), $atts ) );

    return '<div class="show-for-' . esc_attr($for) . '">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'show', 'foundation_shortcode_show' );

// Detection (Hide) [hide][/hide]

function foundation_shortcode_hide( $atts, $content = null ) {

    extract( shortcode_atts( array(
        'for' => ''
    ), $atts ) );

    return '<div class="hide-for-' . esc_attr($for) . '">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'hide', 'foundation_shortcode_hide' );

/**
 * Extras
 */

// Reveal [reveal][/reveal]

function foundation_shortcode_reveal( $atts, $content = null ) {

    extract( shortcode_atts( array(
        'name' => '',
        'style' => ''
    ), $atts ) );

    return '<div id="' . esc_attr($name) . '" class="reveal-modal ' . esc_attr($style) . '">' . do_shortcode($content) . '</div>';

}

add_shortcode( 'reveal', 'foundation_shortcode_reveal' );

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

# Twitter button shortcode
# [t related='NARGA Framework - A rock solid starting WordPress HTML5 theme for developers' countbox='horizontal/vertical' via='narga' ]
# Based on http://www.ilertech.com/2011/07/add-twitter-share-button-to-wordpress-3-0-with-a-simple-shortcode/
function twitter( $atts, $content=null ){
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
add_shortcode('t', 'twitter');

# Facebook Like button shortcode
# [fb  send='true' action='recommend' layout='button_count/box_count']
# Based on http://www.ilertech.com/2011/06/add-facebook-like-button-to-wordpress-3-0-with-a-simple-shortcode/
function fb_like( $atts, $content=null ){
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
add_shortcode('fb', 'fb_like');

# Google Plus button shortcode
# [gp size='small/medium/tall']
# Based on http://www.ilertech.com/2011/06/add-google-1-to-wordpress-3-0-with-a-simple-shortcode/
# Since v1.2.4

// Global namespace in functions.php
$plus1flag = false;

function plus1( $atts, $content=null ){
    extract(shortcode_atts(array(
        'url' => '',
        'lang' => 'en-US',
        'parsetags' => 'onload',
        'count' => 'false',
        'size' => 'medium',
        'callback' => '',

    ), $atts));

    // Set global flag
    global $plus1flag;
    $plus1flag = true;

    // Check for $content and set to URL if not provided
    if($content != null) $url = $content;

    $plus1_code = <<<HTML
    <div class="g-plusone" data-href='$url' data-count="$count" data-size="$size" data-callback="$callback"></div>
HTML;

    return $plus1_code;
}

#/ Add meta for front page ONLY and add scripts to any page with a shortcode
function addPlus1Meta(){
    global $plus1flag;
    if($plus1flag){
        if(is_home()){ // check for front page
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

add_shortcode('gp', 'plus1');
add_action('wp_footer', 'addPlus1Meta');

# GitHub Gist shortcode [gist id="ID" file="FILE"]
function gist_shortcode($atts) {
    return sprintf(
        '<script src="https://gist.github.com/%s.js%s"></script>', 
        $atts['id'], 
        $atts['file'] ? '?file=' . $atts['file'] : ''
    );
} add_shortcode('gist','gist_shortcode');


?>
