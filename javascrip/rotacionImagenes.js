document.addEventListener("DOMContentLoaded", function() {
    var currentSlide = 1;
    var slides = document.querySelectorAll('.slider li');

    function nextSlide() {
        slides[currentSlide - 1].style.opacity = 0;
        currentSlide = (currentSlide === slides.length) ? 1 : currentSlide + 1;
        slides[currentSlide - 1].style.opacity = 1;
    }

    setInterval(nextSlide, 3000); // Cambia la imagen cada 3 segundos (3000 milisegundos)
});
