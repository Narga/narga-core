<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package WordPress
 * @subpackage NARGA
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://wwww.narga.net/how-to-make-your-theme-support-jetpacks-infinite-scroll-feature/
 */

function narga_jetpack_setup() {
    add_theme_support( 'infinite-scroll', array(
        'footer'    => 'footer-info',
        'type'           => 'scroll',
        'footer_widgets' => false,
        'container'      => 'main-content',
        'wrapper'        => true,
        'render'         => false,
        'posts_per_page' => false
    ) );
}
add_action( 'after_setup_theme', 'narga_jetpack_setup' );

?>
