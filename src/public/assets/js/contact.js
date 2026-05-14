/* ═══════════════════════════════════════════════════════════════════
   contact.js — client-side validation for the contact form
   ═══════════════════════════════════════════════════════════════════ */

(function () {
  "use strict";

  const form = document.getElementById("contactForm");
  const submitBtn = document.getElementById("submitBtn");

  if (!form) return;

  // ── Helpers ───────────────────────────────────────────────────────

  function showError(inputId, errorId, msg) {
    const input = document.getElementById(inputId);
    const error = document.getElementById(errorId);
    input.classList.add("is-invalid");
    error.textContent = msg;
    error.classList.add("visible");
  }

  function clearError(inputId, errorId) {
    const input = document.getElementById(inputId);
    const error = document.getElementById(errorId);
    input.classList.remove("is-invalid");
    error.classList.remove("visible");
  }

  // ── Clear errors on input ─────────────────────────────────────────

  ["cf_name", "cf_email", "cf_message"].forEach(function (id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.addEventListener("input", function () {
      clearError(id, "err_" + id.replace("cf_", ""));
    });
  });

  // ── Validate on submit ────────────────────────────────────────────

  form.addEventListener("submit", function (e) {
    let valid = true;

    const name = document.getElementById("cf_name");
    if (!name.value.trim()) {
      showError("cf_name", "err_name", "Please enter your name.");
      valid = false;
    } else {
      clearError("cf_name", "err_name");
    }

    const email = document.getElementById("cf_email");
    const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRe.test(email.value.trim())) {
      showError("cf_email", "err_email", "Please enter a valid email address.");
      valid = false;
    } else {
      clearError("cf_email", "err_email");
    }

    const message = document.getElementById("cf_message");
    if (!message.value.trim()) {
      showError("cf_message", "err_message", "Please enter your message.");
      valid = false;
    } else {
      clearError("cf_message", "err_message");
    }

    if (!valid) {
      e.preventDefault();
      // Scroll to the first invalid field
      const first = form.querySelector(".is-invalid");
      if (first) {
        first.scrollIntoView({ behavior: "smooth", block: "center" });
        first.focus();
      }
      return;
    }

    // Disable button to prevent double-submit
    submitBtn.disabled = true;
    submitBtn.classList.add("loading");
    submitBtn.querySelector(".btn-text").textContent = "Sending";
  });
})();
