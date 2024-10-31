<?php 
if (!defined('ABSPATH')) exit; // Exit if accessed directly

if(quizell_resend_otp()){
    quizell_admin_redirect('verify-otp');
}else{
    quizell_admin_redirect('dashboard');
}