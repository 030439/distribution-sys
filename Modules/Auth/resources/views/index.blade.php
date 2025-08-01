
<!DOCTYPE html>


<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/">

  <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login </title>

  
 
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/deluxe.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css"/>
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

   
<link rel="stylesheet" href="../../assets/vendor/libs/%40form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
<link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css">

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
    
  </head>

  <body>


<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <!-- Login -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
          <a href="http://127.0.0.1:8000/dashboard" class="app-brand-link">
      <span class="app-brand-logo ">
        <h4>Noman Handi Craft</h4>
</span>
    </a>
          </div>
          <form id="login-form" class="mb-4" method="post">
     
            <div class="mb-6">
              <label for="email" class="form-label">Email or Username</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus>
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>
           
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" id="signInButton" type="submit">Login</button>
            </div>
          </form>

        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
</div>

<!-- / Content -->


    
<script src="../../assets/vendor/libs/jquery/jquery.js"></script>
<script>
// Ensure jQuery is loaded
$(document).ready(function() {
    $('#signInButton').click(function(e) {
        e.preventDefault();

        // Retrieve CSRF token from meta tag
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Form data to be sent
        const formData = {
            email: $('#email').val(),
            password: $('#password').val(),
            _token: csrfToken
        };

        // Send AJAX POST request
        $.ajax({
            url: '/api/sign-in', // Your Laravel route
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log('Sign in successful', response);
                window.location.href = '/dashboard';
                // Handle successful response
            },
            error: function(xhr) {
                console.error('Error during sign in', xhr.responseText);
                // Handle error
            }
        });
    });
});

</script>
    

    
  </body>
  </html>



