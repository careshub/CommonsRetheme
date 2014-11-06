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
require_once('includes/cpt-sa-success-stories.php');
//Definition of the Salud America Resources custom taxonomy
require_once('includes/taxonomy-resourcecat.php');
//Definition of the Salud America policy tag custom taxonomy
require_once('includes/taxonomy-sapolicytag.php');
//Shortcode for CDC_DCH Group Home
require_once('includes/cdc_dch_shortcode.php');
//Shortcode for SA Policy Map Search
require_once('includes/sa_policy_map_shortcode.php');
//Definition of the WKKF Scorecard Data Input custom post type
require_once('includes/WKKF_scorecard.php');

//Site search functionality, reconsidered:
require_once('includes/site-search-redux.php');


/* Javascript library and style enqueues
*  
*********************************/
// First, let's dequeue unneeded scripts and styles
add_action( 'wp_enqueue_scripts', 'cc_dequeue_parent_theme_scripts', 91 );
function cc_dequeue_parent_theme_scripts(){
  wp_dequeue_style( 'twentytwelve-style' );
  wp_deregister_style( 'twentytwelve-style' );

  wp_dequeue_script( 'twentytwelve-navigation' );
  wp_deregister_script( 'twentytwelve-navigation' );

  //Dequeue bbPress styles if not on forum
  if ( function_exists( 'is_bbpress' ) && ( ! is_bbpress() && ! bp_is_current_action( 'forum' ) ) ) {
    wp_dequeue_style( 'bbp-default' );
	}

  //Dequeue BuddyPress child theme style -- our styles are in our main style sheets
    // wp_dequeue_style( 'bp-child-css' );
}

add_action( 'wp_print_styles', 'cc_dequeue_other_css_and_scripts', 91 );
function cc_dequeue_other_css_and_scripts(){
  //Devs hook their style enqueues at various times, so sometimes you have to use a different hook
  wp_dequeue_style( 'taxonomy-image-plugin-public' );
}

// Add needed scripts and styles, public-facing pages
add_action( 'wp_print_styles', 'custom_childtheme_stylesheet_load', 99 );
function custom_childtheme_stylesheet_load(){
  wp_register_style(
          'commons_retheme_stylesheet',
          get_stylesheet_uri(),
          false,
          0.40
      );
  wp_enqueue_style( 'commons_retheme_stylesheet' );
}
//Having to hard code this call into the header. In order to add conditionals, you have to use wp_enqueue_scripts, but our main stylesheets must appear after some plugin stylesheets, which are included later at wp_print_styles.
// add_action( 'wp_enqueue_scripts', 'commons_ie_stylesheet_load', 99 );
function commons_ie_stylesheet_load(){
    global $wp_styles;
    wp_register_style(
            'commons_ie_stylesheet',
            get_stylesheet_directory_uri() . '/style-ie.css',
            false,
            0.40
        );
    wp_enqueue_style( 'commons_ie_stylesheet' );
    $wp_styles->add_data( 'commons_ie_stylesheet', 'conditional', 'lt IE 9' );
    // wp_register_script('modernizr', get_stylesheet_directory_uri().'/includes/modernizr.custom.91496.js">', false, '0.1' );  
    // wp_enqueue_script('localScroll');
    // $wp_styles->add_data( 'commons_ie_stylesheet', 'conditional', 'lt IE 9' );
}

add_action( 'wp_print_styles', 'parent_stylesheet_load', 1 );
function parent_stylesheet_load(){
    wp_register_style(
            '2012_parent_stylesheet',
            get_template_directory_uri() . '/style.css',
            false,
            1.5
        );
    wp_enqueue_style( '2012_parent_stylesheet' );
}

// I'm joining the various scripts into one via CodeKit.
add_action( 'wp_enqueue_scripts', 'cc_common_js_load', 14 );
function cc_common_js_load(){
  wp_register_script('cc-common-scripts', get_stylesheet_directory_uri().'/js/commons.min.js">', array('jquery'), '1.0', true  ); 
  wp_enqueue_script('cc-common-scripts'); 
}

