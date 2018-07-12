
<?php get_header();  ?>

<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );  ?>

<?php $termname = $term->name; ?>

<div class="store-container">
<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'store'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
	$featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
?>

<section class="page-banner py-5 white text-uppercase" style="background-image:url(<?php echo $featuredImage; ?>);">
	<div class="container py-5">
		<div class="row">
			<div class="col text-center">
				<h2 class="font-weight-bold "><?php echo $termname; ?></h2>
				<span class="bread-crumbs">Home // <a href="<?php the_permalink() ?>" class="yellow transition"><?php the_title(); ?></a></span>
			</div>
		</div>
	</div>
</section>

<?php 
	endwhile; wp_reset_query(); 
?>

<section class="our-products py-5">
	<div class="container">
		<div class="row">
			
			<div class="col-lg-9 prod-list order-lg-last">

				
					<?php get_template_part('loop-products'); ?>
					<?php wp_pagenavi(); ?>
				

			</div>
			<div class="col-lg-3 order-lg-first">
				
					<ul class="categories col-12"> 
						<?php wp_list_categories( array(
					        'taxonomy' => 'prod_cat',
					        'title_li' => ''
					    ) ); ?> 
				    </ul>
			    
			</div>
		</div>
	</div>
</section>



</div>

<?php get_footer();  ?>