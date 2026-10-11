<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClCar_Core;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Rtcl\Helpers\Functions;
use Rtcl\Models\RtclCFGField;
use \WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RT_Listing_Tab extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Listing Tab', 'clcar-core' );
		$this->rt_base = 'rt-listing-tab';

		$this->rt_translate = [
			'cols'        => [
				'12' => __( '1 Columns', 'clcar-core' ),
				'6'  => __( '2 Columns', 'clcar-core' ),
				'4'  => __( '3 Columns', 'clcar-core' ),
				'3'  => __( '4 Columns', 'clcar-core' ),
			],
		];

		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$terms             = get_terms( [ 'taxonomy' => 'rtcl_category', 'fields' => 'id=>name' ] );
		$category_dropdown = [];

		$type_dropdown = Functions::get_listing_types();

		foreach ( $terms as $id => $name ) {
			$category_dropdown[ $id ] = $name;
		}

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		

		$this->add_responsive_control(
			'gird_column_desktop',
			[
				'label'     => esc_html__( 'Grid Column', 'clcar-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->rt_translate['cols'],
				'default'   => '4',
			]
		);



		$this->add_control(
			'type',
			[
				'type'     => Controls_Manager::SELECT2,
				'label'    => esc_html__( 'Type', 'clcar-core' ),
				'options'  => $type_dropdown,
				'multiple' => true,
			]
		);

		$this->add_control(
			'number',
			[
				'label'       => esc_html__( 'Posts Type Per Page', 'clcar-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '8',
				'description' => esc_html__( 'Write -1 to show all', 'clcar-core' ),
			]
		);

		$this->add_control(
			'random',
			[
				'label'        => esc_html__( 'Change items on every page load', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'clcar-core' ),
				'label_off'    => esc_html__( 'Off', 'clcar-core' ),
				'default'      => false,
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'cat',
			[
				'type'       => Controls_Manager::SELECT2,
				'label'      => esc_html__( 'Categories', 'clcar-core' ),
				'options'    => $category_dropdown,
				'multiple'   => true,
			]
		);
		$this->add_control(
			'orderby',
			[
				'type'       => Controls_Manager::SELECT2,
				'label'      => esc_html__( 'Order By', 'clcar-core' ),
				'options'    => [
					'date'  => __( 'Date (Recents comes first)', 'clcar-core' ),
					'title' => __( 'Title', 'clcar-core' ),
				],
				'default'    => 'date',
			]
		);

		$this->add_control(
			'order',
			[
				'type'       => Controls_Manager::SELECT2,
				'label'      => esc_html__( 'Sort By', 'clcar-core' ),
				'options'    => [
					'asc'  => esc_html__( 'Ascending', 'clcar-core' ),
					'desc' => esc_html__( 'Descending', 'clcar-core' ),
				],
				'default'    => 'asc',
			]
		);

		$this->add_control(
			'more_options',
			[
				'label'     => __( 'Field Visibility Options', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'cat_display',
			[
				'label'        => esc_html__( 'Category Visibility', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'clcar-core' ),
				'label_off'    => esc_html__( 'Off', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'content_visibility',
			[
				'label'        => esc_html__( 'Content Visibility', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'clcar-core' ),
				'label_off'    => esc_html__( 'Off', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'content_limit',
			[
				'label'     => esc_html__( 'Content Limit', 'clcar-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 30,
				'condition' => [
					'content_visibility' => 'yes',
				],
			]
		);
		$this->add_control(
			'listing_action_visibility',
			[
				'label'        => esc_html__( 'Action Button Visibility', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'clcar-core' ),
				'label_off'    => esc_html__( 'Off', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'location_visibility',
			[
				'label'        => esc_html__( 'Location Visibility', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'clcar-core' ),
				'label_off'    => esc_html__( 'Off', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'date_visibility',
			[
				'label'        => esc_html__( 'Date Visibility', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'clcar-core' ),
				'label_off'    => esc_html__( 'Off', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'views_display',
			[
				'label'        => esc_html__( 'Post View Count Visibility', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'clcar-core' ),
				'label_off'    => esc_html__( 'Off', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'label_display',
			[
				'label'        => esc_html__( 'Label Visibility', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'clcar-core' ),
				'label_off'    => esc_html__( 'Off', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'type_visibility',
			[
				'label'        => esc_html__( 'Listing Type Visibility', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'clcar-core' ),
				'label_off'    => esc_html__( 'Off', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'author_display',
			[
				'label'        => esc_html__( 'Display Author Name', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'clcar-core' ),
				'label_off'    => esc_html__( 'Off', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'custom_fields_display',
			[
				'label'        => esc_html__( 'Custom Fields', 'clcar-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'clcar-core' ),
				'label_off'    => esc_html__( 'Off', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		/*
		 * Additional Settings
		 * ===========================================
		 */
		$this->start_controls_section(
			'additional_settings',
			[
				'label' => esc_html__( 'Additional Settings', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'thumbnail_size',
			[
				'label'   => __( 'Thumbnail Size', 'clcar-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->rt_get_all_image_sizes(),
			]
		);

		$this->add_responsive_control(
			'thumb_height',
			[
				'label'      => __( 'Thumbnail Height', 'clcar-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range'      => [
					'px' => [
						'min'  => 150,
						'max'  => 1000,
						'step' => 5,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .listing-thumb > img' => 'height: {{SIZE}}{{UNIT}};object-fit:cover',
				],
			]
		);
		$this->end_controls_section();

		/*
		 * Filter Settings
		 * ===========================================
		 */
		$this->start_controls_section(
			'filter_settings',
			[
				'label'     => esc_html__( 'Filter Settings', 'clcar-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'filter_text_align',
			[
				'label'     => __( 'Alignment', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start'   => [
						'title' => __( 'Left', 'clcar-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'clcar-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'  => [
						'title' => __( 'Right', 'clcar-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .rt-el-listing-wrapper .isotope-classes-tab' => 'justify-content: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'show_all_btn',
			[
				'label'        => __( 'Show All Button', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clcar-core' ),
				'label_off'    => __( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);
		$this->start_controls_tabs(
			'filter_style_tabs'
		);

		$this->start_controls_tab(
			'filter_style_normal_tab',
			[
				'label' => __( 'Normal', 'clcar-core' ),
			]
		);

		$this->add_control(
			'filter_color',
			[
				'label'     => __( 'Color', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-classes-tab .nav-item' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filter_background',
			[
				'label'     => __( 'Background', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-classes-tab .nav-item'         => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .isotope-classes-tab .nav-item::before' => 'border-top-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'filter_style_hover_tab',
			[
				'label' => __( 'Hover/Active', 'clcar-core' ),
			]
		);

		$this->add_control(
			'filter_color_hover',
			[
				'label'     => __( 'Color on Hover', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-classes-tab .nav-item:hover'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .isotope-classes-tab .nav-item.current' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filter_background_hover',
			[
				'label'     => __( 'Background on Hover', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .isotope-classes-tab .nav-item:hover, {{WRAPPER}} .isotope-classes-tab .nav-item.current'                 => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .isotope-classes-tab .nav-item:hover::before, {{WRAPPER}} .isotope-classes-tab .nav-item.current::before' => 'border-top-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'filter_typography',
				'label'    => __( 'Filter Typography', 'clcar-core' ),
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .isotope-classes-tab .nav-item',
			]
		);

		$this->add_responsive_control(
			'filter_spacing',
			[
				'label'              => __( 'Spacing', 'clcar-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '30',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .filter-wrapper .isotope-classes-tab' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
		//End Filter Settings

		$this->start_controls_section(
			'sec_color',
			[
				'label' => esc_html__( 'Color', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item h3.listing-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Hover', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item h3.listing-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-listing-wrapper .rtcl-listings.rtcl-grid-view .listing-item .listing-excerpt' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Price', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-listing-wrapper .item-price .rtcl-price'                    => 'color: {{VALUE}}',
					'{{WRAPPER}} .rtcl span.rtcl-price-meta' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cat_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Category', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-el-listing-wrapper  .listing-category a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Meta', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .entry-meta li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'meta_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Meta Icon', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .entry-meta li i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'meta_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Meta Background', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .listable-items' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'custom_field_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Custom Field Icon', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .listing-features li i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'custom_field_text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Custom Field Text', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .listing-features li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sec_label_color',
			[
				'label' => esc_html__( 'Label Color', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_control(
			'featured_label_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Featured Background', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .badge.rtcl-badge-featured' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'featured_label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Featured Text Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl-listing-badge-wrap span.badge' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'new_label_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'New Background', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .badge.rtcl-badge-new' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'new_label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'New Text Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl-listing-badge-wrap span.badge.rtcl-badge-new' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'popular_label_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Popular Background', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl-listing-badge-wrap span.badge.popular-badge' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'popular_label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Popular Text Color', 'clcar-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtcl-listing-badge-wrap span.badge.popular-badge' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sec_typo',
			[
				'label' => esc_html__( 'Typography', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Title', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rtcl .rtcl-listings .listing-item h3.listing-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Content Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-el-listing-wrapper .rtcl-listings.rtcl-grid-view .listing-item .listing-excerpt',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'price_type',
				'label'    => esc_html__( 'Price Typography', 'clcar-core' ),
				'selector' => '{{WRAPPER}} .rt-el-listing-wrapper .item-price .rtcl-price',
			]
		);


		$this->end_controls_section();
	}

	private function rt_isotope_query( $data ) {
		$result = [];

		// Post type
		$args = [
			'post_type'           => 'rtcl_listing',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => $data['number'],
		];

		// Ordering
		if ( $data['random'] ) {
			$args['orderby'] = 'rand';
		} else {
			$args['orderby'] = $data['orderby'];
			if ( $data['orderby'] == 'title' ) {
				$args['order'] = 'ASC';
			}
		}

		// Date and Meta Query results

		$args2 = [];

		if ( ! empty( $data['cat'] ) ) {
			$args2['tax_query'] = [
				[
					'taxonomy' => 'rtcl_category',
					'field'    => 'term_id',
					'terms'    => $data['cat'],
				],
			];
		}

		foreach ( $data['type'] as $key => $value ) {
			$args2['meta_query'] = [
				[
					'key'     => 'ad_type',
					'value'   => $value,
					'compare' => '=',
				],
			];

			$result[ $value ] = new WP_Query( $args + $args2 );
			$args2            = [];
		}

		return $result;
	}

	private function rt_isotope_navigation( $data ) {
		$type_list = Functions::get_listing_types();

		$navs = [];

		if ( ! empty( $type_list ) ) {
			$navs = $type_list;
		}

		$navs = apply_filters( 'clar_isotope_navigations', $navs );

		foreach ( $navs as $key => $value ) {
			if ( ! in_array( $key, $data['type'] ) ) {
				unset( $navs[ $key ] );
			}
		}

		return $navs;
	}

	protected function render() {

		$data = $this->get_settings();
		$data['queries'] = $this->rt_isotope_query( $data );
			$data['navs']    = $this->rt_isotope_navigation( $data );
			if ( empty( $data['queries'] ) ) {
				echo '<div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i>';
				echo esc_html__( " Please choose 2 or more ( Ad Type ) first for showing posts", "clcar-core" );
				echo '</div>';
			}
		$template = 'view-1';

		$this->rt_template( $template, $data );
	}


}