<?php

namespace radiustheme\ClCar_Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Shortcodes {

	protected static $instance = null;

	public function __construct() {
		add_shortcode( 'rt_contact', [ $this, 'rt_contact_render' ] );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	function rt_contact_render( $atts, $content ) {
		extract( shortcode_atts( [
			'address' => '121 King St, Melbourne den 3000, Australia',
			'mail'    => 'info@example.com',
			'phone'   => '(+123) 596 000',
			'website' => '',
		], $atts ) );

		ob_start();
		?>
        <div class="rt-contact-wrapper">
            <ul>
				<?php if ( $address ) : ?>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <p><?php echo esc_html( $address ); ?></p>
                    </li>
				<?php endif; ?>

				<?php if ( $mail ) : ?>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <p><a target="_blank" href="mailto:<?php echo esc_html( $mail ); ?>"><?php echo esc_html( $mail ); ?></a></p>
                    </li>
				<?php endif; ?>

				<?php if ( $phone ) : ?>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <p><a target="_blank" href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></p>
                    </li>
				<?php endif; ?>

				<?php if ( $website ) : ?>
                    <li>
                        <i class="fas fa-globe"></i>
                        <p><a target="_blank" href="<?php echo esc_url( $website ); ?>"><?php echo esc_html( $website ); ?></a></p>
                    </li>
				<?php endif; ?>
            </ul>
        </div>
		<?php
		return ob_get_clean();
	}

}

Shortcodes::instance();