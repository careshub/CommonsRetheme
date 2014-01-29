<?php

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php //comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			<pre>
			Subcribers:
			<ul>
			<?php
			$admin_path = ABSPATH . 'wp-admin/includes/user.php';
			require_once( $admin_path );

			if ( function_exists( 'wp_delete_user' ) ) {
				echo "function exists";
			}

				$args = array(
					'blog_id'      => 1,
					'role'         => 'contributor',
					// 'meta_key'     => '',
					// 'meta_value'   => '',
					// 'meta_compare' => '',
					// 'meta_query'   => array(),
					// 'include'      => array(),
					'exclude'      => array(), //use ids to save a user from deletion
					'orderby'      => 'login',
					// 'order'        => 'ASC',
					// 'offset'       => '',
					// 'search'       => '',
					// 'number'       => '',
					// 'count_total'  => false,
					// 'fields'       => 'all',
					// 'who'          => ''
				 );

			    $blogusers = get_users( $args );
			    foreach ($blogusers as $user) {
			        echo '<li>' . $user->user_email . ' ' . $user->ID ;

			        // $delete = wp_delete_user( $user->ID );

			        print_r($delete);
			        echo '</li>';
			    }
			?>
			</ul>

			</pre>
		</div>
	</div>

<?php get_footer(); ?>