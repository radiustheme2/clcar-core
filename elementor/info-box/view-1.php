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

$target   = $data['link']['is_external'] ? ' target="_blank"' : '';
$nofollow = $data['link']['nofollow'] ? ' rel="nofollow"' : '';
$text_align = $data['text_align'] ?? '';


$styles = [];

// Add Position
if ( isset($data['offsets']['bottom']) && $data['offsets']['bottom'] !== '' ) {
	$styles[] = "bottom: {$data['offsets']['bottom']}{$data['unit']};";
}
if ( isset($data['offsets']['left']) && $data['offsets']['left'] !== '' ) {
	$styles[] = "left: {$data['offsets']['left']}{$data['unit']};";
}

$top_bottom = $data['position_top_bottom_offset']['size'] ?? 50;
$left_right = $data['position_left_right_offset']['size'] ?? 50;

?>

<div class="why-choose-box rt-info-box">
	<div class="choose-box">
		<div class="icon-holder <?php echo esc_attr( $text_align ); ?>">
				<?php
                    echo $data['link']['url'] ? '<a href="' . esc_url( $data['link']['url'] ) . '"' . esc_attr( $target ) . esc_attr( $nofollow ) . '>' : null;
                    if ( 'image' == $data['icon_type'] ) {
                        echo "<div class='img-wrap'>";
                        echo wp_get_attachment_image( $data['image_icon']['id'], 'full' );
                        echo "</div>";
                    } else {
                        Icons_Manager::render_icon( $data['info_icon'], [ 'aria-hidden' => 'true' ] );
                    }
                    echo $data['link']['url'] ? '</a>' : null;
				?>
		</div>
		<div class="content-holder content-align <?php echo esc_attr( $text_align ); ?>">
			<?php if ( $data['title'] ) : ?>
				<h3 class="entry-title">
					<?php
                        echo $data['link']['url'] ? '<a href="' . esc_url( $data['link']['url'] ) . '"' . esc_attr( $target ) . esc_attr( $nofollow ) . '>' : null;
                        echo wp_kses_post( $data['title'] );
                        echo $data['link']['url'] ? '</a>' : null;
					?>
				</h3>
			<?php endif; ?>
			<?php if($data['step_number']){ ?>
                <span class="step-number" style="top:<?php echo esc_attr( $top_bottom ); ?>%; left:<?php echo esc_attr( $left_right ); ?>%;">
                    <?php echo esc_html($data['step_number']); ?>
                </span>
			<?php } ?>
			<?php if($data['content']){ ?>
				<p class="entry-description"><?php echo esc_html($data['content']); ?></p>
			<?php } ?>
			<?php if ( $data['show_readmore_btn'] ) : ?>
				<div class="read-more-btn">
					<a class="choose-btn" href="<?php echo esc_url( $data['link']['url'] ) ?>" <?php echo esc_attr( $target . ' ' . $nofollow ) ?>>
                        <?php echo esc_html( $data['read_more_btn_text'] ); ?>
                        <i class="icon-arrow-right-bold2"></i>
					</a>
				</div>
			<?php endif; ?>
		</div>
    </div>
</div>



