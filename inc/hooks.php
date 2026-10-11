<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClCar_Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;


class Plugins_Hooks {

	protected static $instance = null;

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function __construct() {

		//Add user contact info
		add_filter( 'user_contactmethods', [ $this, 'rt_user_extra_contact_info' ] );
		add_filter( 'the_password_form', [ $this, 'rt_post_password_form' ] );

		//Menu query string pass for in menu added extra field
		add_action('wp_nav_menu_item_custom_fields', function($item_id, $item) {
			$menu_query_string_key = get_post_meta($item_id, 'rt_menu_query_string_key', true);
			$menu_query_string = get_post_meta($item_id, 'rt_menu_query_string', true);
			?>
			<div class="menu-query-string description-wide">
				<p class="description description-thin">
					<label for="rt-menu-query-string-key-<?php echo esc_attr( $item_id ); ?>" >
					<?php esc_html_e('Query String Key', 'clcar-core'); ?><br>
						<input type="text" 
							id="rt-menu-query-string-key-<?php echo esc_attr( $item_id ); ?>" 
							name="rt-menu-query-string-key[<?php echo esc_attr( $item_id ); ?>]" 
							value="<?php echo esc_html($menu_query_string_key); ?>"
						/>
					</label>
				</p>
				<p class="description description-thin">
					<label for="rt-menu-query-string-<?php echo esc_attr( $item_id ); ?>" >
					<?php esc_html_e('Query String Value', 'clcar-core'); ?><br>
						<input type="text" 
							id="rt-menu-query-string-<?php echo esc_attr( $item_id ); ?>" 
							name="rt-menu-query-string[<?php echo esc_attr( $item_id ); ?>]" 
							value="<?php echo esc_html($menu_query_string); ?>"
						/>
					</label>
				</p>
			</div>
			<?php
			
		}, 10, 2);
		add_action('wp_update_nav_menu_item', function($menu_id, $menu_item_db_id) {
			$query_string_key = isset($_POST['rt-menu-query-string-key'][$menu_item_db_id]) ? $_POST['rt-menu-query-string-key'][$menu_item_db_id] : '';
			$query_string_value = isset($_POST['rt-menu-query-string'][$menu_item_db_id]) ? $_POST['rt-menu-query-string'][$menu_item_db_id] : '';
			update_post_meta($menu_item_db_id, 'rt_menu_query_string_key', $query_string_key);
			update_post_meta($menu_item_db_id, 'rt_menu_query_string', $query_string_value);
		}, 10, 2);
		add_filter( 'wp_get_nav_menu_items', function( $items, $args, $menu = '' ) {
			foreach( $items as $item ) {
				$menu_query_string_key = get_post_meta($item->ID, 'rt_menu_query_string_key', true);
				$menu_query_string = get_post_meta($item->ID, 'rt_menu_query_string', true);
				if ( $menu_query_string )  {
					$item->url = add_query_arg( $menu_query_string_key, $menu_query_string, $item->url );
				}
			}
			return $items;
		}, 11, 3 );

		//Remove listing list view style
		add_filter('rtcl_el_listings_list_style',function($settings){
			$list_style=count($settings);
			for ($i=1; $i <=$list_style; $i++) { 
				if($i<=1){
					continue;
				}
				$value='style-'.$i;
				unset($settings["{$value}"]);
			}
			return $settings;
		});

		//Remove listing grid view style
		add_filter('rtcl_el_listings_grid_style',function($settings){
			$list_style=count($settings);
			for ($i=1; $i <=$list_style; $i++) { 
				if($i<=2){
					continue;
				}
				$value='style-'.$i;
				unset($settings["{$value}"]);
			}
			return $settings;
		});

		//Modify listing widget general field
		add_filter('rtcl_el_listing_widget_general_field',function( $fields , $obj ){
			if( 'rtcl-listing-items' == $obj->rtcl_base ){
				$modify_fields    = array(
					array(
						'id'        => 'rtcl_listings_view',
						'unset'     => array(
							'default',
						),
						'default' => 'grid',
					),
				);
				$fields = $obj->modify_controls( $modify_fields, $fields );
			}
			return $fields;
		}, 10, 2 );
        
		//Unset listing item style default settings
		add_filter('el_widget_listing_wrapper_settings_fields',function( $fields , $obj ){
			if( 'rtcl-listing-items' == $obj->rtcl_base ){
				$after_remove = $obj->remove_controls(
					array(
						'rtcl_listing_wrapper_box_shadow',
						'rtcl_listing_wrapper_hover_box_shadow',
					),
					$fields
				);
				$the_array    = array(
					array(
						'id'        => 'rtcl_listing_border',
						'unset'     => array(
							'fields_options',
						),
					),
					array(
						'id'        => 'rtcl_wrapper_gutter_spacing',
						'unset'     => array(
							'default',
						),
						'default'    => [
							'unit' => 'px',
							'size' => '24',
						],
						'condition'=>[
							'rtcl_listings_view' =>'grid'
						]
					),
					array(
						'id'        => 'rtcl_wrapper_spacing',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .clcar-elementor-widget .listing-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .rtcl .rtcl-list-view .listing-item .item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					),
					array(
						'id'        => 'rtcl_wrapper_bg_color',
						'unset'     => array(
							'selectors',
						),
						'selectors' => [
							'{{WRAPPER}} .rtcl.clcar-elementor-widget .listing-item .item-content' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} .rtcl.clcar-elementor-widget .rtcl-list-view .listing-item' => 'background-color: {{VALUE}};',
						],
					),
				);
				$fields = $obj->modify_controls( $the_array, $after_remove );
			}
			return $fields;
		}, 10, 2 );
		
