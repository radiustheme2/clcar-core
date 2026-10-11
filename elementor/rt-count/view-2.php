<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Image_Size;

$get_img=Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size' , 'rt_image' );

?>
<div class="listing-counter-wrapper style2">
    <div class="banner-message-wrap">
        <div class="wow bounceInDown animated animated" data-wow-delay="0.7s" data-wow-duration="1s">
            <div class="banner-message-box counter-content" data-bg-image="<?php echo esc_url( CLCAR_ASSETS_URL . 'img/count-shape.png' ); ?>" style="background-image: url(<?php echo esc_url( CLCAR_ASSETS_URL . 'img/count-shape.png' ); ?>);">
                <div class="d-flex align-items-center count">
                    <span class="counter" data-num="<?php echo esc_attr($data['counts']); ?>" data-rtspeed="3000" data-rtsteps="10"><?php echo esc_html($data['counts']); ?></span><?php echo esc_html($data['counter_suffix']); ?>
                </div>
                <div class="title"><?php echo esc_html( $data['title'] ); ?></div>
            </div>
        </div>
    </div>
    <?php if($get_img){ ?>
        <div class="figure-holder wow fadeInRight animated animated" data-wow-delay="0.7s" data-wow-duration="1s">
            <?php echo wp_kses_post($get_img); ?>
        </div>
    <?php } ?>
</div>