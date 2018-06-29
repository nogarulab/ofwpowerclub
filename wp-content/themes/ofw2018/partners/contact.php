<?php
if ( is_user_logged_in() && current_user_can('partner') ) :
	$current_user = wp_get_current_user();
	echo '<div class="contact-admin" data-from="'.$current_user->display_name.'" data-email="'.$current_user->user_email.'">';
	echo do_shortcode('[contact-form-7 id="166" title="Contact Administrator"]');
	echo '</div>';
else :
	echo '<p>You do not have permission to use this form!</p>';
endif;
?>