$(document).ready(function () {
  // Load Users
  loadUsers();

  // Registration Form Submission
  $("#registrationForm").submit(function (e) {
    e.preventDefault();
    $.post(
      "../../pages/registration/save.php",
      $(this).serialize(),
      function (response) {
        alert(response);
        $("#registrationForm")[0].reset();
        $("#user_id").val("");
      }
    );
  });

  // Admin Edit User Submission
  $("#editUserForm").submit(function (e) {
    e.preventDefault();
    $.post(
      "../../pages/admin_backend/admin_edit.php",
      $(this).serialize(),
      function (response) {
        alert(response);
        $("#editUserForm")[0].reset();
        $("#user_id").val("");
        loadUsers();
      }
    );
  });

  // Load Users
  function loadUsers() {
    $.get(
      "../../pages/admin_backend/admin_accounts_fetch.php",
      function (data) {
        $("#userTable").html(data);
      }
    );
  }

  // Admin Accounts Dashboard Delete User
  $(document).on("click", ".deleteBtn", function () {
    if (confirm("Are you sure?")) {
      $.post(
        "../../pages/admin_backend/admin_account_delete.php",
        { id: $(this).data("id") },
        function (response) {
          alert(response);
          loadUsers();
        }
      );
    }
  });

  // Admin Accounts Dashboard Edit Populate Modal Inputs
  $(document).on("click", ".editBtn", function () {
    $("#user_id").val($(this).data("user_id"));
    $("#username").val($(this).data("username"));
    $("#first_name").val($(this).data("firstname"));
    $("#last_name").val($(this).data("lastname"));
    $("#middle_name").val($(this).data("middlename"));
    $("#email").val($(this).data("email"));
    $("#admin_role").val($(this).data("role"));
    $("#age").val($(this).data("age"));
    $("#phone_number").val($(this).data("phone"));
    $("#password").val($(this).data("password"));

    const editUserModal = new bootstrap.Modal(
      document.getElementById("editUserModal")
    );
    editUserModal.show();
  });

  // Modal Search
  $(document).on("keyup", "#modalSearchForm", function (e) {
    e.preventDefault();
    const keyword = $("#modalSearchInput").val().trim();

    if (keyword === "") {
      $("#modalSearchResults").html("");
      return;
    }

    $.ajax({
      url: "../../pages/admin_backend/admin_accounts_fetch.php",
      method: "GET",
      data: { search: keyword },
      success: function (response) {
        $("#modalSearchResults").html(response);
      },
    });
  });

  $(
    "#first_name, #last_name, #phone_number, #age, #username, #email, #password_hash_md5, #confirm_password_md5"
  ).change(function (e) {
    e.preventDefault();

    let fieldSet = $("#fieldSet");

    if (
      !$("#first_name").val() ||
      !$("#last_name").val() ||
      !$("#phone_number").val() ||
      !$("#age").val() ||
      !$("#username").val() ||
      !$("#email").val() ||
      !$("#password_hash_md5").val() ||
      !$("#confirm_password_md5").val()
    ) {
      fieldSet.attr("class", "fa-solid fa-circle-xmark me-2");
    } else {
      fieldSet.attr("class", "bi bi-check-circle-fill me-2");
      fieldSet.removeAttr("style", "color: white;");
    }
  });

  $("#first_name").change(function (e) {
    e.preventDefault();

    let fieldSet = $("#fieldSet");

    if (
      !$("#first_name").val() ||
      !$("#last_name").val() ||
      !$("#phone_number").val() ||
      !$("#age").val() ||
      !$("#username").val() ||
      !$("#email").val() ||
      !$("#password_hash_md5").val() ||
      !$("#confirm_password_md5").val()
    ) {
      fieldSet.attr("class", "fa-solid fa-circle-xmark me-2");
    } else {
      fieldSet.attr("class", "bi bi-check-circle-fill me-2");
      fieldSet.removeAttr("style", "color: white;");
    }
  });
});
