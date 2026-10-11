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

class Rt_Pricing_Tab extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Pricing Tab', 'clcar-core' );
		$this->rt_base = 'rt-pricing-tab';
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
        /**Per month repeater control */
        $repeater1 = new \Elementor\Repeater();
        $repeater1->add_control(
			'title', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'clcar-core' ),
				'default' => esc_html__( 'Basic Plan', 'clcar-core' ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'price', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Price', 'clcar-core' ),
				'default'  => esc_html__('$39','clcar'),
				'label_block' => true,
			]
		);
        $repeater1->add_control(
			'price_suffix', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Price Suffix', 'clcar-core' ),
				'default'  => esc_html__('Per Month','clcar-core'),
				'label_block' => true,
			]
		);
        $repeater1->add_control(
			'description', [
				'type' => Controls_Manager::TEXTAREA,
				'label'   => esc_html__( 'Description', 'clcar-core' ),
				'default'  => esc_html__('Massa tempor feugiat nisl pretium area Egestas Massa tempor near agecry feugiat nisl pretium asian.','clcar-core'),
				'label_block' => true,
			]
		);
        $repeater1->add_control(
			'content', [
				'type' => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Content', 'clcar-core' ),
				'label_block' => true,
			]
		);
        $repeater1->add_control(
			'btn_text', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'clcar-core' ),
                'default'  => esc_html__('Purchase Now','clcar-core'),
				'label_block' => true,
			]
		);
        $repeater1->add_control(
			'btn_url', [
				'type' => Controls_Manager::URL,
				'label'   => esc_html__( 'Button URL', 'clcar-core' ),
				'label_block' => true,
			]
		);
        /**Yearly repeater control */
		$repeater2 = new \Elementor\Repeater();

        $repeater2->add_control(
			'yearly_title', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'clcar-core' ),
				'default' => esc_html__( 'Basic Plan', 'clcar-core' ),
				'label_block' => true,
			]
		);
		$repeater2->add_control(
			'yearly_price', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Price', 'clcar-core' ),
				'default'  => esc_html__('$39','clcar-core'),
				'label_block' => true,
			]
		);
        $repeater2->add_control(
			'yearly_price_suffix', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Price Suffix', 'clcar-core' ),
				'default'  => esc_html__('Per Month','clcar-core'),
				'label_block' => true,
			]
		);
        $repeater2->add_control(
			'yearly_description', [
				'type' => Controls_Manager::TEXTAREA,
				'label'   => esc_html__( 'Description', 'clcar-core' ),
				'default'  => esc_html__('Massa tempor feugiat nisl pretium area Egestas Massa tempor near agecry feugiat nisl pretium asian.','clcar-core'),
				'label_block' => true,
			]
		);
        $repeater2->add_control(
			'yearly_content', [
				'type' => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Content', 'clcar-core' ),
				'label_block' => true,
			]
		);
        $repeater2->add_control(
			'yearly_btn_text', [
				'type' => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'clcar-core' ),
                'default'  => esc_html__('Purchase Now','clcar-core'),
				'label_block' => true,
			]
		);
        $repeater2->add_control(
			'yearly_btn_url', [
				'type' => Controls_Manager::URL,
				'label'   => esc_html__( 'Button URL', 'clcar-core' ),
				'label_block' => true,
			]
		);
        $this->add_control(
            'monthly_title',[
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Monthly Title', 'clcar-core' ),
                'default'     => "Monthly",
            ]
        );
        $this->add_control(
            'yearly_title',[
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Yearly Title', 'clcar-core' ),
                'default'     => "Yearly",
            ]
        );
        $this->add_control(
			'monthly_features',
			[
				'label'       => __( 'Monthly Feature List', 'clcar-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater1->get_controls(),
				'default'     => [
					[
						'title'        => __( 'Basic Plan', 'clcar-core' ),
						'price' => __( '$39', 'clcar-core' ),
						'content'     => __( 'All Listing Access','clcar-core' ),
					],
                    [
						'title'        => __( 'Basic Plan', 'clcar-core' ),
						'price' => __( '$39', 'clcar-core' ),
						'content'     => __( 'All Listing Access','clcar-core' ),
					],
                    [
						'title'        => __( 'Basic Plan', 'clcar-core' ),
						'price' => __( '$39', 'clcar-core' ),
						'content'     => __( 'All Listing Access','clcar-core' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);
        $this->add_control(
			'yearly_features',
			[
				'label'       => __( 'Yearly Feature List', 'clcar-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater2->get_controls(),
				'default'     => [
					[
						'yearly_title'        => __( 'Basic Plan', 'clcar-core' ),
						'yearly_price' => __( '$39', 'clcar-core' ),
						'yearly_content'     => __( 'All Listing Access','clcar-core' ),
					],
                    [
						'yearly_title'        => __( 'Basic Plan', 'clcar-core' ),
						'yearly_price' => __( '$39', 'clcar-core' ),
						'yearly_content'     => __( 'All Listing Access','clcar-core' ),
					],
                    [
						'yearly_title'        => __( 'Basic Plan', 'clcar-core' ),
						'yearly_price' => __( '$39', 'clcar-core' ),
						'yearly_content'     => __( 'All Listing Access','clcar-core' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		return $this->rt_template( $template, $data );
	}

}