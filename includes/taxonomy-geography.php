<?php 
add_action( 'init', 'register_taxonomy_sa_geographies' );

function register_taxonomy_sa_geographies() {
	// Add new "Geographies" taxonomy to Salud America Policies

$labels = array(
			'name' => _x( 'Geographies', 'taxonomy general name' ),
			'singular_name' => _x( 'Geography', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Geographies' ),
			'all_items' => __( 'All Geographies' ),
			'parent_item' => __( 'Parent Geographies' ),
			'parent_item_colon' => __( 'Parent Geography:' ),
			'edit_item' => __( 'Edit Geography' ),
			'update_item' => __( 'Update Geography' ),
			'add_new_item' => __( 'Add New Geography' ),
			'new_item_name' => __( 'New Geography Name' ),
			'menu_name' => __( 'Geographies' ),
		);
 
$args = array( 
        'labels' => $labels,
        'public' => false,
        // 'show_in_nav_menus' => false,
        // 'show_ui' => false,
        'show_tagcloud' => false,
        'show_admin_column' => false,
        'hierarchical' => true,
		'rewrite' => array(
					'slug' => 'geographies', // This controls the base slug that will display before each term
					'with_front' => false, // Don't display the category base before "/locations/"
					'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
				),
       // 'query_var' => true
    );

    register_taxonomy( 'geographies', 'sapolicies', $args );
        
}