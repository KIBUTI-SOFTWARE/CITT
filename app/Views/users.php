<?php
$user = $_SESSION['user'];
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
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="row">
                <div class="col-sm-6" align="left">
                    <h5 class="card-header">All Users</h5>
                </div>
                <?php
                if ($user_privileges['add_user'] === 1) {
                ?>
                    <div class="col-sm-6" align="right">
                        <br>
                        <a href="" class="btn btn-md rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">New User</a>&nbsp;&nbsp;
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="card-body">
                <?php
                if (isset($none)) {
                ?>
                    <h5 class="text-center"><?= $none; ?></h5>
                <?php
                } else {
                ?>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Account Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (isset($users)) {
                                    $sn = 0;
                                    foreach ($users as $user) {

                                ?>
                                        <tr>
                                            <td class="text-center"><?= ++$sn; ?></td>
                                            <td class="text-center"><?= $user['firstname'] . " " . $user['lastname']; ?></td>
                                            
                                            <td class="text-center"><?= $user['role_name']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                    if ($user['level'] == 1) {
                                                        $level = "System Admin";
                                                        echo "System Admin";
                                                    }
                                                    if ($user['level'] == 2) {
                                                        $level = "Sub-System Admin";
                                                        echo "Sub-System Admin";
                                                    }
                                                    if ($user['level'] == 3) {
                                                        $level = "Branch Admin";
                                                        echo "Branch Admin";
                                                    }
                                                    if ($user['level'] == 4) {
                                                        $level = "User";
                                                        echo "User";
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="view-user btn btn-outline-info btn-sm" 
                                                    data-userid="<?= $user['user_id']; ?>"
                                                    data-userfirstname="<?= $user['firstname']; ?>"
                                                    data-userlastname="<?= $user['lastname']; ?>"
                                                    data-userfullname="<?= $user['firstname']." ".$user['lastname']; ?>"
                                                    data-useremail="<?= $user['email']; ?>"
                                                    data-userphone="<?= $user['phone']; ?>"
                                                    data-userrole="<?= $user['role_name']; ?>"
                                                    data-userlevel="<?= $level; ?>"
                                                    data-toggle="modal" data-target="#viewUserModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="View" href="#">
                                                        <i class='bx bx-show bx-xs'></i>
                                                    </a>
                                                <!-- <?php
                                                        if ($user['status'] == 1) {
                                                        ?>
                                                                <a class="disable-user btn btn-outline-warning btn-sm" data-userid="<?= $user['user_id']; ?>" data-toggle="modal" data-target="#disableuserModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Disable" href="#">
                                                                    <i class='bx bxs-lock bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <a class="enable-user btn btn-outline-warning btn-sm" data-userid="<?= $user['user_id']; ?>" data-toggle="modal" data-target="#enableuserModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Enable" href="#">
                                                                    <i class='bx bxs-lock-open bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }
                                                ?> -->
                                                <?php
                                                    if ($user_privileges['delete_user'] === 1) {
                                                        ?>
                                                            <a class="delete-user btn btn-outline-danger btn-sm" data-userid="<?= $user['user_id']; ?>" data-toggle="modal" data-target="#deleteUserModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Delete" href="#">
                                                                <i class='bx bx-trash bx-xs'></i>
                                                            </a>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <br>
                        <div align="center">
                            <?php if ($pager) : ?>
                                <?= $pager->links() ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                }

                ?>
            </div>

        </div>
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
    <?php include('Modals/users.php'); ?>
</div>

<script>
    $(function() {
        $(document).on('click', '.edit-user', function(e) {
            e.preventDefault();
            $('#viewUserModal').modal('hide');
            $('#editUserModal').modal('show');
        });

        $(document).on('click', '.view-user', function(e) {
            e.preventDefault();
            const userID = $(this).data('userid');
            const userfirstname = $(this).data('userfirstname');
            const userlastname = $(this).data('userlastname');
            const userfullname = $(this).data('userfullname');
            const useremail = $(this).data('useremail');
            const userphone = $(this).data('userphone');
            const userrole = $(this).data('userrole');
            const userlevel = $(this).data('userlevel');
            $('.userID').val(userID);
            $('.userfirstname').val(userfirstname);
            $('.userlastname').val(userlastname);
            $('.userfullname').val(userfullname);
            $('.useremail').val(useremail);
            $('.userphone').val(userphone);
            $('.userrole').val(userrole);
            $('.userlevel').val(userlevel);
            $('#viewUserModal').modal('show');
        });

        $(document).on('click', '.delete-user', function(e) {
            e.preventDefault();
            const userID = $(this).data('userid');
            $('.userID').val(userID);
            // console.log(userID);
            $('#deleteUserModal').modal('show');
        });
    });
</script>
<?= $this->endSection('content') ?>