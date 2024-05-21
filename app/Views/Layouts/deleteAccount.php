<div class="card">
    <h5 class="card-header">Delete Account</h5>
    <div class="card-body">
        <div class="mb-3 col-12 mb-0">
            <div class="alert alert-warning">
                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
            </div>
        </div>
        <form id="formAccountDeactivation" method="POST" action="profile-update/delete-account">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="accountDeactivation" id="accountDeactivation" value="1" required />
                <label class="form-check-label" for="accountDeactivation">I confirm my account deactivation</label>
            </div>
            <button type="submit" class="btn btn-danger deactivate-account">Delete Account</button>
        </form>
    </div>
</div>