<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClCar_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Title extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Section Title', 'clcar-core' );
		$this->rt_base = 'rt-title';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		/*
		 * General Options
		 * ************************************
		 */

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'top_sub_title',
			[
				'label'       => esc_html__( 'Section Sub Title', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Why Choose Our Properties',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Section Title', 'clcar-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "We're going to became partners for the long run",
				'description' => esc_html__( "If you would like to use different color then separate word by <span>.", 'clcar-core' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => esc_html__( 'Description', 'clcar-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => 'Lorem Ipsum has been standard daand scrambled. Rimply dummy text of the printing and typesetting industry',
			]
		);  

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'clcar-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'clcar-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'clcar-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'clcar-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_shape',
			[
				'label'        => __( 'Title Shape', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Enable', 'clcar-core' ),
				'label_off'    => __( 'Disable', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);
		$this->end_controls_section();


		/*
		 * Top Sub Title
		 * ************************************
		 */

		$this->start_controls_section(
			'top_title_settings',
			[
				'label' => esc_html__( ' Sub Title Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'top_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .section-subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'top_title_two_typo',
				'label'    => esc_html__( 'Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .section-subtitle',
			]
		);

		$this->add_responsive_control(
			'top_title_margin',
			[
				'label'              => __( 'Margin', 'clcar-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .section-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Main Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Section Title Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .section-title' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .section-title',
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label'              => __( 'Margin', 'clcar-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Description Settings
		//==============================================================
		$this->start_controls_section(
			'description_settings',
			[
				'label' => esc_html__( 'Description Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typo',
				'label'    => esc_html__( 'Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .section-description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .section-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label'              => __( 'Margin', 'clcar-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .section-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

    }

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		$this->rt_template( $template, $data );
	}

}