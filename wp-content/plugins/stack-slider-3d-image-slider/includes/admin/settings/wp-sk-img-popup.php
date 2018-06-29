<?php
/**
 * Image Data Popup
 *
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wp-sk-img-data-wrp wp-sk-hide">
	<div class="wp-sk-img-data-cnt">

		<div class="wp-sk-img-cnt-block">
			<div class="wp-sk-popup-close wp-sk-popup-close-wrp"><img src="<?php echo WP_SK_URL; ?>assets/images/close.png" alt="<?php _e('Close (Esc)', 'swiper-slider-and-carousel'); ?>" title="<?php _e('Close (Esc)', 'swiper-slider-and-carousel'); ?>" /></div>

			<div class="wp-sk-popup-body-wrp">
			</div><!-- end .wp-sk-popup-body-wrp -->
			
			<div class="wp-sk-img-loader"><?php _e('Please Wait', 'stack-slider-a-3d-imageslider'); ?> <span class="spinner"></span></div>

		</div><!-- end .wp-sk-img-cnt-block -->

	</div><!-- end .wp-sk-img-data-cnt -->
</div><!-- end .wp-sk-img-data-wrp -->
<div class="wp-sk-popup-overlay"></div>