// Add needed scripts and styles, WP admin pages
function cc_wp_admin_area_stylesheet_load(){
    wp_register_style(
            'cc_wp_admin_area_stylesheet',
            get_stylesheet_directory_uri() . '/css/wp-admin-area-customization.css',
            false
        );
    wp_enqueue_style( 'cc_wp_admin_area_stylesheet' );
    wp_register_style(
            'cc_wp_admin_area_jquery_ui',
            'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css',
            false
        );
    wp_enqueue_style( 'cc_wp_admin_area_jquery_ui' );
}
add_action( 'admin_print_styles', 'cc_wp_admin_area_stylesheet_load', 11 );

// Add style sheet for the TinyMCE (wp_editor) window
add_filter( 'mce_css', 'cc_add_wp_editor_styles', 17 );
function cc_add_wp_editor_styles( $mce_css ) {
  // On the front end, we'll need to include twentytwelve theme's editor styles, too
  if ( ! is_admin() ) {
    if ( ! empty( $mce_css ) )
      $mce_css .= ',';

    $mce_css .= get_template_directory_uri() . '/editor-style.css';
  }

  // Include our own. This is applied to the post editor and front end editors (for the group home page and group narrative)
  if ( ! empty( $mce_css ) )
    $mce_css .= ',';

  $mce_css .= get_stylesheet_directory_uri() . '/css/tinymce-editor-styles.css';

  return $mce_css;
}

// With WordPress 3.8 jqueryui-datepicker isn't reliably loaded
function cc_load_datepicker_script() {
        wp_enqueue_script( 'jquery-ui-datepicker' );
}
add_action( 'admin_enqueue_scripts', 'cc_load_datepicker_script', 22 );

//Add Google Analytics Universal tracking
// add_action( 'wp_head', 'cc_add_google_analytics_universal_code', 92 );
function cc_add_google_analytics_universal_code() {
?>
  <!-- <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-22609831-9', 'communitycommons.org');
    ga('send', 'pageview');

  </script> -->
<?php
}

/*
* Override some parent theme bits
***********************************/
function remove_parent_theme_widgets(){
  // Deregister some of the TwentyTen sidebars
  unregister_sidebar( 'sidebar-2' );
  unregister_sidebar( 'sidebar-3' );
}
add_action( 'widgets_init', 'remove_parent_theme_widgets', 11 );

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
        'name' => __( 'Members sidebar', 'ccommons' ),
        'id' => 'members-sidebar',
        'before_widget' => '<nav id="%1$s" class="widget %2$s">',
        'after_widget' => "</nav>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'description' => __( 'Members page sub nav sidebar', 'ccommons' )
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

register_sidebar( array(
    'name' => __( 'Site Search Sidebar Widget Area', 'ccommons' ),
    'id' => 'site_search',
    'description' => __( 'Site Search Sidebar Widget Area', 'ccommons' ),
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

/*
* Template/theming fucntionality
******************************************/
//Add new image sizes for front page
if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'feature-front', '576', '600', false ); //not hard cropped, resized proportionally
  add_image_size( 'feature-large', '682', '350', true ); // hard cropped
  add_image_size( 'feature-front-sub', '300', '200', true ); // hard cropped
}

// Used to create the "alert" bubble in the CC header nav bar
function notifications_counter() {
  if (function_exists('bp_is_active')) {
  global $bp;

  //Do nothing if the user isn't logged in
  if ( !is_user_logged_in() )
    return ;

  $notifications = bp_notifications_get_notifications_for_user( bp_loggedin_user_id(), 'object' );
  $count = ! empty( $notifications ) ? count( $notifications ) : 0;
  $alert_class = (int) $count > 0 ? 'pending-count alert' : 'count no-alert';
  $output = '<li class="menupop bp-notifications separator">' 
         . '<a href="' . trailingslashit( bp_loggedin_user_domain() . bp_get_notifications_slug() ) . '"><span class="'. $alert_class . '">' . $count . '</span></a>';
  $output .= '<h5>Notifications:</h5>';
  $output .= print_notifications_list( $notifications );
  $output .='</li>';

  echo $output;
  }

}

