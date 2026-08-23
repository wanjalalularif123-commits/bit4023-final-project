// UI enhancements (show/hide password, etc.)

document.addEventListener("DOMContentLoaded", function () {
  const passwordField = document.getElementById("password");
  if (passwordField) {
    const toggle = document.createElement("button");
    toggle.type = "button";
    toggle.textContent = "Show";
    toggle.style.marginLeft = "0.5rem";

    toggle.addEventListener("click", function () {
      if (passwordField.type === "password") {
        passwordField.type = "text";
        toggle.textContent = "Hide";
      } else {
        passwordField.type = "password";
        toggle.textContent = "Show";
      }
    });

    passwordField.insertAdjacentElement("afterend", toggle);
  }
});
