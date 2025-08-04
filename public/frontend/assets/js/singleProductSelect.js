document.querySelectorAll(".size-option").forEach((option) => {
  option.addEventListener("click", function () {
    // Remove selected class from all options
    document.querySelectorAll(".size-option").forEach((opt) => {
      opt.classList.remove("selected");
    });

    // Add selected class to clicked option
    this.classList.add("selected");

    // Check the radio input
    const radio = this.querySelector('input[type="radio"]');
    if (radio) {
      radio.checked = true;
    }
  });
});
