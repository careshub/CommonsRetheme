<?php
/*
Template Name: Salud America
*/

get_header(); ?>
<?php get_sidebar( 'salud-single' ); ?>


	<div id="primary" class="site-content">
		<div id="content" role="main">
			<div class="padder">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- .padder -->
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>