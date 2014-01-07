<?php

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php //comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			<pre>
			<?php
				$args = array(
					// Change these category SLUGS to suit your use.
					'post_type' => 'sapolicies',
		        	'showposts' => '100',
					// 'paged' => 1
				);
                                
				$list_of_policies = new WP_Query( $args );
				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					echo PHP_EOL . 'post ID: ';
					print_r ($post->ID);

					//Get any postmeta associated with this post
					$geoids = get_post_meta( $post->ID, 'geoid_temp');
					
					if (!empty($geoids)) {
						foreach ($geoids as $geoid) {
							echo PHP_EOL;
							print_r($geoid);
						}
					}

					$terms = get_the_terms( $post->ID, 'geographies' );
					foreach ($terms as $term) {
						echo PHP_EOL;

						$descrip = $term->description;
						if ( in_array($descrip, $geoids)  ) {
							echo 'already got it ';
							print_r($descrip);
						} else {
							echo 'adding the geoid ';
							print_r($descrip);

							add_post_meta( $post->ID, 'geoid_temp', $descrip, true );

						}
						
					}
					echo PHP_EOL;

					//comments_template( '', true );
		        endwhile; // end of the loop.

			?>
			</pre>
		</div>
	</div>

<?php get_footer(); ?>