<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Product_Category_Description extends Widget_Base {

    public function get_name() {
        return 'product_category_description';
    }

    public function get_title() {
        return __( 'Product Category Description', 'elementor-mri-addon' );
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
            $description = $category->description;

            if ( ! empty( $description ) ) {
                echo '<div id="description-description">' . wp_kses_post( wpautop( $description ) ) . '</div>';
            } else {
                echo __( 'No category description found.', 'elementor-mri-addon' );
            }
        } else {
            echo __( 'This widget only works on product category pages.', 'elementor-mri-addon' );
        }
    }
}