<?php
add_action( 'init', 'register_taxonomy_advocacy_targets' );

function register_taxonomy_advocacy_targets() {

    $labels = array( 
        'name' => _x( 'Advocacy Targets', 'advocacy_targets' ),
        'singular_name' => _x( 'Advocacy Target', 'advocacy_target' ),
        'search_items' => _x( 'Search Advocacy Targets', 'advocacy_targets' ),
        'popular_items' => _x( 'Popular Advocacy Targets', 'advocacy_targets' ),
        'all_items' => _x( 'All Advocacy Targets', 'advocacy_targets' ),
        'parent_item' => _x( 'Parent Advocacy Target', 'advocacy_targets' ),
        'parent_item_colon' => _x( 'Parent Advocacy Target:', 'advocacy_targets' ),
        'edit_item' => _x( 'Edit Advocacy Target', 'advocacy_targets' ),
        'update_item' => _x( 'Update Advocacy Target', 'advocacy_targets' ),
        'add_new_item' => _x( 'Add New Advocacy Target', 'advocacy_targets' ),
        'new_item_name' => _x( 'New Advocacy Target', 'advocacy_targets' ),
        'separate_items_with_commas' => _x( 'Separate advocacy targets with commas', 'advocacy_targets' ),
        'add_or_remove_items' => _x( 'Add or remove Advocacy Targets', 'advocacy_targets' ),
        'choose_from_most_used' => _x( 'Choose from most used Advocacy Targets', 'advocacy_targets' ),
        'menu_name' => _x( 'Advocacy Targets', 'advocacy_targets' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'advocacy_targets', array('sapolicies'), $args );
}
