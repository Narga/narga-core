<?php
/**
 * Footer Content
 * hook in the content for footer.php
 *
 * @package NARGA Core
 * @since 1.0
 * @author Nguyễn Đình Quân (@Narga / dinhquan@narga.net / http://www.narga.net/)
 * @copyright Copyright (c) 2013, Nguyen Dinh Quan a.k.a narga
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Footer Naviagation
 * @since NARGA v1.1
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
