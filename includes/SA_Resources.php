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
