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
			<?php if (is_user_logged_in()) { ?>
			    <a class="login_button" href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
			<?php } else { ?>
			    <a class="login_button" id="show_login" href="">Login</a>
			<?php } ?>
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
	    		<h5>Subscribe to our newsletter</h5>
				<a href="http://visitor.r20.constantcontact.com/d.jsp?llr=dikmfnjab&p=oi&m=1109617158403" title="Subscribe to our newsletter" class="button">Sign up now</a>
	    	</div>
		    <a href="http://www.facebook.com/CommunityCommons" class="facebookx60 iconx60 alignleft"></a>
		    <a href="https://twitter.com/communitycommon" class="twitterx60 iconx60 alignleft"></a>
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
<script type="text/javascript">
jQuery(document).ready(function(){
     jQuery('#json_click_handler').click(function(){
          doAjaxRequest();
     });
});
function doAjaxRequest(){
     // here is where the request will happen
     jQuery.ajax({
          url: 'http://commonsdev.local/wp-admin/admin-ajax.php',
          data:{
               'action':'do_ajax',
               'fn':'get_latest_posts',
               'count':10
               },
          dataType: 'JSON',
          success:function(data){
                 // our handler function will go here
                 // this part is very important!
                 // it's what happens with the JSON data 
                 // after it is fetched via AJAX!
                 jQuery('#json_response_box').html(data);
                             },
          error: function(errorThrown){
               alert('error');
               console.log(errorThrown);
          }
           
 
     });
 
}
</script>

</div>
<form id="login" action="login" method="post">
        <h1>Site Login</h1>
        <p class="status"></p>
        <label for="username">Username</label>
        <input id="username" type="text" name="username">
        <label for="password">Password</label>
        <input id="password" type="password" name="password">
        <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Lost your password?</a>
        <input class="submit_button" type="submit" value="Login" name="submit">
        <a class="close" href="">(close)</a>
        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
</form>
</body>
</html>