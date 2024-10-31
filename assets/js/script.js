function checkpassword(value) {
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}|:"<>?~`-]).{8,}$/;
    const isValidPassword = passwordRegex.test(value);

    // if (isValidPassword) {
    //     document.querySelector('.login-btn').disabled = false
    // } else {
    //     document.querySelector('.login-btn').disabled = true
    // }
}
function togglePassword(inputElement) {
    const eyeElements = document.querySelectorAll('.eye-btn')
    eyeElements.forEach(eye => {
        eye.classList.toggle('d-none')
    })
    // currentElement.classList.toggle('d-none')
    inputElement.type = inputElement.type == 'password' ? 'text' : 'password'
}


var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
return new bootstrap.Tooltip(tooltipTriggerEl)
})


//************* Sign Up *************

const signUpForm = document.getElementById('signUpForm');

if(signUpForm)
signUpForm.addEventListener('submit', function(event) {
    // event.preventDefault();

    // const formData = new FormData(this);
    // const baseUrl = window.location.origin;
    // const apiUrl = `${baseUrl}/wp-json/quizell/v1/signup`;
    // const apiUrl =  window.location.href;

    const formButton = document.getElementById('submit-btn-js');
    formButton.innerHTML = `
        <div class="spinner-border text-light" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    `;

    // const errorsMessages = document.getElementById('errors-messages');
    // hideElement(errorsMessages);

    // fetch(apiUrl, {
    //     method: 'POST',
    //     body: formData
    // })
    //     .then(response => {
    //         if (response.ok) {
    //             return response.json();
    //         } else {
    //             throw new Error('Form submission failed via AJAX');
    //         }
    //     })
    //     .then(data => {
    //         if (data.status === true) {
    //             formButton.innerHTML = 'Account Created';
    //             redirectToVerifyOtpPage();
    //         } else {
    //             formButton.innerHTML = 'Sign Up';
    //             displayErrors(errorsMessages, data.errors);
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error occurred during form submission:', error);
    //         formButton.innerText = 'Error: Please try again';
    //     });
});

function redirectToVerifyOtpPage() {
    const currentURL = window.location.href;
    const url = new URL(currentURL);
    url.searchParams.set('callback', 'verify-otp');
    const updatedURL = url.href;
    window.location.href = updatedURL;
}

function generateErrorHTML(errors) {
    let html = '<ul>';

    for (const key in errors) {
        if (Object.hasOwnProperty.call(errors, key)) {
            for (let i = 0; i < errors[key].length; i++) {
                html += `<li>${errors[key][i]}</li>`;
            }
        }
    }

    html += '</ul>';
    return html;
}

function displayErrors(errorElement, errors) {
    unhideElement(errorElement);
    errorElement.innerHTML = generateErrorHTML(errors);
}

function hideElement(element) {
    if (!element.classList.contains('d-none')) {
        element.classList.add('d-none');
    }
}

function unhideElement(element) {
    if (element.classList.contains('d-none')) {
        element.classList.remove('d-none');
    }
}


//************* Verify OTP *************

const resendEmailLink = document.querySelector('#resend-email-js');

resendEmailLink.addEventListener('click', function(event) {
    event.preventDefault();

    const resendEmailURL = this.getAttribute('href');
    this.textContent = 'Sending Mail...';

    fetch(resendEmailURL, {
        method: 'GET'
    })
        .then(response => {
            if (response.ok) {
                console.log('Resend email request successful');

                setTimeout(() => {
                    resendEmailLink.textContent = 'Resend Email';
                }, 3000);
            } else {
                console.error('Resend email request failed');
            }
        })
        .catch(error => {
            console.error('Error occurred while resending email:', error);
        });
});




const verifyOTPForm = document.getElementById('verify-otp-form-js');

if(verifyOTPForm)
verifyOTPForm.addEventListener('submit', function(event) {
    // event.preventDefault(); // Prevent the default form submission

    // const formData = new FormData(this); // Get form data

    // const baseUrl = window.location.origin;
    // const apiUrl = `${baseUrl}/wp-json/quizell/v1/verify-otp`;

    const formButton = document.getElementById('verify-submit-btn');
    formButton.innerText = 'Verifying...';


    // const errorsMessages = document.getElementById('errors-messages');
    // hideElement(errorsMessages);

    // fetch(apiUrl, {
    //     method: 'POST',
    //     body: formData
    // })
    //     .then(response => {
    //         if (response.ok) {
    //             return response.json(); // Parse response body as JSON
    //         } else {
    //             throw new Error('Form submission failed via AJAX');
    //         }
    //     })
    //     .then(data => {
    //         if (data.status === true) {
    //             formButton.innerText = 'Verified';
    //             redirectToDashboard();
    //         }else{
    //             formButton.innerText = 'Verify Otp';
    //             displayErrors(errorsMessages, data.errors);
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error occurred during form submission:', error);
    //         formButton.innerText = 'Verify Otp';
    //     });
});

function  redirectToDashboard() {
    const currentURL = window.location.href;
    const url = new URL(currentURL);
    url.searchParams.set('callback', 'dashboard');
    const updatedURL = url.href;
    window.location.href = updatedURL;
}
