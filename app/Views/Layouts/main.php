<?php
$user = $_SESSION['user'];
$user_level = $user['level'];
if (isset($user['member_details'])) {
    $user_profile_data = json_decode($user['member_details'], true);
}
$user_role = $_SESSION['user_role'];

$user_branch_name = strtoupper('citt');
$user_branch = strtoupper('citt');


if(!empty($user['photo'])){
    $image = './uploads/members/'.$user['photo'];
}else{
    $image = 'assets/img/avatars/avatar.png';
}

$user_privileges = json_decode($user_role[0]['privileges'], true);

?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Center of Innovation and Technology Transfer</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo.svg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <!-- <link href="https://fonts.googleapis.com/css2?family=Tahoma:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" /> -->
    <link href='https://fonts.googleapis.com/css?family=Alegreya' rel='stylesheet'>


    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <script src="assets/js/config.js"></script>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <!-- Import the required libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/vendor/js/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Alegreya';
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="/dashboard" class="app-brand-link">
                        <!-- <p class="demo menu-text fw-bolder ms-2" style="font-size: 26px;"><?= $user_branch ?></p> -->
                        <p class="demo menu-text fw-bolder ms-2">Center of Innovation and Technology Transfer</p>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/dashboard') {
                                                echo "active";
                                            } ?>">
                        <a href="/dashboard" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
                    <?php

                    if ($user_privileges['view_members'] === 1) {
                    ?>
                        <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/members' || str_contains($_SERVER['REQUEST_URI'], 'members')) {
                                                    echo "active";
                                                } ?>">
                            <a href="/members" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-group"></i>
                                <div data-i18n="Analytics">Members</div>
                            </a>
                        </li>
                    <?php
                    }

                    if ($user_privileges['view_projects'] === 1) {
                    ?>
                        <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/projects' || str_contains($_SERVER['REQUEST_URI'], 'projects')) {
                                                    echo "active";
                                                } ?>">
                            <a href="/projects" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-file"></i>
                                <div data-i18n="Analytics">Projects</div>
                            </a>
                        </li>
                    <?php
                    }

                    if ($user_privileges['view_categories'] === 1) {
                    ?>
                        <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/categories' || str_contains($_SERVER['REQUEST_URI'], 'categories')) {
                                                    echo "active";
                                                } ?>">
                            <a href="/categories" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-award"></i>
                                <div data-i18n="Analytics">Categories</div>
                            </a>
                        </li>
                    <?php
                    }

                    if ($user_privileges['view_events'] === 1) {
                    ?>
                        <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/events' || str_contains($_SERVER['REQUEST_URI'], 'events')) {
                                                    echo "active";
                                                } ?>">
                            <a href="/events" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                                <div data-i18n="Analytics">Events</div>
                            </a>
                        </li>
                    <?php
                    }

                    if ($user_privileges['view_events'] === 1) {
                    ?>
                        <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/gallery' || str_contains($_SERVER['REQUEST_URI'], 'gallery')) {
                                                    echo "active";
                                                } ?>">
                            <a href="/gallery" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-image"></i>
                                <div data-i18n="Analytics">Gallery</div>
                            </a>
                        </li>
                    <?php
                    }

                    if ($user_privileges['view_reports'] === 1) {
                        ?>
                            <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/reports' || str_contains($_SERVER['REQUEST_URI'], 'reports')) {
                                                        echo "active";
                                                    } ?>">
                                <a href="/reports" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-file"></i>
                                    <div data-i18n="Analytics">Reports</div>
                                </a>
                            </li>
                        <?php
                        }


                    ?>

                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Others</span></li>
                    <!-- User interface -->
                    <?php
                    if ($user_level <= 3) {
                    ?>
                        <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/users' || str_contains($_SERVER['REQUEST_URI'], 'users')) {
                                                    echo "active";
                                                } ?>">
                            <a href="/users" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-group"></i>
                                <div data-i18n="Users">Users</div>
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php 
                    if ($user_privileges['view_categories'] === 1) {
                        ?>
                            <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/colleges' || str_contains($_SERVER['REQUEST_URI'], 'colleges')) {
                                                        echo "active";
                                                    } ?>">
                                <a href="/colleges" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-buildings"></i>
                                    <div data-i18n="Analytics">Colleges & Departments</div>
                                </a>
                            </li>
                        <?php
                        }
                    ?>

                    <?php
                    if ($user_privileges['view_role'] === 1) {
                    ?>
                        <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/roles' || str_contains($_SERVER['REQUEST_URI'], 'roles')) {
                                                    echo "active";
                                                } ?>">
                            <a href="/roles" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-lock"></i>
                                <div data-i18n="Role">Roles & Permissions</div>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/profile' || $_SERVER['REQUEST_URI'] == '/profile-update') {
                                                echo "active open";
                                            } ?>">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div data-i18n="User interface">Profile Settings</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/profile') {
                                                        echo "active";
                                                    } ?>">
                                <a href="/profile" class="menu-link">
                                    <div data-i18n="Accordion">My Profile</div>
                                </a>
                            </li>
                            <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/profile-update') {
                                                        echo "active";
                                                    } ?>">
                                <a href="/profile-update" class="menu-link">
                                    <div data-i18n="Accordion">Update Password</div>
                                </a>
                            </li>
                            <!-- <li class="menu-item <?php if ($_SERVER['REQUEST_URI'] == '/language') {
                                                            echo "active";
                                                        } ?>">
                                <a href="/language" class="menu-link">
                                    <div data-i18n="Alerts">Language</div>
                                </a>
                            </li> -->
                        </ul>
                    </li>
                    <li class="menu-item ">
                        <a href="/logout" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-power-off me-2"></i>
                            <div data-i18n="Analytics">Logout</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="<?= $image; ?>" alt class="w-px-30 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="/profile">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="<?= $image; ?>" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">
                                                        <?php
                                                            if (isset($user_profile_data)) {
                                                                echo $user_profile_data['firstname']. " " . $user_profile_data['lastname'];
                                                            } else {
                                                                echo $user['firstname'] . " " . $user['lastname'];
                                                            } 
                                                            
                                                        ?>
                                                        
                                                    </span>
                                                    <small class="text-muted">
                                                        <?php
                                                        if ($user_level == 1) {
                                                            echo "System Admin";
                                                        }
                                                        if ($user_level == 2) {
                                                            echo "Sub-System Admin";
                                                        }
                                                        if ($user_level == 3) {
                                                            echo "Branch Admin";
                                                        }
                                                        if ($user_level == 4) {
                                                            echo "User";
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/profile">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/logout">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Page Content wrapper -->
                <?= $this->renderSection('content') ?>
                <!-- Page Content wrapper -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme" style="font-size: 16px;">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>,
                            <a href="https://kibuti.co.tz" class="footer-link fw-bolder">Kibuti Softwares.</a>
                        </div>
                        <div>

                            <a href="" class="footer-link me-4">Privacy Policy</a>

                            <a href="" class="footer-link me-4">Terms of Use</a>

                            <a class="footer-link me-4">v0.0.1</a>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- <div class="buy-now">
        <a href="/" class="btn rounded-pill btn-outline-success btn-buy-now">Home</a>
    </div> -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <!-- Import the required libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script src="assets/vendor/js/jquery.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>