<?php

	$current_user = wp_get_current_user();
	$profileimg = get_field('profile_picture', 'user_'.$current_user->ID);
	$user_ID = $current_user->ID;

	if (!$profileimg) :
		$profileimg = get_template_directory_uri().'/img/no-profile-pic.png';
	endif;

	$errors = array();

	if (empty($_POST['firstname'])) {
    	$errors['firstname'] = "Please provide your first name so that we can address you properly.";
    }

    if (empty($_POST['middlename'])) {
    	$errors['middlename'] = "Please provide your middle name so that we can address you properly.";
    }

    if (empty($_POST['lastname'])) {
    	$errors['lastname'] = "Please provide your last name so that we can address you properly.";
    }

	if ( isset( $_POST['update_user_nonce'], $current_user->ID ) && wp_verify_nonce( $_POST['update_user_nonce'], 'update_user' ) ) {

		if (0 === count($errors)) {
			update_user_meta( $user_ID, 'first_name', $_POST['firstname'] );
			update_user_meta( $user_ID, 'middle_name', $_POST['middlename'] );
			update_user_meta( $user_ID, 'last_name', $_POST['lastname'] );

			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	        
	        $attachment_id = media_handle_upload( 'profile_picture', $user_ID );
	        update_user_meta( $user_ID, 'profile_picture', $attachment_id );



		}

	}

?>


<div class="container">
	<form id="edit_profile_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-3">
				
				<div class="profile-picture">
					<div class="updatephoto">
						<img class="profile-photo" id="profile_photo" src="<?php echo $profileimg; ?>" alt="" />
						<input type="file" name="profile_picture" id="profile_picture"  multiple="false" accept="image/gif, image/jpeg, image/png" />
					</div>
				</div>
				
			</div>
			<div class="col-md-9">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="inputFirstname">First Name</label>
						<input type="text" value="<?php the_author_meta( 'first_name', $user_ID ); ?>" name="firstname" id="inputFirstname" class="form-control" />
					</div>
					<div class="form-group col-md-4">
						<label for="inputMiddlename">Middle Name</label>
						<input type="text" value="<?php the_author_meta( 'middle_name', $user_ID ); ?>" name="middlename" id="inputMiddlename" class="form-control" />
					</div>
					<div class="form-group col-md-4">
						<label for="inputLastname">Last Name</label>
						<input type="text" value="<?php the_author_meta( 'last_name', $user_ID ); ?>" name="lastname" id="inputLastname" class="form-control" />
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="inputGender">Gender</label>
						<?php 
							$gender = get_user_meta( $user_ID, 'gender', true );
							$gender_lists = array('Male', 'Female');
						?>
						<select name="gender" id="inputGender" class="form-control">
							<?php foreach ($gender_lists as $gender_list) { ?>
								<option <?php echo ($gender == $gender_list) ? 'selected="selected"' : '' ;?>><?php echo $gender_list; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="inputBirthday">Birthday</label>
						<input type="text" value="<?php the_author_meta( 'birthday', $user_ID ); ?>" name="birthday" id="inputBirthday" class="form-control" />
					</div>
					<div class="form-group col-md-4">
						<label for="inputContactnumber">Contact Number</label>
						<input type="text" value="<?php the_author_meta( 'contact_number', $user_ID ); ?>" name="contact_number" id="inputContactnumber" class="form-control" />
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputCountry">Country Of Work</label>
						<select name="country" id="inputCountry" class="form-control">
							<option>Hong Kong</option>
							<option>Macau</option>
							<option>China</option>
						</select>
					</div>
					<div class="form-group col-md-6">
						<label for="inputHKID">Hong Kong ID Number / Passport Number</label>
						<input type="text" value="<?php the_author_meta( 'hk_id_number', $user_ID ); ?>" name="hk_id_number" id="inputHKID" class="form-control" />
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputAddress">Address In Hong Kong/Place Of Work</label>
						<input type="text" value="<?php the_author_meta( 'address', $user_ID ); ?>" name="address" id="inputAddress" class="form-control" />
					</div>
				</div>
				<hr />
			</div>
		</div>
		<input name="updateuser" type="submit" id="updateuser" class="nbtn primary" value="<?php _e('Update', 'profile'); ?>" />
		<?php wp_nonce_field( 'update_user', 'update_user_nonce' ); ?>
        <input name="action" type="hidden" id="action" value="update_user" />
	</form>
</div>