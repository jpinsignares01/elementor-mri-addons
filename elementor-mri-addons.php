<?php
/**
 * Plugin Name: Elementor Custom Addons
 * Description: Simple widgets for Elementor.
 * Version:     1.0.0
 * Author:      Mr. Insignares
 * Author URI:  https://mrinsignares.com
 * Text Domain: elementor-mri-addon
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.27.3
 * Elementor Pro tested up to: 3.27.3
 */

function register_product_description_on_tabs_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/Product-display-custom-field.php' );

	$widgets_manager->register( new \Product_Display_Custom_Field() );

}
add_action( 'elementor/widgets/register', 'register_product_description_on_tabs_widget' );