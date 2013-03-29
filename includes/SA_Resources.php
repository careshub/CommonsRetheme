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
	$args = array(
		'labels' => $resource_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'has_archive' => 'saresources',
		'taxonomies' => array('resourcecat'),		
		'supports' => array('title','editor','comments'),
        'capability_type' => 'saresources',
        'map_meta_cap'    => true
	); 
	register_post_type('saresources',$args);
  




}


<<<<<<< HEAD


?>


    
       





=======
 add_action( 'save_post', 'saresource_save' );
 function saresource_save() { 
 
   global $post;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

     if ($post->post_type == 'saresources') {      
     
	   save_res_field("sa_sharing");	   
	   
     }
 }
 function save_res_field($event_field) {
    global $post;
    if(isset($_POST[$event_field])) {
        update_post_meta($post->ID, $event_field, $_POST[$event_field]);
    } else{
        delete_post_meta($post->ID, $event_field);
    }
 }
>>>>>>> Fix Headers already sent problem in SA_Resources
