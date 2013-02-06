<?php
/*  -----------------------------------
:: Narga WordPress Framework Customizer
------------------------------------ */
# Narga's Theme Customization Class

if ( class_exists( 'WP_Customize_Control' ) ) {
    # Adds textarea support to the theme customizer
    class WP_Customize_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';
        public function __construct( $manager, $id, $args = array() ) {
            $this->statuses = array( '' => __( 'Default', 'narga' ) );
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {
            echo '<label>';
            echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
            echo '<textarea rows="5" style="width:100%;" ';
            $this->link();
            echo '>' . esc_textarea( $this->value() ) . '</textarea>';
            echo '</label>';
        }
    }

}

# Customizer
add_action( 'customize_register', 'narga_customizer' );
function narga_customizer($wp_customize){
    $wp_customize->add_section('narga_featured_categories', array(
        'title' => 'Orbit Slider',
        'priority' => 36,
        'description'    => 'Orbit Slider Configuration',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_setting('slide_toggle', array(
        'default' => 'disable',
    ) );
    $wp_customize->add_control('slide_toggle', array(
        'type' => 'select',
        'label' => 'Enable Slide',
        'section' => 'narga_featured_categories',
        'choices' => array(
            'enable' => 'Enable',
            'disable' => 'Disable',
        ),
    ) );
    $categories = get_categories();
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cats[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('featured_category', array(
        'default'        => $default,
        'capability'     => 'edit_theme_options',
    ));

    $wp_customize->add_control( 'featured_category', array(
        'settings' => 'featured_category',
        'label'   => 'Select Featured Category:',
        'section' => 'narga_featured_categories',
        'type'    => 'select',
        'choices' => $cats,
    ));

    $wp_customize->add_setting( 'number_slide', array(
        'default'        => '5',
    ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'number_slide', array(
        'label'   => 'Number Slide',
        'section' => 'narga_featured_categories',
        'settings'   => 'number_slide',
    ) ) );
    $wp_customize->add_setting('topbar_search_form_toggle', array(
        'default' => 'enable',
    )
);
    // Add Topbar Search Form Toggle
    $wp_customize->add_control('topbar_search_form_toggle', array(
        'type' => 'select',
        'label' => 'Enable Search Form',
        'section' => 'nav',
        'choices' => array(
            'enable' => 'Enable',
            'disable' => 'Disable',
        ),
    )
);

    $wp_customize->add_section( 'front_page_layout', array(
        'title'          => 'Front Page Layout',
        'priority'       => 125,
        'description'    => 'Change settings for your front page layout.',
        'transport' => 'postMessage',
    ) );

    $wp_customize->add_setting( 'posts_excerpt', array(
        'default' => 'enable',
    ) );
    $wp_customize->add_control( 'posts_excerpt', array(
        'label'   => 'Posts excerpt and clean HTML tags',
        'section' => 'front_page_layout',
        'type'    => 'select',
        'choices'    => array(
            'enable' => 'Enable',
            'disable' => 'Disable',
        ),
    ));
    $wp_customize->add_setting( 'posts_grid_layout', array(
        'default' => 'enable',
    ) );

    $wp_customize->add_control( 'posts_grid_layout', array(
        'label'   => 'Grid layout for latest posts',
        'section' => 'front_page_layout',
        'type'    => 'select',
        'choices'    => array(
            'enable' => 'Enable',
            'disable' => 'Disable',
        ),
    ));
    $wp_customize->add_setting( 'posts_thumbnail', array(
        'default' => 'enable',
    ) );

    $wp_customize->add_control( 'posts_thumbnail', array(
        'label'   => 'Use Post Thumbnail',
        'section' => 'front_page_layout',
        'type'    => 'select',
        'choices'    => array(
            'enable' => 'Enable',
            'disable' => 'Disable',
        ),
    ));
    return $wp_customize;
}
// create widget areas: sidebar, footer
$sidebars = array('Sidebar');
foreach ($sidebars as $sidebar) {
    register_sidebar(array('name'=> $sidebar,
        'before_widget' => '<article id="%1$s" class="row widget %2$s"><div class="sidebar-section twelve columns">',
        'after_widget' => '</div></article>',
        'before_title' => '<h4><strong>',
        'after_title' => '</strong></h4>'
    ));
}
$sidebars = array('Footer');
foreach ($sidebars as $sidebar) {
    register_sidebar(array('name'=> $sidebar,
        'before_widget' => '<article id="%1$s" class="three columns widget %2$s"><div class="footer-section">',
        'after_widget' => '</div></article>',
        'before_title' => '<h4><strong>',
        'after_title' => '</strong></h4>'
    ));
}
/*  --------------------------------
:: ZURB Topbar for WordPress
--------------------------------- */

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
        'walker' => new narga_topbar_walker()
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
        'walker' => new narga_topbar_walker()
    ));
} // end right top bar

/*
Customize the output of menus for Foundation top bar classes and add descriptions
http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output
http://code.hyperspatial.com/1514/twitter-bootstrap-walker-classes/
 */
class narga_topbar_walker extends Walker_Nav_Menu {
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

// Navigation search form
if (!function_exists('search_form_navigation')) :  
    function search_form_navigation() {
        echo '<ul id="menu-right-topbar" class="top-bar-menu right">
            <li class="search"><form method="get" id="searchform" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
            <input type="text" class="field" name="s" id="s" placeholder="';
        esc_attr_e( 'Search', 'narga' );
        echo '" />
            </form></li>
            </ul>';
    }
endif;

// Secondary Menu is Widgetable
function widget_secondary_navigation() {
    echo "<article id=\"secondary_navigation\" class=\"row widget widget_secondary_navigation\"><div class=\"sidebar-section twelve columns\">";
    $menu = wp_nav_menu(array(
        'echo' => false,
        'items_wrap' => '<dl class="%2$s">%3$s</dl>','theme_location' => 'secondary_navigation', 'container' => false, 'menu_class' => 'sub-nav'
    )); 

    $search  = array('<ul', '</ul>', '<li', '</li>', 'current-menu-item');
    $replace = array('<dl', '</dl>', '<dd', '</dd>', 'active');
    echo str_replace($search, $replace, $menu);
    echo "</div></article>";
}
wp_register_sidebar_widget(
    '1',        // your unique widget id
    'Secondary Navigation',          // widget name
    'widget_secondary_navigation',  // callback function
    array(                  // options
        'description' => 'Display Secondary Navigation in sidebar'
    )
);


?>
