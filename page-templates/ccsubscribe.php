<?php
/**
 Template Name: Subscription Matrix 
*/
get_header(); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php                         
				cc_subscribe_matrix();                        
				while ( have_posts() ) : the_post(); ?>
			<?php                              
				//get_template_part( 'content', 'page' ); ?>				
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); 

function cc_subscribe_matrix() {
?>
	<div style="font-weight:bold;font-size:16pt;margin-bottom:20px;">Subscriptions</div>
	<div style="width:900px;height:600px;border:solid 2px #bcbcbc;background-color:#f0f0f0;">
		<div style="position:relative;top:300px;right:-400px;">Image of Matrix Here</div>
	</div>
	<div style="width:900px;margin-top:12px;">
		<div style="float:left;">
			<a href="#">See detailed subscription matrix</a>
		</div>
		<div style="float:right;">
			<?php		
			if ( is_user_logged_in() ) {
				echo '<a href="/subscribeform/" class="button">Sign Up</a>';
			} else {
				echo '<a href="/register/" class="button">Register</a>&nbsp;<a href="/wp-login.php" class="button">Log In</a>';
			}		
			?>		
			<input type="button" value="Request Quote" />
			<input type="button" value="Request Quote" />
		
		</div>
	</div>
	

<?php	
}