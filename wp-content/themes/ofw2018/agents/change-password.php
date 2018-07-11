<?php

$current_user = wp_get_current_user();
$user_ID = $current_user->ID;

if ( isset( $_POST['update_user_nonce'], $current_user->ID ) && wp_verify_nonce( $_POST['update_user_nonce'], 'update_user' ) ) {
	$errors = array();
	if ($_POST['new_password'] != $_POST['repeat_password']) {
    	$errors['lastname'] = "Please make sure you repeat your password correctly.";
    }

    if (strlen($_POST['new_password']) > 1 && strlen($_POST['new_password']) < 8) {
    	$errors['lastname'] = "Password should be more than 8 characters";
    }
    if (0 === count($errors)) {
    	if (!empty($_POST['new_password']) && !empty($_POST['new_password'])) {
        	wp_update_user( array( 'ID' => $user_ID, 'user_pass' => esc_attr( $_POST['new_password'] ) ) );
        }
        echo 'You have successfully changed your password.';
    } else {
    	echo '<ul>';
		foreach ($errors as $error) {
			echo '<li>'.$error.'</li>'; 
		}
		echo '</ul>';
    }
}

?>

<form id="agent-change-password" action="" method="post" enctype="multipart/form-data" class="form-layout">
	<hr>
	<h4>Change Password</h4>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="inputPassword">New Password</label>
			<input type="password" value="" name="new_password" id="inputPassword" class="form-control" />
		</div>
		<div class="form-group col-md-6">
			<label for="inputRPassword">New Password</label>
			<input type="password" value="" name="repeat_password" id="inputRPassword" class="form-control" />
		</div>
	</div>
	<div class="action text-right">
		<a href="<?php echo home_url(); ?>/agent-dashboard">Cancel</a>
		<input name="updateuser" type="submit" id="updateuser" class="nbtn primary" value="<?php _e('Change', 'password'); ?>" />
	</div>
	<?php wp_nonce_field( 'update_user', 'update_user_nonce' ); ?>
    <input name="action" type="hidden" id="action" value="update_user" />
</form>