<?php    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly\ 
  $class="";
    if($show_form_ == false){
        $class="hide_this_now";
    }
?>
<div class="formsectionall <?php echo esc_html($class) ?>">
<style>
    .hide_this_now{
        display: none ;
    }
.page_container {
    background: #ffffff !important;
    display: block;
    width: 100%;
    height: 100%;
    padding: 100px;
    text-align: center;
    height: 100VH;
}
.content {
    max-width: 450px !important;
    margin: auto;
}
.the_image {
    max-width: 450px !important;
}
.heading_asas h1 {
    font-size: 28px;
    font-weight: bold;
}
.heading_asas {
    margin-top: 50px;
}
a#show_form_sec:hover,input#btn_actual_subit:hover {
    background: #000;
    /* color: #4D1B7E; */
}
a#show_form_sec {
    background: #4D1B7E;
    border-radius: 19px !important;
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    margin-top: 20px;
    transition: .2s;
    transition-property: all;
    display: inline-block;
    padding: 11px 30px;
}
.input_group {
    display: grid;
    /* align-items: flex-start; */
    justify-items: flex-start;
    margin: 20px 0px;
}
.input_group input {
    width: 100%;
    padding: 7px 10px;
    border-radius: 9px;
    border: 1px solid #000;
}
form#submit_woo_quizell_connect_data {
    margin-top: 50px;
}
.input_group label{
    color:#73738D;
}
input#btn_actual_subit {
    /* display: flex; */
    /* flex-direction: row; */
    /* justify-content: center; */
    /* align-items: center; */
    padding: 6px 0px;
    background: #4D1B7E;
    border-radius: 100px;
    color: #fff;
    text-decoration: none;
    font-size: 20px;
    margin-top: 50px;
    transition: .2s;
    transition-property: all;
    width: 220px;
    /* justify-content: flex-end; */
    float: right;
}
.clear{
    clear:both;
}
a#skip_woo_quizell_connect {
    float: left;
    margin-top: -50px;
    color:#73738D;
    text-decoration: none;
}
p#error_message {
    color: #4d1b7e;
    font-weight: bold;
    text-align: left;
    text-decoration: underline;
}
.\33 _image {
    display: grid;
    grid-template-columns: auto auto auto;
    justify-content: center;
    align-content: center;
    align-items: center;
    margin: 50px 0px;
}
</style>
<div class="page_container">
    <div class="content">
        <div class="gapper">
            <div class="the_image">

                <div class="3_image">
                <img  style="max-width: 100%;" class="" src="<?php echo esc_url(plugin_dir_url( __DIR__ ).'images/Group 69213.png') ?>" alt="">
                <img class="" src="<?php echo esc_url(plugin_dir_url( __DIR__ ).'images/Group 69220.png') ?>" alt="">
                <img style="    margin-left: 20px; max-width: 80%;" class="" src="<?php echo esc_url(plugin_dir_url( __DIR__ ).'images/Group 69280.png') ?>" alt="">
                </div>
            </div>
            <div class="heading_asas">
                <h1>Connect your Woocommerce</h1>
                <a id="show_form_sec" href="#">Authorize to Woocommerce</a>
            </div>
         
        </div>

        <div style="display:none" id="form_section">
        <div class="heading_asas">
                <h1>Add your Woocommerce Details</h1>
                <span>Not sure how o find his details? <a target="_blank" href="https://support.quizell.com/blogs/integrations/how-to-connect-wordpress-to-quizell" class="" href="#">check here</a></span>
                <form id="submit_woo_quizell_connect_data" action="" method="post" name="submit_woo_quizell_connect_data">
                <p id="error_message"></p>
                    <div class="input_group">
                        <label for="consumer_key_woo_quizell_connect_key">CONSUMER KEY</label>
                        <input type="text" id="consumer_key_woo_quizell_connect_key" name="consumer_key_woo_quizell_connect_key" placeholder="KEY" />
                    </div>

                    <div class="input_group">
                        <label for="consumer_key_woo_quizell_connect_secret">CONSUMER SECRET</label>
                        <input type="text" id="consumer_key_woo_quizell_connect_secret" name="consumer_key_woo_quizell_connect_secret" placeholder="Consumer secret" />
                    </div>

                    <div class="input_group">
                        <label for="consumer_key_woo_quizell_connect_store_url">STORE URL</label>
                        <input type="url" id="consumer_key_woo_quizell_connect_store_url" name="consumer_key_woo_quizell_connect_store_url" placeholder="Store URL" />
                    </div>
                    <input type="hidden" id="data_nonce" name="data_nonce" value="<?php echo esc_html(wp_create_nonce( 'ubmit_woo_quizell_connect'));?> " />
                    <input type="submit" value="Save" id="btn_actual_subit" />
                </form>
                <p class="clear"></p>
                <a href="#" id="skip_woo_quizell_connect">SKIP</a>
                <p class="clear"></p>
            </div>
        </div>
    </div>
</div>
<script>
    // /wp_verify_nonce( $nonce, "delete_post-{$_REQUEST['post_id']}" );
    jQuery(document).ready(function($) {
        $('#show_form_sec').on('click', function(){
            $('.gapper').hide();
            $('#form_section').show();
        });
        $('a#skip_woo_quizell_connect').on('click', function(){
            $('.formsectionall').hide();
            $('.main_dash_sec').show();
        });

    $('#submit_woo_quizell_connect_data').submit(function(e){
        e.preventDefault();
        var data_nnonce = $('#data_nonce').val();
        var consumer_key = $('#consumer_key_woo_quizell_connect_key').val();
        var consumer_secret = $('#consumer_key_woo_quizell_connect_secret').val();
        var store_url = $('#consumer_key_woo_quizell_connect_store_url').val();
        $.ajax({
            url: '<?php echo esc_url(admin_url('admin-ajax.php')) ?>',
            type: 'POST',
            dataType    : 'json',
            data: {
                action: 'update_sp_sl_woo_quizell_connect',
                data_nnonce: data_nnonce,
                consumer_key: consumer_key,
                consumer_secret: consumer_secret,
                store_url: store_url
            },
            success: function(response) {
               console.log(response);
               if(response.error){
                $('#error_message').html(response.error);
                return;
               }
               if(response.saved == 'Yes'){
                $('#error_message').html(response.dumpdata.message);
                location.reload();
               }
               else{
                $('#error_message').html(response.dumpdata.message);
               }
            }
        });
    });
});
</script>
</div>