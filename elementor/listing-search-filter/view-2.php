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

use radiustheme\ClCar\Listing_Functions;
use Rtcl\Helpers\Functions;
use RtclPro\Helpers\Fns;
use radiustheme\ClCar\Helper;
use radiustheme\ClCar\RDTheme;

$currency = Functions::get_currency_symbol();
$loc_text = esc_attr__( 'Select Location', 'clcar-core' );

$cat_text = esc_attr__( 'Select Category', 'clcar-core' );
?>

<!-- Hero layout1 -->
<div class="rt-hero-section <?php echo esc_attr($data['layout']); ?> motion-effects-wrap">
    
    <div class="hero-banner-content">
        <div class="container">
            <div class="banner-search-wrapper">
                <div class="hero-section-title">
                    <p class="hero-content"><?php echo wp_kses_post( $data['section_content'] ); ?></p>
                    <h2 class="hero-content__heading"><?php echo wp_kses_post( $data['section_title'] ); ?></h2>
                </div>
                <form action="<?php echo esc_url( Functions::get_filter_form_url() ); ?>" class="rtcl-widget-search-form">
                    <?php $permalink_structure = get_option( 'permalink_structure' ); ?>
                    <?php if ( ! $permalink_structure ) : ?>
                        <input type="hidden" name="post_type" value="rtcl_listing">
                    <?php endif; ?>
                    <div class="listing-search-filter-area">
                        <div class="search-area">
                            <?php if($data['show_keyword_search']): ?>
                                <div class="search-item search-keyword search-select">
                                    <div class="input-group">
                                        <input type="text" data-type="listing" name="s" class="rtcl-autocomplete form-control"
                                            placeholder="<?php esc_attr_e( 'What are you looking for!', 'clcar' ); ?>"
                                            value="<?php if ( isset( $_GET['s'] ) ) {
                                                echo esc_attr( $_GET['s'] );
                                            } ?>"/>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php 
                                $filter_group_id=$data['cfg_id'];
                                if($filter_group_id){
                                    $args      = [
                                        'is_searchable' => true,
                                        'group_ids'         => [$filter_group_id],
                                    ];
                                    $fields_id = Functions::get_cf_ids( $args );
                                    $html = '';
                                    foreach ( $fields_id as $field ) {
                                        $html .= Listing_Functions::get_advanced_search_ajax_filter_field_html( $field );
                                    }
                                    echo wp_kses_post( $html );
                                }
                                
                            ?>
                            <?php if ( $data['show_category'] ): ?>
                                <div class="search-item search-select rtin-category">
                                    <?php
                                    wp_dropdown_categories(
                                        [
                                            'show_option_none'  => $cat_text,
                                            'option_none_value' => '',
                                            'taxonomy'          => rtcl()->category,
                                            'name'              => 'rtcl_category',
                                            'id'                => 'rtcl-category-search-' . wp_rand(),
                                            'class'             => 'select2 rtcl-category-search',
                                            'selected'          => get_query_var( 'rtcl_category' ),
                                            'hierarchical'      => true,
                                            'value_field'       => 'slug',
                                            'depth'             => Functions::get_category_depth_limit(),
                                            'show_count'        => false,
                                            'hide_empty'        => false,
                                        ]
                                    );
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( method_exists( 'Rtcl\Helpers\Functions', 'location_type' ) && 'local' === Functions::location_type() && $data['show_location']=='yes'): ?>
                                <div class="search-item search-select rtin-location">
                                    <?php
                                    wp_dropdown_categories( [
                                        'show_option_none'  => $loc_text,
                                        'option_none_value' => '',
                                        'taxonomy'          => rtcl()->location,
                                        'name'              => 'rtcl_location',
                                        'id'                => 'rtcl-location-search-' . wp_rand(),
                                        'class'             => 'select2 rtcl-location-search',
                                        'selected'          => get_query_var( 'rtcl_location' ),
                                        'hierarchical'      => true,
                                        'value_field'       => 'slug',
                                        'depth'             => Functions::get_location_depth_limit(),
                                        'show_count'        => false,
                                        'hide_empty'        => true,
                                    ] );
                                    ?>
                                </div>
                            <?php endif; ?>
                                <?php if($data['google_location']=='yes'){ ?>
                                    <div class="search-item  rtcl-radius-group">
                                        <div class="input-group rtcl-geo-address-field">
                                            <input id="rtcl-geo-address-search" type="text" name="geo_address" autocomplete="off"
                                                value="<?php echo ! empty( $_GET['geo_address'] ) ? esc_attr( $_GET['geo_address'] ) : '' ?>"
                                                placeholder="<?php esc_attr_e( "Enter location", "clcar" ) ?>"
                                                class="form-control rtcl-geo-address-input"/>
                                            <i class="rtcl-get-location rtcl-icon rtcl-icon-target"></i>
                                            <input type="hidden" class="latitude" name="center_lat"
                                                value="<?php echo ! empty( $_GET['center_lat'] ) ? esc_attr( $_GET['center_lat'] ) : '' ?>">
                                            <input type="hidden" class="longitude" name="center_lng"
                                                value="<?php echo ! empty( $_GET['center_lng'] ) ? esc_attr( $_GET['center_lng'] ) : '' ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                                    <?php 
                                    if($data['radius_search']=='yes'){
                                    ?>
                                        <div class="search-item search-radius">
                                            <?php $default_radius = apply_filters('clcar_widget_default_radius', ''); ?>
                                            <div class="input-group">
                                                <div class="rtcl-search-input-button">
                                                    <input type="number" class="form-control" name="distance"
                                                        value="<?php echo ! empty( $_GET['distance'] ) ? absint( $_GET['distance'] ) : esc_attr( $default_radius ) ?>"
                                                        placeholder="<?php esc_attr_e( "Radius", "clcar" ); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php  } ?>
                        </div>
                        <div class="search-item search-btn">  
                            <button type="submit" class="submit-btn btn-fill">
                                <?php esc_html_e( 'Search', 'clcar' ); ?>
                                <i class="icon-search3"></i>
                            </button>
                            <?php if($data['show_advanced_search']){ ?>
                            <button class="advanced-btn collapsed" type="button"><?php esc_html_e('Advance Search','clcar'); ?></button>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if($data['show_advanced_search']){ ?>
                    <div class="listing-custom-search-wrapper <?php echo esc_attr($data['advance_search_column']); ?>" id="rt-search-custom-field">
                        <div class="listing-custom-search-box">
                            <?php
                                $inclide_group_id = $data['cfg_include_id'];
                                if ( !empty( $inclide_group_id ) ) {
                                    $args = [
                                        'is_searchable' => true,
                                        'group_ids' => $inclide_group_id
                                    ];
                                    $fields_id = Functions::get_cf_ids( $args );

                                    $html = '';
                                    foreach ( $fields_id as $field ) {
                                        $html .= Listing_Functions::get_advanced_search_field_html( $field );
                                    }
                                    echo wp_kses_post( $html );
                                }
                            ?>
                            <div class="search-item">
                                <div class="price-range">
                                    <label><?php esc_html_e( 'Price', 'clcar' ); ?></label>
                                    <?php
                                    $data_form = '';
                                    $data_to   = '';
                                    $min_price = RDTheme::$options['listing_widget_min_price'];
							        $max_price = RDTheme::$options['listing_widget_max_price'];
                                    if ( isset( $_GET['filters']['price']['min'] ) ) {
                                        $data_form .= sprintf( "data-from=%s", absint( $_GET['filters']['price']['min'] ) );
                                    }
                                    if ( isset( $_GET['filters']['price']['max'] ) && ! empty( $_GET['filters']['price']['max'] ) ) {
                                        $data_to .= sprintf( "data-to=%s", absint( $_GET['filters']['price']['max'] ) );
                                    }
                                    ?>
                                    <input type="number"
                                            class="ion-rangeslider" <?php echo esc_attr( $data_form ); ?> <?php echo esc_attr( $data_form ); ?> <?php echo esc_attr( $data_to ); ?>
                                            data-min="<?php echo isset( $min_price ) && ! empty( $min_price ) ? esc_attr( $min_price ) : 0; ?>"
                                            data-max="<?php echo isset( $max_price ) && ! empty( $max_price ) ? esc_attr( $max_price ) : 5000; ?>"
                                            data-prefix="<?php echo esc_html( $currency ) ?>"/>
                                    <input type="hidden" class="min-volumn" name="filters[price][min]"
                                            value="<?php if ( isset( $_GET['filters']['price']['min'] ) ) {
                                                echo absint( $_GET['filters']['price']['min'] );
                                            } ?>">
                                    <input type="hidden" class="max-volumn" name="filters[price][max]"
                                            value="<?php if ( isset( $_GET['filters']['price']['max'] ) ) {
                                                echo absint( $_GET['filters']['price']['max'] );
                                            } ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
