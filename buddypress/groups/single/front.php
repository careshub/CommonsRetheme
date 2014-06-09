<div class="home-page single-group" role="main">

<?php 
	$custom_front_query = cc_get_group_home_page_post();

// The Loop
	while ( $custom_front_query->have_posts() ) :
		$custom_front_query->the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- <h1 class="entry-title"><?php the_title(); ?></h1> -->
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
		</article><!-- #post -->

<?php
		// $meta = get_post_meta( get_the_ID(),'group_home_page_association',false );
		//print_r($meta);
	endwhile;
?>

</div>