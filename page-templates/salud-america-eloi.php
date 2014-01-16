<?php
/*
Template Name: Salud America Eloi
*/

get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>


		<div id="content" role="main">
			<div class="padder">
<?php 
if (is_page('salud-americaresearch')) { 
				?>
   				<div class="policy-search">
					<form id="sa-policy-search" class="standard-form" method="get" action="/">
					<h3>Search for Research</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Search for Research." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>     
                
				<?php //Display the page content before making the custom loop
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page-notitle' );
					comments_template( '', true );              
				endwhile; // end of the loop. 
				?>
          <h3>Latest Research Added</h3>
          <?php
          wp_reset_postdata();

			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          
          $args = array(
					// Change these category SLUGS to suit your use.
					'post_type' => 'saresources',
          'sa_resource_cat'=> 'research',
        	'showposts' => '4',
					'paged' => $paged
				);
                                
				$list_of_policies = new WP_Query( $args );
				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content', 'saresources-short');

					//comments_template( '', true );
        endwhile; // end of the loop.              
                        
} elseif (is_page('saresourcespage')) {
	//Moved this functionality to resources archive page
  /****** 
  echo '<div class="entry-content">
        <h3 class="screamer sablue">Want to find resources to help make change in your area?</h2>';

         //Display the page content before making the custom loop
          while ( have_posts() ) : the_post();
            get_template_part( 'content', 'page-notitle' );
            // comments_template( '', true );              
          endwhile; // end of the loop. 
          ?>
   				<div class="policy-search">
  					<!--<form id="sa-policy-search" class="standard-form" method="post" action="/">-->
<h3 class="screamer sayellow">Search for Resources by Keyword</h3>
                <?php if ( function_exists('sa_searchresources') ) { 
                  sa_searchresources('/search-results'); 
                } ?>
          </div>
<h3 class="screamer sapurple">Browse Resources by Topic</h3>
						<div>
							
							<?php 
							$advocacy_targets = get_terms('sa_advocacy_targets');
							foreach ($advocacy_targets as $target) {
								?>
								<div class="sixth-block mini-text"><a href="<?php cc_the_cpt_tax_intersection_link( 'saresources', 'sa_advocacy_targets', $target->slug ) ?>"><span class="<?php echo $target->slug; ?>x90"></span><br /><?php echo $target->name; ?></a></div>						
							<?php } //end foreach ?>
							
						</div>

        <?php

        //Specify the saresourcecat slugs we want to show here 
        // If specifying more than one category, make them a comma-separated list               
        $resource_cats = array(
                            'report',
                            'toolkit',
                            'webinar-2'
                          );
        ?>

        <div class="row">
          <h3 class="screamer sagreen">Browse Resources by Type</h3>
          <?php saresources_get_featured_blocks($resource_cats);?>
        </div>

        <!-- Begin secondary loop for most recently added resources -->
        <div class="row taxonomy-policies">
          <h3 class="screamer sapink">Latest Resources Added</h3>
          <?php saresources_get_related_resources($resource_cats);?>
        </div>
      </div> <!-- end .entry-content -->
			<?php
			*/
} elseif (is_page('getting-started')) {

            if ( function_exists('SA_getting_started') ) { SA_getting_started(); }        
} 

// elseif (is_page('saresources-report')) {
// 		echo "<h3 class='screamer sayellow'>Report Resources</h3>";
// 		if ( function_exists('saresources_by_cat') ) { saresources_by_cat('report');	
// 				} {
//                                 get_template_part( 'content', 'saresources-short' );
//                                 comments_template( '', true );}

//                 }
// elseif (is_page('saresources-toolkit')) {
// 		echo "<h3 class='screamer sagreen'>Toolkit Resources</h3>";
// 		if ( function_exists('saresources_by_cat') ) { saresources_by_cat('toolkit'); } 


// }
// elseif (is_page('saresources-webinar')) {
// 		echo "<h3 class='screamer sapurple'>Webinar Resources</h3>";
// 		if ( function_exists('saresources_by_cat') ) { saresources_by_cat('webinar-2'); } 


