<?php
add_action( 'init', 'register_taxonomy_sa_policy_tags' );

function register_taxonomy_sa_policy_tags() {

    $labels = array( 
        'name' => _x( 'SA Tags', 'sa_policy_tags' ),
        'singular_name' => _x( 'SA Tag', 'sa_policy_tags' ),
        'search_items' => _x( 'Search SA Tags', 'sa_policy_tags' ),
        'popular_items' => _x( 'Popular SA Tags', 'sa_policy_tags' ),
        'all_items' => _x( 'All SA Tags', 'sa_policy_tags' ),
        'parent_item' => _x( 'Parent SA Tag', 'sa_policy_tags' ),
        'parent_item_colon' => _x( 'Parent SA Tag:', 'sa_policy_tags' ),
        'edit_item' => _x( 'Edit SA Tag', 'sa_policy_tags' ),
        'update_item' => _x( 'Update SA Tag', 'sa_policy_tags' ),
        'add_new_item' => _x( 'Add New SA Tag', 'sa_policy_tags' ),
        'new_item_name' => _x( 'New SA Tag', 'sa_policy_tags' ),
        'separate_items_with_commas' => _x( 'Separate SA tags with commas', 'sa_policy_tags' ),
        'add_or_remove_items' => _x( 'Add or remove SA Tags', 'sa_policy_tags' ),
        'choose_from_most_used' => _x( 'Choose from most used SA Tags', 'sa_policy_tags' ),
        'menu_name' => _x( 'SA Tags', 'sa_policy_tags' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'capabilities' => array(
                        'manage_terms' => 'edit_sapoliciess',
                        'delete_terms' => 'edit_sapoliciess',
                        'edit_terms' => 'edit_sapoliciess',
                        'assign_terms' => 'edit_sapoliciess'
                        ),
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => false,
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'sa_policy_tags', array('sapolicies','saresources'), $args );
}