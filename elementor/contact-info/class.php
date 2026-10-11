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

class RT_Contact_Info extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Contact Info', 'clcar-core' );
		$this->rt_base = 'rt-contact-info';
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
			'contact_icon',
			[
				'label'            => __( 'Choose Icon', 'clcar-core' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-home',
					'library' => 'fa-solid',
				],
			]
		);
        $this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Address',
				'label_block' => true,
			]
		);
        $this->add_control(
			'contact_info',
			[
				'label'       => esc_html__( 'Contact', 'clcar-core' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => '131 Martens Place, Alexandra Hills, Australia.',
				'label_block' => true,
			]
		);
 

		$this->end_controls_section();


		/*
		 * Style Settings
		 * ************************************
		 */

		$this->start_controls_section(
			'style_settings',
			[
				'label' => esc_html__( ' Style Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-info-default .address-box .content-holder .entry-title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'contact_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Contact Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-info-default .address-box .content-holder .entry-description a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .contact-info-default .address-box .content-holder .entry-description' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'box_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Box Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-info-default .address-box' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'box_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Box Border Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-info-default .address-box' => 'border-color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-info-default .address-box .icon-holder' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Background', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-info-default .address-box .icon-holder' => 'background-color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'icon_size',
			[
				'type'      => Controls_Manager::NUMBER,
				'label'     => esc_html__( 'Icon Size', 'clcar-core' ),
                'default'   =>'',
				'selectors' => [
					'{{WRAPPER}} .contact-info-default .address-box .icon-holder' => 'font-size: {{VALUE}}px',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'              => __( 'Margin', 'clcar-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .contact-info-default .address-box .content-holder .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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