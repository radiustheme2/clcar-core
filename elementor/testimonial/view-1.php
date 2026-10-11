<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $data array
 */

namespace radiustheme\ClCar_Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Icons_Manager;

?>
<div class="rt-el-testimonial-carousel">
    <div class="slide-wrap">
        <div class="rt-global-slider swiper" data-slider-options="<?php echo esc_attr( $data['slider_data'] ); ?>">
            <div class="swiper-wrapper">
				<?php foreach ( $data['items'] as $item ): ?>
                    <div class="swiper-slide slider-item">
                        <div class="testimonial-block quote-icon-<?php echo esc_attr( $data['quote_icon_position'] ); ?>">
                            <?php if ( $data['rating'] ) : ?>
                                <ul class="rating">
                                    <?php for ( $i=0; $i <=4 ; $i++ ) {
                                        if ( $i < $item['rating'] ) {
                                            $full = 'active';
                                        } else {
                                            $full = 'deactive';
                                        }
                                        echo '<li class="has-rating"><i class="fa-solid fa-star ' . esc_attr( $full ) . '"></i></li>';
                                    } ?>
                                </ul>
                            <?php endif; ?>
                            <p class="testimonial-block__text">
                                <?php echo esc_html( $item['content'] ); ?>
                            </p>
                            <div class="testimonial-content">
                                <?php 
                                    if ( $item['image']['id'] && $data['thum_display']=='yes') {
                                        echo "<div class='testimonial-img'>";
                                        echo wp_get_attachment_image( $item['image']['id'], 'full' );
                                        echo "</div>";
                                    }
                                ?>
                                <div class="content-info">
                                    <h3 class="testimonial-block__heading"><?php echo esc_html( $item['name'] ); ?></h3>
                                    <?php if ( $item['designation'] ): ?>
                                        <span class="testimonial-block__designation"><?php echo esc_html( $item['designation'] ); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($data['quote_icon']['value'])){ ?>
                                    <div class="qoute-icon">
                                        <?php Icons_Manager::render_icon( $data['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
            <?php if( $data['dots'] ){ ?>
                <div class="el-swiper-pagination"></div>
            <?php } ?>
        </div>
    </div>
</div>

