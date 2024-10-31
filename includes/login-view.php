<?php    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 ?>
<div class="container-fluid ">
    <div class="row">
    <div class="col-md-6" style="padding-top: 21vh;">
            <div class="flex-column  d-flex justify-content-center align-items-center">
                <div class="width mt-5 ">
                    <h2 class="text-center mb-4">Welcome Back</h2>
                    <div class="custom_cta_button_holder">
                            <a href="<?php echo esc_url(admin_url('admin.php?page=quizell&callback=' . 'login')) ?>" class="active sign_in_btn">Sign In </a>
                            <a href="<?php echo esc_url(admin_url('admin.php?page=quizell&callback=' . 'signup')) ?>" class=" signupbtn">Sign Up</a>
                        </div>
                    <div class="errors text-right  font-weight-bold text-danger" >
                        <?php require_once 'display-errors.php'; ?>
                    </div>
                    <form  autocomplete="off" action="" class="" name="login_form" method="post">
                        <?php $nonce = wp_create_nonce( 'login-nonce' ); ?>
						   <?php //wp_nonce_field( 'qq_login_action','qq_login_nonce_jst' ); ?>
                           <?php wp_nonce_field( 'login-nonce', 'nonce' ); ?>
                           <!-- <input type="hidden" name="nonce" value="<?php //echo esc_html($nonce) ?>" /> -->

                        <div class="form-group">
                            <label for="signUpEmail">Enter your email address *</label>
                            <div class="w-100 d-flex justify-content-center align-items-center custom-input">
                                <input type="email" name="email" id="signUpEmail" class="input-form-control " placeholder="example@mail.com
                                    " required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="signUpPassword"
                                class="w-100 d-flex justify-content-between align-items-center"><span>Enter your
                                    password *
                                </span>
        
                            </label>
                            <div class="w-100 d-flex justify-content-between  align-items-center custom-input">
                                <input type="password" name="password"
                                    class="input-form-control" placeholder="Enter your password " required>
                                <div class="eye-btn" onclick="togglePassword(document.querySelector('#signUpPassword'))">
                                    <div class="mr-2" style="cursor: pointer;"><svg viewBox="0 0 16 16" width="1em"
                                            height="1em" focusable="false" role="img" aria-label="eye"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="bi-eye b-icon bi" style="color: rgb(209, 209, 209);">
                                            <g>
                                                <path fill-rule="evenodd"
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z">
                                                </path>
                                            </g>
                                        </svg></div>
                                </div>
                                <div class="d-none eye-btn"
                                    onclick="togglePassword(document.querySelector('#signUpPassword'))">

                                    <div class="mr-2" style="cursor: pointer;"><svg viewBox="0 0 16 16" width="1em"
                                            height="1em" focusable="false" role="img" aria-label="eye slash"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="bi-eye-slash b-icon bi" style="color: rgb(209, 209, 209);">
                                            <g>
                                                <path
                                                    d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z">
                                                </path>
                                                <path
                                                    d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z">
                                                </path>
                                                <path
                                                    d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"></path>
                                            </g>
                                        </svg></div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" id="login_butntssd" class="btn button-clr btn-block login-btn my-2" name="login_form" >Login</button>
                            <div class="d-flex justify-content-between align-items-center  ">
                    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6  p-0">
            <div class=" d-none d-md-flex justify-content-center align-items-center"
                style="background-color: #f6edff; height:100vh">
                <img class="w-100 h-100" src="<?php echo esc_url(plugin_dir_url( __DIR__ ).'images/sidebar-image.png') ?>" alt="">
            </div>
        </div>
    </div>
</div>