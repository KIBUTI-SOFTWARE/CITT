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
              <p class="mb-4">Step 1 of 3.</p>
            </div>
            <form id="formAuthentication" class="mb-3" method="POST" action="/login/forgot-password1" method="">
              <div class="mb-3">
                <label for="email-phone" class="form-label">Email or Phone</label>
                <input type="text" class="form-control" id="email-phone" name="email-phone" placeholder="Enter your Email or Phone" autofocus required />
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-6" align="left">
                    <button class="btn btn-outline-primary d-grid w-100" type="submit">Submit</button>
                  </div>
                  <div class="col-md-6" align="right">
                    <a href="/" class="btn btn-outline-secondary d-grid w-100" type="submit">Back to Login</a>
                  </div>
                </div>
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

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>