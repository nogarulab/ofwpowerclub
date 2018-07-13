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
    $overall_aa = $total_aa_query->get_total();
    $overall_ma = $total_ma_query->get_total();
    $aa_IDS = [];
    $ma_IDS = [];
    foreach ( $total_ma_query->get_results() as $user ) {
        $ma_IDS[] = $user->ID;
    }
    foreach ( $total_aa_query->get_results() as $user ) {
        $aa_IDS[] = $user->ID;
    }
    $week_aa_args = array(
        'post_type' => 'ms_invoice',
        'post_status' => 'private',
        'author'    => implode(',',$aa_IDS),
        'number'    => -1,
        'date_query' => array(
            array(
                'year' => date( 'Y' ),
                'week' => date( 'W' ),
            ),
        ),
    );
    $week_aa_query = new WP_Query( $week_aa_args );

    if ( $week_aa_query->have_posts() ) {
        // The 2nd Loop
        while ( $week_aa_query->have_posts() ) {
            $week_aa_query->the_post();
            echo '<li>' . get_the_title( ) . '</li>';
        }

        // Restore original Post Data
        wp_reset_postdata();
    }
    $week_aa_count = count($week_aa_query->get_posts());
    $month_aa_args = array(
        'post_type' => 'ms_invoice',
        'post_status' => 'private',
        'author'    => implode(',',$aa_IDS),
        'number'    => -1,
        'date_query' => array(
            array(
                'year' => date( 'Y' ),
                'month' => date( 'M' ),
            ),
        ),
    );
    $month_aa_query = new WP_Query( $month_aa_args );
    $month_aa_count = count($month_aa_query->get_posts());
    $year_aa_args = array(
        'post_type' => 'ms_invoice',
        'post_status' => 'private',
        'author'    => implode(',',$aa_IDS),
        'number'    => -1,
        'date_query' => array(
            array(
                'year' => date( 'Y' ),
            ),
        ),
    );
    $year_aa_query = new WP_Query( $year_aa_args );
    $year_aa_count = count($year_aa_query->get_posts());


    $week_ma_args = array(
        'post_type' => 'ms_event',
        'post_status' => 'private',
        's' => 'user-membership-ofw-power-club-membership-type-paid',
        'author'    => implode(',',$ma_IDS),
        'number'    => -1,
        'date_query' => array(
            array(
                'year' => date( 'Y' ),
                'week' => date( 'W' ),
            ),
        ),
    );
    $week_ma_query = new WP_Query( $week_ma_args );


    $week_ma_count = count($week_ma_query->get_posts());
    $month_ma_args = array(
        'post_type' => 'ms_event',
        'post_status' => 'private',
        's' => 'user-membership-ofw-power-club-membership-type-paid',
        'author'    => implode(',',$ma_IDS),
        'number'    => -1,
        'date_query' => array(
            array(
                'year' => date( 'Y' ),
                'week' => date( 'W' ),
            ),
        ),
    );
    $month_ma_query = new WP_Query( $month_ma_args );

    if ( $month_ma_query->have_posts() ) {
        // The 2nd Loop
        while ( $month_ma_query->have_posts() ) {
            $month_ma_query->the_post();
            echo '<li>' . get_the_title( ) . '</li>';
        }

        wp_reset_postdata();
    }
    $month_ma_count = count($month_ma_query->get_posts());
    $year_ma_args = array(
        'post_type' => 'ms_event',
        'post_status' => 'private',
        's' => 'user-membership-ofw-power-club-membership-type-paid',
        'author'    => implode(',',$ma_IDS),
        'number'    => -1,
        'date_query' => array(
            array(
                'year' => date( 'Y' ),
                'week' => date( 'W' ),
            ),
        ),
    );
    $year_ma_query = new WP_Query( $year_ma_args );
    $year_ma_count = count($year_ma_query->get_posts());

    //	 echo '<p>Total Applicants Added: '.$total_aa_query->get_total().'</p>';
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
                                <td><?php _e($week_aa_count)?></td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td><?php _e($week_ma_count)?></td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td><?php _e($week_ma_count * 5)?></td>
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
                                <td><?php _e($month_aa_count)?></td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td><?php _e($month_ma_count)?></td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td><?php _e($month_ma_count * 5)?></td>
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
                                <td><?php _e($year_aa_count)?></td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td><?php _e($year_ma_count)?></td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td><?php _e($year_ma_count * 5)?></td>
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
                                <td><?php echo $overall_aa; ?></td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td><?php echo $overall_ma; ?></td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td><?php echo ($overall_ma * 5); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>