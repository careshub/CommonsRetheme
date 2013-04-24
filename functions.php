<?php
// If BuddyPress is not activated, switch back to the default WP theme and bail out
if ( ! function_exists( 'bp_is_active' ) ) {
  switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
  return;
}
//include code from include folder
//Definition of the Salud America policy custom post type
require_once('includes/SA_Policies.php');
require_once('includes/taxonomy-advocacytarget.php');
//Definition of the geographies custom taxonomy
require_once('includes/taxonomy-geography.php');
//Definition of the Salud America Resources custom post type
require_once('includes/SA_Resources.php');
//Definition of the Salud America Resources custom taxonomy
require_once('includes/taxonomy-resourcecat.php');
//Definition of the Salud America policy tag custom taxonomy
require_once('includes/taxonomy-sapolicytag.php');
//Shortcode for CDC_DCH Group Home
require_once('includes/cdc_dch_shortcode.php');

function bp_support_theme_setup() {
  global $bp;

  // Load the default BuddyPress AJAX functions if it isn't explicitly disabled or if it isn't already included in a custom theme
  if ( ! function_exists( 'bp_dtheme_ajax_querystring' ) )
    require_once( BP_PLUGIN_DIR . '/bp-themes/bp-default/_inc/ajax.php' );

  // Let's tell BP that we support it!
  add_theme_support( 'buddypress' );

  if ( ! is_admin() ) {
    // Register buttons for the relevant component templates
    // Friends button
    if ( bp_is_active( 'friends' ) )
      add_action( 'bp_member_header_actions',    'bp_add_friend_button' );

    // Activity button
    if ( bp_is_active( 'activity' ) )
      add_action( 'bp_member_header_actions',    'bp_send_public_message_button' );

    // Messages button
    if ( bp_is_active( 'messages' ) )
      add_action( 'bp_member_header_actions',    'bp_send_private_message_button' );

    // Group buttons
    if ( bp_is_active( 'groups' ) ) {
      add_action( 'bp_group_header_actions',     'bp_group_join_button' );
      add_action( 'bp_group_header_actions',     'bp_group_new_topic_button' );
      add_action( 'bp_directory_groups_actions', 'bp_group_join_button' );
    }

    // Blog button
    if ( bp_is_active( 'blogs' ) )
      add_action( 'bp_directory_blogs_actions',  'bp_blogs_visit_blog_button' );
  }
}
add_action( 'after_setup_theme', 'bp_support_theme_setup', 11 );

/**
 * Enqueues BuddyPress JS and related AJAX functions
 *
 * @since 1.2
 */
function bp_support_enqueue_scripts() {

  // Add words that we need to use in JS to the end of the page so they can be translated and still used.
  $params = array(
    'my_favs'           => __( 'My Favorites', 'buddypress' ),
    'accepted'          => __( 'Accepted', 'buddypress' ),
    'rejected'          => __( 'Rejected', 'buddypress' ),
    'show_all_comments' => __( 'Show all comments for this thread', 'buddypress' ),
    'show_all'          => __( 'Show all', 'buddypress' ),
    'comments'          => __( 'comments', 'buddypress' ),
    'close'             => __( 'Close', 'buddypress' )
  );

  // BP 1.5+
  if ( version_compare( BP_VERSION, '1.3', '>' ) ) {
    // Bump this when changes are made to bust cache
    $version = '20120412';

    $params['view']        = __( 'View', 'buddypress' );
    $params['mark_as_fav'] = __( 'Favorite', 'buddypress' );
    $params['remove_fav']  = __( 'Remove Favorite', 'buddypress' );
  }
  // BP 1.2.x
  else {
    $version = '20110729';

    if ( bp_displayed_user_id() )
      $params['mention_explain'] = sprintf( __( "%s is a unique identifier for %s that you can type into any message on this site. %s will be sent a notification and a link to your message any time you use it.", 'buddypress' ), '@' . bp_get_displayed_user_username(), bp_get_user_firstname( bp_get_displayed_user_fullname() ), bp_get_user_firstname( bp_get_displayed_user_fullname() ) );
  }

  // Enqueue the global JS - Ajax will not work without it
  wp_enqueue_script( 'dtheme-ajax-js', BP_PLUGIN_URL . '/bp-themes/bp-default/_inc/global.js', array( 'jquery' ), $version );

  // Localize the JS strings
  wp_localize_script( 'dtheme-ajax-js', 'BP_DTheme', $params );
}
add_action( 'wp_enqueue_scripts', 'bp_support_enqueue_scripts' );

