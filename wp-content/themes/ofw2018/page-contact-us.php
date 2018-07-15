<?php /* Template Name: Contact Us */ 

 get_header();
if (have_posts()):
    while (have_posts()) :
        the_post();

        $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
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
	
	<div class="container">
		<div class="row">
			
			<div class="col-md-6">
				<?php the_content(); ?>
			</div>

			<?php 
				get_sidebar('contact');
			?>
			

		</div>
	</div>

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