<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php if ( ! is_page_template( 'page-templates/front-page.php' ) && ! is_search() ) : ?>
			<?php the_post_thumbnail(); ?>
			<?php endif; ?>
			<?php // If this is the search results, flag the post type
				if ( is_search() ) : ?>
					<h1 class="entry-title"><?php cc_post_type_flag(); ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<?php else : ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php endif; ?>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
