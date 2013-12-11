<?php
/*
//Author: Michael Barbaro
*/

//Defines the Salud America policy content type
add_action('init', 'SA_resources_init');
function SA_resources_init() 
{
	$resource_labels = array(
		'name' => _x('SA Resources', 'post type general name'),
		'singular_name' => _x('SA Resource', 'post type singular name'),
		'all_items' => __('All SA Resources'),
		'add_new' => _x('Add SA Resource', 'SA resources'),
		'add_new_item' => __('Add new SA Resource'),
		'edit_item' => __('Edit SA Resource'),
		'new_item' => __('New SA Resource'),
		'view_item' => __('View SA Resource'),
		'search_items' => __('Search in SA Resources'),
		'not_found' =>  __('No SA Resources found'),
		'not_found_in_trash' => __('No SA Resources found in trash'), 
		'parent_item_colon' => ''
	);
	// $args = array(
	// 	'labels' => $resource_labels,
	// 	'public' => true,
	// 	'publicly_queryable' => true,
	// 	'show_ui' => true, 
	// 	'query_var' => true,
	// 	'rewrite' => true,
	// 	'hierarchical' => false,
	// 	// 'menu_position' => 52,
	// 	'has_archive' => 'saresources',
	// 	'taxonomies' => array('sa_resource_cat', 'sa_advocacy_targets'),		
	// 	'supports' => array('title','editor','comments'),
 //        'capability_type' => 'saresources',
 //        'map_meta_cap'    => true
	// ); 
	$args = array(
		'labels' => $resource_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'hierarchical' => false,
	    'show_in_menu' => true,
	    // 'menu_position' => 22,
	    'taxonomies' => array('sa_advocacy_targets', 'sa_resource_cat', 'sa_resource_type'),
	    //'has_archive' => 'sapolicies',
	    // 'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),
	    'supports' => array('title','editor','comments', 'thumbnail'),
	  	'capability_type' => 'saresources',
	  	'map_meta_cap' => true
		);

	register_post_type('saresources',$args);


}
add_action( 'admin_init', 'sa_resources_meta_box_add' );
function sa_resources_meta_box_add()
{
	add_meta_box( 'sa_resource_meta_box', 'Resource Information (optional)', 'sa_resource_meta_box', 'SA Resources', 'normal', 'high' );   
         
}
function sa_resource_meta_box()
{
    global $post;
    $custom = get_post_custom($post->ID);
    $saresource_date = $custom["saresource_date"][0];
    $saresource_policy = $custom["saresource_policy"][0];
    $saresource_promote = $custom["saresource_promote"][0];

	$args=array(
	  'post_type' => 'sapolicies',
	  'post_status' => 'publish',
	  'posts_per_page' => -1,
	  'caller_get_posts'=> 1,
	  'orderby' => 'title',
	  'order' => 'ASC'
	);
	$my_query = null;
	$my_query = new WP_Query($args);

	$seltext="";
	$selval="";
	if ($saresource_policy == null){
		$seltext="---Select a Policy---";
		$selval="";
	} else {            
		$seltext=$saresource_policy;
		$selval=$saresource_policy;
	}

	?>

    <p><input type="checkbox" id="saresource_promote" name="saresource_promote" <?php checked( $saresource_promote, 'on' ); ?> > <label for="saresource_promote">Promote to Resources <em>(visible independent of related policies)</em></label></input></p>

	<strong>Source Date</strong><br><input type='text' name='saresource_date' id='saresource_date' value='<?php 
                if ($saresource_date != "") {
                    echo $saresource_date;
                }
           ?>'/><br><br>
	<strong>Policy</strong><br>
	<select name='saresource_policy' id='saresource_policy'>
		<option selected="true" value="<?php echo $selval; ?>"><?php echo $seltext; ?></option>
	<?php
	if( $my_query->have_posts() ) {
	  while ($my_query->have_posts()) : $my_query->the_post(); ?>
		<option value='<?php the_title(); ?>'><?php the_title(); ?></option>
		<?php
	  endwhile;
	}
	wp_reset_query();	
	?>
	
	</select>
	
	<script type="text/javascript">

	var $j = jQuery.noConflict();
    $j(document).ready(function()
    {
        $j("#saresource_date").datepicker();        
	});
	</script>
	
	
	<?php
}
add_action( 'save_post', 'saresource_save' );
function saresource_save() { 
 
   global $post;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

    if ($post->post_type == 'saresources') {
       saresource_save_event_field("saresource_date");
	   saresource_save_event_field("saresource_policy");
       saresource_save_check_field("saresource_promote");
	}
}
function saresource_save_event_field($event_field) {
    global $post;
    if( isset( $_POST[$event_field] ) && !empty( $_POST[$event_field] ) ) {
        update_post_meta($post->ID, $event_field, $_POST[$event_field]);
    } else {
        delete_post_meta($post->ID, $event_field);
    }
}
function saresource_save_check_field($field) {
    $chk = ( isset( $_POST[$field] ) && $_POST[$field] ) ? 1 : 0 ;
		update_post_meta( get_the_ID(), $field, $chk );
}


