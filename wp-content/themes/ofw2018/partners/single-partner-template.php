<?php
	if (have_posts()): 
		while (have_posts()) : 
			the_post();
?>
			<img src="<?php  echo $feat_img[0] ?>" alt="" />
			<h1>Name of Establishment: <?php the_title(); ?></h1>
			<div>Description of Establishment: <?php the_content(); ?></div>
			<div>Owner: <?php echo get_post_meta(get_the_ID(), 'establishment_owner', true); ?></div>
			<div><a href="<?php echo get_post_meta(get_the_ID(), 'establishmentwebsite', true); ?>">Click Here To Visit Our Website</a></div>
			<div>
				<h2>Benefits Offered</h2>
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
			        <li>
				        <div>Benefit Name: <?php echo $benefit[0]; ?></div>
				        <div>Benefit Description: <?php echo $benefit[1]; ?></div>
			        </li>
				    <?php
				    }

					?>
				</ul>
			</div>
			<div>
				<h2>Branches</h2>
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
				        <li class="item">
				        <div>Address: <?php echo $branch[1]; ?></div>
				        <div>Location: <?php echo $branch[0]; ?></div>
				        <div>Contact Number: <?php echo $branch[2]; ?></div>
				        <div>Contact Person: <?php echo $branch[3]; ?></div>
				        </li>
				    <?php

				    }

					?>
				</ul>
			</div>

<?php
		endwhile;
	endif;
?>