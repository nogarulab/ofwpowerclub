<?php
if ( is_user_logged_in() && current_user_can('partner') ) :
	echo do_shortcode('[contact-form-7 id="166" title="Contact Administrator"]');
else :
	echo '<p>You do not have permission to use this form!</p>';
endif;
?>