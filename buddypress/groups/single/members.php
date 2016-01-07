<?php
/**
 * BuddyPress - Groups Members
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php if ( bp_group_has_members( bp_ajax_querystring( 'group_members' ) ) ) : ?>

	<?php do_action( 'bp_members_directory_member_sub_types' ); ?>

	<?php

	/**
	 * Fires before the display of the group members content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_group_members_content' ); ?>

	<div id="pag-top" class="pagination no-ajax">

		<div class="pag-count" id="member-count-top">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php

	/**
	 * Fires before the display of the group members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_group_members_list' ); ?>

	<ul id="member-list" class="item-list">

		<?php while ( bp_group_members() ) : bp_group_the_member(); ?>

			<li <?php bp_member_class(); ?>>
				<div class="item-avatar">
					<a href="<?php bp_group_member_domain(); ?>"><?php bp_group_member_avatar_thumb(); ?></a>
				</div>

				<div class="item">
						<div class="item-title"><?php bp_group_member_link(); ?></div>
						<span class="activity"><?php bp_group_member_joined_since(); ?></span>

					<?php

					/**
					 * Fires inside the display of a directory member item.
					 *
					 * @since 1.1.0
					 */
					do_action( 'bp_directory_members_item' ); ?>

					<?php
					 /***
					  * If you want to show specific profile fields here you can,
					  * but it'll add an extra query for each member in the loop
					  * (only one regardless of the number of fields you show):
					  *
					  * bp_member_profile_data( 'field=the field name' );
					  */
					?>
				</div>


				<?php

				/**
				 * Fires inside the listing of an individual group member listing item.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_group_members_list_item' ); ?>

				<div class="action">

					<?php
					if ( bp_is_active( 'friends' ) ) {
						bp_add_friend_button( bp_get_group_member_id(), bp_get_group_member_is_friend() );
						}
					?>

					<?php

					/**
					 * Fires inside the action section of an individual group member listing item.
					 *
					 * @since 1.1.0
					 */
					do_action( 'bp_group_members_list_item_action' ); ?>

				</div>

			</li>

		<?php endwhile; ?>

	</ul>

	<?php

	/**
	 * Fires after the display of the group members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_group_members_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php

	/**
	 * Fires after the display of the group members content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_group_members_content' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'No members were found.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>
