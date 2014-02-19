<?php
/**
 * NARGA Customizer
 * 
 * @package WordPress
 * @subpackage NARGA
 * Since NARGA v0.1
 *
 **/

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function narga_customize_register( $wp_customize ) {
    $readmore = narga_options ('post_readmore');
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'narga_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Since NARGA v1.6
 *
 */
function narga_customize_preview_js() {
	wp_enqueue_script( 'narga_customizer', get_template_directory_uri() . '/javascripts/customizer.js', array( 'customize-preview' ), '20130916', true );
}
add_action( 'customize_preview_init', 'narga_customize_preview_js' );


/**
 * NARGA TextArea Control Class
 *
 * Since NARGA v0.5
 **/

if ( class_exists( 'WP_Customize_Control' ) ) {
    # Adds textarea support to the theme customizer
    class NargaTextAreaControl extends WP_Customize_Control {
        public $type = 'textarea'; # can change to 'number' for input[type=number] field
        public function __construct( $manager, $id, $args = array() ) {
            $this->statuses = array( '' => __( 'Default', 'narga' ) );
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {
            echo '<label>
                <span class="customize-control-title">' . esc_html( $this->label ) . '</span>
                <textarea rows="5" style="width:100%;" ';
            $this->link();
            echo '>' . esc_textarea( $this->value() ) . '</textarea>
                </label>';
        }
    }

}
/**
 * NARGA Category Drop Down List Class
 *
 * modified dropdown-pages from wp-includes/class-wp-customize-control.php
 *
 * @since NARGA v1.0
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
    public $type = 'dropdown-categories';	

    public function render_content() {
        $dropdown = wp_dropdown_categories( 
            array( 
                'name'             => '_customize-dropdown-categories-' . $this->id,
                'echo'             => 0,
                'hide_empty'       => false,
                'show_option_none' => '&mdash; ' . __('Select', 'reactor') . ' &mdash;',
                'hide_if_empty'    => false,
                'selected'         => $this->value(),
            )
        );

        $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

        printf( 
            '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
            $this->label,
            $dropdown
        );
    }
}
}
/**
 * Returns the options array for NARGA
 * @since NARGA 1.3.5
 */
function narga_options($name, $default = false) {
    $options = ( get_option( 'narga_options' ) ) ? get_option( 'narga_options' ) : null;
    // return the option if it exists
    if ( isset( $options[ $name ] ) ) {
        return apply_filters( 'narga_options_$name', $options[ $name ] );
    }
    // return default if nothing else
    return apply_filters( 'narga_options_$name', $default );
}

/**
 * Narga's Theme Customizer Settings
 *
 * Since NARGA v0.5
 *
 **/
add_action( 'customize_register', 'narga_customizer' );
function narga_customizer($wp_customize){
    
    /**
     * Remove default WP Customize sections
     *
     * @since 1.6
     * 
     */
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('static_front_page');


    # General Settings
    $wp_customize->add_section('narga_general_settings', array(
        'title' => 'General Settings',
        'description'    => __('Website General Settings', 'narga'),
        'priority' => 59,
        'transport' => 'postMessage',
    ));

    $wp_customize->add_setting('blogname', array( 
        'default'    => get_option('blogname'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
    ) );

    $wp_customize->add_control('blogname', array( 
        'label'    => __('Site Title', 'narga'),
        'section'  => 'narga_general_settings',
        'priority' => 1,
    ) );
    
    $wp_customize->add_setting('blogdescription', array( 
        'default'    => get_option('blogdescription'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
    ) );
    
    $wp_customize->add_control('blogdescription', array( 
        'label'    => __('Tagline', 'narga'),
        'section'  => 'narga_general_settings',
        'priority' => 2,
    ) );

    $wp_customize->add_setting('display_header_text', array( 
        'default'    => 1,
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
    ) );	

    $wp_customize->add_setting('narga_options[favicon]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'narga_favicon', array(
        'label'    => __('Favicon', 'narga'),
        'section'  => 'narga_general_settings',
        'settings' => 'narga_options[favicon]',
        'priority' => 5,
    ) ) );

    $wp_customize->add_control( 'display_header_text', array(
        'settings' => 'header_textcolor',
        'label'    => __( 'Show Title & Tagline', 'narga' ),
        'section'  => 'narga_general_settings',
        'type'     => 'checkbox',
        'priority' => 4,
    ) );
    
   $wp_customize->add_section( 'header_image', array(
        'title'          => __( 'Header and Logo', 'narga' ),
        'theme_supports' => 'custom-header',
        'priority'       => 60,
    ) );

    /* Custom Logo */
     $wp_customize->add_setting('narga_options[logo]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'narga_logo', array(
        'label'    => __('Logo', 'narga'),
        'section'  => 'header_image',
        'settings' => 'narga_options[logo]',
        'priority' => 1,
    ) ) );

    $wp_customize->add_section( 'background_image', array(
        'title'          => __( 'Background Settings', 'narga' ),
        'theme_supports' => 'custom-background',
        'priority'       => 80,
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_textcolor', array(
        'label'   => __( 'Header Text Color', 'narga' ),
        'section' => 'header_image',
    ) ) );
    
    $wp_customize->add_setting( 'background_color', array(
        'default'        => get_theme_support( 'custom-background', 'default-color' ),
        'theme_supports' => 'custom-background',
        'sanitize_callback'    => 'sanitize_hex_color_no_hash',
        'sanitize_js_callback' => 'maybe_hash_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
        'label'   => __( 'Background Color', 'narga' ),
        'section' => 'background_image',
    ) ) );


    # Orbit Slider as Featured Slider
    $wp_customize->add_section('narga_featured_categories', array(
        'title' => 'Featured Posts Slider',
        'priority' => 81,
        'description'    => __('Orbit Slider Configuration', 'narga'),
        'transport' => 'postMessage',
    ));

    $wp_customize->add_setting('narga_options[featured_category]', array(
        'default'        => '',
        'type'           => 'option',
        'capability'     => 'manage_options',
    ) );

    $wp_customize->add_control( new WP_Customize_Dropdown_Categories_Control( $wp_customize, 'narga_featured_category', array( 
        'label'    => __('Featured Category<br /><span style="font-weight:normal;font-style:italic;">The slides are responsive but make sure your image has at least 640x290.</span>', 'narga'),
        'section'  => 'narga_featured_categories',
        'type'     => 'dropdown-categories',
        'settings' => 'narga_options[featured_category]',
        'priority' => 1,
    ) ) );

    $wp_customize->add_setting( 'narga_options[number_slide]', array(
        'default'        => '5',
        'type'           => 'option',
        'capability'     => 'manage_options',
        'transport'      => 'postMessage',
    ) );

    $wp_customize->add_control( 'narga_options[number_slide]', array(
        'label'   => __('Number Slide', 'narga'),
        'section' => 'narga_featured_categories',
        'type'     => 'text',
        'priority' => 2,
    ) );

    # Orbit Slide Indicator
    $wp_customize->add_setting('narga_options[slide_indicator]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ) );

    $wp_customize->add_control('narga_options[slide_indicator]', array(
        'settings'  => 'narga_options[slide_indicator]',
        'label'     => __('Slide Indicator', 'narga'),
        'section'   => 'narga_featured_categories',
        'type'      => 'checkbox',
        'transport' => 'postMessage',
        'priority'  => 3,
    ) );

    # Orbit Slide Indicator
    $wp_customize->add_setting('narga_options[resume_on_mouseout]', array(
        'capability' => 'edit_theme_options',
        'default'    => '1',
        'type'       => 'option',
    ) );

    $wp_customize->add_control('narga_options[resume_on_mouseout]', array(
        'settings'  => 'narga_options[resume_on_mouseout]',
        'label'     => __('Pauses slider while hovering.', 'narga'),
        'section'   => 'narga_featured_categories',
        'type'      => 'checkbox',
        'transport' => 'postMessage',
        'priority'  => 3,
    ) );

    # Use default image for slides without featured post image
    $wp_customize->add_setting('narga_options[default_slides_image]', array(
        'capability' => 'edit_theme_options',
        'default'    => '1',
        'type'       => 'option',
    ) );

    $wp_customize->add_control('narga_options[default_slides_image]', array(
        'settings'  => 'narga_options[default_slides_image]',
        'label'     => __('Use built in default image for post without featured image.', 'narga'),
        'section'   => 'narga_featured_categories',
        'type'      => 'checkbox',
        'priority'  => 4,
    ) );

    # Display Top Bar Title
    $wp_customize->add_setting('narga_options[show_topbar_title]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ) );

    $wp_customize->add_control('narga_options[show_topbar_title]', array(
        'settings'  => 'narga_options[show_topbar_title]',
        'label'     => __('Display Top Bar Title', 'narga'),
        'section'   => 'nav',
        'type'      => 'checkbox',
        'transport' => 'postMessage',
        'priority'  => 0,
    ) );

    # Top Bar Title
    $wp_customize->add_setting( 'narga_options[topbar_title]', array(
        'default'        => get_bloginfo('name'),
        'type'           => 'option',
        'capability'     => 'manage_options',
        'transport'      => 'postMessage',
    ) );

    $wp_customize->add_control( 'narga_options[topbar_title]', array(
        'label'   => __('Top Bar Title', 'narga'),
        'section' => 'nav',
        'type'     => 'text',
        'priority' => 1,
    ) );

    $wp_customize->add_setting( 'narga_options[topbar_title_url]', array(
        'default'        => home_url(),
        'type'           => 'option',
        'capability'     => 'manage_options',
    ) );

    $wp_customize->add_control( 'narga_options[topbar_title_url]', array(
        'label'   => __('Top Bar URL', 'narga'),
        'section' => 'nav',
        'type'     => 'text',
        'priority' => 2,
    ) );

    # Sticky Top Bar Option
    $wp_customize->add_setting('narga_options[sticky_topbar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ) );

    $wp_customize->add_control('narga_options[sticky_topbar]', array(
        'settings'  => 'narga_options[sticky_topbar]',
        'label'     => __('Sticky Top Bar', 'narga'),
        'section'   => 'nav',
        'type'      => 'checkbox',
        'transport' => 'postMessage',
        'priority'  => 3,
    ) );

    # Contain Top Bar Layout Width 
    $wp_customize->add_setting('narga_options[contain2grid]', array(
        'capability'    => 'manage_options',
        'type'          => 'option',
    ) );

    $wp_customize->add_control('narga_options[contain2grid]', array(
        'settings' => 'narga_options[contain2grid]',
        'label'    => __('Contain Top Bar Layout Width', 'narga'),
        'section'  => 'nav',
        'type'     => 'checkbox',
        'transport' => 'postMessage',
        'priority' => 4,
    ) );

    # Top Bar Search Form
    $wp_customize->add_setting('narga_options[search_form]', array(
        'default'        => '1',
        'capability'     => 'manage_options',
        'type'       => 'option',
    ) );

    $wp_customize->add_control('narga_options[search_form]', array(
        'type' => 'checkbox',
        'label' => __('Top Bar Search Form', 'narga'),
        'section' => 'nav',
        'priority' => 5,
    ) );

    # Front Page Settings
    $wp_customize->add_section( 'static_front_page', array(
        'title'          => __( 'Front Page Settings', 'narga' ),
        'priority'       => 120,
        'description'    => __( 'Your theme supports a static front page.', 'narga'),
    ) );

    $wp_customize->add_setting( 'narga_options[sidebar_position]', array(
        'default' => 'left',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ) );
 
    $wp_customize->add_control( 'narga_options[sidebar_position]', array(
        'type' => 'radio',
        'label' => 'Sidebar Position',
        'section' => 'static_front_page',
        'priority' => 1,
        'choices' => array(
            'left' => 'Left',
            'right' => 'Right',
        ),
    ) );

    $wp_customize->add_setting( 'show_on_front', array(
        'default'        => get_option( 'show_on_front' ),
        'capability'     => 'manage_options',
        'type'           => 'option',
        //	'theme_supports' => 'static-front-page',
    ) );

    $wp_customize->add_control( 'show_on_front', array(
        'label'   => __( 'Front page displays', 'narga' ),
        'section' => 'static_front_page',
        'type'    => 'radio',
        'choices' => array(
            'posts' => __( 'Your latest posts', 'narga' ),
            'page'  => __( 'A static page', 'narga' ),
        ),
    ) );
    
    $wp_customize->add_setting( 'page_on_front', array(
        'type'       => 'option',
        'capability' => 'manage_options',
    ) );

    $wp_customize->add_control( 'page_on_front', array(
        'label'      => __( 'Front page', 'narga' ),
        'section'    => 'static_front_page',
        'type'       => 'dropdown-pages',
    ) );

    $wp_customize->add_setting( 'page_for_posts', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        //	'theme_supports' => 'static-front-page',
    ) );

    $wp_customize->add_control( 'page_for_posts', array(
        'label'      => __( 'Posts page', 'narga' ),
        'section'    => 'static_front_page',
        'type'       => 'dropdown-pages',
    ) );

    # Singular Settings
    $wp_customize->add_section( 'singular_settings', array(
        'title'          => __( 'Post Settings', 'narga' ),
        'priority'       => 130,
        'description'    => __( 'In this section, you can turn on/off post features like: meta, tags, post navigation, author information...', 'narga'),
    ) );

    # Breadcrumb Control
    $wp_customize->add_setting('narga_options[breadcrumb]', array(
        'capability'     => 'manage_options',
        'type'       => 'option',
    ) );

    $wp_customize->add_control('narga_options[breadcrumb]', array(
        'type'      => 'checkbox',
        'label'     => __('Display Breadcrumb','narga'),
        'section'   => 'singular_settings',
        'transport' => 'postMessage',
        'priority'  => 1,
    ) );

    $wp_customize->add_setting( 'narga_options[post_meta]', array(
        'default'       => '1',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ) );
 
    $wp_customize->add_control( 'narga_options[post_meta]', array(
        'settings'  => 'narga_options[post_meta]',
        'label'     => 'Show Post meta.',
        'section'   => 'singular_settings',
        'priority'  => 2,
        'type'      => 'checkbox',
    ) );

    $wp_customize->add_setting( 'narga_options[display_tags]', array(
        'default'       => '1',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ) );
 
    $wp_customize->add_control( 'narga_options[display_tags]', array(
        'settings'  => 'narga_options[display_tags]',
        'label'     => 'Display post tags.',
        'section'   => 'singular_settings',
        'priority'  => 3,
        'type'      => 'checkbox',
    ) );

    $wp_customize->add_setting( 'narga_options[posts_navigation]', array(
        'default'       => '1',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ) );
 
    $wp_customize->add_control( 'narga_options[posts_navigation]', array(
        'settings'  => 'narga_options[posts_navigation]',
        'label'     => 'Post navigation.',
        'section'   => 'singular_settings',
        'priority'  => 4,
        'type'      => 'checkbox',
    ) );

    $wp_customize->add_setting( 'narga_options[post_author]', array(
        'default'       => '1',
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ) );
 
    $wp_customize->add_control( 'narga_options[post_author]', array(
        'settings'  => 'narga_options[post_author]',
        'label'     => 'Display author bio.',
        'section'   => 'singular_settings',
        'priority'  => 5,
        'type'      => 'checkbox',
    ) );

    # Custom Read More Text
    $wp_customize->add_setting('narga_options[post_readmore]', array(
        'default'    => __('Read More &raquo;', 'narga'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport' => 'postMessage',
    ) );

    $wp_customize->add_control('narga_options[post_readmore]', array( 
        'label'    => __('Read More Text', 'narga'),
        'section'  => 'singular_settings',
        'type'     => 'text',
        'priority' => 6,
    ) );
}

/**
 * Widgetable for Sidebar, Footer
 * Since NARGA v1.1
 */
$sidebars = array('Sidebar');
foreach ($sidebars as $sidebar) {
    register_sidebar(array('name'=> $sidebar,
        'before_widget' => '<article id="%1$s" class="widget %2$s">',
        'after_widget' => '</article>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));
}
$sidebars = array('Footer');
foreach ($sidebars as $sidebar) {
    register_sidebar(array('name'=> $sidebar,
        'before_widget' => '<article id="%1$s" class="large-' . narga_widgets_count( 'sidebar-2' ) . ' columns widget %2$s">',
        'after_widget' => '</article>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
}

/**
 * Get number of active WordPress widgets in a footer widget area
 * Since NARGA v1.5
 */

function narga_widgets_count( $sidebar_id ) {

    # Default Foundation Grid is 12 columns
    $total_columns = '12';
    $sidebars_widgets = wp_get_sidebars_widgets();

    // if sidebar doesn't exist return error
    if ( !isset( $sidebars_widgets[$sidebar_id] ) ) {
        return __('Invalid sidebar ID', 'narga');
    }
    # return (int) count( (array) $sidebars_widgets[ $sidebar_id ] );
    $count_widgets = count( $sidebars_widgets[ $sidebar_id ] );
    /* count number of widgets in the sidebar and do some simple math to calculate the columns */
    switch( $count_widgets ) {
		case 1 : $count_widgets = $columns; break;
		case 2 : $count_widgets = $total_columns / 2; break;
		case 3 : $count_widgets = $total_columns / 3; break;
		case 4 : $count_widgets = $total_columns / 4; break;
		case 5 : $count_widgets = $total_columns / 5; break;
		case 6 : $count_widgets = $total_columns / 6; break;
		case 7 : $count_widgets = $total_columns / 7; break;
		case 8 : $count_widgets = $total_columns / 8; break;
    }
    return $count_widgets = ceil( $count_widgets );

}

/**
 * Footer Naviagation
 * Since NARGA v1.1
 */ 
if (!function_exists('narga_footer_navigation')) :  
    function narga_footer_navigation() {
        $menu = wp_nav_menu(array(
            'echo' => false,
            'items_wrap' => '<dl class="%2$s">%3$s</dl>',
            'theme_location' => 'footer_navigation',
            'container' => false,
            'menu_class' => 'sub-nav right'
        )); 
        $search  = array('<ul', '</ul>', '<li', '</li>', 'current-menu-item');
        $replace = array('<dl', '</dl>', '<dd', '</dd>', 'active');
        echo str_replace($search, $replace, $menu);
    }
endif;

?>
