<?php
$user = $_SESSION['user'];
$user_level = $user['level'];
if (isset($user['member_details'])) {
    $user_profile_data = json_decode($user['member_details'], true);
}

if(!empty($user['photo'])){
    $image = './uploads/members/'.$user['photo'];
}else{
    $image = 'assets/img/avatars/avatar.png';
}
?>

<?= $this->extend('Layouts/main.php') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <?php include('Layouts/alerts.php'); ?>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile-update"><i class="bx bx-cog me-2"></i> Account Settings</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">My Profile</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 d-flex align-items-start align-items-sm-center gap-4">
                                <img src="<?= $image ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            </div>
                                <?php
                                if ($user['level'] === '4') {
                                ?>
                                    <div class="col-sm-6 button-wrapper" align="right">
                                        <!--<label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">-->
                                        <!--    <span class="d-none d-sm-block">My CV</span>-->
                                        <!--    <i class="bx bx-upload d-block d-sm-none"></i>-->
                                        <!--</label>-->
                                        <a href="get-cv" class="btn btn-md rounded-pill btn-outline-primary" >My CV</a>&nbsp;&nbsp;
                                    </div>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" onsubmit="return false">
                            <fieldset disabled>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input class="form-control" type="text" id="firstName" name="firstName" value="<?php
                                                                                                                        if (isset($user['firstname'])) {
                                                                                                                            echo $user['firstname'];
                                                                                                                        } else {
                                                                                                                            echo $user_profile_data['firstname'];
                                                                                                                        }

                                                                                                                        ?>" autofocus />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input class="form-control" type="text" name="lastName" id="lastName" value="<?php
                                                                                                                        if (isset($user['lastname'])) {
                                                                                                                            echo $user['lastname'];
                                                                                                                        } else {
                                                                                                                            echo $user_profile_data['lastname'];
                                                                                                                        }

                                                                                                                        ?>" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email" value="<?= $user['email']; ?>" placeholder="<?= $user['email']; ?>" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">TZ (+255)</span>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="<?= $user['phone']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                  
            </div>
        </div>
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>

<?= $this->endSection('content') ?>