<!--Add Project Modal -->
<div class="modal fade" id="addEventModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Creating New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/events/add-event" enctype="multipart/form-data">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Event Title" class="form-label">Event Title</label>
                            <input type="text" name="event_title" id="Event Title" class="form-control" placeholder="Enter Event Title" required />
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-3">
                            <?php
                            if (isset($users)) {
                                if (count($users) >= 1) {
                            ?>
                                    <div class="col mb-3">
                                        <label for="Event Leader" class="form-label">Event Leader</label>
                                        <select class="form-select" name="event_leader" id="exampleFormControlSelect1" aria-label="Event Leader" required>
                                            <option disabled>Select Event Leader</option>

                                            <?php
                                            foreach ($users as $user) {
                                            ?>
                                                <option value="<?= $user['user_id'] ?>"><?= $user['firstname']." ".$user['lastname']; ?></option>
                                            <?php

                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col mb-3">
                                        <label for="Event Leader" class="form-label">Event Leader</label>
                                        <select class="form-select" name="event_leader" id="exampleFormControlSelect1" aria-label="Event Leader" required>
                                            <option disabled>No Users Found.</option>
                                        </select>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Starts On" class="form-label">Starts On</label>
                            <input type="date" name="starts_on" id="Starts On" class="form-control" placeholder="Starts On" required />
                        </div>
                        <div class="col mb-3">
                            <label for="Starts On" class="form-label">Ends On</label>
                            <input type="date" name="ends_on" id="Starts On" class="form-control" placeholder="Ends On" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <?php
                        if (isset($availableProjects)) {
                            if (count($availableProjects) >= 1) {
                        ?>
                                <div class="col mb-3">
                                    <label for="Select Projects" class="form-label">Projects</label>
                                    <select class="form-select" name="projects[]" id="exampleFormControlSelect1" aria-label="Select Select Projects" multiple="multiple" required>
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
                                    <select class="form-select" name="projects" id="exampleFormControlSelect1" aria-label="Select Select Projects" required>
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
                            <label for="Event Description" class="form-label">Event Description</label>
                            <textarea type="description" name="description" id="description" class="form-control" maxlength="300"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Create Event</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--View Modal -->
<div class="modal fade" id="viewEventsModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Viewing Event Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <fieldset disabled>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Event Title" class="form-label">Event Title</label>
                            <input type="text" name="event_title" id="Event Title" class="eventtitle form-control" placeholder="Enter Event Title" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Project Description" class="form-label">Project Description</label>
                            <textarea type="description" name="description" id="description" class="eventdescription form-control" maxlength="300"></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <?php
                if ($user_privileges['edit_projects'] === 1) {
                ?>
                    <!-- <button type="button" class="edit-category btn btn-outline-primary">Edit Project</button> -->
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!--Edit Modal -->
<div class="modal fade" id="editCategoryModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Editing Category Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/categories/update-category" enctype="multipart/form-data">
                    <div class="row g-2">
                        <input type="hidden" name="category_id" class="categoryID" required />
                        <div class="col mb-3">
                            <label for="Category Name" class="form-label">Category's Name</label>
                            <input type="text" name="name" id="Category Name" class="categoryname form-control" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Category Description" class="form-label">Category Description</label>
                            <textarea type="description" name="description" id="description" class="categorydescription form-control" maxlength="300"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Update Category</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="deleteEventModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Deleting Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/events/delete-event">
                    <input type="hidden" class="eventID" name="event_id" id="eventID" value="" required />
                    <h5 class="text-center">You are about to delete this Event, do you want to continue?</h5>

                    <span class="event_id"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Decline
                </button>
                <button type="submit" class="btn btn-outline-danger">Delete Event</button>
            </div>
            </form>
        </div>
    </div>
</div>