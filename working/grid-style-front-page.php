			if ( $latest_posts->have_posts() ):
				?>
				<h2 class="screamer">Top stories from Community Commons</h2>
				<div class="post-grid-container content-row clear">
				<?php
				$opened_second_grid = false;
				while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
					// Make the first full-width, all others half-width
					if ( 0 == $latest_posts->current_post ) {
						$featured_image_size = 'post_thumbnail';
						$outer_grid_class = 'Grid Grid--gutters Grid--full';
						$grid_cell_class = 'Grid-cell story top-story';
					} else {
						$featured_image_size = 'feature-front-two-column';
						$outer_grid_class = 'Grid Grid--gutters Grid--full med-Grid--1of2';
						$grid_cell_class = 'Grid-cell story';
					}

					// Start an outer wrapper before the first and second stories.
					// Structure is:
					// <wrapper>top story</wrapper>
					// <wrapper>other stories</wrapper>
					if ( 0 == $latest_posts->current_post || 1 == $latest_posts->current_post ) : ?>
					<div class="<?php echo $outer_grid_class; ?>">
					<?php endif; ?>

						<div class="<?php echo $grid_cell_class; ?>">
							<?php
			                if ( has_post_thumbnail() ) {
			                    $featured_image = get_the_post_thumbnail( null, $featured_image_size );
			                } else {
			                	$featured_image = 'need a fallback';
			                }
							?>
							<header class="entry-header">
								<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark" class="image-permalink"><?php echo $featured_image; ?></a>
								<?php endif; ?>
								<h3 class="entry-title screamer"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
							</header>
							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div>
						</div>
					<?php // Close the wrapper div after the first story and after the last div.
					if ( 0 == $latest_posts->current_post || $latest_posts->post_count - 1 == $latest_posts->current_post  ) : ?>
					</div>
					<?php endif;

				endwhile;
				?>
				</div>
				<?php
			endif;
			?>