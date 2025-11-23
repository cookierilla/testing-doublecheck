$(document).ready(function () {
  // Sidebar Hover Logic
  const menu = document.querySelector(".menu");
  const mainContentWrapper = document.getElementById("main-content-wrapper");
  const collapsedWidth = "80px";
  const expandedWidth = "250px";

  if (menu && mainContentWrapper) {
    menu.addEventListener("mouseenter", () => {
      mainContentWrapper.style.marginLeft = expandedWidth;
      mainContentWrapper.style.width = `calc(100% - ${expandedWidth})`;

      setTimeout(() => {
        window.lineChartInstance?.resize();
        window.doughnutChartInstance?.resize();
        window.barChartInstance?.resize();
      }, 300);
    });

    menu.addEventListener("mouseleave", () => {
      mainContentWrapper.style.marginLeft = collapsedWidth;
      mainContentWrapper.style.width = `calc(100% - ${collapsedWidth})`;

      setTimeout(() => {
        window.lineChartInstance?.resize();
        window.doughnutChartInstance?.resize();
        window.barChartInstance?.resize();
      }, 300);
    });

    // Initial state
    mainContentWrapper.style.marginLeft = collapsedWidth;
    mainContentWrapper.style.width = `calc(100% - ${collapsedWidth})`;
  }

  // Active Menu Item Logic
  const navButtons = document.querySelectorAll(
    ".menu-button:not(.first):not(.last)"
  );

  if (navButtons.length > 0) {
    navButtons.forEach((button) => {
      button.addEventListener("click", (event) => {
        navButtons.forEach((btn) => btn.classList.remove("active"));
        event.currentTarget.classList.add("active");

        const menuTextSpan = event.currentTarget.querySelector(".menu-text");
        if (menuTextSpan) {
          console.log(menuTextSpan.textContent.trim() + " clicked");
        }
      });
    });
  }

  // Scroll Button Logic
  const scrollUpBtn = document.getElementById("scroll-up-btn");
  const scrollDownBtn = document.getElementById("scroll-down-btn");
  const scrollThreshold = 200;

  if (scrollUpBtn && scrollDownBtn) {
    const scrollToTop = () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };

    const scrollToBottom = () => {
      window.scrollTo({
        top: document.documentElement.scrollHeight,
        behavior: "smooth",
      });
    };

    const toggleScrollUpButton = () => {
      scrollUpBtn.classList.toggle("visible", window.scrollY > scrollThreshold);
    };

    scrollUpBtn.addEventListener("click", scrollToTop);
    scrollDownBtn.addEventListener("click", scrollToBottom);
    window.addEventListener("scroll", toggleScrollUpButton);
    toggleScrollUpButton();
  }

  // Password Hidden Toggle
  const passwordToggles = document.querySelectorAll(".password-toggle");

  passwordToggles.forEach((button) => {
    button.addEventListener("click", function () {
      const targetInputId = this.getAttribute("data-target");
      const passwordInput = document.getElementById(targetInputId);
      const icon = this.querySelector("i");

      if (passwordInput && icon) {
        const isPassword = passwordInput.type === "password";
        passwordInput.type = isPassword ? "text" : "password";
        icon.classList.toggle("bi-eye", !isPassword);
        icon.classList.toggle("bi-eye-slash", isPassword);
      }
    });
  });
});
