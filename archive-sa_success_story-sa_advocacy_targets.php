<?php get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>

		<div id="content" role="main">
			<div class="padder">
				<div class="entry-content">
				<?php
					//Which term is this page showing?
					$tax_term = get_term_by( 'slug', $wp_query->query_vars['term'], $wp_query->query_vars['taxonomy'] );
					// print_r($tax_term);

					//Get the page intro content, which is stored as a page with the same slug as the target area.
					$args = array (
						'pagename' => 'salud-america/sapolicies/' . $tax_term->slug,
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
								 <img class="size-full wp-image-16768 no-box" alt="Topic header for <?php echo $tax_term->name ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/img/salud_america/topic_headers/<?php echo $tax_term->slug ?>.jpg" />
							 </header>
						 <?php
							
							the_content(); 
					endwhile; // end of the loop.

					//Get the related dings

				?>

		               </article>
			    <div class="taxonomy-policies">
	               <h3 class="screamer">Success Stories in the Topic <?php echo $tax_term->name ?></h3>
						
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'sa_success_story-short' ); ?>
						<?php comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>
					<?php twentytwelve_content_nav( 'nav-below' ); ?>
				</div>
					
			</div> <!-- .entry-content -->
			</div><!-- .padder -->
		</div><!-- #content -->

<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>