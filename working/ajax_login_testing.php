<?php 

//Testing AJAX
add_action('wp_ajax_nopriv_do_ajax', 'our_ajax_function');
add_action('wp_ajax_do_ajax', 'our_ajax_function');
function our_ajax_function(){
// the first part is a SWTICHBOARD that fires specific functions
   // according to the value of Query Var 'fn'
 
     switch($_REQUEST['fn']){
          case 'get_latest_posts':
               $output = ajax_get_latest_posts($_REQUEST['count']);
          break;
          default:
              $output = 'No function specified, check your jQuery.ajax() call';
          break;
 
     }
 
   // at this point, $output contains some sort of valuable data!
   // Now, convert $output to JSON and echo it to the browser 
   // That way, we can recapture it with jQuery and run our success function
 
          $output=json_encode($output);
         if(is_array($output)){
        print_r($output);   
         }
         else{
        echo $output;
         }
         die;
}
function ajax_get_latest_posts($count){
     $posts = get_posts('numberposts='.$count);
     return $posts;
}

function ajax_login_init(){

    wp_register_script('ajax-login-script', get_stylesheet_directory_uri() . '/ajax-login-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-login-script');

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    // add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    // add_action('init', 'ajax_login_init');
}

function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
    }

    die();
}