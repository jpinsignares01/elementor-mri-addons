<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Category_Description_After extends Widget_Base {

    public function get_name() {
        return 'product_category_description_after';
    }

    public function get_title() {
        return __( 'Product Category Description After Content', 'elementor-mri-addon' );
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
                'selector' => '{{WRAPPER}} #description-after-content',
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'elementor-mri-addon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #description-after-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        if ( is_product_category() ) {
            $category = get_queried_object();
            $description_after = get_term_meta( $category->term_id, 'em_desc_after_content', true );

            if ( ! empty( $description_after ) ) {
                echo '<div id="description-after-content">' . wp_kses_post( wpautop( $description_after ) ) . '</div>';
            } else {
                echo __( 'No description after content found.', 'elementor-mri-addon' );
            }
        } else {
            echo __( 'This widget only works on product category pages.', 'elementor-mri-addon' );
        }
    }
}