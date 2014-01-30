 <?php
/**
 * The functional page for creating new bp-docs.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<p>This is the cim import content page.</p>
			<pre>
		<?php
		add_cim_content( false );

		function add_cim_content( $run_for_real ) {
			// Adding users to issue workspaces
		    if ( ( $handle = fopen( get_stylesheet_directory_uri() . '/working/cim-content-import.csv', "r" ) ) !== FALSE ) {

			    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			    	$old_doc_id = $data[0];
			    	$doc_title = $data[1];
			    	$doc_content = $data[2];
			    	$user_email = $data[3];
			    	$doc_type = $data[4];
			    	$file_attachment = $data[5];
			    	$associated_group_id = $data[6];
			    	// $group_iw_id = $data[2];
			    	// $admin_status = ( $data[3] == 'TRUE' ? TRUE : FALSE );
					//Find CC user ID
					$user = get_user_by( 'email', $user_email );
					$user_id = $user->ID;
					//Find CC group id
					// $associated_group_id = get_group_id_by_cim_iw_id( $group_iw_id );


			    	echo 'old doc ID: ' . $old_doc_id . PHP_EOL;
			    	echo 'doc title: ' . $doc_title . PHP_EOL;
			    	echo 'doc content: ' . $doc_content . PHP_EOL;
			        echo 'email: '. $user_email . PHP_EOL;
			        echo 'user ID: ' . $user_id  . PHP_EOL;
			        echo 'doc type: ' . $doc_type . PHP_EOL;
			        echo 'group ID: ' . $associated_group_id . PHP_EOL;

			        // echo 'Group IW ID: '. $group_iw_id  . PHP_EOL;
			        // echo 'Admin?: '. $admin_status  . PHP_EOL;

			        //The basic post save:
			        $args = array(
						'post_type'    => 'bp_doc',
						'post_title'   => $doc_title,
						'post_name'    => sanitize_title( $doc_title ), 
						'post_content' => sanitize_post_field( 'post_content', $doc_content, 0, 'db' ),
						'post_status'  => 'publish',
						'post_author' => $user_id,
					);

					print_r($args);

					// Insert the post
					if ($run_for_real) {
						$post_id = wp_insert_post( $args);
					}

					//Next, we tackle the group associations taxonomy.
					// If the Doc was successfully created, run some more stuff
					if ( ! empty( $post_id ) ) {

						// Add to a group, if necessary
						if ( isset( $associated_group_id ) ) {
							bp_docs_set_associated_group_id( $post_id, $associated_group_id );
						}

						// Set up some terms
						// This is the "group-associated" user_term_id
						$term_id = bp_docs_get_item_term_id( $group_id, 'group' );
						// This is the user association
						$user_term_id = bp_docs_get_item_term_id( $user_id, 'user' );
						
						// Make sure the current user is added as one of the authors
						// wp_set_post_terms( $post_id, $user_term_id, 'bp_docs_associated_item', true );

						// Save the last editor id. We'll use this to create an activity item
						update_post_meta( $post_id, 'bp_docs_last_editor', $user_id );

						// Save settings
						// $settings = ! empty( $_POST['settings'] ) ? $_POST['settings'] : array();
						// Typical settings for saving to a group
						$settings = array( 	'edit' => 'group-members',
											'post_comments' => 'group-members',
											'read' => 'group-members',
											'read_comments' => 'group-members',
											'view_history' => 'group-members'
										);

						$verified_settings = bp_docs_verify_settings( $settings, $post_id, $user_id );

						$new_settings = array();
						foreach ( $verified_settings as $verified_setting_name => $verified_setting ) {
							$new_settings[ $verified_setting_name ] = $verified_setting['verified_value'];
						}
						update_post_meta( $post_id, 'bp_docs_settings', $new_settings );

						// The 'read' setting must also be saved to a taxonomy, for
						// easier directory queries
						$read_setting = isset( $new_settings['read'] ) ? $new_settings['read'] : 'anyone';
						bp_docs_update_doc_access( $post_id, $read_setting );

						// Increment the revision count
						$revision_count = get_post_meta( $post_id, 'bp_docs_revision_count', true );
						update_post_meta( $post_id, 'bp_docs_revision_count', intval( $revision_count ) + 1 );

						//Add the taxonomy term for the strategic direction
						//
						//
					}
					
					echo PHP_EOL;

				} // end while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

				fclose($handle);
		    }
		}

				function get_group_id_by_cim_iw_id( $group_iw_id ) {
					if ( empty( $group_iw_id ) )
						return false;

					$args = array( 
						'meta_query' => array(
								array(
									'key' => 'cim_iw_id',
									'value' => $group_iw_id,
									'compare' => 'LIKE',
								)
							) 
						);

						if ( bp_has_groups ( $args ) ) { 
							while ( bp_groups() ) : bp_the_group();
								$group_id = bp_get_group_id();

								if ( $group_id ) {
									return $group_id;
								} 

							endwhile;
						} else {
							return false;
						}
				}

				function cc_create_group_slug( $group_name ) { 
					//Create a url-friendly slug
					$group_name = sanitize_title( $group_name );

					//Check for a group that already has that slug
					if ( $group_id = groups_get_id( $group_name ) ) {
						$group_name = $group_name . '-1';
					}

					return $group_name;

				}

				?>
			</pre>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>