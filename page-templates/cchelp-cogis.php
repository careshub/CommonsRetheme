<?php
/**
 Template Name: CC Help - COGIS
 
 */


 
 
get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php 
			
			cchelp_cogis(); 
			
			while ( have_posts() ) : the_post(); ?>
				<?php //get_template_part( 'content', 'page' ); ?>
			
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); 

function cchelp_cogis() {


	$args = array( 
		'post_type' => 'cchelp', 
		'category_name' => 'ccgroup-association-54'
		);
	$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
	?>
			<div class="entry-content">
			<header class="entry-header clear">
				<h4 class="entry-title"><?php the_title(); ?></h4>
				
				<?php the_content(); ?>
			</header>
			</div>
	
<?php
		endwhile;
	


}