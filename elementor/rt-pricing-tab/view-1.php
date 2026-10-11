<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Utils;
extract($data);
?>
<div class="rt-pricing-tab">
    <div class="pricing-tab">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="monthly-tab" data-bs-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="true"><?php echo esc_html($data['monthly_title']); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="yearly-tab" data-bs-toggle="tab" href="#yearly" role="tab" aria-controls="yearly" aria-selected="false"><?php echo esc_html($data['yearly_title']); ?></a>
            </li>
        </ul>
    </div>
    
    <div class="tab-content" id="myTabContent">
        <?php if($data['monthly_features']){ ?>
            <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                <div class="container">
                    <div class="row g-0">
                    <?php $i=1; ?>
                    <?php foreach($data['monthly_features'] as $key=>$feature){
                        $popular_price=$i==2 ? 'rt-pricing-table--popular':'';    
                        extract($feature);        
                        ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="rt-pricing-table <?php echo esc_attr($popular_price); ?>">
                                <div class="rt-pricing-table__header">
                                    <h3 class="rt-pricing-table__plan-name"><?php echo wp_kses_post($feature['title']); ?></h3>
                                    <div class="rt-pricing-table__item-price">
                                    <?php echo esc_html($feature['price']); ?> <span><?php echo esc_html($feature['price_suffix']) ?></span>
                                    </div>
                                    <p><?php echo wp_kses_post($feature['description']); ?></p>
                                </div>
                                <div class="rt-pricing-table__content">
                                    <?php echo wp_kses_post($feature['content']); ?>
                                </div>
                                <?php if($feature['btn_text']){ ?>
                                    <div class="rt-pricing-table__footer">
                                        <a href="<?php echo esc_url($feature['btn_url']['url']); ?>" class="radius-btn">
                                        <span class="text"><?php echo esc_html($feature['btn_text']); ?></span>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php $i++;} ?>
                    </div>
                </div>   
            </div>
        <?php } ?>
        <?php if($data['yearly_features']){ ?>
            <div class="tab-pane fade" id="yearly" role="tabpanel" aria-labelledby="yearly-tab">
                <div class="container">
                    <div class="row g-0">
                    <?php $j=1; ?>
                    <?php foreach($data['yearly_features'] as $key=>$feature){ 
                        $year_popular_price=$j==2 ? 'rt-pricing-table--popular':'';
                        ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="rt-pricing-table <?php echo esc_attr($year_popular_price); ?>">
                                <div class="rt-pricing-table__header">
                                    <h3 class="rt-pricing-table__plan-name"><?php echo wp_kses_post($feature['yearly_title']); ?></h3>
                                    <div class="rt-pricing-table__item-price">
                                    <?php echo esc_html($feature['yearly_price']) ?> <span><?php echo esc_html($feature['yearly_price_suffix']) ?></span>
                                    </div>
                                    <p><?php echo esc_html($feature['yearly_description']); ?></p>
                                </div>
                                <div class="rt-pricing-table__content">
                                    <?php echo wp_kses_post($feature['yearly_content']); ?>
                                </div>
                                <?php if($feature['yearly_btn_text']){ ?>
                                    <div class="rt-pricing-table__footer">
                                        <a href="<?php echo esc_url($feature['yearly_btn_url']['url']); ?>" class="radius-btn  ">
                                        <span class="text"><?php echo esc_html($feature['yearly_btn_text']); ?></span>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div> 
                        </div>
                    <?php $j++;} ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
