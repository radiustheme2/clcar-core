<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClCar_Core;

use \RT_Postmeta;
use Rtcl\Helpers\Functions;
use radiustheme\ClCar\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ClCar_Main' ) ) {
	return;
}

if ( ! class_exists( 'RT_Postmeta' ) ) {
	return;
}

$Postmeta = RT_Postmeta::getInstance();

$prefix = CLCAR_CORE_THEME_PREFIX;

/*-------------------------------------
#. Layout Settings
---------------------------------------*/
$nav_menus = wp_get_nav_menus( [ 'fields' => 'id=>name' ] );
$nav_menus = [ 'default' => __( 'Default', 'clcar-core' ) ] + $nav_menus;
$sidebars  = [ 'default' => __( 'Default', 'clcar-core' ) ] + Helper::custom_sidebar_fields();



$Postmeta->add_meta_box(
	"{$prefix}_page_settings", __( 'Layout Settings', 'clcar-core' ), [ 'page', 'post' ], '', '', 'high', [
	'fields' => [
		"{$prefix}_layout_settings" => [
			'label' => __( 'Layouts', 'clcar-core' ),
			'type'  => 'group',
			'value' => [
				'layout'         => [
					'label'   => __( 'Layout', 'clcar-core' ),
					'type'    => 'select',
					'options' => [
						'default'       => __( 'Default from customizer', 'clcar-core' ),
						'full-width'    => __( 'Full Width', 'clcar-core' ),
						'left-sidebar'  => __( 'Left Sidebar', 'clcar-core' ),
						'right-sidebar' => __( 'Right Sidebar', 'clcar-core' ),
					],
					'default' => 'default',
				],
				'sidebar'        => [
					'label'   => __( 'Custom Sidebar', 'clcar-core' ),
					'type'    => 'select',
					'options' => $sidebars,
					'default' => 'default',
				],
				'top_bar'        => [
					'label'   => __( 'Top Bar', 'clcar-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'clcar-core' ),
						'on'      => __( 'Enable', 'clcar-core' ),
						'off'     => __( 'Disable', 'clcar-core' ),
					],
					'default' => 'default',
				],
				'header_btn'        => [
					'label'   => __( 'Header Right Button', 'clcar-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'clcar-core' ),
						'on'      => __( 'Enable', 'clcar-core' ),
						'off'     => __( 'Disable', 'clcar-core' ),
					],
					'default' => 'default',
				],
				'footer_apps_banner_section'        => [
					'label'   => __( 'Footer Apps Banner Section', 'clcar-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'clcar-core' ),
						'on'      => __( 'Enable', 'clcar-core' ),
						'off'     => __( 'Disable', 'clcar-core' ),
					],
					'default' => 'default',
				],
				'header_width'   => [
					'label'   => __( 'Header Width', 'clcar-core' ),
					'type'    => 'select',
					'options' => [
						'default'   => __( 'Default from customizer', 'clcar-core' ),
						'box-width' => __( 'Box Width', 'clcar-core' ),
						'fullwidth' => __( 'Full Width', 'clcar-core' ),
					],
					'default' => 'default',
				],

				'header_style'     => [
					'label'   => __( 'Header Layout', 'clcar-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'clcar-core' ),
						'1'       => __( 'Layout 1', 'clcar-core' ),
					],
					'default' => 'default',
				],
				'tr_header'        => [
					'label'   => __( 'Transparent Header', 'clcar-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'clcar-core' ),
						'on'      => __( 'Enable', 'clcar-core' ),
						'off'     => __( 'Disable', 'clcar-core' ),
					],
					'default' => 'default',
				],
				'padding_top'      => [
					'label'   => esc_html__( 'Padding Top', 'clcar-core' ),
					'type'    => 'text',
					'default' => 'default',
				],
				'padding_bottom'   => [
					'label'   => esc_html__( 'Padding Bottom', 'clcar-core' ),
					'type'    => 'text',
					'default' => 'default',
				],
				'breadcrumb'       => [
					'label'   => __( 'Breadcrumb', 'clcar-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'clcar-core' ),
						'on'      => __( 'Enable', 'clcar-core' ),
						'off'     => __( 'Disable', 'clcar-core' ),
					],
					'default' => 'default',
				],
				'footer_style'     => [
					'label'   => __( 'Footer Layout', 'clcar-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'clcar-core' ),
						'1'       => __( 'Layout 1', 'clcar-core' ),
						'2'       => __( 'Layout 2', 'clcar-core' ),
					],
					'default' => 'default',
				],
				'footer_border'    => [
					'label'   => __( 'Footer Border Top', 'clcar-core' ),
					'type'    => 'select',
					'options' => [
						'default' => __( 'Default from customizer', 'clcar-core' ),
						'on'      => __( 'Enable', 'clcar-core' ),
						'off'     => __( 'Disable', 'clcar-core' ),
					],
					'default' => 'default',
				],
				'page_color'      => [
					'label'   => esc_html__( 'Page Color', 'clcar-core' ),
					'type'    => 'color_picker',
					'desc'  => __( 'If not selected, default will be used', 'clcar-core' ),
				],
			],
		],
	],
] );

if ( ! Functions::isEnableFb() ) {
	// Listing Car Brand & Year
	if ( class_exists( 'Rtcl' ) ) {
		$Postmeta->add_meta_box( 'clcar_listing_details', esc_html__( 'Listing Info', 'clcar-core' ), [ "rtcl_listing" ], '', '', 'default', [
			'fields' => [
				"listing_logo_img" => [
					'label' => esc_html__( 'Listing Logo', 'clcar-core' ),
					'type'  => 'image',
					'desc'  => esc_html__( 'This is listing company brand logo.', 'clcar-core' ),
				]
			],
		] );
	}
}





