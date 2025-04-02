// Toggle Mobile Menu
function toggleMenu() {
    document.querySelector(".nav-links").classList.toggle("show");
}

// Toggle Dropdown Menu
document.addEventListener("DOMContentLoaded", function () {
    let dropdownBtn = document.querySelector(".dropbtn");
    let dropdownMenu = document.querySelector(".dropdown-content");

    dropdownBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Prevents page from jumping
        dropdownMenu.classList.toggle("show-dropdown");
    });

    // Close dropdown if clicked outside
    document.addEventListener("click", function (event) {
        if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.remove("show-dropdown");
        }
    });
});
