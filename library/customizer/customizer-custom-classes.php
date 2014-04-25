<?php
/**
 * NARGA Customizer Custom Classes
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
 * NARGA Category Drop Down List Class
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
 * NARGA TextArea Control Class
 * create custom textarea input field
 *
 * @since NARGA v0.5
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

?>
