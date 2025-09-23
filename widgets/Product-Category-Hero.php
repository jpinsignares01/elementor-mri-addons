<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Category_Hero extends Widget_Base {

    public function get_name() {
        return 'product_category_hero';
    }

    public function get_title() {
        return __( 'Product Category Hero', 'elementor-mri-addon' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        // Título
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Title Style', 'elementor-mri-addon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .category-hero-title',
                'responsive' => true,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'elementor-mri-addon' ),
                'type' => Controls_Manager::COLOR,
            ]
        );
        $this->add_responsive_control(
            'title_alignment',
            [
                'label' => __( 'Title Alignment', 'elementor-mri-addon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor-mri-addon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor-mri-addon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor-mri-addon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .category-hero-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Breadcrumb
        $this->start_controls_section(
            'section_breadcrumb_style',
            [
                'label' => __( 'Breadcrumb Style', 'elementor-mri-addon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'breadcrumb_typography',
                'selector' => '{{WRAPPER}} .category-hero-breadcrumb',
                'responsive' => true,
            ]
        );
        $this->add_control(
            'breadcrumb_color',
            [
                'label' => __( 'Breadcrumb Text Color', 'elementor-mri-addon' ),
                'type' => Controls_Manager::COLOR,
                'description' => __( 'Color for breadcrumb text (not links)', 'elementor-mri-addon' ),
            ]
        );
        $this->add_control(
            'breadcrumb_link_color',
            [
                'label' => __( 'Breadcrumb Link Color', 'elementor-mri-addon' ),
                'type' => Controls_Manager::COLOR,
                'description' => __( 'Color for breadcrumb links', 'elementor-mri-addon' ),
            ]
        );
        $this->add_responsive_control(
            'breadcrumb_alignment',
            [
                'label' => __( 'Breadcrumb Alignment', 'elementor-mri-addon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor-mri-addon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor-mri-addon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor-mri-addon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .category-hero-breadcrumb' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Altura del Hero
        $this->start_controls_section(
            'section_hero_height',
            [
                'label' => __( 'Hero Height', 'elementor-mri-addon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'hero_height',
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
                    '{{WRAPPER}} .category-hero' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Opacidad del overlay
        $this->start_controls_section(
            'section_hero_overlay',
            [
                'label' => __( 'Hero Overlay', 'elementor-mri-addon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'hero_overlay_opacity',
            [
                'label' => __( 'Overlay Opacity', 'elementor-mri-addon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ ],
                'range' => [
                    '' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'default' => [
                    'size' => 0.5,
                ],
            ]
        );
        $this->add_control(
            'hero_overlay_color',
            [
                'label' => __( 'Overlay Color', 'elementor-mri-addon' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255,255,255,1)',
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {        
        $settings = $this->get_settings_for_display();
        $category = get_queried_object();
        $background_id = get_term_meta( $category->term_id, 'em_page_header_bg_id', true );
        $background_url = wp_get_attachment_url( $background_id );

        $category_name = isset($category->name) ? $category->name : '';

        // Color del título
        $title_style = '';
        if ( ! empty( $settings['title_color'] ) ) {
            $title_style = 'color:' . esc_attr( $settings['title_color'] ) . ';';
        } else {
            $title_style = 'color:#000;';
        }
        if (is_shop()) {
            $title_style = 'color:#000;';
        }
        // Alineación del título
        $title_alignment = !empty($settings['title_alignment']) ? $settings['title_alignment'] : 'center';
        $title_style .= 'text-align:' . $title_alignment . ';';
        $title_style .= 'margin:0;';

        // Breadcrumb (WooCommerce default)
        $breadcrumb = '';
        $breadcrumb_text_color = !empty($settings['breadcrumb_color']) ? esc_attr($settings['breadcrumb_color']) : '#333';
        $breadcrumb_link_color = !empty($settings['breadcrumb_link_color']) ? esc_attr($settings['breadcrumb_link_color']) : '#0073aa';
        $breadcrumb_alignment = !empty($settings['breadcrumb_alignment']) ? $settings['breadcrumb_alignment'] : 'center';

        if ( function_exists( 'woocommerce_breadcrumb' ) && !is_shop() ) {
            ob_start();
            woocommerce_breadcrumb([
                'delimiter'   => ' &raquo; ',
                'wrap_before' => '<nav class="category-hero-breadcrumb" aria-label="breadcrumb" style="color:' . $breadcrumb_text_color . ';text-align:' . $breadcrumb_alignment . ';">',
                'wrap_after'  => '</nav>',
            ]);
            $breadcrumb_html = ob_get_clean();
            $breadcrumb = preg_replace('/<a\s/', '<a style="text-decoration:underline;color:' . $breadcrumb_link_color . ';" ', $breadcrumb_html);
        }

        // Estilo de fondo: imagen si existe, color si no
        $background_style = $background_url
            ? 'background-image:url(' . esc_url( $background_url ) . ');'
            : 'background-color:#FFF;';

        // Altura
        $height = isset($settings['hero_height']['size']) ? $settings['hero_height']['size'] : 300;
        $height_unit = isset($settings['hero_height']['unit']) ? $settings['hero_height']['unit'] : 'px';

        // Overlay
        $overlay_opacity = isset($settings['hero_overlay_opacity']['size']) ? $settings['hero_overlay_opacity']['size'] : 0.5;
        $overlay_color = !empty($settings['hero_overlay_color']) ? $settings['hero_overlay_color'] : 'rgba(255,255,255,1)';
        $overlay_rgba = $overlay_color;
        if ( strpos($overlay_color, 'rgba') === false ) {
            $hex = ltrim($overlay_color, '#');
            if (strlen($hex) == 6) {
                list($r, $g, $b) = sscanf($hex, "%02x%02x%02x");
                $overlay_rgba = "rgba($r,$g,$b,$overlay_opacity)";
            } else {
                $overlay_rgba = "rgba(255,255,255,$overlay_opacity)";
            }
        } else {
            $overlay_rgba = preg_replace('/rgba\((\d+),(\d+),(\d+),([0-9.]+)\)/', 'rgba($1,$2,$3,' . $overlay_opacity . ')', $overlay_color);
        }

        if ( is_shop() ) {
            $category_name = 'Tienda';
            $title_style = 'color:#000;text-align:' . $title_alignment . ';margin:0;';
        }

        // Renderizar el Hero con overlay y alineación
        echo '<div class="category-hero" style="position:relative; width:100%; min-height:' . esc_attr($height) . esc_attr($height_unit) . '; ' . $background_style . ' background-size:cover; background-position:center; display:flex; flex-direction:column; justify-content:center; align-items:center; padding:60px 20px;">';
        if ( !is_shop() ) {
            echo '<div class="category-hero-overlay" style="position:absolute;top:0;left:0;width:100%;height:100%;background:' . esc_attr($overlay_rgba) . ';z-index:1;pointer-events:none;"></div>';
        }
        echo '<div style="position:relative;z-index:2;width:100%;">';
        echo '<h1 class="category-hero-title" style="' . $title_style . '">' . esc_html( $category_name ) . '</h1>';
        echo $breadcrumb;
        echo '</div>';
        echo '</div>';
    }
}