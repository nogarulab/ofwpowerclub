
<?php
if ( is_user_logged_in() && current_user_can('partner') ) :
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
				'search_columns' 	=> array( 'display_name, user_email' ),
				'number'			=> -1
	        );
	$user_query = new WP_User_Query( $args );

    $users = $user_query->get_results();

    if (isset($_GET['ms'])) {
    	//print_r($users);
    	foreach ($users as $user) {
    		echo $user->display_name;
    	}
    }

    $s_query = isset($_POST['ms']);

?>

	<form action="<?php echo home_url(); ?>/member-search?ms=<?php echo $s_query; ?>" method="GET">
		<input type="text" name="ms" value="" />
    	<input type="submit" value="Search">
	</form>

<?php

else :
	echo '<p>You do not have permission to use this form!</p>';
endif;
?>