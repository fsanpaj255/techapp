function prevSlide() {
    const slider = document.querySelector('.slider');
    slider.insertBefore(slider.lastElementChild, slider.firstElementChild);
}

function nextSlide() {
    const slider = document.querySelector('.slider');
    slider.appendChild(slider.firstElementChild);
}