<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Category_Page_Header_Background extends Widget_Base {

    public function get_name() {
        return 'product_category_page_header_background';
    }

    public function get_title() {
        return __( 'Product Category Page Header Background', 'elementor-mri-addon' );
    }

    public function get_icon() {
        return 'eicon-background';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        if ( is_product_category() ) {
            $category = get_queried_object();
            $background_id = get_term_meta( $category->term_id, 'page_header_background', true );
            $background_url = wp_get_attachment_url( $background_id );

            if ( $background_url ) {
                echo '<div id="page-header-background" style="background-image:url(' . esc_url( $background_url ) . '); width:100%; height:300px; background-size:cover; background-position:center;"></div>';
            } else {
                echo __( 'No page header background found.', 'elementor-mri-addon' );
            }
        } else {
            echo __( 'This widget only works on product category pages.', 'elementor-mri-addon' );
        }
    }
}