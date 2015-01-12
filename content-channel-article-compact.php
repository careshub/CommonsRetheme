<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
// If the post has no thumbnail, we need to do a few things differently.
$has_thumbnail = has_post_thumbnail() ? true : false;

// Set post class
$post_class = 'compact';
if ( ! $has_thumbnail ) {
	$post_class .= ' no-thumbnail';
}
if ( is_sticky() ) {
	$post_class .= ' sticky';
}
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
		<header class="entry-header">
		<?php if ( $has_thumbnail ) : ?>
		   	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		   	<?php the_post_thumbnail('feature-front-sub'); ?>
		   	</a>
	   	<?php endif; ?>
		   	<h1 class="entry-title <?php if ( ! $has_thumbnail ) { echo 'no-thumbnail'; } ?>">
				<?php // If this is the search results, flag the post type
				?><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><!--<span class="title-ribbon"><span class="mapx24-white icon"></span></span>--><?php the_title(); ?></a>
			</h1>
		</header>

		<div class="entry-content">
			<?php the_excerpt(); ?>
			<?php //the_content( __( 'Read more', 'twentytwelve' ) ); ?>
			<?php // wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php //twentytwelve_entry_meta(); ?>
			<?php //edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->