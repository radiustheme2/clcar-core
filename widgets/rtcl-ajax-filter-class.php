<?php

use Rtcl\Helpers\Functions;

if ( ! function_exists( 'render_ajax_filter_by_id' ) ) {

	/**
	 * Render an Ajax Filter by form ID
	 *
	 * @param string $form_id
	 * @return string
	 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

	function render_ajax_filter_by_id( $form_id ) {

		// Get all filter settings
		$filters = Functions::get_option( 'rtcl_filter_settings' );

		if ( empty( $filters ) || empty( $filters[ $form_id ] ) ) {
			return '<p>No filter form found.</p>';
		}

		$filterData = $filters[ $form_id ];
		$filterData['filter_id'] = $form_id;

		// Output buffer to return HTML
		ob_start();
		?>
        <div class="ajax-builder-filter-archive-main-wrapper">
            <div class="rtcl-widget-ajax-filter-wrapper" data-options="<?php echo esc_attr( wp_json_encode( $filterData ) ); ?>">

                <?php if ( function_exists('rtcl') && rtcl()->is_request('frontend') ): ?>
                    <div class="rtcl-ajax-filter-floating-mobile">
                        <h4><?php echo esc_html( apply_filters( 'rtcl_ajax_filter_off_canvas_title', __( 'Show Filter', 'classified-listing' ) ) ); ?></h4>
                        <div class="rtcl-ajax-filter-open-filter">
                            <svg class="filter-icon" width="32" height="21" viewBox="0 0 32 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 4.23184H17.2821C17.7312 5.71883 19.3727 6.82472 21.3241 6.82472C23.2756 6.82472 24.9171 5.71883 25.3662 4.23184H31C31.5523 4.23184 32 3.86493 32 3.41239C32 2.95985 31.5523 2.59294 31 2.59294H25.3661C24.9171 1.10595 23.2756 0 21.3241 0C19.3726 0 17.7311 1.10595 17.282 2.59294H1C0.44775 2.59294 0 2.95985 0 3.41239C0 3.86493 0.44775 4.23184 1 4.23184ZM21.3241 1.6389C22.5175 1.6389 23.4884 2.43448 23.4884 3.41234C23.4884 4.39025 22.5175 5.18583 21.3241 5.18583C20.1308 5.18583 19.1599 4.39025 19.1599 3.41234C19.1599 2.43448 20.1308 1.6389 21.3241 1.6389ZM1 11.3194H6.63387C7.083 12.8064 8.72444 13.9123 10.6759 13.9123C12.6274 13.9123 14.2689 12.8064 14.718 11.3194H31C31.5523 11.3194 32 10.9525 32 10.5C32 10.0475 31.5523 9.68055 31 9.68055H14.7179C14.2688 8.19356 12.6274 7.08761 10.6759 7.08761C8.72437 7.08761 7.08294 8.19356 6.63381 9.68055H1C0.44775 9.68055 0 10.0475 0 10.5C0 10.9525 0.447688 11.3194 1 11.3194ZM10.6759 8.72651C11.8692 8.72651 12.8401 9.52209 12.8401 10.5C12.8401 11.4779 11.8692 12.2734 10.6759 12.2734C9.4825 12.2734 8.51163 11.4779 8.51163 10.5C8.51163 9.52209 9.4825 8.72651 10.6759 8.72651ZM31 16.7682H25.3661C24.917 15.2812 23.2756 14.1752 21.3241 14.1752C19.3726 14.1752 17.7311 15.2812 17.282 16.7682H1C0.44775 16.7682 0 17.1351 0 17.5876C0 18.0402 0.44775 18.4071 1 18.4071H17.2821C17.7312 19.8941 19.3726 21 21.3241 21C23.2756 21 24.9171 19.8941 25.3662 18.4071H31C31.5523 18.4071 32 18.0402 32 17.5876C32 17.1351 31.5523 16.7682 31 16.7682ZM21.3241 19.3611C20.1308 19.3611 19.1599 18.5655 19.1599 17.5876C19.1599 16.6097 20.1308 15.8141 21.3241 15.8141C22.5175 15.8141 23.4884 16.6097 23.4884 17.5876C23.4884 18.5655 22.5175 19.3611 21.3241 19.3611Z"
                                        fill="white"/>
                            </svg>
                            <svg class="cross-icon" viewBox="0 0 10 10" width="1.5em" height="1.5em" stroke="currentColor" stroke-width="2">
                                <line x1="1" y1="1" x2="9" y2="9" />
                                <line x1="9" y1="1" x2="1" y2="9" />
                            </svg>
                            <?php $filter_widget_title = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] )
                                : esc_html__( 'Filters', 'classified-listing' ); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="ajax-builder-filter-wrapper-data">
                    <h4><?php esc_html_e('Filter', 'clcar' ); ?></h4>
                    <?php
                        // Use plugin's template loader
                        $ajaxFilterObj = new \Rtcl\Widgets\AjaxFilter();
                        Functions::get_template(
                            'widgets/ajax-filter',
                            [
                                'object'     => $ajaxFilterObj, // Null is fine for template
                                'filterData' => $filterData
                            ]
                        );
                    ?>
                </div>
            </div>
        </div>
		<?php
		return ob_get_clean();
	}
}
