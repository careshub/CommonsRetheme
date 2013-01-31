<?php

// Customize WP Toolbar
function change_toolbar() {  
	if (! is_admin() ) {
	global $wp_admin_bar;
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('new-content');
	$wp_admin_bar->add_node( array(
		'id' => 'groups_link',
		'title' => 'Groups',
		'href' => '/groups/',
		'meta' => array('class' => 'toolbar_page_links')
		)
	);
	$wp_admin_bar->add_node( array(
		'id' => 'stories_link',
		'title' => 'Stories',
		'href' => '/blog/',
		'meta' => array('class' => 'toolbar_page_links')
		)
	);
	$wp_admin_bar->add_node( array(
		'id' => 'data_vis_link',
		'title' => 'Data Vis',
		'href' => '/mapping/',
		'meta' => array('class' => 'toolbar_page_links')
		)
	);
	$wp_admin_bar->add_node( array(
		'id' => 'members_link',
		'title' => 'Members',
		'href' => '/members/',
		'meta' => array('class' => 'toolbar_page_links')
		)
	);
	

	}
}

//add_action('wp_before_admin_bar_render', 'change_toolbar');



function custom_childtheme_stylesheet_load(){
wp_register_style(
        'custom_childtheme_stylesheet',
        get_stylesheet_directory_uri() . '/style.css',
        false,
        0.2
    );
wp_enqueue_style( 'custom_childtheme_stylesheet' );
}
//No longer required
//add_action( 'wp_print_styles', 'custom_childtheme_stylesheet_load' );


function notifications_counter() {
	if (function_exists(bp_is_active)) {
	global $bp;

	//Do nothing if the user isn't logged in
	if ( !is_user_logged_in() )
		return ;

	$notifications = bp_core_get_notifications_for_user( bp_loggedin_user_id());
	$count = !empty( $notifications ) ? count( $notifications ) : 0;
	$alert_class = (int) $count > 0 ? 'pending-count alert' : 'count no-alert';
	$user = bp_loggedin_user_id();
	$output = '<li class="menupop bp-notifications">' 
			. '<span class="';
	$output .= $alert_class;
	$output .= '">' . $count . '</span>';
	$output .= print_list($notifications,$count);
	$output .='</li>';

	echo $output;
	}

}

function print_list($notifications,$count){
    $output = '<div class="pop-sub-wrapper"><ul class="bp-notification-list">';
        
	if ( $count !== 0 ) {
		$counter = 0;
		for ( $i = 0; $i < $count; $i++ ) {
		$alt = ( 0 == $counter % 2 ) ? ' class="alt"' : '';

		$output .= '<li' . $alt . '>' . $notifications[$i] .'</li>';

		$counter++;
		}
	} else {

	$output .= '<li>You don&rsquo;t have any new notifications.</li>';

	}

	$output .= '</ul></div>';
	return $output;
}

/**
 * Register widgetized area and update sidebar with default widgets
 */
 
function ccommons_widgets_init() {
    
// register_sidebar( array (
//         'name' => __( 'footer-nav', 'ccommons' ),
//         'id' => 'footer-nav',
//         'before_widget' => '<nav id="%1$s" class="widget %2$s">',
//         'after_widget' => "</nav>",
//         'before_title' => '<h3 class="widget-title">',
//         'after_title' => '</h3>',
//         'description' => __( 'Footer Navigation Links', 'ccommons' )
//     ) );

register_sidebar( array (
        'name' => __( 'Groups sidebar', 'ccommons' ),
        'id' => 'groups-sidebar',
        'before_widget' => '<nav id="%1$s" class="widget %2$s">',
        'after_widget' => "</nav>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'description' => __( 'Group page sub nav sidebar', 'ccommons' )
    ) );

register_sidebar( array (
        'name' => __( 'Single group sidebar', 'ccommons' ),
        'id' => 'groups-single-sidebar',
        'before_widget' => '<nav id="%1$s" class="widget %2$s">',
        'after_widget' => "</nav>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'description' => __( 'Single group page sub nav sidebar', 'ccommons' )
    ) );

register_sidebar( array (
        'name' => __( 'Members sidebar', 'ccommons' ),
        'id' => 'members-sidebar',
        'before_widget' => '<nav id="%1$s" class="widget %2$s">',
        'after_widget' => "</nav>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'description' => __( 'Members page sub nav sidebar', 'ccommons' )
    ) );

register_sidebar( array (
        'name' => __( 'Single Member sidebar', 'ccommons' ),
        'id' => 'members-single-sidebar',
        'before_widget' => '<nav id="%1$s" class="widget %2$s">',
        'after_widget' => "</nav>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'description' => __( 'Individual member page sub nav sidebar', 'ccommons' )
    ) );
      
}
add_action( 'init', 'ccommons_widgets_init' );

