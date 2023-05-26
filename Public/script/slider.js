document.addEventListener("DOMContentLoaded", function() {
    var slider = document.querySelector('.slider');
    var sliderItems = document.querySelectorAll('.slider-item');
    var sliderButtons = document.querySelectorAll('.slider-button');
  
    var sliderIndex = 0;
    var numberOfItems = sliderItems.length - 2; // Soustrayez 2 pour exclure les images clonées
    var slideInterval = 3000; // Interval de défilement en millisecondes (1 seconde)
  
    // Clonez les premières images et ajoutez-les à la fin du slider
    var firstClone = sliderItems[0].cloneNode(true);
    var lastClone = sliderItems[sliderItems.length - 1].cloneNode(true);
    slider.appendChild(firstClone);
    slider.insertBefore(lastClone, sliderItems[0]);
  
    // Définissez la position de départ du slider
    slider.style.transform = 'translateX(' + (-(sliderIndex + 1) * sliderItems[0].offsetWidth) + 'px)';
  
    // Fonction pour changer l'image suivante
    function nextSlide() {
      sliderIndex++;
      slider.style.transform = 'translateX(' + (-(sliderIndex + 1) * sliderItems[0].offsetWidth) + 'px)';
  
      // Vérifier si le slider est arrivé à la dernière image clonée
      if (sliderIndex >= numberOfItems) {
        slider.style.transition = 'none';
        sliderIndex = 0;
        slider.style.transform = 'translateX(' + (-(sliderIndex + 1) * sliderItems[0].offsetWidth) + 'px)';
      }
    }
  
    // Déclenche le changement d'image automatiquement à intervalles réguliers
    var slideTimer = setInterval(nextSlide, slideInterval);
  
    // Arrête le défilement automatique lorsque l'utilisateur interagit avec le slider
    slider.addEventListener('mouseover', function() {
      clearInterval(slideTimer);
    });
  
    // Reprend le défilement automatique lorsque l'utilisateur cesse d'interagir avec le slider
    slider.addEventListener('mouseout', function() {
      slideTimer = setInterval(nextSlide, slideInterval);
    });
  
    sliderButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        if (button.classList.contains('prev-button')) {
          sliderIndex--;
        } else if (button.classList.contains('next-button')) {
          sliderIndex++;
        }
  
        slider.style.transform = 'translateX(' + (-(sliderIndex + 1) * sliderItems[0].offsetWidth) + 'px)';
  
        // Loop back to the start or end
        if (sliderIndex < 0) {
          sliderIndex = numberOfItems - 1;
          slider.style.transform = 'translateX(' + (-(sliderIndex + 1) * sliderItems[0].offsetWidth) + 'px)';
        } else if (sliderIndex >= numberOfItems) {
          sliderIndex = 0;
          slider.style.transform = 'translateX(' + (-(sliderIndex + 1) * sliderItems[0].offsetWidth) + 'px)';
        }
      });
    });
  });
  