function saresources_get_featured_blocks($resource_cats) {
	//We'll loop through the entries of the array to build the queries and display the content
	//Count the dimension of the resource_cats array to determine proper class to apply to top blocks.
	$count = count($resource_cats);
	switch ($count) {
		case ( $count %4 == 0 ) :
			$block_class = 'quarter-block';
			break;
		case ( $count %3 == 0 ) :
			$block_class = 'third-block';
			break;
		default:
			$block_class = 'half-block';
			break;
	}
	$do_not_duplicate = array();

    foreach ($resource_cats as $resource_cat) {

      // The Query

          $args = array(
	          'post_type' => 'saresources',
	          'sa_resource_cat' => $resource_cat,
	          'showposts' => '3',
	          'post__not_in' => $do_not_duplicate,
	          );
          $resources_results = new WP_Query( $args );

          // The Loop
          if ( $resources_results->have_posts() ) : ?>

              <div class="<?php echo $block_class; ?>"> 
              <?php $counter = 0;
                 while ( $resources_results->have_posts() ) : $resources_results->the_post();
                    ++$counter;
                    //Add each displayed post to the do_not_duplicate array
                    $do_not_duplicate[] = get_the_ID();

              if ( $counter == 1 ) { ?>

              <header class="entry-header">
                <?php 
                  if ( function_exists('salud_get_taxonomy_images') ) {
                   echo salud_get_taxonomy_images($resource_cat, 'sa_resource_cat');
                  }
                ?>                   
                <h4 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
              </header>                     
              <div class="entry-content"><?php the_excerpt();?></div> <!-- End .entry-content -->
              <h4>Other Resources</h4>
                <ul class="related-posts no-bullets">
              <?php } else { ?>      
                    <li>
                      <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </li>   
              <?php } // end if $counter is not 1 
              // Reset Query
               wp_reset_query();      
               endwhile; 
               ?>
                 </ul>
              </div> <?php echo '<!-- End ' . $block_class . '-->'; ?>
        <?php  endif; ?>                                                         
    <?php } // Ends foreach for four top blocks 
}

function saresources_get_related_resources($resource_cats) {
	wp_reset_postdata();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
	'post_type' => 'saresources',
	'showposts' => '4',
	'paged' => $paged,
	'tax_query' => array(
	                array(
	                 'taxonomy' => 'sa_resource_cat',
	                 'field' => 'slug',
	                 'terms' => $resource_cats
	                )
	             )
	);
	$list_of_policies = new WP_Query( $args ); 

	while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
		//This template should be the short result
		get_template_part( 'content','saresources-short');
		//comments_template( '', true );
	endwhile; // end of the loop.
}

