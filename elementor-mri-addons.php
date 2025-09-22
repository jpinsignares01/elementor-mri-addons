<?php
/**
 * Plugin Name: Elementor Custom Addons
 * Description: Simple widgets for Elementor.
 * Version:     1.0.1
 * Author:      Mr. Insignares
 * Author URI:  https://mrinsignares.com
 * Text Domain: elementor-mri-addon
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.27.3
 * Elementor Pro tested up to: 3.27.3
 */

function register_product_description_on_tabs_widget( $widgets_manager ) {

	// Product Display Custom Field Widget
	require_once( __DIR__ . '/widgets/Product-display-custom-field.php' );
	$widgets_manager->register( new \Product_Display_Custom_Field() );
	
	// Product Category Name Widget
	require_once( __DIR__ . '/widgets/Product-Category-Name.php' );
	$widgets_manager->register( new \Product_Category_Name() );

	// Product Category Image Widget
	require_once( __DIR__ . '/widgets/Product-Category-Image.php' );
	$widgets_manager->register( new \Product_Category_Image() );

	// Product Category Description Widget
	require_once( __DIR__ . '/widgets/Product-Category-Description.php' );
	$widgets_manager->register( new \Product_Category_Description() );

	// Product Category Description After Content Widget
	require_once( __DIR__ . '/widgets/Product-Category-Description-After.php' );
	$widgets_manager->register( new \Product_Category_Description_After() );

	// Product Category Page Header Background Widget
	require_once( __DIR__ . '/widgets/Product-Category-Page-Header-Background.php' );
	$widgets_manager->register( new \Product_Category_Page_Header_Background() );
}
add_action( 'elementor/widgets/register', 'register_product_description_on_tabs_widget' );