    <?php    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 ?>
 <style>

 </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6" style="padding-top: 21vh;">
                <div class="flex-column  d-flex justify-content-center align-items-center">
                    <div class="width">
                        <!-- <h2 class="text-center my-3  ">Welcome Back</h2> -->
                        <h2 class="text-center mt-3 ">Start Using Quizell</h2>
                        <div class="custom_cta_button_holder">
                            <a href="<?php echo esc_url(admin_url('admin.php?page=quizell&callback=' . 'login')) ?>" class="sign_in_btn">Sign In </a>
                            <a href="<?php echo esc_url(admin_url('admin.php?page=quizell&callback=' . 'signup')) ?>" class="active signupbtn">Sign Up</a>
                        </div>
                        <div class="alert alert-danger errors text-left  font-weight-bold my-5 d-none" id="errors-messages">
                        </div>
                        <?php require_once 'display-errors.php'; ?>
                        <form action="" class="" id="signUpForm" method="post">

                            <?php
                            // Output the nonce field within the form
                            //wp_nonce_field('signup_action', 'singup_nocne_dd_sftss_qq');

                            ?>
                                <?php //$nonce = wp_create_nonce( 'signup-nonce' ); ?>
						   <?php //wp_nonce_field( 'qq_login_action','qq_login_nonce_jst' ); 
                            
                           ?>
                              <?php wp_nonce_field( 'signup-nonce', 'nonce' ); ?>
 
                           <!-- <input type="hidden" name="nonce" value="<?php //echo $nonce ?>" /> -->
                            <div class="form-group">
                                <label for="signUpEmail isthis">Email Address *</label>
                                <div class="w-100 d-flex justify-content-center align-items-center custom-input">
                                    <input type="email" name="email" id="signUpEmail" class="input-form-control " placeholder="Enter your account email " required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="businessName">Business name *</label>
                                <div class="w-100 d-flex justify-content-center align-items-center custom-input">
                                    <input type="text" id="businessName" name="name" class="input-form-control" placeholder="Enter your business name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="signUpPassword" class="w-100 d-flex justify-content-between align-items-center"><span>Password *</span> <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="At least eight characters long
                                At least one lowercase letter<br>
                                 At least one uppercase letter<br>
                                 At least one number<br>
                                At least one special character<br>" data-bs-html="true"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" style="color: rgb(209, 209, 209);" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94" />
                                        </svg></span></label>
                                <div class="w-100 d-flex justify-content-between  align-items-center custom-input">
                                    <input type="password" name="password" onkeyup="checkpassword(this.value)" id="signUpPassword" class="input-form-control" placeholder="Enter your password" required>
                                    <div class="eye-btn" onclick="togglePassword(document.querySelector('#signUpPassword'))">
                                        <div class="mr-2" style="cursor: pointer;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" aria-label="eye" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-eye b-icon bi" style="color: rgb(209, 209, 209);">
                                                <g>
                                                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z">
                                                    </path>
                                                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z">
                                                    </path>
                                                </g>
                                            </svg></div>
                                    </div>
                                    <div class="d-none eye-btn" onclick="togglePassword(document.querySelector('#signUpPassword'))">

                                        <div class="mr-2" style="cursor: pointer;"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" aria-label="eye slash" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-eye-slash b-icon bi" style="color: rgb(209, 209, 209);">
                                                <g>
                                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z">
                                                    </path>
                                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z">
                                                    </path>
                                                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709z">
                                                    </path>
                                                    <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"></path>
                                                </g>
                                            </svg></div>
                                    </div>
                                </div>
                            </div>
                            <!--                            <div>-->
                            <!--                                <input type="checkbox" id="agree" required> <label for="agree">I agree with the <a class="text-decoration-none  text-clr" href="https://www.quizell.com/terms-and-condition#PP"><span class="font-size">Terms-->
                            <!--                                            & Conditions</span> </a></label>-->
                            <!--                            </div>-->
                            <div>
                                <button type="submit" class="btn button-clr btn-block login-btn my-2" id="submit-btn-js" name="register_form">Sign
                                    Up</button>
                                  <div class="d-flex justify-content-between align-items-center  ">
                           
</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-0 d-none d-md-block">
                <div class=" d-flex justify-content-center align-items-center" style="background-color: #f6edff; height:100vh">
                    <img class="w-100 h-100" src="<?php echo esc_url(plugin_dir_url( __DIR__ ).'images/sidebar-image.png') ?>" alt="">
                </div>
            </div>
        </div>
    </div>