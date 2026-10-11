<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/contact-box/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\ClCar_Core;

if (!class_exists( 'RtclPro' )) return;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Rtcl\Helpers\Functions;

class RT_Listing_Search extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Listing Search', 'clcar-core' );
		$this->rt_base = 'rt-listing-search';
		parent::__construct( $data, $args );
	}
	public function custom_field_group_list() {
		$group_ids = Functions::get_cfg_ids();

		$list = [];
		foreach ( $group_ids as $id ) {
			$list[ $id ] = get_the_title( $id );
		}

		return $list;
	}
	protected function register_controls() {
		/*
		 * General Options
		 * ************************************
		 */
		$group_list = $this->custom_field_group_list();
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1', 'clcar-core' ),
					'style2' => __( 'Style 2', 'clcar-core' ),
				],
			]
		);
		$this->add_control(
			'highlight_categories',[
				'label'   => esc_html__( 'Highlight Categories', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => $this->listing_categories_slug(),
				'multiple' => true,
				'description'=>esc_html__('If you not select any category then default showing all categories','clcar-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'cfg_id',
			[
				'label'   => esc_html__( 'Search Filtering Group Field', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT2,
				'default' => '',
				'label_block'=>true,
				'options' => $group_list,
				'description'=>esc_html__('Use car fields custom group field for filtering as like our demo','clcar-core')
			]
		);
		$this->add_control(
			'section_title',
			[
				'label'     => esc_html__( 'Section Title', 'clcar-core' ),
				'type'      => Controls_Manager::TEXT,
				'label_block'=>true,
				'default'   => __('Buy & Sell Your Car in One Click','clcar-core'),
			]
		);
		$this->add_control(
			'section_content',
			[
				'label'     => esc_html__( 'Section Content', 'clcar-core' ),
				'type'      => Controls_Manager::TEXTAREA,
				'label_block'=>true,
				'default'   => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. are many nunc facilisis tellus cras.','clcar-core'),
			]
		);
		$this->add_control(
			'type_text',
			[
				'label'     => esc_html__( 'Select Type Text', 'clcar-core' ),
				'type'      => Controls_Manager::TEXT,
				'label_block'=>true,
				'default'   => __('I am Looking for','clcar-core'),
				'condition' =>[
					'layout' =>'style1'
				]
			]
		);
		$this->add_control(
			'cfg_include_id',
			[
				'label'   => esc_html__( 'Select Custom Fields', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT2,
				'default' => '',
				'multiple' => true,
				'label_block' => true,
				'options' => $group_list,
				'description'=>esc_html__('Select custom group fields for filtering','clcar-core')
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
				'condition' =>[
					'layout' =>'style1'
				]
			]
		);
		$this->add_control(
			'show_keyword_search',
			[
				'label' => esc_html__( 'Kayword Search Field', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_location',
			[
				'label' => esc_html__( 'Location Search Field', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);
		$this->add_control(
			'show_category',
			[
				'label' => esc_html__( 'Category Search Field', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_brand',
			[
				'label' => esc_html__( 'Brand Search Field', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_build_year',
			[
				'label' => esc_html__( 'Build Year Search Field', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'google_location',
			[
				'label' => esc_html__( 'Google Location Search Field', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);
		$this->add_control(
			'radius_search',
			[
				'label' => esc_html__( 'Radius Search Field', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);
		$this->add_control(
			'price_search',
			[
				'label' => esc_html__( 'Price Search Field', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);
		$this->add_control(
			'show_advanced_search',
			[
				'label' => esc_html__( 'Advanced Search Field', 'clcar-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => false,
				'condition'	=>[
					'layout' =>'style2'
				]
			]
		);
		$this->end_controls_section();

		/*
		 * Top Sub Title
		 * ************************************
		 */
		//Image Style
		//=============================================
		$this->start_controls_section(
			'image_settings',
			[
				'label' => esc_html__( 'Section Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' =>[
					'layout' =>'style1'
				]
			]
		);

		$this->add_responsive_control(
			'box_height',
			[
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'label'           => __( 'Section Height', 'clcar-core' ),
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 730,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 500,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 400,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .rt-hero-section.style1' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
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
					'{{WRAPPER}} .rt-hero-section .hero-content__heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .hero-content' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cat_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Category Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .search-radio .list-inline li label' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-hero-section .search-radio .list-inline li:first-child' => 'color: {{VALUE}}',
				],
				'condition' =>[
					'layout'=>'style1'
				]
			]
		);
		$this->add_control(
			'input_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Input Background', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .listing-filter-area .search-area .search-item' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-hero-section.style2 .listing-search-filter-area .search-item' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-hero-section.style2 .search-keyword .input-group .form-control' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'input_box_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Input Box Background', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .listing-filter-area' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-hero-section.style2 .hero-banner-content' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'content_spacing',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Content Space', 'clcar-core' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .hero-banner-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-hero-section.style2 .hero-section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'input_spacing',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Input Space', 'clcar-core' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .banner-search-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-hero-section.style2 .listing-search-filter-area .search-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_type',
				'label'    => esc_html__( 'Title Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-hero-section .hero-content__heading',
			]
		);
		$this->add_control(
			'advance_search_column',
			[
				'label'   => esc_html__( 'Advance Search Column', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'column4',
				'options' => [
					'column1' => __( 'Column 1', 'clcar-core' ),
					'column4' => __( 'Column 4', 'clcar-core' ),
				],
				'condition' =>[
					'layout' =>'style2'
				]
			]
		);
		$this->end_controls_section();

    }

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		if($data['layout']=='style2'){
			$template='view-2';
		}
		$this->rt_template( $template, $data );
	}

}