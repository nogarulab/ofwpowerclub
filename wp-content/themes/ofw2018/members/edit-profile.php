<div class="container">

	<?php

	if ( is_user_logged_in() && current_user_can( 'subscriber' ) ) :

		$current_user = wp_get_current_user();
		$profileimg = get_field('profile_picture', 'user_'.$current_user->ID);

		// $bdate = get_user_meta($user_ID, 'birthday', true);
		// $bdate 	= new DateTime($bdate);
		// $byear 	= $bdate->format('Y');
		// $bmonth	= $bdate->format('n');
		// $bday 	= $bdate->format('j');


		// if (isset($_POST['e_month'])) {
		// 	$b_month = $_POST['b_month'];
		// } else {
		// 	$b_month = $bmonth;
		// }

		// if (isset($_POST['e_day'])) {
		// 	$b_day = $_POST['b_day'];
		// } else {
		// 	$b_day = $bday;
		// }

		// if (isset($_POST['e_year'])) {
		// 	$b_year = $_POST['b_year'];
		// } else {
		// 	$b_year = $byear;
		// }

		// $birthdate = $bmonth.'-'.$bday.'-'.$byear;
		// echo $birthdate.'<br>';
		// $date = DateTime::createFromFormat('m-j-Y', $birthdate);
		// $birthdate_formated = $date->format('Ymd');
		// echo $birthdate_formated;

		// $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		
		$user_ID = $current_user->ID;

		if (!$profileimg) :
			$profileimg = get_template_directory_uri().'/img/no-profile-pic.png';
		endif;

		if ( isset( $_POST['update_user_nonce'], $current_user->ID ) && wp_verify_nonce( $_POST['update_user_nonce'], 'update_user' ) ) {

			$firstname = $_POST['firstname'];

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

			if ($_POST['new_password'] != $_POST['repeat_password']) {
		    	$errors['lastname'] = "Please make sure you repeat your password correctly.";
		    }

		    if (strlen($_POST['new_password']) > 1 && strlen($_POST['new_password']) < 8) {
		    	$errors['lastname'] = "Password should be more than 8 characters";
		    }

			if (0 === count($errors)) {
				update_user_meta( $user_ID, 'first_name', $_POST['firstname'] );
				update_user_meta( $user_ID, 'middle_name', $_POST['middlename'] );
				update_user_meta( $user_ID, 'last_name', $_POST['lastname'] );
				update_user_meta( $user_ID, 'contact_number', $_POST['contact_number'] );
				update_user_meta( $user_ID, 'gender', $_POST['gender'] );
				update_user_meta( $user_ID, 'birthday_year', $_POST['e_year'] );
				update_user_meta( $user_ID, 'birthday_day', $_POST['e_day'] );
				update_user_meta( $user_ID, 'birthday_month', $_POST['e_month'] );
            	update_user_meta( $user_ID, 'country', $_POST['e_country'] );
				update_user_meta( $user_ID, 'hk_id_number', $_POST['hk_id_number'] );
				update_user_meta( $user_ID, 'address', $_POST['address'] );
				update_user_meta( $user_ID, 'beneficiary_name', $_POST['beneficiary_name'] );
				update_user_meta( $user_ID, 'beneficiary_contactnumber', $_POST['beneficiary_contactnumber'] );
				update_user_meta( $user_ID, 'relationship_with_beneficiary', $_POST['relationship_with_beneficiary'] );
				update_user_meta( $user_ID, 'beneficiary_address', $_POST['beneficiary_address'] );

				require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		        
		        $attachment_id = media_handle_upload( 'profile_picture', $user_ID );
		        if (!empty($attachment_id) && !is_wp_error( $attachment_id )) {
		        	update_user_meta( $user_ID, 'profile_picture', $attachment_id );
		        }

		        if (!empty($_POST['new_password']) && !empty($_POST['new_password'])) {
		        	wp_update_user( array( 'ID' => $user_ID, 'user_pass' => esc_attr( $_POST['new_password'] ) ) );
		        }

		        echo 'You have successfully edited your profile. <a href="'.home_url().'/account">Back To My Account</a>';
		        exit;

			} else {
				echo '<ul>';
				foreach ($errors as $error) {
					echo '<li>'.$error.'</li>'; 
				}
				echo '</ul>';
			}

		}

	?>

	<form id="edit_profile_form" action="" method="post" enctype="multipart/form-data" class="form-layout">
		<div class="row">
			<div class="col-lg-3">
				
				<div class="profile-picture">
					<div class="updatephoto">
						<img class="profile-photo" id="profile_photo" src="<?php echo $profileimg; ?>" alt="" />
						<input type="file" name="profile_picture" id="profile_picture"  multiple="false" accept="image/gif, image/jpeg, image/png" />
						<div class="upload-text">Upload Profile Picture</div>
					</div>
					<div class="details">
						<p><strong>Username:</strong> <?php echo $current_user->user_login; ?></p>
						<p><strong>Email Address:</strong> <?php echo $current_user->user_email; ?></p>
						<p><strong>Card ID Number:</strong> <?php echo get_user_meta($user_ID, 'id_number', true); ?></p>
					</div>
				</div>
				
			</div>
			<div class="col-lg-9">
				<h4>Personal Information</h4>
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
					<div class="col-md-8">
						<label for="inputBirthday">Birthday</label>
						<div class="form-row">
							<div class="form-group col-md-6">
								<select name="e_month" class="form-control">
									<?php 
									$b_month = get_user_meta( $user_ID, 'birthday_month', true );
									$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
									foreach ($months as $month) {
									?>
									<option <?php echo ($b_month == $month) ? 'selected="selected"' : ''; ?> value="<?php echo $month; ?>"><?php echo $month; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-3">
								<select name="e_day" class="form-control">
									<?php
									$b_day = get_user_meta( $user_ID, 'birthday_day', true );
									$d_counter = 0;
									$d_counter_value = 0;
									for ($i=1; $i<=31; $i++) {
										$d_counter++;
										$d_counter_value++;
										if ($d_counter < 10) {
											$d_counter = '0'.$d_counter;
										}
									?>
											<option <?php echo ($b_day == $i) ? 'selected="selected"' : ''; ?> value="<?php echo $d_counter_value; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-3">
								<select name="e_year" class="form-control">
									<?php 
									$b_year = get_user_meta( $user_ID, 'birthday_year', true );
									for ($i=1940; $i<=(date('Y')-10); $i++) {
									?>
									<option <?php echo ($b_year == $i) ? 'selected="selected"' : ''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="inputContactnumber">Contact Number</label>
						<input type="text" value="<?php the_author_meta( 'contact_number', $user_ID ); ?>" name="contact_number" id="inputContactnumber" class="form-control" />
					</div>
					<div class="form-group col-md-4">
						<label for="inputCountry">Country Of Work</label>
						<select name="e_country" id="inputCountry" class="form-control">
							<?php
							$chosen_country = get_user_meta($user_ID, 'country', true);
							$fields = get_field_object('field_5b3de51a64f76');
							$choices = $fields['choices'];
							foreach($choices as $choice):
							?>
								<option <?php echo ($chosen_country == $choice) ? 'selected="selected"' : ''; ?> value="<?php echo $choice; ?>"><?php echo $choice; ?></option>
							<?php
							endforeach;
							?>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="inputHKID">HK ID Number / Passport Number</label>
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
				<h4>Your Beneficiary</h4>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="inputBName">Name Of Beneficiary</label>
						<input type="text" value="<?php the_author_meta( 'beneficiary_name', $user_ID ); ?>" name="beneficiary_name" id="inputBName" class="form-control" />
					</div>
					<div class="form-group col-md-4">
						<label for="inputBContactnumber">Contact Number Of Beneficiary</label>
						<input type="text" value="<?php the_author_meta( 'beneficiary_contactnumber', $user_ID ); ?>" name="beneficiary_contactnumber" id="inputBContactnumber" class="form-control" />
					</div>
					<div class="form-group col-md-4">
						<label for="inputBRelationship">Relationship With Beneficiary</label>
						<input type="text" value="<?php the_author_meta( 'relationship_with_beneficiary', $user_ID ); ?>" name="relationship_with_beneficiary" id="inputBRelationship" class="form-control" />
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputBAddress">Address Of Beneficiary</label>
						<input type="text" value="<?php the_author_meta( 'beneficiary_address', $user_ID ); ?>" name="beneficiary_address" id="inputBAddress" class="form-control" />
					</div>
				</div>
				<hr />
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
			</div>
			<div class="action text-right">
				<a href="<?php echo home_url(); ?>/account">Cancel</a>
				<input name="updateuser" type="submit" id="updateuser" class="nbtn primary" value="<?php _e('Update', 'profile'); ?>" />
			</div>
		</div>
		<?php wp_nonce_field( 'update_user', 'update_user_nonce' ); ?>
        <input name="action" type="hidden" id="action" value="update_user" />
	</form>
	<?php 
	else :
		echo '<p>You should be a member to access this page.</p>';
	endif;
	?>
</div>