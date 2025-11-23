$(document).ready(function () {
  // profile Form Submission
  $("#ProfileForm").submit(function (e) {
    e.preventDefault();
    $.post(
      "../../pages/user_backend/user_info_edit.php",
      $(this).serialize(),
      function (response) {
        alert(response);
        $("#ProfileForm")[0].reset();
        $("#user_id").val("");
      }
    );
  });

  // Profile Edit Populate Modal Inputs
  $(document).on("click", ".changeInfoBtn", function () {
    $("#user_id").val($(this).data("user_id"));
    $("#username").val($(this).data("username"));
    $("#first_name").val($(this).data("firstname"));
    $("#last_name").val($(this).data("lastname"));
    $("#middle_name").val($(this).data("middlename"));
    $("#email").val($(this).data("email"));
    $("#age").val($(this).data("age"));
    $("#phone_number").val($(this).data("phone"));

    const profileModal = new bootstrap.Modal(
      document.getElementById("ProfileModal")
    );
    profileModal.show();
  });


  $("#ProfileModal").on("hidden.bs.modal", function () {
    location.reload();
  });

});
