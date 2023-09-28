const navlist = document.querySelector("#navlist");
const bar = document.querySelector(".fa-bars");
const xbar = document.querySelector(".fa-x");

// Inputs
const firstnameInput = document.querySelector("#firstname");
const lastnameInput = document.querySelector("#lastname");
const emailInput = document.querySelector("#email");
const ageInput = document.querySelector("#age");

// labels
const label_fname = document.querySelector("#label_firstname");
const label_lname = document.querySelector("#label_lastname");
const label_email = document.querySelector("#label_email");
const label_age = document.querySelector("#label_age");

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

// function firstnameOnchange() {
//   let firstname = firstnameInput.value;

//   if (firstname.length >= 1) {
//     label_fname.style.top = "-0.675rem";
//   } else {
//     label_fname.style.top = "0.625rem";
//   }

// }

// if (firstnameInput.value.trim() !== "") {
//   label_fname.style.top = "-0.675rem";
// }

// if (lastnameInput.value.trim() !== "") {
//   label_lname.style.top = "-0.675rem";
// }

// if (emailInput.value.trim() !== "") {
//   label_email.style.top = "-0.675rem";
// }

// if (ageInput.value.trim() !== "") {
//   label_age.style.top = "-0.675rem";
// }




function lastnameonChange() {
  let lastname = lastnameInput.value;

  if (lastname.length >= 1) {
    label_lname.style.top = "-0.675rem";
  } else {
    label_lname.style.top = "0.625rem";
  }
}

function emailOnchange() {
  let email = emailInput.value;

  if (email.length >= 1) {
    label_email.style.top = "-0.675rem";
  } else {
    label_email.style.top = "0.625rem";
  }
}

function ageOnchange() {
  let age = ageInput.value;

  if (age.length >= 1) {
    label_age.style.top = "-0.675rem";
  } else {
    label_age.style.top = "0.625rem";
  }
}



// firstnameInput.addEventListener("input", function() {
//   if (firstnameInput.value.trim() !== "") {
//     label_fname.style.top = "-0.675rem";
//   } else {
//     label_fname.style.top = "2.5rem"; // Adjust the top position as needed
//   }
// });
// if (firstnameInput.value.trim() !== "") {
//   label_fname.style.top = "-0.675rem";
// }


firstnameInput.addEventListener("input", firstnameOnchange);
lastnameInput.addEventListener("input", lastnameonChange);
emailInput.addEventListener("input", emailOnchange);
ageInput.addEventListener("input", ageOnchange);
