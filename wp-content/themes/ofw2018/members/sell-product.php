<?php

$current_user = wp_get_current_user();
$posttype = 'products';

$errors = array(); 

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	$files 						= $_FILES['product_photo'];
	$title 						= $_POST['product_name'];
	$content 					= $_POST['product_description'];
	$price 						= $_POST['product_price'];
	$product_category 			= $_POST['product_category'];
	$product_images 			= $_FILES['product_photo']['tmp_name'];

	if ( $title == '' )
	{
		$errors['title'] = "Product name cannot be empty.";
	}

	if ( $content == '' )
	{
		$errors['content'] = "Please provide product description.";
	}

	if ( $price == '' )
	{
		$errors['price'] = "You cannot sell without a product price.";
	}

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	if(count($product_images) == 0) {
    	$errors['product_images'] = "You need to upload atleast 1 product photo.";
    }

	if(0 === count($errors)) {  

		$addproduct = array(
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => 'private',
            'post_type'     => 'products'
        );
        $new_product = wp_insert_post($addproduct);
        $product = get_post($new_product);
        add_post_meta( $new_product, 'price', $price );
        add_post_meta( $new_product, '_product_images', 'field_5b41cd9a9a283' );
        add_post_meta( $new_product, 'status', 'Available' );
        wp_set_post_terms( $new_product, $product_category, 'prod_cat', false );

        $img_ids = [];
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
                    $img_ids[] = $newupload;
                }
            } 
        }

        add_post_meta( $new_product, 'product_images', $img_ids );

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
	
		<div class="form-row">
			<div class="form-group col-md-8">
				<label>Product Name</label>
				<input type="text" name="product_name" value="" placeholder="Product Name" class="form-control">
			</div>
			<div class="form-group col-md-4">
				<label>Product Price (HK Dollars)</label>
				<input type="text" name="product_price" value="" placeholder="Product Price" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label>Product Description</label>
			<textarea placeholder="Product Description" name="product_description" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label>Choose Product Category</label>
			<ul class="form-row">
	    	<?php
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
							echo '<li class="col-md-3"><input type="checkbox" name="product_category[]" value="'.$term->term_id.'"> '.$term->name.'</li>';
						}
					}
				}
	    	?>
	    	</ul>
		</div>
		<div class="form-group">
			<div class="form-check">
				<input class="form-check-input" name="product_category[]" type="checkbox" value="23" id="secondhand">
				<label class="form-check-label" for="secondhand">This product is second hand.</label>
			</div>
		</div>
		<div class="form-group">
			<h5>Add Product Photos</h5>
			<div class="product_photos incremental-item" data-itemhtml="<li class='item'><input type='file' name='product_photo[]' id='profile_picture' multiple='false' accept='image/*' /><span class='remove'>Remove</span></li>">
				<ul>
					<li class="item">
						<input type="file" name="product_photo[]" id="" multiple="false" accept="image/*" />
					</li>
				</ul>
				<span class="add btn btn-md btn-secondary">Add Another Photo</span>
			</div>
		</div>
	
	<div class="action"><input type="submit" id="submitbtn" name="submit" value="Sell This Product" class="float-right btn btn-primary btn-lg" /></div>
	<input type="hidden" name="post-type" id="post-type" value="<?php echo $posttype; ?>" />
	<input type="hidden" name="action" value="<?php echo $posttype; ?>" />
	<?php wp_nonce_field( 'submit_'.$posttype,'client_'.$posttype.'_nonce' ); ?>
</form>