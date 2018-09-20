<div class="mb-5"><a href="<?php echo home_url(); ?>/sell-product" class="btn btn-primary btn-md">Sell A Product</a></div>

<?php

global $wp;
$current_url = home_url(add_query_arg(array(),$wp->request));
$current_user = wp_get_current_user();

$args = array(
	'post_type' 	=> 'products',
	'author' 		=> $current_user->ID,
	'post_status'   => array('pending', 'publish'),
	'post_per_page' => -1
);

$products = new WP_Query( $args );

if ($products->have_posts()):

?>
<div class="table-responsive-md">
	<table class="table table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Product Name</th>
				<th scope="col">Price</th>
				<th scope="col">Availability</th>
				<th scope="col">Status</th>
				<th scope="col">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php

			
				while ($products->have_posts()) :
					$products->the_post();

					$sold = get_field('status');
					
			?>
					<tr>
						<th>
							<?php if ($post->post_status == 'publish') { ?> 
								<a href="<?php echo home_url().'?post_type=products&p='.$post->ID.'&preview=true';?>">
							<?php } else { ?> 
								<a href="<?php the_permalink(); ?>"></a>
							<?php } ?>
							<?php 
								if ($sold == 'Sold') {
									echo '<em class="text-danger">*Sold</em> - ';
								}
								echo $post->post_title;
							?>
							</a>
						</th>
						<td><?php the_field('price'); ?></td>
						<td><?php the_field('status'); ?></td>
						<td>
							<?php
							$post_status = $post->post_status;
							if ($post_status == 'pending') {
								$post_status = 'For Approval';
							} else if ($post_status == 'publish') {
								$post_status = 'Approved';
							}

							echo $post_status;
							?>
						</td>
						<td>
							<?php if ($post->post_status == 'publish') { ?>
								<a href="<?php the_permalink(); ?>?edit=true">Edit</a>
							<?php } ?>
							<a href="#" class="deletepost" data-toggle="modal" data-currenturl="<?php echo $current_url.'?id='.$post->ID; ?>" data-target="#deleteProdConfirmation">Delete</a>
						</td>
					</tr>
			<?php

				endwhile;

			?>
		</tbody>
	</table>
</div>

<div class="modal delete_an_item fade" id="deleteProdConfirmation" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this product?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<a href="#" class="confirm btn btn-primary btn-md">Yes</a>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<?php

	if (isset($_GET['id'])) :
		$post_id = $post->ID;
		delete_product_post($post_id);
		echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$current_url.'">';
	endif;

else :

	echo '<p>No products to sell!</p>';

endif;
?>