<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClCar_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class RT_Extende_Element_Widget {

	public function __construct() {
		add_action( 'elementor/widget/before_render_content', [ $this, 'clcar_elementor_extend_widget_render' ] );
		add_action( 'elementor/element/button/section_style/after_section_start', [ $this, 'custom_button_control' ], 10, 2 );

		add_action( 'elementor/element/image-carousel/section_style_image/after_section_start', function( $element, $args ) {
			$element->add_control(
				'image_gray_option',
				[
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Image Gray Style', 'clcar-core' ),
					'label_on' => esc_html__( 'Show', 'clcar-core' ),
					'label_off' => esc_html__( 'Hide', 'clcar-core' ),
					'return_value' => 'has-gray',
					'default' => 'has-gray',
				]
			);

		}, 10, 2 );

		add_action( 'elementor/element/section/section_background/before_section_end', [ $this, 'add_elementor_section_background_controls' ] );
		add_action( 'elementor/frontend/section/before_render', [ $this, 'render_elementor_section_parallax_background' ] );
	}

	function add_elementor_section_background_controls( \Elementor\Element_Section $section ) {
		$section->add_control(
			'rt_section_parallax',
			[
				'label'        => __( 'Parallax', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_off'    => __( 'Off', 'clcar-core' ),
				'label_on'     => __( 'On', 'clcar-core' ),
				'default'      => 'no',
				'prefix_class' => 'rt-parallax-bg-',
			]
		);

		$section->add_control(
			'rt_parallax_speed',
			[
				'label'     => __( 'Speed', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0.1,
				'max'       => 5,
				'step'      => 0.1,
				'default'   => 0.5,
				'condition' => [
					'rt_section_parallax' => 'yes',
				],
			]
		);

		$section->add_control(
			'rt_parallax_transition',
			[
				'label'        => __( 'Parallax Transition off?', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_off'    => __( 'on', 'clcar-core' ),
				'label_on'     => __( 'Off', 'clcar-core' ),
				'default'      => 'off',
				'return_value' => 'off',
				'prefix_class' => 'rt-parallax-transition-',
				'condition'    => [
					'rt_section_parallax' => 'yes',
				],
			]
		);
	}

	// Render section background parallax
	function render_elementor_section_parallax_background( \Elementor\Element_Base $element ) {
		if ( 'section' === $element->get_name() ) {
			if ( 'yes' === $element->get_settings_for_display( 'rt_section_parallax' ) ) {
				$rt_background = $element->get_settings_for_display( 'background_image' );
				if ( ! isset( $rt_background ) ) {
					return;
				}
				$rt_background_URL = $rt_background['url'];
				$data_speed        = $element->get_settings_for_display( 'rt_parallax_speed' );

				$element->add_render_attribute( '_wrapper', [
					'data-speed'    => $data_speed,
					'data-bg-image' => $rt_background_URL,
				] );
			}
		}
	}

	function custom_button_control( $button, $args ) {
		$button->add_control( 'animation_btn_enable',
			[
				'label'        => __( 'Animation Button', 'clcar-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'enable',
				'options'      => [
					'enable'  => __( 'Enable', 'clcar-core' ),
					'disable' => __( 'Disable', 'clcar-core' ),
				],
				'prefix_class' => 'elementor-button-animation-',
			]
		);

		$button->add_control(
			'button_animation_color',
			[
				'label'     => __( 'Hover Animation Color', 'clcar-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-button::after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'animation_btn_enable' => 'enable',
				],
			]
		);
	}


	/**
	 * render custom control output
	 *
	 */
	public function clcar_elementor_extend_widget_render( $widget ) {
		/**
		 * Adding a new attribute to our button
		 *
		 * @param  \Elementor\Widget_Base  $button
		 */
		
		if ( 'image-carousel' === $widget->get_name() ) {
			// Get the settings
			$settings = $widget->get_settings();
			// Adding our type as a class to the button
			if ( $settings['image_gray_option'] ) {
				$widget->add_render_attribute( 'carousel-wrapper',
					[
						'class' => $settings['image_gray_option'],
					], true );
			}
		}
		
	}


}

new RT_Extende_Element_Widget();