if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'footer-nav', 'Footer Navigation' );
}

/* Filters Nav Menu output by adding 'menu-item-{page slug}' to menu li classes
***********/
function add_slug_class_to_menu_item($output){
	$ps = get_option('permalink_structure');
	if(!empty($ps)){
		$idstr = preg_match_all('/<li id="menu-item-(\d+)/', $output, $matches);
		foreach($matches[1] as $mid){
			$id = get_post_meta($mid, '_menu_item_object_id', true);
			$slug = basename(get_permalink($id));
			$output = preg_replace('/menu-item-'.$mid.'">/', 'menu-item-'.$mid.' menu-item-'.$slug.'">', $output, 1);
		}
	}
	return $output;
}
add_filter('wp_nav_menu', 'add_slug_class_to_menu_item');

/* Filter classes added to body tag to add "buddypress" if BuddyPress is active
***************/
function add_buddypress_to_body_tag_classes($classes) {
	// add 'class-name' to the $classes array
	if ( function_exists( 'bp_is_blog_page' ) ) {	
		if ( !bp_is_blog_page() ) {
			$classes[] = 'buddypress';
		}
	}
	// return the $classes array
	return $classes;
}
add_filter('body_class','add_buddypress_to_body_tag_classes');


/*Remove Gravatars for testing on localhost
*/
function bp_remove_gravatar ($image, $params, $item_id, $avatar_dir, $css_id, $html_width, $html_height, $avatar_folder_url, $avatar_folder_dir) {
    //$default = get_stylesheet_directory_uri() .'/_inc/images/bp_default_avatar.jpg';
    $default = '/wp-content/plugins/buddypress/bp-core/images/mystery-man.jpg';

    if( $image && strpos( $image, "gravatar.com" ) ){
        return '<img src="' . $default . '" alt="avatar" class="avatar" ' . $html_width . $html_height . ' />';
    } else {
        return $image;
    }
}
add_filter('bp_core_fetch_avatar', 'bp_remove_gravatar', 1, 9 );
function remove_gravatar ($avatar, $id_or_email, $size, $default, $alt) {
	//$default = get_stylesheet_directory_uri() .'/_inc/images/bp_default_avatar.jpg';
    $default = '/wp-content/plugins/buddypress/bp-core/images/mystery-man.jpg';
    return "<img alt='{$alt}' src='{$default}' class='avatar avatar-{$size} photo avatar-default' height='{$size}' width='{$size}' />";
}
add_filter('get_avatar', 'remove_gravatar', 1, 5);
function bp_remove_signup_gravatar ($image) {
	//$default = get_stylesheet_directory_uri() .'/_inc/images/bp_default_avatar.jpg';
    $default = '/wp-content/plugins/buddypress/bp-core/images/mystery-man.jpg';
    if( $image && strpos( $image, "gravatar.com" ) ){
        return '<img src="' . $default . '" alt="avatar" class="avatar" width="150" height="150" />';
    } else {
        return $image;
    }
}
add_filter('bp_get_signup_avatar', 'bp_remove_signup_gravatar', 1, 1 );

/* Login window changes - adding CC logo and link 
***************/
function cc_custom_login_logo() {
    echo "
    <style>
    body.login #login h1 a {
        background: url('".get_stylesheet_directory_uri()."/img/ccommons-logo-login.png') no-repeat scroll center top transparent !important;
        height: 90px;
        width: 323px;
    }
    </style>
    ";
}
add_action('login_head', 'cc_custom_login_logo');