// }
elseif ( is_page('whats-new') ) {
  
    
    ?>
      <p class="intro-text" style="font-size:1.2em;padding-top:10px">More than 39 percent of Latino children ages 2-19 are overweight or obese.</p> 
                                    
      <p class="intro-text" style="font-size:1.2em; padding-bottom:10px">Here are the latest trends on the obesity epidemic—and the efforts going on across the nation to reduce and prevent obesity among Latino children.</p>
      
<div>
<h3 class="screamer sagreen">Latest Success Stories</h3>
<div class="row clear">
					

					<?php
					//Grab the 3 most recent success stories
						$args = array (
								'post_type' => 'sa_success_story',
								'posts_per_page' => 6,
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

									echo '<h5 class="entry-title">' . get_the_title() . '</h5></a>';
									the_excerpt();
									?>
								</a>
							</div>
							 <?php
						}
						wp_reset_postdata();
						?>
</div>        
      
<h3 class="screamer sapurple">Recent Changes</h3>

					<div class="row">
						<?php
						//Grab the 3 most recent success stories
							$args = array (
									'post_type' => 'sapolicies',
									'posts_per_page' => 6,
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
									?></div><?php
                                                                            							}
							wp_reset_postdata();
							?>
								
                                                              
	<?php
                                                       
} elseif (is_page('learn-to-make-change')) {

				//First, display the content of the page before making the custom loop.
				while ( have_posts() ) : the_post();
				$page_intro = get_the_content();
				if ( !empty($page_intro) ) {
					$page_intro = apply_filters('the_content', $page_intro); 
					?>
					<div class="sa-page-intro">
						<?php echo $page_intro; ?>
					</div>	
	                <?php } //End if empty check
                endwhile; // end of the main page loop. 
   				?>
				<div class="policy-search">
					<form id="sa-policy-search" class="standard-form" method="get" action="/">
					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for Learning Tools</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Not a functional search yet." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>
        <?php

    //3 BLOCKS FOR LEARNING RESOURCES ####################################################                          
        $resource_cats = array(
          'report, research, journal-article',
          'how-to-resource, toolkit, training, webinar-2, learning-resource, recommendations',
          'get-involved',
        );
        ?>

    <h3>Browse Learning Tools by Type</h3>
    <?php saresources_get_featured_blocks($resource_cats) ?>
 
    <h3>Latest Resources Added</h3>                      
		<?php saresources_get_related_resources($resource_cats);

                
} elseif ( is_page('success-stories-intro') ) {                
	//Display the page content before making the custom loop
          while ( have_posts() ) : the_post();
            get_template_part( 'content', 'page-notitle' );
            // comments_template( '', true );              
          endwhile; // end of the loop. 
          ?>
    <div class="browse-topics">

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
							$resource = array(
                                                            // Change these category SLUGS to suit your use.
                                                             'post_type' => 'saresources',
                                                             'sa_resource_cat'=> 'success-stories',
                                                             'showposts' => '1',
                                                             'sa_advocacy_targets' => $cat_slug,
                                                             'paged' => $paged
                                                );
                                                        $list_of_stories = new WP_Query( $resource );
							?>
						<div class="half-block salud-topic <?php echo $cat_slug; ?>">
							<a href="/salud-america/success-stories/success-stories-topics?tag=<?php echo $cat_slug; ?>" class="<?php echo $cat_slug; ?>  clear">
								<span class="<?php echo $cat_slug; ?>x60"></span>
								<h4><?php echo $section_title; ?></h4>
							</a>
							<?php while ( $list_of_stories->have_posts() ): $list_of_stories->the_post();
                                                        //Use the template with the featured image thumbnail.
                                                        get_template_part( 'content', 'saresources-mini'); ?>
                                                        <br />
                                                        <a href="/salud-america/success-stories/success-stories-topics?tag=<?php echo $cat_slug; ?>" class="<?php echo $cat_slug; ?>  clear">See more</a>
                                                    <?php
                                                        //comments_template( '', true );
                                                        endwhile; // end of the loop. 
                                                        ?>
						</div>

						<?php } // End advocacy target loop ?>

				</div>                
                
