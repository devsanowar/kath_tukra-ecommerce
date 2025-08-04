// Add Qunatity input item to Add to Cart

document.addEventListener("DOMContentLoaded", function () {
  const cards = document.querySelectorAll(".product-card");

  cards.forEach((card) => {
    const addToCartBtn = card.querySelector(".add-to-cart-btn");
    const quantitySection = card.querySelector(".quantity-section");
    const quantityInput = card.querySelector(".quantity-input");
    const submitCartBtn = card.querySelector(".submit-cart-btn");

    addToCartBtn.addEventListener("click", function () {
      quantitySection.classList.remove("d-none");
      quantityInput.focus();
    });

    submitCartBtn.addEventListener("click", function () {
      const quantity = quantityInput.value;
      if (quantity > 0) {
        alert(`Added ${quantity} item(s) to cart!`);
        quantitySection.classList.add("d-none");
        quantityInput.value = 1;
      } else {
        alert("Please enter a valid quantity.");
      }
    });
  });
});
