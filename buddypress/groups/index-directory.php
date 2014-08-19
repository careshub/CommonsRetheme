<?php
/**
 * The template for displaying the BuddyPress member directory
 * 
 *
 * @package WordPress
 * @subpackage Commons ReTheme
 * @since 1.2
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php //comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'groups' ); ?>
<?php get_footer(); ?>