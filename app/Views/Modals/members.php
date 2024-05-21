<!--Add User Modal -->
<div class="modal fade" id="addMemberModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Creating New Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/members/add-member" enctype="multipart/form-data">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Member Name" class="form-label">Member's FirstName</label>
                            <input type="text" name="firstname" id="Member Name" class="form-control" placeholder="Enter Member's FirstName" required />
                        </div>
                        <div class="col mb-3">
                            <label for="Member Name" class="form-label">Member's LastName</label>
                            <input type="text" name="lastname" id="Member Name" class="form-control" placeholder="Enter Member's LastName" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Member Email" class="form-label">Member's Email</label>
                            <input type="email" name="email" id="Member Name" class="form-control" placeholder="Enter Member's Email" required />
                        </div>
                        <div class="col mb-3">
                            <label for="User Phone" class="form-label">Member's Phone</label>
                            <input type="text" name="phone" id="Member Name" class="form-control" placeholder="Enter Member's Phone" maxlength="10" minlength="10" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="gender" class="form-label">Member's Gender</label>
                            <select class="form-select" name="gender" id="exampleFormControlSelect1" aria-label="Select Member's Gender" required>
                                <option disabled>Select Member's Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col mb-3">
                            <?php
                                if (isset($colleges)) {
                                    if (count($colleges) >= 1) {
                                        ?>
                                            <div class="col mb-3">
                                                <label for="Member's Department" class="form-label">Member's Department</label>
                                                <select class="form-select" name="department" id="exampleFormControlSelect1" aria-label="Member's Department" required>
                                                    <option disabled>Select Member's Department</option>

                                                    <?php
                                                        foreach ($colleges as $college) {
                                                            if (empty($college['departments'])) {
                                                                $college_departments = 'NONE';
                                                            } else {
                                                                $college_departments = json_decode($college['departments'], true);
                                                            }
                                                            if ($college_departments !== 'NONE') {
                                                                foreach ($college_departments as $department_id => $department_name) {
                                                                    ?>
                                                                        <option value="<?= $department_id ?>"><?= $department_name; ?> - <?= $college['short_name']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                    <option disabled>No Departments Found.</option>
                                                                <?php
                                                                
                                                            }
                                                            
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        <?php
                                    } else {
                                        ?>
                                            <div class="col mb-3">
                                                <label for="Member's Department" class="form-label">Member's Department</label>
                                                <select class="form-select" name="department" id="exampleFormControlSelect1" aria-label="Member's Department" required>
                                                    <option disabled>No Departments Found.</option>
                                                </select>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Create Member</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--View Modal -->
<div class="modal fade" id="viewMemberModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Viewing Member's Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <fieldset disabled>
                    
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="Member Name" class="form-label">Member's FullName</label>
                            <input type="text" name="firstname" id="Member Name" class="memberfullname form-control"/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Member Email" class="form-label">Member's Email</label>
                            <input type="email" name="email" id="Member Name" class="memberemail form-control"/>
                        </div>
                        <div class="col mb-3">
                            <label for="User Phone" class="form-label">Member's Phone</label>
                            <input type="text" name="phone" id="Member Name" class="memberphone form-control"/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="gender" class="form-label">Member's Gender</label>
                            <input type="text" name="level" id="Member Level" class="membergender form-control"/>
                        </div>
                        <div class="col mb-3">
                            <label for="Member Department" class="form-label">Member's Department</label>
                            <input type="text" name="department" id="Member Department" class="memberdepartment form-control"/>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <?php 
                    if ($user_privileges['edit_members'] === 1) {
                        ?>
                            <button type="button" class="edit-member btn btn-outline-primary">Edit Member</button>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<!--Edit Modal -->
<div class="modal fade" id="editMemberModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Editing Member Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/members/update-member" enctype="multipart/form-data">
                    <div class="row g-2">
                        <input type="hidden" name="member_id" class="memberID" required />
                        <div class="col mb-3">
                            <label for="Member Name" class="form-label">Member's FirstName</label>
                            <input type="text" name="firstname" id="Member Name" class="memberfirstname form-control" required />
                        </div>
                        <div class="col mb-3">
                            <label for="Member Name" class="form-label">Member's LastName</label>
                            <input type="text" name="lastname" id="Member Name" class="memberlastname form-control"/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Member Email" class="form-label">Member's Email</label>
                            <input type="email" name="email" id="Member Name" class="memberemail form-control" />
                        </div>
                        <div class="col mb-3">
                            <label for="User Phone" class="form-label">Member's Phone</label>
                            <input type="text" name="phone" id="Member Name" class="memberphone form-control" maxlength="10" minlength="10" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="gender" class="form-label">Member's Gender</label>
                            <select class="membergender form-select" name="gender" id="exampleFormControlSelect1" aria-label="Select Member's Gender" required>
                                <option disabled>Select Member's Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="Member Department" class="form-label">Member's Department</label>
                            <input type="text" name="department" id="Member Department" class="memberdepartment form-control"/>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Update Member</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Update Profile Photo Modal -->
<div class="modal fade" id="updateMemberPhotoModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Update Profile Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/members/updateMember-photo" enctype="multipart/form-data">
                    <input type="hidden" class="memberID" name="member_id" id="memberID" value="" required />
                    <div class="col mb-3">
                        <label for="Member Photo" class="form-label">Member's Photo</label>
                        <input type="file" accept="image/jpg, image/jpeg, image/png" name="photo" id="Member's Photo" class="form-control" required/>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Decline
                </button>
                <button type="submit" class="btn btn-outline-primary">Update Photo</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="deleteMemberModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Deleting Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/members/delete-member">
                    <input type="hidden" class="memberID" name="member_id" id="memberID" value="" required />
                    <h5 class="text-center">You are about to delete this Member, do you want to continue?</h5>

                    <span class="Branch_id"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Decline
                </button>
                <button type="submit" class="btn btn-outline-danger">Delete Member</button>
            </div>
            </form>
        </div>
    </div>
</div>