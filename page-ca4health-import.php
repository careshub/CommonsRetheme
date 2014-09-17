 <?php
/**
 * The template for the topically-oriented maps and data tool overview.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<p>This is the CA import page.</p>
			<pre>
<?php 
// Master controls!
// Note arg 1 = CA4Health, CA4Health Coordinators, CA4Health Evaluators, Funded County or Strategic Direction
// add_ca_users_to_groups( 'CA4Health', false ); 
// add_ca_users_to_groups( 'CA4Health Coordinators', false ); 
// add_ca_users_to_groups( 'CA4Health Evaluators', false );
// add_ca_users_to_groups( 'Funded County', false );
// add_ca_users_to_groups( 'Strategic Direction', false );
// add_ca_users_to_groups( 'View', false );


function add_ca_users_to_groups( $type_to_run, $run_for_real ) {

	// Which groups?
	$ca_top_group_id = array( 47 );
	$ca_coords = array( 553 );
	$ca_evals = array( 554 );
	$ca_counties = array( 49, 542, 543, 544, 545, 546, 547, 548, 549, 550, 551, 552 );
	$ca_sd_groups = array( 539, 540, 541, 48 );
	$ca_all_groups = array( 47, 48, 49, 539, 540, 541, 542, 543, 544, 545, 546, 547, 548, 549, 550, 551, 552, 553, 554 );

	if ( ($handle = fopen(get_stylesheet_directory_uri() . '/working/ca-import-users-to-groups-9-16.csv', "r")) !== FALSE ) {

	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	    	// print_r( $data );
	    	$user_email = $data[0];
	    	$group_type = $data[2];
	    	$primary_group_id = $data[3];
	    	$admin_status = ( $data[4] == 'TRUE' ? TRUE : FALSE );

	    	// Reset
	    	$groups_to_join = array();
	    	$groups_to_admin_in = array();
	    	$groups_to_mod_in = array(); 
	    	
	    	if ( $group_type != $type_to_run )
	    		continue; 

	    	echo PHP_EOL;
	        echo 'email: '. $user_email . PHP_EOL;
	        echo 'Group Type: '. $group_type . PHP_EOL;
	        echo 'Primary ID: '. $primary_group_id . PHP_EOL;
	        echo 'Admin?: '. $admin_status . PHP_EOL;

			if ( ! $user = get_user_by( 'email', $user_email ) ) {
				echo "user not found." . PHP_EOL;
				continue;
			} else {
				echo 'user to add: ' . $user->ID . PHP_EOL;
			}

			// Set the groups to join and promote in based on group type
			switch ( $group_type ) {
				case 'CA4Health':
					// Add to all CA4Health groups. 
					$groups_to_join = $ca_all_groups;
					// Admin = TRUE means promote in top level group
					if ( $admin_status ) {
						$groups_to_admin_in = $ca_all_groups;
					} else {
						// These users should be admins in all the child groups regardless of admin status.
						$groups_to_admin_in = array_diff( $ca_all_groups, $ca_top_group_id );
					}
					break;

				case 'CA4Health Coordinators':
					// Add to all CA4Health groups.
					$groups_to_join = $ca_all_groups;
					// Should be admins in top level, coord and eval groups
					$groups_to_admin_in = array_merge( $ca_top_group_id, $ca_coords, $ca_evals );
					break;

				case 'CA4Health Evaluators':
					// Add to all CA4Health groups.
					$groups_to_join = $ca_all_groups;
					// Should be admins in eval group
					$groups_to_admin_in = array($ca_evals);
					break;

				case 'Funded County':
				case 'Strategic Direction':
					// Add to top level, strategic direction and all county groups.
					$groups_to_join = array_merge( $ca_top_group_id, $ca_sd_groups, $ca_counties );
					// If admin, promote to admin in primary group, else make a mod
					if ( $admin_status ) {
						$groups_to_admin_in = array( $primary_group_id );
					} else {
						$groups_to_mod_in = array( $primary_group_id );
					}
					break;
				case 'View':
					// Add to top level, strategic direction and all county groups.
					$groups_to_join = array_merge( $ca_top_group_id, $ca_sd_groups, $ca_counties );
					// Not an admin anywhere				
				default:
					# code...
					break;
			}

				// Join groups
				if ( $groups_to_join ) {
					foreach ( $groups_to_join as $group_id ) {
						if ( $run_for_real ) {
							$joining = groups_join_group( $group_id, $user->ID );
						}
						echo 'Joined group: ' . $group_id . " " ; 
						print_r( $joining );
						echo PHP_EOL;
					}
				}

				// Promote to admin if necessary
				if ( $groups_to_admin_in ) {
					foreach ( $groups_to_admin_in as $group_id ) {
						if ( $run_for_real ) {
							$promoting = groups_promote_member( $user->ID, $group_id, 'admin' );
						}
						// echo 'Should promote';
						echo 'Promoted to admin in group ' . $group_id . ': ';
						print_r( $promoting );
						echo PHP_EOL;
					}
				}

				// Promote to mod if necessary
				if ( $groups_to_mod_in ) {
					foreach ( $groups_to_mod_in as $group_id ) {
						if ( $run_for_real ) {
							$promoting = groups_promote_member( $user->ID, $group_id, 'mod' );
						}
						// echo 'Should promote';
						echo 'Promoted to mod in group ' . $group_id . ': ';
						print_r( $promoting );
						echo PHP_EOL;
					}
				}
				echo PHP_EOL;

		} // end while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

		fclose($handle);
	}

}

// Creating Partner Groups
function add_ca_groups( $run_for_real ) {
	if ( ($handle = fopen(get_stylesheet_directory_uri() . '/working/ca4health-groups.csv', "r") ) !== FALSE ) {
	    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
	    	$local_id = $data[0];
	    	$local_parent_id = $data[1];
	    	$www_id = $data[2];
	    	$www_parent_id = $data[3];
	    	$group_name = $data[4];
	    	$group_description = $data[5];

	        echo 'Local ID: '. $local_id . PHP_EOL;
	    	echo 'Local Parent ID: '. $local_parent_id . PHP_EOL;
	    	echo 'WWW ID: '. $www_id . PHP_EOL;
	    	echo 'WWW Parent ID: '. $www_parent_id . PHP_EOL;
	    	echo 'Group Name: '. $group_name . PHP_EOL;
	    	echo 'Group Description: '. $group_description . PHP_EOL;

	        $args = array(
				'creator_id' => 22,// Erin is 22 on www
				'name' => $group_name,
				'description' => $group_description,
				'slug' => cc_create_group_slug( $group_name ),
				'status' => 'private', //public, private or hidden
				'enable_forum' => 1, //0 or 1
				'date_created' => bp_core_current_time(),
				// 'parent_id' => $www_parent_id,
				'parent_id' => $local_parent_id,
			     
			);
			print_r( $args );
			// Vanilla BP function
			// $group_id = groups_create_group( $args );

			// BP Group Hierarchy extension allows parent ID
			if ($run_for_real) {
			$group_id = groups_hierarchy_create_group( $args );
				echo 'Group was created. ID: ';
				print_r( $group_id );
				echo '<br />';
			}

	        // Set useful group meta for our new group
			if ( $group_id ) {

				// Set member level that can invite new group members, poss values members, mods, admins 
					$invite = groups_update_groupmeta( $group_id, 'invite_status', 'mods' );
					echo 'Invitation level set: ';
					print_r($invite);
					echo '<br />';
				// Set prime-group-ness 
					// $prime = groups_update_groupmeta( $group_id, 'group_is_prime_group', 'on' );
					// echo 'Prime-ness set: ';
					// print_r($prime);
					// echo '<br />';
				// Turn on bp-docs
					$bp_docs = groups_update_groupmeta( $group_id, 'bpdocs', 'a:2:{s:12:"group-enable";s:1:"1";s:10:"can-create";s:6:"member";}' );
					echo 'BP docs set: ';
					print_r($bp_docs);
					echo '<br />';
				// Turn on aggregated activity
					$group_use_aggregated_activity = groups_update_groupmeta( $group_id, 'group_use_aggregated_activity', 'on' );
					echo 'Aggregated activity: ';
					print_r($group_use_aggregated_activity);
					echo '<br />';
			}

	        }

	    fclose($handle);
	    }
	} //End add_ca_groups


// Creating BP Docs as a content import strategy
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
			$tags = array_filter( array_merge( $resource_cats, $strategic_dir, $tags_array ) ); //Array filter to remove empty elements
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
	if ( ! $exists ) {
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