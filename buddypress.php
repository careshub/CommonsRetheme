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

<?php 
// Don't include a sidebar if on single member, single group, BuddyPress docs archive page, registration page or main site activity page.
// We achieve the full-width look by modifying the body class in functions.php::cc_custom_body_class()
// TODO: bp_is_activity_directory() is only available at BP 2.0
// if ( ! ( bp_is_group_single() || bp_is_user() || is_archive( 'bp-doc' ) || bp_is_activity_directory() ) )
if ( ! ( bp_is_group_single() 
	|| bp_is_user() 
	|| is_archive( 'bp-doc' )
	|| bp_is_register_page()
	|| ( ! bp_displayed_user_id() && bp_is_activity_component() && ! bp_current_action() )
	|| bp_is_group_create() 
	) )
	get_sidebar( $sidebar );
?>
<?php get_footer(); ?>