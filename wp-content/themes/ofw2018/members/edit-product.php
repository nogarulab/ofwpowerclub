<?php get_header(); ?>

<div class="container edit-product">

<?php

global $wp;
$current_url = home_url(add_query_arg(array(),$wp->request));

if (isset($_GET['edit']) == true) {
	$current_user = wp_get_current_user();
	//$member = MS_Factory::load( 'MS_Model_Member', $current_user->ID );
	$member = MS_Model_Member::get_current_member();
	
	$user_status = '';
	foreach ( $member->subscriptions as $subscription ) {
	    $status = $subscription->get_status();
	    $user_status = $status;
	}

	if ($user_status != '') {
		$prod_name = $post->post_title;
		$product_status = get_post_meta($post->ID, 'status', true);
		$productimgs = get_post_meta($post->ID, 'product_images', true);
		$posttype = 'products';

		$prodids = [];
		$produrls = [];
		foreach($productimgs as $productimg) {
			$c = get_post($productimg);
			$produrls[] = $c->guid;
			$prodids[] = $c->ID;
		}
		$noofimgs = count($produrls);

		$errors = array();

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

			$files 						= $_FILES['product_photo'];
			$title 						= $_POST['product_name'];
			$product_sold 				= $_POST['product_sold'];
			$content 					= $_POST['product_description'];
			$price 						= $_POST['product_price'];
			$product_category 			= $_POST['product_category'];
			$product_images 			= $_FILES['product_photo']['tmp_name'];

			if ( $title == '' ) {
				$errors['title'] = "Product name cannot be empty.";
			}

			if ( $content == '' ) {
				$errors['content'] = "Please provide product description.";
			}

			if ( $price == '' ) {
				$errors['price'] = "You cannot sell without a product price.";
			}

			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		    require_once(ABSPATH . "wp-admin" . '/includes/media.php');

			$prodimgs_cntr = 0;

		    foreach($product_images as $product_image) {
		    	if ($product_image == '') {
		    		$prodimgs_cntr = $prodimgs_cntr+1;
		    	} else {
		    		$prodimgs_cntr = $prodimgs_cntr+0;
		    	}
		    } 

		    if ($prodimgs_cntr == 6) {
		    	$errors['product_images'] = "You need to upload atleast 1 product photo.";
		    }

			if(0 === count($errors)) {

				wp_update_post(
	    			array(
	    				'ID' => $post->ID, 
	    				'post_title' => $title,
	    				'post_content' => $content
	    			)
	    		);
	    		update_post_meta( $post->ID, 'price', $price );
	    		update_post_meta( $post->ID, 'status', $product_sold );
	    		wp_set_post_terms( $post->ID, $product_category, 'prod_cat' );

	    		$files = $_FILES["product_photo"];
			    foreach ($files['name'] as $key => $value) {           
		            if ($files['name'][$key]) { 
		                $file = array( 
		                    'name' => $files['name'][$key],
		                    'type' => $files['type'][$key], 
		                    'tmp_name' => $files['tmp_name'][$key], 
		                    'error' => $files['error'][$key],
		                    'size' => $files['size'][$key]
		                ); 
		                $_FILES = array ("product_photo" => $file); 
		                foreach ($_FILES as $file => $array) {
		                	$newupload = media_handle_upload('product_photo',$new_product);
		                	add_post_meta( $new_product, '_thumbnail_id', $newupload);        
		                    array_push($prodids, $newupload);
		                }
		            } 
		        }

		        update_post_meta( $post->ID, 'product_images', $prodids );
		        $ctr = 0;
		        foreach($prodids as $prodid) {
		        	$ctr++;
		        	if ($ctr==1) {
		        		update_post_meta( $post->ID, '_thumbnail_id', $prodid);
		        	}
		        }

		        echo "<div class='success'><h5>You have successfully added your product</h5><p>Please wait for our staff to approve your product.</p></div>";
	    		
			} else {
				
				echo '<ul class="errors">';
		    	foreach ($errors as $error) {
		    		echo "<li>".$error."</li>";
		    	}
		    	echo '</ul>';
			}

		}
?>

		
		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
			<header>
				<h2>Edit Product: <?php echo $prod_name; ?></h2>
				<span class="form-check">
					<input class="form-check-input" name="product_sold" type="checkbox" value="Sold" id="sold" <?php echo ($product_status == 'Sold') ? 'checked="checked"' : '' ?>>
					<label class="form-check-label" for="sold">This product is already sold.</label>
				</span>
			</header>
			<div class="form-row">
				<div class="form-group col-md-8">
					<label>Product Name</label>
					<input type="text" name="product_name" value="<?php echo $post->post_title ?>" placeholder="Product Name" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<label>Product Price (HK Dollars)</label>
					<input type="text" name="product_price" value="<?php the_field('price'); ?>" placeholder="Product Price" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label>Product Description</label>
				<textarea placeholder="Product Description" name="product_description" class="form-control">
					<?php echo $post->post_content; ?>
				</textarea>
			</div>
			<div class="form-group">
				<label>Choose Product Category</label>
				<ul class="form-row">
		    	<?php

		    		$selected_terms = get_the_terms( $post->ID, 'prod_cat' );
		    		
		    		$selected_terms_array=[];
		    		foreach ($selected_terms as $selected_term) {
		    			$selected_terms_array[] = $selected_term->term_id;
		    		}

		    		$terms = get_terms( array(
					    'taxonomy' => 'prod_cat',
					    'hide_empty' => false
					) );

					$terms_parents = [];

					foreach ($terms as $term) {
						if ($term->parent != 0) {
							if (!in_array($term->parent, $terms_parents)) {
								$terms_parents[] = $term->parent;
							}
						}
					}
					
					foreach ($terms as $term) {
						if ($term->name != 'Preloved') {
							if (!in_array($term->term_id, $terms_parents)) {
								echo '<li class="col-md-3"><input '.(in_array($term->term_id, $selected_terms_array) ? 'checked="checked"' : '' ).' type="checkbox" name="product_category[]" value="'.$term->term_id.'"> '.$term->name.'</li>';
							}
						}
					}
		    	?>
		    	</ul>
			</div>
			<div class="form-group">
				<div class="form-check">
					<input class="form-check-input" name="product_category[]" type="checkbox" value="23" id="secondhand" <?php echo (in_array(23, $selected_terms_array) ? 'checked="checked"' : '' );  ?>>
					<label class="form-check-label" for="secondhand">This product is second hand.</label>
				</div>
			</div>
			<div class="form-group">
				<h5>Add Product Photos</h5>
				<p>Please bear in mind that the first photo you choose will serve as the featured image. You can also upload up to six photos of your product.</p>
				<div class="product_photos">
					<ul class="row">
						<?php
						if ($noofimgs == 1) {	
							echo '<li class="item col-md-2"><div class="productimgs"><img src="'.$produrls[0].'" alt="" /></div></li>';
							for ($i=0;$i<5;$i++) {
								echo '<li class="item col-md-2"><div class="productimgs"><img src="'.get_template_directory_uri().'/img/upload-product-photo.gif" alt="" /><input type="file" name="product_photo[]" id="" multiple="false" accept="image/*" /></div></li>';
							}
						} else {
							for ($i=0;$i<6;$i++) {
								if ($i < $noofimgs) {
									echo '<li class="item col-md-2"><div class="productimgs"><img src="'.$produrls[$i].'" alt="" /><span class="deletepost" data-toggle="modal" data-currenturl="'.$current_url.'?edit=true&id='.$prodids[$i].'" data-target="#deleteImgConfirmation">x</span></div></li>';
								} else {
									echo '<li class="item col-md-2"><div class="productimgs"><img src="'.get_template_directory_uri().'/img/upload-product-photo.gif" alt="" /><input type="file" name="product_photo[]" id="" multiple="false" accept="image/*" /></div></li>';
								}
							}
						}

						?>
					</ul>
				</div>
			</div>
			<div class="action clearfix"><input type="submit" id="submitbtn" name="submit" value="Update Product Info" class="float-right btn btn-primary btn-lg" /></div>
			<input type="hidden" name="post-type" id="post-type" value="<?php echo $posttype; ?>" />
			<input type="hidden" name="action" value="<?php echo $posttype; ?>" />
			<?php wp_nonce_field( 'submit_'.$posttype,'client_'.$posttype.'_nonce' ); ?>
		</form>

		<div class="modal delete_an_item fade" id="deleteImgConfirmation" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this photo?</h5>
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
		if (isset($_GET['id'])) {
			$post_id = $post->ID;
	    	$delete_id = $_GET['id'];
			delete_post($delete_id, $post_id);
			echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$current_url.'?edit=true">';
		}
		?>

	</div>

<?php

	} else {
		echo 'You cannot access this page because it is either you are not yet a member or your membership is expired!';
	}

} else {

?>
 
 <p>Test 123</p>

<?php 
}

get_footer();
?>