function print_notifications_list( $notifications ){
    $output = '<div class="pop-sub-wrapper"><ul class="bp-notification-list">';
        
  if ( ! empty( $notifications ) ) {
    foreach ( (array) $notifications as $notification ) {
      $output .= '<li id="cc-notification-' . $notification->id . '">';
      $output .= '<a href="' . $notification->href . '">' . $notification->content . '</a></li>';
    }
  } else {

  $output .= '<li class="no-notices">No new notifications.</li>';

  }

  $output .= '</ul></div>';
  return $output;
}

function cc_no_gravatars_for_groups( $no_grav, $params ) {
  if ( $params['object'] == 'group' )
    $no_grav = true;

  return $no_grav;
}
// @TODO: Waiting on object parameter to be added to BuddyPress core.
// https://buddypress.trac.wordpress.org/ticket/5958
// add_filter( 'bp_core_fetch_avatar_no_grav', 'cc_no_gravatars_for_groups', 10, 2 );

function cc_replace_default_avatar_group( $url, $params ){

  if ( false !== strpos( $url, 'bp-core/images/mystery-man') ) {
    if ( $params['type'] =='thumb' ) {
      $url = get_stylesheet_directory_uri() . '/img/cc-group-default-avatar-50.jpg';
    } else {
      $url = get_stylesheet_directory_uri() . '/img/cc-group-default-avatar.jpg';
    }
  }

  return $url;
}
add_filter( 'bp_core_default_avatar_group', 'cc_replace_default_avatar_group', 10, 2);

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

/* Filter <body> classes -- e.g. add "buddypress" if BuddyPress is active
***************/
function cc_custom_body_class( $classes ) {
 
    // if ( function_exists( 'bp_is_blog_page' ) && !bp_is_blog_page() ) {
    //     // $classes[] = 'buddypress';
    //   }

    if ( is_page_template( 'page-templates/WKKF-Compass.php' ) ) {
        $classes[] = 'full-width';
      }

    if ( is_page_template( 'page-templates/full-width-no-title.php' ) || is_page_template( 'page-templates/full-width-screamer-title.php' ) ) {
        $classes[] = 'full-width';
      }

    if ( is_page( 'maps-data' ) ) {
        $classes[] = 'full-width';
        $classes[] = 'maps-data';
      }

    if ( is_page( array(8622,'wotn') ) ) {
        $classes[] = 'wotn';
        $classes[] = 'full-width';
      }
    if ( is_page( 'ncr' ) ) {
        $classes[] = 'full-width';
        $classes[] = 'ncr';
      }
    if ( is_page( 'ebw' ) ) {
        $classes[] = 'full-width';
        $classes[] = 'ebw';
      }
    if ( is_page_template( 'page-templates/template-grant-writing.php' ) ) {
        $classes[] = 'full-width';
        $classes[] = 'chi-planning';
      }
    if ( is_singular( 'bp_doc' ) || is_post_type_archive( 'bp_doc' ) ) {
        $classes[] = 'full-width';
      }
    // Remove "full-width" from the main search page.
    // 2012 adds it if the main sidebar is empty.
    if ( is_search() && ! is_post_type_archive() ) {
      $key_to_delete = array_search( 'full-width', $classes );
      // Watch out for 0 being a valid return value!
      if ( $key_to_delete !== false ){
          unset( $classes[ $key_to_delete ] );
      }
    }


  return $classes;
}
add_filter( 'body_class', 'cc_custom_body_class', 96 );

/* Filter <article> classes created by post_class()
***************/
function cc_custom_article_class( $classes ) {
    if ( ( is_page_template( 'page-templates/full-width-no-title.php' ) || is_page_template( 'page-templates/full-width-screamer-title.php' ) ) && comments_open() == FALSE ) {
        $classes[] = 'ultra-compact';
        $classes[] = 'no-divider';
      }
  return $classes;
}
add_filter( 'post_class', 'cc_custom_article_class', 96 );

