<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico" type="image/x-icon" />
<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico" type="image/x-icon" />

<?php wp_head(); ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<link rel='stylesheet' id='twentytwelve-ie-css'  href='<?php echo get_template_directory_uri(); ?>/css/ie.css?ver=20121010' type='text/css' media='all' />
<link rel='stylesheet' id='commons_ie_stylesheet-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/style-ie.css?ver=0.32' type='text/css' media='all' />
<![endif]-->
</head>

<body <?php body_class('js'); ?>>

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TJLJ5R"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TJLJ5R');</script>
<!-- End Google Tag Manager -->

	<div id="site-navigation" class="primary-navigation clear" role="navigation">
		<button class="menu-toggler button" id="menu-toggler">Menu</button>
		<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			
			<div class="brand"><a href="/" title="Home" >Community Commons</a></div>
			
			<div class="nav-container">
				<ul class="links">
					
					<?php //wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); 
					$args = array(
						'theme_location'  => 'primary',
						'menu'            => '', 
						'container'       => 'false', 
						'container_class' => '', 
						'container_id'    => '',
						'menu_class' 	  => 'nav-menu',
						'menu_id'         => 'menu-{menu slug}[-{increment}]',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '%3$s',
						'depth'           => 0,
						'walker'          => ''
						);
					wp_nav_menu( $args );

					?>
				</ul> <!-- End .links -->
				
				<ul class="secondary">
					<li id="cc-primary-search" class="expanding-search">
						<div class="" tabindex="-1">
							<form id="cc-navbar-search" method="get" action="<?php echo home_url('/'); ?>">
								<input id="cc-navbar-search-text" class="cc-nav-input searchx18" type="text" maxlength="150" value="" name="s">
								<input class="cc-navbar-search-button" type="submit" value="Search">
							</form>
						</div>
					</li>
					
				<?php if (is_user_logged_in()) { //show user info if logged in ?>
					<li class="menupop clear">
						<a href="<?php echo bp_core_get_userlink( bp_loggedin_user_id(), $no_anchor = false, $just_link = true ); ?>" class="user-home-link" title="My user home">
							<span class="userx21"></span>
						</a>
						<span class="visible-mini">
						<?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?>
						</span>
						<div class="pop-sub-wrapper user-quicklinks">
							<a href="<?php echo bp_loggedin_user_domain(); ?>" title="View my profile" class="avatar">
								<?php bp_loggedin_user_avatar('width=48&height=48'); ?>
							</a>
							<ul>
								<li class="visible-maxi">
									<?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?>
								</li>
								<li>
									<a href="<?php echo bp_loggedin_user_domain() . 'profile'; ?>" title="View my profile"><?php _e( 'View My Profile', 'cctheme' ) ?></a>
								</li>
								<li>
									<a href="<?php echo bp_loggedin_user_domain() . 'groups'; ?>" title="See my groups"><?php _e( 'My Hubs', 'cctheme' ) ?></a>
								</li>
								<li>
									<a href="<?php echo bp_loggedin_user_domain() . 'maps-reports'; ?>" title="See my maps and reports"><?php _e( 'My Maps &amp; Reports', 'cctheme' ) ?></a>
								</li>
								<?php if ( class_exists( 'BP_Docs' )  ): // Only show this if bp-docs is active ?>
								<li>
									<a href="<?php echo bp_loggedin_user_domain() . 'docs'; ?>" title="View my library"><?php _e( 'My Library', 'cctheme' ) ?></a>
								</li>
								<?php endif; // class_exists( 'BP_Docs' ) ?>
								<li>
									<a href="<?php echo wp_logout_url( home_url() ); ?>" title="Log out"><?php _e( 'Log Out', 'buddypress' ) ?></a>
								</li>
							</ul>
						</div>
					</li>
        			<?php //bp_loggedin_user_avatar('width=24&height=24');  
        		} else { //show login and register links if not logged in ?>
	        		<li id="login-item" class="separator clear">
		        		<a class="login-link" href="<?php echo wp_login_url( ( is_ssl() ? 'https://' : 'http://' ) .  $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'] ); ?>" title="Log in"><?php _e( 'Log in', 'buddypress' ) ?></a>
	        			<div class="pop-sub-wrapper">
	        				<form name="login-form" id="sidebar-login-form" class="standard-form" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
								<label><?php _e( 'Username or email', 'buddypress' ) ?><br />
								<input type="text" name="log" id="sidebar-user-login" class="input" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97" /></label>

								<label><?php _e( 'Password', 'buddypress' ) ?><br />
								<input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" tabindex="98" /></label>

								<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" tabindex="99" /> <?php _e( 'Remember Me', 'buddypress' ) ?></label></p>

								<?php do_action( 'bp_sidebar_login_form' ) ?>
								<input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100" /> &nbsp;&nbsp;&nbsp;&nbsp; <button id="cancel-login">Cancel</button>
								<input type="hidden" name="redirect_to" value="<?php echo ( is_ssl() ? 'https://' : 'http://' ) .  $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'] ?>" />
							</form>
	        			</div>
	        		</li>
	        		<li class="separator">
	        			<?php printf( __( '<a href="%s" title="Create an account">Register</a>', 'buddypress' ), site_url( bp_get_signup_slug() ) ) ?>
	        		</li>
        		<?php } ?>
					<?php notifications_counter(); ?>
					<li class="separator">
						<a href="/cchelp/">Support</a>
					</li>
				</ul>
			</div><!-- End nav-container -->
	</div><!-- #site-navigation -->

	<div id="page" class="hfeed site">

		<div id="main" class="wrapper">