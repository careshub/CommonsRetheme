<?php

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php //comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			<pre>
	<?php
	
	// ccgn_create_terms_migrate();
	// May need to run twice!
	function ccgn_create_terms_migrate() {
		$groups = array(36, 50, 51, 52, 54, 55, 56, 58, 60, 521, 522, 527, 47, 528, 529, 84, 81, 79, 83, 85, 80, 87, 88, 531, 532, 534, 535, 536, 537, 538, 555, 556, 557, 552, 548, 49, 542, 543, 544, 565, 566, 567, 568, 569, 570, 571, 576, 577, 578, 579, 580, 581, 582, 564, 584, 585, 590, 591, 545, 593, 597, 553, 554, 549, 550, 48, 539, 540, 541, 546, 547, 551, 617, 619);

		// Are we using BP Group Hierarchy?
		$hierarchy_active = class_exists( 'BP_Groups_Hierarchy' );

		foreach ($groups as $group_id) {
			// Create a group object, using BP Group Hierarchy or not.
			$group_object = $hierarchy_active ? new BP_Groups_Hierarchy( $group_id ) : groups_get_group( array( 'group_id' => $group_id ) );

			if ( ! is_object($group_object) )
				continue;

			$group_name = $group_object->name;
			$term_args['description'] = 'Group narratives associated with ' . $group_name;

			// Check for a term for this group's parent group, set a value for the term's 'parent' arg
			// Depends on BP_Group_Hierarchy being active
			if  ( ( $parent_group_id = $group_object->vars['parent_id'] )  &&  
						( $parent_group_term = get_term_by( 'slug', ccgn_create_taxonomy_slug( $parent_group_id ), 'ccgn_related_groups' ) ) 
					) {
				$term_args['parent'] = (int) $parent_group_term->term_id;
			}

			if ( $existing_term_id = ccgn_get_group_term_id( $group_id ) ) {
				// $term_args['name'] = $group_name;
				// $term_array = wp_update_term( $existing_term_id, 'ccgn_related_groups', $term_args );
			} else {
				$term_args['slug'] = ccgn_create_taxonomy_slug( $group_id );
				$term_array = wp_insert_term( $group_name, 'ccgn_related_groups', $term_args );
			}

			if ( is_wp_error( $term_array ) ) {
				echo "error with " . $term_args['slug'];
			} else {
				echo "created or updated term " . $term_args['slug'];
			}
		}

	}

	?>
			</pre>
		</div>
	</div>

<?php get_footer(); ?>