function cc_group_visibility_class() {
  echo cc_get_group_visibility_class();
}
  function cc_get_group_visibility_class() {
    // Get group visibility to display and set footer header bar color.
    $group_type = bp_get_group_type();
    switch ( $group_type ) {
      case 'Hidden Group':
        $visibility_class = 'hidden';
        break;
      case 'Private Group':
        $visibility_class = 'private';
        break;
      default:
        $visibility_class = 'public';
        break;
    }
    return $visibility_class;
  }

/* Login screen changes - adds CC logo and link 
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


/**
 * Registration - BuddyPress replaces the space with '-' , but the user doesn't know
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

// Sets WordPress toolbar to be hidden by default for new user registrations
add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
function set_user_admin_bar_false_by_default($user_id) {
    update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
}

// Adds a query string to the "register" link in certain situations
// @filter: provides an array of elements to filter
// @returns a query string ( ?interestA=1&interestB=1 ) or null
add_filter( 'bp_get_signup_slug', 'cc_get_signup_interests', 34, 1 );
function cc_get_signup_interests( $sign_up_slug ) {
  $interests = array();

  // Pass the $interest array out to allow filters to remove or add interests
  $interests = apply_filters( 'registration_form_interest_query_string', $interests );

  // Convert it to a query string
  if ( !empty( $interests ) ) {
    $i = 1;
    $query_string = '';
    foreach ( $interests as $argument ) {
      // Append a ? before the first interest, & otherwise
      $query_string .= ( $i == 1 ) ? '?' : '&';
      $query_string .= $argument . '=1';
      $i++;
    }
    return $sign_up_slug . '/' . $query_string;
  }

  return $sign_up_slug . '/';

}

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

// Excerpts behavior modifications
// We're allowing paragraphs, images and hyperlinks.
function cc_improved_trim_excerpt($text) {
        global $post;
        if ( '' == $text ) {
                $text = get_the_content('');
                $text = apply_filters('the_content', $text);
                $text = str_replace('\]\]\>', ']]&gt;', $text);
                $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
                $text = strip_tags($text, '<p><img><a>');
                $excerpt_length = 55;
                $words = explode(' ', $text, $excerpt_length + 1);
                if (count($words)> $excerpt_length) {
                        array_pop($words);
                        array_push($words, '[...]');
                        $text = implode(' ', $words);
                }
        }
        return $text;
}
// remove_filter('get_the_excerpt', 'wp_trim_excerpt');
// add_filter('get_the_excerpt', 'cc_improved_trim_excerpt');

/**
 * Returns a "Continue Reading" link for excerpts
 */
function twentyeleven_continue_reading_link() {
  return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Read more', 'twentyeleven' ) . '</a>';
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

function salud_excerpt_length($length) {
  if ( is_page_template( 'page-templates/salud-america-eloi.php' )
        || is_singular( 'sapolicies' ) 
        || is_page( 'salud-america' ) ) {
    return 20;
  } else {
    return $length;
  }
}
add_filter('excerpt_length', 'salud_excerpt_length', 999);

/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
  $is_search = is_search() ? true : false ;

  // Translators: used between list items, there is a space after the comma.
  $categories_list = get_the_category_list( __( ' ', 'twentytwelve' ) );

  // Translators: used between list items, there is a space after the comma.
  $tag_list = get_the_tag_list( '', __( ' ', 'twentytwelve' ) );

  $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() )
  );

  $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
    // esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    //Use the BuddyPress profile instead
    esc_url( bp_core_get_user_domain( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
    get_the_author()
  );

  // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
  // if ( $tag_list ) {
  //   $utility_text = __( 'Categories: <span class="category-links">%1$s <br />Tags: %2$s <br />Posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
  // } elseif ( $categories_list ) {
  //   $utility_text = __( 'Categories: <span class="category-links">%1$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
  // } else {
  //   $utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
  // }

  $output = '';
  if ( $categories_list && ! $is_search ) {
    $output .= 'Categories <span class="category-links">'. $categories_list . '</span> <br />';
  }
  if ( $tag_list && ! $is_search ) {
    $output .= 'Tags <span class="tag-links">'. $tag_list . '</span> <br />';
  }
  if ( $date && $author ) {
    $output .= 'Posted on ' . $date . '<span class="by-author"> by ' . $author . '</span>.';
  }
  echo $output;

  // printf(
  //   $utility_text,
  //   $categories_list,
  //   $tag_list,
  //   $date,
  //   $author
  // );
}