function custom_childtheme_stylesheet_load(){
wp_register_style(
        'custom_childtheme_stylesheet',
        get_stylesheet_directory_uri() . '/style.css',
        false,
        0.2
    );
wp_enqueue_style( 'custom_childtheme_stylesheet' );
}
// Twenty Twelve parent theme functions call this stylesheet, so we don't need to.
// add_action( 'wp_print_styles', 'custom_childtheme_stylesheet_load' );

function parent_stylesheet_load(){
    wp_register_style(
            '2012_parent_stylesheet',
            get_template_directory_uri() . '/style.css',
            false
        );
    wp_enqueue_style( '2012_parent_stylesheet' );
}
add_action( 'wp_enqueue_scripts', 'parent_stylesheet_load', 1 );

function commons_ie_stylesheet_load(){
    global $wp_styles;
    wp_register_style(
            'commons_ie_stylesheet',
            get_stylesheet_directory_uri() . '/style-ie.css',
            false,
            0.2
        );
    wp_enqueue_style( 'commons_ie_stylesheet' );
    $wp_styles->add_data( 'commons_ie_stylesheet', 'conditional', 'lt IE 9' );
    // wp_register_script('modernizr', get_stylesheet_directory_uri().'/includes/modernizr.custom.91496.js">', false, '0.1' );  
    // wp_enqueue_script('localScroll');
    // $wp_styles->add_data( 'commons_ie_stylesheet', 'conditional', 'lt IE 9' );


}
add_action( 'wp_enqueue_scripts', 'commons_ie_stylesheet_load', 99 );


function notifications_counter() {
	if (function_exists('bp_is_active')) {
	global $bp;

	//Do nothing if the user isn't logged in
	if ( !is_user_logged_in() )
		return ;

  $user = bp_loggedin_user_id();
	$notifications = bp_core_get_notifications_for_user( $user );
	$count = !empty( $notifications ) ? count( $notifications ) : 0;
	$alert_class = (int) $count > 0 ? 'pending-count alert' : 'count no-alert';
	$output = '<li class="menupop bp-notifications">' 
			   . '<span class="';
	$output .= $alert_class;
	$output .= '">' . $count . '</span><h5>Notifications:</h5>';
	$output .= print_notifications_list($notifications,$count);
	$output .='</li>';

	echo $output;
	}

}

function print_notifications_list($notifications,$count){
    $output = '<div class="pop-sub-wrapper"><ul class="bp-notification-list">';
        
	if ( $count !== 0 ) {
		$counter = 0;
		for ( $i = 0; $i < $count; $i++ ) {
		$alt = ( 0 == $counter % 2 ) ? ' alt' : '';

		$output .= '<li class="' . $alt . '">' . $notifications[$i] .'</li>';

		$counter++;
		}
	} else {

	$output .= '<li class="no-notices">You don&rsquo;t have any new notifications.</li>';

	}

	$output .= '</ul></div>';
	return $output;
}

/**
 * Register widgetized area and update sidebar with default widgets
 */
 
