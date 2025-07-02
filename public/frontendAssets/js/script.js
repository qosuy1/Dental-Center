document.addEventListener("DOMContentLoaded", () => {
  const mobileMenu = document.getElementById("mobile-menu");
  const navMenu = document.querySelector(".nav-menu");
  const dropdowns = document.querySelectorAll(".dropdown");

  // Toggle mobile menu
  mobileMenu.addEventListener("click", () => {
    mobileMenu.classList.toggle("active");
    navMenu.classList.toggle("active");
  });

  // Handle dropdowns on mobile
  dropdowns.forEach((dropdown) => {
    // Only attach to the dropdown toggle (the <p class="nav-link">)
    const toggle = dropdown.querySelector('.nav-link');
    if (toggle) {
      toggle.addEventListener("click", (e) => {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          // Close other dropdowns
          dropdowns.forEach((d) => {
            if (d !== dropdown) d.classList.remove("active");
          });
          dropdown.classList.toggle("active");
        }
      });
    }
  });

  // Close mobile menu when clicking outside
  document.addEventListener("click", (e) => {
    if (!e.target.closest(".navbar")) {
      mobileMenu.classList.remove("active");
      navMenu.classList.remove("active");
      dropdowns.forEach((dropdown) => dropdown.classList.remove("active"));
    }
  });
});
