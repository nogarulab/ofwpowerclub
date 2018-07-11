<form id="agent-change-password" action="" method="post" enctype="multipart/form-data" class="form-layout">
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