		//Unset and modify listing items style settings
		add_filter('rtcl_el_listing_widget_style_field',function( $fields , $obj ){
			
			if( 'rtcl-listing-items' == $obj->rtcl_base ){
				$after_remove = $obj->remove_controls(
					array(
						'rtcl_meta_description_hover_color',
						'rtcl_amount_wrapper_padding',
						'rtcl_badge_wrapper_padding',
						'rtcl_badge_bg_color',
						'rtcl_badge_text_color',
						'rtcl_top_badge_bg_color',
						'rtcl_top_badge_text_color',
						'rtcl_new_badge_bg_color',
						'rtcl_new_badge_text_color',
						'rtcl_bump_up_badge_bg_color',
						'rtcl_bump_up_badge_text_color',
						'rtcl_pagination_border',
					),
					$fields
				);
				$modify_array    = array(
					array(
						'id'        => 'rtcl_meta_typo',
						'unset'     => array(
							'selector',
						),
						'selector' => '{{WRAPPER}} .rtcl.clcar-elementor-widget .rtcl-listings .listing-item .entry-meta li,{{WRAPPER}} .rtcl.clcar-elementor-widget .listing-category a'
					),
					array(
						'id'        => 'rtcl_meta_spacing',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .entry-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					),
					array(
						'id'        => 'rtcl_meta_color',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .entry-meta li' => 'color: {{VALUE}}',
							'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .entry-meta li a' => 'color: {{VALUE}}',
						],
					),
					array(
						'id'        => 'rtcl_meta_icon_color',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .entry-meta li i' => 'color: {{VALUE}}',
						],
					),
					array(
						'id'        => 'rtcl_meta_category_color',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl.clcar-elementor-widget .listing-category a' => 'color: {{VALUE}}',
						],
					),
					array(
						'id'        => 'rtcl_meta_hover_color',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .entry-meta li:hover' => 'color: {{VALUE}}',
							'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .entry-meta li a:hover' => 'color: {{VALUE}}',
						],
					),
					array(
						'id'        => 'rtcl_meta_hover_icon_color',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .entry-meta li:hover i' => 'color: {{VALUE}}',
						],
					),
					array(
						'id'        => 'rtcl_meta_category_color_hover',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl.clcar-elementor-widget .listing-category a:hover' => 'color: {{VALUE}}',
						],
					),
					array(
						'id'        => 'rtcl_meta_custom_field_typo',
						'unset'     => array(
							'selector',
						),
						'selector' => '{{WRAPPER}} .rtcl .rtcl-listings .listing-item .listable-items .listing-features li',
					),
					array(
						'id'        => 'rtcl_custom_field_spacing',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .listable-items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					),
					array(
						'id'        => 'rtcl_custom_field_color',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl .rtcl-listings .listing-item .listable-items .listing-features li' =>'color: {{VALUE}}',
						],
					),
					array(
						'id'        => 'rtcl_description_spacing',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .clcar-elementor-widget .rtcl-listings-wrapper .item-content .listing-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					),
					array(
						'id'        => 'rtcl_description_typo',
						'unset'     => array(
							'selector',
						),
						'selector' => '{{WRAPPER}} .clcar-elementor-widget .rtcl-listings-wrapper .item-content .listing-excerpt p',
					),
					array(
						'id'        => 'rtcl_meta_description_color',
						'unset'     => array(
							'selectors',
						),
						'selectors' => [ '{{WRAPPER}} .clcar-elementor-widget .rtcl-listings-wrapper .item-content .listing-excerpt p' => 'color: {{VALUE}}' ],
					),
					array(
						'id'        => 'rtcl_price_typo',
						'unset'     => array(
							'selector',
						),
						'selector' => '{{WRAPPER}} .rtcl-listings-sc-wrapper .item-price .rtcl-price',
					),
					array(
						'id'        => 'rtcl_price_unit_label_typo',
						'unset'     => array(
							'selector',
						),
						'selector' => '{{WRAPPER}} .rtcl span.rtcl-price-meta',
					),
					array(
						'id'        => 'rtcl_price_unit_label_color',
						'unset'     => array(
							'selectors',
						),
						'selectors' => [
							'{{WRAPPER}} .rtcl span.rtcl-price-meta'=> 'color: {{VALUE}};',
						],
					),
					array(
						'id'        => 'rtcl_amount_wrapper_spacing',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl-listings-sc-wrapper .item-price .rtcl-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					),
					array(
						'id'        => 'rtcl_amount_text_color',
						'unset'     => array(
							'selectors',
						),
						'selectors' => [
							'{{WRAPPER}} .rtcl-listings-sc-wrapper .item-price .rtcl-price'=> 'color: {{VALUE}};',
						],
					),
					array(
						'id'        => 'rtcl_badge_sold_out_bg_color',
						'unset'     => array(
							'selectors',
						),
						'selectors' => [
							'{{WRAPPER}} .rtcl-sold-out'=> 'background-color: {{VALUE}};',
							'{{WRAPPER}} .rtcl-sold-out:before'=> 'border-top: 14px solid{{VALUE}};',
							'{{WRAPPER}} .rtcl-sold-out:after'=> 'border-bottom:14px solid {{VALUE}};',
						],
					),
					array(
						'id'        => 'rtcl_pagination_spacing',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl nav.rtcl-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					),
					array(
						'id'        => 'rtcl_pagination_spacing',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => [
							'{{WRAPPER}} .rtcl nav.rtcl-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					),
					array(
						'id'        => 'rtcl_pagination_bg_color',
						'unset'     => array(
							'selectors',
						),
						'selectors' => [
							'{{WRAPPER}} .rtcl.clcar-elementor-widget nav.rtcl-pagination ul.page-numbers' => 'background-color: {{VALUE}};',
						],
					),
					array(
						'id'        => 'rtcl_pagination_active_bg_color',
						'unset'     => array(
							'selectors',
						),
						'selectors' => [
							'{{WRAPPER}} .rtcl nav.rtcl-pagination ul.page-numbers li .page-numbers.current, {{WRAPPER}} .rtcl nav.rtcl-pagination ul.page-numbers li .page-numbers:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
						],
					),
					array(
						'id'        => 'rtcl_pagination_text_color',
						'unset'     => array(
							'selectors',
						),
						'selectors' => [
							'{{WRAPPER}} .rtcl nav.rtcl-pagination ul.page-numbers li .page-numbers' => 'color: {{VALUE}};',
						],
					),
					array(
						'id'        => 'rtcl_pagination_active_text_color',
						'unset'     => array(
							'selectors',
						),
						'selectors' => [
							'{{WRAPPER}} .rtcl nav.rtcl-pagination ul.page-numbers li .page-numbers.current, {{WRAPPER}} .rtcl nav.rtcl-pagination ul.page-numbers li .page-numbers:hover' => 'color: {{VALUE}}',
						],
					),
					
				);
				
				$fields = $obj->modify_controls( $modify_array, $after_remove );
			}
			return $fields;
		}, 10, 2 );

		//Change content visibility fields
		add_filter('el_listing_widget_content_visibility_fields',function( $fields , $obj ){
			if( 'rtcl-listing-items' == $obj->rtcl_base ){
				$fields = $obj->remove_controls(
					array(
						'rtcl_action_button_layout',
						'rtcl_show_quick_view'
					),
					$fields
				);
			}
			return $fields;
		}, 10, 2 );

		//Remove button style settings and section
		add_filter('rtcl_el_listing_items_widget_button_style_field', function( $fields , $obj ){
			if( 'rtcl-listing-items' == $obj->rtcl_base ){
				return [];
			}
			return $fields;
		}, 10, 2 );

		//Listing category general settings modify
		add_filter('rtcl_el_slider_category_widget_general_field',function( $fields , $obj ){
			
			if( 'rtcl-listing-category-slider' == $obj->rtcl_base ){
				$after_remove = $obj->remove_controls(
					array(
						'display_child_category',
						'rtcl_cat_box_style_2_alignment',
					),
					$fields
				);
				$modify_array    = array(
					array(
						'id'        => 'rtcl_icon_type',
						'unset'     => array(
							'default',
						),
						'default'   => 'image',
					),
					array(
						'id'        => 'slider_space_between',
						'unset'     => array(
							'default',
						),
						'default'   => 24,
					),
					
				);
				$fields = $obj->modify_controls( $modify_array, $after_remove );
			}
			return $fields;
		}, 10, 2 );

		//Listing category style settings modify
		add_filter('rtcl_el_slider_category_widget_style_field',function( $fields , $obj ){
			
			if( 'rtcl-listing-category-slider' == $obj->rtcl_base ){
				$after_remove = $obj->remove_controls(
					array(
						'rtcl_head_gutter_padding',
						'rtcl_gutter_padding',
						'rtcl_description_gutter_padding',
						'rtcl_background_header',
						'rtcl_background_body',
						'rtcl_background_header_hover',
						'rtcl_background_body_hover',
						'rtcl_background_header_hover',
						'rtcl_background_header_hover',
						'rtcl_icon_border',
						'rtcl_icon_bg',
						'rtcl_icon_box_shadow',
						'rtcl_icon_hover_border',
						'rtcl_icon_bg_hover',
						'rtcl_icon_box_shadow_hover',
					),
					$fields
				);
				$modify_array    = array(
					array(
						'id'        => 'rtcl_border',
						'unset'     => array(
							'selector',
						),
						'selector' => '{{WRAPPER}} .cat-item-wrap .cat-details'
					),

					array(
						'id'        => 'rtcl_wrapper_padding',
						'mode'		=>'responsive'
					),

					array(
						'id'        => 'rtcl_icon_font_size',
						'unset'     => array(
							'selectors',
						),
						'selectors' => array(
							'{{WRAPPER}} .cat-item-wrap .cat-details .icon a .rtcl-icon' => 'font-size: {{SIZE}}{{UNIT}};',
						),
						'condition' =>[
							'rtcl_icon_type'=>'icon'
						]
					),
					array(
						'id'        => 'rtcl_icon_image_area_size',
						'condition' =>[
							'rtcl_icon_type'=>'icon'
						]
					),
					array(
						'id'        => 'rtcl_icon_image_border_radius',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => array(
							'{{WRAPPER}} .cat-item-wrap .cat-details > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					),
					array(
						'id'        => 'rtcl_image_spacing',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => array(
							'{{WRAPPER}}  .cat-item-wrap .cat-details .cat-figure'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					),
					array(
						'id'        => 'rtcl_counter_color',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => array(
							'{{WRAPPER}}  .rtcl-categories-elementor.rt-el-listing-cat-box-1 .cat-content .views .ads-count'  => 'color: {{VALUE}}',
						),
					),
					array(
						'id'        => 'rtcl_counter_color',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => array(
							'{{WRAPPER}}  .rtcl-categories-elementor.rt-el-listing-cat-box-1 .cat-content .views .ads-count:hover'  => 'color: {{VALUE}}',
						),
					),
					array(
						'id'        => 'rtcl_counter_typo',
						'unset'     => array(
							'selector',
						),
						'selector' => '{{WRAPPER}} .rtcl-categories-elementor.rt-el-listing-cat-box-1 .cat-content .views .ads-count',
					),
					array(
						'id'        => 'rtcl_counter_spacing',
						'unset'     => array(
							'selectors',
						),
						'selectors'  => array(
							'{{WRAPPER}}  .rtcl-categories-elementor.rt-el-listing-cat-box-1 .cat-content .views .ads-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					),
				);

				$fields = $obj->modify_controls( $modify_array, $after_remove );
			}
			return $fields;
		}, 10, 2 );


		add_filter( 'rtcl_el_slider_category_widget_general_field', [ $this, 'category_slider_settings_new_fields' ], 10, 2 );
		add_filter( 'rtcl_el_slider_category_widget_style_field', [ $this, 'category_slider_box_style_new_fields' ], 10, 2 );
		add_filter( 'el_listing_widget_content_visibility_fields', [ __CLASS__, 'listing_widget_content_visibility_fields_label' ], 15, 2 );

		add_filter( 'el_listing_widget_content_visibility_fields', [ __CLASS__, 'listing_slider_widget_content_visibility_fields_label' ], 15, 2 );
	}

	/* User Contact Info */
	function rt_user_extra_contact_info( $contactmethods ) {

		$contactmethods['rt_phone']     = __( 'Phone Number', 'clcar-core' );
		$contactmethods['rt_facebook']  = __( 'Facebook', 'clcar-core' );
		$contactmethods['rt_twitter']   = __( 'Twitter', 'clcar-core' );
		$contactmethods['rt_linkedin']  = __( 'LinkedIn', 'clcar-core' );
		$contactmethods['rt_vimeo']     = __( 'Vimeo', 'clcar-core' );
		$contactmethods['rt_youtube']   = __( 'Youtube', 'clcar-core' );
		$contactmethods['rt_instagram'] = __( 'Instagram', 'clcar-core' );
		$contactmethods['rt_pinterest'] = __( 'Pinterest', 'clcar-core' );
		$contactmethods['rt_reddit']    = __( 'Reddit', 'clcar-core' );
		return $contactmethods;
	}

	/*
	 * change post password from
	 */
	public function rt_post_password_form() {
		global $post;
		$label  = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		$output = '<form action="' . esc_url( home_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
		<p>' . __( 'This content is password protected. To view it please enter your password below:' ) . '</p>
		<p><label for="' . $label . '"><span class="pass-label">' . __( 'Password:' ) . ' </span><input name="post_password" id="' . $label
		          . '" type="password" size="20" /> <input type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form' ) . '" /></label></p></form>
		';

		return $output;
	}

	public function category_slider_settings_new_fields( $fields, $obj ){
		if( 'rtcl-listing-category-slider' == $obj->rtcl_base ){
			$cat_label = array(
				array(
					'id'      => 'arrow_position',
					'label'       => esc_html__( 'Arrow Position', 'clcar-core' ),
					'type'        => Controls_Manager::SELECT2,
					'options'   => [
						'middle-left-right' => __( 'Middle Left Right', 'clcar-core' ),
						'bottom-left-right' => __( 'Bottom Left Right', 'clcar-core' ),
						'top-left-right' => __( 'Top Left Right', 'clcar-core' ),
						'bottom-center' => __( 'Bottom Center', 'clcar-core' ),
						'bottom-left' => __( 'Button Left', 'clcar-core' ),
						'bottom-right' => __( 'Button Right', 'clcar-core' ),
						'top-center' => __( 'Top Center', 'clcar-core' ),
						'top-left' => __( 'Top Left', 'clcar-core' ),
						'top-right' => __( 'Top Right', 'clcar-core' ),
					],
					'default'     => 'bottom-center',
					'condition'   => [ 'slider_nav' => 'yes' ],
					'description' => esc_html__( 'Arrow icons position', 'clcar-core' ),
				),
				array(
					'id'          => 'arrow_wrapper_margin',
					'mode'        => 'responsive',
					'label'       => esc_html__( 'Arrow Margin', 'clcar-core' ),
					'type'        => Controls_Manager::DIMENSIONS,
					'size_units'  => [ 'px' ],
					'selectors'   => [
						'{{WRAPPER}} .swiper-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
					'condition'   => [ 'slider_nav' => 'yes' ],
					'description' => esc_html__( 'Arrow icons wrapper margin', 'clcar-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'slider_nav', $cat_label, $fields );
		}
		return $fields;
	}

	public function category_slider_box_style_new_fields( $fields, $obj ){
		if( 'rtcl-listing-category-slider' == $obj->rtcl_base ){
			$box_border_radius = array(
				array(
					'id'          => 'box_border_radius',
					'mode'        => 'responsive',
					'label'       => esc_html__( 'Box Border Radius', 'clcar-core' ),
					'type'        => Controls_Manager::DIMENSIONS,
					'size_units'  => [ 'px' ],
					'selectors'   => [
						'{{WRAPPER}} .cat-item-wrap .cat-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
					'description' => esc_html__( 'Category Box Border Radius', 'clcar-core' ),
				),
				array(
					'mode'      => 'group',
					'label'     => __( 'Background', 'clcar-core' ),
					'id'        => 'cat_box_background',
					'type'      => Group_Control_Background::get_type(),
					'selector'  => '{{WRAPPER}} .cat-item-wrap .cat-details',
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_wrapper_padding', $box_border_radius, $fields );
		}
		return $fields;
	}

	public static function listing_widget_content_visibility_fields_label( $fields, $obj ){
		if( 'rtcl-listing-items' == $obj->rtcl_base ){
			$custom_fields_label = array(
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_custom_fields_label',
					'label'       => __( 'Show Custom fields label', 'clcar-core' ),
					'label_on'    => __( 'On', 'clcar-core' ),
					'label_off'   => __( 'Off', 'clcar-core' ),
					'default'     => '',
					'description' => __( 'Only work for archive meta. Default: Off', 'clcar-core' ),
				),
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_brand_logo',
					'label'       => __( 'Show brand logo', 'clcar-core' ),
					'label_on'    => __( 'On', 'clcar-core' ),
					'label_off'   => __( 'Off', 'clcar-core' ),
					'default'     => '',
					'description' => __( 'Show company brand logo. Default: Off', 'clcar-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_show_quick_view', $custom_fields_label, $fields );
		}
		return $fields;
	}

	public static function listing_slider_widget_content_visibility_fields_label( $fields, $obj ){
		if( 'rtcl-listing-slider' == $obj->rtcl_base ){
			$custom_fields_label = array(
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_custom_fields_label',
					'label'       => __( 'Show Custom fields label', 'clcar-core' ),
					'label_on'    => __( 'On', 'clcar-core' ),
					'label_off'   => __( 'Off', 'clcar-core' ),
					'default'     => '',
					'description' => __( 'Only work for archive meta. Default: Off', 'clcar-core' ),
				),
				array(
					'type'        => Controls_Manager::SWITCHER,
					'id'          => 'rtcl_show_brand_logo',
					'label'       => __( 'Show brand logo', 'clcar-core' ),
					'label_on'    => __( 'On', 'clcar-core' ),
					'label_off'   => __( 'Off', 'clcar-core' ),
					'default'     => '',
					'description' => __( 'Show company brand logo. Default: Off', 'clcar-core' ),
				),
			);
			$fields = $obj->insert_new_controls( 'rtcl_show_quick_view', $custom_fields_label, $fields );
		}
		return $fields;
	}

}

Plugins_Hooks::instance();