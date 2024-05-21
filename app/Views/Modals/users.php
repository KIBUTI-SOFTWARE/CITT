<!--Add User Modal -->
<div class="modal fade" id="addUserModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Creating New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/users/add-user" enctype="multipart/form-data">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="User Name" class="form-label">User's FirstName</label>
                            <input type="text" name="firstname" id="User Name" class="form-control" placeholder="Enter User's FirstName" required />
                        </div>
                        <div class="col mb-3">
                            <label for="User Name" class="form-label">User's LastName</label>
                            <input type="text" name="lastname" id="User Name" class="form-control" placeholder="Enter User's LastName" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="User Email" class="form-label">User's Email</label>
                            <input type="email" name="email" id="User Name" class="form-control" placeholder="Enter User's Email" required />
                        </div>
                        <div class="col mb-3">
                            <label for="User Phone" class="form-label">User's Phone</label>
                            <input type="text" name="phone" id="User Name" class="form-control" placeholder="Enter User's Phone" maxlength="10" minlength="10" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <?php
                            if (isset($roles)) {
                                if (count($roles) > 1) {
                                    ?>
                                        <div class="col mb-3">
                                            <label for="User Role" class="form-label">User's Role</label>
                                            <select class="form-select" name="role" id="exampleFormControlSelect1" aria-label="Select User's Role" required>
                                                <option disabled>Select User's Role</option>

                                                <?php
                                                foreach ($roles as $role) {
                                                ?>

                                                    <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    <?php
                                } elseif (count($roles) === 1) {
                                    ?>
                                        <div class="col mb-3">
                                            <label for="User Role" class="form-label">User's Role</label>
                                            <select class="form-select" name="role" id="exampleFormControlSelect1" aria-label="Select User's Role" required>
                                                <option disabled>Select User's Role</option>

                                                <?php
                                                foreach ($roles as $role) {
                                                ?>

                                                    <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    <?php
                                } else {
                                    ?>
                                        <div class="col mb-3">
                                            <label for="User Role" class="form-label">User's Role</label>
                                            <select class="form-select" name="role_id" id="exampleFormControlSelect1" aria-label="Select User's Role" required>
                                                <option disabled>No Role Found.</option>
                                            </select>
                                        </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="User Level" class="form-label">User's Level</label>
                            <select class="form-select" name="level" id="exampleFormControlSelect1" aria-label="Select User's Level" required>
                                <option disabled>Select User's Level</option>
                                <option value="3">Admin</option>
                                <option value="4">Normal User</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Create User</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--View Modal -->
<div class="modal fade" id="viewUserModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Viewing User Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <fieldset disabled>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="User Name" class="form-label">User's FullName</label>
                            <input type="text" name="firstname" id="User Name" class="userfullname form-control" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="User Email" class="form-label">User's Email</label>
                            <input type="email" name="email" id="User Name" class="useremail form-control" />
                        </div>
                        <div class="col mb-3">
                            <label for="User Phone" class="form-label">User's Phone</label>
                            <input type="text" name="phone" id="User Name" class="userphone form-control" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="User Level" class="form-label">User's Level</label>
                            <input type="level" name="level" id="User Level" class="userlevel form-control" />
                        </div>
                        <div class="col mb-3">
                            <label for="User Phone" class="form-label">User's Role</label>
                            <input type="role" name="role" id="User Role" class="userrole form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="User Level" class="form-label">User's Branch</label>
                            <input type="branch" name="branch" id="User Branch" class="userbranchname form-control" />
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <?php 
                    if ($user_privileges['edit_user'] === 1) {
                        ?><button type="button" class="edit-user btn btn-outline-primary">Edit User</button><?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<!--Edit Modal -->
<div class="modal fade" id="editUserModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Updating User Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/users/edit-user" enctype="multipart/form-data">
                    <div class="row g-2">
                        <input type="hidden" class="userID" name="user_id" required />
                        <div class="col mb-3">
                            <label for="User Name" class="form-label">User's FirstName</label>
                            <input type="text" name="firstname" id="User Name" class="userfirstname form-control" required />
                        </div>
                        <div class="col mb-3">
                            <label for="User Name" class="form-label">User's LastName</label>
                            <input type="text" name="lastname" id="User Name" class="userlastname form-control" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="User Email" class="form-label">User's Email</label>
                            <input type="email" name="email" id="User Name" class="useremail form-control" required />
                        </div>
                        <div class="col mb-3">
                            <label for="User Phone" class="form-label">User's Phone</label>
                            <input type="text" name="phone" id="User Name" class="userphone form-control" maxlength="10" minlength="10" required />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Update User</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="deleteUserModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Deleting User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/users/delete-user">
                    <input type="hidden" class="userID" name="user_id" id="userID" value="" required />
                    <h5 class="text-center">You are about to delete this User, do you want to continue?</h5>

                    <span class="Branch_id"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Decline
                </button>
                <button type="submit" class="btn btn-outline-danger">Delete User</button>
            </div>
            </form>
        </div>
    </div>
</div>