function change_wp_login_url() {
    return get_bloginfo('url');  // OR ECHO YOUR OWN URL
}
function change_wp_login_title() {
    return get_option('blogname'); // OR ECHO YOUR OWN ALT TEXT
}
add_filter('login_headerurl', 'change_wp_login_url');
add_filter('login_headertitle', 'change_wp_login_title');

/* Javascript library enqueues
**************/
function localscroll_js_load(){

wp_register_script('scrollTo', get_stylesheet_directory_uri().'/js/jquery.scrollTo-1.4.2-min.js">', array('jquery'), '1.4.2' ); 
wp_enqueue_script('scrollTo'); 
wp_register_script('localScroll', get_stylesheet_directory_uri().'/js/jquery.localscroll-1.2.7-min.js">', array('jquery', 'scrollTo'), '1.2.7' );  
wp_enqueue_script('localScroll'); 

}
add_action('wp_enqueue_scripts', 'localscroll_js_load');

function sharrre_js_load(){

wp_register_script('sharrre', get_stylesheet_directory_uri().'/js/jquery.sharrre-1.3.4.min.js">', array('jquery'), '1.3.4' ); 
wp_enqueue_script('sharrre'); 


}
add_action('wp_enqueue_scripts', 'sharrre_js_load');

/* SEARCH - replaces standard WordPress search with a unified results page
*************/

//redirect to new search page

function fb_change_search_url_rewrite() {
    if ( is_search() && ! empty( $_GET['s'] ) ) {
    wp_redirect( home_url( "/search?s=" ) . urlencode( get_query_var( 's' ) ) );
    exit();
    }
}
add_action( 'template_redirect', 'fb_change_search_url_rewrite' );

//  Remove Buddypress search drowpdown for selecting members etc
add_filter('bp_search_form_type_select', 'bpmag_remove_search_dropdown'  );
function bpmag_remove_search_dropdown($select_html){
    return '';
}

//force buddypress to not process the search/redirect
remove_action( 'bp_init', 'bp_core_action_search_site', 7 );

//let us handle the unified page ourself
add_action( 'init', 'bp_buddydev_search', 10 );// custom handler for the search
function bp_buddydev_search(){
global $bp;
    if ( bp_is_current_component(BP_SEARCH_SLUG) )//if this is search page
        bp_core_load_template( apply_filters( 'bp_core_template_search_template', 'search-single' ) );//load the single searh template
}

add_action('advance-search','bpmag_show_search_results',1);//highest priority

/* we just need to filter the query and change search_term=The search text*/
function bpmag_show_search_results(){
    //filter the ajaxquerystring
     add_filter('bp_ajax_querystring','bpmag_global_search_qs',100,2);
}
 //modify the query string with the search term
function bpmag_global_search_qs(){
    return 'search_terms='.$_GET['s'];
    //return 'search_terms='.$_REQUEST['search-terms'];
}
//set search string as variable
function bpmag_global_search_queryvar(){
    //return 'search_terms='.$_GET['s'];
    //return 'search_terms='.$_REQUEST['search-terms'];
}

function bpmag_is_advance_search(){
global $bp;
if(bp_is_current_component( BP_SEARCH_SLUG))
    return true;
return false;
}

//show the search results for member*/
function bpmag_show_member_search(){
    ?>
   <div id="members-results" class="members-search-result search-result members">
   <h3 class="content-title"><?php _e('Members Results',"bpmag");?></h3>
  <?php locate_template( array( 'members/members-loop-unisearch.php' ), true ) ;  ?>
  <?php global $members_template;
    if($members_template->total_member_count>1):?>
   <a href="<?php echo bp_get_root_domain().'/'.  bp_get_members_slug().'/?s='.$_GET['s']?>" ><?php _e(sprintf('View all %d matched Members',$members_template->total_member_count),"bpmag");?></a>
    <?php   endif; ?>
    </div>
<?php   
 }
//Hook Member results to search page
add_action('advance-search','bpmag_show_member_search',10); //the priority defines where in page this result will show up(the order of member search in other searchs)

//Group search
function bpmag_show_groups_search(){
    ?>
<div id="groups-results" class="groups-search-result search-result">
    <h3 class="content-title"><?php _e('Groups Results','bpmag');?></h3>
    <?php locate_template( array('groups/groups-loop-unisearch.php' ), true ) ;  ?>
    
<!--         <a href="<?php echo bp_get_root_domain().'/'.  bp_get_groups_slug().'/?s='.$_GET['s']?>" ><?php _e("View All matched Groups","bpmag");?></a>
 --></div>
    <?php
 //endif;
  }

