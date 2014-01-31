<?php
add_action( 'init', 'register_cpt_sa_success_story' );
function register_cpt_sa_success_story() {

    $labels = array( 
        'name' => _x( 'Salud Heroes', 'sa_success_story' ),
        'singular_name' => _x( 'Salud Hero', 'sa_success_story' ),
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

	private $nonce = 'sa_success_story_custom_meta_box_nonce';

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		add_action( 'save_post', array( $this, 'save_custom_upload_data' ) );
		add_action( 'wp_ajax_delete_success_story_pdf', array( $this, 'ajax_delete_success_story_pdf' ) );

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
		wp_nonce_field( 'sa_success_story_custom_meta_box', $this->nonce );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, 'sa_success_story_video_url', true );
		
		//****ADDED BY MIKE B.*********
		$locvalue = get_post_meta( $post->ID, 'sa_success_story_location', true );
		$latvalue = get_post_meta( $post->ID, 'sa_success_story_latitude', true );
		$longvalue = get_post_meta( $post->ID, 'sa_success_story_longitude', true );
		
		// Display the form, using the current value.
		?>
		<label for="sa_success_story_video_url" class="description"><h4>Featured video URL</h4>
			<em>e.g.: http://www.youtube.com/watch?v=UueU0-EFido</em></label><br />
		<input type="text" id="sa_success_story_video_url" name="sa_success_story_video_url" value="<?php echo esc_attr( $value); ?>" size="75" />
		
		<!--****ADDED BY MIKE B.*********-->
		<label for="sa_success_story_location" class="description"><h4>Location</h4>	
			<em>e.g.: Houston, Texas</em></label><br />		
		<input type="text" id="sa_success_story_location" name="sa_success_story_location" value="<?php echo esc_attr( $locvalue); ?>" size="75" />	<input type="button" id="sa_success_story_save_location" value="Verify Location" /> <img id="sa_success_story_save_location_check" src="http://dev.communitycommons.org/wp-content/uploads/2013/12/greencheck.png" style="vertical-align:middle;" />	
		<input type="hidden" id="sa_success_story_latitude" name="sa_success_story_latitude" value="<?php echo esc_attr( $latvalue); ?>" /><input type="hidden" id="sa_success_story_longitude" name="sa_success_story_longitude" value="<?php echo esc_attr( $longvalue); ?>" />
		
		
		
		
		
		
		<label for="sa_success_story_pdf" class="description"><h4>Attach the PDF version of this story</h4></label>
		<input id="sa_success_story_pdf" type="file" name="sa_success_story_pdf" value="" size="25" />
		<p class="description">
			<?php 
			if( '' == get_post_meta( $post->ID, 'sa_success_story_pdf', true ) ) {
				echo 'No PDF is attached to this post.';
			} else {
				echo '<span id="attached_pdf_info">Currently attached: ' . get_post_meta( $post->ID, 'sa_success_story_pdf', true ) . ' (<a id="delete_attached_pdf">Detach this PDF</a>)</span>';
			} // end if
			?>
			 
		</p><!-- /.description -->
		
		<script type="text/javascript">
			jQuery(document).ready( function( $ ) {

				"use strict";
				
				$(function() {
				
					if( 0 < $('#sa_success_story_pdf').length ) {
					  $('form').attr('enctype', 'multipart/form-data');
					} // end if
					
				});

				//For deleting attachments
				var data = {
					action: 'delete_success_story_pdf',
					post_attachment_to_delete: <?php echo $post->ID; ?>,
					security: '<?php echo wp_create_nonce( 'delete_attached_pdf' ); ?>'
				};

				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				$("#delete_attached_pdf").click(function(evt) {
					$.post(
							ajaxurl, 
							data, 
							function(response) {
							// alert('Got this from the server: ' + response);
								if ( response == 1 ) {
									$("#attached_pdf_info").text("No PDF is attached to this post.");
								}
							}
						);
				});
				
				
				//*******ADDED BY MIKE B.****************
				$("#sa_success_story_save_location_check").hide();
				$("#sa_success_story_save_location").click(function() {
					var geogterm = jQuery("#sa_success_story_location").val();
					var dataString = 'geogstr=' + geogterm;
				
					 $.ajax
						 ({
						   type: "POST",               
						   url: "http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/ajax/getlatlong.php",
						   data: dataString,
						   cache: false,               
						   error: function() {
							 alert("Could not compute a latitude/longitude for this location. Please modify your location.");
						   },
						   success: function(k)
						   {       
							 //alert(k);
							 var coord = $.parseJSON(k);
							 $("#sa_success_story_latitude").val(coord.latitude); 
							 $("#sa_success_story_longitude").val(coord.longitude); 
							 $("#sa_success_story_save_location_check").show();
						   } 
						 });
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
					
			// Sanitize the user input.
			$video_url = sanitize_text_field( $_POST['sa_success_story_video_url'] );

			// Update the meta field.
			if ( !empty( $video_url ) ) {
				update_post_meta( $post_id, 'sa_success_story_video_url', $video_url );
			} else {
				delete_post_meta( $post_id, 'sa_success_story_video_url' );
			}
			//***********ADDED BY MIKE B. *****************
			update_post_meta( $post_id, 'sa_success_story_location', $_POST['sa_success_story_location'] );
			update_post_meta( $post_id, 'sa_success_story_latitude', $_POST['sa_success_story_latitude'] );
			update_post_meta( $post_id, 'sa_success_story_longitude', $_POST['sa_success_story_longitude'] );
		}

	}

	public function save_custom_upload_data( $post_id ) {
	
		// First, make sure the user can save the post
		if( $this->user_can_save( $post_id, $this->nonce ) ) { 

			// If the user uploaded an image, let's upload it to the server
			// $_FILES isn't enough, we need to see if there's something specific set, like the name
			if( !empty( $_FILES ) && !empty( $_FILES['sa_success_story_pdf']['name']) ) {
			
				// Upload the goal image to the uploads directory, resize the image, then upload the resized version
				// $goal_image_file = wp_upload_bits( $_FILES['sa_success_story_pdf']['name'], null, wp_remote_get( $_FILES['sa_success_story_pdf']['tmp_name'] ) );

				// Set post meta about this image. Need the comment ID and need the path.
				// if( false == $goal_image_file['error'] ) {
				
				// 	// Since we've already added the key for this, we'll just update it with the file.
				// 	update_post_meta( $post_id, 'sa_success_story_pdf', $goal_image_file['url'] );
		
				// } // end if/else

				// Use the WordPress API to upload the file  
	            $upload = wp_upload_bits($_FILES['sa_success_story_pdf']['name'], null, file_get_contents($_FILES['sa_success_story_pdf']['tmp_name']));

	   //          $towrite = PHP_EOL . "FILES" . print_r($_FILES, TRUE);
				// $towrite .= PHP_EOL . print_r($upload, TRUE);
				// $fp = fopen('success_story_files.txt', 'a');
				// fwrite($fp, $towrite);
				// fclose($fp);
	      
	            if( isset( $upload['error'] ) && $upload['error'] != 0 ) {  
	                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);  
	            } else if ( !empty($upload['url']) ) {
	            	//Only record the meta if it isn't empty 
	                update_post_meta($post_id, 'sa_success_story_pdf', $upload['url'] );       
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
	public function user_can_save( $post_id, $nonce ) {
		
	    // Don't save if the user hasn't submitted the changes
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return false;
		} // end if

		// Verify that the input is coming from the proper form
		if( ! wp_verify_nonce( $_POST[ $nonce ], 'sa_success_story_custom_meta_box' ) ) {
			return false;
		} // end if

		// Make sure the user has permissions to post
		// if( 'post' == $_POST['post_type'] ) {
		// 	if( ! current_user_can( 'edit_post', $post_id ) ) {
		// 		return;
		// 	} // end if
		// } // end if/else

		return true;
	 
	} // end user_can_save

	public function ajax_delete_success_story_pdf() {
		global $wpdb; // this is how you get access to the database

		if( wp_verify_nonce( $_REQUEST['security'], 'delete_attached_pdf' ) ) {

		$post_attachment_to_delete = intval( $_POST['post_attachment_to_delete'] );

		$success = delete_post_meta( $post_attachment_to_delete, 'umb_file' );
	        
		die( $success ); // this is required to return a proper result

		} else {
			die('-1');
		}
	}

}

//Insert ads after lead in paragraph of single success story.

add_filter( 'the_content', 'insert_actions_in_success_stories' );
function insert_actions_in_success_stories( $content ) {

	if ( is_singular( 'sa_success_story' ) && ! is_admin() ) {
		global $post;
		$pdf_url = get_post_meta( $post->ID, 'sa_success_story_pdf', true );
		$insertion = '<p><a href="' . $pdf_url . '" class="button">Download the PDF</a> <a class="button add-comment-link" href="#respond"><span class="comment-icon"></span>Comment</a> ';
		if ( function_exists( 'bp_get_share_post_button' ) ) {
			$insertion .= bp_get_share_post_button();
		}
		$insertion .= '</p>';
		return insert_random_content_after_paragraph( $insertion, 1, $content );
	}
	
	return $content;
}
 
// Parent Function that makes the magic happen
function insert_random_content_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	foreach ($paragraphs as $index => $paragraph) {

		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}

		if ( $paragraph_id == $index + 1 ) {
			$paragraphs[$index] .= $insertion;
		}
	}
	
	return implode( '', $paragraphs );
}

// add_filter( 'embed_oembed_html', 'success_story_oembed_filter', 10, 4 ) ;
function success_story_oembed_filter($html, $url, $attr, $post_ID) {
	// $towrite = PHP_EOL . '$html: ' . print_r($html, TRUE);
	// $towrite .= PHP_EOL . '$url: ' . print_r($url, TRUE);
	// $towrite .= PHP_EOL . '$attr: ' . print_r($attr, TRUE);
	// $towrite .= PHP_EOL . '$post_id: ' . print_r($post_ID, TRUE);
	// $fp = fopen('oembed_bits.txt', 'a');
	// fwrite($fp, $towrite);
	// fclose($fp);

	if ( is_singular('sa_success_story') ) {
	    $html = '<figure class="video-container">'.$html.'</figure>';
	}
    return $html;
}

// customize embed settings
function youtube_hide_controls_filter($html){
    if( strpos($html, 'youtu.be') !== false || strpos($html, 'youtube.com') !== false ){
  //   	$towrite = PHP_EOL . '$html, before: ' . print_r($html, TRUE);
		// $fp = fopen('oembed_bits.txt', 'a');
		// fwrite($fp, $towrite);
		// fclose($fp);
        $html = preg_replace("@src=\"(.+?)\?(.+?)\"\s@", "src=\"$1?$2&showinfo=0&rel=0&autohide=1\" ", $html);
  //   	$towrite = PHP_EOL . '$html, after: ' . print_r($html, TRUE);
		// $fp = fopen('oembed_bits.txt', 'a');
		// fwrite($fp, $towrite);
		// fclose($fp);
        return $html;
    }
    return $html;
}
 
// add_filter('embed_handler_html', 'custom_youtube_settings');
//This filter handles embeds in content, etc.
add_filter('embed_oembed_html', 'youtube_hide_controls_filter', 77);
//This filter handles embeds fetched via wp_oembed_get.
add_filter('oembed_result', 'youtube_hide_controls_filter', 77);

function cc_get_youtube_video_metadata( $url ) {

	//Get the important part of the $video_url
	// URLs can take the form 'http://youtu.be/WZE-VHRtau8', 'https://www.youtube.com/watch?v=e5yNGuE9qzY' OR 'https://www.youtube.com/watch?v=e5yNGuE9qzY&feature=embedded', so we've got to handle some cases
	if ( stripos( $url, 'www.youtube.com' )  ) {

		$parsed = parse_url($url);
		$args = explode( '&', $parsed['query'] );
		foreach ( $args as $piece ) {
			if ( stripos( $piece, 'v=') !== false ) {
				//Remove the leading 'v='
				$guts = substr( $piece, 2 );
			}
		}

	} else if ( stripos( $url, 'youtu.be' ) ) {

		$parsed = parse_url($url);
		// Remove the leading slash
		$guts = substr( $parsed['path'], 1);
	} else {
		return false;
	}

	$json_output = file_get_contents( "http://gdata.youtube.com/feeds/api/videos/{$guts}?v=2&alt=json" );
	$json = json_decode($json_output, true);
	// print_r($json);

	//This gives you the video description
	$video_description = $json['entry']['media$group']['media$description']['$t'];

	//This gives you the video views count
	$view_count = $json['entry']['yt$statistics']['viewCount'];

	//This gives you the video title
	$video_title = $json['entry']['title']['$t'];

	return array( 	'title' => $video_title, 
					'description' => $video_description, 
					'count' => $view_count
					);
}
// Allow for another archive style that only shows the video posts.
add_filter('pre_get_posts', 'sa_heroes_video_post_archive');
function sa_heroes_video_post_archive( $query ) {
	// If the "style" flag is set to video, only show stories with videos
    if( is_archive( 'sa_success_story' ) 
    	&& !is_admin() 
    	&& $query->is_main_query() 
    	&& ( isset( $_GET['style'] ) && ( $_GET['style'] == 'videos' ) )
    	) {
        
        $meta_query = 	array(
					        array(
					           'key' => 'sa_success_story_video_url',
					           'compare' => 'EXISTS',
					        )
					    );
		$query->set( 'meta_query', $meta_query );
		// Only load 6 at a time, since these pages are ridiculously huge.
		$query->set( 'posts_per_page', 6 );
    }
}

function sa_get_random_hero_video() {

	$args = array(
		'post_type' 			=> 'sa_success_story',
		'orderby'               => 'rand',
		'posts_per_page'         => 1,
		
		//Custom Field Parameters
		'meta_query'     => array(
			array(
				'key' => 'sa_success_story_video_url',
				'compare' => 'EXISTS'
			),
		),
		
	);
	
	$video_story = new WP_Query( $args );
	// print_r($video_story);

	// Use alternate syntax (using the_post() object messes up the outer WP_Query loop because wp_reset_postdata in this case resets the postdata to the archive page's real job, not the page intro secondary loop. 
	foreach ($video_story->posts as $video) {

		$video_url = get_post_meta( $video->ID, 'sa_success_story_video_url', 'true' );

		if ( !empty( $video_url ) ) {
			$video_embed_code = wp_oembed_get( $video_url );
		}

		if ( $video_embed_code ) { ?>
			<div class="video-container-group">
				<figure class="video-container">
					<?php echo $video_embed_code; ?>
				</figure>
				<?php if ( is_archive( 'sa_success_story' ) ) { ?>
					<a href="/sa_success_story/?style=videos" title="link to the Salud Heroes video archive" class="button">Watch all videos</a> 
				<?php } else { ?>
					<figcaption>See how these <a href="/sa_success_story/">Salud Heroes</a> are fighting Latino obesity…and learn how easy it is to be a Salud Hero, too!</figcaption>
				<?php } ?>
			</div>
			<?php } // End if $video_embed_code
	} // End foreach 
}