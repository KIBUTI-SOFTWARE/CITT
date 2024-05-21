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
                    <h5 class="card-header">Events</h5>
                </div>
                <?php
                if ($user_privileges['add_events'] === 1) {
                ?>
                    <div class="col-sm-6" align="right">
                        <br>
                        <a href="" class="btn btn-md rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">New Event</a>&nbsp;&nbsp;
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
                                    <th>Event Name</th>
                                    <th>Projects</th>
                                    <th>Event Leader</th>
                                    <th>Duration</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (isset($events)) {
                                    $sn = 0;
                                    foreach ($events as $event) {
                                        // print_r($project);
                                        $projects = json_decode($event['projects'], true);
                                        $event_description = json_decode($event['event_description'], true);

                                ?>
                                        <tr>
                                            <td class="text-center"><?= ++$sn; ?></td>
                                            <td class="text-center"> <?= $event['event_name']; ?>
                                            <td class="text-center"> 
                                                <?php
                                                    foreach ($projects as $projectRegistered) {
                                                        $projectDetails = ConfigMyFunctions::getProjectDetails($projectRegistered);
                                                        ?>
                                                            <?= $projectDetails[0]['project_title'].",<br> "; ?>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $event['firstname']." ".$event['lastname']; ?>
                                            </td>
                                            <td class="text-center"><?= $event['starts_on']." - ".$event['ends_on']; ?></td>
                                            <td class="text-center">
                                                <a class="view-events btn btn-outline-info btn-sm" 
                                                data-eventid="<?= $event['event_id']; ?>"
                                                data-eventtitle="<?= $event['event_name']; ?>"
                                                data-eventdescription="<?= $event_description; ?>"
                                                data-toggle="modal" data-target="#viewEventsModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="View" href="#">
                                                    <i class='bx bx-show bx-xs'></i>
                                                </a>
                                                <!-- <?php
                                                        if ($event['deleted_flag'] == 1) {
                                                        ?>
                                                                <a class="disable-member btn btn-outline-warning btn-sm" data-eventid="<?= $event['event_id']; ?>" data-toggle="modal" data-target="#disablememberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Disable" href="#">
                                                                    <i class='bx bxs-lock bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <a class="enable-member btn btn-outline-warning btn-sm" data-eventid="<?= $event['event_id']; ?>" data-toggle="modal" data-target="#enablememberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Enable" href="#">
                                                                    <i class='bx bxs-lock-open bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }
                                                            ?> -->
                                                <?php
                                                if ($user_privileges['delete_events'] === 1) {
                                                ?>
                                                    <a class="delete-event btn btn-outline-danger btn-sm" data-eventid="<?= $event['event_id']; ?>" data-toggle="modal" data-target="#deleteProjectModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Delete" href="#">
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
    <?php include('Modals/events.php'); ?>
</div>

<script>
    $(function() {
        $(document).on('click', '.edit-events', function(e) {
            e.preventDefault();
            $('#viewEventsModal').modal('hide');
            $('#editEventsModal').modal('show');
        });

        $(document).on('click', '.view-events', function(e) {
            e.preventDefault();
            const eventID = $(this).data('eventid');
            const eventtitle = $(this).data('eventtitle');
            const eventdescription = $(this).data('eventdescription');
            $('.eventID').val(eventID);
            $('.eventtitle').val(eventtitle);
            $('.eventdescription').val(eventdescription);
            $('#viewEventsModal').modal('show');
        });

        $(document).on('click', '.delete-event', function(e) {
            e.preventDefault();
            const eventID = $(this).data('eventid');
            $('.eventID').val(eventID);
            // console.log(memberID);
            $('#deleteEventModal').modal('show');
        });
    });
</script>
<?= $this->endSection('content') ?>