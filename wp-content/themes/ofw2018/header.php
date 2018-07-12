<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" rel="shortcut icon">
        
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta name="keywords" content="Power Club, Pinoy Power Club, Filipino Power Club, OFW Power Club, OFW Membership">
		<meta name="keywords" content="">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>

    	<div id="preloader">
			<div id="status">&nbsp;</div>
		</div>

		<div class="wrapper">

			<header class="header clear" role="banner">
				<div class="logged-in-account">
					<div class="container text-right">
					<?php
					if ( is_user_logged_in() ) {
						$acurrent_user = wp_get_current_user();
						$firstname = get_user_meta($acurrent_user->ID, 'first_name', true);
						$user = wp_get_current_user();
    					$role = ( array ) $user->roles;
    					if ( $role[0] == 'subscriber' ) {
    						echo '<span>Hello '.$firstname.' | <a href="'.home_url().'/account">My Account</a> | <a href="'.wp_logout_url( home_url() ).'">Logout</a></span>';
    					} else {
    						echo '<span>Hello '.$firstname.' | <a href="'.home_url().'/wp-admin">My Dashboard</a> | <a href="'.wp_logout_url( home_url() ).'">Logout</a></span>';
    					}
					}
					?>						
					</div>
				</div>
				<div class="mid-header py-2">
					<div class="container">
						<div class="row align-items-center justify-content-between">
							<div class="col-xl-2 col-lg-3 col-md-4 col-sm-5">
								<a href="<?php echo home_url(); ?>">
									<?php 
									$data = url_get_contents(get_template_directory_uri().'/img/logo.svg');
									echo $data;
									?>
									<h1 class="d-none"><?php bloginfo('name'); ?></h1>
								</a>
							</div>
							<?php 
							get_template_part( 'partners/partner-dashboard-menu', get_post_format() );
							get_template_part( 'agents/agent-dashboard-menu', get_post_format() );
							?>
							<div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 site-search">
								<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
							</div>
						</div>
					</div>
				</div>
				
				<nav class="navbar navbar-expand-lg navbar-dark">
					<div class="container">
						
						<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
	    					<span class="navbar-toggler-icon"></span>
	  					</button> 
	  					<div class="d-flex align-items-center order-lg-last">
							<?php 
								if ( is_user_logged_in() ) {
							?>
								<div class="login-links">
									<a href="<?php echo wp_logout_url( home_url() ); ?>"><button class="btn-partner">Log Out</button></a>
								</div>
							<?php 
								} else {
							?>	
								<div class="login-links">
									<a href="<?php echo home_url(); ?>/member-login"><button class="btn-member">Member Login</button></a>
								</div>
								<div class="login-links">
									<a href="<?php echo esc_url( wp_login_url() ); ?>"><button class="btn-partner">Partner Login</button></a>
								</div>
							<?php 
								}
							?>

						</div>
	  					<div class="collapse navbar-collapse mt-3 mt-lg-0" id="mainNav">
							<?php wp_nav_menu(array('menu' => 'Main Menu', 'items_wrap' => '<ul class="navbar-nav d-flex order-lg-first">%3$s</ul>'))?>
						</div>
						
					</div>
				</nav>
				
			</header>
