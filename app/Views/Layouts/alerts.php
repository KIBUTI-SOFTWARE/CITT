<?php if (isset($_SESSION['success'])) : ?>
    <div class="col-sm-11" align="right">
        <br>
        <div class="bs-toast toast fade show bg-success top-0 end-0 opacity-75" role="alert" aria-live="assertive" aria-atomic="false" data-bs-delay="1000" data-bs-animation="true" data-bs-autohide="true">
            <div class="toast-header">
                <i class="bx bxs-bell bx-tada"></i>
                <div class="me-auto fw-semibold"> Success</div>
                <small>0 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= $_SESSION['success'] ?>
            </div>
        </div>
    </div>
<?php
    unset($_SESSION['success']);
endif;
?>


<?php if (isset($_SESSION['info'])) : ?>
    <div class="col-sm-11" align="right">
        <br>
        <div class="bs-toast toast fade show bg-info top-0 end-0 opacity-75" role="alert" aria-live="assertive" aria-atomic="false" data-delay="1000">
            <div class="toast-header">
                <i class="bx bxs-bell bx-tada"></i>
                <div class="me-auto fw-semibold"> Info</div>
                <small>0 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= $_SESSION['info'] ?>
            </div>
        </div>
    </div>
<?php
unset($_SESSION['info']);
endif;
?>

<?php if (isset($_SESSION['error'])) : ?>
    <div class="col-sm-11" align="right">
        <br>
        <div class="bs-toast toast fade show bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="false" data-bs-delay="1000">
            <div class="toast-header">
                <i class="bx bxs-bell bx-tada"></i>
                <div class="me-auto fw-semibold"> Error</div>
                <small>0 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= $_SESSION['error'] ?>
            </div>
        </div>
    </div>
<?php
unset($_SESSION['error']);
endif;
?>

<?php if (isset($_SESSION['validationErrors'])) : ?>
    <div class="col-sm-11" align="right">
        <br>
        <div class="bs-toast toast fade show bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="false" data-bs-delay="1000">
            <div class="toast-header">
                <i class="bx bxs-bell bx-tada"></i>
                <div class="me-auto fw-semibold"> Error</div>
                <small>0 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= $_SESSION['validationErrors']->listErrors() ?>
            </div>
        </div>
    </div>
<?php
unset($_SESSION['validationErrors']);
endif;
?>
