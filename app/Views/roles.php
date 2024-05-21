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
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="row">
                <div class="col-sm-6" align="left">
                    <h5 class="card-header">All Roles</h5>
                </div>
                <?php 
                    if ($user_privileges['add_role'] === 1) {
                        ?>
                            <div class="col-sm-6" align="right">
                                <br>
                                <a href="" class="btn btn-md rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">New Role</a>&nbsp;&nbsp;
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
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                if (isset($roles)) {
                                    $sn = 0;
                                    foreach ($roles as $role) {

                                ?>
                                        <tr>
                                            <td class="text-center"><?= ++$sn; ?></td>
                                            <td class="text-center"><?= $role['role_name']; ?></td>
                                            <td class="text-center"><?= $role['description']; ?></td>
                                            <td class="text-center">
                                                    <a class="view-role btn btn-outline-info btn-sm" data-roleid="<?= $role['role_id']; ?>"
                                                    data-rolename="<?= $role['role_name']; ?>"
                                                    data-roledescription="<?= $role['description']; ?>"
                                                    data-toggle="modal" data-target="#viewRoleModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="View" href="#">
                                                        <i class='bx bx-show bx-xs'></i>
                                                    </a>
                                                    <!-- <?php 
                                                        if ($role['status'] == 1) {
                                                            ?>
                                                                <a class="disable-role btn btn-outline-warning btn-sm" data-roleid="<?= $role['role_id']; ?>" data-toggle="modal" data-target="#disableroleModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Disable" href="#">
                                                                    <i class='bx bxs-lock bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }else {
                                                            ?>
                                                                <a class="enable-role btn btn-outline-warning btn-sm" data-roleid="<?= $role['role_id']; ?>" data-toggle="modal" data-target="#enableroleModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Enable" href="#">
                                                                    <i class='bx bxs-lock-open bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }
                                                    ?> -->
                                                    <?php 
                                                        if ($user_privileges['delete_role'] === 1) {
                                                            ?>
                                                                <a class="delete-role btn btn-outline-danger btn-sm" data-roleid="<?= $role['role_id']; ?>" data-toggle="modal" data-target="#deleteRoleModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Delete" href="#">
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
    <?php include('Modals/roles.php'); ?>
</div>

<script>
    $(function() {
        $(document).on('click', '.edit-role', function(e) {
            e.preventDefault();
            $('#viewRoleModal').modal('hide');
            $('#editRoleModal').modal('show');
        });

        $(document).on('click', '.view-role', function(e) {
            e.preventDefault();
            const roleID = $(this).data('roleid');
            const rolename = $(this).data('rolename');
            const roledescription = $(this).data('roledescription');
            $('.roleID').val(roleID);
            $('.rolename').val(rolename);
            $('.roledescription').val(roledescription);
            $('#viewRoleModal').modal('show');
        });

        $(document).on('click', '.delete-role', function(e) {
            e.preventDefault();
            const roleID = $(this).data('roleid');
            $('.roleID').val(roleID);
            // console.log(roleID);
            $('#deleteRoleModal').modal('show');
        });

        $(document).on('click', '.enable-role', function(e) {
            e.preventDefault();
            const roleID = $(this).data('roleid');
            $('.roleID').val(roleID);
            // console.log(roleID);
            $('#enableRoleModal').modal('show');
        });

        $(document).on('click', '.disable-role', function(e) {
            e.preventDefault();
            const roleID = $(this).data('roleid');
            $('.roleID').val(roleID);
            // console.log(roleID);
            $('#disableRoleModal').modal('show');
        });
    });
</script>
<?= $this->endSection('content') ?>