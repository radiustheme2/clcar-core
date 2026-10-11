<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClCar_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Rtcl\Helpers\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Listing_Locations extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Listing Locations', 'clcar-core' );
		$this->rt_base = 'rt-listing-locations';
		parent::__construct( $data, $args );

	}
    public function get_script_depends() {
		return [
			'swiper',
		];
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
			'layouts',
			[
				'label'     => __( 'Layouts', 'clcar-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => [
					'1'     => __( 'Layout 1', 'clcar-core' ),
					'2'     => __( 'Layout 2', 'clcar-core' ),
				],
			]
		);

        $this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Box Height', 'clcar-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 500,
				),
				'selectors' => [
					'{{WRAPPER}} .el-location-box .rt-global-slider .location-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'count_suffix_display',
			[
				'label'     => esc_html__( 'Count Suffix', 'clcar-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'clcar-core' ),
				'label_off' => esc_html__( 'Off', 'clcar-core' ),
				'default'   => false,
			]
		);
		$this->add_control(
			'count_suffix_text',
			[
				'label'     	=> esc_html__( 'Count Suffix Text', 'clcar-core' ),
				'type'      	=> Controls_Manager::TEXT,
				'label_block'   =>true,
				'default'       => 'Car available',
				'condition'		=>[
				  'count_suffix_display'=>'yes'
				]
			]
		);
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
			'location_name',
			[
				'label'   => __( 'Select Location', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT2,
                'options' => $this->rt_get_categories_by_id('rtcl_location'),
				'multiple' => false,
				'label_block' => true,
				'show_label' => false,
			]
		);
        $repeater->add_control(
			'bgimg', [
				'type'    => Controls_Manager::MEDIA,
				'label'   => esc_html__( 'Background Image', 'clcar-core' ),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Select location background image', 'clcar-core' ),
				'show_label' => false,
			]
		);
        $this->add_control(
			'locations',
			[
				'label'     => __( 'Add as many locations as you want', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
        $this->end_controls_section();

		//Carousel Settings
		//=======================================

		$this->start_controls_section(
			'carousel_settings',
			[
				'label'     => esc_html__( 'Carousel Settings', 'clcar-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'slider_per_group',
			[
				'label'        => __( 'Slider Per Group', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SLIDER,
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
			'arrows',
			[
				'label'        => __( 'Arrow', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clcar-core' ),
				'label_off'    => __( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_responsive_control(
			'icon_position',
			[
				'label'     => __( 'Navigation Position', 'clcar-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'clcar-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'clcar-core' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => __( 'Right', 'clcar-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el-location-box.slider .section-heading' => 'justify-content:{{VALUE}}',
				],
				'condition' => [
					'arrows'=>'yes'
				]
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
				'type'         => \Elementor\Controls_Manager::SWITCHER,
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
				'type'    => \Elementor\Controls_Manager::NUMBER,
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
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'size_units' => [ 'px'],
				'default' => [
					'size' => 10,
				],
			]
		);
		$this->add_control(
			'item',
			[
				'label'   => __( 'Desktop items', 'clcar-core' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
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
				'type'    => \Elementor\Controls_Manager::SLIDER,
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
				'type'    => \Elementor\Controls_Manager::SLIDER,
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
				'type'    => \Elementor\Controls_Manager::SLIDER,
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

		$this->start_controls_section(
			'style_settings',
			[
				'label'     => esc_html__( 'Style Settings', 'clcar-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'nav_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Navigation Background', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .el-location-box.slider .section-heading .swiper-button .custom-swiper-button-next' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .el-location-box.slider .section-heading .swiper-button .custom-swiper-button-prev' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

    }
    protected function rt_term_post_count( $term_id ) {
		$args = [
			'nopaging'            => true,
			'fields'              => 'ids',
			'post_type'           => 'rtcl_listing',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'suppress_filters'    => false,
			'tax_query'           => [
				[
					'taxonomy' => 'rtcl_location',
					'field'    => 'term_id',
					'terms'    => $term_id,
				],
			],
		];

		$posts = get_posts( $args );
		return count( $posts );
	}
	protected function render() {
		$data = $this->get_settings();
		if($data['slider_autoplay'] == 'yes'){
			$data['slider_autoplay'] = true;
		}
		else {
			$data['slider_autoplay'] = false;
		}
		$slider_data = array(
			'slidesPerView' 	    => 1,
			'loop'				    => $data['slider_loop']=='yes' ? true:false,
			'direction'				=> 'horizontal',
			'centeredSlides'	    => $data['centeredSlides']=='yes' ? true:false ,
			'slideToClickedSlide'   => true,
			'spaceBetween'		    => $data['space']['size'],
			'slidesPerGroup'		=> $data['slider_per_group']['size'],
			'autoplay'				=> array(
				'delay'             => $data['slider_autoplay_delay'],
			),
			'speed'                 => $data['speed'],
			'auto'		            => $data['slider_autoplay'],
			'breakpoints'   => array(
				'0'         => array('slidesPerView' => 1),
				'576'       => array('slidesPerView' => $data['item_mobile']['size']),
				'768'       => array('slidesPerView' => $data['item_tablet']['size']),
				'992'       => array('slidesPerView' => $data['medium_item']['size']),
				'1200'      => array('slidesPerView' => $data['item']['size']),
				'1600'      => array('slidesPerView' => $data['item']['size'])
			),
		);
		$data['slider_data'] = json_encode( $slider_data );

		$template = 'view-'.$data['layouts'];

		$this->rt_template( $template, $data );
	}

}