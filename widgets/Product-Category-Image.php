<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Product_Category_Image extends Widget_Base {

    public function get_name() {
        return 'product_category_image';
    }

    public function get_title() {
        return __( 'Product Category Image', 'elementor-mri-addon' );
    }

    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        if ( is_product_category() ) {
            $category = get_queried_object();
            $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
            $image_url = wp_get_attachment_url( $thumbnail_id );

            if ( $image_url ) {
                echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $category->name ) . '" />';
            } else {
                echo __( 'No category image found.', 'elementor-mri-addon' );
            }
        } else {
            echo __( 'This widget only works on product category pages.', 'elementor-mri-addon' );
        }
    }
}