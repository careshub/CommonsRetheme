<footer id="single-group-footer" class="single-group-footer clear">

	<div class="group-visibility clear <?php cc_group_visibility_class(); ?>">
		<span class="group-type"><?php bp_group_type();?></span><span class="group-tree">
		<?php
		if ( function_exists('bp_group_hierarchy_get_breadcrumbs') )  {
			echo 'Hub Tree: </em>'; 
			echo bp_group_hierarchy_get_breadcrumbs('&ensp;&gt;&ensp;', false); 
		}
	?></span></div> 

	<div id="item-meta">
		
		<!-- <p class="group-breadcrumbs"><em>Group Tree:</em> <?php //if (function_exists('bp_group_hierarchy_get_breadcrumbs'))  { echo bp_group_hierarchy_get_breadcrumbs('&ensp;&gt;&ensp;', false); } ?></p> -->

		<div class="group-description">
			<?php bp_group_description(); ?>
		</div>

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

					<h5><?php _e( 'Hub Moderators' , 'buddypress' ); ?></h5>

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