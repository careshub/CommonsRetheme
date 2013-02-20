<?php
/*
Template Name: Salud America
*/

get_header(); ?>
<div class="salud-header clear">
	<a href="#" class="logo"><img src="/wp-content/themes/CommonsRetheme/img/SA-logox200.png" class=""></a>
	<h1>Salud America! <br />Advocacy Program</h1>
	<h3>Get involved in reducing latino childhood obesity.</h3>
	<div class="sa-kids-photo"><img src="/wp-content/themes/CommonsRetheme/img/sa-kids-335.png"></div>

</div>
<?php get_sidebar( 'salud-single' ); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">
			<div class="padder">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'sapolicies' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- .padder -->
		</div><!-- #content -->
		<div class="salud-footer">	
			<a href="#"><img src="/wp-content/themes/CommonsRetheme/img/salud-video-still.jpg" class=""></a>
			<p>Salud America! is a RWJF-funded national network dedicated to supporting advocacy for the prevention of Latino childhood obesity. The advocacy platform is the online portal for this effort.</p>
		</div>
	</div><!-- #primary -->
<?php get_footer(); ?>