<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header();

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$injected_block = false;
//Which term is this page showing?
// $tax_term_id = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term = get_queried_object();
$term_id = ( $term ) ? $term->term_id : 0;
$term_name = ( $term ) ? $term->name : '';
?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( '%s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

			<?php //if ( category_description() ) : // Show an optional category description ?>
<!-- 				<div class="archive-meta"><?php echo category_description(); ?></div>
 -->			<?php //endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				if ( $paged == 1 && ! $injected_block ){
					//This will be the most recent sticky post in this category.
					get_template_part( 'content', get_post_format() );
				// Add an action we can use to inject groups, maps, etc.
					?>
					<div class="content-row clear">
						<?php do_action( 'channel_page_after_featured_story', $term_id, $term_name ); ?>
					</div>
					<div class="content-row clear"> <!-- Begins the article compact list -->
					<?php
					$injected_block = true;
				} else {
					// This is not the featured post, so we should display the compact version
					get_template_part( 'content', 'channel-article-compact' );
				}

			endwhile;
			?>
				</div> <!-- ends article compact list -->
			<?php

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar( 'category-page' ); ?>
<?php get_footer(); ?>