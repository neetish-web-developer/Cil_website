(function() {
  var currentSlide = 0;
  var slides = document.querySelectorAll('.slider img');
  var prevBtn = document.getElementById('prevBtn');
  var nextBtn = document.getElementById('nextBtn');

  function showSlide(n) {
    slides[currentSlide].style.display = 'none';
    currentSlide = (n + slides.length) % slides.length;
    slides[currentSlide].style.display = 'block';
  }

  function nextSlide() {
    showSlide(currentSlide + 1);
  }

  function prevSlide() {
    showSlide(currentSlide - 1);
  }

  function startSlider() {
    setInterval(nextSlide, 8000); // 8 seconds
  }

  // prevBtn.addEventListener('click', prevSlide);
  // nextBtn.addEventListener('click', nextSlide);

  showSlide(currentSlide);
  startSlider();
})()

// for testimonial starts
