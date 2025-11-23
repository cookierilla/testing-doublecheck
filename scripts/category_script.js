// category_script.js
$(document).ready(function () {
    // Load Category
    loadCategory();
  
    // Admin Edit User Submission
    $("#createCategoryForm").submit(function (e) {
      e.preventDefault();
      $.post(
        "../../pages/admin_backend/admin_create_category.php",
        $(this).serialize(),
        function (response) {
          alert(response);
          $("#createCategoryForm")[0].reset();
          $("#category_id").val("");
          loadCategory();
        }
      );
    });
  
    // Load Users
    function loadCategory() {
      $.get(
        "../../pages/admin_backend/admin_category_fetch.php",
        function (data) {
          $("#categoryTable").html(data);
        }
      );
    }
  
    // Admin Accounts Dashboard Delete User
    $(document).on("click", ".deleteBtn", function () {
      if (confirm("Are you sure?")) {
        $.post(
          "../../pages/admin_backend/admin_category_delete.php",
          { id: $(this).data("id") },
          function (response) {
            alert(response);
            loadCategory();
          }
        );
      }
    });

    $(document).on("click", ".editBtn", function () {
        const id = $(this).data("category_id");
        const name = $(this).data("name");
        const description = $(this).data("description");
    
        $("#edit_category_id").val(id);
        $("#edit_category_name").val(name);
        $("#edit_category_description").val(description);
    
        const editModal = new bootstrap.Modal(document.getElementById("editCategoryModal"));
        editModal.show();
    });
    
    // Handle edit form submission
    $("#editCategoryForm").submit(function (e) {
        e.preventDefault();
        $.post(
            "../../pages/admin_backend/admin_create_category.php",
            $(this).serialize(),
            function (response) {
                alert(response);
                $("#editCategoryForm")[0].reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById("editCategoryModal"));
                modal.hide();
                loadCategory();
            }
        );
    });
    
  
});