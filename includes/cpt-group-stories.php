<?php
// Create new CPT for group stories. These are the posts, or narratives, collected from the group component.

add_action( 'init', 'register_cpt_group_story' );
function register_cpt_group_story() {

    $labels = array( 
        'name' => _x( 'Group Stories', 'group_story' ),
        'singular_name' => _x( 'Group Story', 'group_story' ),
        'add_new' => _x( 'Add New', 'group_story' ),
        'add_new_item' => _x( 'Add New Group Story', 'group_story' ),
        'edit_item' => _x( 'Edit Group Story', 'group_story' ),
        'new_item' => _x( 'New Group Story', 'group_story' ),
        'view_item' => _x( 'View Group Story', 'group_story' ),
        'search_items' => _x( 'Search Group Stories', 'group_story' ),
        'not_found' => _x( 'No group stories found', 'group_story' ),
        'not_found_in_trash' => _x( 'No group stories found in Trash', 'group_story' ),
        'parent_item_colon' => _x( 'Parent Group Story:', 'group_story' ),
        'menu_name' => _x( 'Group Stories', 'group_story' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Used to collect new posts ("Narratives") from spaces.',
        'supports' => array( 'title', 'editor', 'author', 'revisions' ),
        'taxonomies' => array( 'post_tag', 'related_groups' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 60,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'group_story', $args );
}

add_action( 'init', 'register_taxonomy_related_groups' );

function register_taxonomy_related_groups() {

    $labels = array( 
        'name' => _x( 'Related Groups', 'related_groups' ),
        'singular_name' => _x( 'Related Group', 'related_groups' ),
        'search_items' => _x( 'Search Related Groups', 'related_groups' ),
        'popular_items' => _x( 'Popular Related Groups', 'related_groups' ),
        'all_items' => _x( 'All Related Groups', 'related_groups' ),
        'parent_item' => _x( 'Parent Related Group', 'related_groups' ),
        'parent_item_colon' => _x( 'Parent Related Group:', 'related_groups' ),
        'edit_item' => _x( 'Edit Related Group', 'related_groups' ),
        'update_item' => _x( 'Update Related Group', 'related_groups' ),
        'add_new_item' => _x( 'Add New Related Group', 'related_groups' ),
        'new_item_name' => _x( 'New Related Group', 'related_groups' ),
        'separate_items_with_commas' => _x( 'Separate related groups with commas', 'related_groups' ),
        'add_or_remove_items' => _x( 'Add or remove related groups', 'related_groups' ),
        'choose_from_most_used' => _x( 'Choose from the most used related groups', 'related_groups' ),
        'menu_name' => _x( 'Related Groups', 'related_groups' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'related_groups', array('group_story'), $args );
}