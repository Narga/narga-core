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
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
        'uploads'                => true,
        'default-text-color'     => '',
        'wp-head-callback'       => 'narga_header_style',
        'admin-head-callback'    => 'narga_admin_header_style',
        'admin-preview-callback' => 'narga_admin_header_image',
    ) ) );
}
add_action( 'after_setup_theme', 'narga_custom_header_setup' );

/**
 * Function to generate blog name and subheader for custom as users
 * want without copy the header.php file in child theme
 * Since NARGA v1.1
 */
if (!function_exists('narga_header')) :  
    function narga_header() {
        $header_image = get_header_image();
        echo '<header id="header" class="row site-header" role="banner">
            <div class="site-branding large-12 columns">';
        echo '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo('name') . '</a></h1>
            <h4 id="tagline" class="subheader site-description hide-for-small">' . get_bloginfo('description') . '</h4>';
        if ( ! empty( $header_image ) ) :
            echo '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( get_header_image() ) . '" class="header-image" width="' . get_custom_header()->width . '" height="' . get_custom_header()->height . '" alt="" /></a>';
        endif;
        echo '</div>
            </header>';
    }  
endif;
  
/**
 * Styles the header image and text displayed on the blog
 * @see narga_custom_header_setup().
 * Since NARGA v1.5
 */
if ( ! function_exists( 'narga_header_style' ) ) :
function narga_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // narga_header_style
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see narga_custom_header_setup().
 * Since NARGA v1.5
 */
if ( ! function_exists( 'narga_admin_header_style' ) ) :
function narga_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // narga_admin_header_style

if ( ! function_exists( 'narga_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see narga_custom_header_setup().
 * Since NARGA v1.5
 */
function narga_admin_header_image() {
	$style        = sprintf( ' style="color:#%s;"', get_header_textcolor() );
	$header_image = get_header_image();
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // narga_admin_header_image
