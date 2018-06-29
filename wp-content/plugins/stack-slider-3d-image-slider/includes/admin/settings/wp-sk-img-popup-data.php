<?php
/**
 * Popup Image Data HTML
 *
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$prefix = WP_SK_META_PREFIX;

// Taking some values
$alt_text 			= get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
$attachment_link 	= get_post_meta( $attachment_id, $prefix.'attachment_link', true );
?>

<div class="wp-sk-popup-title"><?php _e('Edit Image', 'stack-slider-a-3d-imageslider'); ?></div>
	
<div class="wp-sk-popup-body">

	<form method="post" class="wp-sk-attachment-form">
		
		<?php if( !empty($attachment_post->guid) ) { ?>
		<div class="wp-sk-popup-img-preview">
			<img src="<?php echo $attachment_post->guid; ?>" alt="" />
		</div>
		<?php } ?>
		<a href="<?php echo get_edit_post_link( $attachment_id ); ?>" target="_blank" class="button right"><i class="dashicons dashicons-edit"></i> <?php _e('Edit Image From Attachment Page', ' stack-slider-a-3d-imageslider'); ?></a>

		<table class="form-table">
			<tr>
				<th><label for="wp-sk-attachment-title"><?php _e('Title', ' stack-slider-a-3d-imageslider'); ?>:</label></th>
				<td>
					<input type="text" name="wp_sk_attachment_title" value="<?php echo wp_sk_esc_attr($attachment_post->post_title); ?>" class="large-text wp-sk-attachment-title" id="wp-sk-attachment-title" />
					<span class="description"><?php _e('Enter image title.', ' stack-slider-a-3d-imageslider'); ?></span>
				</td>
			</tr>		

			<tr>
				<td colspan="2" align="right">
					<div class="wp-sk-success wp-sk-hide"></div>
					<div class="wp-sk-error wp-sk-hide"></div>
					<span class="spinner wp-sk-spinner"></span>
					<button type="button" class="button button-primary wp-sk-save-attachment-data" data-id="<?php echo $attachment_id; ?>"><i class="dashicons dashicons-yes"></i> <?php _e('Save Changes', ' stack-slider-a-3d-imageslider'); ?></button>
					<button type="button" class="button wp-sk-popup-close"><?php _e('Close', ' stack-slider-a-3d-imageslider'); ?></button>
				</td>
			</tr>
		</table>
	</form><!-- end .wp-sk-attachment-form -->

</div><!-- end .wp-sk-popup-body -->