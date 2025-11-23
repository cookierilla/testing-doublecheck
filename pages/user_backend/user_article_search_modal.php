<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Search Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <form id="modalArticleSearchForm">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="modalArticleSearchInput" placeholder="Search by ID, Title, Date Published, or Submission Date">
                    </div>
                </form>
                </form>
                <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Date Published</th>
                                <th scope="col">Category</th>
                                <th scope="col">Submission Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                 <th scope="col">Detection Results</th>
                            </tr>
                        </thead>
                        <tbody id="modalSearchResults">
                            <!-- Search results will appear here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>