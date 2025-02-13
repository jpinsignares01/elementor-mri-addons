<?php

class Product_Display_Custom_Field extends \Elementor\Widget_Base {
    public function get_name(): string {
		return 'Product_Display_Custom_Field';
	}

	public function get_title(): string {
		return esc_html__( 'Display Product Custom Field', 'elementor-mri-addon' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'basic' ];
	}

	public function get_keywords(): array {
		return [ 'product', 'description', 'tabs' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementor-mri-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'customfield',
			[
				'label' => esc_html__( 'Custom field name to display', 'elementor-mri-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'elementor-mri-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'font_family',
			[
				'label' => esc_html__( 'Font Family', 'elementor-mri-addon' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'{{WRAPPER}} .custom-field' => 'font-family: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .custom-field',
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$customField = $this->get_settings_for_display()['customfield'];
		$textToDisplay = nl2br(get_field( $customField ));

		?>
			<p class="custom-field">
				<?php echo $textToDisplay; ?>
			</p>
		<?php
	}
}