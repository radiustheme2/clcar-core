<?php 
namespace radiustheme\ClCar_Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use RtclPro\Helpers\Fns;
use Rtcl\Helpers\Functions;
use radiustheme\ClCar\Listing_Functions;
use RtclPro\Controllers\Hooks\TemplateHooks as TemplateHooksPro;

$size = $data['thumbnail_size'] ? $data['thumbnail_size'] : 'rtcl-thumbnail';

$uniqueid = time() . rand( 1, 99 );
$count    = 0;

$display = [
	'cat'    => $data['cat_display'] ? true : false,
	'action_button'    => $data['listing_action_visibility'] ? true : false,
	'views'  => $data['views_display'] ? true : false,
	'label'  => $data['label_display'] === 'yes' ? true : false,
	'author' => $data['author_display'] === 'yes' ? true : false,
	'content' => $data['content_visibility'] === 'yes' ? true : false,
	'type'   => $data['type_visibility'] === 'yes' ? true : false,
];

$gird_column_desktop = ( isset( $data['gird_column_desktop'] ) ? $data['gird_column_desktop'] : '4' );
$gird_column_tab     =  '6';
$gird_column_mobile  =  '6';
$col_class           = "col-lg-{$gird_column_desktop} col-md-{$gird_column_tab} col-sm-{$gird_column_mobile}";

$custom_fields = $display['custom_fields_display'] ?? '';

?>

