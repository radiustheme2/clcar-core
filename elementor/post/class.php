<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.2
 */

namespace radiustheme\ClCar_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Post extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name      = esc_html__( 'Post', 'clcar-core' );
		$this->rt_base      = 'rt-post';
		$this->rt_translate = [
			'cols' => [
				'3'  => __( '4 Columns', 'clcar-core' ),
				'4'  => __( '3 Columns', 'clcar-core' ),
				'6'  => __( '2 Columns', 'clcar-core' ),
				'12' => __( '1 Columns', 'clcar-core' ),
			],
		];
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		// widget title
		$this->start_controls_section(
			'rt_post_grid',
			[
				'label' => esc_html__( 'Post Grid', 'clcar-core' ),
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
					'style3' => __( 'Style 3', 'clcar-core' ),
				],
			]
		);

		$this->add_control(
			'gridcolumn-popover-toggle',
			[
				'label'        => __( 'Grid Column', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'clcar-core' ),
				'label_on'     => __( 'Custom', 'clcar-core' ),
				'return_value' => 'yes',
			]
		);
		$this->start_popover();

		$this->add_control(
			'gird_column_desktop',
			[
				'label'   => esc_html__( 'Grid Column for Desktop', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => $this->rt_translate['cols'],

			]
		);

		$this->add_control(
			'gird_column_tab',
			[
				'label'   => esc_html__( 'Grid Column for Tab', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '6',
				'options' => $this->rt_translate['cols'],

			]
		);

		$this->add_control(
			'gird_column_mobile',
			[
				'label'   => esc_html__( 'Grid Column for Mobile', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '12',
				'options' => $this->rt_translate['cols'],

			]
		);

		$this->end_popover();

		$this->add_control(
			'post_limit',
			[
				'label'       => __( 'Post Limit', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post Limit', 'clcar-core' ),
				'description' => __( 'Enter number of post to show.', 'clcar-core' ),
				'default'     => '12',
			]
		);

		$this->add_control(
			'post_source',
			[
				'label'       => __( 'Post Source', 'clcar-core' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'most_recent' => __( 'From all recent post', 'clcar-core' ),
					'by_category' => __( 'By Category', 'clcar-core' ),
					'by_tags'     => __( 'By Tags', 'clcar-core' ),
					'by_id'       => __( 'By Post ID', 'clcar-core' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'clcar-core' ),
			]
		);

		$this->add_control(
			'categories',
			[
				'label'       => __( 'Choose Categories', 'clcar-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_category_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_category',
				],
				'description' => __( 'Select post category\'s.', 'clcar-core' ),
			]
		);

		$this->add_control(
			'tags',
			[
				'label'       => __( 'Choose Tags', 'clcar-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_tag_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_tags',
				],
				'description' => __( 'Select post tag\'s.', 'clcar-core' ),
			]
		);

		$this->add_control(
			'post_id',
			[
				'label'       => __( 'Enter post IDs', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Enter the post IDs separated by comma', 'clcar-core' ),
				'label_block' => 'true',
				'condition'   => [
					'post_source' => 'by_id',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       => __( 'Post offset', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post offset', 'clcar-core' ),
				'description' => __( 'Number of post to displace or pass over. The offset parameter is ignored when post limit => -1 (show all posts) is used.', 'clcar-core' ),
			]
		);

		$this->add_control(
			'exclude',
			[
				'label'       => __( 'Exclude posts', 'clcar-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => 'true',
				'description' => __( 'Enter the post IDs separated by comma for exclude', 'clcar-core' ),
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'clcar-core' ),
				'type'    =>Controls_Manager::SELECT,
				'options' => [
					'date'           => __( 'Date', 'clcar-core' ),
					'ID'             => __( 'Order by post ID', 'clcar-core' ),
					'author'         => __( 'Author', 'clcar-core' ),
					'title'          => __( 'Title', 'clcar-core' ),
					'modified'       => __( 'Last modified date', 'clcar-core' ),
					'comment_count'  => __( 'Number of comments', 'clcar-core' ),
					'rand'           => __( 'Random order', 'clcar-core' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Sort order', 'clcar-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => __( 'ASC', 'clcar-core' ),
					'DESC' => __( 'DESC', 'clcar-core' ),
				],
			]
		);
		$this->end_controls_section();
		
		// Thumbnail style
		//========================================================
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => __( 'Thumbnail Style', 'clcar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'project_thumbnail_size',
			[
				'label'     => esc_html__( 'Image Size', 'clcar-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->rt_get_all_image_sizes(),
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'      => __( 'Image Height', 'clcar-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px','%' ],
				'range'      => [
					'%' => [
						'min'  => 20,
						'max'  => 100,
					],
					'px' => [
						'min'  => 300,
						'max'  => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-post-wrapper .blog-block__figure img' => 'height: {{SIZE}}{{UNIT}};object-fit:cover',
				],
			]
		);

		$this->end_controls_section();


		// Title Settings
		//=====================================================================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Style', 'clcar-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .rt-el-post-wrapper .blog-block__heading',
			]
		);
		$this->add_control(
			'title_limit',
			[
				'label'     => __( 'Ttitle Character Limit', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => '10',
			]
		);
		$this->add_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'clcar-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-el-post-wrapper .blog-block__heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_normal_tab',
			[
				'label' => __( 'Normal', 'clcar-core' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-el-post-wrapper .blog-block__heading a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover_tab',
			[
				'label' => __( 'Hover', 'clcar-core' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title Hover Color', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-el-post-wrapper .blog-block__heading a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Content Settings
		//=====================================================================

		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Excerpt Style', 'clcar-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_visibility',
			[
				'label'   => __( 'Excerpt Visibility', 'clcar-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'clcar-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'clcar-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'hidden',
			]
		);
		$this->add_control(
			'content_limit',
			[
				'label'     => __( 'Excerpt Limit', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => '15',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'content_typography',
				'selector'  => '{{WRAPPER}} .rt-el-post-wrapper .post-excerpt',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_spacing',
			[
				'label'              => __( 'Excerpt Spacing', 'clcar-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-el-post-wrapper .post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'condition'          => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-el-post-wrapper .post-excerpt' => 'color: {{VALUE}}',
				],
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();

		// Meta Information Settings
		//=====================================================================

		$this->start_controls_section(
			'meta_info_style',
			[
				'label' => __( 'Meta Info Style', 'clcar-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'post_meta_typography',
				'selector' => '{{WRAPPER}} .rt-el-post-wrapper .blog-block__meta ul li',
			]
		);

		$this->start_controls_tabs(
			'post_meta_style_tabs'
		);

		$this->start_controls_tab(
			'post_meta_normal_tab',
			[
				'label' => __( 'Normal', 'clcar-core' ),
			]
		);


		$this->add_control(
			'post_meta_color',
			[
				'label'     => __( 'Meta Color', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-el-post-wrapper .blog-block__meta ul li' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-el-post-wrapper .blog-block__meta ul li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_meta_hover_tab',
			[
				'label' => __( 'Box Hover', 'clcar-core' ),
			]
		);

		$this->add_control(
			'post_meta_color_hover',
			[
				'label'     => __( 'Meta Color Hover', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-el-post-wrapper .blog-block__meta ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'author_visibility',
			[
				'label'        => __( 'Author Visibility', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clcar-core' ),
				'label_off'    => __( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'author_avatar',
			[
				'label'     => __( 'Author Avatar Style', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'icon',
				'options'   => [
					'icon'      => __( 'Author Icon', 'clcar-core' ),
					'image'     => __( 'Author Image', 'clcar-core' ),
					'no-avatar' => __( 'No Avatar', 'clcar-core' ),
				],
				'condition' => [
					'author_visibility' => 'yes',
				],
			]
		);


		$this->add_control(
			'cat_visibility',
			[
				'label'        => __( 'Category Visibility', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clcar-core' ),
				'label_off'    => __( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false
			]
		);

		$this->add_control(
			'date_visibility',
			[
				'label'        => __( 'Date Visibility', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clcar-core' ),
				'label_off'    => __( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'p_date_format',
			[
				'label'     => __( 'Date Format', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'time_ago',
				'options'   => [
					'default'  => __( 'Default From Settings', 'clcar-core' ),
					'time_ago' => __( 'Time Ago Format', 'clcar-core' ),
				],
			]
		);


		$this->add_control(
			'reading_time_visibility',
			[
				'label'        => __( 'Reading Time Visibility', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clcar-core' ),
				'label_off'    => __( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'comment_visibility',
			[
				'label'        => __( 'Comment Visibility', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clcar-core' ),
				'label_off'    => __( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);


		$this->end_controls_section();
		// Read More Settings
		//=====================================================================

		$this->start_controls_section(
			'read_more_btn',
			[
				'label' => __( 'Button Settings', 'clcar-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'read_more_btn_display',
			[
				'label'        => __( 'Button', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clcar-core' ),
				'label_off'    => __( 'Hide', 'clcar-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'read_more_btn_text',
			[
				'label'        => __( 'Button Text', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::TEXT,
				'default'	   =>__('Read Details','clcar-core'),
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';
		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'style3' == $data['layout'] ) {
			$template = 'view-3';
		}
		$this->rt_template( $template, $data );
	}

}