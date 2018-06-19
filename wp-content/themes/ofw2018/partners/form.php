<?php 

//if ( ! is_user_logged_in() ) :

	global $wpdb, $user_ID;  
	if ($user_ID) {  
	   
	    // They're already logged in, so we bounce them back to the homepage.  
	    header( 'Location:' . home_url() );  
	   
	} else {  
	   
	    $errors = array();  
	   
	    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
	      {  
	   
	        // Check username is present and not already in use  
	        // $username = $wpdb->escape($_REQUEST['username']);  
	        // if ( strpos($username, ' ') !== false )
	        // {   
	        //     $errors['username'] = "Sorry, no spaces allowed in usernames";  
	        // }  
	        // if(emptyempty($username)) 
	        // {   
	        //     $errors['username'] = "Please enter a username";  
	        // } elseif( username_exists( $username ) ) 
	        // {  
	        //     $errors['username'] = "Username already exists, please try another";  
	        // }  
	   
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
	   
	        // Check terms of service is agreed to  
	        // if($_POST['terms'] != "Yes")
	        // {  
	        //     $errors['terms'] = "You must agree to Terms of Service";  
	        // }
	   
	        if(0 === count($errors)) 
	        {  
	   
	            $password = $_POST['password'];  
	   
	            $new_user_id = wp_create_user( $email, $password, $email );
	            $user = new WP_User($new_user_id);
	            $user->set_role('partner');
	            $display_name = $_POST['firstname'] . ' ' . $_POST['lastname'];

	            wp_update_user( array ('ID' => $new_user_id,  'display_name' => $display_name) ) ;
	            update_user_meta( $new_user_id, 'first_name', sanitize_text_field( $_POST['firstname'] ) );
	            update_user_meta( $new_user_id, 'last_name', sanitize_text_field( $_POST['lastname'] ) );

	   
	            // You could do all manner of other things here like send an email to the user, etc. I leave that to you.  
	   
	            $success = 1;  
	   
	            //header( 'Location:' . get_bloginfo('url') . '/login/?success=1&u=' . $username );  
	   
	        }  else {
	        	foreach ($errors as $error) {
	        		echo "<div>".$error."</div>";
	        	}
	        }
	   
	    }  
	}  

?>

<form id="wp_signup_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">  
  
        
        <!-- <input type="text" name="username" id="username">   -->
        <div><input type="text" name="email" id="email" placeholder="Email Address"></div>
        <div><input type="password" name="password" id="password" placeholder="Password">  </div>
        <div><input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">  </div>
        <div><input type="text" name="firstname" id="firstname" placeholder="First Name"></div>
        <div><input type="text" name="lastname" id="lastname" placeholder="Last Name">  </div>
        <!-- <input name="terms" id="terms" type="checkbox" value="Yes">  
        <label for="terms">I agree to the Terms of Service</label>   -->
  
        <div><input type="submit" id="submitbtn" name="submit" value="Sign Up" />  </div>
  
</form> 

<?php
// else :
// 	echo "You already have an account, you don't need to create another.";
// endif;
?>