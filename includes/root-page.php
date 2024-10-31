<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function quizell_root()
{
    //var_dump(quizell_access_token());
    //ini_set('display_errors',0);
    //wp_redirect('http://localhost/plugin2/wp-admin/');
    //die();
    quizell_auth_middleware();
    quizell_guest_middleware();
    quizell_router();
}

function quizell_auth_middleware()
{

    $protected_routes = [
        'dashboard',
        'verify-otp',
    ];
    //var_dump('reading_this');

    if (in_array(quizell_get_route(), $protected_routes)) {

        $token = quizell_access_token();
        
        if(quizell_api_validate_token($token)){

            if(!quizell_is_current_user_verified() && quizell_is_verified_route()){
                quizell_admin_redirect('verify-otp');
            }


        } else {
            //var_dump('reading_this');
            //echo $token;
            //var_dump(quizell_api_validate_token($token));
            //exit();
            quizell_destory_login_user();
            quizell_admin_redirect('signup');
        }
    }


}

function quizell_guest_middleware()
{
    $protected_routes = [
        'login',
        'signup',
    ];

    if (in_array(quizell_get_route(), $protected_routes)) {

        $token = quizell_access_token();

        if ($token) {
            quizell_admin_redirect('dashboard');
        } else {
            quizell_destory_login_user();
        }
    }
}

function quizell_router()
{
    $route = quizell_get_route();
    if ($route == "") {
        quizell_admin_redirect('dashboard');
    }
    //$route =    $route);
    $file_path = dirname(__FILE__) . "/$route-page.php";

    if (file_exists($file_path)) {
        require_once($file_path);
    } else {
        echo "File Missing";
    }
}

function quizell_get_route()
{
    return isset($_GET['callback']) && $_GET['callback'] ? sanitize_text_field($_GET['callback']) : "";
}

function quizell_access_token()
{
    $access_token = isset($_SESSION['quizell_access_token']) && $_SESSION['quizell_access_token'] ? $_SESSION['quizell_access_token'] : false;

    if (!$access_token) {
        $access_token = quizell_token_from_db();
    }

    return  $access_token;
}

function quizell_token_from_db()
{
   // global $wpdb;
    //$table_name = $wpdb->prefix . 'quizell_login';

    //$query = "SELECT * FROM $table_name ORDER BY id DESC LIMIT 1";
    //$latest_record = $wpdb->get_row($query, ARRAY_A);

    //if ($latest_record) {
        //$_SESSION['quizell_access_token'] = $latest_record['access_token'];
        //return $latest_record['access_token'];
    //} else {
        //return false;
    //}
    //$latest_record = json_decode(get_option('quizell_login'), true);
    $accestoken = get_option('quazilla_access_toekn');
    return $accestoken;
}

