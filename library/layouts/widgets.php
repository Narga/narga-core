<?php
/**
 * NARGA Widgets
 * Included functions/settings/classes to make WordPress theme has
 * Widgetable for Sidebar, Footer
 * Some files are included based on theme support
 *
 * @package NARGA Core
 * @since 1.0
 * @author Nguyễn Đình Quân (@Narga / dinhquan@narga.net / http://www.narga.net/)
 * @copyright Copyright (c) 2013, Nguyen Dinh Quan a.k.a narga
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Widgetable for Sidebar, Footer
 * Registed widgets of sidebar, footer
 *
 * @since NARGA v1.1
 * @update NARGA v2.1
 */

if (!function_exists('narga_widgets_init')) :  
function narga_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Sidebar Widgets', 'narga' ),
        'id' => 'sidebar-1',
        'before_widget' => '<article id="%1$s" class="widget %2$s">',
        'after_widget' => '</article>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Widgets', 'narga' ),
        'id' => 'footer-1',
        'before_widget' => '<article id="%1$s" class="large-' . narga_widgets_count( 'footer-1' ) . ' medium-' . narga_widgets_count( 'footer-1' ) . ' small-12 columns widget %2$s">',
        'after_widget' => '</article>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
}

add_action( 'widgets_init', 'narga_widgets_init', 10 );
endif;

/**
 * Get number of active WordPress widgets in a footer widget area
 * to calculate the columns follow number of widgets.
 *
 * @since NARGA v1.5
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

?>