<?php
} elseif ( is_page('success-stories-topics') ) {

$tag = $_GET['tag'];

$term = get_term_by ('slug', $tag, 'sa_advocacy_targets');

$stories =  get_objects_in_term ($term ->term_id, 'sa_advocacy_targets');


		$filter_args = array(
					 'post_type' => 'saresources',
                                         'sa_resource_cat'=> 'success-stories',
					 'post__in' => $stories,
);
                    $query2 = new WP_Query($filter_args);
		    if($query2->have_posts()) : 
			  while($query2->have_posts()) : 
					$query2->the_post();
					get_template_part( 'content', 'saresources-short' ); 

			  endwhile;
		   else: 
			  echo "No Results - Search criteria too specific";	
		   endif;					
                    




} elseif ( is_page('what-is-change') ) {   
        echo '<div class="entry-content">
        <h3 class="screamer sablue">What is Change?</h2>';

         //Display the page content before making the custom loop
          while ( have_posts() ) : the_post();
            get_template_part( 'content', 'page-notitle' );
            // comments_template( '', true );              
          endwhile; // end of the loop.     
?>      
    
        <div class="science-of-change">
          <h3 class="screamer sagreen">Why Change?</h3>
           <p>More than 39% of Latino kids are overweight or obese, a higher rate than all kids (32%).<br /></p>
            <p>There are many reasons, including that Latino kids lack of afterschool physical activity options, have less access to local play facilities, have less access to healthy foods in schools and neighborhoods, are exposed to unhealthy marketing, and consume more sugary drinks than their non-Latino peers.<br /></p>
            <p>This situation puts Latino kids at higher risk of developing obesity-related diseases, such as diabetes.<br /></p>
            <p>Change is greatly needed because Latino children comprise 22 percent of all U.S. youth and represent the largest, fastest-growing minority group in the nation.<br /></p>
           
         </div>   
       </div>
    
      <div class="examples-of-change">
		<h3 class="screamer sapurple">Examples of change</h3>
        <p>Here are a few examples of how people are changing their communities.</p>					  
        
        <?php 
	  	$tag_list = array(
	  		'Active Play' => array( 'Recess', 'PE', 'After School Programs', 'Safe Routes to School', 'Brain Breaks'  ),
	  		'Active Spaces' => array( 'Parks','Shared Use','Playgrounds', 'Complete Streets', 'Sidewalks' ),
	  		'Better Food in Neighborhoods' => array( 'Corner Stores', 'Farmers\' Market', 'Community Gardens' ),
	  		'Healthier Marketing' => array( 'Healthy Ad Campaigns', 'Unhealthy Ad Campaigns', 'Digital Advertising', 'TV Advertising', 'Neighborhood Advertising' ),
	  		'Healthier School Snacks' => array( 'Healthy Lunches', 'Fundraising', 'School Wellness Policies' ),
	  		'Sugary Drinks' => array( 'Sugar-Sweetened Beverages', 'Soda Tax', 'Water' )
	  		);

		$i = 1;

	  	foreach ($tag_list as $advo_target => $tags) {
	  		
	  		//Start the row on i=1 and i=4
	  		if ( $i%3 == 1 )
	  			echo '<div class="row clear">';

	  		$advo_clean = sanitize_title( $advo_target );
	  		?>

	  		<div class="third-block">
              <h4 class="clear"><span class="sa-<?php echo $advo_clean; ?>x60"></span><?php echo $advo_target; ?></h4>
              <ul class="no-bullets clear">
              	<?php //Loop through the tags.
              	foreach ($tags as $tag) {
              		$tag_clean = sanitize_title( $tag );
              		?>
              		<li><a href="<?php cc_the_cpt_tax_intersection_link( 'sapolicies', 'sa_policy_tags', $tag_clean ); ?>" title="Link to <?php echo $tag; ?> topic archive"><?php echo $tag; ?></a></li>
              		<?php
              	}
              	?>
              </ul>
            </div>

	  		<?php
	  		//End the row on i=3 and i=6
	  		if ( $i%3 == 0 )
	  			echo '</div> <!-- end .row -->';

	  		$i++;

	  	} // END foreach ($tag_list as $advo_target => $tags)

	  	?>
	  	</div> <!-- end .examples-of-change -->
                       
        <div class="science-of-change">
          <h3 class="screamer saorange">The Science Behind Change</h3>
           <img class="alignleft" src="<?php echo get_stylesheet_directory_uri(); ?>/img/salud_america/time-for-change.jpg" alt="Photo of a clock showing the words Time for Change"/>
           <p>How far along is change in a community?<br />
            Where might you step in to make a contribution?<br />
            The answers can be found in the Salud America! <a href="/salud-america/what-is-change/the-science-behind-change/" clear="">Policy Contribution Spectra</a>.
           </p> 
         </div>                              

<?php 
} elseif ( is_page('browse-change') ) {
// Moved this functionality to the policies archive page - DC

// $tag = $_GET['tag'];

// $term = get_term_by ('slug', $tag, 'sa_policy_tags');

// $policies =  get_objects_in_term ($term ->term_id, 'sa_policy_tags');


// 		$filter_args = array(
// 					 'post_type' => 'sapolicies',
// 					 'post__in' => $policies,
// );
//                     $query2 = new WP_Query($filter_args);
// 		    if($query2->have_posts()) : 
// 			  while($query2->have_posts()) : 
// 					$query2->the_post();
// 					get_template_part( 'content', 'sa-policy-short' ); 

// 			  endwhile;
// 		   else: 
// 			  echo "No Results - Search criteria too specific";	
// 		   endif;					
                    



          
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

        


        


