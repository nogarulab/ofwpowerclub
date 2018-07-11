<?php /* Template Name: OFW Power Club Template */ 

get_header();
global $post;

if (have_posts()):
    while (have_posts()) :
        the_post();

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
				<!-- <?php if( $post->ID == 325): { ?>
					<form class="ms-membership-form" action="http://ofwpowerclub.nogarulab.com/register/" method="post"><input id="_wpnonce" name="_wpnonce" type="hidden" value="1b47ff460d" />
						<input name="_wp_http_referer" type="hidden" value="/register/" />
						<input id="membership_id" class="wpmui-field-input wpmui-hidden" name="membership_id" type="hidden" value="342" />
						<input id="action" class="wpmui-field-input wpmui-hidden" name="action" type="hidden" value="membership_signup" />
						<input id="step" class="wpmui-field-input wpmui-hidden" name="step" type="hidden" value="payment_table" />
						<button id="submit" class="wpmui-field-input button ms-signup-button membership_signup wpmui-submit button-primary black rounded bg-yellow py-3 px-5 d-inline-block mb-3" name="submit" type="submit" value="">Apply Now</button>
					</form>
				<?php } ?> -->
			</section>
		</div>
	</div>
</div>
<?php endwhile; ?>
<?php else: ?>
	<div class="container">
		<div class="row">
			<div class="col-12 py-5">
				<h3>Sorry, nothing to display.</h3>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php get_sidebar('testimonies') ?>


</div>
<?php get_footer(); ?>
