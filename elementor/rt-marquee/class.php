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

class Rt_Marquee extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Marquee', 'clcar-core' );
		$this->rt_base = 'rt-marquee';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->__general_settings();
		$this->__box_style();
		$this->__title_style();
		$this->__icon_style();
    }

	protected function __general_settings() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label'       => __( 'Title', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Enter Name', 'clcar-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'url',
			[
				'label'       => __( 'Title Link', 'clcar-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'clcar-core' ),
				'show_label'  => false,
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => __( 'Marquee List', 'clcar-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => [
					[ 'title' => 'Marketing Agency', ],
					[ 'title' => 'Let Talk', ],
					[ 'title' => 'Web Design Agency', ],
					[ 'title' => 'Modern Technology', ],
					[ 'title' => 'Web Development', ],
				],
			]
		);

		$this->add_control(
			'marquee_direction',
			[
				'label'     => __( 'Marquee', 'clcar-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'marquee-left',
				'options'   => [
					'marquee-left'  => __( 'Left Direction', 'clcar-core' ),
					'marquee-right' => __( 'Right Direction', 'clcar-core' ),
				],
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__( 'H1', 'clcar-core' ),
					'h2' => esc_html__( 'H2', 'clcar-core' ),
					'h3' => esc_html__( 'H3', 'clcar-core' ),
					'h4' => esc_html__( 'H4', 'clcar-core' ),
					'h5' => esc_html__( 'H5', 'clcar-core' ),
					'h6' => esc_html__( 'H6', 'clcar-core' ),
				],
			]
		);
		$this->end_controls_section();
	}

	protected function __box_style() {
		// Box setting
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box Style', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Radius', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'moving_speed',
			[
				'type'      => Controls_Manager::NUMBER,
				'label'     => esc_html__( 'Moving Speed', 'clcar-core' ),
				'default' => 30,
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee.marquee-left .rt-marquee-item' => 'animation: marquee_left {{VALUE}}s linear infinite;',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'box_transform',
			[
				'type'      => Controls_Manager::NUMBER,
				'label'     => esc_html__( 'Transform Value', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider' => 'transform: rotate({{VALUE}}deg)',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'box_position',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Box Top / Bottom', 'clcar-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label'      => __( 'Margin', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-marquee-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __title_style() {
		// Title setting
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title Style', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Title Typo', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Hover Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_stroke_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Stroke Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title' => '-webkit-text-stroke-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'title_stroke_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Stroke Width', 'clcar-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'gradient_display',
			[
				'label'        => __( 'Gradient Display', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clcar-core' ),
				'label_off'    => __( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_gradient',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .title-gradient',
				'condition' => [
					'gradient_display' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __icon_style() {
		// Icon setting
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __('Icon Type', 'clcar-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => __('Icon', 'clcar-core'),
					'image' => __('Image', 'clcar-core'),
					'none' => __('None', 'clcar-core'),
				],
			]
		);

		$this->add_control(
			'bgicon',
			[
				'label' => __('Choose Icon', 'clcar-core'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fa-solid fa-asterisk',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __('Choose Image', 'clcar-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => ['image'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'icon_typo',
				'label'    => esc_html__( 'Icon Typo', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder',
			]
		);

		$this->add_responsive_control(
			'icon_typo',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Icon Size', 'toyup-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder svg' => 'transform: scale({{SIZE}});',
				],

			]
		);

		$this->add_control(
			'icon_fill_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Fill Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_stroke_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Stroke Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder path' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => '-webkit-text-stroke-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Hover Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item:hover .icon-holder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item:hover .icon-holder path' => 'stroke: {{VALUE}}',

				],
			]
		);

		$this->add_responsive_control(
			'icon_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Icon Gap', 'toyup-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => 'width: {{SIZE}}{{UNIT}};',
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