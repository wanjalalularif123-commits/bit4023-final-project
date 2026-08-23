// Client-side form validation (vanilla JS only - no frameworks)

document.addEventListener("DOMContentLoaded", function () {
  const registerForm = document.getElementById("registerForm");
  const loginForm = document.getElementById("loginForm");

  if (registerForm) {
    registerForm.addEventListener("submit", function (e) {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirm_password").value;

      if (password !== confirmPassword) {
        e.preventDefault();
        alert("Passwords do not match.");
        return;
      }

      if (password.length < 6) {
        e.preventDefault();
        alert("Password must be at least 6 characters.");
      }
    });
  }

  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      const username = loginForm.username.value.trim();
      const password = loginForm.password.value;

      if (!username || !password) {
        e.preventDefault();
        alert("Please fill in all fields.");
      }
    });
  }
});
