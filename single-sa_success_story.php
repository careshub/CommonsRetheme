<?php get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>

		<div id="content" role="main">
			<div class="padder">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'sa_success_story' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			                         
		</div><!-- .padder -->
		</div><!-- #content -->
		
<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>