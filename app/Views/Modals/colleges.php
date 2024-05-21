<!--Add College Modal -->
<div class="modal fade" id="addCollegeModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Creating New College</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/colleges/add-college" enctype="multipart/form-data">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="College Name" class="form-label">College Name</label>
                            <input type="text" name="name" id="College Name" class="form-control" placeholder="Enter the College Name" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="College Short Name" class="form-label">College Short Name</label>
                            <input type="text" name="short_name" id="College Short Name" class="form-control" placeholder="Enter the College Short Name" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="College Description" class="form-label">College Description</label>
                            <textarea type="description" name="others" id="description" class="form-control" maxlength="300"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Create College</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Add Department Modal -->
<div class="modal fade" id="addDepartmentModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Creating New Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/colleges/add-department" enctype="multipart/form-data">
                    <div class="row g-2">
                        <?php
                            if (isset($colleges)) {
                                if (count($colleges) >= 1) {
                                    ?>
                                        <div class="col mb-3">
                                            <label for="College Name" class="form-label">Please Select a College</label>
                                            <select class="form-select" name="college" id="exampleFormControlSelect1" aria-label="Please Select a College" required>
                                                <option disabled>Please Select a College</option>

                                                <?php
                                                    foreach ($colleges as $college) {
                                                        ?>

                                                            <option value="<?= $college['college_id'] ?>"><?= $college['college_name']." [".$college['short_name']."]"; ?></option>

                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    <?php
                                } else {
                                    ?>
                                        <div class="col mb-3">
                                            <label for="College" class="form-label">Please Select a College</label>
                                            <select class="form-select" name="college" id="exampleFormControlSelect1" aria-label="Please Select a College" required>
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
                            <label for="Department Name" class="form-label">Department Name</label>
                            <input type="text" name="department" id="Department Name" class="form-control" placeholder="Enter the Department Name" required />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Create Department</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--View Modal -->
<div class="modal fade" id="viewCollegeModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Viewing College Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <fieldset disabled>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="College Name" class="form-label">College Name</label>
                            <input type="text" name="name" id="College Name" class="Collegename form-control"/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="College Description" class="form-label">College Description</label>
                            <textarea type="description" name="description" id="description" class="Collegedescription form-control" maxlength="300"></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <?php 
                    if ($user_privileges['edit_categories'] === 1) {
                        ?>
                            <button type="button" class="edit-College btn btn-outline-primary">Edit College</button>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<!--Edit Modal -->
<div class="modal fade" id="editCollegeModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Editing College Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/categories/update-College" enctype="multipart/form-data">
                    <div class="row g-2">
                        <input type="hidden" name="College_id" class="CollegeID" required />
                        <div class="col mb-3">
                            <label for="College Name" class="form-label">College's Name</label>
                            <input type="text" name="name" id="College Name" class="Collegename form-control" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="College Description" class="form-label">College Description</label>
                            <textarea type="description" name="description" id="description" class="Collegedescription form-control" maxlength="300"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Update College</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="deleteCollegeModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Deleting College</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/categories/delete-College">
                    <input type="hidden" class="CollegeID" name="College_id" id="CollegeID" value="" required />
                    <h5 class="text-center">You are about to delete this College, do you want to continue?</h5>

                    <span class="College_id"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Decline
                </button>
                <button type="submit" class="btn btn-outline-danger">Delete College</button>
            </div>
            </form>
        </div>
    </div>
</div>