//Removes mentions pane from profile activity (doesn't remove mention functionality)
function ray_remove_mention_nav() {
global $bp;
bp_core_remove_subnav_item( $bp->activity->slug, 'mentions' );
}
add_action( 'bp_setup_nav', 'ray_remove_mention_nav', 15 );

add_action( 'after_setup_theme', 'cc_bp_support_theme_setup', 11 );
function cc_bp_support_theme_setup() {

    // Group buttons
    if ( bp_is_active( 'groups' ) ) {
      add_action( 'bp_group_header_actions',     'cc_group_rss_feed_link' );
    }

}
function cc_group_rss_feed_link() {
  if ( bp_is_group_home() || bp_is_group_activity() ) : ?>
    <div class="generic-button">
      <a href="<?php bp_group_activity_feed_link(); ?>" title="<?php _e( 'RSS Feed', 'buddypress' ); ?>" class="button"><?php _e( 'RSS', 'buddypress' ); ?></a>
    </div>

    <?php do_action( 'bp_group_activity_syndication_options' ); 
  endif;
}

/*
// Get taxonomy images
// Accepts category name and which taxonomy
// returns <img> string, must be echoed
*/
function cc_get_taxonomy_images($category, $taxonomy){
//Only continue if the $category passed matches a real category slug
  //Get an array of all categories
  $args = array(
    'taxonomy' => $taxonomy
  );
  $possible_categories = get_categories($args);
  $all_cats = array();
  foreach ($possible_categories as $cat) {
    $all_possible_cats[] = $cat->slug;
  }
  //If the requested category doesn't exist, bail.
  if ( !in_array($category, $all_possible_cats) )
    return;

  // Build the section header
  // $cat_object = get_term_by('slug', $category, $taxonomy);
  // print_r($cat_object);
  // $section_title = $cat_object->name;
  // $section_description = $cat_object->description;

  //Put them all together for the Taxonomy Images plugin
  $combined_term_args = array(
    'term_args' => array( 
                'slug' => $category, 
            ),
    'taxonomy' => $taxonomy
  );
        
  $tax_images = apply_filters( 'taxonomy-images-get-terms', '', $combined_term_args );
  if ($tax_images) {
   return wp_get_attachment_image( $tax_images[0]->image_id, 'full' );
 }
}

// Add Taxonomy filters for Custom Post Types
add_action('restrict_manage_posts', 'cc_cpt_restrict_manage_posts');
function cc_cpt_restrict_manage_posts() {
    global $typenow;

    $args = array('public'=>true, '_builtin'=>false); 
    $post_types = get_post_types($args);

    if(in_array($typenow, $post_types)) {
        $filters = get_object_taxonomies($typenow);

        foreach ($filters as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            if ($tax_obj->public) {
            
              $term = get_term_by('slug', $_GET[$tax_obj->query_var], $tax_slug);
            
              wp_dropdown_categories(array(
                  'show_option_all' => __('Show All '.$tax_obj->label ),
                  'taxonomy' => $tax_slug,
                  'name' => $tax_obj->name,
                  'orderby' => 'term_order',
                  'selected' => $term->term_id,
                  'hierarchical' => $tax_obj->hierarchical,
                  'show_count' => false,
                  // 'hide_empty' => true,
                  'hide_empty' => false,
                  'walker' => new DropdownSlugWalker()
              ));
            } //End $tax_obj->public check
        }
    }
}


