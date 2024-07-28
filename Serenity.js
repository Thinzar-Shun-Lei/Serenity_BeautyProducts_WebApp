// Cus Js
// Dropdown
//Hamburger Menu
// Hamburger Menu
const hamburgerMenu = document.querySelector(".hamburger");
const dropdownMenu = document.querySelector(".homeDropdown");

hamburgerMenu.addEventListener("click", (e) => {
  e.stopPropagation(); // Prevents the event from bubbling up to the document

  if (dropdownMenu.style.display === "block") {
    dropdownMenu.style.display = "none";
  } else {
    dropdownMenu.style.display = "block";
  }
});
// Close the dropdown menu when clicking outside
document.addEventListener("click", (e) => {
  if (!hamburgerMenu.contains(e.target) && !dropdownMenu.contains(e.target)) {
    dropdownMenu.style.display = "none";
  }
});

