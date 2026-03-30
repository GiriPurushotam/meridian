document.addEventListener("DOMContentLoaded", function () {
  // ── 1. Navbar shadow on scroll ────────────────────────────
  //
  // We listen to the window 'scroll' event.
  // If the page has scrolled more than 10px, add .scrolled to the
  // navbar (our CSS adds a box-shadow when that class is present).
  //
  const navbar = document.getElementById("main-navbar");

  if (navbar) {
    window.addEventListener(
      "scroll",
      function () {
        if (window.scrollY > 10) {
          navbar.classList.add("scrolled");
        } else {
          navbar.classList.remove("scrolled");
        }
      },
      { passive: true },
    ); // passive:true = better scroll performance
  }

  // ── 2. Scroll reveal animation ────────────────────────────
  //
  // IntersectionObserver watches .reveal elements.
  // When 15% of the element enters the viewport, we add .visible
  // which triggers the CSS fade-up transition defined in main.css.
  //
  // Why IntersectionObserver and not scroll events?
  // Because IO is handled by the browser off the main thread —
  // it doesn't cause jank even on slow devices.
  //
  const reveals = document.querySelectorAll(".reveal");

  if (reveals.length > 0) {
    const observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
            // Stop observing after reveal — no need to watch anymore
            observer.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.15, // fire when 15% of element is visible
      },
    );

    reveals.forEach(function (el) {
      observer.observe(el);
    });
  }
});