//Dropdown filter class.  Used with wp_dropdown_categories() to cause the resulting dropdown to use term slugs instead of ids.
class DropdownSlugWalker extends Walker_CategoryDropdown {

    function start_el(&$output, $category, $depth, $args) {
        $pad = str_repeat('&nbsp;', $depth * 3);

        $cat_name = apply_filters('list_cats', $category->name, $category);
        $output .= "\t<option class=\"level-$depth\" value=\"".$category->slug."\"";

        if($category->term_id == $args['selected'])
            $output .= ' selected="selected"';

        $output .= '>';
        $output .= $pad.$cat_name;
        $output .= "</option>\n";
    }
}

// Limit media shown in media library for non-admin users
// If the user isn't a site admin, limit the media items shown in the upload dialog and the media library to items the user uploaded.
// From code originally by @t31os
add_action('pre_get_posts','users_own_attachments');
function users_own_attachments( $wp_query_obj ) 
{
    global $current_user, $pagenow;

    if( !is_a( $current_user, 'WP_User') )
        return;

    // "upload" is the wp-admin media library, "media-new" is the wp-admin media uploader, "async-upload" is called when uploading media from a post edit screen in wp-admin or on the front, like our group home edit page.
    if( 'upload.php' != $pagenow && 'media-new.php' != $pagenow )
        return;

    if( !current_user_can('delete_pages') )
        $wp_query_obj->set('author', $current_user->id );

    return;
}

function ellipsis($text, $max=100, $append='&hellip;') {
    if (strlen($text) <= $max) 
      return $text;

    $out = substr($text,0,$max);

    if (strpos($text,' ') === FALSE) 
      return $out.$append;

    return preg_replace('/\w+$/','',$out).$append;
}

//Remove some group creation steps if the user isn't a superadmin
function cc_remove_group_creation_steps() {
  global $bp;

  // If we're not at domain.org/groups/create/ then return false
  // if ( !bp_is_groups_component() || !bp_is_current_action( 'create' ) )
  //   return false;

  unset( $bp->groups->group_creation_steps['blog-categories'] );
  // unset( $bp->groups->group_creation_steps['docs'] );

}
// add_action( 'bp_before_create_group_content_template', 'cc_remove_group_creation_steps', 9999 );

function hide_group_admin_tabs($classes) {
  if ( bp_is_groups_component() ) {
    // if ( groups_is_user_admin( bp_loggedin_user_id(), bp_get_current_group_id() ) ) {
    //   $classes[] = 'group-member-admin-cap';
    // } else if ( groups_is_user_mod( bp_loggedin_user_id(), bp_get_current_group_id() ) ) {
    //   $classes[] = 'group-member-mod-cap';
    // }
    //Hmmm. The group admin tabs aren't accessible by css selector
    if ( current_user_can('manage_options') ) {
      //Only site admins have this capability
     $classes[] = 'site-administrator';
    }
  }
  return $classes;
}
add_filter( 'body_class', 'hide_group_admin_tabs', 98 );

/* Plugin-specific modifications
*******************/
//Add comment button to appear next to share button
function cc_add_comment_button( $post_id = null ) {
  if ( is_singular() && comments_open( $post_id ) ) {
    echo '<a href="#respond" class="button add-comment-link"><span class="comment-icon"></span>Comment</a>';
  }
}

/*
 * Create a url to a taxonomy term within a CPT
 * 
 * @param string $post_type
 * @param string $taxonomy
 * @param string $term
 * 
 * @return string of the url || false
 */
