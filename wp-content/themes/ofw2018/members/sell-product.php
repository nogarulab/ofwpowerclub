<?php

$current_user = wp_get_current_user();
$post_meta = get_post_meta( 593 );
print_r($post_meta);

?>

<form>
	<div class="row">
		<div class="col-md-12 form-group">
			<label>Product Name</label>
			<input type="text" name="product_name" value="" placeholder="Product Name" class="form-control">
		</div>
		<div class="col-md-12 form-group">
			<label>Product Description</label>
			<textarea placeholder="Product Description" class="form-control"></texatea>
		</div>
	</div>
</form>