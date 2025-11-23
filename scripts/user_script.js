//user_script.js

$(document).ready(function () {
  // Load Articles
  loadArticles();
  function loadArticles() {
    $.get(
      "../../pages/user_backend/user_article_fetch.php", 
      function (data) {
      $("#articleData").html(data);
    });
  }

  // Article form submit handler
  $("#articleForm").submit(function (e) {
    e.preventDefault();
    $.post(
      "../../pages/user_backend/user_article_create.php",
      $(this).serialize(),
      function (response) {
        alert(response);
        $("#articleForm")[0].reset();
        $("#article_id").val("");
        loadArticles();
      }
    );
  });

  // Article Delete
  $(document).on("click", ".deleteBtn", function () {
    if (confirm("Are you sure?")) {
      $.post(
        "../../pages/user_backend/user_article_delete.php",
        { id: $(this).data("id") },
        function (response) {
          alert(response);
          loadArticles();
        }
      );
    }
  });

  $(document).on("click", ".editBtn", function () {
    const id = $(this).data("article_id");
    const title = $(this).data("title");
    const source_url = $(this).data("source_url");
    const content = $(this).data("content");
    const date_published = $(this).data("date_published");
    const category_id = $(this).data("category_id");

    $("#edit_article_id").val(id);
    $("#edit_title").val(title);
    $("#edit_source_url").val(source_url);
    $("#edit_content").val(content);
    $("#edit_date_published").val(date_published);
    $("#edit_category_id").val(category_id);

    const editModal = new bootstrap.Modal(
      document.getElementById("editArticleModal")
    );
    editModal.show();
  });

  // Handle edit form submission
  $("#editArticleForm").submit(function (e) {
    e.preventDefault();
    $.post(
      "../../pages/user_backend/user_article_create.php",
      $(this).serialize(),
      function (response) {
        if (response.startsWith("Error:")) {
          alert(response);
        } else {
          alert(response);
          $("#editArticleForm")[0].reset();
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("editArticleModal")
          );
          modal.hide();
          loadArticles();

          location.reload();
        }
      }
    ).fail(function (jqXHR, textStatus, errorThrown) {
      alert("Request failed: " + textStatus);
    });
  });

  // Modal Search
  $(document).on("keyup", "#modalArticleSearchForm", function (e) {
    e.preventDefault();
    const keyword = $("#modalArticleSearchInput").val().trim();

    if (keyword === "") {
      $("#modalSearchResults").html("");
      return;
    }

    $.ajax({
      url: "../../pages/user_backend/user_article_search.php",
      method: "GET",
      data: { search: keyword },
      success: function (response) {
        $("#modalSearchResults").html(response);
      },
    });
  });

  //Filters
  let status_filter = $("#status_filter");

  function fetchFilteredArticles() {
    let status = status_filter.val();

    $.ajax({
      url: "../../pages/user_backend/user_article_fetch.php",
      method: "post",
      data: {
        status_name: status,
      },
      success: function (data) {
        $("#articleData").html(data);
      },
    });
  }

  // Trigger fetch when either filter changes
  status_filter.change(fetchFilteredArticles);
});
