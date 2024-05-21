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
                    <h5 class="card-header">Members</h5>
                </div>
                <?php 
                    if ($user_privileges['add_members'] === 1) {
                        ?>
                            <div class="col-sm-6" align="right">
                                <br>
                                <a href="" class="btn btn-md rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">New Member</a>&nbsp;&nbsp;
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
                                    <th>Contact</th>
                                    <th>Department</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                if (isset($members)) {
                                    $sn = 0;
                                    foreach ($members as $member) {
                                        $member_photo = ""; 

                                ?>
                                        <tr>
                                            <td class="text-center"><?= ++$sn; ?></td>
                                            <td>
                                                <?php
                                                    
                                                    if(!empty($member['photo'])){
                                                      $member_photo = '/uploads/members/'.$member['photo'];  
                                                    } else {
                                                        $member_photo = $image;
                                                    }
                                                    $member_details = json_decode($member['member_details'], true);
                                                    $member_gender = ($member_details['gender'] === 'Male') ? "Mr." : "Ms." ;
                                                ?>
                                                <a href="" class="update-photo" data-bs-toggle="modal" data-bs-target="#updateMemberPhotoModal" data-memberid="<?= $member['member_id']; ?>" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Update Photo"><img src="<?=$member_photo?>" height="40" width="35" /></a>&nbsp;&nbsp;&nbsp;<?= $member_gender." ". $member_details['firstname']." ". $member_details['lastname']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    ?>
                                                        Phone: <?= $member['phone'];?><br>
                                                        Email: <?= $member['email'];?>
                                                        
                                                    <?php 
                                                ?>
                                            </td>
                                            <td class="text-center"><?= $member_details['department']; ?></td>
                                            <td class="text-center">
                                                    <a class="view-member btn btn-outline-info btn-sm" data-memberid="<?= $member['member_id']; ?>"
                                                    data-memberfirstname="<?= $member_details['firstname']; ?>"
                                                    data-memberfullname="<?= $member_details['firstname'].' '.$member_details['lastname']; ?>"
                                                    data-memberlastname="<?= $member_details['lastname']; ?>"
                                                    data-membergender="<?= $member_details['gender']; ?>"
                                                    data-memberemail="<?= $member['email']; ?>"
                                                    data-memberphone="<?= $member['phone']; ?>"
                                                    data-memberdepartment="<?= $member_details['department']; ?>"
                                                    data-memberphoto="<?= $member_photo; ?>"
                                                    data-status="<?= $member['status']; ?>"
                                                    data-toggle="modal" data-target="#viewMemberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="View" href="#">
                                                        <i class='bx bx-show bx-xs'></i>
                                                    </a>
                                                    <!-- <?php 
                                                        if ($member['deleted_flag'] == 1) {
                                                            ?>
                                                                <a class="disable-member btn btn-outline-warning btn-sm" data-memberid="<?= $member['member_id']; ?>" data-toggle="modal" data-target="#disablememberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Disable" href="#">
                                                                    <i class='bx bxs-lock bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }else {
                                                            ?>
                                                                <a class="enable-member btn btn-outline-warning btn-sm" data-memberid="<?= $member['member_id']; ?>" data-toggle="modal" data-target="#enablememberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Enable" href="#">
                                                                    <i class='bx bxs-lock-open bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }
                                                    ?> -->
                                                    <?php 
                                                        if ($user_privileges['delete_members'] === 1) {
                                                            ?>
                                                                <a class="delete-member btn btn-outline-danger btn-sm" data-memberid="<?= $member['member_id']; ?>" data-toggle="modal" data-target="#deleteMemberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Delete" href="#">
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
    <?php include('Modals/members.php'); ?>
</div>

<script>
    $(function() {
        $(document).on('click', '.edit-member', function(e) {
            e.preventDefault();
            $('#viewMemberModal').modal('hide');
            $('#editMemberModal').modal('show');
        });

        $(document).on('click', '.view-member', function(e) {
            e.preventDefault();
            const memberID = $(this).data('memberid');
            const memberfirstname = $(this).data('memberfirstname');
            const memberfullname = $(this).data('memberfullname');
            const memberlastname = $(this).data('memberlastname');
            const memberemail = $(this).data('memberemail');
            const memberphone = $(this).data('memberphone');
            const membergender = $(this).data('membergender');
            const memberdepartment = $(this).data('memberdepartment');
            const memberphoto = $(this).data('memberphoto');
            const status = $(this).data('status');
            $('.memberID').val(memberID);
            $('.memberfullname').val(memberfullname);
            $('.memberfirstname').val(memberfirstname);
            $('.memberlastname').val(memberlastname);
            $('.memberemail').val(memberemail);
            $('.memberphone').val(memberphone);
            $('.membergender').val(membergender);
            $('.memberdepartment').val(memberdepartment);
            $('.memberphoto').val(memberphoto);
            $('.status').val(status);
            $('#viewMemberModal').modal('show');
        });

        $(document).on('click', '.delete-member', function(e) {
            e.preventDefault();
            const memberID = $(this).data('memberid');
            $('.memberID').val(memberID);
            // console.log(memberID);
            $('#deleteMemberModal').modal('show');
        });
        
        $(document).on('click', '.update-photo', function(e) {
            e.preventDefault();
            const memberID = $(this).data('memberid');
            $('.memberID').val(memberID);
            // console.log(memberID);
            $('#updateMemberPhotoModal').modal('show');
        });
    });
</script>
<?= $this->endSection('content') ?>