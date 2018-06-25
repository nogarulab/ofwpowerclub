<?php

get_header();

if ( is_page('partner-dashboard') ) {

    get_template_part( 'partners/dashboard', get_post_format() );

} elseif ( is_page('agent-dashboard') ) {

    if ( is_user_logged_in() && current_user_can('agent') ) :


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
                                <form name="adding_members" method="POST" >
                                    <h5>Personal Information</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="text" name="lname" class="input-sm form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Middle Name</label>
                                                <input type="text" name="middlename" class="input-sm form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <input type="text" name="first_name" class="input-sm form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <input type="text" name="last_name" class="input-sm form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Gender</label>
                                                <select class="form-control" style="width: 250px">
                                                    <option value="" disabled selected></option>
                                                    <option value="male">Male</option>
                                                    <option value="male">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Date of Birth</label><br/>
                                                <select class="form-control dob-inputs" name="month" style="width: 90px">
                                                    <option value="" disabled selected>Month</option>
                                                    <?php
                                                    foreach(range(1,12) as $index){
                                                        _e("<option>".sprintf('%02d',$index)."</option>");
                                                    }
                                                    ?>
                                                </select> /
                                                <select class="form-control dob-inputs" name="day" style="width: 90px">
                                                    <option value="" disabled selected>Day</option>
                                                    <?php
                                                    foreach(range(1,31) as $index){
                                                        _e("<option>".sprintf('%02d',$index)."</option>");
                                                    }
                                                    ?>
                                                </select> /
                                                <select class="form-control dob-inputs" name="year" style="width: 90px">
                                                    <option value="" disabled selected>YeaYr</option>
                                                    <?php
                                                    foreach(range(date('Y')-10,date('Y')-90) as $index){
                                                        _e("<option>".$index."</option>");
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Contact Number</label>
                                                <input type="text" name="mobile" class="input-sm form-control"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Country of Work</label>
                                                <select name="country_work" class="input-sm form-control country_select">
                                                    <option value="" disabled selected></option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Address in Hong Kong/Place of Work</label>
                                                <input type="text" name="address_work" class="input-sm form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Hong Kong I.D.# / Password Number</label>
                                                <input type="text" name="address_work" class="input-sm form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <h5>Beneficiary Information</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Name of Beneficiary</label>
                                                <input type="text" name="address_work" class="input-sm form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Address of Beneficiary</label>
                                                <input type="text" name="address_work" class="input-sm form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Contact Number</label>
                                                <input type="text" name="address_work" class="input-sm form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Relationship with Beneficiary</label>
                                                <input type="text" name="address_work" class="input-sm form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">

                                        </div>
                                    </div>
                                    <hr/>
                                    <h5>Account Credentials</h5>
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" name="user_login" class="input-sm form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" name="user_pass" class="input-sm form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Re-type Password</label>
                                        <input type="text" name="user_pass" class="input-sm form-control"/>
                                    </div>
                                    <button type="submit" name="submit">Submit</button>
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

    else :

        echo 'You do not have permission to view this page. Please login as an agent to view this page';

    endif;

} else {

    ?>

    <main role="main">
        <!-- section -->
        <section>

            <h1><?php the_title(); ?></h1>

            <?php

            if (have_posts()):
                while (have_posts()) :
                    the_post(); ?>

                    <!-- article -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <?php the_content(); ?>

                        <?php comments_template( '', true ); // Remove if you don't want comments ?>

                        <br class="clear">

                        <?php edit_post_link(); ?>

                    </article>
                    <!-- /article -->

                <?php
                endwhile;
            else:

                ?>

                <!-- article -->
                <article>
                    <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
                </article>
                <!-- /article -->

            <?php

            endif;

            if ( is_page('request-for-partnership') ) {
                get_template_part( 'partners/form', get_post_format() );
            }

            if ( is_page('contact-administrator') ) {
                get_template_part( 'partners/contact', get_post_format() );
            }


            ?>

        </section>
        <!-- /section -->
    </main>

    <?php

    get_sidebar();

}

get_footer();

?>