function ccommons_widgets_init() {

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
register_sidebar( array(
		'name' => __( 'Geo Search SA Policies Widget Area', 'ccommons' ),
		'id' => 'sa_geosearch_widget',
		'description' => __( 'Geo Search SA Policies Widget Area', 'ccommons' ),
		'before_widget' => '<nav id="%1$s" class="widget %2$s">',
		'after_widget' => '</nav>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );        
}
add_action( 'init', 'ccommons_widgets_init' );

if ( function_exists( 'register_nav_menus' ) ) {
  register_nav_menus( 
    array( 
      'footer-nav' => 'Footer Navigation',
      'salud-nav' => 'Salud America section navigation',
      'help-area' => 'Help Area'
      ) 
    );

  // register_nav_menu( 'footer-nav', 'Footer Navigation' );
  // register_nav_menu( 'salud-nav', 'Salud America section navigation' );
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

function hoverIntent_js_load(){

  wp_register_script('hoverIntent', get_stylesheet_directory_uri().'/js/jquery.hoverIntent.minified.js">', array('jquery'), 'r6' ); 
  wp_enqueue_script('hoverIntent'); 

}
add_action('wp_enqueue_scripts', 'hoverIntent_js_load');

/* SEARCH - replaces standard WordPress search with a unified results page
*************/

// TODO wrap this in a buddypress safe way

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

    if ( function_exists('bp_is_current_component') && bp_is_current_component(BP_SEARCH_SLUG) )//if this is search page
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
if( function_exists('bp_is_current_component') && bp_is_current_component( BP_SEARCH_SLUG))
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
    if( function_exists('bp_is_active') && bp_is_active( 'groups' ))
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
    if( function_exists('bp_is_active') && bp_is_active( 'activity' ))
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

/**
 * BuddyPress replaces the space with '-' , but the user doesn't know
 * We remove the attached function to stop BP from circumventing the space in username
 */
add_action('bp_init','bpdev_remove_bp_pre_user_login_action');
function bpdev_remove_bp_pre_user_login_action(){
 remove_action( 'pre_user_login', 'bp_core_strip_username_spaces' );
}
 
//add a filter to invalidate a username with spaces
add_filter('validate_username','bpdev_restrict_space_in_username',10,2);
function bpdev_restrict_space_in_username($valid,$user_name){
 //check if there is an space
 if ( preg_match('/\s/',$user_name) ) {
   return false;//if yes, then we say it is an error
  } else {
   return $valid;//otherwise return the actual validity
  }
}

// Undo some bad styling in the buddypress media plugin:

function add_this_script_footer(){ ?>

  <script type="text/javascript">
  jQuery(document).ready(function($) {
  $(".bpfb_toolbar_container a").addClass("button");
  $("#bpfb_addDocuments").hide();
  
  });
  </script> 

<?php } 

//add_action('wp_footer', 'add_this_script_footer');

function add_group_activity_tab() {
  global $bp;
  // Only check if we're on a group page
  if( bp_is_group() ) { 

  // Only add the "Home" tab if the group has a custom front page, so check for an associated post. 
  // Only add the new "Activity" tab if the group is visible to the user.
    $group_id = $bp->groups->current_group->id ;
    $visible = $bp->groups->current_group->is_visible ;
    $args =  array(
       'post_type'   => 'group_home_page',
       'posts_per_page' => '1',
       'meta_query'  => array(
                           array(
                            'key'           => 'group_home_page_association',
                            'value'         => $group_id,
                            'compare'       => '=',
                            'type'          => 'NUMERIC'
                            )
                        )
    ); 
    $custom_front_query = new WP_Query( $args );

    if( $custom_front_query->have_posts() && $visible ) { 
      bp_core_new_subnav_item( 
        array( 
          'name' => 'Activity', 
          'slug' => 'activity', 
          'parent_slug' => $bp->groups->current_group->slug, 
          'parent_url' => bp_get_group_permalink( $bp->groups->current_group ), 
          'position' => 11, 
          'item_css_id' => 'nav-activity',
          'screen_function' => create_function('',"bp_core_load_template( apply_filters( 'groups_template_group_home', 'groups/single/home' ) );"),
          'user_has_access' => 1
        ) 
      );
   
      if ( bp_is_current_action( 'activity' ) ) {
        add_action( 'bp_template_content_header', create_function( '', 'echo "' . esc_attr( 'Activity' ) . '";' ) );
        add_action( 'bp_template_title', create_function( '', 'echo "' . esc_attr( 'Activity' ) . '";' ) );
      } // END if ( bp_is_current_action( 'activity' ) ) 
    } // END if( $custom_front_query->have_posts() )
  } //END if( bp_is_group() )
}
 
add_action( 'bp_actions', 'add_group_activity_tab', 8 );

//Generate Group Home Page custom post type to populate group home pages
add_action( 'init', 'register_cpt_group_home_page' );

function register_cpt_group_home_page() {

    $labels = array( 
        'name' => _x( 'Group Home Pages', 'group_home_page' ),
        'singular_name' => _x( 'Group Home Page', 'group_home_page' ),
        'add_new' => _x( 'Add New', 'group_home_page' ),
        'add_new_item' => _x( 'Add New Group Home Page', 'group_home_page' ),
        'edit_item' => _x( 'Edit Group Home Page', 'group_home_page' ),
        'new_item' => _x( 'New Group Home Page', 'group_home_page' ),
        'view_item' => _x( 'View Group Home Page', 'group_home_page' ),
        'search_items' => _x( 'Search Group Home Pages', 'group_home_page' ),
        'not_found' => _x( 'No group home pages found', 'group_home_page' ),
        'not_found_in_trash' => _x( 'No group home pages found in Trash', 'group_home_page' ),
        'parent_item_colon' => _x( 'Parent Group Home Page:', 'group_home_page' ),
        'menu_name' => _x( 'Group Homes', 'group_home_page' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'This post type is queried when a group home page is requested.',
        'supports' => array( 'title', 'editor' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        //'menu_icon' => '',
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'post'//,
        //'map_meta_cap'    => true
    );

    register_post_type( 'group_home_page', $args );
}

//Add meta box to Group Home Page custom post type to associate posts with the group home page

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'group_home_meta_boxes_setup' );
add_action( 'load-post-new.php', 'group_home_meta_boxes_setup' );

/* Meta box setup function. */
function group_home_meta_boxes_setup() {

  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'add_group_home_meta_boxes' );

  /* Save post meta on the 'save_post' hook. */
  add_action( 'save_post', 'save_group_home_meta', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the group home page editor screen. */
function add_group_home_meta_boxes() {

  add_meta_box(
    'group-home-page-association',      // Unique ID
    esc_html__( 'Groups to Use this Home Page', 'group-home-page' ),    // Title
    'group_home_page_meta_box',   // Callback function
    'group_home_page',         // Admin page (or post type)
    'normal',         // Context
    'default'         // Priority
  );
}

/* Display the post meta box. */
function group_home_page_meta_box( $object, $box ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'group_home_association_nonce' ); ?>
<!-- Loop through Group Tree with the addition of checkboxes -->
  <?php if (class_exists('BP_Groups_Hierarchy')) {
    $tree = BP_Groups_Hierarchy::get_tree();
    //print_r($tree);
    $group_associations = get_post_meta( $object->ID, 'group_home_page_association', false); // Use false because we want an array of associations to be returned
    //print_r($group_associations);

    echo '<ul class="group-tree">';
    foreach ($tree as $branch) {
      ?>
      <li><!-- ID: <?php echo $branch->id ;?> Name: <?php echo $branch->name;?> Parent ID:<?php echo $branch->parent_id ;?> -->
        <input type="checkbox" id="group-home-page-assoc-<?php echo $branch->id ?>" name="group_home_page_association[]" value="<?php echo $branch->id ?>" <?php checked( in_array( $branch->id , $group_associations ) ); ?> />
        <label for="group-home-page-assoc-<?php echo $branch->id ?>"><?php echo $branch->name; ?></label>
      </li>
      <?php
    }
    echo '</ul>';

  }
}

/* Save the meta box's post metadata. */
function save_group_home_meta( $post_id, $post ) {

  /* Verify the nonce before proceeding. */
  if ( !isset( $_POST['group_home_association_nonce'] ) || !wp_verify_nonce( $_POST['group_home_association_nonce'], basename( __FILE__ ) ) )
    return $post_id;

  /* Get the post type object. */
  $post_type = get_post_type_object( $post->post_type );

  /* Check if the current user has permission to edit the post. */
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

  if (!empty($_POST['group_home_page_association']) && is_array($_POST['group_home_page_association'])) {
        delete_post_meta($post_id, 'group_home_page_association');
        foreach ($_POST['group_home_page_association'] as $association) {
            add_post_meta($post_id, 'group_home_page_association', $association);
        }
    }

}

/**
 * Extends the default WordPress body class to denote:
 * 1. Adds "salud-america" to pages using the SA template.
 *
 *
 * @since Twenty Twelve 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
/* Filter classes added to body tag to add "buddypress" if BuddyPress is active
***************/
function cc_custom_body_class( $classes ) {
    //First we unset the class "buddypress" that was added in BP 1.7 a little too indiscriminately.
    if(($key = array_search('buddypress', $classes)) !== false) {
        unset($classes[$key]);
      }
     
    if ( function_exists( 'bp_is_blog_page' ) && !bp_is_blog_page() ) {
        $classes[] = 'buddypress';
      }

    if ( is_page_template( 'page-templates/salud-america.php' ) || is_page_template( 'page-templates/salud-america-eloi.php' ) || is_singular('sapolicies') ) {
        $classes[] = 'salud-america';
      }

    if ( is_page_template( 'page-templates/full-width-no-title.php' ) ) {
        $classes[] = 'full-width';
      }

    if ( is_page( 'maps-data' ) ) {
        $classes[] = 'full-width';
        $classes[] = 'maps-data';
      }

  return $classes;
}
add_filter( 'body_class', 'cc_custom_body_class', 88 );

remove_filter('the_content','wpautop');

//decide when you want to apply the auto paragraph

add_filter('the_content','salud_formatting');

function salud_formatting($content){
  if ( is_page( 'salud-america' ) ) {
    return $content;//no autop
  } else {
   return wpautop($content);
  }
}
//Add our custom post types to the archives page
function cc_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post',
     'sapolicies'
    ));
    return $query;
  }
}
add_filter( 'pre_get_posts', 'cc_add_custom_types' );

