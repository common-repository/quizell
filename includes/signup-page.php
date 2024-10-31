<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
if (!is_admin()) return ; 

// Do stuff. Say we will echo "Hello World".
//echo 'Hello World';
if (isset($_REQUEST['nonce'])) {
    $nonce = sanitize_text_field($_REQUEST['nonce']);
    if (wp_verify_nonce($nonce, 'signup-nonce')) {
        if (isset($_POST['register_form'])) {
            $name = sanitize_text_field($_POST['name']);
            $email = sanitize_email($_POST['email']);
            $password = sanitize_text_field($_POST['password']);
            if (is_email($email)) {
                $res = quizell_post_signup($name, $email, $password);
                if (isset($res['status']) && $res['status']) {
                    // redirect to verify otp
                    quizell_admin_redirect('verify-otp');
                } else {
                    $_SESSION['errors'] = $res['errors'] ?? [];
                }
            }
        }
    }
}


$view = sanitize_text_field($_GET['callback']) . '-view.php';
include_once $view;



function quizell_post_signup(string $name, string $email, string $password)
{
    $data = quizell_api_register($name, $email, $password);
    $response = array();
    $response['status'] = false;
    if (isset($data['access_token']) && $data['access_token']) {
        $response['status'] = true;
        $validatedToken = preg_replace('/[^a-zA-Z0-9-.]+/', '', $data['access_token']);
        $_SESSION['quizell_access_token'] = $validatedToken;
        quizell_upate_login_record($name, $email, $password);
    } else if (isset($data['errors']) && $data['errors']) {
        $response['errors'] = $data['errors'];
    } else {
        $response['errors'] = [
            'api' => ["Internal server Error",]
        ];
    }

    return $response;
}
