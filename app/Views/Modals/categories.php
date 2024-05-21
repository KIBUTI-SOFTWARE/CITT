<!--Add User Modal -->
<div class="modal fade" id="addCategoryModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Creating New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="" method="POST" action="/categories/add-category" enctype="multipart/form-data">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Category Name" class="form-label">Category Name</label>
                            <input type="text" name="name" id="Category Name" class="form-control" placeholder="Enter the Category Name" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="Category Description" class="form-label">Category Description</label>
                            <textarea type="description" name="description" id="description" class="form-control" maxlength="300"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-secondary">
                    Reset
                </button>
                <button type="submit" class="btn btn-outline-primary">Create Category</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--View Modal -->
<div class="modal fade" id="viewCategoryModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Viewing Category Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <fieldset disabled>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="Category Name" class="form-label">Category Name</label>
                            <input type="text" name="name" id="Category Name" class="categoryname form-control"/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="Category Description" class="form-label">Category Description</label>
                            <textarea type="description" name="description" id="description" class="categorydescription form-control" maxlength="300"></textarea>
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
                            <button type="button" class="edit-category btn btn-outline-primary">Edit Category</button>
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
<div class="modal fade" id="deleteCategoryModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Deleting Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/categories/delete-category">
                    <input type="hidden" class="categoryID" name="category_id" id="categoryID" value="" required />
                    <h5 class="text-center">You are about to delete this Category, do you want to continue?</h5>

                    <span class="category_id"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Decline
                </button>
                <button type="submit" class="btn btn-outline-danger">Delete Category</button>
            </div>
            </form>
        </div>
    </div>
</div>