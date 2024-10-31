<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly



if (isset($_SESSION['errors']) && $_SESSION['errors']) {
    //$erros = sanitze_text
    echo '<div class="alert alert-danger errors text-left  font-weight-bold my-5">';

    echo '<ul>';
    if(is_string($_SESSION['errors'])){
        $erroe = sanitize_text_field($_SESSION['errors']);
        echo '<li>' . esc_html(       $erroe) . '</li>';
    }else{
        if(is_array($_SESSION['errors'])){
        foreach ($_SESSION['errors'] as $field => $errorMessages) {
            foreach ($errorMessages as $errorMessage) {
                $errorMessage = sanitize_text_field($errorMessage);
                echo '<li>' . esc_html($errorMessage) . '</li>';
            }
        }
    }
    }
    echo '</ul>';
    unset($_SESSION['errors']);
    echo '</div>';
}
