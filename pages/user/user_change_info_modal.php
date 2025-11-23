<!-- Edit User Modal -->
<div class="modal fade" id="ProfileModal" tabindex="-1" aria-labelledby="ProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!--Modal Header-->
            <div class="modal-header">
                <h5 class="modal-title epilogue" id="ProfileModalLabel">Make Changes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ProfileForm" action="../user_backend/user_info_edit.php" method="POST">
                <!--Modal Body-->
                <div class="modal-body text-start">
                    <div class="row row-cols-1 row-cols-md-2 g-2 p-3">
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($output['user_id']); ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($output['username']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($output['first_name']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($output['last_name']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo htmlspecialchars($output['middle_name']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($output['email']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($output['age']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($output['phone_number']); ?>">
                        </div>
                        <p></p>
                        <label for="password_hash_md5" class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password_hash_md5" name="password_hash_md5" placeholder="Enter Password">
                            <button class="btn btn-outline-secondary password-toggle" type="button" data-target="password_hash_md5">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="updated" class="btn btn-primary">Update Information</button>
                    </div>
            </form>
        </div>
    </div>
</div>