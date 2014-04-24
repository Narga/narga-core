<?php
/**
 * NARGA - A Core WordPress Theme based on Foundation by ZURB
 * Include the necessary files for NARGA's Themes
 * Some files are included based on theme support
 *
 * @package NARGA Core
 * @since 1.0
 * @author Nguyễn Đình Quân (@Narga / dinhquan@narga.net / http://www.narga.net/)
 * @copyright Copyright (c) 2013, Nguyen Dinh Quan a.k.a narga
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Includes the pro and custom functions if it exists
 *
 * @since NARGA v1.1
 **/
// Includes the pro folder if it exists
if(!defined('PRO_FOLDER'))
    define('PRO_FOLDER', get_template_directory().'/pro/narga-pro.php');

if(file_exists(PRO_FOLDER)) :
    require_once (PRO_FOLDER);
    new NARGAPRO();
endif;
    
/* Load custom-actions.php file if it exists in the uploads folder */
    $upload_dir = wp_upload_dir();
    
if(!defined('ACTION_FILE'))
    define('ACTION_FILE', $upload_dir['basedir'].'/custom-functions.php');
if(file_exists(ACTION_FILE))
    require_once (ACTION_FILE);

/* Load custom.css file if it exists in the uploads folder */
define('CSS_FILE', $upload_dir['basedir'].'/custom.css');

if(file_exists(CSS_FILE))
    add_action("wp_print_styles", "narga_add_custom_css_file", 99);
function narga_add_custom_css_file() {
    wp_register_style('narga_custom_css', CSS_FILE);
    wp_enqueue_style( 'narga_custom_css');
}

class NARGA {

    function __construct() {

        global $narga;

        $narga = new stdClass;

        add_action('after_setup_theme', array( &$this, 'options' ), 6);
        add_action('after_setup_theme', array( &$this, 'extensions' ), 12);
        add_action('after_setup_theme', array( &$this, 'layouts' ), 13);
	}

	function options() {	
	    // function to get options
            require_once locate_template('core/library/customizer/get-options.php');
            // custom Customizer Class
            require_once locate_template('core/library/customizer/customizer-custom-classes.php');
            // Customizer Settings a.k.a Theme Options
            require_once locate_template('core/library/customizer/customizer.php');
	}
		
        function extensions() {
            // Jetpack compatibility
            require_once locate_template('core/library/extensions/jetpack.php');

            // Orbit slider
            require_once locate_template('core/library/extensions/orbit.php');

            // Topbar functions
            require_once locate_template('core/library/extensions/topbar.php');
	}
	
        function layouts() {
            // Content hooks/related functions
            require_once locate_template('core/library/layouts/custom-content.php');

            // Content navigation: pagination, breadcrumbs
            require_once locate_template('core/library/layouts/content-navigation.php');

            // Custom Header
            require_once locate_template('core/library/layouts/custom-header.php');

            // Footer content
            require_once locate_template('core/library/layouts/footer.php');
	    
            // Widgetable for sidebar, footer
            require_once locate_template('core/library/layouts/widgets.php');

            // Require function if theme support
            // require_if_theme_supports('narga-breadcrumbs', locate_template('/library/inc/functions/breadcrumbs.php'));
        }
}

?>
