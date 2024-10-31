<?php    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 ?>    
    <div class="container-fluid ">
        <div class="row">
        <div class="col-md-6" style="padding-top: 21vh;">
                <div class="flex-column  d-flex justify-content-center align-items-center">
              
                    <div class="width mt-5 ">
                        <h2 style="margin-bottom:7px !important" class="text-center mb-4">OTP Verification</h2>
                        <p style="text-align:center; color:#80807F">Enter the verification code we just sent to your email</p>
                        <div class="alert alert-danger errors text-left font-weight-bold my-5 d-none" id="errors-messages">
                        </div>
                        <?php require_once 'display-errors.php'; ?>

                        <form method="post" id="verify-otp-form-js">
                            <?php
                            // Output the nonce field within the form
                          //  wp_nonce_field('verify_otp_action', 'verify_notify_nocne_sftsss');
                            ?>
                             <?php wp_nonce_field( 'verifyotp-nonce', 'nonce' ); ?>
                            <!-- <div class="form-group">
                                <label for="signUpEmail">OTP</label>
                                <div class="w-100 d-flex justify-content-center align-items-center custom-input">
                                    <input type="number" name="otp_code" class="input-form-control " placeholder="enter 6-digit otp" required>
                                </div>
                            </div> -->
<div class="tp_controller">
                            <input  type="text"
            inputmode="numeric" name="otp_code1" class="otp_code input-form-control" placeholder="" required minlength="1" maxlength="1">
<input  type="text"
            inputmode="numeric" name="otp_code2" class="otp_code inputnumcsut input-form-control" placeholder="" required minlength="1" maxlength="1">
<input  type="text"
            inputmode="numeric" name="otp_code3" class="otp_code inputnumcsut input-form-control" placeholder="" required minlength="1" maxlength="1">
<input  type="text"
            inputmode="numeric" name="otp_code4" class="otp_code inputnumcsut input-form-control" placeholder="" required minlength="1" maxlength="1">
<input  type="text"
            inputmode="numeric" name="otp_code5" class="otp_code inputnumcsut input-form-control" placeholder="" required minlength="1" maxlength="1">
<input  type="text"
            inputmode="numeric" name="otp_code6" class="otp_code inputnumcsut input-form-control" placeholder="" required minlength="1" maxlength="1"></div>
<script>
  let otpFields = document.querySelectorAll('.otp_code');

document.addEventListener('paste', function (e) {
    let clipboardData = e.clipboardData || window.clipboardData;
    let pastedData = clipboardData.getData('Text');

    // If the pasted data is not a 6-digit number, ignore it
    if (!/^\d{6}$/.test(pastedData)) return;

    // Distribute the pasted data to the input fields
    for (let i = 0; i < otpFields.length; i++) {
        otpFields[i].value = pastedData[i];
    }
});

    window.onload = function () {
  var inputs = document.getElementsByClassName('input-form-control');

  for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('input', function () {
      if (this.value.length >= this.maxLength) {

        var nextInput = this;
        while (nextInput = nextInput.nextElementSibling) {
          if (nextInput == null)
           //inputs[i].blur();
            break;
          if (nextInput.tagName.toLowerCase() === "input") {
            nextInput.focus();
            break;
          }
        }
      }
    });
  }
};
</script>
                            <div>
                                <button type="submit" class="btn button-clr btn-block login-btn my-2" name="verify_otp_form" id="verify-submit-btn">Verify Otp</button>
                                <div class="d-flex justify-content-between align-items-center  ">
                                    <span class=""> <a href="<?php echo esc_url(admin_url('admin.php?page=quizell&callback=' . 'resend-otp')) ?>" class="text-clr text-black-50 " id="resend-email-js">Resend Email</a> </span>
                                    <!--                                <span class=""> <a href="--><?php //echo admin_url('admin.php?page=quizell&callback=' . 'logout') 
                                                                                                    ?><!--"-->
                                    <!--                                                   class="text-clr text-black-50 ">change account</a> </span>-->

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6  p-0">
                <div class=" d-none d-md-flex justify-content-center align-items-center" style="background-color: #f6edff; height:100vh">
                <img class="w-100 h-100" src="<?php echo esc_url(plugin_dir_url( __DIR__ ).'images/sidebar-image.png') ?>" alt="">
                </div>
            </div>
        </div>
    </div>
