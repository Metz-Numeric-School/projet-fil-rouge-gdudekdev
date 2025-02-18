let currentIndex = 0; // Index de la slide visible actuellement
const slides = document.querySelectorAll('.hero__right-carrousel-slide'); // Sélectionne toutes les slides
console.log(slides);
const totalSlides = slides.length; // Nombre total de slides

// Fonction pour changer la slide visible
function moveSlide(step) {
  currentIndex += step;
  // Si on dépasse le nombre total de slides, on revient au début
  if (currentIndex < 0) {
    currentIndex = totalSlides - 1;
  } else if (currentIndex >= totalSlides) {
    currentIndex = 0;
  }
  

  // On déplace le carrousel pour afficher la slide correspondante
  const carrousel = document.querySelector('.hero__right-carrousel');
  carrousel.style.transform = `translateX(-${currentIndex * 100}%)`;
}

setInterval(() => {
  moveSlide(1); // Avancer d'une slide toutes les 3 secondes
}, 15000);