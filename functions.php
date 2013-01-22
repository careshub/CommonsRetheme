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

// Filters Nav Menu output by adding 'menu-item-{page slug}' to menu li classes
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

// Filter classes added to body tag to add "buddypress" if BuddyPress is active
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


//Remove Gravatars for testing on localhost
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