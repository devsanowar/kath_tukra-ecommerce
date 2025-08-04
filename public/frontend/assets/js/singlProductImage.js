// Change main image when thumbnail is clicked
function changeMainImage(newSrc) {
  const mainImage = document.getElementById("mainProductImage");
  mainImage.src = newSrc;

  // Update active thumbnail
  document.querySelectorAll(".thumbnail-item").forEach((item) => {
    item.classList.remove("active");
  });
  event.currentTarget.parentElement.classList.add("active");
}

// Optional: Zoom functionality for main image
document
  .getElementById("mainProductImage")
  .addEventListener("click", function () {
    this.style.transform =
      this.style.transform === "scale(1.5)" ? "scale(1)" : "scale(1.5)";
    this.style.transition = "transform 0.3s ease";
  });
