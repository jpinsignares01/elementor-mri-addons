<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Category_Name extends Widget_Base {

    public function get_name() {
        return 'product_category_name';
    }

    public function get_title() {
        return __( 'Product Category Name', 'elementor-mri-addon' );
    }

    public function get_icon() {
        return 'eicon-heading';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        if ( is_product_category() ) {
            $category = get_queried_object();
            if ( ! empty( $category->name ) ) {
                echo '<div id="category-name">' . esc_html( $category->name ) . '</div>';
            } else {
                echo __( 'No category name found.', 'elementor-mri-addon' );
            }
        } else {
            echo __( 'This widget only works on product category pages.', 'elementor-mri-addon' );
        }
    }
}