 <?php
/**
 * The template for the new front page.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main" class="content-container">
			<h2 class="screamer spacious clear">We believe that a nation full of healthy, thriving communities is closer than you think—and to get there, we’ll need to work and learn together.</h2>

			<section id="feature-stories" class="clear">
				<header>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/front-1.jpg" class="fitwidth wp-post-image">
					<div class="banner-text">
						<h3 class="text-shadow-dark">Get Inspired</h3>
						<p class="section-intro-inset">Learn how others are working to create healthy and sustainable communities around the nation and the world with by viewing and interacting with our <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">feature stories</a>.</p>
					</div>
				</header>
				<p class="section-intro-outset">Learn how others are creating healthy, sustainable communities via our <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">feature stories</a>.</p>
				<div class="row clear">
					<?php 
					$sticky = get_option( 'sticky_posts' );
					$args = array(
					 	'post__in' => $sticky,
						'ignore_sticky_posts' => 1,
					 	'posts_per_page' => 3
					 	);
					$stories = new WP_QUERY( $args );
					if ( $stories->have_posts() ) : 
						while ( $stories->have_posts() ) : $stories->the_post();
						$categories_list = get_the_category_list( __( ' ', 'twentytwelve' ) );
						$cat_flag = '';
						$title = $cat_flag . ' ' . get_the_title();
						if ( $categories_list ) {
						    $cat_flag .= '<div class="entry-meta"><span class="category-links">'. $categories_list . '</span></div>';
						  }
						?>
						<div class="third-block compact">
							<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<?php echo $cat_flag; ?>
							<?php the_excerpt(); ?>
						</div>
						<?php 
						endwhile; 
					endif; 
					?>
				</div>
			</section>

			<section id="maps-data" class="clear">
				<header>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/explore-maps.png" class="fitwidth wp-post-image">
					<div class="banner-text">
						<h3 class="text-shadow-dark">Explore</h3>
						<p class="section-intro-inset">Dig deeper to explore and visualize the unique realities of your own community using our <a href="">data, maps, reports and tools</a>.</p>
					</div>
				</header>
				<p class="section-intro-outset">Visualize the unique realities of your own community using our <a href="">data, maps, reports and tools</a>.</p>
				<div class="row clear">
					<?php 
				    $data_args =  array( 
						'post_type' => 'data_vis_tool',
						// 'posts_per_page' => $max_number_of_featured,
						'data_vis_tool_categories' => $category,
						'meta_query' => array(
							array(
								'key' => 'ccdvt_check_featured',
								'value' => 'on',
								'compare' => '=',
								)
							)
						);

					$ccdtv_featured_tool = new WP_Query( $data_args );
					if ( $ccdtv_featured_tool->have_posts() ) :
						while ( $ccdtv_featured_tool->have_posts() ) : $ccdtv_featured_tool->the_post();
						$dv_id = get_the_ID();
						$tool_link = get_post_meta( $dv_id, 'ccdvt_link', true);
						$tool_type = get_post_meta( $dv_id, 'ccdvt_tool_type', true);
						?>
						<div class="third-block compact">
							<h4 class="entry-title"><span class="<?php echo $tool_type . 'x24'; ?> icon"></span>
							<a href="<?php echo $tool_link; ?>" title="Link to the map tool" rel="bookmark"><?php the_title(); ?></a></h4>
							<?php the_excerpt(); ?>
						</div>
						<?php 
						endwhile; 
					endif; 
					?>
				</div>
			</section>

			<section id="connect" class="clear">
				<header>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/explore-maps.png" class="fitwidth wp-post-image">
					<div class="banner-text">
						<h3 class="text-shadow-dark">Connect</h3>
						<p class="section-intro-inset">Share your work, your questions and your successes with others in a <a href="">Hub</a>.</p>
					</div>
				</header>
				<p class="section-intro-outset">Share your work, your questions and your successes with others in a <a href="">Hub</a>.</p>
				<div class="row clear">
					<?php
					// We're going to grab some featured groups
					$group_args = array( 'max' => 3, );
					$group_args['meta_query'][] = array(
		           		/* this is the meta_key you want to filter on */
		                'key'     => 'cc_group_is_featured',
		                /* You need to get all values that are = to the id selected */
		                'value'   => 1,
		                'type'    => 'numeric',
		                'compare' => '='
		            );
					if ( bp_has_groups( $group_args ) ) :
							while ( bp_groups() ) : bp_the_group();						
						?>
						<div class="third-block compact">
							<h4 class="entry-title clear"><a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=thumb&width=50&height=50' ); ?> <?php bp_group_name(); ?></a></h4>
							<?php bp_group_description_excerpt(); ?>
						</div>
						<?php 
						endwhile; 
					endif; 
					?>
				</div>
			</section>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>