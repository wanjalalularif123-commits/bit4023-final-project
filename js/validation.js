  document.addEventListener("DOMContentLoaded", function () {
  const registerForm = document.querySelector('form[action="register.php"]');
  const loginForm = document.querySelector('form[action="login.php"]');

  // ---------- helpers ----------

  function showError(field, message) {
    clearError(field);
    const error = document.createElement("div");
    error.className = "field-error";
    error.textContent = message;
    error.style.color = "#c0392b";
    error.style.fontSize = "0.85rem";
    error.style.marginTop = "0.25rem";
    field.insertAdjacentElement("afterend", error);
    field.style.borderColor = "#c0392b";
  }

  function clearError(field) {
    field.style.borderColor = "";
    const next = field.nextElementSibling;
    if (next && next.classList.contains("field-error")) {
      next.remove();
    }
  }

  function clearAllErrors(form) {
    form.querySelectorAll(".field-error").forEach((el) => el.remove());
    form.querySelectorAll("input").forEach((el) => (el.style.borderColor = ""));
  }

  function isValidEmail(value) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
  }

  // ---------- register form ----------

  if (registerForm) {
    const fullName = registerForm.querySelector("#full_name");
    const email = registerForm.querySelector("#email");
    const password = registerForm.querySelector("#password");
    const confirmPassword = registerForm.querySelector("#confirm_password");

    registerForm.addEventListener("submit", function (e) {
      clearAllErrors(registerForm);
      let hasError = false;

      if (fullName && fullName.value.trim() === "") {
        showError(fullName, "Full name is required.");
        hasError = true;
      }

      if (email && !isValidEmail(email.value.trim())) {
        showError(email, "Please enter a valid email address.");
        hasError = true;
      }

      if (password && password.value.length < 6) {
        showError(password, "Password must be at least 6 characters.");
        hasError = true;
      }

      if (confirmPassword && password && confirmPassword.value !== password.value) {
        showError(confirmPassword, "Passwords do not match.");
        hasError = true;
      }

      if (hasError) {
        e.preventDefault();
      }
    });

    // live feedback: clear a field's error as soon as the user fixes it
    [fullName, email, password, confirmPassword].forEach((field) => {
      if (!field) return;
      field.addEventListener("input", () => clearError(field));
    });

    // live "passwords match" indicator while typing
    if (confirmPassword && password) {
      confirmPassword.addEventListener("input", function () {
        clearError(confirmPassword);
        if (confirmPassword.value && confirmPassword.value !== password.value) {
          showError(confirmPassword, "Passwords do not match yet.");
        }
      });
    }
  }

  // ---------- login form ----------

  if (loginForm) {
    const email = loginForm.querySelector("#email");
    const password = loginForm.querySelector("#password");

    loginForm.addEventListener("submit", function (e) {
      clearAllErrors(loginForm);
      let hasError = false;

      if (email && email.value.trim() === "") {
        showError(email, "Email is required.");
        hasError = true;
      }

      if (password && password.value === "") {
        showError(password, "Password is required.");
        hasError = true;
      }

      if (hasError) {
        e.preventDefault();
      }
    });

    [email, password].forEach((field) => {
      if (!field) return;
      field.addEventListener("input", () => clearError(field));
    });
  }
});
