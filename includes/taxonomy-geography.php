<?php 
function add_custom_taxonomies() {
	// Add new "Geographies" taxonomy to Salud America Policies
	register_taxonomy('geographies', 'sapolicies', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
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
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'geographies', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
                'show_ui' => false,
	));
        
}
add_action( 'init', 'add_custom_taxonomies', 0 );
