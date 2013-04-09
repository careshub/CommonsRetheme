<?php
/**
 * Template Name: Homegrown Help Template
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php //Add help area sub-navigation menu 
				$args = array(
					'theme_location' => 'help-area',
					//'menu'            => '', 
					'container'       => 'false', 
					// 'container_class' => 'jumplinks', 
					// 'container_id'    => 'jumplinks',
					// 'menu_class' 	=> 'footer-nav',
					'menu_id'         => 'jumplinks',
					'echo'            => true,
					// 'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => ''
					);
				wp_nav_menu( $args );
				?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page-notitle' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>