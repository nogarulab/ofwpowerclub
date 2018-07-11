<div class="user-dashboard-home">
	<header>
		<h3>Member Search</h3>
		<p>Verify customers if they are OFW Power Club members by searching them here. Please enter full name or email address.</p>
	</header>
<?php
if ( is_user_logged_in() && current_user_can('partner') ) :
?>
	<form action="<?php echo home_url(); ?>/member-search?ms=<?php echo $s_query; ?>" method="GET" class="member-search">
		<div><input type="text" name="ms" value="" class="form-control" placeholder="Email Address" /><input type="submit" value="Search"></div>
	</form>
<?php
	if (isset($_GET['ms'])) {
		$m_name = '*'.$_GET['ms'].'*';
	} else {
		$m_name = '*';
	}
	$args = array(
				'role' 				=> 'Subscriber',
	            'meta_key'  		=> 'ms_is_member',
	            'meta_value'    	=> 1,
	            'search'         	=> $m_name,
				'search_columns' 	=> array( 'user_email' ),
				'number'			=> -1
	        );
	$user_query = new WP_User_Query( $args );
	$user_found = $user_query->get_total();
    $users = $user_query->get_results();
    print_r($users);

    if (isset($_GET['ms'])) {
    	if ($user_found != 0) :
	    	echo '<div class="search-results"><h4>Results</h4><ul class=" row">';
	    	foreach ($users as $user) {
	    		$user_id = $user->ID;
	    		echo '<li class="col-lg-6"><div>';
	    		echo '<img src="'.get_template_directory_uri().'/img/no-profile-pic.png" alt="'.$user->display_name.'">';
	    		echo '<strong>'.$user->display_name.'</strong> ';
	    		echo '<em>'.$user->user_email.'</em> ';
	    		echo '<span>'.get_user_meta($user_id, 'id_number', true).'</span>';
	    		echo '</div></li>';
	    	}
	    	echo '</ul></div>';
	    else :
	    	echo '<p>No member found.</p>';
	    endif;
    }

    $s_query = isset($_POST['ms']);

?>

	

<?php

else :
	echo '<p>You do not have permission to use this form!</p>';
endif;
?>
</div>