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
<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) | !(IE 9) ]><!-->
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
<!--[if lte IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<link rel='stylesheet' id='twentytwelve-ie-css'  href='<?php echo get_template_directory_uri(); ?>/css/ie.css?ver=20121010' type='text/css' media='all' />
<link rel='stylesheet' id='commons_ie_stylesheet-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/style-ie.css?ver=0.32' type='text/css' media='all' />
<![endif]-->
</head>

<body <?php body_class('js'); ?>>

<?php if ( get_site_url( null, '', 'http' ) == 'http://www.communitycommons.org' ) : ?>
	<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TJLJ5R"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TJLJ5R');</script>
	<!-- End Google Tag Manager -->
<?php endif; ?>

	<div id="site-navigation" class="primary-navigation clear" role="navigation">
		<button class="menu-toggler button" id="menu-toggler">Menu</button>
		<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>

			<div class="brand">
				<a href="/" title="Home" >Community Commons</a>
			</div>
			<nav class="nav-container">
				<ul id="menu-primary-nav" class="nav accessible-menu">
					<li id="cc-primary-search" class="expanding-search alignright menu-item menu-item-level-0">
						<a href="#" class="primary-search-toggler"><span class="searchx18"></span><span class="screen-reader-text">Search</span></a>
						<div class="sub-nav">
							<form id="cc-navbar-search" method="get" action="<?php echo home_url('/'); ?>">
								<input id="cc-navbar-search-text" class="cc-nav-input searchx18" type="search" maxlength="150" value="" name="s" placeholder="Search">
								<input class="cc-navbar-search-button" type="submit" value="Search">
							</form>
						</div>
					</li>
					<?php //wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) );
					$args = array(
						'theme_location'  => 'primary',
						'menu'            => '',
						'container'       => 'false',
						// 'container_class' => 'nav-container',
						// 'container_id'    => '',
						'menu_class' 	  => 'nav accessible-menu',
						// 'menu_id'         => 'menu-{menu slug}[-{increment}]',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '%3$s',
						'depth'           => 0,
						'walker'          => new CC_Accessibility_Nav_Walker()
						);
					wp_nav_menu( $args );
					?>
					<!-- <div id="menu-secondary-user-nav" class="secondary">					 -->
						<?php if ( $current_user_id = get_current_user_id() ) { //show user info if logged in ?>
							<li class="user-home-link alignright menu-item menu-item-level-0 menu-item-user menu-item-has-children">
								<a href="<?php echo bp_core_get_userlink( bp_loggedin_user_id(), $no_anchor = false, $just_link = true ); ?>" class="" title="My user profile">
									<!-- <span class="userx21"></span> -->
									<span class="username"><?php bp_loggedin_user_username(); ?></span>
									<?php bp_loggedin_user_avatar('width=32&height=32'); ?>
								</a>
								<?php /* ?>
								<span class="visible-mini">
								<?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?>
								</span>
								<?php */ ?>
								<div class="sub-nav">
									<!-- <a href="<?php echo bp_loggedin_user_domain(); ?>" title="View my profile" class="avatar">
										<?php bp_loggedin_user_avatar('width=48&height=48'); ?>
									</a> -->
									<ul class="sub-nav-group">
										<?php /* ?>
										<li class="visible-maxi">
											<?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?>
										</li>
										<?php */ ?>
										<li class="menu-item">
											<a href="<?php echo bp_loggedin_user_domain() . 'profile'; ?>" title="View my profile"><?php _e( 'View My Profile', 'cctheme' ) ?></a>
										</li>
										<li class="menu-item">
											<a href="<?php echo bp_loggedin_user_domain() . 'groups'; ?>" title="See my groups"><?php _e( 'My Hubs', 'cctheme' ) ?></a>
										</li>
										<?php if ( class_exists( 'BP_Docs' )  ): // Only show this if bp-docs is active ?>
											<li class="menu-item">
												<a href="<?php echo bp_loggedin_user_domain() . 'docs'; ?>" title="View my library"><?php _e( 'My Library', 'cctheme' ) ?></a>
											</li>
										<?php endif; // class_exists( 'BP_Docs' ) ?>
										<li class="menu-item">
											<a href="<?php echo wp_logout_url( home_url() ); ?>" title="Log out"><?php _e( 'Log Out', 'buddypress' ) ?></a>
										</li>
									</ul>
								</div>
							</li>
						<?php notifications_counter(); ?>

		        			<?php //bp_loggedin_user_avatar('width=24&height=24');
		        		} else { //show login and register links if not logged in ?>
			        		<li id="login-item" class="alignright menu-item menu-item-object-page page_item menu-item-level-0 menu-item-has-children menu-item-login">
				        		<a class="login-link" href="<?php echo wp_login_url( ( is_ssl() ? 'https://' : 'http://' ) .  $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'] ); ?>" title="Log in"><?php _e( 'Log in', 'buddypress' ) ?></a>
			        			<div class="sub-nav menu-item-login-panel">
			        				<form name="login-form" id="sidebar-login-form" class="standard-form" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
										<label><?php _e( 'Username or email', 'buddypress' ) ?><br />
										<input type="text" name="log" id="sidebar-user-login" class="input" value="" tabindex="97" /></label>

										<label class="login-form-password-label"><?php _e( 'Password', 'buddypress' ) ?><br />
										<input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" tabindex="98" /></label>

										<?php /* ?>
										<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" tabindex="99" /> <?php _e( 'Remember Me', 'buddypress' ) ?></label></p>
										<?php */ ?>

										<?php do_action( 'bp_sidebar_login_form' ) ?>
										<input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100" /> <!-- &nbsp;&nbsp;&nbsp;&nbsp; <button id="cancel-login">Cancel</button> -->
										<input type="hidden" name="redirect_to" value="<?php echo ( is_ssl() ? 'https://' : 'http://' ) .  $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'] ?>" />
									</form>
									<a href="<?php echo wp_lostpassword_url( ( is_ssl() ? 'https://' : 'http://' ) .  $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'] ); ?>" class="forgot-password">Forgot your password or username?</a>
									<?php do_action( 'cares_after_login_form' ); ?>
			        			</div>
			        		</li>
			        		<?php if ( get_option( 'users_can_register' ) ) : ?>
				        		<li class="alignright menu-item menu-item-object-page page_item menu-item-level-0 menu-item-register<?php if ( bp_is_register_page() ){ echo " current-menu-item  current_page_item"; } ?>">
				        			<?php printf( __( '<a href="%s" title="Create an account">Register</a>', 'buddypress' ), site_url( bp_get_signup_slug() ) ) ?>
				        		</li>
				        	<?php endif; // registration is allowed check?>
		        		<?php } ?>

						<?php // Use this nav for "Support" and similar
						$args = array(
							'theme_location'  => 'main-nav-secondary',
							'menu'            => '',
							'container'       => 'false',
							// 'container_class' => 'nav-container',
							// 'container_id'    => '',
							'menu_class' 	  => 'nav accessible-menu',
							// 'menu_id'         => 'menu-{menu slug}[-{increment}]',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '%3$s',
							'depth'           => 0,
							'walker'          => new CC_Accessibility_Nav_Walker()
							);
						wp_nav_menu( $args );
						?>
					<!-- </div> -->
				</ul>
			</nav><!-- End nav-container -->
			<div class="clear"></div>
		</div><!-- #site-navigation -->

	<div id="page" class="hfeed site">

		<div id="main" class="wrapper">