<?php
/*
Template Name: Salud America
*/

get_header(); ?>
<div class="salud-header clear">
	<a href="#" class="logo"><img src="/wp-content/themes/CommonsRetheme/img/salud_america/SA-logox200.png" class=""></a>
	<h1>Salud America! <br /> Growing Change</h1>
	<h3>Get involved in reducing latino childhood obesity.</h3>
	<div class="sa-kids-photo"><img src="/wp-content/themes/CommonsRetheme/img/salud_america/sa-kids-335.png"></div>

</div>
<?php get_sidebar( 'salud-single' ); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">
			<div class="padder">
			<?php if (is_page('salud-america')) { ?>
				<div class="salud-banner">
					<img src="/wp-content/themes/CommonsRetheme/img/salud_america/salud-hand.jpg" class="no-box">
					<h2>Plant Your <br /><span>Ideas for Change</span><br /> Today!</h2>
				</div>

				<div class="browse-topics">
					<div>
						<form id="sa-policy-search" class="standard-form" method="get" action="/">
						<h3>Search for Policies</h3>
						<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Not a functional search yet." name="sa-policy">
						<input class="sa-policy-search-button" type="submit" value="Search">
						</form>
					</div>
					<h3>Browse Policies by Topic</h3>
					<?php 
						$args = array(
							'taxonomy' => 'sa_advocacy_targets'
						);
						$categories = get_categories($args);
						$all_cats = array();
						foreach ($categories as $cat) {
							$all_cats[] = $cat->slug;
						} 

						foreach ($all_cats as $cat_slug) { 
							//Loop through each advocacy target
							$cat_object = get_term_by('slug', $cat_slug, 'sa_advocacy_targets');
							// print_r($cat_object);
							$section_title = $cat_object->name;
							$section_description = $cat_object->description;
							?>
						<div class="half-block salud-topic">
							<a href="/salud-america/sapolicies/<?php echo $cat_slug; ?>" class="<?php echo $cat_slug; ?>">
								<span class="<?php echo $cat_slug; ?>x60"></span>
								<h4><?php echo $section_title; ?></h4>
							</a>
							<p><?php echo $section_description; ?></p>
						</div>

						<?php } // End advocacy target loop ?>

						<!-- <div class="half-block">
							<a href="/salud-america/sapolicies/better-food-in-neighborhoods/" class="food-neighborhood">
								<span class="icon"></span>
								<h4>Better Food in Neighborhoods</h4>
							</a>
							<p>SaludableOmaha: Latino Health Movement is creating healthy changes in Latino Schools</p>
						</div>
						<div class="half-block">
							<a href="/salud-america/sapolicies/places-activity/" class="places-activity">
								<span class="icon"></span>
								<h4>Places for Activity</h4>
							</a>
							<p>SaludableOmaha: Latino Health Movement is creating healthy changes in Latino Schools</p>
						</div>
						<div class="half-block">
							<a href="/salud-america/sapolicies/school-food/" class="fschool-food">
								<span class="icon"></span>
								<h4>Better Food at School</h4>
							</a>
							<p>SaludableOmaha: Latino Health Movement is creating healthy changes in Latino Schools</p>
						</div>
						<div class="half-block">
							<a href="/salud-america/sapolicies/cost-soda/" class="cost-soda">
								<span class="icon"></span>
								<h4>Price of Sugary Drinks</h4>
							</a>
							<p>SaludableOmaha: Latino Health Movement is creating healthy changes in Latino Schools</p>
						</div>
						<div class="half-block">
							<a href="/salud-america/sapolicies/advertising/" class="advertising">
								<span class="icon"></span>
								<h4>Stop Unhealthy Advertising</h4>
							</a>
							<p>SaludableOmaha: Latino Health Movement is creating healthy changes in Latino Schools</p>
						</div>
						<div class="half-block">
							<a href="/salud-america/sapolicies/more-active-play-time/" class="active-play">
								<span class="icon"></span>
								<h4>More Active Play Time</h4>
							</a>
							<p>SaludableOmaha: Latino Health Movement is creating healthy changes in Latino Schools</p>
						</div> -->

				</div>

			<?php
			} elseif (is_page('sapolicies')) {
				//Do the custom query here, I think
				//echo 'this is that page';
				//First, display the content of the page before making the custom loop.
				$page_content = get_the_content();
				if ( !empty( $page_content ) ) {
					echo '<p class="page-intro">';
					echo $page_content;
					echo '</p>';
				} ?>
				<div class="policy-search">
					<form id="sa-policy-search" class="standard-form" method="get" action="commonsdev.local/salud-america/sapolicies/">
					<h3>Search for Policies</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Not a functional search yet." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>
				<?php 
				// echo isset($_GET['sa-policy']) ? $_GET['sa-policy'] : 'nope' ;
				?>
				<?php //Now we make our loop
				wp_reset_postdata();
			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$args = array(
					// Change these category SLUGS to suit your use.
					'post_type' => 'sapolicies', 
					'paged' => $paged
				);

				$list_of_policies = new WP_Query( $args ); 

				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content', 'sa-policy-short' );
					//comments_template( '', true );
				endwhile; // end of the loop.
				
				// Custom widget Area Start
				 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sa_geosearch_widget') ) : 
				 endif;
				// Custom widget Area End

			} elseif (is_child(150)) {
				//The number above is the id of the parent page, is 11911 on the dev server.
				while ( have_posts() ) : the_post();
				?>

				<?php get_template_part( 'content', 'page' ); ?>

                
                <?php 
                $page_slug = $post->post_name;

                endwhile; // end of the main page loop. 

                // $parent = $post->post_parent;
                // wp_reset_query(); 
                //echo '$page_slug ' . $page_slug; 
				//echo '$parent ' . $parent;
				?>
				<div>
					<!-- <div class="active-play"><span class="icon"></span></div> -->
					<h2>How is your community doing with respect to this topic area?</h2>
					<div style="width:100%;height:200px;background-color:#CCC;margin-bottom:24px;">form/charts go here</div>
				</div>
				<?php //Now we make our loop
				wp_reset_postdata();
			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			  	switch ($page_slug) { //TODO: move to custom taxonomy, not these deals.
			  		case 'sa-better-food-in-neighborhoods':
			  			$sa_target_area = 'sa-better-food-in-neighborhoods';
			  			break;
			  		case 'sa-active-spaces':
			  			$sa_target_area = 'sa-active-spaces';
			  			break;
			  		case 'sa-healthier-school-snacks':
			  			$sa_target_area = 'sa-healthier-school-snacks';
			  			break;
			  		case 'sa-sugary-drinks':
			  			$sa_target_area = 'sa-sugary-drinks';
			  			break;
			  		case 'sa-healthier-marketing':
			  			$sa_target_area = 'sa-healthier-marketing';
			  			break;
			  		case 'sa-active-play':
			  			$sa_target_area = 'sa-active-play';
			  			break;
			  		default:
			  			$sa_target_area = 'sa-better-food-in-neighborhoods';
			  			break;
			  	}

				$args = array(
					'post_type' => 'sapolicies', 
					'paged' => $paged,
					'sa_advocacy_targets' => $sa_target_area,
				);

				$list_of_policies = new WP_Query( $args ); ?>
				<h2>Policies that address this target area: </h2>
				<?php
				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content', 'sa-policy-short' );
					// comments_template( '', true );
				endwhile; // end of the loop.
				
				// Add comment form to these subpages.
				wp_reset_query();
				comments_template( '', true );

			} else {

				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page-notitle' );
					comments_template( '', true );
				endwhile; // end of the loop. 

			}
			
			?>


		</div><!-- .padder -->
		</div><!-- #content -->
		<div class="salud-footer">	
			<a href="#"><img src="/wp-content/themes/CommonsRetheme/img/salud_america/salud-video-still.jpg" class=""></a>
			<p>Salud America! is a RWJF-funded national network dedicated to supporting advocacy for the prevention of Latino childhood obesity. The advocacy platform is the online portal for this effort.</p>
		</div>
	</div><!-- #primary -->
<?php get_footer(); ?>