<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Center of Innovation and Technology Transfer</title>

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
        <?php if (isset($_SESSION['validationErrors'])) : ?>
            <div class="col-sm-11" align="right">
                <br>
                <div class="bs-toast toast fade show bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="false" data-bs-delay="1000">
                    <div class="toast-header">
                        <i class="bx bxs-bell bx-tada"></i>
                        <div class="me-auto fw-semibold"> Error</div>
                        <small>0 mins ago</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?= $_SESSION['validationErrors']->listErrors() ?>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION['validationErrors']);
        endif;
        ?>
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
                        <div class="me-auto fw-semibold"> Success</div>
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
                            <h4 class="mb-2">Welcome Back!</h4>
                            <p class="mb-4">Please sign-in to your account to Continue.</p>
                        </div>

                        <form id="formAuthentication" name="login" class="mb-3" action="/login" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email or Phone</label>
                                <input type="text" class="form-control" id="email-phone" name="email-phone" placeholder="Enter your email or Phone" autofocus required />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="/forgot-password">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div> -->
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>

                        <!-- <p class="text-center">
                            <span>New to e-Transfer?</span>
                            <a href="/register">
                                <span>Create Account Now!</span>
                            </a>
                        </p> -->
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

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