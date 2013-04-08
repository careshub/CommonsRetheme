<?php 
function add_resourcecat_taxonomy() {
	// Add new "Resource Category" taxonomy to Salud America Resources	

	$labels = array(

			'name' => _x( 'Resource Tags', 'taxonomy general name' ),
			'singular_name' => _x( 'Resource Tag', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Resource Tags' ),
			'all_items' => __( 'All Resource Tags' ),
			'parent_item' => __( 'Parent Resource Tags' ),
			'parent_item_colon' => __( 'Parent Resource Tag:' ),
			'edit_item' => __( 'Edit Resource Tag' ),
			'update_item' => __( 'Update Resource Tag' ),
			'add_new_item' => __( 'Add New Resource Tag' ),
			'new_item_name' => __( 'New Resource Tag Name' ),
			'menu_name' => __( 'Resource Tags' )
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

    register_taxonomy('sa_resourcecat', 'saresources', $args);
	
		
}
add_action( 'init', 'add_resourcecat_taxonomy', 0 );