function cc_get_the_cpt_tax_intersection_link( $post_type = false, $taxonomy = false, $term = false ){

  // Bail if one of the args isn't specified
  if( !( $post_type ) || !( $taxonomy ) || !( $term ) )
    return false;

  // If that CPT doesn't exist, bail
  if ( !$cpt_object = get_post_type_object( $post_type ) )
    return false;

    $cpt_slug = $cpt_object->name;

  //Make sure the taxonomy requested is actually related to the CPT
  if ( !in_array( $taxonomy, $cpt_object->taxonomies ) )
    return false;
       
  return home_url( $cpt_slug . '/' . $taxonomy . '/' . $term );
}

  /*
   * Call cc_get_the_cpt_tax_intersection_link and echo the result
   * 
   */
  function cc_the_cpt_tax_intersection_link( $post_type = false, $taxonomy = false, $term = false ){
    echo cc_get_the_cpt_tax_intersection_link( $post_type, $taxonomy, $term );
  }

// Restricted-content shortcodes. These are useful especially when content is generated via shortcode, like Gravity Forms
// Two basic levels: [loggedin] requires user to be logged in, [visitor] only shows to non-logged-in visitors
// More advanced uses WordPress capabilities to show content to admins only, etc.
// From Justin Tadlock: http://justintadlock.com/archives/2009/05/09/using-shortcodes-to-show-members-only-content

// Show contained to logged in only. Use in page or post content. 
// Takes the form: [loggedin message=''] content... [/loggedin] 
// "Message" attribute is optional. Will fall back to default. Specify message='' for no message.
add_shortcode( 'loggedin', 'cc_member_check_shortcode' );
function cc_member_check_shortcode( $atts, $content = null ) {

  extract( shortcode_atts( array( 'message' => 'You must be <a href="/wp-login.php" title="Log in to Community Commons">logged in</a> to view this content.' ), $atts ) );

  if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )
    return do_shortcode( $content );
  
  return $message;
}

// Show contained to visitors only. Use in page or post content. 
// Takes the form: [visitor] content... [/visitor]
// Not necessary as an else with [loggedin], the other shortcode's else provides a message and a login link.
add_shortcode( 'visitor', 'visitor_check_shortcode' );
function visitor_check_shortcode( $atts, $content = null ) {
   if ( ( !is_user_logged_in() && !is_null( $content ) ) || is_feed() )
    return do_shortcode( $content );
  
  return '';
}

// Show contained to users with specific capabilities only. Use in page or post content. 
// Takes the form: [access capability="switch_themes"] content... [/access]
add_shortcode( 'access', 'access_check_shortcode' );

function access_check_shortcode( $attr, $content = null ) {

  extract( shortcode_atts( array( 'capability' => 'read' ), $attr ) );

  if ( current_user_can( $capability ) && !is_null( $content ) && !is_feed() )
    return $content;

  return '';
}

// Show contained to users that are members of a group only. Use in group environment without an id (assumes current group) or with an id elsewhere. 
// Takes the form: [group_member group_id="3"] content... [/group_member]
add_shortcode( 'group_member', 'group_member_check_shortcode' );

function group_member_check_shortcode( $attr, $content = null ) {

  extract( shortcode_atts( array( 'group_id' => 0 ), $attr ) );
  // If no group id was specified, try to get the current group's id
  $group_id = ( $group_id ) ? $group_id : bp_get_current_group_id();

  if ( ( ( $group_id && groups_is_user_member( get_current_user_id(), $group_id ) ) ||current_user_can( 'activate_plugins' ) ) && !is_null( $content ) && !is_feed() )
    return $content;

  return '';
}

// Gravity Forms
// Autofill fields with the property 'logged_in_user_email'
add_filter('gform_field_value_logged_in_user_email', 'cc_gravity_form_user_email_populate');
function cc_gravity_form_user_email_populate(){
    $current_user = wp_get_current_user();

    if ( $current_user )
      return $current_user->user_email;
}

add_filter("gform_field_value_email", "ccsubscribe_populate_email");
function ccsubscribe_populate_email($value){
  $current_user = wp_get_current_user();
  $useremail = $current_user->user_email;
    return $useremail;
}

add_filter("gform_field_value_name", "ccsubscribe_populate_name");
function ccsubscribe_populate_name($value){
  $current_user = wp_get_current_user();
  $displayname = $current_user->display_name;
    return $displayname;
}

