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
                    <h5 class="card-header">Categories</h5>
                </div>
                <?php 
                    if ($user_privileges['add_categories'] === 1) {
                        ?>
                            <div class="col-sm-6" align="right">
                                <br>
                                <a href="" class="btn btn-md rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">New Category</a>&nbsp;&nbsp;
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
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                if (isset($categories)) {
                                    $sn = 0;
                                    foreach ($categories as $category) {
                                        $category_description = json_decode($category['description'], true);

                                ?>
                                        <tr>
                                            <td class="text-center"><?= ++$sn; ?></td>
                                            <td class="text-center"> <?= $category['name']; ?>
                                            </td>
                                            <td class="text-center"><?= $category_description; ?></td>
                                            <td class="text-center">
                                                    <a class="view-category btn btn-outline-info btn-sm" data-categoryid="<?= $category['category_id']; ?>"
                                                    data-categoryname="<?= $category['name']; ?>"
                                                    data-categorydescription="<?= $category_description; ?>"
                                                    data-toggle="modal" data-target="#viewCategoryModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="View" href="#">
                                                        <i class='bx bx-show bx-xs'></i>
                                                    </a>
                                                    <!-- <?php 
                                                        if ($category['deleted_flag'] == 1) {
                                                            ?>
                                                                <a class="disable-member btn btn-outline-warning btn-sm" data-memberid="<?= $category['category_id']; ?>" data-toggle="modal" data-target="#disablememberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Disable" href="#">
                                                                    <i class='bx bxs-lock bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }else {
                                                            ?>
                                                                <a class="enable-member btn btn-outline-warning btn-sm" data-memberid="<?= $category['category_id']; ?>" data-toggle="modal" data-target="#enablememberModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Enable" href="#">
                                                                    <i class='bx bxs-lock-open bx-xs'></i>
                                                                </a>
                                                            <?php
                                                        }
                                                    ?> -->
                                                    <?php 
                                                        if ($user_privileges['delete_categories'] === 1) {
                                                            ?>
                                                                <a class="delete-category btn btn-outline-danger btn-sm" data-categoryid="<?= $category['category_id']; ?>" data-toggle="modal" data-target="#deleteCategoryModal" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="Delete" href="#">
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
    <?php include('Modals/categories.php'); ?>
</div>

<script>
    $(function() {
        $(document).on('click', '.edit-category', function(e) {
            e.preventDefault();
            $('#viewCategoryModal').modal('hide');
            $('#editCategoryModal').modal('show');
        });

        $(document).on('click', '.view-category', function(e) {
            e.preventDefault();
            const categoryID = $(this).data('categoryid');
            const categoryname = $(this).data('categoryname');
            const categorydescription = $(this).data('categorydescription');
            $('.categoryID').val(categoryID);
            $('.categoryname').val(categoryname);
            $('.categorydescription').val(categorydescription);
            $('#viewCategoryModal').modal('show');
        });

        $(document).on('click', '.delete-category', function(e) {
            e.preventDefault();
            const categoryID = $(this).data('categoryid');
            $('.categoryID').val(categoryID);
            // console.log(memberID);
            $('#deleteCategoryModal').modal('show');
        });
    });
</script>
<?= $this->endSection('content') ?>