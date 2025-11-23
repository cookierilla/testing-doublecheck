$(document).ready(function () {
  $("#exportArticleBtn").click(function (e) { 
    e.preventDefault();
    window.location.href = "../../pages/admin_backend/export_articles.php";
  });

  $("#exportAccountBtn").click(function (e) { 
    e.preventDefault();
    window.location.href = "../../pages/admin_backend/export_accounts.php";
  });
});
