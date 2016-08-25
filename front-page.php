<?php
/**
 * The template for the magazine-style front page.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<h1 class="screamer spacious clear"><?php echo get_bloginfo( 'description', 'display' );  ?></h1>

			<?php
			// If the user isn't logged in, show them a login form.
			if ( ! is_user_logged_in() ) : ?>

				<div class="content-row clear front-page-login-explainer Grid Grid--guttersXl Grid--full large-Grid--1of3">
					<div class="front-page-login-form  Grid-cell u-1of3">
						<div class="Grid-cell-liner">
							<h3 class="screamer ccgreen">Log in</h3>
							<div class="inset-contents">
								<form name="login-form" id="front-page-login-form" class="standard-form" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
									<label><?php _e( 'Username or email', 'buddypress' ) ?><br />
									<input type="text" name="log" id="front-page-user-login" class="full-width-input input" value="" tabindex="" /></label>

									<label><?php _e( 'Password', 'buddypress' ) ?><br />
									<input type="password" name="pwd" id="front-page-user-pass" class="full-width-input input" value="" tabindex="" /></label>

									<input type="submit" name="wp-submit" id="front-page-wp-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100" /> <!-- &nbsp;&nbsp;&nbsp;&nbsp; <button id="cancel-login">Cancel</button> -->
									<input type="hidden" name="redirect_to" value="<?php echo ( is_ssl() ? 'https://' : 'http://' ) .  $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'] ?>" />
								</form>
								<?php if ( get_option( 'users_can_register' ) ) : ?>
									<hr />
									<p>Or <a href="<?php echo site_url( bp_get_signup_slug() ); ?>" title="Create an account"><strong>Register</strong> for an account</a> and start learning how to make positive change in your community today.</p>
								<?php endif; // registration is allowed check?>
							</div>
						</div>
					</div>
					<div class="Grid-cell u-2of3">
						<div class="Grid-cell-liner">
							<h3 class="screamer ccyellow" >What is Community Commons?</h3>
							<!-- <div class="inset-contents"> -->
								<?php
									echo wp_oembed_get( 'https://vimeo.com/124966922' );
								?>
							<!-- </div> -->
						</div>
					</div>
				</div>

				<h2 class="screamer">Top stories from Community Commons</h2>

			<?php
			endif; ?>

			<?php
			// Let's get the most recent posts, and make sure to include the "welcome" post.
			$latest_posts_args = array(
				'post_type' => 'post',
				'post__not_in' => array( get_cc_welcome_post_id() ),
			);
			$latest_posts = new WP_Query( $latest_posts_args );
			$welcome_post = new WP_Query( array( 'p' => get_cc_welcome_post_id() ) );

			if ( ! empty( $welcome_post->posts ) ) {
				/*
				 * We trim this down because "sticky" posts don't count against the hard total.
				 * Let's keep the first 6, then add our welcome post for #7.
				 */
				$latest_posts->posts = array_slice( $latest_posts->posts, 0, 6 );
				$latest_posts->posts = array_merge( $latest_posts->posts, $welcome_post->posts );
			} else {
				/*
				 * Keep the first 7.
				 */
				$latest_posts->posts = array_slice( $latest_posts->posts, 0, 7 );
			}
			// Since we've modified the posts array, we have to update the number of found posts.
			$latest_posts->post_count = count( $latest_posts->posts );
			// echo '<pre>'; var_dump( count( $latest_posts->posts ) ); var_dump( $latest_posts->post_count ); echo '</pre>';
			?>

			<?php if ( $latest_posts->have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
					// If the post has no thumbnail, we need to do a few things differently.
					$has_thumbnail = has_post_thumbnail() ? true : false;
					// is_home() is true on the blog page, but not on the home page with a static home page.
					// is_front_page() is true on the static home page.
					$is_sticky = is_sticky();
					$is_first_post = ( $latest_posts->current_post == 0 ) ? true : false ;

					// Set post class
					$post_class = 'clear';
					if ( ! $has_thumbnail ) {
						$post_class .= ' no-thumbnail';
					}
					if ( $is_sticky ) {
						$post_class .= ' sticky';
					}
					if ( $is_first_post ) {
						$post_class .= ' first-article';
					} else {
						$post_class .= ' compact';
					}
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
						<?php //if ( is_sticky() && is_home() && ! is_paged() ) : ?>
						<!-- <div class="featured-post">
							<?php // _e( 'Featured post', 'twentytwelve' ); ?>
						</div> -->
						<?php //endif; ?>
						<header class="entry-header<?php if ( $is_first_post ) { echo " clear"; } ?>">
								<?php if ( $has_thumbnail ) :
									$thumbnail_size = $is_first_post ? 'post_thumbnail' : 'feature-large';
									?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
									<?php the_post_thumbnail( $thumbnail_size ); ?>
									</a>
								<?php
								endif;
							?>
							<p class="category-links"><?php echo get_the_category_list( __( '&#8203;', 'twentytwelve' ) ); ?></p>
							<h1 class="entry-title <?php if ( ! $has_thumbnail ) echo 'no-thumbnail'; ?>">
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h1>
						</header><!-- .entry-header -->

						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->

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
					</article><!-- #post -->
				<?php endwhile; ?>

			<?php endif; ?>

			<h4 class="screamer spacious load-more"><a href="/blog">Browse all Commons articles.</a></h4>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>