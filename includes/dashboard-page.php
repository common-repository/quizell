<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if(is_admin()){
$view = sanitize_text_field($_GET['callback']).'-view.php';
include_once $view;
}
function quizell_check_if_api_form_has_been_submitted(){
    //$user_id = get_current_user_id();
    if(get_option('quizell_woo_sp_sl_key') == "" || get_option('quizell_woo_sp_sl_secret') == ""){
        return false;
    }
    if(get_option('quizell_woo_sp_sl_store_url') == "" || get_option('quizell_woo_sp_sl_connection_id') == ""){
        return false;
    }
    return true;
}