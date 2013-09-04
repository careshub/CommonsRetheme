<?php
/**
 * The sidebar containing the group sub nav and widget area.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			<!-- <p> Salud sidebar single </p> -->
		<!-- <div id="group-navigation">  
		    <div id="group_sidebar">
				<div id="item-header-avatar">
				<?php bp_group_avatar() ?>
				</div>
			</div> -->
		    <div id="item-buttons">

				<?php do_action( 'bp_group_header_actions' ); ?>

			</div><!-- #item-buttons -->
		<!-- </div>      -->
		<div class="sidebar-activity-tabs no-ajax" id="object-nav" role="navigation">
			<!-- <ul>
				<?php bp_get_options_nav(); ?>
				<?php do_action( 'bp_group_options_nav' ); ?>
			</ul> -->

			<?php //Add sidebar navigation menu 
				$args = array(
					'theme_location' => 'salud-nav',
					//'menu'            => '', 
					'container'       => '', 
					//'container_class' => 'salud-nav', 
					//'container_id'    => '',
					//'menu_class' 	=> 'footer-nav',
					//'menu_id'         => 'menu-{menu slug}[-{increment}]',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					//'items_wrap'      => '%3$s',
					'depth'           => 0,
					'walker'          => ''
					);
				wp_nav_menu( $args );
				?>
		</div>

		<?php 
		//Loop to display the most recent changemaker featured image for eah target area.
		$advocacy_targets = get_terms('sa_advocacy_targets');
		// echo '<pre>';
		// print_r($advocacy_targets);
		// echo '</pre>';
		$do_not_duplicate = array();
		foreach ($advocacy_targets as $target) {
			//Build the query
			$args = array (
				'post_type' => 'saresources',
				'sa_advocacy_targets' => $target->slug,
				'sa_resource_cat' => 'success-stories',
				'posts_per_page' => 1,
				'post__not_in' => $do_not_duplicate,
				);
			$ssquery = new WP_Query( $args );
			while ( $ssquery->have_posts() ) {
				$ssquery->the_post();
				echo '<li>' . get_the_title() . ' | '. get_the_ID() . '</li>';
				print_r($do_not_duplicate);
				$do_not_duplicate[] = get_the_ID();
			}


		} //End foreach


		?>
		</div><!-- #secondary -->