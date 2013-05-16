<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. 

			$args =  array(
						   'post_type'   => 'group_home_page', 
						   'meta_query'  => array(
						                       array(
						                        'key'           => 'group_home_page_association',
						                        'value'         => 3,
						                        'compare'       => 'IN',
						                        'type'          => 'NUMERIC'
						                        )
						                    )
						); 
						// print_r($args);
						// The Query
						$the_query = new WP_Query( $args );

						// The Loop
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
							echo '<li>' . get_the_title() . '</li>';
							$meta = get_post_meta( get_the_ID(),'group_home_page_association', true );
							print_r($meta);
						endwhile;
						?>

						<p> si? </p>

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php if (function_exists('cc_add_constant_contact')) {
				// cc_add_constant_contact(1);
				echo "function_exists!";
			}

	//Check to see if user opted in for e-mails:
	$email_option = get_user_meta( 6, 'newsletter', TRUE );
	// $email_me = ( isset( $email_option[0] ) ) ? 1 : 0 ; 
	// print_r($email_option);

	if ( $email_option == 'agreed' ) {
		echo '<br>This user wants spam';
	} else {
		echo '<br>This user is not interested.';
	}
	

						?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>