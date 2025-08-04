const searchToggle = document.getElementById("searchToggle");
const searchField = document.getElementById("searchField");
const menuItems = document.querySelectorAll(".menu-item");
const closeSearch = document.getElementById("closeSearch");

searchToggle.addEventListener("click", (e) => {
  e.preventDefault();
  menuItems.forEach((item) => (item.style.display = "none"));
  searchField.style.display = "flex";
  document.querySelector("#searchField input").focus();
});

closeSearch.addEventListener("click", () => {
  searchField.style.display = "none";
  menuItems.forEach((item) => (item.style.display = "block"));
});
