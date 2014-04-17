<?php
/**
 * NARGA Customizer Settings
 * Add/Remove/Change settings to WordPress Theme
 *
 * @package NARGA Core
 * @since 1.0
 * @author Nguyễn Đình Quân (@Narga / dinhquan@narga.net / http://www.narga.net/)
 * @copyright Copyright (c) 2013, Nguyen Dinh Quan a.k.a narga
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * NARGA Customizer Settings
 *
 * @since NARGA v0.5
 **/
add_action( 'customize_register', 'narga_customizer' );
function narga_customizer($wp_customize){

    # General Settings
    $wp_customize->add_section('narga_general_settings', array(
        'title'      => __('General Settings', 'narga'),
        'description'    => __('Website General Settings', 'narga'),
        'transport'  => 'postMessage',
        'priority'   => 40,
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

    // Typography section
    $wp_customize->add_section( 'typography', array(
        'title' => __( 'Typography', 'narga' ),
        'description'    => __('Select Google Webfonts', 'narga'),
        'priority' => 50,
    ) );

   # Heading Fonts
    $wp_customize->add_setting( 'narga_options[heading_font]', array(
        'default' => "'Economica'', sans-serif",
        'type' => 'option',
        'capability' => 'edit_theme_options'
    ) );

    if ( class_exists( 'NargaGoogleFontControlPro' ) ) {
    $wp_customize->add_control( new NargaGoogleFontControlPro( $wp_customize, 'narga_options[heading_font]', array(
        'label'   => __( 'Heading Fonts', 'narga' ),
        'section' => 'typography',
        'settings'   => 'narga_options[heading_font]',
        'priority' => 1
    ) ) );

    } else {
        $wp_customize->add_control( 'heading_font', array(
            'settings' => 'narga_options[heading_font]',
            'label'   => __( 'Heading Fonts', 'narga' ),
            'section' => 'typography',
            'type'    => 'select',
            'choices'    => narga_fonts_list(),
        ));
    }

    # Body Fonts
    $wp_customize->add_setting( 'narga_options[body_font]', array(
        'default' => "'Open Sans', sans-serif",
        'type' => 'option',
        'capability' => 'manage_options'
    ) );

    if ( class_exists( 'NargaGoogleFontControlPro' ) ) {
        
        $wp_customize->add_control( new NargaGoogleFontControlPro( $wp_customize, 'narga_options[body_font]', array(
            'label'   => __( 'Body Fonts', 'narga' ),
            'section' => 'typography',
            'settings'   => 'narga_options[body_font]',
            'priority' => 2
        ) ) );

    } else {
        $wp_customize->add_control( 'body_font', array(
            'settings' => 'narga_options[body_font]',
            'label'   => __( 'Body Fonts', 'narga' ),
            'section' => 'typography',
            'type'    => 'select',
            'choices'    => narga_fonts_list(),
        ));
    }

    // Custom header and logo settings
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

    # Custom Header Image as Header Background
    $wp_customize->add_setting('narga_options[custom_header_image_background]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '0',
    ) );

    $wp_customize->add_control('narga_options[custom_header_image_background]', array(
        'settings'  => 'narga_options[custom_header_image_background]',
        'label'     => __('Custom Header Image as Header Background', 'narga'),
        'section'   => 'header_image',
        'type'      => 'checkbox',
        'transport' => 'postMessage',
        'priority'  => 11,
    ) );

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

    # Pause slides when the mouse hovering
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
        'priority'  => 4,
    ) );

     # Only show the slider on medium screen size 1024px and abouve
    $wp_customize->add_setting('narga_options[medium_screen_up]', array(
        'capability' => 'edit_theme_options',
        'default'    => '1',
        'type'       => 'option',
    ) );

    $wp_customize->add_control('narga_options[medium_screen_up]', array(
        'settings'  => 'narga_options[medium_screen_up]',
        'label'     => __('Show Slider on medium screens and up.', 'narga'),
        'section'   => 'narga_featured_categories',
        'type'      => 'checkbox',
        'transport' => 'postMessage',
        'priority'  => 5,
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
        'priority'  => 6,
    ) );

    # Disable Top Bar
        $wp_customize->add_setting('narga_options[disable_topbar]', array(
        'default'   => '0',
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ) );

    $wp_customize->add_control('narga_options[disable_topbar]', array(
        'settings'  => 'narga_options[disable_topbar]',
        'label'     => __('Disable Topbar', 'narga'),
        'section'   => 'nav',
        'type'      => 'checkbox',
        'transport' => 'postMessage',
        'priority'  => 0,
    ) );

    # Display Top Bar Title
    $wp_customize->add_setting('narga_options[show_topbar_title]', array(
        'default'   => '0',
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ) );

    $wp_customize->add_control('narga_options[show_topbar_title]', array(
        'settings'  => 'narga_options[show_topbar_title]',
        'label'     => __('Display Top Bar Title', 'narga'),
        'section'   => 'nav',
        'type'      => 'checkbox',
        'transport' => 'postMessage',
        'priority'  => 1,
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
        'priority' => 2,
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
        'priority' => 3,
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
        'transport' => 4,
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
        'priority' => 5,
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
        'priority' => 6,
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
        'default'    => __('<span class="label radius">Read More &raquo;</span>', 'narga'),
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

?>