// Parses the location of a salud policy or resource to a human-readable output
function salud_the_location() {
  echo salud_get_the_location();
}
  function salud_get_the_location() {
  	   
    $geo_tax_type = cc_get_the_geo_tax_type();

	  switch ($geo_tax_type) {
	      case 'State':
	         $geo_tax_location =  cc_get_the_geo_tax_state();
	        break;
	      case 'County':
	      case 'City':
	      case 'School District':
	      case 'US Congressional District':
	      case 'State House District':
	      case 'State Senate District':
	         $geo_tax_location = cc_get_the_geo_tax_name() . ', ' . cc_get_the_geo_tax_state();
	        break;
	      default:
			$geo_tax_location = 'United States';	        
			break;
	    }

         return $geo_tax_location;
  } 

// Create icons from the advocacy targets of a salud policy or resource
function salud_the_target_icons() {
  echo salud_get_the_target_icons();
}
  function salud_get_the_target_icons() {
  	$terms = get_the_terms( $post->ID, 'sa_advocacy_targets' );
	if ( !empty ($terms) ) :
		foreach ( $terms as $term ) {
			$target_icons[] = array ( 
				'target_slug' => $term->slug,
				'target_name' => $term->name
				);
		}
	endif; //check for empty terms

	if ( isset( $target_icons ) ) :
		$output = '';
		foreach ($target_icons as $target_icon) {
			$output .= '<span class="' . $target_icon['target_slug'] . 'x30" title="' . $target_icon['target_name'] . '"></span>';
		}
		return $output;
	endif; //isset $target_icons
	}
//Need to exclude non-promoted resources from taxonomy archives. Little weird because resources have a meta to promote, but policies do not. We're going to have to _not_ match a specific meta value. This will also find resources that don't have a value! Yuck.
// Some query filters for archive pages
// Display upcoming events in date order on Events archive and if viewing a type_of_event taxonomy page.
 
function sa_filter_unpromoted_saresources( $query ) {
 
    if( (is_post_type_archive( 'saresources' ) || is_tax( 'sa_advocacy_targets' ) ) && ( !is_admin() ) && ( $query->is_main_query() )  ) {
        //TODO: This isn't working
        $meta = array(
            array(
            'key' => 'saresource_promote',
            'value' => 0,
            'compare' => 'NOT'
            )
        );
        
        $query->set('meta_query',$meta );
        // $query->set('meta_key', 'event_date');
        // $query->set('orderby', 'meta_value');
        // $query->set('order', 'ASC');
    }
 
}
// add_action('pre_get_posts', 'sa_filter_unpromoted_saresources', 9999); 