/* Group-specific modifications
/* Center for Disease Control -- CDC
***********************/
add_filter("gform_field_value_uuid", "cdc_gf_uuid");
function cdc_gf_uuid($value) {
  $uuid = md5(uniqid(mt_rand(), true));
    return $uuid;
}

function cdcdch_users() {
  if ( ! class_exists('RGFormsModel') )
    return;

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

/* Salud America related stuff 
********************************/
// Salud America isn't a group, but they need to play one on TV. So we're manually adding them to the top of the directory list.
add_action( 'cc_add_to_featured_hubs', 'stick_sa_to_the_top_of_the_directory' );
function stick_sa_to_the_top_of_the_directory( $shown_hubs ){
  
  if ( is_page( 'groups' ) || ( bp_is_user_groups() && get_user_meta( bp_displayed_user_id(), 'salud_interest_group', true) ) ) :
  ?>
      <li id="featured-group-salud-america">
        <div class="item-avatar">
          <a href="/salud-america/" title="Link to Salud America! space"><img width="50" height="50" class="avatar no-box" alt="avatar" src="/wp-content/themes/CommonsRetheme/img/salud_america/SA-logox50.png"></a>
        </div>

        <div class="item">
          <div class="item-title"><a href="/salud-america/" title="Link to Salud America! space">Salud America!</a></div>
          <div class="item-desc">
            <p>Working together to end Latino childhood obesity.</p>
          </div>   
        </div>
        <div class="clear"></div>
      </li>
  <?php
  endif;
}

/*
// Get taxonomy images for Salud
// Accepts category name and which taxonomy
// Uses cc_get_taxonomy_images()
// returns <div><img><h2> string, must be echoed
*/
function salud_get_taxonomy_images($category, $taxonomy){
  // Build the section header
  $cat_array = explode(",", $category);
  foreach ($cat_array as $single_cat) {
    $cat_object = get_term_by('slug', $single_cat, $taxonomy);
    $section_title_cats[] = $cat_object->name;
  }
  $section_title = implode(" &amp; ", $section_title_cats);
  
  $output .= '<div class="sa-resource-header-icon"><span>' . $section_title . '</span>';
  $output .= cc_get_taxonomy_images($cat_array[0], $taxonomy);
  $output .= '</div>';

  return $output;
}

/* Helper functions
***********************/
function bp_dump() {
    // global $bp;
    $bp = buddypress();
 
    foreach ( (array)$bp as $key => $value ) {
        echo '<pre>';
        echo '<strong>' . $key . ': </strong><br />';
        print_r( $value );
        echo '</pre>';
    }
    die;
}
// add_action( 'wp', 'bp_dump' );

function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return 'not found';
    }
}

// Analytics/Metrics work
// Provide the user's login name for use by Google Tag Manager
add_action( 'wp_header', 'cc_user_login_name_for_gtm', 77 );
function cc_user_login_name_for_gtm() {
  global $current_user;
  get_currentuserinfo();
  $user_login = !empty( $current_user->user_login ) ? $current_user->user_login : 'not logged in';
  ?>
  <script type="text/javascript">
   var cc_user_login = "<?php echo $user_login; ?>";
  </script>
  <?php
}

// Invite Anyone uses a check on the number of users to decide if it should build the list of users with checkboxes on the group's "send invites" page. The list is too long for us, but under WP's definition of a large network. So we filter the result to true.
add_filter( 'invite_anyone_is_large_network', 'change_ia_large_network_value', 22, 2 );
function change_ia_large_network_value( $is_large, $count ) {
  return true;
}

// Utility filter to see what's attached to a filter:
function cc_wp_show_hooked_filters(){
  $hook_name = 'comments_open';
  global $wp_filter;
  echo '<pre class="filter-dump">';
  var_dump( $wp_filter[$hook_name] );
  echo '</pre>';
}
// add_action( 'wp_head', 'cc_wp_show_hooked_filters' );