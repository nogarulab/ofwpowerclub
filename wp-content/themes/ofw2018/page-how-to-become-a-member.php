<?php /* Template Name: Be A Member */ 

get_header();


	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'home'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
?>
	<div class="default-template">

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
			<div class="col-12">
				<section class="py-5">
					<?php the_content(); ?>
					<form class="ms-membership-form" action="http://ofwpowerclub.nogarulab.com/register/" method="post"><input id="_wpnonce" name="_wpnonce" type="hidden" value="1b47ff460d" />
							<input name="_wp_http_referer" type="hidden" value="/register/" />
							<input id="membership_id" class="wpmui-field-input wpmui-hidden" name="membership_id" type="hidden" value="342" />
							<input id="action" class="wpmui-field-input wpmui-hidden" name="action" type="hidden" value="membership_signup" />
							<input id="step" class="wpmui-field-input wpmui-hidden" name="step" type="hidden" value="payment_table" />
							<button id="submit" class="wpmui-field-input button ms-signup-button membership_signup wpmui-submit button-primary black rounded bg-yellow py-3 px-5 d-inline-block mb-3" name="submit" type="submit" value="">Apply Now</button>
						</form>
				</section>
			</div>
		</div>
	</div>
<?php 
	endwhile; wp_reset_query(); 
?>
	

<?php get_sidebar('testimonies') ?>


</div>
<?php get_footer(); ?>
