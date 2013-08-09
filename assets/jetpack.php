<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package NARGA
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
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
