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

use Rtcl\Helpers\Functions;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

class RT_Search_Form extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'FB Search Form', 'clcar-core' );
		$this->rt_base = 'rt-fb-search-form';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		/* -- General Styles -- */
		$this->__general_settings();

		/* -- Settings Styles -- */
		$this->__wrapper_style_settings();
		$this->__content_style_settings();
		$this->__button_style_settings();
		$this->__toggle_fields_settings();
    }

	protected function __general_settings() {
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
			'view',
			[
				'label' => esc_html__( 'Layout', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'inline',
				'options' => [
					'inline' => [
						'title' => esc_html__( 'Inline', 'elementor' ),
						'icon' => 'eicon-ellipsis-h',
					],
					'block' => [
						'title' => esc_html__( 'Block', 'elementor' ),
						'icon' => 'eicon-editor-list-ul',
					],
				],
				'render_type' => 'template',
				'classes' => 'elementor-control-start-end',
				'style_transfer' => true,
				'prefix_class' => 'elementor-icon-list--layout-',
			]
		);
		$this->add_control(
			'show_category',
			[
				'label' => esc_html__( 'Category Search Field', 'clcar-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'categories_label_text',
			[
				'label'     => esc_html__( 'Categories label text', 'clcar-core' ),
				'type'      => Controls_Manager::TEXT,
				'label_block'=>true,
				'default'   => __('I am Looking for','clcar-core'),
				'condition'   => [
					'show_category' => 'yes',
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
				'condition'   => [
					'show_category' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_ad_type',
			[
				'label' => esc_html__( 'Ad Type Search Field', 'clcar-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'ad_type_label_text',
			[
				'label'     => esc_html__( 'Ad Type label text', 'clcar-core' ),
				'type'      => Controls_Manager::TEXT,
				'label_block'=>true,
				'default'   => __('I am Looking for','clcar-core'),
				'condition'   => [
					'show_ad_type' => 'yes',
				],
			]
		);
		$this->add_control(
			'highlight_ad_types',[
				'label'   => esc_html__( 'Listing Ad Types', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => Functions::get_listing_types(),
				'multiple' => true,
				'description'=>esc_html__('If you not select any type then default showing all ad types','clcar-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'show_keyword_search',
			[
				'label' => esc_html__( 'Kayword Search Field', 'clcar-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_make_search',
			[
				'label' => esc_html__( 'Make Search Field', 'clcar-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_model_search',
			[
				'label' => esc_html__( 'Model Search Field', 'clcar-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_year_search',
			[
				'label' => esc_html__( 'Year Search Field', 'clcar-core' ),
				'type' => Controls_Manager::SWITCHER,
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
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);
		$this->add_control(
			'google_location',
			[
				'label' => esc_html__( 'Google Location Search Field', 'clcar-core' ),
				'type' => Controls_Manager::SWITCHER,
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
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);
		$this->add_control(
			'toggle_headings',
			[
				'label' => esc_html__( 'Toggle Fields', 'clcar-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_toggle_fields',
			[
				'label' => esc_html__( 'Show Toggle Fields', 'clcar-core' ),
				'type' => Controls_Manager::SWITCHER,
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
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clcar-core' ),
				'label_off' => esc_html__( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default' => false,
			]
		);
		$this->end_controls_section();
	}

	//Wrapper Settings
	protected function __wrapper_style_settings(){

		$this->start_controls_section(
			'wrapper_settings',
			[
				'label' => esc_html__( 'Wrapper Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'form_wrapper_spacing',
			[
				'type' => Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Form Wrapper Padding', 'clcar-core' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .listing-filter-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'form_wrapper_border_radius',
			[
				'type' => Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Form Wrapper Border Radius', 'clcar-core' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .listing-filter-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'form_wrapper_bg_color',
				'label'    => esc_html__( 'Background', 'clcar-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__(' Background', 'clcar-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .rt-hero-section .listing-filter-area',
			]
		);
		$this->end_controls_section();
	}

	//Content Style Settings
	protected function __content_style_settings(){
		$this->start_controls_section(
			'style_settings',
			[
				'label' => esc_html__( ' Fields Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'space_between_fields',
			[
				'type'            => Controls_Manager::SLIDER,
				'label'           => __( 'Space Between Fields', 'clcar-core' ),
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'       => [
					'{{WRAPPER}} .listing-search-fb-form .others-fields' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .listing-search-fb-form .others-fields .search-area' => 'gap: {{SIZE}}{{UNIT}};',
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
			]
		);
		$this->add_responsive_control(
			'input_field_height',
			[
				'type'            => Controls_Manager::SLIDER,
				'label'           => __( 'Fields Height', 'clcar-core' ),
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'       => [
					'{{WRAPPER}} .rt-hero-section .listing-custom-search-wrapper .listing-custom-search-box .rtcl-search-type' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'input_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Input Background', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .listing-filter-area .search-area .search-item' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'input_spacing',
			[
				'type' => Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Input Space', 'clcar-core' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .listing-filter-area .search-area .search-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'input_fields_border',
				'label'     => __( 'Border', 'clcar-core' ),
				'selector'  => '{{WRAPPER}} .rt-hero-section .listing-filter-area .search-area .search-item',
			]
		);
		$this->add_responsive_control(
			'input_fields_border_radius',
			[
				'type' => Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Border Radius', 'clcar-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .listing-filter-area .search-area .search-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	// Button Style
	protected function __button_style_settings() {
		$this->start_controls_section(
			'submit_button_style',
			[
				'label' => esc_html__( 'Submit Button', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'button_type',
			[
				'label'   => __( 'Button Type', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'inline_button',
				'options' => [
					'inline_button'  => __( 'Inline', 'clcar-core' ),
					'block_button' => __( 'Block', 'clcar-core' ),
				],
			]
		);
		$this->add_responsive_control(
			'button_icon_gap',
			[
				'type'            => Controls_Manager::SLIDER,
				'label'           => __( 'Button and Icon Gap', 'clcar-core' ),
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'       => [
					'{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'clcar-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->start_controls_tabs( 'btn_tab_style' );
		// Normal tab.
		$this->start_controls_tab(
			'btn_style_normal',
			[
				'label' => __( 'Normal', 'clcar-core' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clcar-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn' => 'color: {{VALUE}}',

				),
			]
		);
		$this->add_control(
			'btn_icon_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon Color', 'clcar-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn svg' => 'fill: {{VALUE}}',
				),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typo',
				'label'    => esc_html__( 'Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_bg_color',
				'label'    => esc_html__( 'Background', 'clcar-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__(' Background', 'clcar-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'label'     => __( 'Border', 'clcar-core' ),
				'selector'  => '{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn',
			]
		);
		$this->add_responsive_control(
			'btn_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'clcar-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'btn_style_hover',
			[
				'label' => __( 'Hover', 'clcar-core' ),
			]
		);
		$this->add_control(
			'btn_h_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clcar-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn:hover' => 'color: {{VALUE}}',
				),
			]
		);

		$this->add_control(
			'btn_icon_h_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon Color', 'clcar-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn:hover svg' => 'fill: {{VALUE}}',
				),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_hbg_color',
				'label'     => __( 'Background', 'clcar-core' ),
				'selector'  => '{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_hover_border',
				'label'     => __( 'Border', 'clcar-core' ),
				'selector'  => '{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	//Toggle Fields Settings
	protected function __toggle_fields_settings(){

		$this->start_controls_section(
			'toggle_settings',
			[
				'label' => esc_html__( 'Toggle Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'show_toggle_fields' => 'yes',
				],
			]
		);
		$this->add_control(
			'toggle_fields_columns',
			[
				'label'   => esc_html__( 'Style', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'toggle-fields-cols-1' => __( 'Column 1', 'clcar-core' ),
					'toggle-fields-cols-2' => __( 'Columns 2', 'clcar-core' ),
					'toggle-fields-cols-3' => __( 'Columns 3', 'clcar-core' ),
					'toggle-fields-cols-4' => __( 'Columns 4', 'clcar-core' ),
					'toggle-fields-cols-5' => __( 'Columns 6', 'clcar-core' ),
					'toggle-fields-cols-6' => __( 'Columns 6', 'clcar-core' ),
				],
				'default' => 'toggle-fields-cols-4',
			]
		);
		$this->add_responsive_control(
			'toggle_field_height',
			[
				'type'            => Controls_Manager::SLIDER,
				'label'           => __( 'Fields Height', 'clcar-core' ),
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors'       => [
					'{{WRAPPER}} .rt-hero-section .listing-custom-search-wrapper .listing-custom-search-box .rtcl-search-type' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'toggle_input_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Input Background', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .listing-custom-search-wrapper .listing-custom-search-box .rtcl-search-type' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'toggle_fields_border',
				'label'     => __( 'Border', 'clcar-core' ),
				'selector'  => '{{WRAPPER}} .rt-hero-section .search-item.search-btn .submit-btn:hover',
			]
		);
		$this->add_responsive_control(
			'toggle_fields_radius',
			[
				'type' => Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Border Radius', 'clcar-core' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-hero-section .listing-custom-search-wrapper .listing-custom-search-box .rtcl-search-type' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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