<?php
/**
 * BuddyPress - Groups Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of a group's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_group_header' );

?>



<!-- <div id="item-header-avatar">
	<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">

		<?php bp_group_avatar(); ?>

	</a>
</div> --><!-- #item-header-avatar -->

<div id="item-header-content">

	<!-- <p class="group-breadcrumbs"><em>Group Tree:</em> <?php // if (function_exists('bp_group_hierarchy_get_breadcrumbs'))  { echo bp_group_hierarchy_get_breadcrumbs('&ensp;&gt;&ensp;', false); } ?></p> -->

	<!-- <div class="group-visibility <?php cc_group_visibility_class(); ?>">
		<span class="group-type"><?php bp_group_type(); ?></span>
	</div> -->



	<div class="noms clear">
		<h2>
			<div id="item-header-avatar">
				<?php bp_group_avatar( 'width=80&height=80' ) ?>
			</div>
			<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>"><?php bp_group_name(); ?></a></h2>
	</div>

	<!-- <span class="highlight clear"><?php bp_group_type(); ?></span>  -->
	<!-- <span class="activity clear"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span> -->

	<?php do_action( 'bp_before_group_header_meta' ); ?>

	<!-- <div id="item-meta"> -->
		<?php /* ?>
		<div id="item-actions">

		<?php if ( bp_group_is_visible() ) : ?>

			<h3><?php _e( 'Group Admins', 'buddypress' ); ?></h3>

			<?php bp_group_list_admins();

			do_action( 'bp_after_group_menu_admins' );

			if ( bp_group_has_moderators() ) :
				do_action( 'bp_before_group_menu_mods' ); ?>

				<h3><?php _e( 'Group Mods' , 'buddypress' ); ?></h3>

				<?php bp_group_list_mods();

				do_action( 'bp_after_group_menu_mods' );

			endif;

		endif; ?>

		</div><!-- #item-actions -->
		<?php */ ?>

		<?php //bp_group_description(); ?>

		<?php /* ?>
		<div id="item-buttons">

			<?php do_action( 'bp_group_header_actions' ); ?>

		</div> <!-- #item-buttons -->
		<?php */ ?>


		<?php //do_action( 'bp_group_header_meta' ); ?>

	<!-- </div> -->
</div><!-- #item-header-content -->

<?php
do_action( 'bp_after_group_header' );
do_action( 'template_notices' );
?>