/* Adding Members */
function add_user_with_roles(){
    /* Inserting Users in WP*/
    $user_id = wp_insert_user( $_POST ) ;
    /* Checking if not error*/
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
//    return '';
    if ( ! is_wp_error( $user_id ) ) {
        /***
         * Adding additional metakey in user meta
         * agent_id ~ Current User ID
         */
        extract($_POST);

        echo $user_pass1;

        update_user_meta( $user_id, 'agent_id', get_current_user_id());
        update_user_meta( $user_id, 'middle_name', $middle_name);
        update_user_meta( $user_id, 'ms_custom_data', "a:0:{}");
        update_user_meta( $user_id, 'ms_email', $user_email);
        update_user_meta( $user_id, 'ms_gateway_profiles', "a:0:{}");
        update_user_meta( $user_id, 'ms_id', $user_id);
        update_user_meta( $user_id, 'ms_is_member', 1);
        update_user_meta( $user_id, 'ms_first_name', $first_name);
        update_user_meta( $user_id, 'contact_number', '');
        update_user_meta( $user_id, 'ms_last_name', $last_name);
        update_user_meta( $user_id, 'ms_name', $first_name.' '.$last_name);
        update_user_meta( $user_id, 'ms_subscriptions', 'a:1:{i:0;O:21:"MS_Model_Relationship":28:{s:16:"');
        update_user_meta( $user_id, 'ms_username', $user_email);

        /***
        ms_custom_data : a:0:{}
        ms_email : user_email
        ms_first_name : first_name
        ms_gateway_profiles : a:0:{}
        ms_id : $user_id
        ms_is_member : 1
        ms_last_name : last_name
        ms_name : first_name.' '.last_name
        ms_subscriptions : a:1:{i:0;O:21:"MS_Model_Relationship":28:{s:16:"
        ms_username : user_login
         *
         * update_post_meta( $post_id, $meta_key, $meta_value, $prev_value ); ?>
         */
        $membership_id = 25;
        $membership_post = [];
        $membership_post['post_author'] = $user_id;
        $membership_post['post_content'] = "user_id: ".$user_id.", membership_id: ".$membership_id;
        $membership_post['post_title'] = "user_id-$user_id-membership_id-$membership_id";
        $membership_post['post_excerpt'] = "user_id: ".$user_id.", membership_id: ".$membership_id;
        $membership_post['post_status'] = "private";
        $membership_post['comment_status'] = "closed";
        $membership_post['ping_status'] = "closed";
        $membership_post['post_password'] = "";
        $membership_post['post_name'] = "user_id-$user_id-membership_id-$membership_id";
        $membership_post['to_ping'] = "";
        $membership_post['pinged'] = "";
        $membership_post['post_type'] = "ms_relationship";

        $post_id = wp_insert_post( $membership_post);

        $membership_post_update['id'] = $post_id;
        $membership_post_update['guid'] = "http://localhost/ofwpowerclub/ms_relationship/$post_id/";
        wp_insert_post( $membership_post_update);

        $post_meta =[];
        $post_meta['cancelled_memberships'] = '';
        $post_meta['current_invoice_number'] = 1;
        $post_meta['custom_data'] = 'a:0:{}';
        $post_meta['description'] = $membership_post['post_content'];
        $post_meta['email_log'] = 'a:0:{}';
        $post_meta['expire_date'] = date('Y-m-d',strtotime("+30 days"));
        $post_meta['gateway_id'] = 'admin';
        $post_meta['id'] = $post_id;
        $post_meta['is_simulated'] = '';
        $post_meta['membership_id'] = $membership_id;
        $post_meta['move_from_id'] = 0;
        $post_meta['cancelled_memberships'] = '';
        $post_meta['name'] = $membership_post['post_content'];
        $post_meta['payment_type'] = 'recurring';
        $post_meta['payments'] = 'a:0:{}';
        $post_meta['post_modified'] = date('Y-m-d H:i:s');
        $post_meta['source'] = '';
        $post_meta['source_id'] = '';
        $post_meta['start_date'] = date('Y-m-d');
        $post_meta['status'] = 'active';
        $post_meta['title'] = '';
        $post_meta['trial_expire_date'] = '';
        $post_meta['trial_period_completed'] = '';
        $post_meta['user_id'] = $user_id;

        foreach($post_meta as $key=>$pm){
            add_post_meta( $post_id,  $key,  $pm );
        }

        $membership_post = [];
        $membership_post['post_author'] = $user_id;
        $membership_post['post_content'] = "Has signed up to membership member.";
        $membership_post['post_title'] = "user-".$first_name."-".$last_name."-membership-member-type-signed_up";
        $membership_post['post_excerpt'] = "Has signed up to membership member.";
        $membership_post['post_status'] = "private";
        $membership_post['comment_status'] = "closed";
        $membership_post['ping_status'] = "closed";
        $membership_post['post_password'] = "";
        $membership_post['post_name'] = "user-".$first_name."-".$last_name."-membership-member-type-signed_up";
        $membership_post['to_ping'] = "";
        $membership_post['pinged'] = "";
        $membership_post['post_type'] = "ms_event";

        $post_meta_id = wp_insert_post( $membership_post );

        $post_meta =[];
        $post_meta['custom_data'] = 'a:0:{}';
        $post_meta['date'] = date('Y-m-d');
        $post_meta['description'] = 'Has signed up to membership member.';
        $post_meta['id'] = 0;
        $post_meta['ms_relationship_id'] = $post_id;
        $post_meta['membership_id'] = $membership_id;
        $post_meta['name'] = "user: ".$first_name." ".$last_name.", membership: member, type: signed_up";
        $post_meta['post_modified'] = date('Y-m-d H:i:s');
        $post_meta['title'] = '';
        $post_meta['topic'] = 'membership';
        $post_meta['type'] = 'singed_up';
        $post_meta['user_id'] = $user_id;

        foreach($post_meta as $key=>$pm){
            add_post_meta( $post_meta_id,  $key,  $pm );
        }

        /***
         * JUST AND PROMPT
         */
        echo "User created  ";
        echo '<div class="sendtouser" data-username="'.$user_email.'" data-password="" data-toemail="'.$user_email.'" data-name="'.$first_name.' '.$last_name.'">';
        echo do_shortcode('[contact-form-7 id="270" title="Send Payment Options To User Email"]');
        echo '</div>';
        print_r($_POST);

    }else{
        echo "there was an error";
    }
}
add_action('add_members', 'add_user_with_roles');