function sa_searchresources($searchresults) {
        ?>
<div id="cc-adv-search" class="clear">
	<form action="<?php echo '/salud-america' . $searchresults?>" method="POST" enctype="multipart/form-data" name="sa_ps">
			<div class="row">
        <input type="text" id="saps" name="saps" Placeholder="Enter search terms here" value="<?php 
    			if (isset($_POST['saps'])) {
    				echo $_POST['saps']; 
    			}	elseif (isset($_GET['qs'])) {
    					echo $_GET['qs'];	
    			}
    				?>" />
    	<!-- Hidden input to set post type for search-->
	    <input type="hidden" name="requested_content" value="saresources" />
			
  			<input id="searchsubmit" type="submit" alt="Search" value="Search" />
      </div>
	
	<a role="button" id="cc_advanced_search_toggle" class="clear" >+ Advanced Search</a>
		 
			<div id="cc-adv-search-pane-container" class="row clear">
        <div class="cc-adv-search-option-pane third-block">
          <h4>Topic Area</h4>
          <ul style="list-style-type: none;">
            <?php 
            $ATterms = get_terms('sa_advocacy_targets');
            foreach ($ATterms as $ATterm) {
              echo '<li><input type="checkbox" name="sa_advocacy_target[]" id="sa_adv_target_' . $ATterm->term_id . '" value="' . $ATterm->term_id . '" /> <label for="sa_adv_target_' . $ATterm->term_id . '">' . $ATterm->name . '</label></li>';
            }
            ?>
          </ul>
        </div> <!-- End option pane -->
      
        <div class="cc-adv-search-option-pane third-block">
          <h4>Type of Resource</h4>        
          <div class="cc-adv-search-scroll-container">
          <ul style="list-style-type: none;">
            <?php 
            $CATterms = get_terms('sa_resource_cat');
            foreach ($CATterms as $CATterm) {
              echo '<li><input type="checkbox" name="sa_resource_cat[]" id="sa_res_cat_' . $CATterm->term_id . '" value="' . $CATterm->term_id . '" /> <label for="sa_res_cat_' . $CATterm->term_id . '">' . $CATterm->name . '</label></li>';
            }
            ?>
          </ul>
          </div>
         </div> <!-- End option pane -->
      
        <div class="cc-adv-search-option-pane third-block">
          <h4>Tags</h4>
          <?php $sat_args = array('orderby' => count, 'order' => DESC);
          $sapolicytags = get_terms('sa_policy_tags', $sat_args);
          ?>
          <div class="cc-adv-search-scroll-container">
          <ul style="list-style-type: none;">
            <?php
            foreach ($sapolicytags as $sapolicytag) {
              echo '<li><input type="checkbox" name="sa_sapolicy_tag[]" id="sa_policy_tag_' .  $sapolicytag->term_id . '" value="' . $sapolicytag->term_id . '" /> <label for="sa_policy_tag_' . $sapolicytag->term_id . '">' . $sapolicytag->name . ' (' . $sapolicytag->count . ')</label></li>';
            } 
            ?>
          </ul>
          </div> <!-- End scroll container -->
        </div> <!-- End option pane -->
      </div>
			
		</form>	
		
	</div>
	<script type="text/javascript">
		var $j = jQuery.noConflict();
		
		$j(document).ready(function(){

		   $j('#cc-adv-search-pane-container').hide();	
		   $j('#cc_advanced_search_toggle').click(function(){
  				$j('#cc-adv-search-pane-container').slideToggle('fast');
  				if ($j("#cc_advanced_search_toggle").text() == "+ Advanced Search") {
  					$j("#cc_advanced_search_toggle").text("- Advanced Search");
  				}
  				else {
  					$j("#cc_advanced_search_toggle").text("+ Advanced Search");
  				}
		   });

		});
    
	</script>

<?php
	global $wpdb; 
	
	//Get the search terms
	if( isset($_POST['sa_advocacy_target']) ) {
	 	 $advo_targets = $_POST['sa_advocacy_target'];
	}
	if( isset($_POST['sa_resource_cat']) ) {
	 	 $resource_cats = $_POST['sa_resource_cat'];
	}	
	if( isset($_POST['sa_sapolicy_tag']) ) {
		 $policy_tags = $_POST['sa_sapolicy_tag'];
	}

	//Build the query
	if( $advo_targets || $resource_cats || $policy_tags ) {
		$tax_query = array(
		    'relation' => 'AND',
		);
	}

    if (!empty($advo_targets)) {
        $tax_query[] = array(
           'taxonomy' => 'sa_advocacy_targets',
           'field' => 'term_id',
           'terms' => $advo_targets
        );
    }
    
    if (!empty($resource_cats)) {
        $tax_query[] = array(
           'taxonomy' => 'sa_resource_cat',
           'field' => 'term_id',
           'terms' => $resource_cats
        );
    } 

    if (!empty($policy_tags)) {
        $tax_query[] = array(
           'taxonomy' => 'sa_policy_tags',
           'field' => 'term_id',
           'terms' => $policy_tags
        );
    }
    
    if ($tax_query) {
        $filter_args = array(
          'post_type' => 'saresources',
          's' => $_POST['saps'],
	      'tax_query'=> $tax_query,
          );
	} else {
		$filter_args = array(
          'post_type' => 'saresources',
          's' => $_POST['saps'],
          );
	}

	if (isset($_POST['saps'])) {
		//Make the query, do the loop
		$query2 = new WP_Query($filter_args);
		if($query2->have_posts()) : 
		  while($query2->have_posts()) : 
				$query2->the_post();
				get_template_part( 'content', 'saresources-short' ); 

		  endwhile;
		  // echo "END OF SEARCH RESULTS";
	   else: 
		  echo "No Results - Search criteria too specific";	
	   endif;
	}
}

