<?php 

if ( ! is_user_logged_in() ) :

	global $wpdb, $user_ID;  
	$posttype = 'partners';
	if ($user_ID) {  
	   
	    // They're already logged in, so we bounce them back to the homepage.  
	    header( 'Location:' . home_url() );  
	   
	} else {  
	   
	    $errors = array();  
	   
	    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
	    {  
	   
	        // Check email address is present and valid  
	        $email = esc_sql($_REQUEST['email']);  
	        if( !is_email( $email ) ) 
	        {   
	            $errors['email'] = "Please enter a valid email";  
	        } elseif( email_exists( $email ) ) 
	        {  
	            $errors['email'] = "This email address is already in use";  
	        }  
	   
	        // Check password is valid  
	        if(0 === preg_match("/.{6,}/", $_POST['password']))
	        {  
	          $errors['password'] = "Password must be at least six characters";  
	        }  
	   
	        // Check password confirmation_matches  
	        if(0 !== strcmp($_POST['password'], $_POST['password_confirmation']))
	         {  
	          $errors['password_confirmation'] = "Passwords do not match";  
	        }

	        $title 					= $_POST['establishmentname'];
			$content 				= $_POST['establishmentdescription'];
			$terms 					= isset($_POST['terms_condition']);
			$sticker 				= isset($_POST['receivesticker']);
			$owner 					= $_POST['e_owner'];
    		$contactperson 			= $_POST['e_contact_person'];
    		$contactnumber 			= $_POST['e_contact_number'];
    		$establishmentemail 	= $_POST['e_email_address'];
    		$establishmentwebsite 	= $_POST['e_website_url'];


			if ( $title == '' )
			{
				$errors['title'] = "Establishment name cannot be empty.";
			}

			if ( empty($_POST) || !wp_verify_nonce($_POST['client_'.$posttype.'_nonce'],'submit_'.$posttype ) ) {
		        $errors['nonce'] = "Sorry, your nonce did not verify.";
		        exit;
		    }

		    if ( empty($terms) )
		    {
		    	$errors['terms'] = "You should agree the terms and conditions, for you to submit your application.";
		    }

		    if ( empty($owner) )
		    {
		    	$errors['owner'] = "Please tell us the owner of the establishment.";
		    }

		    if ( empty($contactperson) )
		    {
		    	$errors['contactperson'] = "Please tell us who will we talk to";
		    }

		    if ( empty($contactnumber) )
		    {
		    	$errors['contactnumber'] = "Please tell us the contact number";
		    }

		    if ( empty($establishmentemail) )
		    {
		    	$errors['establishmentemail'] = "Please tell us the email address";
		    }
	   
	        if(0 === count($errors)) 
	        {  
	   
	            $password = $_POST['password'];  
	   
	            $new_user_id = wp_create_user( $email, $password, $email );
	            $user = new WP_User($new_user_id);
	            $user->set_role('partner_applicant');
	            $display_name = $_POST['firstname'] . ' ' . $_POST['lastname'];
	            $terms = true;

	            wp_update_user( array ('ID' => $new_user_id,  'display_name' => $display_name) ) ;
	            update_user_meta( $new_user_id, 'first_name', sanitize_text_field( $_POST['firstname'] ) );
	            update_user_meta( $new_user_id, 'last_name', sanitize_text_field( $_POST['lastname'] ) );

	            // You could do all manner of other things here like send an email to the user, etc. I leave that to you.  
	   			//add_partner($posttype);

		        $addpartner = array(
		            'post_title'    => wp_strip_all_tags( $title ),
		            'post_content'  => $content,
		            'post_status'   => 'draft',
		            'post_type'     => 'partners'
		        );
		        $new_partner = wp_insert_post($addpartner);
		        $post = get_post($new_partner);
		        add_post_meta( $new_partner, 'terms_condition', $terms );
		        add_post_meta( $new_partner, 'receive_sticker', $sticker );
		        add_post_meta( $new_partner, 'establishment_owner', $owner );
		        add_post_meta( $new_partner, 'contact_person', $contactperson );
		        add_post_meta( $new_partner, 'contact_number', $contactnumber );
		        add_post_meta( $new_partner, 'establishmentemail', $establishmentemail );
		        add_post_meta( $new_partner, 'establishmentwebsite', $establishmentwebsite );

		        //$post_slug = $post->post_name;
		        //echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.home_url().'/'.$postype.'/'.$post_slug.'?edit=true">';

	            $success = 1;  
	   			echo "<div>You have successfully sent your application. Please wait for our staff to get in touch with you for the next step.</div>";
	            //header( 'Location:' . get_bloginfo('url') . '/login/?success=1&u=' . $username ); 
	   
	        }  else {
	        	foreach ($errors as $error) {
	        		echo "<div>".$error."</div>";
	        	}
	        }
	   
	    }  
	}  

?>

<form id="wp_signup_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">  
	<h3>Tell Us About Yourself</h3>
    <div><input type="text" name="email" id="email" placeholder="Email Address"></div>
    <div><input type="password" name="password" id="password" placeholder="Password">  </div>
    <div><input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">  </div>
    <div><input type="text" name="firstname" id="firstname" placeholder="First Name"></div>
    <div><input type="text" name="lastname" id="lastname" placeholder="Last Name">  </div>
    <hr>
    <h3>Tell Us About Your Establishment</h3>
    <div><input type="text" name="establishmentname" id="establishmentname" placeholder="Establishment/Business Name"></div>
    <div><textarea name="establishmentdescription">Tell Us about your establishment/business</textarea></div>
    <div><input type="text" name="e_owner" value="" placeholder="Name of Proprietor"></div>
    <div><input type="text" name="e_contact_person" value="" placeholder="Name of Contact Person"></div>
    <div><input type="number" name="e_contact_number" value="" placeholder="Contact Number"></div>
    <div><input type="email" name="e_email_address" value="" placeholder="Email Address"></div>
    <div><input type="text" name="e_website_url" value="" placeholder="Website Link"></div>
    <div><input type="checkbox" name="receivesticker" value="" /> Receive OFW Power Club Sticker(s)</div>
    <div>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</div>
    <div><input type="checkbox" name="terms_condition" value="" /> Accept terms and condition</div>



    <div><input type="submit" id="submitbtn" name="submit" value="Sign Up" />  </div>
    <input type="hidden" name="post-type" id="post-type" value="<?php echo $posttype; ?>" />
	<input type="hidden" name="action" value="<?php echo $posttype; ?>" />
	<?php wp_nonce_field( 'submit_'.$posttype,'client_'.$posttype.'_nonce' ); ?>
</form> 

<?php

else :
	echo "You already have an account, you don't need to create another.";
endif;
?>