/* SUBMIT do action Add Members*/
        if(isset($_POST['submit']))
        {
            do_action('add_members');
        }else{ 
            ?>
            <!-- SIMPLE FORM -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form name="adding_members" method="POST">
                                    <h5>Personal Information</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="text" name="user_email" class="input-sm form-control" value="member6@gmail.com "/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <input type="text" name="first_name" class="input-sm form-control" value="fname"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Middle Name</label>
                                                <input type="text" name="middle_name" class="input-sm form-control" value="mname"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <input type="text" name="last_name" class="input-sm form-control" value="lname"/>
                                            </div>
                                            <h5>Account Credentials</h5>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input type="text" name="user_pass1" required class="input-sm form-control" value="qweqwe"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Re-type Password</label>
                                                <input type="text" name="user_pass2" required class="input-sm form-control" value="qweqwe"/>
                                            </div>
                                            <button type="submit" name="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <style>
                .dob-inputs{
                    display: inline-block;
                }
            </style>


            <script>
                (function(){
                    jQuery.ajax({
                        url: window.location.pathname.replace('agent-dashboard','')+'/wp-content/themes/ofw2018/js/countries.json',
                        type:'GET',
                        dataType: 'json',
                        success:function(_data_country_json){
                            jQuery.each(_data_country_json, function(i, val){
                                jQuery('.country_select').append(jQuery('<option />', { value: val.value, text: val.label }));
                            });
                        }
                    });
                })();
            </script>

        <?php
        }

        echo '<a href="'. wp_logout_url( home_url() ) .'">Logout</a>';