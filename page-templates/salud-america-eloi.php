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
					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for Research</h3>
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
         //Display the page content before making the custom loop
          while ( have_posts() ) : the_post();
            get_template_part( 'content', 'page-notitle' );
            // comments_template( '', true );              
          endwhile; // end of the loop. 
          ?>
   				<div class="policy-search">
  					<form id="sa-policy-search" class="standard-form" method="get" action="/">
  					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for Resources</h3>
                                        <?php if ( function_exists('sa_searchpolicies') ) { sa_searchpolicies(); } ?>
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

        <h3>Browse Resources by Type</h3>
        <?php saresources_get_featured_blocks($resource_cats);

        //Begin secondary loop for most recently added resources ?>
        <h3>Latest Resources Added</h3>
        <?php saresources_get_related_resources($resource_cats);
			
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

                
} elseif ( is_page('success-stories') ) {                
	?>
    <div class="browse-topics">
					<h3>Success Stories</h3>
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
                                                             'sa_resource_cat'=> 'changemaker',
                                                             'showposts' => '1',
                                                             'sa_advocacy_targets' => $cat_slug,
                                                             'paged' => $paged
                                                );
                                                        $list_of_policies = new WP_Query( $resource );
							?>
						<div class="half-block salud-topic <?php echo $cat_slug; ?>">
							<a href="/salud-america/success-stories-topics/?topic=<?php echo $cat_slug; ?>" class="<?php echo $cat_slug; ?>  clear">
								<span class="<?php echo $cat_slug; ?>x60"></span>
								<h4><?php echo $section_title; ?></h4>
							</a>
							<?php while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
                                                        //Use the template with the featured image thumbnail.
                                                        get_template_part( 'content', 'saresources-mini'); ?>
                                                        <br />
                                                        <a href="/salud-america/success-stories-topics/?topic=<?php echo $cat_slug; ?>" class="<?php echo $cat_slug; ?>  clear">See more</a>
                                                    <?php
                                                        //comments_template( '', true );
                                                        endwhile; // end of the loop. 
                                                        ?>
						</div>

						<?php } // End advocacy target loop ?>

				</div>                
                
<?php                
                
          
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

        


        


