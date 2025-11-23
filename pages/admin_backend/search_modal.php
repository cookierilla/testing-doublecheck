<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Search Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <form id="modalSearchForm">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="modalSearchInput" placeholder="Search by ID, Username, First Name, Last Name, Middle Name, Email, Age, Phone, Role">
                    </div>
                </form>
                </form>
                <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>First</th>
                                <th>Last</th>
                                <th>Middle</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Phone</th>
                                <th>Password</th>
                                <th>Role</th>
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