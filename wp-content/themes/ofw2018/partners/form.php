
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
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";

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
    		$partner_category_list		= [];
    		if (!empty($partner_category)) {
    			$partner_category = $_POST['partner_category'];
	    		foreach($partner_category as $category) {
	        		$partner_category_list[] = $category;
	        	}
	        }

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

		    $noofcat = count(isset($_POST['partner_category']));
		    if ($noofcat > 3) {
		    	$errors['category'] = "Please choose not more than 3 categories.";
		    }

            if (empty($b_location)) {
                $errors['b_location'] = "Please input at least 1 Branch Location.";
            }

            if (empty($b_address)) {
                $errors['b_address'] = "Please provide us at least 1 Branch Address.";
            }

            if (empty($b_contactnumber)) {
                $errors['b_contactnumber'] = "Please provide us your Branch Contact Number.";
            }

            if (empty($b_contactperson)) {
                $errors['b_contactperson'] = "Please provide us your Branch Contact Person.";
            }

            if (empty($benefitname)) {
                $errors['benefitname'] = "Please provide us at least 1 Beneficiary.";
            }

            if (empty($benefitdesc)) {
                $errors['benefitname'] = "Please tell us about the Beneficiary.";
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
		        add_user_meta( $new_user_id, 'partner_page_id', $new_partner);

		        
		        wp_set_post_terms( $new_partner, $partner_category_list, 'partner_category', false );
		        

	            $success = 1;  
	   			echo "<div class='success'><h5>You have successfully sent your application.</h5><p>Please wait for our staff to get in touch with you for the next step.</p></div>";
	            //header( 'Location:' . get_bloginfo('url') . '/login/?success=1&u=' . $username ); 
	   
	        }  else {
	        	echo '<ul class="errors">';
	        	foreach ($errors as $error) {
	        		echo "<li>".$error."</li>";
	        	}
	        	echo '</ul>';
	        }
	   
	    }  
	}  

?>

