// Color selection
document.querySelectorAll(".color-option").forEach((option) => {
  option.addEventListener("click", function () {
    document
      .querySelectorAll(".color-option")
      .forEach((opt) => opt.classList.remove("selected"));
    this.classList.add("selected");
  });
});

// Size selection
document.querySelectorAll(".size-option").forEach((option) => {
  option.addEventListener("click", function () {
    document
      .querySelectorAll(".size-option")
      .forEach((opt) => opt.classList.remove("selected"));
    this.classList.add("selected");
  });
});

// Quantity selector
const minusBtn = document.querySelector(".quantity-btn.minus");
const plusBtn = document.querySelector(".quantity-btn.plus");
const quantityInput = document.querySelector(".quantity-input");

minusBtn.addEventListener("click", function () {
  let value = parseInt(quantityInput.value);
  if (value > 1) {
    quantityInput.value = value - 1;
  }
});

plusBtn.addEventListener("click", function () {
  let value = parseInt(quantityInput.value);
  quantityInput.value = value + 1;
});

// Add to cart functionality
document.querySelector(".add-to-cart").addEventListener("click", function () {
  const selectedColor = document
    .querySelector(".color-option.selected")
    .getAttribute("data-color");
  const selectedSize = document
    .querySelector(".size-option.selected")
    .getAttribute("data-size");
  const quantity = quantityInput.value;

  alert(
    `Added to cart: ${quantity} x Samsung Galaxy Z Fold3 5G (Color: ${selectedColor}, Size: ${selectedSize})`
  );
});
