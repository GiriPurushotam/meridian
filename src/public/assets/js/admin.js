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
  // Generic password toggle (change-password page)
  // Handles: <button class="password-toggle" data-target="input-id">
  // ----------------------------------------------------------
  function initGenericPasswordToggles() {
    document.querySelectorAll(".password-toggle").forEach(function (btn) {
      btn.addEventListener("click", function () {
        const targetId = btn.dataset.target;
        const input = document.getElementById(targetId);
        const icon = btn.querySelector("i");
        if (!input || !icon) return;

        if (input.type === "password") {
          input.type = "text";
          icon.className = "bi bi-eye-slash";
        } else {
          input.type = "password";
          icon.className = "bi bi-eye";
        }
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
    initGenericPasswordToggles();
  });
})();

// Message Js ---------------------------------------------------

(function () {
  "use strict";

  const table = document.getElementById("messagesTable");
  if (!table) return;

  table.addEventListener("click", function (e) {
    // Ignore clicks inside action buttons / forms
    if (e.target.closest("form") || e.target.closest("a")) return;

    const summaryRow = e.target.closest(".msg-row");
    if (!summaryRow) return;

    const id = summaryRow.dataset.id;
    const detailRow = document.getElementById("detail-" + id);
    if (!detailRow) return;

    const isOpen = !detailRow.classList.contains("d-none");

    // Collapse all other open rows first
    table.querySelectorAll(".msg-detail-row").forEach(function (dr) {
      dr.classList.add("d-none");
    });
    table.querySelectorAll(".msg-row").forEach(function (r) {
      r.classList.remove("msg-row--open");
      r.setAttribute("aria-expanded", "false");
    });

    if (!isOpen) {
      detailRow.classList.remove("d-none");
      summaryRow.classList.add("msg-row--open");
      summaryRow.setAttribute("aria-expanded", "true");

      // Auto mark as read via fetch (fire-and-forget)
      if (summaryRow.classList.contains("msg-unread")) {
        markRead(id, summaryRow);
      }
    }
  });

  /**
   * AJAX mark-as-read so the page doesn't reload on expand.
   * Falls back gracefully if fetch isn't available.
   */
  function markRead(id, row) {
    var formData = new FormData();
    formData.append("id", id);
    formData.append("action", "mark_read");

    fetch("messages.php", {
      method: "POST",
      body: formData,
    })
      .then(function () {
        // Update UI without reload
        row.classList.remove("msg-unread");

        // Remove the unread dot in the first cell
        var dot = row.querySelector(".msg-dot");
        if (dot) dot.remove();

        // Remove bold from cells
        row.querySelectorAll("td").forEach(function (td) {
          td.style.fontWeight = "";
        });

        // Flip the mark toggle button text inside the detail panel
        var detailRow = document.getElementById("detail-" + id);
        var toggleBtn = detailRow
          ? detailRow.querySelector('[name="action"]')
          : null;
        var toggleIcon = detailRow
          ? detailRow.querySelector(".bi-check2-circle, .bi-circle")
          : null;
        if (toggleBtn) toggleBtn.value = "mark_unread";
        if (toggleIcon) {
          toggleIcon.classList.replace("bi-check2-circle", "bi-circle");
          var btnEl = toggleIcon.closest("button");
          if (btnEl)
            btnEl.innerHTML = '<i class="bi bi-circle me-1"></i>Mark as unread';
        }

        // Decrement the badge in the sidebar
        var badge = document.querySelector(".admin-sidebar .badge");
        if (badge) {
          var count = parseInt(badge.textContent, 10) - 1;
          if (count <= 0) {
            badge.remove();
          } else {
            badge.textContent = count;
          }
        }

        // Also update the page-level unread count line
        var pageUnread = document.querySelector(".admin-page-sub .badge");
        if (pageUnread) {
          var pc = parseInt(pageUnread.textContent, 10) - 1;
          if (pc <= 0) {
            pageUnread.parentElement.innerHTML =
              '<span class="text-muted">All caught up — no unread messages.</span>';
          } else {
            pageUnread.textContent = pc + " unread";
          }
        }
      })
      .catch(function () {
        // Silent fail — next page load will reflect correct state
      });
  }
})();

/* ═══════════════════════════════════════════════
   BANNERS PAGE — image preview before upload (Step 7F)
   Append to src/public/assets/js/admin.js
   (outside and below your existing IIFEs)
   ═══════════════════════════════════════════════ */

(function () {
  "use strict";

  // Live preview for any file input with data-preview="<img-id>"
  document.addEventListener("change", function (e) {
    const input = e.target;
    if (input.type !== "file" || !input.dataset.preview) return;

    const preview = document.getElementById(input.dataset.preview);
    if (!preview) return;

    const file = input.files[0];
    if (!file) {
      preview.classList.add("d-none");
      preview.src = "#";
      return;
    }

    const reader = new FileReader();
    reader.onload = function (ev) {
      preview.src = ev.target.result;
      preview.classList.remove("d-none");
    };
    reader.readAsDataURL(file);
  });
})();
