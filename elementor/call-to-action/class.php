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

class RT_Call_To_Action extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT CTA', 'clcar-core' );
		$this->rt_base = 'rt-call-to-action';
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
			'show_shape',
			[
				'label' => esc_html__( 'Shape Visibility', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Download Our Mobile App',
			]
		);
        $this->add_control(
			'content',
			[
				'label'       => esc_html__( 'Content', 'clcar-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quis bibendum id consequat',
			]
		);
		$this->add_control(
			'show_google_btn',
			[
				'label' => esc_html__( 'Google Play Button Visibility', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'google_link',
			[
				'label'         => __( 'Google Play Store Link', 'clcar-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'clcar-core' ),
				'show_external' => true,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition'		=>[
					'show_google_btn' =>'yes'
				]
			]
		);
		$this->add_control(
			'show_ios_btn',
			[
				'label' => esc_html__( 'IOS Button Visibility', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'ios_link',
			[
				'label'         => __( 'IOS Link', 'clcar-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'clcar-core' ),
				'show_external' => true,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition'		=>[
					'show_ios_btn' =>'yes'
				]
			]
		);
		
        $this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();

		/*
		 * Top Sub Title
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
					'{{WRAPPER}} .call-to-action-box.call-to-action-style-1 .content-holder .entry-title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .call-to-action-box.call-to-action-style-1 .content-holder .entry-description' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'box_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Box Background', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout2' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'radius',
			[
				'label' => esc_html__( 'Box Border Radius', 'clcar-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding',
			[
				'label' => esc_html__( 'Box Padding', 'clcar-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .call-to-action-wrap-layout2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_type',
				'label'    => esc_html__( 'Title Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .call-to-action-box.call-to-action-style-1 .content-holder .entry-title',
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_type',
				'label'    => esc_html__( 'Content Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .call-to-action-box.call-to-action-style-1 .content-holder .entry-description',
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