<?php
$user = $_SESSION['user'];
if (isset($user['member_details'])) {
    $user_profile_data = json_decode($user['member_details'], true);
}
$user_level = $user['level'];

$user_role = $_SESSION['user_role'];

if(!empty($user['photo'])){
    $image = './uploads/members/'.$user['photo'];
}else{
    $image = 'assets/img/avatars/avatar.png';
}

$user_privileges = json_decode($user_role[0]['privileges'], true);
?>

<?= $this->extend('Layouts/main.php') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <?php include('Layouts/alerts.php'); ?>
    <!-- Content -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-9">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Welcome Back 
                                        <?php
                                            if (isset($user['firstname'])) {
                                                echo $user['firstname'];
                                            } else {
                                                echo $user_profile_data['firstname'];
                                            } 
                                            
                                        ?>
                                         🎉
                                    </h5>
                                    <p class="mb-4">
                                        Please Use the Menus on the left to navigate the system 🤓.
                                        <br>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-3 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>

<?= $this->endSection('content') ?>