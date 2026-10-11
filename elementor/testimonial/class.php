<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClCar_Core;

use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Testimonial_Carousel extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Testimonial Carousel', 'clcar-core' );
		$this->rt_base = 'rt-testimonial-carousel';
		parent::__construct( $data, $args );
	}
	public function get_script_depends() {
		return [
			'swiper',
		];
	}
	protected function register_controls() {
		$this->__general_settings();
		$this->__carousel_settings();
		$this->__content_style();
		$this->__carousel_style();
		$this->__slider_items_wrapper_style();
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
			'image',
			[
				'label'   => __( 'Choose Image', 'clcar-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'name',
			[
				'label'       => __( 'Name', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Enter Name', 'clcar-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'designation',
			[
				'label'       => __( 'Designation', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Enter Designation', 'clcar-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'content',
			[
				'label'   => __( 'Content', 'clcar-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Enter Designation', 'clcar-core' ),
			]
		);
		$repeater->add_control(
			'rating',[
				'type' => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Rating', 'clcar-core' ),
				'options' => array(
					'1' => esc_html__( 'Rating 1', 'clcar-core' ),
					'2' => esc_html__( 'Rating 2', 'clcar-core' ),
					'3' => esc_html__( 'Rating 3', 'clcar-core' ),
					'4' => esc_html__( 'Rating 4', 'clcar-core' ),
					'5' => esc_html__( 'Rating 5', 'clcar-core' ),
				),
			]
		);
		$this->add_control(
			'items',
			[
				'label'       => __( 'Testimonial List', 'clcar-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'name'        => __( 'Maria Zokatti', 'clcar-core' ),
						'designation' => __( 'CEO, PSDBOSS', 'clcar-core' ),
						'content'     => __( 'Engage with our professional real estate agents sell Following buy or rent your home.Get emails directly to your area reach inbox and manage the lead with.',
							'clcar-core' ),
					],
					[
						'name'        => __( 'John Doe', 'clcar-core' ),
						'designation' => __( 'WordPress Developer', 'clcar-core' ),
						'content'     => __( 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid expedita recusandae ipsam quas fugit aperiam nihil nemo delectus laudantium? Enim est quibusdam dicta a',
							'clcar-core' ),
					],
					[
						'name'        => __( 'Kent Odeldan', 'clcar-core' ),
						'designation' => __( 'Web Designer', 'clcar-core' ),
						'content'     => __( 'Aliquid expedita recusandae ipsam quas fugit aperiam nihil nemo delectus laudantium? Enim est quibusdam dicta a', 'clcar-core' ),
					],

				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->add_control(
			'rating',
			[
				'label'        => __( 'Rating', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clcar-core' ),
				'label_off'    => __( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->end_controls_section();
	}

	protected function __carousel_settings() {
		$this->start_controls_section(
			'carousel_settings',
			[
				'label'     => esc_html__( 'Carousel Settings', 'clcar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'slider_per_group',
			[
				'label'        => __( 'Slider Per Group', 'clcar-core' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
			]
		);

		$this->add_control(
			'dots',
			[
				'label'        => __( 'Dots', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clcar-core' ),
				'label_off'    => __( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false
			]
		);

		$this->add_control(
			'slider_loop',
			[
				'label'        => __( 'Infinite', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'clcar-core' ),
				'label_off'    => __( 'No', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'direction', [
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Direction', 'clcar-core' ),
				'options' => array(
					'horizontal' => esc_html__( 'Horizontal', 'clcar-core' ),
					'vertical'   => esc_html__( 'Verticle', 'clcar-core' ),
				),
			]
		);

		$this->add_responsive_control(
			'verticle_wrapper_height',
			[
				'label'      => __( 'Verticle Wrapper Height', 'clcar-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 3000,
					],
					'%' => [
						'min'  => 10,
						'max'  => 100,
					],
				],
				'default'    => [
					'size' => 900,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-global-slider.swiper.swiper-vertical' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'direction' => 'vertical',
				],
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'label'        => __( 'Autoplay', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'clcar-core' ),
				'label_off'    => __( 'No', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'slider_autoplay_delay',
			[
				'label'     => __( 'Autoplay Speed', 'clcar-core' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1000,
				'max'       => 5000,
				'step'      => 500,
				'default'   => 3000,
				'condition' => [
					'slider_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'centeredSlides',
			[
				'label'        => __( 'Centered Slides', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'clcar-core' ),
				'label_off'    => __( 'No', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false,
				'description'  => __( 'If you use centered slider options then default column will not working.', 'clcar-core' ),
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'clcar-core' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 100,
				'max'     => 5000,
				'step'    => 100,
				'default' => 2000,
			]
		);
		$this->add_control(
			'space',
			[
				'label'   => __( 'Space', 'clcar-core' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 24,
				],
			]
		);
		$this->add_control(
			'item',
			[
				'label'   => __( 'Desktop items', 'clcar-core' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 3,
				],
			]
		);
		$this->add_control(
			'medium_item',
			[
				'label'   => __( 'Medium Desktop items', 'clcar-core' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 2,
				],
			]
		);
		$this->add_control(
			'item_tablet',
			[
				'label'   => __( 'Tablet items', 'clcar-core' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 2,
				],
			]
		);
		$this->add_control(
			'item_mobile',
			[
				'label'   => __( 'Mobile items', 'clcar-core' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 1,
				],
			]
		);
		$this->end_controls_section();
	}

	protected function __content_style() {
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Style', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'thumb_style_heading',
			[
				'label' => __( 'Thumb Style', 'clcar-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'thum_display',
			[
				'label' => esc_html__( 'Thumb', 'clcar-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'thumb_size_width',
			[
				'label'      => __( 'Thumb Size Width', 'clcar-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 600,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-img img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_control(
			'thumb_size_height',
			[
				'label'      => __( 'Thumb Size Height', 'clcar-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 600,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-img img' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_control(
			'name_style_heading',
			[
				'label'     => __( 'Name Style', 'clcar-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Name Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block__heading',
			]
		);
		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Name Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block__heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'designation_style_heading',
			[
				'label'     => __( 'Designation Style', 'clcar-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'designation_typo',
				'label'    => esc_html__( 'Designation', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block__designation',
			]
		);
		$this->add_control(
			'designation_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Designation', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block__designation' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'content_style_heading',
			[
				'label'     => __( 'Content Style', 'clcar-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Content', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block .testimonial-block__text',
			]
		);
		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block .testimonial-block__text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label'      => __( 'Margin', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-block__text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'quote_style_heading',
			[
				'label'     => __( 'Quote Icon', 'clcar-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'quote_icon',
			[
				'type'        => Controls_Manager::ICONS,
				'label'   => esc_html__( 'Select Icon', 'clcar-core' ),
				'default' => array(
					'value' => 'fas fa-quote-right',
					'library' => 'fa-solid',
				),
			]
		);
		$this->add_control(
			'quote_sign_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block .qoute-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block .qoute-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block .qoute-icon svg' => 'fill: {{VALUE}}',
				]
			]
		);

		$this->add_responsive_control(
			'quote_sign_size',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Font Size', 'clcar-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 20,
						'max'  => 300,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block .qoute-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block .qoute-icon svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_responsive_control(
			'quote_icon_position',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Icon Position', 'clcar-core' ),
				'options' => [
					'top-right' => 'Top Right',
					'bottom-right' => 'Bottom Right',
				],
				'default' => 'bottom-right',
			]
		);
		$this->add_control(
			'box_style_heading',
			[
				'label'     => __( 'Item Box Style', 'clcar-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'box_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_responsive_control(
			'item_box_padding',
			[
				'label'      => __( 'Padding', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'item_box_border',
				'label'     => __( 'Border', 'clcar-core' ),
				'selector'  => '{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block',
			]
		);
		$this->add_responsive_control(
			'item_box_border_radius',
			[
				'label'      => __( 'Border Radius', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .testimonial-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function __carousel_style() {
		$this->start_controls_section(
			'carousel_style',
			[
				'label' => __( 'Carousel Style', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'dots_style_heading',
			[
				'label' => __( 'Dots Style', 'clcar-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'dots_width',
			[
				'label'     => __( 'Width', 'clcar-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '15',
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .el-swiper-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'dots_height',
			[
				'label'     => __( 'Height', 'clcar-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '15',
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .el-swiper-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'dots_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Background Color', 'clcar-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .el-swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'dots_active_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Active Background Color', 'clcar-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .el-swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'dots_border',
				'label'     => __( 'Border', 'clcar-core' ),
				'selector'  => '{{WRAPPER}} .rt-el-testimonial-carousel .el-swiper-pagination .swiper-pagination-bullet',
			]
		);
		$this->add_control(
			'dots_active_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Active Border Color', 'clcar-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .el-swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'dots_border_radius',
			[
				'label'     => __( 'Border Radius', 'clcar-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' =>'',
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .el-swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'dots_space_between',
			[
				'label'      => __( 'Space Between Dots', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .el-swiper-pagination .swiper-pagination-bullet' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'dots_wrapper_space_between',
			[
				'label'      => __( 'Dots Wrapper Margin', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .el-swiper-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function __slider_items_wrapper_style() {
		$this->start_controls_section(
			'slider_items_wrapper',
			[
				'label' => __( 'Slider Items Wrapper', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'slider_items_wrapper_bg_color',
				'label' => __('Background', 'haven-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Step Number Hover Background', 'haven-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-el-testimonial-carousel .rt-global-slider',
			]
		);
		$this->add_responsive_control(
			'slider_items_wrapper_padding',
			[
				'label'      => __( 'Padding', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .rt-global-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'slider_items_wrapper_border',
				'label'     => __( 'Border', 'clcar-core' ),
				'selector'  => '{{WRAPPER}} .rt-el-testimonial-carousel .rt-global-slider',
			]
		);

		$this->add_responsive_control(
			'slider_items_wrapper_border_radius',
			[
				'label'      => __( 'Border Radius', 'clcar-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-testimonial-carousel .rt-global-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		if( $data['slider_autoplay'] == 'yes' ){
			$data['slider_autoplay'] = true;
		}
		else{
			$data['slider_autoplay'] = false;
		}
		$slider_data=array(
			'slidesPerView' 	    => 1 ,
			'loop'				    => $data['slider_loop']=='yes' ? true:false,
			'direction'				=> $data['direction'],
			'centeredSlides'	    => $data['centeredSlides']=='yes' ? true:false ,
			'slideToClickedSlide'   => true,
			'spaceBetween'		    => $data['space']['size'],
			'slidesPerGroup'		=> $data['slider_per_group']['size'],
			'autoplay'				=> array(
				'delay'             => $data['slider_autoplay_delay'],
			),
			'speed'                 => $data['speed'],
			'auto'		            => $data['slider_autoplay'],
			'breakpoints' => array(
				'0'     => array('slidesPerView' => 1),
				'576'   => array('slidesPerView' => $data['item_mobile']['size']),
				'768'   => array('slidesPerView' => $data['item_tablet']['size']),
				'992'   => array('slidesPerView' => $data['medium_item']['size']),
				'1200'  => array('slidesPerView' => $data['item']['size']),
				'1600'  => array('slidesPerView' => $data['item']['size'])
			),
		);
		$data['slider_data'] = json_encode( $slider_data );  
		$template = 'view-1';
		$this->rt_template( $template, $data );
	}

}