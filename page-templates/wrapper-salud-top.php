<div class="salud-header clear">
	<a href="#" class="logo"><img src="/wp-content/themes/CommonsRetheme/img/salud_america/SA-logox200.png" class=""></a>
	<h1>Salud America! <br /><span class="salud-tagline">Growing Healthy Change</span></h1>
	<h3 class="screamer saorange">Let's reduce Latino childhood obesity!
        <a href='http://www.facebook.com/pages/SaludToday/160946931268'><img src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/Facebook_Icon.png' style='width:25px; height: 25px; padding-left:330px; vertical-align: middle;' alt='Facebook'></a>
		<a href='http://twitter.com/saludtoday'><img src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/Twitter_Icon.png' style='width:25px; height: 25px; padding-left:0px; vertical-align: middle;' alt='Twitter'></a>
		<a href='http://www.youtube.com/user/SaludToday'><img src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/YouTube_Icon.png' style='width:25px; height: 25px; padding-left:0px; vertical-align: middle;' alt='Youtube'></a>
		<a href='http://www.saludtoday.com/blog/'><img src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/Blog_Icon.png' style='width:25px; height: 25px; padding-left:0px; vertical-align: middle;' alt='Blog'></a>
    </h3>
	<div class="sa-kids-photo"><img src="/wp-content/themes/CommonsRetheme/img/salud_america/sa-kids-335.png"></div>

</div>

<?php 
	if ( is_singular("saresources") ) {
		get_sidebar( 'salud-singlepolicy' ); 
	} elseif ( is_singular("sapolicies") ) {
		get_sidebar( 'salud-singlepolicy' ); 
	} elseif ( is_page('salud-america') ) {
		get_sidebar( 'salud-home' );
	} elseif ( is_page_template( 'page-templates/salud-america.php' ) || is_page_template( 'page-templates/salud-america-eloi.php' ) ) {
		get_sidebar( 'salud-single' );
	} else {
		get_sidebar( 'salud-single' ); 
	}

?>
	<div id="primary" class="site-content">