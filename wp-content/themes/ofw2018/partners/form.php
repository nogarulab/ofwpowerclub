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

	        if (empty($_POST['firstname']))
	        {
	        	$errors['firstname'] = "Please provide your first name so what we can address you properly.";
	        }

	        if (empty($_POST['lastname']))
	        {
	        	$errors['lastname'] = "Please provide your last name so what we can address you properly.";
	        }

	        if (empty($_POST['contactnumber']))
	        {
	        	$errors['contactnumber'] = "Please provide your contactnumber so that we can get in touch.";
	        }

	        $title 						= $_POST['establishmentname'];
			$content 					= $_POST['establishmentdescription'];
			$terms 						= isset($_POST['terms_condition']);
			$sticker 					= isset($_POST['receivesticker']);
			$owner 						= $_POST['e_owner'];
    		$establishmentwebsite 		= $_POST['e_website_url'];
    		$benefitname				= $_POST['benefitname'];
    		$benefitdesc				= $_POST['benefitdesc'];
    		$b_location 				= $_POST['b_location'];
    		$b_address 					= $_POST['b_address'];
    		$b_contactnumber			= $_POST['b_contactnumber'];
    		$b_contactperson 			= $_POST['b_contactperson'];
    		$partner_category 			= isset($_POST['partner_category']);


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

		    if (empty($partner_category)) {
		    	$errors['category'] = "Please tell us what type of business you have.";
		    }

		    $noofcat = count($_POST['partner_category']);
		    if ($noofcat > 3) {
		    	$errors['category'] = "Please choose not more than 3 categories.";
		    }

		    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	        require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	        $file = $_FILES['featured_img']['tmp_name'];

	        if($_FILES['featured_img']['size'] == 0) {
	        	$errors['b_logo'] = "You should upload your logo.";
	        }

	        if (file_exists($file)) {
	            $imagesizedata = getimagesize($file);
	            if ($imagesizedata === FALSE) {
	                $errors['b_logo'] = 'Your uploading a wrong file. Please upload either .jpg, .gif or .png';
	            }
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
	            wp_update_user( array ('ID' => $new_user_id,  'user_url' => $_POST['e_website_url']) ) ;
	            update_user_meta( $new_user_id, 'contact_number', $_POST['contactnumber'] );
	            update_user_meta( $new_user_id, 'first_name', sanitize_text_field( $_POST['firstname'] ) );
	            update_user_meta( $new_user_id, 'last_name', sanitize_text_field( $_POST['lastname'] ) );

	            $benefits_offered = array('name' => $benefitname, 'description' => $benefitdesc);
	            $branches = array('location' => $b_location, 'address' => $b_address, 'contact_no' => $b_contactnumber, 'contact_person' => $b_contactperson);

		        $addpartner = array(
		            'post_title'    => wp_strip_all_tags( $title ),
		            'post_content'  => $content,
		            'post_status'   => 'private',
		            'post_type'     => 'partners',

		        );
		        $new_partner = wp_insert_post($addpartner);
		        $post = get_post($new_partner);
		        add_post_meta( $new_partner, 'terms_condition', $terms );
		        add_post_meta( $new_partner, 'receive_sticker', $sticker );
		        add_post_meta( $new_partner, 'establishment_owner', $owner );
		        add_post_meta( $new_partner, 'establishmentwebsite', $establishmentwebsite );
		        add_post_meta( $new_partner, 'benefits_offered', $benefits_offered );
		        add_post_meta( $new_partner, 'branches', $branches );
		        $attachment_id = media_handle_upload( 'featured_img', $new_partner );
		        add_post_meta( $new_partner, '_thumbnail_id', $attachment_id);

		        
		        wp_set_post_terms( $new_partner, $partner_category, 'partner_category', false );
		        

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
	<div>
		<h3>Create Account</h3>
		<p>Please register first on our website.</p>
	    <div><input type="text" name="email" id="email" placeholder="Email Address"></div>
	    <div><input type="password" name="password" id="password" placeholder="Password">  </div>
	    <div><input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">  </div>
	    <div><input type="text" name="firstname" id="firstname" placeholder="First Name"></div>
	    <div><input type="text" name="lastname" id="lastname" placeholder="Last Name">  </div>
	    <div><input type="number" name="contactnumber" id="contactnumber" placeholder="Contact Number"></div>
	</div>
    <hr>
    <div>
	    <h3>About Your Establishment</h3>
	    <p>Tell us more about your establishments.</p>
	    <div><input type="text" name="establishmentname" id="establishmentname" placeholder="Establishment/Business Name"></div>
	    <div><textarea name="establishmentdescription">Tell Us about your establishment/business</textarea></div>
	    <div><input type="text" name="e_owner" value="" placeholder="Name of Proprietor"></div>
	    <div><input type="text" name="e_website_url" value="" placeholder="Website Link"></div>
	</div>
	<hr>
    <div>
	    <h3>Branches</h3>
	    <p>Tell us the address, contact number, email &amp; contact person of all your establishment branches.</p>
	    <div class='branches incremental-item' data-itemhtml='<li class="item"><div><input type="text" name="b_location[]" placeholder="Location"></div><div><input type="text" name="b_address[]" placeholder="Address"></div><div><input type="text" name="b_contactnumber[]" placeholder="Contact Number"></div><div><input type="text" name="b_contactperson[]" placeholder="Contact Person"></div><span class="remove">Remove</span></li>'>
	    	<ul>
	    		<li class="item">
	    			<div><input type="text" name="b_location[]" placeholder="Location"></div>
	    			<div><input type="text" name="b_address[]" placeholder="Address"></div>
	    			<div><input type="text" name="b_contactnumber[]" placeholder="Contact Number"></div>
	    			<div><input type="text" name="b_contactperson[]" placeholder="Contact Person"></div>
	    		</li>
	    	</ul>
    		<span class="add">Add another branch</button>
	    </div>
	</div>
	<hr>
    <div>
	    <h3>Establishment Category</h3>
	    <p>Tell us the what kind/type of business you have. Please take note that you can only choose 3 categories.</p>
	    <div>
	    	<ul>
	    	<?php
	    		$terms = get_terms( array(
				    'taxonomy' => 'partner_category',
				    'hide_empty' => false,
				) );
				foreach ($terms as $term) {
					echo '<li><input type="checkbox" name="partner_category[]" value="'.$term->name.'"> '.$term->name.'</li>';
				}
	    	?>
	    	</ul>
	    </div>
	</div>
	<hr>
	<div>
    	<h3>Benefits and Perks</h3>
    	<p>Tell us the benefits and perks that you're going to offer to our members.</p>
    	<div class="benefit_perks incremental-item" data-itemhtml="<li class='item'><div><input type='text' name='benefitname[]' placeholder='Benefit Name'></div><div><textarea name='benefitdesc[]'>About the benefit</textarea></div><span class='remove'>Remove</span></li>">
    		<ul>
	    		<li class="item">
	    			<div><input type="text" name="benefitname[]" placeholder="Benefit Name"></div>
	    			<div><textarea name="benefitdesc[]">About the benefit</textarea></div>
	    		</li>
	    	</ul>
    		<span class="add">Add another benefit/perks</button>
    	</div>
    </div>

    <div>
    	<h3>Upload Your Establishment's Logo</h3>
    	<div><input type="file" name="featured_img" id="featured_img" accept="image/*" /></div>
    </div>

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