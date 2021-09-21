"use strict";
document.querySelector("#btn-nav").addEventListener("click", toggleMenu);

function toggleMenu() {
    document.querySelector("header nav ul").classList.toggle("show");
}