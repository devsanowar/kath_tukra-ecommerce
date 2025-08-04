function toggleCategoryDropdown() {
  const dropdown = document.getElementById("categoryDropdown");
  dropdown.classList.toggle("show");
}

// Optional: Click outside to close dropdown
document.addEventListener("click", function (event) {
  const button = document.getElementById("categoryToggle");
  const dropdown = document.getElementById("categoryDropdown");
  if (!button.contains(event.target) && !dropdown.contains(event.target)) {
    dropdown.classList.remove("show");
  }
});

function toggleMobileCategories() {
  document.getElementById("mobileCategoriesDropdown").classList.toggle("show");
}
