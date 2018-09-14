<?php

$current_user = wp_get_current_user();
$post_meta = get_post_meta( 593 );
print_r($post_meta);

$files = $_FILES['image'];
foreach ($files['name'] as $key => $value) {
  if ($files['name'][$key]) {
    $file = array(
      'name'     => $files['name'][$key],
      'type'     => $files['type'][$key],
      'tmp_name' => $files['tmp_name'][$key],
      'error'    => $files['error'][$key],
      'size'     => $files['size'][$key]
    );
    wp_handle_upload($file);
  }
}

?>

<form>
	<div class="row">
		<div class="col-md-12 form-group">
			<label>Product Name</label>
			<input type="text" name="product_name" value="" placeholder="Product Name" class="form-control">
		</div>
		<div class="col-md-12 form-group">
			<label>Product Description</label>
			<textarea placeholder="Product Description" name="product_description" class="form-control"></textarea>
		</div>
		<div class="col-md-12 form-group">
			<h5>Add Product Photos</h5>
			<div class="product_photos incremental-item" data-itemhtml="<li><input type='file' name='product_photo[]' id='profile_picture' multiple='false' accept='image/*' /><span class='remove'>Remove</span></li>">
				<ul>
					<li class="item">
						<input type="file" name="product_photo[]" id="profile_picture" multiple="false" accept="image/*" />
					</li>
				</ul>
				<span class="add btn btn-md btn-secondary">Add Another Photo</span>
			</div>
		</div>
	</div>
</form>