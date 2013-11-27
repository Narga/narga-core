<?php
/**
 * Narga ZURB Topbar for WordPress
 *
 * @package WordPress
 * @subpackage NARGA
 * @since NARGA v0.1
 **/

// the left top bar
function narga_topbar_l() {
    wp_nav_menu(array(
        'container' => false, // remove nav container
        'container_class' => 'menu', // class of container
        'menu' => '', // menu name
        'menu_class' => 'left', // adding custom nav class
        'theme_location' => 'top-bar-l', // where it's located in the theme
        'before' => '', // before each link <a>
        'after' => '', // after each link </a>
        'link_before' => '', // before each link text
        'link_after' => '', // after each link text
        'depth' => 5, // limit the depth of the nav
        'fallback_cb' => 'narga_menu_fallback', // workaround to show a message to set up a menu
        'walker' => new NARGATopbarWalker()
    ));
}

/**
 * Customize the output of menus for Foundation top bar
 *
 * @since NARGA v1.8
 **/
 
class NARGATopbarWalker extends Walker_Nav_Menu {

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $element->has_children = !empty( $children_elements[$element->ID] );
        $element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';
        $element->classes[] = ( $element->has_children ) ? 'has-dropdown' : '';
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
    
    function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
        $item_html = '';
        parent::start_el( $item_html, $object, $depth, $args );
        $output .= ( $depth == 0 ) ? '<li class="divider"></li>' : '';
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;	
        if( in_array('label', $classes) ) {
            $output .= '<li class="divider"></li>';
            $item_html = preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html );
        }
        
        if ( in_array('divider', $classes) ) {
            $item_html = preg_replace( '/<a[^>]*>( .* )<\/a>/iU', '', $item_html );
        }
        
        $output .= $item_html;
    }
    
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<ul class=\"dropdown\">\n";
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
<nav role="navigation" class="top-bar" data-topbar>
<ul class="title-area';
#Sticky Top Bar Option
if (narga_options('show_topbar_title') == 0) :
    echo ' show-for-small';
endif;
echo '">
<li class="name"><h1><a href="' .  narga_options('topbar_title_url') . '">' .  narga_options('topbar_title') . '</a></h1></li>
<li class="toggle-topbar menu-icon"><a href="#"><span>' . __('Menu', 'narga') . '</span></a></li>
    </ul>
    <section class="top-bar-section">';
#Top Bar Search Form
if (narga_options('search_form') == 1) :
    narga_topbar_search_form();
endif;    
echo '<!-- Left Nav Section -->';
narga_topbar_l();
echo '</section>
</nav>
</div>
</div>';
    }
endif;

# Navigation search form
if (!function_exists('narga_topbar_search_form')) :  
    function narga_topbar_search_form() {
        echo '
            <!-- Right Nav Section -->
            <ul class="right">
            <li class="has-form show-for-medium-up"><form method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '"><input type="text" name="s" id="s" placeholder="' . __('Search', 'narga') . '"></form>
            </li>
            </ul>';
    }
endif;
/**
 * A fallback when no navigation is selected by default, otherwise it throws some nasty errors in your face.
 * From required+ Foundation http://themes.required.ch
 * since NARGA v1.5
 */
function narga_menu_fallback() {
    echo '<div class="alert-box secondary">';
    // Translators 1: Link to Menus, 2: Link to Customize
    printf( __( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'narga' ),
        sprintf(  __( '<a href="%s">Menus</a>', 'narga' ),
        get_admin_url( get_current_blog_id(), 'nav-menus.php' )
    ),
    sprintf(  __( '<a href="%s">Customize</a>', 'narga' ),
    get_admin_url( get_current_blog_id(), 'customize.php' )
)
        );
    echo '</div>';
}

/**
 * Fix post sticky class conflict with topbar
 *
 * @since NARGA v1.3
 */
if (!function_exists('narga_fix_sticky_class')) :  
    function narga_fix_sticky_class($classes) {
        $classes = array_diff($classes, array("sticky"));
        return $classes;
    }
add_filter('post_class','narga_fix_sticky_class');
endif;

?>
