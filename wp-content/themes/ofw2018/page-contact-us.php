<?php get_header();
if (have_posts()):
    while (have_posts()) :
        the_post();

        $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 

        $office_lat = get_field('latitude');
        $office_lng = get_field('longitude');
?>
<div class="contact-us">

	<section class="page-banner py-5 white text-uppercase" style="background-image:url(<?php echo $featuredImage; ?>);">
		<div class="container py-5">
			<div class="row">
				<div class="col text-center">
					<h2 class="font-weight-bold "><?php the_title(); ?></h2>
					<span class="bread-crumbs">Home // <a href="<?php the_permalink() ?>" class="yellow transition"><?php the_title(); ?></a></span>
				</div>
			</div>
		</div>
	</section>
	
<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'contact-us'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>

	<div class="container">
		<div class="row">
			
			<div class="col-md-6">
				<?php echo do_shortcode("[contact-form-7 id='155' title='Contact Us']"); ?>
			</div>
			<div class="col-md-6">
				<div class="contact-details">
					<div><strong>Phone</strong> <?php the_field('phone'); ?></div>
					<div><strong>Email</strong> <span class="backward"><?php the_field('email'); ?></div></span>
					<div>
						<strong>Location</strong>
						<address>
							<?php the_field('location'); ?>
						</address>
					</div>
				</div>
			</div>

		</div>
	</div>

<?php 
	endwhile; wp_reset_query(); 
?>

</div>
<?php 
	get_sidebar('connect');
?>
<div class="map">
	<?php echo do_shortcode('[put_wpgm id=1]'); ?>
</div>
<?php 
	endwhile;
endif;
get_footer();  ?>