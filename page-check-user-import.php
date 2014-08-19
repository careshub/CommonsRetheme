<?php

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php //comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			<pre>
	<?php
	
	check_users_before_import();
	function check_users_before_import() {

		if ( ( $handle = fopen(get_stylesheet_directory_uri() . '/working/check-user-import.csv', "r") ) !== FALSE ) {

		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

		    	$user_login = $data[0];
		    	$user_email = $data[2];

		        echo 'email: '. $user_email . '<br />';

		        echo 'email is unique? ';
		        if ( $email_is_used = get_user_by( 'email', $user_email ) ) {
		        	echo "NOT AVAILABLE";
		        } else {
		        	echo "Available";
		        }
		        echo '<br />';

		        echo 'username is unique? ';
		        if ( $username_is_used = get_user_by( 'login', $user_login ) ) {
		        	echo "NOT AVAILABLE";
		        } else {
		        	echo "Available";
		        } 
		        echo '<br />';

				echo PHP_EOL;

			} // end while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

			fclose($handle);
	    }
	}

	?>
			</pre>
		</div>
	</div>

<?php get_footer(); ?>