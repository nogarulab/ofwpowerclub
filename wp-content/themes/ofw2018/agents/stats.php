<div class="total-members-added">
	<?php
	$current_user = wp_get_current_user();

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

	// echo '<p>Total Applicants Added: '.$total_aa_query->get_total().'</p>';
     //    echo "<p>Applicant's Membership Activated: ".$total_ma_query->get_total()."</p>";
     //    echo '<p>Applicants Not Yet Activated: '.$total_np_query.'</p>';
     //    echo '<p>Your Total Points: '.($total_ma_query->get_total() * 5).'</p>'
	?>
    <div class="points">
        <div class="row">
            <div class="col-lg-6">
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">This Week</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Registered</th>
                                <td>15</td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td>3</td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td>15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">This Month</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Registered</th>
                                <td>15</td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td>3</td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td>15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">This Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Registered</th>
                                <td>15</td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td>3</td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td>15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Overall Numbers</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Registered</th>
                                <td><?php echo $total_aa_query->get_total(); ?></td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td><?php echo $total_ma_query->get_total(); ?></td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td><?php echo ($total_ma_query->get_total() * 5); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>