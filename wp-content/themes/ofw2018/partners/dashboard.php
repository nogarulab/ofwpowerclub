<?php

if ( is_user_logged_in() && current_user_can('partner') ) :
$current_user = wp_get_current_user();
$current_user = wp_get_current_user();
$partner_page_id = get_user_meta( $current_user->ID, 'partner_page_id', true ); 
$post = get_post($partner_page_id); 
$slug = $post->post_name;
?>
	<div class="container">
		<h3>Hello <?php echo get_user_meta( $current_user->ID, 'first_name', true );  ?></h3>
		<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione</p>
		<div class="row">
			<div class="col-md-4">
				<a href="#">
					<h4>Search Member</h4>
					<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur.</p>
				</a>
			</div>
			<div class="col-md-4">
				<a href="<?php echo home_url(); ?>/partners/<?php echo $slug; ?>">
					<h4>View Your Page</h4>
					<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur.</p>
				</a>
			</div>
			<div class="col-md-4">
				<a href="#">
					<h4>Contact Administrator</h4>
					<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur.</p>
				</a>
			</div>
		</div>
	</div>

<?php

else :

    echo 'You do not have permission to view this page. Please login as a partner or wait until your account has been activated.';

endif;

?>