<footer id="single-group-footer" class="single-group-footer clear">

	<?php 
	// Get group visibility to display and set footer header bar color.
	$group_type =  bp_get_group_type();
	switch ( $group_type ) {
		case 'Hidden Group':
			$visibility_class = 'ccred';
			break;
		case 'Private Group':
			$visibility_class = 'ccblue';
			break;
		default:
			$visibility_class = 'ccgreen';
			break;
	}
	?>

	<div class="group-visibility clear <?php echo $visibility_class; ?>"><span><?php bp_group_type(); ?></span></div> 

	<div id="item-meta">
		<div id="item-actions" class="clear">

		<?php if ( bp_group_is_visible() ) : ?>

			<div class="half-block compact">

				<h5><?php _e( 'Group Admins', 'buddypress' ); ?></h5>

				<?php bp_group_list_admins();

				do_action( 'bp_after_group_menu_admins' );
			?>

			</div>

			<?php 
			if ( bp_group_has_moderators() ) : ?>

				<div class="half-block compact">

					<?php

					do_action( 'bp_before_group_menu_mods' ); ?>

					<h5><?php _e( 'Group Moderators' , 'buddypress' ); ?></h5>

					<?php bp_group_list_mods();

					do_action( 'bp_after_group_menu_mods' );
					?>

				</div>

				<?php
			endif;

		endif; ?>

		</div><!-- #item-actions -->

		<?php //bp_group_description(); ?>

		<div id="item-buttons">

			<?php do_action( 'bp_group_header_actions' ); ?>

		</div> <!-- #item-buttons -->

		<?php do_action( 'bp_group_header_meta' ); ?>

	</div>

</footer><!-- Group footer -->