<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

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
                'selector' => '{{WRAPPER}} #category-name',
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'elementor-mri-addon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #category-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
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