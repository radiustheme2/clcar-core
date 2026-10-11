<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.1.0
 */

namespace radiustheme\ClCar_Core;

use radiustheme\ClCar\Helper;
use radiustheme\ClCar\RDTheme;
use \WP_Widget;
use \RT_Widget_Fields;

class About_Widget extends WP_Widget {

	public function __construct() {
		$id = CLCAR_CORE_THEME_PREFIX . '_about';
		parent::__construct(
			$id, // Base ID
			esc_html__( 'ClCar: About', 'clcar-core' ), // Name
			[
				'description' => esc_html__( 'ClCar: About', 'clcar-core' ),
			] );
	}

	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );
		$html='';
		if ( ! empty( $instance['logo'] ) ) {
			$html = wp_get_attachment_image_src( $instance['logo'], 'full' );
			$html = $html[0];
			$html = '<div class="footer-logo"><a href="' . home_url( '/' ) . '"><img src="' . $html . '" alt="' . $html . '"></a></div>';
		} elseif ( ! empty( $instance['title'] ) ) {
			$html = apply_filters( 'widget_title', $instance['title'] );
			$html = $args['before_title'] . $html . $args['after_title'];
		} else {
			$main_logo         = ( isset( RDTheme::$options['logo'] ) && 0 != RDTheme::$options['logo'] ) ? wp_get_attachment_image_src( RDTheme::$options['logo'], 'full' ) : '';
			$light_logo        = ( isset( RDTheme::$options['logo_light'] ) && 0 != RDTheme::$options['logo_light'] ) ? wp_get_attachment_image_src( RDTheme::$options['logo_light'], 'full' )
				:'';
			if ( 1 == RDTheme::$footer_style && !empty($light_logo)) {
				$html = '<div class="footer-logo one"><a href="' . home_url( '/' ) . '"><img src="' . $light_logo[0] . '" alt="' . esc_html__( 'Footer main Logo', 'clcar-core' )
				        . '" width="' . $light_logo[1] . '" height="' . $light_logo[2] . '"></a></div>';
			} elseif(2==RDTheme::$footer_style && !empty($main_logo)) {
				$html = '<div class="footer-logo two"><a href="' . home_url( '/' ) . '"><img src="' . $main_logo[0] . '" alt="' . esc_html__( 'Footer light Logo',
						'clcar-core' ) . '" width="' . $main_logo[1] . '" height="' . $main_logo[2] . '"></a></div>';
			}
		}

		echo wp_kses_post( $html );
		?>
        <p><?php if ( ! empty( $instance['description'] ) ) {
				echo wp_kses_post( $instance['description'] );
			} ?></p>
        <ul class="footer-social">
			<?php
			if ( ! empty( $instance['facebook'] ) ) {
				?>
                <li class="rtin-facebook"><a href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank"><i class="icon-facebook"></i></a></li><?php
			}
			if ( ! empty( $instance['twitter'] ) ) {
				?>
                <li class="rtin-twitter"><a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li><?php
			}
			if ( ! empty( $instance['linkedin'] ) ) {
				?>
                <li class="rtin-linkedin"><a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank"><i class="icon-linkedin"></i></a></li><?php
			}
			if ( ! empty( $instance['pinterest'] ) ) {
				?>
                <li class="rtin-pinterest"><a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a></li><?php
			}
			if ( ! empty( $instance['instagram'] ) ) {
				?>
                <li class="rtin-instagram"><a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank"><i class="icon-instagram"></i></a></li><?php
			}
			if ( ! empty( $instance['youtube'] ) ) {
				?>
                <li class="rtin-youtube"><a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank"><i class="fab fa-youtube"></i></a></li><?php
			}
			if ( ! empty( $instance['rss'] ) ) {
				?>
                <li class="rtin-rss"><a href="<?php echo esc_url( $instance['rss'] ); ?>" target="_blank"><i class="fas fa-rss"></i></a></li><?php
			}
			?>
        </ul>

		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {
		$instance                = [];
		$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['logo']        = ( ! empty( $new_instance['logo'] ) ) ? sanitize_text_field( $new_instance['logo'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? wp_kses_post( $new_instance['description'] ) : '';
		$instance['facebook']    = ( ! empty( $new_instance['facebook'] ) ) ? sanitize_text_field( $new_instance['facebook'] ) : '';
		$instance['twitter']     = ( ! empty( $new_instance['twitter'] ) ) ? sanitize_text_field( $new_instance['twitter'] ) : '';
		$instance['linkedin']    = ( ! empty( $new_instance['linkedin'] ) ) ? sanitize_text_field( $new_instance['linkedin'] ) : '';
		$instance['pinterest']   = ( ! empty( $new_instance['pinterest'] ) ) ? sanitize_text_field( $new_instance['pinterest'] ) : '';
		$instance['instagram']   = ( ! empty( $new_instance['instagram'] ) ) ? sanitize_text_field( $new_instance['instagram'] ) : '';
		$instance['youtube']     = ( ! empty( $new_instance['youtube'] ) ) ? sanitize_text_field( $new_instance['youtube'] ) : '';
		$instance['rss']         = ( ! empty( $new_instance['rss'] ) ) ? sanitize_text_field( $new_instance['rss'] ) : '';

		return $instance;
	}

	public function form( $instance ) {
		$defaults = [
			'title'       => '',
			'logo'        => '',
			'description' => '',
			'facebook'    => '',
			'twitter'     => '',
			'linkedin'    => '',
			'pinterest'   => '',
			'instagram'   => '',
			'youtube'     => '',
			'rss'         => '',
		];
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title'       => [
				'label' => esc_html__( 'Title', 'clcar-core' ),
				'type'  => 'text',
			],
			'logo'        => [
				'label' => esc_html__( 'Logo', 'clcar-core' ),
				'type'  => 'image',
				'desc'  => esc_html__( 'If you don\'t choose logo then default logo will show from Customizer > General', 'clcar-core' ),
			],
			'description' => [
				'label' => esc_html__( 'Description', 'clcar-core' ),
				'type'  => 'textarea',
			],
			'facebook'    => [
				'label' => esc_html__( 'Facebook URL', 'clcar-core' ),
				'type'  => 'url',
			],
			'twitter'     => [
				'label' => esc_html__( 'Twitter URL', 'clcar-core' ),
				'type'  => 'url',
			],
			'linkedin'    => [
				'label' => esc_html__( 'Linkedin URL', 'clcar-core' ),
				'type'  => 'url',
			],
			'pinterest'   => [
				'label' => esc_html__( 'Pinterest URL', 'clcar-core' ),
				'type'  => 'url',
			],
			'instagram'   => [
				'label' => esc_html__( 'Instagram URL', 'clcar-core' ),
				'type'  => 'url',
			],
			'youtube'     => [
				'label' => esc_html__( 'YouTube URL', 'clcar-core' ),
				'type'  => 'url',
			],
			'rss'         => [
				'label' => esc_html__( 'Rss Feed URL', 'clcar-core' ),
				'type'  => 'url',
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

}