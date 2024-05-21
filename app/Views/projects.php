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

use Config\MyFunctions as ConfigMyFunctions;
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
                    <h5 class="card-header">Projects</h5>
                </div>
                <?php
                if ($user_privileges['add_projects'] === 1) {
                ?>
                    <div class="col-sm-6" align="right">
                        <br>
                        <a href="" class="btn btn-md rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">New Project</a>&nbsp;&nbsp;
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
                                    <th>Title</th>
                                    <th>Lead Developer</th>
                                    <th>Other Developer(s)</th>
                                    <th>College</th>
                                    <th>Category</th>
                                    <th>Stage</th>
                                    <th>Registration Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (isset($projects)) {
                                    $sn = 0;
                                    foreach ($projects as $project) {
                                        // print_r($project);
                                        $lead_developer = json_decode($project['member_details'], true);
                                        $other_developers = json_decode($project['other_developers'], true);
                                        $description = json_decode($project['project_description'], true);

                                ?>
                                        <tr>
                                            <td class="text-center"><?= ++$sn; ?></td>
                                            <td class="text-center"> <?= $project['project_title']; ?>
                                            <td class="text-center"> <?= $lead_developer['firstname'] . " " . $lead_developer['lastname']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    foreach ($other_developers as $other_developer) {
                                                        $otherDevDetails = ConfigMyFunctions::getMemberDetails($other_developer);
                                                        $otherDevProfile = json_decode($otherDevDetails['member_details'], true);
                                                        ?>
                                                            <?= $otherDevProfile['firstname'] . " " . $otherDevProfile['lastname'].",<br>"; ?>

                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center"><?= $project['short_name']; ?></td>
                                            <td class="text-center"><?= $project['name']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                $stage = $project['stage'];
                                                if ($stage == '1') {
                                                    echo $project_stage = "Ideation";
                                                } elseif ($stage == '2') {
                                                    echo $project_stage = "Proof of Concept";
                                                } elseif ($stage == '3') {
                                                    echo $project_stage = "Prototype";
                                                } elseif ($stage == '4') {
                                                    echo $project_stage = "Minimum Viable Product";
                                                } elseif ($stage == '5') {
                                                    echo $project_stage = "Product";
                                                } else {
                                                    echo "Undefined Status";
                                                }

                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                $reg_status = $project['reg_status'];
                                                if ($reg_status == '1') {
                                                    echo $project_reg_status = "Registered";
                                                } elseif ($reg_status == '2') {
                                                    echo $project_reg_status = "On Progress";
                                                } elseif ($reg_status == '3') {
                                                    echo $project_reg_status = "Unregistered";
                                                } else {
                                                    echo "Undefined Status";
                                                }

                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="view-projects btn btn-outline-info btn-sm" 
                                                data-projectid="<?= $project['project_id']; ?>" 
                                                data-projecttitle="<?= $project['project_title']; ?>" 
                                                data-projectleaddeveloper="<?= $lead_developer['firstname'] . " " . $lead_developer['lastname']; ?>" 
                                                data-projectotherdevelopers="<?= $project['other_developers'] ?>" 
                                                data-projectcollege="<?= $project['short_name']; ?>" 
                                                data-projectcategory="<?= $project['name']; ?>" 
                                                data-projectstage="<?= $project_stage; ?>" 
                                                data-projectregstatus="<?= $project_reg_status; ?>" 
                                                data-projectdescription="<?= $description; ?>" 
                                                data-toggle="modal" data-target="#viewProjectsModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="View" href="#">
                                                    <i class='bx bx-show bx-xs'></i>
                                                </a>
                                                <!-- <?php
                                                        if ($project['deleted_flag'] == 1) {
                                                        ?>
                                                                <a class="disable-member btn btn-outline-warning btn-sm" data-memberid="<?= $project['project_id']; ?>" data-toggle="modal" data-target="#disablememberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Disable" href="#">
                                                                    <i class='bx bxs-lock bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <a class="enable-member btn btn-outline-warning btn-sm" data-memberid="<?= $project['project_id']; ?>" data-toggle="modal" data-target="#enablememberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Enable" href="#">
                                                                    <i class='bx bxs-lock-open bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }
                                                            ?> -->
                                                <?php
                                                if ($user_privileges['delete_projects'] === 1) {
                                                ?>
                                                    <a class="delete-project btn btn-outline-danger btn-sm" data-projectid="<?= $project['project_id']; ?>" data-toggle="modal" data-target="#deleteProjectModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Delete" href="#">
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
    <?php include('Modals/projects.php'); ?>
</div>

<script>
    $(function() {
        $(document).on('click', '.edit-projects', function(e) {
            e.preventDefault();
            $('#viewProjectsModal').modal('hide');
            $('#editProjectsModal').modal('show');
        });

        $(document).on('click', '.view-projects', function(e) {
            e.preventDefault();
            const projectID = $(this).data('projectid');
            const projecttitle = $(this).data('projecttitle');
            const projectleaddeveloper = $(this).data('projectleaddeveloper');
            const projectotherdevelopers = $(this).data('projectotherdevelopers');
            const projectcollege = $(this).data('projectcollege');
            const projectcategory = $(this).data('projectcategory');
            const projectregstatus = $(this).data('projectregstatus');
            const projectstage = $(this).data('projectstage');
            const projectdescription = $(this).data('projectdescription');
            $('.projectID').val(projectID);
            $('.projecttitle').val(projecttitle);
            $('.projectleaddeveloper').val(projectleaddeveloper);
            $('.projectotherdevelopers').val(projectotherdevelopers);
            $('.projectcollege').val(projectcollege);
            $('.projectcategory').val(projectcategory);
            $('.projectregstatus').val(projectregstatus);
            $('.projectstage').val(projectstage);
            $('.projectdescription').val(projectdescription);
            $('#viewProjectsModal').modal('show');
        });

        $(document).on('click', '.delete-project', function(e) {
            e.preventDefault();
            const projectID = $(this).data('projectid');
            $('.projectID').val(projectID);
            // console.log(memberID);
            $('#deleteProjectModal').modal('show');
        });
    });
</script>
<?= $this->endSection('content') ?>