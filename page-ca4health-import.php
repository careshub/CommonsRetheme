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
			<p>This is the test page.</p>
			<pre>
				<?php 
	
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

// Master controls!
add_ca_groups( false );
// $building_partner_groups = false;
// $building_workspaces = false;
// $adding_cim_users_to_workspaces = false;
// $adding_cim_users_to_partners = false;

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

				// Creating workspaces
				if ( $building_workspaces && ($handle = fopen(get_stylesheet_directory_uri() . '/working/cim-import/import-cim-workspaces.csv', "r") ) !== FALSE ) {
				    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {

				    	$cim_iw_id = $data[1];
				    	// $creator_id = $data[1];
				    	$group_name = $data[2];
				    	$group_description = $data[3];
				    	// $status = $data[4];
				    	$parent_group_iw_id = $data[5];

				        echo '<p>IW ID: <code>'. $cim_iw_id . '</code><br />'; 
				        // echo 'Creator ID: '. $creator_id . '<br />';
				        echo 'Group Name: '. $group_name . '<br />';
				        echo 'Description: '. $group_description . '<br />';
				      	// echo 'Status: '. $status . '<br />';
				        echo 'Parent IW ID: '. $parent_group_iw_id . '<br />';
				       	echo 'Parent group ID: '. get_group_id_by_cim_iw_id( $parent_group_iw_id ) . '</p>';


				        $args = array(
							'creator_id' => 22,// Erin is 22 on www
							'name' => $group_name,
							'description' => $group_description,
							'slug' => cc_create_group_slug( $group_name ),
							'status' => 'private', //public, private or hidden
							'enable_forum' => 0, //0 or 1
							'date_created' => bp_core_current_time(),
							// Issue workspace version
							'parent_id' => get_group_id_by_cim_iw_id( $parent_group_iw_id ),
						     
						);
						// Vanilla BP function
						// $group_id = groups_create_group( $args );

						// BP Group Hierarchy extension allows parent ID
						$group_id = groups_hierarchy_create_group( $args );
							echo 'Group ID: ';
							print_r( $group_id );
							echo '<br />';

				        // Set useful group meta for our new group
						if ( $group_id ) {

							// Set the old CIM IW ID as a meta - We'll need this later!
								$cim_iw = groups_update_groupmeta( $group_id, 'cim_iw_id', $cim_iw_id  );
								echo 'CIM IW ID set: ';
								print_r($cim_iw);
								echo '<br />';
							// Set member level that can invite new group members, poss values members, mods, admins 
								$invite = groups_update_groupmeta( $group_id, 'invite_status', 'mods' );
								echo 'Invitation level set: ';
								print_r($invite);
								echo '<br />';
							// Set prime-group-ness 
								$prime = groups_update_groupmeta( $group_id, 'group_is_prime_group', 'on' );
								echo 'Prime-ness set: ';
								print_r($prime);
								echo '<br />';
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


				// Adding users to issue workspaces
			    if ( $adding_cim_users_to_workspaces && ($handle = fopen(get_stylesheet_directory_uri() . '/working/cim-import/import-cim-group-membership.csv', "r")) !== FALSE ) {

				    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

				    	$user_email = $data[1];
				    	$group_iw_id = $data[2];
				    	$admin_status = ( $data[3] == 'TRUE' ? TRUE : FALSE );

				        echo 'email: '. $user_email . '<br />';
				        echo 'Group IW ID: '. $group_iw_id . '<br />';
				        echo 'Admin?: '. $admin_status . '<br />';

						$user = get_user_by( 'email', $user_email );
						echo 'user to add: ' . $user->ID . '<br />';

						$group_to_join = get_group_id_by_cim_iw_id( $group_iw_id );

						if ( $user && $group_to_join ) {
							echo 'Group ID: ' . $group_to_join . '<br />';
							//Add the user to the group
							$joining = groups_join_group( $group_to_join, $user->ID );
								echo 'Joined group: '; 
								print_r($joining);
								echo '<br />';

							//Promote to admin if necessary
						    // possible roles: 'admin' or 'mod' 
							// form: $promoting = groups_promote_member( $user_id, $group_id, $new_role );
							if ( $admin_status ) {
								$promoting = groups_promote_member( $user->ID, $group_to_join, 'admin' );
								// echo 'Should promote';
								echo 'Promoted in group: '; 
								print_r($promoting);
							} 

						} else {
							echo 'user or group not found' . '<br />';
						}
						
						

						
						echo '<br />';

					} // end while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

					fclose($handle);
			    }

			    // Adding users to partner groups
			    if ( $adding_cim_users_to_partners && ($handle = fopen(get_stylesheet_directory_uri() . '/working/cim-import/import-cim-partner-members.csv', "r")) !== FALSE ) {

				    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

				    	$user_email = $data[0];
				    	$group_iw_id = $data[2];
				    	// $admin_status = ( $data[3] == 'TRUE' ? TRUE : FALSE );

				        echo 'email: '. $user_email . '<br />';
				        echo 'Group IW ID: '. $group_iw_id . '<br />';
				        // echo 'Admin?: '. $admin_status . '<br />';

						$user = get_user_by( 'email', $user_email );
						echo 'user to add: ' . $user->ID . '<br />';

						if ( $group_iw_id != '#N/A' ) {
							$group_to_join = get_group_id_by_cim_iw_id( $group_iw_id );
						} else {
							$group_to_join = null;
						}

						if ( $user && $group_to_join ) {
							echo 'Group ID: ' . $group_to_join . '<br />';
							//Add the user to the group
							$joining = groups_join_group( $group_to_join, $user->ID );
							 echo 'Joined group: '; 
							print_r($joining);
							 echo '<br />';

						} else {
							echo 'user or group not found' . '<br />';
						}
						
						

						
						echo '<br />';

					} // end while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

					fclose($handle);
			    }










				// $geo_tax = wp_get_object_terms( $post->ID, 'geographies' ); 16860
				// $geo_tax = wp_get_object_terms( $post->ID, 'geographies' ); 
			 //    $geo_tax_id = $geo_tax[0]->term_id;
			 //    $geo_id = term_description( $geo_tax_id, 'geographies' );

			 //    $input = sanitize_text_field( 'bp-attachments\12456/filename.txt' );
			 //    echo $input;

			 //    if ( class_exists( 'BP_Group_Extension' ) ) {
			 //    	echo "class exists!";
			 //    }

				    
				
				


				?>
			</pre>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>