//Show a list of attachments after the post, for sa policies only

add_filter( 'the_content', 'list_attachments_content_filter' );
function list_attachments_content_filter( $content ) {
  global $post;

  if ( is_single() && $post->post_type == 'sapolicies' && $post->post_status == 'publish' ) {
    $attachments = get_posts( array(
      'post_type' => 'attachment',
      'posts_per_page' => 0,
      'post_parent' => $post->ID
    ) );

    if ( $attachments ) {
      $content .= '<h5 class="attachments-header">Attachments</h5>';
      $content .= '<ul class="post-attachments">';
      foreach ( $attachments as $attachment ) {
        $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
        $title = wp_get_attachment_link( $attachment->ID, false );
        $content .= '<li class="' . $class . '">' . $title . '</li>';
      }
      $content .= '</ul>';
    }
  }

  return $content;
}

// Sets WordPress toolbar to be hidden by default for new user registrations
add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
function set_user_admin_bar_false_by_default($user_id) {
    update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
}

//Add new image sizes for front page
if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'feature-front', '600', '300' ); //not hard cropped, resized proportionally
  add_image_size( 'feature-front-sub', '300', '200', true ); // hard cropped
}

//Function to test whether a page is the child of a specific page
//Used in the Salud America topical guides section
function is_child($page_id_or_slug) { 
    global $post; 
    if(!is_int($page_id_or_slug)) {
        $page = get_page_by_path($page_id_or_slug);
        $page_id_or_slug = $page->ID;
    } 
    if(is_page() && $post->post_parent == $page_id_or_slug ) {
            return true;
    } else { 
            return false; 
    }
}

