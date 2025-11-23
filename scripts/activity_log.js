$(document).ready(function () {
  // Load Activity Log
  loadLog();

  function loadLog() {
    $.get(
      "../../pages/admin_backend/admin_activity_log_fetch.php",
      function (data) {
        $("#logTable").html(data);
      }
    );
  }
});
