<?php

if ( is_user_logged_in() && current_user_can('partner') ) :
	$current_user = wp_get_current_user();
	$current_user = wp_get_current_user();
	$partner_page_id = get_user_meta( $current_user->ID, 'partner_page_id', true ); 
	$post = get_post($partner_page_id); 
	$slug = $post->post_name;
?>
	<div class="user-dashboard-home">
		<header>
			<h3>Hello <?php echo get_user_meta( $current_user->ID, 'first_name', true );  ?>!</h3>
			<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione</p>
		</header>
		<div class="row tools">
			<div class="col-lg-4">
				<a href="<?php echo home_url(); ?>/member-search">
					<h5>Search Member</h5>
					<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur.</p>
				</a>
			</div>
			<div class="col-lg-4">
				<a href="<?php echo home_url(); ?>/partners/<?php echo $slug; ?>" target="_blank">
					<h5>View Your Page</h5>
					<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur.</p>
				</a>
			</div>
			<div class="col-lg-4">
				<a href="<?php echo home_url(); ?>/contact-administrator">
					<h5>Contact Admin</h5>
					<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur.</p>
				</a>
			</div>
		</div>
		<?php get_template_part( 'agents/change-password', get_post_format() ); ?>
	</div>

<?php

else :

    echo '<div class="no-permission">You do not have permission to view this page. Please login as a partner or wait until your account has been activated.</div>';

endif;

?>