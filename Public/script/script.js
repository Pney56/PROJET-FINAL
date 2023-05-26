// Récupération des éléments HTML dont nous avons besoin
const signInForm = document.querySelector(".sign-in");
const signUpForm = document.querySelector("#signup-form");
const signUpBtn = document.querySelector("#signup-btn");
const termsCheckbox = document.querySelector("#accept-terms");

// Éléments pour l'affichage et la fermeture du bloc de connexion
const loginBtn = document.querySelector("#login-btn");
const closeLoginBtn = document.querySelector("#close-login-btn");
const loginContainer = document.querySelector("#login-container");

// Au chargement de la page, on cache le formulaire d'inscription
signUpForm.style.display = "none";

// Lorsque l'utilisateur clique sur le lien "Pas de compte ? Inscris-toi !"
signUpBtn.addEventListener("click", () => {
  // On cache le formulaire de connexion
  signInForm.style.display = "none";
  // On affiche le formulaire d'inscription
  signUpForm.style.display = "block";
});

const backToLoginLink = document.querySelector("#back-to-login-link");

backToLoginLink.addEventListener("click", () => {
  signUpForm.style.display = "none";
  signInForm.style.display = "block";
});

signUpForm.addEventListener("submit", (event) => {
  if (!termsCheckbox.checked) {
    event.preventDefault(); // Empêche le formulaire d'être soumis
    alert("Vous devez accepter les conditions d'utilisation pour vous inscrire.");
  }
});

// Affiche le bloc de connexion lorsque l'utilisateur clique sur le bouton de connexion
loginBtn.addEventListener("click", () => {
  loginContainer.style.display = "flex";
});

// Cache le bloc de connexion lorsque l'utilisateur clique sur le bouton de fermeture
closeLoginBtn.addEventListener("click", () => {
  loginContainer.style.display = "none";
});





// test pop-up 
document.addEventListener('DOMContentLoaded', function() {
  var mangaCards = document.querySelectorAll('.manga-card');

  mangaCards.forEach(function(card) {
    var popup = card.querySelector('.manga-popup');
    var image = card.querySelector('img');

    card.addEventListener('mouseenter', function() {
      popup.style.display = 'block';
    });

    card.addEventListener('mouseleave', function() {
      popup.style.display = 'none';
    });
  });
});





  // Sélectionner tous les éléments de classe "manga-synopsis"
  var synopsisElements = document.getElementsByClassName("manga-synopsis");

  // Parcourir tous les éléments et vérifier si le texte est coupé
  for (var i = 0; i < synopsisElements.length; i++) {
    var element = synopsisElements[i];

    // Vérifier si le texte est coupé
    if (element.scrollHeight > element.clientHeight) {
      element.classList.add("synopsis-cropped");
    }
  }

