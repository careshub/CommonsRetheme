<?php get_header( 'buddypress' ); ?>
<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>

	<div id="content">
		<div class="padder">
			<div id="item-header">
				<?php locate_template( array( 'groups/single/group-header.php' ), true ); ?>
			</div><!-- #item-header -->
			<div id="secondary" class="widget-area" role="complementary">
				<div id="group-navigation"> 
				    <div id="item-buttons">

						<?php do_action( 'bp_group_header_actions' ); ?>

					</div><!-- #item-buttons -->
					<div class="sidebar-activity-tabs no-ajax" id="object-nav" role="navigation">
						<ul>
							<?php bp_get_options_nav(); ?>
							<?php do_action( 'bp_group_options_nav' ); ?>
						</ul>
					</div>
				</div> 
				
			</div> <!-- End #secondary -->

			<?php do_action( 'bp_before_group_plugin_template' ); ?>
			<!-- <div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul>
						<?php bp_get_options_nav(); ?>

						<?php do_action( 'bp_group_plugin_options_nav' ); ?>
					</ul>
				</div>
			</div> --><!-- #item-nav -->

			<div id="item-body">

				<?php do_action( 'bp_before_group_body' ); ?>

				<?php do_action( 'bp_template_content' ); ?>

				<?php do_action( 'bp_after_group_body' ); ?>
			</div><!-- #item-body -->

			<?php do_action( 'bp_after_group_plugin_template' ); ?>


		</div><!-- .padder -->
	</div><!-- #content -->
	<?php endwhile; endif; ?>

	<?php get_sidebar( 'groups-single' ); ?>

<?php get_footer( 'buddypress' ); ?>