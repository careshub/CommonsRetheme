<div id="buddypress">

	<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>

	<?php do_action( 'bp_before_group_home_content' ); ?>

	<div id="item-header" role="complementary">

		<?php bp_get_template_part( 'groups/single/group-header' ); ?>

	</div><!-- #item-header -->

	<div id="secondary">
		<div class="item-list-tabs no-ajax clear" id="object-nav" role="navigation">
			<ul>

				<?php bp_get_options_nav(); ?>

				<?php do_action( 'bp_group_options_nav' ); ?>

			</ul>
		</div>
	</div><!-- #item-nav -->

	<div id="item-body">

		<?php //do_action( 'bp_before_group_body' );

		/**
		 * Does this next bit look familiar? If not, go check out WordPress's
		 * /wp-includes/template-loader.php file.
		 *
		 * @todo A real template hierarchy? Gasp!
		 */

		// Group is visible
		if ( bp_group_is_visible() ) : 

			// Looking at home location
			if ( bp_is_group_home() ) :

				//Check if this group has a post set to be its custom front page.
				$group_id = bp_get_group_id();
				$args =  array(
				   'post_type'   => 'group_home_page',
				   'posts_per_page' => '1',
				   'meta_query'  => array(
				                       array(
				                        'key'           => 'group_home_page_association',
				                        'value'         => $group_id,
				                        'compare'       => '=',
				                        'type'          => 'NUMERIC'
				                        )
				                    )
				); 
				// The Query
				$custom_front_query = new WP_Query( $args );
				$GLOBALS['custom-group-front'] = $custom_front_query;

				//Check if this group has a post set to be its custom front page.
				$front_page_post = cc_get_group_home_page_post();

				if ( $front_page_post && $front_page_post->have_posts()) : 
					bp_get_template_part( 'groups/single/front' );

				// Default to activity
				elseif ( bp_is_active( 'activity' ) ) : 
					bp_get_template_part( 'groups/single/activity' );

				// Otherwise show members
				elseif ( bp_is_active( 'members'  ) ) : 
					bp_get_template_part( 'groups/single/members'  );

				endif;
				
			// Not looking at home
			else :

				// Group Admin
				if     ( bp_is_group_admin_page() ) : bp_get_template_part( 'groups/single/admin'        );

				// Group Activity
				elseif ( bp_is_group_activity()   ) : bp_get_template_part( 'groups/single/activity'     );

				// Group Members
				elseif ( bp_is_group_members()    ) : bp_get_template_part( 'groups/single/members'      );

				// Group Invitations
				elseif ( bp_is_group_invites()    ) : bp_get_template_part( 'groups/single/send-invites' );

				// Old group forums
				elseif ( bp_is_group_forum()      ) : bp_get_template_part( 'groups/single/forum'        );

				// Anything else (plugins mostly)
				else                                : bp_get_template_part( 'groups/single/plugins'      );

				endif;
			endif;

		// Group is not visible
		elseif ( ! bp_group_is_visible() ) :

			// Looking at home location
			if ( bp_is_group_home() ) :

				//Check if this group has a post set to be its custom front page.
				$front_page_post = cc_get_group_home_page_post();

				if ( $front_page_post && $front_page_post->have_posts() ) {
					bp_get_template_part( 'groups/single/front' );
				} else {
					// No custom home page is set, just show the no access message
					do_action( 'bp_before_group_status_message' ); ?>

					<div id="message" class="info">
						<p><?php bp_group_status_message(); ?></p>
					</div>

					<?php do_action( 'bp_after_group_status_message' );
				}

			// Membership request
			elseif ( bp_is_group_membership_request() ) :
				bp_get_template_part( 'groups/single/request-membership' );

			// The group is not visible, show the status message
			else :

				do_action( 'bp_before_group_status_message' ); ?>

				<div id="message" class="info">
					<p><?php bp_group_status_message(); ?></p>
				</div>

				<?php do_action( 'bp_after_group_status_message' );

			endif;
		endif;

		do_action( 'bp_after_group_body' ); ?>

	</div><!-- #item-body -->

	<?php do_action( 'bp_after_group_home_content' ); ?>

	<!-- CAVEAT - putting this sidebar inside the group loop means that you can't use any widgets that use the group loop -->
	<?php //get_sidebar( 'groups-single' ); ?>

	<?php bp_get_template_part( 'groups/single/footer'); ?>

	<?php endwhile; endif; ?>

	
</div><!-- #buddypress -->