<form id="wp_signup_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">  
	<section class="create-an-account">
		<h3>Create An Account</h3>
		<p>Please register an account first in our website.</p>
		<div class="row">
			<div class="col-md-6">
				<div class="form-row">
					<div class="form-group col-md-12"><input class="form-control" type="email" name="email" id="email" required="" placeholder="Email Address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"></div>
				</div>
				<div class="form-row">
				    <div class="form-group col-md-6"><input class="form-control" type="password" name="password" id="password" required="" placeholder="Password" >  </div>
				    <div class="form-group col-md-6"><input class="form-control" type="password" name="password_confirmation" required="" id="password_confirmation" placeholder="Confirm Password">  </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-row">
				    <div class="form-group col-md-6"><input class="form-control" type="text" name="firstname" id="firstname" required="" placeholder="First Name" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>"></div>
				    <div class="form-group col-md-6"><input class="form-control" type="text" name="lastname" id="lastname" required="" placeholder="Last Name" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>"></div>
				</div>
				<div class="form-row">
				    <div class="form-group col-md-12"><input class="form-control" type="number" name="contactnumber" id="contactnumber" required="" placeholder="Contact Number" value="<?php echo isset($_POST['contactnumber']) ? $_POST['contactnumber'] : ''; ?>"></div>
				</div>
			</div>
		</div>
	</section>
    <section class="about-establishment">
	    <h3>About Your Establishment</h3>
	    <p>Tell us more about your establishments.</p>
	    <div class="row">
		    <div class="col-md-3">
		    	<div class="profile-picture form-group">
		    		<div class="updatephoto">
		    			<img class="profile-photo" id="profile_photo" src="<?php echo get_template_directory_uri();?>/img/upload-logo.png" alt="" />
		    			<input type="file" name="featured_img" id="profile_picture" multiple="false" accept="image/*" />
		    			<div class="upload-text">Upload Profile Picture</div>
		    		</div>
		    	</div>
		    </div>
		    <div class="col-md-9">
		    	
	    		<div class="form-row">
    				<div class="form-group col-md-4"><input class="form-control"  type="text" name="establishmentname" id="establishmentname" required="" placeholder="Establishment/Business Name" value="<?php echo isset($_POST['establishmentname']) ? $_POST['establishmentname'] : ''; ?>"></div>
    				<div class="form-group col-md-4"><input class="form-control"  type="text" name="e_owner" required="" placeholder="Name of Proprietor" value="<?php echo isset($_POST['e_owner']) ? $_POST['e_owner'] : ''; ?>"></div>
				    <div class="form-group col-md-4"><input class="form-control"  type="text" name="e_website_url" required="" placeholder="Website Link" value="<?php echo isset($_POST['e_website_url']) ? $_POST['e_website_url'] : ''; ?>"></div>
	    		</div>
	    		<div class="form-row">
    				<div class="form-group col-md-12"><textarea class="form-control"  name="establishmentdescription" required="" placeholder="Tell Us about your establishment/business"><?php echo isset($_POST['establishmentdescription']) ? $_POST['establishmentdescription'] : ''; ?></textarea></div>	
	    		</div>
			    
			</div>
		</div>
	</section>
    <section class="branches clearfix">
	    <h3>Branches</h3>
	    <p>Tell us the address, contact number, email &amp; contact person of all your establishment branches.</p>
	    <div class='branches incremental-item' data-itemhtml='<li class="item"><div class="form-row"><div class="form-group col-md-3"><input class="form-control" type="text" name="b_location[]" placeholder="Location"></div><div class="form-group col-md-3"><input class="form-control" type="text" name="b_contactnumber[]" placeholder="Contact Number"></div><div class="form-group col-md-6"><input class="form-control" type="text" name="b_contactperson[]" placeholder="Contact Person"></div></div><div class="form-row"><div class="form-group col-md-12"><input class="form-control" type="text" name="b_address[]" placeholder="Address"></div></div><span class="remove">Remove</span></li>'>
	    	<ul>
	    		<li class="item">
	    			<div class="form-row">
		    			<div class="form-group col-md-3"><input class="form-control" type="text" required="" name="b_location[]" placeholder="Location"></div>
		    			<div class="form-group col-md-3"><input class="form-control" type="number" required="" name="b_contactnumber[]" placeholder="Contact Number"></div>
		    			<div class="form-group col-md-6"><input class="form-control" type="text" required="" name="b_contactperson[]" placeholder="Contact Person"></div>
	    			</div>
	    			<div class="form-row">
	    				<div class="form-group col-md-12"><input class="form-control" type="text" required="" name="b_address[]" placeholder="Address"></div>
	    			</div>
	    		</li>
	    	</ul>
    		<span class="add btn btn-md btn-secondary float-right">Add Another Branch</button>
	    </div>
	</section>
	<section class="perks clearfix">
    	<h3>Benefits and Perks</h3>
    	<p>Tell us the benefits and perks that you're going to offer to our members.</p>
    	<div class="benefit_perks incremental-item" data-itemhtml="<li class='item'><div class='form-group'><input class='form-control' type='text' name='benefitname[]' placeholder='Benefit Name'></div><div class='form-group'><textarea class='form-control' name='benefitdesc[]'>About the benefit</textarea></div><span class='remove'>Remove</span></li>">
    		<ul>
	    		<li class="item">
	    			<div class="form-group"><input class="form-control" type="text" name="benefitname[]" placeholder="Benefit Name"></div>
	    			<div class="form-group"><textarea class="form-control" name="benefitdesc[]" placeholder="About the benefit"></textarea></div>
	    		</li>
	    	</ul>
    		<span class="add btn btn-md btn-secondary float-right">Add Another Benefit/Perks</span>
    	</div>
    </section>
    <section>
	    <h3>Establishment Category</h3>
	    <p>Tell us the what kind/type of business you have. Please take note that you can only choose 3 categories.</p>
	    <div>
	    	<ul class="form-row">
	    	<?php
	    		$terms = get_terms( array(
				    'taxonomy' => 'partner_category',
				    'hide_empty' => false,
				) );
				foreach ($terms as $term) {
					echo '<li class="col-md-3"><input '.( !empty($partner_category_list) && in_array($term->name, $partner_category_list) ? 'checked="checked"' : '' ).' type="checkbox" name="partner_category[]" value="'.$term->name.'"> '.$term->name.'</li>';
				}
	    	?>
	    	</ul>
	    </div>
	</section>
    <div class="action clearfix">
    	<div class="float-left">
    		<span><input type="checkbox" name="receivesticker" value="" <?php echo (isset($_POST['receivesticker'])) ? 'checked=checked' : ''; ?> /> Receive OFW Power Club Sticker(s)</span>
    		<span><input type="checkbox" class="termsinput" name="terms_condition" required="" value="" <?php echo (isset($_POST['terms_condition'])) ? 'checked=checked' : ''; ?> /> Accept <a href="#" data-toggle="modal" data-target="#terms">terms and condition</a></span>
    	</div>
    	<input type="submit" id="submitbtn" name="submit" value="Send Application" class="float-right btn btn-primary btn-lg" />
    </div>
    <input type="hidden" name="post-type" id="post-type" value="<?php echo $posttype; ?>" />
	<input type="hidden" name="action" value="<?php echo $posttype; ?>" />
	<?php wp_nonce_field( 'submit_'.$posttype,'client_'.$posttype.'_nonce' ); ?>
</form>

<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="terms" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Terms &amp; Conditions</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</p>
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</p>
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</p>
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-accept" data-dismiss="modal">Accept Terms</button>
			</div>
		</div>
	</div>
</div>

<?php

else :
	echo "You already have an account, you don't need to create another.";
endif;
?>
