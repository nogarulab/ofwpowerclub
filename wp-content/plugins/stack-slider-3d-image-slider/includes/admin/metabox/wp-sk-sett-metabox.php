<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WP_SK_META_PREFIX; // Metabox prefix

$gallery_imgs 	= get_post_meta( $post->ID, $prefix.'gallery_id', true );
$no_img_cls		= !empty($gallery_imgs) ? 'wp-sk-hide' : '';
?>

<table class="form-table wp-sk-post-sett-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="wp-sk-gallery-imgs"><?php _e('Choose Gallery Images', 'stack-slider-a-3d-imageslider'); ?></label>
			</th>
			<td>
				<button type="button" class="button button-secondary wp-sk-img-uploader" id="wp-sk-gallery-imgs" data-multiple="true" data-button-text="<?php _e('Add to Gallery', 'stack-slider-a-3d-imageslider'); ?>" data-title="<?php _e('Add Images to Gallery', 'stack-slider-a-3d-imageslider'); ?>"><i class="dashicons dashicons-format-gallery"></i> <?php _e('Gallery Images', 'stack-slider-a-3d-imageslider'); ?></button>
				<button type="button" class="button button-secondary wp-sk-del-gallery-imgs"><i class="dashicons dashicons-trash"></i> <?php _e('Remove Gallery Images', 'stack-slider-a-3d-imageslider'); ?></button><br/>
				
				<div class="wp-sk-gallery-imgs-prev wp-sk-imgs-preview wp-sk-gallery-imgs-wrp">
					<?php if( !empty($gallery_imgs) ) {
						foreach ($gallery_imgs as $img_key => $img_data) {

							$attachment_url 		= wp_get_attachment_thumb_url( $img_data );
							$attachment_edit_link	= get_edit_post_link( $img_data );
					?>
							<div class="wp-sk-img-wrp">
								<div class="wp-sk-img-tools wp-sk-hide">
									<span class="wp-sk-tool-icon wp-sk-edit-img dashicons dashicons-edit" title="<?php _e('Edit Image in Popup', 'stack-slider-a-3d-imageslider'); ?>"></span>
									<a href="<?php echo $attachment_edit_link; ?>" target="_blank" title="<?php _e('Edit Image', 'stack-slider-a-3d-imageslider'); ?>"><span class="wp-sk-tool-icon wp-sk-edit-attachment dashicons dashicons-visibility"></span></a>
									<span class="wp-sk-tool-icon wp-sk-del-tool wp-sk-del-img dashicons dashicons-no" title="<?php _e('Remove Image', 'stack-slider-a-3d-imageslider'); ?>"></span>
								</div>
								<img class="wp-sk-img" src="<?php echo $attachment_url; ?>" alt="" />
								<input type="hidden" class="wp-sk-attachment-no" name="wp_sk_img[]" value="<?php echo $img_data; ?>" />
							</div><!-- end .wp-sk-img-wrp -->
					<?php }
					} ?>
					
					<p class="wp-sk-img-placeholder <?php echo $no_img_cls; ?>"><?php _e('No Gallery Images', 'stack-slider-a-3d-imageslider'); ?></p>

				</div><!-- end .wp-sk-imgs-preview -->
				<span class="description"><?php _e('Choose your desired images for gallery. Hold Ctrl key to select multiple images at a time.', 'stack-slider-a-3d-imageslider'); ?></span>
			</td>
		</tr>
	</tbody>
</table><!-- end .wtwp-tstmnl-table -->