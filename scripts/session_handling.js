$(document).ready(function () {
    $("#login_form").submit(function (event) {
      event.preventDefault();
  
      $.ajax({
        type: "POST",
        url: "../../pages/login/fetch.php",
        data: {
          username: $("#username").val(),
          password: $("#password").val()
        },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            window.location.href = response.redirect;
          } else {
            alert(response.message);
          }
        },
        error: function () {
          alert("An error occurred during login.");
        }
      });
    });
  });
  