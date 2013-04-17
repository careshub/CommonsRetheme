<?php
/**
 * Template Name: Logged-in Users Only
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<!-- If the user is logged in, display the content -->
			<?php if ( function_exists('is_user_logged_in') && is_user_logged_in() ) { ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
					<?php comments_template( '', true ); ?>
				<?php endwhile; // end of the loop. ?>

			<?php } else { ?>

				<!-- If the user isn't logged in, show a login form -->
				<?php if ( function_exists('bp_get_signup_allowed') && bp_get_signup_allowed() ) : ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<div id="BP-login-form" class="border-bottom-palette-6"><!--begin BuddyPress signup form -->

					    	<p>This page is only accessible to registered members of Community Commons. If you are not yet a member, registration takes just a minute. It's worth it&mdash;you'll be able to make GIS maps, participate in forums and more!</p>

							<form name="login-form" id="sidebar-login-form" class="standard-form" action="<?php echo site_url( 'wp-login.php', 'login_post' ) ?>" method="post">
								<label><?php _e( 'Username', 'buddypress' ) ?><br />
								<input type="text" name="log" id="sidebar-user-login" class="input" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97" /></label>

								<label><?php _e( 'Password', 'buddypress' ) ?><br />
								<input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" tabindex="98" /></label>

								<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" tabindex="99" /> <?php _e( 'Remember Me', 'buddypress' ) ?></label></p>

								<?php do_action( 'bp_sidebar_login_form' ) ?>
								<input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100" /> &nbsp;&nbsp;or&nbsp;&nbsp; <?php printf( __( '<a href="%s" title="Create an account" class="button">Register</a>', 'buddypress' ), site_url( bp_get_signup_slug() . '/' ) ) ?>
								<input type="hidden" name="testcookie" value="1" />
							</form>

							<?php do_action( 'bp_after_sidebar_login_form' ) ?>
						</div><!--end BuddyPress signup form -->
					</div> <!-- End .entry-content -->
				</article>
			  <?php endif; ?>				

			<?php } // end logged-in check ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>