function SA_getting_started() 
{
?>
<a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Header1.jpg"><img class="alignright size-full wp-image-17752" alt="Header1" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/Header1.jpg" width="851" height="150" /></a>
</br></br></br></br>

<div class="sa-page-intro"></br></br></br>
Welcome to your new one-stop shop for preventing obesity in Latino kids!</br></br></br>

You’re here because it’s clear you care about Latino kids.</br></br></br>

We want to help you learn about how to make change, find changes in your community, and add your own </br></br>changes and stories.</br></br></br>

Here’s how the site can help:</br></br></br></br>
</div>
<div>
<span style="color: #008000;"><strong>Why are we here?</strong></span>
</br></br>
&nbsp;
<a href="http://dev.communitycommons.org/wp-content/uploads/2013/03/Latino_play.jpg"><img class=" wp-image-12449 alignleft" alt="Health" src="http://dev.communitycommons.org/wp-content/uploads/2013/03/Latino_play.jpg" width="140" height="140" /></a>

</br>
<a href="http://ss">Learn about Latino childhood obesity issues</a></br>
</br>
<a href="http://ss">Learn about <em>Salud America!</em></a>
</div>
&nbsp;
</br></br></br></br></br></br></br>
<div>

<span style="color: #008000;"><strong>Not sure where to start?</strong></span>
</br></br>
&nbsp;
<a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/map2.jpg"><img class=" wp-image-12449 alignleft" alt="Health" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/map2.jpg" width="140" height="140" /></a>

</br>
<a href="http://dev.communitycommons.org/salud-america/sapolicies/">Browse changes happening in your area right now</a></br>

</br></br></br></br></br></br>
&nbsp;
<a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/advocacy_targets_box.jpg"><img class=" wp-image-12449 alignleft" alt="Health" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/advocacy_targets_box.jpg" width="140" height="140" /></a>

</br>
<a href="http://dev.communitycommons.org/salud-america/sapolicies/">Browse changes happening by one of 6 key topic areas</a></br>

</div>
&nbsp;

</br></br></br></br></br></br></br></br>
<div>

<span style="color: #008000;"><strong>Want to learn how you can make change?</strong></span>
</br></br>
&nbsp;
<a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/tools.jpg"><img class=" wp-image-12449 alignleft" alt="Health" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/tools.jpg" width="140" height="140" /></a>

</br>
<a href="http://dev.communitycommons.org/salud-america/saresourcespage/">Browse resources: toolkits, webinars, research, etc.</a></br>

</br></br></br></br></br></br></br></br>

<a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/change.jpg"><img class=" wp-image-12449 alignleft" alt="Health" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/change.jpg" width="140" height="140" /></a>

</br>
<a href="http://dev.communitycommons.org/salud-america/what-is-change/the-science-behind-change/">See the science behind change</a></br>

</div>
&nbsp;

</br></br></br></br></br></br></br></br>
<div>

<span style="color: #008000;"><strong>Want to see people who have made changes in their areas?</strong></span>
</br></br>
&nbsp;
<a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Video_thumbnail.jpg"><img class=" wp-image-12449 alignleft" alt="Health" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/Video_thumbnail.jpg" width="140" height="140" /></a>

</br>
<a href="http://dev.communitycommons.org/salud-america/success-stories">See stories of successful changes</a></br>
</div>
</br></br></br></br></br></br></br></br>

<div>

<span style="color: #008000;"><strong>Ready to make a change?</strong></span>
</br></br>
&nbsp;
<a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/images.jpg"><img class=" wp-image-12449 alignleft" alt="Health" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/images.jpg" width="140" height="140" /></a>

</br>
<a href="http://dev.communitycommons.org/salud-america/share-your-own-stories/">Add a change you're making OR add a change we missed</a></br>

</br></br></br></br></br></br></br>

<a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/share.png"><img class=" wp-image-12449 alignleft" alt="Health" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/share.png" width="140" height="140" /></a>

</br>
<a href="http://dev.communitycommons.org/salud-america/share-your-own-stories/">Share your success story</a></br>

</div>
<?php
}