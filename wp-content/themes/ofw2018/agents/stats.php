<div class="total-members-added">
	<?php
	$current_user = wp_get_current_user();

    echo '<h2>Hello '.$current_user->first_name.'</h2>';
    echo '<h3>Statistics</h3>';
	$total_ma_args = array(
		'role' 			=> 'Subscriber',
		'meta_query'    => array(
            'relation'  => 'AND',
            array(
                'meta_key' => 'ms_is_member',
                'value'     => 1
            ),
            array(
                'meta_key' => 'agent_id',
                'value'     => $current_user->ID
            )
        ),
        'number'        => -1
	);
	$total_ma_query = new WP_User_Query( $total_ma_args );

	$total_aa_args = array(
        'role'          => 'Subscriber',
        'meta_key'      => 'agent_id',
        'meta_value'    => $current_user->ID,
        'number'        => -1
    );
    $total_aa_query = new WP_User_Query( $total_aa_args );
    $total_np_query = abs($total_aa_query->get_total() - $total_ma_query->get_total());

	echo '<p>Total Applicants Added: '.$total_aa_query->get_total().'</p>';
    echo "<p>Applicant's Membership Activated: ".$total_ma_query->get_total()."</p>";
    echo '<p>Applicants Not Yet Activated: '.$total_np_query.'</p>';
    echo '<p>Your Total Points: '.($total_ma_query->get_total() * 5).'</p>'
	?>
</div>