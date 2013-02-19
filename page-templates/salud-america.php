<?php
/*
Template Name: Salud America
*/

get_header(); ?>
<div class="salud-header clear">
	<a href="#" class="logo"><img src="/wp-content/themes/CommonsRetheme/img/SA-logox200.png" class=""></a>
	<h1>Salud America! <br />Advocacy Program</h1>
	<h3>Get involved in reducing latino childhood obesity.</h3>
</div>
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