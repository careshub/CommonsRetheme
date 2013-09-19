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
		add_action( 'save_post', array( $this, 'save_custom_upload_data' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box() {

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
		?>
		<label for="sa_success_story_video_url" class="description">Featured video URL <em>e.g.: http://www.youtube.com/watch?v=UueU0-EFido</em></label><br />
		<input type="text" id="sa_success_story_video_url" name="sa_success_story_video_url" value="<?php esc_attr( $value); ?>" size="75" />
		
		<label for="post_media" class="description">Attach the PDF version of this story</label><br />
		<input id="post_media" type="file" name="post_media" value="" size="25" />
		<p class="description">
			<?php 
			if( '' == get_post_meta( $post->ID, 'umb_file', true ) ) {
				echo 'No PDF is attached to this post.';
			} else {
				echo 'Currently attached: ' . get_post_meta( $post->ID, 'umb_file', true );
			} // end if
			?>
		</p><!-- /.description -->
		
		<script type="text/javascript">
			jQuery(document).ready( function( $ ) {

				"use strict";
				
				$(function() {
				
					if( 0 < $('#post_media').length ) {
					  $('form').attr('enctype', 'multipart/form-data');
					} // end if
					
				});

			});
		</script>
<?php
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

		// First, make sure the user can save the post
		if( $this->user_can_save( $post_id, $this->nonce ) ) { 

			/* OK, its safe for us to save the data now. */

			// Sanitize the user input.
			$mydata = sanitize_text_field( $_POST['sa_success_story_video_url'] );

			// Update the meta field.
			update_post_meta( $post_id, 'sa_success_story_video_url', $mydata );

		}
	}

	public function save_custom_upload_data( $post_id ) {
	
		// First, make sure the user can save the post
		if( $this->user_can_save( $post_id, $this->nonce ) ) { 

			// If the user uploaded an image, let's upload it to the server
			if( ! empty( $_FILES ) && isset( $_FILES['post_media'] ) ) {
			
				// Upload the goal image to the uploads directory, resize the image, then upload the resized version
				$goal_image_file = wp_upload_bits( $_FILES['post_media']['name'], null, wp_remote_get( $_FILES['post_media']['tmp_name'] ) );

				// Set post meta about this image. Need the comment ID and need the path.
				if( false == $goal_image_file['error'] ) {
				
					// Since we've already added the key for this, we'll just update it with the file.
					update_post_meta( $post_id, 'umb_file', $goal_image_file['url'] );
		
				} // end if/else

			} // end if
	
		} // end if
	
	} // end update_data

	/*--------------------------------------------*
	 * Helper Functions
	 *--------------------------------------------*/

	/**
	 * Determines whether or not the current user has the ability to save meta data associated with this post.
	 *
	 * @param		int		$post_id	The ID of the post being save
	 * @param		bool				Whether or not the user has the ability to save this post.
	 */
	function user_can_save( $post_id, $nonce ) {
		
	    $is_autosave = wp_is_post_autosave( $post_id );
	    $is_revision = wp_is_post_revision( $post_id );
	    $is_valid_nonce = ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], plugin_basename( __FILE__ ) ) );
	    
	    // Return true if the user is able to save; otherwise, false.
	    return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
	 
	} // end user_can_save

}