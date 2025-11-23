<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <!--Modal Header-->
      <div class="modal-header">
        <h5 class="modal-title epilogue" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editUserForm" action="../admin_backend/admin_edit.php" method="POST">
        <!--Modal Body-->
          <div class="modal-body text-start">
          <div class="row row-cols-1 row-cols-md-2 g-2 p-3">
            <input type="hidden" id="user_id" name="user_id">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" class="form-control" id="first_name" name="first_name">
            </div>
            <div class="mb-3">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="last_name" name="last_name">
            </div>
            <div class="mb-3">
              <label for="middle_name" class="form-label">Middle Name</label>
              <input type="text" class="form-control" id="middle_name" name="middle_name">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
              <label for="age" class="form-label">Age</label>
              <input type="number" class="form-control" id="age" name="age">
            </div>
            <div class="mb-3">
              <label for="phone_number" class="form-label">Phone Number</label>
              <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>
            <div class="mb-3">
              <label for="password_hash_md5" class="form-label">Password</label>
              <input type="password" class="form-control" id="password_hash_md5" name="password_hash_md5">
            </div>
            <div class="mb-3">
              <label for="confirm_password_md5" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirm_password_md5" name="confirm_password_md5">
            </div>
            <div class="mb-3">
              <label for="admin_role" class="form-label">Role</label>
              <select class="form-select" id="admin_role" name="admin_role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update User</button>
        </div>
      </form>
    </div>
  </div>
</div>