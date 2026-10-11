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

use radiustheme\ClCar\Helper;



$img_url = wp_get_attachment_image_src( $data['image']['id'], 'full' );
$img_bg = '';
if($img_url) {
    $img_bg = "background-image:url(".esc_attr($img_url[0]).")";
}
?>
<div class="rt-video-icon-wrapper" style="<?php echo esc_attr($img_bg) ?>">
    <div class="video-icon-inner">
        <div class="">
            <div class="icon-box">
                <a class="popup-youtube video-popup-icon" href="<?php echo esc_url( $data['video_url'] ) ?>">
                    <i class="fas fa-play"></i>
                </a>
            </div>
        </div>
		<?php if ( $data['button_text'] ) : ?>
            <div class="">
                <a class="popup-youtube button-text" href="<?php echo esc_url( $data['video_url'] ) ?>">
                    <?php echo esc_html( $data['button_text'] ) ?>
                </a>
            </div>
		<?php endif; ?>
    </div>
</div>

