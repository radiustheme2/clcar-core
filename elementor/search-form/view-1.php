<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 *
 * @var $data
 */

namespace radiustheme\ClCar_Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use RtclPro\Helpers\Fns;
use Rtcl\Helpers\Functions;
use radiustheme\ClCar\Helper;
use radiustheme\ClCar\RDTheme;
use radiustheme\ClCar\Listing_Functions;

$currency = Functions::get_currency_symbol();
$loc_text = esc_attr__( 'Select Location', 'clcar-core' );

$toggle_cols = $data['toggle_fields_columns'] ?? 'toggle-fields-cols-4';

?>

<!-- Form Builder Search Form -->
<div class="rt-hero-section motion-effects-wrap listing-search-fb-form">
    <div class="hero-banner-content">
        <div class="banner-search-wrapper listing-search-fb-form-view-<?php echo esc_attr( $data['view'] ); ?>">
            <form action="<?php echo esc_url( Functions::get_filter_form_url() ); ?>" class="rtcl-widget-search-form">

                <?php $permalink_structure = get_option( 'permalink_structure' ); ?>

                <?php if ( ! $permalink_structure ) : ?>
                    <input type="hidden" name="post_type" value="rtcl_listing">
                <?php endif; ?>

                <div class="listing-filter-area">
	                <?php if( $data['show_category'] == 'yes' || $data['show_ad_type'] == 'yes' ){ ?>
                        <div class="cats-and-ad_type-filter-area">
                            <?php if( $data['show_category']=='yes' ){ ?>
                                <div class="listing-category-list">
                                    <span class="line-shape"></span>
                                    <div class="search-item rtin-category search-radio search-radio-check">
                                        <?php if (!empty($data['categories_label_text'])){ ?>
                                            <label><?php echo esc_html($data['categories_label_text']); ?></label>
                                        <?php } ?>
                                        <ul class="list-inline">
                                            <?php
                                            $terms  = $data['highlight_categories'];
                                            if ($terms){
                                                foreach ( $terms as $key => $value ) {
                                                    if (!empty(get_term( $value )->term_id)) {
                                                        $term_id = get_term( $value )->term_id;
                                                        $term_slug = get_term($value)->slug;
                                                        $term_name = get_term($value)->name;
                                                        ?>
                                                        <li class="<?php echo esc_attr( $term_slug ) ?>">
                                                            <label for="<?php echo esc_attr( $term_slug ) ?>" class="">
                                                                <span><?php echo esc_html( $term_name ) ?></span>
                                                                <input
                                                                    type="radio"
                                                                    name="<?php echo esc_attr( 'rtcl_category' ) ?>"
                                                                    id="<?php echo esc_attr( $term_slug ) ?>"
                                                                    value="<?php echo esc_attr( $term_slug ) ?>"
                                                                >
                                                            </label>
                                                        </li>
                                                    <?php }
                                                    ?>

                                                    <?php
                                                }
                                            } else {
                                                $terms = get_terms( [
                                                    'taxonomy'   => rtcl()->category,
                                                    'hide_empty' => true,
                                                ] );
                                                foreach ( $terms as $term ) {
                                                    ?>
                                                    <li class="<?php echo esc_attr( $term->slug ) ?>">
                                                        <label for="<?php echo esc_attr( $term->slug ) ?>" class="">
                                                            <span><?php echo esc_html( $term->name ) ?></span>
                                                            <input
                                                                type="radio"
                                                                name="<?php echo esc_attr( 'rtcl_category' ) ?>"
                                                                id="<?php echo esc_attr( $term->slug ) ?>"
                                                                value="<?php echo esc_attr( $term->slug ) ?>"
                                                            >
                                                        </label>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ( $data['show_ad_type'] == 'yes' ) { ?>
                                <div class="listing-ad-type-list">
                                    <span class="line-shape"></span>
                                    <div class="search-item rtin-ad-type search-radio search-radio-check">
                                        <?php if (!empty($data['ad_type_label_text'])){ ?>
                                            <label><?php echo esc_html($data['ad_type_label_text']); ?></label>
                                        <?php } ?>
                                        <ul class="list-inline">
                                            <?php
                                            $all_ad_types = Functions::get_listing_types();
                                            $highlight_ad_types = !empty($data['highlight_ad_types']) ? $data['highlight_ad_types'] : array();
                                            if ( !empty($highlight_ad_types) ) {
                                                foreach ( $highlight_ad_types as $type_key ) {
                                                    if ( isset($all_ad_types[$type_key]) ) {
                                                        $type_name = $all_ad_types[$type_key];
                                                        ?>
                                                        <li class="<?php echo esc_attr( $type_key ); ?>">
                                                            <label for="ad-type-<?php echo esc_attr( $type_key ); ?>">
                                                                <span><?php echo esc_html( $type_name ); ?></span>
                                                                <input type="radio"
                                                                       name="filter_ad_type"
                                                                       id="ad-type-<?php echo esc_attr( $type_key ); ?>"
                                                                       value="<?php echo esc_attr( $type_key ); ?>">
                                                            </label>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                foreach ( $all_ad_types as $key => $name ) {
                                                    ?>
                                                    <li class="<?php echo esc_attr( $key ); ?>">
                                                        <label for="ad-type-<?php echo esc_attr( $key ); ?>">
                                                            <span><?php echo esc_html( $name ); ?></span>
                                                            <input type="radio" name="filter_ad_type" id="ad-type-<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>">
                                                        </label>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
	                <?php } ?>
                    <div class="others-fields">
                        <div class="search-area" id="rtcl-custom-fields-list">
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

                            <?php if (  Functions::isEnableFb()){
	                            global $wpdb;
	                            $table_name = $wpdb->prefix . 'rtcl_forms';

	                            // Get make field data from database
	                            $form_data = $wpdb->get_row(
		                            $wpdb->prepare(
			                            "SELECT fields FROM $table_name WHERE slug = %s",
			                            'car-listing'
		                            ),
		                            ARRAY_A
	                            );
                                ?>
	                            <?php if($data['show_make_search']){ ?>
                                    <div class="search-item make-dropdowns">
                                        <!-- Filter form এ Make dropdown-->
                                        <select name="cf_select_make" id="select_make" class="select2">
                                            <option value=""><?php esc_html_e('Select Make', 'clcar'); ?></option>
                                            <?php
                                                if ($form_data && !empty($form_data['fields'])) {
                                                    $fields = json_decode($form_data['fields'], true);
                                                    // Find make field
                                                    foreach ($fields as $field) {
                                                        if (isset($field['name']) && $field['name'] === 'select_make') {
                                                            if (isset($field['options']) && is_array($field['options'])) {
                                                                foreach ($field['options'] as $option) {
                                                                    echo '<option value="' . esc_attr($option['value']) . '">' . esc_html($option['label']) . '</option>';
                                                                }
                                                            }
                                                            break;
                                                        }
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
		                            <?php if( $data['show_model_search'] ){ ?>
                                        <div class="search-item model-dropdowns">
                                            <!-- Model dropdown -->
                                            <select name="cf_select_model" id="select_model" class="select2">
                                                <option value=""><?php esc_html_e('Select Model', 'clcar'); ?></option>
                                            </select>
                                        </div>
                                    <?php } ?>
	                            <?php } ?>
	                            <?php if( $data['show_year_search'] ){ ?>
                                    <div class="search-item year-dropdowns">
                                        <!-- Year dropdown-->
                                        <select name="cf_build_year" id="build_year" class="select2">
                                            <option value=""><?php esc_html_e('Select Year', 'clcar' ); ?></option>
                                        </select>
                                    </div>
	                            <?php } ?>
                            <?php } ?>
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
                            <?php if($data['radius_search']=='yes'){ ?>
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
                        <div class="search-item search-btn <?php echo esc_attr( $data['button_type'] ); ?>">
	                        <?php if ( $data['show_toggle_fields'] == 'yes' ) { ?>
                                <button class="advanced-btn collapsed" type="button">
                                    <i class="icon-slider"></i>
                                </button>
                            <?php } ?>
                            <button type="submit" class="submit-btn">
                                <?php esc_html_e( 'Search', 'clcar' ); ?>
                                <i class="icon-search3"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="listing-custom-search-wrapper" id="rt-search-custom-field">
                    <div class="listing-custom-search-box <?php echo esc_attr( $toggle_cols ); ?>">
                        <?php
                            if (  Functions::isEnableFb()){
                                Helper::get_custom_listing_template( 'cfg_fields' );
                            }
                        ?>
                        <?php if ( $data['price_search'] == 'yes' ){ ?>
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
                                        data-max="<?php echo isset( $max_price ) && ! empty( $max_price ) ? esc_attr( $max_price ) : 1000; ?>"
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
                        <?php  } ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
