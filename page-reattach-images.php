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
			    'post_type' => 'attachment',
			    'numberposts' => -1,
			    'post_status' => null,
			    'post_parent' => 0
			);
			$attachments = get_posts($args);
			 if ($attachments) {
			    foreach ($attachments as $post) {
			        setup_postdata($post);
			        the_attachment_link($post->ID);
			       	print_r($post);
			       	echo "is this useful?";
					$uri_string = get_post_meta( $post->ID, '_wp_attached_file', true);
											echo PHP_EOL;

					
					// Search for posts with the matching string...
					$query = new WP_Query( 's=' . $uri_string );
					// print_r($query);
					foreach ($query->posts as $single) {
						print_r($single->ID);
						echo PHP_EOL;
						$success = wp_update_post(
						    array(
						        'ID' => $post->ID, 
						        'post_parent' => $single->ID
						    )
						);
						if ($success) {
							echo "Set post ID: " . $post->ID . " to a post_parent of " . $single->ID . PHP_EOL;
							break;
						}
					}
				}
			 }
				
			echo PHP_EOL;

			?>
			</pre>
		</div>
	</div>

<?php get_footer(); ?>