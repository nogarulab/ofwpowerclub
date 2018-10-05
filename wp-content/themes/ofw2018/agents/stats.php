<?php
    $current_user = wp_get_current_user();
    $thisUser = $current_user->ID;
    $points = 5;
    $keyword = 'Has registered.';

    /** 1 . GET ALL REGISTER USERS */
    //get all the user id's that this user added
    $arui_args = array(
        'role'          => 'Subscriber',
        'meta_key'      => 'agent_id',
        'meta_value'    => $thisUser,
        'number'        => -1
    );
    $all_registered_user_ids = get_users( $arui_args );

    $all_registered_user_ids_list = [];

    //print_r($all_registered_user_ids->user_registered);
    if(count($all_registered_user_ids)>0){
        foreach($all_registered_user_ids as $all_registered_user_id) {
            $all_registered_user_ids_list[] = $all_registered_user_id->ID;
        }
        $overall_total_registered       = count($all_registered_user_ids_list);
    }else{
        $overall_total_registered       = 0;
    }

    //ger all users that are members
    $ami_args = array(
        'include'       => $all_registered_user_ids_list,
        'meta_key'      => 'ms_is_member',
        'meta_value'    => 1
    );
    $all_member_ids = get_users( $ami_args );
    $all_added_member_ids_list = [];

    if(count($all_member_ids)>0){
        foreach($all_member_ids as $all_member_id) {
            $all_added_member_ids_list[] = $all_member_id->ID;
        }
        $overall_total_member           = count($all_added_member_ids_list);
    }else{
        $overall_total_member           = 0;
    }

    //get all users registered this week
    if($overall_total_registered!=0) {
        $rtwui = array(
            'include' => $all_registered_user_ids_list,
            'date_query' => array(
                array(
                    'year' => current_time('Y'),
                    'week' => current_time('W')
                )
            ),
            'number' => -1
        );
        $registered_this_week_user_ids = get_users($rtwui);

        $registered_this_week_user_ids_list = [];

        foreach ($registered_this_week_user_ids as $registered_this_week_user_id) {
            $registered_this_week_user_ids_list[] = $registered_this_week_user_id->ID;
        }

        $total_registered_this_week = count($registered_this_week_user_ids_list);


        /* MONTH */

        //get all users registered this month
        $rtmui = array(
            'include'       => $all_registered_user_ids_list,
            'date_query'    => array(
                array(
                    'year' => current_time( 'Y' ),
                    'month' => current_time( 'm' ),
                )
            ),
            'number'        => -1
        );
        $registered_this_month_user_ids = get_users( $rtmui );

        $registered_this_month_user_ids_list = [];

        foreach($registered_this_month_user_ids as $registered_this_month_user_id) {
            $registered_this_month_user_ids_list[] = $registered_this_month_user_id->ID;
        }

        $total_registered_this_month = count($registered_this_month_user_ids_list);

        //get all users registered this year
        $rtyui = array(
            'include'       => $all_registered_user_ids_list,
            'date_query'    => array(
                array(
                    'year' => current_time( 'Y' )
                )
            ),
            'number'        => -1
        );
        $registered_this_year_user_ids = get_users( $rtyui );

        $registered_this_year_user_ids_list = [];

        foreach($registered_this_year_user_ids as $registered_this_year_user_id) {
            $registered_this_year_user_ids_list[] = $registered_this_year_user_id->ID;
        }
        $total_registered_this_year     = count($registered_this_year_user_ids_list);

    }else{
        $total_registered_this_week     = 0;
        $total_registered_this_month    = 0;
        $total_registered_this_year     = 0;
    }

    if($overall_total_member!=0){

        //get all users that are members for this week

        $mftw_args = array(
            'post_type'         => 'ms_event',
            'post_status'       => 'private',
            'author'            => implode(',',$all_added_member_ids_list),
            's'                 => $keyword,
            'posts_per_page'    => -1,
            'date_query'    => array(
                array(
                    'year' => current_time( 'Y' ),
                    'week' => current_time( 'W' )
                )
            )
        );
        $members_for_this_week = new WP_Query($mftw_args);

        $total_members_this_week        = count($members_for_this_week->posts);

        //get all users that are members for this month

        /*MOTNH MEMBERS*/
        $mftm_args = array(
            'post_type'         => 'ms_event',
            'post_status'       => 'private',
            'author'            => implode(',',$all_added_member_ids_list),
            's'                 => $keyword,
            'posts_per_page'    => -1,
            'date_query'    => array(
                array(
                    'year' => current_time( 'Y' ),
                    'month' => current_time( 'm' )
                )
            )
        );
        $members_for_this_month = new WP_Query($mftm_args);
        $total_members_this_month        = count($members_for_this_month->posts);

        /* YEAR */
        //get all users that are members for this year
        $mfty_args = array(
            'post_type'         => 'ms_event',
            'post_status'       => 'private',
            'author'            => implode(',',$all_added_member_ids_list),
            's'                 => $keyword,
            'posts_per_page'    => -1,
            'date_query'    => array(
                array(
                    'year' => current_time( 'Y' )
                )
            )
        );
        $members_for_this_year = new WP_Query($mfty_args);
        $total_members_this_year        = count($members_for_this_year->posts);


    }else{
        $total_members_this_week        = 0;
        $total_members_this_month       = 0;   
        $total_members_this_year        = 0;

    }



?>

<div class="total-members-added">
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
                                <td><?php echo $total_registered_this_week; ?></td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td><?php echo $total_members_this_week; ?></td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td><?php echo $total_members_this_week * $points; ?></td>
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
                                <td><?php echo $total_registered_this_month; ?></td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td><?php echo $total_members_this_month; ?></td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td><?php echo $total_members_this_month * $points; ?></td>
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
                                <td><?php echo $total_registered_this_year; ?></td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td><?php echo $total_members_this_year; ?></td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td><?php echo $total_members_this_year * $points; ?></td>
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
                                <td><?php echo $overall_total_registered; ?></td>
                            </tr>
                            <tr>
                                <th>Members</th>
                                <td><?php echo $overall_total_member; ?></td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td><?php echo $overall_total_member * $points; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>