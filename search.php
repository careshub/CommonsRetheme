<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">


		<?php 
		// The main loop returns results of the types:
		// posts, pages, group stories, 

		if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title"><span>Search results for: </span><?php echo get_search_query(); ?></h1>
			</header>

			<div class="search-container">
				<?php get_search_form(); ?>
			</div>

			<hr>

			<?php twentytwelve_content_nav( 'nav-above' ); ?>

			<?php /* Start the Loop */ 
			while ( have_posts() ) : the_post();
				// get_template_part( 'content', get_post_type() );
				// Let's forego template parts in favor of simplicity.
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear' ); ?>>
				<header class="entry-header clear">
					<h1 class="entry-title">
						<?php cc_post_type_flag();?><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h1>
				</header>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
				<footer class="entry-meta">
					<?php twentytwelve_entry_meta(); ?>
				</footer><!-- .entry-meta -->
			</article>
			<?php
			endwhile; 
			?>

			<?php twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="archive-header">
					<h1 class="archive-title"><?php _e( 'No Content Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but no content matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>



		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar( 'site-search' ); ?>
<?php get_footer(); ?>