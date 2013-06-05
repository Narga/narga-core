<?php
/**
 * Narga ZURB Topbar for WordPress
 *
 * Since NARGA v0.1
 *
 **/

// the left top bar
function narga_topbar_l() {
    wp_nav_menu(array(
        'container' => false, // remove nav container
        'container_class' => 'menu', // class of container
        'menu' => '', // menu name
        'menu_class' => 'top-bar-menu left', // adding custom nav class
        'theme_location' => 'top-bar-l', // where it's located in the theme
        'before' => '', // before each link <a>
        'after' => '', // after each link </a>
        'link_before' => '', // before each link text
        'link_after' => '', // after each link text
        'depth' => 5, // limit the depth of the nav
        'fallback_cb' => false, // fallback function (see below)
        'walker' => new NargaTopbarWalker()
    ));
} // end left top bar

// the right top bar
function narga_topbar_r() {
    wp_nav_menu(array(
        'container' => false, // remove nav container
        'container_class' => '', // class of container
        'menu' => '', // menu name
        'menu_class' => 'top-bar-menu right hide-for-small', // adding custom nav class
        'theme_location' => 'top-bar-r', // where it's located in the theme
        'before' => '', // before each link <a>
        'after' => '', // after each link </a>
        'link_before' => '', // before each link text
        'link_after' => '', // after each link text
        'depth' => 5, // limit the depth of the nav
        'fallback_cb' => false, // fallback function (see below)
        'walker' => new NargaTopbarWalker()
    ));
} // end right top bar
/*
Customize the output of menus for Foundation top bar classes and add descriptions
http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output
http://code.hyperspatial.com/1514/twitter-bootstrap-walker-classes/
 */
class NargaTopbarWalker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = ($item->current) ? 'active' : '';
        $classes[] = ($args->has_children) ? 'has-dropdown' : '';
        $args->link_before = (in_array('section', $classes)) ? '<label>' : '';
        $args->link_after = (in_array('section', $classes)) ? '</label>' : '';
        $output .= (in_array('section', $classes)) ? '<li class="divider"></li>' : '';
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args ) );
        $class_names = strlen(trim($class_names)) > 0 ? ' class="'.esc_attr($class_names).'"' : '';
        $output .= ($depth == 0) ? $indent.'<li class="divider"></li>' : '';
        $output .= $indent.'<li id="menu-item-'.$item->ID.'"'.$value.$class_names.'>';
        $attributes = !empty($item->attr_title) ? ' title="' .esc_attr($item->attr_title).'"' : '';
        $attributes .= !empty($item->target) ? ' target="'.esc_attr($item->target ).'"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' .esc_attr($item->xfn ).'"' : '';
        $attributes .= !empty($item->url) ? ' href="' .esc_attr($item->url ).'"' : '';
        $item_output = $args->before;
        $item_output .= (!in_array('section', $classes)) ? '<a'.$attributes.'>' : '';
        $item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID);
        $item_output .= $args->link_after;
        $item_output .= (!in_array('section', $classes)) ? '</a>' : '';
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    function end_el(&$output, $item, $depth) {
        $output .= '</li>'."\n";
    }
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n".$indent.'<ul class="sub-menu dropdown">'."\n";
    }
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= $indent.'</ul>'."\n";
    }	
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0])) {
            $args[0]->has_children = ! empty($children_elements[$element->$id_field]);
        }
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

# Function to render Top Bar
if (!function_exists('narga_topbar')) :  
    function narga_topbar() {
        echo '<div';
        #Sticky Top Bar Option
        if (narga_options('sticky_topbar') == 1) :
            echo ' class="sticky"';
        endif;
        echo '>
            <div';
        #Contain Top Bar Layout Width        
        if (narga_options('contain2grid') == 1) :
            echo ' class="contain-to-grid"';
        endif;
        echo '>
            <nav role="navigation" class="top-bar">
                <ul class="title-area">
                    <li class="name"><h1><a href="' .  narga_options('topbar_title_url') . '">' .  narga_options('topbar_title') . '</a></h1></li>
                    <li class="toggle-topbar menu-icon"><a href="#"><span>';
        _e( 'Menu', 'narga' );
        echo '</span></a></li>
                </ul>
                <section class="top-bar-section">
                <!-- Left Nav Section -->';
        narga_topbar_l();
        echo '<!-- Right Nav Section -->';
        narga_topbar_r();                   
        #Top Bar Search Form
        if (narga_options('search_form') == 1) :
            narga_topbar_search_form();
        endif;
        echo '</section>
            </nav>
            </div>
            </div>';
    }
endif;

# Navigation search form
if (!function_exists('narga_topbar_search_form')) :  
    function narga_topbar_search_form() {
        echo '<ul id="menu-right-topbar" class="right hide-for-small">
            <li class="has-form"><form method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
            <input type="text" class="field" name="s" id="s" placeholder="';
        esc_attr_e( 'Search', 'narga' );
        echo '" />
            </form></li>
            </ul>';
    }
endif;

?>
