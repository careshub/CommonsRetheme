<?php 
function add_resourcecat_taxonomy() {
	// Add new "Resource Category" taxonomy to Salud America Resources	

	$labels = array(

			'name' => _x( 'Resource Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Resource Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Resource Categories' ),
			'all_items' => __( 'All Resource Categories' ),
			'parent_item' => __( 'Parent Resource Categories' ),
			'parent_item_colon' => __( 'Parent Resource Category:' ),
			'edit_item' => __( 'Edit Resource Category' ),
			'update_item' => __( 'Update Resource Category' ),
			'add_new_item' => __( 'Add New Resource Category' ),
			'new_item_name' => __( 'New Resource Category Name' ),
			'menu_name' => __( 'Resource Categories' )
		);		

		
	$args = array(
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => true,
		'hierarchical' => false,
        'show_ui' => true,		
		'capabilities' => array(
						'manage_terms' => 'manage_saresourcecat',
						'delete_terms' => 'manage_saresourcecat',
						'edit_terms' => 'manage_saresourcecat',
						'assign_terms' => 'manage_saresourcecat'
					)		
	);

    register_taxonomy('resourcecat', 'saresources', $args);
	
		
}
add_action( 'init', 'add_resourcecat_taxonomy', 0 );
