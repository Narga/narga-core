<?php 
/**
 * NARGA Get Options
 * Based on get_theme_mod in wp-includes/theme.php
 * This function retrieves an option from the database or cache
 * can also get a value from post meta
 *
 * @package NARGA Core
 * @since 1.0.0
 * @author Nguyễn Đình Quân (@Narga / dinhquan@narga.net / http://www.narga.net/)
 * @param $name option name in database
 * @param $default a default value if option is avialble
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Returns the options array for NARGA
 * @since NARGA 1.3.5
 */
function narga_options($name, $default = false) {

    // get the meta from the database
    $options = ( get_option( 'narga_options' ) ) ? get_option( 'narga_options' ) : null;

    // return the option if it exists
    if ( isset( $options[ $name ] ) ) {
        return apply_filters( 'narga_options_$name', $options[ $name ] );
    }

    // return default if nothing else
    return apply_filters( 'narga_options_$name', $default );
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since NARGA v1.6
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
 * @since NARGA v1.6
 */
function narga_customize_preview_js() {
	wp_enqueue_script( 'narga_customizer', get_template_directory_uri() . '/core/js/customizer.js', array( 'customize-preview' ), '20140316', true );
}
add_action( 'customize_preview_init', 'narga_customize_preview_js' );

?>
