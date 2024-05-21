<!--Add Role Modal -->
<div class="modal fade" id="addRoleModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Creating New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/roles/create-role" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="Role Name" class="form-label">Role Name</label>
                            <input type="text" name="name" id="Role Name" class="form-control" placeholder="Enter Role Name" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="Role Description" class="form-label">Role Description</label>
                            <input type="text" name="description" id="Role Description" class="form-control" placeholder="Enter Role Description (Optional)" />
                        </div>
                    </div>
                    <hr>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="fw-semibold d-block">Members</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_members" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="add_members" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Create & Assign Roles</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="edit_members" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">Edit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="delete_members" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Delete</label>
                            </div>
                        </div>

                        <div class="col mb-0">
                            <label class="fw-semibold d-block">Projects</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_projects" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="add_projects" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Create</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="edit_projects" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">Update</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="delete_projects" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Delete</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="fw-semibold d-block">Categories</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_categories" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View</label>
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="add_categories" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Create</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="edit_categories" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">Update</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="delete_categories" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Delete</label>
                            </div>
                        </div>

                        <div class="col mb-0">
                            <label class="fw-semibold d-block">Events &amp; Gallery</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_events" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View</label>
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="add_events" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Create</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="edit_events" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">Update</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="delete_events" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Delete</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="fw-semibold d-block">Reports</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="create_reports" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Create Report</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_reports" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View Reports</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="delete_reports" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Delete</label>
                            </div>
                        </div>
                        
                        <div class="col mb-0">
                            <label class="fw-semibold d-block">Colleges &amp; Departments</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_colleges" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="add_colleges" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Create</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="edit_colleges" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">Update</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="delete_colleges" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Delete</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="fw-semibold d-block">User Accounts</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_user" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="add_user" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Create</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="edit_user" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">Update</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="delete_user" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Delete</label>
                            </div>
                        </div>
                        
                        <div class="col mb-0">
                            <label class="fw-semibold d-block">Roles</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_role" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="add_role" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Create</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="edit_role" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">Update</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="delete_role" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Delete</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- <hr>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="fw-semibold d-block">Subject Associations</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_associations" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="add_associations" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Add</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="edit_associations" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">Edit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="delete_associations" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Delete</label>
                            </div>
                        </div>

                        <div class="col mb-0">
                            <label class="fw-semibold d-block">Departments</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_departments" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="add_departments" id="inlinecheckbox2" value="option2" />
                                <label class="form-check-label" for="inlinecheckbox2">Add</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="edit_departments" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">Edit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="delete_departments" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Delete</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="fw-semibold d-block">Timetables, Messages & Notifications</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_messages" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="add_messages" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Add</label>
                            </div>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="edit_messages" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">Edit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="delete_messages" id="inlinecheckbox2" value="1" />
                                <label class="form-check-label" for="inlinecheckbox2">Delete</label>
                            </div>
                        </div>

                        <div class="col mb-0">
                            <label class="fw-semibold d-block">System Reports</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="checkbox" name="view_reports" id="inlinecheckbox1" value="1" />
                                <label class="form-check-label" for="inlinecheckbox1">View Deleted Data Reports</label>
                            </div>
                        </div>
                    </div> -->
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Create Role</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Edit Modal -->
<div class="modal fade" id="viewRoleModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Viewing Role Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <fieldset disabled>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="Role Name" class="form-label">Role Name</label>
                            <input type="text" name="name" id="Role Name" class="rolename form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="Role Description" class="form-label">Role Description</label>
                            <input type="text" name="description" id="Role Description" class="roledescription form-control" />
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <!-- <button type="button" class="btn btn-outline-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>


<!--Delete Modal -->
<div class="modal fade" id="deleteRoleModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Deleting Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/roles/delete-role">
                    <input type="hidden" class="roleID" name="role_id" id="roleID" value="" required />
                    <h5 class="text-center">You are about to delete this role, do you want to continue?</h5>

                    <span class="role_id"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Decline
                </button>
                <button type="submit" class="btn btn-outline-danger">Delete Role</button>
            </div>
            </form>
        </div>
    </div>
</div>