<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
	<ul>
		<li class="feed"><a href="<?php bp_group_activity_feed_link(); ?>" title="<?php _e( 'RSS Feed', 'buddypress' ); ?>"><?php _e( 'RSS', 'buddypress' ); ?></a></li>

		<?php do_action( 'bp_group_activity_syndication_options' ); ?>

		<li id="activity-filter-select" class="last">
			<label for="activity-filter-by"><?php _e( 'Show:', 'buddypress' ); ?></label> 
			<select id="activity-filter-by">
				<option value="-1"><?php _e( 'Everything', 'buddypress' ); ?></option>
				<option value="activity_update"><?php _e( 'Updates', 'buddypress' ); ?></option>

				<?php if ( bp_is_active( 'forums' ) ) : ?>
					<option value="new_forum_topic"><?php _e( 'Forum Topics', 'buddypress' ); ?></option>
					<option value="new_forum_post"><?php _e( 'Forum Replies', 'buddypress' ); ?></option>
				<?php endif; ?>

				<option value="joined_group"><?php _e( 'Group Memberships', 'buddypress' ); ?></option>

				<?php do_action( 'bp_group_activity_filter_options' ); ?>
			</select>
		</li>
	</ul>
</div><!-- .item-list-tabs -->

<?php do_action( 'bp_before_group_activity_post_form' ); ?>

<?php if ( is_user_logged_in() && bp_group_is_member() ) : ?>
	<?php locate_template( array( 'activity/post-form.php'), true ); ?>
<?php endif; ?>

<?php do_action( 'bp_after_group_activity_post_form' ); ?>
<?php do_action( 'bp_before_group_activity_content' ); ?>

<div class="activity single-group" role="main">
	
	<?php 
	//Check if this group has a tag set for aggregating activity
	// $activity_tag = groups_get_groupmeta( bp_get_group_id(), 'gtags_group_tags' );
	// if ( !empty($activity_tag) ) { 
	// 	//We can only use one tag to generate the aggregated activity list, so we grab the first tag.
	// 	$all_tags = explode(", ", $activity_tag);
	// 	$activity_tag = $all_tags[0];
	// }
	//print_r($activity_tag);
		
	// if ( function_exists('cc_group_custom_meta') && ( cc_group_custom_meta('group_use_tag_activity') == 'on' ) && !empty($activity_tag) ) {
	// 	// This group is set to use aggregated activity and has a tag assigned to it. GO!
	// 	echo do_shortcode('[group_tag_activity tag=' . $activity_tag . ' show=10]');

	// } else {  //Show the default activity loop
		locate_template( array( 'activity/activity-loop.php' ), true ); 
	// }
	?>
</div><!-- .activity.single-group -->

<?php do_action( 'bp_after_group_activity_content' ); ?>
