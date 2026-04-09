document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("signupForm");
  const error = document.getElementById("signupError");

  if (!form || !error) return;

  form.addEventListener("submit", function (e) {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    error.innerText = "";

    if (name === "" || email === "" || password === "" || confirmPassword === "") {
      e.preventDefault();
      error.innerText = "All fields are required.";
      return;
    }

    if (!email.match(emailPattern)) {
      e.preventDefault();
      error.innerText = "Enter a valid email address.";
      return;
    }

    if (password.length < 6) {
      e.preventDefault();
      error.innerText = "Password must be at least 6 characters.";
      return;
    }

    if (password !== confirmPassword) {
      e.preventDefault();
      error.innerText = "Passwords do not match.";
      return;
    }
  });
});