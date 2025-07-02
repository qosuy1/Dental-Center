import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();



//start case details

const slider = document.querySelector(".comparison-slider");
const beforeImage = document.querySelector(".before-image");
const sliderHandle = document.querySelector(".slider-handle");
let isDragging = false;

function updateSliderPosition(x) {
    const rect = slider.getBoundingClientRect();
    const percentage = ((x - rect.left) / rect.width) * 100;
    const clampedPercentage = Math.min(Math.max(percentage, 0), 100);

    beforeImage.style.clipPath = `polygon(0 0, ${clampedPercentage}% 0, ${clampedPercentage}% 100%, 0 100%)`;
    sliderHandle.style.left = `${clampedPercentage}%`;
}

slider.addEventListener("mousedown", (e) => {
    isDragging = true;
    updateSliderPosition(e.clientX);
});

window.addEventListener("mousemove", (e) => {
    if (!isDragging) return;
    updateSliderPosition(e.clientX);
});

window.addEventListener("mouseup", () => {
    isDragging = false;
});

// Touch events for mobile
slider.addEventListener("touchstart", (e) => {
    isDragging = true;
    updateSliderPosition(e.touches[0].clientX);
});

window.addEventListener("touchmove", (e) => {
    if (!isDragging) return;
    updateSliderPosition(e.touches[0].clientX);
});

window.addEventListener("touchend", () => {
    isDragging = false;
});

//end case details
