<!--Add Project Modal -->
<div class="modal fade" id="addReportModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Creating New Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/reports/add-report" enctype="multipart/form-data">
                    <?php
                        if ($user['level'] < 4) {
                            ?>
                                <div class="row g-2">
                                    <div class="col mb-3">
                                        <?php
                                        if (isset($events)) {
                                            if (count($events) >= 1) {
                                        ?>
                                                <div class="col mb-3">
                                                    <label for="Event" class="form-label">Event</label>
                                                    <select class="form-select" name="event_id" id="exampleFormControlSelect1" aria-label="Event" required>
                                                        <option disabled>Select an Event</option>

                                                        <?php
                                                        foreach ($events as $event) {
                                                        ?>
                                                            <option value="<?= $event['event_id'] ?>"><?= $event['event_name']; ?></option>
                                                        <?php

                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col mb-3">
                                                    <label for="Event" class="form-label">Event</label>
                                                    <select class="form-select" name="event_id" id="exampleFormControlSelect1" aria-label="Event" required>
                                                        <option disabled>No Events Found.</option>
                                                    </select>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php
                        } else {
                            ?>

                                <div class="row g-2">
                                    <?php
                                    if (isset($availableProjects)) {
                                        if (count($availableProjects) >= 1) {
                                    ?>
                                            <div class="col mb-3">
                                                <label for="Select Projects" class="form-label">Projects</label>
                                                <select class="form-select" name="project_id" id="exampleFormControlSelect1" aria-label="Select Select Projects">
                                                    <option disabled>Select Projects</option>

                                                    <?php
                                                    foreach ($availableProjects as $project) {
                                                    ?>

                                                        <option value="<?= $project['project_id'] ?>"><?= $project['project_title']; ?></option>

                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col mb-3">
                                                <label for="Select Projects" class="form-label">Projects</label>
                                                <select class="form-select" name="project_id" id="exampleFormControlSelect1" aria-label="Select Select Projects">
                                                    <option disabled>No Results Found.</option>
                                                </select>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            <?php
                        }
                        
                    ?>

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="file" class="form-label">Report File <span><i>[.pdf, .docx, .doc, .xslx, .xls Allowed]</i></label>
                            <input type="file" name="file" id="file" class="form-control" placeholder="Please Upload Reporrt File" accept=".pdf,.docx,.doc,.xslx,.xls" required/>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Report Description" class="form-label">Report Description</label>
                            <textarea type="description" name="description" id="description" class="form-control" maxlength="300"></textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Upload Report</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Create Attendance Report Modal -->
<div class="modal fade" id="createAttendanceReportModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Creating Attendance Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="" method="POST" action="/reports/get-attendanceReport">
                        <div class="row g-2">
                            <?php
                                if (isset($projects)) {
                                    if (count($projects) > 1) {
                                        ?>
                                            <div class="col mb-3">
                                                <label for="Project Title" class="form-label">Project Title</label>
                                                <select class="form-select" name="project" id="exampleFormControlSelect1" aria-label="Select a Project Title" required>
                                                    <option disabled>Select a Project Title</option>

                                                    <?php
                                                        foreach ($projects as $project) {
                                                            ?>

                                                                <option value="<?= $project['project_id'] ?>"><?= $project['project_name']; ?></option>

                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        <?php
                                    } elseif (count($projects) === 1) {
                                        ?>
                                            <div class="col mb-3">
                                                <label for="Project Title" class="form-label">Project Title</label>
                                                <select class="form-select" name="project" id="exampleFormControlSelect1" aria-label="Select a Project Title" required>
                                                    <option disabled>Select a Project Title</option>

                                                    <?php
                                                        foreach ($projects as $project) {
                                                            ?>

                                                                <option value="<?= $project['project_id'] ?>"><?= $project['project_name']; ?></option>

                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        <?php
                                    } else {
                                        ?>
                                            <div class="col mb-3">
                                                <label for="Project Title" class="form-label">Project Title</label>
                                                <select class="form-select" name="project" id="exampleFormControlSelect1" aria-label="Select a Project Title" required>
                                                    <option disabled>No Results Found.</option>
                                                </select>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-3">
                                <label for="Date" class="form-label">From</label>
                                <input type="date" name="from" id="Date" class="form-control" placeholder="Date" required />
                            </div>
                            <div class="col mb-3">
                                <label for="Date" class="form-label">To</label>
                                <input type="date" name="to" id="Date" class="form-control" placeholder="Date" required />
                            </div>
                        </div>
                
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Continue</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--View Attendance Modal -->
<div class="modal fade" id="viewAttendanceModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Viewing Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="" method="POST" action="/attendance/view-attendance">
                        <div class="row g-2">
                            <?php
                                if (isset($projects)) {
                                    if (count($projects) > 1) {
                                        ?>
                                            <div class="col mb-3">
                                                <label for="Project Title" class="form-label">Project Title</label>
                                                <select class="form-select" name="project" id="exampleFormControlSelect1" aria-label="Select a Project Title" required>
                                                    <option disabled>Select a Project Title</option>

                                                    <?php
                                                        foreach ($projects as $project) {
                                                            ?>

                                                                <option value="<?= $project['project_id'] ?>"><?= $project['project_name']; ?></option>

                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        <?php
                                    } elseif (count($projects) === 1) {
                                        ?>
                                            <div class="col mb-3">
                                                <label for="Project Title" class="form-label">Project Title</label>
                                                <select class="form-select" name="project" id="exampleFormControlSelect1" aria-label="Select a Project Title" required>
                                                    <option disabled>Select a Project Title</option>

                                                    <?php
                                                        foreach ($projects as $project) {
                                                            ?>

                                                                <option value="<?= $project['project_id'] ?>"><?= $project['project_name']; ?></option>

                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        <?php
                                    } else {
                                        ?>
                                            <div class="col mb-3">
                                                <label for="Project Title" class="form-label">Project Title</label>
                                                <select class="form-select" name="project" id="exampleFormControlSelect1" aria-label="Select a Project Title" required>
                                                    <option disabled>No Results Found.</option>
                                                </select>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-3">
                                <label for="Date" class="form-label">Date</label>
                                <input type="date" name="date" id="Date" class="form-control" placeholder="Date" required />
                            </div>
                        </div>
                
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Continue</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Enable Modal -->
<div class="modal fade" id="enableProjectModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Enabling Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="enable-form" method="POST" action="/Projects/enable-Project">
                <input type="hidden" class="ProjectID" name="Project_id" id="Project_id" value="" required />
                <div class="modal-body">
                    <h5 class="text-center">You are about to enable this Project, do you want to continue?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Decline
                    </button>
                    <button type="submit" class="btn btn-outline-success">Enable Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Download Modal -->
<div class="modal fade" id="downloadReportModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Downloading Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/reports/download-report">
                    <input type="hidden" class="reportID" name="report_id" id="reportID" value="" required />
                    <input type="hidden" class="file" name="file" id="file" value="" required />
                    <h5 class="text-center">You are about to download this Report, do you want to continue?</h5>

                    <span class="report_id"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Decline
                </button>
                <button type="submit" class="btn btn-outline-primary">Download Report</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!--Delete Modal -->
<div class="modal fade" id="deleteReportModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Deleting Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/reports/delete-report">
                    <input type="hidden" class="reportID" name="report_id" id="reportID" value="" required />
                    <input type="hidden" class="" name="deleted_by" value="" required />
                    <h5 class="text-center">You are about to delete this Report, do you want to continue?</h5>

                    <span class="report_id"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Decline
                </button>
                <button type="submit" class="btn btn-outline-danger">Delete Report</button>
            </div>
            </form>
        </div>
    </div>
</div>