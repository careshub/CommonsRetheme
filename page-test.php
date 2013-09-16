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

<h4>Using WP suggest:</h4>
<script src="http://commonsdev.local/wp-includes/js/jquery/suggest.js" type="text/javascript"></script>
<script type="text/javascript">
        jQuery('#tag_suggest').suggest( "<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=post_tag");
 </script>
<input type="text" id="tag_suggest">

<h4>Using JQ autocomplete:</h4>
<?php 
include_once( ABSPATH . WPINC . '/class-IXR.php' );
include_once( ABSPATH . WPINC . '/class-wp-http-ixr-client.php' );
$client = new WP_HTTP_IXR_CLIENT( 'http://dev.communitycommons.org/xmlrpc.php' );
// $client->debug = true;

$tag_request = $client->query( 'wp.getTerms', array( 0, 'dcavins', 'mando2ba', 'post_tag' ) );
$tags = $client->getResponse();
foreach ($tags as $tag) {
	$tag_var[] = $tag['name'];
}
//convert to a js-friendly array
$js_array = json_encode($tag_var);
?>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> -->

<input type="text" id="tags">

<script>
  jQuery(function() {
    var availableTags = <?php echo $js_array . ";\n"; ?>
    jQuery( "#tags" ).autocomplete({
      source: availableTags
    });
  });
</script>


<?php
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