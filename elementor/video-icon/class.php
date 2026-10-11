<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClCar_Core;

use Elementor\Controls_Manager;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Video_Icon extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Video', 'clcar-core' );
		$this->rt_base = 'rt-video-icon';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
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

		$this->add_control(
			'video_url',
			[
				'label' => __( 'Video URL', 'clcar-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => __( 'Enter your URL', 'clcar-core' ),
				'default' => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'clcar-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter button text', 'clcar-core' ),
				'default' => __( 'Play Video', 'clcar-core' ),
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			'wrap_height',
			[
				'label' => __( 'Wrapper Height', 'clcar-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'vh' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'clcar-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'clcar-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'clcar-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Horizontal Align', 'clcar-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'clcar-core' ),
					'flex-start' => __( 'Start', 'clcar-core' ),
					'center' => __( 'Center', 'clcar-core' ),
					'flex-end' => __( 'End', 'clcar-core' ),
					'space-between' => __( 'Space Between', 'clcar-core' ),
					'space-around' => __( 'Space Around', 'clcar-core' ),
					'space-evenly' => __( 'Space Evenly', 'clcar-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'justify-content: {{VALUE}}; display:flex',
				],
			]
		);

		$this->add_responsive_control(
			'vertical_align',
			[
				'label' => __( 'Vertical Align', 'clcar-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'clcar-core' ),
					'flex-start' => __( 'Start', 'clcar-core' ),
					'center' => __( 'Center', 'clcar-core' ),
					'flex-end' => __( 'End', 'clcar-core' ),
					'space-between' => __( 'Space Between', 'clcar-core' ),
					'space-around' => __( 'Space Around', 'clcar-core' ),
					'space-evenly' => __( 'Space Evenly', 'clcar-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'align-items: {{VALUE}}; display:flex',
				],
			]
		);

		$this->end_controls_section();


		//Play Button Style
		//=============================================
		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Play Button Style', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => __( 'Button Size', 'clcar-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .icon-box' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->add_control(
			'button_spacing',
			[
				'label' => __( 'Button Spacing', 'clcar-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .icon-box' => 'margin-right:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __( 'Normal', 'clcar-core' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Background Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __( 'Hover', 'clcar-core' ),
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color Hover', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Background Color Hover', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'text_style',
			[
				'label' => __( 'Text Style', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Text Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-video-icon-wrapper .button-text',
			]
		);

		$this->add_control(
			'text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .button-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Hover Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .button-text:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();
		$template = 'view-1';
		$this->rt_template( $template, $data );
	}

}