<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="listing-counter-wrapper style1">
    <div class="counter-content">
        <div class="count">
            <span class="counter" data-num="<?php echo esc_attr($data['counts']); ?>" data-rtspeed="1000" data-rtsteps="10"><?php echo esc_html($data['counts']); ?></span><?php echo esc_html($data['counter_suffix']); ?>
        </div>
        <div class="title"><?php echo esc_html( $data['title'] ); ?></div>
    </div>
</div>
