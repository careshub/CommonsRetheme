<?php get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); 

//Which term is this page showing? Is it showing a term?
if ( isset( $wp_query->query_vars['term'] ) ) {
	$tax_term = get_term_by( 'slug', $wp_query->query_vars['term'], $wp_query->query_vars['taxonomy'] );
}
// Should we display the video archive?
$archive_style = ( isset( $_GET['style'] ) && $_GET['style'] == 'videos'  ) ? 'videos' : '';
?>

	<div id="content" role="main">
		<div class="padder">
			<div class="entry-content">
				<?php 
				if ( $archive_style == 'videos') {
					?>
					<h3 class="screamer sablue">Salud Heroes Video Archive</h3>
					<?php

					while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'sa_success_story-videos' ); ?>
					<?php endwhile; // end of the loop. ?>
					
					<?php twentytwelve_content_nav( 'nav-below' );

				} else {
					// First section of following if statement is used if this page is an advocacy target taxonomy page. Standard archives are rendered using the else section. 
					if ( !empty( $tax_term ) && $tax_term->taxonomy == 'sa_advocacy_targets' ) {

						//Get the page intro content, which is stored as a page with the same slug as the target area.
						$args = array (
							'pagename' => 'salud-america/sa-advocacy-targets-intros/' . $tax_term->slug,
							'post_type' => 'page'
							);
						// print_r($wp_query->query_vars);
						$page_intro = new WP_Query( $args );
						// print_r($page_intro);
						while ( $page_intro->have_posts() ) : $page_intro->the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('advocacy_target_introduction'); ?>>
								<?php 
								//Get the page header image ?>
								<header>
									 <img class="size-full no-box" alt="Topic header for <?php echo $tax_term->name ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/img/salud_america/topic_headers/<?php echo $tax_term->slug ?>.jpg" />
								 </header>
							 <?php
								
								the_content(); 
								?>
							</article>
						<?php
						endwhile; // end of the loop.
						?>

				    <div class="taxonomy-policies">
		               <h3 class="screamer saorange">Salud Heroes in the Topic <?php echo $tax_term->name ?></h3>
							
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'sa_success_story-short' ); ?>
							<?php comments_template( '', true ); ?>
						<?php endwhile; // end of the loop. ?>
						<?php twentytwelve_content_nav( 'nav-below' ); ?>
					</div>
					
				<?php } else { // not an advocacy target archive, this is the 6-up overview page ?>

					<h3 class="screamer sablue">Salud Heroes</h3>
						<?php
						//Get the page intro content.
						$args = array (
							'pagename' => 'salud-america/success-stories-intro/',
							'post_type' => 'page'
							);
						$page_intro = new WP_Query( $args );

						while ( $page_intro->have_posts() ) : $page_intro->the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clear'); ?>>
								<?php sa_get_random_hero_video() ?>
								<?php the_content(); ?>
								<!-- <header>
									 <img class="size-full wp-image-16768 no-box" alt="Topic header for <?php echo $tax_term->name ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/img/salud_america/topic_headers/<?php echo $tax_term->slug ?>.jpg" />
								 </header> -->
			                </article>

							<?php
						endwhile; // end of the loop.
						wp_reset_postdata();

						//Loop to display the most recent changemaker featured image for each target area.
						$advocacy_targets = get_terms('sa_advocacy_targets');

						$do_not_duplicate = array();
						foreach ( $advocacy_targets as $target ) {
							//Build the query
							$args = array (
								'post_type' => 'sa_success_story',
								'posts_per_page' => 1,
								'post__not_in' => $do_not_duplicate,
								'tax_query' => array(
									array(
										'taxonomy' => 'sa_advocacy_targets',
										'field' => 'slug',
										'terms' => array( $target->slug )
									),
								)
								);

							$ssquery = new WP_Query( $args );
							while ( $ssquery->have_posts() ) {
								$ssquery->the_post();
								global $post;
								setup_postdata( $post );
								?>
								<div class="half-block salud-topic <?php echo $target->slug; ?>">
									<a href="<?php cc_the_cpt_tax_intersection_link( 'sa_success_story', 'sa_advocacy_targets', $target->slug );?>" class="topic-header-link" title="Link to taxonomy page.">
										<span class="<?php echo $target->slug; ?>x60"></span>
										<h4 class="icon-friendly" style="width:65%; margin-top:0; line-height:1.2;"><?php echo $target->name ?></h4>
									</a>
									<?php
			                        get_template_part( 'content', 'saresources-mini');
			                        ?><a href="<?php echo cc_get_the_cpt_tax_intersection_link( 'sa_success_story', 'sa_advocacy_targets', $target->slug );?>" title="Link to taxonomy page." class="button">More stories on this topic...</a>
			                    </div> <!-- .half-block -->
			                    <?php
								$do_not_duplicate[] = get_the_ID();
							}
							wp_reset_postdata();

						} //End foreach advocacy target
				 } // END non-advocacy target version
			} //END check for $archive_style 
		?>
			</div> <!-- .entry-content -->
		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>