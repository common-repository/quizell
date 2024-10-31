<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Plugin Name: Quizell: AI-Powered Quizzes, Forms, and Product Recommendation Quiz for Enhanced Engagement
 * Plugin URI: https://app.quizell.com
 * Description: Quizell is an online E-commerce Quiz Generator that will increase your conversion rate, reduce return rate and improve your customer experience.
 * Author: Quizell
 * Author URI: https://quizell.com
 * Version: 1.5
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


if (!session_id()) {
    session_start();
}
const API_URL = 'https://api.quizell.com';
const USER_DASHBOARD_APP = "https://app.quizell.com";
// Create a tab in the admin dashboard
add_action('admin_menu', 'quizell_admin_menu');
//register_activation_hook(__FILE__, 'quizell_create_table');
register_deactivation_hook(__FILE__, 'quizell_deactivate');


function quizell_admin_menu()
{
    add_menu_page(
        'Quizell', // Page Title
        'Quizell',       // Menu Title
        'manage_options',    // Capability required to access
        'quizell',  // Menu Slug
        'quizell_root',   // Callback function to display the page content
        esc_url( plugins_url('/images/quizell-icon.png', __FILE__)), // Icon class (use your custom icon's class or Dashicons class)
        20                    // Position in the menu
    );
}
function quizell_deactivate()
{
    //logout user
    quizell_destory_login_user();
}

//api related functions
require_once(dirname(__FILE__) . '/api-calls.php');

//main page
require_once(dirname(__FILE__) . '/includes/root-page.php');


function quizell_enqueue_custom_assets() {

    // Check if the current screen is your plugin page
    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'quizell') {
        wp_enqueue_style('bootstrap', esc_url( plugins_url('/assets/style/bootstrap.min.css', __FILE__)), array(), '0.1.0');
        wp_enqueue_style('custom-style',esc_url( plugins_url('/assets/style/style.css', __FILE__)), array(), '2.0');
        //wp_enqueue_script('bootstrap-bundle',esc_url( plugins_url('/assets/js/bootstrap.bundle.min.js', __FILE__)), array('jquery'), '', true);
        wp_enqueue_script('login-js', esc_url( plugins_url('/assets/js/script.js', __FILE__)), array('jquery'), '1.0', true);
    }
}
add_action('admin_enqueue_scripts', 'quizell_enqueue_custom_assets');
function quizell_custom_scripts_enqueue() {
    wp_enqueue_script('custom-script', esc_url(plugins_url('../js/quizell-script.js', __FILE__)), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'quizell_custom_scripts_enqueue');

function quizell_admin_redirect(string $page_name)
{
    
    wp_safe_redirect(admin_url('admin.php?page=quizell&callback=' . $page_name));
    die;
}
function quizell_admin_redirect_js(string $page_name)
{
    ?>
    <script>window.location.href='<?php echo esc_html(admin_url('admin.php?page=quizell&callback=' . $page_name)) ?>'</script>
    <?php
    //wp_safe_redirect();
    die;
}
function quizell_upate_login_record(string $email, string $password, string $access_token, bool $isVerified = false)
{
    $_SESSION['quizell_is_verified'] = $isVerified;
    global $wpdb;
    $data = array(
        'email' => $email,
        'password' => $password,
        'access_token' => $access_token,
        'is_verified' => $isVerified,
    );
    //var_dump( wp_json_encode($data));
    if (update_option('quizell_login', wp_json_encode($data))) {
        return true;
    } else {
        //echo 'Error: ' . esc_js( $wpdb->last_error); // Echo the error
        return false;
    }
}

function quizell_delete_login_records(){

    delete_option('quizell_login');
    delete_option('quazilla_access_toekn');
}

function quizell_get_current_user(){
    $latest_record = json_decode(get_option('quizell_login'), true);
    $_SESSION['quizell_is_verified'] = $latest_record['is_user_verified'];
    return $latest_record;
}

function quizell_db_unverify_user(){
    $_SESSION['quizell_is_verified'] = false;
   $latest_record = json_decode(get_option('quizell_login'), true);
   if($latest_record['is_user_verified'] == 1){
    $data = array(
        'email' => $latest_record['email'] ,
        'password' => $latest_record['password'] ,
        'access_token' => $latest_record['access_token'] ,
        'is_verified' => 0,
    );
}
//var_dump( wp_json_encode($data));
    $test = update_option('quizell_login', wp_json_encode($data));
}

function quizell_db_verify_user(){
    $_SESSION['quizell_is_verified'] = true;
    $latest_record = json_decode(get_option('quizell_login'), true);
    
    //if($latest_record['is_user_verified'] == 0){
     $data = array(
         'email' => $latest_record['email'] ,
         'password' => $latest_record['password'] ,
         'access_token' => $latest_record['access_token'] ,
         'is_verified' => 1,
     );
    //}
    //var_dump( wp_json_encode($data));
     $test = update_option('quizell_login', wp_json_encode($data));
}

function quizell_is_current_user_verified(){
    $latest_record = json_decode(get_option('quizell_login'), true);
    if(isset($latest_record['is_verified']) &&  $latest_record['is_verified'] == 1){
        return true;
    }
	else{
		return false;
	}
}


function quizell_destory_login_user(){
    unset($_SESSION['quizell_access_token']);
    unset($_SESSION['quizell_is_verified']);
    quizell_delete_login_records();
}


function quizell_is_verified_route(){
    $verified_routes = [
        'dashboard',
    ];
    return in_array(quizell_get_route(), $verified_routes);
}
add_action('wp_ajax_update_sp_sl_woo_quizell_connect', 'sp_sl_quizell_update_coonect_woo_data');
function sp_sl_quizell_update_coonect_woo_data(){
    $data_nonce = sanitize_text_field($_REQUEST['data_nnonce']);
    if(wp_verify_nonce($data_nonce, 'ubmit_woo_quizell_connect')){
        $array = array(
            'saved' => 'no'
        );
        //$array['on'] = 'asdsad';
        $consumer_key =  sanitize_text_field($_REQUEST['consumer_key']);
        $consumer_secret =  sanitize_text_field($_REQUEST['consumer_secret']);
        $store_url = sanitize_url($_REQUEST['store_url']);
        if(   $consumer_key == '' ||   $consumer_secret ==  '' ||       $store_url == ''){
            $array['error'] = 'All Fields are Mandatory';
        }
        else{
            $data = quizell_woo_zx_coonect_sp_sl_da($consumer_key, $consumer_secret, $store_url);
            $array['dumpdata'] = $data;
            if(isset($data['ok']) && $data['ok'] == true && isset($data['connection_id'])){
                update_option('quizell_woo_sp_sl_key',         $consumer_key );
                update_option('quizell_woo_sp_sl_secret',         $consumer_secret );
                update_option('quizell_woo_sp_sl_store_url',         $store_url );
                update_option('quizell_woo_sp_sl_connection_id',        sanitize_text_field($data['connection_id']) );
                $array['on'] = 'Connection Saved';
                $array['saved'] = 'Yes';
            }
            else{
                //$array['on'] = $data;
            }

        }
        //echo 'yes';
    }
    wp_send_json( $array );
    wp_die();
}
