const navlist = document.querySelector("#navlist");
const bar = document.querySelector(".fa-bars");
const xbar = document.querySelector(".fa-x");

// inputs
const login_email = document.querySelector("#login_email");
const login_password = document.querySelector("#login_password");
const login_Confirmpassword = document.querySelector("#reg_confirmPassword");

// label

const label_email = document.querySelector("#login_label_email");
const label_password = document.querySelector("#login_label_password");
const label_confirmPassword = document.querySelector(
  "#reg_label_confirmPassword"
);

let isHidden = false;

bar.onclick = () => {
  if (isHidden) {
    bar.style.display = "flex";
  } else {
    bar.style.display = "none";
    navlist.style.display = "flex";
    xbar.style.display = "flex";
  }
};

xbar.onclick = () => {
  if (isHidden) {
    xbar.style.display = "flex";
  } else {
    xbar.style.display = "none";
    bar.style.display = "flex";
    navlist.style.display = "none";
  }
};

function emailOnchangeLogin() {
  let email = login_email.value;

  if (email.length >= 1) {
    label_email.style.top = "-0.675rem";
  } else {
    label_email.style.top = "0.625rem";
  }
}

function passwordonChangeLogin() {
  let password = login_password.value;

  if (password.length >= 1) {
    label_password.style.top = "-0.675rem";
  } else {
    label_password.style.top = "0.625rem";
  }
}

function confirmPasswordonChangeReg() {
  let password = login_Confirmpassword.value;

  if (password.length >= 1) {
    label_confirmPassword.style.top = "-0.675rem";
  } else {
    label_confirmPassword.style.top = "0.625rem";
  }
}

function focusLoginEmail() {
  login_email.focus();
}
function focusPasswordEmail() {
  login_password.focus();
}
function focusConfirmPasswordEmail() {
  login_Confirmpassword.focus();
}

login_email.addEventListener("input", emailOnchangeLogin);
login_password.addEventListener("input", passwordonChangeLogin);
login_Confirmpassword.addEventListener("input", confirmPasswordonChangeReg);
