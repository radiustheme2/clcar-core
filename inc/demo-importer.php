<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


namespace radiustheme\ClCar_Core;


use \FW_Ext_Backups_Demo;

if ( ! defined( 'ABSPATH' ) ) exit;

class Demo_Importer {

	public function __construct() {
		add_filter( 'plugin_action_links_rt-demo-importer/rt-demo-importer.php', array( $this, 'add_action_links' ) ); // Link from plugins page 
		add_filter( 'rt_demo_installer_warning', array( $this, 'data_loss_warning' ) );
		add_filter( 'fw:ext:backups-demo:demos', array( $this, 'demo_config' ) );
		add_action( 'fw:ext:backups:tasks:success:id:demo-content-install', array( $this, 'after_demo_install' ) );
	}

	public function add_action_links( $links ) {
		$mylinks = array(
			'<a href="' . esc_url( admin_url( 'tools.php?page=fw-backups-demo-content' ) ) . '">'.__( 'Install Demo Contents', 'clcar-core' ).'</a>',
		);
		return array_merge( $links, $mylinks );
	}

	public function data_loss_warning( $links ) {
		$html  = '<div style="margin-top:20px;color:#f00;font-size:17px;line-height:1.3;font-weight:600;margin-bottom:40px;border-color: #f00;border-style: dashed;border-width: 1px 0;padding:10px 0;">';
		$html .= __( 'Warning: All your old data will be lost if you install One Click demo data from here, so it is suitable only for a new website.', 'clcar-core');
		$html .= '</div>';
		return $html;
	}

	public function demo_config( $demos ) {
		$demos_array = array(
			'demo1' => array(
				'title' => __( 'Home 1', 'clcar-core' ),
				'screenshot' => plugins_url( 'screenshots/1.png', dirname(__FILE__) ),
				'preview_link' => 'https://www.radiustheme.com/demo/wordpress/themes/clcar/',
			),
			'demo2' => array(
				'title' => __( 'Home 2', 'clcar-core' ),
				'screenshot' => plugins_url( 'screenshots/2.png', dirname(__FILE__) ),
				'preview_link' => 'https://www.radiustheme.com/demo/wordpress/themes/clcar/home-2/',
			),
		);

		$download_url = 'http://demo.radiustheme.com/wordpress/demo-content/clcar/';

		foreach ($demos_array as $id => $data) {
			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $download_url,
				'file_id' => $id,
			));
			$demo->set_title($data['title']);
			$demo->set_screenshot($data['screenshot']);
			$demo->set_preview_link($data['preview_link']);

			$demos[ $demo->get_id() ] = $demo;

			unset($demo);
		}

		return $demos;
	}

	public function after_demo_install( $collection ){
		// Update front page id
		$demos = array(
			'demo1'  => 1235,
			'demo2'  => 1102,
		);

		$data = $collection->to_array();

		foreach( $data['tasks'] as $task ) {
			if( $task['id'] == 'demo:demo-download' ){
				$demo_id = $task['args']['demo_id'];
				$page_id = $demos[$demo_id];
				update_option( 'page_on_front', $page_id );
				flush_rewrite_rules();
				break;
			}
		}

		// Update post author id
		global $wpdb;
		$id = get_current_user_id();
		$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->posts} SET post_author = %d", $id ) );

		// Import Users
		new \ClCar_Core_Demo_User_Import();
	}
}

new Demo_Importer;