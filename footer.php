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
		<div class="site-info">
		<div class="alignleft">
			<p>Community Commons is inspired by <a href="http://www.advancingthemovement.org">Advancing the Movement</a>, and is powered by <a href="http://www.i-p3.org">IP3</a>.</p>
			<p>&copy; Community Commons &amp; IP3 | All Rights Reserved.</p>
		</div>
	    <div class="alignright">
		    <a href="http://www.facebook.com/CommunityCommons"><img title="Facebook" alt="Facebook" src="http://www.communitycommons.org/wp-content/themes/ccommons/images/icons/facebook.png"></a>&nbsp;
		    <a href="https://twitter.com/communitycommon"><img title="Twitter" alt="Twitter" src="http://www.communitycommons.org/wp-content/themes/ccommons/images/icons/twitter.png"></a>
		</div>        
		</div><!-- .site-info -->
	</div> <!-- .page width -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>