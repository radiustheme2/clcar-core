<?php  

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Image_Size;
use FluentForm\App\Modules\Entries\Report;


$btn = $attr = '';

if ( !empty( $data['btnurl']['url'] ) ) {
	$attr  = 'href="' . $data['btnurl']['url'] . '"';
	$attr .= !empty( $data['btnurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['btnurl']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
if ( !empty( $data['btntext'] ) ) {
	$btn = '<a class="btn-fill" ' . $attr . '>' . $data['btntext'] . '</a>';
}
$get_img1=wp_get_attachment_image($data['rt_image']['id'],'full');
$get_img2=wp_get_attachment_image($data['rt_image2']['id'],'full'); 
$get_img3=wp_get_attachment_image($data['rt_image3']['id'],'full'); 
?>

<div class="rt-about-box-wrapper style2">
    <div class="row justify-content-center g-4 row-cols-1 row-cols-md-2">
        <div class="col wow fadeInUp animated animated" data-wow-delay="0.3s" data-wow-duration="1s">
            <div class="about-box about-style-1">
                <div class="content-holder">
                    <div class="entry-sub-title"><?php echo esc_html($data['subtitle']); ?></div>
                    <h2 class="entry-title"><?php echo esc_html($data['title']); ?></h2>
                    <p class="entry-description"><?php echo esc_html($data['content']); ?></p>
                    <?php echo wp_kses_post( $btn ); ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="about-box about-style-1 motion-effects-wrap">
                <ul class="animated-figures">
                    <?php if($get_img1){ ?>
                        <li class="figure-1 wow fadeInRight animated animated"  data-wow-delay="0.7s" data-wow-duration="1s">
                            <span class="motion-effects1"><?php echo wp_kses_post($get_img1); ?></span>
                        </li>
                    <?php } ?>
                    <?php if($get_img2){ ?>
                        <li class="figure-2 wow fadeInUp animated animated" data-wow-delay="0.9s" data-wow-duration="1s">
                            <span class="motion-effects3"><?php echo wp_kses_post($get_img2); ?></span>
                        </li>
                    <?php } ?>
                    <?php if($get_img3){ ?>
                        <li class="figure-3 wow fadeInRight animated animated" data-wow-delay="1.1s" data-wow-duration="1s">
                            <span class="motion-effects6"><?php echo wp_kses_post($get_img3); ?></span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
