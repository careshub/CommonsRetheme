<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. 

			$args =  array(
						   'post_type'   => 'group_home_page', 
						   'meta_query'  => array(
						                       array(
						                        'key'           => 'group_home_page_association',
						                        'value'         => 3,
						                        'compare'       => 'IN',
						                        'type'          => 'NUMERIC'
						                        )
						                    )
						); 
						// print_r($args);
						// The Query
						$the_query = new WP_Query( $args );

						// The Loop
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
							echo '<li>' . get_the_title() . '</li>';
							$meta = get_post_meta( get_the_ID(),'group_home_page_association', true );
							print_r($meta);
						endwhile;
						?>

<!-- 						<p> si? </p>
 -->
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php 
// include_once( ABSPATH . WPINC . '/class-IXR.php' );
// include_once( ABSPATH . WPINC . '/class-wp-http-ixr-client.php' );
// $client = new WP_HTTP_IXR_CLIENT( 'http://dev.communitycommons.org/xmlrpc.php' );
// $client->debug = true;

// $addition = $client->query( 'demo.addTwoNumbers', array( 55, 17 ) );
//report 32
//map 63
// $hello = $client->query( 'cc.record_map_activity', array(
// 	'username' => "dcavins", 
// 	'password' => "mando2ba", 
// 	// 'actor_id' => 2, 
// 	'activity_type' => "map_created",
// 	'item_id' => 63,
// 	// 'sharing' => '17,26',
// 	// 'title' => $title,
// 	// 'description' => $description,
// 	) 
// );

// cc_maps_reports_delete_activity( 63, "map_created");
// $hello = $client->query( 'cc.record_map_activity', array(
// 	'username' => "admin", 
// 	'password' => "admin", 
// 	'actor_id' => 2, 
// 	'activity_type' => "created_map",
// 	'id' => 176,
// 	'sharing' => 'public'
// 	) 
// );

// global $bp;
// echo "<pre>";
// print_r($bp);
// echo "</pre>";

	// Get 50 custom post types pages, set the number higher if is not slow.

$mycustomposts = get_posts( array( 'post_type' => 'sapolicies', 'number' => 250) );
   foreach( $mycustomposts as $mypost ) {
     // Delete's each post.
     wp_delete_post( $mypost->ID, true);
    // Set to False if you want to send them to Trash.
   }
// 50 custom post types are being deleted everytime you refresh the page.

// 						$taxonomy = 'geographies';

// $terms = get_terms($taxonomy);
//  $count = count($terms);
//  if ( $count > 0 ){

//      foreach ( $terms as $term ) {
//         wp_delete_term( $term->term_id, $taxonomy );
//      }
//  }

						?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>