<div class="rtcl rt-el-listing-wrapper isotope-wrap" id="inner-isotope">
		<div class="filter-wrapper">
            <div class="isotope-classes-tab">
				<?php if ( $data['show_all_btn'] ) : ?>
                    <a class="nav-item current" data-filter="*"><?php echo esc_html__( 'All Type', 'clcar-core' ); ?></a>
				<?php endif; ?>

				<?php foreach ( $data['navs'] as $key => $value ): ?>
                    <a class="nav-item <?php echo ( ! $count && ! $data['show_all_btn'] ) ? 'current' : '';
					$count ++; ?>" data-filter=".<?php echo esc_attr( $key . $uniqueid ); ?>"><?php echo esc_html( $value ); ?></a>
				<?php endforeach; ?>
            </div>
        </div>
		<div class="rtcl-listings rtcl-grid-view">
			<div class="row featuredContainer">
				<?php foreach ( $data['queries'] as $key => $query ): ?>
					<?php if ( $query->have_posts() ) : ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php
							global $listing;
							$listing_type = Listing_Functions::get_listing_type( $listing );
							$thumb_img    = wp_get_attachment_image_src( $listing->get_the_thumbnail_id(), $size );
							$images       = Functions::get_listing_images( $listing->get_id() );
							?>
							<div class="<?php echo esc_attr( $col_class . ' ' . $key . $uniqueid ); ?>">
								<div class="listing-box listing-item rtcl-listing-item">
									<div class="listing-thumb">
										<?php 
											$the_thumbnail = $listing->get_the_thumbnail( $size );
											if($the_thumbnail){
												echo wp_kses_post($the_thumbnail);
											}
											if ( $listing && Fns::is_enable_mark_as_sold() && Fns::is_mark_as_sold( $listing->get_id() ) ) {
												echo wp_kses_post( '<span class="rtcl-sold-out">' . apply_filters( 'rtcl_sold_out_banner_text', esc_html__( "Sold Out", 'clcar' ) ) . '</span>' );
											}
										?>
										<div class="listing-action-items">
											<div class="brand-wrap">
												<?php
												if ( Functions::isEnableFb() ) {
													$logoId = get_post_meta( $listing->get_id(), 'listing_logo', true );
													if ( ! empty( $logoId ) ) {
														$logo_id = $logoId[0];
													} else {
														$logo_id = '';
													}
												} else {
													$logo_id = get_post_meta( $listing->get_id(), 'listing_logo_img', true );
												};
												if( $logo_id ){
													?>
                                                    <div class="brand-logo">
														<?php Listing_Functions::listing_logo(); ?>
                                                    </div>
												<?php } ?>
											</div>
											<?php if($display['action_button']){ ?>
												<div class="clcar-listing-action">
													<?php 
															echo wp_kses_post( Listing_Functions::get_favourites_link( $listing->get_id() ) );
														
													?>
													<?php if ( Fns::is_enable_compare()) {
														$compare_ids    = ! empty( $_SESSION['rtcl_compare_ids'] ) ? $_SESSION['rtcl_compare_ids'] : [];
														$selected_class = '';
														if ( is_array( $compare_ids ) && in_array( $listing->get_id(), $compare_ids ) ) {
															$selected_class = ' selected';
														}
														?>
														<a class="rtcl-compare <?php echo esc_attr( $selected_class ); ?>" href="#" data-listing_id="<?php echo absint( $listing->get_id() ) ?>">
															<i class="icon-compare2"></i>
														</a>
													<?php } ?>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="item-content">
										<?php $listing_type = Listing_Functions::get_listing_type( $listing );
											if ( ! empty( $listing_type ) && $display['type']) : ?>
												<span class="listing-add-type">
													<?php echo wp_kses_post( sprintf( "%s %s", apply_filters( 'rtcl_type_prefix', esc_html__( 'For', 'clcar' ) ), esc_html( $listing_type['label'] ) ) ); ?>
												</span>
										<?php endif; ?>
										<?php
										if ( $listing->has_category() && $display['cat'] ):
											$category = $listing->get_categories();
											$category = end( $category );
											?>
											<div class="listing-category">
												<a href="<?php echo esc_url( get_term_link( $category->term_id,
													$category->taxonomy ) ); ?>"><?php echo esc_html( $category->name ) ?></a>
											</div>
										<?php endif; ?>
										<div class="item-price"><?php echo wp_kses_post( $listing->get_price_html() ); ?></div>
										<?php if ( $listing->get_the_title() ): ?>
											<h3 class="listing-title rtcl-listing-title">
												<a href="<?php $listing->the_permalink(); ?>">
													<?php $listing->the_title(); ?>
												</a>
											</h3>
										<?php endif; ?>
										<?php if($display['label']){
											$listing->the_badges();
										} ?>
										<ul class="entry-meta">
											<?php if($display['author']){ ?>
												<li class="author">
													<i class="fas fa-user"></i><?php esc_html_e( 'by ', 'clcar' ); ?>
													<?php if ( $listing->can_add_user_link() && ! is_author() ) : ?>
														<a href="<?php echo esc_url( $listing->get_the_author_url() ); ?>"><?php $listing->the_author(); ?></a>
													<?php else : ?>
														<?php $listing->the_author(); ?>
													<?php endif; ?>
												</li>
											<?php } ?>
											<?php if ( $listing->has_location()  && $data['location_visibility'] ): ?>
												<li><i class="icon-location"></i><?php $listing->the_locations(); ?></li>
											<?php endif; ?>

											<?php if ( $data['date_visibility'] ): ?>
												<li class="updated"><i class="icon-calendar-1"></i><?php $listing->the_time(); ?></li>
											<?php endif; ?>

											<?php if ( $display['views'] ): ?>
												<li class="rt-views">
													<i class="icon-view"></i><?php echo esc_html( sprintf( _n( "%s view", "%s views", $listing->get_view_counts(), 'clcar-core' ),
														number_format_i18n( $listing->get_view_counts() ) ) ); ?>
												</li>
											<?php endif; ?>
										</ul>
										<?php if($display['content']){ ?>
											<div class="listing-excerpt">
												<?php
												$content = strip_shortcodes( wp_strip_all_tags( $listing->get_the_content() ) );
												$content = wp_trim_words( $content, $data['content_limit'], '' );
												echo wp_kses_post( $content );
												?>
											</div>
										<?php } ?>
										<?php
										    if( $custom_fields ) {
											    TemplateHooksPro::loop_item_listable_fields();
										    }
                                        ?>
									</div>
									
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php
if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
	?>
    <script>jQuery('.featuredContainer').isotope();</script>
	<?php
}

