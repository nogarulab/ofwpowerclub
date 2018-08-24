<?php get_header();  ?>

<div class="partners-container">
<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'partners'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
	$featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
?>

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
	endwhile; wp_reset_query(); 
?>

<section class="our-partners py-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<ul>
					<li class="d-inline-block d-lg-block"><a class="transition all d-inline d-lg-block mb-1 mb-md-2 mb-lg-3 mb-xl-4" href="<?php echo home_url(); ?>/partners">All</a></li>
					<?php 
						$terms = get_terms( 'partner_category' );
						foreach ( $terms as $term ) {
						    $term_link = get_term_link( $term );
						    if ( is_wp_error( $term_link ) ) {
						        continue;
						    }
						    echo '<li class="d-inline-block d-lg-block"><a href="' . esc_url( $term_link ) . '" class="transition d-inline d-lg-block mb-1 mb-md-2 mb-lg-3 mb-xl-4">' . $term->name . '</a></li>';
						}
					?>
				</ul>
			</div>
			<div class="col-lg-9">
				<?php get_template_part('loop-partners'); ?>
				<?php wp_pagenavi(); ?>
			</div>
		</div>
	</div>
</section>

<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'partners'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
<section class="partner-bottom bg-yellow py-4">
	<div class="container">
		<div class="partner-invite-text"><?php the_content(); ?></div>
		<a href="<?php echo home_url(); ?>/request-for-partnership" class="white transition h-c-white rounded bg-blue py-3 px-5 d-inline-block btn-beapartner">Be a Partner</a>
	</div>
</section>
<?php 
	endwhile; wp_reset_query(); 
?>

</div>

<?php get_footer();  ?>