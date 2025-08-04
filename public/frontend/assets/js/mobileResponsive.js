function toggleMobileNav() {
  document.getElementById("mobileNav").classList.toggle("active");
}

document.getElementById("userIcon").addEventListener("click", function (e) {
  e.stopPropagation();
  this.classList.toggle("open");
});
document.getElementById("userIcon2").addEventListener("click", function (e) {
  e.stopPropagation();
  this.classList.toggle("open");
});

document.addEventListener("click", function (e) {
  const userIcon = document.getElementById("userIcon");
  if (!userIcon.contains(e.target)) {
    userIcon.classList.remove("open");
  }
});
document.addEventListener("click", function (e) {
  const userIcon = document.getElementById("userIcon2");
  if (!userIcon.contains(e.target)) {
    userIcon.classList.remove("open");
  }
});

// document.addEventListener("DOMContentLoaded", function () {
//     const toggleBtn = document.getElementById("mobileMenuToggle");
//     const mobileNav = document.getElementById("mobileNav");
//     const desktopNav = document.getElementById("desktopNav").cloneNode(true);
//     desktopNav.classList.remove("d-none");

//     if (mobileNav && desktopNav) {
//       mobileNav.appendChild(desktopNav);
//     }

//     toggleBtn?.addEventListener("click", function () {
//       mobileNav.classList.toggle("active");
//     });
//   });
