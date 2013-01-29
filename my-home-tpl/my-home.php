<?php get_header() ?>

	<div id="content">
		<div class="padder">

			<div id="item-header">
				<?php locate_template( array( 'members/single/member-header.php' ), true ) ?>
			</div>

			<!-- <div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav">
					<ul>
						<?php bp_get_displayed_user_nav() ?>
					</ul>
				</div>
			</div> -->

			<div id="item-body">

				<div class="item-list-tabs no-ajax" id="subnav">
					<ul class="nav-tabs">
						<?php bp_get_options_nav() ?>
					</ul>
				</div>
				<?php do_action('bp_my_home_before_widgets');?>
				
				<?php bp_my_home_load_widgets();?>
				
				<?php do_action('bp_my_home_after_widgets');?>


			</div><!-- #item-body -->

		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_sidebar( 'members-single' ); ?>
<?php get_footer() ?>