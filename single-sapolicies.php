<?php get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>

		<div id="content" role="main">
			<div class="padder">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'sapolicies' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			<div class="related-policies">
				<?php //Get related posts by topic
				$source_post_id = $post->ID;
				$exclude_posts = array( $source_post_id );
				// echo PHP_EOL . 'excluded posts: ';
				// 	print_r($exclude_posts);
				$terms = get_the_terms( $source_post_id, 'sa_advocacy_targets' );
					if ( !empty ($terms) ) :
						foreach ( $terms as $term ) {
							$advocacy_targets_id_array[] = $term->term_id;
						}

						$related_policies_args = array(
							'post_type' => 'sapolicies',
							'post__not_in' => $exclude_posts,
							'posts_per_page' => 3,
							'tax_query' => array(
								array(
									'taxonomy' => 'sa_advocacy_targets',
									'field' => 'id',
									'terms' => $advocacy_targets_id_array,
								)
							)
						);

						$related_policies = new WP_Query( $related_policies_args );
						// print_r($related_policies);
						?>
						<div class="related-by-topic">
							<h3 class="screamer sagreen">Related Changes by Topic</h3>
							<?php
							while ( $related_policies->have_posts() ): $related_policies->the_post();
								//This template should be the short result
								// get_template_part( 'content', 'sa-policy-short' );
								// $body = apply_filters( 'the_content', get_the_content() );
								// $body = ellipsis( $body );
								?>
								<div class="third-block">
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'sa-item-short-form' ); ?>>
										<div class="entry-content">
											<header class="entry-header clear">
												<h4 class="entry-title">
												<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
												</h4>
												<?php the_excerpt(); ?>
											</header>

										</div> <!-- entry-content -->
									</article>
								</div>
								<?php
								$exclude_posts[] = $post->ID;
							endwhile; // end of the loop.
						?>
						</div> <!-- #related-by-topic -->
						<?php

					endif; //check for empty terms
					// echo PHP_EOL . 'excluded posts: ';
					// print_r($exclude_posts);

	                  ?>  

			            <div class="related-what-can-you-do clear">
			                <h3 class="screamer sablue">What Can You Do?</h3>
			                  	
		                  	<a href="http://dev.communitycommons.org/salud-america/share-your-own-stories/" class="column1of3 aligncenter">
			                  	<img alt="Health" src="/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/BeaStar_icon.png" width="100px"/><br />Start your own change!
		                  	</a>
		                  	
		                  	<a href="http://##" class="column1of3 aligncenter">
	                            <img alt="Health" src="/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/AddChange_icon.png" width="100px"/><br />Connect with members in your area!
                        	</a>

		                  	<a href="http://dev.communitycommons.org/salud-america/what-is-change/" class="column1of3 aligncenter">
	                            <img alt="Health" src="/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/WhatsChange_icon.png" width="100px"/><br />See how a change is made
                        	</a>
	                    </div>

	            <?php //Get related posts by tag
				$tags = get_the_terms( $source_post_id, 'sa_policy_tags' );
					if ( !empty ($tags) ) :
						foreach ( $tags as $tag ) {
							$policy_tags_array[] = $tag->term_id;
						}
						// echo 'policy-tags: ';
						// print_r($tags);
						// echo PHP_EOL. 'array';
						// print_r($policy_tags_array);

						$related_policies_args = array(
							'post_type' => 'sapolicies',
							'post__not_in' => $exclude_posts,
							'posts_per_page' => 3,
							'tax_query' => array(
								array(
									'taxonomy' => 'sa_policy_tags',
									'field' => 'id',
									'terms' => $policy_tags_array,
									'operator' => 'IN'
								)
							)
						);

						$related_policies = new WP_Query( $related_policies_args );
						// print_r($related_policies);
						?>
						<div class="related-by-tag">
							<h3 class="screamer saorange">Related Changes by Tag</h3>
							<?php
							while ( $related_policies->have_posts() ): $related_policies->the_post();
								//This template should be the short result
								// get_template_part( 'content', 'sa-policy-short' );
							?>
							<div class="third-block">
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'sa-item-short-form' ); ?>>
										<div class="entry-content">
											<header class="entry-header clear">
												<h4 class="entry-title">
												<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
												</h4>
												<?php the_excerpt(); ?>
											</header>

										</div> <!-- entry-content -->
									</article>
								</div>
							<?php
							endwhile; // end of the loop.
						?>
						</div>
						<?php
					endif; //check for empty terms


	                  ?>
		                
              </div> <!-- .related-policies -->  

                <!-- <div class="related-items-sidebar">
                <h3 class="aligncenter screamer sablue">What Can</br> You Do?</h3>
                  <table>
                    <tr><td><a href="http://dev.communitycommons.org/salud-america/share-your-own-stories/">
                            <img class=" wp-image-12449 aligncenter" alt="Health" src="/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/BeaStar_icon.png" width="60" height="60" /></a></td>
                        <td><h4><a href="http://dev.communitycommons.org/salud-america/share-your-own-stories/">Start your own change!</a></td></h4></tr>
                  <tr><td><a href="http://##">
                            <img class=" wp-image-12449 aligncenter" alt="Health" src="/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/AddChange_icon.png" width="60" height="60" align='left' /></a></td>
                        <td><h4><a href="http://##">Connect with members in your area!</a></td></h4></tr>
                  <tr><td><a href="http://dev.communitycommons.org/salud-america/what-is-change/">
                            <img class=" wp-image-12449 aligncenter" alt="Health" src="/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/WhatsChange_icon.png" width="60" height="60" /></td>
                        <td><h4><a href="http://dev.communitycommons.org/salud-america/what-is-change/">See how a change is made</a></td></h4></tr>
                  </table>
               
                  </div> -->                            
		</div><!-- .padder -->
		</div><!-- #content -->
		
<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>