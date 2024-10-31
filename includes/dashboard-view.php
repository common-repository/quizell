<?php    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly\
// /var_dump(quizell_check_if_api_form_has_been_submitted())
$show_form_ = false;
if(!quizell_check_if_api_form_has_been_submitted()){
    // /echo 'hi';
    $show_form_ = true;
}
    require_once(dirname(__FILE__) . '/connect-page.php');
    $newa = '';
if($show_form_ == true){
    $newa = 'hide_this_now';
}
 ?>
<div class="main_dash_sec <?php echo esc_html($newa) ?>">
<style>
        body {
            background-color: #F6F6F7;
        }

        .items {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* flex-wrap: wrap; */
            margin: 0;
            gap: 20px;
            border-radius: 12px;

            border: none;
        }

        .sm-box:hover {
            color: #38165a;
            text-decoration: none;
        }

        .sm-box:focus {
            outline: 2px solid #38165a;

        }

        .sm-box {

            display: flex;
            /*min-width: 170px; !* Adjust the value as per your requirement *!*/
            min-height: 40px;
            text-wrap: nowrap;
            padding: 10px 20px; /* Adjust the padding as needed */
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            color: #4D1B7E;
            border-radius: 8px;
            background: rgba(77, 27, 126, 0.10);
        }

        .sm-box {
            /*padding: 10px; !* Adjust the padding for small screens *!*/
            font-size: 12px !important; /* Adjust the font size for small screens */
        }

        .card-description{

            font-size: small;
        }
        .text-size{
            font-size: 17px;
        }


        .card {
            transition: 0.3s ease all;
        }

        .card:hover {
            box-shadow: 1px 0px 6px 1px #cbc4c4;
        }
        .text-size{
            font-size: 18px;
            font-weight: 600;
            color: #1F1F28;
        }
    </style>
<input type="hidden" id="jwt_access_token" value="<?php echo esc_html(quizell_access_token()); ?>">
<div class="container">
    <div class="">
        <h1>Home</h1>
        <p>Help your customers to select the right products with our quizzes</p>
    </div>
    <div class="row " id="q-row">

    </div>
    <div class="py-5">
        <h1>Setting</h1>
        <p>Help your customers to select the right products with our quizzes</p>
    </div>
    <div class="row" id="setting"></div>
</div>
<script>

    function getRedirectToPath(path) {
        const token = document.getElementById("jwt_access_token").value;
        let fullPath = "<?php echo esc_html(USER_DASHBOARD_APP); ?>/login?" + path + token;
        return fullPath;
    }

    const row = document.getElementById('q-row');
    const settigRow=  document.getElementById('setting');
        const columnItems = [{
            image: '<?php echo esc_url(plugins_url( '../images/Frame 4.svg', __FILE__ )); ?>',
        heading: 'Create a new Quizz',
        description: ' Let\'s create a new quiz to help your customers find the perfect product.',
        link: {
            text: '+ Create',
            href: getRedirectToPath('page=/manage/create-quiz&token=')
        },
    },
        {
            image: '<?php echo esc_url( plugins_url( '../images/Frame 5 (1).svg', __FILE__ )); ?>',
            heading: 'Manage products',
            description: ' Add or remove products to feature in your quizzes.',
            link: {
                text: 'Go to products',
                href: getRedirectToPath('page=/manage/products&token=')
            },
        },
        {
            image: '<?php echo esc_url( plugins_url( '../images/Frame 5 (2).svg', __FILE__ )); ?>',
            heading: 'View your quizzes',
            description: 'Manage your quizzes in one place.',
            link: {
                text: 'See Quizzes',
                href: getRedirectToPath('page=/manage/quizzes&token=')
            },
        },
        {
            image: '<?php echo esc_url( plugins_url( '../images/Frame 5 (5).svg', __FILE__ )); ?>',
            heading: 'Get support',
            description: 'Need help? Our support team is here to assist you.',
            link: {
                text: 'Go to support',
                href: 'https://support.quizell.com/'
            },
        },
        {
            image: '<?php echo esc_url(plugins_url( '../images/Frame 5 (4).svg', __FILE__ )); ?>',
            heading: 'Integrations',
            description: ` Connect Quizell with your favorite apps and tools to streamline your
                                            workflow.`,
            link: {
                text: 'Set Integrations',
                href: getRedirectToPath('page=/integrations/list&token=')
            },
        },

        {
            image: '<?php echo esc_url( plugins_url( '../images/Frame 5 (6).svg', __FILE__ )); ?>',
            heading: 'Manage Profile',
            description: 'Manage your Quizell account and personal information.',
            link: {
                text: 'Your profile',
                href: getRedirectToPath('page=/manage/account/user_profile&token=')
            },


        },

    ];
    const settingColumnItems=[ {
        image: '<?php echo esc_url( plugins_url( '../images/Frame 5 (8).svg', __FILE__ )); ?>',
        heading: 'View setting',
        description: `Set up advanced settings for campaign and affiliate accounts`,
        link: {
            text: 'View setting',
            href: getRedirectToPath('page=/manage/account/user_profile&token=')
        },
    },
        {
            image: '<?php echo esc_url( plugins_url( '../images/Frame 5 (9).svg', __FILE__ )); ?>',
            heading: 'Pricing',
            description: 'Check pricing and unlock advanced features',
            link: {
                text: 'View setting',
                href: 'https://www.quizell.com/pricing'
            },
        }]
    addColumns(row,columnItems);
    addColumns(settigRow,settingColumnItems);
    function addColumns(qRow,column) {
        qRow.innerHTML = '';
        column.forEach(column => {
            qRow.innerHTML += `<div class="col-lg-6">
    <div class="card border-white px-0 px-sm-3 col-12">
        <div class="card-body  flex-sm-column">
            <div class="items ">
                <div class="d-flex align-items-center ">
                    <div class="" >
                        <img src="${column.image}" alt="">
                    </div>
                    <div class="pl-3 heading-desc">
                        <h4 class="text-size" onclick="RedirectToPath('page=/manage/account/user_profile&token=')">${column.heading}</h4>
                        <span class="card-description">${column.description}</span>
                    </div>
                </div>
                <div class="flex-sm-column">
                    <a class="sm-box" href="${column.link.href}" target="_blank">${column.link.text}</a>
                </div>
            </div>
        </div>
    </div>
</div>`;
        });
    }
</script>
</div>
<?php
