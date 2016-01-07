<?php

/**
 * BuddyPress - Groups Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter()
 *
 * @package BuddyPress
 * @subpackage BP Group Hierarchy
 */

?>

<?php do_action( 'bp_before_groups_loop' ); ?>

<?php // If the user has chosen to hide the bp-normal all groups tab, we can help what happens at page load by modifying the object.
	$object = 'tree';
	if( get_site_option( 'bpgh_extension_hide_group_list', false ) ) {
		if ( ! empty( $_POST['cookie'] ) ) {
			$cookies = wp_parse_args( str_replace( '; ', '&', urldecode( $_POST['cookie'] ) ) );
		} else {
			$cookies = &$_COOKIE;
		}
		if ( isset( $cookies['bp-groups-scope'] ) && $cookies['bp-groups-scope'] == 'personal' ) {
			// If the user is trying to load or reload the "my groups" tab, the object needs to be "groups"
			$object = 'groups';
		}
	}

if ( bp_has_groups( bp_ajax_querystring( $object ) ) ) : ?>

	<div id="pag-top" class="pagination">

		<div class="pag-count" id="group-dir-count-top">

			<?php bp_groups_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="group-dir-pag-top">

			<?php bp_groups_pagination_links(); ?>

		</div>

	</div>

	<?php do_action( 'bp_before_directory_groups_list' ); ?>

	<ul id="groups-list" class="item-list" role="main">

	<?php while ( bp_groups() ) : bp_the_group(); ?>

		<li id="tree-childof_<?php bp_group_id(); ?>">
			<?php if ( $object == 'tree' ) : ?>
			<div class="item-subitem-indicator">
				<?php if(bp_group_hierarchy_has_subgroups()) : ?>
				<a href="">[+]</a>
				<?php else: ?>
				<a href="" class="disabled">&nbsp;- </a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<div class="item-avatar">
				<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar(); ?></a>
			</div>

			<div class="item">
				<div class="item-title"><a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a></div>
				<div class="item-meta"><span class="activity"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span></div>

				<div class="item-desc"><?php bp_group_description_excerpt(); ?></div>

				<?php do_action( 'bp_directory_groups_item' ); ?>

			</div>

			<div class="action">

				<?php do_action( 'bp_directory_groups_actions' ); ?>

				<div class="meta">

					<?php bp_group_type(); ?> / <?php bp_group_member_count(); ?>

				</div>

			</div>

			<div class="clear"></div>
		</li>

	<?php endwhile; ?>

	</ul>

	<?php do_action( 'bp_after_directory_groups_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="group-dir-count-bottom">
			<?php bp_groups_pagination_count(); ?>
		</div>

		<div class="pagination-links" id="group-dir-pag-bottom">
			<?php bp_groups_pagination_links(); ?>
		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'There were no groups found.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_groups_loop' ); ?>
<?php do_action( 'bp_after_group_hierarchy_loop' ); ?>