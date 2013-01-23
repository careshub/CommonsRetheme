<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	
</div><!-- #page -->

<footer id="colophon" role="contentinfo">
	<div class="page-width">
			
		<div class="site-info">
		<div class="alignleft">
			<?php //Add footer navigation menu 
				$args = array(
					'theme_location' => 'footer-nav',
					//'menu'            => '', 
					//'container'       => 'div', 
					'container_class' => 'footer-nav', 
					//'container_id'    => '',
					//'menu_class' 	=> 'footer-nav',
					//'menu_id'         => 'menu-{menu slug}[-{increment}]',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					//'items_wrap'      => '%3$s',
					'depth'           => 0,
					'walker'          => ''
					);
				wp_nav_menu( $args );
				?>
			<p>Community Commons is inspired by <a href="http://www.advancingthemovement.org">Advancing the Movement</a>, and is powered by <a href="http://www.i-p3.org">IP3</a>.</p>
			<p>&copy; Community Commons &amp; IP3 | All Rights Reserved.</p>
			<p>Read our <a href="/terms-of-service">Terms of Service.</a></p>
		</div>
	    <div class="alignright">
	    	<div>
				<form id="cc-footer-search" method="get" action="<?php echo home_url('/'); ?>">
				<h5>Search this site</h5>
				<input id="cc-footer-search-text" class="cc-footer-input" type="text" maxlength="150" value="" name="s">
				<input class="cc-footer-search-button" type="submit" value="Search">
				</form>
			</div>
	    	<div>
	    		<form id="newsletter-opt-in" method="get" action="">
	    		<h5>Subscribe to our newsletter</h5>
				<input id="newsletter-opt-in-text" class="" type="text" maxlength="150" value="" name="s">
				<input class="newsletter-opt-in-button" type="submit" value="Submit">
				</form>
	    	</div>
		    <a href="http://www.facebook.com/CommunityCommons"><img title="Facebook" alt="Facebook" src="<?php echo get_stylesheet_directory_uri(); ?>/img/facebookx60.png"></a>&nbsp;
		    <a href="https://twitter.com/communitycommon"><img title="Twitter" alt="Twitter" src="<?php echo get_stylesheet_directory_uri(); ?>/img/twitterx60.png"></a>
		</div>        
		</div><!-- .site-info -->
	</div> <!-- .page width -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>