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
		<div class="alignleft" style="margin-bottom:1em;">
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
			<p>Community Commons is powered by <a href="http://www.i-p3.org">IP3</a> and <a href="http://www.cares.missouri.edu">CARES - University of Missouri</a> .</p>
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
	    		<h5>Subscribe to our newsletter</h5>
				<a href="http://communitycommons.us8.list-manage.com/subscribe?u=38f5aa1692dd8f73ad2f92e28&id=f2849a0057" title="Subscribe to our newsletter" class="button">Sign up now</a>
	    	</div>
		    <a href="http://www.facebook.com/CommunityCommons" class="facebookx60 iconx60 alignleft"></a>
		    <a href="https://twitter.com/communitycommon" class="twitterx60 iconx60 alignleft"></a>
		    <a href="http://www.linkedin.com/company/3194585" class="linkedinx60 iconx60 alignleft"></a>
		    <a href="https://plus.google.com/117982399710195199733" rel="publisher" class="gplusx60 iconx60 alignleft"></a>
		</div>        
		</div><!-- .site-info -->

	</div> <!-- .page width -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>
<script type="text/javascript">
	jQuery(function() {
		 jQuery('a[href^="https://ip3.zendesk.com"]').click(function(e) {
		 	if (typeof Zenbox.show == 'function') { 
	  			Zenbox.show();
	  			//If Zenbox.show isn't defined the link will still work, so only prevent the click if Zenbox.show is defined.
	  			return false;
			}
			});					
		});
</script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery.localScroll();
	});
</script>

</div>
</body>
</html>