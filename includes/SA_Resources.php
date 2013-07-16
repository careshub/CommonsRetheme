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
	    'supports' => array('title','editor','comments'),
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
	}else {            
		$seltext=$saresource_policy;
		$selval=$saresource_policy;
	}

	?>
<br>
            <input type="checkbox" id="saresource_promote" name="saresource_promote" value='Promote to Resources' <?php checked( $saresrouce_promote, 'Promote to Resources' ); ?>             
                   > <label for="saresource_promote"><strong>Promote to Resources</strong></label><br /></input>
            <?php 
                if ($saresource_promote != "") {
                    echo $saresource_promote;
                }
           ?>'
<br>

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
           saresource_save_event_field("saresource_promote");
	}
}
function saresource_save_event_field($event_field) {
    global $post;
    if(isset($_POST[$event_field])) {
        update_post_meta($post->ID, $event_field, $_POST[$event_field]);
    } else{
        delete_post_meta($post->ID, $event_field);
    }
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

    foreach ($resource_cats as $resource_cat) {

      // The Query

          $args = array(
          // Change these category SLUGS to suit your use.
          'post_type' => 'saresources',
          'sa_resource_cat' => $resource_cat,
          'showposts' => '3',
          );
          $resources_results = new WP_Query( $args );

          // The Loop
          if ( $resources_results->have_posts() ) : ?>

              <div class="<?php echo $block_class; ?>"> 
              <?php $counter = 0;
                 while ( $resources_results->have_posts() ) : $resources_results->the_post();
                    ++$counter;
              if ( $counter == 1 ) { ?>

              <header class="entry-header">
                <?php 
                  if ( function_exists('salud_get_taxonomy_images') ) {
                   echo salud_get_taxonomy_images($resource_cat, 'sa_resource_cat');
                  }
                ?>                   
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
              </header>                     
              <div class="entry-content"><?php the_excerpt();?></div> <!-- End .entry-content -->
              <h4>Other Resources</h4>
                <ul class="related-posts">
              <?php } else { ?>      
                    <li>
                      <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </li>   
              <?php } // end if $counter is not 1 
              // Reset Query
               wp_reset_query();      
               endwhile; ?>
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
    //Location parsing
      $custom_fields = get_post_custom();
      $geography_type = isset($custom_fields['sa_geog'][0]) ? $custom_fields['sa_geog'][0] : '';
      $geog_final = isset($custom_fields['sa_finalgeog'][0]) ? $custom_fields['sa_finalgeog'][0] : '';
      $geog_state = isset($custom_fields['sa_state'][0]) ? ucwords($custom_fields['sa_state'][0]) : '';
      switch ($geography_type) {
        case 'National':
          $location = 'United States';
          break;
        case 'State':
          $location = $geog_state;
          break;
        case 'County':
        case 'City':
        case 'School District':
        case 'US Congressional District':
        case 'State House District':
        case 'State Senate District':
          $location = $geog_final . ", " . $geog_state;
          break;
        default:
          $location = 'Location unknown';
          break;
        }
         
         return $location;
  } 
