<?php 
$current_user = wp_get_current_user();
$partner_page_id = get_user_meta( $current_user->ID, 'partner_page_id', true ); 
$post = get_post($partner_page_id); 
$slug = $post->post_name;
?>
<div class="partner-dashboard-menu">
	<ul>
		<li><a href="<?php echo home_url(); ?>/partner-dashboard">Dashboard</a></li>
		<li><a href="<?php echo home_url(); ?>/member-search">Search Member</a></li>
		<!-- <li><a href="<?php echo home_url(); ?>/partners/<?php echo $slug; ?>" target="_blank">View Your Page</a></li> -->
		<li><a href="<?php echo home_url(); ?>/contact-administrator">Contact Admin</a></li>
		<li><a href="<?php echo home_url(); ?>/partner-dashboard?showform=1#changepass" class="change-pass"">Change Password</a></li>
		<li><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
	</ul>
</div>