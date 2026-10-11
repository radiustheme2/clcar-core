<?php
/*
Plugin Name: ClCar Core
Plugin URI: https://www.radiustheme.com
Description: ClCar Theme Core Plugin
Version: 2.2.1
Author: RadiusTheme
Author URI: https://www.radiustheme.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'CLCAR_CORE' ) ) {
	$plugin_data = get_file_data( __FILE__, [ 'version' => 'Version' ] );
	define( 'CLCAR_CORE', $plugin_data['version'] );
	define( 'CLCAR_CORE_THEME_PREFIX', 'clcar' );
	define( 'CLCAR_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'CLCAR_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
	define( 'CLCAR_CORE_DEMO_CONTENT', plugin_dir_path( __FILE__ ) . 'demo-content/' );
}

require_once CLCAR_CORE_BASE_DIR . 'demo-users/user-importer.php';

class ClCar_Core {

	public $plugin = 'clcar-core';
	public $action = 'clcar_theme_init';
	protected static $instance;

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'demo_importer' ], 17 );
		add_action( $this->action, [ $this, 'after_theme_loaded' ] );
		add_action( 'init', [ $this, 'after_theme_loaded' ] );
		add_action( 'init', [ $this, 'custom_post_meta' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_script' ] );
		if ( isset( $_GET['export_user'] ) && $_GET['export_user'] == 1 ) {
			ClCar_Core_Demo_User_Import::export_users();
		}
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function after_theme_loaded() {
		require_once CLCAR_CORE_BASE_DIR . 'lib/sidebar-generator/init.php'; // Sidebar generator
		require_once CLCAR_CORE_BASE_DIR . 'lib/wp-svg/init.php'; // SVG support
		require_once CLCAR_CORE_BASE_DIR . 'inc/shortcode.php'; // Shortcode
		require_once CLCAR_CORE_BASE_DIR . 'inc/hooks.php'; // Hooks
		require_once CLCAR_CORE_BASE_DIR . 'widgets/rt-contact.php'; // Contact Widget
		require_once CLCAR_CORE_BASE_DIR . 'widgets/featured-post.php'; // Featured Post Widget
		if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			require_once CLCAR_CORE_BASE_DIR . 'widgets/init.php'; // Widgets
		}
		if ( did_action( 'elementor/loaded' ) ) {
			require_once CLCAR_CORE_BASE_DIR . 'elementor/init.php'; // Elementor
		}
	}

	public function custom_post_meta() {
		if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			require_once CLCAR_CORE_BASE_DIR . 'inc/post-meta.php'; // Post Meta
			require_once CLCAR_CORE_BASE_DIR . 'widgets/init.php'; // Widgets
			require_once CLCAR_CORE_BASE_DIR . 'widgets/rtcl-ajax-filter-class.php'; // Widgets
		}
	}

	public function demo_importer() {
		require_once CLCAR_CORE_BASE_DIR . 'demo-importer/init.php';
	}

	public function register_script() {
		wp_register_script( 'tweenmax', CLCAR_CORE_BASE_URL . 'assets/js/tween-max.js', '', '1.20.2', true );
	}

	public function enqueue_script() {
		wp_enqueue_script( 'tweenmax' );
	}

	public static function social_share( $sharer = [] ) {
		include CLCAR_CORE_BASE_DIR . 'inc/social-share.php';
	}
}

ClCar_Core::instance();