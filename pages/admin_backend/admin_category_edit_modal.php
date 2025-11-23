<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editCategoryForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="category_id" id="edit_category_id">
          <div class="mb-3">
            <label for="edit_category_name" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="category_name" id="edit_category_name" required>
          </div>
          <div class="mb-3">
            <label for="edit_category_description" class="form-label">Description</label>
            <textarea class="form-control" name="category_description" id="edit_category_description" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
