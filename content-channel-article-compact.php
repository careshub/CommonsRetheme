<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'compact' ); ?>>
		<?php
		// If the post has no thumbnail, we need to do a few things differently.
		$has_thumbnail = has_post_thumbnail() ? true : false;
		?>
		<?php
			//Don't add the category flag if we're in a category or on the search results
			if ( ! is_category() && ! is_search() ) {
				echo '<span class="category-links visible-1000">' . get_the_category_list( __( '&#8203;', 'twentytwelve' ) ) . '</span>';
			}
			?>
			<?php if ( $has_thumbnail ) : ?>
			   	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
			   	<?php the_post_thumbnail('feature-front-sub'); ?>
			   	</a>
		   <?php endif; ?>
		<h1 class="entry-title <?php if ( ! $has_thumbnail ) { echo 'no-thumbnail'; } ?>">
			<?php // If this is the search results, flag the post type
			?><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php //if ( comments_open() ) : ?>
			<!-- <div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
			</div> --><!-- .comments-link -->
		<?php //endif; // comments_open() ?>

		<div class="entry-content">
			<?php the_excerpt(); ?>
			<?php //the_content( __( 'Read more', 'twentytwelve' ) ); ?>
			<?php // wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
			<footer class="entry-meta">
				<?php twentytwelve_entry_meta(); ?>
				<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
				<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
					<div class="author-info">
						<div class="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 68 ) ); ?>
						</div><!-- .author-avatar -->
						<div class="author-description">
							<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
							<p><?php the_author_meta( 'description' ); ?></p>
							<div class="author-link">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
								</a>
							</div><!-- .author-link	-->
						</div><!-- .author-description -->
					</div><!-- .author-info -->
				<?php endif; ?>
			</footer><!-- .entry-meta -->
		<?php //endif; // is_single ?>
	</article><!-- #post -->