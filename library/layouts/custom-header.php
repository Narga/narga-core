<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

<?php $header_image = get_header_image();
if ( ! empty( $header_image ) ) { ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
    <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
    </a>
    <?php } // if ( ! empty( $header_image ) ) ?>

    *
    * @package WordPress
    * @subpackage NARGA
    * @since NARGA v1.5.1
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses narga_header_style()
 * @uses narga_admin_header_style()
 * @uses narga_admin_header_image()
 *
 * @package NARGA
 */
function narga_custom_header_setup() {
    add_theme_support( 'custom-header', apply_filters( 'narga_custom_header_args', array(
        'default-image'          => '',
        'random-default'         => false,
        'width'                  => 0,
        'height'                 => 0,
        'flex-height'            => true,
        'flex-width'             => true,
        'header-text'            => true,
        'uploads'                => true,
        'default-text-color'     => 'fff',
        'wp-head-callback'       => 'narga_header_style',
        'admin-head-callback'    => 'narga_admin_header_style',
        'admin-preview-callback' => 'narga_admin_header_image',
    ) ) );
}
add_action( 'after_setup_theme', 'narga_custom_header_setup', 14 );

/**
 * Function to generate blog name and subheader for custom as users
 * want without copy the header.php file in child theme
 * Since NARGA v1.1
 */
if (!function_exists('narga_header')) :  
    function narga_header() {
        echo '<header id="header" class="row" role="banner">';
        if ( get_header_image() && ( narga_options('custom_header_image_background') == 1 ) ) {
            echo '<div id="site-header" class="site-header">';
            narga_custom_logo();
            echo '</div>';
        } elseif ( get_header_image() && ( narga_options('custom_header_image_background') == 0 ) ) {
            echo '<div id="site-header">';
            echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home"><img src="' . esc_url( get_header_image() ) . '" class="header-image" width="' . get_custom_header()->width . '" height="' . get_custom_header()->height . '" alt=""></a>';
            echo '</div>';
        } else {
            narga_custom_logo();
        }
        echo '</header>';
    }
endif;
/**
 * Display custom logo if it exist
 * @since NARGA v2.1
 */
if ( ! function_exists( 'narga_custom_logo' ) ) :
    function narga_custom_logo() {
        echo '<div id="custom-header" class="custom-header column">';
        # Custom logo
        if (narga_options('logo') != '') {
            echo '
                <h1 id="custom-logo"><a href="' . esc_url( home_url( '/' ) ) . '"  title="' . get_bloginfo('description') . '"><img src="' . narga_options('logo') . '" class="custom-logo" alt="' . get_bloginfo('description') . '" /></a></h1>
                <h2 id="custom-tagline" class="tagline hide">' . get_bloginfo('description') . '</h2>';
        }  else {
            echo '<h1 id="custom-title" class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo('name') . '</a></h1>
                <h4 id="custom-tagline" class="tagline hide-for-small">' . get_bloginfo('description') . '</h4>';
        }
        echo '</div>';
    }
endif;

/**
 * Styles the header image and text displayed on the blog
 * @see narga_custom_header_setup().
 * @since NARGA v1.5
 */
if ( ! function_exists( 'narga_header_style' ) ) :
    function narga_header_style() {
        $header_text_color = get_header_textcolor();
        $header_image = get_header_image();
        $text_color   = get_header_textcolor();

        // If no custom options for text are set, let's bail.
        if ( empty( $header_image ) && $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
            return;

        // If we get this far, we have custom styles.
        echo '<style type="text/css" id="narga-header-css">';
        if ( ! empty( $header_image ) ) {
            echo '.site-header {
                background: url("' . get_header_image() . '") no-repeat scroll top;
                background-size: 1600px auto;
                height: ' . get_custom_header()->height . 'px;
                width: 100%;
        }

        .custom-header {
            position: absolute;
            top: 40%;
            transform: translate(0, -50%);
        }';
        }
        // Has the text been hidden?
        if ( ! display_header_text() ) {
            echo '.site-title,
                .site-description {
                    position: absolute;
                    clip: rect(1px 1px 1px 1px); /* IE7 */
                    clip: rect(1px, 1px, 1px, 1px);
        }';

        if ( empty( $header_image ) ) 
            echo '.site-header .home-link {
                min-height: 0;
        }';
        // If the user has set a custom color for the text, use that.
        } elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) {
            echo '.site-title,
                .site-description {
                    color: #' . esc_attr( $text_color ) . ';
        }';
        }
        echo '</style>';
    }
endif; // narga_header_style

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see narga_custom_header_setup().
 * @since NARGA v1.5
 */
if ( ! function_exists( 'narga_admin_header_style' ) ) :
    function narga_admin_header_style() {
        narga_header_style();
        echo '<style type="text/css">
            .custom-header {
                position: absolute;
                top:25%;
                left:25%;
                transform: translate(0, -50%);
    }
.hide { display:none}
</style>';
    }
endif; // narga_admin_header_style

/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 * 
 * @see narga_custom_header_setup().
 * @since NARGA v1.5
 **/
if ( ! function_exists( 'narga_admin_header_image' ) ) :
    function narga_admin_header_image() {
        narga_header();
    }
