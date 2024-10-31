<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
if (isset($_REQUEST['nonce'])) {
    $nonce = sanitize_text_field($_REQUEST['nonce']);
    if (wp_verify_nonce($nonce, 'verifyotp-nonce')) {
        if (isset($_POST['verify_otp_form'])) {
            //check_admin_referer( 'qq_login_action', 'qq_login_nonce_jst' )

                $otp_code1 = sanitize_text_field($_POST['otp_code1']);
                $otp_code2 = sanitize_text_field($_POST['otp_code2']);
                $otp_code3 = sanitize_text_field($_POST['otp_code3']);
                $otp_code4 = sanitize_text_field($_POST['otp_code4']);
                $otp_code5 = sanitize_text_field($_POST['otp_code5']);
                $otp_code6 = sanitize_text_field($_POST['otp_code6']);
                $max__otp =      $otp_code1 . $otp_code2. $otp_code3. $otp_code4. $otp_code5.      $otp_code6;
                $otp_code = (int)$max__otp;
                //validation
                if(is_numeric($otp_code))
                    quizell_post_verify_otp($otp_code);
            }
        }
}

if (quizell_is_current_user_verified()) {
    quizell_admin_redirect('dashboard');
}
$dname = sanitize_text_field($_GET['callback']);
$view = $dname . '-view.php';
include_once $view;


function quizell_post_verify_otp(string $otp_code)
{
    $status = quizell_api_verify_otp($otp_code);
    if ($status) {
        quizell_db_verify_user();
        quizell_admin_redirect('dashboard');
    } else {
        $_SESSION['errors'] = [
            'api' => ["Otp Code is not Valid."]
        ];
        quizell_admin_redirect(sanitize_text_field($_GET['callback']));
    }
}
