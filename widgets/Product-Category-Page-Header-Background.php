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

    protected function register_controls() {
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Background Style', 'elementor-mri-addon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Altura
        $this->add_control(
            'height',
            [
                'label' => __( 'Height', 'elementor-mri-addon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} #page-header-background' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Tipo de background
        $this->add_control(
            'background_size',
            [
                'label' => __( 'Background Size', 'elementor-mri-addon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'cover' => __( 'Cover', 'elementor-mri-addon' ),
                    'contain' => __( 'Contain', 'elementor-mri-addon' ),
                    'auto' => __( 'Auto', 'elementor-mri-addon' ),
                ],
                'default' => 'cover',
                'selectors' => [
                    '{{WRAPPER}} #page-header-background' => 'background-size: {{VALUE}};',
                ],
            ]
        );

        // Posición del background
        $this->add_control(
            'background_position',
            [
                'label' => __( 'Background Position', 'elementor-mri-addon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'center center' => __( 'Center Center', 'elementor-mri-addon' ),
                    'center left' => __( 'Center Left', 'elementor-mri-addon' ),
                    'center right' => __( 'Center Right', 'elementor-mri-addon' ),
                    'top center' => __( 'Top Center', 'elementor-mri-addon' ),
                    'top left' => __( 'Top Left', 'elementor-mri-addon' ),
                    'top right' => __( 'Top Right', 'elementor-mri-addon' ),
                    'bottom center' => __( 'Bottom Center', 'elementor-mri-addon' ),
                    'bottom left' => __( 'Bottom Left', 'elementor-mri-addon' ),
                    'bottom right' => __( 'Bottom Right', 'elementor-mri-addon' ),
                ],
                'default' => 'center center',
                'selectors' => [
                    '{{WRAPPER}} #page-header-background' => 'background-position: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        if ( is_product_category() ) {
            $category = get_queried_object();
            $background_id = get_term_meta( $category->term_id, 'em_page_header_bg_id', true );
            $background_url = wp_get_attachment_url( $background_id );

            if ( $background_url ) {
                echo '<div id="page-header-background" style="background-image:url(' . esc_url( $background_url ) . '); width:100%;">';
                echo '</div>';
            } else {
                echo __( 'No page header background found.', 'elementor-mri-addon' );
            }
        } else {
            echo __( 'This widget only works on product category pages.', 'elementor-mri-addon' );
        }
    }
}