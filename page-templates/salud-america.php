<?php
/**
* Template Name: Salud America
*/
get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>

		<div id="content" role="main">
			<div class="padder">
			<?php if (is_page('salud-america')) { ?>

			<div class="entry-content">
				<div class="notice" style="border-left:8px solid red;background-color:#F3F3F3;padding: 1px 2em 1em;">
					<h4 style="color:black;margin-bottom:.5em;"><a href="<?php echo home_url( 'salud-america-video-contest' ); ?>" style="text-decoration:none;color:black"><span class="uppercase" style="text-transform:uppercase; color: red;">Vote and win a prize: </span>&emsp;Vote for Best New #SaludHeroes Video; Enter to Win T-Shirt, Jump Rope</a></h4>
                    <a href="<?php echo home_url( 'salud-america-video-contest' ); ?>" class="button">Vote now</a>
                    <h4 style="color:black;margin-top: 1em;margin-bottom:.5em;"><a href="<?php echo home_url( 'salud-america/tweetchat' ); ?>" style="text-decoration:none;color:black"><span class="uppercase" style="text-transform:uppercase; color: red;">Tweetchat 1/27:</span>&emsp;&ldquo;Education + Health: Keys Ways to Empower the Latino Community&rdquo;</a></h4>
                    <a href="https://twitter.com/SaludToday" target="_blank" class="button" >Follow the conversation</a>&emsp;<a href="<?php echo home_url( 'salud-america/tweetchat' ); ?>" class="button">Learn more</a>
				</div>
				<h3 class="screamer sagreen">How can you fight Latino childhood obesity in your area?</h2>

				<?php sa_get_random_hero_video(); ?>

				<p class="intro-text" style="font-size:1.2em;">Obesity threatens the health of Latino kids.</p>

				<p><strong>Growing Healthy Change</strong> brings you healthy changes happening in your community right now, and shows how to start your own change.</p>

				<p>Find new policies, stories, and research to reduce Latino childhood obesity&mdash;like unlocking playgrounds after school&mdash;in your city, school, county, state, and nation.</p>

                <p>Learn from our Salud Heroes how you can make a change, too.</p>

                <p>Get started!</p>

				<div class="find-changes">
					<h3 class="screamer saorange">1. Find Changes</h3>

						<div style="margin-bottom:1.6em;">
							<h4 style="margin-top:0;">By Keyword</h4>
							<?php if ( function_exists('sa_searchpolicies') ) {
                        	sa_searchpolicies('/search-results');
                        } ?>
						</div>

					<div class="row">

						<div class="half-block">
							<h4 style="margin-top:0;">By Topic</h4>
							<?php
							$advocacy_targets = get_terms('sa_advocacy_targets');
							foreach ($advocacy_targets as $target) {
								?>
								<div class="column1of3 mini-text"><a href="<?php cc_the_cpt_tax_intersection_link( 'sapolicies', 'sa_advocacy_targets', $target->slug ) ?>" title="<?php echo $target->description; ?>"><span class="<?php echo $target->slug; ?>x90"></span><br /><?php echo $target->name; ?></a></div>
							<?php } //end foreach ?>

						</div>

						<div class="half-block">
							<h4 style="margin-top:0;">By Location</h4>
							<a href="http://maps.communitycommons.org/policymap/" title="link to interactive map of changes"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/salud_america/policy-map-sm.jpg" alt='Map of Changes' class="no-box"></a><br />
			                <a href="http://maps.communitycommons.org/policymap/">Browse changes happening in your area</a>
						</div>
					</div>
					<h4>Recent Changes</h4>
					<div class="row">
						<?php
						//Grab the 3 most recent success stories
							$args = array (
									'post_type' => 'sapolicies',
									'posts_per_page' => 3,
									// 'tax_query' => array(
									// 	array(
									// 		'taxonomy' => 'sa_resource_cat',
									// 		'field' => 'slug',
									// 		'terms' => array( 'success-stories' ),
									// 	)
									// )
								);
							//Grab the possible advocacy targets
							$advocacy_targets = get_terms('sa_advocacy_targets');
							foreach ($advocacy_targets as $target) {
								$possible_targets[] = $target->slug;
							}
							$ssquery = new WP_Query( $args );
							while ( $ssquery->have_posts() ) {
							// print_r($possible_targets);

								$ssquery->the_post();
								global $post;
								setup_postdata( $post );

								// echo '<li class="third-block"><h5>' . $target->name . '</h5>';
								echo '<div class="third-block">';
								?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >

									<?php
									if ( has_post_thumbnail()) {
										//Use the post thumbnail if it exists
										the_post_thumbnail('feature-front-sub');
										echo '<br />';
									} else {
										//Otherwise, use some stand-in images by advocacy target
										$terms = get_the_terms( $post->ID, 'sa_advocacy_targets' );
										if ( !empty ($terms) ) :
											//loop through the terms to find a usable (unique) image
											foreach ($terms as $term) {
												if ( in_array( $term->slug, $possible_targets ) ) {
													$advo_target = $term->slug;
													break;
												}
											}
											//If an advo_target didn't get set, we'll set one at random
											if ( !( $advo_target ) ) {
												$advo_target = current($possible_targets);
												// $advo_target = next_targe;
												// print_r(current($possible_targets));
											}

											// echo PHP_EOL . $advo_target;

											//Delete that value from the possible values
												$key_to_delete = array_search($advo_target, $possible_targets);
												if ( false !== $key_to_delete ) {
												    unset( $possible_targets[$key_to_delete] );
												}

										endif; //check for empty terms

										echo '<img src="' . get_stylesheet_directory_uri() . '/img/salud_america/advocacy_targets/' . $advo_target . 'x300.jpg" > ';
										unset($advo_target);
									}

									echo '<h5 class="entry-title">' . get_the_title() . '</h5></a>';
									the_excerpt();
									?>
								</div>
								 <?php
							}
							wp_reset_postdata();
							?>
					</div> <!-- .row -->
				</div> <!-- find-changes -->

				<!-- <h3 class="screamer sablue">2. Learn from Success Stories</h3> -->
				<!-- <div class="learn-from-success-stories">

				</div> -->

				<h3 class="screamer sapurple">2. Learn to Create Change</h3>
				<div class="row clear">
					<h4 style="margin-top:0;">See the Changes a Salud Hero Can Make</h4>

					<?php
					//Grab the 3 most recent success stories
						$args = array (
								'post_type' => 'sa_success_story',
								'posts_per_page' => 3,
							);
						$ssquery = new WP_Query( $args );
						while ( $ssquery->have_posts() ) {

							$ssquery->the_post();
							global $post;
							setup_postdata( $post );
							// echo '<li class="third-block"><h5>' . $target->name . '</h5>';
							echo '<div class="third-block">';
							?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >

								<?php
								if ( has_post_thumbnail()) {
									the_post_thumbnail('feature-front-sub');
									echo '<br />';
									}

								the_title();
								?>
								</a>
							</div>
							 <?php
						}
						wp_reset_postdata();
						?>
					</div>  <!-- end .row -->

				<div class="row">
					<div class="half-block" style="margin-top:0;">
						<h4 style="margin-top:0;">What's Change?</h4>
	                    <a href="/salud-america/what-is-change"><img src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/WhatsChange_icon.png' alt='Active Play' class="no-box" style="width:25%; float:left; margin-right:5%;"></a>
	                    <p>Find out what "change" really means and all the science behind it.<br />
	                    	<a href="/salud-america/what-is-change" class="button" title="Learn what change means.">Learn more</a></p>
                    </div>

					<div class="half-block" style="margin-top:0;">
						<h4 style="margin-top:0;">Get help to Make a Change</h4>
	                    <a href='/salud-america/saresourcespage/'><img src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/Resoucesmakechange_icon.png' alt='Active Play' class="no-box" style="width:25%; float:left; margin-right:5%;"></a>
	                    <p>Use research, toolkits, and other elements to learn about healthy change.<br />
	                    	<a href="/saresources/" class="button" title="Learn about healthy change.">Learn more</a></p>
					</div>
				</div>

				<h3 class="screamer sablue">3. Be a Salud Hero</h3>

				<div class="row">
					<div class="half-block" style="margin-top:0;">
						<h4 style="margin-top:0;">Making a Change?</h4>
	                    <a href='/salud-america/share-your-own-stories/'><img src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/BeaStar_icon.png' alt='Share Your Change' style="width:25%; float:left; margin-right:5%;" class="no-box"></a>
	                    <p>If you or someone you know is starting a change or already made a change, let us know. <br />
	                    	We can write it up, possibly film it, and share it nationwide!<br />
	                    	<a href="/salud-america/share-your-own-stories/" class="button" title="Share your story.">Share your story or alert us to a change</a>
	                    	<!-- <a href="/salud-america/share-your-own-stories/" class="button" title="Alert us to a change.">Alert us to a change.</a> --></p>
					</div>

					<div class="half-block" style="margin-top:0;">

	                    <iframe width="450" height="250" src="//www.youtube.com/embed/8I4T08MONBA?rel=0;showinfo=0;controls=0" frameborder="0" allowfullscreen></iframe>
	                         	</div>
				</div>
			</div>

			<?php } elseif ( is_page('search-results') ) {

				if ( $_POST['requested_content'] == 'saresources' ) {

					echo '<h3 class="screamer sablue">Searching for Resources</h3>';

					if ( function_exists('sa_searchresources') ) {
                        	sa_searchresources('/search-results');
                        }

			        $filter_args = array(
								 'post_type' => 'saresources',
								 's' => $_POST['saps'],
								 'post__in' => $post_ids3,
								 );
			        //var_dump($filter_args);
			        $query2 = new WP_Query($filter_args);

					//***********Mike added commented this section because saresource results were showing twice**************
			        // if($query2->have_posts()) {
			      		// echo '<div class="taxonomy-policies">';
			        	// while($query2->have_posts()) :
	                        // $query2->the_post();
	                        // get_template_part( 'content', 'saresources-short' );
	                    // endwhile;
	                    // echo '<div>';

			        // } else {
	                    // echo "No Results - Search criteria too specific";
	                // }
					//********************************************************************************************************


				} else {

				echo '<h3 class="screamer sablue">Searching for Changes</h3>';

				if ( function_exists('sa_searchpolicies') ) {
                    	sa_searchpolicies('/search-results');
                    }

//				$filter_args = array(
//					 'post_type' => 'sapolicies',
//					 's' => $_POST['saps'],
//					 'post__in' => $post_ids3,
//					 'meta_query' => array(
//										array(
//											'key' => 'sa_policystage',
//											'value' => $chk2
//											 )
//					 					 )
//
//					 );
//                    //var_dump($filter_args);
//                    $query2 = new WP_Query($filter_args);
//                    if($query2->have_posts()) {
//                    	echo '<div class="taxonomy-policies">';
//
//                        while($query2->have_posts()) :
//                            $query2->the_post();
//                            get_template_part( 'content', 'sa-policy-short' );
//                        endwhile;
//                        echo '<div>';
//
//
//                    } else {
//                        echo "No Results - Search criteria too specific";
//                    }
                }


			} elseif (is_page('sapolicies')) {
				//Moved functionality to policies archive
				/****
				echo '<div class="entry-content">';
                                ?>
                                 <div class="policy-search">
  					<!--<form id="sa-policy-search" class="standard-form" method="get" action="/search-results">-->
  					<h3 class="screamer sagreen">Search for Changes by Keyword</h3>
                                        <?php if ( function_exists('sa_searchpolicies') ) {
                                                sa_searchpolicies('/search-results');
                                                } ?>
  				</div><?php

                if ( function_exists('sa_location_search') ) {
	                 	sa_location_search();
	                } ?>

				<div class="browse-topics">
					<h3 class="screamer sablue">Browse Changes by Topic</h3>
					<?php
						$args = array(
							'taxonomy' => 'sa_advocacy_targets'
						);
						$categories = get_categories($args);
						$all_cats = array();
						foreach ($categories as $cat) {
							$all_cats[] = $cat->slug;
						}
						echo '<div class="row clear">';
						$i=0;

						foreach ($all_cats as $cat_slug) {
							//Loop through each advocacy target
							$cat_object = get_term_by('slug', $cat_slug, 'sa_advocacy_targets');
							// print_r($cat_object);
							$section_title = $cat_object->name;
							$section_description = $cat_object->description;
							++$i;
							?>
						<div class="half-block salud-topic <?php echo $cat_slug; ?>">
							<a href="<?php cc_the_cpt_tax_intersection_link( 'sapolicies', 'sa_advocacy_targets', $cat_slug ) ?>" class="<?php echo $cat_slug; ?>  clear">
								<span class="<?php echo $cat_slug; ?>x60"></span>
								<h4><?php echo $section_title; ?></h4>
							</a>
							<p><?php echo $section_description; ?></p>
						</div>
						<?php
						if ( $i%2 == 0 ) {
							echo '</div>
							<div class="row clear">';

					}

						} // End advocacy target loop
						echo '</div>';
						 ?>

				</div>
			</div> <!-- .entry-content -->
<?php */
			}  elseif (is_page('sa-policy-map-search')) {
				sa_location_search();

			}  elseif (is_child(150)) {

				//This section is being replaced by the taxonomy pages. See archive-sapolicies-sa_advocacy_targets.php.

				//The number above is the id of the parent page, is 11911 on the dev server.
				//It's 150 on DC's local install
				/***

                            if ( function_exists('SA_topics') ) {
                            	SA_topics();}
                            	?>
                                        	-
	                                        <div class="policy-search-home">
							<h3>Search for Changes in Progress on This Topic</h3>
							<?php sa_searchpolicies(); ?>
							<!--<form id="sa-policy-search" class="standard-form" method="get" action="/">
							<h4>Search for Changes in Progress</h4>
							<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="70" value="" placeholder="Enter search terms here" name="sa-policy">
							<input class="sa-policy-search-button" type="submit" value="Search">
							</form>-->
						</div>


				<?php //Now we make our loop
				wp_reset_postdata();
			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			  	// switch ($page_slug) { //TODO: move to custom taxonomy, not these deals.
			  	// 	case 'sa-better-food-in-neighborhoods':
			  	// 		$sa_target_area = 'sa-better-food-in-neighborhoods';
			  	// 		break;
			  	// 	case 'sa-active-spaces':
			  	// 		$sa_target_area = 'sa-active-spaces';
			  	// 		break;
			  	// 	case 'sa-healthier-school-snacks':
			  	// 		$sa_target_area = 'sa-healthier-school-snacks';
			  	// 		break;
			  	// 	case 'sa-sugary-drinks':
			  	// 		$sa_target_area = 'sa-sugary-drinks';
			  	// 		break;
			  	// 	case 'sa-healthier-marketing':
			  	// 		$sa_target_area = 'sa-healthier-marketing';
			  	// 		break;
			  	// 	case 'sa-active-play':
			  	// 		$sa_target_area = 'sa-active-play';
			  	// 		break;
			  	// 	default:
			  	// 		$sa_target_area = 'sa-better-food-in-neighborhoods';
			  	// 		break;
			  	// }

                                global $post;
                                $page_slug = get_post( $post )->post_name;

				$args = array(
					'post_type' => 'sapolicies',
					'paged' => $paged,
                                        'showposts' => '5',
					'sa_advocacy_targets' => $page_slug,
				);

				$list_of_policies = new WP_Query( $args ); ?>

                                <!-- NEED FIX TO PULL THE RIGHT CONTENT-->

                                <div>
				<div style="width:60%" class="half-block"><h3>Latest Changes: </h3>

				<?php
				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content', 'sa-policy-short' );
					// comments_template( '', true );
				endwhile; // end of the loop.

				// Add comment form to these subpages.
				wp_reset_query();

                                ?>
                                </div>
                                <div style="width:25%" class="half-block">
                                <div style="background-color:rgb(240,240,240);border-width: 3px; border-style: solid;border-color: lightgrey;">
                                <h3 style='text-align:center; padding-top:0px'>Start a Change</h3>
                                <div style="padding-left:15px"><a href="/salud-america/share-your-own-stories/">Add a change</a> in your area!<br/><br/><a href="/salud-america/share-your-own-stories/"></div>
                                    <img class=" wp-image-12449 aligncenter" alt="Health" src="/wp-content/uploads/2013/08/images.jpg" width="120" height="120" /></a>
                                <br/>
                                </div>
                                  <br/>
                                <div style="background-color:rgb(240,240,240);border-width: 3px; border-style: solid;border-color: lightgrey;">
                                <h3 style='text-align:center; padding-top:0px'>Success Story</h3>
                                <div style="padding-left:15px;padding-right:5px">
                                    <?php
                                        $cat_object = get_term_by('slug', $cat_slug, 'sa_advocacy_targets');

                                        $success = array(
					'post_type' => 'saresources',
					'sa_resource_cat' => 'success-stories',
                                        'paged' => $paged,
                                        'showposts' => '1',
					'sa_advocacy_targets' => $page_slug,
                                         );


                                     $feat_success = new WP_Query( $success );
                                     while ( $feat_success->have_posts() ): $feat_success->the_post();
                                     $success[] = $post->ID;
                                     //Use the template with the featured image thumbnail.
                                     ?><h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></h2>
                                     <?php
                                            if ( has_post_thumbnail() ) {
						the_post_thumbnail('feature-front-sub');
						}?></a><?php
                                     endwhile
                                         ?><br/><br/>
                                                        <a href="/salud-america/success-stories-topics/?topic=<?php echo $page_slug; ?>" class="<?php echo $page_slug; ?>  clear">See more</a>
                                   <br/>
                                </div>
                                </div>
                                    <br/>
                                <div style="background-color:rgb(240,240,240);border-width: 3px; border-style: solid;border-color: lightgrey;">
                                 <h3 style='text-align:center; padding-top:0px'>Resources</h3>
                                 <div style="padding-left:15px;padding-right:5px">
                                    <?php
                                        $cat_object = get_term_by('slug', $cat_slug, 'sa_advocacy_targets');

                                        $resources = array(
					'post_type' => 'saresources',
                                        'post__not_in' => $success,
                                        'paged' => $paged,
                                        'showposts' => '1',
					'sa_advocacy_targets' => $page_slug,
                                    );
                                     $feat_resource = new WP_Query( $resources );
                                     while ( $feat_resource->have_posts() ): $feat_resource->the_post();
                                     //Use the template with the featured image thumbnail.
                                     ?><h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></h2>
                                     <?php
                                            if ( has_post_thumbnail() ) {
						the_post_thumbnail('feature-front-sub');
						}?></a><?php
                                     endwhile
                                         ?><br/><br/>
                                                        <a href="/salud-america/saresourcespage/">See more</a>
                                   <br/><br/>
                                 </div>
                                </div>

                                </div>
                                </div>
                                <?php
                                comments_template( '', true );
             */

			} else {

				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page-notitle' );
					comments_template( '', true );
				endwhile; // end of the loop.

			}

			?>


		</div><!-- .padder -->
		</div><!-- #content -->

<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>