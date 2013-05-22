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
	// 	'taxonomies' => array('sa_resourcecat', 'sa_advocacy_targets'),		
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
	    'taxonomies' => array('sa_advocacy_targets', 'sa_resourcecat'),
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