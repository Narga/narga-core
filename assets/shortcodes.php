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

# GitHub Gist shortcode [gist id="ID" file="FILE"]
function gist_shortcode($atts) {
    return sprintf(
        '<script src="https://gist.github.com/%s.js%s"></script>', 
        $atts['id'], 
        $atts['file'] ? '?file=' . $atts['file'] : ''
    );
} add_shortcode('gist','gist_shortcode');

# Converts audio5 shortcode to HTML5 audio tag
function narga_html5_audio($atts, $content = null) {
    extract(shortcode_atts(array(
        "src" => ''
    ), $atts));
    return '<audio src="'.$src.'" controls autobuffer>';
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
?>
