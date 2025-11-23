$(document).ready(function () {
  loadArticles();

  // Load Articles
  function loadArticles() {
    $.get(
      "../../pages/admin_backend/admin_articles_fetch.php",
      function (data) {
        $("#articlesTable").html(data);
      }
    );
  }

  $("#tag_article_btn").click(function () {
    const articleId = $(this).data("article-id");
    const status = $("#status_select").val();
    const sourceReliable = $('input[name="source_reliable"]:checked').val();

    if (!sourceReliable) {
      alert("Please select if the source is reliable.");
      return;
    }

    $.ajax({
      url: "../../pages/admin_backend/admin_review_article_save.php",
      type: "POST",
      data: {
        article_id: articleId,
        status: status,
        source_reliable: sourceReliable,
        matched_keywords: JSON.stringify(matchedKeywordIds),
      },
      success: function (res) {
        const response = typeof res === "string" ? JSON.parse(res) : res;
        if (response.message) {
          alert(response.message);
        } else if (response.error) {
          alert("Error: " + response.error);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX error:", status, error);
        alert("Something went wrong while tagging the article.");
      },
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
      url: "../../pages/admin_backend/admin_articles_search.php",
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
      url: "../../pages/admin_backend/admin_articles_fetch.php",
      method: "post",
      data: {
        status_name: status,
      },
      success: function (data) {
        $("#articlesTable").html(data);
      },
    });
  }

  // Trigger fetch when either filter changes
  status_filter.change(fetchFilteredArticles);
});
