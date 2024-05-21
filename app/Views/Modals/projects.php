<!--Add Project Modal -->
<div class="modal fade" id="addProjectModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Creating New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/projects/add-project" enctype="multipart/form-data">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Project Title" class="form-label">Project Title</label>
                            <input type="text" name="project_title" id="Project Title" class="form-control" placeholder="Enter Project Title" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <?php
                            if (isset($categories)) {
                                if (count($categories) >= 1) {
                            ?>
                                    <div class="col mb-3">
                                        <label for="Project Category" class="form-label">Project Category</label>
                                        <select class="form-select" name="category" id="exampleFormControlSelect1" aria-label="Select Project Category" required>
                                            <option disabled>Select Project Category</option>

                                            <?php
                                            foreach ($categories as $category) {
                                            ?>

                                                <option value="<?= $category['category_id'] ?>"><?= $category['name']; ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col mb-3">
                                        <label for="Project Category" class="form-label">Project Category</label>
                                        <select class="form-select" name="category" id="exampleFormControlSelect1" aria-label="Select Project Category" required>
                                            <option disabled>No Results Found.</option>
                                        </select>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col mb-3">
                            <label for="Project Stage" class="form-label">Project Stage</label>
                            <select class="form-select" name="stage" id="exampleFormControlSelect1" aria-label="Select Project Stage" aria-multiselectable="" required>
                                <option disabled>Select Project Stage</option>
                                <option value="1">Ideation</option>
                                <option value="2">Proof of Concept</option>
                                <option value="3">Prototype</option>
                                <option value="4">Minimum Viable Product</option>
                                <option value="5">Product</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-3">
                            <?php
                            if (isset($colleges)) {
                                if (count($colleges) >= 1) {
                            ?>
                                    <div class="col mb-3">
                                        <label for="Project Parent College" class="form-label">Project Parent College</label>
                                        <select class="form-select" name="department" id="exampleFormControlSelect1" aria-label="Project Parent College" required>
                                            <option disabled>Select Project Parent College</option>

                                            <?php
                                            foreach ($colleges as $college) {
                                            ?>
                                                <option value="<?= $college['college_id'] ?>"><?= $college['short_name']; ?></option>
                                            <?php

                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col mb-3">
                                        <label for="Project Parent College" class="form-label">Project Parent College</label>
                                        <select class="form-select" name="department" id="exampleFormControlSelect1" aria-label="Project Parent College" required>
                                            <option disabled>No Colleges Found.</option>
                                        </select>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>

                        <div class="col mb-3">
                            <label for="Project Registration Status" class="form-label">Project Registration Status</label>
                            <select class="form-select" name="registration_status" id="exampleFormControlSelect1" aria-label="Select Project Registration Status" aria-multiselectable="" required>
                                <option disabled>Select Project Registration Status</option>
                                <option value="1">Registered</option>
                                <option value="2">On Progress</option>
                                <option value="3">Un Registered</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2">
                        <?php
                        if (isset($members)) {
                            if (count($members) >= 1) {
                        ?>
                                <div class="col mb-3">
                                    <label for="Project Lead Developer" class="form-label">Project Lead Developer</label>
                                    <select class="form-select" name="lead_developer" id="exampleFormControlSelect1" aria-label="Select Lead Developer" required>
                                        <option disabled>Select Project Lead Developer</option>

                                        <?php
                                        foreach ($members as $member) {
                                            $member_details = json_decode($member['member_details'], true);
                                        ?>

                                            <option value="<?= $member['member_id'] ?>"><?= $member_details['firstname'] . " " . $member_details['lastname']; ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col mb-3">
                                    <label for="Project Lead Developer" class="form-label">Project Lead Developer</label>
                                    <select class="form-select" name="lead_developer" id="exampleFormControlSelect1" aria-label="Select Project Lead Developer" required>
                                        <option disabled>No Results Found.</option>
                                    </select>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="row g-2">
                        <?php
                        if (isset($members)) {
                            if (count($members) >= 1) {
                        ?>
                                <div class="col mb-3">
                                    <label for="Other Project Developers" class="form-label">Other Project Developers</label>
                                    <select class="form-select" name="other_developers[]" id="exampleFormControlSelect1" aria-label="Select Other Project Developers" multiple="multiple" required>
                                        <option disabled>Select Other Project Developers</option>

                                        <?php
                                        foreach ($members as $member) {
                                            $member_details = json_decode($member['member_details'], true);
                                        ?>

                                            <option value="<?= $member['member_id'] ?>"><?= $member_details['firstname'] . " " . $member_details['lastname']; ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col mb-3">
                                    <label for="Project Other Developers" class="form-label">Other Project Developers</label>
                                    <select class="form-select" name="other_developers" id="exampleFormControlSelect1" aria-label="Select Other Project Developers" required>
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
                            <label for="Project Description" class="form-label">Project Description</label>
                            <textarea type="description" name="description" id="description" class="form-control" maxlength="300"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Create Project</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--View Modal -->
<div class="modal fade" id="viewProjectsModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Viewing Project Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <fieldset disabled>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Project Title" class="form-label">Project Title</label>
                            <input type="text" name="project_title" id="Project Title" class="projecttitle form-control" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Project Category" class="form-label">Project Category</label>
                            <input type="text" name="project_title" id="Project Title" class="projectcategory form-control" required />
                        </div>
                        <div class="col mb-3">
                            <label for="Project Stage" class="form-label">Project Stage</label>
                            <input type="text" name="project_title" id="Project Title" class="projectstage form-control" required />
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Project Parent College" class="form-label">Project Parent College</label>
                            <input type="text" name="project_title" id="Project Title" class="projectcollege form-control" required />
                        </div>

                        <div class="col mb-3">
                            <label for="Project Registration Status" class="form-label">Project Registration Status</label>
                            <input type="text" name="project_title" id="Project Title" class="projectregstatus form-control" required />
                        </div>
                    </div>

                    <div class="row g-2">
                        <label for="Project Lead Developer" class="form-label">Project Lead Developer</label>
                        <input type="text" name="project_title" id="Project Title" class="projectleaddeveloper form-control" required />
                        
                    </div>


                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Project Description" class="form-label">Project Description</label>
                            <textarea type="description" name="description" id="description" class="projectdescription form-control" maxlength="300"></textarea>
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
<div class="modal fade" id="deleteProjectModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Deleting Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/projects/delete-project">
                    <input type="hidden" class="projectID" name="project_id" id="projectID" value="" required />
                    <h5 class="text-center">You are about to delete this Project, do you want to continue?</h5>

                    <span class="project_id"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Decline
                </button>
                <button type="submit" class="btn btn-outline-danger">Delete Project</button>
            </div>
            </form>
        </div>
    </div>
</div>