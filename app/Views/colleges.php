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
                    <h5 class="card-header">Colleges</h5>
                </div>
                <?php 
                    if ($user_privileges['add_categories'] === 1) {
                        ?>
                            <div class="col-sm-6" align="right">
                                <br>
                                <a href="" class="btn btn-md rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCollegeModal">New College</a>&nbsp;&nbsp;
                                <a href="" class="btn btn-md rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">New Department</a>&nbsp;&nbsp;
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
                                    <th>Departments</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                if (isset($colleges)) {
                                    
                                    $sn = 0;
                                    foreach ($colleges as $college) {
                                        if (empty($college['departments'])) {
                                            $college_departments_null = 'No Departments.';
                                        } else {
                                            $college_departments = json_decode($college['departments'], true);
                                        }
                                        
                                        if (empty($college['others'])) {
                                            $others = 'NONE';
                                        } else {
                                            $others = json_decode($college['others'], true);
                                        }

                                ?>
                                        <tr>
                                            <td class="text-center"><?= ++$sn; ?></td>
                                            <td class="text-center"> <?= $college['college_name']." [".$college['short_name']."]"; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if (isset($college_departments_null)) {
                                                            echo $college_departments_null;
                                                            // echo "No Departments"
                                                        } else {
                                                            foreach ($college_departments as $college_department) {
                                                                ?> <?= ($college_department).",<br>"; ?> <?php
                                                            } 
                                                        }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                    <!--<a class="view-college btn btn-outline-info btn-sm" data-collegeid="<?= $college['college_id']; ?>"-->
                                                    <!--data-collegename="<?= $college['college_name']; ?>"-->
                                                    <!--data-collegedepartments="<?= $college['college_name']; ?>"-->
                                                    <!--data-toggle="modal" data-target="#viewCollegeModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="View" href="#">-->
                                                    <!--    <i class='bx bx-show bx-xs'></i>-->
                                                    <!--</a>-->
                                                    <!-- <?php 
                                                        if ($college['deleted_flag'] == 1) {
                                                            ?>
                                                                <a class="disable-member btn btn-outline-warning btn-sm" data-memberid="<?= $college['college_id']; ?>" data-toggle="modal" data-target="#disablememberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Disable" href="#">
                                                                    <i class='bx bxs-lock bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }else {
                                                            ?>
                                                                <a class="enable-member btn btn-outline-warning btn-sm" data-memberid="<?= $college['college_id']; ?>" data-toggle="modal" data-target="#enablememberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Enable" href="#">
                                                                    <i class='bx bxs-lock-open bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }
                                                    ?> -->
                                                    <?php 
                                                        if ($user_privileges['delete_categories'] === 1) {
                                                            ?>
                                                                <a class="delete-college btn btn-outline-danger btn-sm" data-collegeid="<?= $college['college_id']; ?>" data-toggle="modal" data-target="#deleteCollegeModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Delete" href="#">
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
    <?php include('Modals/colleges.php'); ?>
</div>

<script>
    $(function() {
        $(document).on('click', '.edit-college', function(e) {
            e.preventDefault();
            $('#viewCollegeModal').modal('hide');
            $('#editCollegeModal').modal('show');
        });

        $(document).on('click', '.view-college', function(e) {
            e.preventDefault();
            const collegeID = $(this).data('collegeid');
            const collegename = $(this).data('collegename');
            const collegedepartments = $(this).data('collegedepartments');
            $('.collegeID').val(collegeID);
            $('.collegename').val(collegename);
            $('.collegedepartments').val(collegedepartments);
            $('#viewCollegeModal').modal('show');
        });

        $(document).on('click', '.delete-college', function(e) {
            e.preventDefault();
            const collegeID = $(this).data('collegeid');
            $('.collegeID').val(collegeID);
            // console.log(memberID);
            $('#deleteCollegeModal').modal('show');
        });
    });
</script>
<?= $this->endSection('content') ?>