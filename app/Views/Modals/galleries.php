<!--Add Project Modal -->
<div class="modal fade" id="addGalleryModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Adding to New Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/gallery/add-gallery" enctype="multipart/form-data">
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

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="images" class="form-label">Photos <span><i>[.jpg, .jpeg, .png]</span></label>
                            <input type="file" multiple name="photos[]" id="photos" class="form-control" placeholder="Please Upload Events Photos" accept=".jpg,.jpeg,.png" required/>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Add to Gallery</button>
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
<div class="modal fade" id="deleteGalleryModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Deleting From Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/gallery/delete-gallery">
                    <input type="hidden" class="eventID" name="event_id" id="eventID" value="" required />
                    <h5 class="text-center">You are about to delete these Photos, do you want to continue?</h5>

                    <span class="event_id"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Decline
                </button>
                <button type="submit" class="btn btn-outline-danger">Delete from Gallery</button>
            </div>
            </form>
        </div>
    </div>
</div>