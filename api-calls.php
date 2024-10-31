<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function quizell_api_get_access_token(string $email, string $password)
{
    $form_data = array(
        'email' => $email,
        'password' => $password,
    );

    $params = array(
        'body' => $form_data,
    );

    // Make the request
    $response = wp_remote_post(API_URL . '/login', $params);

    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
        $data = wp_remote_retrieve_body($response);
        $decoded_data = json_decode($data, true);
		$validatedToken = preg_replace('/[^a-zA-Z0-9-.]+/', '', $decoded_data['access_token']);
		//$validatedToken = $decoded_data['access_token'];
        update_option('quazilla_access_toekn', $validatedToken);
        //update_option('quazilla_access_toekn', $decoded_data['access_token']);
        //$_SESSION['access_token'] = $decoded_data['access_token'];
        return $validatedToken;
    } else {
        return false;
    }
}

function quizell_api_register(string $name, string $email, string $password)
{

    $form_data = array(
        'name' => $name,
        'email' => $email,
        'password' => $password,
    );

    $params = array(
        'body' => $form_data,
        'timeout' => 999999,
    );

    $response = wp_remote_post(API_URL . '/wordpress/register', $params);

    $data = wp_remote_retrieve_body($response);
    $decoded_data = json_decode($data, true);
    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
		$validatedToken = preg_replace('/[^a-zA-Z0-9-.]+/', '', $decoded_data['access_token']);
				//$validatedToken = $decoded_data['access_token'];
        update_option('quazilla_access_toekn', $validatedToken);
        //$_SESSION['access_token'] = $decoded_data['access_token'];
        return [
            'access_token' => $validatedToken,
        ];
    } else {

        if (isset($decoded_data['message']) && $decoded_data['message']) {
            return [
                'errors' => $decoded_data['message'],
            ];
        }
        return false;
    }
}

function quizell_woo_zx_coonect_sp_sl_da(string $key, string $secret, string $store_url)
{
    $headers = [
        'Authorization' => 'Bearer ' . get_option('quazilla_access_toekn')
    ];
    $form_data = array(
        'app_id' => 11,
        'api_key' => $key,
        'list_key' => $secret,
        'other_key' => $store_url,
        'full_status' => false
    );

    $params = array(
        'headers' => $headers,
        'body' => $form_data,
    );

    $response = wp_remote_post(API_URL . '/integrationConnectionSave', $params);

    $data = wp_remote_retrieve_body($response);
    $decoded_data = json_decode($data, true);
    //return $decoded_data;
    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
        return $decoded_data;
    } else {

        if (isset($decoded_data['message']) && $decoded_data['message']) {
            return [
                'errors' => $decoded_data['message'],
            ];
        }
        return false;
    }
}


function quizell_api_validate_token(string $token)
{
    $request_args = [
        'headers' => [
            'Authorization' => 'Bearer ' . $token,
        ],
    ];

    $response = wp_remote_post(API_URL . '/wordpress/get-current-user', $request_args);
    $response_code = wp_remote_retrieve_response_code($response);
    $data = wp_remote_retrieve_body($response);
    //var_dump(    $data);
    if ($response_code == 401) {
        return false;
    }
    if ($response_code != 200) {
        /* display error */
        //echo "display error";
        //quizell_dd($data,$response_code);
    }

    $data = json_decode($data, true)['data'];

    if(quizell_is_current_user_verified() != $data['is_verified'] ){

        if (isset($data['is_verified']) && $data['is_verified'] == false) {
            quizell_db_unverify_user();
        } else {
            quizell_db_verify_user();
        }

    }

    return true;
}

function quizell_api_verify_otp(string $optCode)
{

    $headers = [
        'Authorization' => 'Bearer ' . get_option('quazilla_access_toekn')
    ];

    $body = array(
        'otp_code' => $optCode,
    );

    $args = array(
        'headers' => $headers,
        'body' => $body, // Encode the body data as JSON if required
    );

    $response = wp_remote_post(API_URL . '/verify-otp', $args);

    if (is_wp_error($response)) {
        echo "Error: " . esc_html($response->get_error_message());
        die;
    } else {
        $data = wp_remote_retrieve_body($response);
        $decoded_data = json_decode($data, true);
        if (isset($decoded_data['status']) && $decoded_data['status'] == false) {
            return false;
        } elseif(isset($decoded_data['access_token']) && $decoded_data['access_token'] ) {
            return true;
        }
    }
}

function quizell_resend_otp()
{

    $headers = [
        'Authorization' => 'Bearer ' . get_option('quazilla_access_toekn'),
    ];

    $args = array(
        'headers' => $headers,
        'timeout' => 999999,
    );

    $response = wp_remote_post(API_URL . '/resend-otp', $args);

    if (is_wp_error($response)) {
        echo "Error: " . esc_html($response->get_error_message());
        die;
    } else {
        $data = wp_remote_retrieve_body($response);
        $decoded_data = json_decode($data, true);

        return $decoded_data['data']['email_sent'];
    }
}

function quizell_deactivate_account()
{

    $headers = [
        'Authorization' => 'Bearer ' . get_option('quazilla_access_toekn'),
    ];

    $args = array(
        'headers' => $headers,
        'timeout' => 999999,
    );

    $response = wp_remote_post(API_URL . '/user/deactivate-account', $args);

    if (is_wp_error($response)) {
        echo "Error: " . esc_html($response->get_error_message());
        die;
    }
}