<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $data array;
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Icons_Manager;

?>

<div class="rt-marquee-slider">
    <div class="rt-marquee <?php echo esc_attr( $data['marquee_direction'] );?>">
        <div class="rt-marquee-item">
			<?php foreach ( $data['items'] as $item ) :
			$attr = '';
			if ( !empty( $item['url']['url'] ) ) {
				$attr  = 'href="' . $item['url']['url'] . '"';
				$attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
				$attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
				$title = '<a ' . $attr . '>' . $item['title'] . '</a>';
			} else {
				$title = $item['title'];
			}
			?>
            <<?php echo esc_attr( $data['heading_tag'] ); ?> class="entry-title <?php if( $data['gradient_display'] == 'yes' ) { ?>title-gradient<?php } ?>" data-per="<?php echo wp_kses_post( $item['title'] ); ?>">
			<?php echo wp_kses_post( $title ); ?>
			<?php  if('icon' == $data['icon_type'] || 'image' == $data['icon_type']) : ?>
                <span class="icon-holder rt-spin-counterclockwise">
			        <?php
			        if('icon' == $data['icon_type']) {
				        Icons_Manager::render_icon( $data['bgicon'] );
			        } elseif ('image' == $data['icon_type']) {
				        echo wp_get_attachment_image( $data['image']['id'], 'full' );
			        }
			        ?>
                </span>
			<?php endif; ?>
            </<?php echo esc_attr( $data['heading_tag'] ); ?>>
            <?php endforeach; ?>
        </div>
        <div class="rt-marquee-item">
            <?php foreach ( $data['items'] as $item ) :
            $attr = '';
            if ( !empty( $item['url']['url'] ) ) {
                $attr  = 'href="' . $item['url']['url'] . '"';
                $attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
                $attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
                $title = '<a ' . $attr . '>' . $item['title'] . '</a>';
            } else {
                $title = $item['title'];
            }
            ?>
            <<?php echo esc_attr( $data['heading_tag'] ); ?> class="entry-title <?php if( $data['gradient_display'] == 'yes' ) { ?>title-gradient<?php } ?>" data-per="<?php echo wp_kses_post( $item['title'] ); ?>">
            <?php echo wp_kses_post( $title ); ?>
            <?php  if('icon' == $data['icon_type'] || 'image' == $data['icon_type']) : ?>
                <span class="icon-holder rt-spin-counterclockwise">
                    <?php
                    if('icon' == $data['icon_type']) {
                        Icons_Manager::render_icon( $data['bgicon'] );
                    } elseif ('image' == $data['icon_type']) {
                        echo wp_get_attachment_image( $data['image']['id'], 'full' );
                    }
                    ?>
                </span>
            <?php endif; ?>
            </<?php echo esc_attr( $data['heading_tag'] ); ?>>
            <?php endforeach; ?>
        </div>

        <div class="rt-marquee-item">
            <?php foreach ( $data['items'] as $item ) :
            $attr = '';
            if ( !empty( $item['url']['url'] ) ) {
                $attr  = 'href="' . $item['url']['url'] . '"';
                $attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
                $attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
                $title = '<a ' . $attr . '>' . $item['title'] . '</a>';
            } else {
                $title = $item['title'];
            }
            ?>
            <<?php echo esc_attr( $data['heading_tag'] ); ?> class="entry-title <?php if( $data['gradient_display'] == 'yes' ) { ?>title-gradient<?php } ?>" data-per="<?php echo wp_kses_post( $item['title'] ); ?>">
            <?php echo wp_kses_post( $title ); ?>
            <?php  if('icon' == $data['icon_type'] || 'image' == $data['icon_type']) : ?>
                <span class="icon-holder rt-spin-counterclockwise">
                    <?php
                        if('icon' == $data['icon_type']) {
                            Icons_Manager::render_icon( $data['bgicon'] );
                        } elseif ('image' == $data['icon_type']) {
                            echo wp_get_attachment_image( $data['image']['id'], 'full' );
                        }
                    ?>
                </span>
            <?php endif; ?>
            </<?php echo esc_attr( $data['heading_tag'] ); ?>>
            <?php endforeach; ?>
        </div>
    </div>
</div>