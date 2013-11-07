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
  echo '<div class="entry-content">
        <h3 class="screamer sablue">Find Resources</h2>';

         //Display the page content before making the custom loop
          while ( have_posts() ) : the_post();
            get_template_part( 'content', 'page-notitle' );
            // comments_template( '', true );              
          endwhile; // end of the loop. 
          ?>
   				<div class="policy-search">
  					<!--<form id="sa-policy-search" class="standard-form" method="post" action="/">-->

                <?php if ( function_exists('sa_searchresources') ) { 
                  sa_searchresources('/search-results'); 
                } ?>
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
} elseif (is_page('getting-started')) {

            if ( function_exists('SA_getting_started') ) { SA_getting_started(); }        
} 

elseif ( is_page('whats-new') ) {

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
					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for News</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Not a functional search yet." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>        
                          
        <?php  
        //4 BLOCKS FOR WHAT'S GOING ON NOW
        // Specify the saresourcecat slugs we want to show here
        // If specifying more than one category, make them a comma-separated list                       
            $resource_cats = array(
              'news, press-release',
              'op-ed',
              'research, report, policy-brief' 
            );
            ?>

      <h3>Browse News by Type</h3>
      <?php saresources_get_featured_blocks($resource_cats); ?>

      <h3>Latest Resources Added</h3>
      <?php saresources_get_related_resources($resource_cats);		

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
          <div class="row clear">
            <div class="third-block">
              <h4 class="clear"><span class="sa-active-playx60"></span>Active Play</h4>
              <ul class="no-bullets clear">
                <li><a href="/salud-america/what-is-change/browse-change?tag=recess">Recess</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=pe">P.E.</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=after-school-program">After School Programs</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=safe-routes-to-school">Safe Routes to Schools</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=brain-breaks">Brain Breaks</a></li>
              </ul>
              </div>

            <div class="third-block">
              <h4 class="clear"><span class="sa-active-spacesx60"></span>Active Spaces</h4>
              <ul class="no-bullets clear">
                <li><a href="/salud-america/what-is-change/browse-change?tag=parks">Parks
                <li><a href="/salud-america/what-is-change/browse-change?tag=shared-use">Shared Use</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=playgrounds">Playgrounds</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=complete-streets">Complete Streets</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=sidewalks">Sidewalks</a></li>
              </ul>
              </div>

            <div class="third-block">
              <h4 class="clear"><span class="sa-better-food-in-neighborhoodsx60"></span>Better Food in Neighborhoods</h4>
              <ul class="no-bullets clear">
                <li><a href="/salud-america/what-is-change/browse-change?tag=corner-stores">Corner Stores</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=farmers-market">Farmers' Markets</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=community-gardens-3">Community Gardens</a></li>
              </ul>
              </div>
          </div> <!-- end .row -->

          <div class="row clear">
            <div class="third-block">
              <h4 class="clear"><span class="sa-healthier-marketingx60"></span>Healthier Marketing</h4>
              <ul class="no-bullets clear">
                <li><a href="/salud-america/what-is-change/browse-change?tag=healthy-ad-campaign">Healthy Ad Campaigns</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=unhealthy-ad-campaign">Unhealthy Ad Campaigns</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=digital-advertising">Digital Advertising 
                <a href="/salud-america/what-is-change/browse-change?tag=tv-advertising">TV Advertising</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=neighborhood-advertising">Neighborhood Advertising</a></li>
              </ul>
            </div>

            <div class="third-block">
              <h4 class="clear"><span class="sa-healthier-school-snacksx60"></span>Healthier School Snacks</h4>
              <ul class="no-bullets clear">
                <li><a href="/salud-america/what-is-change/browse-change?tag=healthy-lunches">Healthy Lunches</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=fundraising">Fundraising</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=school-wellness-policies">School Wellness Policies</a></li>
              </ul>
            </div>

            <div class="third-block">
              <h4 class="clear"><span class="sa-sugary-drinksx60"></span>Sugary Drinks</h4>
              <ul class="no-bullets clear">
                <li><a href="/salud-america/what-is-change/browse-change?tag=sugar-sweetened-beverages">Sugar-Sweetened Beverages</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=soda-tax">Soda Tax</a></li>
                <li><a href="/salud-america/what-is-change/browse-change?tag=water">Water</a></li>
              </ul>
            </div>
          </div> <!-- end .row -->
        </div> <!-- end .examples-of-change -->
	
                                
        <div class="science-of-change">
          <h3 class="screamer saorange">The Science Behind Change</h3>
           <img class="alignleft" src="/wp-content/uploads/2013/08/time-for-change.jpg" width="350" height="150" />
           <p>How far along is change in a community?<br />
            Where might you step in to make a contribution?<br />
            The answers can be found in the Salud America! <a href="/salud-america/what-is-change/the-science-behind-change/" clear="">Policy Contribution Spectra</a>.
           </p> 
         </div>   
       </div>
                                    

              
<?php 
} elseif ( is_page('browse-change') ) {
$tag = $_GET['tag'];

$term = get_term_by ('slug', $tag, 'sa_policy_tags');

$policies =  get_objects_in_term ($term ->term_id, 'sa_policy_tags');


		$filter_args = array(
					 'post_type' => 'sapolicies',
					 'post__in' => $policies,
);
                    $query2 = new WP_Query($filter_args);
		    if($query2->have_posts()) : 
			  while($query2->have_posts()) : 
					$query2->the_post();
					get_template_part( 'content', 'sa-policy-short' ); 

			  endwhile;
		   else: 
			  echo "No Results - Search criteria too specific";	
		   endif;					
                    



          
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

        


        


