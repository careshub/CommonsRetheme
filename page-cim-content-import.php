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
		// Needed for file sideload
		require_once(ABSPATH . '/wp-admin/includes/file.php');
	    require_once(ABSPATH . '/wp-admin/includes/media.php');
	    require_once(ABSPATH . '/wp-admin/includes/image.php');
	    require_once(ABSPATH . 'wp-admin/includes/misc.php' );

		add_cim_content( false );
		// add_ca4health_content( false );

		function add_cim_content( $run_for_real ) {
			global $parent_post_id;
			//Sort the import records by user email or group id for slight efficiency
			$last_user_email = '';
			$last_group_iw_id = '';
			
		    if ( ( $handle = fopen( get_stylesheet_directory_uri() . '/working/cim-content-files.csv', "r" ) ) !== FALSE ) {

			    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			    	// echo PHP_EOL . '<hr>';

			    	$old_content_id = $data[0];
			    	$doc_title = $data[1];
			    	$doc_content = $data[2];
			    	$user_email = $data[4];
					$group_iw_id = $data[5];
			    	$doc_type = $data[6];
			    	$file_attachment = $data[7];
					
					// Find CC user_id, if different than the last user
			    	if ( $user_email != $last_user_email ) {
						$user = get_user_by( 'email', $user_email );
						$user_id = $user->ID;
					} else {
						// echo "Same user!" . PHP_EOL;
					}
					// Set the last user e-mail for the next time around
					$last_user_email = $user_email;

					// Find CC group_id, if different than the last
					if ( $group_iw_id != $last_group_iw_id ) {
						$associated_group_id = get_group_id_by_cim_iw_id( $group_iw_id );
					} else {
						// echo "Same group !" . PHP_EOL;
					}
					// Set the last group_iw_id for the next go round
					$last_group_iw_id = $group_iw_id;

					// If the thingy is a link, add it to the end of the content
					if ( $doc_type == 'Hyperlink' ) {
						$doc_content = $doc_content . '<br /> ' . PHP_EOL . $file_attachment;						
					}


			    	echo 'doc title: ' . $doc_title . PHP_EOL;
			    	echo 'doc content: ' . $doc_content . PHP_EOL;
			        echo 'email: '. $user_email . PHP_EOL;
			        echo 'user ID: ' . $user_id  . PHP_EOL;
			        echo 'doc type: ' . $doc_type . PHP_EOL;
			        echo 'group ID: ' . $associated_group_id . PHP_EOL;

			        //The basic post save:
			        $args = array(
						'post_type'    => 'bp_doc',
						'post_title'   => $doc_title,
						'post_name'    => sanitize_title( $doc_title ), 
						'post_content' => sanitize_post_field( 'post_content', $doc_content, 0, 'db' ),
						'post_status'  => 'publish',
						'post_author'  => $user_id,
					);

					// print_r($args);

					if ( $doc_type == 'File' ) {
							//Set the url
							// Should end up like http://www.cim-network.org/CIMcontent/BOCOMO/final_FAMT_report.pdf

							$file_attach_pieces = explode( '/', $file_attachment ); 
							// print_r($file_attach_pieces);
							$file_sitecore_partner = $file_attach_pieces[2];
							$file_sitecore_name = $file_attach_pieces[3];
							// We encode special characters in the filename, because there are lots of special characters in these filenames.
 							$file_sitecore_name_url = rawurlencode( $file_attach_pieces[3] );
 							$source_url = 'http://www.cim-network.org/CIMcontent/' . $file_sitecore_partner . '/' . $file_sitecore_name_url;

 						// 	echo PHP_EOL . 'sitecore_name: ' . $file_sitecore_name;
							echo PHP_EOL . 'source_url: ' . $source_url;
							$exists = remoteFileExists( $source_url);
							if ($exists) {
							    echo PHP_EOL . 'file exists' . PHP_EOL;
							 //    $tmp = download_url( $source_url );
							 //    print_r($tmp);
							 //    //BASENAME IS BROKEN WITH THIS SCHEME!! DO SOMETHING ELSE
								// $filename = basename($tmp);
								// echo "filename: " . $filename . PHP_EOL;
								// echo "filename redux: " . sanitize_title( $file_sitecore_name ) . PHP_EOL;

								$mime = wp_check_filetype( basename($source_url) );
								// print_r($mime);
							} else {
							    echo PHP_EOL . 'file does not exist: ' . $old_content_id;
							}
						}

					// Insert the post
					if ($run_for_real) {
						$post_id = wp_insert_post( $args);
					}

					//Next, we tackle the group associations taxonomy.
					// If the Doc was successfully created, run some more stuff
					if ( ! empty( $post_id ) ) {
						$parent_post_id = $post_id;

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

						// Handle file attachments
						if ( $doc_type == 'File' ) {
							//Set the url
							// $source_url = 'http://phds.ca4health.org/CA4Health_Content/Resources/' . rawurlencode( $file_attachment );
							// $file_attach_pieces = explode( '/', $file_attachment ); 
							// $file_sitecore_guid = $file_attach_pieces[0];
							// $file_sitecore_name = $file_attach_pieces[1];
 						// 	$file_sitecore_name_url = rawurlencode( $file_attach_pieces[1] );
 						// 	$source_url = 'http://phds.ca4health.org/CA4Health_Content/Resources/' . $file_sitecore_guid . '/' . $file_sitecore_name_url;
							// import_media_content( $source_url, $file_sitecore_name, $parent_post_id, $user_id );
						}

					} //if post_id
					
					echo PHP_EOL;

				} // end while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

				fclose($handle);
		    }
		}

		function add_ca4health_content( $run_for_real ) {
			global $parent_post_id;
			
			
			// Adding users to issue workspaces
		    if ( ( $handle = fopen( get_stylesheet_directory_uri() . '/working/amy-content-import-full-staging.csv', "r" ) ) !== FALSE ) {

			    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			    	$associated_group_id = $data[0];
			    	$user_email = $data[1];
			    	$resource_date = $data[3]; //Will need to process this? Maybe re-format it pre-import.
			    	$doc_type = $data[4];
			    	$file_attachment = $data[6];
			    	$attachment_author = $data[7];
			    	$doc_title = $data[8];
			    	$doc_content = $data[9];
			    	$county = $data[10];

			    	// $old_doc_id = $data[0];
			    	// $group_iw_id = $data[2];
			    	// $admin_status = ( $data[3] == 'TRUE' ? TRUE : FALSE );
					
					//Find CC user 
					$user = get_user_by( 'email', $user_email );
					$user_id = $user->ID;
					
					//Tags, need to do some concatenating
					$resource_cats = array( $data[2] ); //These contain commas
			    	$strategic_dir = array( $data[12] ); //???
					$tag_source = $data[13]; //Tags are pipe delimited
					$tags_array = explode( '|', $tag_source);
					$tags = array_filter( array_merge( $resource_cats, $strategic_dir, $tags_array ) ); //Array filter to remoe empty elements
					// print_r($tags);

					//Insert the author and date before the content, ( CA4Health stuff )
					if ( $resource_date ) {
						$doc_content = '<em>Date:</em> ' . $resource_date . '<br /> ' . PHP_EOL . $doc_content;
					}
					if ( $attachment_author ) {
						$doc_content = '<em>Author:</em> ' . $attachment_author . '<br /> ' . PHP_EOL . $doc_content;			
					}

					//If the thingy is a link, add it to the end of the content
					if ( $doc_type == 'Hyperlink' ) {
						$doc_content = $doc_content . '<br /> ' . PHP_EOL . $file_attachment;						
					}

					//Find CC group id
					// $associated_group_id = get_group_id_by_cim_iw_id( $group_iw_id );


			    	// echo 'old doc ID: ' . $old_doc_id . PHP_EOL;
			    	// echo 'doc title: ' . $doc_title . PHP_EOL;
			    	// echo 'doc content: ' . $doc_content . PHP_EOL;
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
						'post_author'  => $user_id,
						'tax_input'    => array( 'bp_docs_tag' => $tags ) 
					);

					print_r($args);

					if ( $doc_type == 'File' ) {
							//Set the url
							//Replace spaces only? --Works for fetching the file, mostly? This is going to be a pain in the ass. 

							// MAYBE grab the actual filename and rawurlencode just it?
							$file_attach_pieces = explode( '/', $file_attachment ); 
							$file_sitecore_guid = $file_attach_pieces[0];
							$file_sitecore_name = $file_attach_pieces[1];
 							$file_sitecore_name_url = rawurlencode( $file_attach_pieces[1] );
 							$source_url = 'http://phds.ca4health.org/CA4Health_Content/Resources/' . $file_sitecore_guid . '/' . $file_sitecore_name_url;
 							echo PHP_EOL . 'sitecore_name: ' . $file_sitecore_name;
							echo PHP_EOL . 'source_url: ' . $source_url;
							$exists = remoteFileExists( $source_url);
							if ($exists) {
							    echo PHP_EOL . 'file exists' . PHP_EOL;
							 //    $tmp = download_url( $source_url );
							 //    print_r($tmp);
							 //    //BASENAME IS BROKEN WITH THIS SCHEME!! DO SOMETHING ELSE
								// $filename = basename($tmp);
								// echo "filename: " . $filename . PHP_EOL;
								// echo "filename redux: " . sanitize_title( $file_sitecore_name ) . PHP_EOL;

								$mime = wp_check_filetype( basename($source_url) );
								print_r($mime);
							} else {
							    echo PHP_EOL . 'file does not exist';   
							}
						}

					// Insert the post
					if ($run_for_real) {
						$post_id = wp_insert_post( $args);
					}

					//Next, we tackle the group associations taxonomy.
					// If the Doc was successfully created, run some more stuff
					if ( ! empty( $post_id ) ) {
						$parent_post_id = $post_id;

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

						// Handle file attachments
						if ( $doc_type == 'File' ) {
							//Set the url
							// $source_url = 'http://phds.ca4health.org/CA4Health_Content/Resources/' . rawurlencode( $file_attachment );
							$file_attach_pieces = explode( '/', $file_attachment ); 
							$file_sitecore_guid = $file_attach_pieces[0];
							$file_sitecore_name = $file_attach_pieces[1];
 							$file_sitecore_name_url = rawurlencode( $file_attach_pieces[1] );
 							$source_url = 'http://phds.ca4health.org/CA4Health_Content/Resources/' . $file_sitecore_guid . '/' . $file_sitecore_name_url;
							import_media_content( $source_url, $file_sitecore_name, $parent_post_id, $user_id );
						}

					} //if post_id
					
					echo PHP_EOL;

				} // end while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

				fclose($handle);
		    }
		}

		function import_media_content( $url, $file_sitecore_name, $parent_post_id, $author_id ) {
			global $parent_post_id;

			//Check that we can fetch the remote file, else bail out.
			$exists = remoteFileExists( $url );
			if ( !$exists ) {
				echo PHP_EOL . 'Error: ' . $file_sitecore_name . ' file does not exist. :(';
			    return false;
			}
		    
			$tmp = download_url( $url );
			// $filename = basename($tmp);
			echo "filename: " . $file_sitecore_name . PHP_EOL;
			$mime = wp_check_filetype( basename($url) );
			print_r($mime);

			// If error storing temporarily, unlink
			if ( is_wp_error( $tmp ) ) {
				echo PHP_EOL . "error on tmp";
				@unlink($file_array['tmp_name']);
				$file_array['tmp_name'] = '';
			}

			// Set variables for storage
			$file_args = array( //array to mimic $_FILES
		            'name' => $file_sitecore_name, //Use the unfiltered sitecore file name for the file name
		            'type' => $mime['type'],
		            'tmp_name' => $tmp, //this field passes the actual path to the image
		            'error' => 0, //normally, this is used to store an error, should the upload fail. but since this isnt actually an instance of $_FILES we can default it to zero here
		            'size' => filesize($tmp) //returns image filesize in bytes
		        );

			echo PHP_EOL . "File args: ";
			print_r( $file_args );
			echo PHP_EOL;

			//temporarily add a filter to the upload directory calculation
			add_filter( 'upload_dir', 'cc_filter_upload_dir' );
			// do the validation and storage stuff
			$id = media_handle_sideload( $file_args, $parent_post_id, $filename );

			echo PHP_EOL . "Created media post id: ";
			print_r( $id );
			echo PHP_EOL;

			// If error storing permanently, unlink
			if ( is_wp_error( $id ) ) {
				echo "error creating the post";
				@unlink($file_array['tmp_name']);
				return $id;
			}


			$src = wp_get_attachment_url( $id );

			print_r( $src );

			//Update the author to match the parent doc's author
			  $args = array(
			      'ID'           => $id,
			      'post_author' => $author_id
			  );

 			  wp_update_post( $args );

			//Create the .htaccess file
 			$upload_dir = wp_upload_dir();
 			$htaccess_path = $upload_dir['path'] . DIRECTORY_SEPARATOR . '.htaccess';
 			echo PHP_EOL . "htaccess_path: " . $htaccess_path;
			// $htaccess_path = $this->get_htaccess_path();
			$rules = cc_import_generate_rewrite_rules( $parent_post_id );

			if ( ! empty( $rules ) ) {
				insert_with_markers( $htaccess_path, 'BuddyPress Docs', $rules );
			}

			//Remove the dir upload filter
			remove_filter( 'upload_dir', 'cc_filter_upload_dir' );

		}

		function cc_filter_upload_dir( $uploads ) {
			global $parent_post_id;

			$subdir = DIRECTORY_SEPARATOR . 'bp-attachments' . DIRECTORY_SEPARATOR . $parent_post_id;

			$uploads['subdir'] = $subdir;
			$uploads['path'] = $uploads['basedir'] . $subdir;
			$uploads['url'] = $uploads['baseurl'] . '/bp-attachments/' . $parent_post_id;

			return $uploads;
		}

		function cc_import_generate_rewrite_rules( $doc_id ) {
			$rules = array();

			$url = bp_docs_get_doc_link( $doc_id );
			$url_parts = parse_url( $url );

			if ( ! empty( $url_parts['path'] ) ) {
				$rules = array(
					'RewriteEngine On',
					'RewriteBase ' . $url_parts['path'],
					'RewriteRule (.+) ?bp-attachment=$1 [R=302,NC]',
				);
			}

			return $rules;
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

		function remoteFileExists($url) {
		    $curl = curl_init($url);

		    //don't fetch the actual page, you only want to check the connection is ok
		    curl_setopt($curl, CURLOPT_NOBODY, true);

		    //do request
		    $result = curl_exec($curl);

		    $ret = false;

		    //if request did not fail
		    if ($result !== false) {
		        //if request was ok, check response code
		        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  

		        if ($statusCode == 200) {
		            $ret = true;   
		        }
		    }

		    curl_close($curl);

		    return $ret;
		}



		?>
			</pre>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>