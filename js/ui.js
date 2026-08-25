document.addEventListener("DOMContentLoaded", function () {
  const passwordFields = document.querySelectorAll('input[type="password"]');

  passwordFields.forEach((field) => {
    const toggle = document.createElement("button");
    toggle.type = "button";
    toggle.textContent = "Show";
    toggle.style.marginLeft = "0.5rem";
    toggle.setAttribute("aria-label", "Show password");

    toggle.addEventListener("click", function () {
      if (field.type === "password") {
        field.type = "text";
        toggle.textContent = "Hide";
        toggle.setAttribute("aria-label", "Hide password");
      } else {
        field.type = "password";
        toggle.textContent = "Show";
        toggle.setAttribute("aria-label", "Show password");
      }
    });

    field.insertAdjacentElement("afterend", toggle);
  });

  // Password strength hint - only on the main "password" field of the
  // register form (id="password"), not the confirm field.
  const registerForm = document.querySelector('form[action="register.php"]');
  if (registerForm) {
    const password = registerForm.querySelector("#password");
    if (password) {
      const hint = document.createElement("div");
      hint.style.fontSize = "0.8rem";
      hint.style.marginTop = "0.25rem";
      hint.style.color = "#6b6b6b";
      hint.textContent = "Password strength: —";
      // insertAdjacentElement puts it right after the field; the Show/Hide
      // button (added above) is already there, so anchor after that instead.
      const afterField = password.nextElementSibling; // the show/hide button
      if (afterField) {
        afterField.insertAdjacentElement("afterend", hint);
      } else {
        password.insertAdjacentElement("afterend", hint);
      }

      password.addEventListener("input", function () {
        const value = password.value;
        let strength = "Too short";
        let color = "#c0392b";

        if (value.length >= 6 && value.length < 10) {
          strength = "Okay";
          color = "#d9a441";
        }
        if (value.length >= 10 && /[0-9]/.test(value) && /[A-Za-z]/.test(value)) {
          strength = "Strong";
          color = "#2d6a4f";
        }

        hint.textContent = value ? "Password strength: " + strength : "Password strength: —";
        hint.style.color = color;
      });
    }
  }
});
