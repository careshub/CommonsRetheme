<?php
/**
 * The template for displaying most BuddyPress pages
 * More specific templates are used when appropriate per BP's template hierarchy.
 *
 * @package WordPress
 * @subpackage Commons ReTheme
 * @since 1.2
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page-notitle' ); ?>
				<?php //comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php // Don't include a sidebar if on single member or single group sidebar
if ( !( bp_is_group_single() || bp_is_user() ) )
	get_sidebar( $sidebar );
 ?>
<?php get_footer(); ?>