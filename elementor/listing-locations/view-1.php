<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/listing/view-2.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\ClCar_Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Rtcl\Helpers\Link;

if(is_array($data['locations']) && !empty($data['locations'])){ ?>
    <div class="el-location-box slider el-location-box-1">
        <div class="rt-global-slider swiper" data-slider-options="<?php echo esc_attr( $data['slider_data'] ); ?>">
            <?php if ( $data['arrows'] =='yes' ) : ?>
                <div class="section-heading">
                        <div class="swiper-button">
                            <div class="custom-swiper-button-prev">
                                <svg width="10" height="20" viewBox="0 0 10 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.75005 17.25C8.55823 17.25 8.36623 17.1767 8.2198 17.0302L0.719797 9.53024C0.426734 9.23718 0.426734 8.76261 0.719797 8.46974L8.2198 0.969736C8.51286 0.676673 8.98742 0.676673 9.2803 0.969736C9.57317 1.2628 9.57336 1.73736 9.2803 2.03024L2.31055 8.99999L9.2803 15.9697C9.57336 16.2628 9.57336 16.7374 9.2803 17.0302C9.13386 17.1767 8.94186 17.25 8.75005 17.25Z" fill="currentColor"></path>
                                </svg>
                            </div>
                            <div class="custom-swiper-button-next">
                                <svg width="10" height="20" viewBox="0 0 10 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.24995 17.25C1.44177 17.25 1.63377 17.1767 1.7802 17.0302L9.2802 9.53024C9.57327 9.23718 9.57327 8.76261 9.2802 8.46974L1.7802 0.969736C1.48714 0.676673 1.01258 0.676673 0.719703 0.969736C0.426828 1.2628 0.426641 1.73736 0.719703 2.03024L7.68945 8.99999L0.719703 15.9697C0.426641 16.2628 0.426641 16.7374 0.719703 17.0302C0.86614 17.1767 1.05814 17.25 1.24995 17.25Z" fill="currentColor"></path>
                                </svg>
                            </div>
                        </div>
                </div>
            <?php endif; ?>
            <div class="swiper-wrapper">
                <?php extract( $data ); ?>
                <?php foreach ( $data['locations'] as $item ) {
                    $term = get_term( $item['location_name'], 'rtcl_location' );
                    if ( $term && !is_wp_error( $term ) ) {
                        $item['title']     = $term->name;
                        $item['count']     = $this->rt_term_post_count( $term->term_id );
                        $item['permalink'] = Link::get_location_page_link( $term );
                    } else {
                        $item['title'] = esc_html__( 'Please Select a Location and Background', 'clcar-core' );
                        $item['count'] = 0;
	                    $item['permalink'] = '';
                        $item['display_count'] = $data['enable_link'] = false;
                    } ?>
                    <div class="swiper-slide">
                        <div class="location-box" data-bg-image="<?php echo esc_url($item['bgimg']['url']); ?>">
                            <div class="location-content">
                                <div class="text-holder">
                                    <h3>
                                        <a href="<?php echo esc_url($item['permalink']); ?>">
                                        <?php 
                                        echo esc_html($item['title']);
                                        ?></a>
                                    </h3>
                                    <div class="listing-count">
                                        <span class="count"><?php echo esc_html( $item['count'] < 10 ? '0'.ltrim($item['count'], "0") : $item['count']); ?></span>
                                        <?php if($data['count_suffix_display']=='yes'){ ?>
                                            <span><?php echo esc_html($data['count_suffix_text']); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <a href="<?php echo esc_url($item['permalink']); ?>" class="icon-holder"><i class="icon-arrow-right-thin2"></i></a>
                            </div>
                        </div>
                    </div>
                <?php    
                } 
                ?>
            </div>
            <?php if($data['dots']){ ?>
                <div class="el-swiper-pagination"></div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
   



