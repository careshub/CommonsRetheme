<div class="home-page single-group" role="main">

<?php 	//print_r($GLOBALS['custom-group-front']);
		// global $custom_front_query;
		// var_dump(defined($custom_front_query));

		//TODO don't duplicate this query.
		// $group_id = bp_get_group_id();
		// $args =  array(
		//     'post_type'   => 'group_home_page',
		// 	'posts_per_page' => '1',
		// 	'meta_query'  => array(
		//                        array(
		//                         'key'           => 'group_home_page_association',
		//                         'value'         => $group_id,
		//                         'compare'       => '=',
		//                         'type'          => 'NUMERIC'
		//                         )
		//                     )
		// ); 
		// print_r($args);
		// The Query
		//$custom_front_query = new WP_Query( $args );

	$custom_front_query = $GLOBALS['custom-group-front'] ? $GLOBALS['custom-group-front'] : '';

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