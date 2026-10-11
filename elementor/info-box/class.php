<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClCar_Core;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Info_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Info Box', 'clcar-core' );
		$this->rt_base = 'rt-info-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_info_box',
			[
				'label' => esc_html__( 'Info Box Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'   => __( 'Icon Type', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon'  => __( 'Icon', 'clcar-core' ),
					'image' => __( 'Image', 'clcar-core' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Wide Range of Brands',
				'label_block' => true,
			]
		);

		$this->add_control(
			'step_number',
			[
				'label'       => esc_html__( 'Step Number', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'content',
			[
				'label'       => esc_html__( 'Content', 'clcar-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Lorem ipsum dolor sit amet, conseetur adipiscing elit. In dolor libero eu potenti massa cursus.',
				'label_block' => true,
			]
		);

		$this->add_control(
			'info_icon',
			[
				'label'            => __( 'Choose Icon', 'clcar-core' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-diamond',
					'library' => 'fa-solid',
				],
				'condition'        => [
					'icon_type' => [ 'icon' ],
				],
			]
		);

		$this->add_control(
			'show_readmore_btn',
			[
				'label'        => __( 'Read More Button', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'clcar-core' ),
				'label_off'    => __( 'Off', 'clcar-core' ),
				'return_value' => 'is-readmore',
			]
		);

		$this->add_control(
			'read_more_btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Read More',
				'label_block' => true,
				'condition'   => [
					'show_readmore_btn' => [ 'is-readmore' ],
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'clcar-core' ),
				'type'          => Controls_Manager::URL,
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
			]
		);

		$this->add_control(
			'image_icon',
			[
				'label'     => __( 'Choose Image', 'clcar-core' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'text_align',
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
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box  *' => 'text-align: {{VALUE}} !important',
				],
				'toggle'    => true,
			]
		);



		$this->end_controls_section();

		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box .content-holder .entry-title'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .choose-box .content-holder .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box:hover .content-holder .entry-title'   => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-info-box .choose-box:hover .content-holder .entry-title a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box .content-holder .entry-title',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'clcar-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'selectors'          => [
					'{{WRAPPER}} .rt-info-box .choose-box .content-holder .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Step Number Settings
		//==============================================================
		$this->start_controls_section(
			'step_number_settings',
			[
				'label' => esc_html__( 'Step Number Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'step_number_width',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Step Number Width', 'clcar-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .step-number' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'step_number_height',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Step Number Height', 'clcar-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .step-number' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'step_number_typography',
				'label'    => esc_html__( 'Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .step-number',
			]
		);
		$this->add_control(
			'step_number_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .step-number'   => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'step_number_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .step-number'   => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'step_number_bg_color',
				'label' => __('Background', 'haven-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Step Number Background', 'haven-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box .step-number',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'step_number_hover_bg_color',
				'label' => __('Background', 'haven-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Step Number Hover Background', 'haven-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box:hover .step-number',
			]
		);
		$this->add_responsive_control(
			'step_number_padding',
			[
				'label'              => __( 'Padding', 'clcar-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'selectors'          => [
					'{{WRAPPER}} .step-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'step_number_border',
				'label'     => __( 'Border', 'clcar-core' ),
				'selector'  => '{{WRAPPER}} .step-number',
			]
		);
		$this->add_control(
			'step_number_hover_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Border Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box:hover .step-number'=> 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'step_number_border_radius',
			[
				'label'              => __( 'Border Radius', 'clcar-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'selectors'          => [
					'{{WRAPPER}} .step-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'position_top_bottom_offset',
			[
				'label' => __( 'Offsets (Top / Bottom) %', 'clcar-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [ 'size' => 25 ],
			]
		);
		$this->add_responsive_control(
			'position_left_right_offset',
			[
				'label' => __( 'Offsets (Left / Right) %', 'clcar-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [ 'size' => 83 ],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'step_number_box_shadow',
				'selector' => '{{WRAPPER}} .step-number',
				'fields_options' =>
					[
						'box_shadow_type' =>
							[
								'default' =>'no'
							],
					]
			]
		);
		$this->end_controls_section();

		// Content Settings
		//==============================================================
		$this->start_controls_section(
			'content_settings',
			[
				'label'     => esc_html__( 'Content Settings', 'clcar-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box .entry-description' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'content_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box:hover .entry-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box .entry-description',
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label'              => __( 'Content Spacing', 'clcar-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .rt-info-box .choose-box .entry-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Icon Settings
		//==============================================================
		$this->start_controls_section(
			'icon_settings',
			[
				'label'     => esc_html__( 'Icon Settings', 'clcar-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => [ 'icon' ],
				],
			]
		);

		$this->add_responsive_control(
			'icon_box_size',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Box Size', 'clcar-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 20,
						'max'  => 150,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .choose-box .icon-holder' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Font Size', 'clcar-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 20,
						'max'  => 150,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .choose-box .icon-holder i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-box .choose-box svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				],

			]
		);


		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box .icon-holder i'=> 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .choose-box .icon-holder svg path'=> 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box:hover .icon-holder i'=> 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .choose-box:hover .icon-holder svg path'=> 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'icon_box_bg_color',
				'label'    => esc_html__( 'Background', 'clcar-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Icon Box Background', 'clcar-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box .icon-holder',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'icon_box_hover_bg_color',
				'label'    => esc_html__( 'Background', 'clcar-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Icon Box Hover Background', 'clcar-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box:hover .icon-holder',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'icon_box_border',
				'label'     => __( 'Border', 'clcar-core' ),
				'selector'  => '{{WRAPPER}} .rt-info-box .choose-box .icon-holder',
			]
		);
		$this->add_control(
			'icon_box_hover_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Border Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .choose-box:hover .icon-holder'=> 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_box_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'clcar-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-info-box .choose-box .icon-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_box_shadow',
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box .icon-holder',
				'fields_options' =>
					[
						'box_shadow_type' =>
							[
								'default' =>'no'
							],
					]
			]
		);
		$this->end_controls_section();

		// Image Settings
		//==============================================================

		$this->start_controls_section(
			'image_settings',
			[
				'label'     => esc_html__( 'Image Settings', 'clcar-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'image_wrap_margin_bottom',
			[
				'label'      => __( 'Image Wrapper Margin Bottom', 'clcar-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_icon_width',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Image Width', 'clcar-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
				'condition'  => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'image_wrap_width',
			[
				'label'      => __( 'Image Wrapper Width / Height', 'clcar-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'clcar-core' ),
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder .img-wrap img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'image_bg_shape',
				'label'    => __( 'Shape Background', 'clcar-core' ),
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'clcar-core' ),
					],
				],
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-info-box.style1 .services-block__icon::before',
			]
		);
		//End Icon Style Tab
		$this->end_controls_section();


		// Box Settings
		//==============================================================
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__( 'Box Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Box Padding', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .choose-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg',
				'label'    => __( 'Background', 'clcar-core' ),
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Box Background', 'clcar-core' ),
					],
				],
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_hover_bg',
				'label'    => __( 'Background', 'clcar-core' ),
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Box Hover Background', 'clcar-core' ),
					],
				],
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'full_box_border',
				'label'     => __( 'Border', 'clcar-core' ),
				'selector'  => '{{WRAPPER}} .rt-info-box .choose-box',
			]
		);
		$this->add_responsive_control(
			'border_color',
			[
				'label'      => __( 'Border Color', 'clcar-core' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .choose-box' => 'border-color:{{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Border Radius', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .choose-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_hover_shadow',
				'label'    => __( 'Box Shadow', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .choose-box:hover'
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