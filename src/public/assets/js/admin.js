/**
 * admin.js — Meridian FMS Admin Panel
 * Shared JS for all admin pages
 */

(function () {
  "use strict";

  // ----------------------------------------------------------
  // Sidebar toggle (mobile)
  // ----------------------------------------------------------
  function initSidebar() {
    const sidebar = document.getElementById("adminSidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const toggleBtn = document.getElementById("sidebarToggle");

    if (!sidebar || !overlay || !toggleBtn) return;

    function openSidebar() {
      sidebar.classList.add("open");
      overlay.classList.add("visible");
      document.body.style.overflow = "hidden";
    }

    function closeSidebar() {
      sidebar.classList.remove("open");
      overlay.classList.remove("visible");
      document.body.style.overflow = "";
    }

    toggleBtn.addEventListener("click", openSidebar);
    overlay.addEventListener("click", closeSidebar);

    // Close on Escape key
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") closeSidebar();
    });
  }

  // ----------------------------------------------------------
  // Password visibility toggle (login page)
  // ----------------------------------------------------------
  function initPasswordToggle() {
    const toggle = document.getElementById("togglePw");
    const input = document.getElementById("password");
    const icon = document.getElementById("pwIcon");

    if (!toggle || !input || !icon) return;

    toggle.addEventListener("click", function () {
      if (input.type === "password") {
        input.type = "text";
        icon.className = "bi bi-eye-slash";
      } else {
        input.type = "password";
        icon.className = "bi bi-eye";
      }
    });
  }

  // ----------------------------------------------------------
  // Auto-dismiss alerts after 4 seconds
  // ----------------------------------------------------------
  function initAlertDismiss() {
    document
      .querySelectorAll(".admin-alert[data-auto-dismiss]")
      .forEach(function (el) {
        setTimeout(function () {
          el.style.transition = "opacity 0.4s";
          el.style.opacity = "0";
          setTimeout(function () {
            el.remove();
          }, 400);
        }, 4000);
      });
  }

  // ----------------------------------------------------------
  // Confirm delete dialogs
  // ----------------------------------------------------------
  function initDeleteConfirm() {
    document.querySelectorAll("[data-confirm]").forEach(function (el) {
      el.addEventListener("click", function (e) {
        const message =
          el.dataset.confirm || "Are you sure you want to delete this?";
        if (!window.confirm(message)) {
          e.preventDefault();
        }
      });
    });
  }

  // ----------------------------------------------------------
  // Image preview before upload
  // ----------------------------------------------------------
  function initImagePreview() {
    document
      .querySelectorAll('input[type="file"][data-preview]')
      .forEach(function (input) {
        input.addEventListener("change", function () {
          const previewId = input.dataset.preview;
          const preview = document.getElementById(previewId);
          if (!preview || !input.files || !input.files[0]) return;

          const reader = new FileReader();
          reader.onload = function (e) {
            preview.src = e.target.result;
          };
          reader.readAsDataURL(input.files[0]);
        });
      });
  }

  // ----------------------------------------------------------
  // Init all on DOM ready
  // ----------------------------------------------------------
  document.addEventListener("DOMContentLoaded", function () {
    initSidebar();
    initPasswordToggle();
    initAlertDismiss();
    initDeleteConfirm();
    initImagePreview();
  });
})();
