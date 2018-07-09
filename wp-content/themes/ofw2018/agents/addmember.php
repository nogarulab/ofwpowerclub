<?php

if ( is_user_logged_in() && current_user_can( 'agent' ) ) :
	$posttype = 'ms_invoice';
	$current_user = wp_get_current_user();
	$errors = array(); 

	$ms_settings = get_option( 'ms_model_settings' );
	$cntr = 0;
	foreach($ms_settings as $ms_setting) {
		$cntr++;
		if ($cntr==1) {
			$currency = $ms_setting;
		}
	}

	$args=array(
      'post_type' => 'ms_invoice',
      'posts_per_page' => 1,
      'orderby' => 'id',
      'order'   => 'DESC',
      'post_status' => 'private'
      );

    $query = new WP_Query($args);

    if ($query->have_posts()):
        while ($query->have_posts()) :
            $query->the_post();
            $latest_ms_invoice_post_id = get_the_id();
        endwhile;
    endif;
        


	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {  

		// Check email address is present and valid  
        $m_email = esc_sql($_REQUEST['m_email']);  
        if( !is_email( $m_email ) ) 
        {   
        $errors['m_email'] = "Please enter a valid email";  
        } elseif( email_exists( $m_email ) ) 
        {  
            $errors['m_email'] = "This email address is already in use";  
        }  
   
        // Check password is valid  
        if(0 === preg_match("/.{6,}/", $_POST['m_pass1']))
        {  
          $errors['password'] = "Password must be at least six characters";  
        }  
   
        // Check password confirmation_matches  
        if(0 !== strcmp($_POST['m_pass1'], $_POST['m_pass2'])) {  
			$errors['password'] = "Passwords do not match";  
        }

        if (empty($_POST['m_firstname'])) {
        	$errors['firstname'] = "Please provide your first name so what we can address you properly.";
        }

        if (empty($_POST['m_lastname'])) {
        	$errors['lastname'] = "Please provide your last name so what we can address you properly.";
        }

        if(0 === count($errors)) {

        	// CREATE WP ACCOUNT

        	$user_pass = $_POST['m_pass1'];  
        	$new_user_id = wp_create_user( $m_email, $user_pass, $m_email );
            $user = new WP_User($new_user_id);
            $user->set_role('subscriber');
            $first_name = $_POST['m_firstname'];
            $last_name = $_POST['m_lastname'];
            $display_name = $first_name . ' ' . $last_name;

            wp_update_user( array ('ID' => $new_user_id,  'display_name' => $display_name) ) ;
            update_user_meta( $new_user_id, 'first_name', sanitize_text_field( $first_name ) );
            update_user_meta( $new_user_id, 'middle_name', sanitize_text_field( $_POST['m_middlename'] ) );
            update_user_meta( $new_user_id, 'last_name', sanitize_text_field( $last_name ) );
            update_user_meta( $new_user_id, 'gender', $_POST['m_gender'] );
            update_user_meta( $new_user_id, 'contact_number', $_POST['m_contact_number'] );
            update_user_meta( $new_user_id, 'country', $_POST['m_country'] );
            update_user_meta( $new_user_id, 'agent_id', $current_user->ID );
            update_user_meta( $new_user_id, 'hk_id_number', $_POST['hk_id_number'] );
            update_user_meta( $new_user_id, 'address', $_POST['m_address'] );
            update_user_meta( $new_user_id, 'birthday_year', $_POST['b_year'] );
            update_user_meta( $new_user_id, 'birthday_month', $_POST['b_month'] );
            update_user_meta( $new_user_id, 'birthday_day', $_POST['b_day'] );
            update_user_meta( $new_user_id, 'beneficiary_name', $_POST['beneficiary_name'] );
            update_user_meta( $new_user_id, 'beneficiary_contactnumber', $_POST['beneficiary_contactnumber'] );
            update_user_meta( $new_user_id, 'relationship_with_beneficiary', $_POST['relationship_with_beneficiary'] );
            update_user_meta( $new_user_id, 'beneficiary_address', $_POST['beneficiary_address'] );
            update_user_meta( $new_user_id, 'ms_custom_data', 'a:0:{}' );
            update_user_meta( $new_user_id, 'ms_gateway_profiles', 'a:0:{}' );
            update_user_meta( $new_user_id, 'ms_id', $new_user_id );
            update_user_meta( $new_user_id, 'ms_is_member', '' );
            update_user_meta( $new_user_id, 'ms_firstname', $first_name );
            update_user_meta( $new_user_id, 'ms_lastname', $last_name );
            update_user_meta( $new_user_id, 'ms_name', $display_name );
            update_user_meta( $new_user_id, 'ms_subscription', 'a:0:{}' );
            update_user_meta( $new_user_id, 'ms_username', $m_email );
            update_user_meta( $new_user_id, 'ms_email', $m_email );

            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	        
	        $attachment_id = media_handle_upload( 'profile_picture', $new_user_id );
	        if (!empty($attachment_id) && !is_wp_error( $attachment_id )) {
	        	update_user_meta( $new_user_id, 'profile_picture', $attachment_id );
	        }

	        $m_email_clean = strtolower($m_email);
	        $m_email_clean = str_replace("@", " ", $m_email_clean);
	        $m_email_clean = str_replace(".", "-", $m_email_clean);

	        //Event

            $add_ms_event = array(
            	'post_author' 		=> $new_user_id,
            	'post_content'		=> 'Has registered.',
            	'post_excerpt'		=> 'Has registered.',
            	'post_status'		=> 'private',
            	'comment_status'	=> 'closed',
            	'ping_status'		=> 'closed',
            	'post_type'			=> 'ms_event'
            );
            $new_ms_event = wp_insert_post($add_ms_event);

            add_post_meta( $new_ms_event, 'id', 0 );
            add_post_meta( $new_ms_event, 'date', date('Y-m-d') );
            add_post_meta( $new_ms_event, 'description', 'Has registered.' );
            add_post_meta( $new_ms_event, 'user_id', $new_user_id );
            add_post_meta( $new_ms_event, 'membership_id', null );
            add_post_meta( $new_ms_event, 'ms_relationship_id', null );
            add_post_meta( $new_ms_event, 'name', 'user: , type: registered' );
            add_post_meta( $new_ms_event, 'title', '' );
            add_post_meta( $new_ms_event, 'topic', 'user' );
            add_post_meta( $new_ms_event, 'type', 'registered' );

            //Relationship
            $membership_id = 342;
            $add_ms_relationship = array(
            	'post_author' 		=> $new_user_id,
            	'post_content'		=> 'user_id: '.$new_user_id.', membership: '.$membership_id,
            	'post_title'		=> 'user_id-'.$new_user_id.'-membership_id-'.$membership_id,
            	'post_excerpt'		=> 'user_id: '.$new_user_id.', membership: '.$membership_id,
            	'post_status'		=> 'private',
            	'comment_status'	=> 'closed',
            	'ping_status'		=> 'closed',
            	'post_name'		=> 'user_id-'.$new_user_id.'-membership_id-'.$membership_id,
            	'post_type'			=> 'ms_relationship'
            );
            $new_ms_relationship = wp_insert_post($add_ms_relationship);

            add_post_meta( $new_ms_relationship, 'cancelled_memberships', '' );
            //add_post_meta( $new_ms_relationship, 'custom_data', 'a:0:{}' );
            add_post_meta( $new_ms_relationship, 'description', 'user_id: '.$new_user_id.', membership_id: '.$membership_id );
            //add_post_meta( $new_ms_relationship, 'email_log', 'a:0:{}' );
            add_post_meta( $new_ms_relationship, 'expiry_date', '' );
            add_post_meta( $new_ms_relationship, 'gateway_id', null );
            add_post_meta( $new_ms_relationship, 'id', $new_ms_relationship );
            add_post_meta( $new_ms_relationship, 'is_simulated', '' );
            add_post_meta( $new_ms_relationship, 'membership_id', $membership_id );
            add_post_meta( $new_ms_relationship, 'move_from_id', 0 );
            add_post_meta( $new_ms_relationship, 'name', 'user_id: '.$new_user_id.', membership_id: '.$membership_id );
            add_post_meta( $new_ms_relationship, 'payment_type', 'recurring' );
            add_post_meta( $new_ms_relationship, 'payments', 'a:0:{}' );
            add_post_meta( $new_ms_relationship, 'source', '' );
            add_post_meta( $new_ms_relationship, 'source_id', '' );
            add_post_meta( $new_ms_relationship, 'start_date', date('Y-m-d') );
            add_post_meta( $new_ms_relationship, 'status', 'pending' );
            add_post_meta( $new_ms_relationship, 'title', '' );
            add_post_meta( $new_ms_relationship, 'trial_expire_date', '' );
            add_post_meta( $new_ms_relationship, 'trial_period_completed', '' );
            add_post_meta( $new_ms_relationship, 'user_id', $new_user_id );

            //Invoice
            $m_email_clean = strtolower($m_email);
            $m_email_clean = str_replace("@", "", $m_email_clean);
            $m_email_clean = str_replace(".", "-", $m_email_clean);
            $membership_name = get_post_meta($membership_id, 'name', true);
            $membership_name = strtolower($membership_name);
            $membership_name = str_replace(" ", "-", $membership_name);
            $membership_price = get_post_meta($membership_id, 'price', true);
            $membership_tax = get_post_meta($membership_id, 'tax_rate', true);
            $membership_subtotal = get_post_meta($membership_id, 'subtotal', true);
            $latest_ms_invoice_post_id = get_post_meta($latest_ms_invoice_post_id, 'custom_invoice_id', true) + 1;
            $add_ms_invoice = array(
            	'post_author' 		=> $new_user_id,
            	'post_content'		=> 'You will pay <span class="price">'.$currency.' '.$membership_price.'</span> each year.',
            	'post_title'		=> 'invoice-for-'.$membership_name.'-'.$m_email_clean,
            	'post_excerpt'		=> 'You will pay <span class="price">'.$currency.' '.$membership_price.'</span> each year.',
            	'post_status'		=> 'private',
            	'comment_status'	=> 'closed',
            	'ping_status'		=> 'closed',
            	'post_name'			=> 'invoice-for-'.$membership_name.'-'.$m_email_clean,
            	'post_type'			=> 'ms_invoice'
            );
            $new_ms_invoice = wp_insert_post($add_ms_invoice);

            add_post_meta( $new_ms_invoice, 'user_id', $new_user_id );
            add_post_meta( $new_ms_invoice, 'uses_trial', '' );
            add_post_meta( $new_ms_invoice, 'trial_ends', '' );
            add_post_meta( $new_ms_invoice, 'title', '' );
            add_post_meta( $new_ms_invoice, 'tax_name', '' );
            add_post_meta( $new_ms_invoice, 'status', 'billed' );
            add_post_meta( $new_ms_invoice, 'source', '' );
            add_post_meta( $new_ms_invoice, 'short_description', '<span class="price">'.$currency.' '.$membership_price.'</span> (each year)' );
            add_post_meta( $new_ms_invoice, 'pay_date', '' );
            add_post_meta( $new_ms_invoice, 'name', 'Invoice for '.get_post_meta($membership_id, 'name', true).' - '.$m_email );
            add_post_meta( $new_ms_invoice, 'ms_relationship_id', $new_ms_relationship );
            add_post_meta( $new_ms_invoice, 'membership_id', $membership_id );
            add_post_meta( $new_ms_invoice, 'invoice_date', date('Y-m-d') );
            add_post_meta( $new_ms_invoice, 'id', $new_ms_invoice );
            add_post_meta( $new_ms_invoice, 'gateway_id', 'manual' );
            add_post_meta( $new_ms_invoice, 'external_id', '' );
            add_post_meta( $new_ms_invoice, 'duration', '' );
            add_post_meta( $new_ms_invoice, 'due_date', date('Y-m-d') );
            add_post_meta( $new_ms_invoice, 'description', '<span class="price">'.$currency.' '.$membership_price.'</span> (each year)' );
            add_post_meta( $new_ms_invoice, 'amount', $membership_price );
            add_post_meta( $new_ms_invoice, 'amount_paid', 0 );
            add_post_meta( $new_ms_invoice, 'custom_invoice_id', $latest_ms_invoice_post_id );
            add_post_meta( $new_ms_invoice, 'currency', $currency );

            echo "<h3>You've successfully added a member</h3>";
            echo "Please be advised that in order for the membership to be active the, applicant should pay". $membership_price . " " . $currency . "first. Please see below our payment options.";
            echo '<div class="sendtouser" data-password="'.$user_pass.'" data-toemail="'.$m_email.'" data-name="'.$first_name.' '.$last_name.'">';
	        echo do_shortcode('[contact-form-7 id="270" title="Send Payment Options To User Email"]');
	        echo '</div>';

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

<form id="wp_addmember_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data" class="form-layout">  

	<h1>Add A Member</h1>

	<div class="row">
		<div class="col-md-3 ml-md-auto mr-md-auto">
			<div class="profile-picture">
				<div class="updatephoto">
					<img class="profile-photo" id="profile_photo" src="<?php echo get_template_directory_uri().'/img/no-profile-pic.png'; ?>" alt="" />
					<input type="file" name="profile_picture" id="profile_picture"  multiple="false" accept="image/gif, image/jpeg, image/png" />
					<div class="upload-text">Upload Profile Picture</div>
				</div>
			</div>
		</div>
	</div>
		
	<h4>Account Creation</h4>
	<div class="form-row">
		<div class="form-group col-md-12">
			<label for="inputEmailaddress">Email Address</label>
			<input type="text" value="" name="m_email" id="inputEmailaddress" class="form-control" />
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="inputPassword">Password</label>
			<input type="text" value="testpassword" name="m_pass1" id="inputPassword" class="form-control" />
		</div>
		<div class="form-group col-md-6">
			<label for="inputRPassword">Repeat Password</label>
			<input type="text" value="testpassword" name="m_pass2" id="inputLastname" class="form-control" />
		</div>
	</div>
	<hr>
	<h4>Personal Information</h4>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="inputFirstname">First Name</label>
			<input type="text" value="Member" name="m_firstname" id="inputFirstname" class="form-control" />
		</div>
		<div class="form-group col-md-4">
			<label for="inputMiddlename">Middle Name</label>
			<input type="text" value="Mid Name" name="m_middlename" id="inputMiddlename" class="form-control" />
		</div>
		<div class="form-group col-md-4">
			<label for="inputLastname">Last Name</label>
			<input type="text" value="Ako" name="m_lastname" id="inputLastname" class="form-control" />
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="inputGender">Gender</label>
			<?php $gender_lists = array('Male', 'Female'); ?>
			<select name="m_gender" id="inputGender" class="form-control">
				<option>--</option>
				<?php foreach ($gender_lists as $gender_list) { ?>
					<option><?php echo $gender_list; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-8">
			<label for="inputBirthday">Birthday</label>
			<?php
				$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
			?>	
			<div class="form-row">
				<div class="form-group col-md-6">
					<select name="b_month" class="form-control">
						<option>--</option>
						<?php 
						foreach ($months as $month) {
							echo '<option value="'.$month.'">'.$month.'</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group col-md-3">
					<select name="b_day" class="form-control">
						<option>--</option>
						<?php
						$d_counter = 0;
						for ($i=1; $i<=31; $i++) {
							$d_counter++;
							if ($d_counter < 10) {
								$d_counter = '0'.$d_counter;
							}
							echo '<option value="'.$d_counter.'">'.$i.'</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group col-md-3">
					<select name="b_year" class="form-control">
						<option>--</option>
						<?php
						for ($i=1940; $i<=(date('Y')-10); $i++) {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="inputContactnumber">Contact Number</label>
			<input type="text" value="" name="m_contact_number" id="inputContactnumber" class="form-control" />
		</div>
		<div class="form-group col-md-4">
			<label for="inputCountry">Country Of Work</label>
			<select name="m_country" id="inputCountry" class="form-control">
				<option>--</option>
				<?php
				$fields = get_field_object('field_5b3ff14d13d65');
				$choices = $fields['choices'];
				foreach($choices as $choice):
					echo '<option value="'.$choice.'">'.$choice.'</option>';
				endforeach;
				?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label for="inputHKID">HK ID Number / Passport Number</label>
			<input type="text" value="" name="hk_id_number" id="inputHKID" class="form-control" />
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-12">
			<label for="inputAddress">Address In Hong Kong/Place Of Work</label>
			<input type="text" value="" name="m_address" id="inputAddress" class="form-control" />
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

	<div class="action">
		<input type="submit" id="submitbtn" name="submit" value="Sign Up" />
	</div>

</form>

<?php

else :
	echo "You do not have permission to access this page. Please login as an agent.";
endif;
?>