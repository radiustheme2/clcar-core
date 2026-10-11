<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$img= wp_get_attachment_image( $data['image']['id'], 'full' );

$google_target   = $data['google_link']['is_external'] ? ' target="_blank"' : '';
$google_nofollow = $data['google_link']['nofollow'] ? ' rel="nofollow"' : '';

$ios_target   = $data['ios_link']['is_external'] ? ' target="_blank"' : '';
$ios_nofollow = $data['ios_link']['nofollow'] ? ' rel="nofollow"' : '';
?>

<div class="call-to-action-wrap-layout2 motion-effects-wrap">
     <?php if($data['show_shape']){ ?>
        <div class="shape-wrap-main">
            <div class="shape-1 wow fadeInDown animated animated" data-wow-delay="0.3s" data-wow-duration="1s">
            <img class="motion-effects1" src="<?php echo esc_url( CLCAR_ASSETS_URL . 'img/apps-shape1.png' ); ?>" alt="<?php echo esc_attr('Shape', 'clcar-core'); ?>">
            </div>
            <div class="shape-2 wow fadeInDown animated animated" data-wow-delay="0.5s" data-wow-duration="1s">
            <img class="motion-effects3" src="<?php echo esc_url( CLCAR_ASSETS_URL . 'img/apps-shape2.png' ); ?>" alt="<?php echo esc_attr('Shape', 'clcar-core'); ?>">
            </div>
        </div>
      <?php } ?>
      <div class="container">
        <div class="row justify-content-center g-4 row-cols-lg-2 row-cols-1">
          <div class="col">
            <div class="call-to-action-box call-to-action-style-1">
              <div class="content-holder">
                <h2 class="entry-title"><?php echo esc_html($data['title']); ?></h2>
                
                    <p class="entry-description"><?php echo wp_kses_post($data['content']); ?></p>
                
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <?php if($data['show_google_btn']){ ?>
                        <a class="app-box google" href="<?php echo esc_url($data['google_link']['url']); ?>" <?php echo esc_attr( $google_target . ' ' . $google_nofollow ) ?>>
                            <div class="app-icon">
                              <i class="icon-google-play"></i>
                            </div>
                            <div class="app-content">
                              <span class="app-sub-title"><?php esc_html_e('Get it in','clcar-core') ?></span>
                              <h3 class="app-title"><?php esc_html_e('Google Play','clcar-core'); ?></h3>
                            </div>
                        </a>
                    
                    <?php } ?>
                    <?php if($data['show_ios_btn']){ ?>
                        <a class="app-box apple" href="<?php echo esc_url($data['ios_link']['url']); ?>" <?php echo esc_attr( $ios_target . ' ' . $ios_nofollow ) ?>>
                            <div class="app-icon">
                              <i class="icon-apple"></i>
                            </div>
                            <div class="app-content">
                              <span class="app-sub-title"><?php esc_html_e('Download on the','clcar-core'); ?></span>
                              <h3 class="app-title"><?php esc_html_e('App Store','clcar-core'); ?></h3>
                            </div>
                        </a>
                    <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="call-to-action-box call-to-action-style-1">
              <div class="figure-holder">
                <div class="shape-wrap-inner">
                  <div class="shape-1 wow fadeInDown animated" data-wow-delay="0.3s" data-wow-duration="1s">
                    <img class="motion-effects1" src="<?php echo esc_url( CLCAR_ASSETS_URL . 'img/apps-shape3.png' ); ?>" alt="<?php echo esc_attr('Shape', 'clcar-core'); ?>">
                  </div>
                  <div class="shape-2 wow fadeInRight animated" data-wow-delay="0.5s" data-wow-duration="1s">
                    <img class="motion-effects4" src="<?php echo esc_url( CLCAR_ASSETS_URL . 'img/apps-shape4.png' ); ?>" alt="<?php echo esc_attr('Shape', 'clcar-core'); ?>">
                  </div>
                  <div class="shape-3 wow fadeInUp animated" data-wow-delay="0.7s" data-wow-duration="1s">
                    <img class="motion-effects3" src="<?php echo esc_url( CLCAR_ASSETS_URL . 'img/apps-banner5.png' ); ?>" alt="<?php echo esc_attr('Shape 5', 'clcar-core'); ?>">
                  </div>
                </div>
                <?php if($img){
                        echo wp_kses_post($img);
                    } else {?>
                        <img class="wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="1.5s" src="<?php echo esc_url( CLCAR_ASSETS_URL . 'img/apps-banner6.png' ); ?>" alt="<?php echo esc_attr('Shape 6', 'clcar-core'); ?>">
                <?php } ?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
</div>