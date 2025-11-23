<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="createCategoryForm" method="POST" action="../admin_backend/admin_create_category.php">
        <div class="modal-header">
          <h5 class="modal-title" id="createCategoryLabel">Add New Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <input type="hidden" name="category_id" id="category_id">
        <div class="modal-body">
          <div class="mb-3">
            <label for="categoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="category_name" required>
          </div>
          <div class="mb-3">
            <label for="categoryDescription" class="form-label">Description</label>
            <textarea class="form-control" id="categoryDescription" name="category_description" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Category</button>
        </div>
      </form>
    </div>
  </div>
</div>
