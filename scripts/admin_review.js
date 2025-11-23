$(document).ready(function () {
  let datePublishedText = $("#date_published").text().slice(16);
  let dateImage = $("#dateImage");
  let content = $("#content").text();
  let title = $("#title").text();
  let keywordCount = parseInt($("#keywordCount").text());

  const getAge = (birthDate) =>
    Math.floor((new Date() - new Date(birthDate).getTime()) / 3.15576e10);
  let age = getAge(datePublishedText);

  if (age > 5) {
    dateImage.attr("src", "../../assets/images/X-icon.png");
  } else {
    dateImage.attr("src", "../../assets/images/check.png");
  }

  function calculateFakeNewsScore(keywordCount, age, source_url, content) {
    $.ajax({
      url: "../../pages/admin_backend/fake_news_calculator.php",
      type: "POST",
      data: {
        keyword_count: keywordCount,
        source_url: source_url,
        date_published: age,
        content: content,
        title: title,
      },
      success: function (data) {
        let percentage = parseFloat(data.replace("%", ""));
        updatePercentageTextAndColor(percentage);
      },
    });
  }
  function updatePercentageTextAndColor(score) {
    const percentageText = $("#percentage");
    const labelText = $("#label");
    let text = "";
    let color = "";

    if (score <= 10) {
      text = "Likely REAL";
      color = "#7CB518";
    } else if (score > 10 && score <= 35) {
      text = "Questionable";
      color = "#FF9000";
    } else if (score > 35 && score <= 60) {
      text = "Unreliable";
      color = "#990033";
    } else {
      text = "Likely FAKE";
      color = "#660000";
    }

    percentageText.text(`${score}%`);
    percentageText.css("color", color);
    labelText.text(text);
    labelText.css("color", color);
  }

  let selectedRadio = $("input[name=source_reliable]:checked").val();
  if (selectedRadio === "Yes" || selectedRadio === "No") {
    let source_url = selectedRadio === "Yes";
    calculateFakeNewsScore(keywordCount, age, source_url, content, title);
  } else {
    $("#percentage").text("Select reliability");
  }

  $("#radio_source input").change(function (e) {
    e.preventDefault();
    let newVal = $("input[name=source_reliable]:checked").val();
    let newSourceURL = newVal === "Yes";
    calculateFakeNewsScore(keywordCount, age, newSourceURL, content, title);
  });

  const detectionVal = $("#detection").text();
  const detection = $("#detection");
  if (detectionVal === "Fake") {
    detection.css("color", "#990033");
  } else {
    detection.css("color", "#7CB518");
  }

  let statusDropDown = $("#status_select");
  $("#status_select").change(function (e) { 
    e.preventDefault();

    alert("nigga");
  });
});
