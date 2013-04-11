<?php
/**
 * The template used for displaying brief content on the front page.
 *
 * @package WordPress
 * @subpackage Commons_Retheme
 * @since Commons Retheme 1
 */
global $layout_location;

if ( has_post_thumbnail() ) {
 	if ($layout_location == 'primary') {
	   $featured_image = get_the_post_thumbnail( $post->ID, 'feature-front');
	} elseif ($layout_location == 'secondary') {
		$featured_image = get_the_post_thumbnail( $post->ID, 'feature-front-sub');
	}
 }
if ( ($layout_location == 'primary') || ($layout_location == 'secondary') ) { 
?> 
	<header class="entry-header">
		<?php if ($featured_image) { ?>
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark" class="front<?php echo $layout_location ?>"><?php echo $featured_image; ?></a>
		<?php } ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header>
	<div class="entry-content">
		<?php the_excerpt(); ?>
		<?php //if ( is_sticky() ) { ?>
		<!-- <p>This post is sticky.</p> -->
		 <?php //}  ?>

	</div>

<?php } elseif ($layout_location == 'related') { ?>
	<li>
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</li>
<?php
}