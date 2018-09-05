<div class="single-partners">
<?php
	if (have_posts()): 
		while (have_posts()) : 
			the_post();
			$feat_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
?>
	
	<div class="single-banner py-5">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-4 col-md-5">
					<img src="<?php  echo $feat_img[0] ?>" alt="<?php the_title(); ?>" class="img-fluid d-block mx-auto mb-5 mb-md-0"/>
				</div>
				<div class="col-lg-8 col-md-7">
					<div class="about">
						<div class="row">
							<div class="col-lg-9 col-md-10 ml-auto">
								<h2 class="text-uppercase font-weight-bold blue">About <?php the_title(); ?></h2>
								<?php the_content(); ?>

								<?php $web = get_post_meta( $post->ID, 'establishmentwebsite', true ); ?>
								<?php if(!($web == null || $web == '')){ ?>
									<a target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'establishmentwebsite', true); ?>" class="white transition h-c-white rounded bg-red py-3 px-5 d-inline-block mt-3">Visit our Website</a>
								<?php } ?> 

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="owner-section py-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-8 col-sm-10 text-center">
					<?php $owner = get_post_meta(get_the_ID(), 'establishment_owner', true); ?>
					<?php if( !empty( $owner) ) : ?> 
					<div class="owner-container py-1">
						<h3 class="text-uppercase font-weight-bold mb-0"><?php echo $owner; ?></h3>
						<p class="mb-0 owner">OWNER</p>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="benefits-branches pb-5">
		<div class="container">
			<div class="row">
				<div class="col-md-6 mb-3">
					<h3 class="font-weight-bold blue">Benefits Offered</h3>
					<ul>
						<?php

						$benefits_offered = get_post_meta(get_the_ID(), 'benefits_offered', true);
					    $benefits = [];

					    for ($i=0;$i<count($benefits_offered['name']);$i++) {
					        array_push($benefits, array($benefits_offered['name'][$i]));
					        array_push($benefits[$i], $benefits_offered['description'][$i]);
					    }

					    foreach ($benefits as $benefit) {
					    ?>
				        <li class="mb-3">
					        <h4 class="font-weight-bold"><?php echo $benefit[0]; ?></h4>
					        <p><?php echo $benefit[1]; ?></p>
				        </li>
					    <?php
					    }

						?>
					</ul>
				</div>
				<div class="col-md-6">
					<h3 class="font-weight-bold blue">Branches</h3>
					<ul>
						<?php

						$available_branches = get_post_meta(get_the_ID(), 'branches', true);
					    $branches = [];

					    for ($i=0;$i<count($available_branches['location']);$i++) {
					        array_push($branches, array($available_branches['location'][$i]));
					        array_push($branches[$i], $available_branches['address'][$i]);
					        array_push($branches[$i], $available_branches['contact_no'][$i]);
					        array_push($branches[$i], $available_branches['contact_person'][$i]);
					    }

					    foreach ($branches as $branch) {
					    ?>
					        <li class="mb-3">
						        <div class="d-flex"><span class="blue font-weight-bold mr-2">Address:</span> <?php echo $branch[1]; ?></div>
						        <div class="d-flex"><span class="blue font-weight-bold mr-2">Location:</span> <?php echo $branch[0]; ?></div>
						        <div class="d-flex"><span class="blue font-weight-bold mr-2">Contact Number:</span> <?php echo $branch[2]; ?></div>
						        <div class="d-flex"><span class="blue font-weight-bold mr-2">Contact Person:</span> <?php echo $branch[3]; ?></div>
					        </li>
					    <?php

					    }

						?>
					</ul>
				</div>
			</div>
		</div>
	</div>

<?php
		endwhile;
	endif;
?>

</div>