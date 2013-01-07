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

function echo_print_list($notifications,$count){
    echo '<ul class="bp-notification-list">';
        
	if ( $notifications ) {
	$counter = 0;
	for ( $i = 0; $i < $count; $i++ ) {
	$alt = ( 0 == $counter % 2 ) ? ' class="alt"' : ''; ?>

	<li<?php echo $alt ?>><?php echo $notifications[$i] ?></li>

	<?php $counter++;
	}
	} else { ?>

	<li><?php _e( 'You don\'t have any new notifications.', 'bpdnw' ); ?></li>

	<?php
	}

	echo '</ul>';
}

function print_list($notifications,$count){
    $output = '<ul class="bp-notification-list">';
        
	if ( $notifications ) {
		$counter = 0;
		for ( $i = 0; $i < $count; $i++ ) {
		$alt = ( 0 == $counter % 2 ) ? ' class="alt"' : '';

		$output .= '<li' . $alt . '>' . $notifications[$i] .'</li>';

		$counter++;
		}
	} else {

	$output .= '<li>You don&rsquo;t have any new notifications.</li>';

	}

	$output .= '</ul>';
	return $output;
}

