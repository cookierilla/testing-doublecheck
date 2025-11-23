<div class="modal fade" id="editArticleModal" tabindex="-1" aria-labelledby="editArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editArticleForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editArticleModalLabel">Edit Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="article_id" id="edit_article_id">

                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit_title" name="title">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="edit_content" name="content" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_source_url" class="form-label">Source URL</label>
                        <input type="" class="form-control" id="edit_source_url" name="source_url">
                    </div>

                    <div class="mb-3">
                        <label for="edit_date_published" class="form-label">Date Published</label>
                        <input type="date" class="form-control" id="edit_date_published" name="date_published">
                    </div>

                    <div class="mb-3">
                        <select class="form-select form-select-md" id="edit_category_id" name="CATEGORY_category_id" aria-label="Category selection">
                            <option value="" selected disabled>Select Category</option>
                            <?php
                            include "../../config.php";
                            $categoryQuery = "SELECT * FROM category";
                            $categoryResult = $conn->query($categoryQuery);

                            while ($category = $categoryResult->fetch_assoc()) {
                                echo "<option value='{$category['category_id']}'>{$category['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                        <input type="hidden" class="form-control" id="edit_submission_date" name="submission_date">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
        </form>
    </div>
</div>