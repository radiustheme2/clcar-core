<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Finbuzz_Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<div class="contact-info-default">
    <div class="address-box">
        <div class="icon-holder">
            <?php \Elementor\Icons_Manager::render_icon( $data['contact_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <div class="content-holder">
            <h3 class="entry-title"><?php echo esc_html($data['title']); ?></h3>
            <?php
                $data_type = $data['contact_info'];
                if(filter_var($data_type, FILTER_VALIDATE_EMAIL)){
                    $href_value = 'mailto:'. sanitize_email( $data_type );
                } elseif ( preg_match('/^[0-9\-\(\)\/\+\s]*$/', $data_type ) ) {
                    $href_value = 'tel:'.esc_attr($data_type);
                } elseif (filter_var($data_type, FILTER_VALIDATE_URL)) {
                    $href_value = "esc_url($data_type)";
                } else {
                    $href_value = '';
                }
                $link_key = 'link';
                $this->add_render_attribute( $link_key, 'href', $href_value );
            ?>					
            <div class="entry-description">
            
                <?php if (!empty( $href_value ) ) { ?>
                    <a <?php echo wp_kses_post( $this->get_render_attribute_string( $link_key ) ); ?>>
                        <?php echo wp_kses_post($data['contact_info']); ?>
                    </a>
                
                <?php } else { ?>
                    <?php echo wp_kses_post($data['contact_info']); ?>
                <?php } ?>
                
            </div>
        </div>
    </div>
</div>

