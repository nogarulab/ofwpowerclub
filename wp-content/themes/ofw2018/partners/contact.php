<div class="user-dashboard-home">
	<header>
		<h3>Contact Administrator</h3>
		<p>Verify customers if they are OFW Power Club members by searching them here. Please enter full name or email address.</p>
	</header>
<?php
if ( is_user_logged_in() && current_user_can('partner') ) :
	$current_user = wp_get_current_user();
	echo '<div class="contact-admin" data-from="'.$current_user->display_name.'" data-email="'.$current_user->user_email.'">';
	echo do_shortcode('[contact-form-7 id="166" title="Contact Administrator"]');
	echo '</div>';
else :
	echo '<div class="no-permission">You do not have permission to use this form!</div>';
endif;
?>
</div>