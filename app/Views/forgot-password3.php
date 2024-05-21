<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Centralized Citizenship Identification System</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="assets/img/icons/graduation-cap-solid.svg" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <!-- <link href="https://fonts.googleapis.com/css2?family=TAHOMA:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" /> -->
  <link href='https://fonts.googleapis.com/css?family=Alegreya' rel='stylesheet'>

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="assets/js/config.js"></script>
  <style>
    body {
      font-family: 'Alegreya';
    }
  </style>
</head>

<body>
  <!-- Content -->


  <div class="container-xxl">
    <br>

    <div class="col-sm-12" align="right">
      <?php if (isset($validation)) : ?>
        <div class="bs-toast toast fade show bg-danger " role="alert" aria-live="assertive" aria-atomic="false">
          <div class="toast-header">
            <i class="bx bxs-bell bx-tada"></i>
            <div class="me-auto fw-semibold"> Error</div>
            <small>0 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            <?= $validation->listErrors() ?>
          </div>
        </div>
        <!--  -->
      <?php endif; ?>
    </div>
    <div class="col-sm-12" align="right">
      <?php if (isset($_SESSION['error'])) : ?>
        <div class="bs-toast toast fade show bg-danger " role="alert" aria-live="assertive" aria-atomic="false">
          <div class="toast-header">
            <i class="bx bxs-bell bx-tada"></i>
            <div class="me-auto fw-semibold"> Error</div>
            <small>0 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            <?= $_SESSION['error'] ?>
          </div>
        </div>
        <!--  -->
      <?php
        unset($_SESSION['error']);
      endif;
      ?>
    </div>
    <div class="col-sm-12" align="right">
      <?php if (isset($_SESSION['success'])) : ?>
        <div class="bs-toast toast fade show bg-success " role="alert" aria-live="assertive" aria-atomic="false">
          <div class="toast-header">
            <i class="bx bxs-bell bx-tada"></i>
            <div class="me-auto fw-semibold"> Error</div>
            <small>0 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            <?= $_SESSION['success'] ?>
          </div>
        </div>
        <!--  -->
      <?php
        unset($_SESSION['success']);
      endif;
      ?>
    </div>
    <div class="col-sm-12" align="right">
            <?php if (isset($_SESSION['info'])) : ?>
                <div class="bs-toast toast fade show bg-info " role="alert" aria-live="assertive" aria-atomic="false">
                    <div class="toast-header">
                        <i class="bx bxs-bell bx-tada"></i>
                        <div class="me-auto fw-semibold"> Info</div>
                        <small>0 mins ago</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?= $_SESSION['info'] ?>
                    </div>
                </div>
                <!--  -->
                <?php 
                    unset($_SESSION['info']);
                    endif; 
                ?>
      </div>
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">

        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <!-- <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bolder">Project Managament System</span>
                            </a>
                        </div> -->
            <!-- /Logo -->
            <div class="text-center">
              <h4 class="mb-2">Password Recovery</h4>
              <p class="mb-4">Step 3 of 3.</p>
            </div>
            <form id="formAuthentication" class="mb-3" method="POST" action="/login/recover-password" method="">
              <div class="mb-3 col-md-12 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3 col-md-12 form-password-toggle">
                <label class="form-label" for="password">Confirm Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="confirm_password" class="form-control" name="confirmPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span><br>
                  
                </div>
              </div>
              <div class="mb-3 col-md-12">
                <span id="message"></span>
              </div>
              <div id="button">

              </div>
            </form>

          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <div class="buy-now">
    <a href="https://smas.app" class="btn rounded-pill btn-outline-info btn-buy-now">SMAS Login</a>
  </div>

  <!-- Core JS -->
  
  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="assets/js/main.js"></script>
  <script>
    $('#password, #confirm_password').on('keyup', function() {
      if (($('#password').val()) && ($('#confirm_password').val())) {
        if ($('#password').val() == $('#confirm_password').val()) {
          $('#message').html('Password and Confirm Password Match.').css('color', 'green');
          $('#button').html('<button class="btn btn-primary d-grid w-100">Recover Password</button>');
        } else {
          $('#message').html('Password and Confirm Password Do not Match.').css('color', 'red');
          $('#button').html('')
        }
      } else {
        $('#message').html('Password or Confirm Password Fields Cannot be empty.').css('color', 'red');
        $('#button').html('')
      }

      // if ($('#password').val() == $('#confirm_password').val()) {
      // 	$('#message').html('New and Confirm Passwords Match').css('color', 'green');
      // 	$('#button').html('<button type="submit" name="signup" class="btn btn-lg btn-primary">Sign up</button><br><br><p>Already Have an Account? <a href="login.php">Signin</a></p>');
      // } else {
      // 	$('#message').html('New and Confirm Passwords Do not Match').css('color', 'red');
      // 	$('#button').html('')
      // }
    });
  </script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>