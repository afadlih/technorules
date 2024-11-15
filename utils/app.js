// Hamburger Menu
const hamburger_menu = document.getElementById("hamburger-menu");
const sidebar = document.getElementById("sidebar");

hamburger_menu.addEventListener("click", () => {
  sidebar.classList.toggle("hidden");
  const timer = setTimeout(() => {
    sidebar.classList.toggle("fixed");
    clearTimeout(timer);
  });
});