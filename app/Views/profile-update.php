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
                        <a class="nav-link" href="/profile"><i class="bx bx-user me-1"></i> Account Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-cog me-2"></i> Account Settings</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Password Update</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="/profile-update/password">
                            <fieldset>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="currentPassword" class="form-label">Current Password</label>
                                        <input class="form-control" type="password" id="current_password" name="current_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="newPassword" class="form-label">New Password</label>
                                        <input class="form-control" type="password" id="new_password" name="new_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus />
                                    </div>
                                    <div class="mb-4 col-md-6">
                                    <br>
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autofocus />
                                    </div>
                                    
                                    <div class="mb-4 col-md-6 text-center">
                                        <div class="gap"><br>&nbsp;&nbsp;&nbsp;</div>
                                        <button type="submit" class="btn btn-outline-success me-2">Save changes</button>
                                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <!-- <?php include('Layouts/deleteAccount.php'); ?> -->
            </div>
        </div>
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>

<?= $this->endSection('content') ?>