//Hook Groups results to search page
 if(bp_is_active( 'groups' ))
    add_action('advance-search','bpmag_show_groups_search',15);

 /**activity update search*/
 //Activity search
function bpmag_show_activity_search(){
    ?>
<div id="activity-results" class="activity-search-result search-result activity">
    <h3 class="content-title"><?php _e('Activity Stream Updates','bpmag');?></h3>
    <?php locate_template( array('activity/activity-loop-unisearch.php' ), true ) ;  ?>
    
        <!-- <a href="<?php echo bp_get_root_domain().'/'.  bp_get_activity_slug().'/?s='.$_GET['s']?>" ><?php _e("View all matched updates","bpmag");?></a> -->
</div>
    <?php
 //endif;
  }

//Hook Groups results to search page
 if(bp_is_active( 'activity' ))
    add_action('advance-search','bpmag_show_activity_search',20);

/**
 *
 * Show blog posts in search
 */
function bpmag_show_site_blog_search(){
    ?>
 <div id="article-results" class="blog-search-result search-result">
 
  <h3 class="content-title"><?php _e('News &amp; Features Results','bpmag');?></h3>
   
   <?php locate_template( array( 'search-loop.php' ), true ) ;  ?>
<!--    <a href="<?php echo bp_get_root_domain().'/?s='.$_GET['s']?>" ><?php _e("View All matched Posts","bpmag");?></a>
 --></div>
   <?php
  }

//Hook Blog Post results to search page
 add_action('advance-search',"bpmag_show_site_blog_search",17);


//show blogs search result

function bpmag_show_blogs_search(){

    ?>
  <div class="blogs-search-result search-result">
  <h3 class="content-title"><?php _e('Blogs Search',"bpmag");?></h3>
  <?php locate_template( array( 'blogs/blogs-loop.php' ), true ) ;  ?>
  <a href="<?php echo bp_get_root_domain().'/'. bp_get_blogs_slug().'/?s='.$_GET['s']?>" ><?php _e("View All matched Blogs","bpmag");?></a>
 </div>
  <?php
  }

//Hook Blogs results to search page if blogs comonent is active
 // if(bp_is_active( 'blogs' ))
 //    add_action('advance-search','bpmag_show_blogs_search',10);

 //show forums search
function bpmag_show_forums_search(){
    ?>
 <div class="forums-search-result search-result">
   <h3 class="content-title"><?php _e("Forum Topics Search","bpmag");?></h3>
  <?php locate_template( array( 'forums/forums-loop.php' ), true ) ;  ?>
   <a href="<?php echo bp_get_root_domain().'/'.  bp_get_forums_slug().'/?s='.$_GET['s']?>" ><?php _e("View All matched forum posts","bpmag");?></a>
</div>
  <?php
  }

//Hook Forums results to search page
// if ( bp_is_active( 'forums' ) && bp_forums_is_installed_correctly() && bp_forums_has_directory() )
 //add_action('advance-search',"bpmag_show_forums_search",20);
 
 function bpmag_show_bbpress_topic_search(){
     //$_REQUEST['ts']=$_REQUEST['search-terms'];//put it for bbpress topic search
    $_REQUEST['ts']=$_GET['s'];//put it for bbpress topic search
    ?>
  <div id="forum-results" class="bbp-topic-search-result search-result">
  <h3 class="content-title"><?php _e('Forum Topic Results',"bpmag");?></h3>
  <?php bbp_get_template_part('bbpress/content','archive-topic') ;  ?>
  <?php
  global $bbp;
    $page = bbp_get_page_by_path( $bbp->root_slug );
    
  ?>
<!--   <a href="<?php echo get_permalink($page).'?ts='.$_GET['s']?>" ><?php _e("View all matched topics","bpmag");?></a>
 --> </div>
  <?php
  }

//Hook Blogs results to search page if blogs comonent is active
 if(function_exists( 'bbp_has_topics' ))
    add_action('advance-search','bpmag_show_bbpress_topic_search',28);

/* End SEARCH code
********************/

