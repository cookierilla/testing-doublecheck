$(document).ready(function () {
  // Bar Real vs Fake Chart
  fetch("../../pages/admin_backend/admin_linechart.php")
    .then((res) => res.json())
    .then((data) => {
      const ctx = document.getElementById("barChart").getContext("2d");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["Real", "Fake"],
          datasets: [
            {
              label: "Detection ",
              data: [data.real, data.fake],
              backgroundColor: ["#7CB518", "#990033"],
            },
          ],
        },
        options: {
          indexAxis: "y",
          plugins: {
            legend: {
              labels: {
                generateLabels: function (chart) {
                  const colors = ["#7CB518", "#990033"];
                  const labels = ["Real", "Fake"];
                  return labels.map((label, i) => ({
                    text: label,
                    fillStyle: colors[i],
                    strokeStyle: colors[i],
                    lineWidth: 1,
                    hidden: false,
                    index: i,
                  }));
                },
              },
            },
          },
          scales: {
            x: {
              beginAtZero: true,
            },
          },
        },
      });
    });

  // Doughnut Chart
  fetch("../../pages/admin_backend/admin_doughnut.php")
    .then((response) => response.json())
    .then((data) => {
      const ctx = document.getElementById("doughnutChart").getContext("2d");
      new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: ["Pending", "Double-Checked", "Rejected"],
          datasets: [
            {
              label: "Request Status",
              data: [data.pending, data.approved, data.rejected],
              backgroundColor: ["#55D6BE", "#7D5BA6", "#C94277"],
            },
          ],
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: "bottom",
            },
          },
        },
      });
    });
  // Fetching trending keywords from PHP endpoint
  fetch("../../pages/admin_backend/admin_trending_keywords.php")
    .then((response) => response.json())
    .then((data) => {
      const labels = data.map((keyword) => keyword.label); // Extract keyword labels
      const counts = data.map((keyword) => keyword.count); // Extract keyword counts
      const colors = generateRandomColors(labels.length); // Helper to generate random colors

      const radarCtx = document
        .getElementById("keywordRadarChart")
        .getContext("2d");

      // Radar Chart with dynamic data
      const radarChart = new Chart(radarCtx, {
        type: "radar",
        data: {
          labels: labels,
          datasets: [
            {
              label: "Trending Fake News Keywords",
              data: counts,
              backgroundColor: "rgba(255, 99, 132, 0.1)", // Optional fill
              borderColor: "rgba(255, 99, 132, 0.6)",
              borderWidth: 1.5,
              pointBackgroundColor: colors,
              pointBorderColor: colors,
              pointHoverBackgroundColor: colors,
            },
          ],
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: "top",
            },
          },
          scales: {
            r: {
              beginAtZero: true,
              suggestedMax: 20,
              ticks: {
                stepSize: 20,
              },
            },
          },
        },
      });
    });

  // Helper function to generate random colors for each point
  function generateRandomColors(n) {
    const colors = [];
    const baseColors = [
      "#e6194b",
      "#3cb44b",
      "#ffe119",
      "#4363d8",
      "#f58231",
      "#911eb4",
      "#46f0f0",
      "#f032e6",
      "#bcf60c",
      "#fabebe",
    ];
    for (let i = 0; i < n; i++) {
      colors.push(baseColors[i % baseColors.length]);
    }
    return colors;
  }
});
