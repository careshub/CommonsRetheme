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
  					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Search for Resources." name="sa-policy">
  					<input class="sa-policy-search-button" type="submit" value="Search">
  					</form>
  				</div>

        <?php

        //Specify the saresourcecat slugs we want to show here 
        //                          
        $resource_cats = array(
          'report',
          'toolkit',
          'webinar-2',
          'case-study'
        );
        ?>

        <h3>Browse Resources by Type</h3>
        <?php saresources_get_featured_blocks($resource_cats);

        //Begin secondary loop for most recently added resources ?>
        <h3>Latest Resources Added</h3>
        <?php saresources_get_related_resources($resource_cats);
			
} elseif ( is_page('whats-new') ) {

				//First, display the content of the page before making the custom loop.
				$page_content = get_the_content();
				if ( !empty( $page_content ) ) {
					echo '<p class="page-intro">';
					echo $page_content;
					echo '</p>';
				} ?>
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
            $resource_cats = array(
              'get-involved',
              'journal-article',
              'news',
              'press-release'
            );
            ?>

      <h3>Browse News by Type</h3>
      <?php saresources_get_featured_blocks($resource_cats); ?>

      <h3>Latest Resources Added</h3>
      <?php saresources_get_related_resources($resource_cats);		

} elseif (is_page('learn-to-make-change')) {

				$page_content = get_the_content();
				if ( !empty( $page_content ) ) {
					echo '<p class="page-intro">';
					echo $page_content;
					echo '</p>';
				} ?>
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
          'learning-resource',
          'training',
          'role-model-story'
        );
        ?>

    <h3>Browse Learning Tools by Type</h3>
    <?php saresources_get_featured_blocks($resource_cats) ?>
 
    <h3>Latest Resources Added</h3>                      
		<?php saresources_get_related_resources($resource_cats);

} elseif (is_child(11911)) {
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
			  			$sa_target_area = 'sa_at1';
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
    
<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>

        


        


