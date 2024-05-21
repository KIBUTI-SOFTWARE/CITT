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
                    <h5 class="card-header">All Reports</h5>
                </div>
                <?php 
                    if ($user_privileges['create_reports'] === 1) {
                        ?>
                            <div class="col-sm-6" align="right">
                                <br>
                                <a href="" class="btn btn-md rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addReportModal">Upload Report</a>&nbsp;&nbsp;
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
                                    <th>Report For</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                if (isset($reports)) {
                                    $sn = 0;
                                    foreach ($reports as $report) {
                                        // print_r($reports);
                                ?>
                                        <tr>
                                            <td class="text-center"><?= ++$sn; ?></td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($report['report_event'] !== 'NULL') {
                                                        ?><?= $report['event_name']; ?><?php
                                                    }

                                                    if ($report['report_project'] !== 'NULL') {
                                                        ?><?= $report['project_title']; ?><?php
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center"><?= json_decode($report['report_description'], true); ?></td>
                                            <td class="text-center">
                                                    <?php 
                                                        if ($report['file'] !== 'NULL') {
                                                            ?>
                                                                <a class="download-report btn btn-outline-primary btn-sm" 
                                                                data-reportid="<?= $report['report_id']; ?>"
                                                                data-file="<?= json_decode($report['file'],true); ?>" 
                                                                data-toggle="modal" data-target="#downloadReportModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Download" href="#">
                                                                    <i class='bx bx-download bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }
                                                    ?>
                                                    
                                                    <?php 
                                                        if ($user_privileges['delete_reports'] === 1) {
                                                            ?>
                                                                <a class="delete-report btn btn-outline-danger btn-sm" data-reportid="<?= $report['report_id']; ?>" data-toggle="modal" data-target="#downloafReportModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Delete" href="#">
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
    <?php include('Modals/reports.php'); ?>
</div>

<script>
    $(function() {
        $(document).on('click', '.edit-role', function(e) {
            e.preventDefault();
            $('#viewRoleModal').modal('hide');
            $('#editRoleModal').modal('show');
        });

        $(document).on('click', '.delete-report', function(e) {
            e.preventDefault();
            const reportID = $(this).data('reportid');
            $('.reportID').val(reportID);
            // console.log(roleID);
            $('#deleteReportModal').modal('show');
        });

        $(document).on('click', '.download-report', function(e) {
            e.preventDefault();
            const reportID = $(this).data('reportid');
            const file = $(this).data('file');
            $('.reportID').val(reportID);
            $('.file').val(file);
            // console.log(roleID);
            $('#downloadReportModal').modal('show');
        });
    });
</script>
<?= $this->endSection('content') ?>