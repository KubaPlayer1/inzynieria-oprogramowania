const wrapper = document.querySelector(".wrapper");
const loginLink = document.querySelector(".login-link");
const registerLink = document.querySelector(".register-link");
const btnpopup = document.querySelector(".button-pop");
const btnout = document.querySelector(".button-out");
const close = document.querySelector(".close-button");

registerLink.addEventListener("click", () => {
  wrapper.classList.add("active");
});

loginLink.addEventListener("click", () => {
  wrapper.classList.remove("active");
});

btnpopup.addEventListener("click", () => {
  wrapper.classList.add("active-popup");
});

/*btnout.addEventListener("click", () => {
  Location.href = "../index.html";
});*/

close.addEventListener("click", () => {
  wrapper.classList.remove("active-popup");
});

function emailValidation() {
  var form = document.getElementById("register");
  var email = document.getElementById("email").value;
  var emailValid = document.getElementById("email-valid");
  var pattern =
    /^([A-Za-z0-9_]{2,10})+\@([A-Za-z0-9_]{2,8})+\.([A-Za-z]{2,4})$/;

  /**/

  if (email.match(pattern)) {
    form.classList.add("valid");
    form.classList.remove("invalid");
    emailValid.innerHTML = "Your email address is valid.";
    emailValid.style.color = "#00ff00";
  } else {
    form.classList.remove("valid");
    form.classList.add("invalid");
    emailValid.innerHTML = "Please enter valid address.";
    emailValid.style.color = "#ff0000";
  }
}

function passwordValidation() {
  var form = document.getElementById("register");
  var password = document.getElementById("password").value;
  var passwordValid = document.getElementById("password-valid");
  var pattern = /^[A-Za-z0-9_]{8,24}$/;

  if (password.match(pattern)) {
    form.classList.add("valid");
    form.classList.remove("invalid");
    passwordValid.innerHTML = "Your password is valid.";
    passwordValid.style.color = "#00ff00";
  } else {
    form.classList.remove("valid");
    form.classList.add("invalid");
    passwordValid.innerHTML = "Please enter correct password.";
    passwordValid.style.color = "#ff0000";
  }
}

function usernameValidation() {
  var form = document.getElementById("register");
  var username = document.getElementById("username").value;
  var usernameValid = document.getElementById("username-valid");
  var pattern = /^[A-Za-z0-9_]{4,14}$/;

  if (username.match(pattern)) {
    form.classList.add("valid");
    form.classList.remove("invalid");
    usernameValid.innerHTML = "Username correct.";
    usernameValid.style.color = "#00ff00";
  } else {
    form.classList.remove("valid");
    form.classList.add("invalid");
    usernameValid.innerHTML = "Enter username.";
    usernameValid.style.color = "#ff0000";
  }
}
