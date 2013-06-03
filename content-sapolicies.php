<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

//print_r($post);
// echo 'META:';

$custom_fields = get_post_custom($post->ID);
$terms = get_the_terms( $post->ID, 'sa_advocacy_targets' );
	foreach ( $terms as $term ) {
		$advocacy_targets[] = '<a href="' .get_term_link($term->slug, 'sa_advocacy_targets') .'">'.$term->name.'</a>';
		$target_icons[] = $term->slug;
	}
	$advocacy_targets = join( ', ', $advocacy_targets );

$tags = get_the_terms( $post->ID, 'sa_policy_tags' );
	foreach ( $tags as $tag ) {
		$policy_tags[] = '<a href="' . get_term_link($tag->slug, 'sa_policy_tags') .'">'.$tag->name.'</a>';
	}
	$policy_tags = join( ', ', $policy_tags );
// print_r($tags);
// echo $policy_tags;

// echo '<pre>';
// print_r($custom_fields); 
// echo '</pre>';

// echo "<br />";

//Location
	// $location = $custom_fields['sa_finalgeog'][0];
	//

//Progress meter
	$progress = $custom_fields['sa_policystage'][0];
		switch ($progress) {
	    case "Pre Policy":
	        $percentage = 25;
	        $progress_label = "in pre-policy";
	        break;
	    case "Develop Policy":
			$percentage = 50;
	        $progress_label = 'in development';
	        break;
	    case "Enact Policy":
			$percentage = 75;
	        $progress_label = 'enacted';
	       	break;
	    case "Post Policy":
			$percentage = 75;
	        $progress_label = 'in post-policy';
	       	break;
		}
	//echo $progress_label . " " . $percentage;

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<header class="entry-header clear">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php //echo "<br />"; ?>
				<?php if ( isset( $target_icons ) ) {
						foreach ($target_icons as $target_icon) {
							echo '<span class="' . $target_icon . 'x30"></span>';
						}
					}
				?>
				<p class="location"><?php //echo $location; 
						if (function_exists('salud_the_location')) {
							salud_the_location();
						}
					?></p>
				<div class="meter-box clear">
					<p>This policy is <a href="/saresources/policy-stages/" title="More information about policy development"><?php echo $progress_label; ?></a>.
					<div class="meter nostripes">
						<span style="width: <?php echo $percentage; ?>%"><span></span></span>
					</div>
				</div> <!-- end .meter-box -->
				
			</header>


			<?php the_content(); ?>

			<p class="sa-policy-meta">Advocacy targets:
				<?php echo $advocacy_targets; ?>
			</a></p>
			<?php 
			if (isset($policy_tags)) { 
					?>
				<p class="sa-policy-meta">Tags :
					<?php echo $policy_tags; ?>
				</a></p>
			<?php } ?>
			<p class="sa-policy-meta">This policy is of the type: <a href="#">
				<?php echo $custom_fields['sa_policytype'][0];
				// echo $advocacy_targets;
				?>
			</a></p>

			<?php 
				if ( function_exists('bp_share_post_button') ) { 
					bp_share_post_button(); 
				} 
			?>

			<div class="clear"></div>			
			<!-- Finding and listing related resources. -->
			<?php // args
				
				$looky = '%"' . $post->ID . '"%';
				$related_resource_results = $wpdb->get_results( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = 'sa_resource_policy' AND meta_value LIKE %s", $looky ) );

				wp_reset_postdata();

				if ($related_resource_results) {
					//Build a 1-dimensional array of associated post IDs
					foreach ($related_resource_results as $relation) {
						$associated_resources[] = $relation->post_id;
					}
				// print_r($associated_resources);
				
				//Now we have the ids of all the associated resources, we have to figure out how to output them... something like:

				$args = array(
			 	'post__in' => $associated_resources,
			 	'post_type' => 'saresources'
			 	);
			 	$associated_docs = new WP_Query( $args );

			 	// echo "<pre>";
			 	// var_dump($associated_docs);
			 	// echo "</pre>";	
	
				if ( $associated_docs ) : ?>

					<h5>Associated Resources</h5>	
					<ul id="sa_associated_resources">

					<?php while ( $associated_docs->have_posts() ) : $associated_docs->the_post();
					$assoc_tags = get_the_terms( $post->ID, 'sa_resourcecat' );
						if ($assoc_tags) {
							foreach ( $assoc_tags as $assoc_tag ) {
								$resource_tags[] = '<a href="' . get_term_link($assoc_tag->slug, 'sa_resourcecat') .'">'.$assoc_tag->name.'</a>';
							}
							$resource_tags = join( ', ', $resource_tags );
						}
				?>
						<li>
							<p class="sa_assoc_resource_title">
								<em>
									<?php 
									// get_template_part( 'content', 'saresources' );
									$resource_type = get_field( "sa_resource_type" ) ? get_field( "sa_resource_type" ) : '' ;
									if ( $resource_type )  { ?>
										<?php the_field( "sa_resource_type" ); ?>:
									<?php }	?>
								</em>
								<?php if ( $resource_type == 'Link' ) { 
									$link_url = get_field( 'sa_resource_link' );
									?>
									
									<a href="<?php echo $link_url ; ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a>

								<?php } else { ?>

									<?php the_title(); ?>

								<?php } ?>

							</p>
							<div class="sa_assoc_resource_title">
								<?php the_content(); ?>
							</div>
						<?php if (isset($resource_tags)) { ?>
							<p class="resource-tags">Tags :
								<?php echo $resource_tags; ?>
							</a></p>
						<?php } ?>

						</li>						
					<?php endwhile; ?>
						</ul>
				<?php endif; ?>	

			<?php } // End if ($related_resource_results) check ?>

			<?php //wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
                    
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
