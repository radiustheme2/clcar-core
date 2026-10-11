<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * top_sub_title
 * title
 * subtitle
 * bg_title
 * top_title_icon
 *
 */

namespace radiustheme\ClCar_Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="section-title-wrapper">
    <div class="title-inner-wrapper">

        <!--Top Sub Title-->
        <?php if ( $data['top_sub_title'] ): ?>
            <div class="section-subtitle">
                <?php
                echo esc_html( $data['top_sub_title'] );
                ?>
            </div>
        <?php endif; ?>

        <!--Main Title-->
        <?php if ( $data['title'] ): ?>
            <div class="title-wrapper">
                <h2 class="section-title"><?php echo wp_kses_post( $data['title'] ); ?></h2>
                <?php if($data['title_shape']=='yes'){ ?>
                    <div class="rt-heading-shape"><i class="icon-wheel"></i></div>
                <?php } ?>
            </div>
        <?php endif; ?>

        <!--Description-->
        <?php if ( $data['description'] ): ?>
            <div class="section-description"><?php echo wp_kses_post( $data['description'] ); ?></div>
        <?php endif; ?>
    </div>
</div>