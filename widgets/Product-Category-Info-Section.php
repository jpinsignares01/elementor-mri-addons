<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ProductCategoryInfoSection extends Widget_Base {

    public function get_name() {
        return 'product_category_info_section';
    }

    public function get_title() {
        return __( 'Product Category Info Section', 'elementor-mri-addon' );
    }

    public function get_icon() {
        return 'eicon-post-content';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'elementor-mri-addon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} #description-description',
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'elementor-mri-addon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #description-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        if ( is_product_category() ) {
            $category = get_queried_object();
            $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
            $image_url = wp_get_attachment_url( $thumbnail_id );
            $description = $category->description;

            echo '<div class="product-category-info-section">';
            if ( ! empty( $description ) ) {
                echo '<div id="description-description">' . wp_kses_post( wpautop( $description ) ) . '</div>';
            }
            if ( $image_url ) {
                echo '<img class="product-category-image" src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $category->name ) . '" />';
            }
            echo '</div>';
        }
    }
}