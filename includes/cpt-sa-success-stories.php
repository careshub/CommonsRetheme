<?php
add_action( 'init', 'register_cpt_sa_success_story' );
function register_cpt_sa_success_story() {

    $labels = array( 
        'name' => _x( 'SA Success Stories', 'sa_success_story' ),
        'singular_name' => _x( 'SA Success Story', 'sa_success_story' ),
        'add_new' => _x( 'Add New', 'sa_success_story' ),
        'add_new_item' => _x( 'Add New SA Success Story', 'sa_success_story' ),
        'edit_item' => _x( 'Edit SA Success Story', 'sa_success_story' ),
        'new_item' => _x( 'New SA Success Story', 'sa_success_story' ),
        'view_item' => _x( 'View SA Success Story', 'sa_success_story' ),
        'search_items' => _x( 'Search SA Success Stories', 'sa_success_story' ),
        'not_found' => _x( 'No sa success stories found', 'sa_success_story' ),
        'not_found_in_trash' => _x( 'No sa success stories found in Trash', 'sa_success_story' ),
        'parent_item_colon' => _x( 'Parent SA Success Story:', 'sa_success_story' ),
        'menu_name' => _x( 'SA Success Stories', 'sa_success_story' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Used to highlight policies that went well and can serve as a model for change in other places.',
        'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ),
        'taxonomies' => array( 'sa_advocacy_targets' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'sa_success_story',
        'map_meta_cap' => true
    );

    register_post_type( 'sa_success_story', $args );
}

/**
 * Putting the meta box creation in a class
 * Calls the class on the post edit screen.
 */
function call_sa_success_story_meta_box() {

    return new sa_success_story_meta_box();
}
add_action( 'admin_init', 'call_sa_success_story_meta_box' );


/** 
 * The class that handles meta box creation.
 */
class sa_success_story_meta_box {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box() {
		// add_meta_box(
		// 	 'some_meta_box_name'
		// 	,__( 'Some Meta Box Headline', 'myplugin_textdomain' )
		// 	,array( $this, 'render_meta_box_content' )
		// 	,'post'
		// 	,'advanced'
		// 	,'high'
		// );

		add_meta_box( 
			'sa_success_stories_meta_box', 
			'More Details', 
			array( $this, 'render_meta_box_content' ), 
			'sa_success_story', 
			'normal', 
			'high'
			); 
	}

	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'sa_success_story_custom_meta_box', 'sa_success_story_custom_meta_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, 'sa_success_story_video_url', true );

		// Display the form, using the current value.
		echo '<label for="sa_success_story_video_url">';
		echo 'Featured video URL <em>e.g.: http://www.youtube.com/watch?v=UueU0-EFido</em>';
		echo '</label><br /> ';
		echo '<input type="text" id="sa_success_story_video_url" name="sa_success_story_video_url" value="' . esc_attr( $value ) . '" size="75" />';
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['sa_success_story_custom_meta_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['sa_success_story_custom_meta_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'sa_success_story_custom_meta_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$mydata = sanitize_text_field( $_POST['sa_success_story_video_url'] );

		// Update the meta field.
		update_post_meta( $post_id, 'sa_success_story_video_url', $mydata );
	}

}