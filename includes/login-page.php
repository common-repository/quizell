<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if (!is_admin()) return ; 
if ( isset($_REQUEST['nonce']) ) {
    $nonce = sanitize_text_field($_REQUEST['nonce']);
    if (  wp_verify_nonce( $nonce, 'login-nonce' ) ) {
        //var_dump('sadasd');
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = sanitize_email($_POST['email']);
                $password = sanitize_text_field($_POST['password']);
                if(is_email($email))
                    quizell_post_login($email, $password);
                }
    } 
}
    $felanme = sanitize_text_field($_GET['callback']);
    $view =  $felanme.'-view.php';
     include_once $view;
function quizell_post_login(string $email, string $password)
{
    $access_token =  quizell_api_get_access_token($email, $password);
    if(!$access_token){
        $_SESSION['errors'] = [
            'api' => ["Email or password Incorrect."]
        ];        quizell_admin_redirect('login');

    }
    if($access_token){        quizell_upate_login_record($email, $password, $access_token);
       // echo 'redirecting';
        //var_dump($access_token);
        //quizell_admin_redirect('dashboard');
        quizell_admin_redirect_js('dashboard');
    }
    
 }