function cdcdch_users() {
	if ( is_page('cdc_dch1') ) {
        $form_id = 2;        
        $cdcusers = RGFormsModel::get_leads($form_id, '5', 'ASC');
		global $current_user;
		$count = 0;
		// loop through all the returned results
        foreach ($cdcusers as $cdcuser) {                
				if ($current_user->display_name == $cdcuser['5'])
				{
					$count = $count + 1;
				}            
        }
		 if ($count > 0) {
				wp_redirect( 'http://assessment.communitycommons.org/Footprint/Default.aspx?t=DCH' );
				exit();    
		 } else {
			 return "";
		 }
	}
}
add_action( 'template_redirect', 'cdcdch_users' );

//Plugin Q and A FAQs sloppily affects all excerpts everywhere. This removes that, so we can do our own.
remove_filter( 'excerpt_more', 'qaplus_auto_excerpt_more' );
remove_filter( 'get_the_excerpt', 'qaplus_custom_excerpt_more' );
remove_filter( 'excerpt_length', 'qaplus_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function twentyeleven_continue_reading_link() {
  return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function twentyeleven_auto_excerpt_more( $more ) {
  return ' &hellip;' . twentyeleven_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function twentyeleven_custom_excerpt_more( $output ) {
  if ( has_excerpt() && ! is_attachment() ) {
    $output .= twentyeleven_continue_reading_link();
  }
  return $output;
}
add_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );//Modify "Read More" to the end of excerpts

//Removes mentions pane from profile activity (doesn't remove mention functionality)
function ray_remove_mention_nav() {
global $bp;
bp_core_remove_subnav_item( $bp->activity->slug, 'mentions' );
}
// add_action( 'init', 'ray_remove_mention_nav' );