endif; # narga_admin_header_image

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * based on Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
if (!function_exists('narga_wp_title')) :  
    function narga_wp_title( $title, $sep ) {
        global $paged, $page;

        if ( is_feed() )
            return $title;

        // Add the site name.
        $title .= get_bloginfo( 'name' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";

        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', 'narga' ), max( $paged, $page ) );

        return $title;
    }
add_filter( 'wp_title', 'narga_wp_title', 10, 2 );
endif;

/**
 * Custom Fonts
 * Functions to change default theme typography
 * Inspired from http://wptheming.com/2012/06/loading-google-fonts-from-theme-options
 *
 * @since NARGA v2.1
 */

if ( !class_exists( 'NargaGoogleFontControlPro', false ) ) :
    /**
     * Font list
     * A list of fonts that is choosable.
     *
     * @since NARGA v2.1
     */

    if ( !function_exists('narga_fonts_list') ) {
        function narga_fonts_list(){
            $font_faces = array(
                "'Arvo', serif" => "Arvo",
                "'Copse', sans-serif" => "Copse",
                "'Cabin', sans-serif" => "Cabin",
                "'Droid Sans', sans-serif" => "Droid Sans",
                "'Droid Serif', serif" => "Droid Serif",
                "'Economica'', sans-serif" => "Economica",
                "'Helvetica Neue', sans-serif" => "Helvetica Neue",
                "'Josefin Slab', serif" => "Josefin Slab",
                "'Lato', sans-serif" => "Lato",
                "'Lobster', cursive" => "Lobster",
                "'Nobile', sans-serif" => "Nobile",
                "'Open Sans', sans-serif" => "Open Sans",
                "'Oswald', sans-serif" => "Oswald",
                "'Poly', sans-serif" => "Poly",
                "'Pacifico', cursive" => "Pacifico",
                "'Roboto', sans-serif" => "Roboto",
                "'Rokkitt', serif" => "Rokkit",
                "'PT Sans', sans-serif" => "PT Sans",
                "'Quattrocento', serif" => "Quattrocento",
                "'Raleway', cursive" => "Raleway",
                "'Titillium Web', sans-serif" => "Titillium Web",
                "'Ubuntu', sans-serif" => "Ubuntu",
                "'Vollkorn', serif" => "Vollkorn",
                "'Yanone Kaffeesatz', sans-serif" => "Yanone Kaffeesatz");
            return $font_faces;
        }
    }

/**
 * Create an array of fonts to be enqueued
 *
 * @since NARGA v2.1
 */
function narga_custom_fonts(){
    $all_font_faces = array_keys( narga_fonts_list() );
    // Get the font face for each option and put it in an array
    $content_font = narga_options('body_font', "'Helvetica Neue', Helvetica, Arial, sans-serif");
    $title_font = narga_options('heading_font', "'Helvetica Neue', Helvetica, Arial, sans-serif");
    $selected_fonts = array(
        $content_font,
        $title_font );
    // Remove any duplicates in the list
    $selected_fonts = array_unique( $selected_fonts );
    // Check each of the unique fonts against the defined Google fonts
    // If it is a Google font, go ahead and call the function to enqueue it
    foreach ( $selected_fonts as $font ){
        if ( in_array( $font, $all_font_faces ) ){
            narga_enqueue_custom_font( $font );
        }
    }
}
add_action('wp_enqueue_scripts', 'narga_custom_fonts');

/**
 * Enqueues the Google $font that is passed
 *
 * @since NARGA v2.1
 */

function narga_enqueue_custom_font( $font ){
    $font = explode( ',', $font );
    $font = $font[0];
    $font = preg_replace( '/[^A-Za-z0-9 ]/', '', $font );
    $font = str_replace( ' ', '+', $font );
    $handle = 'narga-typography-' . $font;
    $src = 'http://fonts.googleapis.com/css?family=' . $font .':400italic,700italic,400,700?ver=20140330';
    wp_enqueue_style( $handle, $src, false, null, 'all' );
}

/**
 * Add Customizer generated CSS to header
 *
 * @since NARGA v2.1
 */
function narga_custom_fonts_css() {
    do_action('narga_custom_fonts_css');

    $output = '';

    if ( narga_options('heading_font') != '\'Helvetica Neue\', sans-serif' ) 
        $output .= "\n" . 'h1, h2, h3, h4, h5, h6, .slider-title, li.menu-item a { font-family: ' . narga_options('heading_font') . ' !important; }';
    

    if ( narga_options('body_font') != '\'Helvetica Neue\', sans-serif' ) {
        $output .= "\n" . 'body, p  { font-family: ' . narga_options('body_font') . ' !important; }';
    }

    echo ( $output ) ? '<style>' . apply_filters('narga_custom_fonts_css', $output) . "\n" . '</style>' . "\n" : '';
}

add_action('wp_head', 'narga_custom_fonts_css');

endif;

/**
 * Custom Favicon
 * If the custom favicon hasn't defined, the default favicon will uses.
 *
 * @since NARGA v2.1
 */
if (!function_exists('narga_custom_favicon')) :  
function narga_custom_favicon () {
    # Custom favicon
    echo "\t" . '<link rel="shortcut icon" type="image/png" href="';
    if (narga_options('favicon') != '') :
        echo narga_options('favicon');
    else :
        echo get_stylesheet_directory_uri() . '/core/images/favicon.png';
    endif;
    echo '">' . "\n";
}
# Attach custom favicon to header
add_action('wp_head', 'narga_custom_favicon', 7);
endif;

?>
